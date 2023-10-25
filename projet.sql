-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 25 oct. 2023 à 16:53
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `car_photo`
--

CREATE TABLE `car_photo` (
  `id_photo` int(11) NOT NULL,
  `id_voiture` int(11) DEFAULT NULL,
  `PhotoPath` varchar(255) DEFAULT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `car_photo`
--

INSERT INTO `car_photo` (`id_photo`, `id_voiture`, `PhotoPath`, `uploaded_on`) VALUES
(0, 24, '6538f65961c9bdefaultCar.png', '2023-10-25 11:04:57'),
(0, 27, '65390c84ac862defaultCar.png', '2023-10-25 12:39:32'),
(0, 28, '653925ded3bdd65325173db6e4-img3.png', '2023-10-25 14:27:42'),
(0, 29, '6539262c457046538f65961c9bdefaultCar.png', '2023-10-25 14:29:00'),
(0, 29, '6539262c4afc365390c84ac862defaultCar.png', '2023-10-25 14:29:00');

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `id_Contrat` int(11) NOT NULL,
  `id_voiture` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `rent_start` timestamp NOT NULL DEFAULT current_timestamp(),
  `rent_end` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `photo_profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `nom`, `prenom`, `role`, `created_at`, `photo_profil`) VALUES
(23, 'ttaq@tt.c', '$2y$10$g1tUn8t9gGMEbiJHvaNdvOOBttSvEsiy7GE2ptg9m8PbCm.kkCl.6', 'rr', 'rr', 'user', '2023-10-18 11:15:08', ''),
(24, 'tt@tt.c', '$2y$10$ytcdYEQc96zLgfsTc4/XDuEfRc1L0rvHaAxUzUyqjDg3DkIQ4rHbS', 'tt', 'tt', 'admin', '2023-10-18 11:22:18', ''),
(34, 'qq@qq.c', '$2y$10$ORQgrpKFSMtIiQg3GZQKbO3Xqr5dBv6BfkBM5vuwjYqSbvDSjqLju', 'qq', 'qq', 'user', '2023-10-24 13:04:27', '6537c0db30680-default.png'),
(36, 'ff@ff.c', '$2y$10$n.N1l/q5/NUHiqDF5qijYOi1Jng8IYMp4oEbI0xCOB0vwUjxUQu7.', 'xx', 'xx', 'admin', '2023-10-24 13:08:20', '6537c1c426749-6537c125185ef-653256e3e8483-65313b34e4668-65313a714eb76-m.png'),
(38, 'll@ll.c', '$2y$10$nuu7FqXkCi.jBTv/2THfrObbI/8gNVC5nWy/f1SLL.HQaUQMDP6V6', 'll', 'll', 'user', '2023-10-24 13:13:41', '6537c3051dc56-653247e0c54d1-653133e446cda-femme.png'),
(39, 'ii@ii.c', '$2y$10$ZUXX9E59Ne0q0OT5YtNJROpYx8FK07z1dQsyaS/yeFwsGL7G5kasu', 'ii', 'ii', 'admin', '2023-10-24 16:52:35', '6537f65347d5f-6537c204b4f3a-65313d9aa4359-f.png'),
(40, 'kk@kk.c', '$2y$10$YLhEZYhTiQBNa1XVs3v5m.Yl1vVcnNq8Wta3hY18jq16uQziIkgz2', 'kk', 'kk', 'admin', '2023-10-25 07:17:22', '6538c1022b4e5-images.jpg'),
(41, 'nn@nn.c', '$2y$10$tM84y2llkPllK696tuq/QOD/.B4yKR7UHHQnhD5P78.eTU5Q.46FK', 'nn', 'nn', 'user', '2023-10-25 07:18:06', '6538c12ec45ae-avatar_people_person_profile_user_wander_woman_icon_123348.png'),
(42, 'yy@yy.c', '$2y$10$HAqQBbok6TBKH771dOSqk.rE.RYuCKD3oiP4OfESpghhsnMKpeoAi', 'yy', 'yy', 'user', '2023-10-25 07:18:34', '6538c14a4325c-avatar_people_person_profile_user_woman_icon_123356.png'),
(43, 'ww@ww.c', '$2y$10$mVzgERCeDBuUJvoP3Acj3OtJ6PEIlGyhIQ/6GIfD8bhujM2c7VaOe', 'ww', 'ww', 'user', '2023-10-25 07:19:11', '6538c16f070f7-images (1).jpg'),
(44, 'ss@ss.c', '$2y$10$oPD5Vv0GdgoGS7VtpLFld.4NHQy/3xoUPYNpdQ4kLLE70huYU9Mxq', 'ss', 'ss', 'admin', '2023-10-25 07:57:01', '6538ca4d0dfe6-773355.png'),
(45, 'admin@admin.c', '$2y$10$9VrEjWfayT1PMIsjYcnutujLAb8WWWijaIQsYxOpLAyxadyqk/D7K', 'admin', 'admin', 'admin', '2023-10-25 14:19:04', '653923d847867-avatar_people_person_profile_user_woman_icon_123358.png'),
(46, 'user@user.c', '$2y$10$M4Zq8bsgIHyUUyTlej5DWeMN6svjkFGn3N9guvfCZsqSAhxyAVTL.', 'user', 'user', 'user', '2023-10-25 14:19:46', '6539240208d59-6537c125185ef-653256e3e8483-65313b34e4668-65313a714eb76-m.png');

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

CREATE TABLE `voiture` (
  `id_voiture` int(11) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `date_arrivage` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prix_location` varchar(11) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`id_voiture`, `marque`, `modele`, `couleur`, `date_arrivage`, `prix_location`, `action`) VALUES
