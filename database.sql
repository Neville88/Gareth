-- Create the database
CREATE DATABASE IF NOT EXISTS gareth_portfolio;
USE gareth_portfolio;

-- Users table for authentication
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Projects table
CREATE TABLE IF NOT EXISTS projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    live_url VARCHAR(255),
    github_url VARCHAR(255),
    featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Project technologies (tags) table
CREATE TABLE IF NOT EXISTS technologies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Project-Technology relationship table
CREATE TABLE IF NOT EXISTS project_technologies (
    project_id INT,
    technology_id INT,
    PRIMARY KEY (project_id, technology_id),
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (technology_id) REFERENCES technologies(id) ON DELETE CASCADE
);

-- Contact messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Skills table
CREATE TABLE IF NOT EXISTS skills (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    category ENUM('frontend', 'backend', 'database', 'other') NOT NULL,
    proficiency INT CHECK (proficiency BETWEEN 1 AND 100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Experience table
CREATE TABLE IF NOT EXISTS experience (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    company VARCHAR(100) NOT NULL,
    location VARCHAR(100),
    start_date DATE NOT NULL,
    end_date DATE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Education table
CREATE TABLE IF NOT EXISTS education (
    id INT PRIMARY KEY AUTO_INCREMENT,
    degree VARCHAR(100) NOT NULL,
    institution VARCHAR(100) NOT NULL,
    field_of_study VARCHAR(100),
    start_date DATE NOT NULL,
    end_date DATE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert some sample data for technologies
INSERT INTO technologies (name) VALUES
('HTML'), ('CSS'), ('JavaScript'), ('PHP'), ('MySQL'),
('React'), ('Node.js'), ('Python'), ('Django'), ('Laravel'),
('Tailwind CSS'), ('Bootstrap'), ('Git'), ('Docker'), ('AWS');

-- Insert sample project
INSERT INTO projects (title, description, image_url, live_url, github_url, featured) VALUES
('Portfolio Website', 'A modern portfolio website built with PHP and Tailwind CSS', '/images/portfolio.jpg', 'https://gareth.com', 'https://github.com/gareth/portfolio', TRUE);

-- Insert sample skills
INSERT INTO skills (name, category, proficiency) VALUES
('HTML/CSS', 'frontend', 95),
('JavaScript', 'frontend', 90),
('PHP', 'backend', 85),
('MySQL', 'database', 80),
('React', 'frontend', 85);

-- Insert sample experience
INSERT INTO experience (title, company, location, start_date, end_date, description) VALUES
('Senior Web Developer', 'Tech Company', 'Kampala, Uganda', '2020-01-01', NULL, 'Leading web development projects and mentoring junior developers');

-- Insert sample education
INSERT INTO education (degree, institution, field_of_study, start_date, end_date, description) VALUES
('Bachelor of Science', 'Makerere University', 'Computer Science', '2016-09-01', '2020-06-30', 'Focused on web development and software engineering'); 