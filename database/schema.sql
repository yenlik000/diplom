-- =============================================================
-- Bridge LMS — PostgreSQL Schema
-- =============================================================

-- ------------------------------------------------------------
-- Utility: auto-update updated_at on every row change
-- ------------------------------------------------------------
CREATE OR REPLACE FUNCTION set_updated_at()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;


-- ============================================================
-- USERS
-- ============================================================
CREATE TABLE users (
    id            SERIAL PRIMARY KEY,
    email         VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255),                       -- NULL when using Google OAuth
    google_id     VARCHAR(255) UNIQUE,
    name          VARCHAR(255) NOT NULL,
    avatar_url    TEXT,
    role          VARCHAR(20)  NOT NULL DEFAULT 'student'
                      CHECK (role IN ('student', 'admin')),
    created_at    TIMESTAMPTZ  NOT NULL DEFAULT NOW(),
    updated_at    TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);

CREATE TRIGGER trg_users_updated_at
    BEFORE UPDATE ON users
    FOR EACH ROW EXECUTE FUNCTION set_updated_at();


-- ============================================================
-- COURSES
-- ============================================================
CREATE TABLE courses (
    id           SERIAL PRIMARY KEY,
    title        VARCHAR(255)   NOT NULL,
    description  TEXT,
    cover_image  TEXT,
    price        NUMERIC(10, 2) NOT NULL DEFAULT 0,
    level        VARCHAR(50),   -- 'A1', 'B2', 'Grade 2', etc.
    subject      VARCHAR(100),  -- 'English', 'Math', 'SAT', 'IELTS'
    is_published BOOLEAN        NOT NULL DEFAULT FALSE,
    created_at   TIMESTAMPTZ    NOT NULL DEFAULT NOW(),
    updated_at   TIMESTAMPTZ    NOT NULL DEFAULT NOW()
);

CREATE TRIGGER trg_courses_updated_at
    BEFORE UPDATE ON courses
    FOR EACH ROW EXECUTE FUNCTION set_updated_at();


-- ============================================================
-- MODULES
-- ============================================================
CREATE TABLE modules (
    id         SERIAL PRIMARY KEY,
    course_id  INTEGER      NOT NULL REFERENCES courses(id) ON DELETE CASCADE,
    title      VARCHAR(255) NOT NULL,
    order_num  INTEGER      NOT NULL,
    created_at TIMESTAMPTZ  NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMPTZ  NOT NULL DEFAULT NOW(),
    UNIQUE (course_id, order_num)
);

CREATE INDEX idx_modules_course_id ON modules(course_id);

CREATE TRIGGER trg_modules_updated_at
    BEFORE UPDATE ON modules
    FOR EACH ROW EXECUTE FUNCTION set_updated_at();


-- ============================================================
-- LESSONS
-- ============================================================
CREATE TABLE lessons (
    id               SERIAL PRIMARY KEY,
    module_id        INTEGER      NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
    title            VARCHAR(255) NOT NULL,
    video_url        TEXT,
    audio_url        TEXT,
    text_content     TEXT,
    order_num        INTEGER      NOT NULL,
    is_free_preview  BOOLEAN      NOT NULL DEFAULT FALSE,
    duration_seconds INTEGER      NOT NULL DEFAULT 0,
    created_at       TIMESTAMPTZ  NOT NULL DEFAULT NOW(),
    updated_at       TIMESTAMPTZ  NOT NULL DEFAULT NOW(),
    UNIQUE (module_id, order_num)
);

CREATE INDEX idx_lessons_module_id ON lessons(module_id);

CREATE TRIGGER trg_lessons_updated_at
    BEFORE UPDATE ON lessons
    FOR EACH ROW EXECUTE FUNCTION set_updated_at();


-- ============================================================
-- LESSON MATERIALS  (PDFs, notes, etc.)
-- ============================================================
CREATE TABLE lesson_materials (
    id         SERIAL PRIMARY KEY,
    lesson_id  INTEGER      NOT NULL REFERENCES lessons(id) ON DELETE CASCADE,
    title      VARCHAR(255) NOT NULL,
    file_url   TEXT         NOT NULL,
    file_type  VARCHAR(50),  -- 'pdf', 'docx', 'pptx', etc.
    created_at TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);

CREATE INDEX idx_lesson_materials_lesson_id ON lesson_materials(lesson_id);


-- ============================================================
-- HOMEWORKS
-- ============================================================
CREATE TABLE homeworks (
    id          SERIAL PRIMARY KEY,
    lesson_id   INTEGER      NOT NULL REFERENCES lessons(id) ON DELETE CASCADE,
    title       VARCHAR(255),
    description TEXT,
    max_score   INTEGER      NOT NULL DEFAULT 100,
    created_at  TIMESTAMPTZ  NOT NULL DEFAULT NOW(),
    updated_at  TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);

CREATE INDEX idx_homeworks_lesson_id ON homeworks(lesson_id);

CREATE TRIGGER trg_homeworks_updated_at
    BEFORE UPDATE ON homeworks
    FOR EACH ROW EXECUTE FUNCTION set_updated_at();


-- ============================================================
-- HOMEWORK QUESTIONS
-- ============================================================
CREATE TABLE homework_questions (
    id            SERIAL PRIMARY KEY,
    homework_id   INTEGER NOT NULL REFERENCES homeworks(id) ON DELETE CASCADE,
    question_text TEXT    NOT NULL,
    question_type VARCHAR(20) NOT NULL
                      CHECK (question_type IN ('multiple_choice', 'open')),
    order_num     INTEGER NOT NULL,
    created_at    TIMESTAMPTZ NOT NULL DEFAULT NOW(),
    UNIQUE (homework_id, order_num)
);

