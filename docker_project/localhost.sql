-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 16 2022 г., 21:07
-- Версия сервера: 8.0.28
-- Версия PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `practice`
--
CREATE DATABASE IF NOT EXISTS `practice` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `practice`;

-- --------------------------------------------------------

--
-- Структура таблицы `gibdd`
--

CREATE TABLE `gibdd` (
  `model` varchar(100) NOT NULL,
  `release_year` year NOT NULL,
  `vin` varchar(17) NOT NULL,
  `frame_number` varchar(100) NOT NULL,
  `cabin_number` varchar(17) NOT NULL,
  `cabin_color` varchar(100) NOT NULL,
  `engine_number` varchar(100) NOT NULL,
  `displacement` varchar(100) NOT NULL,
  `power` varchar(100) NOT NULL,
  `vehicle_type` varchar(100) NOT NULL,
  `holding_period` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `gibdd_dk`
--

CREATE TABLE `gibdd_dk` (
  `dcNumber` varchar(100) NOT NULL,
  `dcDate` varchar(100) NOT NULL,
  `dcExpirationDate` varchar(100) NOT NULL,
  `pointAddress` varchar(200) NOT NULL,
  `vin` varchar(17) NOT NULL,
  `body` varchar(100) NOT NULL,
  `chassis` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `odometerValue` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `gibdd_dtp`
--

CREATE TABLE `gibdd_dtp` (
  `number` int NOT NULL,
  `vin` varchar(17) NOT NULL,
  `date` varchar(16) NOT NULL,
  `type` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `release_year` year NOT NULL,
  `opf_owner` varchar(50) NOT NULL,
  `num_all` varchar(10) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `gibdd_restrict`
--

CREATE TABLE `gibdd_restrict` (
  `tsVIN` varchar(17) NOT NULL,
  `tsmodel` varchar(100) NOT NULL,
  `tsyear` year NOT NULL,
  `dateogr` varchar(10) NOT NULL,
  `regname` varchar(100) NOT NULL,
  `codeTo` varchar(100) NOT NULL,
  `divtype` varchar(100) NOT NULL,
  `osnOgr` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `gid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `gibdd_wanted`
--

CREATE TABLE `gibdd_wanted` (
  `w_vin` varchar(17) NOT NULL,
  `w_model` varchar(100) NOT NULL,
  `w_god_vyp` year NOT NULL,
  `w_data_pu` date NOT NULL,
  `w_reg_inic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `log_gibdd`
--

CREATE TABLE `log_gibdd` (
  `id` int NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `vin` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `log_gibdd`
--
ALTER TABLE `log_gibdd`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `log_gibdd`
--
ALTER TABLE `log_gibdd`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
