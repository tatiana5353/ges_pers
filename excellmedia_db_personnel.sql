-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 juin 2023 à 00:15
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `excellmedia_db_personnel`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

CREATE TABLE `affectation` (
  `id` int(11) NOT NULL,
  `numero` char(10) DEFAULT NULL,
  `key_affectation` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id` int(11) NOT NULL,
  `motif` text NOT NULL,
  `numero` char(10) NOT NULL,
  `motif_refus` text DEFAULT NULL,
  `key_demande` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `idtypeconge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnalite`
--

CREATE TABLE `fonctionnalite` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `key_fonctionnalite` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fonctionnalite`
--

INSERT INTO `fonctionnalite` (`id`, `libelle`, `code`, `key_fonctionnalite`, `statut`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'gestion de presence', 'presence', 'efegrghht', 1, 1, '2023-06-14 17:09:55', NULL, NULL),
(2, 'gestion des horaires', 'horaire', '12fhtyjjygn', 1, 1, '2023-06-14 17:09:55', NULL, NULL),
(3, 'gestion des types de conge', 'conge', 'pukypjypotjo', 1, 1, '2023-06-15 16:08:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `id` int(11) NOT NULL,
  `heure_arrivee` time NOT NULL,
  `heure_depart` time NOT NULL,
  `key_horaire` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id`, `heure_arrivee`, `heure_depart`, `key_horaire`, `statut`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(7, '07:00:00', '11:00:00', '-nAONyNBeMoTyZENnRpIpB1r5x7XORMo', 1, 2, '2023-06-27 18:06:53', NULL, NULL),
(8, '08:30:00', '18:00:00', '0zt0ITMy0gydZAMMYixIcSbkLTTtoZWO', 1, 2, '2023-06-27 18:12:02', NULL, NULL),
(9, '12:00:00', '13:00:00', 'AO2NitaCJ4zeqTBRQH1nCZiddUQihBhW', 1, 2, '2023-06-27 18:29:14', NULL, NULL),
(10, '14:00:00', '15:00:00', 'n-swHRTWoIGhOQ0duVkRkcjGh1ooXt5r', 1, 2, '2023-06-27 18:34:34', NULL, NULL),
(11, '14:51:00', '14:52:00', 'CrxkRomeS5rEGMa9umIDImFKJ_U_2asS', 1, 2, '2023-06-29 16:58:43', NULL, NULL),
(12, '14:00:00', '15:15:00', 'xRAN54Fy0uc_2F5LluE-QuL1M1PlohPN', 1, 2, '2023-06-29 17:03:35', NULL, NULL),
(13, '14:00:00', '22:02:00', 'I8-cK_5YR5WAQ6Pn5xTEuDkRaCvpPlhs', 1, 2, '2023-06-29 17:11:04', NULL, NULL),
(14, '00:01:00', '18:01:00', 'BeNd4p4raeczOLcII2HMNoI9RfQ_eMGr', 1, 2, '2023-06-29 19:02:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1686750552);

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

CREATE TABLE `presence` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `justification` text DEFAULT NULL,
  `heure_arrivee` datetime DEFAULT NULL,
  `heure_depart` datetime DEFAULT NULL,
  `key_presence` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `idhoraire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `key_profil` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `libelle`, `key_profil`, `statut`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'superadmin', 'dsfjghdfgcvc', 1, 1, '2023-06-14 17:02:50', NULL, NULL),
(2, 'employe', 'rgdhjezzzzzzzzgf', 1, 1, '2023-06-14 17:04:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `profil_fonctionnalite`
--

CREATE TABLE `profil_fonctionnalite` (
  `id` int(11) NOT NULL,
  `key_profilfonctionnalite` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `idprofil` int(11) NOT NULL,
  `idfonctionnalite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `profil_fonctionnalite`
--

INSERT INTO `profil_fonctionnalite` (`id`, `key_profilfonctionnalite`, `statut`, `created_by`, `updated_by`, `created_at`, `updated_at`, `idprofil`, `idfonctionnalite`) VALUES
(1, '12gdgfgfgf', 1, 1, NULL, '2023-06-14 17:22:16', NULL, 1, 2),
(2, '1234dgsgdhdh', 1, 1, NULL, '2023-06-14 17:28:15', NULL, 1, 1),
(3, 'hgjhghggjhjh', 1, 1, NULL, '2023-06-21 20:55:34', NULL, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `key_projet` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `heure_debut` datetime DEFAULT NULL,
  `heure_fin` datetime DEFAULT NULL,
  `key_tache` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `idaffectation` int(11) DEFAULT NULL,
  `idprojet` int(11) DEFAULT NULL,
  `idtypetache` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_conge`
--

CREATE TABLE `type_conge` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `key_typeconge` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_conge`
--

INSERT INTO `type_conge` (`id`, `libelle`, `key_typeconge`, `statut`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'maladiess', 'ludyfkyhf', 3, 1, '0000-00-00 00:00:00', 2, '2023-06-22 18:23:29'),
(2, 'maladies', 'fgdgjf', 3, 1, '0000-00-00 00:00:00', 2, '2023-06-22 18:26:32'),
(3, 'accident', 'htdghjkethd', 1, 1, '2023-06-21 10:19:40', NULL, NULL),
(4, 'conge', 'grzshdv', 3, 1, '2023-06-21 10:22:10', 2, '2023-06-23 18:58:05'),
(5, 'mange', 'hdghfytet', 3, 1, '2023-06-21 10:22:47', 2, '2023-06-23 18:24:55'),
(6, 'dada', 'xEYyQdj2fIypQJYscvKZfr2nb07s0zku', 3, 2, '2023-06-21 20:58:59', 2, '2023-06-23 18:24:49'),
(7, 'rr', 'oL8Dlze2Pv5UgVAuQXtxW9sCgtFIuMjx', 3, 2, '2023-06-22 16:10:50', 2, '2023-06-23 18:24:44'),
(8, 'sfg', 'JOvr_K2FrskIylXANmD3UpvGk-vcHrIY', 3, 2, '2023-06-22 16:32:49', 2, '2023-06-23 18:24:40'),
(9, 'ehsq', '-GElGd6_SIEGAW8U12CzwXE7TcKgy8zc', 3, 2, '2023-06-22 16:33:17', 2, '2023-06-23 18:24:37'),
(10, 'sqtyudfkg', '04PfGWbUMyjy-AOB_lIIqDxknKgK59uo', 3, 2, '2023-06-22 16:34:17', 2, '2023-06-23 18:24:33'),
(11, 'sqydhufjcgkf', 'dpIs8WC2SwlSggTdb5zd1L66rxaQeCqA', 3, 2, '2023-06-22 16:34:54', 2, '2023-06-23 18:24:28'),
(12, 'qsyghl', 'u8TfqrWgypjI13M107FxCTg2z5oDFF6A', 3, 2, '2023-06-22 16:36:39', 2, '2023-06-23 18:24:24'),
(13, 'dwbdv', '4U053snbXgpp06hPWpHIGAZMXfuUt1Ny', 3, 2, '2023-06-22 16:39:43', 2, '2023-06-23 18:24:18'),
(14, 'gshyt', 'xutDpAMRfPSQq5in2rGdWgoqHKaiyXZo', 3, 2, '2023-06-22 16:41:15', 2, '2023-06-23 18:24:14'),
(15, 'c', 'XQRpx3KIrvqhrzNaTSVrz1ZVniXqNjLF', 3, 2, '2023-06-23 18:23:58', 2, '2023-06-23 18:24:08'),
(16, 'maladie', 'shPGugV6kzA8SjuH5lTxsRDZJ85ERBGK', 1, 2, '2023-06-24 20:37:39', NULL, NULL),
(17, 'maladies', 'cBoghjcWDBEkMoizupMOIPVZX4Jj9umD', 1, 2, '2023-06-26 18:36:23', 2, '2023-06-27 15:09:02'),
(18, 'sida', 'AWLlrK8KcTqdJymLH6PpjFSV-1rtltFd', 1, 2, '2023-06-27 15:10:30', 2, '2023-06-29 12:34:53'),
(19, 'accident de travail', '94gfJlPUko1yE2CZXIjL69rmlmEp3iVV', 1, 2, '2023-06-29 12:37:54', NULL, NULL),
(20, 'maladi', 'egmrnfW1djMU7IolXV5BESHdvh0zdfEU', 1, 2, '2023-06-29 12:42:06', NULL, NULL),
(21, 'v', '83iAJQIlymzVzQ0gG6qc65MOHmt3Lvzv', 1, 2, '2023-06-29 13:00:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_tache`
--

CREATE TABLE `type_tache` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `key_typetache` char(32) NOT NULL,
  `statut` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenoms` varchar(50) NOT NULL,
  `sexe` char(1) NOT NULL,
  `date_naiss` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` smallint(6) NOT NULL,
  `auth_key` char(32) NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `idprofil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenoms`, `sexe`, `date_naiss`, `username`, `password_hash`, `password_reset_token`, `telephone`, `email`, `role`, `auth_key`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `idprofil`) VALUES
(1, 'eklou', 'josey', 'f', '2023-06-14 16:49:02', 'madame', '$2y$13$NbIzTCdb7tpTbD8Gc8Fp9Onb20Ix/XxqCMXV44EYOLFHCxRGwXz4O', NULL, '70338737', 'tatianapelei18@gmail.com', 10, '1234vvjhd', 10, 1, NULL, '2023-06-14 16:49:02', NULL, 1),
(2, 'PELEI', 'Tatiana', 'F', '2023-06-19 22:01:31', 'admin', '$2y$13$ex6QVnNv/7oTepla4/mCQe2V7r7h6YHvxnwDq8vwJ4gl1KLCi5ema', NULL, '70338737', 'tatianapelei18@gmail.com', 10, 'hjdhgfejgfjgvsv', 10, 1, NULL, '2023-06-19 22:01:31', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affectation_user_fk` (`iduser`),
  ADD KEY `affectation_userupdated_fk` (`updated_by`),
  ADD KEY `affectation_usercreated_fk` (`created_by`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demande_typeconge_fk` (`idtypeconge`),
  ADD KEY `demande_userupdated_fk` (`updated_by`),
  ADD KEY `demande_usercreated_fk` (`created_by`);

--
-- Index pour la table `fonctionnalite`
--
ALTER TABLE `fonctionnalite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fonctionnalite_userupdated_fk` (`updated_by`),
  ADD KEY `fonctionnalite_usercreated_fk` (`created_by`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horaire_userupdated_fk` (`updated_by`),
  ADD KEY `horaire_usercreated_fk` (`created_by`);

--
-- Index pour la table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presence_horaire_fk` (`idhoraire`),
  ADD KEY `presence_userupdated_fk` (`updated_by`),
  ADD KEY `presence_usercreated_fk` (`created_by`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profil_userupdated_fk` (`updated_by`),
  ADD KEY `profil_usercreated_fk` (`created_by`);

--
-- Index pour la table `profil_fonctionnalite`
--
ALTER TABLE `profil_fonctionnalite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profil_prof_fonc_fk` (`idprofil`),
  ADD KEY `fonctionnalite_prof_fonc_fk` (`idfonctionnalite`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_userupdated_fk` (`updated_by`),
  ADD KEY `projet_usercreated_fk` (`created_by`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tache_projet_fk` (`idprojet`),
  ADD KEY `tache_typetache_fk` (`idtypetache`),
  ADD KEY `tache_affectation_fk` (`idaffectation`),
  ADD KEY `tache_userupdated_fk` (`updated_by`),
  ADD KEY `tache_usercreated_fk` (`created_by`);

--
-- Index pour la table `type_conge`
--
ALTER TABLE `type_conge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeconge_userupdated_fk` (`updated_by`),
  ADD KEY `type_conge_usercreated_fk` (`created_by`);

--
-- Index pour la table `type_tache`
--
ALTER TABLE `type_tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typetache_userupdated_fk` (`updated_by`),
  ADD KEY `typetache_usercreated_fk` (`created_by`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_userupdated_fk` (`updated_by`),
  ADD KEY `user_usercreated_fk` (`created_by`),
  ADD KEY `user_profil_fk` (`idprofil`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `affectation`
--
ALTER TABLE `affectation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fonctionnalite`
--
ALTER TABLE `fonctionnalite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `presence`
--
ALTER TABLE `presence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `profil_fonctionnalite`
--
ALTER TABLE `profil_fonctionnalite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_conge`
--
ALTER TABLE `type_conge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `type_tache`
--
ALTER TABLE `type_tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `affectation_user_fk` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `affectation_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `affectation_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_typeconge_fk` FOREIGN KEY (`idtypeconge`) REFERENCES `type_conge` (`id`),
  ADD CONSTRAINT `demande_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `demande_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `fonctionnalite`
--
ALTER TABLE `fonctionnalite`
  ADD CONSTRAINT `fonctionnalite_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fonctionnalite_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD CONSTRAINT `horaire_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `horaire_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `presence_horaire_fk` FOREIGN KEY (`idhoraire`) REFERENCES `horaire` (`id`),
  ADD CONSTRAINT `presence_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `presence_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `profil_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `profil_fonctionnalite`
--
ALTER TABLE `profil_fonctionnalite`
  ADD CONSTRAINT `fonctionnalite_prof_fonc_fk` FOREIGN KEY (`idfonctionnalite`) REFERENCES `fonctionnalite` (`id`),
  ADD CONSTRAINT `profil_prof_fonc_fk` FOREIGN KEY (`idprofil`) REFERENCES `profil` (`id`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `projet_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `projet_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `tache_affectation_fk` FOREIGN KEY (`idaffectation`) REFERENCES `affectation` (`id`),
  ADD CONSTRAINT `tache_projet_fk` FOREIGN KEY (`idprojet`) REFERENCES `projet` (`id`),
  ADD CONSTRAINT `tache_typetache_fk` FOREIGN KEY (`idtypetache`) REFERENCES `type_tache` (`id`),
  ADD CONSTRAINT `tache_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `tache_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `type_conge`
--
ALTER TABLE `type_conge`
  ADD CONSTRAINT `type_conge_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `typeconge_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `type_tache`
--
ALTER TABLE `type_tache`
  ADD CONSTRAINT `typetache_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `typetache_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_profil_fk` FOREIGN KEY (`idprofil`) REFERENCES `profil` (`id`),
  ADD CONSTRAINT `user_usercreated_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_userupdated_fk` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
