-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 30 2020 г., 04:24
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `calculator`
--

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sourceImg` varchar(1000) NOT NULL,
  `hidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `sourceImg`, `hidden`) VALUES
(1, 'Дружковка', 'img/D_logo.png', 0),
(2, 'Альта-тех', 'img/alta_logo.png', 0),
(4, 'Concordance Extraction Corporation', 'img/unnamed.png', 1),
(5, 'Калибр', 'img/kalibrmic.png', 0),
(6, 'Test', 'img/marker.png', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1`
--

CREATE TABLE `positions_1` (
  `id` smallint(6) NOT NULL,
  `fName` varchar(200) DEFAULT NULL,
  `sName` varchar(200) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1`
--

INSERT INTO `positions_1` (`id`, `fName`, `sName`, `hidden`) VALUES
(1, 'DIN 933 5,8 цб', 'Болт метрический', 0),
(2, 'DIN 933 8,8 цб', 'Болт метрический', 0),
(3, 'DIN 912 8,8 цб', 'С вн. шестигранником', 0),
(4, 'DIN 934 6 цб', 'Гайка метрическая', 0),
(5, 'DIN 934 8 цб', 'Гайка метрическая', 0),
(7, 'DIN 6923 цб', 'Зубчатая с фланцем', 0),
(8, 'DIN 931 5,8', 'болт оцинкованный', 0),
(9, 'DIN 934 6 бп', 'Гайка метрическая', 0),
(10, 'DIN 934 8 бп', 'Гайка метрическая', 0),
(11, 'DIN 933 6 бп', 'Болты метрические', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1_1`
--

CREATE TABLE `positions_1_1` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1_1`
--

INSERT INTO `positions_1_1` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '6*12', 25, 5450, 5350, 0, ''),
(2, '6*16', 25, 4774, 4679, 0, ''),
(3, '6*20', 25, 4182, 4100, 0, ''),
(4, '6*25', 25, 3700, 3627, 0, ''),
(5, '6*30', 25, 3280, 3214, 0, ''),
(6, '6*35', 25, 2969, 2909, 0, ''),
(7, '6*40', 25, 2653, 2600, 0, ''),
(8, '6*50', 25, 2137, 2094, 0, ''),
(9, '8*16', 25, 2351, 2300, 0, ''),
(10, '8*20', 25, 2100, 2050, 0, ''),
(11, '8*25', 25, 1852, 1815, 0, ''),
(14, '8*30', 25, 1687, 1650, 0, ''),
(15, '8*35', 25, 1524, 1493, 0, ''),
(16, '8*40', 25, 1382, 1354, 0, ''),
(17, '10*20', 25, 1143, 1120, 0, ''),
(18, '10*25', 25, 1035, 1014, 0, ''),
(19, '12*30', 25, 643, 630, 0, ''),
(20, '12*35', 25, 585, 573, 0, ''),
(21, '8*45', 25, 1284, 1258, 0, ''),
(24, '6*45', 25, 0, 0, 1, 'Данных нет'),
(25, '8*50', 25, 1184, 1160, 0, ''),
(26, '8*55', 25, 1105, 1083, 0, ''),
(27, '8*60', 25, 1027, 1007, 0, ''),
(28, '8*65', 25, 969, 949, 0, ''),
(29, '8*70', 25, 918, 900, 0, ''),
(30, '8*75', 25, 863, 845, 0, ''),
(31, '10*30', 25, 942, 923, 0, ''),
(32, '10*35', 25, 864, 846, 0, ''),
(33, '10*40', 25, 796, 780, 0, ''),
(34, '10*45', 25, 734, 720, 0, ''),
(35, '10*50', 25, 688, 674, 0, ''),
(36, '10*60', 25, 601, 589, 0, ''),
(37, '10*70', 25, 540, 529, 0, 'В таблице -2% было 520шт'),
(38, '10*80', 25, 487, 477, 0, ''),
(39, '10*90', 25, 445, 436, 0, ''),
(40, '10*100', 25, 410, 400, 0, ''),
(41, '12*25', 25, 0, 0, 1, 'Нет данных'),
(42, '12*40', 25, 541, 530, 0, 'В таблице -2% было 531шт'),
(43, '12*45', 25, 500, 490, 0, ''),
(44, '12*50', 25, 466, 456, 0, ''),
(45, '12*55', 25, 441, 433, 0, ''),
(46, '12*60', 25, 417, 408, 0, ''),
(47, '12*65', 25, 391, 384, 0, ''),
(48, '12*70', 25, 368, 360, 0, ''),
(49, '12*80', 25, 335, 328, 0, ''),
(50, '12*100', 25, 282, 276, 0, ''),
(51, '16*30', 25, 326, 319, 0, ''),
(52, '16*35', 25, 298, 292, 0, ''),
(53, '16*40', 25, 280, 274, 0, ''),
(54, '16*45', 25, 261, 256, 0, ''),
(55, '16*50', 25, 242, 237, 0, ''),
(56, '16*55', 25, 230, 226, 0, ''),
(57, '16*60', 25, 217, 213, 0, ''),
(58, '16*65', 25, 204, 200, 0, ''),
(59, '16*70', 25, 193, 190, 0, ''),
(60, '16*75', 25, 185, 181, 0, ''),
(61, '16*80', 25, 175, 172, 0, ''),
(62, '16*90', 25, 161, 158, 0, ''),
(63, '16*100', 25, 0, 0, 1, 'Нет данных'),
(64, '16*120', 25, 129, 126, 0, ''),
(65, '20*50', 25, 142, 140, 0, ''),
(66, '20*55', 25, 134, 132, 0, ''),
(67, '20*60', 25, 128, 125, 0, ''),
(68, '20*65', 25, 121, 118, 0, ''),
(69, '20*70', 25, 115, 113, 0, ''),
(70, '20*75', 25, 110, 108, 0, ''),
(71, '20*80', 25, 105, 102, 0, ''),
(72, '20*90', 25, 97, 95, 0, ''),
(73, '20*100', 25, 89, 88, 0, ''),
(74, '20*110', 25, 83, 82, 0, ''),
(75, '20*120', 25, 78, 77, 0, ''),
(76, '24*120', 30, 63, 61, 0, 'Я бы поставил -2% - 62шт'),
(77, '16*110', 25, 126, 124, 0, 'Данные по 931 болту. В базе числился как 933');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1_2`
--

CREATE TABLE `positions_1_2` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1_2`
--

INSERT INTO `positions_1_2` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '6*20', 25, 4251, 4166, 0, ''),
(2, '6*25', 25, 3676, 3600, 0, ''),
(3, '6*30', 25, 3276, 3211, 0, ''),
(4, '6*40', 25, 2691, 2637, 0, ''),
(5, '6*45', 25, 2439, 2390, 0, ''),
(6, '6*50', 25, 2270, 2225, 0, ''),
(7, '8*16', 25, 2380, 2332, 0, ''),
(8, '8*20', 25, 2145, 2103, 0, ''),
(9, '8*25', 25, 1888, 1850, 0, ''),
(10, '8*30', 25, 1690, 1656, 0, ''),
(11, '8*35', 25, 1541, 1511, 0, ''),
(12, '8*40', 25, 1407, 1379, 0, ''),
(13, '8*45', 25, 1291, 1265, 0, ''),
(14, '8*50', 25, 1193, 1170, 0, ''),
(15, '8*55', 25, 1115, 1093, 0, ''),
(16, '8*60', 25, 1049, 1028, 0, ''),
(17, '8*65', 25, 985, 965, 0, ''),
(18, '8*80', 25, 819, 802, 0, ''),
(19, '10*20', 25, 1161, 1137, 0, ''),
(20, '10*25', 25, 1041, 1020, 0, ''),
(21, '10*30', 25, 949, 930, 0, ''),
(22, '10*35', 25, 875, 857, 0, ''),
(23, '10*40', 25, 802, 785, 0, ''),
(24, '10*45', 25, 740, 725, 0, ''),
(25, '10*50', 25, 687, 673, 0, ''),
(26, '10*55', 25, 651, 638, 0, ''),
(27, '10*60', 25, 608, 595, 0, ''),
(28, '10*65', 25, 573, 562, 0, ''),
(29, '10*70', 25, 544, 533, 0, ''),
(30, '10*80', 25, 493, 483, 0, 'В таблице -2% было 474 шт'),
(31, '10*90', 25, 452, 442, 0, ''),
(32, '10*100', 25, 416, 407, 0, ''),
(33, '12*25', 25, 711, 697, 0, ''),
(34, '12*30', 25, 635, 622, 0, ''),
(35, '12*35', 25, 585, 573, 0, ''),
(36, '12*40', 25, 544, 533, 0, ''),
(37, '12*45', 25, 511, 500, 0, ''),
(38, '12*50', 25, 472, 462, 0, ''),
(39, '12*55', 25, 444, 435, 0, ''),
(40, '12*60', 25, 415, 406, 0, ''),
(41, '12*65', 25, 392, 385, 0, ''),
(42, '12*70', 25, 373, 365, 0, ''),
(43, '12*80', 25, 336, 329, 0, ''),
(44, '12*90', 25, 310, 304, 0, ''),
(45, '12*100', 25, 284, 278, 0, ''),
(46, '16*30', 25, 328, 321, 0, ''),
(47, '16*35', 25, 304, 298, 0, ''),
(48, '16*40', 25, 283, 277, 0, ''),
(49, '16*45', 25, 260, 255, 0, ''),
(50, '16*50', 25, 244, 239, 0, ''),
(51, '16*55', 25, 229, 225, 0, ''),
(52, '16*60', 25, 217, 213, 0, ''),
(53, '16*65', 25, 205, 200, 0, ''),
(54, '16*70', 25, 194, 190, 0, ''),
(55, '16*75', 25, 185, 181, 0, ''),
(56, '16*80', 25, 176, 172, 0, ''),
(57, '16*90', 25, 162, 159, 0, ''),
(58, '16*100', 25, 148, 145, 0, ''),
(59, '16*120', 25, 130, 127, 0, ''),
(60, '16*140', 25, 114, 112, 0, ''),
(61, '20*50', 25, 143, 140, 0, ''),
(62, '20*55', 25, 135, 132, 0, ''),
(63, '20*60', 25, 127, 124, 0, ''),
(64, '20*65', 25, 121, 119, 0, ''),
(65, '20*70', 25, 115, 113, 0, ''),
(66, '20*75', 25, 114, 112, 0, ''),
(67, '20*80', 25, 106, 104, 0, ''),
(68, '20*90', 25, 97, 95, 0, ''),
(69, '20*100', 25, 90, 88, 0, ''),
(70, '20*110', 25, 84, 82, 0, ''),
(71, '20*120', 25, 78, 77, 0, ''),
(72, '24*80', 30, 0, 0, 1, 'Данных нет'),
(73, '24*90', 30, 76, 74, 0, 'Данные лучше перепроверить'),
(74, '24*100', 30, 71, 69, 0, ''),
(75, '24*120', 30, 62, 61, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1_3`
--

CREATE TABLE `positions_1_3` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1_3`
--

INSERT INTO `positions_1_3` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '6*20', 25, 3975, 3895, 0, ''),
(2, '6*30', 25, 3086, 3024, 0, ''),
(3, '6*35', 25, 2739, 2684, 0, ''),
(4, '6*40', 25, 2450, 2400, 0, ''),
(5, '6*45', 25, 2222, 2177, 0, ''),
(6, '8*20', 25, 1944, 1905, 0, ''),
(8, '8*25', 25, 1707, 1673, 0, ''),
(9, '8*30', 25, 1556, 1525, 0, ''),
(10, '8*35', 25, 1424, 1395, 0, ''),
(11, '8*40', 25, 1279, 1253, 0, ''),
(12, '8*50', 25, 1051, 1030, 0, ''),
(13, '8*55', 25, 990, 970, 0, ''),
(14, '8*60', 25, 911, 893, 0, ''),
(15, '8*70', 25, 799, 783, 0, ''),
(16, '10*20', 25, 1147, 1124, 0, ''),
(17, '10*25', 25, 1031, 1010, 0, ''),
(18, '10*30', 25, 949, 930, 0, ''),
(19, '10*35', 25, 860, 843, 0, ''),
(20, '10*40', 25, 790, 774, 0, ''),
(21, '10*45', 25, 713, 700, 0, ''),
(22, '10*50', 25, 657, 644, 0, ''),
(23, '10*60', 25, 570, 558, 0, 'В таблице -2% было как 568шт. Это, вероятно, -1%.'),
(24, '10*70', 25, 495, 485, 0, ''),
(25, '10*80', 25, 446, 437, 0, ''),
(26, '12*25', 25, 700, 686, 0, ''),
(27, '12*30', 25, 634, 622, 0, ''),
(28, '12*35', 25, 649, 636, 0, ''),
(29, '12*40', 25, 534, 523, 0, ''),
(30, '12*45', 25, 496, 486, 0, ''),
(31, '12*60', 25, 396, 388, 0, ''),
(32, '12*70', 25, 348, 341, 0, ''),
(33, '16*30', 25, 315, 309, 0, ''),
(34, '16*45', 25, 250, 248, 0, 'По факту -2% - 245шт. '),
(35, '16*50', 25, 235, 230, 0, ''),
(36, '16*60', 25, 209, 205, 0, ''),
(37, '16*100', 25, 0, 0, 1, 'Нет данных');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1_4`
--

CREATE TABLE `positions_1_4` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1_4`
--

