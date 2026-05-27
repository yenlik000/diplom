-- Add audio_url column to lessons (for MP3 / podcast-style lessons)
ALTER TABLE lessons ADD COLUMN IF NOT EXISTS audio_url TEXT;
