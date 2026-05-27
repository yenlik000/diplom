<?php

namespace App\Core;

class MinioStorage
{
    private string $endpoint;
    private string $publicUrl;
    private string $key;
    private string $secret;
    private string $bucket;
    private string $region = 'us-east-1';

    public function __construct()
    {
        $this->endpoint  = rtrim(getenv('MINIO_ENDPOINT')   ?: 'http://minio:9000',    '/');
        $this->publicUrl = rtrim(getenv('MINIO_PUBLIC_URL') ?: 'http://localhost:9000', '/');
        $this->key       = getenv('MINIO_KEY')    ?: 'minio_admin';
        $this->secret    = getenv('MINIO_SECRET') ?: 'minio_secret123';
        $this->bucket    = getenv('MINIO_BUCKET') ?: 'lms-files';
    }

    public function upload(string $tmpPath, string $objectKey, string $mimeType): string
    {
        $this->ensureBucket();
        $this->putObject($tmpPath, $objectKey, $mimeType);
        return "{$this->publicUrl}/{$this->bucket}/{$objectKey}";
    }

    private function putObject(string $tmpPath, string $objectKey, string $mimeType): void
    {
        $now     = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
        $date    = $now->format('Ymd');
        $amzDate = $now->format('Ymd\THis\Z');
        $host    = $this->host();

        $headers = [
            'content-type'          => $mimeType,
            'host'                  => $host,
            'x-amz-content-sha256'  => 'UNSIGNED-PAYLOAD',
            'x-amz-date'            => $amzDate,
        ];
        $auth = $this->sign('PUT', "/{$this->bucket}/{$objectKey}", '', $headers, 'UNSIGNED-PAYLOAD', $date, $amzDate);

        $fp   = fopen($tmpPath, 'rb');
        $size = filesize($tmpPath);

        $ch = curl_init("{$this->endpoint}/{$this->bucket}/{$objectKey}");
        curl_setopt_array($ch, [
            CURLOPT_PUT            => true,
            CURLOPT_INFILE         => $fp,
            CURLOPT_INFILESIZE     => $size,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => $this->buildHeaders($headers, $auth, ['Expect:']),
        ]);
        $resp   = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        fclose($fp);

        if ($status !== 200) {
            throw new \RuntimeException("MinIO upload failed ({$status}): {$resp}");
        }
    }

    private function ensureBucket(): void
    {
        $now     = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
        $date    = $now->format('Ymd');
        $amzDate = $now->format('Ymd\THis\Z');
        $hash    = hash('sha256', '');
        $host    = $this->host();

        $headers = [
            'host'                 => $host,
            'x-amz-content-sha256' => $hash,
            'x-amz-date'           => $amzDate,
        ];
        $auth = $this->sign('HEAD', "/{$this->bucket}", '', $headers, $hash, $date, $amzDate);

        $ch = curl_init("{$this->endpoint}/{$this->bucket}");
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST  => 'HEAD',
            CURLOPT_NOBODY         => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => $this->buildHeaders($headers, $auth),
        ]);
        curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status === 404) {
            $this->createBucket();
        }
        // Always ensure public-read policy is applied (idempotent)
        $this->setBucketPolicy();
    }

    private function createBucket(): void
    {
        $now     = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
        $date    = $now->format('Ymd');
        $amzDate = $now->format('Ymd\THis\Z');
        $hash    = hash('sha256', '');
        $host    = $this->host();

        $headers = [
            'host'                 => $host,
            'x-amz-content-sha256' => $hash,
            'x-amz-date'           => $amzDate,
        ];
        $auth = $this->sign('PUT', "/{$this->bucket}", '', $headers, $hash, $date, $amzDate);

        $ch = curl_init("{$this->endpoint}/{$this->bucket}");
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST  => 'PUT',
            CURLOPT_POSTFIELDS     => '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => $this->buildHeaders($headers, $auth),
        ]);
        curl_exec($ch);
        curl_close($ch);
    }

    private function setBucketPolicy(): void
    {
        $policy = json_encode([
            'Version'   => '2012-10-17',
            'Statement' => [[
                'Effect'    => 'Allow',
                'Principal' => ['AWS' => ['*']],
                'Action'    => ['s3:GetObject'],
                'Resource'  => ["arn:aws:s3:::{$this->bucket}/*"],
            ]],
        ], JSON_UNESCAPED_SLASHES);

        $now     = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
        $date    = $now->format('Ymd');
        $amzDate = $now->format('Ymd\THis\Z');
        $hash    = hash('sha256', $policy);
        $host    = $this->host();

        $headers = [
            'content-length'       => (string) strlen($policy),
            'content-type'         => 'application/json',
            'host'                 => $host,
            'x-amz-content-sha256' => $hash,
            'x-amz-date'           => $amzDate,
        ];
        $auth = $this->sign('PUT', "/{$this->bucket}", 'policy=', $headers, $hash, $date, $amzDate);

        $ch = curl_init("{$this->endpoint}/{$this->bucket}?policy");
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST  => 'PUT',
            CURLOPT_POSTFIELDS     => $policy,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => $this->buildHeaders($headers, $auth),
        ]);
        curl_exec($ch);
        curl_close($ch);
    }

    private function sign(
        string $method,
        string $uri,
        string $queryString,
        array  $headers,
        string $payloadHash,
        string $date,
        string $amzDate
    ): string {
        ksort($headers);

        $signedHeaders    = implode(';', array_keys($headers));
        $canonicalHeaders = '';
        foreach ($headers as $k => $v) {
            $canonicalHeaders .= $k . ':' . trim($v) . "\n";
        }

        $canonicalRequest = implode("\n", [
            $method,
            $uri,
            $queryString,
            $canonicalHeaders,
            $signedHeaders,
            $payloadHash,
        ]);

        $credentialScope = "{$date}/{$this->region}/s3/aws4_request";
        $stringToSign    = implode("\n", [
            'AWS4-HMAC-SHA256',
            $amzDate,
            $credentialScope,
            hash('sha256', $canonicalRequest),
        ]);

        $signingKey = hash_hmac('sha256', 'aws4_request',
            hash_hmac('sha256', 's3',
                hash_hmac('sha256', $this->region,
                    hash_hmac('sha256', $date, "AWS4{$this->secret}", true),
                    true
                ),
                true
            ),
            true
        );

        $signature = hash_hmac('sha256', $stringToSign, $signingKey);

        return "AWS4-HMAC-SHA256 Credential={$this->key}/{$credentialScope}, SignedHeaders={$signedHeaders}, Signature={$signature}";
    }

    private function host(): string
    {
        $p    = parse_url($this->endpoint);
        $host = $p['host'];
        if (!empty($p['port'])) {
            $host .= ':' . $p['port'];
        }
        return $host;
    }

    private function buildHeaders(array $headers, string $auth, array $extra = []): array
    {
        $result = ["Authorization: {$auth}"];
        foreach ($headers as $k => $v) {
            $result[] = "{$k}: {$v}";
        }
        return array_merge($result, $extra);
    }
}
