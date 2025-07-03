-- Do stworzenia tabeli opinii w bazie danych 

CREATE TABLE IF NOT EXISTS wp_karcher_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    text TEXT NOT NULL,
    equipment VARCHAR(255) NOT NULL,
    stars TINYINT NOT NULL CHECK (stars >= 1 AND stars <= 5),
    created_at DATETIME NOT NULL,
    INDEX idx_created_at (created_at),
    INDEX idx_stars (stars),
    INDEX idx_equipment (equipment)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;