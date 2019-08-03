-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 03 2019 г., 17:43
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
-- База данных: `avito`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `text` varchar(256) DEFAULT NULL,
  `timeup` datetime NOT NULL,
  `user` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ads`
--

INSERT INTO `ads` (`id`, `title`, `text`, `timeup`, `user`, `category`) VALUES
(1, 'Lego', 'Продам Lego', '2019-08-03 16:59:59', 1, 3),
(2, 'КУкла', 'Маша', '2019-08-03 14:14:22', 1, 3),
(3, 'Книга', 'кулинарная', '2019-08-03 17:38:52', 1, 1),
(4, 'Кукла', 'Даша', '2019-08-03 14:16:38', 1, 3),
(5, 'Car', 'supercar', '2019-08-01 16:59:36', 1, 2),
(6, '|Vfib', 'vfalkdjfalkdfsald', '2019-08-02 17:01:17', 2, 2),
(7, 'Штука', 'Ерундовина для полива цветов', '2019-08-03 17:31:16', 2, 2),
(8, 'Штука', 'Ерундовина для полива цветов', '2019-08-03 17:31:32', 2, 2),
(9, 'Audi 100', 'В хорошем состоянии', '2019-08-03 17:38:45', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Личные вещи'),
(2, 'Авто'),
(3, 'Для детей');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'test', '$2y$10$GC5XWghAuZVDwz1A29bKgeJbx2pr8AmtqpTYn3XcoGBHaJ//x.y3W'),
(2, 'mivi', '$2y$10$KL00KAbaS/Pq0lACkuMj1uT.u.UO3om6L6qDTE3GjJtCFarpXW.AS');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
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
-- AUTO_INCREMENT для таблицы `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
