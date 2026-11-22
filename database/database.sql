CREATE DATABASE tp7_crud;

USE tp7_crud;

CREATE TABLE formations (
    id_formation INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL,
    description TEXT,
    date_debut DATE,
    date_fin DATE
);

CREATE TABLE etudiants (
    id_etudiant INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150),
    telephone VARCHAR(20),
    formation_id INT NOT NULL,
    FOREIGN KEY (formation_id) REFERENCES formations(id_formation)
);

CREATE TABLE modules (
    id_module INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    coefficient INT,
    volume_horaire INT,
    formation_id INT NOT NULL,
    FOREIGN KEY (formation_id) REFERENCES formations(id_formation)
);