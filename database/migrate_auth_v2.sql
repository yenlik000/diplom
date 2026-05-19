-- =============================================================
-- Bridge LMS — Auth v2 Migration
-- Adds: username, full_name to users
-- Creates: groups, teacher_profiles, student_profiles tables
-- Run ONCE on an existing database.
-- =============================================================

-- ── 1. Extend users table ─────────────────────────────────────

-- Add username (unique login identifier, replaces email for login)
ALTER TABLE users ADD COLUMN IF NOT EXISTS username  VARCHAR(100);
ALTER TABLE users ADD COLUMN IF NOT EXISTS full_name VARCHAR(255);

-- Backfill existing rows: derive username from email prefix
UPDATE users
SET
    username  = LOWER(REGEXP_REPLACE(SPLIT_PART(email, '@', 1), '[^a-z0-9]', '_', 'g')),
    full_name = name
WHERE username IS NULL;

-- Enforce NOT NULL and uniqueness
ALTER TABLE users ALTER COLUMN username  SET NOT NULL;
ALTER TABLE users ALTER COLUMN full_name SET NOT NULL;
ALTER TABLE users ADD CONSTRAINT users_username_key UNIQUE (username);

-- Fix role CHECK to include teacher (idempotent)
ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check;
ALTER TABLE users ADD  CONSTRAINT users_role_check
    CHECK (role IN ('student', 'teacher', 'admin'));


-- ── 2. Groups ─────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS groups (
    id          SERIAL       PRIMARY KEY,
    name        VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at  TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);


-- ── 3. Teacher profiles ───────────────────────────────────────

CREATE TABLE IF NOT EXISTS teacher_profiles (
    id         SERIAL      PRIMARY KEY,
    user_id    INTEGER     NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    bio        TEXT,
    subject    VARCHAR(100),
    created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
    UNIQUE (user_id)
);


-- ── 4. Student profiles ───────────────────────────────────────

CREATE TABLE IF NOT EXISTS student_profiles (
    id         SERIAL      PRIMARY KEY,
    user_id    INTEGER     NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    group_id   INTEGER     REFERENCES groups(id) ON DELETE SET NULL,
    created_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
    UNIQUE (user_id)
);

CREATE INDEX IF NOT EXISTS idx_student_profiles_group ON student_profiles(group_id);


-- ── 5. Seed admin account ────────────────────────────────────
-- Password hash for 'Admin@12345' (bcrypt cost 12).
-- Generate your own: php -r "echo password_hash('YourPassword', PASSWORD_BCRYPT);"
-- Replace the hash below before running.

INSERT INTO users (full_name, username, name, email, password_hash, role)
VALUES (
    'System Admin',
    'admin',
    'System Admin',
    'admin@lms.local',
    '$2y$12$9CM0f4s.7Q02tXFRBZdxeOElNYckM.CRGdqboy.SUoOoNub.tkh0e',
    'admin'
)
ON CONFLICT (username) DO NOTHING;

-- ── Done ──────────────────────────────────────────────────────
