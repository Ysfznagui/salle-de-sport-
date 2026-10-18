CREATE DATABASE IF NOT EXISTS salle_sport CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE salle_sport;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(120) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE sports (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(60) NOT NULL
);
CREATE TABLE abonnements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  sport_id INT NOT NULL,
  date_naissance DATE NOT NULL,
  categorie ENUM('enfant','adulte') NOT NULL,
  duree_mois TINYINT NOT NULL,
  prix DECIMAL(8,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (sport_id) REFERENCES sports(id)
);
CREATE TABLE exercices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  image VARCHAR(120) NOT NULL
);

INSERT INTO sports (nom) VALUES ('Fitness'), ('Gymnastique'), ('Danse');
INSERT INTO exercices (nom, image) VALUES
 ('One-arm dumbbell row', 'one-arm-row.jpg'),
 ('Lat pulldown', 'lat-pulldown.jpg');
