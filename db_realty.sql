-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 04 2016 г., 16:55
-- Версия сервера: 5.5.45
-- Версия PHP: 5.4.44

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `db_realty`
--

-- --------------------------------------------------------

--
-- Структура таблицы `realty`
--

CREATE TABLE IF NOT EXISTS `realty` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `title` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1023) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Дамп данных таблицы `realty`
--

INSERT INTO `realty` (`id`, `type_id`, `title`, `address`, `price`) VALUES
(33, 3, 'Комната в коммунальной квартире, туалет совмещенный, одни соседи алканавты, другие многодетная семья. И далее может быть длинное описание. Так как описание может быть очччень длинным, его нет смысла полностью выводить на главной странице. Полностью выводи', 'ул. Строителей 70', 2000000),
(34, 1, '3-комнатная квартира', 'Средний пр. 45', 7500000),
(50, 2, '2-этажный дом', 'Село Крайнее Новая ул 20', 3000000),
(51, 3, 'Комната в коммунальной квартире', 'Средняя 60', 700000),
(58, 1, '3-комнатная квартира', 'Столичная ул 9', 7000000);

-- --------------------------------------------------------

--
-- Структура таблицы `realty_type`
--

CREATE TABLE IF NOT EXISTS `realty_type` (
  `type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_id_3` (`type_id`),
  KEY `type_id` (`type_id`),
  KEY `type_id_2` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `realty_type`
--

INSERT INTO `realty_type` (`type_id`, `type`) VALUES
(1, 'Квартира'),
(2, 'Загородный дом'),
(3, 'Комната');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `realty`
--
ALTER TABLE `realty`
  ADD CONSTRAINT `realty_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `realty_type` (`type_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
