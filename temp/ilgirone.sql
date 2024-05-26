-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 27, 2024 alle 01:04
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ilgirone`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT 6,
  `name` varchar(100) NOT NULL DEFAULT 'article name not set',
  `description` varchar(32) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `articles`
--

INSERT INTO `articles` (`article_id`, `user_id`, `type_id`, `name`, `description`, `created_at`) VALUES
(1, 8, 6, 'succi', 'succi gay schiavo degli ebrei', '2024-05-11 16:39:29'),
(2, 5, 6, 'elitropia', 'vendo elitropia trovata nel mugn', '2024-05-11 16:41:28'),
(3, 5, 2, 'fenta', 'micro dose', '2024-05-11 19:18:04'),
(44, 10, 3, 'm ', '', '2024-05-24 22:33:42'),
(45, 10, 3, 'ihnujhb', 'ijnj', '2024-05-24 22:45:41'),
(46, 10, 3, '  jsnjdsx', '', '2024-05-24 22:46:26'),
(47, 10, 3, 'ubjh', '', '2024-05-24 22:47:30'),
(48, 10, 3, 'bh', 'hbv', '2024-05-24 22:49:19'),
(49, 8, 1, 'wsl', 'wsl adoen', '2024-05-24 22:51:29'),
(50, 8, 1, 'wsl', 'wsl adoen', '2024-05-24 22:53:21'),
(51, 8, 1, 'wsl', 'wsl adoen', '2024-05-24 22:54:45'),
(52, 8, 1, 'wsl', 'wsl adoen', '2024-05-24 22:55:11'),
(53, 8, 3, 'arg', 'src', '2024-05-24 22:55:30'),
(54, 8, 3, 'arg', 'src', '2024-05-24 22:56:08'),
(55, 8, 3, 'arg', 'src', '2024-05-24 22:57:07'),
(56, 8, 3, 'wsa', 'was', '2024-05-24 22:58:12'),
(57, 8, 3, 'ace', 'acd', '2024-05-24 22:58:39'),
(58, 8, 1, 'screenshot(1)', 'screenshot(1).png', '2024-05-24 22:59:28'),
(59, 8, 2, 'Lorenzix', '', '2024-05-25 23:40:24'),
(60, 8, 4, 'spike', 'brawler', '2024-05-26 20:17:59'),
(61, 5, 3, 'ertyu', '', '2024-05-26 21:42:45'),
(62, 5, 3, '', '', '2024-05-26 21:43:09'),
(63, 5, 3, '', '', '2024-05-26 21:44:13');

-- --------------------------------------------------------

--
-- Struttura della tabella `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `image_url` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `images`
--