(15, 'bmw', '6', 'bleu', '2023-10-24 15:00:47', '0', ''),
(16, 'golf', '8', 'bleu', '2023-10-24 15:01:44', '0', ''),
(17, 'golf', '8', 'bleu', '2023-10-24 15:04:13', '0', ''),
(18, 'bmw', '6', 'bleu', '2023-10-24 15:05:49', '0', ''),
(19, 'bmw', '7', 'rouge', '2023-10-24 15:06:34', '0', ''),
(20, 'bmw', '6', 'rouge', '2023-10-24 15:08:00', '0', ''),
(21, 'golf', '7', 'rouge', '2023-10-24 15:09:23', '0', ''),
(22, 'golf', '6', 'rouge', '2023-10-24 15:10:07', '0', ''),
(24, 'golf', '6', 'bleu', '2023-10-25 11:04:57', '0', ''),
(25, 'golf', '7', 'rouge', '2023-10-25 11:07:50', '300', 'rent'),
(26, 'Toyota', 'Camry', 'Blue', '2023-10-25 12:36:35', '50.00', 'Sale'),
(27, 'golf', '6', 'bleu', '2023-10-25 12:39:32', '300', 'rent'),
(28, 'golf', '7', 'bleu', '2023-10-25 14:27:42', '300', 'rent'),
(29, 'polo', '7', 'rouge', '2023-10-25 14:29:00', '150', 'rent');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `car_photo`
--
ALTER TABLE `car_photo`
  ADD KEY `fk_car_photo_voiture` (`id_voiture`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id_Contrat`),
  ADD KEY `id_voiture` (`id_voiture`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`id_voiture`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `id_Contrat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `voiture`
--
ALTER TABLE `voiture`
  MODIFY `id_voiture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `car_photo`
--
ALTER TABLE `car_photo`
  ADD CONSTRAINT `fk_car_photo_voiture` FOREIGN KEY (`id_voiture`) REFERENCES `voiture` (`id_voiture`) ON DELETE CASCADE;

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`id_voiture`) REFERENCES `voiture` (`id_voiture`),
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
