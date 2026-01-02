-- Tworzenie bazy danych
CREATE DATABASE IF NOT EXISTS messages CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE messages;

-- Usunięcie starej tabeli jeśli istnieje
DROP TABLE IF EXISTS messages;

-- Tworzenie struktury tabeli
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    parent_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES messages(id) ON DELETE CASCADE,
    INDEX idx_parent_id (parent_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
