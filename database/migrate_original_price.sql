-- Add original_price column to courses for showing discount
ALTER TABLE courses ADD COLUMN IF NOT EXISTS original_price NUMERIC(10, 2);
