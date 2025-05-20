-- ---------------------------------------------------------------
-- PORTFOLIO DATABASE SCHEMA
-- ---------------------------------------------------------------
-- This SQL file sets up the entire database structure for the portfolio website
-- It creates all necessary tables and inserts sample data
-- ---------------------------------------------------------------

-- Projects table - Stores all portfolio projects
CREATE TABLE IF NOT EXISTS projects (
    id INT PRIMARY KEY AUTO_INCREMENT,         -- Unique identifier for each project
    title VARCHAR(100) NOT NULL,               -- Project title (required)
    description TEXT,                          -- Detailed project description
    image_url VARCHAR(255),                    -- URL to project screenshot/image
    live_url VARCHAR(255),                     -- URL to live demo of the project
    github_url VARCHAR(255),                   -- URL to GitHub repository
    featured BOOLEAN DEFAULT FALSE,            -- Whether project should be featured on homepage
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,        -- When project was added
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- When project was last updated
);

-- Users table - For admin authentication
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,         -- Unique identifier for each user
    username VARCHAR(50) UNIQUE NOT NULL,      -- Username for login (must be unique)
    email VARCHAR(100) UNIQUE NOT NULL,        -- Email address (must be unique)
    password VARCHAR(255) NOT NULL,            -- Hashed password (never store plain text!)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Technologies table - List of programming languages/technologies used in projects
CREATE TABLE IF NOT EXISTS technologies (
    id INT PRIMARY KEY AUTO_INCREMENT,         -- Unique identifier for each technology
    name VARCHAR(50) UNIQUE NOT NULL,          -- Technology name (must be unique)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Project-Technology relationship table - Many-to-many relationship
-- This junction table connects projects with their associated technologies
CREATE TABLE IF NOT EXISTS project_technologies (
    project_id INT,                            -- References projects.id
    technology_id INT,                         -- References technologies.id
    PRIMARY KEY (project_id, technology_id),   -- Composite primary key prevents duplicates
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,      -- If project deleted, delete relationship too
    FOREIGN KEY (technology_id) REFERENCES technologies(id) ON DELETE CASCADE -- If technology deleted, delete relationship too
);

-- Contact messages table - Stores messages from the contact form
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,         -- Unique identifier for each message
    first_name VARCHAR(50) NOT NULL,           -- Sender's first name
    last_name VARCHAR(50) NOT NULL,            -- Sender's last name
    email VARCHAR(100) NOT NULL,               -- Sender's email address
    subject VARCHAR(200) NOT NULL,             -- Message subject
    message TEXT NOT NULL,                     -- Message content
    status ENUM('new', 'read', 'replied') DEFAULT 'new',  -- Current status of the message
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Skills table - For the skills section of the portfolio
CREATE TABLE IF NOT EXISTS skills (
    id INT PRIMARY KEY AUTO_INCREMENT,         -- Unique identifier for each skill
    name VARCHAR(50) NOT NULL,                 -- Skill name
    category ENUM('frontend', 'backend', 'database', 'other') NOT NULL, -- Skill category
    proficiency INT,                           -- Proficiency level (typically 0-100)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Experience table - For work experience section
CREATE TABLE IF NOT EXISTS experience (
    id INT PRIMARY KEY AUTO_INCREMENT,         -- Unique identifier for each job
    title VARCHAR(100) NOT NULL,               -- Job title
    company VARCHAR(100) NOT NULL,             -- Company name
    location VARCHAR(100),                     -- Job location
    start_date DATE NOT NULL,                  -- When you started the job
    end_date DATE,                             -- When you left (NULL if current job)
    description TEXT,                          -- Job description
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Education table - For education section
CREATE TABLE IF NOT EXISTS education (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Unique identifier for each education entry
    degree VARCHAR(255) NOT NULL,              -- Degree/certification name
    institution VARCHAR(255) NOT NULL,         -- School/university name
    location VARCHAR(255) NOT NULL,            -- Institution location
    start_date DATE NOT NULL,                  -- When you started studying
    end_date DATE,                             -- When you finished (NULL if current)
    description TEXT,                          -- Description of studies
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------------
-- SAMPLE DATA
-- ---------------------------------------------------------------

-- Insert sample technologies data
-- Using INSERT IGNORE to prevent duplicate key errors if data already exists
INSERT IGNORE INTO technologies (name) VALUES
('HTML'), ('CSS'), ('JavaScript'), ('PHP'), ('MySQL'),
('React'), ('Node.js'), ('Python'), ('Django'), ('Laravel'),
('Tailwind CSS'), ('Bootstrap'), ('Git'), ('Docker'), ('AWS');

-- Insert sample project
INSERT IGNORE INTO projects (title, description, image_url, live_url, github_url, featured) VALUES
('Portfolio Website', 'A modern portfolio website built with PHP and Tailwind CSS', '/images/portfolio.jpg', 'https://gareth.com', 'https://github.com/gareth/portfolio', TRUE);

-- Insert sample skills
INSERT IGNORE INTO skills (name, category, proficiency) VALUES
('HTML/CSS', 'frontend', 95),
('JavaScript', 'frontend', 90),
('PHP', 'backend', 85),
('MySQL', 'database', 80),
('React', 'frontend', 85);

-- Insert sample experience
INSERT IGNORE INTO experience (title, company, location, start_date, end_date, description) VALUES
('Senior Web Developer', 'TechCorp Inc.', 'New York, NY', '2020-01-01', NULL, 'Lead developer for multiple web applications using React, Node.js, and AWS.'),
('Web Developer', 'Digital Solutions', 'Boston, MA', '2017-05-01', '2019-12-31', 'Developed responsive websites and e-commerce solutions using PHP, MySQL, and JavaScript.');

-- Insert sample education
INSERT IGNORE INTO education (degree, institution, location, start_date, end_date, description) VALUES
('Bachelor of Science in Computer Science', 'Tech University', 'San Francisco, CA', '2013-09-01', '2017-05-01', 'Focus on web development and software engineering principles.'),
('Web Development Bootcamp', 'Coding Academy', 'Online', '2017-01-01', '2017-04-01', 'Intensive training in full-stack web development.');

-- Insert default admin user (username: admin, password: admin123)
-- Password is hashed for security - never store plain text passwords!
INSERT IGNORE INTO users (username, email, password) VALUES
('admin', 'admin@example.com', '$2y$10$8MR3aCL3683.RqMSBLe8/.N.2nh9SbPvnfj4kMk6nVZtXPTLIJXr6'); 