
CREATE TABLE IF NOT EXISTS Logement_entier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    date_creation DATE
);

CREATE TABLE IF NOT EXISTS Chambre_privée (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    date_creation DATE
);

CREATE TABLE IF NOT EXISTS Chambre_partagés (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    date_creation DATE
);
