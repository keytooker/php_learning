-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 16 2019 г., 16:09
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
-- База данных: `48-55`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `url` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `url`, `title`) VALUES
(1, '/dmitry/lesson48-50/index.php', 'Главная'),
(2, '/dmitry/lesson48-50/1.php', 'Как соединиться с базой данных в php');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `date` date DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `date`, `email`, `registration_date`, `country`) VALUES
(1, 'user', '12345', NULL, '', NULL, NULL),
(2, 'admin', '123', NULL, '', NULL, NULL),
(3, 'Mikhail', '123', NULL, '', NULL, NULL),
(4, 'someone', '1234', NULL, '', NULL, NULL),
(5, 'adfa', 'adfad', '2014-08-31', '', NULL, NULL),
(6, 'adfadfsa', 'adfadf', '2011-05-31', 'adfad@dfa.com', NULL, NULL),
(7, 'dima', 'dima', '2010-11-30', 'dima@ya.com', '2019-06-21', NULL),
(8, 'anna', 'anna', '2018-12-31', 'anna@anna.cm', '2019-06-21', NULL),
(9, 'dima', '123', '2018-11-27', 'dfa@sd.rcoi', '2019-06-21', NULL),
(11, 'www', 'ййй', '2019-07-01', 'gjgvj@jhbk.sh', '2019-07-16', NULL),
(12, 'eee', 'еее', '2019-07-01', 'xfgxgfg@nhvnh.ru', '2019-07-16', NULL),
(13, 'ddd', 'dddd', '2019-07-03', 'kgv@jgc.yt', '2019-07-16', 'USA');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
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
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
