-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 19 2022 г., 06:48
-- Версия сервера: 5.5.62-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `userdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `RoomId` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `DateEnd` date DEFAULT NULL,
  `CountVisitors` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `booking`
--

INSERT INTO `booking` (`id`, `RoomId`, `StartDate`, `DateEnd`, `CountVisitors`) VALUES
(8, 2, '2022-05-14', '2022-05-22', 3),
(9, 1, '2022-05-14', '2022-05-22', 3),
(10, 2, '2022-06-14', '2022-07-01', 3),
(11, 1, '2022-05-16', '2022-05-19', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `hotelrooms`
--

CREATE TABLE `hotelrooms` (
  `id` int(11) NOT NULL,
  `RoomNumer` int(11) NOT NULL,
  `Type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cost` decimal(10,0) NOT NULL,
  `ImageURL` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `hotelrooms`
--

INSERT INTO `hotelrooms` (`id`, `RoomNumer`, `Type`, `Cost`, `ImageURL`) VALUES
(1, 101, 'OrdinaryСlass', '1000', 'https://media-cdn.tripadvisor.com/media/photo-s/09/86/c8/21/hotel-valley.jpg'),
(2, 102, 'LuxuryСlass', '5000', 'https://hotelpeking.ru/wp-content/uploads/2015/10/712_Ambassador_Suite_4-1-1024x683.jpg'),
(3, 103, 'LuxuryClass', '5000', 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'),
(4, 104, 'OrdinaryClass', '2000', 'https://images.unsplash.com/photo-1605346434674-a440ca4dc4c0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80'),
(5, 105, 'OrdinaryClass', '2000', 'https://images.unsplash.com/photo-1630660664869-c9d3cc676880?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'),
(6, 106, 'LuxuryClass', '4000', 'https://images.unsplash.com/flagged/photo-1556438758-8d49568ce18e?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1174');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(355) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`) VALUES
(7, 'Дикобраз', 'admin', 'mishail6668@gmail.com', '202cb962ac59075b964b07152d234b70', 'uploads/1652460179dkbrz.jpeg');

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `v_booking`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `v_booking` (
`id` int(11)
,`RoomNumer` int(11)
,`StartDate` date
,`DateEnd` date
,`CountVisitors` int(11)
,`CostPerPerson` decimal(10,0)
,`TotalCost` decimal(20,0)
,`Days` int(7)
);

-- --------------------------------------------------------

--
-- Структура для представления `v_booking`
--
DROP TABLE IF EXISTS `v_booking`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_booking`  AS SELECT `b`.`id` AS `id`, `h`.`RoomNumer` AS `RoomNumer`, `b`.`StartDate` AS `StartDate`, `b`.`DateEnd` AS `DateEnd`, `b`.`CountVisitors` AS `CountVisitors`, `h`.`Cost` AS `CostPerPerson`, (`h`.`Cost` * `b`.`CountVisitors`) AS `TotalCost`, (to_days(`b`.`DateEnd`) - to_days(`b`.`StartDate`)) AS `Days` FROM (`booking` `b` join `hotelrooms` `h` on((`b`.`RoomId` = `h`.`id`))) ORDER BY `b`.`StartDate` ASC ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RoomId` (`RoomId`);

--
-- Индексы таблицы `hotelrooms`
--
ALTER TABLE `hotelrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hotelrooms_RoomNumer_uindex` (`RoomNumer`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `hotelrooms`
--
ALTER TABLE `hotelrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`RoomId`) REFERENCES `hotelrooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
