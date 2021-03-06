-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 26 2019 г., 23:53
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
  `country` varchar(128) DEFAULT NULL,
  `surname` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `patronymic` varchar(128) DEFAULT NULL,
  `status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `date`, `email`, `registration_date`, `country`, `surname`, `name`, `patronymic`, `status`) VALUES
(15, 'mivi', 'ec432060f6b8a16f1f6be5feb664c225', '1986-03-10', 'adf@dfasdf.ru', '1986-03-10', 'USA', 'Visloguzov', 'Mikhail', 'Aleksandrovith', 'user'),
(16, 'user', '$2y$10$edqC7JEjKTAbEJzqwaUA0eyC3bybTGwtmo97Rw34Z3fzZ9C9RjOTa', '2010-07-26', 'khgfc@jhgf.oiu', '2019-07-16', 'Russia', 'ce', '77777', 'be', 'user'),
(23, 'admin', '$2y$10$A1679n11Y.sWS0L/sSxlBOfZPQOv4Rvm0mbcO1FbpMuFzVrDRhpc2', '2019-07-17', 'admin@admin.com', '2019-07-26', 'Russia', NULL, NULL, NULL, 'admin');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
