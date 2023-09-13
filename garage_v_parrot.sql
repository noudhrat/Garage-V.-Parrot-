-- Créer la base de données garage_v_parrot
CREATE DATABASE IF NOT EXISTS garage_v_parrot;

-- Utiliser la base de données garage_v_parrot
USE garage_v_parrot;


CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mdp text NOT NULL,
    role VARCHAR(255) NOT NULL
);

CREATE TABLE services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description text NOT NULL,
    image VARCHAR(255) NOT NULL
);

CREATE TABLE horaires (
    id INT PRIMARY KEY AUTO_INCREMENT,
    horaire VARCHAR(255) NOT NULL
);


CREATE TABLE temoignage (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    message VARCHAR(255) NOT NULL,
    note VARCHAR(255) NOT NULL
);


CREATE TABLE voitures (
    id INT PRIMARY KEY AUTO_INCREMENT,
    image VARCHAR(255) NOT NULL,
    marque VARCHAR(255) NOT NULL,
    annee INT NOT NULL,
    kilometrage INT NOT NULL,
    prix INT NOT NULL,
    carburant VARCHAR(255) NOT NULL
);


CREATE TABLE description_voiture (
    id INT PRIMARY KEY AUTO_INCREMENT,
    voiture_id INT NOT NULL,
    prix INT NOT NULL,
    annee INT NOT NULL,
    kilometrage INT NOT NULL,
    image VARCHAR(255) NOT NULL,
    FOREIGN KEY (voiture_id) REFERENCES voitures(id)
);

CREATE TABLE caracteristique (
    id INT PRIMARY KEY AUTO_INCREMENT,
    voiture_id INT NOT NULL,
    nom TEXT NOT NULL,
    description TEXT NOT NULL,
    FOREIGN KEY (voiture_id) REFERENCES voitures(id)
);


ALTER TABLE caracteristique
ADD CONSTRAINT unique_nom_valeur UNIQUE (nom, description);

