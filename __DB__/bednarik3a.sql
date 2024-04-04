-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost:8889
-- Čas generovania: Št 04.Apr 2024, 10:30
-- Verzia serveru: 5.7.39
-- Verzia PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `bednarik3a`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `t_user`
--

CREATE TABLE `t_user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `email`) VALUES
(1, 'Ivanka', 'ivanka', 'f@fd.sk'),
(2, 'Roman', 'roman', 'r@r.sk'),
(3, 'jakub', 'jakub', 'jakub@gmail.sk'),
(4, 'marek', 'marek', 'marek@gmail.sk'),
(5, 'anicka', 'anicka', 'anica@gmail.sk'),
(6, 'viktor', '$2y$10$0Xru.Owq96YrJB1LncL0AOiBiw8tlFEIdB/T2D1P/HFCOpLjDDJle', 'viktor@gmail.sk'),
(7, 'r', '$2y$10$sE.vNNtYH0mAqzdAh6wK/urQZuJq3CnXK2qW3shE/Vi9iM1QkdtJe', 'r@g.sk');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
