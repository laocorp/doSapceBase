-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Sze 07. 18:22
-- Kiszolgáló verziója: 10.4.24-MariaDB
-- PHP verzió: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `pve`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin_category`
--

CREATE TABLE `admin_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `cc` longtext DEFAULT NULL,
  `active` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `admin_category`
--

INSERT INTO `admin_category` (`id`, `category`, `cc`, `active`) VALUES
(1, 'Manage Events', 'events', '1'),
(113, 'Manage Users', 'users', '1'),
(114, 'View Logs (Founder)', 'logs', '1'),
(115, 'Add Items', 'items', '1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin_log`
--

CREATE TABLE `admin_log` (
  `id` int(11) NOT NULL,
  `adminId` varchar(255) DEFAULT NULL,
  `toUserId` int(11) DEFAULT NULL,
  `logComplet` longtext DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `admin_log`
--

INSERT INTO `admin_log` (`id`, `adminId`, `toUserId`, `logComplet`, `date`) VALUES
(1, '1', 0, 'The admin \"Admin\" has stopped the event \"Spaceball\"', '20-07-2022 10:22:01');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bank_log`
--

CREATE TABLE `bank_log` (
  `id` int(11) NOT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `idClan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bugreport`
--

CREATE TABLE `bugreport` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` mediumtext NOT NULL,
  `usersid` int(11) NOT NULL,
  `fecha` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `buyed_titles`
--

CREATE TABLE `buyed_titles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `buyed_titles`
--

INSERT INTO `buyed_titles` (`id`, `title`, `userId`, `time`) VALUES
(1, 'hercules', '4', '1658509587'),
(2, 'muki', '5', '1658509871'),
(3, 'leon', '5', '1658510073');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categoryupgradesystem`
--

CREATE TABLE `categoryupgradesystem` (
  `id` int(11) NOT NULL,
  `cat` varchar(255) DEFAULT NULL,
  `active` varchar(255) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `categoryupgradesystem`
--

INSERT INTO `categoryupgradesystem` (`id`, `cat`, `active`) VALUES
(1, 'Lasers', '1'),
(2, 'Shields', '1'),
(3, 'Drones', '0'),
(4, 'Rocket launchers', '0');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `chat_log`
--

CREATE TABLE `chat_log` (
  `id` int(11) NOT NULL,
  `playerName` varchar(255) DEFAULT NULL,
  `playerId` int(11) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `chat_log`
--

INSERT INTO `chat_log` (`id`, `playerName`, `playerId`, `content`, `date`) VALUES
(1, 'tester1', 4, '/start_royal', '21.07.2022 04.44.42'),
(2, 'tester1', 4, '/start_company', '21.07.2022 04.49.22'),
(3, 'tester1', 4, '/start_emperator', '21.07.2022 05.06.09'),
(4, 'Adminka', 10, '/start-invasion', '31.07.2022 02.11.31'),
(5, 'Adminka', 10, '/start-invasion', '31.07.2022 02.12.13'),
(6, 'Adminka', 10, '/start-invasion', '31.07.2022 02.15.17'),
(7, 'Admin', 1, '/start_kristallon', '23.08.2022 02.27.15'),
(8, 'Admin', 1, 'start_kristallon', '23.08.2022 02.32.17'),
(9, 'Admin', 1, '/start_kristallon', '23.08.2022 02.32.40'),
(10, 'Admin', 1, '/start_kristallon', '23.08.2022 02.33.46'),
(11, 'Admin', 1, '/start_kristallon', '23.08.2022 02.41.55'),
(12, 'Admin', 1, '/start_kristallon', '23.08.2022 02.42.57'),
(13, 'Admin', 1, '/start_kristallon', '23.08.2022 05.58.19'),
(14, 'Admin', 1, '/start_kristallon', '23.08.2022 05.59.04'),
(15, 'Admin', 1, '/damage 1000000', '23.08.2022 06.01.17'),
(16, 'Admin', 1, '/damage+1000000', '23.08.2022 06.02.12'),
(17, 'Admin', 1, '/damage+ 10000000', '23.08.2022 06.02.34'),
(18, 'Admin', 1, '/start_royal', '23.08.2022 07.03.29');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `chat_permissions`
--

CREATE TABLE `chat_permissions` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- A tábla adatainak kiíratása `chat_permissions`
--

INSERT INTO `chat_permissions` (`id`, `userId`, `type`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `chat_rooms`
--

CREATE TABLE `chat_rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isAdminRoom` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `discordannounces`
--

CREATE TABLE `discordannounces` (
  `id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `idMsg` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `html_code` varchar(2000) COLLATE utf8_bin NOT NULL,
  `active` int(11) NOT NULL,
  `event_code` varchar(10) COLLATE utf8_bin NOT NULL,
  `eventoname` varchar(9999) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- A tábla adatainak kiíratása `event`
--

INSERT INTO `event` (`id`, `html_code`, `active`, `event_code`, `eventoname`) VALUES
(1, '', 0, '', 'Spaceball'),
(2, '', 1, '', 'B.royal'),
(3, '', 0, '', 'Jpb'),
(4, '', 0, '', 'Invasion'),
(5, '', 0, '', 'Demaner'),
(6, '', 0, '', 'Meteorit'),
(7, '', 0, '', 'Emperator'),
(8, '', 0, '', 'Team'),
(9, '', 0, '', 'Hitac'),
(10, '', 1, '', 'Kristallon');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `event_coins`
--

CREATE TABLE `event_coins` (
  `id` int(11) NOT NULL,
  `coins` int(11) NOT NULL,
  `userId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- A tábla adatainak kiíratása `event_coins`
--

INSERT INTO `event_coins` (`id`, `coins`, `userId`) VALUES
(1, 345, 1),
(2, 50, 2),
(3, 221, 3),
(4, 2280, 4),
(5, 49700, 5),
(6, 400, 6),
(7, 50, 7),
(8, 529, 8),
(9, 50, 9),
(10, 454, 10),
(11, 50, 11),
(12, 0, 12),
(13, 270, 13),
(14, 50, 14),
(15, 50, 15),
(16, 50, 16),
(17, 3712, 17),
(18, 50, 18),
(19, 50, 19);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gg_log`
--

CREATE TABLE `gg_log` (
  `id` int(11) NOT NULL,
  `log` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `gg_log`
--

INSERT INTO `gg_log` (`id`, `log`, `date`, `userId`) VALUES
(1, 'Earned 255 ucb ammo', '1657899507', 1),
(2, 'Earned 475 mcb50 ammo', '1657899507', 1),
(3, 'Earned 3 parts of Alpha gate', '1657899508', 1),
(4, 'Earned 450 mcb25 ammo', '1657899515', 1),
(5, 'Earned 255 ucb ammo', '1657899515', 1),
(6, 'Earned 475 mcb50 ammo', '1657899516', 1),
(7, 'Earned 150 rb214 ammo', '1657899516', 1),
(8, 'Earned 1 parts of Alpha gate', '1657899516', 1),
(9, 'Earned 475 mcb50 ammo', '1657899516', 1),
(10, 'Earned 1 parts of Alpha gate', '1657899516', 1),
(11, 'Earned 1 parts of Alpha gate', '1657899517', 1),
(12, 'Earned 150 rb214 ammo', '1657899517', 1),
(13, 'Earned 350 sab ammo', '1657899517', 1),
(14, 'Earned 350 sab ammo', '1657899517', 1),
(15, 'Earned 1 parts of Alpha gate', '1657899517', 1),
(16, 'Earned 450 mcb25 ammo', '1657899517', 1),
(17, 'Earned 475 mcb50 ammo', '1657899518', 1),
(18, 'Earned 3 parts of Alpha gate', '1657899518', 1),
(19, 'Earned 150 rsb ammo', '1657899518', 1),
(20, 'Earned 3 parts of Alpha gate', '1657899518', 1),
(21, 'Earned 255 ucb ammo', '1657899519', 1),
(22, 'Earned 475 mcb50 ammo', '1657899519', 1),
(23, 'Earned 450 mcb25 ammo', '1657899519', 1),
(24, 'Earned 3 parts of Alpha gate', '1657899519', 1),
(25, 'Earned 255 ucb ammo', '1657899519', 1),
(26, 'Earned 450 mcb25 ammo', '1657899520', 1),
(27, 'Earned 350 sab ammo', '1657899520', 1),
(28, 'Earned 150 rsb ammo', '1657899520', 1),
(29, 'Earned 350 sab ammo', '1657899520', 1),
(30, 'Earned 150 rb214 ammo', '1657899520', 1),
(31, 'Earned 255 ucb ammo', '1657899520', 1),
(32, 'Earned 150 rb214 ammo', '1657899521', 1),
(33, 'Earned 3 parts of Alpha gate', '1657899521', 1),
(34, 'Earned 65 plt3030 ammo', '1657899521', 1),
(35, 'Earned 475 mcb50 ammo', '1657899521', 1),
(36, 'Earned 475 mcb50 ammo', '1657899521', 1),
(37, 'Earned 350 sab ammo', '1657899522', 1),
(38, 'Earned 3 parts of Alpha gate', '1657899522', 1),
(39, 'Earned 1 parts of Alpha gate', '1657899522', 1),
(40, 'Earned 350 sab ammo', '1657899522', 1),
(41, 'Earned 150 rb214 ammo', '1657899522', 1),
(42, 'Earned 5 parts of Alpha gate', '1657899523', 1),
(43, 'Earned 350 sab ammo', '1657899523', 1),
(44, 'Earned 450 mcb25 ammo', '1657899523', 1),
(45, 'Earned 255 ucb ammo', '1657899523', 1),
(46, 'Earned 255 ucb ammo', '1657899523', 1),
(47, 'Earned 255 ucb ammo', '1657899523', 1),
(48, 'Earned 1 parts of Alpha gate', '1657899524', 1),
(49, 'Earned 150 rb214 ammo', '1657899524', 1),
(50, 'Earned 475 mcb50 ammo', '1657899524', 1),
(51, 'Earned 255 ucb ammo', '1657899524', 1),
(52, 'Earned 475 mcb50 ammo', '1657899524', 1),
(53, 'Earned 255 ucb ammo', '1657899525', 1),
(54, 'Earned 255 ucb ammo', '1657899525', 1),
(55, 'Earned 450 mcb25 ammo', '1657899525', 1),
(56, 'Earned 255 ucb ammo', '1657899525', 1),
(57, 'Earned 255 ucb ammo', '1657899526', 1),
(58, 'Earned 150 rb214 ammo', '1657899526', 1),
(59, 'Earned 350 sab ammo', '1657899526', 1),
(60, 'Earned 1 parts of Alpha gate', '1657899526', 1),
(61, 'Earned 475 mcb50 ammo', '1657899526', 1),
(62, 'Earned 1 parts of Alpha gate', '1657899527', 1),
(63, 'Earned 255 ucb ammo', '1657899527', 1),
(64, 'Earned 450 mcb25 ammo', '1657899527', 1),
(65, 'Earned 475 mcb50 ammo', '1657899527', 1),
(66, 'Earned 255 ucb ammo', '1657899527', 1),
(67, 'Earned 65 plt3030 ammo', '1657899527', 1),
(68, 'Earned 150 rb214 ammo', '1657899528', 1),
(69, 'Earned 1 parts of Alpha gate', '1657899528', 1),
(70, 'Earned 1 parts of Alpha gate', '1657899528', 1),
(71, 'Earned 3 parts of Alpha gate. Sucesfully unlocked gate.', '1657899528', 1),
(72, 'Earned 1 parts of Delta gate', '1658082226', 1),
(73, 'Earned 255 ucb ammo', '1658082228', 1),
(74, 'Earned 150 rb214 ammo', '1658082234', 1),
(75, 'Earned 5 parts of Delta gate', '1658082235', 1),
(76, 'Earned 150 rb214 ammo', '1658082454', 1),
(77, 'Earned 255 ucb ammo', '1658082456', 1),
(78, 'Earned 255 ucb ammo', '1658082457', 1),
(79, 'Earned 475 mcb50 ammo', '1658082457', 1),
(80, 'Earned 3 parts of Lambda gate', '1658082458', 1),
(81, 'Earned 1 parts of Lambda gate', '1658082461', 1),
(82, 'Earned 475 mcb50 ammo', '1658082463', 1),
(83, 'Earned 475 mcb50 ammo', '1658082464', 1),
(84, 'Earned 3 parts of Lambda gate', '1658082465', 1),
(85, 'Earned 150 rsb ammo', '1658082467', 1),
(86, 'Earned 255 ucb ammo', '1658082468', 1),
(87, 'Earned 255 ucb ammo', '1658334495', 1),
(88, 'Earned 5 parts of Alpha gate', '1658334495', 1),
(89, 'Earned 3 parts of Alpha gate', '1658334496', 1),
(90, 'Earned 255 ucb ammo', '1658334496', 1),
(91, 'Earned 255 ucb ammo', '1658334496', 1),
(92, 'Earned 255 ucb ammo', '1658334496', 1),
(93, 'Earned 150 rb214 ammo', '1658334497', 1),
(94, 'Earned 450 mcb25 ammo', '1658334497', 1),
(95, 'Earned 150 rsb ammo', '1658334497', 1),
(96, 'Earned 475 mcb50 ammo', '1658334497', 1),
(97, 'Earned 150 rsb ammo', '1658334497', 1),
(98, 'Earned 3 parts of Alpha gate', '1658334498', 1),
(99, 'Earned 150 rb214 ammo', '1658334498', 1),
(100, 'Earned 150 rb214 ammo', '1658334498', 1),
(101, 'Earned 255 ucb ammo', '1658334498', 1),
(102, 'Earned 475 mcb50 ammo', '1658334498', 1),
(103, 'Earned 150 rb214 ammo', '1658334498', 1),
(104, 'Earned 350 sab ammo', '1658334499', 1),
(105, 'Earned 65 plt3030 ammo', '1658334499', 1),
(106, 'Earned 1 parts of Alpha gate', '1658334499', 1),
(107, 'Earned 150 rsb ammo', '1658334499', 1),
(108, 'Earned 1 parts of Alpha gate', '1658334499', 1),
(109, 'Earned 475 mcb50 ammo', '1658334500', 1),
(110, 'Earned 150 rb214 ammo', '1658334500', 1),
(111, 'Earned 475 mcb50 ammo', '1658334500', 1),
(112, 'Earned 255 ucb ammo', '1658334500', 1),
(113, 'Earned 5 parts of Alpha gate', '1658334500', 1),
(114, 'Earned 1 parts of Alpha gate', '1658334500', 1),
(115, 'Earned 150 rsb ammo', '1658334501', 1),
(116, 'Earned 475 mcb50 ammo', '1658334501', 1),
(117, 'Earned 5 parts of Alpha gate', '1658334501', 1),
(118, 'Earned 150 rsb ammo', '1658334501', 1),
(119, 'Earned 475 mcb50 ammo', '1658334501', 1),
(120, 'Earned 3 parts of Alpha gate', '1658334502', 1),
(121, 'Earned 150 rb214 ammo', '1658334502', 1),
(122, 'Earned 475 mcb50 ammo', '1658334502', 1),
(123, 'Earned 1 parts of Alpha gate', '1658334502', 1),
(124, 'Earned 1 parts of Alpha gate', '1658334502', 1),
(125, 'Earned 475 mcb50 ammo', '1658334503', 1),
(126, 'Earned 255 ucb ammo', '1658334503', 1),
(127, 'Earned 255 ucb ammo', '1658334503', 1),
(128, 'Earned 350 sab ammo', '1658334503', 1),
(129, 'Earned 255 ucb ammo', '1658334503', 1),
(130, 'Earned 1 parts of Alpha gate', '1658334504', 1),
(131, 'Earned 350 sab ammo', '1658334504', 1),
(132, 'Earned 1 parts of Alpha gate', '1658334504', 1),
(133, 'Earned 1 parts of Alpha gate', '1658334504', 1),
(134, 'Earned 450 mcb25 ammo', '1658334505', 1),
(135, 'Earned 1 parts of Alpha gate', '1658334505', 1),
(136, 'Earned 350 sab ammo', '1658334505', 1),
(137, 'Earned 1 parts of Alpha gate. Sucesfully unlocked gate.', '1658334505', 1),
(138, 'Earned 65 plt3030 ammo', '1658346862', 1),
(139, 'Earned 1 parts of Lambda gate', '1658346862', 1),
(140, 'Earned 3 parts of Lambda gate', '1658346863', 1),
(141, 'Earned 3 parts of Lambda gate', '1658346863', 1),
(142, 'Earned 150 rb214 ammo', '1658346863', 1),
(143, 'Earned 1 parts of Lambda gate', '1658346863', 1),
(144, 'Earned 255 ucb ammo', '1658346863', 1),
(145, 'Earned 475 mcb50 ammo', '1658346864', 1),
(146, 'Earned 3 parts of Lambda gate', '1658346864', 1),
(147, 'Earned 150 rsb ammo', '1658346864', 1),
(148, 'Earned 450 mcb25 ammo', '1658346864', 1),
(149, 'Earned 65 plt3030 ammo', '1658346864', 1),
(150, 'Earned 350 sab ammo', '1658346865', 1),
(151, 'Earned 350 sab ammo', '1658346865', 1),
(152, 'Earned 475 mcb50 ammo', '1658346865', 1),
(153, 'Earned 475 mcb50 ammo', '1658346865', 1),
(154, 'Earned 450 mcb25 ammo', '1658346866', 1),
(155, 'Earned 1 parts of Lambda gate', '1658346866', 1),
(156, 'Earned 1 parts of Lambda gate', '1658346866', 1),
(157, 'Earned 1 parts of Lambda gate', '1658346866', 1),
(158, 'Earned 475 mcb50 ammo', '1658346866', 1),
(159, 'Earned 1 parts of Lambda gate', '1658346867', 1),
(160, 'Earned 1 parts of Lambda gate', '1658346867', 1),
(161, 'Earned 1 parts of Lambda gate', '1658346868', 1),
(162, 'Earned 475 mcb50 ammo', '1658346868', 1),
(163, 'Earned 350 sab ammo', '1658346869', 1),
(164, 'Earned 475 mcb50 ammo', '1658346869', 1),
(165, 'Earned 150 rsb ammo', '1658346869', 1),
(166, 'Earned 255 ucb ammo', '1658346869', 1),
(167, 'Earned 475 mcb50 ammo', '1658346870', 1),
(168, 'Earned 255 ucb ammo', '1658346870', 1),
(169, 'Earned 150 rb214 ammo', '1658346870', 1),
(170, 'Earned 475 mcb50 ammo', '1658346870', 1),
(171, 'Earned 150 rsb ammo', '1658346870', 1),
(172, 'Earned 475 mcb50 ammo', '1658346871', 1),
(173, 'Earned 255 ucb ammo', '1658346871', 1),
(174, 'Earned 475 mcb50 ammo', '1658346871', 1),
(175, 'Earned 475 mcb50 ammo', '1658346871', 1),
(176, 'Earned 475 mcb50 ammo', '1658346871', 1),
(177, 'Earned 450 mcb25 ammo', '1658346872', 1),
(178, 'Earned 475 mcb50 ammo', '1658346872', 1),
(179, 'Earned 150 rsb ammo', '1658346872', 1),
(180, 'Earned 255 ucb ammo', '1658346872', 1),
(181, 'Earned 475 mcb50 ammo', '1658346872', 1),
(182, 'Earned 255 ucb ammo', '1658346872', 1),
(183, 'Earned 150 rsb ammo', '1658346873', 1),
(184, 'Earned 255 ucb ammo', '1658346873', 1),
(185, 'Earned 450 mcb25 ammo', '1658346873', 1),
(186, 'Earned 255 ucb ammo', '1658346873', 1),
(187, 'Earned 350 sab ammo', '1658346874', 1),
(188, 'Earned 255 ucb ammo', '1658346874', 1),
(189, 'Earned 450 mcb25 ammo', '1658346874', 1),
(190, 'Earned 475 mcb50 ammo', '1658346874', 1),
(191, 'Earned 1 parts of Lambda gate', '1658346874', 1),
(192, 'Earned 475 mcb50 ammo', '1658346875', 1),
(193, 'Earned 65 plt3030 ammo', '1658346875', 1),
(194, 'Earned 255 ucb ammo', '1658346875', 1),
(195, 'Earned 255 ucb ammo', '1658346875', 1),
(196, 'Earned 1 parts of Lambda gate', '1658346875', 1),
(197, 'Earned 350 sab ammo', '1658346876', 1),
(198, 'Earned 150 rb214 ammo', '1658346876', 1),
(199, 'Earned 255 ucb ammo', '1658346876', 1),
(200, 'Earned 1 parts of Lambda gate', '1658346876', 1),
(201, 'Earned 255 ucb ammo', '1658346876', 1),
(202, 'Earned 475 mcb50 ammo', '1658346877', 1),
(203, 'Earned 150 rb214 ammo', '1658346877', 1),
(204, 'Earned 450 mcb25 ammo', '1658346877', 1),
(205, 'Earned 3 parts of Lambda gate', '1658346877', 1),
(206, 'Earned 475 mcb50 ammo', '1658346877', 1),
(207, 'Earned 65 plt3030 ammo', '1658346878', 1),
(208, 'Earned 150 rb214 ammo', '1658346878', 1),
(209, 'Earned 1 parts of Lambda gate', '1658346878', 1),
(210, 'Earned 255 ucb ammo', '1658346878', 1),
(211, 'Earned 3 parts of Lambda gate', '1658346878', 1),
(212, 'Earned 5 parts of Lambda gate', '1658346879', 1),
(213, 'Earned 1 parts of Lambda gate', '1658346879', 1),
(214, 'Earned 1 parts of Lambda gate', '1658346879', 1),
(215, 'Earned 475 mcb50 ammo', '1658346879', 1),
(216, 'Earned 1 parts of Lambda gate', '1658346879', 1),
(217, 'Earned 1 parts of Lambda gate', '1658346880', 1),
(218, 'Earned 150 rb214 ammo', '1658346880', 1),
(219, 'Earned 65 plt3030 ammo', '1658346880', 1),
(220, 'Earned 3 parts of Lambda gate. Sucesfully unlocked gate.', '1658346880', 1),
(221, 'Buyed 1 live in Lambda gate', '1658347469', 1),
(222, 'Buyed 1 live in Lambda gate', '1658347476', 1),
(223, 'Buyed 1 live in Lambda gate', '1658347484', 1),
(224, 'Earned 255 ucb ammo', '1658503325', 4),
(225, 'Earned 255 ucb ammo', '1658503327', 4),
(226, 'Earned 1 parts of Alpha gate', '1658503331', 4),
(227, 'Earned 150 sab ammo', '1658503889', 4),
(228, 'Earned 1 parts of Alpha gate', '1658503900', 4),
(229, 'Earned 1 parts of Alpha gate', '1658503901', 4),
(230, 'Earned 5 parts of Alpha gate', '1658503902', 4),
(231, 'Earned 75 mcb50 ammo', '1658503903', 4),
(232, 'Earned 1 parts of Alpha gate', '1658503904', 4),
(233, 'Earned 1 parts of Alpha gate', '1658503908', 4),
(234, 'Earned 100 mcb25 ammo', '1658503909', 4),
(235, 'Earned 215 mcb50 ammo', '1658503910', 4),
(236, 'Earned 215 mcb50 ammo', '1658503911', 4),
(237, 'Earned 100 mcb25 ammo', '1658503912', 4),
(238, 'Earned 75 mcb50 ammo', '1658503913', 4),
(239, 'Earned 1 parts of Alpha gate', '1658503914', 4),
(240, 'Earned 75 mcb50 ammo', '1658503915', 4),
(241, 'Earned 150 sab ammo', '1658503917', 4),
(242, 'Earned 75 mcb50 ammo', '1658503918', 4),
(243, 'Earned 25 plt21 ammo', '1658503919', 4),
(244, 'Earned 100 mcb25 ammo', '1658503920', 4),
(245, 'Earned 150 sab ammo', '1658503922', 4),
(246, 'Earned 150 sab ammo', '1658503923', 4),
(247, 'Earned 25 plt21 ammo', '1658503925', 4),
(248, 'Earned 215 mcb50 ammo', '1658503926', 4),
(249, 'Earned 140 mcb25 ammo', '1658503927', 4),
(250, 'Earned 1 parts of Alpha gate', '1658503928', 4),
(251, 'Earned 150 sab ammo', '1658503929', 4),
(252, 'Earned 225 sab ammo', '1658503930', 4),
(253, 'Earned 25 plt21 ammo', '1658503931', 4),
(254, 'Earned 140 mcb25 ammo', '1658503932', 4),
(255, 'Earned 3 parts of Alpha gate', '1658503933', 4),
(256, 'Earned 1 parts of Alpha gate', '1658503934', 4),
(257, 'Earned 1 parts of Alpha gate', '1658503935', 4),
(258, 'Earned 25 plt21 ammo', '1658503936', 4),
(259, 'Earned 215 mcb50 ammo', '1658503936', 4),
(260, 'Earned 215 mcb50 ammo', '1658503937', 4),
(261, 'Earned 140 mcb25 ammo', '1658503938', 4),
(262, 'Earned 3 parts of Alpha gate', '1658503938', 4),
(263, 'Earned 100 mcb25 ammo', '1658503940', 4),
(264, 'Earned 1 parts of Alpha gate', '1658503941', 4),
(265, 'Earned 225 sab ammo', '1658503942', 4),
(266, 'Earned 150 sab ammo', '1658503943', 4),
(267, 'Earned 3 parts of Alpha gate', '1658503944', 4),
(268, 'Earned 215 mcb50 ammo', '1658503945', 4),
(269, 'Earned 1 parts of Alpha gate', '1658503946', 4),
(270, 'Earned 1 parts of Alpha gate', '1658503947', 4),
(271, 'Earned 225 sab ammo', '1658503947', 4),
(272, 'Earned 75 mcb50 ammo', '1658503948', 4),
(273, 'Earned 5 parts of Alpha gate', '1658503948', 4),
(274, 'Earned 25 plt21 ammo', '1658503948', 4),
(275, 'Earned 25 plt21 ammo', '1658503949', 4),
(276, 'Earned 225 sab ammo', '1658503949', 4),
(277, 'Earned 215 mcb50 ammo', '1658503949', 4),
(278, 'Earned 5 parts of Alpha gate. Sucesfully unlocked gate.', '1658503950', 4),
(279, 'Earned 100 mcb25 ammo', '1658504385', 4),
(280, 'Earned 85 mcb25 ammo', '1658504402', 4),
(281, 'Earned 130 mcb25 ammo', '1658504418', 4),
(282, 'Earned 1 parts of Beta gate', '1658504442', 4),
(283, 'Earned 85 mcb25 ammo', '1658504454', 4),
(284, 'Earned 2 parts of Beta gate', '1658504463', 4),
(285, 'Earned 30  ammo', '1658504471', 4),
(286, 'Earned 100 mcb25 ammo', '1658504474', 4),
(287, 'Earned 100 mcb25 ammo', '1658504503', 4),
(288, 'Earned 100 mcb25 ammo', '1658504504', 4),
(289, 'Earned 25 plt21 ammo', '1658504507', 4),
(290, 'Earned 50 sab ammo', '1658504515', 4),
(291, 'Earned 1 parts of Beta gate', '1658504525', 4),
(292, 'Earned 140 mcb25 ammo', '1658504527', 4),
(293, 'Earned 75 mcb50 ammo', '1658504538', 4),
(294, 'Earned 50 sab ammo', '1658504544', 4),
(295, 'Earned 140 mcb25 ammo', '1658504551', 4),
(296, 'Earned 2 parts of Beta gate', '1658504567', 4),
(297, 'Earned 100 mcb25 ammo', '1658504575', 4),
(298, 'Earned 85 mcb25 ammo', '1658504576', 4),
(299, 'Earned 140 mcb25 ammo', '1658504581', 4),
(300, 'Earned 215 mcb50 ammo', '1658504583', 4),
(301, 'Earned 3 parts of Beta gate', '1658504589', 4),
(302, 'Earned 100 mcb25 ammo', '1658504594', 4),
(303, 'Earned 3 parts of Beta gate', '1658504599', 4),
(304, 'Earned 150 sab ammo', '1658504600', 4),
(305, 'Earned 150 sab ammo', '1658504602', 4),
(306, 'Earned 125 mcb50 ammo', '1658504602', 4),
(307, 'Earned 30  ammo', '1658504603', 4),
(308, 'Earned 50 sab ammo', '1658504604', 4),
(309, 'Earned 215 mcb50 ammo', '1658504605', 4),
(310, 'Earned 100 mcb25 ammo', '1658504607', 4),
(311, 'Earned 125 mcb50 ammo', '1658504608', 4),
(312, 'Earned 100 mcb25 ammo', '1658504608', 4),
(313, 'Earned 50 sab ammo', '1658504609', 4),
(314, 'Earned 225 sab ammo', '1658504610', 4),
(315, 'Earned 125 mcb50 ammo', '1658504610', 4),
(316, 'Earned 100 mcb25 ammo', '1658504611', 4),
(317, 'Earned 125 mcb50 ammo', '1658504612', 4),
(318, 'Earned 100 mcb25 ammo', '1658504612', 4),
(319, 'Earned 100 mcb25 ammo', '1658504613', 4),
(320, 'Earned 150 sab ammo', '1658504614', 4),
(321, 'Earned 85 mcb25 ammo', '1658504614', 4),
(322, 'Earned 50 sab ammo', '1658504615', 4),
(323, 'Earned 215 mcb50 ammo', '1658504616', 4),
(324, 'Earned 125 mcb50 ammo', '1658504616', 4),
(325, 'Earned 100 mcb25 ammo', '1658504617', 4),
(326, 'Earned 215 mcb50 ammo', '1658504618', 4),
(327, 'Earned 150 sab ammo', '1658504618', 4),
(328, 'Earned 130 mcb25 ammo', '1658504619', 4),
(329, 'Earned 125 mcb50 ammo', '1658504619', 4),
(330, 'Earned 1 parts of Beta gate', '1658504620', 4),
(331, 'Earned 85 mcb25 ammo', '1658504621', 4),
(332, 'Earned 225 sab ammo', '1658504622', 4),
(333, 'Earned 50 sab ammo', '1658504623', 4),
(334, 'Earned 100 mcb25 ammo', '1658504623', 4),
(335, 'Earned 150 sab ammo', '1658504624', 4),
(336, 'Earned 3 parts of Beta gate', '1658504624', 4),
(337, 'Earned 3 parts of Beta gate', '1658504625', 4),
(338, 'Earned 130 mcb25 ammo', '1658504626', 4),
(339, 'Earned 140 mcb25 ammo', '1658504627', 4),
(340, 'Earned 100 mcb25 ammo', '1658504627', 4),
(341, 'Earned 25 plt21 ammo', '1658504628', 4),
(342, 'Earned 50 sab ammo', '1658504635', 4),
(343, 'Earned 125 mcb50 ammo', '1658504636', 4),
(344, 'Earned 110 sab ammo', '1658504637', 4),
(345, 'Earned 110 sab ammo', '1658504638', 4),
(346, 'Earned 1 parts of Beta gate', '1658504638', 4),
(347, 'Earned 215 mcb50 ammo', '1658504639', 4),
(348, 'Earned 100 mcb25 ammo', '1658504647', 4),
(349, 'Earned 215 mcb50 ammo', '1658504647', 4),
(350, 'Earned 75 mcb50 ammo', '1658504648', 4),
(351, 'Earned 130 mcb25 ammo', '1658504649', 4),
(352, 'Earned 215 mcb50 ammo', '1658504650', 4),
(353, 'Earned 3 parts of Beta gate', '1658504651', 4),
(354, 'Earned 3 parts of Beta gate', '1658504652', 4),
(355, 'Earned 3 parts of Beta gate', '1658504653', 4),
(356, 'Earned 140 mcb25 ammo', '1658504653', 4),
(357, 'Earned 50 sab ammo', '1658504654', 4),
(358, 'Earned 85 mcb25 ammo', '1658504654', 4),
(359, 'Earned 30  ammo', '1658504655', 4),
(360, 'Earned 215 mcb50 ammo', '1658504656', 4),
(361, 'Earned 100 mcb25 ammo', '1658504861', 4),
(362, 'Earned 140 mcb25 ammo', '1658504862', 4),
(363, 'Earned 2 parts of Beta gate', '1658504863', 4),
(364, 'Earned 215 mcb50 ammo', '1658504863', 4),
(365, 'Earned 30  ammo', '1658504869', 4),
(366, 'Earned 1 parts of Beta gate', '1658504871', 4),
(367, 'Earned 1 parts of Beta gate', '1658504873', 4),
(368, 'Earned 150 sab ammo', '1658504875', 4),
(369, 'Earned 100 mcb25 ammo', '1658504876', 4),
(370, 'Earned 215 mcb50 ammo', '1658504876', 4),
(371, 'Earned 215 mcb50 ammo', '1658504877', 4),
(372, 'Earned 85 mcb25 ammo', '1658504877', 4),
(373, 'Earned 225 sab ammo', '1658504878', 4),
(374, 'Earned 45 pld ammo', '1658504879', 4),
(375, 'Earned 215 mcb50 ammo', '1658504879', 4),
(376, 'Earned 50 sab ammo', '1658504947', 4),
(377, 'Earned 215 mcb50 ammo', '1658504948', 4),
(378, 'Earned 10 pld ammo', '1658504949', 4),
(379, 'Earned 225 sab ammo', '1658504951', 4),
(380, 'Earned 115 mcb50 ammo', '1658504952', 4),
(381, 'Earned 85 mcb25 ammo', '1658504953', 4),
(382, 'Earned 150 sab ammo', '1658504954', 4),
(383, 'Earned 35  ammo', '1658504955', 4),
(384, 'Earned 2 parts of Beta gate', '1658504958', 4),
(385, 'Earned 85 mcb25 ammo', '1658505045', 4),
(386, 'Earned 150 sab ammo', '1658505046', 4),
(387, 'Earned 100 mcb25 ammo', '1658505046', 4),
(388, 'Earned 140 mcb25 ammo', '1658505047', 4),
(389, 'Earned 25 plt21 ammo', '1658505048', 4),
(390, 'Earned 215 mcb50 ammo', '1658505057', 4),
(391, 'Earned 100 mcb25 ammo', '1658505058', 4),
(392, 'Earned 25 plt21 ammo', '1658505059', 4),
(393, 'Earned 215 mcb50 ammo', '1658505065', 4),
(394, 'Earned 100 mcb25 ammo', '1658505065', 4),
(395, 'Earned 140 mcb25 ammo', '1658505066', 4),
(396, 'Earned 25 plt21 ammo', '1658505067', 4),
(397, 'Earned 3 parts of Beta gate', '1658505078', 4),
(398, 'Earned 50 sab ammo', '1658505079', 4),
(399, 'Earned 3 parts of Beta gate', '1658505080', 4),
(400, 'Earned 100 mcb25 ammo', '1658505081', 4),
(401, 'Earned 2 parts of Beta gate', '1658505082', 4),
(402, 'Earned 10 pld ammo', '1658505084', 4),
(403, 'Earned 215 mcb50 ammo', '1658505085', 4),
(404, 'Earned 215 mcb50 ammo', '1658505086', 4),
(405, 'Earned 35 plt21 ammo', '1658505087', 4),
(406, 'Earned 2 parts of Beta gate', '1658505101', 4),
(407, 'Earned 50 sab ammo', '1658505102', 4),
(408, 'Earned 100 mcb25 ammo', '1658505104', 4),
(409, 'Earned 50 sab ammo', '1658505105', 4),
(410, 'Earned 50 sab ammo', '1658505106', 4),
(411, 'Earned 3 parts of Beta gate. Sucesfully unlocked gate.', '1658505107', 4),
(412, 'Earned 100 mcb25 ammo', '1658505117', 4),
(413, 'Earned 1 parts of Gamma gate', '1658505119', 4),
(414, 'Earned 100 mcb25 ammo', '1658505120', 4),
(415, 'Earned 10 pld ammo', '1658505122', 4),
(416, 'Earned 115 mcb50 ammo', '1658505124', 4),
(417, 'Earned 1 parts of Gamma gate', '1658505137', 4),
(418, 'Earned 150 sab ammo', '1658505138', 4),
(419, 'Earned 1 parts of Gamma gate', '1658505138', 4),
(420, 'Earned 75 mcb50 ammo', '1658505140', 4),
(421, 'Earned 1 parts of Gamma gate', '1658505141', 4),
(422, 'Earned 25 plt21 ammo', '1658505142', 4),
(423, 'Earned 75 mcb50 ammo', '1658505143', 4),
(424, 'Earned 215 mcb50 ammo', '1658505144', 4),
(425, 'Earned 25 plt21 ammo', '1658505148', 4),
(426, 'Earned 1 parts of Gamma gate', '1658505154', 4),
(427, 'Earned 75 mcb50 ammo', '1658505154', 4),
(428, 'Earned 85 mcb25 ammo', '1658505155', 4),
(429, 'Earned 1 parts of Gamma gate', '1658505156', 4),
(430, 'Earned 100 mcb25 ammo', '1658505157', 4),
(431, 'Earned 215 mcb50 ammo', '1658505158', 4),
(432, 'Earned 115 mcb50 ammo', '1658505160', 4),
(433, 'Earned 215 mcb50 ammo', '1658505173', 4),
(434, 'Earned 140 mcb25 ammo', '1658505174', 4),
(435, 'Earned 100 mcb25 ammo', '1658505174', 4),
(436, 'Earned 75 mcb50 ammo', '1658505174', 4),
(437, 'Earned 150 sab ammo', '1658505174', 4),
(438, 'Earned 1 parts of Gamma gate', '1658505174', 4),
(439, 'Earned 85 mcb25 ammo', '1658505175', 4),
(440, 'Earned 215 mcb50 ammo', '1658505175', 4),
(441, 'Earned 215 mcb50 ammo', '1658505175', 4),
(442, 'Earned 10 pld ammo', '1658505175', 4),
(443, 'Earned 225 sab ammo', '1658505175', 4),
(444, 'Earned 115 mcb50 ammo', '1658505175', 4),
(445, 'Earned 10 pld ammo', '1658505176', 4),
(446, 'Earned 150 sab ammo', '1658505176', 4),
(447, 'Earned 140 mcb25 ammo', '1658505176', 4),
(448, 'Earned 150 sab ammo', '1658505176', 4),
(449, 'Earned 1 parts of Gamma gate', '1658505176', 4),
(450, 'Earned 150 sab ammo', '1658505177', 4),
(451, 'Earned 100 mcb25 ammo', '1658505177', 4),
(452, 'Earned 1 parts of Gamma gate', '1658505177', 4),
(453, 'Earned 150 sab ammo', '1658505177', 4),
(454, 'Earned 115 mcb50 ammo', '1658505177', 4),
(455, 'Earned 1 parts of Gamma gate', '1658505178', 4),
(456, 'Earned 215 mcb50 ammo', '1658505178', 4),
(457, 'Earned 100 mcb25 ammo', '1658505178', 4),
(458, 'Earned 75 mcb50 ammo', '1658505178', 4),
(459, 'Earned 100 mcb25 ammo', '1658505178', 4),
(460, 'Earned 1 parts of Gamma gate', '1658505179', 4),
(461, 'Earned 215 mcb50 ammo', '1658505179', 4),
(462, 'Earned 140 mcb25 ammo', '1658505179', 4),
(463, 'Earned 100 mcb25 ammo', '1658505179', 4),
(464, 'Earned 10 pld ammo', '1658505179', 4),
(465, 'Earned 2 parts of Gamma gate', '1658505180', 4),
(466, 'Earned 3 parts of Gamma gate', '1658505180', 4),
(467, 'Earned 215 mcb50 ammo', '1658505180', 4),
(468, 'Earned 50 sab ammo', '1658505180', 4),
(469, 'Earned 140 mcb25 ammo', '1658505180', 4),
(470, 'Earned 1 parts of Gamma gate', '1658505180', 4),
(471, 'Earned 10 pld ammo', '1658505181', 4),
(472, 'Earned 150 sab ammo', '1658505181', 4),
(473, 'Earned 215 mcb50 ammo', '1658505181', 4),
(474, 'Earned 2 parts of Gamma gate', '1658505181', 4),
(475, 'Earned 215 mcb50 ammo', '1658505181', 4),
(476, 'Earned 140 mcb25 ammo', '1658505182', 4),
(477, 'Earned 1 parts of Gamma gate', '1658505182', 4),
(478, 'Earned 85 mcb25 ammo', '1658505182', 4),
(479, 'Earned 25 plt21 ammo', '1658505183', 4),
(480, 'Earned 140 mcb25 ammo', '1658505183', 4),
(481, 'Earned 85 mcb25 ammo', '1658505183', 4),
(482, 'Earned 225 sab ammo', '1658505183', 4),
(483, 'Earned 100 mcb25 ammo', '1658505183', 4),
(484, 'Earned 100 mcb25 ammo', '1658505184', 4),
(485, 'Earned 100 mcb25 ammo', '1658505184', 4),
(486, 'Earned 225 sab ammo', '1658505184', 4),
(487, 'Earned 50 sab ammo', '1658505184', 4),
(488, 'Earned 115 mcb50 ammo', '1658505184', 4),
(489, 'Earned 1 parts of Gamma gate', '1658505185', 4),
(490, 'Earned 100 mcb25 ammo', '1658505185', 4),
(491, 'Earned 85 mcb25 ammo', '1658505185', 4),
(492, 'Earned 1 parts of Gamma gate', '1658505185', 4),
(493, 'Earned 3 parts of Gamma gate', '1658505185', 4),
(494, 'Earned 140 mcb25 ammo', '1658505186', 4),
(495, 'Earned 215 mcb50 ammo', '1658505186', 4),
(496, 'Earned 1 parts of Gamma gate', '1658505186', 4),
(497, 'Earned 2 parts of Gamma gate', '1658505186', 4),
(498, 'Earned 225 sab ammo', '1658505186', 4),
(499, 'Earned 1 parts of Gamma gate', '1658505187', 4),
(500, 'Earned 35 plt21 ammo', '1658505187', 4),
(501, 'Earned 1 parts of Gamma gate', '1658505187', 4),
(502, 'Earned 215 mcb50 ammo', '1658505187', 4),
(503, 'Earned 25 plt21 ammo', '1658505187', 4),
(504, 'Earned 10 pld ammo', '1658505188', 4),
(505, 'Earned 25 plt21 ammo', '1658505188', 4),
(506, 'Earned 225 sab ammo', '1658505188', 4),
(507, 'Earned 75 mcb50 ammo', '1658505188', 4),
(508, 'Earned 140 mcb25 ammo', '1658505189', 4),
(509, 'Earned 215 mcb50 ammo', '1658505189', 4),
(510, 'Earned 100 mcb25 ammo', '1658505189', 4),
(511, 'Earned 10 pld ammo', '1658505189', 4),
(512, 'Earned 35 plt21 ammo', '1658505189', 4),
(513, 'Earned 215 mcb50 ammo', '1658505190', 4),
(514, 'Earned 10 pld ammo', '1658505190', 4),
(515, 'Earned 75 mcb50 ammo', '1658505190', 4),
(516, 'Earned 35 plt21 ammo', '1658505190', 4),
(517, 'Earned 140 mcb25 ammo', '1658505190', 4),
(518, 'Earned 50 sab ammo', '1658505191', 4),
(519, 'Earned 3 parts of Gamma gate', '1658505191', 4),
(520, 'Earned 100 mcb25 ammo', '1658505191', 4),
(521, 'Earned 50 sab ammo', '1658505191', 4),
(522, 'Earned 140 mcb25 ammo', '1658505191', 4),
(523, 'Earned 3 parts of Gamma gate', '1658505192', 4),
(524, 'Earned 215 mcb50 ammo', '1658505192', 4),
(525, 'Earned 85 mcb25 ammo', '1658505192', 4),
(526, 'Earned 1 parts of Gamma gate', '1658505192', 4),
(527, 'Earned 115 mcb50 ammo', '1658852191', 1),
(528, 'Earned 25 plt21 ammo', '1658852192', 1),
(529, 'Earned 85 mcb25 ammo', '1658852192', 1),
(530, 'Earned 100 mcb25 ammo', '1658852192', 1),
(531, 'Earned 150 sab ammo', '1658852192', 1),
(532, 'Earned 75 mcb50 ammo', '1658852192', 1),
(533, 'Earned 10 pld ammo', '1658852193', 1),
(534, 'Earned 75 mcb50 ammo', '1658852193', 1),
(535, 'Earned 215 mcb50 ammo', '1658852193', 1),
(536, 'Earned 1 parts of Beta gate', '1658852193', 1),
(537, 'Earned 225 sab ammo', '1658852193', 1),
(538, 'Earned 25 plt21 ammo', '1658852194', 1),
(539, 'Earned 1 parts of Beta gate', '1658852194', 1),
(540, 'Earned 215 mcb50 ammo', '1658852194', 1),
(541, 'Earned 85 mcb25 ammo', '1658852194', 1),
(542, 'Earned 225 sab ammo', '1658852194', 1),
(543, 'Earned 50 sab ammo', '1658852194', 1),
(544, 'Earned 215 mcb50 ammo', '1658852195', 1),
(545, 'Earned 50 sab ammo', '1658852195', 1),
(546, 'Earned 150 sab ammo', '1658852195', 1),
(547, 'Earned 150 sab ammo', '1658852195', 1),
(548, 'Earned 1 parts of Beta gate', '1658852195', 1),
(549, 'Earned 215 mcb50 ammo', '1658852196', 1),
(550, 'Earned 215 mcb50 ammo', '1658852196', 1),
(551, 'Earned 10 pld ammo', '1658852196', 1),
(552, 'Earned 75 mcb50 ammo', '1658852196', 1),
(553, 'Earned 100 mcb25 ammo', '1658852196', 1),
(554, 'Earned 140 mcb25 ammo', '1658852196', 1),
(555, 'Earned 100 mcb25 ammo', '1658852197', 1),
(556, 'Earned 10 pld ammo', '1658852197', 1),
(557, 'Earned 100 mcb25 ammo', '1658852197', 1),
(558, 'Earned 35 plt21 ammo', '1658852197', 1),
(559, 'Earned 150 sab ammo', '1658852197', 1),
(560, 'Earned 1 parts of Beta gate', '1658852197', 1),
(561, 'Earned 225 sab ammo', '1658852198', 1),
(562, 'Earned 85 mcb25 ammo', '1658852198', 1),
(563, 'Earned 10 pld ammo', '1658852198', 1),
(564, 'Earned 115 mcb50 ammo', '1658852198', 1),
(565, 'Earned 1 parts of Beta gate', '1658852198', 1),
(566, 'Earned 1 parts of Beta gate', '1658852199', 1),
(567, 'Earned 150 sab ammo', '1658852199', 1),
(568, 'Earned 75 mcb50 ammo', '1658852199', 1),
(569, 'Earned 215 mcb50 ammo', '1658852199', 1),
(570, 'Earned 150 sab ammo', '1658852199', 1),
(571, 'Earned 225 sab ammo', '1658852199', 1),
(572, 'Earned 150 sab ammo', '1658852200', 1),
(573, 'Earned 225 sab ammo', '1658852200', 1),
(574, 'Earned 35 plt21 ammo', '1658852200', 1),
(575, 'Earned 100 mcb25 ammo', '1658852200', 1),
(576, 'Earned 50 sab ammo', '1658852200', 1),
(577, 'Earned 100 mcb25 ammo', '1658852201', 1),
(578, 'Earned 115 mcb50 ammo', '1658852201', 1),
(579, 'Earned 10 pld ammo', '1658852201', 1),
(580, 'Earned 85 mcb25 ammo', '1658852201', 1),
(581, 'Earned 3 parts of Beta gate', '1658852201', 1),
(582, 'Earned 115 mcb50 ammo', '1658852202', 1),
(583, 'Earned 150 sab ammo', '1658852202', 1),
(584, 'Earned 215 mcb50 ammo', '1658852202', 1),
(585, 'Earned 25 plt21 ammo', '1658852202', 1),
(586, 'Earned 3 parts of Beta gate', '1658852202', 1),
(587, 'Earned 100 mcb25 ammo', '1658852203', 1),
(588, 'Earned 140 mcb25 ammo', '1658852203', 1),
(589, 'Earned 35 plt21 ammo', '1658852203', 1),
(590, 'Earned 35 plt21 ammo', '1658852203', 1),
(591, 'Earned 75 mcb50 ammo', '1658852203', 1),
(592, 'Earned 75 mcb50 ammo', '1658852204', 1),
(593, 'Earned 115 mcb50 ammo', '1658852204', 1),
(594, 'Earned 215 mcb50 ammo', '1658852204', 1),
(595, 'Earned 100 mcb25 ammo', '1658852204', 1),
(596, 'Earned 50 sab ammo', '1658852204', 1),
(597, 'Earned 35 plt21 ammo', '1658852205', 1),
(598, 'Earned 215 mcb50 ammo', '1658852205', 1),
(599, 'Earned 150 sab ammo', '1658852205', 1),
(600, 'Earned 215 mcb50 ammo', '1658852205', 1),
(601, 'Earned 215 mcb50 ammo', '1658852205', 1),
(602, 'Earned 115 mcb50 ammo', '1658852206', 1),
(603, 'Earned 215 mcb50 ammo', '1658852206', 1),
(604, 'Earned 150 sab ammo', '1658852206', 1),
(605, 'Earned 75 mcb50 ammo', '1658852207', 1),
(606, 'Earned 215 mcb50 ammo', '1658852207', 1),
(607, 'Earned 75 mcb50 ammo', '1658852208', 1),
(608, 'Earned 35 plt21 ammo', '1658852208', 1),
(609, 'Earned 85 mcb25 ammo', '1658852208', 1),
(610, 'Earned 85 mcb25 ammo', '1658852208', 1),
(611, 'Earned 25 plt21 ammo', '1658852208', 1),
(612, 'Earned 215 mcb50 ammo', '1658852208', 1),
(613, 'Earned 115 mcb50 ammo', '1658852209', 1),
(614, 'Earned 140 mcb25 ammo', '1658852209', 1),
(615, 'Earned 225 sab ammo', '1658852209', 1),
(616, 'Earned 3 parts of Beta gate', '1658852209', 1),
(617, 'Earned 100 mcb25 ammo', '1658852209', 1),
(618, 'Earned 215 mcb50 ammo', '1658852209', 1),
(619, 'Earned 3 parts of Beta gate', '1658852210', 1),
(620, 'Earned 35 plt21 ammo', '1658852210', 1),
(621, 'Earned 1 parts of Beta gate', '1658852210', 1),
(622, 'Earned 100 mcb25 ammo', '1658852210', 1),
(623, 'Earned 215 mcb50 ammo', '1658852210', 1),
(624, 'Earned 100 mcb25 ammo', '1658852211', 1),
(625, 'Earned 3 parts of Beta gate', '1658852211', 1),
(626, 'Earned 35 plt21 ammo', '1658852211', 1),
(627, 'Earned 215 mcb50 ammo', '1658852211', 1),
(628, 'Earned 100 mcb25 ammo', '1658852211', 1),
(629, 'Earned 3 parts of Beta gate', '1658852211', 1),
(630, 'Earned 35 plt21 ammo', '1658852212', 1),
(631, 'Earned 215 mcb50 ammo', '1658852212', 1),
(632, 'Earned 100 mcb25 ammo', '1658852212', 1),
(633, 'Earned 215 mcb50 ammo', '1658852212', 1),
(634, 'Earned 1 parts of Beta gate', '1658852212', 1),
(635, 'Earned 115 mcb50 ammo', '1658852213', 1),
(636, 'Earned 75 mcb50 ammo', '1658852213', 1),
(637, 'Earned 25 plt21 ammo', '1658852213', 1),
(638, 'Earned 50 sab ammo', '1658852213', 1),
(639, 'Earned 1 parts of Beta gate', '1658852213', 1),
(640, 'Earned 50 sab ammo', '1658852214', 1),
(641, 'Earned 50 sab ammo', '1658852214', 1),
(642, 'Earned 215 mcb50 ammo', '1658852214', 1),
(643, 'Earned 225 sab ammo', '1658852214', 1),
(644, 'Earned 2 parts of Beta gate', '1658852214', 1),
(645, 'Earned 35 plt21 ammo', '1658852218', 1),
(646, 'Earned 75 mcb50 ammo', '1658852219', 1),
(647, 'Earned 100 mcb25 ammo', '1658852219', 1),
(648, 'Earned 150 sab ammo', '1658852220', 1),
(649, 'Earned 2 parts of Beta gate', '1658852220', 1),
(650, 'Earned 115 mcb50 ammo', '1658852221', 1),
(651, 'Earned 115 mcb50 ammo', '1658852221', 1),
(652, 'Earned 215 mcb50 ammo', '1658852221', 1),
(653, 'Earned 75 mcb50 ammo', '1658852222', 1),
(654, 'Earned 215 mcb50 ammo', '1658852222', 1),
(655, 'Earned 215 mcb50 ammo', '1658852222', 1),
(656, 'Earned 10 pld ammo', '1658852222', 1),
(657, 'Earned 100 mcb25 ammo', '1658852223', 1),
(658, 'Earned 115 mcb50 ammo', '1658852223', 1),
(659, 'Earned 10 pld ammo', '1658852223', 1),
(660, 'Earned 215 mcb50 ammo', '1658852223', 1),
(661, 'Earned 75 mcb50 ammo', '1658852223', 1),
(662, 'Earned 1 parts of Beta gate', '1658852224', 1),
(663, 'Earned 100 mcb25 ammo', '1658852224', 1),
(664, 'Earned 25 plt21 ammo', '1658852224', 1),
(665, 'Earned 75 mcb50 ammo', '1658852224', 1),
(666, 'Earned 1 parts of Beta gate', '1658852224', 1),
(667, 'Earned 85 mcb25 ammo', '1658852225', 1),
(668, 'Earned 3 parts of Beta gate', '1658852225', 1),
(669, 'Earned 215 mcb50 ammo', '1658852225', 1),
(670, 'Earned 1 parts of Beta gate', '1658852225', 1),
(671, 'Earned 215 mcb50 ammo', '1658852225', 1),
(672, 'Earned 215 mcb50 ammo', '1658852226', 1),
(673, 'Earned 10 pld ammo', '1658852226', 1),
(674, 'Earned 2 parts of Beta gate', '1658852226', 1),
(675, 'Earned 35 plt21 ammo', '1658852226', 1),
(676, 'Earned 35 plt21 ammo', '1658852226', 1),
(677, 'Earned 85 mcb25 ammo', '1658852227', 1),
(678, 'Earned 75 mcb50 ammo', '1658852227', 1),
(679, 'Earned 150 sab ammo', '1658852227', 1),
(680, 'Earned 100 mcb25 ammo', '1658852227', 1),
(681, 'Earned 50 sab ammo', '1658852227', 1),
(682, 'Earned 3 parts of Beta gate', '1658852227', 1),
(683, 'Earned 215 mcb50 ammo', '1658852228', 1),
(684, 'Earned 215 mcb50 ammo', '1658852228', 1),
(685, 'Earned 140 mcb25 ammo', '1658852228', 1),
(686, 'Earned 215 mcb50 ammo', '1658852228', 1),
(687, 'Earned 100 mcb25 ammo', '1658852228', 1),
(688, 'Earned 115 mcb50 ammo', '1658852229', 1),
(689, 'Earned 1 parts of Beta gate', '1658852229', 1),
(690, 'Earned 25 plt21 ammo', '1658852229', 1),
(691, 'Earned 100 mcb25 ammo', '1658852229', 1),
(692, 'Earned 100 mcb25 ammo', '1658852229', 1),
(693, 'Earned 100 mcb25 ammo', '1658852229', 1),
(694, 'Earned 50 sab ammo', '1658852230', 1),
(695, 'Earned 215 mcb50 ammo', '1658852230', 1),
(696, 'Earned 1 parts of Beta gate', '1658852230', 1),
(697, 'Earned 75 mcb50 ammo', '1658852230', 1),
(698, 'Earned 1 parts of Beta gate', '1658852230', 1),
(699, 'Earned 225 sab ammo', '1658852231', 1),
(700, 'Earned 100 mcb25 ammo', '1658852231', 1),
(701, 'Earned 150 sab ammo', '1658852231', 1),
(702, 'Earned 1 parts of Beta gate', '1658852231', 1),
(703, 'Earned 215 mcb50 ammo', '1658852231', 1),
(704, 'Earned 1 parts of Beta gate', '1658852231', 1),
(705, 'Earned 150 sab ammo', '1658852232', 1),
(706, 'Earned 150 sab ammo', '1658852232', 1),
(707, 'Earned 100 mcb25 ammo', '1658852232', 1),
(708, 'Earned 25 plt21 ammo', '1658852232', 1),
(709, 'Earned 1 parts of Beta gate. Sucesfully unlocked gate.', '1658852232', 1),
(710, 'Earned 1 parts of Gamma gate', '1658853007', 1),
(711, 'Earned 115 mcb50 ammo', '1658853007', 1),
(712, 'Earned 3 parts of Gamma gate', '1658853007', 1),
(713, 'Earned 35 plt21 ammo', '1658853007', 1),
(714, 'Earned 115 mcb50 ammo', '1658853007', 1),
(715, 'Earned 2 parts of Gamma gate', '1658853008', 1),
(716, 'Earned 100 mcb25 ammo', '1658853008', 1),
(717, 'Earned 10 pld ammo', '1658853008', 1),
(718, 'Earned 50 sab ammo', '1658853008', 1),
(719, 'Earned 215 mcb50 ammo', '1658853008', 1),
(720, 'Earned 225 sab ammo', '1658853009', 1),
(721, 'Earned 35 plt21 ammo', '1658853009', 1),
(722, 'Earned 35 plt21 ammo', '1658853009', 1),
(723, 'Earned 25 plt21 ammo', '1658853009', 1),
(724, 'Earned 3 parts of Gamma gate', '1658853009', 1),
(725, 'Earned 225 sab ammo', '1658853009', 1),
(726, 'Earned 1 parts of Gamma gate', '1658853010', 1),
(727, 'Earned 85 mcb25 ammo', '1658853010', 1),
(728, 'Earned 35 plt21 ammo', '1658853010', 1),
(729, 'Earned 10 pld ammo', '1658853010', 1),
(730, 'Earned 85 mcb25 ammo', '1658853010', 1),
(731, 'Earned 2 parts of Gamma gate', '1658853010', 1),
(732, 'Earned 1 parts of Gamma gate', '1658853011', 1),
(733, 'Earned 3 parts of Gamma gate', '1658853011', 1),
(734, 'Earned 115 mcb50 ammo', '1658853011', 1),
(735, 'Earned 100 mcb25 ammo', '1658853011', 1),
(736, 'Earned 150 sab ammo', '1658853011', 1),
(737, 'Earned 50 sab ammo', '1658853012', 1),
(738, 'Earned 35 plt21 ammo', '1658853012', 1),
(739, 'Earned 35 plt21 ammo', '1658853012', 1),
(740, 'Earned 150 sab ammo', '1658853012', 1),
(741, 'Earned 3 parts of Gamma gate', '1658853012', 1),
(742, 'Earned 3 parts of Gamma gate', '1658853013', 1),
(743, 'Earned 75 mcb50 ammo', '1658853013', 1),
(744, 'Earned 100 mcb25 ammo', '1658853013', 1),
(745, 'Earned 1 parts of Gamma gate', '1658853013', 1),
(746, 'Earned 100 mcb25 ammo', '1658853013', 1),
(747, 'Earned 215 mcb50 ammo', '1658853014', 1),
(748, 'Earned 1 parts of Gamma gate', '1658853014', 1),
(749, 'Earned 25 plt21 ammo', '1658853014', 1),
(750, 'Earned 115 mcb50 ammo', '1658853014', 1),
(751, 'Earned 85 mcb25 ammo', '1658853014', 1),
(752, 'Earned 2 parts of Gamma gate', '1658853014', 1),
(753, 'Earned 225 sab ammo', '1658853015', 1),
(754, 'Earned 1 parts of Gamma gate', '1658853015', 1),
(755, 'Earned 1 parts of Gamma gate', '1658853015', 1),
(756, 'Earned 215 mcb50 ammo', '1658853015', 1),
(757, 'Earned 225 sab ammo', '1658853015', 1),
(758, 'Earned 75 mcb50 ammo', '1658853016', 1),
(759, 'Earned 150 sab ammo', '1658853016', 1),
(760, 'Earned 100 mcb25 ammo', '1658853016', 1),
(761, 'Earned 215 mcb50 ammo', '1658853016', 1),
(762, 'Earned 10 pld ammo', '1658853016', 1),
(763, 'Earned 10 pld ammo', '1658853016', 1),
(764, 'Earned 215 mcb50 ammo', '1658853017', 1),
(765, 'Earned 215 mcb50 ammo', '1658853017', 1),
(766, 'Earned 75 mcb50 ammo', '1658853017', 1),
(767, 'Earned 85 mcb25 ammo', '1658853017', 1),
(768, 'Earned 225 sab ammo', '1658853017', 1),
(769, 'Earned 1 parts of Gamma gate', '1658853018', 1),
(770, 'Earned 10 pld ammo', '1658853018', 1),
(771, 'Earned 215 mcb50 ammo', '1658853018', 1),
(772, 'Earned 215 mcb50 ammo', '1658853018', 1),
(773, 'Earned 150 sab ammo', '1658853018', 1),
(774, 'Earned 85 mcb25 ammo', '1658853018', 1),
(775, 'Earned 1 parts of Gamma gate', '1658853019', 1),
(776, 'Earned 3 parts of Gamma gate', '1658853019', 1),
(777, 'Earned 225 sab ammo', '1658853019', 1),
(778, 'Earned 3 parts of Gamma gate', '1658853019', 1),
(779, 'Earned 215 mcb50 ammo', '1658853019', 1),
(780, 'Earned 140 mcb25 ammo', '1658853020', 1),
(781, 'Earned 150 sab ammo', '1658853020', 1),
(782, 'Earned 1 parts of Gamma gate', '1658853020', 1),
(783, 'Earned 100 mcb25 ammo', '1658853020', 1),
(784, 'Earned 1 parts of Gamma gate', '1658853020', 1),
(785, 'Earned 2 parts of Gamma gate', '1658853021', 1),
(786, 'Earned 100 mcb25 ammo', '1658853021', 1),
(787, 'Earned 2 parts of Gamma gate', '1658853021', 1),
(788, 'Earned 75 mcb50 ammo', '1658853021', 1),
(789, 'Earned 100 mcb25 ammo', '1658853021', 1),
(790, 'Earned 115 mcb50 ammo', '1658853022', 1),
(791, 'Earned 3 parts of Gamma gate', '1658853022', 1),
(792, 'Earned 3 parts of Gamma gate', '1658853022', 1),
(793, 'Earned 2 parts of Gamma gate', '1658853022', 1),
(794, 'Earned 140 mcb25 ammo', '1658853022', 1),
(795, 'Earned 1 parts of Gamma gate', '1658853023', 1),
(796, 'Earned 25 plt21 ammo', '1658853023', 1),
(797, 'Earned 1 parts of Gamma gate', '1658853023', 1),
(798, 'Earned 50 sab ammo', '1658853023', 1),
(799, 'Earned 215 mcb50 ammo', '1658853023', 1),
(800, 'Earned 50 sab ammo', '1658853024', 1),
(801, 'Earned 100 mcb25 ammo', '1658853024', 1),
(802, 'Earned 85 mcb25 ammo', '1658853024', 1),
(803, 'Earned 1 parts of Gamma gate', '1658853024', 1),
(804, 'Earned 115 mcb50 ammo', '1658853024', 1),
(805, 'Earned 50 sab ammo', '1658853025', 1),
(806, 'Earned 215 mcb50 ammo', '1658853025', 1),
(807, 'Earned 1 parts of Gamma gate', '1658853025', 1),
(808, 'Earned 3 parts of Gamma gate', '1658853025', 1),
(809, 'Earned 1 parts of Gamma gate', '1658853025', 1),
(810, 'Earned 215 mcb50 ammo', '1658853026', 1),
(811, 'Earned 75 mcb50 ammo', '1658853026', 1),
(812, 'Earned 1 parts of Gamma gate', '1658853026', 1),
(813, 'Earned 140 mcb25 ammo', '1658853026', 1),
(814, 'Earned 35 plt21 ammo', '1658853026', 1),
(815, 'Earned 100 mcb25 ammo', '1658853027', 1),
(816, 'Earned 85 mcb25 ammo', '1658853027', 1),
(817, 'Earned 215 mcb50 ammo', '1658853027', 1),
(818, 'Earned 225 sab ammo', '1658853027', 1),
(819, 'Earned 2 parts of Gamma gate', '1658853027', 1),
(820, 'Earned 75 mcb50 ammo', '1658853028', 1),
(821, 'Earned 150 sab ammo', '1658853028', 1),
(822, 'Earned 115 mcb50 ammo', '1658853028', 1),
(823, 'Earned 1 parts of Gamma gate', '1658853028', 1),
(824, 'Earned 225 sab ammo', '1658853028', 1),
(825, 'Earned 1 parts of Gamma gate', '1658853029', 1),
(826, 'Earned 50 sab ammo', '1658853029', 1),
(827, 'Earned 10 pld ammo', '1658853029', 1),
(828, 'Earned 115 mcb50 ammo', '1658853029', 1),
(829, 'Earned 10 pld ammo', '1658853029', 1),
(830, 'Earned 1 parts of Gamma gate', '1658853030', 1),
(831, 'Earned 215 mcb50 ammo', '1658853030', 1),
(832, 'Earned 1 parts of Gamma gate', '1658853030', 1),
(833, 'Earned 35 plt21 ammo', '1658853030', 1),
(834, 'Earned 100 mcb25 ammo', '1658853030', 1),
(835, 'Earned 85 mcb25 ammo', '1658853031', 1),
(836, 'Earned 85 mcb25 ammo', '1658853031', 1),
(837, 'Earned 140 mcb25 ammo', '1658853031', 1),
(838, 'Earned 225 sab ammo', '1658853031', 1),
(839, 'Earned 25 plt21 ammo', '1658853031', 1),
(840, 'Earned 225 sab ammo', '1658853031', 1),
(841, 'Earned 115 mcb50 ammo', '1658853032', 1),
(842, 'Earned 10 pld ammo', '1658853032', 1),
(843, 'Earned 85 mcb25 ammo', '1658853032', 1),
(844, 'Earned 3 parts of Gamma gate', '1658853032', 1),
(845, 'Earned 215 mcb50 ammo', '1658853032', 1),
(846, 'Earned 215 mcb50 ammo', '1658853033', 1),
(847, 'Earned 140 mcb25 ammo', '1658853033', 1),
(848, 'Earned 215 mcb50 ammo', '1658853033', 1),
(849, 'Earned 150 sab ammo', '1658853033', 1),
(850, 'Earned 115 mcb50 ammo', '1658853034', 1),
(851, 'Earned 1 parts of Gamma gate', '1658853034', 1),
(852, 'Earned 225 sab ammo', '1658853034', 1),
(853, 'Earned 115 mcb50 ammo', '1658853034', 1),
(854, 'Earned 75 mcb50 ammo', '1658853034', 1),
(855, 'Earned 1 parts of Gamma gate', '1658853034', 1),
(856, 'Earned 215 mcb50 ammo', '1658853035', 1),
(857, 'Earned 50 sab ammo', '1658853035', 1),
(858, 'Earned 35 plt21 ammo', '1658853035', 1),
(859, 'Earned 100 mcb25 ammo', '1658853035', 1),
(860, 'Earned 1 parts of Gamma gate', '1658853035', 1),
(861, 'Earned 215 mcb50 ammo', '1658853036', 1),
(862, 'Earned 50 sab ammo', '1658853036', 1),
(863, 'Earned 140 mcb25 ammo', '1658853036', 1),
(864, 'Earned 100 mcb25 ammo', '1658853036', 1),
(865, 'Earned 50 sab ammo', '1658853036', 1),
(866, 'Earned 215 mcb50 ammo', '1658853037', 1),
(867, 'Earned 1 parts of Gamma gate', '1658853037', 1),
(868, 'Earned 215 mcb50 ammo', '1658853037', 1),
(869, 'Earned 215 mcb50 ammo', '1658853037', 1),
(870, 'Earned 100 mcb25 ammo', '1658853037', 1),
(871, 'Earned 150 sab ammo', '1658853038', 1),
(872, 'Earned 85 mcb25 ammo', '1658853038', 1),
(873, 'Earned 215 mcb50 ammo', '1658853038', 1),
(874, 'Earned 35 plt21 ammo', '1658853038', 1),
(875, 'Earned 85 mcb25 ammo', '1658853038', 1),
(876, 'Earned 225 sab ammo', '1658853039', 1),
(877, 'Earned 100 mcb25 ammo', '1658853039', 1),
(878, 'Earned 25 plt21 ammo', '1658853039', 1),
(879, 'Earned 100 mcb25 ammo', '1658853039', 1),
(880, 'Earned 150 sab ammo', '1658853039', 1),
(881, 'Earned 85 mcb25 ammo', '1658853039', 1),
(882, 'Earned 85 mcb25 ammo', '1658853040', 1),
(883, 'Earned 225 sab ammo', '1658853040', 1),
(884, 'Earned 1 parts of Gamma gate', '1658853040', 1),
(885, 'Earned 150 sab ammo', '1658853040', 1),
(886, 'Earned 115 mcb50 ammo', '1658853040', 1),
(887, 'Earned 115 mcb50 ammo', '1658853041', 1),
(888, 'Earned 225 sab ammo', '1658853041', 1),
(889, 'Earned 215 mcb50 ammo', '1658853041', 1),
(890, 'Earned 225 sab ammo', '1658853041', 1),
(891, 'Earned 140 mcb25 ammo', '1658853041', 1),
(892, 'Earned 75 mcb50 ammo', '1658853042', 1),
(893, 'Earned 10 pld ammo', '1658853042', 1),
(894, 'Earned 140 mcb25 ammo', '1658853042', 1),
(895, 'Earned 100 mcb25 ammo', '1658853042', 1),
(896, 'Earned 85 mcb25 ammo', '1658853042', 1),
(897, 'Earned 215 mcb50 ammo', '1658853042', 1),
(898, 'Earned 140 mcb25 ammo', '1658853043', 1),
(899, 'Earned 100 mcb25 ammo', '1658853043', 1),
(900, 'Earned 85 mcb25 ammo', '1658853043', 1),
(901, 'Earned 100 mcb25 ammo', '1658853043', 1),
(902, 'Earned 50 sab ammo', '1658853043', 1),
(903, 'Earned 140 mcb25 ammo', '1658853044', 1),
(904, 'Earned 25 plt21 ammo', '1658853044', 1),
(905, 'Earned 140 mcb25 ammo', '1658853044', 1),
(906, 'Earned 140 mcb25 ammo', '1658853044', 1),
(907, 'Earned 215 mcb50 ammo', '1658853044', 1),
(908, 'Earned 35 plt21 ammo', '1658853045', 1),
(909, 'Earned 50 sab ammo', '1658853045', 1),
(910, 'Earned 85 mcb25 ammo', '1658853045', 1),
(911, 'Earned 85 mcb25 ammo', '1658853045', 1),
(912, 'Earned 50 sab ammo', '1658853045', 1),
(913, 'Earned 225 sab ammo', '1658853045', 1),
(914, 'Earned 225 sab ammo', '1658853046', 1),
(915, 'Earned 150 sab ammo', '1658853046', 1),
(916, 'Earned 50 sab ammo', '1658853046', 1),
(917, 'Earned 3 parts of Gamma gate', '1658853047', 1),
(918, 'Earned 100 mcb25 ammo', '1658853047', 1),
(919, 'Earned 225 sab ammo', '1658853047', 1),
(920, 'Earned 100 mcb25 ammo', '1658853047', 1),
(921, 'Earned 35 plt21 ammo', '1658853047', 1),
(922, 'Earned 215 mcb50 ammo', '1658853047', 1),
(923, 'Earned 1 parts of Gamma gate', '1658853048', 1),
(924, 'Earned 1 parts of Gamma gate', '1658853048', 1),
(925, 'Earned 75 mcb50 ammo', '1658853048', 1),
(926, 'Earned 50 sab ammo', '1658853048', 1),
(927, 'Earned 10 pld ammo', '1658853049', 1),
(928, 'Earned 25 plt21 ammo', '1658853049', 1),
(929, 'Earned 50 sab ammo', '1658853049', 1),
(930, 'Earned 25 plt21 ammo', '1658853049', 1),
(931, 'Earned 100 mcb25 ammo', '1658853049', 1),
(932, 'Earned 100 mcb25 ammo', '1658853049', 1),
(933, 'Earned 100 mcb25 ammo', '1658853050', 1),
(934, 'Earned 50 sab ammo', '1658853050', 1),
(935, 'Earned 215 mcb50 ammo', '1658853050', 1),
(936, 'Earned 215 mcb50 ammo', '1658853050', 1),
(937, 'Earned 75 mcb50 ammo', '1658853051', 1),
(938, 'Earned 100 mcb25 ammo', '1658853051', 1),
(939, 'Earned 10 pld ammo', '1658853051', 1),
(940, 'Earned 115 mcb50 ammo', '1658853051', 1),
(941, 'Earned 1 parts of Gamma gate', '1658853051', 1),
(942, 'Earned 215 mcb50 ammo', '1658853052', 1),
(943, 'Earned 215 mcb50 ammo', '1658853052', 1),
(944, 'Earned 3 parts of Gamma gate. Sucesfully unlocked gate.', '1658853052', 1),
(945, 'Buyed 1 live in Lambda gate', '1658925787', 1),
(946, 'Earned 100 mcb25 ammo', '1658945266', 8),
(947, 'Earned 3 parts of Delta gate', '1658945267', 8),
(948, 'Earned 25 plt21 ammo', '1658945267', 8),
(949, 'Earned 35 plt21 ammo', '1658945267', 8),
(950, 'Earned 215 mcb50 ammo', '1658945267', 8),
(951, 'Earned 150 sab ammo', '1658945267', 8),
(952, 'Earned 115 mcb50 ammo', '1658945268', 8),
(953, 'Earned 100 mcb25 ammo', '1658945268', 8),
(954, 'Earned 100 mcb25 ammo', '1658945268', 8),
(955, 'Earned 140 mcb25 ammo', '1658945268', 8),
(956, 'Earned 100 mcb25 ammo', '1658945268', 8),
(957, 'Earned 1 parts of Delta gate', '1658945269', 8),
(958, 'Earned 225 sab ammo', '1658945269', 8),
(959, 'Earned 3 parts of Delta gate', '1658945269', 8),
(960, 'Earned 3 parts of Delta gate', '1658945269', 8),
(961, 'Earned 1 parts of Delta gate', '1658945269', 8),
(962, 'Earned 100 mcb25 ammo', '1658945269', 8),
(963, 'Earned 115 mcb50 ammo', '1658945270', 8),
(964, 'Earned 225 sab ammo', '1658945270', 8),
(965, 'Earned 150 sab ammo', '1658945270', 8),
(966, 'Earned 225 sab ammo', '1658945270', 8),
(967, 'Earned 100 mcb25 ammo', '1658945270', 8),
(968, 'Earned 100 mcb25 ammo', '1658945271', 8),
(969, 'Earned 215 mcb50 ammo', '1658945271', 8),
(970, 'Earned 50 sab ammo', '1658945271', 8),
(971, 'Earned 35 plt21 ammo', '1658945271', 8),
(972, 'Earned 75 mcb50 ammo', '1658945271', 8),
(973, 'Earned 25 plt21 ammo', '1658945272', 8),
(974, 'Earned 115 mcb50 ammo', '1658945272', 8),
(975, 'Earned 50 sab ammo', '1658945272', 8),
(976, 'Earned 75 mcb50 ammo', '1658945272', 8),
(977, 'Earned 1 parts of Delta gate', '1658945272', 8),
(978, 'Earned 150 sab ammo', '1658945273', 8),
(979, 'Earned 10 pld ammo', '1658945273', 8),
(980, 'Earned 150 sab ammo', '1658945273', 8),
(981, 'Earned 115 mcb50 ammo', '1658945273', 8),
(982, 'Earned 115 mcb50 ammo', '1658945273', 8),
(983, 'Earned 50 sab ammo', '1658945274', 8),
(984, 'Earned 225 sab ammo', '1658945274', 8),
(985, 'Earned 225 sab ammo', '1658945274', 8),
(986, 'Earned 1 parts of Delta gate', '1658945274', 8),
(987, 'Earned 115 mcb50 ammo', '1658945274', 8),
(988, 'Earned 140 mcb25 ammo', '1658945275', 8),
(989, 'Earned 50 sab ammo', '1658945275', 8),
(990, 'Earned 1 parts of Delta gate', '1658945275', 8),
(991, 'Earned 2 parts of Delta gate', '1658945275', 8),
(992, 'Earned 100 mcb25 ammo', '1658945275', 8),
(993, 'Earned 100 mcb25 ammo', '1658945276', 8),
(994, 'Earned 10 pld ammo', '1658945276', 8),
(995, 'Earned 215 mcb50 ammo', '1658945276', 8),
(996, 'Earned 215 mcb50 ammo', '1658945276', 8),
(997, 'Earned 1 parts of Delta gate', '1658945276', 8),
(998, 'Earned 1 parts of Delta gate', '1658945277', 8),
(999, 'Earned 115 mcb50 ammo', '1658945277', 8),
(1000, 'Earned 35 plt21 ammo', '1658945277', 8),
(1001, 'Earned 215 mcb50 ammo', '1658945277', 8),
(1002, 'Earned 1 parts of Delta gate', '1658945278', 8),
(1003, 'Earned 2 parts of Delta gate', '1658945278', 8),
(1004, 'Earned 115 mcb50 ammo', '1658945278', 8),
(1005, 'Earned 3 parts of Delta gate', '1658945278', 8),
(1006, 'Earned 140 mcb25 ammo', '1658945278', 8),
(1007, 'Earned 1 parts of Delta gate', '1658945279', 8),
(1008, 'Earned 85 mcb25 ammo', '1658945279', 8),
(1009, 'Earned 100 mcb25 ammo', '1658945279', 8),
(1010, 'Earned 25 plt21 ammo', '1658945279', 8),
(1011, 'Earned 10 pld ammo', '1658945279', 8),
(1012, 'Earned 100 mcb25 ammo', '1658945279', 8),
(1013, 'Earned 215 mcb50 ammo', '1658945280', 8),
(1014, 'Earned 100 mcb25 ammo', '1658945280', 8),
(1015, 'Earned 100 mcb25 ammo', '1658945280', 8),
(1016, 'Earned 1 parts of Delta gate', '1658945280', 8),
(1017, 'Earned 140 mcb25 ammo', '1658945281', 8),
(1018, 'Earned 100 mcb25 ammo', '1658945281', 8),
(1019, 'Earned 215 mcb50 ammo', '1658945281', 8),
(1020, 'Earned 215 mcb50 ammo', '1658945281', 8),
(1021, 'Earned 225 sab ammo', '1658945281', 8),
(1022, 'Earned 100 mcb25 ammo', '1658945282', 8),
(1023, 'Earned 75 mcb50 ammo', '1658945282', 8),
(1024, 'Earned 25 plt21 ammo', '1658945282', 8),
(1025, 'Earned 100 mcb25 ammo', '1658945282', 8),
(1026, 'Earned 215 mcb50 ammo', '1658945282', 8),
(1027, 'Earned 225 sab ammo', '1658945283', 8),
(1028, 'Earned 3 parts of Delta gate', '1658945283', 8),
(1029, 'Earned 115 mcb50 ammo', '1658945283', 8),
(1030, 'Earned 85 mcb25 ammo', '1658945283', 8),
(1031, 'Earned 85 mcb25 ammo', '1658945283', 8),
(1032, 'Earned 215 mcb50 ammo', '1658945284', 8),
(1033, 'Earned 100 mcb25 ammo', '1658945284', 8),
(1034, 'Earned 115 mcb50 ammo', '1658945284', 8),
(1035, 'Earned 150 sab ammo', '1658945284', 8),
(1036, 'Earned 100 mcb25 ammo', '1658945284', 8),
(1037, 'Earned 85 mcb25 ammo', '1658945285', 8),
(1038, 'Earned 2 parts of Delta gate', '1658945285', 8),
(1039, 'Earned 1 parts of Delta gate', '1658945285', 8),
(1040, 'Earned 10 pld ammo', '1658945285', 8),
(1041, 'Earned 2 parts of Delta gate', '1658945285', 8),
(1042, 'Earned 10 pld ammo', '1658945286', 8);
INSERT INTO `gg_log` (`id`, `log`, `date`, `userId`) VALUES
(1043, 'Earned 100 mcb25 ammo', '1658945286', 8),
(1044, 'Earned 115 mcb50 ammo', '1658945286', 8),
(1045, 'Earned 100 mcb25 ammo', '1658945286', 8),
(1046, 'Earned 100 mcb25 ammo', '1658945286', 8),
(1047, 'Earned 100 mcb25 ammo', '1658945287', 8),
(1048, 'Earned 75 mcb50 ammo', '1658945287', 8),
(1049, 'Earned 115 mcb50 ammo', '1658945287', 8),
(1050, 'Earned 225 sab ammo', '1658945287', 8),
(1051, 'Earned 1 parts of Delta gate', '1658945287', 8),
(1052, 'Earned 140 mcb25 ammo', '1658945288', 8),
(1053, 'Earned 115 mcb50 ammo', '1658945288', 8),
(1054, 'Earned 3 parts of Delta gate', '1658945288', 8),
(1055, 'Earned 215 mcb50 ammo', '1658945288', 8),
(1056, 'Earned 140 mcb25 ammo', '1658945288', 8),
(1057, 'Earned 3 parts of Delta gate', '1658945289', 8),
(1058, 'Earned 115 mcb50 ammo', '1658945289', 8),
(1059, 'Earned 75 mcb50 ammo', '1658945289', 8),
(1060, 'Earned 140 mcb25 ammo', '1658945289', 8),
(1061, 'Earned 100 mcb25 ammo', '1658945289', 8),
(1062, 'Earned 100 mcb25 ammo', '1658945290', 8),
(1063, 'Earned 140 mcb25 ammo', '1658945290', 8),
(1064, 'Earned 25 plt21 ammo', '1658945290', 8),
(1065, 'Earned 1 parts of Delta gate', '1658945290', 8),
(1066, 'Earned 140 mcb25 ammo', '1658945290', 8),
(1067, 'Earned 3 parts of Delta gate', '1658945290', 8),
(1068, 'Earned 50 sab ammo', '1658945291', 8),
(1069, 'Earned 140 mcb25 ammo', '1658945291', 8),
(1070, 'Earned 225 sab ammo', '1658945291', 8),
(1071, 'Earned 215 mcb50 ammo', '1658945291', 8),
(1072, 'Earned 100 mcb25 ammo', '1658945292', 8),
(1073, 'Earned 225 sab ammo', '1658945292', 8),
(1074, 'Earned 1 parts of Delta gate', '1658945293', 8),
(1075, 'Earned 100 mcb25 ammo', '1658945293', 8),
(1076, 'Earned 215 mcb50 ammo', '1658945293', 8),
(1077, 'Earned 25 plt21 ammo', '1658945293', 8),
(1078, 'Earned 1 parts of Delta gate', '1658945293', 8),
(1079, 'Earned 100 mcb25 ammo', '1658945293', 8),
(1080, 'Earned 50 sab ammo', '1658945294', 8),
(1081, 'Earned 100 mcb25 ammo', '1658945294', 8),
(1082, 'Earned 85 mcb25 ammo', '1658945294', 8),
(1083, 'Earned 215 mcb50 ammo', '1658945294', 8),
(1084, 'Earned 75 mcb50 ammo', '1658945294', 8),
(1085, 'Earned 10 pld ammo', '1658945295', 8),
(1086, 'Earned 1 parts of Delta gate', '1658945295', 8),
(1087, 'Earned 140 mcb25 ammo', '1658945295', 8),
(1088, 'Earned 225 sab ammo', '1658945296', 8),
(1089, 'Earned 150 sab ammo', '1658945296', 8),
(1090, 'Earned 2 parts of Delta gate', '1658945296', 8),
(1091, 'Earned 115 mcb50 ammo', '1658945296', 8),
(1092, 'Earned 225 sab ammo', '1658945296', 8),
(1093, 'Earned 115 mcb50 ammo', '1658945296', 8),
(1094, 'Earned 85 mcb25 ammo', '1658945297', 8),
(1095, 'Earned 35 plt21 ammo', '1658945297', 8),
(1096, 'Earned 75 mcb50 ammo', '1658945297', 8),
(1097, 'Earned 1 parts of Delta gate', '1658945297', 8),
(1098, 'Earned 115 mcb50 ammo', '1658945297', 8),
(1099, 'Earned 140 mcb25 ammo', '1658945298', 8),
(1100, 'Earned 85 mcb25 ammo', '1658945298', 8),
(1101, 'Earned 115 mcb50 ammo', '1658945298', 8),
(1102, 'Earned 35 plt21 ammo', '1658945298', 8),
(1103, 'Earned 215 mcb50 ammo', '1658945298', 8),
(1104, 'Earned 85 mcb25 ammo', '1658945299', 8),
(1105, 'Earned 75 mcb50 ammo', '1658945299', 8),
(1106, 'Earned 35 plt21 ammo', '1658945299', 8),
(1107, 'Earned 1 parts of Delta gate', '1658945299', 8),
(1108, 'Earned 140 mcb25 ammo', '1658945300', 8),
(1109, 'Earned 50 sab ammo', '1658945300', 8),
(1110, 'Earned 140 mcb25 ammo', '1658945300', 8),
(1111, 'Earned 100 mcb25 ammo', '1658945300', 8),
(1112, 'Earned 115 mcb50 ammo', '1658945301', 8),
(1113, 'Earned 25 plt21 ammo', '1658945301', 8),
(1114, 'Earned 25 plt21 ammo', '1658945301', 8),
(1115, 'Earned 1 parts of Delta gate', '1658945301', 8),
(1116, 'Earned 1 parts of Delta gate', '1658945301', 8),
(1117, 'Earned 100 mcb25 ammo', '1658945301', 8),
(1118, 'Earned 85 mcb25 ammo', '1658945302', 8),
(1119, 'Earned 25 plt21 ammo', '1658945302', 8),
(1120, 'Earned 75 mcb50 ammo', '1658945302', 8),
(1121, 'Earned 35 plt21 ammo', '1658945302', 8),
(1122, 'Earned 100 mcb25 ammo', '1658945302', 8),
(1123, 'Earned 100 mcb25 ammo', '1658945303', 8),
(1124, 'Earned 3 parts of Delta gate', '1658945303', 8),
(1125, 'Earned 100 mcb25 ammo', '1658945303', 8),
(1126, 'Earned 25 plt21 ammo', '1658945303', 8),
(1127, 'Earned 150 sab ammo', '1658945303', 8),
(1128, 'Earned 75 mcb50 ammo', '1658945304', 8),
(1129, 'Earned 50 sab ammo', '1658945304', 8),
(1130, 'Earned 10 pld ammo', '1658945304', 8),
(1131, 'Earned 140 mcb25 ammo', '1658945304', 8),
(1132, 'Earned 140 mcb25 ammo', '1658945304', 8),
(1133, 'Earned 75 mcb50 ammo', '1658945305', 8),
(1134, 'Earned 215 mcb50 ammo', '1658945305', 8),
(1135, 'Earned 115 mcb50 ammo', '1658945305', 8),
(1136, 'Earned 100 mcb25 ammo', '1658945305', 8),
(1137, 'Earned 225 sab ammo', '1658945305', 8),
(1138, 'Earned 1 parts of Delta gate', '1658945306', 8),
(1139, 'Earned 115 mcb50 ammo', '1658945306', 8),
(1140, 'Earned 75 mcb50 ammo', '1658945306', 8),
(1141, 'Earned 215 mcb50 ammo', '1658945306', 8),
(1142, 'Earned 100 mcb25 ammo', '1658945306', 8),
(1143, 'Earned 35 plt21 ammo', '1658945307', 8),
(1144, 'Earned 10 pld ammo', '1658945308', 8),
(1145, 'Earned 215 mcb50 ammo', '1658945309', 8),
(1146, 'Earned 140 mcb25 ammo', '1658945309', 8),
(1147, 'Earned 50 sab ammo', '1658945310', 8),
(1148, 'Earned 140 mcb25 ammo', '1658945311', 8),
(1149, 'Earned 35 plt21 ammo', '1658945311', 8),
(1150, 'Earned 75 mcb50 ammo', '1658945312', 8),
(1151, 'Earned 215 mcb50 ammo', '1658945312', 8),
(1152, 'Earned 140 mcb25 ammo', '1658945313', 8),
(1153, 'Earned 75 mcb50 ammo', '1658945313', 8),
(1154, 'Earned 100 mcb25 ammo', '1658945313', 8),
(1155, 'Earned 215 mcb50 ammo', '1658945314', 8),
(1156, 'Earned 1 parts of Delta gate', '1658945314', 8),
(1157, 'Earned 1 parts of Delta gate', '1658945314', 8),
(1158, 'Earned 50 sab ammo', '1658945314', 8),
(1159, 'Earned 215 mcb50 ammo', '1658945316', 8),
(1160, 'Earned 35 plt21 ammo', '1658945317', 8),
(1161, 'Earned 100 mcb25 ammo', '1658945317', 8),
(1162, 'Earned 115 mcb50 ammo', '1658945318', 8),
(1163, 'Earned 35 plt21 ammo', '1658945318', 8),
(1164, 'Earned 10 pld ammo', '1658945319', 8),
(1165, 'Earned 215 mcb50 ammo', '1658945319', 8),
(1166, 'Earned 150 sab ammo', '1658945320', 8),
(1167, 'Earned 75 mcb50 ammo', '1658945320', 8),
(1168, 'Earned 100 mcb25 ammo', '1658945321', 8),
(1169, 'Earned 50 sab ammo', '1658945321', 8),
(1170, 'Earned 100 mcb25 ammo', '1658945322', 8),
(1171, 'Earned 1 parts of Delta gate', '1658945322', 8),
(1172, 'Earned 215 mcb50 ammo', '1658945323', 8),
(1173, 'Earned 100 mcb25 ammo', '1658945324', 8),
(1174, 'Earned 3 parts of Delta gate', '1658945324', 8),
(1175, 'Earned 25 plt21 ammo', '1658945325', 8),
(1176, 'Earned 215 mcb50 ammo', '1658945325', 8),
(1177, 'Earned 115 mcb50 ammo', '1658945326', 8),
(1178, 'Earned 150 sab ammo', '1658945326', 8),
(1179, 'Earned 35 plt21 ammo', '1658945326', 8),
(1180, 'Earned 150 sab ammo', '1658945326', 8),
(1181, 'Earned 1 parts of Delta gate', '1658945327', 8),
(1182, 'Earned 150 sab ammo', '1658945327', 8),
(1183, 'Earned 25 plt21 ammo', '1658945327', 8),
(1184, 'Earned 75 mcb50 ammo', '1658945327', 8),
(1185, 'Earned 25 plt21 ammo', '1658945328', 8),
(1186, 'Earned 1 parts of Delta gate', '1658945328', 8),
(1187, 'Earned 1 parts of Delta gate', '1658945328', 8),
(1188, 'Earned 100 mcb25 ammo', '1658945328', 8),
(1189, 'Earned 35 plt21 ammo', '1658945328', 8),
(1190, 'Earned 215 mcb50 ammo', '1658945329', 8),
(1191, 'Earned 2 parts of Delta gate', '1658945329', 8),
(1192, 'Earned 85 mcb25 ammo', '1658945329', 8),
(1193, 'Earned 3 parts of Delta gate', '1658945329', 8),
(1194, 'Earned 215 mcb50 ammo', '1658945330', 8),
(1195, 'Earned 100 mcb25 ammo', '1658945330', 8),
(1196, 'Earned 35 plt21 ammo', '1658945330', 8),
(1197, 'Earned 100 mcb25 ammo', '1658945330', 8),
(1198, 'Earned 100 mcb25 ammo', '1658945331', 8),
(1199, 'Earned 100 mcb25 ammo', '1658945331', 8),
(1200, 'Earned 1 parts of Delta gate', '1658945332', 8),
(1201, 'Earned 100 mcb25 ammo', '1658945332', 8),
(1202, 'Earned 1 parts of Delta gate', '1658945332', 8),
(1203, 'Earned 10 pld ammo', '1658945332', 8),
(1204, 'Earned 1 parts of Delta gate', '1658945333', 8),
(1205, 'Earned 215 mcb50 ammo', '1658945333', 8),
(1206, 'Earned 3 parts of Delta gate', '1658945333', 8),
(1207, 'Earned 100 mcb25 ammo', '1658945333', 8),
(1208, 'Earned 225 sab ammo', '1658945334', 8),
(1209, 'Earned 100 mcb25 ammo', '1658945334', 8),
(1210, 'Earned 100 mcb25 ammo', '1658945334', 8),
(1211, 'Earned 10 pld ammo', '1658945335', 8),
(1212, 'Earned 115 mcb50 ammo', '1658945335', 8),
(1213, 'Earned 3 parts of Delta gate', '1658945335', 8),
(1214, 'Earned 225 sab ammo', '1658945336', 8),
(1215, 'Earned 85 mcb25 ammo', '1658945336', 8),
(1216, 'Earned 10 pld ammo', '1658945336', 8),
(1217, 'Earned 100 mcb25 ammo', '1658945336', 8),
(1218, 'Earned 150 sab ammo', '1658945336', 8),
(1219, 'Earned 115 mcb50 ammo', '1658945337', 8),
(1220, 'Earned 10 pld ammo', '1658945337', 8),
(1221, 'Earned 10 pld ammo', '1658945337', 8),
(1222, 'Earned 100 mcb25 ammo', '1658945337', 8),
(1223, 'Earned 225 sab ammo', '1658945338', 8),
(1224, 'Earned 215 mcb50 ammo', '1658945338', 8),
(1225, 'Earned 225 sab ammo', '1658945338', 8),
(1226, 'Earned 215 mcb50 ammo', '1658945338', 8),
(1227, 'Earned 115 mcb50 ammo', '1658945338', 8),
(1228, 'Earned 3 parts of Delta gate', '1658945339', 8),
(1229, 'Earned 225 sab ammo', '1658945339', 8),
(1230, 'Earned 215 mcb50 ammo', '1658945339', 8),
(1231, 'Earned 3 parts of Delta gate', '1658945339', 8),
(1232, 'Earned 100 mcb25 ammo', '1658945339', 8),
(1233, 'Earned 215 mcb50 ammo', '1658945339', 8),
(1234, 'Earned 150 sab ammo', '1658945340', 8),
(1235, 'Earned 10 pld ammo', '1658945340', 8),
(1236, 'Earned 75 mcb50 ammo', '1658945344', 8),
(1237, 'Earned 1 parts of Delta gate', '1658945344', 8),
(1238, 'Earned 140 mcb25 ammo', '1658945344', 8),
(1239, 'Earned 10 pld ammo', '1658945345', 8),
(1240, 'Earned 100 mcb25 ammo', '1658945345', 8),
(1241, 'Earned 25 plt21 ammo', '1658945345', 8),
(1242, 'Earned 85 mcb25 ammo', '1658945345', 8),
(1243, 'Earned 3 parts of Delta gate', '1658945345', 8),
(1244, 'Earned 100 mcb25 ammo', '1658945346', 8),
(1245, 'Earned 35 plt21 ammo', '1658945346', 8),
(1246, 'Earned 100 mcb25 ammo', '1658945346', 8),
(1247, 'Earned 85 mcb25 ammo', '1658945346', 8),
(1248, 'Earned 75 mcb50 ammo', '1658945346', 8),
(1249, 'Earned 215 mcb50 ammo', '1658945347', 8),
(1250, 'Earned 100 mcb25 ammo', '1658945347', 8),
(1251, 'Earned 10 pld ammo', '1658945347', 8),
(1252, 'Earned 25 plt21 ammo', '1658945347', 8),
(1253, 'Earned 25 plt21 ammo', '1658945347', 8),
(1254, 'Earned 1 parts of Delta gate', '1658945348', 8),
(1255, 'Earned 1 parts of Delta gate', '1658945348', 8),
(1256, 'Earned 140 mcb25 ammo', '1658945348', 8),
(1257, 'Earned 25 plt21 ammo', '1658945348', 8),
(1258, 'Earned 215 mcb50 ammo', '1658945348', 8),
(1259, 'Earned 25 plt21 ammo', '1658945349', 8),
(1260, 'Earned 1 parts of Delta gate', '1658945349', 8),
(1261, 'Earned 150 sab ammo', '1658945349', 8),
(1262, 'Earned 75 mcb50 ammo', '1658945349', 8),
(1263, 'Earned 50 sab ammo', '1658945349', 8),
(1264, 'Earned 75 mcb50 ammo', '1658945350', 8),
(1265, 'Earned 1 parts of Delta gate', '1658945350', 8),
(1266, 'Earned 100 mcb25 ammo', '1658945350', 8),
(1267, 'Earned 150 sab ammo', '1658945350', 8),
(1268, 'Earned 215 mcb50 ammo', '1658945350', 8),
(1269, 'Earned 25 plt21 ammo', '1658945351', 8),
(1270, 'Earned 3 parts of Delta gate', '1658945351', 8),
(1271, 'Earned 150 sab ammo', '1658945351', 8),
(1272, 'Earned 215 mcb50 ammo', '1658945351', 8),
(1273, 'Earned 215 mcb50 ammo', '1658945351', 8),
(1274, 'Earned 215 mcb50 ammo', '1658945352', 8),
(1275, 'Earned 140 mcb25 ammo', '1658945352', 8),
(1276, 'Earned 1 parts of Delta gate', '1658945352', 8),
(1277, 'Earned 50 sab ammo', '1658945352', 8),
(1278, 'Earned 1 parts of Delta gate', '1658945353', 8),
(1279, 'Earned 215 mcb50 ammo', '1658945353', 8),
(1280, 'Earned 225 sab ammo', '1658945353', 8),
(1281, 'Earned 100 mcb25 ammo', '1658945353', 8),
(1282, 'Earned 2 parts of Delta gate', '1658945353', 8),
(1283, 'Earned 115 mcb50 ammo', '1658945353', 8),
(1284, 'Earned 3 parts of Delta gate', '1658945354', 8),
(1285, 'Earned 3 parts of Delta gate', '1658945354', 8),
(1286, 'Earned 100 mcb25 ammo', '1658945354', 8),
(1287, 'Earned 75 mcb50 ammo', '1658945354', 8),
(1288, 'Earned 225 sab ammo', '1658945354', 8),
(1289, 'Earned 100 mcb25 ammo', '1658945355', 8),
(1290, 'Earned 100 mcb25 ammo', '1658945355', 8),
(1291, 'Earned 150 sab ammo', '1658945355', 8),
(1292, 'Earned 35 plt21 ammo', '1658945355', 8),
(1293, 'Earned 25 plt21 ammo', '1658945355', 8),
(1294, 'Earned 10 pld ammo', '1658945356', 8),
(1295, 'Earned 225 sab ammo', '1658945356', 8),
(1296, 'Earned 10 pld ammo', '1658945356', 8),
(1297, 'Earned 1 parts of Delta gate', '1658945356', 8),
(1298, 'Earned 35 plt21 ammo', '1658945357', 8),
(1299, 'Earned 215 mcb50 ammo', '1658945357', 8),
(1300, 'Earned 140 mcb25 ammo', '1658945357', 8),
(1301, 'Earned 115 mcb50 ammo', '1658945357', 8),
(1302, 'Earned 10 pld ammo', '1658945357', 8),
(1303, 'Earned 225 sab ammo', '1658945358', 8),
(1304, 'Earned 25 plt21 ammo', '1658945359', 8),
(1305, 'Earned 215 mcb50 ammo', '1658945359', 8),
(1306, 'Earned 1 parts of Delta gate', '1658945360', 8),
(1307, 'Earned 100 mcb25 ammo', '1658945360', 8),
(1308, 'Earned 3 parts of Delta gate', '1658945360', 8),
(1309, 'Earned 100 mcb25 ammo', '1658945360', 8),
(1310, 'Earned 115 mcb50 ammo', '1658945361', 8),
(1311, 'Earned 140 mcb25 ammo', '1658945361', 8),
(1312, 'Earned 3 parts of Delta gate', '1658945361', 8),
(1313, 'Earned 1 parts of Delta gate', '1658945361', 8),
(1314, 'Earned 25 plt21 ammo', '1658945361', 8),
(1315, 'Earned 225 sab ammo', '1658945362', 8),
(1316, 'Earned 10 pld ammo', '1658945362', 8),
(1317, 'Earned 1 parts of Delta gate', '1658945362', 8),
(1318, 'Earned 2 parts of Delta gate', '1658945362', 8),
(1319, 'Earned 215 mcb50 ammo', '1658945362', 8),
(1320, 'Earned 1 parts of Delta gate', '1658945363', 8),
(1321, 'Earned 2 parts of Delta gate', '1658945363', 8),
(1322, 'Earned 115 mcb50 ammo', '1658945363', 8),
(1323, 'Earned 1 parts of Delta gate', '1658945363', 8),
(1324, 'Earned 50 sab ammo', '1658945363', 8),
(1325, 'Earned 215 mcb50 ammo', '1658945364', 8),
(1326, 'Earned 85 mcb25 ammo', '1658945364', 8),
(1327, 'Earned 225 sab ammo', '1658945364', 8),
(1328, 'Earned 215 mcb50 ammo', '1658945364', 8),
(1329, 'Earned 100 mcb25 ammo', '1658945365', 8),
(1330, 'Earned 1 parts of Delta gate', '1658945365', 8),
(1331, 'Earned 140 mcb25 ammo', '1658945365', 8),
(1332, 'Earned 85 mcb25 ammo', '1658945365', 8),
(1333, 'Earned 35 plt21 ammo', '1658945365', 8),
(1334, 'Earned 215 mcb50 ammo', '1658945366', 8),
(1335, 'Earned 50 sab ammo', '1658945366', 8),
(1336, 'Earned 150 sab ammo', '1658945366', 8),
(1337, 'Earned 100 mcb25 ammo', '1658945366', 8),
(1338, 'Earned 115 mcb50 ammo', '1658945366', 8),
(1339, 'Earned 75 mcb50 ammo', '1658945367', 8),
(1340, 'Earned 75 mcb50 ammo', '1658945367', 8),
(1341, 'Earned 35 plt21 ammo', '1658945367', 8),
(1342, 'Earned 215 mcb50 ammo', '1658945367', 8),
(1343, 'Earned 50 sab ammo', '1658945367', 8),
(1344, 'Earned 75 mcb50 ammo', '1658945368', 8),
(1345, 'Earned 50 sab ammo', '1658945368', 8),
(1346, 'Earned 215 mcb50 ammo', '1658945368', 8),
(1347, 'Earned 100 mcb25 ammo', '1658945368', 8),
(1348, 'Earned 100 mcb25 ammo', '1658945368', 8),
(1349, 'Earned 140 mcb25 ammo', '1658945369', 8),
(1350, 'Earned 225 sab ammo', '1658945369', 8),
(1351, 'Earned 150 sab ammo', '1658945369', 8),
(1352, 'Earned 35 plt21 ammo', '1658945369', 8),
(1353, 'Earned 1 parts of Delta gate', '1658945370', 8),
(1354, 'Earned 10 pld ammo', '1658945370', 8),
(1355, 'Earned 50 sab ammo', '1658945370', 8),
(1356, 'Earned 215 mcb50 ammo', '1658945370', 8),
(1357, 'Earned 100 mcb25 ammo', '1658945370', 8),
(1358, 'Earned 140 mcb25 ammo', '1658945371', 8),
(1359, 'Earned 140 mcb25 ammo', '1658945371', 8),
(1360, 'Earned 215 mcb50 ammo', '1658945371', 8),
(1361, 'Earned 25 plt21 ammo', '1658945371', 8),
(1362, 'Earned 100 mcb25 ammo', '1658945371', 8),
(1363, 'Earned 35 plt21 ammo', '1658945372', 8),
(1364, 'Earned 3 parts of Delta gate. Sucesfully unlocked gate.', '1658945372', 8),
(1365, 'Earned 1 parts of Alpha gate', '1659174827', 10),
(1366, 'Earned 100 mcb25 ammo', '1659174827', 10),
(1367, 'Earned 35 plt21 ammo', '1659174827', 10),
(1368, 'Earned 75 mcb50 ammo', '1659174827', 10),
(1369, 'Earned 100 mcb25 ammo', '1659174827', 10),
(1370, 'Earned 215 mcb50 ammo', '1659174827', 10),
(1371, 'Earned 150 sab ammo', '1659174828', 10),
(1372, 'Earned 100 mcb25 ammo', '1659174828', 10),
(1373, 'Earned 25 plt21 ammo', '1659174828', 10),
(1374, 'Earned 75 mcb50 ammo', '1659174828', 10),
(1375, 'Earned 50 sab ammo', '1659174828', 10),
(1376, 'Earned 85 mcb25 ammo', '1659174828', 10),
(1377, 'Earned 85 mcb25 ammo', '1659174829', 10),
(1378, 'Earned 1 parts of Alpha gate', '1659174829', 10),
(1379, 'Earned 75 mcb50 ammo', '1659174829', 10),
(1380, 'Earned 140 mcb25 ammo', '1659174829', 10),
(1381, 'Earned 35 plt21 ammo', '1659174829', 10),
(1382, 'Earned 215 mcb50 ammo', '1659174829', 10),
(1383, 'Earned 2 parts of Alpha gate', '1659174830', 10),
(1384, 'Earned 10 pld ammo', '1659174830', 10),
(1385, 'Earned 215 mcb50 ammo', '1659174830', 10),
(1386, 'Earned 215 mcb50 ammo', '1659174830', 10),
(1387, 'Earned 100 mcb25 ammo', '1659174830', 10),
(1388, 'Earned 1 parts of Alpha gate', '1659174831', 10),
(1389, 'Earned 150 sab ammo', '1659174831', 10),
(1390, 'Earned 85 mcb25 ammo', '1659174831', 10),
(1391, 'Earned 215 mcb50 ammo', '1659174831', 10),
(1392, 'Earned 25 plt21 ammo', '1659174831', 10),
(1393, 'Earned 150 sab ammo', '1659174831', 10),
(1394, 'Earned 215 mcb50 ammo', '1659174832', 10),
(1395, 'Earned 35 plt21 ammo', '1659174832', 10),
(1396, 'Earned 50 sab ammo', '1659174832', 10),
(1397, 'Earned 100 mcb25 ammo', '1659174832', 10),
(1398, 'Earned 100 mcb25 ammo', '1659174832', 10),
(1399, 'Earned 100 mcb25 ammo', '1659174833', 10),
(1400, 'Earned 50 sab ammo', '1659174833', 10),
(1401, 'Earned 150 sab ammo', '1659174833', 10),
(1402, 'Earned 215 mcb50 ammo', '1659174833', 10),
(1403, 'Earned 1 parts of Alpha gate', '1659174833', 10),
(1404, 'Earned 225 sab ammo', '1659174834', 10),
(1405, 'Earned 115 mcb50 ammo', '1659174834', 10),
(1406, 'Earned 115 mcb50 ammo', '1659174834', 10),
(1407, 'Earned 215 mcb50 ammo', '1659174834', 10),
(1408, 'Earned 1 parts of Alpha gate', '1659174834', 10),
(1409, 'Earned 150 sab ammo', '1659174835', 10),
(1410, 'Earned 25 plt21 ammo', '1659174835', 10),
(1411, 'Earned 215 mcb50 ammo', '1659174835', 10),
(1412, 'Earned 10 pld ammo', '1659174835', 10),
(1413, 'Earned 1 parts of Alpha gate', '1659174835', 10),
(1414, 'Earned 100 mcb25 ammo', '1659174836', 10),
(1415, 'Earned 140 mcb25 ammo', '1659174837', 10),
(1416, 'Earned 1 parts of Alpha gate', '1659174838', 10),
(1417, 'Earned 85 mcb25 ammo', '1659174838', 10),
(1418, 'Earned 1 parts of Alpha gate', '1659174838', 10),
(1419, 'Earned 215 mcb50 ammo', '1659174838', 10),
(1420, 'Earned 1 parts of Alpha gate', '1659174839', 10),
(1421, 'Earned 25 plt21 ammo', '1659174839', 10),
(1422, 'Earned 35 plt21 ammo', '1659174839', 10),
(1423, 'Earned 10 pld ammo', '1659174839', 10),
(1424, 'Earned 115 mcb50 ammo', '1659174840', 10),
(1425, 'Earned 25 plt21 ammo', '1659174840', 10),
(1426, 'Earned 1 parts of Alpha gate', '1659174840', 10),
(1427, 'Earned 100 mcb25 ammo', '1659174840', 10),
(1428, 'Earned 10 pld ammo', '1659174840', 10),
(1429, 'Earned 225 sab ammo', '1659174840', 10),
(1430, 'Earned 225 sab ammo', '1659174841', 10),
(1431, 'Earned 25 plt21 ammo', '1659174841', 10),
(1432, 'Earned 1 parts of Alpha gate', '1659174841', 10),
(1433, 'Earned 140 mcb25 ammo', '1659174841', 10),
(1434, 'Earned 140 mcb25 ammo', '1659174841', 10),
(1435, 'Earned 75 mcb50 ammo', '1659174842', 10),
(1436, 'Earned 10 pld ammo', '1659174842', 10),
(1437, 'Earned 1 parts of Alpha gate', '1659174842', 10),
(1438, 'Earned 35 plt21 ammo', '1659174842', 10),
(1439, 'Earned 75 mcb50 ammo', '1659174842', 10),
(1440, 'Earned 10 pld ammo', '1659174842', 10),
(1441, 'Earned 150 sab ammo', '1659174843', 10),
(1442, 'Earned 215 mcb50 ammo', '1659174843', 10),
(1443, 'Earned 215 mcb50 ammo', '1659174843', 10),
(1444, 'Earned 215 mcb50 ammo', '1659174843', 10),
(1445, 'Earned 100 mcb25 ammo', '1659174843', 10),
(1446, 'Earned 3 parts of Alpha gate', '1659174844', 10),
(1447, 'Earned 1 parts of Alpha gate', '1659174844', 10),
(1448, 'Earned 10 pld ammo', '1659174844', 10),
(1449, 'Earned 215 mcb50 ammo', '1659174844', 10),
(1450, 'Earned 1 parts of Alpha gate', '1659174844', 10),
(1451, 'Earned 50 sab ammo', '1659174845', 10),
(1452, 'Earned 100 mcb25 ammo', '1659174845', 10),
(1453, 'Earned 1 parts of Alpha gate', '1659174845', 10),
(1454, 'Earned 1 parts of Alpha gate', '1659174845', 10),
(1455, 'Earned 50 sab ammo', '1659174845', 10),
(1456, 'Earned 2 parts of Alpha gate', '1659174845', 10),
(1457, 'Earned 10 pld ammo', '1659174846', 10),
(1458, 'Earned 215 mcb50 ammo', '1659174846', 10),
(1459, 'Earned 100 mcb25 ammo', '1659174846', 10),
(1460, 'Earned 1 parts of Alpha gate', '1659174846', 10),
(1461, 'Earned 3 parts of Alpha gate', '1659174846', 10),
(1462, 'Earned 115 mcb50 ammo', '1659174847', 10),
(1463, 'Earned 225 sab ammo', '1659174847', 10),
(1464, 'Earned 215 mcb50 ammo', '1659174847', 10),
(1465, 'Earned 3 parts of Alpha gate', '1659174847', 10),
(1466, 'Earned 215 mcb50 ammo', '1659174847', 10),
(1467, 'Earned 215 mcb50 ammo', '1659174848', 10),
(1468, 'Earned 2 parts of Alpha gate', '1659174848', 10),
(1469, 'Earned 100 mcb25 ammo', '1659174848', 10),
(1470, 'Earned 35 plt21 ammo', '1659174848', 10),
(1471, 'Earned 35 plt21 ammo', '1659174848', 10),
(1472, 'Earned 1 parts of Alpha gate', '1659174849', 10),
(1473, 'Earned 50 sab ammo', '1659174849', 10),
(1474, 'Earned 35 plt21 ammo', '1659174849', 10),
(1475, 'Earned 1 parts of Alpha gate. Sucesfully unlocked gate.', '1659174849', 10),
(1476, 'Earned 100 mcb25 ammo', '1659266875', 10),
(1477, 'Earned 75 mcb50 ammo', '1659266875', 10),
(1478, 'Earned 1 parts of Kronos gate', '1659266875', 10),
(1479, 'Earned 85 mcb25 ammo', '1659266876', 10),
(1480, 'Earned 10 pld ammo', '1659266876', 10),
(1481, 'Earned 140 mcb25 ammo', '1659266876', 10),
(1482, 'Earned 215 mcb50 ammo', '1659266876', 10),
(1483, 'Earned 100 mcb25 ammo', '1659266877', 10),
(1484, 'Earned 35 plt21 ammo', '1659266877', 10),
(1485, 'Earned 215 mcb50 ammo', '1659266877', 10),
(1486, 'Earned 1 parts of Kronos gate', '1659266877', 10),
(1487, 'Earned 100 mcb25 ammo', '1659266877', 10),
(1488, 'Earned 10 pld ammo', '1659266877', 10),
(1489, 'Earned 100 mcb25 ammo', '1659266878', 10),
(1490, 'Earned 1 parts of Kronos gate', '1659266878', 10),
(1491, 'Earned 100 mcb25 ammo', '1659266878', 10),
(1492, 'Earned 3 parts of Kronos gate', '1659266878', 10),
(1493, 'Earned 2 parts of Kronos gate', '1659266878', 10),
(1494, 'Earned 100 mcb25 ammo', '1659266879', 10),
(1495, 'Earned 3 parts of Kronos gate', '1659266879', 10),
(1496, 'Earned 50 sab ammo', '1659266879', 10),
(1497, 'Earned 150 sab ammo', '1659266879', 10),
(1498, 'Earned 2 parts of Kronos gate', '1659266879', 10),
(1499, 'Earned 25 plt21 ammo', '1659266880', 10),
(1500, 'Earned 1 parts of Kronos gate', '1659266880', 10),
(1501, 'Earned 2 parts of Kronos gate', '1659266880', 10),
(1502, 'Earned 100 mcb25 ammo', '1659266880', 10),
(1503, 'Earned 1 parts of Kronos gate', '1659266880', 10),
(1504, 'Earned 215 mcb50 ammo', '1659266881', 10),
(1505, 'Earned 225 sab ammo', '1659266881', 10),
(1506, 'Earned 100 mcb25 ammo', '1659266881', 10),
(1507, 'Earned 225 sab ammo', '1659266881', 10),
(1508, 'Earned 1 parts of Kronos gate', '1659266881', 10),
(1509, 'Earned 10 pld ammo', '1659266881', 10),
(1510, 'Earned 25 plt21 ammo', '1659266882', 10),
(1511, 'Earned 100 mcb25 ammo', '1659266882', 10),
(1512, 'Earned 215 mcb50 ammo', '1659266882', 10),
(1513, 'Earned 1 parts of Kronos gate', '1659266882', 10),
(1514, 'Earned 3 parts of Kronos gate', '1659266882', 10),
(1515, 'Earned 1 parts of Kronos gate', '1659266883', 10),
(1516, 'Earned 25 plt21 ammo', '1659266883', 10),
(1517, 'Earned 50 sab ammo', '1659266883', 10),
(1518, 'Earned 150 sab ammo', '1659266883', 10),
(1519, 'Earned 3 parts of Kronos gate', '1659266884', 10),
(1520, 'Earned 100 mcb25 ammo', '1659266884', 10),
(1521, 'Earned 35 plt21 ammo', '1659266884', 10),
(1522, 'Earned 85 mcb25 ammo', '1659266884', 10),
(1523, 'Earned 25 plt21 ammo', '1659266884', 10),
(1524, 'Earned 75 mcb50 ammo', '1659266885', 10),
(1525, 'Earned 225 sab ammo', '1659266885', 10),
(1526, 'Earned 1 parts of Kronos gate', '1659266885', 10),
(1527, 'Earned 115 mcb50 ammo', '1659266885', 10),
(1528, 'Earned 215 mcb50 ammo', '1659266885', 10),
(1529, 'Earned 100 mcb25 ammo', '1659266885', 10),
(1530, 'Earned 75 mcb50 ammo', '1659266886', 10),
(1531, 'Earned 140 mcb25 ammo', '1659266886', 10),
(1532, 'Earned 75 mcb50 ammo', '1659266886', 10),
(1533, 'Earned 25 plt21 ammo', '1659266886', 10),
(1534, 'Earned 2 parts of Kronos gate', '1659266886', 10),
(1535, 'Earned 10 pld ammo', '1659266887', 10),
(1536, 'Earned 85 mcb25 ammo', '1659266887', 10),
(1537, 'Earned 1 parts of Kronos gate', '1659266887', 10),
(1538, 'Earned 100 mcb25 ammo', '1659266887', 10),
(1539, 'Earned 100 mcb25 ammo', '1659266887', 10),
(1540, 'Earned 215 mcb50 ammo', '1659266888', 10),
(1541, 'Earned 100 mcb25 ammo', '1659266888', 10),
(1542, 'Earned 100 mcb25 ammo', '1659266888', 10),
(1543, 'Earned 1 parts of Kronos gate', '1659266888', 10),
(1544, 'Earned 100 mcb25 ammo', '1659266888', 10),
(1545, 'Earned 50 sab ammo', '1659266888', 10),
(1546, 'Earned 140 mcb25 ammo', '1659266889', 10),
(1547, 'Earned 35 plt21 ammo', '1659266889', 10),
(1548, 'Earned 85 mcb25 ammo', '1659266889', 10),
(1549, 'Earned 140 mcb25 ammo', '1659266889', 10),
(1550, 'Earned 100 mcb25 ammo', '1659266889', 10),
(1551, 'Earned 1 parts of Kronos gate', '1659266890', 10),
(1552, 'Earned 3 parts of Kronos gate', '1659266890', 10),
(1553, 'Earned 1 parts of Kronos gate', '1659266890', 10),
(1554, 'Earned 50 sab ammo', '1659266890', 10),
(1555, 'Earned 50 sab ammo', '1659266890', 10),
(1556, 'Earned 25 plt21 ammo', '1659266891', 10),
(1557, 'Earned 50 sab ammo', '1659266891', 10),
(1558, 'Earned 1 parts of Kronos gate', '1659266891', 10),
(1559, 'Earned 215 mcb50 ammo', '1659266891', 10),
(1560, 'Earned 100 mcb25 ammo', '1659266891', 10),
(1561, 'Earned 150 sab ammo', '1659266892', 10),
(1562, 'Earned 115 mcb50 ammo', '1659266892', 10),
(1563, 'Earned 50 sab ammo', '1659266892', 10),
(1564, 'Earned 35 plt21 ammo', '1659266892', 10),
(1565, 'Earned 35 plt21 ammo', '1659266892', 10),
(1566, 'Earned 35 plt21 ammo', '1659266893', 10),
(1567, 'Earned 85 mcb25 ammo', '1659266893', 10),
(1568, 'Earned 215 mcb50 ammo', '1659266893', 10),
(1569, 'Earned 1 parts of Kronos gate', '1659266893', 10),
(1570, 'Earned 85 mcb25 ammo', '1659266893', 10),
(1571, 'Earned 225 sab ammo', '1659266893', 10),
(1572, 'Earned 150 sab ammo', '1659266894', 10),
(1573, 'Earned 215 mcb50 ammo', '1659266894', 10),
(1574, 'Earned 35 plt21 ammo', '1659266916', 10),
(1575, 'Earned 225 sab ammo', '1659266916', 10),
(1576, 'Earned 100 mcb25 ammo', '1659266917', 10),
(1577, 'Earned 115 mcb50 ammo', '1659266917', 10),
(1578, 'Earned 225 sab ammo', '1659266917', 10),
(1579, 'Earned 10 pld ammo', '1659266917', 10),
(1580, 'Earned 115 mcb50 ammo', '1659266917', 10),
(1581, 'Earned 75 mcb50 ammo', '1659266918', 10),
(1582, 'Earned 150 sab ammo', '1659266918', 10),
(1583, 'Earned 75 mcb50 ammo', '1659266918', 10),
(1584, 'Earned 50 sab ammo', '1659266918', 10),
(1585, 'Earned 115 mcb50 ammo', '1659266918', 10),
(1586, 'Earned 3 parts of Kronos gate', '1659266918', 10),
(1587, 'Earned 85 mcb25 ammo', '1659266919', 10),
(1588, 'Earned 150 sab ammo', '1659266919', 10),
(1589, 'Earned 1 parts of Kronos gate', '1659266919', 10),
(1590, 'Earned 215 mcb50 ammo', '1659266919', 10),
(1591, 'Earned 100 mcb25 ammo', '1659266920', 10),
(1592, 'Earned 100 mcb25 ammo', '1659266920', 10),
(1593, 'Earned 85 mcb25 ammo', '1659266920', 10),
(1594, 'Earned 10 pld ammo', '1659266920', 10),
(1595, 'Earned 215 mcb50 ammo', '1659266920', 10),
(1596, 'Earned 140 mcb25 ammo', '1659266920', 10),
(1597, 'Earned 35 plt21 ammo', '1659266921', 10),
(1598, 'Earned 1 parts of Kronos gate', '1659266921', 10),
(1599, 'Earned 35 plt21 ammo', '1659266921', 10),
(1600, 'Earned 10 pld ammo', '1659266921', 10),
(1601, 'Earned 150 sab ammo', '1659266921', 10),
(1602, 'Earned 85 mcb25 ammo', '1659266922', 10),
(1603, 'Earned 50 sab ammo', '1659266922', 10),
(1604, 'Earned 3 parts of Kronos gate', '1659266922', 10),
(1605, 'Earned 225 sab ammo', '1659266922', 10),
(1606, 'Earned 225 sab ammo', '1659266922', 10),
(1607, 'Earned 115 mcb50 ammo', '1659266922', 10),
(1608, 'Earned 50 sab ammo', '1659266923', 10),
(1609, 'Earned 85 mcb25 ammo', '1659266923', 10),
(1610, 'Earned 115 mcb50 ammo', '1659266923', 10),
(1611, 'Earned 50 sab ammo', '1659266923', 10),
(1612, 'Earned 25 plt21 ammo', '1659266924', 10),
(1613, 'Earned 75 mcb50 ammo', '1659266924', 10),
(1614, 'Earned 150 sab ammo', '1659266924', 10),
(1615, 'Earned 100 mcb25 ammo', '1659266924', 10),
(1616, 'Earned 215 mcb50 ammo', '1659266924', 10),
(1617, 'Earned 100 mcb25 ammo', '1659266924', 10),
(1618, 'Earned 100 mcb25 ammo', '1659266925', 10),
(1619, 'Earned 100 mcb25 ammo', '1659266925', 10),
(1620, 'Earned 25 plt21 ammo', '1659266925', 10),
(1621, 'Earned 100 mcb25 ammo', '1659266925', 10),
(1622, 'Earned 100 mcb25 ammo', '1659266925', 10),
(1623, 'Earned 25 plt21 ammo', '1659266926', 10),
(1624, 'Earned 1 parts of Kronos gate', '1659266926', 10),
(1625, 'Earned 85 mcb25 ammo', '1659266926', 10),
(1626, 'Earned 10 pld ammo', '1659266926', 10),
(1627, 'Earned 2 parts of Kronos gate', '1659266926', 10),
(1628, 'Earned 75 mcb50 ammo', '1659266927', 10),
(1629, 'Earned 140 mcb25 ammo', '1659266927', 10),
(1630, 'Earned 100 mcb25 ammo', '1659266927', 10),
(1631, 'Earned 215 mcb50 ammo', '1659266927', 10),
(1632, 'Earned 75 mcb50 ammo', '1659266927', 10),
(1633, 'Earned 140 mcb25 ammo', '1659266928', 10),
(1634, 'Earned 100 mcb25 ammo', '1659266928', 10),
(1635, 'Earned 100 mcb25 ammo', '1659266928', 10),
(1636, 'Earned 50 sab ammo', '1659266928', 10),
(1637, 'Earned 10 pld ammo', '1659266928', 10),
(1638, 'Earned 35 plt21 ammo', '1659266929', 10),
(1639, 'Earned 140 mcb25 ammo', '1659266929', 10),
(1640, 'Earned 1 parts of Kronos gate', '1659266929', 10),
(1641, 'Earned 35 plt21 ammo', '1659266929', 10),
(1642, 'Earned 3 parts of Kronos gate', '1659266929', 10),
(1643, 'Earned 1 parts of Kronos gate', '1659266930', 10),
(1644, 'Earned 3 parts of Kronos gate', '1659266930', 10),
(1645, 'Earned 150 sab ammo', '1659266930', 10),
(1646, 'Earned 115 mcb50 ammo', '1659266930', 10),
(1647, 'Earned 215 mcb50 ammo', '1659266930', 10),
(1648, 'Earned 115 mcb50 ammo', '1659266931', 10),
(1649, 'Earned 150 sab ammo', '1659266931', 10),
(1650, 'Earned 10 pld ammo', '1659266931', 10),
(1651, 'Earned 1 parts of Kronos gate', '1659266931', 10),
(1652, 'Earned 140 mcb25 ammo', '1659266931', 10),
(1653, 'Earned 100 mcb25 ammo', '1659266932', 10),
(1654, 'Earned 1 parts of Kronos gate', '1659266932', 10),
(1655, 'Earned 225 sab ammo', '1659266932', 10),
(1656, 'Earned 225 sab ammo', '1659266932', 10),
(1657, 'Earned 50 sab ammo', '1659266932', 10),
(1658, 'Earned 3 parts of Kronos gate', '1659266933', 10),
(1659, 'Earned 85 mcb25 ammo', '1659266933', 10),
(1660, 'Earned 1 parts of Kronos gate', '1659266934', 10),
(1661, 'Earned 215 mcb50 ammo', '1659266935', 10),
(1662, 'Earned 1 parts of Kronos gate', '1659266936', 10),
(1663, 'Earned 10 pld ammo', '1659266937', 10),
(1664, 'Earned 115 mcb50 ammo', '1659266937', 10),
(1665, 'Earned 100 mcb25 ammo', '1659266938', 10),
(1666, 'Earned 100 mcb25 ammo', '1659266938', 10),
(1667, 'Earned 1 parts of Kronos gate', '1659266938', 10),
(1668, 'Earned 115 mcb50 ammo', '1659266939', 10),
(1669, 'Earned 3 parts of Kronos gate', '1659266939', 10),
(1670, 'Earned 215 mcb50 ammo', '1659266939', 10),
(1671, 'Earned 50 sab ammo', '1659266939', 10),
(1672, 'Earned 140 mcb25 ammo', '1659266939', 10),
(1673, 'Earned 1 parts of Kronos gate', '1659266940', 10),
(1674, 'Earned 215 mcb50 ammo', '1659266940', 10),
(1675, 'Earned 100 mcb25 ammo', '1659266941', 10),
(1676, 'Earned 25 plt21 ammo', '1659266941', 10),
(1677, 'Earned 100 mcb25 ammo', '1659266942', 10),
(1678, 'Earned 140 mcb25 ammo', '1659266942', 10),
(1679, 'Earned 150 sab ammo', '1659266943', 10),
(1680, 'Earned 50 sab ammo', '1659266943', 10),
(1681, 'Earned 1 parts of Kronos gate', '1659266943', 10),
(1682, 'Earned 85 mcb25 ammo', '1659266943', 10),
(1683, 'Earned 100 mcb25 ammo', '1659266944', 10),
(1684, 'Earned 75 mcb50 ammo', '1659266944', 10),
(1685, 'Earned 1 parts of Kronos gate', '1659266944', 10),
(1686, 'Earned 1 parts of Kronos gate', '1659266944', 10),
(1687, 'Earned 140 mcb25 ammo', '1659266944', 10),
(1688, 'Earned 150 sab ammo', '1659266945', 10),
(1689, 'Earned 215 mcb50 ammo', '1659266945', 10),
(1690, 'Earned 25 plt21 ammo', '1659266945', 10),
(1691, 'Earned 1 parts of Kronos gate', '1659266945', 10),
(1692, 'Earned 3 parts of Kronos gate', '1659266945', 10),
(1693, 'Earned 100 mcb25 ammo', '1659266946', 10),
(1694, 'Earned 10 pld ammo', '1659266946', 10),
(1695, 'Earned 1 parts of Kronos gate', '1659266946', 10),
(1696, 'Earned 100 mcb25 ammo', '1659266946', 10),
(1697, 'Earned 1 parts of Kronos gate', '1659266946', 10),
(1698, 'Earned 225 sab ammo', '1659266946', 10),
(1699, 'Earned 25 plt21 ammo', '1659266947', 10),
(1700, 'Earned 1 parts of Kronos gate', '1659266947', 10),
(1701, 'Earned 115 mcb50 ammo', '1659266947', 10),
(1702, 'Earned 100 mcb25 ammo', '1659266947', 10),
(1703, 'Earned 1 parts of Kronos gate', '1659266947', 10),
(1704, 'Earned 100 mcb25 ammo', '1659266948', 10),
(1705, 'Earned 100 mcb25 ammo', '1659266948', 10),
(1706, 'Earned 85 mcb25 ammo', '1659266948', 10),
(1707, 'Earned 1 parts of Kronos gate', '1659266948', 10),
(1708, 'Earned 115 mcb50 ammo', '1659266948', 10),
(1709, 'Earned 115 mcb50 ammo', '1659266949', 10),
(1710, 'Earned 215 mcb50 ammo', '1659266949', 10),
(1711, 'Earned 85 mcb25 ammo', '1659266949', 10),
(1712, 'Earned 25 plt21 ammo', '1659266949', 10),
(1713, 'Earned 150 sab ammo', '1659266949', 10),
(1714, 'Earned 215 mcb50 ammo', '1659266950', 10),
(1715, 'Earned 100 mcb25 ammo', '1659266950', 10),
(1716, 'Earned 215 mcb50 ammo', '1659266950', 10),
(1717, 'Earned 100 mcb25 ammo', '1659266950', 10),
(1718, 'Earned 75 mcb50 ammo', '1659266950', 10),
(1719, 'Earned 100 mcb25 ammo', '1659266951', 10),
(1720, 'Earned 100 mcb25 ammo', '1659266951', 10),
(1721, 'Earned 25 plt21 ammo', '1659266951', 10),
(1722, 'Earned 85 mcb25 ammo', '1659266951', 10),
(1723, 'Earned 150 sab ammo', '1659266951', 10),
(1724, 'Earned 140 mcb25 ammo', '1659266952', 10),
(1725, 'Earned 85 mcb25 ammo', '1659266952', 10),
(1726, 'Earned 215 mcb50 ammo', '1659266952', 10),
(1727, 'Earned 225 sab ammo', '1659266952', 10),
(1728, 'Earned 215 mcb50 ammo', '1659266952', 10),
(1729, 'Earned 10 pld ammo', '1659266953', 10),
(1730, 'Earned 100 mcb25 ammo', '1659266953', 10),
(1731, 'Earned 1 parts of Kronos gate', '1659266953', 10),
(1732, 'Earned 85 mcb25 ammo', '1659266953', 10),
(1733, 'Earned 215 mcb50 ammo', '1659266953', 10),
(1734, 'Earned 115 mcb50 ammo', '1659266953', 10),
(1735, 'Earned 1 parts of Kronos gate', '1659266954', 10),
(1736, 'Earned 50 sab ammo', '1659266954', 10),
(1737, 'Earned 1 parts of Kronos gate', '1659266954', 10),
(1738, 'Earned 25 plt21 ammo', '1659266954', 10),
(1739, 'Earned 100 mcb25 ammo', '1659266954', 10),
(1740, 'Earned 100 mcb25 ammo', '1659266955', 10),
(1741, 'Earned 10 pld ammo', '1659266955', 10),
(1742, 'Earned 215 mcb50 ammo', '1659266955', 10),
(1743, 'Earned 50 sab ammo', '1659266955', 10),
(1744, 'Earned 100 mcb25 ammo', '1659266955', 10),
(1745, 'Earned 1 parts of Kronos gate', '1659266956', 10),
(1746, 'Earned 50 sab ammo', '1659266956', 10),
(1747, 'Earned 50 sab ammo', '1659266956', 10),
(1748, 'Earned 215 mcb50 ammo', '1659266960', 10),
(1749, 'Earned 3 parts of Kronos gate', '1659266960', 10),
(1750, 'Earned 225 sab ammo', '1659266961', 10),
(1751, 'Earned 215 mcb50 ammo', '1659266961', 10),
(1752, 'Earned 100 mcb25 ammo', '1659266961', 10),
(1753, 'Earned 115 mcb50 ammo', '1659266961', 10),
(1754, 'Earned 225 sab ammo', '1659266962', 10),
(1755, 'Earned 25 plt21 ammo', '1659266962', 10),
(1756, 'Earned 150 sab ammo', '1659266962', 10),
(1757, 'Earned 225 sab ammo', '1659266962', 10),
(1758, 'Earned 2 parts of Kronos gate', '1659266962', 10),
(1759, 'Earned 3 parts of Kronos gate', '1659266963', 10),
(1760, 'Earned 115 mcb50 ammo', '1659266963', 10),
(1761, 'Earned 215 mcb50 ammo', '1659266963', 10),
(1762, 'Earned 75 mcb50 ammo', '1659266963', 10),
(1763, 'Earned 75 mcb50 ammo', '1659266963', 10),
(1764, 'Earned 1 parts of Kronos gate', '1659266964', 10),
(1765, 'Earned 100 mcb25 ammo', '1659266964', 10),
(1766, 'Earned 100 mcb25 ammo', '1659266964', 10),
(1767, 'Earned 1 parts of Kronos gate', '1659266964', 10),
(1768, 'Earned 1 parts of Kronos gate', '1659266964', 10),
(1769, 'Earned 215 mcb50 ammo', '1659266965', 10),
(1770, 'Earned 25 plt21 ammo', '1659266965', 10),
(1771, 'Earned 225 sab ammo', '1659266965', 10),
(1772, 'Earned 10 pld ammo', '1659266965', 10),
(1773, 'Earned 50 sab ammo', '1659266966', 10),
(1774, 'Earned 10 pld ammo', '1659266966', 10),
(1775, 'Earned 85 mcb25 ammo', '1659266966', 10),
(1776, 'Earned 3 parts of Kronos gate', '1659266966', 10),
(1777, 'Earned 10 pld ammo', '1659266966', 10),
(1778, 'Earned 215 mcb50 ammo', '1659266967', 10),
(1779, 'Earned 100 mcb25 ammo', '1659266967', 10),
(1780, 'Earned 75 mcb50 ammo', '1659266967', 10),
(1781, 'Earned 100 mcb25 ammo', '1659266967', 10),
(1782, 'Earned 85 mcb25 ammo', '1659266967', 10),
(1783, 'Earned 50 sab ammo', '1659266968', 10),
(1784, 'Earned 1 parts of Kronos gate', '1659266968', 10),
(1785, 'Earned 2 parts of Kronos gate', '1659266968', 10),
(1786, 'Earned 1 parts of Kronos gate', '1659266968', 10),
(1787, 'Earned 215 mcb50 ammo', '1659266968', 10),
(1788, 'Earned 1 parts of Kronos gate', '1659266969', 10),
(1789, 'Earned 140 mcb25 ammo', '1659266969', 10),
(1790, 'Earned 25 plt21 ammo', '1659266969', 10),
(1791, 'Earned 225 sab ammo', '1659266969', 10),
(1792, 'Earned 215 mcb50 ammo', '1659266969', 10),
(1793, 'Earned 100 mcb25 ammo', '1659266970', 10),
(1794, 'Earned 115 mcb50 ammo', '1659266970', 10),
(1795, 'Earned 1 parts of Kronos gate', '1659266970', 10),
(1796, 'Earned 1 parts of Kronos gate', '1659266970', 10),
(1797, 'Earned 100 mcb25 ammo', '1659266971', 10),
(1798, 'Earned 225 sab ammo', '1659266971', 10),
(1799, 'Earned 3 parts of Kronos gate', '1659266971', 10),
(1800, 'Earned 85 mcb25 ammo', '1659266971', 10),
(1801, 'Earned 75 mcb50 ammo', '1659266972', 10),
(1802, 'Earned 35 plt21 ammo', '1659266972', 10),
(1803, 'Earned 225 sab ammo', '1659266972', 10),
(1804, 'Earned 215 mcb50 ammo', '1659266972', 10),
(1805, 'Earned 75 mcb50 ammo', '1659266972', 10),
(1806, 'Earned 3 parts of Kronos gate', '1659266972', 10),
(1807, 'Earned 225 sab ammo', '1659266973', 10),
(1808, 'Earned 85 mcb25 ammo', '1659266973', 10),
(1809, 'Earned 100 mcb25 ammo', '1659266973', 10),
(1810, 'Earned 115 mcb50 ammo', '1659266973', 10),
(1811, 'Earned 2 parts of Kronos gate', '1659266973', 10),
(1812, 'Earned 35 plt21 ammo', '1659266974', 10),
(1813, 'Earned 85 mcb25 ammo', '1659266974', 10),
(1814, 'Earned 225 sab ammo', '1659266974', 10),
(1815, 'Earned 50 sab ammo', '1659266974', 10),
(1816, 'Earned 1 parts of Kronos gate', '1659266974', 10),
(1817, 'Earned 3 parts of Kronos gate', '1659266975', 10),
(1818, 'Earned 215 mcb50 ammo', '1659266975', 10),
(1819, 'Earned 10 pld ammo', '1659266975', 10),
(1820, 'Earned 215 mcb50 ammo', '1659266975', 10),
(1821, 'Earned 50 sab ammo', '1659266975', 10),
(1822, 'Earned 115 mcb50 ammo', '1659266976', 10),
(1823, 'Earned 75 mcb50 ammo', '1659266976', 10),
(1824, 'Earned 100 mcb25 ammo', '1659266976', 10),
(1825, 'Earned 140 mcb25 ammo', '1659266976', 10),
(1826, 'Earned 35 plt21 ammo', '1659266977', 10),
(1827, 'Earned 1 parts of Kronos gate', '1659266977', 10),
(1828, 'Earned 3 parts of Kronos gate. Sucesfully unlocked gate.', '1659266977', 10),
(1829, 'Earned 225 sab ammo', '1659268500', 10),
(1830, 'Earned 75 mcb50 ammo', '1659268500', 10),
(1831, 'Earned 140 mcb25 ammo', '1659268500', 10),
(1832, 'Earned 1 parts of Alpha gate', '1659268500', 10),
(1833, 'Earned 1 parts of Alpha gate', '1659268500', 10),
(1834, 'Earned 1 parts of Alpha gate', '1659268501', 10),
(1835, 'Earned 75 mcb50 ammo', '1659268501', 10),
(1836, 'Earned 100 mcb25 ammo', '1659268501', 10),
(1837, 'Earned 25 plt21 ammo', '1659268501', 10),
(1838, 'Earned 25 plt21 ammo', '1659268501', 10),
(1839, 'Earned 1 parts of Alpha gate', '1659268501', 10),
(1840, 'Earned 115 mcb50 ammo', '1659268502', 10),
(1841, 'Earned 10 pld ammo', '1659268502', 10),
(1842, 'Earned 3 parts of Alpha gate', '1659268502', 10),
(1843, 'Earned 75 mcb50 ammo', '1659268502', 10),
(1844, 'Earned 25 plt21 ammo', '1659268502', 10),
(1845, 'Earned 3 parts of Alpha gate', '1659268503', 10),
(1846, 'Earned 85 mcb25 ammo', '1659268503', 10),
(1847, 'Earned 3 parts of Alpha gate', '1659268503', 10),
(1848, 'Earned 3 parts of Alpha gate', '1659268503', 10),
(1849, 'Earned 100 mcb25 ammo', '1659268503', 10),
(1850, 'Earned 215 mcb50 ammo', '1659268503', 10),
(1851, 'Earned 100 mcb25 ammo', '1659268504', 10),
(1852, 'Earned 150 sab ammo', '1659268504', 10),
(1853, 'Earned 1 parts of Alpha gate', '1659268504', 10),
(1854, 'Earned 2 parts of Alpha gate', '1659268504', 10),
(1855, 'Earned 10 pld ammo', '1659268504', 10),
(1856, 'Earned 85 mcb25 ammo', '1659268504', 10),
(1857, 'Earned 2 parts of Alpha gate', '1659268505', 10),
(1858, 'Earned 100 mcb25 ammo', '1659268505', 10),
(1859, 'Earned 35 plt21 ammo', '1659268505', 10),
(1860, 'Earned 100 mcb25 ammo', '1659268505', 10),
(1861, 'Earned 10 pld ammo', '1659268505', 10),
(1862, 'Earned 1 parts of Alpha gate', '1659268506', 10),
(1863, 'Earned 140 mcb25 ammo', '1659268506', 10),
(1864, 'Earned 50 sab ammo', '1659268506', 10),
(1865, 'Earned 3 parts of Alpha gate', '1659268506', 10),
(1866, 'Earned 25 plt21 ammo', '1659268507', 10),
(1867, 'Earned 85 mcb25 ammo', '1659268507', 10),
(1868, 'Earned 1 parts of Alpha gate', '1659268507', 10),
(1869, 'Earned 150 sab ammo', '1659268507', 10),
(1870, 'Earned 150 sab ammo', '1659268507', 10),
(1871, 'Earned 150 sab ammo', '1659268507', 10),
(1872, 'Earned 225 sab ammo', '1659268508', 10),
(1873, 'Earned 75 mcb50 ammo', '1659268508', 10),
(1874, 'Earned 1 parts of Alpha gate', '1659268508', 10),
(1875, 'Earned 10 pld ammo', '1659268508', 10),
(1876, 'Earned 150 sab ammo', '1659268508', 10),
(1877, 'Earned 3 parts of Alpha gate', '1659268509', 10),
(1878, 'Earned 35 plt21 ammo', '1659268509', 10),
(1879, 'Earned 100 mcb25 ammo', '1659268509', 10),
(1880, 'Earned 85 mcb25 ammo', '1659268509', 10),
(1881, 'Earned 75 mcb50 ammo', '1659268509', 10),
(1882, 'Earned 85 mcb25 ammo', '1659268509', 10),
(1883, 'Earned 150 sab ammo', '1659268510', 10),
(1884, 'Earned 215 mcb50 ammo', '1659268510', 10),
(1885, 'Earned 10 pld ammo', '1659268510', 10),
(1886, 'Earned 85 mcb25 ammo', '1659268510', 10),
(1887, 'Earned 140 mcb25 ammo', '1659268511', 10),
(1888, 'Earned 140 mcb25 ammo', '1659268511', 10),
(1889, 'Earned 150 sab ammo', '1659268511', 10),
(1890, 'Earned 215 mcb50 ammo', '1659268511', 10),
(1891, 'Earned 150 sab ammo', '1659268512', 10),
(1892, 'Earned 140 mcb25 ammo', '1659268512', 10),
(1893, 'Earned 215 mcb50 ammo', '1659268512', 10),
(1894, 'Earned 75 mcb50 ammo', '1659268512', 10),
(1895, 'Earned 1 parts of Alpha gate', '1659268512', 10),
(1896, 'Earned 25 plt21 ammo', '1659268513', 10),
(1897, 'Earned 215 mcb50 ammo', '1659268513', 10),
(1898, 'Earned 25 plt21 ammo', '1659268513', 10),
(1899, 'Earned 115 mcb50 ammo', '1659268513', 10),
(1900, 'Earned 75 mcb50 ammo', '1659268513', 10),
(1901, 'Earned 100 mcb25 ammo', '1659268513', 10),
(1902, 'Earned 85 mcb25 ammo', '1659268514', 10),
(1903, 'Earned 50 sab ammo', '1659268514', 10),
(1904, 'Earned 10 pld ammo', '1659268514', 10),
(1905, 'Earned 50 sab ammo', '1659268515', 10),
(1906, 'Earned 1 parts of Alpha gate', '1659268515', 10),
(1907, 'Earned 100 mcb25 ammo', '1659268515', 10),
(1908, 'Earned 215 mcb50 ammo', '1659268515', 10),
(1909, 'Earned 100 mcb25 ammo', '1659268516', 10),
(1910, 'Earned 25 plt21 ammo', '1659268516', 10),
(1911, 'Earned 100 mcb25 ammo', '1659268516', 10),
(1912, 'Earned 10 pld ammo', '1659268517', 10),
(1913, 'Earned 2 parts of Alpha gate. Sucesfully unlocked gate.', '1659268517', 10),
(1914, 'Earned 25 plt21 ammo', '1660143896', 11),
(1915, 'Earned 25 plt21 ammo', '1660143896', 11),
(1916, 'Earned 1 parts of Alpha gate', '1660143897', 11),
(1917, 'Earned 25 plt21 ammo', '1660143897', 11),
(1918, 'Earned 100 mcb25 ammo', '1660143897', 11),
(1919, 'Earned 215 mcb50 ammo', '1660143897', 11),
(1920, 'Earned 140 mcb25 ammo', '1660143897', 11),
(1921, 'Earned 2 parts of Alpha gate', '1660143897', 11),
(1922, 'Earned 10 pld ammo', '1660143898', 11),
(1923, 'Earned 100 mcb25 ammo', '1660143898', 11),
(1924, 'Earned 1 parts of Alpha gate', '1660143898', 11),
(1925, 'Earned 1 parts of Alpha gate', '1660143898', 11),
(1926, 'Earned 1 parts of Alpha gate', '1660143898', 11),
(1927, 'Earned 215 mcb50 ammo', '1660143898', 11),
(1928, 'Earned 3 parts of Alpha gate', '1660143899', 11),
(1929, 'Earned 10 pld ammo', '1660143899', 11),
(1930, 'Earned 50 sab ammo', '1660143899', 11),
(1931, 'Earned 100 mcb25 ammo', '1660143899', 11),
(1932, 'Earned 140 mcb25 ammo', '1660143899', 11),
(1933, 'Earned 75 mcb50 ammo', '1660143900', 11),
(1934, 'Earned 1 parts of Alpha gate', '1660143900', 11),
(1935, 'Earned 215 mcb50 ammo', '1660143900', 11),
(1936, 'Earned 100 mcb25 ammo', '1660143900', 11),
(1937, 'Earned 1 parts of Alpha gate', '1660143900', 11),
(1938, 'Earned 225 sab ammo', '1660143900', 11),
(1939, 'Earned 150 sab ammo', '1660143901', 11),
(1940, 'Earned 3 parts of Alpha gate', '1660143901', 11),
(1941, 'Earned 75 mcb50 ammo', '1660143901', 11),
(1942, 'Earned 100 mcb25 ammo', '1660143901', 11),
(1943, 'Earned 85 mcb25 ammo', '1660143901', 11),
(1944, 'Earned 100 mcb25 ammo', '1660143902', 11),
(1945, 'Earned 215 mcb50 ammo', '1660143902', 11),
(1946, 'Earned 225 sab ammo', '1660143902', 11),
(1947, 'Earned 100 mcb25 ammo', '1660143902', 11),
(1948, 'Earned 150 sab ammo', '1660143902', 11),
(1949, 'Earned 150 sab ammo', '1660143902', 11),
(1950, 'Earned 100 mcb25 ammo', '1660143903', 11),
(1951, 'Earned 50 sab ammo', '1660143903', 11),
(1952, 'Earned 85 mcb25 ammo', '1660143903', 11),
(1953, 'Earned 140 mcb25 ammo', '1660143903', 11),
(1954, 'Earned 150 sab ammo', '1660143903', 11),
(1955, 'Earned 100 mcb25 ammo', '1660143903', 11),
(1956, 'Earned 215 mcb50 ammo', '1660143904', 11),
(1957, 'Earned 50 sab ammo', '1660143904', 11),
(1958, 'Earned 140 mcb25 ammo', '1660143904', 11),
(1959, 'Earned 2 parts of Alpha gate', '1660143904', 11),
(1960, 'Earned 140 mcb25 ammo', '1660143904', 11),
(1961, 'Earned 50 sab ammo', '1660143905', 11),
(1962, 'Earned 2 parts of Alpha gate', '1660143905', 11),
(1963, 'Earned 50 sab ammo', '1660143905', 11),
(1964, 'Earned 1 parts of Alpha gate', '1660143905', 11),
(1965, 'Earned 140 mcb25 ammo', '1660143905', 11),
(1966, 'Earned 225 sab ammo', '1660143906', 11),
(1967, 'Earned 100 mcb25 ammo', '1660143906', 11),
(1968, 'Earned 1 parts of Alpha gate', '1660143906', 11),
(1969, 'Earned 215 mcb50 ammo', '1660143906', 11),
(1970, 'Earned 85 mcb25 ammo', '1660143906', 11),
(1971, 'Earned 35 plt21 ammo', '1660143906', 11),
(1972, 'Earned 100 mcb25 ammo', '1660143907', 11),
(1973, 'Earned 1 parts of Alpha gate', '1660143907', 11),
(1974, 'Earned 1 parts of Alpha gate', '1660143907', 11),
(1975, 'Earned 85 mcb25 ammo', '1660143907', 11),
(1976, 'Earned 1 parts of Alpha gate', '1660143907', 11),
(1977, 'Earned 50 sab ammo', '1660143908', 11),
(1978, 'Earned 2 parts of Alpha gate', '1660143908', 11),
(1979, 'Earned 85 mcb25 ammo', '1660143908', 11),
(1980, 'Earned 75 mcb50 ammo', '1660143908', 11),
(1981, 'Earned 150 sab ammo', '1660143908', 11),
(1982, 'Earned 75 mcb50 ammo', '1660143908', 11),
(1983, 'Earned 85 mcb25 ammo', '1660143909', 11),
(1984, 'Earned 140 mcb25 ammo', '1660143909', 11),
(1985, 'Earned 215 mcb50 ammo', '1660143909', 11),
(1986, 'Earned 3 parts of Alpha gate', '1660143909', 11),
(1987, 'Earned 115 mcb50 ammo', '1660143909', 11),
(1988, 'Earned 1 parts of Alpha gate', '1660143910', 11),
(1989, 'Earned 100 mcb25 ammo', '1660143910', 11),
(1990, 'Earned 100 mcb25 ammo', '1660143910', 11),
(1991, 'Earned 1 parts of Alpha gate', '1660143910', 11),
(1992, 'Earned 100 mcb25 ammo', '1660143910', 11),
(1993, 'Earned 50 sab ammo', '1660143910', 11),
(1994, 'Earned 150 sab ammo', '1660143911', 11),
(1995, 'Earned 75 mcb50 ammo', '1660143911', 11),
(1996, 'Earned 1 parts of Alpha gate', '1660143911', 11),
(1997, 'Earned 1 parts of Alpha gate', '1660143911', 11),
(1998, 'Earned 25 plt21 ammo', '1660143911', 11),
(1999, 'Earned 215 mcb50 ammo', '1660143912', 11),
(2000, 'Earned 10 pld ammo', '1660143912', 11),
(2001, 'Earned 25 plt21 ammo', '1660143912', 11),
(2002, 'Earned 50 sab ammo', '1660143912', 11),
(2003, 'Earned 100 mcb25 ammo', '1660143912', 11),
(2004, 'Earned 1 parts of Alpha gate', '1660143912', 11),
(2005, 'Earned 140 mcb25 ammo', '1660143913', 11),
(2006, 'Earned 85 mcb25 ammo', '1660143913', 11),
(2007, 'Earned 25 plt21 ammo', '1660143913', 11),
(2008, 'Earned 100 mcb25 ammo', '1660143913', 11),
(2009, 'Earned 100 mcb25 ammo', '1660143913', 11),
(2010, 'Earned 215 mcb50 ammo', '1660143914', 11),
(2011, 'Earned 1 parts of Alpha gate. Sucesfully unlocked gate.', '1660143914', 11),
(2012, 'Earned 3 parts of Beta gate', '1660155027', 11),
(2013, 'Earned 1 parts of Beta gate', '1660155027', 11),
(2014, 'Earned 100 mcb25 ammo', '1660155028', 11),
(2015, 'Earned 225 sab ammo', '1660155028', 11),
(2016, 'Earned 225 sab ammo', '1660155028', 11),
(2017, 'Earned 10 pld ammo', '1660155028', 11),
(2018, 'Earned 100 mcb25 ammo', '1660155029', 11),
(2019, 'Earned 140 mcb25 ammo', '1660155029', 11),
(2020, 'Earned 150 sab ammo', '1660155029', 11),
(2021, 'Earned 215 mcb50 ammo', '1660155029', 11),
(2022, 'Earned 25 plt21 ammo', '1660155029', 11),
(2023, 'Earned 140 mcb25 ammo', '1660155029', 11),
(2024, 'Earned 1 parts of Beta gate', '1660155030', 11),
(2025, 'Earned 100 mcb25 ammo', '1660155030', 11),
(2026, 'Earned 50 sab ammo', '1660155030', 11),
(2027, 'Earned 85 mcb25 ammo', '1660155030', 11),
(2028, 'Earned 1 parts of Beta gate', '1660155030', 11),
(2029, 'Earned 140 mcb25 ammo', '1660155030', 11),
(2030, 'Earned 140 mcb25 ammo', '1660155031', 11),
(2031, 'Earned 100 mcb25 ammo', '1660155031', 11),
(2032, 'Earned 2 parts of Beta gate', '1660155031', 11),
(2033, 'Earned 75 mcb50 ammo', '1660155031', 11),
(2034, 'Earned 1 parts of Beta gate', '1660155031', 11),
(2035, 'Earned 50 sab ammo', '1660155032', 11),
(2036, 'Earned 2 parts of Beta gate', '1660155032', 11),
(2037, 'Earned 150 sab ammo', '1660155032', 11),
(2038, 'Earned 100 mcb25 ammo', '1660155032', 11),
(2039, 'Earned 50 sab ammo', '1660155033', 11),
(2040, 'Earned 100 mcb25 ammo', '1660155033', 11),
(2041, 'Earned 100 mcb25 ammo', '1660155033', 11),
(2042, 'Earned 10 pld ammo', '1660155034', 11),
(2043, 'Earned 225 sab ammo', '1660155034', 11),
(2044, 'Earned 100 mcb25 ammo', '1660155034', 11),
(2045, 'Earned 10 pld ammo', '1660155034', 11),
(2046, 'Earned 85 mcb25 ammo', '1660155034', 11),
(2047, 'Earned 85 mcb25 ammo', '1660155034', 11),
(2048, 'Earned 75 mcb50 ammo', '1660155034', 11),
(2049, 'Earned 3 parts of Beta gate', '1660155035', 11);
INSERT INTO `gg_log` (`id`, `log`, `date`, `userId`) VALUES
(2050, 'Earned 140 mcb25 ammo', '1660155035', 11),
(2051, 'Earned 140 mcb25 ammo', '1660155035', 11),
(2052, 'Earned 150 sab ammo', '1660155035', 11),
(2053, 'Earned 100 mcb25 ammo', '1660155036', 11),
(2054, 'Earned 75 mcb50 ammo', '1660155036', 11),
(2055, 'Earned 85 mcb25 ammo', '1660155036', 11),
(2056, 'Earned 215 mcb50 ammo', '1660155036', 11),
(2057, 'Earned 25 plt21 ammo', '1660155036', 11),
(2058, 'Earned 225 sab ammo', '1660155036', 11),
(2059, 'Earned 85 mcb25 ammo', '1660155037', 11),
(2060, 'Earned 225 sab ammo', '1660155037', 11),
(2061, 'Earned 215 mcb50 ammo', '1660155037', 11),
(2062, 'Earned 10 pld ammo', '1660155037', 11),
(2063, 'Earned 215 mcb50 ammo', '1660155038', 11),
(2064, 'Earned 215 mcb50 ammo', '1660155038', 11),
(2065, 'Earned 1 parts of Beta gate', '1660155038', 11),
(2066, 'Earned 3 parts of Beta gate', '1660155038', 11),
(2067, 'Earned 1 parts of Beta gate', '1660155038', 11),
(2068, 'Earned 2 parts of Beta gate', '1660155038', 11),
(2069, 'Earned 215 mcb50 ammo', '1660155039', 11),
(2070, 'Earned 1 parts of Beta gate', '1660155039', 11),
(2071, 'Earned 150 sab ammo', '1660155039', 11),
(2072, 'Earned 85 mcb25 ammo', '1660155039', 11),
(2073, 'Earned 140 mcb25 ammo', '1660155039', 11),
(2074, 'Earned 215 mcb50 ammo', '1660155039', 11),
(2075, 'Earned 100 mcb25 ammo', '1660155040', 11),
(2076, 'Earned 215 mcb50 ammo', '1660155040', 11),
(2077, 'Earned 1 parts of Beta gate', '1660155040', 11),
(2078, 'Earned 100 mcb25 ammo', '1660155040', 11),
(2079, 'Earned 10 pld ammo', '1660155040', 11),
(2080, 'Earned 115 mcb50 ammo', '1660155041', 11),
(2081, 'Earned 215 mcb50 ammo', '1660155041', 11),
(2082, 'Earned 10 pld ammo', '1660155041', 11),
(2083, 'Earned 225 sab ammo', '1660155041', 11),
(2084, 'Earned 1 parts of Beta gate', '1660155041', 11),
(2085, 'Earned 75 mcb50 ammo', '1660155042', 11),
(2086, 'Earned 50 sab ammo', '1660155042', 11),
(2087, 'Earned 115 mcb50 ammo', '1660155042', 11),
(2088, 'Earned 85 mcb25 ammo', '1660155042', 11),
(2089, 'Earned 215 mcb50 ammo', '1660155042', 11),
(2090, 'Earned 225 sab ammo', '1660155043', 11),
(2091, 'Earned 50 sab ammo', '1660155043', 11),
(2092, 'Earned 100 mcb25 ammo', '1660155043', 11),
(2093, 'Earned 10 pld ammo', '1660155043', 11),
(2094, 'Earned 215 mcb50 ammo', '1660155043', 11),
(2095, 'Earned 215 mcb50 ammo', '1660155044', 11),
(2096, 'Earned 1 parts of Beta gate', '1660155044', 11),
(2097, 'Earned 25 plt21 ammo', '1660155044', 11),
(2098, 'Earned 140 mcb25 ammo', '1660155044', 11),
(2099, 'Earned 3 parts of Beta gate', '1660155044', 11),
(2100, 'Earned 150 sab ammo', '1660155044', 11),
(2101, 'Earned 85 mcb25 ammo', '1660155045', 11),
(2102, 'Earned 3 parts of Beta gate', '1660155045', 11),
(2103, 'Earned 100 mcb25 ammo', '1660155045', 11),
(2104, 'Earned 100 mcb25 ammo', '1660155045', 11),
(2105, 'Earned 10 pld ammo', '1660155045', 11),
(2106, 'Earned 150 sab ammo', '1660155045', 11),
(2107, 'Earned 25 plt21 ammo', '1660155046', 11),
(2108, 'Earned 25 plt21 ammo', '1660155046', 11),
(2109, 'Earned 75 mcb50 ammo', '1660155046', 11),
(2110, 'Earned 75 mcb50 ammo', '1660155046', 11),
(2111, 'Earned 3 parts of Beta gate', '1660155046', 11),
(2112, 'Earned 35 plt21 ammo', '1660155047', 11),
(2113, 'Earned 100 mcb25 ammo', '1660155047', 11),
(2114, 'Earned 1 parts of Beta gate', '1660155047', 11),
(2115, 'Earned 100 mcb25 ammo', '1660155047', 11),
(2116, 'Earned 75 mcb50 ammo', '1660155047', 11),
(2117, 'Earned 75 mcb50 ammo', '1660155048', 11),
(2118, 'Earned 140 mcb25 ammo', '1660155048', 11),
(2119, 'Earned 100 mcb25 ammo', '1660155048', 11),
(2120, 'Earned 1 parts of Beta gate', '1660155048', 11),
(2121, 'Earned 25 plt21 ammo', '1660155048', 11),
(2122, 'Earned 100 mcb25 ammo', '1660155048', 11),
(2123, 'Earned 1 parts of Beta gate', '1660155049', 11),
(2124, 'Earned 1 parts of Beta gate', '1660155049', 11),
(2125, 'Earned 1 parts of Beta gate', '1660155049', 11),
(2126, 'Earned 35 plt21 ammo', '1660155049', 11),
(2127, 'Earned 10 pld ammo', '1660155053', 11),
(2128, 'Earned 3 parts of Beta gate', '1660155053', 11),
(2129, 'Earned 215 mcb50 ammo', '1660155054', 11),
(2130, 'Earned 140 mcb25 ammo', '1660155054', 11),
(2131, 'Earned 150 sab ammo', '1660155054', 11),
(2132, 'Earned 115 mcb50 ammo', '1660155054', 11),
(2133, 'Earned 10 pld ammo', '1660155054', 11),
(2134, 'Earned 50 sab ammo', '1660155055', 11),
(2135, 'Earned 100 mcb25 ammo', '1660155055', 11),
(2136, 'Earned 1 parts of Beta gate', '1660155055', 11),
(2137, 'Earned 50 sab ammo', '1660155055', 11),
(2138, 'Earned 100 mcb25 ammo', '1660155055', 11),
(2139, 'Earned 3 parts of Beta gate', '1660155056', 11),
(2140, 'Earned 1 parts of Beta gate', '1660155056', 11),
(2141, 'Earned 1 parts of Beta gate. Sucesfully unlocked gate.', '1660155056', 11),
(2142, 'Earned 1 parts of Alpha gate', '1660156659', 11),
(2143, 'Earned 25 plt21 ammo', '1660156659', 11),
(2144, 'Earned 225 sab ammo', '1660156660', 11),
(2145, 'Earned 215 mcb50 ammo', '1660156660', 11),
(2146, 'Earned 35 plt21 ammo', '1660156660', 11),
(2147, 'Earned 115 mcb50 ammo', '1660156660', 11),
(2148, 'Earned 25 plt21 ammo', '1660156660', 11),
(2149, 'Earned 2 parts of Alpha gate', '1660156661', 11),
(2150, 'Earned 225 sab ammo', '1660156661', 11),
(2151, 'Earned 225 sab ammo', '1660156661', 11),
(2152, 'Earned 215 mcb50 ammo', '1660156661', 11),
(2153, 'Earned 115 mcb50 ammo', '1660156661', 11),
(2154, 'Earned 100 mcb25 ammo', '1660156661', 11),
(2155, 'Earned 1 parts of Alpha gate', '1660156662', 11),
(2156, 'Earned 215 mcb50 ammo', '1660156662', 11),
(2157, 'Earned 100 mcb25 ammo', '1660156662', 11),
(2158, 'Earned 115 mcb50 ammo', '1660156662', 11),
(2159, 'Earned 1 parts of Alpha gate', '1660156663', 11),
(2160, 'Earned 1 parts of Alpha gate', '1660156663', 11),
(2161, 'Earned 50 sab ammo', '1660156663', 11),
(2162, 'Earned 1 parts of Alpha gate', '1660156663', 11),
(2163, 'Earned 100 mcb25 ammo', '1660156663', 11),
(2164, 'Earned 100 mcb25 ammo', '1660156663', 11),
(2165, 'Earned 100 mcb25 ammo', '1660156663', 11),
(2166, 'Earned 100 mcb25 ammo', '1660156664', 11),
(2167, 'Earned 1 parts of Alpha gate', '1660156664', 11),
(2168, 'Earned 3 parts of Alpha gate', '1660156664', 11),
(2169, 'Earned 140 mcb25 ammo', '1660156664', 11),
(2170, 'Earned 10 pld ammo', '1660156664', 11),
(2171, 'Earned 140 mcb25 ammo', '1660156664', 11),
(2172, 'Earned 215 mcb50 ammo', '1660156665', 11),
(2173, 'Earned 75 mcb50 ammo', '1660156665', 11),
(2174, 'Earned 3 parts of Alpha gate', '1660156665', 11),
(2175, 'Earned 1 parts of Alpha gate', '1660156665', 11),
(2176, 'Earned 10 pld ammo', '1660156665', 11),
(2177, 'Earned 25 plt21 ammo', '1660156665', 11),
(2178, 'Earned 150 sab ammo', '1660156666', 11),
(2179, 'Earned 225 sab ammo', '1660156666', 11),
(2180, 'Earned 85 mcb25 ammo', '1660156666', 11),
(2181, 'Earned 10 pld ammo', '1660156667', 11),
(2182, 'Earned 1 parts of Alpha gate', '1660156667', 11),
(2183, 'Earned 3 parts of Alpha gate', '1660156667', 11),
(2184, 'Earned 3 parts of Alpha gate', '1660156667', 11),
(2185, 'Earned 50 sab ammo', '1660156667', 11),
(2186, 'Earned 85 mcb25 ammo', '1660156667', 11),
(2187, 'Earned 1 parts of Alpha gate', '1660156667', 11),
(2188, 'Earned 3 parts of Alpha gate', '1660156667', 11),
(2189, 'Earned 100 mcb25 ammo', '1660156668', 11),
(2190, 'Earned 1 parts of Alpha gate', '1660156668', 11),
(2191, 'Earned 215 mcb50 ammo', '1660156668', 11),
(2192, 'Earned 50 sab ammo', '1660156668', 11),
(2193, 'Earned 225 sab ammo', '1660156668', 11),
(2194, 'Earned 150 sab ammo', '1660156669', 11),
(2195, 'Earned 225 sab ammo', '1660156669', 11),
(2196, 'Earned 215 mcb50 ammo', '1660156669', 11),
(2197, 'Earned 25 plt21 ammo', '1660156670', 11),
(2198, 'Earned 50 sab ammo', '1660156671', 11),
(2199, 'Earned 150 sab ammo', '1660156671', 11),
(2200, 'Earned 50 sab ammo', '1660156671', 11),
(2201, 'Earned 215 mcb50 ammo', '1660156671', 11),
(2202, 'Earned 100 mcb25 ammo', '1660156671', 11),
(2203, 'Earned 35 plt21 ammo', '1660156672', 11),
(2204, 'Earned 215 mcb50 ammo', '1660156672', 11),
(2205, 'Earned 25 plt21 ammo', '1660156672', 11),
(2206, 'Earned 25 plt21 ammo', '1660156672', 11),
(2207, 'Earned 100 mcb25 ammo', '1660156672', 11),
(2208, 'Earned 150 sab ammo', '1660156672', 11),
(2209, 'Earned 115 mcb50 ammo', '1660156673', 11),
(2210, 'Earned 215 mcb50 ammo', '1660156673', 11),
(2211, 'Earned 35 plt21 ammo', '1660156673', 11),
(2212, 'Earned 3 parts of Alpha gate', '1660156673', 11),
(2213, 'Earned 100 mcb25 ammo', '1660156673', 11),
(2214, 'Earned 1 parts of Alpha gate', '1660156674', 11),
(2215, 'Earned 25 plt21 ammo', '1660156674', 11),
(2216, 'Earned 225 sab ammo', '1660156674', 11),
(2217, 'Earned 75 mcb50 ammo', '1660156674', 11),
(2218, 'Earned 215 mcb50 ammo', '1660156674', 11),
(2219, 'Earned 100 mcb25 ammo', '1660156674', 11),
(2220, 'Earned 215 mcb50 ammo', '1660156675', 11),
(2221, 'Earned 3 parts of Alpha gate. Sucesfully unlocked gate.', '1660156675', 11),
(2222, 'Earned 1 parts of Alpha gate', '1660220253', 12),
(2223, 'Earned 215 mcb50 ammo', '1660220253', 12),
(2224, 'Earned 215 mcb50 ammo', '1660220254', 12),
(2225, 'Earned 1 parts of Alpha gate', '1660220254', 12),
(2226, 'Earned 85 mcb25 ammo', '1660220254', 12),
(2227, 'Earned 1 parts of Alpha gate', '1660220254', 12),
(2228, 'Earned 85 mcb25 ammo', '1660220254', 12),
(2229, 'Earned 215 mcb50 ammo', '1660220254', 12),
(2230, 'Earned 50 sab ammo', '1660220255', 12),
(2231, 'Earned 215 mcb50 ammo', '1660220255', 12),
(2232, 'Earned 1 parts of Alpha gate', '1660220255', 12),
(2233, 'Earned 3 parts of Alpha gate', '1660220255', 12),
(2234, 'Earned 10 pld ammo', '1660220255', 12),
(2235, 'Earned 225 sab ammo', '1660220255', 12),
(2236, 'Earned 225 sab ammo', '1660220256', 12),
(2237, 'Earned 100 mcb25 ammo', '1660220256', 12),
(2238, 'Earned 3 parts of Alpha gate', '1660220256', 12),
(2239, 'Earned 35 plt21 ammo', '1660220256', 12),
(2240, 'Earned 50 sab ammo', '1660220257', 12),
(2241, 'Earned 115 mcb50 ammo', '1660220257', 12),
(2242, 'Earned 215 mcb50 ammo', '1660220257', 12),
(2243, 'Earned 140 mcb25 ammo', '1660220257', 12),
(2244, 'Earned 2 parts of Alpha gate', '1660220257', 12),
(2245, 'Earned 3 parts of Alpha gate', '1660220257', 12),
(2246, 'Earned 1 parts of Alpha gate', '1660220258', 12),
(2247, 'Earned 215 mcb50 ammo', '1660220258', 12),
(2248, 'Earned 225 sab ammo', '1660220258', 12),
(2249, 'Earned 100 mcb25 ammo', '1660220258', 12),
(2250, 'Earned 1 parts of Alpha gate', '1660220258', 12),
(2251, 'Earned 225 sab ammo', '1660220259', 12),
(2252, 'Earned 100 mcb25 ammo', '1660220259', 12),
(2253, 'Earned 215 mcb50 ammo', '1660220259', 12),
(2254, 'Earned 225 sab ammo', '1660220259', 12),
(2255, 'Earned 85 mcb25 ammo', '1660220259', 12),
(2256, 'Earned 35 plt21 ammo', '1660220259', 12),
(2257, 'Earned 140 mcb25 ammo', '1660220260', 12),
(2258, 'Earned 215 mcb50 ammo', '1660220260', 12),
(2259, 'Earned 35 plt21 ammo', '1660220260', 12),
(2260, 'Earned 1 parts of Alpha gate', '1660220260', 12),
(2261, 'Earned 100 mcb25 ammo', '1660220260', 12),
(2262, 'Earned 25 plt21 ammo', '1660220261', 12),
(2263, 'Earned 3 parts of Alpha gate', '1660220261', 12),
(2264, 'Earned 100 mcb25 ammo', '1660220261', 12),
(2265, 'Earned 225 sab ammo', '1660220261', 12),
(2266, 'Earned 85 mcb25 ammo', '1660220261', 12),
(2267, 'Earned 115 mcb50 ammo', '1660220261', 12),
(2268, 'Earned 100 mcb25 ammo', '1660220262', 12),
(2269, 'Earned 25 plt21 ammo', '1660220262', 12),
(2270, 'Earned 1 parts of Alpha gate', '1660220262', 12),
(2271, 'Earned 150 sab ammo', '1660220262', 12),
(2272, 'Earned 215 mcb50 ammo', '1660220262', 12),
(2273, 'Earned 140 mcb25 ammo', '1660220263', 12),
(2274, 'Earned 115 mcb50 ammo', '1660220263', 12),
(2275, 'Earned 100 mcb25 ammo', '1660220263', 12),
(2276, 'Earned 215 mcb50 ammo', '1660220263', 12),
(2277, 'Earned 10 pld ammo', '1660220263', 12),
(2278, 'Earned 215 mcb50 ammo', '1660220263', 12),
(2279, 'Earned 10 pld ammo', '1660220264', 12),
(2280, 'Earned 25 plt21 ammo', '1660220264', 12),
(2281, 'Earned 50 sab ammo', '1660220264', 12),
(2282, 'Earned 215 mcb50 ammo', '1660220264', 12),
(2283, 'Earned 75 mcb50 ammo', '1660220264', 12),
(2284, 'Earned 2 parts of Alpha gate', '1660220265', 12),
(2285, 'Earned 10 pld ammo', '1660220265', 12),
(2286, 'Earned 115 mcb50 ammo', '1660220265', 12),
(2287, 'Earned 100 mcb25 ammo', '1660220265', 12),
(2288, 'Earned 1 parts of Alpha gate', '1660220265', 12),
(2289, 'Earned 1 parts of Alpha gate', '1660220266', 12),
(2290, 'Earned 1 parts of Alpha gate', '1660220266', 12),
(2291, 'Earned 25 plt21 ammo', '1660220266', 12),
(2292, 'Earned 215 mcb50 ammo', '1660220266', 12),
(2293, 'Earned 10 pld ammo', '1660220266', 12),
(2294, 'Earned 25 plt21 ammo', '1660220266', 12),
(2295, 'Earned 115 mcb50 ammo', '1660220267', 12),
(2296, 'Earned 2 parts of Alpha gate', '1660220267', 12),
(2297, 'Earned 3 parts of Alpha gate', '1660220267', 12),
(2298, 'Earned 75 mcb50 ammo', '1660220267', 12),
(2299, 'Earned 225 sab ammo', '1660220267', 12),
(2300, 'Earned 1 parts of Alpha gate', '1660220268', 12),
(2301, 'Earned 115 mcb50 ammo', '1660220268', 12),
(2302, 'Earned 75 mcb50 ammo', '1660220268', 12),
(2303, 'Earned 100 mcb25 ammo', '1660220268', 12),
(2304, 'Earned 1 parts of Alpha gate. Sucesfully unlocked gate.', '1660220268', 12),
(2305, 'Earned 75 mcb50 ammo', '1660223170', 13),
(2306, 'Earned 225 sab ammo', '1660223170', 13),
(2307, 'Earned 215 mcb50 ammo', '1660223170', 13),
(2308, 'Earned 75 mcb50 ammo', '1660223170', 13),
(2309, 'Earned 215 mcb50 ammo', '1660223170', 13),
(2310, 'Earned 225 sab ammo', '1660223171', 13),
(2311, 'Earned 35 plt21 ammo', '1660223171', 13),
(2312, 'Earned 1 parts of Beta gate', '1660223171', 13),
(2313, 'Earned 50 sab ammo', '1660223171', 13),
(2314, 'Earned 50 sab ammo', '1660223171', 13),
(2315, 'Earned 2 parts of Beta gate', '1660223172', 13),
(2316, 'Earned 100 mcb25 ammo', '1660223172', 13),
(2317, 'Earned 115 mcb50 ammo', '1660223172', 13),
(2318, 'Earned 215 mcb50 ammo', '1660223172', 13),
(2319, 'Earned 215 mcb50 ammo', '1660223172', 13),
(2320, 'Earned 50 sab ammo', '1660223173', 13),
(2321, 'Earned 225 sab ammo', '1660223173', 13),
(2322, 'Earned 10 pld ammo', '1660223173', 13),
(2323, 'Earned 225 sab ammo', '1660223173', 13),
(2324, 'Earned 100 mcb25 ammo', '1660223173', 13),
(2325, 'Earned 115 mcb50 ammo', '1660223174', 13),
(2326, 'Earned 2 parts of Beta gate', '1660223174', 13),
(2327, 'Earned 225 sab ammo', '1660223174', 13),
(2328, 'Earned 1 parts of Beta gate', '1660223174', 13),
(2329, 'Earned 100 mcb25 ammo', '1660223174', 13),
(2330, 'Earned 3 parts of Beta gate', '1660223175', 13),
(2331, 'Earned 75 mcb50 ammo', '1660223175', 13),
(2332, 'Earned 25 plt21 ammo', '1660223176', 13),
(2333, 'Earned 1 parts of Beta gate', '1660223176', 13),
(2334, 'Earned 10 pld ammo', '1660223176', 13),
(2335, 'Earned 85 mcb25 ammo', '1660223176', 13),
(2336, 'Earned 35 plt21 ammo', '1660223176', 13),
(2337, 'Earned 35 plt21 ammo', '1660223177', 13),
(2338, 'Earned 225 sab ammo', '1660223177', 13),
(2339, 'Earned 115 mcb50 ammo', '1660223177', 13),
(2340, 'Earned 225 sab ammo', '1660223177', 13),
(2341, 'Earned 215 mcb50 ammo', '1660223177', 13),
(2342, 'Earned 3 parts of Beta gate', '1660223178', 13),
(2343, 'Earned 25 plt21 ammo', '1660223178', 13),
(2344, 'Earned 3 parts of Beta gate', '1660223178', 13),
(2345, 'Earned 100 mcb25 ammo', '1660223178', 13),
(2346, 'Earned 3 parts of Beta gate', '1660223178', 13),
(2347, 'Earned 85 mcb25 ammo', '1660223179', 13),
(2348, 'Earned 10 pld ammo', '1660223179', 13),
(2349, 'Earned 100 mcb25 ammo', '1660223179', 13),
(2350, 'Earned 1 parts of Beta gate', '1660223179', 13),
(2351, 'Earned 1 parts of Beta gate', '1660223179', 13),
(2352, 'Earned 85 mcb25 ammo', '1660223180', 13),
(2353, 'Earned 75 mcb50 ammo', '1660223180', 13),
(2354, 'Earned 215 mcb50 ammo', '1660223180', 13),
(2355, 'Earned 25 plt21 ammo', '1660223180', 13),
(2356, 'Earned 225 sab ammo', '1660223180', 13),
(2357, 'Earned 10 pld ammo', '1660223181', 13),
(2358, 'Earned 75 mcb50 ammo', '1660223181', 13),
(2359, 'Earned 150 sab ammo', '1660223181', 13),
(2360, 'Earned 2 parts of Beta gate', '1660223181', 13),
(2361, 'Earned 2 parts of Beta gate', '1660223182', 13),
(2362, 'Earned 1 parts of Beta gate', '1660223182', 13),
(2363, 'Earned 1 parts of Beta gate', '1660223182', 13),
(2364, 'Earned 215 mcb50 ammo', '1660223182', 13),
(2365, 'Earned 150 sab ammo', '1660223182', 13),
(2366, 'Earned 75 mcb50 ammo', '1660223182', 13),
(2367, 'Earned 35 plt21 ammo', '1660223183', 13),
(2368, 'Earned 1 parts of Beta gate', '1660223183', 13),
(2369, 'Earned 2 parts of Beta gate', '1660223183', 13),
(2370, 'Earned 215 mcb50 ammo', '1660223183', 13),
(2371, 'Earned 215 mcb50 ammo', '1660223184', 13),
(2372, 'Earned 225 sab ammo', '1660223184', 13),
(2373, 'Earned 1 parts of Beta gate', '1660223184', 13),
(2374, 'Earned 215 mcb50 ammo', '1660223184', 13),
(2375, 'Earned 100 mcb25 ammo', '1660223184', 13),
(2376, 'Earned 100 mcb25 ammo', '1660223185', 13),
(2377, 'Earned 50 sab ammo', '1660223185', 13),
(2378, 'Earned 10 pld ammo', '1660223185', 13),
(2379, 'Earned 140 mcb25 ammo', '1660223185', 13),
(2380, 'Earned 1 parts of Beta gate', '1660223186', 13),
(2381, 'Earned 1 parts of Beta gate', '1660223186', 13),
(2382, 'Earned 35 plt21 ammo', '1660223186', 13),
(2383, 'Earned 50 sab ammo', '1660223186', 13),
(2384, 'Earned 100 mcb25 ammo', '1660223186', 13),
(2385, 'Earned 1 parts of Beta gate', '1660223187', 13),
(2386, 'Earned 1 parts of Beta gate', '1660223187', 13),
(2387, 'Earned 2 parts of Beta gate', '1660223187', 13),
(2388, 'Earned 225 sab ammo', '1660223187', 13),
(2389, 'Earned 215 mcb50 ammo', '1660223188', 13),
(2390, 'Earned 140 mcb25 ammo', '1660223188', 13),
(2391, 'Earned 215 mcb50 ammo', '1660223188', 13),
(2392, 'Earned 1 parts of Beta gate', '1660223188', 13),
(2393, 'Earned 1 parts of Beta gate', '1660223188', 13),
(2394, 'Earned 215 mcb50 ammo', '1660223189', 13),
(2395, 'Earned 215 mcb50 ammo', '1660223189', 13),
(2396, 'Earned 215 mcb50 ammo', '1660223189', 13),
(2397, 'Earned 10 pld ammo', '1660223189', 13),
(2398, 'Earned 150 sab ammo', '1660223189', 13),
(2399, 'Earned 150 sab ammo', '1660223190', 13),
(2400, 'Earned 225 sab ammo', '1660223190', 13),
(2401, 'Earned 140 mcb25 ammo', '1660223191', 13),
(2402, 'Earned 2 parts of Beta gate', '1660223191', 13),
(2403, 'Earned 50 sab ammo', '1660223191', 13),
(2404, 'Earned 2 parts of Beta gate', '1660223191', 13),
(2405, 'Earned 140 mcb25 ammo', '1660223192', 13),
(2406, 'Earned 100 mcb25 ammo', '1660223192', 13),
(2407, 'Earned 215 mcb50 ammo', '1660223193', 13),
(2408, 'Earned 225 sab ammo', '1660223193', 13),
(2409, 'Earned 85 mcb25 ammo', '1660223193', 13),
(2410, 'Earned 115 mcb50 ammo', '1660223193', 13),
(2411, 'Earned 1 parts of Beta gate', '1660223193', 13),
(2412, 'Earned 100 mcb25 ammo', '1660223194', 13),
(2413, 'Earned 10 pld ammo', '1660223194', 13),
(2414, 'Earned 50 sab ammo', '1660223194', 13),
(2415, 'Earned 35 plt21 ammo', '1660223194', 13),
(2416, 'Earned 2 parts of Beta gate', '1660223195', 13),
(2417, 'Earned 100 mcb25 ammo', '1660223223', 13),
(2418, 'Earned 100 mcb25 ammo', '1660223223', 13),
(2419, 'Earned 10 pld ammo', '1660223223', 13),
(2420, 'Earned 85 mcb25 ammo', '1660223223', 13),
(2421, 'Earned 1 parts of Beta gate', '1660223224', 13),
(2422, 'Earned 1 parts of Beta gate. Sucesfully unlocked gate.', '1660223224', 13),
(2423, 'Buyed 1 live in Beta gate', '1660226581', 13),
(2424, 'Buyed 1 live in Beta gate', '1660227465', 13),
(2425, 'Buyed 1 live in Beta gate', '1660227471', 13),
(2426, 'Earned 140 mcb25 ammo', '1660227954', 13),
(2427, 'Earned 25 plt21 ammo', '1660227955', 13),
(2428, 'Earned 25 plt21 ammo', '1660227955', 13),
(2429, 'Earned 215 mcb50 ammo', '1660227956', 13),
(2430, 'Earned 10 pld ammo', '1660227956', 13),
(2431, 'Earned 75 mcb50 ammo', '1660227956', 13),
(2432, 'Earned 100 mcb25 ammo', '1660227956', 13),
(2433, 'Earned 75 mcb50 ammo', '1660227956', 13),
(2434, 'Earned 75 mcb50 ammo', '1660227957', 13),
(2435, 'Earned 25 plt21 ammo', '1660227957', 13),
(2436, 'Earned 3 parts of Lambda gate', '1660227957', 13),
(2437, 'Earned 1 parts of Lambda gate', '1660227957', 13),
(2438, 'Earned 140 mcb25 ammo', '1660227957', 13),
(2439, 'Earned 35 plt21 ammo', '1660227957', 13),
(2440, 'Earned 25 plt21 ammo', '1660227958', 13),
(2441, 'Earned 100 mcb25 ammo', '1660227958', 13),
(2442, 'Earned 3 parts of Lambda gate', '1660227958', 13),
(2443, 'Earned 100 mcb25 ammo', '1660227958', 13),
(2444, 'Earned 10 pld ammo', '1660227958', 13),
(2445, 'Earned 10 pld ammo', '1660227959', 13),
(2446, 'Earned 50 sab ammo', '1660227959', 13),
(2447, 'Earned 140 mcb25 ammo', '1660227959', 13),
(2448, 'Earned 215 mcb50 ammo', '1660227959', 13),
(2449, 'Earned 140 mcb25 ammo', '1660227959', 13),
(2450, 'Earned 100 mcb25 ammo', '1660227959', 13),
(2451, 'Earned 115 mcb50 ammo', '1660227960', 13),
(2452, 'Earned 100 mcb25 ammo', '1660227960', 13),
(2453, 'Earned 10 pld ammo', '1660227960', 13),
(2454, 'Earned 3 parts of Lambda gate', '1660227960', 13),
(2455, 'Earned 1 parts of Lambda gate', '1660227960', 13),
(2456, 'Earned 1 parts of Lambda gate', '1660227961', 13),
(2457, 'Earned 215 mcb50 ammo', '1660227961', 13),
(2458, 'Earned 3 parts of Lambda gate', '1660227961', 13),
(2459, 'Earned 215 mcb50 ammo', '1660227961', 13),
(2460, 'Earned 2 parts of Lambda gate', '1660227961', 13),
(2461, 'Earned 1 parts of Lambda gate', '1660227962', 13),
(2462, 'Earned 215 mcb50 ammo', '1660227962', 13),
(2463, 'Earned 1 parts of Lambda gate', '1660227962', 13),
(2464, 'Earned 10 pld ammo', '1660227962', 13),
(2465, 'Earned 100 mcb25 ammo', '1660227962', 13),
(2466, 'Earned 225 sab ammo', '1660227962', 13),
(2467, 'Earned 3 parts of Lambda gate', '1660227963', 13),
(2468, 'Earned 1 parts of Lambda gate', '1660227963', 13),
(2469, 'Earned 140 mcb25 ammo', '1660227963', 13),
(2470, 'Earned 35 plt21 ammo', '1660227963', 13),
(2471, 'Earned 100 mcb25 ammo', '1660227963', 13),
(2472, 'Earned 85 mcb25 ammo', '1660227964', 13),
(2473, 'Earned 35 plt21 ammo', '1660227964', 13),
(2474, 'Earned 100 mcb25 ammo', '1660227964', 13),
(2475, 'Earned 215 mcb50 ammo', '1660227964', 13),
(2476, 'Earned 3 parts of Lambda gate', '1660227964', 13),
(2477, 'Earned 50 sab ammo', '1660227964', 13),
(2478, 'Earned 10 pld ammo', '1660227965', 13),
(2479, 'Earned 100 mcb25 ammo', '1660227965', 13),
(2480, 'Earned 150 sab ammo', '1660227965', 13),
(2481, 'Earned 85 mcb25 ammo', '1660227965', 13),
(2482, 'Earned 100 mcb25 ammo', '1660227965', 13),
(2483, 'Earned 35 plt21 ammo', '1660227966', 13),
(2484, 'Earned 115 mcb50 ammo', '1660227966', 13),
(2485, 'Earned 115 mcb50 ammo', '1660227966', 13),
(2486, 'Earned 75 mcb50 ammo', '1660227966', 13),
(2487, 'Earned 140 mcb25 ammo', '1660227966', 13),
(2488, 'Earned 25 plt21 ammo', '1660227967', 13),
(2489, 'Earned 1 parts of Lambda gate', '1660227967', 13),
(2490, 'Earned 25 plt21 ammo', '1660227967', 13),
(2491, 'Earned 100 mcb25 ammo', '1660227967', 13),
(2492, 'Earned 100 mcb25 ammo', '1660227967', 13),
(2493, 'Earned 225 sab ammo', '1660227967', 13),
(2494, 'Earned 100 mcb25 ammo', '1660227968', 13),
(2495, 'Earned 50 sab ammo', '1660227968', 13),
(2496, 'Earned 215 mcb50 ammo', '1660227968', 13),
(2497, 'Earned 140 mcb25 ammo', '1660227968', 13),
(2498, 'Earned 75 mcb50 ammo', '1660227969', 13),
(2499, 'Earned 3 parts of Lambda gate', '1660227969', 13),
(2500, 'Earned 140 mcb25 ammo', '1660227969', 13),
(2501, 'Earned 215 mcb50 ammo', '1660227969', 13),
(2502, 'Earned 75 mcb50 ammo', '1660227969', 13),
(2503, 'Earned 140 mcb25 ammo', '1660227970', 13),
(2504, 'Earned 1 parts of Lambda gate', '1660227970', 13),
(2505, 'Earned 100 mcb25 ammo', '1660227970', 13),
(2506, 'Earned 25 plt21 ammo', '1660227970', 13),
(2507, 'Earned 50 sab ammo', '1660227970', 13),
(2508, 'Earned 100 mcb25 ammo', '1660227970', 13),
(2509, 'Earned 100 mcb25 ammo', '1660227971', 13),
(2510, 'Earned 215 mcb50 ammo', '1660227971', 13),
(2511, 'Earned 100 mcb25 ammo', '1660227971', 13),
(2512, 'Earned 150 sab ammo', '1660227971', 13),
(2513, 'Earned 3 parts of Lambda gate', '1660227971', 13),
(2514, 'Earned 10 pld ammo', '1660227972', 13),
(2515, 'Earned 3 parts of Lambda gate', '1660227972', 13),
(2516, 'Earned 225 sab ammo', '1660227972', 13),
(2517, 'Earned 215 mcb50 ammo', '1660227972', 13),
(2518, 'Earned 25 plt21 ammo', '1660227972', 13),
(2519, 'Earned 85 mcb25 ammo', '1660227973', 13),
(2520, 'Earned 1 parts of Lambda gate', '1660227973', 13),
(2521, 'Earned 150 sab ammo', '1660227973', 13),
(2522, 'Earned 10 pld ammo', '1660227973', 13),
(2523, 'Earned 140 mcb25 ammo', '1660227973', 13),
(2524, 'Earned 115 mcb50 ammo', '1660227973', 13),
(2525, 'Earned 115 mcb50 ammo', '1660227974', 13),
(2526, 'Earned 225 sab ammo', '1660227974', 13),
(2527, 'Earned 225 sab ammo', '1660227974', 13),
(2528, 'Earned 1 parts of Lambda gate', '1660227974', 13),
(2529, 'Earned 2 parts of Lambda gate', '1660227974', 13),
(2530, 'Earned 100 mcb25 ammo', '1660227975', 13),
(2531, 'Earned 35 plt21 ammo', '1660227975', 13),
(2532, 'Earned 75 mcb50 ammo', '1660227975', 13),
(2533, 'Earned 35 plt21 ammo', '1660227975', 13),
(2534, 'Earned 215 mcb50 ammo', '1660227975', 13),
(2535, 'Earned 100 mcb25 ammo', '1660227975', 13),
(2536, 'Earned 50 sab ammo', '1660227976', 13),
(2537, 'Earned 115 mcb50 ammo', '1660227976', 13),
(2538, 'Earned 140 mcb25 ammo', '1660227976', 13),
(2539, 'Earned 2 parts of Lambda gate', '1660227976', 13),
(2540, 'Earned 3 parts of Lambda gate. Sucesfully unlocked gate.', '1660227977', 13),
(2541, 'Earned 75 mcb50 ammo', '1660250841', 13),
(2542, 'Earned 25 plt21 ammo', '1660250841', 13),
(2543, 'Earned 35 plt21 ammo', '1660250841', 13),
(2544, 'Earned 10 pld ammo', '1660250841', 13),
(2545, 'Earned 1 parts of Gamma gate', '1660250841', 13),
(2546, 'Earned 35 plt21 ammo', '1660250842', 13),
(2547, 'Earned 225 sab ammo', '1660250842', 13),
(2548, 'Earned 215 mcb50 ammo', '1660250842', 13),
(2549, 'Earned 150 sab ammo', '1660250842', 13),
(2550, 'Earned 150 sab ammo', '1660250842', 13),
(2551, 'Earned 215 mcb50 ammo', '1660250843', 13),
(2552, 'Earned 225 sab ammo', '1660250843', 13),
(2553, 'Earned 225 sab ammo', '1660250843', 13),
(2554, 'Earned 1 parts of Gamma gate', '1660250843', 13),
(2555, 'Earned 100 mcb25 ammo', '1660250843', 13),
(2556, 'Earned 100 mcb25 ammo', '1660250843', 13),
(2557, 'Earned 1 parts of Gamma gate', '1660250844', 13),
(2558, 'Earned 100 mcb25 ammo', '1660250844', 13),
(2559, 'Earned 225 sab ammo', '1660250844', 13),
(2560, 'Earned 50 sab ammo', '1660250844', 13),
(2561, 'Earned 1 parts of Gamma gate', '1660250845', 13),
(2562, 'Earned 225 sab ammo', '1660250845', 13),
(2563, 'Earned 1 parts of Gamma gate', '1660250845', 13),
(2564, 'Earned 115 mcb50 ammo', '1660250845', 13),
(2565, 'Earned 85 mcb25 ammo', '1660250845', 13),
(2566, 'Earned 225 sab ammo', '1660250845', 13),
(2567, 'Earned 50 sab ammo', '1660250846', 13),
(2568, 'Earned 225 sab ammo', '1660250846', 13),
(2569, 'Earned 10 pld ammo', '1660250846', 13),
(2570, 'Earned 25 plt21 ammo', '1660250846', 13),
(2571, 'Earned 3 parts of Gamma gate', '1660250846', 13),
(2572, 'Earned 100 mcb25 ammo', '1660250847', 13),
(2573, 'Earned 115 mcb50 ammo', '1660250847', 13),
(2574, 'Earned 115 mcb50 ammo', '1660250847', 13),
(2575, 'Earned 100 mcb25 ammo', '1660250847', 13),
(2576, 'Earned 225 sab ammo', '1660250847', 13),
(2577, 'Earned 225 sab ammo', '1660250848', 13),
(2578, 'Earned 215 mcb50 ammo', '1660250848', 13),
(2579, 'Earned 85 mcb25 ammo', '1660250848', 13),
(2580, 'Earned 100 mcb25 ammo', '1660250848', 13),
(2581, 'Earned 150 sab ammo', '1660250848', 13),
(2582, 'Earned 1 parts of Gamma gate', '1660250848', 13),
(2583, 'Earned 1 parts of Gamma gate', '1660250849', 13),
(2584, 'Earned 3 parts of Gamma gate', '1660250849', 13),
(2585, 'Earned 225 sab ammo', '1660250849', 13),
(2586, 'Earned 140 mcb25 ammo', '1660250849', 13),
(2587, 'Earned 2 parts of Gamma gate', '1660250850', 13),
(2588, 'Earned 1 parts of Gamma gate', '1660250850', 13),
(2589, 'Earned 100 mcb25 ammo', '1660250850', 13),
(2590, 'Earned 215 mcb50 ammo', '1660250850', 13),
(2591, 'Earned 215 mcb50 ammo', '1660250850', 13),
(2592, 'Earned 50 sab ammo', '1660250851', 13),
(2593, 'Earned 1 parts of Gamma gate', '1660250851', 13),
(2594, 'Earned 100 mcb25 ammo', '1660250851', 13),
(2595, 'Earned 140 mcb25 ammo', '1660250851', 13),
(2596, 'Earned 75 mcb50 ammo', '1660250851', 13),
(2597, 'Earned 75 mcb50 ammo', '1660250851', 13),
(2598, 'Earned 150 sab ammo', '1660250852', 13),
(2599, 'Earned 215 mcb50 ammo', '1660250852', 13),
(2600, 'Earned 10 pld ammo', '1660250852', 13),
(2601, 'Earned 35 plt21 ammo', '1660250852', 13),
(2602, 'Earned 100 mcb25 ammo', '1660250852', 13),
(2603, 'Earned 25 plt21 ammo', '1660250853', 13),
(2604, 'Earned 35 plt21 ammo', '1660250853', 13),
(2605, 'Earned 150 sab ammo', '1660250853', 13),
(2606, 'Earned 2 parts of Gamma gate', '1660250853', 13),
(2607, 'Earned 10 pld ammo', '1660250853', 13),
(2608, 'Earned 100 mcb25 ammo', '1660250854', 13),
(2609, 'Earned 35 plt21 ammo', '1660250854', 13),
(2610, 'Earned 150 sab ammo', '1660250854', 13),
(2611, 'Earned 215 mcb50 ammo', '1660250854', 13),
(2612, 'Earned 115 mcb50 ammo', '1660250854', 13),
(2613, 'Earned 115 mcb50 ammo', '1660250854', 13),
(2614, 'Earned 215 mcb50 ammo', '1660250855', 13),
(2615, 'Earned 2 parts of Gamma gate', '1660250855', 13),
(2616, 'Earned 215 mcb50 ammo', '1660250855', 13),
(2617, 'Earned 150 sab ammo', '1660250855', 13),
(2618, 'Earned 10 pld ammo', '1660250855', 13),
(2619, 'Earned 25 plt21 ammo', '1660250856', 13),
(2620, 'Earned 25 plt21 ammo', '1660250856', 13),
(2621, 'Earned 1 parts of Gamma gate', '1660250856', 13),
(2622, 'Earned 10 pld ammo', '1660250856', 13),
(2623, 'Earned 75 mcb50 ammo', '1660250856', 13),
(2624, 'Earned 2 parts of Gamma gate', '1660250857', 13),
(2625, 'Earned 115 mcb50 ammo', '1660250857', 13),
(2626, 'Earned 1 parts of Gamma gate', '1660250857', 13),
(2627, 'Earned 1 parts of Gamma gate', '1660250857', 13),
(2628, 'Earned 115 mcb50 ammo', '1660250857', 13),
(2629, 'Earned 1 parts of Gamma gate', '1660250858', 13),
(2630, 'Earned 1 parts of Gamma gate', '1660250858', 13),
(2631, 'Earned 100 mcb25 ammo', '1660250858', 13),
(2632, 'Earned 115 mcb50 ammo', '1660250858', 13),
(2633, 'Earned 100 mcb25 ammo', '1660250858', 13),
(2634, 'Earned 225 sab ammo', '1660250859', 13),
(2635, 'Earned 115 mcb50 ammo', '1660250859', 13),
(2636, 'Earned 1 parts of Gamma gate', '1660250859', 13),
(2637, 'Earned 10 pld ammo', '1660250859', 13),
(2638, 'Earned 75 mcb50 ammo', '1660250859', 13),
(2639, 'Earned 2 parts of Gamma gate', '1660250860', 13),
(2640, 'Earned 225 sab ammo', '1660250860', 13),
(2641, 'Earned 150 sab ammo', '1660250860', 13),
(2642, 'Earned 225 sab ammo', '1660250860', 13),
(2643, 'Earned 1 parts of Gamma gate', '1660250860', 13),
(2644, 'Earned 100 mcb25 ammo', '1660250861', 13),
(2645, 'Earned 75 mcb50 ammo', '1660250861', 13),
(2646, 'Earned 1 parts of Gamma gate', '1660250861', 13),
(2647, 'Earned 150 sab ammo', '1660250861', 13),
(2648, 'Earned 85 mcb25 ammo', '1660250861', 13),
(2649, 'Earned 225 sab ammo', '1660250862', 13),
(2650, 'Earned 1 parts of Gamma gate', '1660250862', 13),
(2651, 'Earned 225 sab ammo', '1660250862', 13),
(2652, 'Earned 35 plt21 ammo', '1660250862', 13),
(2653, 'Earned 1 parts of Gamma gate', '1660250863', 13),
(2654, 'Earned 150 sab ammo', '1660250863', 13),
(2655, 'Earned 35 plt21 ammo', '1660250863', 13),
(2656, 'Earned 100 mcb25 ammo', '1660250864', 13),
(2657, 'Earned 140 mcb25 ammo', '1660250864', 13),
(2658, 'Earned 35 plt21 ammo', '1660250864', 13),
(2659, 'Earned 75 mcb50 ammo', '1660250864', 13),
(2660, 'Earned 100 mcb25 ammo', '1660250864', 13),
(2661, 'Earned 50 sab ammo', '1660250864', 13),
(2662, 'Earned 85 mcb25 ammo', '1660250865', 13),
(2663, 'Earned 50 sab ammo', '1660250865', 13),
(2664, 'Earned 50 sab ammo', '1660250865', 13),
(2665, 'Earned 35 plt21 ammo', '1660250865', 13),
(2666, 'Earned 25 plt21 ammo', '1660250865', 13),
(2667, 'Earned 225 sab ammo', '1660250866', 13),
(2668, 'Earned 225 sab ammo', '1660250866', 13),
(2669, 'Earned 1 parts of Gamma gate', '1660250866', 13),
(2670, 'Earned 150 sab ammo', '1660250866', 13),
(2671, 'Earned 100 mcb25 ammo', '1660250867', 13),
(2672, 'Earned 100 mcb25 ammo', '1660250867', 13),
(2673, 'Earned 10 pld ammo', '1660250867', 13),
(2674, 'Earned 10 pld ammo', '1660250867', 13),
(2675, 'Earned 215 mcb50 ammo', '1660250867', 13),
(2676, 'Earned 85 mcb25 ammo', '1660250868', 13),
(2677, 'Earned 100 mcb25 ammo', '1660250868', 13),
(2678, 'Earned 35 plt21 ammo', '1660250868', 13),
(2679, 'Earned 215 mcb50 ammo', '1660250868', 13),
(2680, 'Earned 3 parts of Gamma gate', '1660250868', 13),
(2681, 'Earned 2 parts of Gamma gate', '1660250869', 13),
(2682, 'Earned 1 parts of Gamma gate', '1660250869', 13),
(2683, 'Earned 50 sab ammo', '1660250869', 13),
(2684, 'Earned 100 mcb25 ammo', '1660250869', 13),
(2685, 'Earned 100 mcb25 ammo', '1660250869', 13),
(2686, 'Earned 25 plt21 ammo', '1660250870', 13),
(2687, 'Earned 35 plt21 ammo', '1660250870', 13),
(2688, 'Earned 225 sab ammo', '1660250870', 13),
(2689, 'Earned 100 mcb25 ammo', '1660250870', 13),
(2690, 'Earned 50 sab ammo', '1660250870', 13),
(2691, 'Earned 225 sab ammo', '1660250871', 13),
(2692, 'Earned 100 mcb25 ammo', '1660250871', 13),
(2693, 'Earned 215 mcb50 ammo', '1660250871', 13),
(2694, 'Earned 1 parts of Gamma gate', '1660250871', 13),
(2695, 'Earned 100 mcb25 ammo', '1660250872', 13),
(2696, 'Earned 100 mcb25 ammo', '1660250872', 13),
(2697, 'Earned 140 mcb25 ammo', '1660250872', 13),
(2698, 'Earned 225 sab ammo', '1660250872', 13),
(2699, 'Earned 215 mcb50 ammo', '1660250872', 13),
(2700, 'Earned 3 parts of Gamma gate', '1660250872', 13),
(2701, 'Earned 75 mcb50 ammo', '1660250873', 13),
(2702, 'Earned 215 mcb50 ammo', '1660250873', 13),
(2703, 'Earned 25 plt21 ammo', '1660250873', 13),
(2704, 'Earned 35 plt21 ammo', '1660250873', 13),
(2705, 'Earned 10 pld ammo', '1660250873', 13),
(2706, 'Earned 115 mcb50 ammo', '1660250874', 13),
(2707, 'Earned 215 mcb50 ammo', '1660250874', 13),
(2708, 'Earned 215 mcb50 ammo', '1660250874', 13),
(2709, 'Earned 3 parts of Gamma gate', '1660250874', 13),
(2710, 'Earned 50 sab ammo', '1660250874', 13),
(2711, 'Earned 25 plt21 ammo', '1660250875', 13),
(2712, 'Earned 100 mcb25 ammo', '1660250875', 13),
(2713, 'Earned 140 mcb25 ammo', '1660250875', 13),
(2714, 'Earned 2 parts of Gamma gate', '1660250875', 13),
(2715, 'Earned 35 plt21 ammo', '1660250875', 13),
(2716, 'Earned 215 mcb50 ammo', '1660250876', 13),
(2717, 'Earned 25 plt21 ammo', '1660250876', 13),
(2718, 'Earned 25 plt21 ammo', '1660250876', 13),
(2719, 'Earned 115 mcb50 ammo', '1660250876', 13),
(2720, 'Earned 100 mcb25 ammo', '1660250876', 13),
(2721, 'Earned 10 pld ammo', '1660250877', 13),
(2722, 'Earned 100 mcb25 ammo', '1660250877', 13),
(2723, 'Earned 25 plt21 ammo', '1660250877', 13),
(2724, 'Earned 2 parts of Gamma gate', '1660250877', 13),
(2725, 'Earned 1 parts of Gamma gate', '1660250878', 13),
(2726, 'Earned 115 mcb50 ammo', '1660250878', 13),
(2727, 'Earned 215 mcb50 ammo', '1660250878', 13),
(2728, 'Earned 3 parts of Gamma gate', '1660250878', 13),
(2729, 'Earned 35 plt21 ammo', '1660250878', 13),
(2730, 'Earned 100 mcb25 ammo', '1660250879', 13),
(2731, 'Earned 225 sab ammo', '1660250879', 13),
(2732, 'Earned 10 pld ammo', '1660250879', 13),
(2733, 'Earned 215 mcb50 ammo', '1660250879', 13),
(2734, 'Earned 225 sab ammo', '1660250879', 13),
(2735, 'Earned 100 mcb25 ammo', '1660250879', 13),
(2736, 'Earned 215 mcb50 ammo', '1660250880', 13),
(2737, 'Earned 100 mcb25 ammo', '1660250880', 13),
(2738, 'Earned 215 mcb50 ammo', '1660250880', 13),
(2739, 'Earned 225 sab ammo', '1660250880', 13),
(2740, 'Earned 225 sab ammo', '1660250880', 13),
(2741, 'Earned 85 mcb25 ammo', '1660250881', 13),
(2742, 'Earned 215 mcb50 ammo', '1660250881', 13),
(2743, 'Earned 75 mcb50 ammo', '1660250881', 13),
(2744, 'Earned 225 sab ammo', '1660250881', 13),
(2745, 'Earned 115 mcb50 ammo', '1660250882', 13),
(2746, 'Earned 35 plt21 ammo', '1660250882', 13),
(2747, 'Earned 50 sab ammo', '1660250882', 13),
(2748, 'Earned 1 parts of Gamma gate', '1660250882', 13),
(2749, 'Earned 115 mcb50 ammo', '1660250882', 13),
(2750, 'Earned 100 mcb25 ammo', '1660250882', 13),
(2751, 'Earned 50 sab ammo', '1660250883', 13),
(2752, 'Earned 100 mcb25 ammo', '1660250883', 13),
(2753, 'Earned 25 plt21 ammo', '1660250883', 13),
(2754, 'Earned 100 mcb25 ammo', '1660250883', 13),
(2755, 'Earned 100 mcb25 ammo', '1660250884', 13),
(2756, 'Earned 10 pld ammo', '1660250884', 13),
(2757, 'Earned 1 parts of Gamma gate', '1660250884', 13),
(2758, 'Earned 215 mcb50 ammo', '1660250884', 13),
(2759, 'Earned 225 sab ammo', '1660250884', 13),
(2760, 'Earned 115 mcb50 ammo', '1660250885', 13),
(2761, 'Earned 50 sab ammo', '1660250885', 13),
(2762, 'Earned 100 mcb25 ammo', '1660250885', 13),
(2763, 'Earned 10 pld ammo', '1660250885', 13),
(2764, 'Earned 140 mcb25 ammo', '1660250885', 13),
(2765, 'Earned 1 parts of Gamma gate', '1660250886', 13),
(2766, 'Earned 115 mcb50 ammo', '1660250886', 13),
(2767, 'Earned 100 mcb25 ammo', '1660250886', 13),
(2768, 'Earned 215 mcb50 ammo', '1660250886', 13),
(2769, 'Earned 115 mcb50 ammo', '1660250886', 13),
(2770, 'Earned 100 mcb25 ammo', '1660250887', 13),
(2771, 'Earned 10 pld ammo', '1660250887', 13),
(2772, 'Earned 100 mcb25 ammo', '1660250887', 13),
(2773, 'Earned 1 parts of Gamma gate', '1660250887', 13),
(2774, 'Earned 85 mcb25 ammo', '1660250887', 13),
(2775, 'Earned 100 mcb25 ammo', '1660250888', 13),
(2776, 'Earned 35 plt21 ammo', '1660250888', 13),
(2777, 'Earned 115 mcb50 ammo', '1660250888', 13),
(2778, 'Earned 50 sab ammo', '1660250888', 13),
(2779, 'Earned 100 mcb25 ammo', '1660250888', 13),
(2780, 'Earned 85 mcb25 ammo', '1660250888', 13),
(2781, 'Earned 115 mcb50 ammo', '1660250889', 13),
(2782, 'Earned 1 parts of Gamma gate', '1660250889', 13),
(2783, 'Earned 100 mcb25 ammo', '1660250889', 13),
(2784, 'Earned 25 plt21 ammo', '1660250889', 13),
(2785, 'Earned 115 mcb50 ammo', '1660250889', 13),
(2786, 'Earned 35 plt21 ammo', '1660250890', 13),
(2787, 'Earned 215 mcb50 ammo', '1660250890', 13),
(2788, 'Earned 3 parts of Gamma gate', '1660250890', 13),
(2789, 'Earned 2 parts of Gamma gate', '1660250890', 13),
(2790, 'Earned 50 sab ammo', '1660250890', 13),
(2791, 'Earned 35 plt21 ammo', '1660250891', 13),
(2792, 'Earned 75 mcb50 ammo', '1660250891', 13),
(2793, 'Earned 35 plt21 ammo', '1660250891', 13),
(2794, 'Earned 1 parts of Gamma gate', '1660250891', 13),
(2795, 'Earned 85 mcb25 ammo', '1660250891', 13),
(2796, 'Earned 225 sab ammo', '1660250892', 13),
(2797, 'Earned 2 parts of Gamma gate', '1660250892', 13),
(2798, 'Earned 225 sab ammo', '1660250892', 13),
(2799, 'Earned 1 parts of Gamma gate', '1660250892', 13),
(2800, 'Earned 3 parts of Gamma gate', '1660250892', 13),
(2801, 'Earned 215 mcb50 ammo', '1660250893', 13),
(2802, 'Earned 100 mcb25 ammo', '1660250893', 13),
(2803, 'Earned 100 mcb25 ammo', '1660250893', 13),
(2804, 'Earned 215 mcb50 ammo', '1660250893', 13),
(2805, 'Earned 140 mcb25 ammo', '1660250893', 13),
(2806, 'Earned 1 parts of Gamma gate', '1660250893', 13),
(2807, 'Earned 215 mcb50 ammo', '1660250894', 13),
(2808, 'Earned 1 parts of Gamma gate', '1660250894', 13),
(2809, 'Earned 140 mcb25 ammo', '1660250894', 13),
(2810, 'Earned 2 parts of Gamma gate', '1660250894', 13),
(2811, 'Earned 3 parts of Gamma gate', '1660250894', 13),
(2812, 'Earned 1 parts of Gamma gate. Sucesfully unlocked gate.', '1660250895', 13),
(2813, 'Buyed 1 live in Gamma gate', '1660327585', 1),
(2814, 'Earned 50 sab ammo', '1660397053', 14),
(2815, 'Earned 225 sab ammo', '1660397053', 14),
(2816, 'Earned 140 mcb25 ammo', '1660397054', 14),
(2817, 'Earned 100 mcb25 ammo', '1660397054', 14),
(2818, 'Earned 1 parts of Alpha gate', '1660397054', 14),
(2819, 'Earned 215 mcb50 ammo', '1660397054', 14),
(2820, 'Earned 75 mcb50 ammo', '1660397054', 14),
(2821, 'Earned 225 sab ammo', '1660397054', 14),
(2822, 'Earned 1 parts of Alpha gate', '1660397055', 14),
(2823, 'Earned 35 plt21 ammo', '1660397055', 14),
(2824, 'Earned 50 sab ammo', '1660397055', 14),
(2825, 'Earned 1 parts of Alpha gate', '1660397055', 14),
(2826, 'Earned 25 plt21 ammo', '1660397055', 14),
(2827, 'Earned 100 mcb25 ammo', '1660397056', 14),
(2828, 'Earned 100 mcb25 ammo', '1660397056', 14),
(2829, 'Earned 215 mcb50 ammo', '1660397056', 14),
(2830, 'Earned 100 mcb25 ammo', '1660397056', 14),
(2831, 'Earned 25 plt21 ammo', '1660397057', 14),
(2832, 'Earned 1 parts of Alpha gate', '1660397057', 14),
(2833, 'Earned 140 mcb25 ammo', '1660397057', 14),
(2834, 'Earned 115 mcb50 ammo', '1660397057', 14),
(2835, 'Earned 100 mcb25 ammo', '1660397057', 14),
(2836, 'Earned 50 sab ammo', '1660397058', 14),
(2837, 'Earned 25 plt21 ammo', '1660397058', 14),
(2838, 'Earned 50 sab ammo', '1660397058', 14),
(2839, 'Earned 215 mcb50 ammo', '1660397058', 14),
(2840, 'Earned 25 plt21 ammo', '1660397059', 14),
(2841, 'Earned 100 mcb25 ammo', '1660397059', 14),
(2842, 'Earned 1 parts of Alpha gate', '1660397059', 14),
(2843, 'Earned 150 sab ammo', '1660397059', 14),
(2844, 'Earned 215 mcb50 ammo', '1660397059', 14),
(2845, 'Earned 10 pld ammo', '1660397059', 14),
(2846, 'Earned 1 parts of Alpha gate', '1660397060', 14),
(2847, 'Earned 1 parts of Alpha gate', '1660397060', 14),
(2848, 'Earned 50 sab ammo', '1660397060', 14),
(2849, 'Earned 50 sab ammo', '1660397060', 14),
(2850, 'Earned 225 sab ammo', '1660397060', 14),
(2851, 'Earned 215 mcb50 ammo', '1660397061', 14),
(2852, 'Earned 150 sab ammo', '1660397061', 14),
(2853, 'Earned 1 parts of Alpha gate', '1660397061', 14),
(2854, 'Earned 1 parts of Alpha gate', '1660397061', 14),
(2855, 'Earned 115 mcb50 ammo', '1660397061', 14),
(2856, 'Earned 25 plt21 ammo', '1660397062', 14),
(2857, 'Earned 225 sab ammo', '1660397062', 14),
(2858, 'Earned 75 mcb50 ammo', '1660397062', 14),
(2859, 'Earned 10 pld ammo', '1660397062', 14),
(2860, 'Earned 1 parts of Alpha gate', '1660397062', 14),
(2861, 'Earned 215 mcb50 ammo', '1660397062', 14),
(2862, 'Earned 100 mcb25 ammo', '1660397063', 14),
(2863, 'Earned 215 mcb50 ammo', '1660397063', 14),
(2864, 'Earned 215 mcb50 ammo', '1660397063', 14),
(2865, 'Earned 140 mcb25 ammo', '1660397063', 14),
(2866, 'Earned 115 mcb50 ammo', '1660397063', 14),
(2867, 'Earned 75 mcb50 ammo', '1660397063', 14),
(2868, 'Earned 215 mcb50 ammo', '1660397064', 14),
(2869, 'Earned 225 sab ammo', '1660397064', 14),
(2870, 'Earned 75 mcb50 ammo', '1660397064', 14),
(2871, 'Earned 3 parts of Alpha gate', '1660397064', 14),
(2872, 'Earned 150 sab ammo', '1660397065', 14),
(2873, 'Earned 1 parts of Alpha gate', '1660397065', 14),
(2874, 'Earned 2 parts of Alpha gate', '1660397065', 14),
(2875, 'Earned 1 parts of Alpha gate', '1660397065', 14),
(2876, 'Earned 75 mcb50 ammo', '1660397066', 14),
(2877, 'Earned 215 mcb50 ammo', '1660397066', 14),
(2878, 'Earned 100 mcb25 ammo', '1660397066', 14),
(2879, 'Earned 100 mcb25 ammo', '1660397066', 14),
(2880, 'Earned 225 sab ammo', '1660397066', 14),
(2881, 'Earned 100 mcb25 ammo', '1660397066', 14),
(2882, 'Earned 75 mcb50 ammo', '1660397067', 14),
(2883, 'Earned 50 sab ammo', '1660397067', 14),
(2884, 'Earned 225 sab ammo', '1660397067', 14),
(2885, 'Earned 3 parts of Alpha gate', '1660397067', 14),
(2886, 'Earned 35 plt21 ammo', '1660397068', 14),
(2887, 'Earned 35 plt21 ammo', '1660397068', 14),
(2888, 'Earned 10 pld ammo', '1660397068', 14),
(2889, 'Earned 100 mcb25 ammo', '1660397068', 14),
(2890, 'Earned 215 mcb50 ammo', '1660397068', 14),
(2891, 'Earned 140 mcb25 ammo', '1660397069', 14),
(2892, 'Earned 1 parts of Alpha gate', '1660397069', 14),
(2893, 'Earned 225 sab ammo', '1660397069', 14),
(2894, 'Earned 2 parts of Alpha gate', '1660397069', 14),
(2895, 'Earned 100 mcb25 ammo', '1660397069', 14),
(2896, 'Earned 100 mcb25 ammo', '1660397070', 14),
(2897, 'Earned 150 sab ammo', '1660397070', 14),
(2898, 'Earned 225 sab ammo', '1660397070', 14),
(2899, 'Earned 140 mcb25 ammo', '1660397070', 14),
(2900, 'Earned 150 sab ammo', '1660397071', 14),
(2901, 'Earned 10 pld ammo', '1660397071', 14),
(2902, 'Earned 215 mcb50 ammo', '1660397071', 14),
(2903, 'Earned 225 sab ammo', '1660397071', 14),
(2904, 'Earned 35 plt21 ammo', '1660397071', 14),
(2905, 'Earned 1 parts of Alpha gate', '1660397071', 14),
(2906, 'Earned 100 mcb25 ammo', '1660397072', 14),
(2907, 'Earned 100 mcb25 ammo', '1660397072', 14),
(2908, 'Earned 1 parts of Alpha gate', '1660397072', 14),
(2909, 'Earned 85 mcb25 ammo', '1660397072', 14),
(2910, 'Earned 140 mcb25 ammo', '1660397072', 14),
(2911, 'Earned 225 sab ammo', '1660397073', 14),
(2912, 'Earned 75 mcb50 ammo', '1660397073', 14),
(2913, 'Earned 25 plt21 ammo', '1660397073', 14),
(2914, 'Earned 215 mcb50 ammo', '1660397073', 14),
(2915, 'Earned 2 parts of Alpha gate', '1660397073', 14),
(2916, 'Earned 100 mcb25 ammo', '1660397073', 14),
(2917, 'Earned 1 parts of Alpha gate', '1660397074', 14),
(2918, 'Earned 50 sab ammo', '1660397074', 14),
(2919, 'Earned 100 mcb25 ammo', '1660397074', 14),
(2920, 'Earned 35 plt21 ammo', '1660397074', 14),
(2921, 'Earned 150 sab ammo', '1660397075', 14),
(2922, 'Earned 215 mcb50 ammo', '1660397075', 14),
(2923, 'Earned 50 sab ammo', '1660397075', 14),
(2924, 'Earned 115 mcb50 ammo', '1660397075', 14),
(2925, 'Earned 100 mcb25 ammo', '1660397075', 14),
(2926, 'Earned 2 parts of Alpha gate', '1660397075', 14),
(2927, 'Earned 85 mcb25 ammo', '1660397076', 14),
(2928, 'Earned 100 mcb25 ammo', '1660397076', 14),
(2929, 'Earned 35 plt21 ammo', '1660397076', 14),
(2930, 'Earned 215 mcb50 ammo', '1660397076', 14),
(2931, 'Earned 1 parts of Alpha gate', '1660397077', 14),
(2932, 'Earned 150 sab ammo', '1660397077', 14),
(2933, 'Earned 100 mcb25 ammo', '1660397077', 14),
(2934, 'Earned 115 mcb50 ammo', '1660397077', 14),
(2935, 'Earned 100 mcb25 ammo', '1660397078', 14),
(2936, 'Earned 3 parts of Alpha gate. Sucesfully unlocked gate.', '1660397078', 14),
(2937, 'Earned 100 mcb25 ammo', '1660510595', 14),
(2938, 'Earned 1 parts of Beta gate', '1660510597', 14),
(2939, 'Earned 1 parts of Beta gate', '1660510598', 14),
(2940, 'Earned 75 mcb50 ammo', '1660510600', 14),
(2941, 'Earned 50 sab ammo', '1660510601', 14),
(2942, 'Earned 3 parts of Beta gate', '1660510602', 14),
(2943, 'Earned 150 sab ammo', '1660510604', 14),
(2944, 'Earned 150 sab ammo', '1660510605', 14),
(2945, 'Earned 50 sab ammo', '1660510606', 14),
(2946, 'Earned 50 sab ammo', '1660510608', 14),
(2947, 'Earned 100 mcb25 ammo', '1660510609', 14),
(2948, 'Earned 100 mcb25 ammo', '1660510611', 14),
(2949, 'Earned 10 pld ammo', '1660510614', 14),
(2950, 'Earned 140 mcb25 ammo', '1660510615', 14),
(2951, 'Earned 3 parts of Beta gate', '1660510618', 14),
(2952, 'Earned 1 parts of Beta gate', '1660510619', 14),
(2953, 'Earned 10 pld ammo', '1660510620', 14),
(2954, 'Earned 85 mcb25 ammo', '1660510621', 14),
(2955, 'Earned 215 mcb50 ammo', '1660510623', 14),
(2956, 'Earned 140 mcb25 ammo', '1660510625', 14),
(2957, 'Earned 3 parts of Beta gate', '1660510627', 14),
(2958, 'Earned 1 parts of Beta gate', '1660510628', 14),
(2959, 'Buyed 1 live in Alpha gate', '1660668405', 14),
(2960, 'Buyed 1 live in Alpha gate', '1660668414', 14),
(2961, 'Earned 85 mcb25 ammo', '1660668961', 14),
(2962, 'Earned 25 plt21 ammo', '1660668961', 14),
(2963, 'Earned 2 parts of Alpha gate', '1660668961', 14),
(2964, 'Earned 215 mcb50 ammo', '1660668962', 14),
(2965, 'Earned 50 sab ammo', '1660668962', 14),
(2966, 'Earned 100 mcb25 ammo', '1660668962', 14),
(2967, 'Earned 10 pld ammo', '1660668962', 14),
(2968, 'Earned 3 parts of Alpha gate', '1660668962', 14),
(2969, 'Earned 1 parts of Alpha gate', '1660668963', 14),
(2970, 'Earned 100 mcb25 ammo', '1660668963', 14),
(2971, 'Earned 115 mcb50 ammo', '1660668963', 14),
(2972, 'Earned 3 parts of Alpha gate', '1660668963', 14),
(2973, 'Earned 100 mcb25 ammo', '1660668963', 14),
(2974, 'Earned 10 pld ammo', '1660668964', 14),
(2975, 'Earned 100 mcb25 ammo', '1660668964', 14),
(2976, 'Earned 1 parts of Alpha gate', '1660668964', 14),
(2977, 'Earned 100 mcb25 ammo', '1660668964', 14),
(2978, 'Earned 115 mcb50 ammo', '1660668964', 14),
(2979, 'Earned 85 mcb25 ammo', '1660668964', 14),
(2980, 'Earned 25 plt21 ammo', '1660668965', 14),
(2981, 'Earned 1 parts of Alpha gate', '1660668965', 14),
(2982, 'Earned 1 parts of Alpha gate', '1660668965', 14),
(2983, 'Earned 100 mcb25 ammo', '1660668965', 14),
(2984, 'Earned 215 mcb50 ammo', '1660668966', 14),
(2985, 'Earned 1 parts of Alpha gate', '1660668966', 14),
(2986, 'Earned 25 plt21 ammo', '1660668966', 14),
(2987, 'Earned 85 mcb25 ammo', '1660668966', 14),
(2988, 'Earned 35 plt21 ammo', '1660668966', 14),
(2989, 'Earned 2 parts of Alpha gate', '1660668966', 14),
(2990, 'Earned 1 parts of Alpha gate', '1660668967', 14),
(2991, 'Earned 215 mcb50 ammo', '1660668967', 14),
(2992, 'Earned 85 mcb25 ammo', '1660668967', 14),
(2993, 'Earned 1 parts of Alpha gate', '1660668967', 14),
(2994, 'Earned 115 mcb50 ammo', '1660668967', 14),
(2995, 'Earned 100 mcb25 ammo', '1660668968', 14),
(2996, 'Earned 140 mcb25 ammo', '1660668968', 14),
(2997, 'Earned 215 mcb50 ammo', '1660668968', 14),
(2998, 'Earned 75 mcb50 ammo', '1660668968', 14),
(2999, 'Earned 25 plt21 ammo', '1660668968', 14),
(3000, 'Earned 1 parts of Alpha gate', '1660668969', 14),
(3001, 'Earned 225 sab ammo', '1660668969', 14),
(3002, 'Earned 140 mcb25 ammo', '1660668969', 14),
(3003, 'Earned 1 parts of Alpha gate', '1660668969', 14),
(3004, 'Earned 2 parts of Alpha gate', '1660668969', 14),
(3005, 'Earned 1 parts of Alpha gate', '1660668970', 14),
(3006, 'Earned 1 parts of Alpha gate', '1660668970', 14),
(3007, 'Earned 1 parts of Alpha gate', '1660668970', 14),
(3008, 'Earned 10 pld ammo', '1660668970', 14),
(3009, 'Earned 100 mcb25 ammo', '1660668970', 14),
(3010, 'Earned 85 mcb25 ammo', '1660668971', 14),
(3011, 'Earned 100 mcb25 ammo', '1660668971', 14),
(3012, 'Earned 1 parts of Alpha gate', '1660668971', 14),
(3013, 'Earned 1 parts of Alpha gate', '1660668971', 14),
(3014, 'Earned 75 mcb50 ammo', '1660668971', 14),
(3015, 'Earned 35 plt21 ammo', '1660668971', 14),
(3016, 'Earned 100 mcb25 ammo', '1660668972', 14),
(3017, 'Earned 150 sab ammo', '1660668972', 14),
(3018, 'Earned 1 parts of Alpha gate', '1660668972', 14),
(3019, 'Earned 25 plt21 ammo', '1660668972', 14),
(3020, 'Earned 2 parts of Alpha gate', '1660668972', 14),
(3021, 'Earned 100 mcb25 ammo', '1660668973', 14),
(3022, 'Earned 3 parts of Alpha gate', '1660668973', 14),
(3023, 'Earned 225 sab ammo', '1660668973', 14),
(3024, 'Earned 140 mcb25 ammo', '1660668973', 14),
(3025, 'Earned 1 parts of Alpha gate', '1660668974', 14),
(3026, 'Earned 140 mcb25 ammo', '1660668974', 14),
(3027, 'Earned 1 parts of Alpha gate. Sucesfully unlocked gate.', '1660668974', 14),
(3028, 'Earned 2 parts of Kronos gate', '1662382642', 1),
(3029, 'Earned 35 plt3030 ammo', '1662382642', 1),
(3030, 'Earned 215 mcb50 ammo', '1662382642', 1),
(3031, 'Earned 185 mcb25 ammo', '1662382643', 1),
(3032, 'Earned 10 pld ammo', '1662382643', 1),
(3033, 'Earned 215 mcb50 ammo', '1662382643', 1),
(3034, 'Earned 175 mcb50 ammo', '1662382643', 1),
(3035, 'Earned 275 mcb50 ammo', '1662382643', 1),
(3036, 'Earned 210 mcb25 ammo', '1662382643', 1),
(3037, 'Earned 45 plt21 ammo', '1662382644', 1),
(3038, 'Earned 45 plt21 ammo', '1662382644', 1),
(3039, 'Earned 210 mcb25 ammo', '1662382644', 1),
(3040, 'Earned 250 sab ammo', '1662382644', 1),
(3041, 'Earned 325 ucb ammo', '1662382644', 1),
(3042, 'Earned 215 mcb50 ammo', '1662382644', 1),
(3043, 'Earned 3 parts of Kronos gate', '1662382645', 1),
(3044, 'Earned 250 sab ammo', '1662382645', 1),
(3045, 'Earned 210 mcb25 ammo', '1662382645', 1),
(3046, 'Earned 35 plt3030 ammo', '1662382645', 1),
(3047, 'Earned 350 ucb ammo', '1662382645', 1);
INSERT INTO `gg_log` (`id`, `log`, `date`, `userId`) VALUES
(3048, 'Earned 1 parts of Kronos gate', '1662382646', 1),
(3049, 'Earned 1 parts of Kronos gate', '1662382646', 1),
(3050, 'Earned 350 ucb ammo', '1662382646', 1),
(3051, 'Earned 185 mcb25 ammo', '1662382646', 1),
(3052, 'Earned 275 mcb50 ammo', '1662382646', 1),
(3053, 'Earned 275 mcb50 ammo', '1662382646', 1),
(3054, 'Earned 3 parts of Kronos gate', '1662382647', 1),
(3055, 'Earned 350 ucb ammo', '1662382647', 1),
(3056, 'Earned 1 parts of Kronos gate', '1662382647', 1),
(3057, 'Earned 1 parts of Kronos gate', '1662382647', 1),
(3058, 'Earned 210 mcb25 ammo', '1662382647', 1),
(3059, 'Earned 210 mcb25 ammo', '1662382648', 1),
(3060, 'Earned 275 mcb50 ammo', '1662382648', 1),
(3061, 'Earned 175 mcb25 ammo', '1662382648', 1),
(3062, 'Earned 175 mcb25 ammo', '1662382648', 1),
(3063, 'Earned 215 mcb50 ammo', '1662382648', 1),
(3064, 'Earned 35 plt3030 ammo', '1662382648', 1),
(3065, 'Earned 175 mcb50 ammo', '1662382649', 1),
(3066, 'Earned 1 parts of Kronos gate', '1662382649', 1),
(3067, 'Earned 35 plt3030 ammo', '1662382649', 1),
(3068, 'Earned 45 plt21 ammo', '1662382649', 1),
(3069, 'Earned 215 mcb50 ammo', '1662382649', 1),
(3070, 'Earned 3 parts of Kronos gate', '1662382650', 1),
(3071, 'Earned 210 mcb25 ammo', '1662382650', 1),
(3072, 'Earned 325 ucb ammo', '1662382650', 1),
(3073, 'Earned 175 mcb50 ammo', '1662382650', 1),
(3074, 'Earned 175 mcb25 ammo', '1662382650', 1),
(3075, 'Earned 215 mcb50 ammo', '1662382650', 1),
(3076, 'Earned 3 parts of Kronos gate', '1662382651', 1),
(3077, 'Earned 210 mcb25 ammo', '1662382651', 1),
(3078, 'Earned 215 mcb50 ammo', '1662382651', 1),
(3079, 'Earned 250 sab ammo', '1662382651', 1),
(3080, 'Earned 325 ucb ammo', '1662382651', 1),
(3081, 'Earned 3 parts of Kronos gate', '1662382652', 1),
(3082, 'Earned 210 mcb25 ammo', '1662382652', 1),
(3083, 'Earned 175 mcb50 ammo', '1662382652', 1),
(3084, 'Earned 175 mcb25 ammo', '1662382652', 1),
(3085, 'Earned 185 mcb25 ammo', '1662382652', 1),
(3086, 'Earned 250 sab ammo', '1662382653', 1),
(3087, 'Earned 215 mcb50 ammo', '1662382653', 1),
(3088, 'Earned 45 plt21 ammo', '1662382653', 1),
(3089, 'Earned 1 parts of Kronos gate', '1662382653', 1),
(3090, 'Earned 350 ucb ammo', '1662382653', 1),
(3091, 'Earned 210 mcb25 ammo', '1662382653', 1),
(3092, 'Earned 275 mcb50 ammo', '1662382654', 1),
(3093, 'Earned 10 pld ammo', '1662382654', 1),
(3094, 'Earned 215 mcb50 ammo', '1662382654', 1),
(3095, 'Earned 210 mcb25 ammo', '1662382654', 1),
(3096, 'Earned 210 mcb25 ammo', '1662382654', 1),
(3097, 'Earned 215 mcb50 ammo', '1662382655', 1),
(3098, 'Earned 215 mcb50 ammo', '1662382655', 1),
(3099, 'Earned 175 mcb25 ammo', '1662382655', 1),
(3100, 'Earned 175 mcb25 ammo', '1662382655', 1),
(3101, 'Earned 35 plt3030 ammo', '1662382655', 1),
(3102, 'Earned 45 plt21 ammo', '1662382655', 1),
(3103, 'Earned 185 mcb25 ammo', '1662382656', 1),
(3104, 'Earned 215 mcb50 ammo', '1662382656', 1),
(3105, 'Earned 250 sab ammo', '1662382656', 1),
(3106, 'Earned 1 parts of Kronos gate', '1662382656', 1),
(3107, 'Earned 250 sab ammo', '1662382656', 1),
(3108, 'Earned 10 pld ammo', '1662382657', 1),
(3109, 'Earned 250 sab ammo', '1662382657', 1),
(3110, 'Earned 45 plt21 ammo', '1662382657', 1),
(3111, 'Earned 210 mcb25 ammo', '1662382657', 1),
(3112, 'Earned 210 mcb25 ammo', '1662382657', 1),
(3113, 'Earned 210 mcb25 ammo', '1662382657', 1),
(3114, 'Earned 350 ucb ammo', '1662382658', 1),
(3115, 'Earned 325 ucb ammo', '1662382658', 1),
(3116, 'Earned 45 plt21 ammo', '1662382658', 1),
(3117, 'Earned 250 sab ammo', '1662382658', 1),
(3118, 'Earned 175 mcb50 ammo', '1662382658', 1),
(3119, 'Earned 175 mcb50 ammo', '1662382659', 1),
(3120, 'Earned 215 mcb50 ammo', '1662382659', 1),
(3121, 'Earned 215 mcb50 ammo', '1662382659', 1),
(3122, 'Earned 210 mcb25 ammo', '1662382659', 1),
(3123, 'Earned 210 mcb25 ammo', '1662382659', 1),
(3124, 'Earned 210 mcb25 ammo', '1662382659', 1),
(3125, 'Earned 35 plt3030 ammo', '1662382660', 1),
(3126, 'Earned 45 plt21 ammo', '1662382660', 1),
(3127, 'Earned 325 ucb ammo', '1662382660', 1),
(3128, 'Earned 2 parts of Kronos gate', '1662382660', 1),
(3129, 'Earned 45 plt21 ammo', '1662382660', 1),
(3130, 'Earned 210 mcb25 ammo', '1662382661', 1),
(3131, 'Earned 250 sab ammo', '1662382661', 1),
(3132, 'Earned 175 mcb50 ammo', '1662382661', 1),
(3133, 'Earned 3 parts of Kronos gate', '1662382661', 1),
(3134, 'Earned 175 mcb50 ammo', '1662382661', 1),
(3135, 'Earned 1 parts of Kronos gate', '1662382662', 1),
(3136, 'Earned 2 parts of Kronos gate', '1662382662', 1),
(3137, 'Earned 215 mcb50 ammo', '1662382662', 1),
(3138, 'Earned 1 parts of Kronos gate', '1662382662', 1),
(3139, 'Earned 185 mcb25 ammo', '1662382662', 1),
(3140, 'Earned 325 ucb ammo', '1662382662', 1),
(3141, 'Earned 350 ucb ammo', '1662382663', 1),
(3142, 'Earned 1 parts of Kronos gate', '1662382663', 1),
(3143, 'Earned 210 mcb25 ammo', '1662382663', 1),
(3144, 'Earned 250 sab ammo', '1662382663', 1),
(3145, 'Earned 215 mcb50 ammo', '1662382663', 1),
(3146, 'Earned 215 mcb50 ammo', '1662382664', 1),
(3147, 'Earned 45 plt21 ammo', '1662382664', 1),
(3148, 'Earned 175 mcb50 ammo', '1662382664', 1),
(3149, 'Earned 3 parts of Kronos gate', '1662382664', 1),
(3150, 'Earned 215 mcb50 ammo', '1662382664', 1),
(3151, 'Earned 185 mcb25 ammo', '1662382664', 1),
(3152, 'Earned 215 mcb50 ammo', '1662382665', 1),
(3153, 'Earned 215 mcb50 ammo', '1662382665', 1),
(3154, 'Earned 1 parts of Kronos gate', '1662382665', 1),
(3155, 'Earned 210 mcb25 ammo', '1662382665', 1),
(3156, 'Earned 275 mcb50 ammo', '1662382665', 1),
(3157, 'Earned 3 parts of Kronos gate', '1662382666', 1),
(3158, 'Earned 185 mcb25 ammo', '1662382666', 1),
(3159, 'Earned 350 ucb ammo', '1662382666', 1),
(3160, 'Earned 250 sab ammo', '1662382666', 1),
(3161, 'Earned 215 mcb50 ammo', '1662382666', 1),
(3162, 'Earned 45 plt21 ammo', '1662382666', 1),
(3163, 'Earned 250 sab ammo', '1662382667', 1),
(3164, 'Earned 210 mcb25 ammo', '1662382667', 1),
(3165, 'Earned 2 parts of Kronos gate', '1662382667', 1),
(3166, 'Earned 325 ucb ammo', '1662382667', 1),
(3167, 'Earned 45 plt21 ammo', '1662382667', 1),
(3168, 'Earned 175 mcb50 ammo', '1662382667', 1),
(3169, 'Earned 35 plt3030 ammo', '1662382668', 1),
(3170, 'Earned 215 mcb50 ammo', '1662382668', 1),
(3171, 'Earned 215 mcb50 ammo', '1662382668', 1),
(3172, 'Earned 1 parts of Kronos gate', '1662382668', 1),
(3173, 'Earned 215 mcb50 ammo', '1662382668', 1),
(3174, 'Earned 45 plt21 ammo', '1662382669', 1),
(3175, 'Earned 1 parts of Kronos gate', '1662382669', 1),
(3176, 'Earned 215 mcb50 ammo', '1662382669', 1),
(3177, 'Earned 210 mcb25 ammo', '1662382669', 1),
(3178, 'Earned 185 mcb25 ammo', '1662382669', 1),
(3179, 'Earned 215 mcb50 ammo', '1662382669', 1),
(3180, 'Earned 45 plt21 ammo', '1662382670', 1),
(3181, 'Earned 1 parts of Kronos gate', '1662382670', 1),
(3182, 'Earned 215 mcb50 ammo', '1662382670', 1),
(3183, 'Earned 210 mcb25 ammo', '1662382670', 1),
(3184, 'Earned 3 parts of Kronos gate', '1662382670', 1),
(3185, 'Earned 45 plt21 ammo', '1662382671', 1),
(3186, 'Earned 350 ucb ammo', '1662382671', 1),
(3187, 'Earned 35 plt3030 ammo', '1662382671', 1),
(3188, 'Earned 215 mcb50 ammo', '1662382671', 1),
(3189, 'Earned 175 mcb25 ammo', '1662382671', 1),
(3190, 'Earned 1 parts of Kronos gate', '1662382672', 1),
(3191, 'Earned 10 pld ammo', '1662382672', 1),
(3192, 'Earned 10 pld ammo', '1662382672', 1),
(3193, 'Earned 275 mcb50 ammo', '1662382672', 1),
(3194, 'Earned 175 mcb50 ammo', '1662382672', 1),
(3195, 'Earned 210 mcb25 ammo', '1662382672', 1),
(3196, 'Earned 325 ucb ammo', '1662382673', 1),
(3197, 'Earned 275 mcb50 ammo', '1662382673', 1),
(3198, 'Earned 35 plt3030 ammo', '1662382673', 1),
(3199, 'Earned 215 mcb50 ammo', '1662382673', 1),
(3200, 'Earned 350 ucb ammo', '1662382673', 1),
(3201, 'Earned 1 parts of Kronos gate', '1662382674', 1),
(3202, 'Earned 3 parts of Kronos gate', '1662382674', 1),
(3203, 'Earned 210 mcb25 ammo', '1662382674', 1),
(3204, 'Earned 215 mcb50 ammo', '1662382674', 1),
(3205, 'Earned 45 plt21 ammo', '1662382675', 1),
(3206, 'Earned 215 mcb50 ammo', '1662382675', 1),
(3207, 'Earned 275 mcb50 ammo', '1662382675', 1),
(3208, 'Earned 10 pld ammo', '1662382675', 1),
(3209, 'Earned 250 sab ammo', '1662382675', 1),
(3210, 'Earned 175 mcb25 ammo', '1662382676', 1),
(3211, 'Earned 250 sab ammo', '1662382676', 1),
(3212, 'Earned 35 plt3030 ammo', '1662382676', 1),
(3213, 'Earned 215 mcb50 ammo', '1662382676', 1),
(3214, 'Earned 210 mcb25 ammo', '1662382676', 1),
(3215, 'Earned 325 ucb ammo', '1662382677', 1),
(3216, 'Earned 35 plt3030 ammo', '1662382677', 1),
(3217, 'Earned 210 mcb25 ammo', '1662382677', 1),
(3218, 'Earned 215 mcb50 ammo', '1662382677', 1),
(3219, 'Earned 1 parts of Kronos gate', '1662382677', 1),
(3220, 'Earned 175 mcb25 ammo', '1662382677', 1),
(3221, 'Earned 215 mcb50 ammo', '1662382678', 1),
(3222, 'Earned 45 plt21 ammo', '1662382678', 1),
(3223, 'Earned 210 mcb25 ammo', '1662382678', 1),
(3224, 'Earned 325 ucb ammo', '1662382682', 1),
(3225, 'Earned 250 sab ammo', '1662382682', 1),
(3226, 'Earned 210 mcb25 ammo', '1662382682', 1),
(3227, 'Earned 325 ucb ammo', '1662382682', 1),
(3228, 'Earned 250 sab ammo', '1662382682', 1),
(3229, 'Earned 210 mcb25 ammo', '1662382683', 1),
(3230, 'Earned 215 mcb50 ammo', '1662382683', 1),
(3231, 'Earned 215 mcb50 ammo', '1662382683', 1),
(3232, 'Earned 35 plt3030 ammo', '1662382683', 1),
(3233, 'Earned 275 mcb50 ammo', '1662382683', 1),
(3234, 'Earned 215 mcb50 ammo', '1662382684', 1),
(3235, 'Earned 350 ucb ammo', '1662382684', 1),
(3236, 'Earned 175 mcb25 ammo', '1662382684', 1),
(3237, 'Earned 2 parts of Kronos gate', '1662382684', 1),
(3238, 'Earned 3 parts of Kronos gate', '1662382684', 1),
(3239, 'Earned 275 mcb50 ammo', '1662382685', 1),
(3240, 'Earned 3 parts of Kronos gate', '1662382685', 1),
(3241, 'Earned 275 mcb50 ammo', '1662382685', 1),
(3242, 'Earned 210 mcb25 ammo', '1662382685', 1),
(3243, 'Earned 215 mcb50 ammo', '1662382685', 1),
(3244, 'Earned 215 mcb50 ammo', '1662382686', 1),
(3245, 'Earned 250 sab ammo', '1662382686', 1),
(3246, 'Earned 325 ucb ammo', '1662382686', 1),
(3247, 'Earned 215 mcb50 ammo', '1662382686', 1),
(3248, 'Earned 325 ucb ammo', '1662382686', 1),
(3249, 'Earned 215 mcb50 ammo', '1662382686', 1),
(3250, 'Earned 350 ucb ammo', '1662382687', 1),
(3251, 'Earned 250 sab ammo', '1662382687', 1),
(3252, 'Earned 325 ucb ammo', '1662382687', 1),
(3253, 'Earned 275 mcb50 ammo', '1662382687', 1),
(3254, 'Earned 210 mcb25 ammo', '1662382688', 1),
(3255, 'Earned 275 mcb50 ammo', '1662382688', 1),
(3256, 'Earned 210 mcb25 ammo', '1662382688', 1),
(3257, 'Earned 3 parts of Kronos gate', '1662382688', 1),
(3258, 'Earned 1 parts of Kronos gate', '1662382688', 1),
(3259, 'Earned 2 parts of Kronos gate', '1662382688', 1),
(3260, 'Earned 185 mcb25 ammo', '1662382689', 1),
(3261, 'Earned 175 mcb50 ammo', '1662382689', 1),
(3262, 'Earned 350 ucb ammo', '1662382689', 1),
(3263, 'Earned 275 mcb50 ammo', '1662382689', 1),
(3264, 'Earned 210 mcb25 ammo', '1662382689', 1),
(3265, 'Earned 215 mcb50 ammo', '1662382690', 1),
(3266, 'Earned 210 mcb25 ammo', '1662382690', 1),
(3267, 'Earned 250 sab ammo', '1662382690', 1),
(3268, 'Earned 215 mcb50 ammo', '1662382690', 1),
(3269, 'Earned 35 plt3030 ammo', '1662382690', 1),
(3270, 'Earned 10 pld ammo', '1662382691', 1),
(3271, 'Earned 325 ucb ammo', '1662382691', 1),
(3272, 'Earned 10 pld ammo', '1662382691', 1),
(3273, 'Earned 215 mcb50 ammo', '1662382691', 1),
(3274, 'Earned 325 ucb ammo', '1662382691', 1),
(3275, 'Earned 325 ucb ammo', '1662382692', 1),
(3276, 'Earned 350 ucb ammo', '1662382692', 1),
(3277, 'Earned 35 plt3030 ammo', '1662382692', 1),
(3278, 'Earned 2 parts of Kronos gate', '1662382692', 1),
(3279, 'Earned 215 mcb50 ammo', '1662382692', 1),
(3280, 'Earned 45 plt21 ammo', '1662382693', 1),
(3281, 'Earned 215 mcb50 ammo', '1662382693', 1),
(3282, 'Earned 3 parts of Kronos gate', '1662382693', 1),
(3283, 'Earned 250 sab ammo', '1662382693', 1),
(3284, 'Earned 1 parts of Kronos gate', '1662382693', 1),
(3285, 'Earned 215 mcb50 ammo', '1662382693', 1),
(3286, 'Earned 250 sab ammo', '1662382694', 1),
(3287, 'Earned 215 mcb50 ammo', '1662382694', 1),
(3288, 'Earned 275 mcb50 ammo', '1662382694', 1),
(3289, 'Earned 350 ucb ammo', '1662382694', 1),
(3290, 'Earned 1 parts of Kronos gate', '1662382694', 1),
(3291, 'Earned 215 mcb50 ammo', '1662382695', 1),
(3292, 'Earned 175 mcb25 ammo', '1662382695', 1),
(3293, 'Earned 45 plt21 ammo', '1662382695', 1),
(3294, 'Earned 350 ucb ammo', '1662382695', 1),
(3295, 'Earned 35 plt3030 ammo', '1662382695', 1),
(3296, 'Earned 210 mcb25 ammo', '1662382696', 1),
(3297, 'Earned 185 mcb25 ammo', '1662382696', 1),
(3298, 'Earned 45 plt21 ammo', '1662382696', 1),
(3299, 'Earned 210 mcb25 ammo', '1662382696', 1),
(3300, 'Earned 350 ucb ammo', '1662382696', 1),
(3301, 'Earned 35 plt3030 ammo', '1662382697', 1),
(3302, 'Earned 45 plt21 ammo', '1662382697', 1),
(3303, 'Earned 215 mcb50 ammo', '1662382697', 1),
(3304, 'Earned 2 parts of Kronos gate', '1662382697', 1),
(3305, 'Earned 210 mcb25 ammo', '1662382697', 1),
(3306, 'Earned 275 mcb50 ammo', '1662382698', 1),
(3307, 'Earned 275 mcb50 ammo', '1662382698', 1),
(3308, 'Earned 325 ucb ammo', '1662382698', 1),
(3309, 'Earned 325 ucb ammo', '1662382698', 1),
(3310, 'Earned 1 parts of Kronos gate', '1662382698', 1),
(3311, 'Earned 10 pld ammo', '1662382699', 1),
(3312, 'Earned 175 mcb50 ammo', '1662382699', 1),
(3313, 'Earned 45 plt21 ammo', '1662382699', 1),
(3314, 'Earned 175 mcb50 ammo', '1662382699', 1),
(3315, 'Earned 1 parts of Kronos gate', '1662382699', 1),
(3316, 'Earned 185 mcb25 ammo', '1662382700', 1),
(3317, 'Earned 10 pld ammo', '1662382700', 1),
(3318, 'Earned 215 mcb50 ammo', '1662382700', 1),
(3319, 'Earned 185 mcb25 ammo', '1662382700', 1),
(3320, 'Earned 350 ucb ammo', '1662382700', 1),
(3321, 'Earned 210 mcb25 ammo', '1662382701', 1),
(3322, 'Earned 45 plt21 ammo', '1662382701', 1),
(3323, 'Earned 215 mcb50 ammo', '1662382701', 1),
(3324, 'Earned 275 mcb50 ammo', '1662382701', 1),
(3325, 'Earned 215 mcb50 ammo', '1662382701', 1),
(3326, 'Earned 325 ucb ammo', '1662382702', 1),
(3327, 'Earned 210 mcb25 ammo', '1662382702', 1),
(3328, 'Earned 275 mcb50 ammo', '1662382702', 1),
(3329, 'Earned 215 mcb50 ammo', '1662382702', 1),
(3330, 'Earned 210 mcb25 ammo', '1662382702', 1),
(3331, 'Earned 325 ucb ammo', '1662382703', 1),
(3332, 'Earned 45 plt21 ammo', '1662382703', 1),
(3333, 'Earned 1 parts of Kronos gate', '1662382703', 1),
(3334, 'Earned 175 mcb25 ammo', '1662382703', 1),
(3335, 'Earned 210 mcb25 ammo', '1662382703', 1),
(3336, 'Earned 10 pld ammo', '1662382704', 1),
(3337, 'Earned 350 ucb ammo', '1662382704', 1),
(3338, 'Earned 215 mcb50 ammo', '1662382704', 1),
(3339, 'Earned 185 mcb25 ammo', '1662382704', 1),
(3340, 'Earned 215 mcb50 ammo', '1662382704', 1),
(3341, 'Earned 350 ucb ammo', '1662382704', 1),
(3342, 'Earned 175 mcb25 ammo', '1662382705', 1),
(3343, 'Earned 10 pld ammo', '1662382705', 1),
(3344, 'Earned 185 mcb25 ammo', '1662382705', 1),
(3345, 'Earned 45 plt21 ammo', '1662382705', 1),
(3346, 'Earned 325 ucb ammo', '1662382705', 1),
(3347, 'Earned 215 mcb50 ammo', '1662382706', 1),
(3348, 'Earned 215 mcb50 ammo', '1662382706', 1),
(3349, 'Earned 325 ucb ammo', '1662382706', 1),
(3350, 'Earned 185 mcb25 ammo', '1662382706', 1),
(3351, 'Earned 45 plt21 ammo', '1662382706', 1),
(3352, 'Earned 35 plt3030 ammo', '1662382707', 1),
(3353, 'Earned 325 ucb ammo', '1662382707', 1),
(3354, 'Earned 175 mcb50 ammo', '1662382707', 1),
(3355, 'Earned 45 plt21 ammo', '1662382707', 1),
(3356, 'Earned 1 parts of Kronos gate', '1662382707', 1),
(3357, 'Earned 210 mcb25 ammo', '1662382708', 1),
(3358, 'Earned 210 mcb25 ammo', '1662382708', 1),
(3359, 'Earned 45 plt21 ammo', '1662382708', 1),
(3360, 'Earned 275 mcb50 ammo', '1662382708', 1),
(3361, 'Earned 210 mcb25 ammo', '1662382708', 1),
(3362, 'Earned 175 mcb25 ammo', '1662382708', 1),
(3363, 'Earned 215 mcb50 ammo', '1662382709', 1),
(3364, 'Earned 215 mcb50 ammo', '1662382709', 1),
(3365, 'Earned 35 plt3030 ammo', '1662382709', 1),
(3366, 'Earned 35 plt3030 ammo', '1662382713', 1),
(3367, 'Earned 1 parts of Kronos gate', '1662382713', 1),
(3368, 'Earned 275 mcb50 ammo', '1662382713', 1),
(3369, 'Earned 175 mcb50 ammo', '1662382713', 1),
(3370, 'Earned 275 mcb50 ammo', '1662382714', 1),
(3371, 'Earned 1 parts of Kronos gate', '1662382714', 1),
(3372, 'Earned 350 ucb ammo', '1662382714', 1),
(3373, 'Earned 10 pld ammo', '1662382714', 1),
(3374, 'Earned 210 mcb25 ammo', '1662382714', 1),
(3375, 'Earned 210 mcb25 ammo', '1662382715', 1),
(3376, 'Earned 350 ucb ammo', '1662382715', 1),
(3377, 'Earned 210 mcb25 ammo', '1662382715', 1),
(3378, 'Earned 45 plt21 ammo', '1662382715', 1),
(3379, 'Earned 210 mcb25 ammo', '1662382715', 1),
(3380, 'Earned 3 parts of Kronos gate', '1662382717', 1),
(3381, 'Earned 175 mcb25 ammo', '1662382717', 1),
(3382, 'Earned 215 mcb50 ammo', '1662382717', 1),
(3383, 'Earned 350 ucb ammo', '1662382717', 1),
(3384, 'Earned 325 ucb ammo', '1662382718', 1),
(3385, 'Earned 215 mcb50 ammo', '1662382718', 1),
(3386, 'Earned 3 parts of Kronos gate', '1662382718', 1),
(3387, 'Earned 350 ucb ammo', '1662382718', 1),
(3388, 'Earned 215 mcb50 ammo', '1662382718', 1),
(3389, 'Earned 215 mcb50 ammo', '1662382719', 1),
(3390, 'Earned 215 mcb50 ammo', '1662382719', 1),
(3391, 'Earned 175 mcb25 ammo', '1662382719', 1),
(3392, 'Earned 250 sab ammo', '1662382719', 1),
(3393, 'Earned 175 mcb25 ammo', '1662382719', 1),
(3394, 'Earned 10 pld ammo', '1662382720', 1),
(3395, 'Earned 210 mcb25 ammo', '1662382720', 1),
(3396, 'Earned 350 ucb ammo', '1662382720', 1),
(3397, 'Earned 350 ucb ammo', '1662382720', 1),
(3398, 'Earned 175 mcb25 ammo', '1662382720', 1),
(3399, 'Earned 350 ucb ammo', '1662382721', 1),
(3400, 'Earned 175 mcb25 ammo', '1662382721', 1),
(3401, 'Earned 185 mcb25 ammo', '1662382721', 1),
(3402, 'Earned 1 parts of Kronos gate', '1662382721', 1),
(3403, 'Earned 215 mcb50 ammo', '1662382721', 1),
(3404, 'Earned 45 plt21 ammo', '1662382721', 1),
(3405, 'Earned 215 mcb50 ammo', '1662382722', 1),
(3406, 'Earned 175 mcb50 ammo', '1662382722', 1),
(3407, 'Earned 45 plt21 ammo', '1662382722', 1),
(3408, 'Earned 210 mcb25 ammo', '1662382722', 1),
(3409, 'Earned 275 mcb50 ammo', '1662382722', 1),
(3410, 'Earned 175 mcb50 ammo', '1662382723', 1),
(3411, 'Earned 215 mcb50 ammo', '1662382723', 1),
(3412, 'Earned 275 mcb50 ammo', '1662382723', 1),
(3413, 'Earned 185 mcb25 ammo', '1662382723', 1),
(3414, 'Earned 1 parts of Kronos gate', '1662382723', 1),
(3415, 'Earned 325 ucb ammo', '1662382724', 1),
(3416, 'Earned 275 mcb50 ammo', '1662382724', 1),
(3417, 'Earned 250 sab ammo', '1662382724', 1),
(3418, 'Earned 175 mcb50 ammo', '1662382724', 1),
(3419, 'Earned 215 mcb50 ammo', '1662382724', 1),
(3420, 'Earned 210 mcb25 ammo', '1662382725', 1),
(3421, 'Earned 215 mcb50 ammo', '1662382725', 1),
(3422, 'Earned 215 mcb50 ammo', '1662382725', 1),
(3423, 'Earned 1 parts of Kronos gate', '1662382725', 1),
(3424, 'Earned 175 mcb25 ammo', '1662382725', 1),
(3425, 'Earned 1 parts of Kronos gate', '1662382725', 1),
(3426, 'Earned 210 mcb25 ammo', '1662382726', 1),
(3427, 'Earned 3 parts of Kronos gate', '1662382726', 1),
(3428, 'Earned 45 plt21 ammo', '1662382726', 1),
(3429, 'Earned 215 mcb50 ammo', '1662382726', 1),
(3430, 'Earned 45 plt21 ammo', '1662382726', 1),
(3431, 'Earned 1 parts of Kronos gate', '1662382727', 1),
(3432, 'Earned 3 parts of Kronos gate', '1662382727', 1),
(3433, 'Earned 215 mcb50 ammo', '1662382727', 1),
(3434, 'Earned 210 mcb25 ammo', '1662382727', 1),
(3435, 'Earned 175 mcb25 ammo', '1662382727', 1),
(3436, 'Earned 215 mcb50 ammo', '1662382728', 1),
(3437, 'Earned 1 parts of Kronos gate', '1662382728', 1),
(3438, 'Earned 3 parts of Kronos gate', '1662382728', 1),
(3439, 'Earned 250 sab ammo', '1662382728', 1),
(3440, 'Earned 35 plt3030 ammo', '1662382728', 1),
(3441, 'Earned 3 parts of Kronos gate', '1662382728', 1),
(3442, 'Earned 10 pld ammo', '1662382729', 1),
(3443, 'Earned 325 ucb ammo', '1662382729', 1),
(3444, 'Earned 250 sab ammo', '1662382729', 1),
(3445, 'Earned 210 mcb25 ammo', '1662382729', 1),
(3446, 'Earned 10 pld ammo', '1662382730', 1),
(3447, 'Earned 1 parts of Kronos gate', '1662382730', 1),
(3448, 'Earned 210 mcb25 ammo', '1662382730', 1),
(3449, 'Earned 10 pld ammo', '1662382730', 1),
(3450, 'Earned 45 plt21 ammo', '1662382730', 1),
(3451, 'Earned 250 sab ammo', '1662382731', 1),
(3452, 'Earned 350 ucb ammo', '1662382731', 1),
(3453, 'Earned 1 parts of Kronos gate', '1662382731', 1),
(3454, 'Earned 10 pld ammo', '1662382731', 1),
(3455, 'Earned 1 parts of Kronos gate', '1662382731', 1),
(3456, 'Earned 325 ucb ammo', '1662382732', 1),
(3457, 'Earned 175 mcb50 ammo', '1662382732', 1),
(3458, 'Earned 215 mcb50 ammo', '1662382732', 1),
(3459, 'Earned 1 parts of Kronos gate', '1662382732', 1),
(3460, 'Earned 45 plt21 ammo', '1662382732', 1),
(3461, 'Earned 1 parts of Kronos gate', '1662382732', 1),
(3462, 'Earned 10 pld ammo', '1662382733', 1),
(3463, 'Earned 275 mcb50 ammo', '1662382733', 1),
(3464, 'Earned 175 mcb50 ammo', '1662382733', 1),
(3465, 'Earned 1 parts of Kronos gate', '1662382733', 1),
(3466, 'Earned 250 sab ammo', '1662382733', 1),
(3467, 'Earned 45 plt21 ammo', '1662382734', 1),
(3468, 'Earned 325 ucb ammo', '1662382734', 1),
(3469, 'Earned 175 mcb25 ammo', '1662382734', 1),
(3470, 'Earned 185 mcb25 ammo', '1662382734', 1),
(3471, 'Earned 175 mcb25 ammo', '1662382734', 1),
(3472, 'Earned 175 mcb50 ammo', '1662382738', 1),
(3473, 'Earned 275 mcb50 ammo', '1662382738', 1),
(3474, 'Earned 35 plt3030 ammo', '1662382738', 1),
(3475, 'Earned 175 mcb25 ammo', '1662382738', 1),
(3476, 'Earned 175 mcb25 ammo', '1662382739', 1),
(3477, 'Earned 35 plt3030 ammo', '1662382739', 1),
(3478, 'Earned 1 parts of Kronos gate', '1662382739', 1),
(3479, 'Earned 175 mcb50 ammo', '1662382739', 1),
(3480, 'Earned 350 ucb ammo', '1662382739', 1),
(3481, 'Earned 250 sab ammo', '1662382740', 1),
(3482, 'Earned 185 mcb25 ammo', '1662382740', 1),
(3483, 'Earned 1 parts of Kronos gate', '1662382740', 1),
(3484, 'Earned 1 parts of Kronos gate', '1662382740', 1),
(3485, 'Earned 275 mcb50 ammo', '1662382740', 1),
(3486, 'Earned 1 parts of Kronos gate', '1662382741', 1),
(3487, 'Earned 175 mcb25 ammo', '1662382741', 1),
(3488, 'Earned 10 pld ammo', '1662382741', 1),
(3489, 'Earned 1 parts of Kronos gate', '1662382741', 1),
(3490, 'Earned 325 ucb ammo', '1662382741', 1),
(3491, 'Earned 275 mcb50 ammo', '1662382742', 1),
(3492, 'Earned 1 parts of Kronos gate. Sucesfully unlocked gate.', '1662382742', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `info_galaxygates`
--

CREATE TABLE `info_galaxygates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gateId` int(11) NOT NULL,
  `parts` varchar(255) NOT NULL,
  `cost` varchar(10) NOT NULL,
  `live_cost` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `info_galaxygates`
--

INSERT INTO `info_galaxygates` (`id`, `name`, `gateId`, `parts`, `cost`, `live_cost`) VALUES
(1, 'Alpha', 1, '34', '100', '10000'),
(2, 'Beta', 2, '48', '100', '10000'),
(3, 'Gamma', 3, '82', '100', '10000'),
(4, 'Delta', 4, '128', '100', '10000'),
(5, 'Kappa', 7, '120', '200', '10000'),
(6, 'Kronos', 9, '120', '200', '10000'),
(7, 'Lambda', 8, '45', '200', '10000');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `itemsupgradesystem`
--

CREATE TABLE `itemsupgradesystem` (
  `id` int(11) NOT NULL,
  `catId` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `multiplier` varchar(255) DEFAULT '100000',
  `checkLaser` varchar(255) DEFAULT '',
  `percentData` longtext DEFAULT NULL,
  `active` varchar(255) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `itemsupgradesystem`
--

INSERT INTO `itemsupgradesystem` (`id`, `catId`, `name`, `image`, `multiplier`, `checkLaser`, `percentData`, `active`) VALUES
(1, '1', 'LF-1', '/do_img/global/items/equipment/weapon/laser/lf-1_100x100.png', '50', 'lf1', NULL, '1'),
(2, '1', 'LF-2', '/do_img/global/items/equipment/weapon/laser/lf-2_100x100.png', '100', 'lf2', NULL, '1'),
(3, '1', 'LF-3', '/do_img/global/items/equipment/weapon/laser/lf-3_100x100.png', '620', 'lf3', NULL, '1'),
(4, '1', 'LF-4', '/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png', '880', 'lf4', NULL, '1'),
(5, '1', 'Prometeus', '/do_img/global/items/equipment/weapon/laser/pr-l_100x100.png', '1250', 'lf5', NULL, '1'),
(6, '2', 'SG3N-A01', '/do_img/global/items/equipment/generator/shield/sg3n-a01_100x100.png', '100', 'A01', NULL, '1'),
(7, '2', 'SG3N-A02', '/do_img/global/items/equipment/generator/shield/sg3n-a02_100x100.png', '200', 'A02', NULL, '1'),
(8, '2', 'SG3N-A03', '/do_img/global/items/equipment/generator/shield/sg3n-a03_100x100.png', '300', 'A03', NULL, '1'),
(9, '2', 'SG3N-B01', '/do_img/global/items/equipment/generator/shield/sg3n-b01_100x100.png', '500', 'B01', NULL, '1'),
(10, '2', 'SG3N-B02', '/do_img/global/items/equipment/generator/shield/sg3n-b02_100x100.png', '800', 'bo2', NULL, '1'),
(11, '2', 'SG3N-B03', '/do_img/global/items/equipment/generator/shield/sg3n-b03_100x100.png', '1250', 'bo3', NULL, '1'),
(12, '3', 'Drone Level', '/img/drone.png', '500000', '', NULL, '1'),
(13, '1', 'LF-3-Neutron', '/do_img/global/items/equipment/weapon/laser/lf-3-n_100x100.png', '750', 'lf3n', NULL, '1'),
(14, '1', 'LF-4 Magmadrill', '/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png', '900', 'lf4md', NULL, '1'),
(15, '1', 'LF-4 Paritydrill', '/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png', '900', 'lf4pd', NULL, '1'),
(16, '1', 'LF-4 Hyperplasmoid\n', '/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png', '900', 'lf4hp', NULL, '1'),
(17, '1', 'LF-4-SP\r\n', '/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png', '900', 'lf4sp', NULL, '1'),
(18, '1', 'Unstable LF-4\r\n', '/do_img/global/items/equipment/weapon/laser/lf-4-unstable_100x100.png', '850', 'lf4unstable', NULL, '1'),
(19, '1', 'MP-1\r\n', '/do_img/global/items/equipment/weapon/laser/mp-1_100x100.png', '80', 'mp1', NULL, '1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log_event_jpb`
--

CREATE TABLE `log_event_jpb` (
  `id` int(11) NOT NULL,
  `players` text COLLATE utf8_bin NOT NULL,
  `finalists` text COLLATE utf8_bin NOT NULL,
  `winner_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log_event_uba`
--

CREATE TABLE `log_event_uba` (
  `id` int(11) NOT NULL,
  `players` text COLLATE utf8_bin NOT NULL,
  `finalists` text COLLATE utf8_bin NOT NULL,
  `winner_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `top` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log_player_kills`
--

CREATE TABLE `log_player_kills` (
  `id` int(11) NOT NULL,
  `killer_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `pushing` tinyint(1) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `manage_events`
--

CREATE TABLE `manage_events` (
  `id` int(11) NOT NULL,
  `event` varchar(255) DEFAULT NULL,
  `commandEvent` varchar(255) DEFAULT NULL,
  `canStop` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `manage_events`
--

INSERT INTO `manage_events` (`id`, `event`, `commandEvent`, `canStop`) VALUES
(1, 'Spaceball', '/start-spaceball', '1'),
(2, 'B.royal', '/start_royal', '0'),
(3, 'Company', '/start_company', '0'),
(4, 'Invasion', '/start-invasion', '0'),
(5, 'Team', '/start-team', '0'),
(6, 'Demaner', '/start_demaner', '0'),
(7, 'Meteorit', '/start_meteorit', '0'),
(8, 'Emperator', '/start_emperator', '0'),
(9, 'Jackpot', '/start-jpb', '0'),
(10, 'Hitac', '/start-hitac', '0'),
(11, 'Kristallon', '/start_kristallon', '0');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `newsclantablelog`
--

CREATE TABLE `newsclantablelog` (
  `id` int(11) NOT NULL,
  `date` text NOT NULL,
  `texto` longtext NOT NULL,
  `leaderId` varchar(999) NOT NULL,
  `clanId` int(11) NOT NULL,
  `type` enum('new','logbank','joinmember','logusers','settings','systembank') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `player_accounts`
--

CREATE TABLE `player_accounts` (
  `userId` int(20) NOT NULL,
  `sessionId` varchar(32) COLLATE utf8_bin NOT NULL,
  `data` text COLLATE utf8_bin NOT NULL DEFAULT '{"uridium":100000,"credits":500000,"honor":0,"experience":0,"jackpot":0}',
  `bootyKeys` text COLLATE utf8_bin NOT NULL DEFAULT '{"greenKeys":0,"redKeys":0,"blueKeys":0,"silverKeys":0,"goldKeys":0,"demanerKeys":0}',
  `info` text COLLATE utf8_bin NOT NULL,
  `destructions` text COLLATE utf8_bin NOT NULL DEFAULT '{"fpd":0,"dbrz":0}',
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `pilotName` varchar(20) COLLATE utf8_bin NOT NULL,
  `petName` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'Your PET',
  `petDesign` int(20) NOT NULL DEFAULT 22,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(260) COLLATE utf8_bin NOT NULL,
  `shipId` int(11) NOT NULL DEFAULT 1,
  `premium` tinyint(1) NOT NULL DEFAULT 0,
  `title` varchar(128) COLLATE utf8_bin NOT NULL DEFAULT '',
  `factionId` int(1) NOT NULL DEFAULT 0,
  `clanId` int(11) NOT NULL DEFAULT 0,
  `rankId` int(2) NOT NULL DEFAULT 1,
  `rankPoints` bigint(20) NOT NULL DEFAULT 0,
  `rank` int(11) NOT NULL DEFAULT 0,
  `warPoints` int(20) NOT NULL DEFAULT 0,
  `warBattel` int(11) DEFAULT 0,
  `warRank` int(11) NOT NULL DEFAULT 0,
  `extraEnergy` int(11) NOT NULL,
  `nanohull` int(11) NOT NULL,
  `verification` text COLLATE utf8_bin NOT NULL,
  `oldPilotNames` text COLLATE utf8_bin NOT NULL DEFAULT '[]',
  `version` tinyint(4) NOT NULL DEFAULT 0,
  `droneExp` longtext COLLATE utf8_bin NOT NULL DEFAULT '0',
  `position` text COLLATE utf8_bin NOT NULL DEFAULT '{"mapID":0,"x":0,"y":0}',
  `profile` text COLLATE utf8_bin DEFAULT 'public/img/avatars/default.png',
  `ammo` text COLLATE utf8_bin DEFAULT '{"mcb25":3000,"lcb10":10000,"acm":1,"mcb50":2000,"mcb100":0,"im01":1,"mcb250":0,"mcb500":0,"hstrm01":5,"ucb":1000,"ucb200":0,"rsb":200,"rsb300":0,"job100":0,"rb214":0,"cbo100":0,"sab":3000,"pib":0,"ish":1,"emp":1,"smb":1,"plt3030":30,"plt5050":0,"plt8080":0,"ice":1,"dcr":1,"wiz":1,"pld":1,"slm":1,"ddm":1,"empm":1,"sabm":1,"cloacks":1,"r310":200,"plt26":100,"plt21":30,"pib":0,"ubr100":0,"sar02":0,"sar01":0,"eco10":0}',
  `petSavedDesigns` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  `nextLevel` smallint(6) DEFAULT NULL,
  `activateKey` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `cargo` text COLLATE utf8_bin NOT NULL,
  `skylab` text COLLATE utf8_bin NOT NULL,
  `mapID` int(11) NOT NULL DEFAULT 1,
  `posX` int(11) NOT NULL DEFAULT 2000,
  `posY` int(11) NOT NULL DEFAULT 2000,
  `kills` int(11) NOT NULL DEFAULT 0,
  `petExp` longtext COLLATE utf8_bin DEFAULT '0',
  `peteExp` longtext COLLATE utf8_bin NOT NULL DEFAULT '0',
  `MaxEGWave` int(11) DEFAULT 0,
  `EGWave` int(11) DEFAULT 0,
  `EGKeys` int(11) DEFAULT 0,
  `EgLifes` int(11) DEFAULT 0,
  `ubaPoints` int(11) DEFAULT 0,
  `EGMult` int(11) DEFAULT 0,
  `balance` decimal(20,6) DEFAULT 100.000000,
  `rid` varchar(50) COLLATE utf8_bin NOT NULL,
  `ip_address` varchar(50) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_request` datetime DEFAULT NULL,
  `slots_lifetime_winnings` decimal(20,6) NOT NULL,
  `slots_spins` int(11) NOT NULL,
  `killedNpc` text COLLATE utf8_bin NOT NULL DEFAULT '{"ship85":0,"ship23":0,"ship34":0,"ship36":0,"ship44":0,"ship71":0,"ship24":0,"ship37":0,"ship75":0,"ship25":0,"ship38":0,"ship73":0,"ship31":0,"ship43":0,"ship72":0,"ship26":0,"ship39":0,"ship74":0,"ship46":0,"ship47":0,"ship76":0,"ship27":0,"ship40":0,"ship77":0,"ship28":0,"ship41":0,"ship78":0,"ship29":0,"ship42":0,"ship79":0,"ship35":0,"ship45":0,"ship80":0,"ship81":0,"ship107":0,"ship105":0,"ship99":0,"ship118":0,"ship116":0,"ship103":0,"ship84":0,"ship33":0,"ship83":0,"ship11":0,"ship126":0,"ship127":0,"ship122":0,"ship124":0,"ship119":0,"ship123":0,"ship82":0,"ship97":0,"ship96":0,"ship95":0,"ship90":0,"ship91":0,"ship92":0,"ship93":0,"ship94":0,"ship21":0,"ship32":0,"ship114":0,"ship111":0,"ship113":0,"ship112":0,"ship115":0,"ship216":0,"ship215":0,"ship214":0,"ship213":0}',
  `Npckill` text COLLATE utf8_bin NOT NULL DEFAULT '{"ship85":0,"ship23":0,"ship34":0,"ship36":0,"ship44":0,"ship71":0,"ship24":0,"ship37":0,"ship75":0,"ship25":0,"ship38":0,"ship73":0,"ship31":0,"ship43":0,"ship72":0,"ship26":0,"ship39":0,"ship74":0,"ship46":0,"ship47":0,"ship76":0,"ship27":0,"ship40":0,"ship77":0,"ship28":0,"ship41":0,"ship78":0,"ship29":0,"ship42":0,"ship79":0,"ship35":0,"ship45":0,"ship80":0,"ship81":0,"ship107":0,"ship105":0,"ship99":0,"ship118":0,"ship116":0,"ship103":0,"ship84":0,"ship33":0,"ship83":0,"ship11":0,"ship126":0,"ship127":0,"ship122":0,"ship124":0,"ship119":0,"ship123":0,"ship82":0,"ship97":0,"ship96":0,"ship95":0,"ship90":0,"ship91":0,"ship92":0,"ship93":0,"ship94":0,"ship21":0,"ship32":0,"ship114":0,"ship111":0,"ship113":0,"ship112":0,"ship115":0,"ship216":0,"ship215":0,"ship214":0,"ship213":0}'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- A tábla adatainak kiíratása `player_accounts`
--

INSERT INTO `player_accounts` (`userId`, `sessionId`, `data`, `bootyKeys`, `info`, `destructions`, `username`, `pilotName`, `petName`, `petDesign`, `password`, `email`, `shipId`, `premium`, `title`, `factionId`, `clanId`, `rankId`, `rankPoints`, `rank`, `warPoints`, `warBattel`, `warRank`, `extraEnergy`, `nanohull`, `verification`, `oldPilotNames`, `version`, `droneExp`, `position`, `profile`, `ammo`, `petSavedDesigns`, `level`, `nextLevel`, `activateKey`, `cargo`, `skylab`, `mapID`, `posX`, `posY`, `kills`, `petExp`, `peteExp`, `MaxEGWave`, `EGWave`, `EGKeys`, `EgLifes`, `ubaPoints`, `EGMult`, `balance`, `rid`, `ip_address`, `created`, `user_agent`, `last_request`, `slots_lifetime_winnings`, `slots_spins`, `killedNpc`, `Npckill`) VALUES
(1, 'eD0cn1KmwOHhx0JIDTolEZ4E0VhLVfir', '{\"uridium\":101936771,\"credits\":74787265,\"honor\":330495,\"experience\":19540461,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":7,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"blueKeys\":16,\"demanerKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"15.07.2022 17:38:15\"}', '{\"fpd\":0,\"dbrz\":0}', 'Admin', 'Admin', 'majom', 22, '$2y$10$o0XtXImg1S7R8hPdp3HgN.HLKeM2tzgbN6gAZY6OtORm1srUbOR8a', 'terheh@tzest.com', 7, 0, 'title_battle_royal_winner', 2, 1, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"tVoUnGRbMeYbTpikGKVMpbthq19NnpVD\"}', '[]', 1, '598', '{\"mapID\":76,\"x\":13329,\"y\":6556,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":37838,\"lcb10\":14207,\"mcb50\":38349,\"mcb100\":0,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0,\"ubr100\":915,\"ucb\":219671,\"rsb\":200,\"sab\":10000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":730,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":201,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":78,\"r310\":200,\"plt26\":1650,\"cbo100\":0,\"job100\":0,\"rb214\":0,\"plt21\":3045}', NULL, 12, 13, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":76,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":12,\"ship24\":5,\"ship37\":0,\"ship75\":9,\"ship25\":9,\"ship38\":0,\"ship73\":1,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":2,\"ship46\":1,\"ship47\":0,\"ship76\":0,\"ship27\":2,\"ship40\":0,\"ship77\":1,\"ship28\":0,\"ship41\":0,\"ship78\":12,\"ship29\":0,\"ship42\":0,\"ship79\":3,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":101,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":1,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":5,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":144,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(2, 'onqeKFIULkNXiXPZsWcQMj5l9UAtA0WY', '{\"uridium\":2270086546,\"credits\":2347839,\"honor\":3851,\"experience\":106186,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":68,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"blueKeys\":1}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"16.07.2022 12:41:32\"}', '{\"fpd\":0,\"dbrz\":0}', 'Claire', 'Claire', 'Your PET', 22, '$2y$10$4NKwnoCldgzuDbsO8sirIu3HBep7wtbF6BGAhntHltygJ/xHLZZQu', 'asdasd@asd.asd', 7, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"LDPNsaW0rABkXe4aNvJkQ4wD0JcDgwdw\"}', '[]', 0, '27', '{\"mapID\":5,\"x\":10353,\"y\":2093,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 5, 6, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":4,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":6,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":6,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(3, 'Etea0ppAQts9Dl13LhZUUnMCeC8yG3Nb', '{\"uridium\":835517661,\"credits\":1487933,\"honor\":74168,\"experience\":1737654,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"18.07.2022 19:57:07\"}', '{\"fpd\":0,\"dbrz\":0}', 'Admin2', 'Admin2', 'Your PET', 22, '$2y$10$0bUGXB8EPhoduIzU878.EO0AKkML4LlisstxdmVgvmyfVjRtBA.wm', 'tregbee@test.com', 10, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"qJNQuYcfqPM9awz6poljUTnL5iGGWGK9\"}', '[]', 0, '186', '{\"mapID\":5,\"x\":11923,\"y\":5908,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 9, 10, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":27,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":4,\"ship24\":1,\"ship37\":0,\"ship75\":5,\"ship25\":5,\"ship38\":0,\"ship73\":2,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":28,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":1,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":28,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(4, 'TgxotuYAaP14we3OyAd25qTNKY3tqpNG', '{\"uridium\":4760989,\"credits\":2558771,\"honor\":49915,\"experience\":1182431,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":938,\"redKeys\":49,\"silverKeys\":927,\"goldKeys\":0,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"21.07.2022 16:16:59\"}', '{\"fpd\":0,\"dbrz\":0}', 'tester1', 'tester1', 'Your PET', 22, '$2y$10$auDWle5Vywzd/kUHKkJFEOVww3NzsKgeJPjlHLh3iGALb8xof8MXu', 'trhj@test.com', 245, 0, 'title_hercules', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"UfvNfozApsbfPKdOfeevIZ1L6adfDmuR\"}', '[]', 0, '71', '{\"mapID\":5,\"x\":12607,\"y\":6039,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 8, 9, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":3,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":197,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":12,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(5, 'iT6MOiukCb617LOYuSab741lJnmCajso', '{\"uridium\":87618,\"credits\":502156,\"honor\":0,\"experience\":0,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":2,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"22.07.2022 19:10:30\"}', '{\"fpd\":0,\"dbrz\":0}', 'mukso', 'mukso', 'Your PET', 22, '$2y$10$VJSWyeEssGvtoBzJQIt43Opn5m8HTcmtyqUl2kxT9xE2QS5MY.SFS', 'trrguz@test.com', 1, 0, 'title_leon', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"ddRMqRJ5C9IiLMGt0FaIjV8XtgDIRu4V\"}', '[]', 0, '0', '{\"mapID\":5,\"x\":3598,\"y\":9154,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 1, 2, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(6, 'tXiAGofvVnoGtkGrx5awSMckRzOiCW9E', '{\"uridium\":100505662,\"credits\":500000,\"honor\":0,\"experience\":0,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":90,\"redKeys\":0,\"silverKeys\":85,\"goldKeys\":0,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"24.07.2022 14:10:09\"}', '{\"fpd\":0,\"dbrz\":0}', 'tester100', 'tester100', 'Your PET', 22, '$2y$10$7YtYcy6v6kfZY95hxtbqRO7/NX50fvNStpdSpC5Kz9IEaLH6beR2W', 'terwet@test.com', 245, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"tXiAGofvVnoGtkGrx5awSMckRzOiCW9E\"}', '[]', 0, '0', '{\"mapID\":5,\"x\":12914,\"y\":4464,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 1, 2, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(7, 'gCPR23Lt5cQsErn1zWjwSGvMAfqydcew', '{\"uridium\":112876,\"credits\":810400,\"honor\":5752,\"experience\":250400,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"25.07.2022 23:30:28\"}', '{\"fpd\":0,\"dbrz\":0}', 'tester1000', 'tester1000', 'Your PET', 22, '$2y$10$Ez2NGpipH9TbmLxTsev5w./Pn0sJiiqz67Jj4ktO/T.HtZSwdvdBm', '6zrtfdh@test.com', 7, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"9tSaNdETxLSIN0uB6RFTCbNcYIG0k2ql\"}', '[]', 0, '85', '{\"mapID\":5,\"x\":11746,\"y\":6338,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 6, 7, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":3,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":101,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":114,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(8, 'xL09eogIpcdwffW0e9nf3gaYjzifNeSB', '{\"uridium\":558254,\"credits\":6704202,\"honor\":29829,\"experience\":4848800,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"silverKeys\":56,\"goldKeys\":66,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"27.07.2022 15:47:24\"}', '{\"fpd\":0,\"dbrz\":0}', 'teresert1', 'teresert1', 'Your PET', 22, '$2y$10$mlEBH9aIPZG8emp1I44HPeaWXgAPX7HqwlOVUsXTbIVB909.Kry0G', 'hfuhfgu@twst.com', 353, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"xL09eogIpcdwffW0e9nf3gaYjzifNeSB\"}', '[]', 0, '2', '{\"mapID\":55,\"x\":11800,\"y\":7112,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 10, 11, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":1,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(9, 'l2QrMKxfWS6CBX5x2olh5Elfg6vUYgOc', '{\"uridium\":100000,\"credits\":500000,\"honor\":0,\"experience\":0,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"29.07.2022 10:47:09\"}', '{\"fpd\":0,\"dbrz\":0}', 'teresert10', 'teresert10', 'Your PET', 22, '$2y$10$ipAZTRnmjSUsyHe937Y3EegjGMU19i0FDreC.ui4bAGWP/PReJ/Qy', 'zrjhj@test.com', 10, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"oLpwbfMWLcLLTjoBInxJYSova9U8wh9F\"}', '[]', 0, '0', '{\"mapID\":5,\"x\":18887,\"y\":2230,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 1, 2, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(10, 'vWyervaI6SeHabNLMmC54LxN88ABz1Rw', '{\"uridium\":97365226,\"credits\":6341600,\"honor\":2015085,\"experience\":82905184,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":5,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"29.07.2022 12:18:19\"}', '{\"fpd\":0,\"dbrz\":0}', 'Adminka', 'Adminka', 'Your PET', 22, '$2y$10$EcogZbSbZ7E2CfKA9zYMTOWiKvDOzA./E2fc.nrU8IuUoCXWc96hG', 'zrtukj@terst.cvom', 346, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"J0UhWrDg2n3bMAPgy8iL1LegpDAdkKon\"}', '[]', 0, '43', '{\"mapID\":5,\"x\":18900,\"y\":2000,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 15, 16, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":4,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":12,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":12,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(11, 'vqraRohbokgJo5c74oSge0mW2uOL1UfM', '{\"uridium\":539188,\"credits\":57015859,\"honor\":140032,\"experience\":10724800,\"jackpot\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"08.08.2022 14:51:11\"}', '{\"fpd\":0,\"dbrz\":0}', 'tester333', 'tester333', 'Your PET', 22, '$2y$10$9ROXpRU8eKZkhLNtRwP.JeZHgRyFSQDXkPKNFw5O4nEfabxK1DwqG', 'trezh@test.com', 10, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"LOlGpt5kEaNulQOl9iU6AhQAkyrXe6Dc\"}', '[]', 0, '0', '{\"mapID\":24,\"x\":9393,\"y\":1929,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 12, 13, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '95.000000', '', '', NULL, '', NULL, '0.000000', 5, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(12, 'PdVUOg05Q6yZQky1bno9Gn7GRNfZoC0k', '{\"uridium\":90850008,\"credits\":510370,\"honor\":983,\"experience\":7726,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":1,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"10.08.2022 21:38:04\"}', '{\"fpd\":0,\"dbrz\":0}', 'tester3333', 'tester3333', 'Your PET', 22, '$2y$10$s7UaR6EcDqQZT8ubcfwf1eRyUs432Me6nanxRpqF9EAgGVVTph3zK', 'trghjhk@test.com', 10, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"roLzdiKLsdodUDgmBfHIShBT5MmlArdm\"}', '[]', 0, '2', '{\"mapID\":5,\"x\":13698,\"y\":1929,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 1, 2, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":1,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":1,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(13, 'ze36tShIVE3I9HG0qk1Zs1CHM7aS6k0s', '{\"uridium\":7470704,\"credits\":83828000,\"honor\":16105920,\"experience\":615334400,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"11.08.2022 14:50:51\"}', '{\"fpd\":0,\"dbrz\":0}', 'gyula', 'gyula', 'Your PET', 22, '$2y$10$GWPngG4KI8hhsmKvwKcRb.f0KIQQsreN8klK/rHEIxqjbA/38xJ6i', 'hfzr6@test.com', 10, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"0BNSL33PtlsgKwnxRphUNxlA7K5iAqaT\"}', '[]', 0, '0', '{\"mapID\":53,\"x\":10500,\"y\":6500,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 17, 18, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(14, 'Jh015wAc6JVcscGs6vs573LtE1W8nmJt', '{\"uridium\":13300000,\"credits\":34944793,\"honor\":2066723,\"experience\":89707144,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":10,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":7,\"blueKeys\":6}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"13.08.2022 15:24:00\"}', '{\"fpd\":0,\"dbrz\":0}', 'manoka79', 'manoka79', 'haha11', 203, '$2y$10$2MwNtAgo7I8hfqhr/1/K9.SabkeD9UZlBQiFDsj2bVWyKEous.byS', 'terdt@test.com', 245, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"eQCwqV1syt5vsH6zSrcOhBMai5FkRRNA\"}', '[]', 0, '97', '{\"mapID\":5,\"x\":18900,\"y\":2000,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', '[\"22\",\"203\",\"197\"]', 15, 16, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":19,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":22,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":22,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(15, 'Lz9tLJG9W6rwuZl7B2SKF8HwRj9EB5ly', '{\"uridium\":100000,\"credits\":500000,\"honor\":0,\"experience\":0,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"blueKeys\":0,\"blackKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"19.08.2022 16:16:04\"}', '{\"fpd\":0,\"dbrz\":0}', 'Admin3', 'Admin3', 'Your PET', 22, '$2y$10$bY6azjKYESSfdr8vDjMYpugfnWDdRcbWr6tVD.MdmxE7uZ1iiAhFK', 'teretzr@test2.com', 1, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"f9Swh3ZFrMahs0tjzAO7iWRqSDA3dFgW\"}', '[]', 1, '0', '{\"mapID\":5,\"x\":10848,\"y\":5762,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 1, 2, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}');
INSERT INTO `player_accounts` (`userId`, `sessionId`, `data`, `bootyKeys`, `info`, `destructions`, `username`, `pilotName`, `petName`, `petDesign`, `password`, `email`, `shipId`, `premium`, `title`, `factionId`, `clanId`, `rankId`, `rankPoints`, `rank`, `warPoints`, `warBattel`, `warRank`, `extraEnergy`, `nanohull`, `verification`, `oldPilotNames`, `version`, `droneExp`, `position`, `profile`, `ammo`, `petSavedDesigns`, `level`, `nextLevel`, `activateKey`, `cargo`, `skylab`, `mapID`, `posX`, `posY`, `kills`, `petExp`, `peteExp`, `MaxEGWave`, `EGWave`, `EGKeys`, `EgLifes`, `ubaPoints`, `EGMult`, `balance`, `rid`, `ip_address`, `created`, `user_agent`, `last_request`, `slots_lifetime_winnings`, `slots_spins`, `killedNpc`, `Npckill`) VALUES
(16, 'WfSFoziVoDX1k4CmPMLuXTjqB69L7WkS', '{\"uridium\":100187,\"credits\":500000,\"honor\":0,\"experience\":0,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"apocalypseKeys\":0,\"blueKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"19.08.2022 16:42:55\"}', '{\"fpd\":0,\"dbrz\":0}', 'tewst1', 'tewst1', 'Your PET', 22, '$2y$10$adiCppLIhCxY7s/oJ04sqea7ExQM4hAw3elGmKaAIGsCNSvEtRV5i', 'teret@retd.com', 1, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"WfSFoziVoDX1k4CmPMLuXTjqB69L7WkS\"}', '[]', 0, '0', '{\"mapID\":5,\"x\":15041,\"y\":5112,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 1, 2, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(17, 'reh5QdIMxAiLiadIegLCtVvSjBgFoFgO', '{\"uridium\":244984,\"credits\":6002667,\"honor\":18978,\"experience\":107643,\"jackpot\":0,\"ec\":0}', '{\"greenKeys\":7,\"redKeys\":10,\"silverKeys\":0,\"goldKeys\":0,\"blueKeys\":0,\"demanerKeys\":7}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"20.08.2022 11:23:46\"}', '{\"fpd\":0,\"dbrz\":0}', 'Admin4', 'Admin4', 'Your PET', 22, '$2y$10$EfHmjcmH46JG6zmxvRSdi.UI.e2eTIupwqRGfb8M3u1zCvkaB2.ZO', 'tretght@test.com', 49, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"bXNk4sPPnDOFsrzWKZjCzPt89wirRLP1\"}', '[]', 0, '0', '{\"mapID\":5,\"x\":1816,\"y\":2741,\"isInMapPremium\":false}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, 5, 6, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(18, 'qnI8ka3Z2YcGbDnk94FkGmh9AbJdKuZL', '{\"uridium\":100000,\"credits\":500000,\"honor\":0,\"experience\":0,\"jackpot\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"blueKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"demanerKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"03.09.2022 14:03:37\"}', '{\"fpd\":0,\"dbrz\":0}', 'muksi', 'muksi', 'Your PET', 22, '$2y$10$tNYIGCYCL9deVLwSqbYe3epCxZ0NxN7wc8Smx5fAgSGzijLFxIDWe', 'gfdjhj@test.com', 1, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"qnI8ka3Z2YcGbDnk94FkGmh9AbJdKuZL\"}', '[]', 0, '0', '{\"mapID\":5,\"x\":18900,\"y\":2000}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, NULL, NULL, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}'),
(19, 'p8KXxPYaKqnlOkHR7ZAAkr0Nbsf28kFw', '{\"uridium\":100000,\"credits\":500000,\"honor\":0,\"experience\":0,\"jackpot\":0}', '{\"greenKeys\":0,\"redKeys\":0,\"blueKeys\":0,\"silverKeys\":0,\"goldKeys\":0,\"demanerKeys\":0}', '{\"lastIP\":\"127.0.0.1\",\"registerIP\":\"127.0.0.1\",\"registerDate\":\"03.09.2022 14:13:02\"}', '{\"fpd\":0,\"dbrz\":0}', 'muksika', 'muksika', 'Your PET', 22, '$2y$10$c//m.tzYOJ4lZi.6CPfJfO.R7T4ByYgYeOGBZSnSCFU.9eILifVzW', 'trerg@test.com', 1, 0, '', 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"verified\":true,\"hash\":\"p8KXxPYaKqnlOkHR7ZAAkr0Nbsf28kFw\"}', '[]', 0, '0', '{\"mapID\":5,\"x\":18900,\"y\":2000}', 'public/img/avatars/default.png', '{\"mcb25\":3000,\"lcb10\":10000,\"acm\":1,\"mcb50\":2000,\"mcb100\":0,\"im01\":1,\"mcb250\":0,\"mcb500\":0,\"hstrm01\":5,\"ucb\":1000,\"ucb200\":0,\"rsb\":200,\"rsb300\":0,\"job100\":0,\"rb214\":0,\"cbo100\":0,\"sab\":3000,\"pib\":0,\"ish\":1,\"emp\":1,\"smb\":1,\"plt3030\":30,\"plt5050\":0,\"plt8080\":0,\"ice\":1,\"dcr\":1,\"wiz\":1,\"pld\":1,\"slm\":1,\"ddm\":1,\"empm\":1,\"sabm\":1,\"cloacks\":1,\"r310\":200,\"plt26\":100,\"plt21\":30,\"pib\":0,\"ubr100\":0,\"sar02\":0,\"sar01\":0,\"eco10\":0}', NULL, NULL, NULL, NULL, '', '', 1, 2000, 2000, 0, '0', '0', 0, 0, 0, 0, 0, 0, '100.000000', '', '', NULL, '', NULL, '0.000000', 0, '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}', '{\"ship85\":0,\"ship23\":0,\"ship34\":0,\"ship36\":0,\"ship44\":0,\"ship71\":0,\"ship24\":0,\"ship37\":0,\"ship75\":0,\"ship25\":0,\"ship38\":0,\"ship73\":0,\"ship31\":0,\"ship43\":0,\"ship72\":0,\"ship26\":0,\"ship39\":0,\"ship74\":0,\"ship46\":0,\"ship47\":0,\"ship76\":0,\"ship27\":0,\"ship40\":0,\"ship77\":0,\"ship28\":0,\"ship41\":0,\"ship78\":0,\"ship29\":0,\"ship42\":0,\"ship79\":0,\"ship35\":0,\"ship45\":0,\"ship80\":0,\"ship81\":0,\"ship107\":0,\"ship105\":0,\"ship99\":0,\"ship118\":0,\"ship116\":0,\"ship103\":0,\"ship84\":0,\"ship33\":0,\"ship83\":0,\"ship11\":0,\"ship126\":0,\"ship127\":0,\"ship122\":0,\"ship124\":0,\"ship119\":0,\"ship123\":0,\"ship82\":0,\"ship97\":0,\"ship96\":0,\"ship95\":0,\"ship90\":0,\"ship91\":0,\"ship92\":0,\"ship93\":0,\"ship94\":0,\"ship21\":0,\"ship32\":0,\"ship114\":0,\"ship111\":0,\"ship113\":0,\"ship112\":0,\"ship115\":0,\"ship216\":0,\"ship215\":0,\"ship214\":0,\"ship213\":0}');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `player_designs`
--

CREATE TABLE `player_designs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `baseShipId` int(11) NOT NULL,
  `userId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- A tábla adatainak kiíratása `player_designs`
--

INSERT INTO `player_designs` (`id`, `name`, `baseShipId`, `userId`) VALUES
(1, 'ship_goliath_design_spectrum', 10, 2),
(2, 'ship_goliath_design_venom', 10, 2),
(3, 'ship_goliath_design_solace', 10, 2),
(4, 'ship_goliath_design_sentinel', 10, 2),
(5, 'ship_goliath_design_spectrum', 10, 4),
(6, 'ship_goliath_design_solace', 10, 4),
(7, 'ship_goliath_design_venom', 10, 4),
(8, 'ship_solace_design_solace-ullrin', 10, 4),
(9, 'ship_goliath_design_diminisher', 10, 4),
(10, 'ship_goliath_design_sentinel', 10, 4),
(11, 'ship_cyborg_design_cyborg-frozen', 245, 4),
(12, 'ship_goliath_design_sentinel', 10, 6),
(13, 'ship_goliath_design_spectrum', 10, 6),
(14, 'ship_solace_design_solace-ullrin', 10, 6),
(15, 'ship_goliath_design_spectrum', 10, 8),
(16, 'ship_goliath_design_diminisher', 10, 8),
(17, 'ship_sentinel_design_sentinel-argon', 10, 8),
(18, 'ship_cyborg_design_cyborg-frozen', 245, 8),
(19, 'ship_solace_design_solace-ullrin', 10, 8),
(20, 'ship_goliath_design_sentinel', 10, 8),
(21, 'ship_goliath_design_solace', 10, 8),
(22, 'ship_sentinel_design_sentinel-asimov', 10, 8),
(23, 'ship_sentinel_design_sentinel-legend', 10, 8),
(24, 'ship_venom_design_venom-ocean', 10, 8),
(25, 'ship_diminisher_design_diminisher-legend', 10, 8),
(26, 'ship_sentinel_design_sentinel-epion', 10, 8),
(27, 'ship_venom_design_venom-poison', 10, 8),
(28, 'ship_diminisher_design_diminisher-frost', 10, 8),
(29, 'ship_g-surgeon_design_g-surgeon-cicada', 156, 8),
(30, 'ship_diminisher_design_diminisher-frost', 10, 10),
(31, 'ship_sentinel_design_sentinel-lava', 10, 10),
(32, 'ship_goliath_design_spectrum', 10, 1),
(33, 'ship_goliath_design_spectrum', 246, 1),
(34, 'ship_goliath_design_spectrum', 246, 1),
(35, 'ship_hammerclaw-lava borrar', 1018, 1),
(36, 'ship_aegis_design_aegis-superelite', 158, 1),
(37, 'ship_goliath_design_kick', 10, 1),
(38, 'ship_cyborg_design_cyborg-firestar', 245, 14),
(39, 'ship_cyborg_design_cyborg-ullrin', 245, 14),
(40, 'ship_cyborg_design_cyborg-carbonite', 245, 14),
(41, 'ship_cyborg_design_cyborg-ocean', 245, 14),
(42, 'ship_cyborg_design_cyborg-poison', 245, 17),
(43, 'ship_cyborg_design_cyborg-maelstrom', 245, 17),
(44, 'ship_cyborg_design_cyborg-ullrin', 245, 17),
(45, 'ship_cyborg_design_cyborg-lava', 245, 17),
(46, 'ship_liberator', 5, 17),
(47, 'ship_cyborg_design_cyborg-carbonite', 245, 17),
(48, 'ship_cyborg_design_cyborg-starscream', 245, 17),
(49, 'ship_cyborg_design_cyborg-infinite', 245, 17),
(50, 'ship_cyborg_design_cyborg-asimov', 245, 17),
(51, 'ship_cyborg_design_cyborg-nobilis', 245, 17);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `player_equipment`
--

CREATE TABLE `player_equipment` (
  `userId` int(11) NOT NULL,
  `config1_lasers` text COLLATE utf8_bin NOT NULL DEFAULT '[]',
  `config1_generators` text COLLATE utf8_bin NOT NULL DEFAULT '[]',
  `config1_drones` text COLLATE utf8_bin NOT NULL DEFAULT '[{"items":[],"designs":[]},{"items":[],"designs":[]}]',
  `config2_lasers` text COLLATE utf8_bin NOT NULL DEFAULT '[]',
  `config2_generators` text COLLATE utf8_bin NOT NULL DEFAULT '[]',
  `config2_drones` text COLLATE utf8_bin NOT NULL DEFAULT '[{"items":[],"designs":[]},{"items":[],"designs":[]}]',
  `items` text COLLATE utf8_bin NOT NULL DEFAULT '{"iris1":0,"lf4spCount":0,"lfp01Count":0,"hst2Count":0,"lf5Count":0,"lf4Count":0,"lf4hpCount":0,"lf4mdCount":0,"lf4pdCount":0,"lf4unstableCount":0,"lf3Count":3,"lf3nCount":0,"lf2Count":0,"lf1Count":0,"mp1Count":0,"bo3Count":0,"bo2Count":0,"B01Count":1,"A03Count":0,"A02Count":0,"A01Count":0,"g3n6900Count":0,"g3n3310Count":0,"g3n3210Count":0,"g3n2010Count":0,"g3n1010Count":3,"g3nCount":0,"spartanCount":0,"iriscount":0,"flaxcount":0,"havocCount":0,"herculesCount":0,"apis":false,"zeus":false,"pet":false,"petModules":[],"ships":[7],"designs":{},"skillTree":{"logdisks":0,"researchPoints":0,"resetCount":0},"droneApisParts":0,"droneZeusParts":0}',
  `skill_points` text COLLATE utf8_bin NOT NULL DEFAULT '{"engineering":0,"shieldEngineering":0,"detonation1":0,"detonation2":0,"heatseekingMissiles":0,"rocketFusion":0,"cruelty1":0,"cruelty2":0,"explosives":0,"luck1":0,"luck2":0,"bountyhunter1":0,"bountyhunter2":0,"shieldMechanics":0,"electroOptics":0,"shiphull1":0,"shiphull2":0}',
  `modules` longtext COLLATE utf8_bin NOT NULL DEFAULT '[]',
  `boosters` longtext COLLATE utf8_bin NOT NULL DEFAULT '{"0":[],"1":[],"2":[],"3":[],"4":[],"5":[],"6":[],"7":[],"8":[],"9":[],"10":[],"11":[],"12":[],"13":[],"14":[],"15":[],"16":[],"17":[],"18":[],"19":[],"20":[],"21":[],"22":[],"23":[],"24":[],"25":[],"26":[],"27":[],"28":[],"29":[],"30":[],"31":[],"32":[],"33":[]}',
  `boostersList` longtext COLLATE utf8_bin DEFAULT NULL,
  `ModulesList` longtext COLLATE utf8_bin DEFAULT NULL,
  `lf4lvl` int(11) NOT NULL DEFAULT 0,
  `lf4mdlvl` int(11) NOT NULL DEFAULT 0,
  `lf4pdlvl` int(11) NOT NULL DEFAULT 0,
  `lf4hplvl` int(11) NOT NULL DEFAULT 0,
  `lf4splvl` int(11) NOT NULL DEFAULT 0,
  `lf4unstablelvl` int(11) NOT NULL DEFAULT 0,
  `promelvl` int(11) NOT NULL DEFAULT 0,
  `iris` int(11) NOT NULL DEFAULT 0,
  `lf3lvl` int(11) NOT NULL DEFAULT 0,
  `lf3nlvl` int(11) NOT NULL DEFAULT 0,
  `lf2lvl` int(11) NOT NULL DEFAULT 0,
  `lf1lvl` int(11) NOT NULL DEFAULT 0,
  `mp1lvl` int(11) NOT NULL DEFAULT 0,
  `hst2lvl` int(11) NOT NULL DEFAULT 0,
  `lf5lvl` int(11) NOT NULL DEFAULT 0,
  `lfp01lvl` int(11) NOT NULL DEFAULT 0,
  `A01lvl` int(11) DEFAULT 0,
  `A02lvl` int(11) DEFAULT 0,
  `A03lvl` int(11) DEFAULT 0,
  `B01lvl` int(11) DEFAULT 0,
  `B02lvl` int(11) DEFAULT 0,
  `B03lvl` int(11) DEFAULT 0,
  `formationsSaved` longtext COLLATE utf8_bin NOT NULL,
  `iris1` text COLLATE utf8_bin DEFAULT NULL,
  `iris2` text COLLATE utf8_bin DEFAULT NULL,
  `iris3` text COLLATE utf8_bin DEFAULT NULL,
  `iris4` text COLLATE utf8_bin DEFAULT NULL,
  `iris5` text COLLATE utf8_bin DEFAULT NULL,
  `iris6` text COLLATE utf8_bin DEFAULT NULL,
  `iris7` text COLLATE utf8_bin DEFAULT NULL,
  `iris8` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- A tábla adatainak kiíratása `player_equipment`
--

INSERT INTO `player_equipment` (`userId`, `config1_lasers`, `config1_generators`, `config1_drones`, `config2_lasers`, `config2_generators`, `config2_drones`, `items`, `skill_points`, `modules`, `boosters`, `boostersList`, `ModulesList`, `lf4lvl`, `lf4mdlvl`, `lf4pdlvl`, `lf4hplvl`, `lf4splvl`, `lf4unstablelvl`, `promelvl`, `iris`, `lf3lvl`, `lf3nlvl`, `lf2lvl`, `lf1lvl`, `mp1lvl`, `hst2lvl`, `lf5lvl`, `lfp01lvl`, `A01lvl`, `A02lvl`, `A03lvl`, `B01lvl`, `B02lvl`, `B03lvl`, `formationsSaved`, `iris1`, `iris2`, `iris3`, `iris4`, `iris5`, `iris6`, `iris7`, `iris8`) VALUES
(1, '[\"0\",\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', '[\"41\",\"45\"]', '[{\"items\":[\"33\",\"32\"],\"designs\":[]},{\"items\":[\"31\",\"30\"],\"designs\":[]},{\"items\":[\"29\",\"28\"],\"designs\":[]},{\"items\":[\"27\",\"26\"],\"designs\":[]},{\"items\":[\"25\",\"24\"],\"designs\":[]},{\"items\":[\"23\",\"22\"],\"designs\":[]},{\"items\":[\"21\",\"20\"],\"designs\":[]},{\"items\":[\"19\",\"18\"],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":34,\"lf3nCount\":0,\"lf2Count\":4,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":34,\"B01Count\":4,\"A03Count\":5,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":0,\"g3nCount\":1,\"spartanCount\":0,\"iriscount\":8,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":1,\"apis\":false,\"zeus\":false,\"pet\":true,\"petModules\":[],\"ships\":[7,245,10,49,56,61,62,157,65,64,67],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0,\"fuel\":30000,\"GUARD\":true,\"KAMIKAZE\":false,\"COMBO_SHIP_REPAIR\":false,\"REPAIR_PET\":false,\"AUTO_LOOT\":false}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[{\"Id\":5,\"Type\":5,\"InUse\":false},{\"Id\":9,\"Type\":9,\"InUse\":false}]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '[\"180\"]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":3,\"lf3nCount\":10,\"lf2Count\":1,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":1,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":0,\"g3nCount\":13,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7,3,10],\"designs\":{},\"skillTree\":{\"logdisks\":299486,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":2,\"bountyhunter2\":3,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":3,\"lf3nCount\":0,\"lf2Count\":1,\"lf1Count\":1,\"mp1Count\":1,\"bo3Count\":0,\"bo2Count\":1,\"B01Count\":2,\"A03Count\":1,\"A02Count\":1,\"A01Count\":1,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":8,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7,49,1,2,3,4,5,10,9,8,6],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"drone_formation_f-3d-dm\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"drone_formation_f-3d-dr\",\"drone_formation_f-11-he\":\"drone_formation_f-11-he\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"drone_formation_f-01-tu\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"drone_formation_f-3d-wl\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":5,\"lf3nCount\":40,\"lf2Count\":49,\"lf1Count\":0,\"mp1Count\":42,\"bo3Count\":0,\"bo2Count\":0,\"B01Count\":10,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":8,\"flaxcount\":0,\"havocCount\":13,\"herculesCount\":18,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7,67,157,49,10,245],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":1,\"droneZeusParts\":10}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":5,\"lf3nCount\":0,\"lf2Count\":1,\"lf1Count\":0,\"mp1Count\":2,\"bo3Count\":0,\"bo2Count\":0,\"B01Count\":5,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":3,\"lf3nCount\":0,\"lf2Count\":1,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":0,\"B01Count\":4,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7,245],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '[\"0\",\"1\",\"2\"]', '[\"420\"]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":4,\"lf3nCount\":0,\"lf2Count\":0,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":0,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '[\"260\",\"261\",\"262\",\"263\",\"264\",\"265\",\"266\",\"267\",\"268\",\"0\",\"1\",\"2\",\"3\",\"4\",\"5\"]', '[\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\"]', '[{\"items\":[\"37\",\"36\"],\"designs\":[\"124\"]},{\"items\":[\"35\",\"34\"],\"designs\":[\"123\"]},{\"items\":[\"33\",\"32\"],\"designs\":[\"122\"]},{\"items\":[\"31\",\"30\"],\"designs\":[\"121\"]},{\"items\":[\"29\",\"28\"],\"designs\":[\"120\"]},{\"items\":[\"27\",\"26\"],\"designs\":[\"132\"]},{\"items\":[\"25\",\"24\"],\"designs\":[\"131\"]},{\"items\":[\"23\",\"22\"],\"designs\":[\"130\"]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":2,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":9,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":38,\"lf3nCount\":0,\"lf2Count\":0,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":20,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":8,\"flaxcount\":0,\"havocCount\":5,\"herculesCount\":3,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7,10],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":1,\"droneZeusParts\":4}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[{\"Type\":6,\"Seconds\":35295}],\"5\":[],\"6\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"drone_formation_f-3d-dr\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '[\"0\",\"1\",\"2\"]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":3,\"lf3nCount\":0,\"lf2Count\":0,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":0,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '[\"5\",\"0\",\"1\",\"2\",\"3\",\"4\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\"]', '[\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\"]', '[{\"items\":[\"35\",\"34\"],\"designs\":[]},{\"items\":[\"33\",\"32\"],\"designs\":[]},{\"items\":[\"31\",\"30\"],\"designs\":[]},{\"items\":[\"29\",\"28\"],\"designs\":[]},{\"items\":[\"27\",\"26\"],\"designs\":[]},{\"items\":[\"25\",\"24\"],\"designs\":[]},{\"items\":[\"23\",\"22\"],\"designs\":[]},{\"items\":[\"21\",\"20\"],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":36,\"lf3nCount\":0,\"lf2Count\":1,\"lf1Count\":0,\"mp1Count\":1,\"bo3Count\":0,\"bo2Count\":20,\"B01Count\":2,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":8,\"flaxcount\":0,\"havocCount\":1,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7,10,65,64,346,415,67,19,56],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":2,\"droneZeusParts\":2}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '[\"37\"]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":40,\"lf3nCount\":0,\"lf2Count\":1,\"lf1Count\":1,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":20,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":8,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7,10],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '[\"20\"]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":40,\"lf3nCount\":0,\"lf2Count\":0,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":16,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":8,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7,10],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":1}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '[\"0\",\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\"]', '[\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\"]', '[{\"items\":[\"39\",\"38\"],\"designs\":[]},{\"items\":[\"37\",\"36\"],\"designs\":[]},{\"items\":[\"35\",\"34\"],\"designs\":[]},{\"items\":[\"33\",\"32\"],\"designs\":[]},{\"items\":[\"31\",\"30\"],\"designs\":[]},{\"items\":[\"29\",\"28\"],\"designs\":[]},{\"items\":[\"27\",\"26\"],\"designs\":[]},{\"items\":[\"25\",\"24\"],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":1,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":40,\"lf3nCount\":0,\"lf2Count\":0,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":16,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":8,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7,10],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '[\"0\",\"1\",\"2\",\"3\",\"4\",\"5\",\"660\",\"661\",\"662\",\"663\",\"664\",\"665\"]', '[\"40\",\"100\"]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":6,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":1,\"lf4pdCount\":1,\"lf4unstableCount\":0,\"lf3Count\":6,\"lf3nCount\":0,\"lf2Count\":1,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":2,\"B01Count\":0,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":1,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":true,\"petModules\":[],\"ships\":[7,245,3,2,10,67],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":2,\"droneZeusParts\":0,\"fuel\":12550,\"GUARD\":true,\"KAMIKAZE\":false,\"COMBO_SHIP_REPAIR\":false,\"REPAIR_PET\":false,\"AUTO_LOOT\":false}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":3,\"lf3nCount\":0,\"lf2Count\":0,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":0,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":3,\"lf3nCount\":0,\"lf2Count\":0,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":0,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":3,\"lf3nCount\":0,\"lf2Count\":1,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":0,\"B01Count\":3,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":3,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7,1,3,8,10,9,49],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"drone_formation_default\":\"drone_formation_default\",\"drone_formation_f-02-ar\":\"\",\"drone_formation_f-12-ba\":\"\",\"drone_formation_f-13-bt\":\"\",\"drone_formation_f-08-ch\":\"\",\"drone_formation_f-10-cr\":\"\",\"drone_formation_f-07-di\":\"\",\"drone_formation_f-3d-dm\":\"\",\"drone_formation_f-06-da\":\"\",\"drone_formation_f-3d-dr\":\"\",\"drone_formation_f-11-he\":\"\",\"drone_formation_f-03-la\":\"\",\"drone_formation_f-09-mo\":\"\",\"drone_formation_f-05-pi\":\"\",\"drone_formation_f-3d-rg\":\"\",\"drone_formation_f-04-st\":\"\",\"drone_formation_f-01-tu\":\"\",\"drone_formation_f-3d-vt\":\"\",\"drone_formation_f-3d-wv\":\"\",\"drone_formation_f-3d-wl\":\"\",\"drone_formation_f-3d-x\":\"\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":3,\"lf3nCount\":0,\"lf2Count\":0,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":0,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `player_equipment` (`userId`, `config1_lasers`, `config1_generators`, `config1_drones`, `config2_lasers`, `config2_generators`, `config2_drones`, `items`, `skill_points`, `modules`, `boosters`, `boostersList`, `ModulesList`, `lf4lvl`, `lf4mdlvl`, `lf4pdlvl`, `lf4hplvl`, `lf4splvl`, `lf4unstablelvl`, `promelvl`, `iris`, `lf3lvl`, `lf3nlvl`, `lf2lvl`, `lf1lvl`, `mp1lvl`, `hst2lvl`, `lf5lvl`, `lfp01lvl`, `A01lvl`, `A02lvl`, `A03lvl`, `B01lvl`, `B02lvl`, `B03lvl`, `formationsSaved`, `iris1`, `iris2`, `iris3`, `iris4`, `iris5`, `iris6`, `iris7`, `iris8`) VALUES
(19, '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '[]', '[]', '[{\"items\":[],\"designs\":[]},{\"items\":[],\"designs\":[]}]', '{\"iris1\":0,\"lf4spCount\":0,\"lfp01Count\":0,\"hst2Count\":0,\"lf5Count\":0,\"lf4Count\":0,\"lf4hpCount\":0,\"lf4mdCount\":0,\"lf4pdCount\":0,\"lf4unstableCount\":0,\"lf3Count\":3,\"lf3nCount\":0,\"lf2Count\":0,\"lf1Count\":0,\"mp1Count\":0,\"bo3Count\":0,\"bo2Count\":0,\"B01Count\":1,\"A03Count\":0,\"A02Count\":0,\"A01Count\":0,\"g3n6900Count\":0,\"g3n3310Count\":0,\"g3n3210Count\":0,\"g3n2010Count\":0,\"g3n1010Count\":3,\"g3nCount\":0,\"spartanCount\":0,\"iriscount\":0,\"flaxcount\":0,\"havocCount\":0,\"herculesCount\":0,\"apis\":false,\"zeus\":false,\"pet\":false,\"petModules\":[],\"ships\":[7],\"designs\":{},\"skillTree\":{\"logdisks\":0,\"researchPoints\":0,\"resetCount\":0},\"droneApisParts\":0,\"droneZeusParts\":0}', '{\"engineering\":0,\"shieldEngineering\":0,\"detonation1\":0,\"detonation2\":0,\"heatseekingMissiles\":0,\"rocketFusion\":0,\"cruelty1\":0,\"cruelty2\":0,\"explosives\":0,\"luck1\":0,\"luck2\":0,\"bountyhunter1\":0,\"bountyhunter2\":0,\"shieldMechanics\":0,\"electroOptics\":0,\"shiphull1\":0,\"shiphull2\":0}', '[]', '{\"0\":[],\"1\":[],\"2\":[],\"3\":[],\"4\":[],\"5\":[],\"6\":[],\"7\":[],\"8\":[],\"9\":[],\"10\":[],\"11\":[],\"12\":[],\"13\":[],\"14\":[],\"15\":[],\"16\":[],\"17\":[],\"18\":[],\"19\":[],\"20\":[],\"21\":[],\"22\":[],\"23\":[],\"24\":[],\"25\":[],\"26\":[],\"27\":[],\"28\":[],\"29\":[],\"30\":[],\"31\":[],\"32\":[],\"33\":[]}', NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `player_galaxygates`
--

CREATE TABLE `player_galaxygates` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `gateId` int(11) NOT NULL,
  `parts` longtext COLLATE utf8_bin NOT NULL DEFAULT '[]',
  `multiplier` int(11) NOT NULL DEFAULT 0,
  `lives` int(11) NOT NULL DEFAULT -1,
  `prepared` tinyint(4) NOT NULL DEFAULT 0,
  `wave` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- A tábla adatainak kiíratása `player_galaxygates`
--

INSERT INTO `player_galaxygates` (`id`, `userId`, `gateId`, `parts`, `multiplier`, `lives`, `prepared`, `wave`) VALUES
(1, 1, 1, '[5,3,3,1,1,5,1,5,3,1,1,1,1,1,1,1]', 0, 3, 1, 9),
(2, 1, 4, '[1,5]', 0, 3, 0, 1),
(3, 1, 8, '[]', 0, 0, 0, 1),
(4, 4, 1, '[1,1,1,5,1,1,1,1,3,1,1,3,1,3,1,1,5,5]', 0, 3, 0, 1),
(5, 4, 2, '[1,2,1,2,3,3,1,3,3,1,3,3,3,2,1,1,2,3,3,2,2,3]', 0, 3, 1, 1),
(6, 4, 3, '[1,1,1,1,1,1,1,1,1,1,1,2,3,1,2,1,1,1,3,1,2,1,1,3,3,1]', 0, 3, 0, 1),
(7, 1, 2, '[1,1,1,1,1,1,3,3,3,3,1,3,3,1,1,2,2,1,1,3,1,2,3,1,1,1,1,1,1]', 0, 1, 1, 3),
(8, 1, 3, '[1,3,2,3,1,2,1,3,3,3,1,1,2,1,1,1,1,3,3,1,1,2,2,3,3,2,1,1,1,1,3,1,1,2,1,1,1,1,3,1,1,1,1,1,3,1,1,1,3]', 0, 4, 1, 2),
(9, 8, 4, '[3,1,3,3,1,1,1,1,2,1,1,1,2,3,1,1,3,2,1,2,1,3,3,1,3,1,1,1,2,1,1,1,1,3,1,1,1,1,3,1,1,1,2,3,1,1,1,3,3,3,3,1,3,1,1,1,1,3,1,1,2,3,3,1,1,3,3,1,1,2,1,2,1,1,1,3]', 0, 3, 1, 6),
(10, 10, 1, '[1,1,1,1,3,3,3,3,1,2,2,1,3,1,1,3,1,1,2]', 0, 0, 1, 2),
(11, 10, 9, '[1,1,1,3,2,3,2,1,2,1,1,1,3,1,3,1,2,1,1,1,3,1,1,1,3,1,1,3,1,2,1,3,1,3,1,1,3,1,1,1,3,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,3,2,3,1,1,1,3,1,2,1,1,1,1,3,3,2,1,3,1,3]', 0, 2, 1, 3),
(12, 11, 1, '[1,2,1,1,1,1,1,3,3,1,1,3,3,1,3,1,3,1,3]', 0, 0, 1, 7),
(13, 11, 2, '[3,1,1,1,2,1,2,3,1,3,1,2,1,1,1,1,3,3,3,1,1,1,1,1,3,1,3,1,1]', 0, 2, 1, 5),
(14, 12, 1, '[1,1,1,1,3,3,2,3,1,1,1,3,1,2,1,1,1,2,3,1,1]', 0, 3, 1, 5),
(15, 13, 2, '[1,2,2,1,3,1,3,3,3,1,1,2,2,1,1,1,2,1,1,1,1,1,2,1,1,2,2,1,2,1,1]', 0, 4, 1, 8),
(16, 13, 8, '[]', 0, 0, 0, 1),
(17, 13, 3, '[1,1,1,1,1,3,1,1,3,2,1,1,2,2,1,2,1,1,1,1,1,2,1,1,1,1,1,3,2,1,1,3,3,2,2,1,3,1,1,1,1,1,3,2,1,2,1,3,1,1,2,3,1]', 0, 3, 1, 1),
(18, 14, 1, '[2,3,1,3,1,1,1,1,2,1,1,1,1,2,1,1,1,1,1,1,2,3,1,1]', 0, 0, 1, 1),
(19, 14, 2, '[1,1,3,3,1,3,1]', 0, 3, 0, 1),
(20, 1, 9, '[2,3,1,1,3,1,1,1,3,3,3,1,1,2,3,1,2,1,1,3,1,3,2,1,1,1,3,1,1,3,1,2,3,3,3,1,2,2,3,1,1,2,1,1,1,1,1,1,3,3,1,1,1,1,3,1,3,1,3,3,1,1,1,1,1,1,1,1,1,1,1,1]', 0, 9, 1, 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `player_settings`
--

CREATE TABLE `player_settings` (
  `userId` int(11) NOT NULL,
  `audio` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `quality` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `classY2T` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `display` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `gameplay` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `window` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `boundKeys` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `inGameSettings` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `cooldowns` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `slotbarItems` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `premiumSlotbarItems` text COLLATE utf8_bin NOT NULL DEFAULT '',
  `proActionBarItems` text COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- A tábla adatainak kiíratása `player_settings`
--

INSERT INTO `player_settings` (`userId`, `audio`, `quality`, `classY2T`, `display`, `gameplay`, `window`, `boundKeys`, `inGameSettings`, `cooldowns`, `slotbarItems`, `premiumSlotbarItems`, `proActionBarItems`) VALUES
(1, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":3,\"qualityExplosion\":3,\"qualityCollectable\":3,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":3,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":7,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06561679790026247,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":4,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":0,\"y\":94,\"width\":300,\"height\":150,\"maximixed\":true},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":96,\"width\":325,\"height\":232,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":98,\"y\":6,\"width\":322,\"height\":332,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":0,\"y\":19,\"width\":260,\"height\":130,\"maximixed\":true},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":39,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":46,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_ucb-100\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[]}', '{\"ammunition_mine_smb-01\":\"2022-09-03 23:32:49\",\"equipment_extra_cpu_ish-01\":\"2022-09-03 23:32:49\",\"ammunition_specialammo_emp-01\":\"2022-09-03 23:32:48\",\"ammunition_mine\":\"1954-08-19 12:29:13\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-08-19 12:29:13\",\"ammunition_specialammo_r-ic3\":\"1954-08-19 12:29:13\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\",\"ability_venom\":\"2022-09-04 13:03:32\",\"ability_aegis_hp-repair\":\"2022-07-17 12:17:21\",\"ability_aegis_shield-repair\":\"2022-07-17 12:17:20\",\"ability_aegis_repair-pod\":\"2022-07-17 12:17:20\",\"ability_spectrum\":\"2022-07-29 12:53:13\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(2, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":0,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":3,\"qualityExplosion\":3,\"qualityCollectable\":3,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":1,\"varp3M\":4,\"displaySetting3DqualityEffects\":1,\"displaySetting3DqualityLights\":1,\"displaySetting3DqualityTextures\":1,\"var03r\":4,\"displaySetting3DsizeTextures\":1,\"displaySetting3DtextureFiltering\":1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":13,\"y\":4,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":0,\"y\":96,\"width\":300,\"height\":150,\"maximixed\":true},\"group\":{\"x\":50,\"y\":49,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":97,\"y\":96,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":9,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":41,\"y\":0,\"width\":750,\"height\":168,\"maximixed\":false},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":9,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":47,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":49,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[]}', '{\"ammunition_mine_smb-01\":\"1954-06-28 13:31:38\",\"equipment_extra_cpu_ish-01\":\"1954-06-28 13:31:38\",\"ammunition_specialammo_emp-01\":\"1954-06-28 13:31:38\",\"ammunition_mine\":\"1954-06-28 13:31:38\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-06-28 13:31:38\",\"ammunition_specialammo_r-ic3\":\"1954-06-28 13:31:38\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\",\"ability_solace\":\"1954-06-28 09:40:30\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(3, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":3,\"qualityExplosion\":3,\"qualityCollectable\":3,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":96,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":86,\"y\":1,\"width\":305,\"height\":222,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":49,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":50,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_f-01-tu\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\"]}', '{\"ammunition_mine_smb-01\":\"2022-07-18 20:10:38\",\"equipment_extra_cpu_ish-01\":\"2022-07-18 20:10:35\",\"ammunition_specialammo_emp-01\":\"2022-07-18 20:10:32\",\"ammunition_mine\":\"2022-07-18 20:09:10\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-06-30 20:31:50\",\"ammunition_specialammo_r-ic3\":\"1954-06-30 20:31:50\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(4, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":0,\"qualityExplosion\":0,\"qualityCollectable\":0,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":0,\"y\":95,\"width\":300,\"height\":150,\"maximixed\":true},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":96,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":98,\"y\":8,\"width\":366,\"height\":382,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":8,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":47,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":48,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[]}', '{\"ammunition_mine_smb-01\":\"1954-07-07 20:11:27\",\"equipment_extra_cpu_ish-01\":\"1954-07-07 20:11:27\",\"ammunition_specialammo_emp-01\":\"1954-07-07 20:11:27\",\"ammunition_mine\":\"1954-07-07 20:11:27\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-07-07 20:11:27\",\"ammunition_specialammo_r-ic3\":\"1954-07-07 20:11:27\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\",\"ability_venom\":\"1954-07-07 20:11:27\",\"ability_aegis_hp-repair\":\"1954-07-04 15:54:42\",\"ability_aegis_shield-repair\":\"1954-07-04 15:54:42\",\"ability_aegis_repair-pod\":\"1954-07-04 15:54:42\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(5, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":0,\"qualityEngine\":0,\"qualityExplosion\":0,\"qualityCollectable\":0,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":false,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":96,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":96,\"y\":7,\"width\":240,\"height\":150,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":95,\"y\":10,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":49,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\"]}', '{\"ammunition_mine_smb-01\":\"1954-07-04 16:00:44\",\"equipment_extra_cpu_ish-01\":\"1954-07-04 16:00:44\",\"ammunition_specialammo_emp-01\":\"1954-07-04 16:00:44\",\"ammunition_mine\":\"1954-07-04 16:00:44\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-07-04 16:00:44\",\"ammunition_specialammo_r-ic3\":\"1954-07-04 16:00:44\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(6, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":27,\"voice\":49}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":3,\"qualityExplosion\":3,\"qualityCollectable\":3,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":4,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":4,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":97,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":98,\"y\":9,\"width\":407,\"height\":568,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":71,\"y\":33,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":50,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\"]}', '{\"ammunition_mine_smb-01\":\"0001-01-01 00:00:00\",\"equipment_extra_cpu_ish-01\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_emp-01\":\"0001-01-01 00:00:00\",\"ammunition_mine\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_r-ic3\":\"0001-01-01 00:00:00\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\",\"ability_venom\":\"0001-01-01 00:00:00\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(7, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":0,\"qualityEngine\":0,\"qualityExplosion\":0,\"qualityCollectable\":0,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":false,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":30,\"y\":30,\"width\":212,\"height\":88,\"maximixed\":false},\"ship\":{\"x\":30,\"y\":30,\"width\":212,\"height\":88,\"maximixed\":false},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":94,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":98,\"y\":6,\"width\":413,\"height\":352,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":50,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":50,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\"]}', '{\"ammunition_mine_smb-01\":\"0001-01-01 00:00:00\",\"equipment_extra_cpu_ish-01\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_emp-01\":\"0001-01-01 00:00:00\",\"ammunition_mine\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_r-ic3\":\"0001-01-01 00:00:00\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}');
INSERT INTO `player_settings` (`userId`, `audio`, `quality`, `classY2T`, `display`, `gameplay`, `window`, `boundKeys`, `inGameSettings`, `cooldowns`, `slotbarItems`, `premiumSlotbarItems`, `proActionBarItems`) VALUES
(8, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":0,\"qualityExplosion\":0,\"qualityCollectable\":0,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,1|33,1|36,1|\",\"gameFeatureBarPosition\":\"0.06561679790026247,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":96,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":97,\"y\":9,\"width\":379,\"height\":357,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":11,\"y\":5,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":48,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":49,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_mcb-500\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_ubr-100\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\",\"equipment_extra_cpu_cl04k-xl\"]}', '{\"ammunition_mine_smb-01\":\"1954-07-09 16:57:45\",\"equipment_extra_cpu_ish-01\":\"1954-07-09 16:57:45\",\"ammunition_specialammo_emp-01\":\"1954-07-09 16:57:45\",\"ammunition_mine\":\"1954-07-09 16:57:45\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-07-09 16:57:45\",\"ammunition_specialammo_r-ic3\":\"1954-07-09 16:57:45\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\",\"ability_venom\":\"0001-01-01 00:00:00\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(9, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":0,\"qualityEngine\":0,\"qualityExplosion\":0,\"qualityCollectable\":0,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":false,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":30,\"y\":30,\"width\":238,\"height\":180,\"maximixed\":false},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":30,\"y\":30,\"width\":240,\"height\":150,\"maximixed\":false},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":50,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":50,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\"]}', '{\"ammunition_mine_smb-01\":\"0001-01-01 00:00:00\",\"equipment_extra_cpu_ish-01\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_emp-01\":\"0001-01-01 00:00:00\",\"ammunition_mine\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_r-ic3\":\"0001-01-01 00:00:00\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(10, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":3,\"qualityExplosion\":3,\"qualityCollectable\":3,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":0,\"y\":96,\"width\":300,\"height\":150,\"maximixed\":true},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":95,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":98,\"y\":12,\"width\":343,\"height\":509,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":49,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":49,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[]}', '{\"ammunition_mine_smb-01\":\"1954-07-13 10:56:52\",\"equipment_extra_cpu_ish-01\":\"2022-07-30 11:59:59\",\"ammunition_specialammo_emp-01\":\"2022-07-30 11:59:59\",\"ammunition_mine\":\"1954-07-13 10:56:52\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-07-13 10:56:52\",\"ammunition_specialammo_r-ic3\":\"1954-07-13 10:56:52\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\",\"ability_venom\":\"1954-07-12 08:43:34\",\"ability_sentinel\":\"2022-07-31 13:32:39\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(11, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":0,\"qualityExplosion\":3,\"qualityCollectable\":0,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":96,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":30,\"y\":30,\"width\":240,\"height\":150,\"maximixed\":false},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":9,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":47,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":50,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_ucb-100\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_ubr-100\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\"]}', '{\"ammunition_mine_smb-01\":\"1954-07-23 17:59:07\",\"equipment_extra_cpu_ish-01\":\"1954-07-23 17:59:07\",\"ammunition_specialammo_emp-01\":\"1954-07-23 17:59:07\",\"ammunition_mine\":\"1954-07-23 17:59:07\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-07-23 17:59:07\",\"ammunition_specialammo_r-ic3\":\"1954-07-23 17:59:07\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(12, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":0,\"qualityEngine\":0,\"qualityExplosion\":0,\"qualityCollectable\":0,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":false,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":97,\"y\":94,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":30,\"y\":30,\"width\":240,\"height\":150,\"maximixed\":false},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":50,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":50,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[]}', '{\"ammunition_mine_smb-01\":\"1954-07-24 11:10:24\",\"equipment_extra_cpu_ish-01\":\"1954-07-24 11:10:24\",\"ammunition_specialammo_emp-01\":\"1954-07-24 11:10:24\",\"ammunition_mine\":\"1954-07-24 11:10:24\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-07-24 11:10:24\",\"ammunition_specialammo_r-ic3\":\"1954-07-24 11:10:24\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(13, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":0,\"qualityEngine\":0,\"qualityExplosion\":0,\"qualityCollectable\":0,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":false,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":8,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":4,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":96,\"width\":288,\"height\":209,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":98,\"y\":10,\"width\":421,\"height\":488,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":50,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":50,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\"]}', '{\"ammunition_mine_smb-01\":\"1954-07-24 19:34:24\",\"equipment_extra_cpu_ish-01\":\"1954-07-24 19:34:24\",\"ammunition_specialammo_emp-01\":\"1954-07-24 19:34:24\",\"ammunition_mine\":\"1954-07-24 19:34:24\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-07-24 19:34:24\",\"ammunition_specialammo_r-ic3\":\"1954-07-24 19:34:24\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(14, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":0,\"qualityExplosion\":0,\"qualityCollectable\":0,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06561679790026247,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":4,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":96,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":98,\"y\":7,\"width\":354,\"height\":383,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":0,\"y\":19,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":47,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":49,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_mcb-500\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_ubr-100\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_rllb-x\",\"equipment_extra_cpu_arol-x\"]}', '{\"ammunition_mine_smb-01\":\"2022-08-14 22:54:31\",\"equipment_extra_cpu_ish-01\":\"2022-08-14 22:54:29\",\"ammunition_specialammo_emp-01\":\"2022-08-14 22:54:30\",\"ammunition_mine\":\"1954-07-29 15:35:40\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-07-29 15:35:40\",\"ammunition_specialammo_r-ic3\":\"1954-07-29 15:35:40\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\",\"ability_venom\":\"1954-07-29 15:35:40\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}');
INSERT INTO `player_settings` (`userId`, `audio`, `quality`, `classY2T`, `display`, `gameplay`, `window`, `boundKeys`, `inGameSettings`, `cooldowns`, `slotbarItems`, `premiumSlotbarItems`, `proActionBarItems`) VALUES
(15, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":3,\"qualityExplosion\":3,\"qualityCollectable\":3,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":3,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":30,\"y\":30,\"width\":212,\"height\":88,\"maximixed\":false},\"ship\":{\"x\":30,\"y\":30,\"width\":212,\"height\":88,\"maximixed\":false},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":30,\"y\":30,\"width\":238,\"height\":180,\"maximixed\":false},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":30,\"y\":30,\"width\":240,\"height\":150,\"maximixed\":false},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":48,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":49,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\"]}', '{\"ammunition_mine_smb-01\":\"1954-08-01 13:08:03\",\"equipment_extra_cpu_ish-01\":\"1954-08-01 13:08:03\",\"ammunition_specialammo_emp-01\":\"1954-08-01 13:08:03\",\"ammunition_mine\":\"1954-08-01 13:08:03\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-08-01 13:08:03\",\"ammunition_specialammo_r-ic3\":\"1954-08-01 13:08:03\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(16, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":3,\"qualityExplosion\":3,\"qualityCollectable\":3,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":3,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":30,\"y\":30,\"width\":212,\"height\":88,\"maximixed\":false},\"ship\":{\"x\":30,\"y\":30,\"width\":212,\"height\":88,\"maximixed\":false},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":96,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":30,\"y\":30,\"width\":240,\"height\":150,\"maximixed\":false},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":48,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":50,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\"]}', '{\"ammunition_mine_smb-01\":\"0001-01-01 00:00:00\",\"equipment_extra_cpu_ish-01\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_emp-01\":\"0001-01-01 00:00:00\",\"ammunition_mine\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_r-ic3\":\"0001-01-01 00:00:00\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(17, '{\"notSet\":false,\"playCombatMusic\":true,\"music\":50,\"sound\":100,\"voice\":100}', '{\"notSet\":false,\"qualityAttack\":0,\"qualityBackground\":3,\"qualityPresetting\":3,\"qualityCustomized\":true,\"qualityPoizone\":3,\"qualityShip\":3,\"qualityEngine\":3,\"qualityExplosion\":3,\"qualityCollectable\":3,\"qualityEffect\":0}', '{\"questsAvailableFilter\":false,\"questsUnavailableFilter\":false,\"questsCompletedFilter\":false,\"var_1151\":false,\"var_2239\":false,\"questsLevelOrderDescending\":false}', '{\"notSet\":false,\"displayPlayerNames\":true,\"displayResources\":true,\"showPremiumQuickslotBar\":true,\"allowAutoQuality\":true,\"preloadUserShips\":true,\"displayHitpointBubbles\":true,\"showNotOwnedItems\":true,\"displayChat\":true,\"displayWindowsBackground\":true,\"displayNotFreeCargoBoxes\":true,\"dragWindowsAlways\":true,\"displayNotifications\":true,\"hoverShips\":true,\"displayDrones\":true,\"displayBonusBoxes\":true,\"displayFreeCargoBoxes\":true,\"var12P\":true,\"varb3N\":true,\"displaySetting3DqualityAntialias\":4,\"varp3M\":4,\"displaySetting3DqualityEffects\":4,\"displaySetting3DqualityLights\":3,\"displaySetting3DqualityTextures\":3,\"var03r\":4,\"displaySetting3DsizeTextures\":3,\"displaySetting3DtextureFiltering\":-1,\"proActionBarEnabled\":true,\"proActionBarKeyboardInputEnabled\":true,\"proActionBarAutohideEnabled\":true,\"proActionBarOpened\":false}', '{\"notSet\":false,\"autoRefinement\":false,\"quickSlotStopAttack\":true,\"autoBoost\":false,\"autoBuyBootyKeys\":false,\"doubleclickAttackEnabled\":true,\"autochangeAmmo\":true,\"autoStartEnabled\":true,\"varE3N\":true}', '{\"hideAllWindows\":false,\"scale\":6,\"barState\":\"24,1|23,1|100,1|25,1|35,0|34,0|39,0|\",\"gameFeatureBarPosition\":\"0.06397952655150352,0\",\"gameFeatureBarLayoutType\":\"0\",\"genericFeatureBarPosition\":\"98.29931972789116,0\",\"genericFeatureBarLayoutType\":\"0\",\"categoryBarPosition\":\"50,85\",\"standartSlotBarPosition\":\"50,85|0,40\",\"standartSlotBarLayoutType\":\"0\",\"premiumSlotBarPosition\":\"50,85|0,80\",\"premiumSlotBarLayoutType\":\"0\",\"proActionBarPosition\":\"\",\"proActionBarLayoutType\":\"\",\"windows\":{\"user\":{\"x\":13,\"y\":4,\"width\":212,\"height\":88,\"maximixed\":true},\"ship\":{\"x\":0,\"y\":5,\"width\":212,\"height\":88,\"maximixed\":true},\"ship_warp\":{\"x\":50,\"y\":50,\"width\":300,\"height\":210,\"maximixed\":false},\"chat\":{\"x\":10,\"y\":10,\"width\":300,\"height\":150,\"maximixed\":false},\"group\":{\"x\":50,\"y\":50,\"width\":196,\"height\":200,\"maximixed\":false},\"minimap\":{\"x\":98,\"y\":96,\"width\":375,\"height\":263,\"maximixed\":true},\"spacemap\":{\"x\":10,\"y\":10,\"width\":650,\"height\":475,\"maximixed\":false},\"log\":{\"x\":98,\"y\":9,\"width\":252,\"height\":357,\"maximixed\":true},\"refinement\":{\"x\":50,\"y\":50,\"width\":450,\"height\":520,\"maximixed\":false},\"quests\":{\"x\":30,\"y\":30,\"width\":200,\"height\":150,\"maximixed\":false},\"pet\":{\"x\":50,\"y\":50,\"width\":260,\"height\":130,\"maximixed\":false},\"spaceball\":{\"x\":10,\"y\":10,\"width\":170,\"height\":70,\"maximixed\":false},\"booster\":{\"x\":10,\"y\":10,\"width\":110,\"height\":150,\"maximixed\":false},\"traininggrounds\":{\"x\":10,\"y\":10,\"width\":320,\"height\":320,\"maximixed\":false},\"settings\":{\"x\":50,\"y\":49,\"width\":400,\"height\":470,\"maximixed\":false},\"help\":{\"x\":10,\"y\":10,\"width\":219,\"height\":121,\"maximixed\":false},\"logout\":{\"x\":50,\"y\":46,\"width\":200,\"height\":200,\"maximixed\":false}}}', '[{\"actionType\":7,\"charCode\":0,\"parameter\":0,\"keyCodes\":[49]},{\"actionType\":7,\"charCode\":0,\"parameter\":1,\"keyCodes\":[50]},{\"actionType\":7,\"charCode\":0,\"parameter\":2,\"keyCodes\":[51]},{\"actionType\":7,\"charCode\":0,\"parameter\":3,\"keyCodes\":[52]},{\"actionType\":7,\"charCode\":0,\"parameter\":4,\"keyCodes\":[53]},{\"actionType\":7,\"charCode\":0,\"parameter\":5,\"keyCodes\":[54]},{\"actionType\":7,\"charCode\":0,\"parameter\":6,\"keyCodes\":[55]},{\"actionType\":7,\"charCode\":0,\"parameter\":7,\"keyCodes\":[56]},{\"actionType\":7,\"charCode\":0,\"parameter\":8,\"keyCodes\":[57]},{\"actionType\":7,\"charCode\":0,\"parameter\":9,\"keyCodes\":[48]},{\"actionType\":8,\"charCode\":0,\"parameter\":0,\"keyCodes\":[112]},{\"actionType\":8,\"charCode\":0,\"parameter\":1,\"keyCodes\":[113]},{\"actionType\":8,\"charCode\":0,\"parameter\":2,\"keyCodes\":[114]},{\"actionType\":8,\"charCode\":0,\"parameter\":3,\"keyCodes\":[115]},{\"actionType\":8,\"charCode\":0,\"parameter\":4,\"keyCodes\":[116]},{\"actionType\":8,\"charCode\":0,\"parameter\":5,\"keyCodes\":[117]},{\"actionType\":8,\"charCode\":0,\"parameter\":6,\"keyCodes\":[118]},{\"actionType\":8,\"charCode\":0,\"parameter\":7,\"keyCodes\":[119]},{\"actionType\":8,\"charCode\":0,\"parameter\":8,\"keyCodes\":[120]},{\"actionType\":0,\"charCode\":0,\"parameter\":0,\"keyCodes\":[74]},{\"actionType\":1,\"charCode\":0,\"parameter\":0,\"keyCodes\":[67]},{\"actionType\":2,\"charCode\":0,\"parameter\":0,\"keyCodes\":[17]},{\"actionType\":3,\"charCode\":0,\"parameter\":0,\"keyCodes\":[32]},{\"actionType\":4,\"charCode\":0,\"parameter\":0,\"keyCodes\":[69]},{\"actionType\":5,\"charCode\":0,\"parameter\":0,\"keyCodes\":[82]},{\"actionType\":13,\"charCode\":0,\"parameter\":0,\"keyCodes\":[68]},{\"actionType\":6,\"charCode\":0,\"parameter\":0,\"keyCodes\":[76]},{\"actionType\":9,\"charCode\":0,\"parameter\":0,\"keyCodes\":[72]},{\"actionType\":10,\"charCode\":0,\"parameter\":0,\"keyCodes\":[70]},{\"actionType\":11,\"charCode\":0,\"parameter\":0,\"keyCodes\":[107]},{\"actionType\":12,\"charCode\":0,\"parameter\":0,\"keyCodes\":[109]},{\"actionType\":14,\"charCode\":0,\"parameter\":0,\"keyCodes\":[13]},{\"actionType\":15,\"charCode\":0,\"parameter\":0,\"keyCodes\":[9]},{\"actionType\":8,\"charCode\":0,\"parameter\":9,\"keyCodes\":[121]},{\"actionType\":16,\"charCode\":0,\"parameter\":0,\"keyCodes\":[16]}]', '{\"petDestroyed\":false,\"blockedGroupInvites\":false,\"selectedLaser\":\"ammunition_laser_lcb-10\",\"selectedRocket\":\"ammunition_rocket_plt-3030\",\"selectedRocketLauncher\":\"ammunition_rocketlauncher_hstrm-01\",\"selectedFormation\":\"drone_formation_default\",\"currentConfig\":1,\"selectedCpus\":[\"equipment_extra_cpu_arol-x\",\"equipment_extra_cpu_rllb-x\"]}', '{\"ammunition_mine_smb-01\":\"1954-08-02 20:29:44\",\"equipment_extra_cpu_ish-01\":\"1954-08-02 20:29:44\",\"ammunition_specialammo_emp-01\":\"1954-08-02 20:29:44\",\"ammunition_mine\":\"1954-08-02 20:29:44\",\"ammunition_specialammo_dcr-250\":\"0001-01-01 00:00:00\",\"ammunition_specialammo_pld-8\":\"1954-08-02 20:29:44\",\"ammunition_specialammo_r-ic3\":\"1954-08-02 20:29:44\",\"tech_energy-leech\":\"\",\"tech_chain-impulse\":\"\",\"tech_precision-targeter\":\"\",\"tech_backup-shields\":\"\",\"tech_battle-repair-bot\":\"\",\"ability_aegis_hp-repair\":\"1954-08-02 20:29:44\",\"ability_aegis_shield-repair\":\"1954-08-02 20:29:44\",\"ability_aegis_repair-pod\":\"1954-08-02 20:29:44\"}', '{\"1\":\"ammunition_laser_ucb-100\"}', '{\"1\":\"drone_formation_default\"}', '{}'),
(18, '', '', '', '', '', '', '', '', '', '', '', ''),
(19, '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `player_titles`
--

CREATE TABLE `player_titles` (
  `userID` int(11) NOT NULL,
  `titles` varchar(999) CHARACTER SET utf8 NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- A tábla adatainak kiíratása `player_titles`
--

INSERT INTO `player_titles` (`userID`, `titles`) VALUES
(1, '[majom]'),
(2, '[]'),
(3, '[]'),
(4, '[]'),
(5, '[]'),
(6, '[]'),
(7, '[]'),
(8, '[]'),
(9, '[]'),
(10, '[]'),
(11, '[]'),
(12, '[]'),
(13, '[]'),
(14, '[]'),
(15, '[]'),
(16, '[]'),
(17, '[]'),
(18, '[]'),
(19, '[]');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `resource_achievements`
--

CREATE TABLE `resource_achievements` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `serverbanklog_clans`
--

CREATE TABLE `serverbanklog_clans` (
  `ID` int(11) NOT NULL DEFAULT 0,
  `Amount` int(11) DEFAULT 0,
  `From` varchar(99) NOT NULL,
  `ClanId` int(11) DEFAULT 0,
  `Reason` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_bans`
--

CREATE TABLE `server_bans` (
  `id` bigint(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `modId` int(11) NOT NULL,
  `reason` text COLLATE utf8_bin NOT NULL,
  `typeId` tinyint(4) NOT NULL,
  `ended` tinyint(1) NOT NULL,
  `end_date` datetime NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_battlestations`
--

CREATE TABLE `server_battlestations` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `mapId` int(11) NOT NULL,
  `clanId` int(11) NOT NULL,
  `positionX` int(11) NOT NULL,
  `positionY` int(11) NOT NULL,
  `inBuildingState` tinyint(4) NOT NULL,
  `buildTimeInMinutes` int(11) NOT NULL,
  `buildTime` datetime NOT NULL,
  `deflectorActive` tinyint(4) NOT NULL,
  `deflectorSecondsLeft` int(11) NOT NULL,
  `deflectorTime` datetime NOT NULL,
  `visualModifiers` text COLLATE utf8_bin NOT NULL,
  `modules` longtext COLLATE utf8_bin NOT NULL,
  `active` tinyint(4) NOT NULL,
  `protectedClanId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- A tábla adatainak kiíratása `server_battlestations`
--

INSERT INTO `server_battlestations` (`id`, `name`, `mapId`, `clanId`, `positionX`, `positionY`, `inBuildingState`, `buildTimeInMinutes`, `buildTime`, `deflectorActive`, `deflectorSecondsLeft`, `deflectorTime`, `visualModifiers`, `modules`, `active`, `protectedClanId`) VALUES
(1, 'Aries', 3, 0, 10500, 2500, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(2, 'Balzar', 4, 0, 4500, 9300, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(3, 'Cetus', 17, 0, 17000, 2500, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(4, 'Draco', 18, 0, 10000, 6500, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(5, 'Equleus', 19, 0, 10000, 7500, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(6, 'Fornax', 7, 0, 10500, 2500, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(7, 'Gemini', 8, 0, 16000, 8500, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(8, 'Hydra', 21, 0, 10500, 9000, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(9, 'Indus', 22, 0, 9000, 6500, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(10, 'Julius', 23, 0, 10500, 6000, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(11, 'Kepler', 11, 0, 10500, 2500, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(12, 'Lynx', 12, 0, 4500, 9000, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(13, 'Mensa', 25, 0, 11000, 9000, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(14, 'Nashira', 26, 0, 10000, 8500, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(15, 'Orion', 27, 0, 10500, 5000, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(16, 'Volan', 13, 0, 10000, 6000, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(17, 'Wican', 14, 0, 11500, 6000, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(18, 'Xenitor', 15, 0, 9000, 6000, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0),
(19, 'Yukian', 16, 0, 9000, 6000, 0, 0, '0000-00-00 00:00:00', 0, 0, '0001-01-01 00:00:00', '[]', '[]', 0, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_clans`
--

CREATE TABLE `server_clans` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `tag` varchar(4) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `description` varchar(16000) COLLATE utf8_bin NOT NULL DEFAULT '',
  `factionId` tinyint(4) NOT NULL DEFAULT 0,
  `recruiting` tinyint(4) NOT NULL DEFAULT 1,
  `leaderId` int(11) NOT NULL DEFAULT 0,
  `news` text COLLATE utf8_bin NOT NULL DEFAULT '[]',
  `join_dates` text COLLATE utf8_bin NOT NULL DEFAULT '{}',
  `rankPoints` bigint(20) DEFAULT 0,
  `rank` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `profile` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'logo_default.jpg',
  `bankcredits` int(11) NOT NULL DEFAULT 0,
  `bankuri` int(11) NOT NULL DEFAULT 0,
  `creditTax` varchar(255) COLLATE utf8_bin DEFAULT '0',
  `uridiumTax` varchar(255) COLLATE utf8_bin DEFAULT '0',
  `lastTaxCredit` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lastTaxUridium` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- A tábla adatainak kiíratása `server_clans`
--

INSERT INTO `server_clans` (`id`, `name`, `tag`, `description`, `factionId`, `recruiting`, `leaderId`, `news`, `join_dates`, `rankPoints`, `rank`, `date`, `profile`, `bankcredits`, `bankuri`, `creditTax`, `uridiumTax`, `lastTaxCredit`, `lastTaxUridium`) VALUES
(1, 'ADMIN', 'ADMI', 'fdhjdsfj', 2, 1, 1, '[]', '{\"1\":\"2022-07-20 21:39:43\"}', 0, 0, '2022-07-20 21:39:43', 'logo_default.jpg', 0, 0, '0', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_clan_applications`
--

CREATE TABLE `server_clan_applications` (
  `id` int(11) NOT NULL,
  `clanId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_clan_diplomacy`
--

CREATE TABLE `server_clan_diplomacy` (
  `id` bigint(20) NOT NULL,
  `senderClanId` int(11) NOT NULL,
  `toClanId` int(11) NOT NULL,
  `diplomacyType` tinyint(4) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_clan_diplomacy_applications`
--

CREATE TABLE `server_clan_diplomacy_applications` (
  `id` bigint(20) NOT NULL,
  `senderClanId` int(11) NOT NULL,
  `toClanId` int(11) NOT NULL,
  `diplomacyType` tinyint(4) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `message` longtext COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_maps`
--

CREATE TABLE `server_maps` (
  `mapID` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `npcs` longtext COLLATE utf8_bin NOT NULL,
  `stations` longtext COLLATE utf8_bin NOT NULL,
  `portals` longtext COLLATE utf8_bin NOT NULL,
  `collectables` longtext COLLATE utf8_bin NOT NULL,
  `options` varchar(512) COLLATE utf8_bin NOT NULL DEFAULT '{"StarterMap":false,"PvpMap":false,"RangeDisabled":false,"CloakBlocked":false,"LogoutBlocked":false,"DeathLocationRepair":true}',
  `factionID` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- A tábla adatainak kiíratása `server_maps`
--

INSERT INTO `server_maps` (`mapID`, `name`, `npcs`, `stations`, `portals`, `collectables`, `options`, `factionID`) VALUES
(1, '1-1', '[{   \"ShipId\": 84,   \"Amount\":15},{   \"ShipId\": 23,   \"Amount\":15}]    ', '[{\"TypeId\": 46,   \"FactionId\": 1,   \"Position\": [2000,2000] },{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [2200,200]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [1500,300]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [1000,500]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [500,1000]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [200,1500]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [200,2100]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [400,2800]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [700,3300]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [1200,3600]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [1800,3800]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [2400,3700]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3000,3400]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [3400,3000]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3700,2400]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3700,1800]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3600,1200]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [600,7600]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3200,700]}]\r\n', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10200,2000],   \"TargetPosition\": [6000,13400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 2,   \"Position\": [18500, 11500],   \"TargetPosition\": [1900, 2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 51,   \"Position\": [5100, 1900],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 2,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 52,   \"Position\": [4100, 3500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 74,   \"Position\": [6100, 5000],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 75,   \"Position\": [6100, 3500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 76,   \"Position\": [6100, 2000],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 53,   \"Position\": [2200, 4300],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 4,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 306,   \"Position\": [700, 11200],   \"TargetPosition\": [9800,6700],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 55,   \"Position\": [800, 4600],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 5,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(2, '1-2', '[{\"ShipId\":84,\"Amount\":10},{\"ShipId\":71,\"Amount\":10},{\"ShipId\":119,\"Amount\":10},{\"ShipId\":23,\"Amount\":7},{\"ShipId\":24,\"Amount\":7}]', '', '[{   \"TargetSpaceMapId\": 1,   \"Position\": [2000, 2000],   \"TargetPosition\": [18900,11400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 3,   \"Position\": [19500, 2000],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 4,   \"Position\": [19500, 12000],   \"TargetPosition\": [1600,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(3, '1-3', '[{\"ShipId\":71,\"Amount\":10},{\"ShipId\":72,\"Amount\":10},{\"ShipId\":75,\"Amount\":10},{\"ShipId\":73,\"Amount\":10},{\"ShipId\":26,\"Amount\":7},{\"ShipId\":25,\"Amount\":8},{\"ShipId\":31,\"Amount\":7}]', '', '[{   \"TargetSpaceMapId\": 7,   \"Position\": [18700, 1300],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 4,   \"Position\": [18700, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 2,   \"Position\": [1800, 11300],   \"TargetPosition\": [19500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(4, '1-4', '[{\"ShipId\":71,\"Amount\":10},{\"ShipId\":74,\"Amount\":10},{\"ShipId\":75,\"Amount\":10},{\"ShipId\":73,\"Amount\":10},{\"ShipId\":46,\"Amount\":7},{\"ShipId\":25,\"Amount\":7},{\"ShipId\":24,\"Amount\":7}]', '', '[{   \"TargetSpaceMapId\": 12,   \"Position\": [18700, 11300],   \"TargetPosition\": [1900,1100],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 13,   \"Position\": [18700, 6500],   \"TargetPosition\": [1900,6350],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 3,   \"Position\": [18700, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 2,   \"Position\": [1600, 1300],   \"TargetPosition\": [19500,12000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(5, '2-1', '[{   \"ShipId\": 84,   \"Amount\":15},{   \"ShipId\": 23,   \"Amount\":15}]  ', '[{\"TypeId\": 46,   \"FactionId\": 2,   \"Position\": [18900,2000] },{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [17500,3000]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [17200,2500]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [17200,1800]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [17300,1200]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [17700,700]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [18200,300]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [18800,200]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [19400,200]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [20000,500]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [20400,1000]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [20700,1500]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [20800,2100]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [20600,2800]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [20200,3300]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [19700,3600]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [19100,3800]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [18500,3700]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [17900,3400]}]', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10200, 2000],   \"TargetPosition\": [28000,3000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 150,   \"Position\": [10200, 3500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 2,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 51,   \"Position\": [16200, 1400],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 2,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 52,   \"Position\": [17000, 3300],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 74,   \"Position\": [15800, 3500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 75,   \"Position\": [15800, 6500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 76,   \"Position\": [15800, 5000],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 53,   \"Position\": [18800, 4600],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 4,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 307,   \"Position\": [1800, 1300],   \"TargetPosition\": [600,5800],   \"GraphicId\": 1,   \"FactionId\": 2,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 55,   \"Position\": [20400, 5100],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 5,   \"FactionId\": 2,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 6,   \"Position\": [1800, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(6, '2-2', '[{\"ShipId\":84,\"Amount\":10},{\"ShipId\":71,\"Amount\":10},{\"ShipId\":119,\"Amount\":10},{\"ShipId\":23,\"Amount\":7},{\"ShipId\":24,\"Amount\":7}]', '', '[{   \"TargetSpaceMapId\": 5,   \"Position\": [18700, 1300],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 7,   \"Position\": [1800, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 8,   \"Position\": [18700, 11300],   \"TargetPosition\": [1800,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(7, '2-3', '[{\"ShipId\":71,\"Amount\":10},{\"ShipId\":72,\"Amount\":10},{\"ShipId\":75,\"Amount\":10},{\"ShipId\":73,\"Amount\":10},{\"ShipId\":26,\"Amount\":7},{\"ShipId\":25,\"Amount\":8},{\"ShipId\":31,\"Amount\":7}]', '', '[{   \"TargetSpaceMapId\": 6,   \"Position\": [18700, 1300],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 3,   \"Position\": [1800, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 8,   \"Position\": [18700, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(8, '2-4', '[{\"ShipId\":71,\"Amount\":10},{\"ShipId\":74,\"Amount\":10},{\"ShipId\":75,\"Amount\":10},{\"ShipId\":73,\"Amount\":10},{\"ShipId\":46,\"Amount\":7},{\"ShipId\":25,\"Amount\":7},{\"ShipId\":24,\"Amount\":7}]', '', '[{   \"TargetSpaceMapId\": 6,   \"Position\": [1800, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 7,   \"Position\": [18700, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 11,   \"Position\": [1800, 11300],   \"TargetPosition\": [1600,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 14,   \"Position\": [10200, 11300],   \"TargetPosition\": [10000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(9, '3-1', '[{   \"ShipId\": 84,   \"Amount\":15},{   \"ShipId\": 23,   \"Amount\":15}]    ', '[{\"TypeId\": 46,   \"FactionId\": 3,   \"Position\": [19000,11600] },{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [17500,10400]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17200,11000]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17200,11600]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17300,12200]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [17700,12800]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [18200,13100]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [18800,13300]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19400,13200]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [20000,13000]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20400,12500]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20700,11900]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20700,11300]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [20600,10700]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20200,10200]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19700,9900]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [19100,9700]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [18500,9800]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17900,10000]}]', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10500, 11600],   \"TargetPosition\": [28000,24000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 10,   \"Position\": [1800, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 51,   \"Position\": [17900, 8900],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 2,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 52,   \"Position\": [16600, 10400],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 74,   \"Position\": [18000, 11000],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 75,   \"Position\": [18000, 12000],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 76,   \"Position\": [18000, 10000],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 3,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 53,   \"Position\": [16000, 12400],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 4,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 308,   \"Position\": [1800, 1300],   \"TargetPosition\": [600,5800],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 55,   \"Position\": [19400, 8400],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 5,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(10, '3-2', '[{\"ShipId\":84,\"Amount\":10},{\"ShipId\":71,\"Amount\":10},{\"ShipId\":119,\"Amount\":10},{\"ShipId\":23,\"Amount\":7},{\"ShipId\":24,\"Amount\":7}]', '', '[{   \"TargetSpaceMapId\": 9,   \"Position\": [18700, 11300],   \"TargetPosition\": [1600,1800],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 11,   \"Position\": [18700, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 12,   \"Position\": [1600, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(11, '3-3', '[{\"ShipId\":71,\"Amount\":10},{\"ShipId\":72,\"Amount\":10},{\"ShipId\":75,\"Amount\":10},{\"ShipId\":73,\"Amount\":10},{\"ShipId\":26,\"Amount\":7},{\"ShipId\":25,\"Amount\":8},{\"ShipId\":31,\"Amount\":7}]', '', '[{   \"TargetSpaceMapId\": 8,   \"Position\": [1600, 1300],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 12,   \"Position\": [1600, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 10,   \"Position\": [18700, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(12, '3-4', '[{\"ShipId\":71,\"Amount\":10},{\"ShipId\":74,\"Amount\":10},{\"ShipId\":75,\"Amount\":10},{\"ShipId\":73,\"Amount\":10},{\"ShipId\":46,\"Amount\":7},{\"ShipId\":25,\"Amount\":7},{\"ShipId\":24,\"Amount\":7}]', '', '[{   \"TargetSpaceMapId\": 4,   \"Position\": [1800, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 11,   \"Position\": [18700, 1300],   \"TargetPosition\": [1600,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 10,   \"Position\": [18700, 11300],   \"TargetPosition\": [1600,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 15,   \"Position\": [10500, 1300],   \"TargetPosition\": [18700,6500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(13, '4-1', '[{\"ShipId\":118,\"Amount\":3}]', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10400,6400],   \"TargetPosition\": [19200,13400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 4,   \"Position\": [1900,6350],   \"TargetPosition\": [18600,6400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 15,   \"Position\": [18500,11500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 14,   \"Position\": [18500,2000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]\r\n', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(14, '4-2', '[{\"ShipId\":118,\"Amount\":6}]', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10000,6300],   \"TargetPosition\": [21800,11900],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 13,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 8,   \"Position\": [10000,2000],   \"TargetPosition\": [10200,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 15,   \"Position\": [18500,11500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(15, '4-3', '[{\"ShipId\":118,\"Amount\":3}]', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10200, 6600],   \"TargetPosition\": [21800,14500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 12,   \"Position\": [18500,6750],   \"TargetPosition\": [10500,1200],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 14,   \"Position\": [2000,2000],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 13,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(16, '4-4', '', '', '[{   \"TargetSpaceMapId\": 17,   \"Position\": [6000,13400],   \"TargetPosition\": [18500,6750],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 21,   \"Position\": [28000,3000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 25,   \"Position\": [28000,24000],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 13,   \"Position\": [19200,13400],   \"TargetPosition\": [10400,6400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 14,   \"Position\": [21800,11900],   \"TargetPosition\": [10000,6400],   \"GraphicId\": 1,   \"FactionId\": 2,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 15,   \"Position\": [21800,14500],   \"TargetPosition\": [10200,6600],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 93,   \"Position\": [10200, 2000],   \"TargetPosition\": [18000,3000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":true,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(17, '1-5', '[{   \"ShipId\": 71,   \"Amount\": 20},{   \"ShipId\": 24,   \"Amount\": 15},{   \"ShipId\": 76,   \"Amount\": 15},{   \"ShipId\": 27,   \"Amount\": 8},{   \"ShipId\": 77,   \"Amount\": 10},{   \"ShipId\": 28,   \"Amount\": 8}]\r\n', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [18500,6750],   \"TargetPosition\": [6000,13400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 19,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 18,   \"Position\": [2000,2000],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 19,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 29,   \"Position\": [10000,11500],   \"TargetPosition\": [7100,13300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(18, '1-6', '[{   \"ShipId\": 29,   \"Amount\": 6},{   \"ShipId\": 35,   \"Amount\": 10},{   \"ShipId\": 80,   \"Amount\": 2}]', '', '[{   \"TargetSpaceMapId\": 17,   \"Position\": [18500, 11500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 20,   \"Position\": [2000, 11500],   \"TargetPosition\": [18200,2200],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(19, '1-7', '[{   \"ShipId\": 78,   \"Amount\": 10},{   \"ShipId\": 29,   \"Amount\": 2},{   \"ShipId\": 79,   \"Amount\": 10},{   \"ShipId\": 35,   \"Amount\": 10}]', '', '[{   \"TargetSpaceMapId\": 20,   \"Position\": [2000, 2000],   \"TargetPosition\": [18200,11200],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 17,   \"Position\": [18500,2000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(20, '1-8', '[{   \"ShipId\": 85,   \"Amount\": 30},{   \"ShipId\": 34,   \"Amount\": 20}]', '[{   \"TypeId\": 46,   \"FactionId\": 1,   \"Position\": [2100,6600] },{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [200,6700]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [200,6200]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [500,5500]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [900,5100]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [1500,4900]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [2100,4800]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [2800,5000]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3200,5400]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [3600,5800]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3700,6400]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3700,7100]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3400,7600]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [3000,8100]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [2400,8300]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [1800,8400]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [1200,8200]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [600,7600]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [300,7300]}]\r\n', '[{   \"TargetSpaceMapId\": 19,   \"Position\": [18200, 11200],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 18,   \"Position\": [18200, 2200],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 51,   \"Position\": [4500,5400],   \"TargetPosition\": [18900,11300],   \"GraphicId\": 2, \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 16,   \"Position\": [18100, 6600],   \"TargetPosition\": [6000,13400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 306,   \"Position\": [11100, 11000],   \"TargetPosition\": [700,11400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(21, '2-5', '[{   \"ShipId\": 71,   \"Amount\": 20},{   \"ShipId\": 24,   \"Amount\": 15},{   \"ShipId\": 76,   \"Amount\": 15},{   \"ShipId\": 27,   \"Amount\": 8},{   \"ShipId\": 77,   \"Amount\": 10},{   \"ShipId\": 28,   \"Amount\": 8}]\r\n', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [2000,11500],   \"TargetPosition\": [28000,3000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 22,   \"Position\": [2000,2000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 23,   \"Position\": [18500,2000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 29,   \"Position\": [18500,11500],   \"TargetPosition\": [30400,4500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(22, '2-6', '[{   \"ShipId\": 29,   \"Amount\": 6},{   \"ShipId\": 35,   \"Amount\": 10},{   \"ShipId\": 80,   \"Amount\": 2}]', '', '[{   \"TargetSpaceMapId\": 21,   \"Position\": [2000, 11500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 24,   \"Position\": [18500, 2000],   \"TargetPosition\": [2200,11000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(23, '2-7', '[{   \"ShipId\": 78,   \"Amount\": 10},{   \"ShipId\": 29,   \"Amount\": 2},{   \"ShipId\": 79,   \"Amount\": 10},{   \"ShipId\": 35,   \"Amount\": 10}]', '', '[{   \"TargetSpaceMapId\": 21,   \"Position\": [2000, 11500],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 24,   \"Position\": [18500, 2000],   \"TargetPosition\": [18500,11000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]\r\n', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(24, '2-8', '[{   \"ShipId\": 85,   \"Amount\": 30},{   \"ShipId\": 34,   \"Amount\": 20}]', '[{\"TypeId\": 46,   \"FactionId\": 2,   \"Position\": [10400,1800] },{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [8900,2800]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [9300,3200]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [9800,3700]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [10400,3900]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [11000,3700]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [11600,3500]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [12000,3100]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [12300,2400]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [12400,1700]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [12200,1100]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [11800,800]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [11300,400]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [10700,200]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [10100,300]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [9500,500]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [9100,900]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [8800,1500]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [8700,2100]}]', '[{   \"TargetSpaceMapId\": 23,   \"Position\": [18500, 11000],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 22,   \"Position\": [2200, 11000],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 51,   \"Position\": [7800,3900],   \"TargetPosition\": [18900,11300],   \"GraphicId\": 2, \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 16,   \"Position\": [10300, 10800],   \"TargetPosition\": [28000,3000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 307,   \"Position\": [16500, 3600],   \"TargetPosition\": [10800,1500],   \"GraphicId\": 1,   \"FactionId\": 2,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(25, '3-5', '[{   \"ShipId\": 71,   \"Amount\": 20},{   \"ShipId\": 24,   \"Amount\": 15},{   \"ShipId\": 76,   \"Amount\": 15},{   \"ShipId\": 27,   \"Amount\": 8},{   \"ShipId\": 77,   \"Amount\": 10},{   \"ShipId\": 28,   \"Amount\": 8}]\r\n', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [2000,2000],   \"TargetPosition\": [28000,24000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 26,   \"Position\": [2000,11500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 27,   \"Position\": [18500,11500],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 29,   \"Position\": [18500,2000],   \"TargetPosition\": [30400,21600],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(26, '3-6', '[{   \"ShipId\": 29,   \"Amount\": 6},{   \"ShipId\": 35,   \"Amount\": 10},{   \"ShipId\": 80,   \"Amount\": 2}]', '', '[{   \"TargetSpaceMapId\": 25,   \"Position\": [2000, 2000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 28,   \"Position\": [18500, 11500],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(27, '3-7', '[{   \"ShipId\": 78,   \"Amount\": 10},{   \"ShipId\": 29,   \"Amount\": 2},{   \"ShipId\": 79,   \"Amount\": 10},{   \"ShipId\": 35,   \"Amount\": 10}]', '', '[{   \"TargetSpaceMapId\": 25,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 28,   \"Position\": [18500,11500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(28, '3-8', '[{   \"ShipId\": 85,   \"Amount\": 30},{   \"ShipId\": 34,   \"Amount\": 20}]', '[{\"TypeId\": 46,   \"FactionId\": 3,   \"Position\": [19100,6500] },{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [18700,4800]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19300,4700]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19900,5000]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20400,5300]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [20800,5800]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [21000,6400]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20900,7100]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20600,7600]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [20200,8100]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19600,8300]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19000,8400]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [18400,8300]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [17900,7900]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17500,7400]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17300,6700]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [17400,6100]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17700,5500]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [18100,5100]}]', '[{   \"TargetSpaceMapId\": 27,   \"Position\": [2000, 2000],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 26,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 51,   \"Position\": [16000,5100],   \"TargetPosition\": [18900,11300],   \"GraphicId\": 2, \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 16,   \"Position\": [1900, 6800],   \"TargetPosition\": [28000,24000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 308,   \"Position\": [16600, 10300],   \"TargetPosition\": [19000,11700],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true }]\r\n', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(29, '4-5', '[{   \"ShipId\": 42,   \"Amount\": 13},{   \"ShipId\": 45,   \"Amount\": 11},{   \"ShipId\": 47,   \"Amount\": 10},{   \"ShipId\": 83,   \"Amount\": 5},{   \"ShipId\": 36,   \"Amount\": 5},{   \"ShipId\": 37,   \"Amount\": 5},{   \"ShipId\": 38,   \"Amount\": 5},{   \"ShipId\": 39,   \"Amount\": 8},{   \"ShipId\": 43,   \"Amount\": 5},{   \"ShipId\": 39,   \"Amount\": 5},{   \"ShipId\": 40,   \"Amount\": 5},{   \"ShipId\": 41,   \"Amount\": 5},{   \"ShipId\": 44,   \"Amount\": 5},{   \"ShipId\": 116,   \"Amount\": 5}]', '', '[{   \"TargetSpaceMapId\": 91,   \"Position\": [21200,13300],   \"TargetPosition\": [21300,13400],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 17,   \"Position\": [7100,13300],   \"TargetPosition\": [10000,11500],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 21,   \"Position\": [30400,4500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 25,   \"Position\": [30400,21600],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(42, '???', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(51, 'GG Alpha', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(52, 'GG Beta', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(53, 'GG Gamma', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(55, 'GG Delta', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(58, 'Battle Map', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(61, 'MMO INVASION', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":false}', 0),
(62, 'EIC INVASION', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":false}', 0),
(63, 'VRU INVASION', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":false}', 0),
(70, 'GG Epsilon', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(71, 'GG Zeta', '[{   \"ShipId\": 107,   \"Amount\": 18}]', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10300,6300],   \"TargetPosition\": [21300,13400],   \"GraphicId\": 4,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(74, 'GG Kappa', '', '', '[{   \"TargetSpaceMapId\": 20,   \"Position\": [10000, 6200],   \"TargetPosition\": [10000,6200],   \"GraphicId\": 41,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(75, 'GG Lambda', '     ', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(76, 'GG Kronos', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(91, '5-1', '[{\"ShipId\":114,\"Amount\":5},{\"ShipId\":111,\"Amount\":5},{\"ShipId\":23,\"Amount\":5},{\"ShipId\":113,\"Amount\":5}]', '', '[{   \"TargetSpaceMapId\": 92,   \"Position\": [6000,13400],   \"TargetPosition\": [18500,6750],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 29,   \"Position\": [21200,13300],   \"TargetPosition\": [21300,13400],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(92, '5-2', '[{\"ShipId\":114,\"Amount\":10},{\"ShipId\":111,\"Amount\":10},{\"ShipId\":23,\"Amount\":10},{\"ShipId\":113,\"Amount\":10}]', '', '[{   \"TargetSpaceMapId\": 91,   \"Position\": [18700, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 93,   \"Position\": [1800, 11300],   \"TargetPosition\": [1600,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(93, '5-3', '[{\"ShipId\":114,\"Amount\":10},{\"ShipId\":111,\"Amount\":10},{\"ShipId\":23,\"Amount\":10},{\"ShipId\":113,\"Amount\":10}]', '', '[{   \"TargetSpaceMapId\": 92,   \"Position\": [1800, 11300],   \"TargetPosition\": [1600,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 16,   \"Position\": [10000,6300],   \"TargetPosition\": [21800,11900],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(101, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(102, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(103, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(104, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(105, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(106, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(107, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(108, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(109, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(110, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(111, 'JP', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(112, 'UBA', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(113, 'UBA', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(114, 'UBA', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(115, 'UBA', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(116, 'UBA', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(117, 'UBA', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(118, 'UBA', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(119, 'UBA', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(120, 'UBA', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(121, 'UBA', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(150, 'R-Zone 1', '[{\"ShipId\":114,\"Amount\":10},{\"ShipId\":111,\"Amount\":10},{\"ShipId\":23,\"Amount\":10},{\"ShipId\":113,\"Amount\":10}]', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(151, 'R-Zone 2', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(152, 'R-Zone 3', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(200, 'LoW', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(201, 'SC-1', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(202, 'SC-2', '', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10300,6300],   \"TargetPosition\": [21300,13400],   \"GraphicId\": 4,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0);
INSERT INTO `server_maps` (`mapID`, `name`, `npcs`, `stations`, `portals`, `collectables`, `options`, `factionID`) VALUES
(224, 'Battle Royal', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(306, '1-BL', '[{   \"ShipId\": 213,   \"Amount\":16},{   \"ShipId\": 214,   \"Amount\":15},{   \"ShipId\": 215,   \"Amount\":15},{   \"ShipId\": 216,   \"Amount\":2}]', '', '[{   \"TargetSpaceMapId\": 2,   \"Position\": [18500, 11500],   \"TargetPosition\": [1900, 2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(307, '2-BL', '[{   \"ShipId\": 213,   \"Amount\":16},{   \"ShipId\": 214,   \"Amount\":15},{   \"ShipId\": 215,   \"Amount\":15},{   \"ShipId\": 216,   \"Amount\":2}]', '', '[{   \"TargetSpaceMapId\": 5,   \"Position\": [18700, 1300],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(308, '3-BL', '[{   \"ShipId\": 213,   \"Amount\":16},{   \"ShipId\": 214,   \"Amount\":15},{   \"ShipId\": 215,   \"Amount\":15},{   \"ShipId\": 216,   \"Amount\":2}]', '', '[{   \"TargetSpaceMapId\": 10,   \"Position\": [1800, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_news`
--

CREATE TABLE `server_news` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `news` varchar(255) DEFAULT NULL,
  `urlNotice` varchar(255) DEFAULT NULL,
  `nameButton` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `server_news`
--

INSERT INTO `server_news` (`id`, `image`, `title`, `news`, `urlNotice`, `nameButton`) VALUES
(1, '/news/cyborg.png', 'Cyborg is now available.', '<br>Test it out.', NULL, NULL),
(2, '/news/pusat_plus.png', 'Pusat-Plus', '<br>Take this ship now.', NULL, NULL),
(3, '/news/event-deal-stellar2019-5.png', 'Cyborg Strarter pack', '<br><br>Buy this pack now.', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_ships`
--

CREATE TABLE `server_ships` (
  `id` int(11) NOT NULL,
  `shipID` int(11) NOT NULL,
  `baseShipId` int(11) NOT NULL,
  `lootID` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `health` int(11) NOT NULL DEFAULT 0,
  `shield` int(11) NOT NULL DEFAULT 0,
  `speed` int(11) NOT NULL DEFAULT 300,
  `lasers` int(11) NOT NULL DEFAULT 1,
  `generators` int(11) NOT NULL DEFAULT 1,
  `cargo` int(11) NOT NULL DEFAULT 100,
  `aggressive` tinyint(1) NOT NULL DEFAULT 0,
  `damage` int(11) NOT NULL DEFAULT 20,
  `respawnable` tinyint(1) NOT NULL,
  `reward` varchar(2048) COLLATE utf8_bin NOT NULL DEFAULT '{"Experience":0,"Honor":0,"Credits":0,"Uridium":0,"EC":0}',
  `isdesign` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- A tábla adatainak kiíratása `server_ships`
--

INSERT INTO `server_ships` (`id`, `shipID`, `baseShipId`, `lootID`, `name`, `health`, `shield`, `speed`, `lasers`, `generators`, `cargo`, `aggressive`, `damage`, `respawnable`, `reward`, `isdesign`) VALUES
(47, 1, 1, 'ship_phoenix', 'Phoenix', 4000, 0, 320, 1, 1, 100, 0, 0, 0, '{\"Experience\":100,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 0),
(48, 2, 2, 'ship_yamato', 'Yamato', 8000, 0, 260, 8, 12, 1000, 0, 0, 0, '{\"Experience\":200,\"Honor\":2,\"Credits\":0,\"Uridium\":0}', 0),
(49, 3, 3, 'ship_leonov', 'Leonov', 128000, 0, 380, 6, 6, 1000, 0, 0, 0, '{\"Experience\":1200,\"Honor\":120,\"Credits\":0,\"Uridium\":0}', 0),
(50, 4, 4, 'ship_defcom', 'Defcom', 16000, 0, 280, 12, 8, 800, 0, 0, 0, '{\"Experience\":400,\"Honor\":4,\"Credits\":0,\"Uridium\":0}', 0),
(51, 5, 5, 'ship_liberator', 'Liberator', 16000, 0, 330, 4, 6, 400, 0, 0, 0, '{\"Experience\":1600,\"Honor\":16,\"Credits\":0,\"Uridium\":0}', 0),
(52, 6, 6, 'ship_piranha', 'Piranha', 164000, 0, 360, 6, 8, 600, 0, 0, 0, '{\"Experience\":3200,\"Honor\":32,\"Credits\":0,\"Uridium\":0}', 0),
(53, 7, 7, 'ship_nostromo', 'Nostromo', 128000, 0, 340, 7, 10, 700, 0, 0, 0, '{\"Experience\":6400,\"Honor\":64,\"Credits\":0,\"Uridium\":0}', 0),
(54, 8, 8, 'ship_vengeance', 'Vengeance', 280000, 0, 380, 10, 10, 1000, 0, 0, 0, '{\"Experience\":12800,\"Honor\":128,\"Credits\":0,\"Uridium\":0}', 0),
(55, 9, 9, 'ship_bigboy', 'Bigboy', 260000, 0, 260, 8, 15, 700, 0, 0, 0, '{\"Experience\":25600,\"Honor\":256,\"Credits\":0,\"Uridium\":0}', 0),
(56, 10, 10, 'ship_goliath', 'Goliath', 356000, 0, 300, 15, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":5}', 0),
(57, 12, 0, 'pet', 'P.E.T. Level 1-3', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":0,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 0),
(58, 13, 0, 'pet', 'P.E.T. Red', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":0,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 0),
(59, 15, 0, 'pet', 'P.E.T. Frozen', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":0,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 0),
(60, 16, 8, 'ship_vengeance_design_adept', 'Adept', 280000, 0, 380, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(61, 17, 8, 'ship_vengeance_design_corsair', 'Corsair', 280000, 0, 380, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(62, 18, 8, 'ship_vengeance_design_lightning', 'Lightning', 280000, 0, 380, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(63, 19, 10, 'ship_goliath_design_jade', 'Jade +10DMG+25HP\r\n\r\n', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(64, 20, 0, 'ship_admin', 'Ufo', 256000, 0, 1000, 0, 0, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(65, 22, 0, 'pet', 'P.E.T. Normal', 0, 50000, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":5}', 0),
(66, 49, 49, 'ship_aegis', 'Aegis', 375000, 0, 300, 10, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(67, 52, 10, 'ship_goliath_design_amber', 'Amber', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(68, 53, 10, 'ship_goliath_design_crimson', 'Crimson', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(69, 54, 10, 'ship_goliath_design_sapphire', 'Sapphire', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(70, 56, 10, 'ship_goliath_design_enforcer', 'Enforcer', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(71, 57, 10, 'ship_goliath_design_independence', 'G-Burn', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(72, 58, 8, 'ship_vengeance_design_revenge', 'Revenge', 280000, 0, 380, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(73, 59, 10, 'ship_goliath_design_bastion', 'Bastion', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(74, 60, 8, 'ship_vengeance_design_avenger', 'Avenger', 280000, 0, 380, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(75, 14, 0, 'pet', 'P.E.T. Green', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":5}', 0),
(76, 62, 10, 'ship_goliath_design_exalted', 'Exalted', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(77, 63, 10, 'ship_goliath_design_solace', 'Solace', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(78, 64, 10, 'ship_goliath_design_diminisher', 'Diminisher', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(79, 65, 10, 'ship_goliath_design_spectrum', 'Spectrum', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(80, 66, 10, 'ship_goliath_design_sentinel', 'Sentinel', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(81, 67, 10, 'ship_goliath_design_venom', 'Venom', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(82, 68, 10, 'ship_goliath_design_ignite', 'Ignite', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(83, 69, 69, 'ship_citadel', 'Citadel', 650000, 0, 240, 7, 20, 4000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(84, 70, 70, 'ship_spearhead', 'Spearhead', 200000, 0, 370, 5, 12, 500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(85, 130, 130, 'ship_vengeance_design_pusat', 'Pusat', 256000, 0, 360, 16, 12, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(86, 86, 10, 'ship_goliath_design_kick', 'Kick', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(87, 87, 10, 'ship_goliath_design_referee', 'Referee', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(88, 88, 10, 'ship_goliath_design_goal', 'Goal', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(89, 98, 98, 'ship_police', 'PoliceShip', 50000000, 0, 1000, 20, 20, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(90, 109, 10, 'ship_goliath_design_saturn', 'Saturn', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(91, 110, 10, 'ship_goliath_design_centaur', 'Centaur', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(92, 61, 10, 'ship_goliath_design_veteran', 'Veteran', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(93, 140, 10, 'ship_goliath_design_vanquisher', 'VanquisherMMO', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(94, 141, 10, 'ship_goliath_design_sovereign', 'VanquisherEIC', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(95, 142, 10, 'ship_goliath_design_peacemaker', 'VanquisherVRU', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(96, 150, 150, 'ship_nostromo_design_diplomat', 'Nostromo Diplomat', 220000, 0, 340, 7, 10, 700, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(97, 151, 151, 'ship_nostromo_design_envoy', 'Nostromo Envoy', 220000, 0, 340, 7, 10, 700, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(98, 152, 152, 'ship_nostromo_design_ambassador', 'Nostromo Ambassador', 220000, 0, 340, 7, 10, 700, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(99, 153, 10, 'ship_goliath_design_razer', 'Razer', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(100, 154, 154, 'ship_nostromo_design_nostromo-razer', 'Nostromo Razer', 220000, 0, 340, 7, 10, 700, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(101, 155, 10, 'ship_goliath_design_turkish', 'Champion-Turkish', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(102, 156, 156, 'ship_g-surgeon', 'Surgeon', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(103, 157, 157, 'ship_aegis_design_aegis-elite', 'Aegis Veteran', 275000, 0, 300, 10, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(104, 158, 158, 'ship_aegis_design_aegis-superelite', 'Aegis Super Elite', 275000, 0, 300, 10, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(105, 159, 159, 'ship_citadel_design_citadel-elite', 'Citadel Veteran', 650000, 0, 240, 7, 20, 4000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(106, 160, 160, 'ship_citadel_design_citadel-superelite', 'Citadel Super Elite', 650000, 0, 240, 7, 20, 4000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(107, 161, 161, 'ship_spearhead_design_spearhead-elite', 'Spearhead Veteran', 200000, 0, 370, 5, 12, 500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(108, 162, 162, 'ship_spearhead_design_spearhead-superelite', 'Spearhead Super Elite', 200000, 0, 370, 5, 12, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(109, 442, 0, 'spaceball_summer', '..::{Spaceball}::..', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(110, 443, 0, 'spaceball_winter', '..::{Spaceball}::..', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(111, 444, 0, 'spaceball_soccer', '..::{Spaceball}::..', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(112, 79, 0, 'ship79', '-=[ Kristallon ]=-', 800000, 600000, 200, 1, 1, 100, 0, 5000, 1, '{\"Experience\":102400,\"Honor\":6144,\"Credits\":2457600,\"Uridium\":2560}', 0),
(113, 78, 0, 'ship78', '-=[ Kristallin ]=-', 100000, 80000, 300, 1, 1, 100, 1, 1200, 1, '{\"Experience\":12800,\"Honor\":768,\"Credits\":76800,\"Uridium\":320}', 0),
(114, 35, 0, 'ship35', '..::{ Boss Kristallon }::..', 1600000, 1200000, 250, 1, 1, 100, 0, 20000, 1, '{\"Experience\":409600,\"Honor\":12288,\"Credits\":9830400,\"Uridium\":10240}', 0),
(115, 29, 0, 'ship29', '..::{ Boss Kristallin }::..', 400000, 320000, 300, 1, 1, 100, 1, 4800, 1, '{\"Experience\":51200,\"Honor\":3072,\"Credits\":307200,\"Uridium\":1280}', 0),
(116, 85, 0, 'ship85', '..::{ StreuneR}::..', 80000, 60000, 200, 1, 1, 100, 0, 3000, 1, '{\"Experience\":12000,\"Honor\":720,\"Credits\":72000,\"Uridium\":300}', 0),
(117, 99, 0, 'ship99', '..::{ Deyeks}::..', 700000, 500000, 400, 1, 1, 100, 1, 15000, 1, '{\"Experience\":11200,\"Honor\":1448,\"Credits\":512000,\"Uridium\":3800}', 0),
(118, 118, 0, 'ship118', '..::{ Boss Curcubitor }::..', 6200000, 6200000, 300, 1, 1, 0, 0, 17000, 1, '{\"Experience\":500120,\"Honor\":10000,\"Credits\":2500000,\"Uridium\":14000}', 0),
(119, 80, 0, 'ship80', '..::{Cubikon}::..', 1600000, 1200000, 0, 2, 2, 100, 0, 15000, 1, '{\"Experience\":1024000,\"Honor\":18384,\"Credits\":3500000,\"Uridium\":20480}', 0),
(120, 116, 0, 'ship116', '..::{Stroner}::..', 1500000, 1200000, 180, 2, 2, 100, 0, 18000, 1, '{\"Experience\":710020,\"Honor\":15500,\"Credits\":2300000,\"Uridium\":8500}', 0),
(121, 103, 0, 'ship103', '..::{Ice}::..', 1000000, 500000, 430, 2, 2, 100, 1, 5000, 1, '{\"Experience\":452000,\"Honor\":6400,\"Credits\":250000,\"Uridium\":3360}', 0),
(122, 107, 0, 'ship107', 'COVID-19[MUTATED]', 50000, 30000, 650, 5, 1, 1, 1, 4500, 1, '{\"Experience\":512000,\"Honor\":1012,\"Credits\":51002,\"Uridium\":125}', 0),
(123, 246, 246, 'ship_hammerclaw', 'hammerclaw', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(124, 900, 900, 'mimesis', 'Mimesis', 386000, 0, 300, 14, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(125, 901, 901, 'mimesis_design_carbonite', 'Mimesis-Carbonite', 386000, 0, 300, 14, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(126, 1000, 1000, 'tartarus', 'tartarus', 360000, 0, 300, 14, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(127, 1001, 1001, 'ship_tartarus_design_tartarus-epion', 'tartarus-epion', 360000, 0, 300, 14, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(128, 1002, 1002, 'ship_tartarus_design_tartarus-osiris', 'tartarus-osiris', 360000, 0, 300, 14, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(129, 1003, 1003, 'ship_tartarus_design_tartarus-smite', 'tartarus-smite', 360000, 0, 300, 14, 15, 1500, 0, 0, 0, '{\"Experience\":1200,\"Honor\":2,\"Credits\":512,\"Uridium\":20}', 0),
(130, 84, 0, 'ship84', '-=[ Streuner ]=-', 800, 400, 270, 1, 1, 100, 0, 20, 1, '{\"Experience\":3200,\"Honor\":16,\"Credits\":3200,\"Uridium\":8}', 0),
(131, 23, 0, 'ship23', '..::{ Boss Streuner }::..', 3200, 1600, 250, 1, 1, 100, 0, 80, 1, '{\"Experience\":12800,\"Honor\":64,\"Credits\":12800,\"Uridium\":32}', 0),
(132, 71, 0, 'ship71', '-=[ Lordakia ]=-', 2000, 2000, 300, 1, 1, 100, 1, 80, 1, '{\"Experience\":4800,\"Honor\":20,\"Credits\":4800,\"Uridium\":12}', 0),
(133, 73, 0, 'ship73', '-=[ Mordon ]=-', 20000, 10000, 80, 1, 1, 100, 1, 400, 1, '{\"Experience\":25600,\"Honor\":128,\"Credits\":51200,\"Uridium\":64}', 0),
(134, 31, 0, 'ship31', '-=[ Boss Mordon]=-', 80000, 40000, 80, 1, 1, 100, 1, 1600, 1, '{\"Experience\":102400,\"Honor\":512,\"Credits\":204800,\"Uridium\":256}', 0),
(135, 75, 0, 'ship75', '-=[ Saimon ]=-', 6000, 3000, 300, 1, 1, 100, 1, 200, 1, '{\"Experience\":9600,\"Honor\":48,\"Credits\":9600,\"Uridium\":24}', 0),
(136, 25, 0, 'ship25', '-=[ Boss Saimon ]=-', 24000, 12000, 300, 1, 1, 100, 1, 800, 1, '{\"Experience\":51200,\"Honor\":256,\"Credits\":51200,\"Uridium\":128}', 0),
(137, 72, 0, 'ship72', '-=[ Devolarium ]=-', 100000, 100000, 150, 1, 1, 100, 1, 1200, 1, '{\"Experience\":51200,\"Honor\":256,\"Credits\":512400,\"Uridium\":188}', 0),
(138, 26, 0, 'ship26', '-=[ Boss Devolarium ]=-', 400000, 400000, 150, 1, 1, 100, 1, 4800, 1, '{\"Experience\":204800,\"Honor\":1024,\"Credits\":1638400,\"Uridium\":512}', 0),
(139, 34, 0, 'ship34', '-=[ Boss StreuneR ]=-', 80000, 60000, 200, 1, 1, 100, 1, 6000, 1, '{\"Experience\":102880,\"Honor\":512,\"Credits\":204800,\"Uridium\":256}', 0),
(140, 46, 0, 'ship46', '-=[ Boss-Sibelon ]=-', 800000, 800000, 100, 1, 1, 100, 1, 12000, 1, '{\"Experience\":409600,\"Honor\":2048,\"Credits\":3276800,\"Uridium\":1024}', 0),
(141, 27, 0, 'ship27', '..::( Boss Sibelonit )::..', 160000, 160000, 300, 1, 1, 100, 1, 4000, 1, '{\"Experience\":128000,\"Honor\":3840,\"Credits\":307200,\"Uridium\":960}', 0),
(142, 81, 0, 'ship81', '-=[ Protegit]=-', 50000, 40000, 500, 2, 2, 100, 1, 1400, 1, '{\"Experience\":51200,\"Honor\":256,\"Credits\":102400,\"Uridium\":128}', 0),
(143, 1005, 0, 'ship_yamato', 'Yamato', 260000, 0, 260, 8, 12, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(144, 1006, 0, 'ship_leonov', 'Leonov', 260000, 0, 380, 6, 6, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(145, 1007, 0, 'ship_defcom', 'Defcom', 250000, 0, 340, 12, 8, 800, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(146, 1008, 0, 'ship_liberator', 'Liberator', 116000, 0, 330, 4, 6, 400, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(147, 1009, 0, 'ship_piranha', 'Piranha', 164000, 0, 360, 6, 8, 600, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(148, 1010, 0, 'ship_nostromo', 'Nostromo', 220000, 0, 450, 7, 10, 700, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(149, 1011, 0, 'ship_vengeance', 'Vengeance', 280000, 0, 380, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(150, 1012, 0, 'ship_goliath', 'Goliath', 356000, 0, 300, 15, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(151, 1013, 10, 'ship_goliath_design_kick', 'Kick', 750000, 0, 450, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(152, 1014, 0, 'ship_goliath_design_referee', 'Referee', 750000, 0, 450, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(153, 1015, 0, 'ship_goliath_design_goal', 'Goal', 750000, 0, 450, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(154, 1016, 0, 'ship_vengeance_design_pusatborra', 'Pusat', 1250000, 0, 300, 16, 17, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(155, 1017, 0, 'ship_venom_design_venom-inferno borrar', 'Cyborg Inferno', 1250000, 0, 350, 18, 18, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(156, 1018, 0, 'ship_hammerclaw-lava borrar', 'hammerclaw-lava borrar', 1250000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(157, 1020, 0, 'mimesis_design_carbonite mirar', 'mimesis_design_carbonite', 1250000, 0, 300, 16, 17, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(158, 1021, 0, 'ship_goliath_design_enforcer', 'Enforcer', 750000, 0, 450, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(159, 1022, 0, 'ship_vengeance_design_lightning', 'Lightning', 1250000, 0, 450, 10, 10, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(160, 42, 0, 'ship42', '[ Uber Kristallin ]', 400000, 320000, 300, 1, 1, 100, 1, 9600, 1, '{\"Experience\":409600,\"Honor\":2048,\"Credits\":819200,\"Uridium\":1024}', 0),
(161, 45, 0, 'ship45', '[ Uber-Kristallon ]', 3200000, 2400000, 200, 1, 1, 100, 0, 40000, 1, ' {\"Experience\":3276800,\"Honor\":16384,\"Credits\":26214400,\"Uridium\":8192}', 0),
(162, 33, 0, 'ship33', '-=: Ice Meteorit :=-', 1600000, 1200000, 200, 1, 1, 100, 0, 2000, 1, '{\"Experience\":8000000,\"Honor\":40000,\"Credits\":24000000,\"Uridium\":14400}', 0),
(163, 47, 0, 'ship47', '[ Uber Sibelon ]', 1600000, 1600000, 100, 1, 1, 100, 0, 24000, 1, '{\"Experience\":819200,\"Honor\":4096,\"Credits\":6553600,\"Uridium\":2048}', 0),
(164, 83, 0, 'ship83', '[ Uber Kucurbium ]', 60000000, 60000000, 200, 1, 1, 100, 0, 75000, 1, '{\"Experience\":13107200,\"Honor\":522880,\"Credits\":23932160,\"Uridium\":70960}', 0),
(165, 500, 10, 'ship_goliath_design_gold', 'Goliath-Gold', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(166, 499, 10, 'ship_goliath_design_silver', 'Goliath-Silver', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(167, 498, 10, 'ship_goliath_design_bronze', 'Goliath-Bronze', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(168, 497, 156, 'surgeon-cicada borrar', 'borrar', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(169, 496, 10, 'ship_goliath_design_cbs-design', 'MYSTERIOUS', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(170, 11, 0, 'ship11', '-=[ DemaNeR ]=-', 512000, 256001, 400, 1, 1, 100, 1, 4850, 1, '{\"Experience\":409600,\"Honor\":4096,\"Credits\":3276800,\"Uridium\":2048}', 0),
(171, 126, 0, 'ship126', 'DemaNeR Freighter', 300000000, 300000000, 140, 1, 1, 100, 1, 15000, 1, '{\"Experience\":24000000,\"Honor\":240000,\"Credits\":60000000,\"Uridium\":240000}', 0),
(172, 127, 0, 'ship127', '-=[ Skoll ]=- ', 3000000, 2700000, 200, 1, 1, 100, 1, 30000, 1, '{\"Experience\":600000,\"Honor\":182000,\"Credits\":3000000,\"Uridium\":53500}', 0),
(173, 1004, 1000, 'ship_tartarus_design_tartarus-lava', 'tartarus-lava', 360000, 0, 300, 14, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(174, 261, 10, 'ship_solace_design_solace-asimov', 'Solace-Asimov', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(175, 262, 10, 'ship_solace_design_solace-argon', 'Solace-Argon', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(176, 263, 10, 'ship_solace_design_solace-blaze', 'Solace-Blaze', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(177, 264, 10, 'ship_solace_design_solace-borealis', 'Solace-Borealis', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(178, 340, 10, 'ship_solace_design_solace-ocean', 'Solace-Ocean', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(179, 341, 10, 'ship_solace_design_solace-poison', 'Solace-Poison', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(180, 342, 10, 'ship_solace_design_solace-tyrannos', 'Solace-Tyrannos', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(181, 281, 245, 'ship_cyborg_design_cyborg-infinite', 'Cyborg-Infinite', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(182, 249, 245, 'ship_cyborg_design_cyborg-lava', 'Cyborg-Lava', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(183, 273, 245, 'ship_cyborg_design_cyborg-carbonite', 'Cyborg-Carbonite', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(184, 274, 245, 'ship_cyborg_design_cyborg-firestar', 'Cyborg-Firestar', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(185, 486, 10, 'ship_spectrum_design_spectrum-dusklight', 'Spectrum-dusklight', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(186, 487, 10, 'ship_spectrum_design_spectrum-legend', 'Spectrum-Legend', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(187, 265, 10, 'ship_sentinel_design_sentinel-argon', 'Sentinel-Argon', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(188, 266, 10, 'ship_sentinel_design_sentinel-legend', 'Sentinel-Legend', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(189, 268, 10, 'ship_diminisher_design_diminisher-argon', 'Diminisher-Argon', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(190, 269, 10, 'ship_diminisher_design_diminisher-legend', 'Diminisher-Legend', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(191, 275, 245, 'ship_cyborg_design_cyborg-nobilis', 'Cyborg-Nobilis', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(192, 276, 245, 'ship_cyborg_design_cyborg-scourge', 'Cyborg-Scourge', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(193, 277, 245, 'ship_cyborg_design_cyborg-inferno', 'Cyborg-Inferno', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(194, 278, 245, 'ship_cyborg_design_cyborg-ullrin', 'Cyborg-Ullrin', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(195, 279, 245, 'ship_cyborg_design_cyborg-dusklight', 'Cyborg-Dusklight', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(196, 170, 10, 'ship_goliath_design_orion', 'Orion', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(197, 280, 245, 'ship_cyborg_design_cyborg-frozen', 'Cyborg-Frozen', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(198, 282, 245, 'ship_cyborg_design_cyborg-sunstorm', 'Cyborg-Sunstorm', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(199, 283, 10, 'ship_sentinel_design_sentinel-expo2016', 'Sentinel-Expo', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(200, 284, 10, 'ship_sentinel_design_sentinel-frost', 'Sentinel-Frozen se ve rara', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(201, 285, 10, 'ship_sentinel_design_sentinel-inferno', 'Sentinel-Inferno no se ve', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(202, 286, 10, 'ship_spectrum_design_spectrum-inferno', 'Spectrum-Inferno se ve rara', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(203, 287, 10, 'ship_spectrum_design_spectrum-frost', 'Spectrum-Frost se ve rara', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(204, 288, 10, 'ship_spectrum_design_spectrum-poison', 'Spectrum-Poison', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(205, 289, 10, 'ship_spectrum_design_spectrum-lava', 'Spectrum-Lava', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(206, 290, 10, 'ship_spectrum_design_spectrum-sandstorm', 'Spectrum-Sandstorm', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(207, 291, 10, 'ship_spectrum_design_spectrum-blaze', 'Spectrum-Blaze', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(208, 292, 10, 'ship_spectrum_design_spectrum-ocean', 'Spectrum-Ocean', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(209, 293, 10, 'ship_diminisher_design_diminisher-expo2016', 'Diminisher-Expo2016', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(210, 294, 10, 'ship_diminisher_design_diminisher-lava', 'Diminisher-Lava', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(211, 295, 295, 'ship_g_champion_design_g_champion_spain', 'Champion-Spain', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(212, 296, 296, 'ship_g-champion_design_g-champion-albania', 'Champion-Albania', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(213, 297, 297, 'ship_g-champion_design_g-champion-austria', 'Champion-Austria', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(214, 298, 298, 'ship_g-champion_design_g-champion-belgium', 'Champion-Belgium', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(215, 299, 299, 'ship_g-champion_design_g-champion-croatia', 'Champion-Croatia', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(216, 300, 300, 'ship_g-champion_design_g-champion-czech-republic', 'Champion-Czech-Republic', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(217, 301, 301, 'ship_g-champion_design_g-champion-england', 'Champion-England', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(218, 302, 302, 'ship_g-champion_design_g-champion-france', 'Champion-France', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(219, 303, 303, 'ship_g-champion_design_g-champion-germany', 'Champion-Germany', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(220, 304, 304, 'ship_g-champion_design_g-champion-iceland', 'Champion-Iceland', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(221, 305, 305, 'ship_g-champion_design_g-champion-italy', 'Champion-Italy', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(222, 306, 306, 'ship_g-champion_design_g-champion-northern-ireland', 'Champion-Northern-Ireland', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(223, 307, 307, 'ship_g-champion_design_g-champion-poland', 'Champion-Poland', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(224, 308, 308, 'ship_g-champion_design_g-champion-portugal', 'Champion-Portugal', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(225, 309, 309, 'ship_g-champion_design_g-champion-republic-of-ireland', 'Champion-Republic-Of-Ireland', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(226, 310, 310, 'ship_g-champion_design_g-champion-romania', 'Champion-Romania', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(227, 311, 311, 'ship_g-champion_design_g-champion-russia', 'Champion-Russia', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(228, 312, 312, 'ship_g-champion_design_g-champion-slovakia', 'Champion-Slovakia', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(229, 313, 313, 'ship_g-champion_design_g-champion-sweden', 'Champion-Sweden', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(230, 314, 314, 'ship_g-champion_design_g-champion-switzerland', 'Champion-Switzerland', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(231, 315, 315, 'ship_g-champion_design_g-champion-ukraine', 'Champion-Ukraine', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(232, 316, 316, 'ship_g-champion_design_g-champion-wales', 'Champion-Wales', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(233, 317, 317, 'ship_g-champion_design_g-champion-dusklight', 'Champion-Dusklight', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(234, 318, 10, 'ship_goliath_design_bronze', 'Goliath-Bronze', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(235, 319, 10, 'ship_goliath_design_silver', 'Goliath-Silver', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(236, 320, 10, 'ship_goliath_design_gold', 'Goliath-Gold', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(237, 321, 10, 'ship_goliath_design_iron', 'Goliath-Iron', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(238, 247, 247, 'ship_hammerclaw_design_hammerclaw-lava', 'Hammerclaw-Lava', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(239, 248, 248, 'ship_hammerclaw_design_hammerclaw-carbonite', 'Hammerclaw-Carbonite', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(240, 250, 250, 'ship_hammerclaw_design_hammerclaw-bane', 'Hammerclaw-Bane', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(241, 251, 251, 'ship_hammerclaw_design_hammerclaw-frozen', 'Hammerclaw-Frozen', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(242, 252, 252, 'ship_hammerclaw_design_hammerclaw-nobilis', 'Hammerclaw-Nobilis', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(243, 253, 253, 'ship_hammerclaw_design_hammerclaw-ullrin', 'Hammerclaw-Ullrin', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(244, 255, 245, 'ship_cyborg_design_cyborg-starscream', 'Cyborg-Starscream', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(245, 256, 245, 'ship_cyborg_design_cyborg-celestial', 'Cyborg-Celestial', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(246, 257, 245, 'ship_cyborg_design_cyborg-maelstrom', 'Cyborg-Maelstrom', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(247, 258, 245, 'ship_cyborg_design_cyborg-asimov', 'Cyborg-Asimov', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(248, 259, 245, 'ship_cyborg_design_cyborg-tyrannos', 'Cyborg-Tyrannos', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(249, 260, 10, 'ship_solace_design_solace-frost', 'Solace-Frost', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(250, 343, 10, 'ship_sentinel_design_sentinel-asimov', 'Sentinel-Asimov', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(251, 344, 10, 'ship_sentinel_design_sentinel-arios', 'Sentinel-Arios', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(252, 345, 10, 'ship_sentinel_design_sentinel-neikos', 'Sentinel-Neikos', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(253, 346, 10, 'ship_sentinel_design_sentinel-lava', 'Sentinel-Lava', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(254, 347, 10, 'ship_sentinel_design_sentinel-tyrannos', 'Sentinel-Tyrannos', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(255, 349, 10, 'ship_spectrum_design_spectrum-tyrannos', 'Spectrum-Tyrannos', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(256, 350, 10, 'ship_venom_design_venom-argon', 'Venom-Argon', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(257, 351, 10, 'ship_venom_design_venom-blaze', 'Venom-Blaze', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(258, 352, 10, 'ship_venom_design_venom-borealis', 'Venom-Borealis', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(259, 353, 10, 'ship_venom_design_venom-ocean', 'Venom-Ocean', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(260, 354, 10, 'ship_venom_design_venom-poison', 'Venom-Poison', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(261, 355, 245, 'ship_cyborg_design_cyborg-ocean', 'Cyborg-Ocean', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(262, 356, 245, 'ship_cyborg_design_cyborg-poison', 'Cyborg-Poison', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(263, 357, 245, 'ship_cyborg_design_cyborg-prometheus', 'Cyborg-Prometheus', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(264, 358, 245, 'ship_cyborg_design_cyborg-blaze', 'Cyborg-Blaze', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(265, 359, 10, 'ship_solace_design_solace-inferno', 'Solace-Inferno', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(266, 360, 10, 'ship_diminisher_design_diminisher-frost', 'Diminisher-Frost', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(267, 361, 156, 'ship_g-surgeon_design_g-surgeon-cicada', 'Surgeon-Cicada', 356000, 0, 300, 15, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(268, 362, 156, 'ship_g-surgeon_design_g-surgeon-locust', 'Surgeon-Locust', 356000, 0, 300, 15, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(269, 363, 363, 'ship_g-champion_design_g-champion-lava', 'Champion-Lava', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(270, 364, 364, 'ship_g-champion_design_g-champion-argon', 'Champion-Argon', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(271, 365, 365, 'ship_g-champion_design_g-champion-legend', 'G-Inferno', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(272, 366, 366, 'ship_g-champion_design_g-champion-tyrannos', 'Champion-Tyrannos', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(273, 367, 367, 'ship_hammerclaw_design_hammerclaw-tyrannos', 'Hammerclaw-Tyrannos', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(274, 368, 368, 'ship_hammerclaw_design_hammerclaw-prometheus', 'Hammerclaw-Prometheus', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(275, 369, 130, 'ship_pusat_design_pusat-blaze', 'Pusat-Blaze', 256000, 0, 360, 16, 12, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(276, 370, 130, 'ship_pusat_design_pusat-expo16', 'Pusat-Expo2016', 256000, 0, 360, 16, 12, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(277, 371, 130, 'ship_pusat_design_pusat-lava', 'Pusat-Lava', 256000, 0, 360, 16, 12, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(278, 372, 130, 'ship_pusat_design_pusat-legend', 'Pusat-Legend', 256000, 0, 360, 16, 12, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(279, 373, 130, 'ship_pusat_design_pusat-ocean', 'Pusat-Ocean', 256000, 0, 360, 16, 12, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(280, 374, 130, 'ship_pusat_design_pusat-poison', 'Pusat-Poison', 256000, 0, 360, 16, 12, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(281, 375, 130, 'ship_pusat_design_pusat-sandstorm', 'Pusat-SandStorm', 256000, 0, 360, 16, 12, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(282, 376, 10, 'ship_solace_design_solace-contagion', 'Solace-Contagion', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(283, 377, 10, 'ship_sentinel_design_sentinel-contagion', 'Sentinel-Contagion', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(284, 378, 10, 'ship_spectrum_design_spectrum-argon', 'Spectrum-Argon', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(285, 902, 900, 'mimesis-epion', 'mimesis-epion', 386000, 0, 300, 14, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(286, 903, 900, 'mimesis-nobilis', 'mimesis-nobilis', 386000, 0, 300, 14, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(287, 904, 900, 'mimesis-osiris', 'mimesis-osiris', 386000, 0, 300, 14, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(288, 905, 900, 'mimesis-smite', 'mimesis-smite', 386000, 0, 300, 14, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(289, 906, 900, 'mimesis-tyrannos', 'mimesis-tyrannos', 386000, 0, 300, 14, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(290, 245, 245, 'ship_cyborg', 'Cyborg', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(291, 804, 804, 'ship_hammerclaw_design_hammerclaw-tyrannos', 'Hammerclaw-Tyrannos', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(292, 122, 0, 'ship122', '[ Emperor-Kristallon ]', 14080000, 11100000, 350, 1, 1, 0, 0, 60000, 1, '{\"Experience\":7680000,\"Honor\":40960,\"Credits\":25000000,\"Uridium\":184320}', 0),
(293, 124, 0, 'ship124', '[ Emperor-Sibelon ]', 6400000, 6400000, 350, 1, 1, 0, 0, 35000, 1, '{\"Experience\":2048000,\"Honor\":30240,\"Credits\":7000000,\"Uridium\":130000}', 0),
(294, 119, 0, 'ship119', '..::{ Curcubitor }::..', 250000, 150000, 250, 1, 1, 0, 0, 2000, 1, '{\"Experience\":90000,\"Honor\":400,\"Credits\":82000,\"Uridium\":192}', 0),
(295, 123, 0, 'ship123', '[ Emperor-Lordakium ]', 9600000, 6400000, 350, 1, 1, 0, 0, 45000, 1, '{\"Experience\":1930000,\"Honor\":35440,\"Credits\":10000000,\"Uridium\":152880}', 0),
(296, 82, 0, 'ship82', '..::{ Kucurbium }::..', 5000000, 5000000, 200, 1, 1, 100, 0, 25000, 1, '{\"Experience\":1024000,\"Honor\":40120,\"Credits\":20000000,\"Uridium\":100000}', 0),
(297, 97, 0, 'ship97', '..::{ Ravager }::..', 300000, 200000, 340, 1, 1, 100, 1, 10000, 1, '{\"Experience\":250000,\"Honor\":3840,\"Credits\":800000,\"Uridium\":2560}', 0),
(298, 96, 0, 'ship96', '..::{ Hooligan }::..', 250000, 200000, 340, 1, 1, 100, 1, 10000, 1, '{\"Experience\":320000,\"Honor\":256,\"Credits\":1000000,\"Uridium\":512}', 0),
(299, 95, 0, 'ship95', '..::{ Convict }::..', 400000, 200000, 345, 1, 1, 100, 1, 11000, 1, '{\"Experience\":480000,\"Honor\":6000,\"Credits\":1760000,\"Uridium\":1200}', 0),
(300, 90, 0, 'ship90', '..::{ Century-Falcon }::..', 36000000, 27000000, 320, 1, 1, 100, 1, 66000, 1, '{\"Experience\":45000000,\"Honor\":655000,\"Credits\":66000000,\"Uridium\":360000}', 0),
(301, 91, 0, 'ship91', '..::{ Corsair }::..', 200000, 120000, 335, 1, 1, 100, 1, 8000, 1, '{\"Experience\":150000,\"Honor\":960,\"Credits\":400000,\"Uridium\":640}', 0),
(302, 92, 0, 'ship92', '..::{ Outcast }::..', 150000, 80000, 320, 1, 1, 100, 1, 5000, 1, '{\"Experience\":160000,\"Honor\":90,\"Credits\":400000,\"Uridium\":192}', 0),
(303, 93, 0, 'ship93', '..::{ Marauder }::..', 100000, 60000, 325, 1, 1, 100, 1, 4500, 1, '{\"Experience\":128000,\"Honor\":64,\"Credits\":240000,\"Uridium\":128}', 0),
(304, 94, 0, 'ship94', '..::{ Vagrant }::..', 40000, 40000, 345, 1, 1, 100, 1, 2500, 1, '{\"Experience\":24000,\"Honor\":32,\"Credits\":120000,\"Uridium\":64}', 0),
(305, 24, 0, 'ship24', '..::( Boss Lordakia )::..', 8000, 8000, 320, 1, 1, 100, 1, 320, 1, '{\"Experience\":256000,\"Honor\":128,\"Credits\":25600,\"Uridium\":64}', 0),
(306, 76, 0, 'ship76', '-=[ Sibelonit ]=-', 40000, 40000, 320, 1, 1, 100, 1, 1000, 1, '{\"Experience\":256000,\"Honor\":128,\"Credits\":102400,\"Uridium\":96}', 0),
(307, 77, 0, 'ship77', '-=[ Lordakium ]=-', 300000, 200000, 230, 1, 1, 100, 0, 4000, 1, '{\"Experience\":204800,\"Honor\":1024,\"Credits\":1638400,\"Uridium\":512}', 0),
(308, 28, 0, 'ship28', '..::( Boss Lordakium )::..', 1200000, 800000, 200, 1, 1, 100, 0, 16000, 1, '{\"Experience\":819200,\"Honor\":4096,\"Credits\":6553600,\"Uridium\":2048}', 0),
(309, 1100, 1100, 'ship_zephyr', 'Zephyr', 250000, 0, 300, 12, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(310, 1120, 1120, 'ship_berserker', 'Berserker', 500000, 0, 290, 5, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(311, 1121, 1120, 'ship_berserker-arios', 'Berserker-Arios', 500000, 0, 290, 5, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(312, 1122, 1120, 'ship_berserker-blaze', 'Berserker-Blaze', 500000, 0, 290, 5, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(313, 1123, 1120, 'ship_berserker-neikos', 'Berserker-Neikos', 500000, 0, 290, 5, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(314, 1124, 1120, 'ship_berserker-phantasm', 'Berserker-Phantasm', 500000, 0, 290, 5, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(315, 1130, 1130, 'ship_disruptor', 'Disruptor', 356000, 0, 300, 14, 14, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(316, 1131, 1130, 'ship_disruptor-arios', 'Disruptor-Arios', 356000, 0, 300, 14, 14, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(317, 1132, 1130, 'ship_disruptor-neikos', 'Disruptor-Neikos', 356000, 0, 300, 14, 14, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(318, 1133, 1130, 'ship_disruptor-tyrannos', 'Disruptor-Tyrannos', 356000, 0, 300, 14, 14, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(319, 1140, 1140, 'ship_solaris', 'Solaris', 377000, 0, 300, 15, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(320, 1141, 1140, 'ship_solaris-amor', 'Solaris-Amor', 377000, 0, 300, 15, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(321, 1142, 1140, 'ship_solaris-psyche', 'Solaris-Psyche', 377000, 0, 300, 15, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(322, 1150, 1150, 'centurion', 'Centurion', 365000, 0, 300, 16, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(323, 1151, 1150, 'ship_centurion-frost', 'Centurion-Frost', 365000, 0, 300, 16, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(324, 1152, 1150, 'centurion-ability', 'Centurion-Ability', 365000, 0, 300, 16, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(325, 1153, 1150, 'centurion-damage', 'Centurion-Damage', 365000, 0, 300, 16, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(326, 1154, 1150, 'centurion-hp', 'Centurion-Hp', 365000, 0, 300, 16, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(327, 1155, 1150, 'centurion-shield', 'Centurion-Shield', 365000, 0, 300, 16, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(328, 1156, 1150, 'centurion-speed', 'Centurion-Speed', 365000, 0, 320, 16, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(329, 1157, 1150, 'centurion-tyrannos', 'Centurion-Tyrannos', 365000, 0, 300, 16, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(330, 1165, 1165, 'ship_keres', 'Keres', 356000, 0, 300, 15, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(331, 1166, 1165, 'ship_keres-contagion', 'Keres-Contagion', 356000, 0, 300, 15, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(332, 1185, 1185, 'ship_hecate', 'Hecate', 377000, 0, 300, 15, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0);
INSERT INTO `server_ships` (`id`, `shipID`, `baseShipId`, `lootID`, `name`, `health`, `shield`, `speed`, `lasers`, `generators`, `cargo`, `aggressive`, `damage`, `respawnable`, `reward`, `isdesign`) VALUES
(333, 1186, 1185, 'ship_hecate_design_hecate-dusklight', 'Hecate-DuskLight', 377000, 0, 300, 15, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(334, 1187, 1185, 'ship_hecate_design_hecate-inferno', 'Hecate-Inferno', 377000, 0, 300, 15, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(335, 1188, 1185, 'ship_hecate_design_hecate-ullrin', 'Hecate-Ullrin', 377000, 0, 300, 15, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(336, 1189, 1185, 'ship_hecate_design_hecate-tyrannos', 'Hecate-Tyrannos', 377000, 0, 300, 15, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(337, 1190, 1185, 'ship_hecate_design_hecate-frost', 'Hecate-Frost', 377000, 0, 300, 15, 16, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(338, 36, 0, 'ship36', '[ Uber-Streuner ]', 6400, 3200, 160, 1, 1, 100, 1, 160, 1, '{\"Experience\":25600,\"Honor\":128,\"Credits\":25600,\"Uridium\":64}', 0),
(339, 37, 0, 'ship37', '[ Uber-Lordakia ]', 16000, 16000, 300, 1, 1, 100, 1, 640, 1, '{\"Experience\":51200,\"Honor\":256,\"Credits\":51200,\"Uridium\":128}', 0),
(340, 38, 0, 'ship38', '[ Uber-Saimon ]', 48000, 24000, 300, 1, 1, 100, 1, 1600, 1, '{\"Experience\":102400,\"Honor\":512,\"Credits\":102400,\"Uridium\":256}', 0),
(341, 43, 0, 'ship43', '[ Uber-Mordon ]', 160000, 80000, 120, 1, 1, 100, 1, 3200, 1, '{\"Experience\":204800,\"Honor\":1024,\"Credits\":409600,\"Uridium\":512}', 0),
(342, 39, 0, 'ship39', '[ Uber-Devolarium ]', 800000, 800000, 150, 1, 1, 100, 1, 9600, 1, '{\"Experience\":409600,\"Honor\":2048,\"Credits\":3276800,\"Uridium\":1024}', 0),
(343, 74, 0, 'ship74', '-=[ Sibelon ]=-', 200000, 200000, 100, 1, 1, 100, 0, 3000, 1, '{\"Experience\":102400,\"Honor\":512,\"Credits\":819200,\"Uridium\":256}', 0),
(344, 40, 0, 'ship40', '[ Uber-Sibelonit ]', 320000, 320000, 300, 1, 1, 100, 1, 8000, 1, '{\"Experience\":204800,\"Honor\":1024,\"Credits\":819200,\"Uridium\":768}', 0),
(345, 41, 0, 'ship41', '[ Uber-Lordakium ]', 2400000, 1600000, 200, 1, 1, 100, 0, 32000, 1, '{\"Experience\":1638400,\"Honor\":8192,\"Credits\":8192000,\"Uridium\":4096}', 0),
(346, 44, 0, 'ship44', '[ Uber-StreuneR ]', 320000, 240000, 200, 1, 1, 100, 1, 4000, 1, '{\"Experience\":550000,\"Honor\":512,\"Credits\":512000,\"Uridium\":428}', 0),
(347, 379, 10, 'ship_diminisher_design_diminisher-epion', 'Diminisher-Epion', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(348, 380, 10, 'ship_diminisher_design_diminisher-phantasm', 'Diminisher-Phantasm', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(349, 381, 10, 'ship_diminisher_design_diminisher-ullrin', 'Diminisher-Ullrin', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(350, 1300, 1300, 'ship_retiarus', 'Retiarus', 400000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(351, 1301, 1300, 'ship_retiarus-arios', 'Retiarus-Arios', 400000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(352, 1302, 1300, 'ship_retiarus-neikos', 'Retiarus-Neikos', 400000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(353, 382, 10, 'ship_diminisher_design_diminisher-smite', 'Diminisher-Smite', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(354, 383, 10, 'ship_diminisher_design_diminisher-osiris', 'Diminisher-Osiris', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(355, 393, 10, 'ship_sentinel_design_sentinel-epion', 'Sentinel-Epion', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(356, 394, 10, 'ship_sentinel_design_sentinel-harbinger', 'Sentinel-Harbinger', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(357, 395, 10, 'ship_sentinel_design_sentinel-osiris', 'Sentinel-Osiris', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(358, 396, 10, 'ship_sentinel_design_sentinel-smite', 'Sentinel-smite', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(359, 397, 10, 'ship_sentinel_design_sentinel-ullrin', 'Sentinel-ullrin', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(360, 410, 10, 'ship_solace_design_solace-epion', 'Solace-Epion', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(361, 411, 10, 'ship_solace_design_solace-nobilis', 'Solace-Nobilis', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(362, 412, 10, 'ship_solace_design_solace-osiris', 'Solace-Osiris', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(363, 413, 10, 'ship_solace_design_solace-smite', 'Solace-Smite', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(364, 414, 10, 'ship_solace_design_solace-ullrin', 'Solace-Ullrin', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(365, 424, 10, 'ship_spectrum_design_spectrum-ace', 'Spectrum-Ace', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(366, 425, 10, 'ship_spectrum_design_spectrum-epion', 'Spectrum-Epion', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(367, 426, 10, 'ship_spectrum_design_spectrum-osiris', 'Spectrum-Osiris', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(368, 427, 10, 'ship_spectrum_design_spectrum-smite', 'Spectrum-Smite', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(369, 450, 10, 'ship_goliath_design_enforcer2', 'Enforcer-Bonus', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(370, 451, 10, 'ship_goliath_design_bastion2', 'Bastion-Bonus', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(371, 452, 245, 'ship_cyborg_design_cyborg-argon', 'Cyborg-Argon', 356000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(372, 453, 10, 'ship_diminisher_design_diminisher-carbonite', 'Diminisher-Carbonite', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(373, 1191, 1185, 'ship_hecate_design_hecate-carbonite', 'Hecate-Carbonite', 377000, 0, 300, 15, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(374, 454, 130, 'ship_pusat_design_pusat-carbonite', 'Pusat-Carbonite', 280000, 0, 360, 16, 12, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(375, 398, 10, 'ship_sentinel_design_sentinel-carbonite', 'Sentinel-Carbonite', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(376, 415, 10, 'ship_solace_design_solace-carbonite', 'Solace-Carbonite', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(377, 428, 10, 'ship_spectrum_design_spectrum-carbonite', 'Spectrum-Carbonite', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(378, 1125, 1120, 'ship_berserker-carbonite', 'Berserker-Carbonite', 500000, 0, 290, 5, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(379, 1400, 1400, 'ship_orcus', 'Orcus', 385000, 0, 300, 16, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(380, 21, 0, 'ship21', '-=[ UFONIT ]=-', 60000, 50000, 700, 1, 1, 0, 0, 300, 1, '{\"Experience\":400,\"Honor\":104,\"Credits\":68,\"Uridium\":35}', 0),
(381, 32, 0, 'ship32', '-=[ SANTA-BOT ]=-', 550000, 700000, 280, 1, 1, 0, 1, 1800, 1, '{\"Experience\":170,\"Honor\":110,\"Credits\":202,\"Uridium\":15}', 0),
(382, 700, 0, 'ship700', '-=[ SANTA-BOT ]=-', 740000, 980000, 285, 1, 1, 0, 1, 2300, 1, '{\"Experience\":170,\"Honor\":110,\"Credits\":202,\"Uridium\":15}', 0),
(383, 701, 0, 'ship701', '-=[ SANTA-BOT ]=-', 1260000, 1550000, 287, 1, 1, 0, 1, 3400, 1, '{\"Experience\":170,\"Honor\":110,\"Credits\":202,\"Uridium\":15}', 0),
(384, 702, 0, 'ship702', '-=[ SANTA-BOT ]=-', 2150000, 1300000, 299, 1, 1, 0, 1, 5500, 1, '{\"Experience\":170,\"Honor\":110,\"Credits\":202,\"Uridium\":15}', 0),
(385, 703, 0, 'ship703', '-=[ SANTA-BOT ]=-', 3080000, 3289000, 300, 1, 1, 0, 1, 6450, 1, '{\"Experience\":170,\"Honor\":110,\"Credits\":202,\"Uridium\":15}', 0),
(386, 704, 0, 'ship704', '-=[ SANTA-BOT ]=-', 4130000, 4300000, 301, 1, 1, 0, 1, 7000, 1, '{\"Experience\":170,\"Honor\":110,\"Credits\":202,\"Uridium\":15}', 0),
(387, 705, 0, 'ship705', '-=[ SANTA-BOT ]=-', 5530000, 7600000, 305, 1, 1, 0, 1, 8700, 1, '{\"Experience\":170,\"Honor\":110,\"Credits\":202,\"Uridium\":15}', 0),
(388, 213, 0, 'black_light1', 'Impulse II', 1200000, 750000, 450, 1, 1, 0, 1, 12000, 1, '{\"Experience\":440000,\"Honor\":1600,\"Credits\":1600000,\"Uridium\":360}', 0),
(389, 384, 10, 'ship_diminisher-prometheus', 'Diminisher-Prometheus', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":112000,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(390, 214, 0, 'black_light2', 'Attend XI', 9000000, 4800000, 150, 1, 1, 0, 1, 17000, 1, '{\"Experience\":2800000,\"Honor\":6000,\"Credits\":8000000,\"Uridium\":2200}', 0),
(391, 215, 0, 'black_light3', 'Invoke XVI', 36000000, 35000000, 0, 1, 1, 0, 1, 30000, 1, '{\"Experience\":7000000,\"Honor\":160000,\"Credits\":950000,\"Uridium\":10000}', 0),
(392, 216, 0, 'black_light4', 'Mindfire Behemoth', 135000000, 135000000, 0, 1, 1, 0, 1, 145000, 1, '{\"Experience\":8000000,\"Honor\":400000,\"Credits\":16000000,\"Uridium\":40000}', 0),
(393, 1401, 1400, 'ship_orcus-nobilis', 'Orcus-Nobilis', 385000, 0, 300, 16, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(394, 1402, 1400, 'ship_orcus-frost', 'Orcus-Frost', 385000, 0, 300, 16, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(395, 1403, 1400, 'ship_orcus-harbinger', 'Orcus-Harbinger', 385000, 0, 300, 16, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(396, 1404, 1400, 'ship_orcus-seraph', 'Orcus-Seraph', 385000, 0, 300, 17, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(397, 416, 10, 'ship_solace-prometheus', 'Solace-Prometheus', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(398, 1303, 1300, 'ship_retiarus-frost', 'Retiarus-Frost', 400000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(399, 455, 245, 'ship_cyborg_design_cyborg-seraph', 'Cyborg-Seraph', 356000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(400, 456, 245, 'ship_cyborg_design_cyborg-epion', 'Cyborg-Epion', 356000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(401, 457, 245, 'ship_cyborg_design_cyborg-osiris', 'Cyborg-Osiris', 356000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(402, 458, 245, 'ship_cyborg_design_cyborg-smite', 'Cyborg-Smite', 356000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(403, 1126, 1120, 'ship_berserker-amor', 'Berserker-Amor', 500000, 0, 290, 5, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(404, 1127, 1120, 'ship_berserker-psyche', 'Berserker-Psyche', 500000, 0, 290, 5, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(405, 114, 0, 'ship114', '..::{ Annihilator }::..', 300000, 200000, 350, 1, 1, 100, 1, 12000, 1, '{\"Experience\":600000,\"Honor\":1024,\"Credits\":2000000,\"Uridium\":520}', 0),
(406, 111, 0, 'ship111', '..::{ Interceptor }::..', 60000, 40000, 350, 1, 1, 100, 1, 500, 1, '{\"Experience\":60000,\"Honor\":320,\"Credits\":125000,\"Uridium\":160}', 0),
(407, 113, 0, 'ship113', '..::{ Saboteur }::..', 200000, 150000, 400, 1, 1, 100, 0, 4000, 1, '{\"Experience\":180000,\"Honor\":576,\"Credits\":1000000,\"Uridium\":360}', 0),
(408, 112, 0, 'ship112', '.::{ Barracuda }::..', 180000, 100000, 430, 1, 1, 100, 1, 6000, 1, '{\"Experience\":120000,\"Honor\":448,\"Credits\":720000,\"Uridium\":200}', 0),
(409, 115, 0, 'ship115', '..::{ Battleray }::..', 330000, 260000, 450, 1, 1, 0, 0, 15000, 1, '{\"Experience\":666400,\"Honor\":1280,\"Credits\":5800000,\"Uridium\":928}', 0),
(410, 1990, 10, 'ship_goliath_design_inferno', 'Inferno', 356000, 0, 360, 20, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(411, 2500, 10, 'ship_solace-dark-white', 'Solace-Black', 356000, 0, 360, 50, 50, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(412, 2502, 10, 'ship_solace-dark-blue', 'Solace-DarkBlue', 356000, 0, 360, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(413, 2501, 10, 'ship_solace-dark-purple', 'Solace-Purple', 356000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(414, 5000, 10, 'ship_solace-custom1', 'Solace-Yellow', 356000, 0, 300, 20, 20, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(415, 5041, 10, 'ship_g-champion-blue', 'Champion-Blue', 356000, 0, 300, 15, 15, 100, 0, 20, 0, '{\"Experience\":0,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 1),
(416, 5042, 10, 'ship_g-champion-lightblue', 'Champion-LightBlue', 356000, 0, 300, 15, 15, 100, 0, 20, 0, '{\"Experience\":0,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 0),
(417, 1409, 1400, 'ship_orcus-celestial', 'Orcus Celestial', 385000, 0, 300, 16, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(418, 173, 10, 'ship_sentinel_design_sentinel-expo2016', 'Sentinel-Expo2016', 356000, 0, 300, 15, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(419, 1405, 1400, 'ship_orcus-ullrin', 'Orcus ullrin', 385000, 0, 300, 16, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `shop_category`
--

CREATE TABLE `shop_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `shop_category`
--

INSERT INTO `shop_category` (`id`, `category`, `active`) VALUES
(1, 'Ship', '1'),
(2, 'Drone', '1'),
(3, 'Drone-Formation', '0'),
(4, 'Weapon', '1'),
(5, 'Laser ammo', '1'),
(6, 'Special ammo', '1'),
(7, 'Custom ammunition', '0'),
(8, 'Rocket ammo', '1'),
(9, 'Extra', '1'),
(10, 'PET', '1'),
(11, 'Generator', '1'),
(12, 'Solace', '0'),
(13, 'Spectrum', '0'),
(14, 'Venom', '0'),
(15, 'Diminisher', '0'),
(16, 'Sentinel', '0'),
(17, 'Cyborg', '0'),
(18, 'Hammerclaw', '0'),
(19, 'Pusat', '0'),
(20, 'Vengeance', '1'),
(21, 'Goliath', '1'),
(22, 'Designs', '1'),
(145, 'G-Champion', '0'),
(146, 'Berserker', '0'),
(147, 'Hecate', '0'),
(148, 'Orcus', '0'),
(149, 'Booster', '1'),
(150, 'Centurion', '0'),
(151, 'Module', '0'),
(152, 'Orcus', '0'),
(153, 'Retiarus', '0'),
(154, 'Solaris', '0'),
(155, 'Surgeon', '0'),
(156, 'Tartarus', '0');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `shop_items`
--

CREATE TABLE `shop_items` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `information` longtext NOT NULL,
  `price` bigint(20) NOT NULL,
  `priceType` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL,
  `shipId` int(11) NOT NULL,
  `design_name` varchar(255) NOT NULL,
  `moduleId` varchar(255) NOT NULL,
  `moduleType` varchar(255) NOT NULL,
  `boosterId` varchar(255) NOT NULL,
  `boosterType` varchar(255) NOT NULL,
  `boosterDuration` varchar(255) NOT NULL,
  `laserName` varchar(255) NOT NULL,
  `petName` varchar(255) NOT NULL,
  `skillTree` varchar(255) NOT NULL,
  `droneName` varchar(255) NOT NULL,
  `ammoId` varchar(255) NOT NULL,
  `typeKey` varchar(255) NOT NULL,
  `petDesign` varchar(255) NOT NULL,
  `petFuel` varchar(255) NOT NULL,
  `petModule` varchar(255) NOT NULL,
  `FormationName` varchar(255) NOT NULL,
  `nameBootyKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `shop_items`
--

INSERT INTO `shop_items` (`id`, `category`, `name`, `information`, `price`, `priceType`, `amount`, `image`, `active`, `shipId`, `design_name`, `moduleId`, `moduleType`, `boosterId`, `boosterType`, `boosterDuration`, `laserName`, `petName`, `skillTree`, `droneName`, `ammoId`, `typeKey`, `petDesign`, `petFuel`, `petModule`, `FormationName`, `nameBootyKey`) VALUES
(1, 'Drone', 'Apis', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 37, 190);display: inline-block;\">45 parts to buy, or booty, also available in a box.Its a part for build a Apis drone.Found in silver boty boxes.</p>', 24500, 'uridium', '1', 'do_img/global/items/drone/apis-5_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', 'apis', '', '', '', '', '', '', ''),
(2, 'Drone', 'Zeus', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 37, 190);display: inline-block;\">45 parts to buy, or booty, also available in a box.Its a part for build a Zeus drone.Found in silver boty boxes</p>', 34500, 'uridium', '1', 'do_img/global/items/drone/zeus-5_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', 'zeus', '', '', '', '', '', '', ''),
(3, 'Extra', 'Logdisk', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Parts for research pilots points.</p>', 250, 'uridium', '1', '/do_img/global/items/resource/logfile_100x100.png', '1', 0, '', '', '', '', '', '', '', '', 'logdisks', '', '', '', '', '', '', '', ''),
(4, 'Extra', 'Logdisk', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Parts for research pilots points.</p>', 500000, 'credits', '1', '/do_img/global/items/resource/logfile_100x100.png', '1', 0, '', '', '', '', '', '', '', '', 'logdisks', '', '', '', '', '', '', '', ''),
(5, 'Extras', 'Logdisk', '', 5000000, 'credits', '1', '', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 'Extras', 'Logdisk', '', 5000000, 'credits', '1', '', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 'Extras', 'Logdisk', '', 5000000, 'credits', '1', '', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 'Extras', 'Logdisk', '', 5000000, 'credits', '1', '', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 'Drone', 'Havoc', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">20% Damage</p><p style=\"color: #ffffff; display: inline-block;\"<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">15% Hitpoints</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 212, 0);display: inline-block;\">Full Set</p> <p style=\"color: rgb(255, 212, 0);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box</p>', 650000, 'uridium', '1', 'do_img/global/items/drone/designs/havoc_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', 'havocCount', '', '', '', '', '', '', ''),
(10, 'Drone', 'Hercules', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 212, 0);display: inline-block;\">Full Set</p> <p style=\"color: rgb(255, 212, 0);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box</p>', 325000, 'uridium', '1', 'do_img/global/items/drone/designs/hercules_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', 'herculesCount', '', '', '', '', '', '', ''),
(11, 'Extras', 'Logdisk', '', 5000000, 'credits', '1', '', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 'Extras', 'Logdisk', '', 5000000, 'credits', '1', '', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 'Extras', 'Logdisk', '', 5000000, 'credits', '1', '', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, 'Extras', 'Logdisk', '', 5000000, 'credits', '1', '', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 'Module', 'Module HULM-1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Part for build base 1/2</p>', 15, 'event', '0', 'img/base/hulm-1_100x100.png', '1', 0, '', '2', '2', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, 'Module', 'Module DEFM-1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Part for build base 2/2</p>', 15, 'event', '0', 'img/base/defm-1_100x100.png', '1', 0, '', '3', '3', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, 'Module', 'Module REPM-1', 'Repair modules and base', 10, 'event', '0', 'do_img/global/items/module/repm-1_100x100.png', '0', 0, '', '4', '4', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(19, 'Module', 'Module HONM-1', 'Increases Honor points', 8, 'event', '0', 'do_img/global/items/module/honm-1_100x100.png', '0', 0, '', '10', '10', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(23, 'PET', 'P.E.T.', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\"> P.E.T 10\r\nThe P.E.T. will accompany your spaceship throughout the expanses of space, helping you out where it can.\r\n</p>', 50000, 'uridium', '0', '/do_img/global/items/pet/pet10_100x100.png', '1', 0, '', '', '', '', '', '', '', 'pet', '', '', '', '', '', '', '', '', ''),
(24, 'Module', 'Module DMGM-1', 'Increase damage', 8, 'event', '0', 'do_img/global/items/module/dmgm-1_100x100.png', '0', 0, '', '11', '11', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, 'Module', 'Module XPM-1', 'Damage: Increases experience points', 8, 'event', '0', 'do_img/global/items/module/xpm-1_100x100.png', '0', 0, '', '12', '12', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(26, 'Module', 'Module LTM-HR', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage: 58.500</p>', 105000, 'uridium', '0', 'img/base/ltm-hr_100x100.png', '1', 0, '', '5', '5', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, 'Module', 'Module LTM-MR', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage: 38.450</p>', 95000, 'uridium', '0', 'do_img/global/items/module/ltm-mr_100x100.png', '1', 0, '', '6', '6', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(28, 'Module', 'Module LTM-LR', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage: 29.850</p>', 85000, 'uridium', '0', 'do_img/global/items/module/ltm-lr_100x100.png', '1', 0, '', '7', '7', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(29, 'Module', 'Module RAM-MA', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage: 51.250</p>', 105000, 'uridium', '0', 'img/base/ram-ma_100x100.png', '1', 0, '', '8', '8', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(30, 'Module', 'Module RAM-LA', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage: 35.550</p>', 95000, 'uridium', '0', 'do_img/global/items/module/ram-la_100x100.png', '1', 0, '', '9', '9', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(31, 'Ship', 'Phoenix', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 4000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 1</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 1</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 320</p>', 0, 'credits', '0', 'do_img/global/items/ship/phoenix_100x100.png', '1', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(32, 'Ship', 'Yamato', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 8000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 8</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 12</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 320</p>', 16000, 'credits', '0', 'do_img/global/items/ship/yamato_100x100.png', '1', 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(33, 'Ship', 'Leonov', '<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 128.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 6</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 6</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 360</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">2x Damage: from x1 map to x4 map.</p>', 15000, 'uridium', '0', 'do_img/global/items/ship/leonov_100x100.png', '1', 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(34, 'Ship', 'Defcom', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 16000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 12</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 8</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 340</p>', 32000, 'credits', '0', 'do_img/global/items/ship/defcom_100x100.png', '1', 4, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(35, 'Ship', 'Liberator', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 116.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 4</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 6</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>', 40000, 'credits', '0', 'do_img/global/items/ship/liberator_100x100.png', '0', 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(36, 'Ship', 'Piranha', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 164.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 4</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 6</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>', 150000, 'credits', '0', 'do_img/global/items/ship/piranha_100x100.png', '1', 6, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(37, 'Ship', 'Nostromo', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 128.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 7</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 10</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 340</p>', 100000, 'credits', '0', 'do_img/global/items/ship/nostromo_100x100.png', '1', 7, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(38, 'Ship', 'Vengeance', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 280.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 10</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 10</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 380</p>', 30000, 'uridium', '0', 'do_img/global/items/ship/vengeance_100x100.png', '1', 8, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(39, 'Ship', 'Bigboy', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 260.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 8</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 260</p>', 200000, 'credits', '0', 'do_img/global/items/ship/bigboy_100x100.png', '1', 9, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(40, 'Ship', 'Goliath', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 50000, 'uridium', '0', 'do_img/global/items/ship/goliath_100x100.png', '1', 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(41, 'Ship', 'Spearhead', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 200.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 5</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 12</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 370</p>', 120000, 'uridium', '0', 'do_img/global/items/ship/spearhead-eic_100x100.png', '0', 70, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(42, 'Ship', 'Aegis', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 375.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 10</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 80000, 'uridium', '0', 'do_img/global/items/ship/aegis-eic_100x100.png', '1', 49, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(43, 'Ship', 'Citadel', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 650.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 7</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 20</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 240</p>', 500000, 'uridium', '0', 'do_img/global/items/ship/citadel_100x100.png', '0', 69, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(46, 'Ship', 'Cyborg', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 16</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 16</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 425000, 'uridium', '0', 'do_img/global/items/ship/cyborg_100x100.png', '0', 245, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(47, 'Ship', 'Mimesis', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 386.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 14</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 14</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/mimesis_100x100.png', '0', 900, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(48, 'Ship', 'Tartarus', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 360.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 14</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 200000, 'uridium', '0', 'do_img/global/items/tartarus_top.png', '0', 1000, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(49, 'Cyborg', 'Cyborg-Firestar', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-firestar_100x100.png', '1', 274, 'ship_cyborg_design_cyborg-firestar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(50, 'Cyborg', 'Cyborg-Sunstorm', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-sunstorm_100x100.png', '1', 282, 'ship_cyborg_design_cyborg-sunstorm', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(51, 'Cyborg', 'Cyborg-Maelstorm', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-maelstrom_100x100.png', '1', 257, 'ship_cyborg_design_cyborg-maelstrom', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(52, 'Cyborg', 'Cyborg-Celestial', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-celestial_100x100.png', '1', 256, 'ship_cyborg_design_cyborg-celestial', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(53, 'Cyborg', 'Cyborg-Starscream', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-starscream_100x100.png', '1', 255, 'ship_cyborg_design_cyborg-starscream', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(54, 'Cyborg', 'Cyborg-Frozen', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-frozen_100x100.png', '1', 280, 'ship_cyborg_design_cyborg-frozen', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(55, 'Cyborg', 'Cyborg-Prometheus', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-prometheus_100x100.png', '1', 357, 'ship_cyborg_design_cyborg-prometheus', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(56, 'Cyborg', 'Cyborg-Dusklight', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-dusklight_100x100.png', '1', 279, 'ship_cyborg_design_cyborg-dusklight', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(57, 'Cyborg', 'Cyborg-Scourge', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-scourge_100x100.png', '1', 276, 'ship_cyborg_design_cyborg-scourge', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(58, 'Cyborg', 'Cyborg-Ullrin', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-ullrin_100x100.png', '1', 278, 'ship_cyborg_design_cyborg-ullrin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(59, 'Cyborg', 'Cyborg-Blaze', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-blaze_100x100.png', '1', 358, 'ship_cyborg_design_cyborg-blaze', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(60, 'Cyborg', 'Cyborg-Ocean', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-ocean_100x100.png', '1', 355, 'ship_cyborg_design_cyborg-ocean', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(61, 'Cyborg', 'Cyborg-Poison', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">5%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-poison_100x100.png', '1', 356, 'ship_cyborg_design_cyborg-poison', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(62, 'Ship', 'Hammerclaw', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 377.500</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 12</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 14</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 310</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/hammerclaw_100x100.png', '0', 246, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(63, 'Hammerclaw', 'Hammerclaw-Ullrin', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/hammerclaw/design/hammerclaw-ullrin_100x100.png', '1', 253, 'ship_hammerclaw_design_hammerclaw-ullrin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(64, 'Hammerclaw', 'Hammerclaw-Frozen', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/hammerclaw/design/hammerclaw-frozen_100x100.png', '1', 251, 'ship_hammerclaw_design_hammerclaw-frozen', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(65, 'Hammerclaw', 'Hammerclaw-Bane', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/hammerclaw/design/hammerclaw-bane_100x100.png', '1', 250, 'ship_hammerclaw_design_hammerclaw-bane', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(66, 'Hammerclaw', 'Hammerclaw-Tyrannos', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/hammerclaw/design/hammerclaw-tyrannos_100x100.png', '1', 367, 'ship_hammerclaw_design_hammerclaw-tyrannos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(67, 'Solace', 'Solace-Argon', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-argon_100x100.png', '1', 262, 'ship_solace_design_solace-argon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(68, 'Solace', 'Solace-Blaze', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-blaze_100x100.png', '1', 263, 'ship_solace_design_solace-blaze', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(69, 'Solace', 'Solace-Borealis', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-borealis_100x100.png', '1', 264, 'ship_solace_design_solace-borealis', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(70, 'Solace', 'Solace-Ocean', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-ocean_100x100.png', '1', 340, 'ship_solace_design_solace-ocean', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(71, 'Solace', 'Solace-Poison', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-poison_100x100.png', '1', 341, 'ship_solace_design_solace-poison', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(72, 'Spectrum', 'Spectrum-Blaze', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-blaze_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-blaze', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(73, 'Spectrum', 'Spectrum-Ocean', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-ocean_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-ocean', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(74, 'Spectrum', 'Spectrum-Poison', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-poison_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-poison', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(75, 'Spectrum', 'Spectrum-Sandstorm', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-sandstorm_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-sandstorm', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(76, 'Spectrum', 'Spectrum-Legend', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 600000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-legend_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-legend', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(77, 'Spectrum', 'Spectrum-Dusklight', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-dusklight_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-dusklight', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(78, 'Designs', 'Spectrum-Argon', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-argon_100x100.png', '0', 378, 'ship_spectrum_design_spectrum-argon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(79, 'Sentinel', 'Sentinel-Argon\r\n', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-argon_100x100.png', '1', 265, 'ship_sentinel_design_sentinel-argon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(80, 'Sentinel', 'Sentinel-Expo2016', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-expo2016_100x100.png', '1', 173, 'ship_sentinel_design_sentinel-expo2016', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(81, 'Designs', 'Sentinel-Lava', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-lava_100x100.png', '1', 346, 'ship_sentinel_design_sentinel-lava', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(82, 'Sentinel', 'Sentinel-Tyrannos', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-tyrannos_100x100.png', '1', 347, 'ship_sentinel_design_sentinel-tyrannos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(83, 'Sentinel', 'Sentinel-Asimov', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-asimov_100x100.png', '1', 347, 'ship_sentinel_design_sentinel-asimov', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(84, 'Sentinel', 'Sentinel-Legend', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-legend_100x100.png', '1', 266, 'ship_sentinel_design_sentinel-legend', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(85, 'Designs', 'Venom-Blaze', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/venom/design/venom-blaze_100x100.png', '0', 351, 'ship_venom_design_venom-blaze', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(86, 'Venom', 'Venom-Borealis', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/venom/design/venom-borealis_100x100.png', '1', 352, 'ship_venom_design_venom-borealis', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(87, 'Venom', 'Venom-Ocean', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/venom/design/venom-ocean_100x100.png', '1', 353, 'ship_venom_design_venom-ocean', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(88, 'Venom', 'Venom-Poison', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/venom/design/venom-poison_100x100.png', '1', 354, 'ship_venom_design_venom-poison', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(89, 'Designs', 'Diminisher-Argon', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/diminisher/design/diminisher-argon_100x100.png', '0', 268, 'ship_diminisher_design_diminisher-argon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(90, 'Diminisher', 'Diminisher-Expo2016', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/diminisher/design/diminisher-expo2016_100x100.png', '1', 293, 'ship_diminisher_design_diminisher-expo2016', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(91, 'Diminisher', 'Diminisher-Lava', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/diminisher/design/diminisher-lava_100x100.png', '1', 294, 'ship_diminisher_design_diminisher-lava', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(92, 'Diminisher', 'Diminisher-Legend', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/diminisher/design/diminisher-legend_100x100.png', '1', 269, 'ship_diminisher_design_diminisher-legend', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(93, 'Diminisher', 'Diminisher-Frost', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/diminisher/design/diminisher-frost_100x100.png', '1', 360, 'ship_diminisher_design_diminisher-frost', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(94, 'G-Champion', 'Champion-Argon', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">SHD</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>', 250, 'event', '0', 'do_img/global/items/ship/g-champion/design/g-champion-argon_100x100.png', '0', 364, 'ship_g-champion_design_g-champion-argon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(95, 'Goliath', 'Champion-Lava', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">SHD</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>', 250, 'event', '0', 'do_img/global/items/ship/g-champion/design/g-champion-lava_100x100.png', '0', 363, 'ship_g-champion_design_g-champion-lava', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(96, 'Surgeon', 'Surgeon', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/g-surgeon/design/g-surgeon_100x100.png', '1', 156, 'ship_g-surgeon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(97, 'Pusat', 'Pusat-Expo', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 200000, 'uridium', '0', 'do_img/global/items/ship/pusat/design/pusat-expo_100x100.png', '1', 370, 'ship_pusat_design_pusat-expo16', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(98, 'Pusat', 'Pusat-Lava', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 200000, 'uridium', '0', 'do_img/global/items/ship/pusat/design/pusat-lava_100x100.png', '1', 371, 'ship_pusat_design_pusat-lava', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `shop_items` (`id`, `category`, `name`, `information`, `price`, `priceType`, `amount`, `image`, `active`, `shipId`, `design_name`, `moduleId`, `moduleType`, `boosterId`, `boosterType`, `boosterDuration`, `laserName`, `petName`, `skillTree`, `droneName`, `ammoId`, `typeKey`, `petDesign`, `petFuel`, `petModule`, `FormationName`, `nameBootyKey`) VALUES
(99, 'Pusat', 'Pusat-Blaze', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 200000, 'uridium', '0', 'do_img/global/items/ship/pusat/design/pusat-blaze_100x100.png', '1', 369, 'ship_pusat_design_pusat-blaze', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(100, 'Pusat', 'Pusat-Ocean', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 200000, 'uridium', '0', 'do_img/global/items/ship/pusat/design/pusat-ocean_100x100.png', '1', 373, 'ship_pusat_design_pusat-ocean', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(101, 'Pusat', 'Pusat-Poison', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 200000, 'uridium', '0', 'do_img/global/items/ship/pusat/design/pusat-poison_100x100.png', '1', 374, 'ship_pusat_design_pusat-poison', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(102, 'Pusat', 'Pusat-Sandstorm', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 200000, 'uridium', '0', 'do_img/global/items/ship/pusat/design/pusat-sandstorm_100x100.png', '1', 375, 'ship_pusat_design_pusat-sandstorm', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(113, 'Goliath', 'Goliath-Legend', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">25%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Experience</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">15%</p>', 500, 'event', '0', 'do_img/global/items/ship/g-champion/design/g-champion-legend_100x100.png', '0', 365, 'ship_g-champion_design_g-champion-legend', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(117, 'G-Champion', 'Champion-Albania', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-albania_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-albania', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(118, 'G-Champion', 'Champion-Austria', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-austria_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-austria', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(119, 'G-Champion', 'Champion-Belgium', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-belgium_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-belgium', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(120, 'G-Champion', 'Champion-Croatia', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-croatia_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-croatia', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(121, 'G-Champion', 'Champion-Czech-Republic', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-czech-republic_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-czech-republic', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(122, 'G-Champion', 'Champion-England', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-england_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-england', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(123, 'G-Champion', 'Champion-France', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-france_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-france', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(124, 'G-Champion', 'Champion-Germany', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-germany_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-germany', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(125, 'G-Champion', 'Champion-Iceland', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-iceland_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-iceland', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(126, 'G-Champion', 'Champion-Italy', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-italy_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-italy', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(127, 'G-Champion', 'Champion-Northern-Ireland', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-northern-ireland_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-northern-ireland', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(128, 'G-Champion', 'Champion-Poland', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-poland_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-poland', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(129, 'G-Champion', 'Champion-Portugal', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-portugal_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-portugal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(130, 'G-Champion', 'Champion-Republic-Ireland', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-republic-of-ireland_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-republic-of-ireland', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(131, 'G-Champion', 'Champion-Romania', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-romania_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-romania', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(132, 'G-Champion', 'Champion-Russia', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-russia_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-russia', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(133, 'G-Champion', 'Champion-Slovakia', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-slovakia_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-slovakia', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(134, 'G-Champion', 'Champion-Sweden', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-sweden_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-sweden', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(135, 'G-Champion', 'Champion-Switzerland', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-switzerland_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-switzerland', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(136, 'G-Champion', 'Champion-Ukraine', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-ukraine_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-ukraine', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(137, 'G-Champion', 'Champion-Wales', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-wales_100x100.png', '1', 0, 'ship_g-champion_design_g-champion-wales', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(138, 'G-Champion', 'Champion-Spain', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-spain_100x100.png', '1', 0, 'ship_g_champion_design_g_champion_spain', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(139, 'Ship', 'Pusat', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 256.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 16</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 12</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 370</p>', 180000, 'uridium', '0', 'do_img/global/items/ship/pusat_100x100.png', '0', 130, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(140, 'Laser ammo', 'LCB-10', 'LCB-10 is credit bought laser battery which is currently the least powerful ammunition for laser cannons dealing x1 (so regular) amounts of damage.', 10, 'credits', '1', '/do_img/global/items/ammunition/laser/lcb-10_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_lcb-10', '', '', '', '', '', ''),
(141, 'Laser ammo', 'MCB-25', 'The ammo is also known as x2 ammo, because when the laser cannon is used it deals twice its normal damage.\r\n', 500, 'credits', '1', '/do_img/global/items/ammunition/laser/mcb-25_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_mcb-25', '', '', '', '', '', ''),
(142, 'Laser ammo', 'MCB-50', 'MCB-50 is ammunition for the laser cannons and is currently the fifth most powerful laser battery that is available for direct purchase through the shop.', 1, 'uridium', '1', '/do_img/global/items/ammunition/laser/mcb-50_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_mcb-50', '', '', '', '', '', ''),
(143, 'Laser ammo', 'SAB-50', 'Unlike other laser batteries, SAB-50 does not cause normal damage to the target\'s HP; instead, it drains the target\'s shields and refills the shooter\'s shields. The amount of shield it drains is comparable to MCB-25, however, because of its unique trait of refilling your shields, it costs twice as much.', 1, 'uridium', '1', '/do_img/global/items/ammunition/laser/sab-50_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_sab-50', '', '', '', '', '', ''),
(144, 'Laser ammo', 'UCB-100', 'UCB-100 is a type of ammunition that deals 4 times your normal damage on all attacks to anything you shoot. This is the most common type of ammo to be used in PvP battles with RSB-75. This battery is also known as the x4 ammo, since it deals 4 times your normal damage.', 5, 'uridium', '1', '/do_img/global/items/ammunition/laser/ucb-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_ucb-100', '', '', '', '', '', ''),
(145, 'Laser ammo', 'RSB-75', 'RSB-75 (Rapid Salvo Battery) is a type of ammunition that gives 6 times the damage but has a brief cooldown after each use. For this reason it is usually combined with another ammo type.', 5, 'uridium', '1', '/do_img/global/items/ammunition/laser/rsb-75_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_rsb-75', '', '', '', '', '', ''),
(146, 'Rocket ammo', 'PLT-3030', 'PLT-3030 (Long-Range Rocket) is the last type of rocket with no special ability that you can obtain in DarkOrbit. It has a very low accuracy but it packs a big punch. It is available anytime in Shop, Auction, Buy now and can sometimes be received from Pirate Booty.', 7, 'uridium', '1', '/do_img/global/items/ammunition/rocket/plt-3030_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocket_plt-3030', '', '', '', '', '', ''),
(147, 'Special ammo', 'PLD-8', 'PLD-8 (Plasma Charger) is elite rocket ammunition that temporarily reduces the accuracy of your enemy\'s weapons system when successfully hit. It is available anytime in Shop and ocassionaly in Bonus Boxes during special events.', 100, 'uridium', '1', '/do_img/global/items/ammunition/specialammo/pld-8_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_specialammo_pld-8', '', '', '', '', '', ''),
(148, 'Special ammo', 'DCR-250', 'DCR-250 (Deceleration Rocket) is an elite rocket that can slow down your enemies by 30% for 5 seconds. It is available anytime in Shop.', 250, 'uridium', '1', '/do_img/global/items/ammunition/specialammo/dcr-250_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_specialammo_dcr-250', '', '', '', '', '', ''),
(149, 'Rocket ammo', 'R-IC3', 'R-IC3 (Long-Range Rocket) is an elite rocket that can freeze targets for 2 seconds. The target will still be able to use most of their abilities, but it won\'t be able move. EMP-01 will remove the frozen effect, but not the rocket. ISH-01 will remove the rocket as it comes to you, but not when you\'re already frozen. It is available only during Winterfest.', 300, 'uridium', '1', '/do_img/global/items/ammunition/specialammo/R-IC3.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_specialammo_r-ic3', '', '', '', '', '', ''),
(150, 'Special ammo', 'WIZ-X', 'WIZ-X (Holo Emitter Rocket) is an elite rocket that can transform your target into a random ship or alien. The target cannot be a P.E.T.-10. It deals 0 damage and its\' purpose is only to amuse others. It is found ocassionaly during special events, such as Hallowwen, Winterfest and Easter.', 35, 'uridium', '1', '/do_img/global/items/ammunition/specialammo/wiz-x_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_specialammo_wiz-x', '', '', '', '', '', ''),
(151, 'Special ammo', 'ISH-01', 'A ISH-01 (Insta-Shield) is an extra CPU that gives your ship a 4 second invincibility shield from any incoming damage when activated.', 250, 'uridium', '1', '/do_img/global/items/equipment/extra/cpu/ish-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'equipment_extra_cpu_ish-01', '', '', '', '', '', ''),
(152, 'Special ammo', 'SMB-01', 'SMB-01 (also known as a Smart Bomb or SMTB) is an elite explosive ammunition which cannot be picked up or found, but only be created using the SMB-01 CPU (Smart Bomb CPU).', 250, 'uridium', '1', '/do_img/global/items/equipment/extra/cpu/smb-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_mine_smb-01', '', '', '', '', '', ''),
(153, 'Special ammo', 'EMP-01', 'EMP-01 (EMP Burst) is an elite ammunition insta-mine. It is available anytime at Shop, Assembly and can be sometimes received from Pirate Booty.', 500, 'uridium', '1', '/do_img/global/items/ammunition/specialammo/emp-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_specialammo_emp-01', '', '', '', '', '', ''),
(154, 'Extra', 'CLO4K-XL', 'CLO4K CPU XL is an elite extra which contains 50 cloaks that make the player invisible until you launch an attack yourself, get EMP\'d, or go into Pirate de-cloak mist. Compared to CLO4K CPU and CLO4K-MOD, it is the best out of the two due to having 50 cloaks. Be aware that you\'re still visible in the minimap. The only way to become completely invisible is to own a Spearhead and activate the \"Ultimate Cloaking\" ability.', 500, 'uridium', '1', '/do_img/global/items/equipment/extra/cpu/cl04k-xl_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'equipment_extra_cpu_cl04k-xl', '', '', '', '', '', ''),
(155, 'booty', 'BOOTY-KEY', 'The most common chests found in space, requiring Green keys.', 5000, 'uridium', '1', '/do_img/global/items/resource/gif/booty-key.gif', '0', 0, '', '', '', '', '', '', '', '', '', '', '', 'greenKeys', '', '', '', '', ''),
(156, 'booty', 'BOOTY-KEY', 'The most common chests found in space, requiring Green keys.', 100, 'uridium', '1', '/do_img/global/items/resource/booty-key_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', 'greenKeys', '', '', '', '', ''),
(171, 'Weapon', 'Prometheus', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">An essential tool for every pilot\'s arsenal, ensure victory when going head-to-head with the Black Light!</p>', 250000, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/pr-l_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4Count', '', '', '', '', '', '', '', '', '', ''),
(172, 'Ship', 'Hecate', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 377.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 16</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 220000, 'uridium', '0', 'do_img/global/items/ship/hecate_100x100.png', '0', 1185, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(173, 'Ship', 'Centurion', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 365.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 16</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 360000, 'uridium', '0', 'do_img/global/items/ship/centurion_100x100.png', '0', 1150, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(174, 'Solaris', 'Solaris', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Lasers:</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Generators:</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15</p> <p style=\"color: rgb(4, 177, 25);display: inline-block;\">Speed:</p> \r\n          <p style=\"color: #04a734;display: inline-block;\">300</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/solaris_100x100.png', '1', 1140, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(175, 'Ship', 'Disruptor', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 14</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 14</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 340000, 'uridium', '0', 'do_img/global/items/ship/disruptor_100x100.png', '0', 1130, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(176, 'Ship', 'Berserker', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 500.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 5</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 16</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 290</p>', 340000, 'uridium', '0', 'do_img/global/items/ship/berserker_100x100.png', '0', 1120, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(177, 'Ship', 'Zephyr', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 250.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 12</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 16</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 320000, 'uridium', '0', 'do_img/global/items/ship/zephyr_100x100.png', '0', 1100, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(178, 'Hecate', 'Hecate-Tyrannos', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/hecate/design/hecate-tyrannos_100x100.png', '1', 1189, 'ship_hecate_design_hecate-tyrannos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(179, 'Hecate', 'Hecate-Frost', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/hecate/design/hecate-frost_100x100.png', '1', 1190, 'ship_hecate_design_hecate-frost', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(181, 'Tartarus', 'Tartarus-Epion', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/tartarus/design/tartarus-epion_100x100.png', '1', 1001, 'ship_tartarus_epion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(182, 'Tartarus', 'Tartarus-Smite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/tartarus/design/tartarus-smite_100x100.png', '1', 1003, 'ship_tartarus_smite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(184, 'Centurion', 'Centurion-Damage', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">20%</p>', 350000, 'uridium', '0', 'do_img/global/items/centurion_top.png', '1', 1153, 'centurion-damage', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(185, 'Centurion', 'Centurion-HP', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">25%</p>', 350000, 'uridium', '0', 'do_img/global/items/centurion-hp_top.png', '1', 1154, 'centurion-hp', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(186, 'Centurion', 'Centurion-Shield', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">25%</p>', 350000, 'uridium', '0', 'do_img/global/items/centurion-shield_top.png', '1', 1155, 'centurion-shield', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(187, 'Centurion', 'Centurion-Tyrannos', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">HP</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">14</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">SHD</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15</p>', 2500000, 'uridium', '0', 'do_img/global/items/centurion-tyrannos_top.png', '1', 1157, 'centurion-tyrannos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(189, 'Solaris', 'Solaris-Psyche', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/solaris-psyche_100x100.png', '1', 1141, 'ship_solaris-psyche', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(190, 'Solaris', 'Solaris-Amor', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/solaris-amor_100x100.png', '1', 1142, 'ship_solaris-amor', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(191, 'PET', 'Pet Sentinel Legend', 'Wear the colors of a true hero when you equip the Legend Sentinel P.E.T. Design. Proving your excellence in combat and providing a golden edge to proceedings.\r\n', 62000, 'uridium', '0', 'do_img/global/items/pet/design/pet-sentinel-legend_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '203', '', '', '', ''),
(192, 'PET', 'Pet Diminisher Lava', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Lava Diminisher P.E.T. Design. A hot way to say you mean business.\r\n\r\n', 62000, 'uridium', '0', 'do_img/global/items/pet/design/pet-diminisher-lava_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '205', '', '', '', ''),
(193, 'PET', 'Pet G Champion Legend', 'The Legend G-Champion P.E.T. Design does everything it says on the tin. It makes your P.E.T. look like a legend. What more can we say.', 62000, 'uridium', '0', 'do_img/global/items/pet/design/pet-g-champion-legend_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '200', '', '', '', ''),
(194, 'PET', 'Pet Design red', 'The outer shell of your P.E.T. will look like it\\\'s bathed in spooky red St. Elmo\\\'s Fire, astonishing allies and aliens alike!\r\n\r\n', 50000, 'uridium', '0', 'do_img/global/items/pet/design/red_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '161', '', '', '', ''),
(195, 'PET', 'Pet Design Green', 'This design will imbue your P.E.T. with a high-tech look full of positive energy and joie de vivre!\r\n\r\n\r\n', 50000, 'uridium', '0', 'do_img/global/items/pet/design/green_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '162', '', '', '', ''),
(196, 'PET', 'Pet Sentinel Argon', 'Make your P.E.T. stand out from the crowd with the Argon Sentinel P.E.T. Design. The colors scheme representing the many aliens Earth has defeated over the centuries.\r\n\r\n\r\n\r\n', 62000, 'uridium', '0', 'do_img/global/items/pet/design/pet-sentinel-argon_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '201', '', '', '', ''),
(197, 'PET', 'Pet Diminisher Legend', 'This legend will never be diminished as the Legend Diminisher P.E.T. Design is second-to-none. Bringing a cool slice of civilisation to the vacuum of space, as you carve your way through the galaxy.\r\n\r\n', 62000, 'uridium', '0', 'do_img/global/items/pet/design/pet-diminisher-legend_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '206', '', '', '', ''),
(198, 'PET', 'Pet G Champion Argon', 'Be the hippest cat in the galaxy with the Argon G-Champion P.E.T. Design. Make them know you\\\'re ready for action when you battle with this design by your side.\r\n\r\n', 62000, 'uridium', '0', 'do_img/global/items/pet/design/pet-g-champion-argon_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '197', '', '', '', ''),
(199, 'PET', 'Pet Pusat Poision', 'The Poison Pusat P.E.T. Design gives your P.E.T. a toxic style. More than enough to ensure your enemies know how dangerous you are.\r\n\r\n\r\n', 62000, 'uridium', '0', 'do_img/global/items/pet/design/pet-pusat-poison_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '187', '', '', '', ''),
(200, 'G-Champion', 'Champion-Turkish', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 200000000, 'credits', '0', 'do_img/global/items/ship/g-champion/design/g-champion-turkey_100x100.png', '1', 0, 'ship_goliath_design_turkish', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(201, 'Vengeance', 'Vengeance-Adept', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>', 100000, 'uridium', '0', 'do_img/global/items/ship/vengeance/design/adept_100x100.png', '1', 16, 'ship_vengeance_design_adept', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(202, 'Vengeance', 'Vengeance-Corsair', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HON</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>', 100000, 'uridium', '0', 'do_img/global/items/ship/vengeance/design/corsair_100x100.png', '1', 17, 'ship_vengeance_design_corsair', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(203, 'Vengeance', 'Vengeance-Revenge', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> ', 100000, 'uridium', '0', 'do_img/global/items/ship/vengeance/design/revenge_100x100.png', '1', 58, 'ship_vengeance_design_revenge', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(204, 'Vengeance', 'Vengeance-Avenger', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>', 100000, 'uridium', '0', 'do_img/global/items/ship/vengeance/design/avenger_100x100.png', '1', 60, 'ship_vengeance_design_avenger', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(205, 'Diminisher', 'Diminisher-Epion', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/diminisher/design/diminisher-epion_100x100.png', '1', 379, 'ship_diminisher_design_diminisher-epion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(206, 'Diminisher', 'Diminisher-Phantasm', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/diminisher/design/diminisher-phantasm_100x100.png', '1', 380, 'ship_diminisher_design_diminisher-phantasm', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(207, 'Diminisher', 'Diminisher-Ullrin', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/diminisher/design/diminisher-ullrin_100x100.png', '1', 381, 'ship_diminisher_design_diminisher-ullrin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(208, 'Ship', 'Retiarus', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 400.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 16</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 16</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 450000, 'uridium', '0', 'do_img/global/items/ship/retiarus_100x100.png', '0', 1300, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(209, 'Retiarus', 'Retiarus-Neikos', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">13%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p>', 5000000, 'uridium', '0', 'do_img/global/items/ship/retiarus-neikos_100x100.png', '0', 1302, 'ship_retiarus-neikos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(210, 'Goliath', 'Goliath-Enforcer', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p>\r\n', 100000, 'uridium', '0', 'do_img/global/items/ship/goliath/design/enforcer_100x100.png', '1', 56, 'ship_goliath_design_enforcer', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(211, 'Goliath', 'Goliath-bastion', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">SHD</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p>\r\n', 100000, 'uridium', '0', 'do_img/global/items/ship/g-bastion_100x100.png', '1', 59, 'ship_goliath_design_bastion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(212, 'Sentinel', 'Sentinel-Epion', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-epion_100x100.png', '1', 393, 'ship_sentinel_design_sentinel-epion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(213, 'Sentinel', 'Sentinel-Harbinger', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-harbinger_100x100.png', '1', 394, 'ship_sentinel_design_sentinel-harbinger', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(214, 'Sentinel', 'Sentinel-Osiris', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-osiris_100x100.png', '1', 395, 'ship_sentinel_design_sentinel-osiris', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(215, 'Sentinel', 'Sentinel-smite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-smite_100x100.png', '1', 396, 'ship_sentinel_design_sentinel-smite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `shop_items` (`id`, `category`, `name`, `information`, `price`, `priceType`, `amount`, `image`, `active`, `shipId`, `design_name`, `moduleId`, `moduleType`, `boosterId`, `boosterType`, `boosterDuration`, `laserName`, `petName`, `skillTree`, `droneName`, `ammoId`, `typeKey`, `petDesign`, `petFuel`, `petModule`, `FormationName`, `nameBootyKey`) VALUES
(216, 'Sentinel', 'Sentinel-ullrin', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-ullrin_100x100.png', '1', 397, 'ship_sentinel_design_sentinel-ullrin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(217, 'Solace', 'Solace-Epion', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-epion_100x100.png', '1', 410, 'ship_solace_design_solace-epion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(218, 'Solace', 'Solace-Nobilis', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-nobilis_100x100.png', '1', 411, 'ship_solace_design_solace-nobilis', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(219, 'Solace', 'Solace-Osiris', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-osiris_100x100.png', '1', 412, 'ship_solace_design_solace-osiris', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(220, 'Solace', 'Solace-Smite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-smite_100x100.png', '1', 413, 'ship_solace_design_solace-smite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(221, 'Solace', 'Solace-Ullrin', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p><p style=\"color: #009cf7;display: inline-block;\">5%</p>\r\n          ', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-ullrin_100x100.png', '1', 414, 'ship_solace_design_solace-ullrin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(222, 'Spectrum', 'Spectrum-Ace', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">3%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">7%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-ace_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-ace', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(223, 'Spectrum', 'Spectrum-Epion', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">3%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">7%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-epion_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-epion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(224, 'Spectrum', 'Spectrum-Osiris', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">3%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">7%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-osiris_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-osiris', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(225, 'Spectrum', 'Spectrum-Smite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">3%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">7%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-smite_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-smite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(227, 'Berserker', 'Berserker-Blaze', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/berserker-blaze_100x100.png', '1', 1122, 'ship_berserker-blaze', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(228, 'Berserker', 'Berserker-Neikos', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/berserker-neikos_100x100.png', '1', 1123, 'ship_berserker-neikos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(229, 'Berserker', 'Berserker-Phantasm', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/berserker-phantasm_100x100.png', '1', 1124, 'ship_berserker-phantasm', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(230, 'Hecate', 'Hecate-Carbonite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/hecate/design/hecate-carbonite_100x100.png', '1', 1191, 'ship_hecate_design_hecate-carbonite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(231, 'Pusat', 'Pusat-Carbonite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/pusat/design/pusat-carbonite_100x100.png', '1', 454, 'ship_pusat_design_pusat-carbonite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(232, 'Sentinel', 'Sentinel-Carbonite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-carbonite_100x100.png', '1', 398, 'ship_sentinel_design_sentinel-carbonite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(233, 'Designs', 'Solace-Carbonite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-carbonite_100x100.png', '1', 415, 'ship_solace_design_solace-carbonite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(234, 'Berserker', 'Berserker-Carbonite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">SHD</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/berserker/design/berserker-carbonite_100x100.png', '1', 1125, 'ship_berserker-carbonite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(235, 'Spectrum', 'Spectrum-Carbonite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-carbonite_100x100.png', '0', 0, 'ship_spectrum_design_spectrum-carbonite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(236, 'Ship', 'Orcus', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 385.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 16</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 650000, 'uridium', '0', 'do_img/global/items/orcus_top.png', '0', 1400, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(239, 'PET', 'Pet Fuel 1.000 Liters', 'Charge 1.000 liters fuel in your pet.', 1000000, 'credits', '0', 'do_img/global/items/fuel-100_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '1000', '', '', ''),
(240, 'PET', 'Pet Fuel 5.000 Liters', 'Charge 5.000 liters fuel in your pet.', 5000000, 'credits', '0', 'do_img/global/items/fuel-100_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '5000', '', '', ''),
(241, 'PET', 'Pet Fuel 10.000 Liters', 'Charge 10.000 liters fuel in your pet.', 10000000, 'credits', '0', 'do_img/global/items/fuel-100_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '10000', '', '', ''),
(242, 'PET', 'CGM-02', 'The Combo Guard Mode Gear is a P.E.T gear which will give a very high chance for enemy players to miss attacks on your P.E.T 10.', 22500000, 'credits', '0', 'do_img/global/items/equipment/petgear/cgm-02_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'GUARD', '', ''),
(243, 'PET', 'G-KK1', 'When your P.E.T. or ship is close to being destroyed, the Kamikaze Detonator will start the self-destruct sequence and explode, thereby taking out all enemies in the immediate vicinity.', 22500000, 'credits', '0', 'do_img/global/items/equipment/petgear/g-kk1_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'KAMIKAZE', '', ''),
(244, 'PET', 'G-REP1', 'The P.E.T. repairer will fix your P.E.T. by 5000 per second.', 22500000, 'credits', '0', 'do_img/global/items/equipment/petgear/g-rep1_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'REPAIR_PET', '', ''),
(245, 'PET', 'CSR-02', 'Repairs your ship during flight. Uses extra fuel for each repair.', 22500000, 'credits', '0', 'do_img/global/items/equipment/petgear/csr-02_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'COMBO_SHIP_REPAIR', '', ''),
(250, 'Generator', 'SG3N-A01', 'SG3N-A01 is a shield generator. It is by far the weakest shield generator in the game, but also the cheapest.', 8000, 'credits', '1', '/do_img/global/items/equipment/generator/shield/sg3n-a01_100x100.png', '1', 0, '', '', '', '', '', '', 'A01Count', '', '', '', '', '', '', '', '', '', ''),
(251, 'Generator', 'SG3N-A02', 'SG3N-A02 is a shield generator. It is a small improvement over the SG3N-A01 generator.', 16000, 'credits', '1', '/do_img/global/items/equipment/generator/shield/sg3n-a02_100x100.png', '1', 0, '', '', '', '', '', '', 'A02Count', '', '', '', '', '', '', '', '', '', ''),
(252, 'Generator', 'SG3N-A03', 'SG3N-A03 is a shield generator. It has a far bigger price than its weaker counterpart, SG3N-A02, for a decent amount of shield strength and absorption. SG3N-A03 cannot be upgraded.', 125000, 'credits', '1', '/do_img/global/items/equipment/generator/shield/sg3n-a03_100x100.png', '1', 0, '', '', '', '', '', '', 'A03Count', '', '', '', '', '', '', '', '', '', ''),
(253, 'Generator', 'SG3N-B01', 'SG3N-B01 is a shield generator. It only has 500 more shield strength than its weaker counterpart, SG3N-B00.\r\n\r\n', 2500, 'uridium', '1', '/do_img/global/items/equipment/generator/shield/sg3n-b01_100x100.png', '1', 0, '', '', '', '', '', '', 'B01Count', '', '', '', '', '', '', '', '', '', ''),
(254, 'Generator', 'SG3N-B02', 'SG3N-B02 is a shield generator. For a long time it was the best shield generator in the game, and that\'s why it is standard elite equipment.\r\n\r\n', 10000, 'uridium', '1', '/do_img/global/items/equipment/generator/shield/sg3n-b02_100x100.png', '1', 0, '', '', '', '', '', '', 'bo2Count', '', '', '', '', '', '', '', '', '', ''),
(255, 'Generator', 'SG3N-B03', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box\r\nSG3N-B03 is a shield generator. It is by far the strongest shield generator in the game, offering the most shield strength and absorption out of any other generator available.</p>\r\n\r\n\r\n', 2000000, 'uridium', '1', '/do_img/global/items/equipment/generator/shield/sg3n-b03_100x100.png', '0', 0, '', '', '', '', '', '', 'bo3Count', '', '', '', '', '', '', '', '', '', ''),
(256, 'Generator', 'G3N-1010', 'Generador basico.Aumenta la velocidad en 2.', 2000, 'credits', '1', '', '0', 0, '', '', '', '', '', '', 'g3n1010Count', '', '', '', '', '', '', '', '', '', ''),
(257, 'Generator', 'G3N-2010', 'Generador de velocidad basico.Aumenta la velocidad en 3.', 4000, 'credits', '1', '/do_img/global/items/equipment/generator/speed/g3n-2010_100x100.png', '1', 0, '', '', '', '', '', '', 'g3n2010Count', '', '', '', '', '', '', '', '', '', ''),
(258, 'Generator', 'G3N-3210', 'Generador de velocidad medio.Aumenta la velocidad en 4.\r\n\r\n', 8000, 'credits', '1', '/do_img/global/items/equipment/generator/speed/g3n-3210_100x100.png', '1', 0, '', '', '', '', '', '', 'g3n3210Count', '', '', '', '', '', '', '', '', '', ''),
(259, 'Generator', 'G3N-3310', 'Generador de velocidad medio.Aumenta la velocidad en 5.\r\n\r\n', 16000, 'credits', '1', '/do_img/global/items/equipment/generator/speed/g3n-3310_100x100.png', '1', 0, '', '', '', '', '', '', 'g3n3310Count', '', '', '', '', '', '', '', '', '', ''),
(260, 'Generator', 'G3N-6900', 'Generador de velocidad avanzado. Aumenta la velocidad en 7.\r\n\r\n', 1000, 'uridium', '1', '/do_img/global/items/equipment/generator/speed/g3n-6900_100x100.png', '1', 0, '', '', '', '', '', '', 'g3n6900Count', '', '', '', '', '', '', '', '', '', ''),
(261, 'Generator', 'G3N-7900', 'Generador de velocidad elite.Aumenta la velocidad en 10.\r\n\r\n', 2000, 'uridium', '1', '/do_img/global/items/equipment/generator/speed/g3n-7900_100x100.png', '1', 0, '', '', '', '', '', '', 'g3nCount', '', '', '', '', '', '', '', '', '', ''),
(262, 'Drone', 'Spartan', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">HP</p> <p style=\"color: #009cf7;display: inline-block;\">50%</p><p style=\"color: #ffffff; display: inline-block;\"></p> ', 140000, 'uridium', '1', 'do_img/global/items/drone/designs/spartan_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', 'spartanCount', '', '', '', '', '', '', ''),
(282, 'Extra', 'Blue Key', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(37, 110, 255);display: inline-block;\">Contents:Prometeus weapon 5%,LF-4 10%,LF-4-SP 10%,LF-4-HP 10%,LF-4-MD 10%,LF-4-PD 10%,LF-4-UNSTABLE 10%,LF3-NEUTRON 10%,Apis Parts 5%,Zeus Parts 5%,Havoc 10%,Hercules 10%,\r\nThese contents are available.  </p>', 250, 'event', '1', '/do_img/global/items/resource/booty-key-blue_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'blueKeys'),
(283, 'Extra', 'Red Key', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 37, 37);display: inline-block;\">Contents: MCB-100,SAB-50,CBO-100,SMB-01,UCB-100,MCB-250,RSB-75,JOB-100,ISH-01,MCB-500,PIB-100,RB-214,CLK-XL,PLT-3030,PLD-8,DCR-250,WIZ-X,R-IC3,EMP-01,It is needed to open valuable red pirate chests and collect priceless treasures.  </p>', 75, 'event', '1', '/do_img/global/items/resource/booty-key-red_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'redKeys'),
(284, 'Extra', 'Green Key', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(37, 255, 62);display: inline-block;\">Contents:LF-2,LF-3,SG3N-B02,Ammunition,SG3N-B01,SG3N-A03,G3N-7900,CREDITS,URIDIUM,It is used to unlock pirate loot and collect the valuable treasures in it.  </p>', 1500, 'uridium', '1', '/do_img/global/items/resource/booty-key_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'greenKeys'),
(512, 'Drone', 'Iris', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 37, 190);display: inline-block;\">The Battle Drone (BD-02 I) commonly known as the Iris is an elite battle drone that has two equipment slots.</p>', 35000, 'uridium', '0', 'do_img/global/items/drone/iris-0_100x100.png', '1', 0, '', '', '', '', '', '', 'iriscount', '', '', '', '', '', '', '', '', '', ''),
(513, 'Drone', 'F-3D-DM', 'Augment your drone control unit with the Dome Formation.\r\n\r\nShield points are increased by 30% and regenerate by 0.5% per second. Cooldown times for rockets and rocket launchers are reduced by 25%; however, laser damage and speed are both reduced by 50%.\r\n\r\n', 150000, 'uridium', '0', '/do_img/global/items/drone/formation/f-3d-dm_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-dm', ''),
(514, 'Drone', 'F-3D-DR', 'Augment your drone control unit with the Drill Formation.\r\n\r\nLaser damage is increased by 20%; however, shield points are reduced by 25%, shield spread by 5%, and speed by 5%.\r\n\r\n', 150000, 'uridium', '0', '/do_img/global/items/drone/formation/f-3d-dr_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-dr', ''),
(515, 'Drone', 'F-3D-RG', 'Augment your drone control unit with the Ring Formation.\r\n\r\nShield points are increased by 85%; however, speed is reduced by 5%, laser damage is reduced by 25%, and cooldown times for rockets and rocket launchers are increased by 25%.\r\n\r\n', 150000, 'uridium', '0', '/do_img/global/items/drone/formation/f-3d-rg_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-rg', ''),
(516, 'Drone', 'F-3D-VT', 'Augment your drone control unit with the Veteran Formation.\r\n\r\nHonor is increased by 20%; however, laser damage, hit points, and shield points are all decreased by 20%.\r\n\r\n', 150000, 'uridium', '0', '/do_img/global/items/drone/formation/f-3d-vt_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-vt', ''),
(517, 'Drone', 'F-3D-WL', 'The Wheel Formation is mostly used for catching ships or fleeing from enemy ships but is definitely not the cheapest solution to do so.', 150000, 'uridium', '0', '/do_img/global/items/drone/formation/f-3d-wl_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-wl', ''),
(518, 'Drone', 'F-3D-WV', 'Jazz up your drones with the Wave Formation!\r\n\r\nDrones will make waves, but otherwise this formation grants neither benefits nor penalties.\r\n\r\n', 4950000, 'credits', '0', '/do_img/global/items/drone/formation/f-3d-wv_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-wv', ''),
(519, 'Drone', 'F-3D-X', 'Augment your drone control unit with the X Formation.\r\n\r\n-100% honor rewarded\r\n\r\nYour lasers cause no damage to enemy players\r\n\r\n+5% Laser Damage against aliens\r\n\r\n+5% XP from aliens\r\n\r\n+8% HP', 300000, 'credits', '0', '/do_img/global/items/drone/formation/f-3d-x_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-x', ''),
(550, 'Weapon', 'Prometeus', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box.is an all-around great elite laser cannon that deals 480 damage per shot. </p>', 800, 'event', '1', '/do_img/global/items/equipment/weapon/laser/pr-l_100x100.png', '0', 0, '', '', '', '', '', '', 'lf5Count', '', '', '', '', '', '', '', '', '', ''),
(551, 'Weapon', 'LF-4', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">LF-4 is an all-around great elite laser cannon that deals 200 damage per shot.</p>', 60000, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4Count', '', '', '', '', '', '', '', '', '', ''),
(552, 'Weapon', 'LF-3', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">LF-3 is an all-around great elite laser cannon that deals 150 damage per shot.</p>', 10000, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-3_100x100.png', '1', 0, '', '', '', '', '', '', 'lf3Count', '', '', '', '', '', '', '', '', '', ''),
(553, 'Weapon', 'LF-2', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">LF-2 is an elite laser cannon that deals 100 damage per shot. </p>', 250000, 'credits', '1', '/do_img/global/items/equipment/weapon/laser/lf-2_100x100.png', '1', 0, '', '', '', '', '', '', 'lf2Count', '', '', '', '', '', '', '', '', '', ''),
(554, 'Weapon', 'LF-1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">LF-1 is the weakest laser cannon in the entire game, dealing up to 40 damage per shot.</p>', 10000, 'credits', '1', '/do_img/global/items/equipment/weapon/laser/lf-1_100x100.png', '1', 0, '', '', '', '', '', '', 'lf1Count', '', '', '', '', '', '', '', '', '', ''),
(555, 'Weapon', 'MP-1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Average laser: causes up to 60 damage points per round.</p>', 40000, 'credits', '1', '/do_img/global/items/equipment/weapon/laser/mp-1_100x100.png', '1', 0, '', '', '', '', '', '', 'mp1Count', '', '', '', '', '', '', '', '', '', ''),
(2037, 'Diminisher', 'Diminisher-Prometheus', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">20%</p>', 500000, 'uridium', '0', 'do_img/global/items/ship/diminisher-prometheus_100x100.png', '0', 384, 'ship_diminisher-prometheus', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2038, 'Solace', 'Solace-Prometheus', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/solace-prometheus_top.png', '1', 416, 'ship_solace-prometheus', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2039, 'Retiarus', 'Retiarus-Frost', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">17%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">17%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">17%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">HON</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">20%</p>', 700000, 'uridium', '0', 'do_img/global/items/ship/retiarus-frost_100x100.png', '0', 1303, 'ship_retiarus-frost', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2040, 'Orcus', 'Orcus-Harbinger', '<p style=\"color: #f34242;display: inline-block;\">DMG</p> <p style=\"color: #f34242;display: inline-block;\">45%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">EXP</p> <p style=\"color: #009cf7;display: inline-block;\">30%</p><p style=\"color: #f3721f;; display: inline-block;\"></p> <p style=\"color: #f3721f;display: inline-block;\">HP</p> <p style=\"color: #f3721f;display: inline-block;\">30%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">SHD</p> <p style=\"color: #009cf7;display: inline-block;\">25%</p><p style=\"color: #f3721f;; display: inline-block;\"></p><p style=\"color: #f34242;display: inline-block;\">HON</p> <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p>', 3000, 'event', '0', 'do_img/global/items/ship/orcus/design/orcus-harbinger_100x100.png', '1', 1403, 'ship_orcus-harbinger', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2041, 'Orcus', 'Orcus-Frost', '<p style=\"color: #f34242;display: inline-block;\">DMG</p> <p style=\"color: #f34242;display: inline-block;\">45%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">EXP</p> <p style=\"color: #009cf7;display: inline-block;\">30%</p><p style=\"color: #f3721f;; display: inline-block;\"></p> <p style=\"color: #f3721f;display: inline-block;\">HP</p> <p style=\"color: #f3721f;display: inline-block;\">30%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">SHD</p> <p style=\"color: #009cf7;display: inline-block;\">25%</p><p style=\"color: #f3721f;; display: inline-block;\"></p><p style=\"color: #f34242;display: inline-block;\">HON</p> <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p>', 3000, 'event', '0', 'do_img/global/items/ship/orcus/design/orcus-frost_100x100.png', '1', 1402, 'ship_orcus-frost', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2042, 'Orcus', 'Orcus-Nobilis', '<p style=\"color: #f34242;display: inline-block;\">DMG</p> <p style=\"color: #f34242;display: inline-block;\">45%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">EXP</p> <p style=\"color: #009cf7;display: inline-block;\">30%</p><p style=\"color: #f3721f;; display: inline-block;\"></p> <p style=\"color: #f3721f;display: inline-block;\">HP</p> <p style=\"color: #f3721f;display: inline-block;\">30%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">SHD</p> <p style=\"color: #009cf7;display: inline-block;\">25%</p><p style=\"color: #f3721f;; display: inline-block;\"></p><p style=\"color: #f34242;display: inline-block;\">HON</p> <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p>', 3000, 'event', '0', 'do_img/global/items/ship/orcus/design/orcus-nobilis_100x100.png', '1', 1401, 'ship_orcus-nobilis', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2043, 'Orcus', 'Orcus-Seraph', '<p style=\"color: #f34242;display: inline-block;\">DMG</p> <p style=\"color: #f34242;display: inline-block;\">45%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">EXP</p> <p style=\"color: #009cf7;display: inline-block;\">30%</p><p style=\"color: #f3721f;; display: inline-block;\"></p> <p style=\"color: #f3721f;display: inline-block;\">HP</p> <p style=\"color: #f3721f;display: inline-block;\">30%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">SHD</p> <p style=\"color: #009cf7;display: inline-block;\">25%</p><p style=\"color: #f3721f;; display: inline-block;\"></p><p style=\"color: #f34242;display: inline-block;\">HON</p> <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p>', 3000, 'event', '0', 'do_img/global/items/ship/orcus/design/orcus-seraph_100x100.png', '1', 1404, 'ship_orcus-seraph', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2044, 'Cyborg', 'Cyborg-Seraph', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HON</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p>\r\n          ', 280, 'event', '0', 'do_img/global/items/ship/cyborg/design/cyborg-seraph_100x100.png', '0', 455, 'ship_cyborg_design_cyborg-seraph', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2045, 'Cyborg', 'Cyborg-Osiris', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">25%</p><p style=\"color: #009cf7;display: inline-block;\">15%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HON</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> ', 320, 'event', '0', 'do_img/global/items/ship/cyborg/design/cyborg-osiris_100x100.png', '0', 457, 'ship_cyborg_design_cyborg-osiris', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2046, 'Cyborg', 'Cyborg-Epion', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(156, 93, 255);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #9c5dff;display: inline-block;\">10%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/cyborg/design/cyborg-epion_100x100.png', '1', 456, 'ship_cyborg_design_cyborg-epion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2047, 'Booster', 'Health HP-BO1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 6 Hours, +15% Health</p>', 10000, 'uridium', '0', '/do_img/global/items/booster/hp-b01_100x100.png', '1', 0, '', '', '', '7', '8', '21600', '', '', '', '', '', '', '', '', '', '', ''),
(2048, 'Booster', 'Health HP-BO2', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hour, +25% Health</p>', 500, 'event', '0', '/do_img/global/items/booster/hp-b02_100x100.png', '1', 0, '', '', '', '7', '9', '36000', '', '', '', '', '', '', '', '', '', '', ''),
(2049, 'Booster', 'Shield SHD-BO1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 6 Hours, +15% Shield</p>', 10000, 'uridium', '0', '/do_img/global/items/booster/shd-b01_100x100.png', '1', 0, '', '', '', '3', '15', '21600', '', '', '', '', '', '', '', '', '', '', ''),
(2050, 'Booster', 'Shield SHD-BO2', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hour, +25% Shield</p>', 500, 'event', '0', '/do_img/global/items/booster/shd-b02_100x100.png', '1', 0, '', '', '', '3', '16', '36000', '', '', '', '', '', '', '', '', '', '', ''),
(2051, 'Booster', 'Damage DMG-BO1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 6 Hours, +15% Damage</p>', 10000, 'uridium', '0', '/do_img/global/items/booster/dmg-b01_100x100.png', '1', 0, '', '', '', '2', '0', '21600', '', '', '', '', '', '', '', '', '', '', ''),
(2052, 'Booster', 'Damage DMG-BO2', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hour, +25% Damage</p>', 500, 'event', '0', '/do_img/global/items/booster/dmg-b02_100x100.png', '1', 0, '', '', '', '2', '1', '36000', '', '', '', '', '', '', '', '', '', '', ''),
(2053, 'Booster', 'Honor HON-BO1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 6 Hours, +15% Honor</p>', 20000, 'uridium', '0', '/do_img/global/items/booster/hon-b01_100x100.png', '1', 0, '', '', '', '1', '5', '21600', '', '', '', '', '', '', '', '', '', '', ''),
(2054, 'Booster', 'Honor HON-BO2', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hours, +25% Honor</p>', 500, 'event', '0', '/do_img/global/items/booster/hon-b02_100x100.png', '1', 0, '', '', '', '1', '6', '36000', '', '', '', '', '', '', '', '', '', '', ''),
(2055, 'Booster', 'Experience XP-BO1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 6 Hours, +15% Experience</p>', 20000, 'uridium', '0', '/do_img/global/items/booster/ep-b01_100x100.png', '1', 0, '', '', '', '-0', '2', '21600', '', '', '', '', '', '', '', '', '', '', ''),
(2056, 'Booster', 'Experience XP-BO2', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hour, +25% Experience</p>', 500, 'event', '0', '/do_img/global/items/booster/ep-b02_100x100.png', '1', 0, '', '', '', '-0', '3', '36000', '', '', '', '', '', '', '', '', '', '', ''),
(2057, 'Booster', 'Repair REP-BO1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 6 Hours, 15% Repair</p>', 10000, 'uridium', '0', '/do_img/global/items/booster/rep-b01_100x100.png', '1', 0, '', '', '', '4', '10', '21600', '', '', '', '', '', '', '', '', '', '', ''),
(2058, 'Booster', 'Repair REP-BO2', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hour, 25% Repair</p>', 500, 'event', '0', '/do_img/global/items/booster/rep-b02_100x100.png', '1', 0, '', '', '', '4', '11', '36000', '', '', '', '', '', '', '', '', '', '', ''),
(2060, 'Goliath', 'Goliath-Independence', 'Hitpoints: 15%\r\n\r\nShield: 25%\r\n\r\nDamage: 15%\r\n\r\n', 2000, 'event', '0', 'do_img/global/items/ship/goliath/design/independence_100x100.png', '0', 0, 'ship_goliath_design_independence', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3061, 'Goliath', 'Goliath-Kick', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">SHD</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p>\r\n\r\n', 150, 'event', '0', 'do_img/global/items/ship/goliath/design/kick_100x100.png', '0', 86, 'ship_goliath_design_kick', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3062, 'Goliath', 'Goliath-Referee', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">SHD</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p>\r\n\r\n', 150, 'event', '0', 'do_img/global/items/ship/goliath/design/referee_100x100.png', '0', 87, 'ship_goliath_design_referee', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3063, 'Goliath', 'Goliath-Goal', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p>\r\n\r\n', 150, 'event', '0', 'do_img/global/items/ship/goliath/design/goal_100x100.png', '0', 0, 'ship_goliath_design_goal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3064, 'Cyborg', 'Cyborg-Asimov', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">16%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15%</p>', 190, 'event', '0', 'do_img/global/items/ship/cyborg/design/cyborg-asimov_100x100.png', '0', 258, 'ship_cyborg_design_cyborg-asimov', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3065, 'Cyborg', 'Cyborg-Infinite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">25%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15%</p>', 200, 'event', '0', 'do_img/global/items/ship/cyborg/design/cyborg-infinite_100x100.png', '0', 281, 'ship_cyborg_design_cyborg-infinite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3066, 'Hammerclaw', 'Hammerclaw-Prometheus', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15%</p>', 200, 'event', '0', 'do_img/global/items/ship/hammerclaw/design/hammerclaw-prometheus_100x100.png', '0', 368, 'ship_hammerclaw_design_hammerclaw-prometheus', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3067, 'Spectrum', 'Spectrum-Tyrannos', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Hon</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">35%</p>', 300000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-tyrannos_100x100.png', '0', 349, 'ship_spectrum_design_spectrum-tyrannos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3068, 'Sentinel', 'Sentinel-Arios', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">16%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">HP</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 5000000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-arios_100x100.png', '1', 344, 'ship_sentinel_design_sentinel-arios', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3069, 'Solace', 'Solace-Tyrannos', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">30%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p>', 200, 'event', '0', 'do_img/global/items/ship/solace/design/solace-tyrannos_100x100.png', '0', 342, 'ship_solace_design_solace-tyrannos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `shop_items` (`id`, `category`, `name`, `information`, `price`, `priceType`, `amount`, `image`, `active`, `shipId`, `design_name`, `moduleId`, `moduleType`, `boosterId`, `boosterType`, `boosterDuration`, `laserName`, `petName`, `skillTree`, `droneName`, `ammoId`, `typeKey`, `petDesign`, `petFuel`, `petModule`, `FormationName`, `nameBootyKey`) VALUES
(3070, 'Solace', 'Solace-Frost', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 200, 'event', '0', 'do_img/global/items/ship/solace/design/solace-frost_100x100.png', '0', 0, 'ship_solace_design_solace-frost', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3071, 'Venom', 'Venom-Argon', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">17%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 300000, 'uridium', '0', 'do_img/global/items/ship/venom/design/venom-argon_100x100.png', '1', 350, 'ship_venom_design_venom-argon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3072, 'Surgeon', 'Surgeon-Cicada', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Exp</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">50%</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/g-surgeon/design/g-surgeon-cicada_100x100.png', '0', 361, 'ship_g-surgeon_design_g-surgeon-cicada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3073, 'Surgeon', 'Surgeon-Locust', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">50%</p>', 350000, 'uridium', '0', 'do_img/global/items/ship/g-surgeon/design/g-surgeon-locust_100x100.png', '0', 362, 'ship_g-surgeon_design_g-surgeon-locust', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3074, 'Pusat', 'Pusat-Legend', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HON</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>', 500000, 'uridium', '0', 'do_img/global/items/ship/pusat/design/pusat-legend_100x100.png', '0', 372, 'ship_pusat_design_pusat-legend', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3075, 'Solace', 'Solace-Contagion', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 200, 'event', '0', 'do_img/global/items/ship/solace/design/solace-contagion_100x100.png', '0', 0, 'ship_solace_design_solace-contagion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3076, 'Sentinel', 'Sentinel-Contagion', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">16%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">HP</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 5000000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-contagion_100x100.png', '1', 377, 'ship_sentinel_design_sentinel-contagion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3077, 'Hecate', 'Hecate-Dusklight', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">13%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">13%</p>', 150, 'event', '0', 'do_img/global/items/ship/hecate/design/hecate-dusklight_100x100.png', '1', 1186, 'ship_hecate_design_hecate-dusklight', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3078, 'Tartarus', 'Tartarus-Osiris', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">12%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">12%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 400000, 'uridium', '0', 'do_img/global/items/ship/tartarus/design/tartarus-osiris_100x100.png', '1', 1002, 'ship_tartarus_osiris', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3079, 'special-ec', 'Centurion-Tyrannos', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 250, 'event', '0', 'do_img/global/items/ship/centurion-tyrannos_top.png', '1', 1157, 'centurion-tyrannos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3080, 'Berserker', 'Berserker-Arios', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/berserker-arios_100x100.png', '1', 1121, 'ship_berserker-arios', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3082, 'Rocket ammo', 'PLT-2021', 'Long-range rocket: causes up to 4,000 points per rocket fired', 5, 'uridium', '1', '/do_img/global/items/ammunition/rocket/plt-2021_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocket_plt-2021', '', '', '', '', '', ''),
(3083, 'Rocket ammo', 'PLT-2026', 'Mid-range rocket: causes up to 2,000 damage points per rocket fired', 500, 'credits', '1', '/do_img/global/items/ammunition/rocket/plt-2026_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocket_plt-2026', '', '', '', '', '', ''),
(3084, 'Rocket ammo', 'R-310', 'Short-range rocket: causes up to 1,000 damage points per rocket fired', 100, 'credits', '1', '/do_img/global/items/ammunition/rocket/r-310_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocket_r-310', '', '', '', '', '', ''),
(3085, 'Laser ammo', 'CBO-100', 'The CBO-100 (Combo Battery Ordnance) is an elite laser battery ammunition with a unique form of damage. It causes the same damage as MCB-50, as well as half the shielding effect of SAB-50 ammunition. Available in the store for a limited time only.', 5, 'uridium', '1', '/do_img/global/items/ammunition/laser/cbo-100_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_cbo-100', '', '', '', '', '', ''),
(3086, 'Laser ammo', 'JOB-100', 'JOB-100 (Jack-O-Battery) is elite special laser battery ammunition that was released during the Pumpkin Fest 2012. It deals 3.5 times the damage to Aliens and 2 times the damage to players. ', 7, 'uridium', '1', '/do_img/global/items/ammunition/laser/Job-100_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_job-100', '', '', '', '', '', ''),
(3087, 'Laser ammo', 'RB-214', 'It quadruples the damage caused by the laser with each shot. It causes 8 times damage to demaner casings and signal towers.', 8, 'uridium', '1', '/do_img/global/items/ammunition/laser/rb-214_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_rb-214', '', '', '', '', '', ''),
(3088, 'Custom ammunition', 'MCB-100', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">This is the best standard laser ammo on the market. x7 laser damage per round</p>', 30, 'uridium', '1', '/do_img/global/items/ammunition/laser/mcb-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_mcb-100', '', '', '', '', '', ''),
(3089, 'Custom ammunition', 'MCB-250', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">This is the best standard laser ammo on the market. x10 laser damage per round</p>', 45, 'uridium', '1', '/do_img/global/items/ammunition/laser/mcb-250_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_mcb-250', '', '', '', '', '', ''),
(3090, 'Custom ammunition', 'MCB-500', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">This is the best standard laser ammo on the market. x12 laser damage per round</p> \r\n          \r\n', 60, 'uridium', '1', '/do_img/global/items/ammunition/laser/mcb-500_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_mcb-500', '', '', '', '', '', ''),
(3091, 'PET', ' Pet Fuel', ' P.E.T Fuel \r\n1000 liters', 750, 'uridium', '0', 'do_img/global/items/fuel-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '1000', '', '', ''),
(3092, 'PET', ' Pet Fuel', 'P.E.T Fuel \r\n6000 liters', 4500, 'uridium', '0', 'do_img/global/items/fuel-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '6000', '', '', ''),
(3093, 'PET', ' Pet Fuel', 'P.E.T Fuel \r\n25000 liters', 18750, 'uridium', '0', 'do_img/global/items/fuel-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '25000', '', '', ''),
(3094, 'PET', 'CGM-02', 'It combines the known protection method with the new instant shield. Uses 35% more fuel when active.\r\nAvoidance chance: 65%\r\nExtra consumption: 35 units. fuel', 20000, 'uridium', '0', 'do_img/global/items/equipment/petgear/cgm-02_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'GUARD', '', ''),
(3095, 'PET', 'G-KK1', 'The self-destruct device is activated when your spaceship or P.E.T. almost destroyed. Then the P.E.T. deals a final self-destruct attack against your opponent.\r\nEffect: deals 25000 spreading damage when detonated.\r\nRange: 250', 7500, 'uridium', '0', 'do_img/global/items/equipment/petgear/g-kk1_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'KAMIKAZE', '', ''),
(3096, 'PET', 'G-REP1', 'The repair equipment repairs your PET at 2000 HP per second.\r\nEffect: Heals 2000 health per second.\r\nTime: 120 seconds', 2500, 'uridium', '0', 'do_img/global/items/equipment/petgear/g-rep1_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'REPAIR_PET', '', ''),
(3097, 'PET', 'CSR-02', 'Repairs your spaceship while in flight. You need extra fuel to repair.\r\nEffect: Heals 10000 HP per second.\r\nTime: 5 seconds\r\nAvoidance chance: 65%\r\nConsumption: 200 units. fuel', 20000, 'uridium', '0', 'do_img/global/items/equipment/petgear/csr-02_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'COMBO_SHIP_REPAIR', '', ''),
(3098, 'Extra', 'Silver Key', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(240, 37, 255);display: inline-block;\">Contents.\r\nhavoc, hercules,LF-4-SP,LF4-Paritydrill,LF4Magmadrill,ammunition,MCB_500,MCB_250, uridium, BO3 shield, LF-4,These contents are available. </p>', 350, 'event', '1', '/do_img/global/items/resource/silverboty.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'silverKeys'),
(3099, 'PET', 'Frozen pet design', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Lava Diminisher P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/frozen_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '160', '', '', '', ''),
(3100, 'PET', 'Pet Cyborg Argon', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Pet Cyborg Argon P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/cyborg-argon_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '193', '', '', '', ''),
(3101, 'PET', 'Pet Cyborg Lava', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Pet Cyborg Lava P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-cyborg-lava_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '268', '', '', '', ''),
(3102, 'PET', 'pet-mirage-orange', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the pet-mirage-orange P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/mirage-orange_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '167', '', '', '', ''),
(3103, 'PET', 'Pet Hammerclaw', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Pet Hammerclaw P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-hammerclaw_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '190', '', '', '', ''),
(3104, 'PET', 'Pet Cyborg Carbonite', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Pet Cyborg Carbonite P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-cyborg-carbonite_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '212', '', '', '', ''),
(3105, 'PET', 'Pet Diminisher Argon', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Pet Diminisher Argon P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-diminisher-argon_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '204', '', '', '', ''),
(3106, 'PET', 'Spectrum Pet Blaze', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Spectrum Pet Blaze P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-spectrum-blaze_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '176', '', '', '', ''),
(3107, 'PET', 'Spectrum Pet Ocean', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Spectrum Pet Ocean P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-spectrum-ocean_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '177', '', '', '', ''),
(3108, 'PET', 'Pet Goliath X Argon', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Pet Goliath X Argon P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-goliath-x-argon_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '207', '', '', '', ''),
(3109, 'PET', 'Pet Goliath X Lava', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Pet Goliath X Lava P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-goliath-x-lava_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '208', '', '', '', ''),
(3110, 'PET', 'pet-chimera-argon', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the pet-chimera-argon P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/chimera-argon_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '178', '', '', '', ''),
(3111, 'PET', 'pet-chimera-lava', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the pet-chimera-lava P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/chimera-lava_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '179', '', '', '', ''),
(3112, 'PET', 'Pet Phoenix', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the Pet Phoenix P.E.T. Design. A hot way to say you mean business.', 40000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-phoenix_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '210', '', '', '', ''),
(3113, 'PET', 'pet-pusat-blaze', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the pet-pusat-blaze P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-pusat-blaze_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '174', '', '', '', ''),
(3114, 'PET', 'pet-inferno', 'When you want to diminishing the threat, what better way than skinning your P.E.T. with the pet-inferno P.E.T. Design. A hot way to say you mean business.', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-inferno_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '189', '', '', '', ''),
(3115, 'Orcus', 'Orcus-Celestial', '<p style=\"color: #f34242;display: inline-block;\">DMG</p> <p style=\"color: #f34242;display: inline-block;\">45%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">EXP</p> <p style=\"color: #009cf7;display: inline-block;\">30%</p><p style=\"color: #f3721f;; display: inline-block;\"></p> <p style=\"color: #f3721f;display: inline-block;\">HP</p> <p style=\"color: #f3721f;display: inline-block;\">30%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">SHD</p> <p style=\"color: #009cf7;display: inline-block;\">25%</p><p style=\"color: #f3721f;; display: inline-block;\"></p><p style=\"color: #f34242;display: inline-block;\">HON</p> <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p>', 3000, 'event', '0', 'do_img/global/items/ship/orcus/design/orcus-celestial_100x100.png', '1', 1409, 'ship_orcus-celestial', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3116, 'Spectrum', 'Spectrum-Inferno', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">5%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum/design/spectrum-inferno_100x100.png', '1', 286, 'ship_spectrum_design_spectrum-inferno', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3117, 'Diminisher', 'Diminisher-Carbonite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">20%</p>', 650000, 'uridium', '0', 'do_img/global/items/ship/diminisher/design/diminisher-carbonite_100x100.png', '0', 453, 'ship_diminisher-carbonite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3118, 'Hammerclaw', 'Hammerclaw-Nobilis', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HON</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>', 250, 'event', '0', 'do_img/global/items/ship/hammerclaw/design/hammerclaw-nobilis_100x100.png', '0', 252, 'ship_hammerclaw_design_hammerclaw-nobilis', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3119, 'Hammerclaw', 'Hammerclaw-lava', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>', 250, 'event', '0', 'do_img/global/items/ship/hammerclaw/design/hammerclaw-lava_100x100.png', '0', 247, 'ship_hammerclaw_design_hammerclaw-lava', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3120, 'Berserker', 'Berserker-Amor', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">25%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HON</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p>', 3500, 'event', '0', 'do_img/global/items/ship/berserker/design/berserker-amor_100x100.png', '1', 1126, 'ship_berserker-amor', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3121, 'Retiarus', 'Retiarus-Arios', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">15%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">13%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Honor</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p>', 5000000, 'uridium', '0', 'do_img/global/items/ship/retiarus-arios_100x100.png', '0', 1301, 'ship_retiarus-arios', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3122, 'Booster', 'Experience XP-B50', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hour, +50% Experience</p>', 1000, 'event', '0', '/do_img/global/items/booster/ep-b02_100x100.png', '1', 0, '', '', '', '-0', '4', '2628000', '', '', '', '', '', '', '', '', '', '', ''),
(3123, 'Booster', 'Honor HON-50', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hours, +50% Honor</p>', 1000, 'event', '0', '/do_img/global/items/booster/hon-b02_100x100.png', '1', 0, '', '', '', '1', '7', '2628000', '', '', '', '', '', '', '', '', '', '', ''),
(3124, 'Booster', 'Damage DMG-BO3', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hour, +50% Damage</p>', 200, 'event', '0', '/do_img/global/items/booster/dmg-b02_100x100.png', '0', 0, '', '', '', '2', '27', '36000', '', '', '', '', '', '', '', '', '', '', ''),
(3125, 'Rocket ammo', 'ECO-100', 'Long-range rocket: causes up to 4,000 points per rocket fired', 1500, 'credits', '1', '/do_img/global/items/ammunition/rocketlauncher/eco-10_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocketlauncher_eco-10', '', '', '', '', '', ''),
(3126, 'Rocket ammo', 'UBR-100', 'Long-range rocket: causes up to 8,000 points per rocket fired', 150, 'uridium', '1', '/do_img/global/items/ammunition/rocketlauncher/ubr-100_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocketlauncher_ubr-100', '', '', '', '', '', ''),
(3127, 'Special ammo', 'ACM-01', 'A ISH-01 (Insta-Shield) is an extra CPU that gives your ship a 4 second invincibility shield from any incoming damage when activated.', 100, 'uridium', '1', '/do_img/global/items/equipment/extra/cpu/acm-01_30x30.png', '0', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_mine_acm-01', '', '', '', '', '', ''),
(3128, 'Laser ammo', 'PIB-100', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">The PIB-100 is a powerful laser battery ammo type that multiplies your base damage by 4 while in PvP battles it also infects enemy ships which applies some visual effects on the target. </p> ', 9, 'uridium', '1', '/do_img/global/items/ammunition/laser/pib-100_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_pib-100', '', '', '', '', '', ''),
(3130, 'Drone', 'Iris-2', '', 24000, 'uridium', '0', 'do_img/global/items/drone/iris-5_100x100.png', '0', 0, '', '', '', '', '', '', 'iriscount', '', '', '', '', '', '', '', '', '', ''),
(3131, 'Drone', 'Iris-3', '', 48000, 'uridium', '0', 'do_img/global/items/drone/iris-5_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3132, 'Drone', 'Iris-4', '', 64000, 'uridium', '0', 'do_img/global/items/drone/iris-5_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3133, 'Drone', 'Iris-5', '', 78000, 'uridium', '0', 'do_img/global/items/drone/iris-5_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3134, 'Drone', 'Iris-6', '', 96000, 'uridium', '0', 'do_img/global/items/drone/iris-5_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3135, 'Drone', 'Iris-7', '', 128000, 'uridium', '0', 'do_img/global/items/drone/iris-5_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3136, 'Drone', 'Iris-8', '', 200000, 'uridium', '0', 'do_img/global/items/drone/iris-5_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3137, 'Goliath', 'Goliath-Veteran', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p>', 100000, 'uridium', '0', 'do_img/global/items/ship/goliath/design/veteran_100x100.png', '1', 61, 'ship_goliath_design_veteran', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3138, 'Goliath', 'Goliath-Exalted', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HON</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p>', 100000, 'uridium', '0', 'do_img/global/items/ship/goliath/design/exalted_100x100.png', '1', 62, 'ship_goliath_design_exalted', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3139, 'Weapon', 'LF-3-N', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">LF-3 is an all-around great elite laser cannon that deals 175 damage per shot.</p>', 10000, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-3-n_100x100.png', '0', 0, '', '', '', '', '', '', 'lf3nCount', '', '', '', '', '', '', '', '', '', ''),
(3140, 'PET', 'Pet Hammerclaw Carbonite', 'Pet Hammerclaw Carbonite', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-hammerclaw-carbonite_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '211', '', '', '', ''),
(3141, 'PET', 'Pet Hammerclaw Dusklight', 'Pet Hammerclaw Dusklight', 62000, 'uridium', '0', 'do_img/global/items/pet/design/hammerclaw-dusklight_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '269', '', '', '', ''),
(3142, 'Weapon', 'LF-3-Neutron', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">LF-3-Neutron is an all-around great elite laser cannon that deals 220 damage per shot.</p>', 15000, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-3-n_100x100.png', '0', 0, '', '', '', '', '', '', 'lf3nCount', '', '', '', '', '', '', '', '', '', ''),
(3143, 'Weapon', 'LF-4 Magmadrill', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium. But it can also be found in a Silver Booty box,LF-4 Magmadrill is an all-around great elite laser cannon that deals 220 damage per shot.</p>', 62500, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4mdCount', '', '', '', '', '', '', '', '', '', ''),
(3144, 'Weapon', 'LF-4 Paritydrill', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium. But it can also be found in a Silver Booty box,LF-4 Paritydrill is an all-around great elite laser cannon that deals 220 damage per shot.</p>', 62500, 'uridium', '0', '/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4pdCount', '', '', '', '', '', '', '', '', '', ''),
(3145, 'Weapon', 'LF-4-HP', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box.LF-4-HP is an all-around great elite laser cannon that deals 225 damage per shot.</p>', 62000, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4hpCount', '', '', '', '', '', '', '', '', '', ''),
(3146, 'Weapon', 'LF-4-SP', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box.LF-4-SP is an all-around great elite laser cannon that deals 280 damage per shot.</p>', 62000, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4spCount', '', '', '', '', '', '', '', '', '', ''),
(3147, 'Weapon', 'Unstable LF-4', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Unstable LF-4 is an all-around great elite laser cannon that deals 150-200 damage per shot.</p>', 45000, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-4-unstable_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4unstableCount', '', '', '', '', '', '', '', '', '', ''),
(3149, 'Orcus', 'Orcus ullrin', '<p style=\"color: #f34242;display: inline-block;\">DMG</p> <p style=\"color: #f34242;display: inline-block;\">65%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">EXP</p> <p style=\"color: #009cf7;display: inline-block;\">50%</p><p style=\"color: #f3721f;; display: inline-block;\"></p></p> <p style=\"color: #009cf7;display: inline-block;\">HON</p> <p style=\"color: #009cf7;display: inline-block;\">50%</p><p style=\"color: #f3721f;; display: inline-block;\"></p> <p style=\"color: #f3721f;display: inline-block;\">HP</p> <p style=\"color: #f3721f;display: inline-block;\">60%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">SHD</p> <p style=\"color: #009cf7;display: inline-block;\">50%</p><p style=\"color: #f3721f;; display: inline-block;\"></p>', 7500, 'event', '0', 'do_img/global/items/ship/orcus/design/orcus-ullrin_100x100.png', '1', 1405, 'ship_orcus-ullrin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3150, 'Extra', 'Gold Key', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(240, 37, 255);display: inline-block;\">Contents.\r\nApis, zeus, havoc, hercules, promethius weapon,LF-4-SP,E.C, ammunition,MCB_500, uridium, BO3 shield, LF-4\r\nThese contents are available. </p>', 500, 'event', '1', '/do_img/global/items/resource/goldboty.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'goldKeys'),
(3151, 'Generator', 'SG3N-B03', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box\r\nSG3N-B03 is a shield generator. It is by far the strongest shield generator in the game, offering the most shield strength and absorption out of any other generator available.</p>', 800, 'event', '1', '/do_img/global/items/equipment/generator/shield/sg3n-b03_100x100.png', '0', 0, '', '', '', '', '', '', 'bo3Count', '', '', '', '', '', '', '', '', '', ''),
(4001, 'Drone', 'F-01-TU', 'Augment your drone control unit with the Turtle Formation.\r\n\r\nIncreases shield power by 10%, but laser and rocket damage decrease by 7.5%.\r\n\r\n', 1000000, 'credits', '0', '/do_img/global/items/drone/formation/f-01-tu_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-01-tu', ''),
(4002, 'Drone', 'F-02-AR', 'Augment your drone control unit with the Arrow Formation.\r\n\r\nIncreases rocket damage by 20%, but reduces laser damage by 3%.\r\n\r\n', 1000000, 'credits', '0', '/do_img/global/items/drone/formation/f-02-ar_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-02-ar', ''),
(4003, 'Drone', 'F-03-LA', 'Augment your drone control unit with the Lance Formation. Increases mine damage by 50%.', 75000, 'uridium', '0', '/do_img/global/items/drone/formation/f-03-la_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-03-la', ''),
(4004, 'Drone', 'F-04-ST', 'Augment your drone control unit with the Star Formation.\r\n\r\nIncreases rocket damage by 25%, evasion by 10%, but rocket launcher reload time increases by 33%, as well.\r\n\r\n', 75000, 'uridium', '0', '/do_img/global/items/drone/formation/f-04-st_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-04-st', ''),
(4005, 'Drone', 'F-05-PI', 'Augment your drone control unit with the Pincer Formation.\r\n\r\nIncreases laser damage by 3% against other players and provides an additional 5% honor point bonus. However, it reduces shield penetration by 10%.\r\n\r\n', 100000, 'uridium', '0', '/do_img/global/items/drone/formation/f-05-pi_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-05-pi', ''),
(4006, 'Drone', 'F-06-DA', 'Augment your drone control unit with the Double Arrow Formation.\r\n\r\nIncreases rocket damage by 30%, shield penetration by 10%, but reduces shield power by 20%.\r\n\r\n', 75000, 'uridium', '0', '/do_img/global/items/drone/formation/f-06-da_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-06-da', ''),
(4007, 'Drone', 'F-07-DI', 'Augment your drone control unit with the Diamond Formation.\r\n\r\nYour shield regenerates 1% of your max shield power per second, up to a maximum of 5,000 per second. But hit points are reduced by 30%.', 100000, 'uridium', '0', '/do_img/global/items/drone/formation/f-07-di_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-07-di', ''),
(4008, 'Drone', 'F-08-CH', 'Augment your drone control unit with the Chevron Formation.\r\n\r\nIncreases rocket damage by 65%, but reduces ship hit points by 20%.\r\n\r\n', 75000, 'uridium', '0', '/do_img/global/items/drone/formation/f-08-ch_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-08-ch', ''),
(4009, 'Drone', 'F-09-MO', 'Augment your drone control unit with the Moth Formation.\r\n\r\nIncreases shield penetration by 20%. Hit points are also increased by 20%. But it weakens your shield strength at a rate of 5% per second.\r\n\r\n', 100000, 'uridium', '0', '/do_img/global/items/drone/formation/f-09-mo_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-09-mo', ''),
(4010, 'Drone', 'F-10-CR', 'Augment your drone control unit with the Crab Formation.\r\n\r\nIncreases shield absorption by 20%, but reduces speed by 15%.\r\n\r\n', 100000, 'uridium', '0', '/do_img/global/items/drone/formation/f-10-cr_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-10-cr', ''),
(4011, 'Drone', 'F-11-HE', 'Augment your drone control unit with the Heart Formation.\r\n\r\nIncreases your shield power by 20% and your hit points by 20%. Laser damage is, however, reduced by 5%.\r\n\r\n', 100000, 'uridium', '0', '/do_img/global/items/drone/formation/f-11-he_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-11-he', ''),
(4012, 'Drone', 'F-12-BA', 'Augment your drone control unit with the Barrage Formation.\r\n\r\nIncreases laser damage to NPCs by 5% and provides an additional 5% XP from NPC kills. Shield Leech will, however, be reduced by 15%.\r\n\r\n', 100000, 'uridium', '0', '/do_img/global/items/drone/formation/f-12-ba_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-12-ba', ''),
(4013, 'Drone', 'F-13-BT', 'Augment your drone control unit with the Bat Formation.\r\n\r\nIncrease damage to NPCs by 8% and earn 8% more XP from NPC kills; however, your speed will be reduced by 15%.', 100000, 'uridium', '0', '/do_img/global/items/drone/formation/f-13-bt_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-13-bt', ''),
(4014, 'Vengeance', 'Lightning', '<div class=\"production-info\"><div class=\"info-item\"><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> <p style=\"color: #f34242;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> ', 250000, 'uridium', '0', 'do_img/global/items/ship/vengeance/design/lightning_100x100.png', '1', 0, 'ship_vengeance_design_lightning', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4015, 'Designs', 'Aegis Veteran', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HON</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 100000, 'uridium', '0', 'do_img/global/items/ship/a-veteran-eic_100x100.png', '1', 157, 'ship_aegis_design_aegis-elite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4016, 'Designs', 'Venom', 'This ship has the following abilities: 5% extra damage, and the Singularity ability, which will paralyze enemy ships and cause them substantial damage over time!\r\n\r\n', 250000, 'uridium', '0', 'do_img/global/items/ship/venom_100x100.png', '1', 67, 'ship_goliath_design_venom', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4017, 'Designs', 'Spectrum', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p> <p style=\"color: #ffffff; display: inline-block;\"></p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum_100x100.png', '1', 65, 'ship_goliath_design_spectrum', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4018, 'Designs', 'Diminisher', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> ', 250000, 'uridium', '0', 'do_img/global/items/ship/diminisher_100x100.png', '1', 64, 'ship_goliath_design_diminisher', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4019, 'Goliath', 'Goliath Jade', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">25%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p>', 250000, 'uridium', '0', 'do_img/global/items/ship/goliath/design/jade_100x100.png', '0', 19, 'ship_goliath_design_jade', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4020, 'Rocket ammo', 'UBR-100', 'Long-range rocket: causes up to 7,500 points per rocket fired', 30, 'uridium', '1', '/do_img/global/items/ammunition/rocketlauncher/ubr-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocketlauncher_ubr-100', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `system_verification`
--

CREATE TABLE `system_verification` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `actived` int(11) NOT NULL,
  `userId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `system_verification`
--

INSERT INTO `system_verification` (`id`, `hash`, `actived`, `userId`) VALUES
(1, '0a5fd7c1046a6c7039e8eff30f8ce1e2', 0, '1'),
(2, 'f1e082bc3b2f90159374ee7e01e40dc0', 0, '2'),
(3, '7a12129b242cce0bf00457d023f9e24b', 0, '3'),
(4, '6694c025cff6cb0d89c7b8ebfdb75179', 0, '4'),
(5, '5a4eeac720535aba0cc9ecd45d70bb89', 0, '5'),
(6, '984ecde1bced288f993282793b57ef7d', 0, '6'),
(7, 'db64b20c414183dd9fadf6ba46aafeb4', 0, '7'),
(8, '70938d4f00d3e4d740f3a39515a370de', 0, '8'),
(9, 'bd4e17ae42f664560a38e208232c116d', 0, '9'),
(10, '61f2ae65181a1557aa18f7ef41d30d92', 0, '10'),
(11, '70a3d0630b35a7e5120cdde920b87863', 0, '11'),
(12, '591c2aab08c87b7885e55d11ae75a1ff', 0, '12'),
(13, 'dcb42785a71acc5b316004befe9df6a2', 0, '13'),
(14, '3746811e66f41e102a9fabbeba164ed6', 0, '14'),
(15, 'f46410b651d62b92be44f4c1807be752', 0, '15'),
(16, 'cb578f380e0652164e1896430bef1fc9', 0, '16'),
(17, 'd4a6aa453514dfe2f44d2f4db2de0052', 0, '17'),
(18, '7ded74c15c974355e28b20bcd33ced44', 0, '18'),
(19, 'f041700a8101ef5067eaee2b4bd3bd91', 0, '19');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `uba_rewards`
--

CREATE TABLE `uba_rewards` (
  `id` int(11) NOT NULL,
  `reward` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `upgradessystem`
--

CREATE TABLE `upgradessystem` (
  `id` int(11) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `lvl_base` varchar(255) NOT NULL,
  `new_lvl` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `itemId` varchar(255) NOT NULL,
  `waitTime` varchar(255) NOT NULL,
  `percent` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `timeNow` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_bans`
--

CREATE TABLE `user_bans` (
  `id` int(11) NOT NULL,
  `ip_user` varchar(25) COLLATE utf8_bin NOT NULL,
  `userId` bigint(20) NOT NULL,
  `banType` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `voucher` longtext NOT NULL,
  `uses` bigint(255) NOT NULL,
  `design` varchar(255) NOT NULL,
  `uridium` varchar(255) NOT NULL,
  `credits` varchar(255) NOT NULL,
  `event_coins` varchar(255) NOT NULL,
  `date` time(6) NOT NULL,
  `only_one_user` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0 = Desactivado | 1 = Activado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `vouchers`
--

INSERT INTO `vouchers` (`id`, `voucher`, `uses`, `design`, `uridium`, `credits`, `event_coins`, `date`, `only_one_user`) VALUES
(1, 'rewet', 135, '', '', '', '200', '00:00:00.000000', '1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vouchers_uses`
--

CREATE TABLE `vouchers_uses` (
  `id` int(11) NOT NULL,
  `userId` int(255) NOT NULL,
  `voucherId` varchar(255) NOT NULL,
  `dateUsed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `vouchers_uses`
--

INSERT INTO `vouchers_uses` (`id`, `userId`, `voucherId`, `dateUsed`) VALUES
(1, 1, 'rewet', '1661791498');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `voucher_log`
--

CREATE TABLE `voucher_log` (
  `id` int(11) NOT NULL,
  `voucher` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `voucher_log`
--

INSERT INTO `voucher_log` (`id`, `voucher`, `userId`, `item`, `amount`, `date`) VALUES
(1, 'rewet', 1, 'event_coins', '200', '1661791498');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin_category`
--
ALTER TABLE `admin_category`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `bank_log`
--
ALTER TABLE `bank_log`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `bugreport`
--
ALTER TABLE `bugreport`
  ADD KEY `id` (`id`);

--
-- A tábla indexei `buyed_titles`
--
ALTER TABLE `buyed_titles`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `categoryupgradesystem`
--
ALTER TABLE `categoryupgradesystem`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `chat_log`
--
ALTER TABLE `chat_log`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `chat_permissions`
--
ALTER TABLE `chat_permissions`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `discordannounces`
--
ALTER TABLE `discordannounces`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- A tábla indexei `event_coins`
--
ALTER TABLE `event_coins`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- A tábla indexei `gg_log`
--
ALTER TABLE `gg_log`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `info_galaxygates`
--
ALTER TABLE `info_galaxygates`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `itemsupgradesystem`
--
ALTER TABLE `itemsupgradesystem`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `log_event_jpb`
--
ALTER TABLE `log_event_jpb`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `log_event_uba`
--
ALTER TABLE `log_event_uba`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `log_player_kills`
--
ALTER TABLE `log_player_kills`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `manage_events`
--
ALTER TABLE `manage_events`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `newsclantablelog`
--
ALTER TABLE `newsclantablelog`
  ADD KEY `id` (`id`);

--
-- A tábla indexei `player_accounts`
--
ALTER TABLE `player_accounts`
  ADD PRIMARY KEY (`userId`,`mapID`,`posX`,`posY`);

--
-- A tábla indexei `player_designs`
--
ALTER TABLE `player_designs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- A tábla indexei `player_equipment`
--
ALTER TABLE `player_equipment`
  ADD PRIMARY KEY (`userId`);

--
-- A tábla indexei `player_galaxygates`
--
ALTER TABLE `player_galaxygates`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `player_settings`
--
ALTER TABLE `player_settings`
  ADD PRIMARY KEY (`userId`);

--
-- A tábla indexei `player_titles`
--
ALTER TABLE `player_titles`
  ADD PRIMARY KEY (`userID`);

--
-- A tábla indexei `resource_achievements`
--
ALTER TABLE `resource_achievements`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `server_bans`
--
ALTER TABLE `server_bans`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `server_battlestations`
--
ALTER TABLE `server_battlestations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `server_clans`
--
ALTER TABLE `server_clans`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `server_clan_applications`
--
ALTER TABLE `server_clan_applications`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `server_clan_diplomacy`
--
ALTER TABLE `server_clan_diplomacy`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `server_clan_diplomacy_applications`
--
ALTER TABLE `server_clan_diplomacy_applications`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `server_maps`
--
ALTER TABLE `server_maps`
  ADD PRIMARY KEY (`mapID`) USING BTREE;

--
-- A tábla indexei `server_news`
--
ALTER TABLE `server_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- A tábla indexei `server_ships`
--
ALTER TABLE `server_ships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipID` (`shipID`);

--
-- A tábla indexei `shop_category`
--
ALTER TABLE `shop_category`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `shop_items`
--
ALTER TABLE `shop_items`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `system_verification`
--
ALTER TABLE `system_verification`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `uba_rewards`
--
ALTER TABLE `uba_rewards`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `upgradessystem`
--
ALTER TABLE `upgradessystem`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `user_bans`
--
ALTER TABLE `user_bans`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- A tábla indexei `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `vouchers_uses`
--
ALTER TABLE `vouchers_uses`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `voucher_log`
--
ALTER TABLE `voucher_log`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin_category`
--
ALTER TABLE `admin_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT a táblához `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `bank_log`
--
ALTER TABLE `bank_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `bugreport`
--
ALTER TABLE `bugreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `buyed_titles`
--
ALTER TABLE `buyed_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `categoryupgradesystem`
--
ALTER TABLE `categoryupgradesystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `chat_log`
--
ALTER TABLE `chat_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `chat_permissions`
--
ALTER TABLE `chat_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `chat_rooms`
--
ALTER TABLE `chat_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `discordannounces`
--
ALTER TABLE `discordannounces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT a táblához `event_coins`
--
ALTER TABLE `event_coins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `gg_log`
--
ALTER TABLE `gg_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3493;

--
-- AUTO_INCREMENT a táblához `info_galaxygates`
--
ALTER TABLE `info_galaxygates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `itemsupgradesystem`
--
ALTER TABLE `itemsupgradesystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22224;

--
-- AUTO_INCREMENT a táblához `log_event_jpb`
--
ALTER TABLE `log_event_jpb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `log_event_uba`
--
ALTER TABLE `log_event_uba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT a táblához `log_player_kills`
--
ALTER TABLE `log_player_kills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `manage_events`
--
ALTER TABLE `manage_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `newsclantablelog`
--
ALTER TABLE `newsclantablelog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `player_accounts`
--
ALTER TABLE `player_accounts`
  MODIFY `userId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `player_designs`
--
ALTER TABLE `player_designs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT a táblához `player_equipment`
--
ALTER TABLE `player_equipment`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `player_galaxygates`
--
ALTER TABLE `player_galaxygates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `player_settings`
--
ALTER TABLE `player_settings`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `player_titles`
--
ALTER TABLE `player_titles`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `resource_achievements`
--
ALTER TABLE `resource_achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT a táblához `server_bans`
--
ALTER TABLE `server_bans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `server_battlestations`
--
ALTER TABLE `server_battlestations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `server_clans`
--
ALTER TABLE `server_clans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `server_clan_applications`
--
ALTER TABLE `server_clan_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT a táblához `server_clan_diplomacy`
--
ALTER TABLE `server_clan_diplomacy`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `server_clan_diplomacy_applications`
--
ALTER TABLE `server_clan_diplomacy_applications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `server_news`
--
ALTER TABLE `server_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `shop_category`
--
ALTER TABLE `shop_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT a táblához `shop_items`
--
ALTER TABLE `shop_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300003;

--
-- AUTO_INCREMENT a táblához `system_verification`
--
ALTER TABLE `system_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT a táblához `uba_rewards`
--
ALTER TABLE `uba_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `upgradessystem`
--
ALTER TABLE `upgradessystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `user_bans`
--
ALTER TABLE `user_bans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `vouchers_uses`
--
ALTER TABLE `vouchers_uses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `voucher_log`
--
ALTER TABLE `voucher_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