CREATE INDEX idx_homework_questions_homework_id ON homework_questions(homework_id);


-- ============================================================
-- HOMEWORK OPTIONS  (choices for multiple_choice questions)
-- ============================================================
CREATE TABLE homework_options (
    id          SERIAL PRIMARY KEY,
    question_id INTEGER NOT NULL REFERENCES homework_questions(id) ON DELETE CASCADE,
    option_text TEXT    NOT NULL,
    is_correct  BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE INDEX idx_homework_options_question_id ON homework_options(question_id);


-- ============================================================
-- ENROLLMENTS  (which courses a user has purchased/unlocked)
-- ============================================================
CREATE TABLE enrollments (
    id          SERIAL PRIMARY KEY,
    user_id     INTEGER     NOT NULL REFERENCES users(id)   ON DELETE CASCADE,
    course_id   INTEGER     NOT NULL REFERENCES courses(id) ON DELETE CASCADE,
    enrolled_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
    expires_at  TIMESTAMPTZ,          -- NULL = no expiry
    UNIQUE (user_id, course_id)
);

CREATE INDEX idx_enrollments_user_id   ON enrollments(user_id);
CREATE INDEX idx_enrollments_course_id ON enrollments(course_id);


-- ============================================================
-- LESSON PROGRESS
-- ============================================================
CREATE TABLE lesson_progress (
    id           SERIAL PRIMARY KEY,
    user_id      INTEGER     NOT NULL REFERENCES users(id)   ON DELETE CASCADE,
    lesson_id    INTEGER     NOT NULL REFERENCES lessons(id) ON DELETE CASCADE,
    completed_at TIMESTAMPTZ NOT NULL DEFAULT NOW(),
    UNIQUE (user_id, lesson_id)
);

CREATE INDEX idx_lesson_progress_user_id   ON lesson_progress(user_id);
CREATE INDEX idx_lesson_progress_lesson_id ON lesson_progress(lesson_id);


-- ============================================================
-- HOMEWORK SUBMISSIONS
-- ============================================================
CREATE TABLE homework_submissions (
    id           SERIAL PRIMARY KEY,
    user_id      INTEGER        NOT NULL REFERENCES users(id)     ON DELETE CASCADE,
    homework_id  INTEGER        NOT NULL REFERENCES homeworks(id) ON DELETE CASCADE,
    submitted_at TIMESTAMPTZ    NOT NULL DEFAULT NOW(),
    score        NUMERIC(5, 2),
    status       VARCHAR(30)    NOT NULL DEFAULT 'submitted',
    feedback     TEXT,
    graded_at    TIMESTAMPTZ,
    UNIQUE (user_id, homework_id)
);

CREATE INDEX idx_homework_submissions_user_id     ON homework_submissions(user_id);
CREATE INDEX idx_homework_submissions_homework_id ON homework_submissions(homework_id);


-- ============================================================
-- HOMEWORK ANSWERS
-- ============================================================
CREATE TABLE homework_answers (
    id                 SERIAL PRIMARY KEY,
    submission_id      INTEGER NOT NULL REFERENCES homework_submissions(id) ON DELETE CASCADE,
    question_id        INTEGER NOT NULL REFERENCES homework_questions(id),
    answer_text        TEXT,                                -- for open questions
    selected_option_id INTEGER REFERENCES homework_options(id), -- for multiple_choice
    is_correct         BOOLEAN                             -- NULL until checked
);

CREATE INDEX idx_homework_answers_submission_id ON homework_answers(submission_id);


-- ============================================================
-- MESSAGES  (Direct messaging between users)
-- ============================================================
CREATE TABLE messages (
    id           SERIAL PRIMARY KEY,
    from_user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    to_user_id   INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    body         TEXT    NOT NULL,
    is_read      BOOLEAN NOT NULL DEFAULT FALSE,
    created_at   TIMESTAMPTZ NOT NULL DEFAULT NOW()
);

CREATE INDEX idx_messages_from ON messages(from_user_id);
CREATE INDEX idx_messages_to   ON messages(to_user_id);


-- ============================================================
-- COMMENTS  (About Us page — authenticated user comments)
-- ============================================================
CREATE TABLE comments (
    id         SERIAL PRIMARY KEY,
    user_id    INTEGER      NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    body       TEXT         NOT NULL,
    created_at TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);

CREATE INDEX idx_comments_user_id ON comments(user_id);

-- ============================================================
-- REVIEWS  (About Us page — user-submitted reviews)
-- ============================================================
CREATE TABLE reviews (
    id         SERIAL PRIMARY KEY,
    author     VARCHAR(255) NOT NULL,
    title      VARCHAR(255) NOT NULL,
    body       TEXT         NOT NULL,
    rating     SMALLINT     NOT NULL CHECK (rating BETWEEN 1 AND 5),
    likes      INTEGER      NOT NULL DEFAULT 0,
    dislikes   INTEGER      NOT NULL DEFAULT 0,
    created_at TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);

-- ============================================================
-- TESTIMONIALS  (landing page reviews)
-- ============================================================
CREATE TABLE testimonials (
    id           SERIAL PRIMARY KEY,
    author_name  VARCHAR(255) NOT NULL,
    author_role  VARCHAR(255),          -- e.g. 'IELTS student', 'Grade 5 parent'
    content      TEXT         NOT NULL,
    avatar_url   TEXT,
    rating       SMALLINT     CHECK (rating BETWEEN 1 AND 5),
    is_published BOOLEAN      NOT NULL DEFAULT FALSE,
    created_at   TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);
