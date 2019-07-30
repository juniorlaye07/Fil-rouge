-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 30 juil. 2019 à 09:16
-- Version du serveur :  5.7.27-0ubuntu0.18.04.1
-- Version de PHP :  7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `baseapi`
--

-- --------------------------------------------------------

--
-- Structure de la table `comptbank`
--

CREATE TABLE `comptbank` (
  `id` int(11) NOT NULL,
  `numcompte` int(11) NOT NULL,
  `solde` int(11) DEFAULT NULL,
  `id_partenaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comptbank`
--

INSERT INTO `comptbank` (`id`, `numcompte`, `solde`, `id_partenaire_id`) VALUES
(1, 184814, 210000, 9),
(2, 7458622, 460600, 10),
(3, 8587451, 370050, 8);

-- --------------------------------------------------------

--
-- Structure de la table `depot_argent`
--

CREATE TABLE `depot_argent` (
  `id` int(11) NOT NULL,
  `comptbank_id` int(11) NOT NULL,
  `montant` double NOT NULL,
  `date_depot` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `depot_argent`
--

INSERT INTO `depot_argent` (`id`, `comptbank_id`, `montant`, `date_depot`) VALUES
(1, 1, 50000, '2019-07-29 12:27:58'),
(2, 1, 10000, '2019-07-29 15:22:24'),
(3, 2, 10000, '2019-07-29 15:24:07'),
(4, 3, 10000, '2019-07-29 15:24:17'),
(5, 3, 10000, '2019-07-29 15:24:57'),
(6, 3, 50, '2019-07-29 15:27:30'),
(7, 2, 600, '2019-07-29 16:17:34');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190725214936', '2019-07-25 21:50:23'),
('20190726173439', '2019-07-26 17:35:03'),
('20190727191637', '2019-07-27 19:16:55'),
('20190729105042', '2019-07-29 10:51:08'),
('20190729110824', '2019-07-29 11:09:17'),
('20190729111214', '2019-07-29 11:12:20'),
('20190729112233', '2019-07-29 11:22:43');

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE `partenaire` (
  `id` int(11) NOT NULL,
  `ninea` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raisonsocial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `partenaire`
--

INSERT INTO `partenaire` (`id`, `ninea`, `raisonsocial`, `tel`, `adresse`, `adresse_mail`, `status`) VALUES
(1, '2548ML', 'ELTON', 339764188, 'Dakar', 'janismoney@gmail.com', 'Bloquer'),
(2, '2548ML', 'C3S', 339764188, 'Dakar', 'janismoney@gmail.com', 'Bloquer'),
(8, 'AHDL491', 'Toluim SA', 332236604, 'Mermouz', 'safiamoney@yahoo.fr', 'Actif'),
(9, 'AQM295', 'Senegal-Tourisme', 332237704, 'Sacre-coeur3', 'setamoney@yahoo.fr', 'Actif'),
(10, 'APOM295', 'Kanuni-Tech', 332237564, 'St-louis', 'kachmoney@yahoo.fr', 'Bloquer');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `frais` int(11) NOT NULL,
  `gain` int(11) NOT NULL,
  `taxetat` int(11) NOT NULL,
  `nomcomplet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `cin` int(11) NOT NULL,
  `date_envoie` datetime NOT NULL,
  `date_retrait` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_partenaire_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `roles`, `password`, `nom`, `prenom`, `tel`, `status`, `profil`, `id_partenaire_id`) VALUES
(9, 'layejunior07', '[\"ROLE_SUPER_ADMIN\"]', '$argon2id$v=19$m=65536,t=6,p=1$hpckpVcTjhY+I6wMDh1o7Q$rfR8joxnN/WIzyxViNEkM2qfMBJojnp7NP7KqhBHvUc', 'Ngom', 'Abdoulaye', 776418887, 'Actif', 'SUPERADMIN', NULL),
(16, 'jordan', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=6,p=1$1LiMgvYCEatwHWWrbjMVRA$PJu9+bShu3/5GC4v0MYPSpyHju58zxt4H3PbErxiUxE', 'Ndour', 'safia', 772236604, 'Actif', 'ADMIN', 2),
(17, 'jolie', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=6,p=1$b4W1nFvwcajgmxR3ZmCyYw$AyofGoRjDKYVrnmV3qwaeMSKYI5HDgYK/WUyjxLQD1k', 'Ngom', 'Mariama', 775631214, 'Actif', 'ADMIN', 9),
(19, 'betty', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$Zr0kXoyiYexLsUD2a8gz7g$zJnFKRblS6XP5dawzU/7E8Odsg+knpR2IBgKWH9YBrA', 'Ndir', 'Betty', 775551214, 'Actif', 'USER', 9),
(20, 'momo', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$K0aKJoEWgSWcQAQ+lVZxsA$XqZaSFOnfHioKRyAPDzQYw4DQ1rtZHoScMP748xvs74', 'Ngom', 'Momo', 784562163, 'Actif', 'USER', 2),
(21, 'mamzy', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$aprp2b3opplWtn7zF35kcw$cTfB0saZdbCa9I83kI12sHqg4E+eLhzUGgXRfG2x+68', 'Faye', 'Mamzy', 774562123, 'Actif', 'USER', 2),
(25, 'laye', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$nklte0O21VYOHZ8fcRc6zg$Ln+XZUkBfOSzkCA1k2si+eVwuF7Bb7Gypb5t93HAcVY', 'Junior', 'Laye', 774562145, 'Actif', 'USER', 10),
(26, 'kharagne', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$Y7gTs2Z30/J3+j+Ii6N/mg$Udap1l/1rbS3diskoVcLBPw37EtNPLVovsmCjpFRwcA', 'Lo', 'Modou', 772584596, 'Actif', 'USER', 9),
(28, 'sire', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$PN18aaCrEahG/c5IqkCVoQ$iqtDJX+e5QzxwUAzoy7wiE62UIkweSSGRBU8sVQXFas', 'fall', 'Modou', 772584596, 'Actif', 'USER', 10),
(29, 'saly', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$G03x72mk3k0lDwNmcZmzbA$XZHINCBhSZdmQ/IIUC4uN9cDGuiQUKjL1yoIcJ0sgtw', 'Ndour', 'Salimata', 782546210, 'Actif', 'USER', 8),
(30, 'maka', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$uHF/3yAidrS2KH+JOfrVag$5IULz1AzdPhyZa+8q0pKpx+IqPDJGRXyKbhng4pWOJI', 'Fall', 'Sokhna', 778945623, 'Bloquer', 'USER', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comptbank`
--
ALTER TABLE `comptbank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9E191D5526F6C2C9` (`id_partenaire_id`);

--
-- Index pour la table `depot_argent`
--
ALTER TABLE `depot_argent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FD573C969731ED29` (`comptbank_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1D1C63B3F85E0677` (`username`),
  ADD KEY `IDX_1D1C63B326F6C2C9` (`id_partenaire_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comptbank`
--
ALTER TABLE `comptbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `depot_argent`
--
ALTER TABLE `depot_argent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comptbank`
--
ALTER TABLE `comptbank`
  ADD CONSTRAINT `FK_9E191D5526F6C2C9` FOREIGN KEY (`id_partenaire_id`) REFERENCES `partenaire` (`id`);

--
-- Contraintes pour la table `depot_argent`
--
ALTER TABLE `depot_argent`
  ADD CONSTRAINT `FK_FD573C969731ED29` FOREIGN KEY (`comptbank_id`) REFERENCES `comptbank` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_1D1C63B326F6C2C9` FOREIGN KEY (`id_partenaire_id`) REFERENCES `partenaire` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
