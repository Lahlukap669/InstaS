-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 08. okt 2019 ob 09.56
-- Različica strežnika: 10.1.40-MariaDB
-- Različica PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `instas`
--

-- --------------------------------------------------------

--
-- Struktura tabele `chat`
--

CREATE TABLE `chat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `getter_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `massg` text COLLATE utf8_slovenian_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `filters`
--

CREATE TABLE `filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter` varchar(200) COLLATE utf8_slovenian_ci NOT NULL,
  `ime` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `opis` text COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `filters`
--

INSERT INTO `filters` (`id`, `filter`, `ime`, `opis`) VALUES
(1, 'none', 'none', 'none');

-- --------------------------------------------------------

--
-- Struktura tabele `followers`
--

CREATE TABLE `followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `followed_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `followers`
--

INSERT INTO `followers` (`id`, `follower_id`, `followed_id`) VALUES
(21, 4, 8),
(25, 8, 4);

-- --------------------------------------------------------

--
-- Struktura tabele `komentarji`
--

CREATE TABLE `komentarji` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `komentar` text COLLATE utf8_slovenian_ci NOT NULL,
  `opis` text COLLATE utf8_slovenian_ci NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `komentarji`
--

INSERT INTO `komentarji` (`id`, `komentar`, `opis`, `post_id`, `user_id`, `datum`) VALUES
(1, 'ful kul', '/', 1, 8, '2019-09-30 20:46:47'),
(11, 'wd', '', 1, 8, '2019-10-01 10:52:33'),
(10, 'neki pa je', '', 1, 8, '2019-10-01 10:51:58'),
(9, 'lolololol', '', 1, 8, '2019-10-01 10:50:31'),
(8, 'hahahaha', '', 1, 8, '2019-10-01 10:44:36'),
(12, 'hahaha', '', 1, 8, '2019-10-01 11:01:33'),
(13, 'ne pa ne', '', 1, 8, '2019-10-01 11:02:19'),
(14, 'neki hahaahah', '', 1, 8, '2019-10-01 18:53:27'),
(15, '12', '', 1, 8, '2019-10-02 08:03:01');

-- --------------------------------------------------------

--
-- Struktura tabele `lajki`
--

CREATE TABLE `lajki` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `lajki`
--

INSERT INTO `lajki` (`id`, `post_id`, `user_id`) VALUES
(22, 0, 8),
(18, 1, 4),
(16, 0, 4),
(25, 1, 8);

-- --------------------------------------------------------

--
-- Struktura tabele `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` bigint(20) UNSIGNED NOT NULL,
  `naslov` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `opis` text COLLATE utf8_slovenian_ci,
  `slika_url` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `posts`
--

INSERT INTO `posts` (`id`, `filter_id`, `naslov`, `opis`, `slika_url`, `user_id`, `datum`) VALUES
(1, 1, 'neki', 'lol', 'uploads/2019-09-24_13_19_56_logo-title.png', 4, '2019-09-26 16:53:10');

-- --------------------------------------------------------

--
-- Struktura tabele `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) NOT NULL,
  `story_url` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `stories`
--

INSERT INTO `stories` (`id`, `story_url`, `user_id`, `datum`) VALUES
(1, 'uploads/2019-09-24_13_19_56_logo-title.png', 4, '2019-10-08 07:24:11');

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `google_auth_id` varchar(255) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `ime` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `priimek` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `datum_r` date NOT NULL,
  `geslo` varchar(255) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `opis` text COLLATE utf8_slovenian_ci,
  `profile_picture` varchar(255) COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`id`, `google_auth_id`, `email`, `ime`, `priimek`, `datum_r`, `geslo`, `opis`, `profile_picture`) VALUES
(8, NULL, 'luka11.lah@gmail.com', 'Luka', 'Lah', '2001-04-21', 'edf46ae9122b1a247e127ef26c2e1af0d29cb42b', NULL, 'https://image.flaticon.com/icons/png/128/149/149452.png'),
(4, '105911729496609897693', 'luka1.lah@gmail.com', 'Luka', 'Lah', '0000-00-00', NULL, NULL, 'https://lh4.googleusercontent.com/-FMlF6AKsUTg/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfj80YtkR8cTJcsXEpbPfeM1BGvTA/photo.jpg');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `getter_id` (`getter_id`);

--
-- Indeksi tabele `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksi tabele `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `followed_id` (`followed_id`);

--
-- Indeksi tabele `komentarji`
--
ALTER TABLE `komentarji`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indeksi tabele `lajki`
--
ALTER TABLE `lajki`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indeksi tabele `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `filter_id` (`filter_id`);

--
-- Indeksi tabele `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `filters`
--
ALTER TABLE `filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT tabele `followers`
--
ALTER TABLE `followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT tabele `komentarji`
--
ALTER TABLE `komentarji`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT tabele `lajki`
--
ALTER TABLE `lajki`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT tabele `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT tabele `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
