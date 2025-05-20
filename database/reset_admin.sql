-- First, clear the users table
TRUNCATE TABLE users;

-- Insert new admin user with a fresh password hash
INSERT INTO users (username, email, password) VALUES 
('admin', 'admin@example.com', '$2y$10$YourNewSecureHashHere'); 