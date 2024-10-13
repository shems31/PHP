-- database.sql

-- 1. Création de la base de données 'mon_projet'
CREATE DATABASE IF NOT EXISTS mon_projet CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- 2. Utilisation de la base de données 'mon_projet'
USE mon_projet;

-- 3. Table `users`
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);

-- 4. Table `cv`
DROP TABLE IF EXISTS cv;
CREATE TABLE cv (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255),
    description TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 5. Table `skills`
DROP TABLE IF EXISTS skills;
CREATE TABLE skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cv_id INT NOT NULL,
    title VARCHAR(255),
    description TEXT,
    years_of_experience INT,
    FOREIGN KEY (cv_id) REFERENCES cv(id) ON DELETE CASCADE
);

-- 6. Table `experiences_external`
DROP TABLE IF EXISTS experiences_external;
CREATE TABLE experiences_external (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cv_id INT NOT NULL,
    title VARCHAR(255),
    start_date DATE,
    end_date DATE,
    FOREIGN KEY (cv_id) REFERENCES cv(id) ON DELETE CASCADE
);

-- 7. Table `educations_external`
DROP TABLE IF EXISTS educations_external;
CREATE TABLE educations_external (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cv_id INT NOT NULL,
    school VARCHAR(255),
    start_date DATE,
    end_date DATE,
    FOREIGN KEY (cv_id) REFERENCES cv(id) ON DELETE CASCADE
);

-- 8. Table `projects`
DROP TABLE IF EXISTS projects;
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255),
    description TEXT,
    image VARCHAR(255),
    is_validated BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- 9. Table `favorites`
DROP TABLE IF EXISTS favorites;
CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    project_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);

-- 10. Table `comments`
DROP TABLE IF EXISTS comments;
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    project_id INT NOT NULL,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);

-- 11. Insertion d'un utilisateur admin par défaut
INSERT INTO users (email, first_name, last_name, password, role) VALUES
('admin@example.com', 'Admin', 'User', '$2y$10$ybOP3hulir7vLGAC4A8xUe9nAEAVnGZHsPWcdo7.EWUANkcKwFVLi', 'admin');
-- Le mot de passe est 'password' haché avec password_hash()