INSERT INTO `positions_1_4` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '6', 25, 11800, 11564, 0, ''),
(2, '8', 25, 5450, 5340, 0, ''),
(3, '10', 25, 2286, 2240, 0, ''),
(4, '12', 25, 1500, 1500, 0, 'Исключение. 12 гайка принимается как 1500 штук и отгружается так же.'),
(5, '14', 25, 1093, 1070, 0, ''),
(6, '16', 25, 835, 818, 0, 'Раньше принимали по 800шт'),
(7, '18', 25, 596, 584, 0, ''),
(8, '20', 25, 462, 452, 0, ''),
(9, '22', 30, 0, 0, 1, 'Нет данных'),
(10, '24', 30, 283, 277, 0, ''),
(11, '27', 30, 142, 139, 0, ''),
(12, '36', 30, 80, 79, 0, ''),
(13, '30', 30, 142, 139, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1_5`
--

CREATE TABLE `positions_1_5` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1_5`
--

INSERT INTO `positions_1_5` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '6', 25, 11309, 11082, 0, ''),
(2, '8', 25, 5446, 5337, 0, ''),
(3, '10', 25, 2338, 2291, 0, ''),
(4, '12', 25, 1500, 1500, 0, 'Исключение. 12 гайка принимается как 1500 штук и отгружается так же.'),
(5, '14', 25, 1111, 1088, 0, ''),
(6, '16', 25, 835, 818, 0, 'Раньше принимали по 800шт'),
(7, '18', 25, 0, 0, 1, 'Нет данных'),
(8, '20', 25, 442, 433, 0, ''),
(9, '22', 30, 0, 0, 1, 'Нет данных'),
(10, '24', 30, 283, 277, 0, ''),
(11, '27', 30, 0, 0, 1, 'Нет данных'),
(12, '30', 30, 139, 136, 0, ''),
(13, '36', 30, 0, 0, 1, 'Нет данных');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1_7`
--

CREATE TABLE `positions_1_7` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1_7`
--

