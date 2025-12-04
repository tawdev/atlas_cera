-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 nov. 2025 à 15:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `atlas_cera`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password_hash`, `created_at`) VALUES
(1, 'atlas_admin', 'atlas_admin2025', '2025-11-27 12:52:20');

-- --------------------------------------------------------

--
-- Structure de la table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `project_type` varchar(60) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact_requests`
--

INSERT INTO `contact_requests` (`id`, `name`, `email`, `phone`, `project_type`, `message`, `created_at`) VALUES
(1, 'hassan', 'hsn12@gmail.com', '238572529', 'construction', 'kjniefnkjfnwefjf', '2025-11-27 12:08:03'),
(2, 'dufa', 'jwjndajnda@gmail.com', '9873894837', 'construction', 'ueijkfeifnuejfkefeskfsf', '2025-11-27 12:12:06'),
(3, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 12:57:01'),
(4, 'dufa', 'jwjndajnda@gmail.com', '9873894837', 'construction', 'ueijkfeifnuejfkefeskfsf', '2025-11-27 13:02:40'),
(5, 'dufa', 'jwjndajnda@gmail.com', '9873894837', 'construction', 'ueijkfeifnuejfkefeskfsf', '2025-11-27 13:06:09'),
(6, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 13:11:57'),
(7, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 13:17:13'),
(8, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 13:20:34'),
(9, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 13:23:30'),
(10, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 13:23:40'),
(11, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 13:23:56'),
(12, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 13:26:34'),
(13, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 13:27:07'),
(14, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 13:30:17'),
(15, 'ahmed', 'hsn12@gmail.com', '238572529', 'decoration', 'oidjeideoijknsnjcsdne', '2025-11-27 13:31:16');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
