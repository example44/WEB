-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 17 2019 г., 00:06
-- Версия сервера: 5.7.26
-- Версия PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `conference`
--

-- --------------------------------------------------------

--
-- Структура таблицы `prispevek`
--

DROP TABLE IF EXISTS `prispevek`;
CREATE TABLE IF NOT EXISTS `prispevek` (
  `id_PRISPEVEK` int(11) NOT NULL AUTO_INCREMENT,
  `obsah` longtext COLLATE utf8_czech_ci NOT NULL,
  `nazev` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `rozhodnuti` tinyint(4) NOT NULL DEFAULT '0',
  `id_UZIVATEL` bigint(20) NOT NULL,
  PRIMARY KEY (`id_PRISPEVEK`),
  UNIQUE KEY `nazev_UNIQUE` (`nazev`),
  KEY `fk_PRISPEVEK_UZIVATEL1_idx` (`id_UZIVATEL`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `recenze`
--

DROP TABLE IF EXISTS `recenze`;
CREATE TABLE IF NOT EXISTS `recenze` (
  `id_RECENZE` int(11) NOT NULL AUTO_INCREMENT,
  `originalita` tinyint(1) NOT NULL DEFAULT '0',
  `tema` tinyint(1) NOT NULL DEFAULT '0',
  `technicka_kvalita` tinyint(1) NOT NULL DEFAULT '0',
  `jazykova_kvalita` tinyint(1) NOT NULL DEFAULT '0',
  `doporuceni` tinyint(1) NOT NULL DEFAULT '0',
  `poznamky` longtext COLLATE utf8_czech_ci,
  `id_UZIVATEL` bigint(20) DEFAULT NULL,
  `id_PRISPEVEK` int(11) NOT NULL,
  PRIMARY KEY (`id_RECENZE`),
  KEY `fk_RECENZE_UZIVATEL1_idx` (`id_UZIVATEL`),
  KEY `fk_RECENZE_PRISPEVEK1_idx` (`id_PRISPEVEK`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_ROLE` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_ROLE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id_ROLE`, `nazev`) VALUES
(1, 'Admin'),
(2, 'Recenzent'),
(3, 'Autor');

-- --------------------------------------------------------

--
-- Структура таблицы `soubor`
--

DROP TABLE IF EXISTS `soubor`;
CREATE TABLE IF NOT EXISTS `soubor` (
  `id_SOUBOR` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `id_PRISPEVEK` int(11) NOT NULL,
  PRIMARY KEY (`id_SOUBOR`),
  UNIQUE KEY `nazev_UNIQUE` (`nazev`),
  KEY `fk_SOUBOR_PRISPEVEK1_idx` (`id_PRISPEVEK`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `uzivatel`
--

DROP TABLE IF EXISTS `uzivatel`;
CREATE TABLE IF NOT EXISTS `uzivatel` (
  `id_UZIVATEL` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `id_ROLE` int(1) NOT NULL,
  PRIMARY KEY (`id_UZIVATEL`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_UZIVATEL_ROLE1_idx` (`id_ROLE`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Дамп данных таблицы `uzivatel`
--

INSERT INTO `uzivatel` (`id_UZIVATEL`, `email`, `heslo`, `username`, `active`, `id_ROLE`) VALUES
(9, 'test1@test.com', 'test', 'test1', 1, 1),
(10, 'test2@test.com', 'test', 'test2', 1, 2),
(11, 'test3@test.com', 'test', 'test3', 1, 3);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `prispevek`
--
ALTER TABLE `prispevek`
  ADD CONSTRAINT `fk_PRISPEVEK_UZIVATEL1` FOREIGN KEY (`id_UZIVATEL`) REFERENCES `uzivatel` (`id_UZIVATEL`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `recenze`
--
ALTER TABLE `recenze`
  ADD CONSTRAINT `fk_RECENZE_PRISPEVEK1` FOREIGN KEY (`id_PRISPEVEK`) REFERENCES `prispevek` (`id_PRISPEVEK`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RECENZE_UZIVATEL1` FOREIGN KEY (`id_UZIVATEL`) REFERENCES `uzivatel` (`id_UZIVATEL`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `soubor`
--
ALTER TABLE `soubor`
  ADD CONSTRAINT `fk_SOUBOR_PRISPEVEK1` FOREIGN KEY (`id_PRISPEVEK`) REFERENCES `prispevek` (`id_PRISPEVEK`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD CONSTRAINT `fk_UZIVATEL_ROLE1` FOREIGN KEY (`id_ROLE`) REFERENCES `role` (`id_ROLE`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
