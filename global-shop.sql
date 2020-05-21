-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 20 2020 г., 11:12
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `global-shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `imgLg` varchar(255) DEFAULT NULL,
  `imgSm` varchar(255) NOT NULL,
  `imgXl` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `color` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `title`, `text`, `img`, `imgLg`, `imgSm`, `imgXl`, `price`, `color`, `quantity`, `category`) VALUES
(1, 'Beatsx', 'With up to 40 hours of battery life, Beatsx is your perfect everyday headphone. Get the most out of your music with an award-winning, emotionally charged Beats listening experience.', 'goods1.png', 'goods1-lg.jpg', 'goods1-sm.png', 'goods1-xl.png', 200, 'violet', 45, 'headphones'),
(2, 'Beatsx', 'With up to 40 hours of battery life, Beatsx is your perfect everyday headphone. Get the most out of your music with an award-winning, emotionally charged Beats listening experience.', 'goods2.png', 'goods2-lg.jpg', 'goods2-sm.png', 'goods2-xl.png', 150, 'pink', 108, 'headphones'),
(3, 'Beats Studio Wireless', 'With up to 40 hours of battery life, Beats Studio Wireless is your perfect everyday headphone. Get the most out of your music with an award-winning, emotionally charged Beats listening experience.', 'goods3.png', 'goods3-lg.jpg', 'goods3-sm.png', 'goods3-xl.png', 355, 'green', 123, 'headphones'),
(4, 'Beats Studio Wireless', 'With up to 40 hours of battery life, Beats Studio Wireless is your perfect everyday headphone. Get the most out of your music with an award-winning, emotionally charged Beats listening experience.', 'goods4.png', 'goods4-lg.jpg', 'goods4-sm.png', 'goods4-xl.png', 280, 'gumbo', 76, 'headphones'),
(5, 'Beats Studio Wireless', 'With up to 40 hours of battery life, Beats Studio Wireless is your perfect everyday headphone. Get the most out of your music with an award-winning, emotionally charged Beats listening experience.', 'goods5.png', 'goods5-lg.jpg', 'goods5-sm.png', 'goods5-xl.png', 600, 'blue', 98, 'headphones'),
(6, 'Beats EP', 'With up to 40 hours of battery life, Beats EP is your perfect everyday headphone. Get the most out of your music with an award-winning, emotionally charged Beats listening experience.', 'goods6.png', 'goods6-lg.jpg', 'goods6-sm.png', 'goods6-xl.png', 255, 'gold', 78, 'headphones');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `videos`
--

INSERT INTO `videos` (`id`, `poster`, `video`) VALUES
(1, 'preview1.jpg', 'video1.mp4'),
(2, 'preview2.jpg', 'video2.mp4');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
