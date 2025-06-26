-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:4022
-- Generation Time: Jun 26, 2025 at 11:48 AM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reco`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_commentaire` datetime DEFAULT CURRENT_TIMESTAMP,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `nom`, `message`, `date_commentaire`, `url`) VALUES
(3, 'wrgoijworig', 'bosenbwriwrbwrb', '2025-05-29 15:14:38', NULL),
(4, 'pierre 2', 'message message', '2025-05-29 15:33:12', NULL),
(5, 'test', 'ceci est un test', '2025-05-29 15:34:53', NULL),
(6, 'test 2', 're test', '2025-05-29 15:42:53', NULL),
(7, 'pierre', 'message', '2025-06-02 11:37:41', NULL),
(10, 'test_url', 'un test pour l\'url', '2025-06-06 17:19:54', NULL),
(11, 'pierre', 'test message lien', '2025-06-06 17:34:56', NULL),
(12, 'message', 'Message pour tester redirection', '2025-06-06 17:54:15', NULL),
(13, 'retest', 'retest redirection', '2025-06-06 17:57:22', NULL),
(14, 'nomUtilisateur', 'message de test', '2025-06-13 14:41:11', NULL),
(15, 'messageUtilisateur', 'ceci est un message', '2025-06-13 14:41:43', 'https://www.imdb.com/title/tt0068646/'),
(16, 'test url', 'verification de url', '2025-06-14 12:24:07', NULL),
(17, 'verification insertion', 'ceci est une verification', '2025-06-14 12:33:40', 'google.com'),
(18, 'test', 'test', '2025-06-14 12:48:34', 'google.com'),
(19, 'test', 'test', '2025-06-16 11:03:41', 'google.com'),
(20, 'film 2', 'ce commentaire parait sur film 2', '2025-06-24 08:55:12', 'https://www.imdb.com/title/tt0068646/'),
(21, 'elie', 'cc', '2025-06-26 11:40:27', 'google.com'),
(22, 'pierre', 'j\'ai adoré ce film!', '2025-06-26 13:17:32', 'https://www.imdb.com/title/tt0111161/'),
(23, 'pierre', 'un film que j\'ai trouvé moyen', '2025-06-26 13:19:28', 'https://www.imdb.com/title/tt0109830/'),
(24, 'pierre thos', 'j\'ai trouvé ce film très bien', '2025-06-26 13:40:27', 'https://www.imdb.com/title/tt0111161/'),
(25, 'pierre raphael', 'j\'ai trouvé ce film moyen', '2025-06-26 13:41:27', 'https://www.imdb.com/title/tt0111161/');

-- --------------------------------------------------------

--
-- Table structure for table `reco_item`
--

CREATE TABLE `reco_item` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `description` text,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reco_item`
--

INSERT INTO `reco_item` (`id`, `label`, `description`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Un film', 'description de ce film 123', 'google.com', '2025-04-14 12:39:21', '2025-06-26 09:38:28'),
(2, 'Un autre', 'Ceci est un film', 'https://www.imdb.com/title/tt0068646/', '2025-06-06 15:21:16', '2025-06-06 15:21:16'),
(6, 'The Shawshank Redemption', 'Deux hommes emprisonnés nouent une amitié au fil des années, trouvant réconfort et rédemption grâce à des actes de bonté.', 'https://www.imdb.com/title/tt0111161/', '2025-06-26 11:14:31', '2025-06-26 11:14:31'),
(7, 'Forrest Gump', 'Un homme simple au grand cœur traverse les décennies en influençant malgré lui des événements majeurs de l\'histoire américaine.', 'https://www.imdb.com/title/tt0109830/', '2025-06-26 11:14:31', '2025-06-26 11:14:31'),
(8, 'Inception', 'Un voleur spécialisé dans l\'extraction de secrets d\'entreprise via les rêves se voit confier la mission inverse : implanter une idée.', 'https://www.imdb.com/title/tt1375666/', '2025-06-26 11:14:31', '2025-06-26 11:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(3, 'test12345', '$2y$10$wBfwcQ9V4VXVb5ji6.8CCOLQKZeUXDhbKSkDkP01DzsH77lWLKtJG', 'test3@gmail.com', '2025-05-05 12:31:40', '2025-05-18 10:40:51'),
(6, 'admin', '$2y$10$8n/7sOHJip21V9fmIRs9JuaNjLWHhuiz.Dl0/p1co6SMncetiNWrG', 'admin@gmail.com', '2025-05-11 12:07:59', '2025-05-11 12:07:59'),
(9, 'pierre_t', '$2y$10$wCvhtdHsn9ww5JgzMZnscOi0AXhqhbZdDmU4f5RO/n0LsM9mf5dJG', 'pierrethos06@gmail.com', '2025-06-26 09:55:59', '2025-06-26 09:55:59'),
(12, 'elie', '$2y$10$tEA8YaDyvYnXkRm/3qJtH.h2Kt.DuBe4obxMPQorkqHSzI6xK6ldy', 'eliechrisbley@gmail.com', '2025-06-26 10:53:24', '2025-06-26 10:53:24'),
(13, 'pierre', '$2y$10$cNo3olp5Wi7C4zmN3floMebEAy7BvQv8ZHB10hlV3EONvSZmd7w/K', 'pierre@gmail.com', '2025-06-26 11:36:41', '2025-06-26 11:36:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commentaires_url` (`url`);

--
-- Indexes for table `reco_item`
--
ALTER TABLE `reco_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reco_item`
--
ALTER TABLE `reco_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `fk_commentaires_url` FOREIGN KEY (`url`) REFERENCES `reco_item` (`url`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
