-- Sample Projects
INSERT IGNORE INTO projects (title, description, image_url, live_url, github_url, featured) VALUES
('Portfolio Website', 'A responsive portfolio website built with PHP and MySQL', '/images/portfolio.jpg', 'https://gareth.com', 'https://github.com/gareth/portfolio', 1),
('E-commerce Platform', 'Full-stack e-commerce solution with payment integration', '/images/ecommerce.jpg', 'https://shop.example.com', 'https://github.com/gareth/ecommerce', 1),
('Task Management App', 'React-based task management application with real-time updates', '/images/taskapp.jpg', 'https://tasks.example.com', 'https://github.com/gareth/taskapp', 0),
('Weather Dashboard', 'Weather application using OpenWeather API', '/images/weather.jpg', 'https://weather.example.com', 'https://github.com/gareth/weather', 0);

-- Sample Technologies
INSERT IGNORE INTO technologies (name, icon) VALUES
('PHP', 'fab fa-php'),
('MySQL', 'fas fa-database'),
('JavaScript', 'fab fa-js'),
('React', 'fab fa-react'),
('Node.js', 'fab fa-node-js'),
('HTML5', 'fab fa-html5'),
('CSS3', 'fab fa-css3-alt'),
('Bootstrap', 'fab fa-bootstrap');

-- Link Projects with Technologies
INSERT IGNORE INTO project_technologies (project_id, technology_id) VALUES
(1, 1), (1, 2), (1, 6), (1, 7), (1, 8),  -- Portfolio Website
(2, 1), (2, 2), (2, 3), (2, 8),          -- E-commerce Platform
(3, 3), (3, 4), (3, 5),                   -- Task Management App
(4, 3), (4, 6), (4, 7);                   -- Weather Dashboard

-- Sample Skills
INSERT IGNORE INTO skills (name, proficiency, category) VALUES
('PHP', 90, 'Backend'),
('MySQL', 85, 'Database'),
('JavaScript', 88, 'Frontend'),
('React', 82, 'Frontend'),
('Node.js', 80, 'Backend'),
('HTML5', 95, 'Frontend'),
('CSS3', 90, 'Frontend'),
('Bootstrap', 85, 'Frontend'),
('Git', 88, 'Tools'),
('Docker', 75, 'DevOps');

-- Sample Experience
INSERT IGNORE INTO experience (company, title, position, location, description, start_date, end_date, current) VALUES
('Tech Solutions Inc.', 'Senior Software Engineer', 'Senior Web Developer', 'San Francisco, CA', 'Led development of enterprise web applications', '2020-01-01', NULL, 1),
('Digital Creations', 'Full Stack Developer', 'Web Developer', 'New York, NY', 'Developed responsive websites and web applications', '2018-06-01', '2019-12-31', 0),
('StartUp Innovations', 'Junior Developer', 'Junior Developer', 'Boston, MA', 'Assisted in full-stack development projects', '2017-01-01', '2018-05-31', 0);

-- Sample Education
INSERT IGNORE INTO education (institution, degree, field_of_study, location, start_date, end_date, current) VALUES
('University of Technology', 'Master of Computer Science', 'Software Engineering', 'New York, USA', '2015-09-01', '2017-06-30', 0),
('State University', 'Bachelor of Science', 'Computer Science', 'Boston, USA', '2011-09-01', '2015-06-30', 0),
('Online Learning Platform', 'Web Development Certification', 'Full Stack Development', 'Remote', '2020-01-01', NULL, 1);

-- Sample Contact Messages
INSERT IGNORE INTO contact_messages (first_name, last_name, email, subject, message, status) VALUES
('John', 'Doe', 'john@example.com', 'Project Inquiry', 'I would like to discuss a potential project with you.', 'new'),
('Jane', 'Smith', 'jane@example.com', 'Job Opportunity', 'We have an opening that matches your skills.', 'read'),
('Mike', 'Johnson', 'mike@example.com', 'Collaboration', 'Interested in collaborating on an open-source project.', 'new'); 