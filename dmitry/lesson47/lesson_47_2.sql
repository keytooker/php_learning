-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 10 2019 г., 20:37
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lesson_47_2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `family_tree`
--

CREATE TABLE `family_tree` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `mother` int(11) DEFAULT NULL,
  `father` int(11) DEFAULT NULL,
  `sex` varchar(6) NOT NULL,
  `spouse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `family_tree`
--

INSERT INTO `family_tree` (`id`, `name`, `mother`, `father`, `sex`, `spouse`) VALUES
(1, 'Архипов Пантелеймон', NULL, NULL, 'male', 0),
(2, 'Архипова Клавдия', NULL, NULL, 'female', 0),
(3, 'Архипов Иван', 2, 1, 'male', 0),
(4, 'Онопко Наталья', 2, 1, 'famale', 0),
(5, 'Архипов Мирон', NULL, 3, 'male', 0),
(6, 'Онопко Екатерина', 4, NULL, 'famale', 0),
(7, 'Архипов Павел', NULL, 5, 'male', NULL),
(8, 'Архипова Марина', NULL, 5, 'female', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `family_tree`
--
ALTER TABLE `family_tree`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `family_tree`
--
ALTER TABLE `family_tree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
