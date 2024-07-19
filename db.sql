-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 23 2024 г., 00:15
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `repair_orders`
--

CREATE TABLE `repair_orders` (
  `id` int(255) NOT NULL,
  `photo_path` char(255) DEFAULT NULL,
  `the_job` char(255) NOT NULL,
  `id_type` int(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `repair_orders`
--

INSERT INTO `repair_orders` (`id`, `photo_path`, `the_job`, `id_type`, `description`, `price`) VALUES
(1, 'Dvigatel_osm.jpg', 'Осмотр двигателя.', 1, 'Есть проблемы с работой двигателя, провалы в мощности после 3000 оборотов.', 700.00),
(2, 'GRM.jpg', 'Регулировка ремня ГРМ.', 3, '', 1000.00),
(3, 'Salon_poln.JPG', 'Полная уборка салона', 2, '', 2000.00),
(4, 'Petli.jpg', 'Смазка дверных петель', 4, '', 700.00),
(5, 'Provod_zam.jpg', 'Замена проводки освещения', 5, 'Проблемы с дальним светом фар', 700.00),
(6, 'Salon_poln2.jpg', 'Полная уборка салона', 2, '', 2000.00),
(7, 'Dvigatel_osm2.jpg', 'Осмотр двигателя.', 1, 'Не заводится двигатель', 700.00),
(8, 'Petli2.jpg', 'Смазка дверных петель', 4, '', 700.00),
(9, 'Kovr_chist2.jpg', 'Чистка ковров', 2, '', 500.00),
(10, 'Zamena_prov.jpg', 'Полная замена проводки', 5, '', 3000.00),
(11, 'Tormoz_osm.jpg', 'Осмотр тормозной системы', 1, '', 700.00),
(12, 'Koleso.jpg', 'Протяжка колес', 3, 'Полная протяжка всех крепежных узлов на колесах', 400.00),
(13, 'Salon_poln3.jpg', 'Полная уборка салона', 2, '', 2000.00),
(14, 'Prow_osw.jpg', 'Замена проводки освещения', 5, 'Проблемы с огнями ПТФ', 700.00),
(15, 'Akkum.jpg', 'Замена аккумулятора', 5, '', 800.00),
(16, 'Kovr_chist2.jpg', 'Чистка ковров', 2, '', 500.00),
(17, 'Tormoz_osm2.jpg', 'Осмотр тормозной системы', 1, '', 700.00),
(18, 'Petli3.jpg', 'Смазка дверных петель', 4, '', 700.00),
(19, 'Dvigatel_osm3.jpg', 'Осмотр двигателя.', 1, 'Стук двигателя', 700.00),
(20, 'Salon_poln4.jpg', 'Полная уборка салона', 2, '', 2000.00);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(255) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `interests` varchar(255) NOT NULL,
  `vk` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `rh_factor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fio`, `birthday`, `address`, `gender`, `interests`, `vk`, `blood_type`, `rh_factor`) VALUES
(1, 'user10745@ya.ru', '$2y$10$IV.4u7KgBK.HdkRzLt9h2Oym3RUZ1XgGlIoDY6YF4.l3AYY.AEroy', 'Хуй пизда', '2023-12-01', 'хуй пидо 92', 'male', 'asdasd', 'фывфыв', 'фывфыв', 'фывфыв'),
(2, 'user10745@yandex.ru', '$2y$10$LwlCa0XdA0a0oiN.uiPH.uijZdGffs8vFccAEk/Nq2k.iri.MBhwK', '&lt;?= htmlspecialchars($email) ?&gt;', '2023-12-03', '&lt;?= htmlspecialchars($email) ?&gt;', 'female', '&lt;?= htmlspecialchars($email) ?&gt;', '&lt;?= htmlspecialchars($email) ?&gt;', '&lt;?= htmlspecialchars($email) ?&gt;', '&lt;?= htmlspecialchars($email) ?&gt;'),
(3, 'user1074@yandex.ru', '$2y$10$C/bsvH.qwxvdbfuFxFPbGeK4LDIVpXQPcHw1.jARfLAETnLeXXDxa', 'qwerty', '2023-12-09', 'asdasd', 'male', 'asdasdad', 'asdasd', 'asdasd', 'asdasd'),
(4, 'user107@yandex.ru', '$2y$10$hP1qQT7O7.H0oYh8B9vrBeQYe2BCTvv0CQxgydU1J2ZL44wZs8otu', '', '0000-00-00', '', 'male', '', '', '', ''),
(5, 'user10@yandex.ru', '$2y$10$.WIxLxCPjQZQQSNBqI0.lOwNZzua8OpLc.DzkF4u4vmeBxt5O66Iu', 'weqwe', '2023-12-12', '123123', 'female', '12313', '1231', '123', '1231'),
(6, 'user10745@yarus.ru', '$2y$10$QOitwQ5Nz/N4IXFDV8Wqn.O8LXa03aX684txOSRU1zbgo42uvVTjy', '123', '0000-00-00', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `work_types`
--

CREATE TABLE `work_types` (
  `id` int(255) NOT NULL,
  `name` char(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `work_types`
--

INSERT INTO `work_types` (`id`, `name`, `description`) VALUES
(1, 'Контрольно-диагностические', 'Производится осмотр состояния транспортного средства.'),
(2, 'Уборочно-моечные', 'Производится уборка салона, мойка наружней части странспортного средства.'),
(3, 'Крепежные', 'Производится настрока крепежных узлов.'),
(4, 'Смазочные', 'Производится смазка всех узлов.'),
(5, 'Электротехнические', 'Производится осмотр и ремонт элеметротрехнических элементов автомобиля.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `repair_orders`
--
ALTER TABLE `repair_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`id_type`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `work_types`
--
ALTER TABLE `work_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `repair_orders`
--
ALTER TABLE `repair_orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `work_types`
--
ALTER TABLE `work_types`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `repair_orders`
--
ALTER TABLE `repair_orders`
  ADD CONSTRAINT `type` FOREIGN KEY (`id_type`) REFERENCES `work_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