INSERT INTO `positions_1_7` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '6', 25, 8064, 7903, 0, ''),
(2, '8', 25, 0, 0, 1, 'Нет данных'),
(3, '10', 25, 2080, 2060, 0, ''),
(4, '12', 25, 1260, 1235, 0, ''),
(5, '14', 25, 0, 0, 1, 'Нет данных'),
(6, '16', 25, 528, 517, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1_8`
--

CREATE TABLE `positions_1_8` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1_8`
--

INSERT INTO `positions_1_8` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '16*110', 25, 126, 124, 0, 'Числился в базе как 933'),
(2, '27*120', 30, 44, 43, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1_9`
--

CREATE TABLE `positions_1_9` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1_9`
--

INSERT INTO `positions_1_9` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '8', 30, 6349, 6222, 0, ''),
(2, '6', 30, 0, 0, 1, 'Нет данных'),
(3, '10', 30, 2788, 2732, 0, ''),
(4, '12', 30, 1850, 1813, 0, ''),
(5, '14', 30, 0, 0, 1, 'Нет данных'),
(6, '16', 30, 1009, 989, 0, ''),
(7, '18', 30, 717, 702, 0, ''),
(8, '20', 30, 549, 538, 0, 'Данные лучше перепроверить'),
(9, '22', 30, 407, 398, 0, ''),
(10, '24', 30, 285, 279, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1_10`
--

CREATE TABLE `positions_1_10` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1_10`
--

INSERT INTO `positions_1_10` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '20', 30, 448, 439, 0, 'Данные лучше перепроверить');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_1_11`
--

CREATE TABLE `positions_1_11` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_1_11`
--

