-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 02 mai 2023 à 13:20
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sharetogeda`
--

-- --------------------------------------------------------

--
-- Structure de la table `donationproof`
--

CREATE TABLE `donationproof` (
  `senderName` varchar(255) NOT NULL,
  `photoproof` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `donationId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `donationproof`
--

INSERT INTO `donationproof` (`senderName`, `photoproof`, `item`, `donationId`) VALUES
('Ange Sepdeu', 'Ange Sepdeu profile.jpg', '', 31310257),
('Ange Sepdeu', 'OAXn3x2i2A bread.jpg', '', 2068229746);

-- --------------------------------------------------------

--
-- Structure de la table `donations`
--

CREATE TABLE `donations` (
  `donation_id` varchar(255) NOT NULL,
  `donorName` varchar(255) NOT NULL,
  `donorEmail` varchar(255) NOT NULL,
  `foodDesc` text NOT NULL,
  `foodQuantity` varchar(255) NOT NULL,
  `expiryDate` datetime(6) NOT NULL,
  `donation_date` datetime(6) NOT NULL,
  `receivername` varchar(255) NOT NULL DEFAULT 'None',
  `status` varchar(255) NOT NULL DEFAULT 'New',
  `site` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `donations`
--

INSERT INTO `donations` (`donation_id`, `donorName`, `donorEmail`, `foodDesc`, `foodQuantity`, `expiryDate`, `donation_date`, `receivername`, `status`, `site`) VALUES
('2068229746', 'Ange Sepdeu', 'chriskameni25@gmail.com', 'Bread', '25', '2023-05-10 16:50:00.000000', '2023-05-02 11:50:54.000000', 'None', 'Completed', ' Saint Paul, La Réunion'),
('31310257', 'Ange Sepdeu', 'chriskameni25@gmail.com', 'Pizza, Tangerine, Rice', '150', '2023-05-06 17:19:00.000000', '2023-04-30 05:19:57.000000', 'None', 'Completed', 'Flic en Flac'),
('966133273', 'Ange Sepdeu', 'chriskameni25@gmail.com', 'Pizza', '125', '2023-05-07 16:57:00.000000', '2030-04-23 04:57:00.000000', 'Ida Stephanie', 'New', 'Tamarin');

-- --------------------------------------------------------

--
-- Structure de la table `donation_sites`
--

CREATE TABLE `donation_sites` (
  `name` varchar(128) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `donation_sites`
--

INSERT INTO `donation_sites` (`name`, `longitude`, `latitude`) VALUES
(' Chamarel, Maurice', 57.4285, -20.4147),
(' Saint Paul, La Réunion', 55.2736, -20.9697);

-- --------------------------------------------------------

--
-- Structure de la table `reservationproof`
--

CREATE TABLE `reservationproof` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `reservationId` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservationproof`
--

INSERT INTO `reservationproof` (`id`, `photo`, `reservationId`, `date`, `userId`) VALUES
(1, 'iwsdiDfMdn auth.png', 6, '2023-05-02 08:42:37', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `donationId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `donationId`, `status`, `userId`) VALUES
(6, 31310257, 'pending', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'receiver',
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `joinedDate` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `fullname`, `tel`, `address`, `email`, `password`, `type`, `longitude`, `latitude`, `joinedDate`) VALUES
(1, 'chris Kameni', '55197145', 'Awae Escalier', 'chris25@gmail.com', '$2y$10$XhkovQ98KrlaiUfYTz.qse6al4ppBnd7MvLAF4pbVPQRA0rQ4GpMK', 'admin', 11.5578, 3.81362, '2023-04-30 02:44:49.000000'),
(2, 'Caleb', '55197145', 'Grand Bae', 'ndabosed@gmail.com', '$2y$10$XhkovQ98KrlaiUfYTz.qse6al4ppBnd7MvLAF4pbVPQRA0rQ4GpMK', 'receiver', 11.5578, 3.81362, '2023-04-30 03:10:26.000000'),
(3, 'Ange Sepdeu', '55024486', 'Awae', 'chriskameni25@gmail.com', '$2y$10$XhkovQ98KrlaiUfYTz.qse6al4ppBnd7MvLAF4pbVPQRA0rQ4GpMK', 'donor', 11.5578, 3.81362, '2023-04-30 03:10:26.000000'),
(4, 'Junior', '55197144', 'Ebene', 'ndabosed1@gmail.com', '$2y$10$XhkovQ98KrlaiUfYTz.qse6al4ppBnd7MvLAF4pbVPQRA0rQ4GpMK', 'donor', 11.5578, 3.81362, '2023-05-01 11:14:22.000000'),
(5, 'Michael', '55197144', 'Ebene', 'ndabosed2@gmail.com', '$2y$10$6KBoP6Mi8rnAudOoKyqlJuZQlRQDG2yRjxJc4gBu7i13e0.hrTmRO', 'donor', 57.361, -20.3533, '2023-05-01 11:17:26.000000');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`);

--
-- Index pour la table `reservationproof`
--
ALTER TABLE `reservationproof`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reservationproof`
--
ALTER TABLE `reservationproof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
