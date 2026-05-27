-- Add duration_seconds to lessons table
ALTER TABLE lessons ADD COLUMN IF NOT EXISTS duration_seconds INTEGER NOT NULL DEFAULT 0;