INSERT INTO `positions_1_11` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '8*20', 30, 2555, 2505, 0, ''),
(2, '12*35', 30, 712, 700, 0, 'В таблице -2% было 698шт');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_2`
--

CREATE TABLE `positions_2` (
  `id` tinyint(4) NOT NULL,
  `fName` varchar(200) NOT NULL,
  `sName` varchar(200) NOT NULL,
  `hidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_2`
--

INSERT INTO `positions_2` (`id`, `fName`, `sName`, `hidden`) VALUES
(1, 'DIN 933 5.8', 'Болт оцинкованный', 0),
(2, 'DIN 934 6', 'Гайка оцинкованная', 0),
(3, 'DIN 934 8', 'Гайка оцинкованная', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `positions_2_1`
--

CREATE TABLE `positions_2_1` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) NOT NULL,
  `standart` smallint(6) NOT NULL,
  `quantity` mediumint(9) NOT NULL,
  `quantity_2` mediumint(9) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `alt` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_2_1`
--

INSERT INTO `positions_2_1` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '6*25', 10, 1522, 1492, 0, ''),
(2, '6*80', 10, 632, 619, 0, ''),
(3, '8*50', 10, 484, 474, 0, ''),
(4, '8*90', 10, 300, 294, 0, ''),
(5, '8*100', 10, 274, 269, 0, ''),
(6, '10*25', 10, 422, 414, 0, ''),
(7, '10*40', 10, 319, 313, 0, ''),
(8, '10*50', 10, 278, 272, 0, ''),
(9, '10*100', 10, 168, 164, 0, ''),
(10, '10*120', 10, 145, 142, 0, ''),
(11, '12*80', 10, 137, 135, 0, ''),
(12, '12*120', 10, 100, 98, 0, ''),
(13, '16*40', 10, 113, 110, 0, ''),
(14, '16*60', 10, 87, 86, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_2_2`
--

CREATE TABLE `positions_2_2` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) NOT NULL,
  `standart` smallint(6) NOT NULL,
  `quantity` mediumint(9) NOT NULL,
  `quantity_2` mediumint(9) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `alt` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_2_2`
--

INSERT INTO `positions_2_2` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '4', 10, 14700, 14406, 0, ''),
(2, '6', 10, 4925, 4825, 0, ''),
(3, '8', 10, 2200, 2156, 0, ''),
(4, '10', 10, 1000, 980, 0, ''),
(5, '16', 10, 349, 342, 0, ''),
(6, '20', 10, 191, 187, 0, ''),
(7, '5', 10, 0, 0, 1, 'Нет данных'),
(8, '12', 10, 0, 0, 1, 'Нет данных'),
(9, '14', 10, 0, 0, 1, 'Нет данных'),
(10, '18', 10, 0, 0, 1, 'Нет данных');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_2_3`
--

CREATE TABLE `positions_2_3` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_2_3`
--

