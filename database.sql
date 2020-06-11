-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 11 2020 г., 13:36
-- Версия сервера: 5.7.26
-- Версия PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `game_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `player1_id` int(10) UNSIGNED NOT NULL,
  `player2_id` int(10) UNSIGNED NOT NULL,
  `current_bet` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `game_status` varchar(2) DEFAULT NULL,
  `player1_score` int(10) UNSIGNED DEFAULT '0',
  `player2_score` int(10) UNSIGNED DEFAULT '0',
  `game_ended_in` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `game`
--

INSERT INTO `game` (`game_id`, `player1_id`, `player2_id`, `current_bet`, `game_status`, `player1_score`, `player2_score`, `game_ended_in`) VALUES
(1, 4, 5, 0, 'w1', 100, 47, '2019-11-10 13:41:37'),
(2, 4, 5, 0, 'w1', 101, 74, '2019-11-10 13:58:19'),
(3, 5, 4, 0, 'w2', 0, 0, '2019-11-10 15:41:11'),
(4, 5, 4, 0, 'w2', 85, 103, '2019-11-10 15:45:09');

-- --------------------------------------------------------

--
-- Структура таблицы `gamelobby`
--

DROP TABLE IF EXISTS `gamelobby`;
CREATE TABLE IF NOT EXISTS `gamelobby` (
  `player_id` int(10) UNSIGNED NOT NULL,
  `last_update` timestamp NULL DEFAULT NULL,
  `search_completed` tinyint(3) UNSIGNED DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `gamelobby`
--

INSERT INTO `gamelobby` (`player_id`, `last_update`, `search_completed`) VALUES
(5, '2020-01-03 16:28:01', 1),
(2, '2019-11-08 16:08:55', 1),
(5, '2020-01-03 16:28:01', 1),
(2, '2019-11-08 16:08:55', 1),
(5, '2020-01-03 16:28:01', 1),
(2, '2019-11-08 16:08:55', 1),
(5, '2020-01-03 16:28:01', 1),
(2, '2019-11-08 16:08:55', 1),
(5, '2020-01-03 16:28:01', 1),
(2, '2019-11-08 16:08:55', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(4, '2019-11-18 10:10:40', 1),
(5, '2020-01-03 16:28:01', 1),
(6, '2019-11-10 16:33:00', 1),
(4, '2019-11-18 10:10:40', 1),
(7, '2019-11-22 18:54:47', 1),
(9, '2019-11-29 12:40:37', 1),
(10, '2019-11-29 12:40:36', 1),
(9, '2019-11-29 12:40:37', 1),
(11, '2019-12-08 18:15:40', 1),
(12, '2020-01-03 16:27:39', 1),
(5, '2020-01-03 16:28:01', 1),
(12, '2020-01-03 16:27:39', 1),
(1, '2020-05-31 06:25:13', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE IF NOT EXISTS `tokens` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `auth_token` varchar(64) NOT NULL,
  `token_exp` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `tokens`
--

INSERT INTO `tokens` (`user_id`, `auth_token`, `token_exp`) VALUES
(2, '973c97888bb1081622366d18d58dba7c02cd9264165ef3f2d7e7ba2128ba2641', '2019-11-25 17:50:13'),
(3, '279be02ffd340df37c0a8153ef2893634309d6162c5f264010bf52860b3d1337', '2019-11-25 17:50:22'),
(1, 'c5ab535ffd5c28d8ca9aa97536d40addedf9a50f75975f33600bd34023ebdaf1', '2019-11-25 18:05:54'),
(2, 'd9a328120b2dbfb0df251aee98530b9baa38ee3f7ea2a1db962d5036eca47f84', '2019-12-03 19:43:14'),
(4, 'd7552a0169598398e396b75c46f716ff8505da05d5ab602bd87cffb6ed1f2b2c', '2019-12-04 18:12:58'),
(5, '55eb14ba872af5d71a4350b801dd9c2a2f902f9674e1a3897ff125559352a3a8', '2019-12-02 17:18:32'),
(1, '74c4b429340a7272590084171e5b6bab234b632adbe9d21a1bb2f2413a2417fc', '2019-12-04 18:15:34'),
(4, '7e88611f0b870789fbd307072191476b0d714966af555a83484125ae9c74c9fd', '2019-12-09 18:41:50'),
(4, 'd5c5788c3f393ff733167d416a37f708797079b1a19ca1075eb824278e9c0e30', '2019-12-18 10:09:29'),
(7, 'd8a62b61c9dc9e3dca18b3fb5f85b3acdb015ec498b4d9a47f51eb71e6909b12', '2019-12-22 18:54:37'),
(9, '72233d56da40bc1382fa12a08c6225b853b748b18b2b1e404c5265f476d992c1', '2019-12-29 12:39:19'),
(10, '8133ac3b5e20a1f57f28e611cabb7529df12197fbbc85d4f634ae9ce4fd6cbda', '2019-12-29 12:40:33'),
(11, 'e572ddec689bbd21e4a2890a17ed32361ca093681aa0326bbecae85d0a57b691', '2020-01-07 18:15:10'),
(12, '461896efc301fefe2226710d8ea872a930fa9772cf39a85d31e47f648c666618', '2020-02-02 12:56:33'),
(5, 'bfcccbcd67ac12a2bfb9cedcada06fafae7d6ad064e8a14e931c8f5a16843d07', '2020-02-02 16:24:14'),
(1, 'aef29d8e272b71c1475eb81a39e091d3662a6d6a9e3df350ef8301cf5ef08980', '2020-06-30 06:25:09');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pass_h` varchar(64) NOT NULL,
  `pass_s` varchar(64) NOT NULL,
  `pass_exp` timestamp NULL DEFAULT NULL,
  `verified` tinyint(3) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass_h`, `pass_s`, `pass_exp`, `verified`) VALUES
(1, '1', '40c9a743983d14518ee0f89519572231fc520457e1aa32559163cc30042b0af5', 'f76f2561d67ccedcf01636c3f10c6f784819067e8601390bb66df701ae6e962e', '2020-06-30 06:25:09', 0),
(2, '', 'f79d33d9669a18e9f27fc14f3c68ed2d198c342af289c0cdbf7e532089151725', 'ab163af257095494ea501e19a818bca50667989fb9b3315d99d562102ae11335', '2020-07-09 03:43:17', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
