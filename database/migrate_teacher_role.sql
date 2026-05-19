-- Add teacher role to users
ALTER TABLE users DROP CONSTRAINT users_role_check;
ALTER TABLE users ADD CONSTRAINT users_role_check
    CHECK (role IN ('student', 'teacher', 'admin'));

-- Add teacher ownership to courses
ALTER TABLE courses ADD COLUMN teacher_id INTEGER REFERENCES users(id) ON DELETE SET NULL;
