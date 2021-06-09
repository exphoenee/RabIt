-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Jún 09. 16:03
-- Kiszolgáló verziója: 10.4.16-MariaDB
-- PHP verzió: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `rabit`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rabit__advert`
--

CREATE TABLE `rabit__advert` (
  `advert_id` smallint(6) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `user_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `rabit__advert`
--

INSERT INTO `rabit__advert` (`advert_id`, `title`, `user_id`) VALUES
(4, 'Senior Mechanical Engineer', 59),
(6, 'What is Lorem Ipsum?', 15),
(7, 'Dolor Sit Amet!', 73),
(8, 'Senior Mechanical Engineer', 62),
(9, 'Dolor Sit Amet?', 15);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rabit__user`
--

CREATE TABLE `rabit__user` (
  `user_id` smallint(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `rabit__user`
--

INSERT INTO `rabit__user` (`user_id`, `name`) VALUES
(62, 'exphoenee@gmail.com'),
(73, 'Jancsika'),
(15, 'Pista'),
(60, 'Rozsomák'),
(59, 'Viktor Bozzay');

-- --------------------------------------------------------

--
-- A nézet helyettes szerkezete `rabit__users_adverts`
-- (Lásd alább az aktuális nézetet)
--
CREATE TABLE `rabit__users_adverts` (
`advert_id` smallint(6)
,`title` varchar(50)
,`name` varchar(50)
);

-- --------------------------------------------------------

--
-- Nézet szerkezete `rabit__users_adverts`
--
DROP TABLE IF EXISTS `rabit__users_adverts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rabit__users_adverts`  AS SELECT `rabit__advert`.`advert_id` AS `advert_id`, `rabit__advert`.`title` AS `title`, `rabit__user`.`name` AS `name` FROM (`rabit__advert` join `rabit__user` on(`rabit__advert`.`user_id` = `rabit__user`.`user_id`)) ;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `rabit__advert`
--
ALTER TABLE `rabit__advert`
  ADD PRIMARY KEY (`advert_id`),
  ADD KEY `fk_user_advert` (`user_id`) USING BTREE;

--
-- A tábla indexei `rabit__user`
--
ALTER TABLE `rabit__user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `rabit__advert`
--
ALTER TABLE `rabit__advert`
  MODIFY `advert_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `rabit__user`
--
ALTER TABLE `rabit__user`
  MODIFY `user_id` smallint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `rabit__advert`
--
ALTER TABLE `rabit__advert`
  ADD CONSTRAINT `fk_user_adver` FOREIGN KEY (`user_id`) REFERENCES `rabit__user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
