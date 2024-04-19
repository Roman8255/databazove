-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost:8889
-- Čas generovania: Pi 19.Apr 2024, 12:43
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
-- Štruktúra tabuľky pre tabuľku `product`
--

CREATE TABLE `product` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `popis` varchar(500) NOT NULL,
  `cena` double NOT NULL,
  `hmotnost` double NOT NULL,
  `cesta_k_obrazku` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `product`
--

INSERT INTO `product` (`id`, `name`, `popis`, `cena`, `hmotnost`, `cesta_k_obrazku`) VALUES
(1, 'Ručný mixér', 'Výkonný mixér na prípravu smoothies a polievok.', 29.99, 1.2, '/produkty/DSC_5335.jpg'),
(2, 'Bežcovské tenisky', 'Kvalitné tenisky pre športové aktivity.', 49.99, 0.8, '/produkty/DSC_5336.jpg'),
(3, 'Kávovar', 'Moderný kávovar na prípravu lahodnej kávy.', 79.99, 2.5, '/produkty/DSC_5345.jpg'),
(4, 'Notebook', 'Výkonný notebook pre prácu a zábavu.', 899.99, 1.7, '/produkty/DSC_5346.jpg'),
(5, 'Slúchadlá', 'Bezdrôtové slúchadlá s vynikajúcim zvukom.', 129.99, 0.3, '/produkty/DSC_5348.jpg'),
(6, 'Futbalový míč', 'Odolný futbalový míč pre tréning a zábavu.', 19.99, 0.9, '/produkty/DSC_5349.jpg'),
(7, 'Horské kolo', 'Všestranné horské kolo pre dobrodružné výlety.', 349.99, 12.5, '/produkty/DSC_5354.jpg'),
(8, 'Záhradná hojdačka', 'Pohodlná hojdačka pre relaxáciu v záhrade.', 99.99, 6, '/produkty/DSC_5357.jpg'),
(9, 'Digitálny fotoaparát', 'Výkonný fotoaparát pre profesionálne fotografovanie.', 599.99, 0.8, '/produkty/DSC_5358.jpg'),
(10, 'Pracovný stôl', 'Štýlový pracovný stôl pre produktívne pracovné prostredie.', 149.99, 18, '/produkty/DSC_5537.jpg');

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
-- Indexy pre tabuľku `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pre tabuľku `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
