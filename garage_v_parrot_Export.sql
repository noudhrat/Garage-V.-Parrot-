-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 28 sep. 2023 à 14:43
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `garage_v_parrot`
--

-- --------------------------------------------------------

--
-- Structure de la table `caracteristique`
--

CREATE TABLE `caracteristique` (
  `id` int(11) NOT NULL,
  `voiture_id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `caracteristique`
--

INSERT INTO `caracteristique` (`id`, `voiture_id`, `nom`, `description`) VALUES
(1, 6, 'Carrosserie: <br />\r\nFinition: <br />\r\nÉmission de CO2:<br />\r\nGarantie:', 'Berline<br />\r\n Pack<br />\r\n 98<br />\r\n 12 Mois '),
(2, 16, ' Motricité: <br />\r\nÉchapement: <br />\r\nNombre de cylindre: <br />\r\nType de cylindrée: <br />\r\nPuissance en cm3:<br />\r\nSegmentation du véhicule: ', '4 roues permanent<br />\r\n G-Kat<br />\r\n4<br />\r\nLigne<br />\r\n 2488<br />\r\n SUV de luxe '),
(9, 8, 'Carrosserie:<br />\r\nFinition:<br />\r\nÉmission de CO2:<br />\r\nGarantie:', 'Berline<br />\r\nPack<br />\r\n98<br />\r\n12 Mois'),
(10, 18, 'Carrosserie:<br />\r\nFinition:<br />\r\nÉmission de CO2:<br />\r\nGarantie:', 'Berline<br />\r\nPack<br />\r\n98<br />\r\n12 Mois ');

-- --------------------------------------------------------

--
-- Structure de la table `description_voiture`
--

CREATE TABLE `description_voiture` (
  `id` int(11) NOT NULL,
  `voiture_id` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `kilometrage` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `description_voiture`
--

INSERT INTO `description_voiture` (`id`, `voiture_id`, `prix`, `annee`, `kilometrage`, `image`) VALUES
(1, 16, 4790, 2001, 177220, 'upload/voitures/audi.jpg'),
(2, 18, 4790, 2001, 177220, 'upload/voitures/hyundai.jpg'),
(3, 6, 9190, 2010, 267220, 'upload/voitures/renault.jpg'),
(4, 8, 9190, 2010, 267220, 'upload/voitures/peugeot.jpg'),
(5, 9, 9190, 2010, 267220, 'upload/voitures/nissan-2317539_1920.jpg'),
(6, 19, 9190, 2010, 267220, 'upload/voitures/mercedes.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE `horaires` (
  `id` int(11) NOT NULL,
  `horaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `horaires`
--

INSERT INTO `horaires` (`id`, `horaire`) VALUES
(4, 'Ouvert'),
(5, 'fermé'),
(6, 'fermé'),
(7, 'Fermé'),
(8, 'Fermé'),
(9, 'lll');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image`) VALUES
(12, 'Vente', 'Mise en vente de véhicules d\'occasions', 'upload/services/vente.jpg'),
(14, 'Entretien ', 'Entretien régulier pour garantir leur performance et<br />\r\nleur sécurité.', 'upload/services/64f5c38f66c49_entretien.jpg'),
(15, 'Réparation', 'Réparation de la carrosserie et de la mécanique des voitures.', 'upload/services/64f5c78600cfe_réparation.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `temoignage`
--

CREATE TABLE `temoignage` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `temoignage`
--

INSERT INTO `temoignage` (`id`, `nom`, `message`, `note`) VALUES
(18, 'Alexandre', 'Je trouve que le service est impeccable, je suis ravi de  ma nouvelle trouvaille.', '5/5'),
(20, 'louis', 'super service.', '4/5'),
(29, 'Marie', 'lorem', '4/5');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `mdp`, `role`) VALUES
(1, 'parrot', 'victor', 'victorparrot25@gmail.com', '$2y$10$FTmVOpjaOzWj/b28vQRu7OWEncLOZDNjbARY0RxnH3o6kXEQuF9K6', 'admin'),
(5, 'martinez', 'alicia', 'aliciamartinez@gmail.com', '$2y$10$mvZh9ysBpQD10uZtysg4TuhANBbuWUcU47U1d0Z7haLxwiXcNNBPO', 'employee'),
(6, 'guerin', 'loic', 'loicguerin@gmail.com', '$2y$10$wZ1BT9TaC.JcDjqYWIdJouRTwXRA5UWKuFRd4vJ/xcqeDb6pmdP9i', 'employee'),
(8, 'mars', 'loris', 'lorismars@gmail.com', '$2y$10$AgfSTq5v2ORMdmCEg4jhquFr.78CYNqNbQk4VQMmUYs8qPdHIWgOi', 'employee');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE `voitures` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `annee` int(11) NOT NULL,
  `kilometrage` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `carburant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`id`, `image`, `marque`, `annee`, `kilometrage`, `prix`, `carburant`) VALUES
(6, 'upload/voitures/renault.jpg', 'renault', 2010, 267220, 9190, 'diesel'),
(8, 'upload/voitures/peugeot.jpg', 'peugeot', 2010, 267220, 9190, 'essence'),
(9, 'upload/voitures/nissan-2317539_1920.jpg', 'nissan', 2010, 267220, 9190, 'essence'),
(16, 'upload/voitures/audi.jpg', 'audi', 2001, 177220, 4790, 'essence'),
(18, 'upload/voitures/hyundai.jpg', 'Hyundai', 2001, 177220, 4790, 'essence'),
(19, 'upload/voitures/mercedes.jpg', 'mercedes', 2010, 267220, 9190, 'diesel');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `caracteristique`
--
ALTER TABLE `caracteristique`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nom_valeur` (`nom`,`description`) USING HASH,
  ADD KEY `voiture_id` (`voiture_id`);

--
-- Index pour la table `description_voiture`
--
ALTER TABLE `description_voiture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voiture_id` (`voiture_id`);

--
-- Index pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `temoignage`
--
ALTER TABLE `temoignage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `caracteristique`
--
ALTER TABLE `caracteristique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `description_voiture`
--
ALTER TABLE `description_voiture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `temoignage`
--
ALTER TABLE `temoignage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `caracteristique`
--
ALTER TABLE `caracteristique`
  ADD CONSTRAINT `caracteristique_ibfk_1` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`);

--
-- Contraintes pour la table `description_voiture`
--
ALTER TABLE `description_voiture`
  ADD CONSTRAINT `description_voiture_ibfk_1` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