INSERT INTO `positions_2_3` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '6', 10, 0, 0, 1, 'Нет данных');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_4`
--

CREATE TABLE `positions_4` (
  `id` smallint(6) NOT NULL,
  `fName` varchar(200) DEFAULT NULL,
  `sName` varchar(200) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_4`
--

INSERT INTO `positions_4` (`id`, `fName`, `sName`, `hidden`) VALUES
(1, 'Powering Humanity', 'into the future', 0),
(2, 'йцук', 'цйуцк', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `positions_4_1`
--

CREATE TABLE `positions_4_1` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_4_1`
--

INSERT INTO `positions_4_1` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(10, '5*30', 25, 1000, 980, 0, ''),
(15, '8*100', 25, 300, 294, 0, ''),
(16, '8*120', 25, 500, 490, 0, ''),
(17, '10*80', 25, 150, 147, 0, ''),
(19, '10*90', 25, 123, 120, 0, ''),
(20, '10*100', 25, 110, 107, 0, ''),
(21, '10*120', 25, 50, 49, 0, ''),
(23, '12*20', 12, 2134, 2091, 1, '24 м'),
(25, '12*50', 32, 3423, 3354, 0, 'Вася'),
(26, '12*60', 21, 324324, 317837, 0, 'Петя'),
(27, '12*70', 34, 43543, 42672, 0, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_4_2`
--

CREATE TABLE `positions_4_2` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `positions_5`
--

CREATE TABLE `positions_5` (
  `id` smallint(6) NOT NULL,
  `fName` varchar(200) DEFAULT NULL,
  `sName` varchar(200) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_5`
--

INSERT INTO `positions_5` (`id`, `fName`, `sName`, `hidden`) VALUES
(1, 'Гайка ромбовидная', 'Закладная оцинкованная', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `positions_5_1`
--

CREATE TABLE `positions_5_1` (
  `id` smallint(6) NOT NULL,
  `position` varchar(10) DEFAULT NULL,
  `standart` smallint(6) DEFAULT NULL,
  `quantity` mediumint(9) DEFAULT NULL,
  `quantity_2` mediumint(9) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `alt` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `positions_5_1`
--

INSERT INTO `positions_5_1` (`id`, `position`, `standart`, `quantity`, `quantity_2`, `hidden`, `alt`) VALUES
(1, '8', 10, 803, 786, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `positions_6`
--

CREATE TABLE `positions_6` (
  `id` smallint(6) NOT NULL,
  `fName` varchar(200) DEFAULT NULL,
  `sName` varchar(200) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` tinyint(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'feebf2ce8e41247d0a2c533af8bd4e6a', '8c1e53f478de2be125953060b1223996');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1`
--
ALTER TABLE `positions_1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1_1`
--
ALTER TABLE `positions_1_1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1_2`
--
ALTER TABLE `positions_1_2`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1_3`
--
ALTER TABLE `positions_1_3`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1_4`
--
ALTER TABLE `positions_1_4`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1_5`
--
ALTER TABLE `positions_1_5`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1_7`
--
ALTER TABLE `positions_1_7`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1_8`
--
ALTER TABLE `positions_1_8`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1_9`
--
ALTER TABLE `positions_1_9`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1_10`
--
ALTER TABLE `positions_1_10`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_1_11`
--
ALTER TABLE `positions_1_11`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_2`
--
ALTER TABLE `positions_2`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_2_1`
--
ALTER TABLE `positions_2_1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_2_2`
--
ALTER TABLE `positions_2_2`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_2_3`
--
ALTER TABLE `positions_2_3`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_4`
--
ALTER TABLE `positions_4`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_4_1`
--
ALTER TABLE `positions_4_1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_4_2`
--
ALTER TABLE `positions_4_2`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_5`
--
ALTER TABLE `positions_5`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_5_1`
--
ALTER TABLE `positions_5_1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions_6`
--
ALTER TABLE `positions_6`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `positions_1`
--
ALTER TABLE `positions_1`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `positions_1_1`
--
ALTER TABLE `positions_1_1`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT для таблицы `positions_1_2`
--
ALTER TABLE `positions_1_2`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT для таблицы `positions_1_3`
--
ALTER TABLE `positions_1_3`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `positions_1_4`
--
ALTER TABLE `positions_1_4`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `positions_1_5`
--
ALTER TABLE `positions_1_5`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `positions_1_7`
--
ALTER TABLE `positions_1_7`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `positions_1_8`
--
ALTER TABLE `positions_1_8`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `positions_1_9`
--
ALTER TABLE `positions_1_9`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `positions_1_10`
--
ALTER TABLE `positions_1_10`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `positions_1_11`
--
ALTER TABLE `positions_1_11`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `positions_2`
--
ALTER TABLE `positions_2`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `positions_2_1`
--
ALTER TABLE `positions_2_1`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `positions_2_2`
--
ALTER TABLE `positions_2_2`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `positions_2_3`
--
ALTER TABLE `positions_2_3`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `positions_4`
--
ALTER TABLE `positions_4`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `positions_4_1`
--
ALTER TABLE `positions_4_1`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `positions_4_2`
--
ALTER TABLE `positions_4_2`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `positions_5`
--
ALTER TABLE `positions_5`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `positions_5_1`
--
ALTER TABLE `positions_5_1`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `positions_6`
--
ALTER TABLE `positions_6`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