INSERT INTO `images` (`image_id`, `article_id`, `image_url`) VALUES
(3, 3, 'upload/fenta_01.webp'),
(4, 3, 'upload/fenta_02.webp'),
(5, 3, 'upload/fenta_03.webp'),
(6, 2, 'upload/9b49aefb-94d0-4331-aa60-8abcc048d331.jpg'),
(7, 2, 'upload/f4fb75c9-02b8-4e1b-ad98-35afe5226667.jpg'),
(34, 1, '../../upload/breadB.jpg'),
(35, 1, '../../upload/breadB.jpg'),
(36, 1, 'upload/breadB.jpg'),
(37, NULL, 'upload/sfondo.jpeg'),
(38, NULL, 'upload/sfondo.jpeg'),
(39, 44, 'upload/circuito.png'),
(40, 45, 'upload/circuito.png'),
(41, 46, 'upload/comlotto.png'),
(42, 47, 'upload/Screenshot 2023-05-28 172625.png'),
(43, 48, 'upload/contatore.png'),
(44, 49, 'upload/wsl_update_x64.msi'),
(45, 50, 'upload/Screenshot (1).png'),
(46, 51, 'upload/Screenshot (1).png'),
(47, 52, 'upload/Screenshot (1).png'),
(48, 53, 'upload/Screenshot (1).png'),
(49, 54, 'upload/Screenshot (1).png'),
(50, 55, 'upload/Screenshot (1).png'),
(51, 56, 'upload/Screenshot (1).png'),
(52, 57, 'upload/Screenshot (1).png'),
(53, 58, 'upload/Screenshot (1).png'),
(54, 59, 'upload/IMG-20240526-WA0001.jpg'),
(55, 60, 'upload/download.jpg'),
(56, 61, 'upload/IMG-20240526-WA0000.jpg'),
(57, 62, 'upload/IMG-20240526-WA0000.jpg'),
(58, 63, 'upload/IMG-20240526-WA0000.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `proposals`
--

CREATE TABLE `proposals` (
  `proposal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `price` varchar(16) NOT NULL DEFAULT '0,00',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = sent\r\n-1 = declined\r\n1 = accepted',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `proposals`
--

INSERT INTO `proposals` (`proposal_id`, `user_id`, `article_id`, `price`, `status`, `created_at`) VALUES
(1, 8, 3, '1 melodioni di €', -1, '2024-05-11 20:50:12'),
(2, 8, 3, '12', -1, '2024-05-22 21:21:34'),
(3, 8, 46, 'un complotto pls', 0, '2024-05-25 14:02:51'),
(4, 10, 3, '1234567890', 1, '2024-05-25 22:59:11'),
(9, 10, 1, '10,00', 0, '2024-05-26 22:08:09');

-- --------------------------------------------------------

--
-- Struttura della tabella `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `types`
--

INSERT INTO `types` (`type_id`, `name`) VALUES
(3, 'abbigliamento'),
(6, 'altro'),
(2, 'cucina'),
(1, 'informatica'),
(5, 'libri'),
(4, 'sport');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `first_name` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `image_id`, `email`, `first_name`, `last_name`, `created_at`) VALUES
(1, 'qwerty', '65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5', NULL, 'qwerty@gmail.com', 'qwe', 'rty', '2024-05-10 01:30:19'),
(3, 'qwertz', 'd482ba4b7d3218f3e841038c407ed1f94e9846a4dd68e56bab7718903962aa98', NULL, 'qwertz@gmail.com', 'qwe', 'rtz', '2024-05-10 01:31:21'),
(4, 'tumultuoso1378', '003d8212504fe979b5ad227869bf63c801e32a59920820c1be455d4157e9d3e6', NULL, 'tintore@fi.com', 'ciompo', 'tintore', '2024-05-10 01:37:21'),
(5, 'governatoreDirezionale', '549954f9ed1f6f6f7aeeacbe69187f99159e1b1c17057e4807acf760b93e8611', NULL, 'giano@comune.fi.com', 'giano', 'della bella', '2024-05-10 01:39:32'),
(6, 'elitropiaFinder2000', '828b0d9743aaba2d4150982570110d6f4237b712809b01745540ec47296732b0', NULL, 'ardiAndrew@cdm.fi.com', 'Mr.Andreuccio', NULL, '2024-05-10 01:42:55'),
(8, 'taitElSamuel', '9886c6407c4758bb1e3d327a5529ddf0cef70eef6a8833e85b6ca7cf622a92ba', NULL, 'ElSamuel@signa.it', 'Sig.Samuel', '', '2024-05-11 02:52:51'),
(9, 'ciompoide', '73624f5cf4ec36771bc800d250b0ac5a8faf0250317238a2367a8208c9d18f20', NULL, 'ardi@andreu.com', 'ciompoide', 'ciompo', '2024-05-23 00:06:48'),
(10, 'aaa', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', NULL, 'a@a.a', 'a', 'aa', '2024-05-25 00:23:25'),
(11, 'sonoMarioSturniolo', '1c73aa76f104abc93fe18756dc3557c512e093ac8df969d76bd2af4726cbff6d', NULL, 'sono@mario.sturniolo', 'Mario', 'Sturniolo', '2024-05-26 03:29:57'),
(12, 'ciompo', 'ddaed44711777b445df5b14892f0377103156457e615217a39ac9263ec75e01d', NULL, 'ciompo@gmail.com', 'ciompo', 'ciompo', '2024-05-26 22:16:46'),
(13, 'q', '8e35c2cd3bf6641bdb0e2050b76932cbb2e6034a0ddacc1d9bea82a6ba57f7cf', NULL, 'q@q.q', 'q', 'q', '2024-05-27 00:00:43');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indici per le tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indici per le tabelle `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`proposal_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indici per le tabelle `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `image_id` (`image_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT per la tabella `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT per la tabella `proposals`
--
ALTER TABLE `proposals`
  MODIFY `proposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proposals_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
