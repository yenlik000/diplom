<?php
/**
 * Run this script to generate the bcrypt hash for the admin seed user,
 * then paste the result into migrate_auth_v2.sql.
 *
 * Usage: php seed_admin.php
 */

$password = 'Admin@12345'; // Change to your desired admin password

$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

echo "Password : {$password}\n";
echo "Hash     : {$hash}\n\n";

echo "SQL INSERT (run in psql after updating the hash):\n";
echo "INSERT INTO users (full_name, username, name, email, password_hash, role)\n";
echo "VALUES ('System Admin', 'admin', 'System Admin', 'admin@lms.local', '{$hash}', 'admin')\n";
echo "ON CONFLICT (username) DO NOTHING;\n";
