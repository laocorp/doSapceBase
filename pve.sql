-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Jan 17. 15:15
-- Kiszolgáló verziója: 10.4.25-MariaDB
-- PHP verzió: 7.4.30

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
-- Tábla szerkezet ehhez a táblához `bid_system`
--

CREATE TABLE `bid_system` (
  `bid_id` bigint(20) NOT NULL,
  `bid_pid` bigint(20) DEFAULT NULL,
  `bid_credit` bigint(20) DEFAULT NULL,
  `bid_pilotname` varchar(20) COLLATE utf8_bin NOT NULL,
  `last_pilotname` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(2, '', 0, '', 'B.royal'),
(3, '', 0, '', 'Jpb'),
(5, '', 0, '', 'Demaner'),
(6, '', 0, '', 'Meteorit'),
(7, '', 0, '', 'Emperator'),
(8, '', 0, '', 'Team'),
(9, '', 0, '', 'Hitac'),
(10, '', 0, '', 'X3event'),
(11, '', 0, '', 'NpcWars');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `event_coins`
--

CREATE TABLE `event_coins` (
  `id` int(11) NOT NULL,
  `coins` int(11) NOT NULL,
  `userId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

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
(1, 'Alpha', 1, '34', '200', '10000'),
(2, 'Beta', 2, '48', '200', '10000'),
(3, 'Gamma', 3, '82', '200', '10000'),
(4, 'Delta', 4, '128', '200', '10000'),
(5, 'Kappa', 7, '120', '300', '10000'),
(6, 'Kronos', 9, '120', '300', '10000'),
(7, 'Lambda', 8, '45', '300', '10000');

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
(1, '1', 'LF-1', '/do_img/global/items/equipment/weapon/laser/lf-1_100x100.png', '500', 'lf1', NULL, '1'),
(2, '1', 'LF-2', '/do_img/global/items/equipment/weapon/laser/lf-2_100x100.png', '2500', 'lf2', NULL, '1'),
(3, '1', 'LF-3', '/do_img/global/items/equipment/weapon/laser/lf-3_100x100.png', '5000', 'lf3', NULL, '1'),
(4, '1', 'LF-4', '/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png', '10000', 'lf4', NULL, '1'),
(5, '1', 'Prometeus', '/do_img/global/items/equipment/weapon/laser/pr-l_100x100.png', '20000', 'lf5', NULL, '1'),
(6, '2', 'SG3N-A01', '/do_img/global/items/equipment/generator/shield/sg3n-a01_100x100.png', '500', 'A01', NULL, '1'),
(7, '2', 'SG3N-A02', '/do_img/global/items/equipment/generator/shield/sg3n-a02_100x100.png', '1000', 'A02', NULL, '1'),
(8, '2', 'SG3N-A03', '/do_img/global/items/equipment/generator/shield/sg3n-a03_100x100.png', '2000', 'A03', NULL, '1'),
(9, '2', 'SG3N-B01', '/do_img/global/items/equipment/generator/shield/sg3n-b01_100x100.png', '3500', 'B01', NULL, '1'),
(10, '2', 'SG3N-B02', '/do_img/global/items/equipment/generator/shield/sg3n-b02_100x100.png', '5000', 'bo2', NULL, '1'),
(11, '2', 'SG3N-B03', '/do_img/global/items/equipment/generator/shield/sg3n-b03_100x100.png', '12500', 'bo3', NULL, '1'),
(12, '3', 'Drone Level', '/img/drone.png', '500000', '', NULL, '1'),
(13, '1', 'LF-3-Neutron', '/do_img/global/items/equipment/weapon/laser/lf-3-n_100x100.png', '7500', 'lf3n', NULL, '1'),
(14, '1', 'LF-4-MD', '/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png', '15000', 'lf4md', NULL, '1'),
(15, '1', 'LF-4-PD', '/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png', '15000', 'lf4pd', NULL, '1'),
(16, '1', 'LF-4-HP', '/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png', '15000', 'lf4hp', NULL, '1'),
(17, '1', 'LF-4-SP', '/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png', '15000', 'lf4sp', NULL, '1'),
(18, '1', 'Unstable LF-4', '/do_img/global/items/equipment/weapon/laser/lf-4-unstable_100x100.png', '13500', 'lf4unstable', NULL, '1'),
(19, '1', 'MP-1', '/do_img/global/items/equipment/weapon/laser/mp-1_100x100.png', '1000', 'mp1', NULL, '1');

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
-- Tábla szerkezet ehhez a táblához `log_player_killhistory`
--

CREATE TABLE `log_player_killhistory` (
  `killer_id` bigint(20) DEFAULT NULL,
  `target_id` bigint(20) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log_player_kills`
--

CREATE TABLE `log_player_kills` (
  `id` int(11) NOT NULL,
  `killer_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `pushing` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log_player_npc`
--

CREATE TABLE `log_player_npc` (
  `id` int(11) NOT NULL,
  `killer_id` int(11) NOT NULL,
  `target_id` varchar(11) COLLATE utf8_bin NOT NULL,
  `pushing` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `groupId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log_player_pve_kills`
--

CREATE TABLE `log_player_pve_kills` (
  `userId` bigint(20) DEFAULT NULL,
  `npc` bigint(20) DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log_player_pvp_kills`
--

CREATE TABLE `log_player_pvp_kills` (
  `userId` bigint(20) DEFAULT NULL,
  `ship` bigint(20) DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log_player_quests`
--

CREATE TABLE `log_player_quests` (
  `userid` bigint(20) DEFAULT NULL,
  `questid` bigint(20) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `collected` datetime DEFAULT current_timestamp(),
  `before_data` text DEFAULT NULL,
  `before_ammo` text DEFAULT NULL,
  `before_items` text DEFAULT NULL,
  `before_premiumVal` text DEFAULT NULL,
  `before_premiumUntil` text DEFAULT NULL,
  `after_data` text DEFAULT NULL,
  `after_ammo` text DEFAULT NULL,
  `after_items` text DEFAULT NULL,
  `after_premiumVal` text DEFAULT NULL,
  `after_premiumUntil` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log_player_quests_state_tmp`
--

CREATE TABLE `log_player_quests_state_tmp` (
  `userId` bigint(20) DEFAULT NULL,
  `questId` bigint(20) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `charId` bigint(20) DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log_player_transactions`
--

CREATE TABLE `log_player_transactions` (
  `userId` bigint(20) DEFAULT NULL,
  `area` varchar(200) DEFAULT NULL,
  `item` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(11, 'X3event', '/start-x3event', '0'),
(12, 'NpcWars', '/start-NpcWars', '0');

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
  `data` text COLLATE utf8_bin NOT NULL DEFAULT '{"uridium":100000,"credits":1000000,"honor":0,"experience":0,"jackpot":0}',
  `bootyKeys` text COLLATE utf8_bin NOT NULL DEFAULT '{"greenKeys":0,"redKeys":0,"blueKeys":0,"silverKeys":0,"goldKeys":0,"ecKeys":0}',
  `info` text COLLATE utf8_bin NOT NULL,
  `destructions` text COLLATE utf8_bin NOT NULL DEFAULT '{"fpd":0,"dbrz":0}',
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `pilotName` varchar(20) COLLATE utf8_bin NOT NULL,
  `petName` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'Your PET',
  `petDesign` int(20) NOT NULL DEFAULT 22,
  `pwResetKey` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `securityQuestions` text COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(260) COLLATE utf8_bin NOT NULL,
  `shipId` int(11) NOT NULL DEFAULT 1,
  `premium` tinyint(1) NOT NULL DEFAULT 0,
  `premiumUntil` datetime DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_bin NOT NULL DEFAULT '',
  `factionId` int(1) NOT NULL DEFAULT 0,
  `clanId` int(11) NOT NULL DEFAULT 0,
  `rankId` int(2) NOT NULL DEFAULT 1,
  `rankPoints` bigint(20) NOT NULL DEFAULT 0,
  `rank` int(11) NOT NULL DEFAULT 0,
  `warPoints` int(20) NOT NULL DEFAULT 0,
  `warBattel` int(11) DEFAULT 0,
  `warRank` int(11) NOT NULL DEFAULT 1,
  `extraEnergy` int(11) NOT NULL,
  `nanohull` int(11) NOT NULL,
  `verification` text COLLATE utf8_bin NOT NULL,
  `oldPilotNames` text COLLATE utf8_bin NOT NULL DEFAULT '[]',
  `version` tinyint(4) NOT NULL DEFAULT 0,
  `droneExp` longtext COLLATE utf8_bin NOT NULL DEFAULT '0',
  `position` text COLLATE utf8_bin NOT NULL DEFAULT '{"mapID":0,"x":0,"y":0}',
  `profile` text COLLATE utf8_bin DEFAULT 'public/img/avatars/default.png',
  `ammo` text COLLATE utf8_bin DEFAULT '{"mcb25":10000,"lcb10":10000,"acm":1,"mcb50":10000,"xcb25":2000,"im01":1,"xcb50":2000,"lxcb75":2000,"hstrm01":50,"ucb":10000,"ucb200":0,"rsb":10000,"rsb300":0,"job100":0,"rb214":0,"cbo100":0,"sab":10000,"pib":0,"ish":2,"emp":2,"smb":2,"plt3030":300,"plt5050":0,"plt8080":0,"ice":1,"dcr":1,"wiz":1,"pld":1,"slm":1,"ddm":1,"empm":1,"sabm":1,"cloacks":1,"r310":10000,"plt26":10000,"plt21":1000,"pib":0,"ubr100":50,"sar02":50,"sar01":50,"eco10":100}',
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
  `killedNpc` text COLLATE utf8_bin NOT NULL DEFAULT '{"ship85":0,"ship23":0,"ship34":0,"ship36":0,"ship44":0,"ship71":0,"ship24":0,"ship37":0,"ship75":0,"ship25":0,"ship38":0,"ship73":0,"ship31":0,"ship43":0,"ship72":0,"ship26":0,"ship39":0,"ship74":0,"ship46":0,"ship47":0,"ship76":0,"ship27":0,"ship40":0,"ship77":0,"ship28":0,"ship41":0,"ship78":0,"ship29":0,"ship42":0,"ship79":0,"ship35":0,"ship45":0,"ship80":0,"ship81":0,"ship107":0,"ship105":0,"ship99":0,"ship118":0,"ship116":0,"ship103":0,"ship84":0,"ship33":0,"ship83":0,"ship11":0,"ship126":0,"ship127":0,"ship122":0,"ship124":0,"ship119":0,"ship123":0,"ship82":0,"ship97":0,"ship96":0,"ship95":0,"ship90":0,"ship91":0,"ship92":0,"ship93":0,"ship94":0,"ship21":0,"ship32":0,"ship114":0,"ship111":0,"ship113":0,"ship112":0,"ship115":0,"ship216":0,"ship215":0,"ship214":0,"ship213":0,"ship6000":0,"ship6001":0,"ship6002":0,"ship6003":0,"ship6004":0,"ship6005":0,"ship6006":0,"ship6007":0,"ship6008":0,"ship6009":0,"ship6010":0,"ship6011":0,"ship6012":0,"ship6013":0,"ship6014":0,"ship6015":0,"ship6016":0,"ship6017":0,"ship6018":0,"ship6019":0,"ship6020":0,"ship6021":0,"ship6022":0,"ship6023":0,"ship6024":0,"ship6025":0,"ship6026":0,"ship6027":0,"ship6028":0,"ship6029":0,"ship6030":0,"ship6031":0,"ship6032":0,"ship6033":0,"ship6034":0,"ship6035":0,"ship6036":0,"ship6037":0,"ship6038":0,"ship6039":0,"ship6040":0}',
  `Npckill` text COLLATE utf8_bin NOT NULL DEFAULT '{"ship85":0,"ship23":0,"ship34":0,"ship36":0,"ship44":0,"ship71":0,"ship24":0,"ship37":0,"ship75":0,"ship25":0,"ship38":0,"ship73":0,"ship31":0,"ship43":0,"ship72":0,"ship26":0,"ship39":0,"ship74":0,"ship46":0,"ship47":0,"ship76":0,"ship27":0,"ship40":0,"ship77":0,"ship28":0,"ship41":0,"ship78":0,"ship29":0,"ship42":0,"ship79":0,"ship35":0,"ship45":0,"ship80":0,"ship81":0,"ship107":0,"ship105":0,"ship99":0,"ship118":0,"ship116":0,"ship103":0,"ship84":0,"ship33":0,"ship83":0,"ship11":0,"ship126":0,"ship127":0,"ship122":0,"ship124":0,"ship119":0,"ship123":0,"ship82":0,"ship97":0,"ship96":0,"ship95":0,"ship90":0,"ship91":0,"ship92":0,"ship93":0,"ship94":0,"ship21":0,"ship32":0,"ship114":0,"ship111":0,"ship113":0,"ship112":0,"ship115":0,"ship216":0,"ship215":0,"ship214":0,"ship213":0,"ship6000":0,"ship6001":0,"ship6002":0,"ship6003":0,"ship6004":0,"ship6005":0,"ship6006":0,"ship6007":0,"ship6008":0,"ship6009":0,"ship6010":0,"ship6011":0,"ship6012":0,"ship6013":0,"ship6014":0,"ship6015":0,"ship6016":0,"ship6017":0,"ship6018":0,"ship6019":0,"ship6020":0,"ship6021":0,"ship6022":0,"ship6023":0,"ship6024":0,"ship6025":0,"ship6026":0,"ship6027":0,"ship6028":0,"ship6029":0,"ship6030":0,"ship6031":0,"ship6032":0,"ship6033":0,"ship6034":0,"ship6035":0,"ship6036":0,"ship6037":0,"ship6038":0,"ship6039":0,"ship6040":0}',
  `reset` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

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
  `items` text COLLATE utf8_bin NOT NULL DEFAULT '{"mp1Count":0,"lf1Count":0,"lf2Count":0,"lf3Count":3,"lf3nCount":0,"lf4Count":0,"lf4hpCount":0,"lf4mdCount":0,"lf4pdCount":0,"lf4unstableCount":0,"lf4spCount":0,"lfp01Count":0,"lf5Count":0,"A01Count":0,"A02Count":0,"A03Count":0,"B01Count":0,"bo2Count":2,"bo3Count":0,"g3n1010Count":0,"g3n2010Count":0,"g3n3210Count":0,"g3n3310Count":0,"g3n6900Count":0,"g3nCount":3,"flaxcount":0,"iriscount":0,"havocCount":0,"herculesCount":0,"spartanCount":0,"cyborgCount":0,"apis":false,"zeus":false,"pet":false,"petModules":[],"ships":[3],"designs":{},"skillTree":{"logdisks":0,"researchPoints":0,"resetCount":0},"droneApisParts":0,"droneZeusParts":0}',
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
  `formationsSaved` longtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `player_quests`
--

CREATE TABLE `player_quests` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL DEFAULT 0,
  `questId` bigint(20) NOT NULL DEFAULT 0,
  `state` set('accepted','collected') NOT NULL DEFAULT 'accepted',
  `accepted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `player_titles`
--

CREATE TABLE `player_titles` (
  `userID` int(11) NOT NULL,
  `titles` varchar(999) CHARACTER SET utf8 NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(1, '1-1', '[{\"ShipId\":84,\"Amount\":40},{\"ShipId\": 23,\"Amount\":40}]  ', '[{\"TypeId\": 46,   \"FactionId\": 1,   \"Position\": [2000,2000] },{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [2200,200]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [1500,300]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [1000,500]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [500,1000]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [200,1500]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [200,2100]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [400,2800]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [700,3300]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [1200,3600]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [1800,3800]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [2400,3700]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3000,3400]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [3400,3000]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3700,2400]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3700,1800]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3600,1200]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [600,7600]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3200,700]}]\r\n', '[{   \"TargetSpaceMapId\": 2,   \"Position\": [18500, 11500],   \"TargetPosition\": [1900, 2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 16,   \"Position\": [10200,2000],   \"TargetPosition\": [6000,13400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 306,   \"Position\": [700, 11200],   \"TargetPosition\": [9800,6700],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(2, '1-2', '[{\"ShipId\":84,\"Amount\":10},{\"ShipId\":71,\"Amount\":10},{\"ShipId\":119,\"Amount\":10},{\"ShipId\":23,\"Amount\":10},{\"ShipId\":24,\"Amount\":10}]', '', '[{   \"TargetSpaceMapId\": 1,   \"Position\": [2000, 2000],   \"TargetPosition\": [18900,11400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 3,   \"Position\": [19500, 2000],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 4,   \"Position\": [19500, 12000],   \"TargetPosition\": [1600,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(3, '1-3', '[{\"ShipId\":71,\"Amount\":20},{\"ShipId\":72,\"Amount\":20},{\"ShipId\":75,\"Amount\":20},{\"ShipId\":6002,\"Amount\":5},{\"ShipId\":6005,\"Amount\":5},{\"ShipId\":73,\"Amount\":20},{\"ShipId\":26,\"Amount\":4},{\"ShipId\":25,\"Amount\":20},{\"ShipId\":31,\"Amount\":20}]', '', '[{   \"TargetSpaceMapId\": 7,   \"Position\": [18700, 1300],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 4,   \"Position\": [18700, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 2,   \"Position\": [1800, 11300],   \"TargetPosition\": [19500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(4, '1-4', '[{\"ShipId\":71,\"Amount\":20},{\"ShipId\":74,\"Amount\":10},{\"ShipId\":75,\"Amount\":20},{\"ShipId\":73,\"Amount\":20},{\"ShipId\":46,\"Amount\":4},{\"ShipId\":25,\"Amount\":20},{\"ShipId\":24,\"Amount\":20}]', '', '[{   \"TargetSpaceMapId\": 12,   \"Position\": [18700, 11300],   \"TargetPosition\": [1900,1100],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 13,   \"Position\": [18700, 6500],   \"TargetPosition\": [1900,6350],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 3,   \"Position\": [18700, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 2,   \"Position\": [1600, 1300],   \"TargetPosition\": [19500,12000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(5, '2-1', '[{\"ShipId\":84,\"Amount\":40},{\"ShipId\": 23,\"Amount\":40}]  ', '[{\"TypeId\": 46,   \"FactionId\": 2,   \"Position\": [18900,2000] },{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [17500,3000]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [17200,2500]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [17200,1800]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [17300,1200]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [17700,700]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [18200,300]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [18800,200]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [19400,200]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [20000,500]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [20400,1000]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [20700,1500]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [20800,2100]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [20600,2800]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [20200,3300]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [19700,3600]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [19100,3800]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [18500,3700]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [17900,3400]}]', '[{   \"TargetSpaceMapId\": 6,   \"Position\": [1800, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 2,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 16,   \"Position\": [10200, 2000],   \"TargetPosition\": [28000,3000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 307,   \"Position\": [1800, 1300],   \"TargetPosition\": [600,5800],   \"GraphicId\": 1,   \"FactionId\": 2,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(6, '2-2', '[{\"ShipId\":84,\"Amount\":10},{\"ShipId\":71,\"Amount\":10},{\"ShipId\":119,\"Amount\":10},{\"ShipId\":23,\"Amount\":10},{\"ShipId\":24,\"Amount\":10}]', '', '[{   \"TargetSpaceMapId\": 5,   \"Position\": [18700, 1300],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 7,   \"Position\": [1800, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 8,   \"Position\": [18700, 11300],   \"TargetPosition\": [1800,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(7, '2-3', '[{\"ShipId\":71,\"Amount\":20},{\"ShipId\":72,\"Amount\":20},{\"ShipId\":75,\"Amount\":20},{\"ShipId\":6002,\"Amount\":5},{\"ShipId\":6005,\"Amount\":5},{\"ShipId\":73,\"Amount\":20},{\"ShipId\":26,\"Amount\":4},{\"ShipId\":25,\"Amount\":20},{\"ShipId\":31,\"Amount\":20}]', '', '[{   \"TargetSpaceMapId\": 6,   \"Position\": [18700, 1300],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 3,   \"Position\": [1800, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 8,   \"Position\": [18700, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(8, '2-4', '[{\"ShipId\":71,\"Amount\":20},{\"ShipId\":74,\"Amount\":10},{\"ShipId\":75,\"Amount\":20},{\"ShipId\":73,\"Amount\":20},{\"ShipId\":46,\"Amount\":4},{\"ShipId\":25,\"Amount\":20},{\"ShipId\":24,\"Amount\":20}]', '', '[{   \"TargetSpaceMapId\": 6,   \"Position\": [1800, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 7,   \"Position\": [18700, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 11,   \"Position\": [1800, 11300],   \"TargetPosition\": [1600,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 14,   \"Position\": [10200, 11300],   \"TargetPosition\": [10000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(9, '3-1', '[{\"ShipId\":84,\"Amount\":40},{\"ShipId\": 23,\"Amount\":40}]  ', '[{\"TypeId\": 46,   \"FactionId\": 3,   \"Position\": [19000,11600] },{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [17500,10400]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17200,11000]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17200,11600]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17300,12200]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [17700,12800]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [18200,13100]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [18800,13300]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19400,13200]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [20000,13000]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20400,12500]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20700,11900]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20700,11300]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [20600,10700]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20200,10200]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19700,9900]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [19100,9700]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [18500,9800]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17900,10000]}]', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10500, 11600],   \"TargetPosition\": [28000,24000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 10,   \"Position\": [1800, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 308,   \"Position\": [1800, 1300],   \"TargetPosition\": [600,5800],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(10, '3-2', '[{\"ShipId\":84,\"Amount\":10},{\"ShipId\":71,\"Amount\":10},{\"ShipId\":119,\"Amount\":10},{\"ShipId\":23,\"Amount\":10},{\"ShipId\":24,\"Amount\":10}]', '', '[{   \"TargetSpaceMapId\": 9,   \"Position\": [18700, 11300],   \"TargetPosition\": [1600,1800],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 11,   \"Position\": [18700, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 12,   \"Position\": [1600, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(11, '3-3', '[{\"ShipId\":71,\"Amount\":20},{\"ShipId\":72,\"Amount\":20},{\"ShipId\":75,\"Amount\":20},{\"ShipId\":6002,\"Amount\":5},{\"ShipId\":6005,\"Amount\":5},{\"ShipId\":73,\"Amount\":20},{\"ShipId\":26,\"Amount\":4},{\"ShipId\":25,\"Amount\":20},{\"ShipId\":31,\"Amount\":20}]', '', '[{   \"TargetSpaceMapId\": 8,   \"Position\": [1600, 1300],   \"TargetPosition\": [1800,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 12,   \"Position\": [1600, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 10,   \"Position\": [18700, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(12, '3-4', '[{\"ShipId\":71,\"Amount\":20},{\"ShipId\":74,\"Amount\":10},{\"ShipId\":75,\"Amount\":20},{\"ShipId\":73,\"Amount\":20},{\"ShipId\":46,\"Amount\":4},{\"ShipId\":25,\"Amount\":20},{\"ShipId\":24,\"Amount\":20}]', '', '[{   \"TargetSpaceMapId\": 4,   \"Position\": [1800, 1300],   \"TargetPosition\": [18700,11300],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 11,   \"Position\": [18700, 1300],   \"TargetPosition\": [1600,11300],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 10,   \"Position\": [18700, 11300],   \"TargetPosition\": [1600,1300],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 15,   \"Position\": [10500, 1300],   \"TargetPosition\": [18400,6700],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(13, '4-1', '[{\"ShipId\":118,\"Amount\":3}]', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10400,6400],   \"TargetPosition\": [19200,13400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 4,   \"Position\": [1900,6350],   \"TargetPosition\": [18600,6400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 15,   \"Position\": [18500,11500],   \"TargetPosition\": [1900,11400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 14,   \"Position\": [18500,2000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]\r\n', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(14, '4-2', '[{\"ShipId\":118,\"Amount\":3}]', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10000,6300],   \"TargetPosition\": [21800,11900],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 13,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,11900],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 8,   \"Position\": [10000,2000],   \"TargetPosition\": [10200,11300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 15,   \"Position\": [18500,11500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(15, '4-3', '[{\"ShipId\":118,\"Amount\":3}]', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10200, 6600],   \"TargetPosition\": [21800,14500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 12,   \"Position\": [18500,6750],   \"TargetPosition\": [10500,1200],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 14,   \"Position\": [2000,2000],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 13,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '[{   \"TypeId\": 2,   \"Amount\": 100,   \"TopLeft\": [18300,1100], \"BottomRight\": [18300,1100], \"Respawnable\":true }]', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(16, '4-4', '', '', '[{   \"TargetSpaceMapId\": 17,   \"Position\": [6000,13400],   \"TargetPosition\": [18500,6750],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 21,   \"Position\": [28000,3000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 25,   \"Position\": [28000,24000],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 13,   \"Position\": [19200,13400],   \"TargetPosition\": [10400,6400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 14,   \"Position\": [21800,11900],   \"TargetPosition\": [10000,6400],   \"GraphicId\": 1,   \"FactionId\": 2,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 15,   \"Position\": [21800,14500],   \"TargetPosition\": [10200,6600],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 93,   \"Position\": [10200, 2000],   \"TargetPosition\": [18000,3000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":true,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(17, '1-5', '[{   \"ShipId\": 71,   \"Amount\": 20},{   \"ShipId\": 24,   \"Amount\": 20},{   \"ShipId\": 76,   \"Amount\": 20},{   \"ShipId\": 27,   \"Amount\": 20},{   \"ShipId\": 77,   \"Amount\": 20},{   \"ShipId\": 28,   \"Amount\": 8}]\r\n', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [18500,6750],   \"TargetPosition\": [6000,13400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 19,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 18,   \"Position\": [2000,2000],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 19,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 29,   \"Position\": [10000,11500],   \"TargetPosition\": [7100,13300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(18, '1-6', '[{   \"ShipId\": 29,   \"Amount\": 8},{   \"ShipId\": 35,   \"Amount\": 15},{   \"ShipId\": 80,   \"Amount\": 2}]', '', '[{   \"TargetSpaceMapId\": 17,   \"Position\": [18500, 11500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 20,   \"Position\": [2000, 11500],   \"TargetPosition\": [18200,2200],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(19, '1-7', '[{   \"ShipId\": 78,   \"Amount\": 7},{   \"ShipId\": 6027,   \"Amount\": 10},{   \"ShipId\": 6028,   \"Amount\": 7},{   \"ShipId\": 79,   \"Amount\": 10}]', '', '[{   \"TargetSpaceMapId\": 20,   \"Position\": [2000, 2000],   \"TargetPosition\": [18200,11200],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 17,   \"Position\": [18500,2000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(20, '1-8', '[{   \"ShipId\": 85,   \"Amount\": 30},{   \"ShipId\": 34,   \"Amount\": 20}]', '[{   \"TypeId\": 46,   \"FactionId\": 1,   \"Position\": [2100,6600] },{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [200,6700]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [200,6200]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [500,5500]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [900,5100]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [1500,4900]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [2100,4800]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [2800,5000]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3200,5400]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [3600,5800]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3700,6400]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3700,7100]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [3400,7600]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [3000,8100]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [2400,8300]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [1800,8400]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [1200,8200]},{\"TypeId\": 58, \"FactionId\": 1, \"Position\": [600,7600]},{\"TypeId\": 56, \"FactionId\": 1, \"Position\": [300,7300]}]\r\n', '[{   \"TargetSpaceMapId\": 19,   \"Position\": [18200, 11200],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 18,   \"Position\": [18200, 2200],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 16,   \"Position\": [18100, 6600],   \"TargetPosition\": [6000,13400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 306,   \"Position\": [11100, 11000],   \"TargetPosition\": [700,11400],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1),
(21, '2-5', '[{   \"ShipId\": 71,   \"Amount\": 20},{   \"ShipId\": 24,   \"Amount\": 20},{   \"ShipId\": 76,   \"Amount\": 20},{   \"ShipId\": 27,   \"Amount\": 20},{   \"ShipId\": 77,   \"Amount\": 20},{   \"ShipId\": 28,   \"Amount\": 8}]\r\n', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [2000,11500],   \"TargetPosition\": [28000,3000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 22,   \"Position\": [2000,2000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 23,   \"Position\": [18500,2000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 29,   \"Position\": [18500,11500],   \"TargetPosition\": [30400,4500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(22, '2-6', '[{   \"ShipId\": 29,   \"Amount\": 8},{   \"ShipId\": 35,   \"Amount\": 15},{   \"ShipId\": 80,   \"Amount\": 2}]', '', '[{   \"TargetSpaceMapId\": 21,   \"Position\": [2000, 11500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 24,   \"Position\": [18500, 2000],   \"TargetPosition\": [2200,11000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(23, '2-7', '[{   \"ShipId\": 78,   \"Amount\": 7},{   \"ShipId\": 6027,   \"Amount\": 10},{   \"ShipId\": 6028,   \"Amount\": 7},{   \"ShipId\": 79,   \"Amount\": 10}]', '', '[{   \"TargetSpaceMapId\": 21,   \"Position\": [2000, 11500],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 24,   \"Position\": [18500, 2000],   \"TargetPosition\": [18500,11000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]\r\n', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(24, '2-8', '[{   \"ShipId\": 85,   \"Amount\": 30},{   \"ShipId\": 34,   \"Amount\": 20}]', '[{\"TypeId\": 46,   \"FactionId\": 2,   \"Position\": [10400,1800] },{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [8900,2800]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [9300,3200]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [9800,3700]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [10400,3900]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [11000,3700]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [11600,3500]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [12000,3100]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [12300,2400]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [12400,1700]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [12200,1100]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [11800,800]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [11300,400]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [10700,200]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [10100,300]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [9500,500]},{\"TypeId\": 58, \"FactionId\": 2, \"Position\": [9100,900]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [8800,1500]},{\"TypeId\": 56, \"FactionId\": 2, \"Position\": [8700,2100]}]', '[{   \"TargetSpaceMapId\": 23,   \"Position\": [18500, 11000],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 22,   \"Position\": [2200, 11000],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 16,   \"Position\": [10300, 10800],   \"TargetPosition\": [28000,3000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 307,   \"Position\": [16500, 3600],   \"TargetPosition\": [10800,1500],   \"GraphicId\": 1,   \"FactionId\": 2,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 2),
(25, '3-5', '[{   \"ShipId\": 71,   \"Amount\": 20},{   \"ShipId\": 24,   \"Amount\": 20},{   \"ShipId\": 76,   \"Amount\": 20},{   \"ShipId\": 27,   \"Amount\": 20},{   \"ShipId\": 77,   \"Amount\": 20},{   \"ShipId\": 28,   \"Amount\": 8}]\r\n', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [2000,2000],   \"TargetPosition\": [28000,24000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 26,   \"Position\": [2000,11500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 27,   \"Position\": [18500,11500],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 29,   \"Position\": [18500,2000],   \"TargetPosition\": [30400,21600],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(26, '3-6', '[{   \"ShipId\": 29,   \"Amount\": 8},{   \"ShipId\": 35,   \"Amount\": 15},{   \"ShipId\": 80,   \"Amount\": 2}]', '', '[{   \"TargetSpaceMapId\": 25,   \"Position\": [2000, 2000],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 28,   \"Position\": [18500, 11500],   \"TargetPosition\": [2000,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(27, '3-7', '[{   \"ShipId\": 78,   \"Amount\": 7},{   \"ShipId\": 6027,   \"Amount\": 10},{   \"ShipId\": 6028,   \"Amount\": 7},{   \"ShipId\": 79,   \"Amount\": 10}]', '', '[{   \"TargetSpaceMapId\": 25,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 28,   \"Position\": [18500,11500],   \"TargetPosition\": [2000,2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(28, '3-8', '[{   \"ShipId\": 85,   \"Amount\": 7},{   \"ShipId\": 78,   \"Amount\":12},{   \"ShipId\": 35,   \"Amount\":2},{   \"ShipId\": 29,   \"Amount\":4}]', '[{\"TypeId\": 46,   \"FactionId\": 3,   \"Position\": [19100,6500] },{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [18700,4800]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19300,4700]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19900,5000]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20400,5300]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [20800,5800]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [21000,6400]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20900,7100]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [20600,7600]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [20200,8100]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19600,8300]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [19000,8400]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [18400,8300]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [17900,7900]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17500,7400]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17300,6700]},{\"TypeId\": 58, \"FactionId\": 3, \"Position\": [17400,6100]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [17700,5500]},{\"TypeId\": 56, \"FactionId\": 3, \"Position\": [18100,5100]}]', '[{   \"TargetSpaceMapId\": 27,   \"Position\": [2000, 2000],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true },  {   \"TargetSpaceMapId\": 26,   \"Position\": [2000,11500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 16,   \"Position\": [1900, 6800],   \"TargetPosition\": [28000,24000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 308,   \"Position\": [16600, 10300],   \"TargetPosition\": [19000,11700],   \"GraphicId\": 1,   \"FactionId\": 3,   \"Visible\": true,   \"Working\": true }]\n', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 3),
(29, '4-5', '[{   \"ShipId\": 42,   \"Amount\": 20},{   \"ShipId\": 45,   \"Amount\": 20},{   \"ShipId\": 47,   \"Amount\": 20},{   \"ShipId\": 83,   \"Amount\": 20},{   \"ShipId\": 36,   \"Amount\": 20},{   \"ShipId\": 37,   \"Amount\": 20},{   \"ShipId\": 38,   \"Amount\": 20},{   \"ShipId\": 39,   \"Amount\": 20},{   \"ShipId\": 43,   \"Amount\": 20},{   \"ShipId\": 39,   \"Amount\": 20},{   \"ShipId\": 40,   \"Amount\": 20},{   \"ShipId\": 41,   \"Amount\": 20},{   \"ShipId\": 44,   \"Amount\": 20}]', '', '[{   \"TargetSpaceMapId\": 91,   \"Position\": [21200,13300],   \"TargetPosition\": [21300,13400],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 17,   \"Position\": [7100,13300],   \"TargetPosition\": [10000,11500],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 21,   \"Position\": [30400,4500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 25,   \"Position\": [30400,21600],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(42, '???', '[{   \"ShipId\": 42,   \"Amount\": 20},{   \"ShipId\": 45,   \"Amount\": 20},{   \"ShipId\": 47,   \"Amount\": 20},{   \"ShipId\": 83,   \"Amount\": 20},{   \"ShipId\": 36,   \"Amount\": 20},{   \"ShipId\": 37,   \"Amount\": 20},{   \"ShipId\": 38,   \"Amount\": 20},{   \"ShipId\": 39,   \"Amount\": 20},{   \"ShipId\": 43,   \"Amount\": 20},{   \"ShipId\": 39,   \"Amount\": 20},{   \"ShipId\": 40,   \"Amount\": 20},{   \"ShipId\": 41,   \"Amount\": 20},{   \"ShipId\": 44,   \"Amount\": 20}]', '', '[{   \"TargetSpaceMapId\": 91,   \"Position\": [21200,13300],   \"TargetPosition\": [21300,13400],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 17,   \"Position\": [7100,13300],   \"TargetPosition\": [10000,11500],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 21,   \"Position\": [30400,4500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 25,   \"Position\": [30400,21600],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(51, 'GG Alpha', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(52, 'GG Beta', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(53, 'GG Gamma', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(55, 'GG Delta', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(58, 'Battle Map', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(61, 'MMO INVASION', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":false}', 0),
(62, 'EIC INVASION', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":false}', 0),
(63, 'VRU INVASION', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":false}', 0),
(70, 'GG Epsilon', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(71, 'GG Zeta', '[{   \"ShipId\": 107,   \"Amount\": 18}]', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(74, 'GG Kappa', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(75, 'GG Lambda', '     ', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 1),
(76, 'GG Kronos', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(91, '5-1', '[{\"ShipId\":114,\"Amount\":5},{\"ShipId\":111,\"Amount\":5},{\"ShipId\":112,\"Amount\":5},{\"ShipId\":113,\"Amount\":5}]', '', '[{   \"TargetSpaceMapId\": 92,   \"Position\": [6000,13400],   \"TargetPosition\": [18500,6750],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 42,   \"Position\": [21200,13300],   \"TargetPosition\": [21300,13400],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(92, '5-2', '[{\"ShipId\":114,\"Amount\":10},{\"ShipId\":111,\"Amount\":10},{\"ShipId\":96,\"Amount\":10},{\"ShipId\":113,\"Amount\":10}]', '', '[{   \"TargetSpaceMapId\": 91,   \"Position\": [18700, 11300],   \"TargetPosition\": [18700,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 93,   \"Position\": [1800, 11300],   \"TargetPosition\": [1600,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(93, '5-3', '[{\"ShipId\":114,\"Amount\":10},{\"ShipId\":111,\"Amount\":10},{\"ShipId\":97,\"Amount\":5},{\"ShipId\":113,\"Amount\":10}]', '', '[{   \"TargetSpaceMapId\": 92,   \"Position\": [1800, 11300],   \"TargetPosition\": [1600,1300],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 16,   \"Position\": [10000,6300],   \"TargetPosition\": [21800,11900],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
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
(150, 'R-Zone 1', '[{   \"ShipId\": 42,   \"Amount\": 13},{   \"ShipId\": 45,   \"Amount\": 11},{   \"ShipId\": 47,   \"Amount\": 10},{   \"ShipId\": 83,   \"Amount\": 5},{   \"ShipId\": 36,   \"Amount\": 5},{   \"ShipId\": 37,   \"Amount\": 3},{   \"ShipId\": 38,   \"Amount\": 3},{   \"ShipId\": 39,   \"Amount\": 8},{   \"ShipId\": 43,   \"Amount\": 3},{   \"ShipId\": 39,   \"Amount\": 3},{   \"ShipId\": 40,   \"Amount\": 3},{   \"ShipId\": 41,   \"Amount\": 3},{   \"ShipId\": 44,   \"Amount\": 3}]', '', '[{   \"TargetSpaceMapId\": 91,   \"Position\": [21200,13300],   \"TargetPosition\": [21300,13400],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 17,   \"Position\": [7100,13300],   \"TargetPosition\": [10000,11500],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 21,   \"Position\": [30400,4500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 25,   \"Position\": [30400,21600],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(151, 'R-Zone 2', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(152, 'R-Zone 3', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(200, '4-5', '[{   \"ShipId\": 42,   \"Amount\": 13},{   \"ShipId\": 45,   \"Amount\": 11},{   \"ShipId\": 47,   \"Amount\": 10},{   \"ShipId\": 83,   \"Amount\": 5},{   \"ShipId\": 36,   \"Amount\": 5},{   \"ShipId\": 37,   \"Amount\": 3},{   \"ShipId\": 38,   \"Amount\": 3},{   \"ShipId\": 39,   \"Amount\": 8},{   \"ShipId\": 43,   \"Amount\": 3},{   \"ShipId\": 39,   \"Amount\": 3},{   \"ShipId\": 40,   \"Amount\": 3},{   \"ShipId\": 41,   \"Amount\": 3},{   \"ShipId\": 44,   \"Amount\": 3}]', '', '[{   \"TargetSpaceMapId\": 91,   \"Position\": [21200,13300],   \"TargetPosition\": [21300,13400],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 17,   \"Position\": [7100,13300],   \"TargetPosition\": [10000,11500],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 21,   \"Position\": [30400,4500],   \"TargetPosition\": [18500,11500],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true },{   \"TargetSpaceMapId\": 25,   \"Position\": [30400,21600],   \"TargetPosition\": [18500,2000],   \"GraphicId\": 1,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":true,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 0),
(201, 'SC-1', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(202, 'SC-2', '', '', '[{   \"TargetSpaceMapId\": 16,   \"Position\": [10300,6300],   \"TargetPosition\": [21300,13400],   \"GraphicId\": 4,   \"FactionId\": 0,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(224, 'Battle Royal', '', '', '', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":true,\"CloakBlocked\":true,\"LogoutBlocked\":true,\"DeathLocationRepair\":false}', 0),
(306, '1-BL', '[{   \"ShipId\": 213,   \"Amount\":16},{   \"ShipId\": 214,   \"Amount\":15},{   \"ShipId\": 215,   \"Amount\":15},{   \"ShipId\": 216,   \"Amount\":2}]', '', '[{   \"TargetSpaceMapId\": 2,   \"Position\": [18500, 11500],   \"TargetPosition\": [1900, 2000],   \"GraphicId\": 1,   \"FactionId\": 1,   \"Visible\": true,   \"Working\": true }]', '', '{\"StarterMap\":false,\"PvpMap\":false,\"RangeDisabled\":false,\"CloakBlocked\":false,\"LogoutBlocked\":false,\"DeathLocationRepair\":true}', 1);
INSERT INTO `server_maps` (`mapID`, `name`, `npcs`, `stations`, `portals`, `collectables`, `options`, `factionID`) VALUES
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
(1, NULL, 'Voucher Code', '<p style=\"color: yellow; display: inline-block;\"></p> <p style=\"color: yellow; display: inline-block;\">StarOrbitNew</p>', NULL, NULL),
(2, '/news/plus.png', 'Plus Ship', NULL, NULL, NULL),
(3, '/news/gg_week_201809.png', 'Galaxy Gates', 'Alpha-Gate Beta-Gate Delta-Gate Gamma-Gate Kappa-Gate Kronos-Gate Lambda-Gate.', NULL, NULL),
(4, '/news/CyborgDroneDesign.png', 'Drone', 'New Design CYBORG Drone!!!!!', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_quests`
--

CREATE TABLE `server_quests` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` set('pve','pvp','collect','special') DEFAULT 'pve',
  `neededLvl` bigint(20) DEFAULT 0,
  `onlyAdmin` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `server_quests`
--

INSERT INTO `server_quests` (`id`, `title`, `description`, `category`, `neededLvl`, `onlyAdmin`) VALUES
(1, 'Streuner', '', 'pve', 1, 0),
(2, 'New Register', '', 'pve', 1, 0),
(3, 'Status', '', 'pve', 4, 0),
(4, 'Trust is Expected ', '', 'pve', 5, 0),
(5, 'Shatter Zone', '', 'pve', 6, 0),
(6, 'Wolf at the Door ', '', 'pve', 6, 0),
(7, 'Influence! ', '', 'pve', 7, 0),
(8, 'The price of betrayal', '', 'pve', 7, 0),
(9, 'Not a human enemy', '', 'pve', 8, 0),
(10, 'A pilot\'s weapons ', '', 'pve', 8, 0),
(11, 'Everyone take cover!', '', 'pve', 8, 0),
(12, 'A skilled fighter', '', 'pve', 9, 0),
(13, 'Sibelon 100', '', 'pve', 9, 0),
(14, 'Boss Sibelon 50', '', 'pve', 9, 0),
(15, 'The prince in the limelight', '', 'pve', 10, 0),
(16, 'Always ready ', '', 'pve', 11, 0),
(17, 'Kristallon', '', 'pve', 11, 0),
(18, 'Kristallin', '', 'pve', 11, 0),
(19, 'Boss Curcubitor', '', 'pve', 11, 0),
(20, 'Boss Kristallon', '', 'pve', 11, 0),
(21, 'Boss Kristallin', '', 'pve', 11, 0),
(22, 'Cubikon', '', 'pve', 11, 0),
(23, 'Cubikon+Protegit', '', 'pve', 11, 0),
(24, 'The Mad Prince ', '', 'pve', 11, 0),
(25, 'Viral Kristallon', '', 'pve', 11, 0),
(26, 'Execution', '', 'pve', 12, 0),
(27, 'Unexpected danger', '', 'pve', 12, 0),
(28, 'Diplomatic suicide ', '', 'pve', 12, 0),
(29, 'Mr.Hyde ', '', 'pve', 12, 0),
(30, 'Camouflage', '', 'pve', 12, 0),
(31, 'Uber', '', 'pve', 12, 0),
(32, 'Uber-Kristallon', '', 'pve', 12, 0),
(33, '1', '', 'pve', 1, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_quests_rewards`
--

CREATE TABLE `server_quests_rewards` (
  `id` bigint(20) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `amount` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `server_quests_rewards`
--

INSERT INTO `server_quests_rewards` (`id`, `type`, `amount`) VALUES
(1, 'mcb50', 10000),
(2, 'exp', 10000),
(3, 'hon', 1500),
(4, 'uridium', 50000),
(5, 'uridium', 50000),
(6, 'exp', 25000),
(7, 'hon', 2500),
(8, 'lf3', 2),
(9, 'bo2', 2),
(10, 'g3n', 3),
(11, 'uridium', 60000),
(12, 'exp', 30000),
(13, 'hon', 5000),
(14, 'uridium', 36500),
(15, 'credits', 2000000),
(16, 'exp', 45000),
(17, 'hon', 6550),
(18, 'uridium', 75000),
(19, 'credits', 2000000),
(20, 'exp', 105000),
(21, 'hon', 7000),
(22, 'mcb50', 6500),
(23, 'uridium', 85500),
(24, 'exp', 100000),
(25, 'hon', 8500),
(26, 'ubr100', 150),
(27, 'uridium', 150000),
(28, 'exp', 115000),
(29, 'hon', 9000),
(30, 'ucb', 7000),
(31, 'uridium', 100000),
(32, 'exp', 85555),
(33, 'hon', 9555),
(34, 'sar02', 150),
(35, 'uridium', 115000),
(36, 'exp', 100000),
(37, 'hon', 12500),
(38, 'lf3', 1),
(39, 'premium', 1),
(40, 'uridium', 125000),
(41, 'credits', 3000000),
(42, 'exp', 150000),
(43, 'hon', 16500),
(44, 'logfiles', 150),
(45, 'uridium', 120000),
(46, 'exp', 125600),
(47, 'hon', 17555),
(48, 'cloacks', 15),
(49, 'lf3', 1),
(50, 'uridium', 135000),
(51, 'exp', 150000),
(52, 'hon', 20000),
(53, 'lf3n', 1),
(54, 'uridium', 150000),
(55, 'exp', 150000),
(56, 'hon', 25000),
(57, 'ubr100', 200),
(58, 'ucb', 20000),
(59, 'uridium', 200000),
(60, 'exp', 550000),
(61, 'hon', 40000),
(62, 'ubr100', 300),
(63, 'ucb', 35000),
(64, 'uridium', 185500),
(65, 'hon', 38450),
(66, 'exp', 750000),
(67, 'plt3030', 250),
(68, 'uridium', 300000),
(69, 'hon', 45000),
(70, 'exp', 1450000),
(71, 'xcb25', 15000),
(72, 'uridium', 500000),
(73, 'exp', 1230000),
(74, 'hon', 32200),
(75, 'logfiles', 300),
(76, 'cloacks', 10),
(77, 'uridium', 155555),
(78, 'exp', 450000),
(79, 'hon', 18500),
(80, 'logfiles', 350),
(81, 'uridium', 3500000),
(82, 'exp', 5000000),
(83, 'hon', 100000),
(84, 'xcb50', 25000),
(85, 'uridium', 2500000),
(86, 'exp', 6500000),
(87, 'hon', 355000),
(88, 'lf4', 1),
(89, 'uridium', 650000),
(90, 'exp', 565000),
(91, 'hon', 35500),
(92, 'sab', 15500),
(93, 'uridium', 10000000),
(94, 'exp', 6500000),
(95, 'hon', 850000),
(96, 'lf4', 1),
(97, 'lxcb75', 15000),
(98, 'uridium', 1000000),
(99, 'exp', 1450000),
(100, 'hon', 255000),
(101, 'ubr100', 350),
(102, 'uridium', 350000),
(103, 'hon', 35000),
(104, 'exp', 176000),
(105, 'sar02', 250),
(106, 'uridium', 1000000),
(107, 'exp', 1150000),
(108, 'hon', 30555),
(109, 'acm', 50),
(110, 'uridium', 1500000),
(111, 'hon', 45000),
(112, 'exp', 655555),
(113, 'sab', 30000),
(114, 'xcb25', 25000),
(115, 'uridium', 3000000),
(116, 'exp', 2500000),
(117, 'hon', 123000),
(118, 'ubr100', 350),
(119, 'uridium', 2500000),
(120, 'exp', 365000),
(121, 'hon', 46500),
(122, 'xcb25', 15000),
(123, 'uridium', 5000000),
(124, 'exp', 565000),
(125, 'hon', 87500),
(126, 'sar02', 1000),
(127, 'uridium', 15000000),
(128, 'exp', 6500000),
(129, 'hon', 125000),
(130, 'lxcb75', 30000),
(131, 'ubr100', 10000),
(132, 'uridium', 10000000),
(133, 'hon', 86500),
(134, 'exp', 455000),
(135, 'lf5', 1),
(136, 'uridium', 30000000),
(137, 'hon', 225000),
(138, 'exp', 12000000),
(139, 'lxcb75', 100000),
(140, 'ubr100', 20000),
(141, 'exp', 50000);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_quests_rewards_temp`
--

CREATE TABLE `server_quests_rewards_temp` (
  `questId` bigint(20) DEFAULT NULL,
  `rewardId` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `server_quests_rewards_temp`
--

INSERT INTO `server_quests_rewards_temp` (`questId`, `rewardId`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(3, 11),
(3, 12),
(3, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(5, 22),
(6, 23),
(6, 24),
(6, 25),
(6, 26),
(7, 27),
(7, 28),
(7, 29),
(7, 30),
(8, 31),
(8, 32),
(8, 33),
(8, 34),
(9, 35),
(9, 36),
(9, 37),
(9, 38),
(9, 39),
(10, 40),
(10, 41),
(10, 42),
(10, 43),
(10, 44),
(11, 45),
(11, 46),
(11, 47),
(11, 48),
(11, 49),
(12, 50),
(12, 51),
(12, 52),
(12, 53),
(13, 54),
(13, 55),
(13, 56),
(13, 57),
(13, 58),
(14, 59),
(14, 60),
(14, 61),
(14, 62),
(14, 63),
(15, 64),
(15, 65),
(15, 66),
(15, 67),
(16, 68),
(16, 69),
(16, 70),
(16, 71),
(17, 72),
(17, 73),
(17, 74),
(17, 75),
(17, 76),
(18, 77),
(18, 78),
(18, 79),
(18, 80),
(19, 81),
(19, 82),
(19, 83),
(19, 84),
(20, 85),
(20, 86),
(20, 87),
(20, 88),
(21, 89),
(21, 90),
(21, 91),
(21, 92),
(22, 93),
(22, 94),
(22, 95),
(22, 96),
(22, 97),
(23, 98),
(23, 99),
(23, 100),
(23, 101),
(24, 102),
(24, 103),
(24, 104),
(24, 105),
(25, 106),
(25, 107),
(25, 108),
(25, 109),
(26, 110),
(26, 111),
(26, 112),
(26, 113),
(26, 114),
(27, 115),
(27, 116),
(27, 117),
(27, 118),
(28, 119),
(28, 120),
(28, 121),
(28, 122),
(29, 123),
(29, 124),
(29, 125),
(29, 126),
(30, 127),
(30, 128),
(30, 129),
(30, 130),
(30, 131),
(31, 132),
(31, 133),
(31, 134),
(31, 135),
(32, 136),
(32, 137),
(32, 138),
(32, 139),
(32, 140),
(33, 141);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_quests_tasks`
--

CREATE TABLE `server_quests_tasks` (
  `id` bigint(20) NOT NULL,
  `neededAmount` bigint(20) NOT NULL DEFAULT 0,
  `type` set('destroy_npc','destroy_player') NOT NULL DEFAULT 'destroy_npc',
  `company` set('mmo','eic','vru') DEFAULT NULL,
  `targetElement` bigint(20) NOT NULL DEFAULT 0,
  `targetElementBaseId` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `server_quests_tasks`
--

INSERT INTO `server_quests_tasks` (`id`, `neededAmount`, `type`, `company`, `targetElement`, `targetElementBaseId`) VALUES
(1, 10, 'destroy_npc', NULL, 84, 0),
(2, 50, 'destroy_npc', NULL, 84, 0),
(3, 50, 'destroy_npc', NULL, 23, 0),
(4, 52, 'destroy_npc', NULL, 119, 0),
(5, 65, 'destroy_npc', NULL, 71, 0),
(6, 75, 'destroy_npc', NULL, 71, 0),
(7, 70, 'destroy_npc', NULL, 84, 0),
(8, 30, 'destroy_npc', NULL, 23, 0),
(9, 55, 'destroy_npc', NULL, 71, 0),
(10, 45, 'destroy_npc', NULL, 73, 0),
(11, 40, 'destroy_npc', NULL, 75, 0),
(12, 56, 'destroy_npc', NULL, 75, 0),
(13, 35, 'destroy_npc', NULL, 72, 0),
(14, 40, 'destroy_npc', NULL, 71, 0),
(15, 50, 'destroy_npc', NULL, 72, 0),
(16, 50, 'destroy_npc', NULL, 73, 0),
(17, 65, 'destroy_npc', NULL, 71, 0),
(18, 60, 'destroy_npc', NULL, 75, 0),
(19, 60, 'destroy_npc', NULL, 25, 0),
(20, 75, 'destroy_npc', NULL, 25, 0),
(21, 70, 'destroy_npc', NULL, 31, 0),
(22, 5, 'destroy_npc', NULL, 26, 0),
(23, 100, 'destroy_npc', NULL, 31, 0),
(24, 85, 'destroy_npc', NULL, 25, 0),
(25, 70, 'destroy_npc', NULL, 23, 0),
(26, 55, 'destroy_npc', NULL, 24, 0),
(27, 75, 'destroy_npc', NULL, 24, 0),
(28, 75, 'destroy_npc', NULL, 31, 0),
(29, 5, 'destroy_npc', NULL, 26, 0),
(30, 100, 'destroy_npc', NULL, 71, 0),
(31, 65, 'destroy_npc', NULL, 73, 0),
(32, 55, 'destroy_npc', NULL, 72, 0),
(33, 100, 'destroy_npc', NULL, 74, 0),
(34, 50, 'destroy_npc', NULL, 46, 0),
(35, 100, 'destroy_npc', NULL, 77, 0),
(36, 45, 'destroy_npc', NULL, 76, 0),
(37, 75, 'destroy_npc', NULL, 28, 0),
(38, 35, 'destroy_npc', NULL, 77, 0),
(39, 100, 'destroy_npc', NULL, 79, 0),
(40, 100, 'destroy_npc', NULL, 78, 0),
(41, 70, 'destroy_npc', NULL, 118, 0),
(42, 60, 'destroy_npc', NULL, 35, 0),
(43, 100, 'destroy_npc', NULL, 29, 0),
(44, 50, 'destroy_npc', NULL, 80, 0),
(45, 1, 'destroy_npc', NULL, 80, 0),
(46, 100, 'destroy_npc', NULL, 81, 0),
(47, 100, 'destroy_npc', NULL, 76, 0),
(48, 45, 'destroy_npc', NULL, 27, 0),
(49, 100, 'destroy_npc', NULL, 6027, 0),
(50, 50, 'destroy_npc', NULL, 6028, 0),
(51, 100, 'destroy_npc', NULL, 85, 0),
(52, 100, 'destroy_npc', NULL, 34, 0),
(53, 45, 'destroy_npc', NULL, 114, 0),
(54, 50, 'destroy_npc', NULL, 111, 0),
(55, 25, 'destroy_npc', NULL, 113, 0),
(56, 20, 'destroy_npc', NULL, 112, 0),
(57, 50, 'destroy_npc', NULL, 36, 0),
(58, 50, 'destroy_npc', NULL, 44, 0),
(59, 50, 'destroy_npc', NULL, 38, 0),
(60, 65, 'destroy_npc', NULL, 40, 0),
(61, 60, 'destroy_npc', NULL, 38, 0),
(62, 60, 'destroy_npc', NULL, 43, 0),
(63, 50, 'destroy_npc', NULL, 41, 0),
(64, 100, 'destroy_npc', NULL, 37, 0),
(65, 80, 'destroy_npc', NULL, 38, 0),
(66, 50, 'destroy_npc', NULL, 43, 0),
(67, 50, 'destroy_npc', NULL, 45, 0),
(68, 3, 'destroy_npc', NULL, 84, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `server_quests_tasks_temp`
--

CREATE TABLE `server_quests_tasks_temp` (
  `questId` bigint(20) DEFAULT NULL,
  `taskId` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `server_quests_tasks_temp`
--

INSERT INTO `server_quests_tasks_temp` (`questId`, `taskId`) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 4),
(3, 5),
(4, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10),
(5, 11),
(6, 12),
(6, 13),
(6, 14),
(7, 15),
(7, 16),
(8, 17),
(8, 18),
(8, 19),
(9, 20),
(9, 21),
(9, 22),
(10, 23),
(10, 24),
(10, 25),
(10, 26),
(11, 27),
(11, 28),
(11, 29),
(12, 30),
(12, 31),
(12, 32),
(13, 33),
(14, 34),
(15, 35),
(15, 36),
(16, 37),
(16, 38),
(17, 39),
(18, 40),
(19, 41),
(20, 42),
(21, 43),
(22, 44),
(23, 45),
(23, 46),
(24, 47),
(24, 48),
(25, 49),
(25, 50),
(26, 51),
(26, 52),
(27, 53),
(27, 54),
(27, 55),
(27, 56),
(28, 57),
(28, 58),
(28, 59),
(29, 60),
(29, 61),
(29, 62),
(30, 63),
(31, 64),
(31, 65),
(31, 66),
(32, 67),
(33, 68);

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
  `reward` varchar(2048) COLLATE utf8_bin NOT NULL DEFAULT '{"Experience":0,"Honor":0,"Credits":0,"Uridium":0}',
  `isdesign` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- A tábla adatainak kiíratása `server_ships`
--

INSERT INTO `server_ships` (`id`, `shipID`, `baseShipId`, `lootID`, `name`, `health`, `shield`, `speed`, `lasers`, `generators`, `cargo`, `aggressive`, `damage`, `respawnable`, `reward`, `isdesign`) VALUES
(47, 1, 1, 'ship_phoenix', 'Phoenix', 4000, 0, 320, 1, 1, 100, 0, 0, 0, '{\"Experience\":100,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 0),
(48, 2, 2, 'ship_yamato', 'Yamato', 8000, 0, 260, 8, 12, 1000, 0, 0, 0, '{\"Experience\":200,\"Honor\":2,\"Credits\":0,\"Uridium\":0}', 0),
(49, 3, 3, 'ship_leonov', 'Leonov', 160000, 0, 300, 6, 6, 1000, 0, 0, 0, '{\"Experience\":1200,\"Honor\":120,\"Credits\":0,\"Uridium\":0}', 0),
(50, 4, 4, 'ship_defcom', 'Defcom', 16000, 0, 280, 12, 8, 800, 0, 0, 0, '{\"Experience\":400,\"Honor\":4,\"Credits\":0,\"Uridium\":0}', 0),
(51, 5, 5, 'ship_liberator', 'Liberator', 16000, 0, 330, 4, 6, 400, 0, 0, 0, '{\"Experience\":1600,\"Honor\":16,\"Credits\":0,\"Uridium\":0}', 0),
(52, 6, 6, 'ship_piranha', 'Piranha', 164000, 0, 360, 6, 8, 600, 0, 0, 0, '{\"Experience\":3200,\"Honor\":32,\"Credits\":0,\"Uridium\":0}', 0),
(53, 7, 7, 'ship_nostromo', 'Nostromo', 128000, 0, 284, 7, 10, 700, 0, 0, 0, '{\"Experience\":6400,\"Honor\":64,\"Credits\":0,\"Uridium\":0}', 0),
(54, 8, 8, 'ship_vengeance', 'Vengeance', 280000, 0, 320, 10, 10, 1000, 0, 0, 0, '{\"Experience\":12800,\"Honor\":128,\"Credits\":0,\"Uridium\":0}', 0),
(55, 9, 9, 'ship_bigboy', 'Bigboy', 260000, 0, 217, 8, 15, 700, 0, 0, 0, '{\"Experience\":25600,\"Honor\":256,\"Credits\":0,\"Uridium\":0}', 0),
(56, 10, 10, 'ship_goliath', 'Goliath', 356000, 0, 300, 15, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":5}', 0),
(57, 12, 0, 'pet', 'P.E.T. Level 1-3', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":0,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 0),
(58, 13, 0, 'pet', 'P.E.T. Red', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":0,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 0),
(59, 15, 0, 'pet', 'P.E.T. Frozen', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":0,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 0),
(60, 16, 8, 'ship_vengeance_design_adept', 'Adept', 280000, 0, 320, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(61, 17, 8, 'ship_vengeance_design_corsair', 'Corsair', 280000, 0, 320, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(62, 18, 8, 'ship_vengeance_design_lightning', 'Lightning', 280000, 0, 320, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(63, 19, 10, 'ship_goliath_design_jade', 'Jade +10DMG+25HP\r\n\r\n', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(64, 20, 0, 'ship_admin', 'Ufo', 256000, 0, 1000, 0, 0, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(65, 22, 0, 'pet', 'P.E.T. Normal', 0, 50000, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":5}', 0),
(66, 49, 49, 'ship_aegis', 'Aegis', 375000, 0, 300, 10, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(67, 52, 10, 'ship_goliath_design_amber', 'Amber', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(68, 53, 10, 'ship_goliath_design_crimson', 'Crimson', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(69, 54, 10, 'ship_goliath_design_sapphire', 'Sapphire', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(70, 56, 10, 'ship_goliath_design_enforcer', 'Enforcer', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(71, 57, 10, 'ship_goliath_design_independence', 'G-Burn', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(72, 58, 8, 'ship_vengeance_design_revenge', 'Revenge', 280000, 0, 320, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(73, 59, 10, 'ship_goliath_design_bastion', 'Bastion', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(74, 60, 8, 'ship_vengeance_design_avenger', 'Avenger', 280000, 0, 320, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(75, 14, 0, 'pet', 'P.E.T. Green', 0, 0, 0, 0, 0, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":5}', 0),
(76, 62, 10, 'ship_goliath_design_exalted', 'Exalted', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(77, 63, 63, 'ship_goliath_design_solace', 'Solace', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
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
(89, 98, 98, 'ship_police', 'PoliceShip', 500000000, 50000000, 3000, 20, 20, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
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
(112, 79, 0, 'ship79', '-=[ Kristallon ]=-', 400000, 400000, 200, 1, 1, 100, 0, 5000, 1, '{\"Experience\":215500,\"Honor\":768,\"Credits\":1715000,\"Uridium\":1500}', 0),
(113, 78, 0, 'ship78', '-=[ Kristallin ]=-', 100000, 80000, 300, 1, 1, 100, 1, 1200, 1, '{\"Experience\":19200,\"Honor\":96,\"Credits\":150600,\"Uridium\":350}', 0),
(114, 35, 0, 'ship35', '..::{ Boss Kristallon }::..', 1600000, 1200000, 200, 1, 1, 100, 0, 20000, 1, '{\"Experience\":614400,\"Honor\":3072,\"Credits\":3276800,\"Uridium\":5120}', 0),
(115, 29, 0, 'ship29', '..::{ Boss Kristallin }::..', 400000, 320000, 300, 1, 1, 100, 1, 4800, 1, '{\"Experience\":58200,\"Honor\":3072,\"Credits\":307200,\"Uridium\":800}', 0),
(116, 85, 0, 'ship85', '..::{ StreuneR}::..', 80000, 60000, 200, 1, 1, 100, 0, 3000, 1, '{\"Experience\":18000,\"Honor\":90,\"Credits\":24000,\"Uridium\":150}', 0),
(117, 99, 0, 'ship99', '..::{ Deyeks}::..', 700000, 500000, 400, 1, 1, 100, 1, 15000, 1, '{\"Experience\":11200,\"Honor\":1448,\"Credits\":512000,\"Uridium\":2800}', 0),
(118, 118, 0, 'ship118', '..::{ Boss Curcubitor }::..', 6200000, 6200000, 300, 1, 1, 0, 0, 17000, 1, '{\"Experience\":500120,\"Honor\":10000,\"Credits\":2500000,\"Uridium\":14000}', 0),
(119, 80, 0, 'ship80', '..::{Cubikon}::..', 1600000, 1200000, 0, 2, 2, 100, 0, 15000, 1, '{\"Experience\":1536000,\"Honor\":12288,\"Credits\":3276800,\"Uridium\":15240}', 0),
(120, 116, 0, 'ship116', '..::{Stroner}::..', 1500000, 1200000, 180, 2, 2, 100, 0, 18000, 1, '{\"Experience\":710020,\"Honor\":15500,\"Credits\":2300000,\"Uridium\":8500}', 0),
(121, 103, 0, 'ship103', '<=<Icy>=>', 100000, 80000, 475, 2, 2, 100, 1, 2000, 1, '{\"Experience\":19200,\"Honor\":96,\"Credits\":38400,\"Uridium\":160}', 0),
(122, 107, 0, 'ship107', 'COVID-19[MUTATED]', 50000, 30000, 650, 5, 1, 1, 1, 4500, 1, '{\"Experience\":512000,\"Honor\":1012,\"Credits\":51002,\"Uridium\":125}', 0),
(123, 246, 246, 'ship_hammerclaw', 'hammerclaw', 377500, 0, 310, 12, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(124, 900, 900, 'mimesis', 'Mimesis', 386000, 0, 300, 14, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(125, 901, 901, 'mimesis_design_carbonite', 'Mimesis-Carbonite', 386000, 0, 300, 14, 14, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(126, 1000, 1000, 'tartarus', 'tartarus', 360000, 0, 300, 14, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(127, 1001, 1001, 'ship_tartarus_design_tartarus-epion', 'tartarus-epion', 360000, 0, 300, 14, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(128, 1002, 1002, 'ship_tartarus_design_tartarus-osiris', 'tartarus-osiris', 360000, 0, 300, 14, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(129, 1003, 1003, 'ship_tartarus_design_tartarus-smite', 'tartarus-smite', 360000, 0, 300, 14, 15, 1500, 0, 0, 0, '{\"Experience\":1200,\"Honor\":2,\"Credits\":512,\"Uridium\":20}', 0),
(130, 84, 0, 'ship84', '-=[ Streuner ]=-', 800, 400, 270, 1, 1, 100, 0, 20, 1, '{\"Experience\":1200,\"Honor\":6,\"Credits\":6200,\"Uridium\":25}', 0),
(131, 23, 0, 'ship23', '..::{ Boss Streuner }::..', 3200, 1600, 250, 1, 1, 100, 0, 80, 1, '{\"Experience\":4800,\"Honor\":24,\"Credits\":14800,\"Uridium\":50}', 0),
(132, 71, 0, 'ship71', '-=[ Lordakia ]=-', 2000, 2000, 300, 1, 1, 100, 1, 80, 1, '{\"Experience\":2400,\"Honor\":12,\"Credits\":9400,\"Uridium\":30}', 0),
(133, 73, 0, 'ship73', '-=[ Mordon ]=-', 20000, 10000, 80, 1, 1, 100, 1, 400, 1, '{\"Experience\":9600,\"Honor\":48,\"Credits\":12800,\"Uridium\":80}', 0),
(134, 31, 0, 'ship31', '-=[ Boss Mordon]=-', 80000, 40000, 80, 1, 1, 100, 1, 1600, 1, '{\"Experience\":38400,\"Honor\":192,\"Credits\":51200,\"Uridium\":320}', 0),
(135, 75, 0, 'ship75', '-=[ Saimon ]=-', 6000, 3000, 300, 1, 1, 100, 1, 200, 1, '{\"Experience\":4800,\"Honor\":24,\"Credits\":3200,\"Uridium\":40}', 0),
(136, 25, 0, 'ship25', '-=[ Boss Saimon ]=-', 24000, 12000, 300, 1, 1, 100, 1, 800, 1, '{\"Experience\":19200,\"Honor\":96,\"Credits\":12800,\"Uridium\":160}', 0),
(137, 72, 0, 'ship72', '-=[ Devolarium ]=-', 100000, 100000, 150, 1, 1, 100, 1, 1200, 1, '{\"Experience\":19200,\"Honor\":96,\"Credits\":102400,\"Uridium\":320}', 0),
(138, 26, 0, 'ship26', '-=[ Boss Devolarium ]=-', 400000, 400000, 150, 1, 1, 100, 1, 4800, 1, '{\"Experience\":76800,\"Honor\":384,\"Credits\":409800,\"Uridium\":640}', 0),
(139, 34, 0, 'ship34', '-=[ Boss StreuneR ]=-', 80000, 40000, 200, 1, 1, 100, 1, 1400, 1, '{\"Experience\":38580,\"Honor\":192,\"Credits\":51200,\"Uridium\":320}', 0),
(140, 46, 0, 'ship46', '-=[ Boss-Sibelon ]=-', 800000, 800000, 100, 1, 1, 100, 1, 12000, 1, '{\"Experience\":153600,\"Honor\":768,\"Credits\":819200,\"Uridium\":1580}', 0),
(141, 27, 0, 'ship27', '..::( Boss Sibelonit )::..', 160000, 160000, 300, 1, 1, 100, 1, 4000, 1, '{\"Experience\":38400,\"Honor\":192,\"Credits\":102400,\"Uridium\":580}', 0),
(142, 81, 0, 'ship81', '-=[ Protegit]=-', 50000, 40000, 500, 2, 2, 100, 1, 1400, 1, '{\"Experience\":19200,\"Honor\":96,\"Credits\":25600,\"Uridium\":160}', 0),
(143, 1005, 0, 'ship_yamato', 'Yamato', 260000, 0, 260, 8, 12, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(144, 1006, 0, 'ship_leonov', 'Leonov', 160000, 0, 300, 6, 6, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(145, 1007, 0, 'ship_defcom', 'Defcom', 250000, 0, 340, 12, 8, 800, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(146, 1008, 0, 'ship_liberator', 'Liberator', 116000, 0, 330, 4, 6, 400, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(147, 1009, 0, 'ship_piranha', 'Piranha', 164000, 0, 360, 6, 8, 600, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(148, 1010, 0, 'ship_nostromo', 'Nostromo', 220000, 0, 340, 7, 10, 700, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(149, 1011, 0, 'ship_vengeance', 'Vengeance', 280000, 0, 380, 10, 10, 1000, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(150, 1012, 0, 'ship_goliath', 'Goliath', 356000, 0, 300, 15, 15, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(151, 1013, 10, 'ship_goliath_design_kick', 'Kick', 750000, 0, 450, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(152, 1014, 0, 'ship_goliath_design_referee', 'Referee', 750000, 0, 450, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(153, 1015, 0, 'ship_goliath_design_goal', 'Goal', 750000, 0, 450, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(154, 1016, 0, 'ship_vengeance_design_pusatborra', 'Pusat', 1250000, 0, 300, 16, 17, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(155, 1017, 0, 'ship_venom_design_venom-inferno borrar', 'Cyborg Inferno', 1250000, 0, 350, 18, 18, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(156, 1018, 0, 'ship_hammerclaw-lava borrar', 'hammerclaw-lava borrar', 1250000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(157, 1020, 0, 'mimesis_design_carbonite mirar', 'mimesis_design_carbonite', 1250000, 0, 300, 16, 17, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(158, 1021, 0, 'ship_goliath_design_enforcer', 'Enforcer', 750000, 0, 450, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(159, 1022, 0, 'ship_vengeance_design_lightning', 'Lightning', 1250000, 0, 450, 10, 10, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(160, 42, 0, 'ship42', '[ Uber Kristallin ]', 400000, 320000, 300, 1, 1, 100, 1, 9600, 1, '{\"Experience\":153600,\"Honor\":768,\"Credits\":204800,\"Uridium\":5280}', 0),
(161, 45, 0, 'ship45', '[ Uber-Kristallon ]', 3200000, 2400000, 200, 1, 1, 100, 0, 40000, 1, ' {\"Experience\":1228800,\"Honor\":6144,\"Credits\":6553600,\"Uridium\":100240}', 0),
(162, 33, 0, 'ship33', '-=: Ice Meteorit :=-', 1600000, 1200000, 200, 1, 1, 100, 0, 2000, 1, '{\"Experience\":3000000,\"Honor\":15000,\"Credits\":6000000,\"Uridium\":18000}', 0),
(163, 47, 0, 'ship47', '[ Uber Sibelon ]', 1600000, 1600000, 100, 1, 1, 100, 0, 24000, 1, '{\"Experience\":307200,\"Honor\":1536,\"Credits\":1638400,\"Uridium\":20560}', 0),
(164, 83, 0, 'ship83', '[ Uber Kucurbium ]', 60000000, 60000000, 200, 1, 1, 100, 0, 75000, 1, '{\"Experience\":13107200,\"Honor\":522880,\"Credits\":23932160,\"Uridium\":70960}', 0),
(165, 500, 10, 'ship_goliath_design_gold', 'Goliath-Gold', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(166, 499, 10, 'ship_goliath_design_silver', 'Goliath-Silver', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(167, 498, 10, 'ship_goliath_design_bronze', 'Goliath-Bronze', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(168, 497, 156, 'surgeon-cicada borrar', 'borrar', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(169, 496, 10, 'ship_goliath_design_cbs-design', 'MYSTERIOUS', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(170, 11, 0, 'ship11', '-=[ DemaNeR ]=-', 512000, 256000, 400, 1, 1, 100, 1, 5000, 1, '{\"Experience\":153600,\"Honor\":1536,\"Credits\":819200,\"Uridium\":2560}', 0),
(171, 126, 0, 'ship126', 'DemaNeR Freighter', 20000000, 180000000, 120, 1, 1, 100, 1, 15000, 1, '{\"Experience\":9000000,\"Honor\":90000,\"Credits\":24000000,\"Uridium\":300000}', 0),
(172, 127, 0, 'ship127', '-=[ Skoll ]=- ', 3000000, 2700000, 200, 1, 1, 100, 1, 30000, 1, '{\"Experience\":600000,\"Honor\":82000,\"Credits\":3000000,\"Uridium\":23500}', 0),
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
(183, 273, 245, 'ship_cyborg_design_cyborg-carbonite', 'Cyborg-Carbonite', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(184, 274, 245, 'ship_cyborg_design_cyborg-firestar', 'Cyborg-Firestar', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(185, 486, 10, 'ship_spectrum_design_spectrum-dusklight', 'Spectrum-dusklight', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(186, 487, 10, 'ship_spectrum_design_spectrum-legend', 'Spectrum-Legend', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(187, 265, 10, 'ship_sentinel_design_sentinel-argon', 'Sentinel-Argon', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(188, 266, 10, 'ship_sentinel_design_sentinel-legend', 'Sentinel-Legend', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(189, 268, 10, 'ship_diminisher_design_diminisher-argon', 'Diminisher-Argon', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(190, 269, 10, 'ship_diminisher_design_diminisher-legend', 'Diminisher-Legend', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(191, 275, 245, 'ship_cyborg_design_cyborg-nobilis', 'Cyborg-Nobilis', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(192, 276, 245, 'ship_cyborg_design_cyborg-scourge', 'Cyborg-Scourge', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(193, 277, 245, 'ship_cyborg_design_cyborg-inferno', 'Cyborg-Inferno', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
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
(244, 255, 255, 'ship_cyborg_design_cyborg-starscream', 'Cyborg-Starscream', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(245, 256, 245, 'ship_cyborg_design_cyborg-celestial', 'Cyborg-Celestial', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(246, 257, 245, 'ship_cyborg_design_cyborg-maelstrom', 'Cyborg-Maelstrom', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(247, 258, 245, 'ship_cyborg_design_cyborg-asimov', 'Cyborg-Asimov', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(248, 259, 245, 'ship_cyborg_design_cyborg-tyrannos', 'Cyborg-Tyrannos', 356000, 0, 300, 16, 16, 1500, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(249, 260, 10, 'ship_solace_design_solace-frost', 'Solace-Frost', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(250, 343, 10, 'ship_sentinel_design_sentinel-asimov', 'Sentinel-Asimov', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(251, 344, 10, 'ship_sentinel_design_sentinel-arios', 'Sentinel-Arios', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(252, 345, 10, 'ship_sentinel_design_sentinel-neikos', 'Sentinel-Neikos', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(253, 346, 10, 'ship_sentinel_design_sentinel-lava', 'Sentinel-Lava', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(254, 347, 10, 'ship_sentinel_design_sentinel-tyrannos', 'Sentinel-Tyrannos', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
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
(265, 359, 10, 'ship_solace_design_solace-inferno', 'Solace-Inferno', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
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
(292, 122, 0, 'ship122', '[ Emperor-Kristallon ]', 14080000, 11100000, 350, 1, 1, 0, 0, 100000, 1, '{\"Experience\":4608000,\"Honor\":24576,\"Credits\":10000000,\"Uridium\":368640}', 0),
(293, 124, 0, 'ship124', '[ Emperor-Sibelon ]', 6400000, 6400000, 350, 1, 1, 0, 0, 35000, 1, '{\"Experience\":1228800,\"Honor\":6144,\"Credits\":2800000,\"Uridium\":61440}', 0),
(294, 119, 0, 'ship119', '..::{ Curcubitor }::..', 250000, 150000, 250, 1, 1, 0, 0, 2000, 1, '{\"Experience\":15000,\"Honor\":150,\"Credits\":36000,\"Uridium\":172}', 0),
(295, 123, 0, 'ship123', '[ Emperor-Lordakium ]', 9600000, 6400000, 350, 1, 1, 0, 0, 45000, 1, '{\"Experience\":1930000,\"Honor\":35440,\"Credits\":10000000,\"Uridium\":152880}', 0),
(296, 82, 0, 'ship82', '..::{ Kucurbium }::..', 5000000, 5000000, 200, 1, 1, 100, 0, 25000, 1, '{\"Experience\":819200,\"Honor\":14096,\"Credits\":24000000,\"Uridium\":20480}', 0),
(297, 97, 0, 'ship97', '..::{ Ravager }::..', 300000, 200000, 340, 1, 1, 100, 1, 10000, 1, '{\"Experience\":150000,\"Honor\":192,\"Credits\":320000,\"Uridium\":1280}', 0),
(298, 96, 0, 'ship96', '..::{ Hooligan }::..', 250000, 200000, 340, 1, 1, 100, 1, 10000, 1, '{\"Experience\":120000,\"Honor\":96,\"Credits\":256000,\"Uridium\":640}', 0),
(299, 95, 0, 'ship95', '..::{ Convict }::..', 400000, 200000, 345, 1, 1, 100, 1, 11000, 1, '{\"Experience\":180000,\"Honor\":300,\"Credits\":440000,\"Uridium\":1500}', 0),
(300, 90, 0, 'ship90', '..::{ Century-Falcon }::..', 36000000, 27000000, 320, 1, 1, 100, 1, 66000, 1, '{\"Experience\":24000000,\"Honor\":390000,\"Credits\":45000000,\"Uridium\":450000}', 0),
(301, 91, 0, 'ship91', '..::{ Corsair }::..', 200000, 120000, 335, 1, 1, 100, 1, 8000, 1, '{\"Experience\":90000,\"Honor\":48,\"Credits\":240000,\"Uridium\":320}', 0),
(302, 92, 0, 'ship92', '..::{ Outcast }::..', 150000, 80000, 320, 1, 1, 100, 1, 5000, 1, '{\"Experience\":60000,\"Honor\":36,\"Credits\":150000,\"Uridium\":240}', 0),
(303, 93, 0, 'ship93', '..::{ Marauder }::..', 100000, 60000, 325, 1, 1, 100, 1, 4500, 1, '{\"Experience\":48000,\"Honor\":24,\"Credits\":90000,\"Uridium\":160}', 0),
(304, 94, 0, 'ship94', '..::{ Vagrant }::..', 40000, 40000, 345, 1, 1, 100, 1, 2500, 1, '{\"Experience\":9000,\"Honor\":12,\"Credits\":30000,\"Uridium\":80}', 0),
(305, 24, 0, 'ship24', '..::( Boss Lordakia )::..', 8000, 8000, 320, 1, 1, 100, 1, 320, 1, '{\"Experience\":9600,\"Honor\":48,\"Credits\":9600,\"Uridium\":100}', 0),
(306, 76, 0, 'ship76', '-=[ Sibelonit ]=-', 40000, 40000, 300, 1, 1, 100, 1, 1000, 1, '{\"Experience\":9600,\"Honor\":48,\"Credits\":38400,\"Uridium\":220}', 0),
(307, 77, 0, 'ship77', '-=[ Lordakium ]=-', 300000, 300000, 200, 1, 1, 100, 0, 4000, 1, '{\"Experience\":76800,\"Honor\":384,\"Credits\":409600,\"Uridium\":800}', 0),
(308, 28, 0, 'ship28', '..::( Boss Lordakium )::..', 1200000, 800000, 200, 1, 1, 100, 0, 16000, 1, '{\"Experience\":307200,\"Honor\":1536,\"Credits\":1638400,\"Uridium\":2560}', 0),
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
(338, 36, 0, 'ship36', '[ Uber-Streuner ]', 6400, 3200, 160, 1, 1, 100, 1, 160, 1, '{\"Experience\":9600,\"Honor\":48,\"Credits\":6400,\"Uridium\":180}', 0),
(339, 37, 0, 'ship37', '[ Uber-Lordakia ]', 16000, 16000, 300, 1, 1, 100, 1, 640, 1, '{\"Experience\":19200,\"Honor\":96,\"Credits\":12800,\"Uridium\":260}', 0),
(340, 38, 0, 'ship38', '[ Uber-Saimon ]', 48000, 24000, 300, 1, 1, 100, 1, 1600, 1, '{\"Experience\":38400,\"Honor\":192,\"Credits\":38400,\"Uridium\":320}', 0),
(341, 43, 0, 'ship43', '[ Uber-Mordon ]', 160000, 80000, 80, 1, 1, 100, 1, 3200, 1, '{\"Experience\":76800,\"Honor\":384,\"Credits\":102400,\"Uridium\":640}', 0),
(342, 39, 0, 'ship39', '[ Uber-Devolarium ]', 800000, 800000, 150, 1, 1, 100, 1, 9600, 1, '{\"Experience\":153600,\"Honor\":768,\"Credits\":819200,\"Uridium\":10280}', 0),
(343, 74, 0, 'ship74', '-=[ Sibelon ]=-', 200000, 200000, 100, 1, 1, 100, 0, 3000, 1, '{\"Experience\":38400,\"Honor\":192,\"Credits\":504800,\"Uridium\":520}', 0),
(344, 40, 0, 'ship40', '[ Uber-Sibelonit ]', 320000, 320000, 300, 1, 1, 100, 1, 8000, 1, '{\"Experience\":76800,\"Honor\":384,\"Credits\":204800,\"Uridium\":960}', 0),
(345, 41, 0, 'ship41', '[ Uber-Lordakium ]', 2400000, 1600000, 200, 1, 1, 100, 0, 32000, 1, '{\"Experience\":614400,\"Honor\":3072,\"Credits\":3276800,\"Uridium\":50120}', 0),
(346, 44, 0, 'ship44', '[ Uber-StreuneR ]', 160000, 80000, 250, 1, 1, 100, 1, 7500, 1, '{\"Experience\":76800,\"Honor\":384,\"Credits\":102400,\"Uridium\":640}', 0),
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
(371, 452, 452, 'ship_cyborg_design_cyborg-argon', 'Cyborg-Argon', 356000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
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
(388, 213, 0, 'black_light1', 'Impulse II', 1200000, 750000, 450, 1, 1, 0, 1, 12000, 1, '{\"Experience\":165000,\"Honor\":600,\"Credits\":400000,\"Uridium\":1450}', 0),
(389, 384, 10, 'ship_diminisher-prometheus', 'Diminisher-Prometheus', 356000, 0, 300, 15, 15, 0, 0, 0, 0, '{\"Experience\":112000,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(390, 214, 0, 'black_light2', 'Attend XI', 9000000, 4800000, 150, 1, 1, 0, 1, 17000, 1, '{\"Experience\":1050000,\"Honor\":2250,\"Credits\":3000000,\"Uridium\":18750}', 0),
(391, 215, 0, 'black_light3', 'Invoke XVI', 36000000, 1000000, 0, 1, 1, 0, 1, 30000, 1, '{\"Experience\":10500000,\"Honor\":60000,\"Credits\":18000000,\"Uridium\":20000}', 0),
(392, 216, 0, 'black_light4', 'Mindfire Behemoth', 135000000, 1000000, 0, 1, 1, 0, 1, 145000, 1, '{\"Experience\":240000000,\"Honor\":1500000,\"Credits\":40000000,\"Uridium\":25000}', 0),
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
(405, 114, 0, 'ship114', '..::{ Annihilator }::..', 300000, 200000, 350, 1, 1, 100, 1, 15000, 1, '{\"Experience\":225000,\"Honor\":384,\"Credits\":500000,\"Uridium\":650}', 0),
(406, 111, 0, 'ship111', '..::{ Interceptor }::..', 60000, 40000, 600, 1, 1, 100, 1, 500, 1, '{\"Experience\":22500,\"Honor\":120,\"Credits\":50000,\"Uridium\":200}', 0),
(407, 113, 0, 'ship113', '..::{ Saboteur }::..', 200000, 150000, 450, 1, 1, 100, 0, 4000, 1, '{\"Experience\":67500,\"Honor\":216,\"Credits\":250000,\"Uridium\":450}', 0),
(408, 112, 0, 'ship112', '.::{ Barracuda }::..', 180000, 100000, 500, 1, 1, 100, 1, 6000, 1, '{\"Experience\":45000,\"Honor\":168,\"Credits\":180000,\"Uridium\":250}', 0),
(409, 115, 0, 'ship115', '..::{ Battleray }::..', 330000, 260000, 350, 1, 1, 0, 0, 7000, 1, '{\"Experience\":249900,\"Honor\":480,\"Credits\":2300320,\"Uridium\":1160}', 0),
(410, 1990, 10, 'ship_goliath_design_inferno', 'Inferno', 356000, 0, 360, 20, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(411, 2500, 10, 'ship_solace-dark-white', 'Solace-Black', 356000, 0, 360, 50, 50, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(412, 2502, 10, 'ship_solace-dark-blue', 'Solace-DarkBlue', 356000, 0, 360, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(413, 2501, 10, 'ship_solace-dark-purple', 'Solace-Purple', 356000, 0, 300, 16, 16, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(414, 5000, 10, 'ship_solace-custom1', 'Solace-Yellow', 356000, 0, 300, 20, 20, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(415, 5041, 10, 'ship_g-champion-blue', 'Champion-Blue', 356000, 0, 300, 15, 15, 100, 0, 20, 0, '{\"Experience\":0,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 1),
(416, 5042, 10, 'ship_g-champion-lightblue', 'Champion-LightBlue', 356000, 0, 300, 15, 15, 100, 0, 20, 0, '{\"Experience\":0,\"Honor\":0,\"Credits\":0,\"Uridium\":0}', 0),
(417, 1409, 1400, 'ship_orcus-celestial', 'Orcus Celestial', 385000, 0, 300, 16, 15, 0, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(418, 173, 10, 'ship_sentinel_design_sentinel-expo2016', 'Sentinel-Expo2016', 356000, 0, 300, 15, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(419, 1405, 1400, 'ship_orcus-ullrin', 'Orcus ullrin', 385000, 0, 300, 16, 15, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 1),
(420, 163, 163, 'ship_goliath-plus', 'Goliath Plus', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(421, 164, 164, 'ship_citadel-plus', 'Citadel Plus', 700000, 0, 240, 10, 20, 20, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(422, 165, 165, 'ship_liberator-plus', 'Liberator Plus', 275000, 0, 330, 12, 12, 100, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(423, 6000, 0, 'ship6000', '-=[ Saturn Phoenix ]=-', 4000, 1000, 320, 1, 1, 100, 1, 150, 1, '{\"Experience\":100,\"Honor\":10,\"Credits\":4000,\"Uridium\":5}', 0),
(424, 6001, 0, 'ship6001', '-=[ Saturn Liberator ]=-', 16000, 60000, 300, 1, 1, 100, 1, 900, 1, '{\"Experience\":1600,\"Honor\":16,\"Credits\":3200,\"Uridium\":12}', 0),
(425, 6002, 0, 'ship6002', '-=[ Saturn Yamato ]=-', 8000, 20000, 280, 1, 1, 100, 1, 400, 1, '{\"Experience\":200,\"Honor\":2,\"Credits\":800,\"Uridium\":7}', 0),
(426, 6003, 0, 'ship6003', '-=[ Saturn Defcom ]=-', 12000, 50000, 280, 1, 1, 100, 1, 500, 1, '{\"Experience\":800,\"Honor\":8,\"Credits\":1600,\"Uridium\":9}', 0),
(427, 6004, 0, 'ship6004', '-=[ Saturn Piranha ]=-', 64000, 80000, 300, 1, 1, 100, 1, 900, 1, '{\"Experience\":3200,\"Honor\":64,\"Credits\":6400,\"Uridium\":15}', 0),
(428, 6005, 0, 'ship6005', '-=[ Saturn Leonov ]=-', 160000, 60000, 300, 1, 1, 100, 1, 5000, 1, '{\"Experience\":12800,\"Honor\":65,\"Credits\":25600,\"Uridium\":25}', 0),
(429, 6006, 0, 'ship6006', '-=[ Saturn Nostromo ]=-', 64000, 80000, 290, 1, 1, 100, 1, 900, 1, '{\"Experience\":6400,\"Honor\":64,\"Credits\":6400,\"Uridium\":18}', 0),
(430, 6007, 0, 'ship6007', '-=[ Saturn Bigboy ]=-', 260000, 130000, 260, 1, 1, 100, 1, 5500, 1, '{\"Experience\":45500,\"Honor\":450,\"Credits\":35500,\"Uridium\":25}', 0),
(431, 6008, 0, 'ship6008', '-=[ Saturn Goliath ]=-', 256000, 150000, 300, 1, 1, 100, 1, 7000, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(432, 6009, 0, 'ship6009', '-=[ Saturn Vengeance ]=-', 180000, 100000, 320, 1, 1, 100, 1, 3000, 1, '{\"Experience\":12800,\"Honor\":128,\"Credits\":25600,\"Uridium\":28}', 0),
(433, 6010, 0, 'ship6010', '-=[ Saturn Jade ]=-', 256000, 150000, 300, 1, 1, 100, 1, 7000, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(434, 6011, 0, 'ship6011', '-=[ Saturn Sapphire ]=-', 256000, 150000, 300, 1, 1, 100, 1, 7000, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(435, 6012, 0, 'ship6012', '-=[ Saturn Crimson ]=-', 256000, 150000, 300, 1, 1, 100, 1, 7000, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(436, 6013, 0, 'ship6013', '-=[ Saturn Spearhead ]=-', 100000, 120000, 370, 1, 1, 100, 1, 7500, 1, '{\"Experience\":7500,\"Honor\":75,\"Credits\":2000,\"Uridium\":20}', 0),
(437, 6014, 0, 'ship6014', '-=[ Saturn Lightning ]=-', 180000, 100000, 320, 1, 1, 100, 1, 3000, 1, '{\"Experience\":12800,\"Honor\":128,\"Credits\":25600,\"Uridium\":28}', 0),
(438, 6015, 0, 'ship6015', '-=[ Saturn Revenge ]=-', 180000, 100000, 320, 1, 1, 100, 1, 3000, 1, '{\"Experience\":12800,\"Honor\":128,\"Credits\":25600,\"Uridium\":28}', 0),
(439, 6016, 0, 'ship6016', '-=[ Saturn Avenger ]=-', 180000, 100000, 320, 1, 1, 100, 1, 3000, 1, '{\"Experience\":12800,\"Honor\":128,\"Credits\":25600,\"Uridium\":28}', 0),
(440, 6017, 0, 'ship6017', '-=[ Saturn Enforcer ]=-', 256000, 150000, 300, 1, 1, 100, 1, 8500, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(441, 6018, 0, 'ship6018', '-=[ Saturn Bastion ]=-', 256000, 200000, 300, 1, 1, 100, 1, 7000, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(442, 6019, 0, 'ship6019', '-=[ Saturn Aegis ]=-', 275, 150000, 300, 1, 1, 100, 1, 5000, 1, '{\"Experience\":2500,\"Honor\":250,\"Credits\":50000,\"Uridium\":56}', 0),
(443, 6020, 0, 'ship6020', '-=[ Saturn Citadel ]=-', 550000, 200000, 240, 1, 1, 100, 1, 6500, 1, '{\"Experience\":12000,\"Honor\":120,\"Credits\":80000,\"Uridium\":100}', 0),
(444, 6021, 0, 'ship6021', '-=[ Saturn Solace ]=-', 256000, 150000, 300, 1, 1, 100, 1, 8500, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(445, 6022, 0, 'ship6022', '-=[ Saturn Venom ]=-', 256000, 150000, 300, 1, 1, 100, 1, 8500, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(446, 6023, 0, 'ship6023', '-=[ Saturn Sentinel ]=-', 256000, 150000, 300, 1, 1, 100, 1, 7000, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(447, 6024, 0, 'ship6024', '-=[ Saturn Diminisher ]=-', 256000, 150000, 300, 1, 1, 100, 1, 8500, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(448, 6025, 0, 'ship6025', '-=[ Saturn Spectrum ]=-', 256000, 150000, 300, 1, 1, 100, 1, 7000, 1, '{\"Experience\":51200,\"Honor\":512,\"Credits\":45000,\"Uridium\":100}', 0),
(449, 6026, 0, 'ship6026', '-=[ Saturn Cyborg ]=-', 356000, 200000, 300, 1, 1, 100, 1, 15500, 1, '{\"Experience\":115500,\"Honor\":5500,\"Credits\":175000,\"Uridium\":350}', 0),
(450, 166, 166, 'ship_goliath-plus-amor', 'Goliath Plus Amor', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(451, 167, 167, 'ship_goliath-plus-ullrin', 'Goliath Plus Ullrin', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(452, 6027, 0, 'ship6027', '-=[Viral Kristallon]=-', 356000, 200000, 200, 1, 1, 100, 0, 2000, 1, '{\"Experience\":115500,\"Honor\":650,\"Credits\":175000,\"Uridium\":750}', 0),
(453, 6028, 0, 'ship6028', '-=[Viral Kristallin]=-', 200000, 150000, 300, 1, 1, 100, 1, 500, 1, '{\"Experience\":11550,\"Honor\":350,\"Credits\":17500,\"Uridium\":250}', 0),
(454, 168, 168, 'ship_citadel-plus-frost', 'Citadel Plus Frost', 700000, 0, 250, 10, 20, 20, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(455, 169, 169, 'ship_solace-plus', 'Solace Plus', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(456, 6029, 0, 'ship6029', '-=[Plutus Boss]=-', 3750000, 450000, 300, 1, 1, 100, 0, 15000, 1, '{\"Experience\":5000000,\"Honor\":500000,\"Credits\":5000000,\"Uridium\":5000}', 0),
(457, 6030, 0, 'ship6030', '-=[Plutus Turret]=-', 2750000, 350000, 300, 1, 1, 100, 0, 10000, 1, '{\"Experience\":2500000,\"Honor\":250000,\"Credits\":2500000,\"Uridium\":3000}', 0),
(458, 6031, 0, 'ship6031', '-=[Plutus Warhead]=-', 300000, 300000, 300, 1, 1, 100, 1, 3500, 1, '{\"Experience\":100000,\"Honor\":15000,\"Credits\":1000000,\"Uridium\":1500}', 0),
(459, 6032, 0, 'ship6032', '-=[Cote Lo]=-', 120000, 20000, 400, 1, 1, 100, 1, 2500, 1, '{\"Experience\":11000,\"Honor\":52,\"Credits\":82000,\"Uridium\":28}', 0),
(460, 6033, 0, 'ship6033', '-=[Cowering Cyborg]=-', 18000, 20000, 250, 1, 1, 100, 1, 550, 1, '{\"Experience\":4000,\"Honor\":20,\"Credits\":8000,\"Uridium\":9}', 0),
(461, 6034, 0, 'ship6034', '-=[Kodkod]=-', 350000, 50000, 300, 1, 1, 100, 0, 5000, 1, '{\"Experience\":3000,\"Honor\":156,\"Credits\":235000,\"Uridium\":75}', 0),
(462, 6035, 0, 'ship6035', '-=[ Aura Dun Jig ]=-', 320000, 320000, 300, 1, 1, 100, 0, 7500, 1, '{\"Experience\":48000,\"Honor\":235,\"Credits\":400000,\"Uridium\":128}', 0),
(463, 6036, 0, 'ship6036', '-=[Natal Nap]=- ​', 2500000, 150000, 150, 1, 1, 100, 0, 15000, 1, '{\"Experience\":200000,\"Honor\":999,\"Credits\":1555000,\"Uridium\":500}', 0),
(464, 6037, 0, 'ship6037', '-=[Lac Lion]=-', 950000, 150000, 500, 1, 1, 100, 0, 3500, 1, '{\"Experience\":70000,\"Honor\":350,\"Credits\":555000,\"Uridium\":175}', 0),
(465, 6038, 0, 'ship6038', '-=[Mordon Boss Abberation]=-', 320000, 200000, 80, 1, 1, 100, 1, 4800, 1, '{\"Experience\":67500,\"Honor\":2010,\"Credits\":125000,\"Uridium\":520}', 0),
(466, 6039, 0, 'ship6039', '-=[Mordon Abberation]=-', 160000, 100000, 80, 1, 1, 100, 1, 1200, 1, '{\"Experience\":37500,\"Honor\":1010,\"Credits\":75000,\"Uridium\":160}', 0),
(467, 6040, 0, 'ship6040', '-=[Devolarium Abberation]=-', 600000, 600000, 150, 1, 1, 100, 1, 6500, 1, '{\"Experience\":103600,\"Honor\":575,\"Credits\":512000,\"Uridium\":550}', 0),
(468, 180, 180, 'ship_goliath-plus-frost', 'Goliath Plus Frost', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(469, 181, 181, 'ship_goliath-plus-smite', 'Goliath Plus Smite', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(470, 182, 182, 'ship_goliath-plus-psyche', 'Goliath Plus Psyche', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(471, 183, 183, 'ship_goliath-plus-osiris', 'Goliath Plus Osiris', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(472, 184, 184, 'ship_goliath-plus-nobilis', 'Goliath Plus Nobilis', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(473, 185, 185, 'ship_goliath-plus-argon', 'Goliath Plus Argon', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":51200,\"Honor\":512,\"Credits\":0,\"Uridium\":512}', 0),
(474, 186, 186, 'ship_solace-plus-ullrin', 'Solace Plus Ullrin', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(475, 187, 187, 'ship_solace-plus-tyrannos', 'Solace Plus Tyrannos', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(476, 188, 188, 'ship_solace-plus-phantasm', 'Solace Plus Phantasm', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(477, 189, 189, 'ship_solace-plus-epion', 'Solace Plus Epion', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(478, 190, 190, 'ship_solace-plus-asimov', 'Solace Plus Asimov', 700000, 0, 300, 10, 20, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(479, 191, 191, 'ship_citadel-plus-asimov', 'Citadel Plus Asimow', 700000, 0, 240, 10, 20, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(480, 192, 192, 'ship_citadel-plus-empyrian', 'Citadel Plus Empyrian', 700000, 0, 240, 10, 20, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(481, 193, 193, 'ship_citadel-plus-nobilis', 'Citadel Plus Nobilis', 700000, 0, 240, 10, 20, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(482, 194, 194, 'ship_citadel-plus-prosperous', 'Citadel Plus Prosperous', 700000, 0, 240, 10, 20, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(483, 195, 10, 'ship_goliath_design_neon-lightgreen-glow', 'Neon-lightgreen', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(484, 196, 10, 'ship_goliath_design_neon-white-glow', 'Neon-White-Glow', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(485, 197, 10, 'ship_goliath_design_neon-yellow-glow', 'Neon-Yellow', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(486, 198, 10, 'ship_goliath_design_neon-pink-glow', 'Neon-Pink-Glow', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(487, 199, 10, 'ship_goliath_design_neon-red-glow', 'Neon-Red-Glow', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0),
(488, 200, 10, 'ship_goliath_design_neon-lightblue', 'Neon-Lightblue', 356000, 0, 300, 18, 18, 100, 0, 0, 0, '{\"Experience\":11200,\"Honor\":112,\"Credits\":512,\"Uridium\":512}', 0);

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
(0, 'Ship', '1'),
(1, 'Elit.Premium Ship', '1'),
(2, 'Drone', '1'),
(3, 'Drone-Formation', '0'),
(4, 'Weapon', '1'),
(5, 'Laser ammo', '1'),
(6, 'Special ammo', '1'),
(8, 'Rocket ammo', '1'),
(9, 'Mines', '1'),
(10, 'Extra', '1'),
(11, 'Generator', '1'),
(12, 'PET', '1'),
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
(23, 'Booster', '1'),
(120, 'Solace', '0'),
(145, 'G-Champion', '0'),
(146, 'Berserker', '0'),
(147, 'Hecate', '0'),
(148, 'Orcus', '0'),
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
(1, 'Drone', 'Apis', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 37, 190);display: inline-block;\">45 parts to buy, or booty, also available in a box.Its a part for build a Apis drone.Found in silver boty boxes.</p>', 25000, 'uridium', '1', 'do_img/global/items/drone/apis-5_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', 'apis', '', '', '', '', '', '', ''),
(2, 'Drone', 'Zeus', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 37, 190);display: inline-block;\">45 parts to buy, or booty, also available in a box.Its a part for build a Zeus drone.Found in silver boty boxes</p>', 50000, 'uridium', '1', 'do_img/global/items/drone/zeus-5_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', 'zeus', '', '', '', '', '', '', ''),
(3, 'Extra', 'Logdisk', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(159,197,232);display: inline-block;\">Log-disks can be exchanged for Research Points.</p>', 200, 'uridium', '1', '/do_img/global/items/resource/logfile_100x100.png', '1', 0, '', '', '', '', '', '', '', '', 'logdisks', '', '', '', '', '', '', '', ''),
(4, 'Extra', 'Logdisk', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Log-disks can be exchanged for Research Points.</p>', 500000, 'credits', '1', '/do_img/global/items/resource/logfile_100x100.png', '1', 0, '', '', '', '', '', '', '', '', 'logdisks', '', '', '', '', '', '', '', ''),
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
(23, 'PET', 'P.E.T.', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(159,197,232);display: inline-block;\"> P.E.T 10\r\nThe P.E.T. will accompany your spaceship throughout the expanses of space, helping you out where it can.\r\n</p>', 50000, 'uridium', '0', '/do_img/global/items/pet/pet10_100x100.png', '1', 0, '', '', '', '', '', '', '', 'pet', '', '', '', '', '', '', '', '', ''),
(24, 'Module', 'Module DMGM-1', 'Increase damage', 8, 'event', '0', 'do_img/global/items/module/dmgm-1_100x100.png', '0', 0, '', '11', '11', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, 'Module', 'Module XPM-1', 'Damage: Increases experience points', 8, 'event', '0', 'do_img/global/items/module/xpm-1_100x100.png', '0', 0, '', '12', '12', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(26, 'Module', 'Module LTM-HR', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage: 58.500</p>', 105000, 'uridium', '0', 'img/base/ltm-hr_100x100.png', '1', 0, '', '5', '5', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, 'Module', 'Module LTM-MR', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage: 38.450</p>', 95000, 'uridium', '0', 'do_img/global/items/module/ltm-mr_100x100.png', '1', 0, '', '6', '6', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(28, 'Module', 'Module LTM-LR', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage: 29.850</p>', 85000, 'uridium', '0', 'do_img/global/items/module/ltm-lr_100x100.png', '1', 0, '', '7', '7', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(29, 'Module', 'Module RAM-MA', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage: 51.250</p>', 105000, 'uridium', '0', 'img/base/ram-ma_100x100.png', '1', 0, '', '8', '8', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(30, 'Module', 'Module RAM-LA', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage: 35.550</p>', 95000, 'uridium', '0', 'do_img/global/items/module/ram-la_100x100.png', '1', 0, '', '9', '9', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(31, 'Ship', 'Phoenix', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 4000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 1</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 1</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 320</p>', 0, 'credits', '0', 'do_img/global/items/ship/phoenix_100x100.png', '1', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(32, 'Ship', 'Yamato', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 8000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 8</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 12</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 320</p>', 16000, 'credits', '0', 'do_img/global/items/ship/yamato_100x100.png', '0', 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(33, 'Ship', 'Leonov', '<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 160.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 6</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 6</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 360</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">2x Damage: from x1 map to x4 map.</p>', 15000, 'uridium', '0', 'do_img/global/items/ship/leonov_100x100.png', '1', 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(34, 'Ship', 'Defcom', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 16000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 12</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 8</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 340</p>', 32000, 'credits', '0', 'do_img/global/items/ship/defcom_100x100.png', '0', 4, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(35, 'Ship', 'Liberator', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 116.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 4</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 6</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>', 64000, 'credits', '0', 'do_img/global/items/ship/liberator_100x100.png', '1', 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(36, 'Ship', 'Piranha', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 164.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 4</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 6</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>', 128000, 'credits', '0', 'do_img/global/items/ship/piranha_100x100.png', '1', 6, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(37, 'Ship', 'Nostromo', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 128.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 7</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 10</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 340</p>', 100000, 'credits', '0', 'do_img/global/items/ship/nostromo_100x100.png', '1', 7, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(38, 'Ship', 'Vengeance', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 280.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 10</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 10</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 380</p>', 30000, 'uridium', '0', 'do_img/global/items/ship/vengeance_100x100.png', '1', 8, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(39, 'Ship', 'Bigboy', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 260.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 8</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 260</p>', 200000, 'credits', '0', 'do_img/global/items/ship/bigboy_100x100.png', '1', 9, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(40, 'Ship', 'Goliath', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 80000, 'uridium', '0', 'do_img/global/items/ship/goliath_100x100.png', '1', 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(41, 'Ship', 'Spearhead', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 200.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 5</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 12</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 370</p>', 120000, 'uridium', '0', 'do_img/global/items/ship/spearhead-eic_100x100.png', '0', 70, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(42, 'Ship', 'Aegis', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 375.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 10</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 15</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 80000, 'uridium', '0', 'do_img/global/items/ship/aegis-eic_100x100.png', '1', 49, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(43, 'Ship', 'Citadel', 'Citadel currently only has 1 rocketlauncher-slot and no abilitys!\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 650.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 7</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 20</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 240</p>', 300000, 'uridium', '0', 'do_img/global/items/ship/citadel-eic_100x100.png', '1', 69, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
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
(81, 'Designs', 'Sentinel-Lava', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 114, 31);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #f3721f;display: inline-block;\">8%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel/design/sentinel-lava_100x100.png', '0', 346, 'ship_sentinel_design_sentinel-lava', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
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
(97, 'Pusat', 'Pusat-Expo', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 200000, 'uridium', '0', 'do_img/global/items/ship/pusat/design/pusat-expo_100x100.png', '1', 370, 'ship_pusat_design_pusat-expo16', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `shop_items` (`id`, `category`, `name`, `information`, `price`, `priceType`, `amount`, `image`, `active`, `shipId`, `design_name`, `moduleId`, `moduleType`, `boosterId`, `boosterType`, `boosterDuration`, `laserName`, `petName`, `skillTree`, `droneName`, `ammoId`, `typeKey`, `petDesign`, `petFuel`, `petModule`, `FormationName`, `nameBootyKey`) VALUES
(98, 'Pusat', 'Pusat-Lava', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">8%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 200000, 'uridium', '0', 'do_img/global/items/ship/pusat/design/pusat-lava_100x100.png', '1', 371, 'ship_pusat_design_pusat-lava', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
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
(141, 'Laser ammo', 'MCB-25', 'The ammo is also known as x2 ammo, because when the laser cannon is used it deals twice its normal damage.\r\n', 150, 'credits', '1', '/do_img/global/items/ammunition/laser/mcb-25_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_mcb-25', '', '', '', '', '', ''),
(142, 'Laser ammo', 'MCB-50', 'MCB-50 is ammunition for the laser cannons and is currently the fifth most powerful laser battery that is available for direct purchase through the shop.', 300, 'credits', '1', '/do_img/global/items/ammunition/laser/mcb-50_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_mcb-50', '', '', '', '', '', ''),
(143, 'Laser ammo', 'SAB-50', 'Unlike other laser batteries, SAB-50 does not cause normal damage to the target\'s HP; instead, it drains the target\'s shields and refills the shooter\'s shields. The amount of shield it drains is comparable to MCB-25, however, because of its unique trait of refilling your shields, it costs twice as much.', 1, 'uridium', '1', '/do_img/global/items/ammunition/laser/sab-50_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_sab-50', '', '', '', '', '', ''),
(144, 'Laser ammo', 'UCB-100', 'UCB-100 is a type of ammunition that deals 4 times your normal damage on all attacks to anything you shoot. This is the most common type of ammo to be used in PvP battles with RSB-75. This battery is also known as the x4 ammo, since it deals 4 times your normal damage.', 5, 'uridium', '1', '/do_img/global/items/ammunition/laser/ucb-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_ucb-100', '', '', '', '', '', ''),
(145, 'Laser ammo', 'RSB-75', 'RSB-75 (Rapid Salvo Battery) is a type of ammunition that gives 6 times the damage but has a brief cooldown after each use. For this reason it is usually combined with another ammo type.', 6, 'uridium', '1', '/do_img/global/items/ammunition/laser/rsb-75_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_rsb-75', '', '', '', '', '', ''),
(146, 'Rocket ammo', 'PLT-3030', 'PLT-3030 (Long-Range Rocket) is the last type of rocket with no special ability that you can obtain in DarkOrbit. It has a very low accuracy but it packs a big punch. It is available anytime in Shop, Auction, Buy now and can sometimes be received from Pirate Booty.', 7, 'uridium', '1', '/do_img/global/items/ammunition/rocket/plt-3030_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocket_plt-3030', '', '', '', '', '', ''),
(147, 'Special ammo', 'PLD-8', 'PLD-8 (Plasma Charger) is elite rocket ammunition that temporarily reduces the accuracy of your enemy\'s weapons system when successfully hit. It is available anytime in Shop and ocassionaly in Bonus Boxes during special events.', 100, 'uridium', '1', '/do_img/global/items/ammunition/specialammo/pld-8_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_specialammo_pld-8', '', '', '', '', '', ''),
(148, 'Special ammo', 'DCR-250', 'DCR-250 (Deceleration Rocket) is an elite rocket that can slow down your enemies by 30% for 5 seconds. It is available anytime in Shop.', 250, 'uridium', '1', '/do_img/global/items/ammunition/specialammo/dcr-250_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_specialammo_dcr-250', '', '', '', '', '', ''),
(149, 'Rocket ammo', 'R-IC3', 'R-IC3 (Long-Range Rocket) is an elite rocket that can freeze targets for 2 seconds. The target will still be able to use most of their abilities, but it won\'t be able move. EMP-01 will remove the frozen effect, but not the rocket. ISH-01 will remove the rocket as it comes to you, but not when you\'re already frozen. It is available only during Winterfest.', 300, 'uridium', '1', '/do_img/global/items/ammunition/specialammo/R-IC3.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_specialammo_r-ic3', '', '', '', '', '', ''),
(150, 'Special ammo', 'WIZ-X', 'WIZ-X (Holo Emitter Rocket) is an elite rocket that can transform your target into a random ship or alien. The target cannot be a P.E.T.-10. It deals 0 damage and its\' purpose is only to amuse others. It is found ocassionaly during special events, such as Hallowwen, Winterfest and Easter.', 35, 'uridium', '1', '/do_img/global/items/ammunition/specialammo/wiz-x_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_specialammo_wiz-x', '', '', '', '', '', ''),
(151, 'Special ammo', 'ISH-01', 'A ISH-01 (Insta-Shield) is an extra CPU that gives your ship a 4 second invincibility shield from any incoming damage when activated.', 250, 'uridium', '1', '/do_img/global/items/equipment/extra/cpu/ish-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'equipment_extra_cpu_ish-01', '', '', '', '', '', ''),
(152, 'Special ammo', 'SMB-01', 'SMB-01 (also known as a Smart Bomb or SMTB) is an elite explosive ammunition which cannot be picked up or found, but only be created using the SMB-01 CPU (Smart Bomb CPU).', 250, 'uridium', '1', '/do_img/global/items/equipment/extra/cpu/smb-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_mine_smb-01', '', '', '', '', '', ''),
(153, 'Special ammo', 'EMP-01', 'EMP-01 (EMP Burst) is an elite ammunition insta-mine. It is available anytime at Shop, Assembly and can be sometimes received from Pirate Booty.', 500, 'uridium', '1', '/do_img/global/items/ammunition/specialammo/emp-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_specialammo_emp-01', '', '', '', '', '', ''),
(154, 'Extra', 'CLO4K-XL', 'Cloak your ship and stay invisible until you launch an attack yourself', 500, 'uridium', '1', '/do_img/global/items/equipment/extra/cpu/cl04k-xl_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'equipment_extra_cpu_cl04k-xl', '', '', '', '', '', ''),
(155, 'booty', 'BOOTY-KEY', 'The most common chests found in space, requiring Green keys.', 5000, 'uridium', '1', '/do_img/global/items/resource/gif/booty-key.gif', '0', 0, '', '', '', '', '', '', '', '', '', '', '', 'greenKeys', '', '', '', '', ''),
(156, 'booty', 'BOOTY-KEY', 'The most common chests found in space, requiring Green keys.', 100, 'uridium', '1', '/do_img/global/items/resource/booty-key_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', 'greenKeys', '', '', '', '', ''),
(171, 'Weapon', 'Prometheus', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">An essential tool for every pilot\'s arsenal, ensure victory when going head-to-head with the Black Light!</p>', 5, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/pr-l_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4Count', '', '', '', '', '', '', '', '', '', ''),
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
(233, 'Designs', 'Solace-Carbonite', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 250000, 'uridium', '0', 'do_img/global/items/ship/solace/design/solace-carbonite_100x100.png', '0', 415, 'ship_solace_design_solace-carbonite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
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
(253, 'Generator', 'SG3N-B01', 'SG3N-B01 is a shield generator. It only has 500 more shield strength than its weaker counterpart, SG3N-B00.\r\n\r\n', 500000, 'credits', '1', '/do_img/global/items/equipment/generator/shield/sg3n-b01_100x100.png', '1', 0, '', '', '', '', '', '', 'B01Count', '', '', '', '', '', '', '', '', '', ''),
(254, 'Generator', 'SG3N-B02', 'SG3N-B02 is a shield generator. For a long time it was the best shield generator in the game, and that\'s why it is standard elite equipment.\r\n\r\n', 10000, 'uridium', '1', '/do_img/global/items/equipment/generator/shield/sg3n-b02_100x100.png', '1', 0, '', '', '', '', '', '', 'bo2Count', '', '', '', '', '', '', '', '', '', ''),
(255, 'Generator', 'SG3N-B03', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box\r\nSG3N-B03 is a shield generator. It is by far the strongest shield generator in the game, offering the most shield strength and absorption out of any other generator available.</p>\r\n\r\n\r\n', 2000000, 'uridium', '1', '/do_img/global/items/equipment/generator/shield/sg3n-b03_100x100.png', '0', 0, '', '', '', '', '', '', 'bo3Count', '', '', '', '', '', '', '', '', '', ''),
(256, 'Generator', 'G3N-1010', 'Generador basico.Aumenta la velocidad en 2.', 2000, 'credits', '1', '', '0', 0, '', '', '', '', '', '', 'g3n1010Count', '', '', '', '', '', '', '', '', '', ''),
(257, 'Generator', 'G3N-2010', 'Generador de velocidad basico.Aumenta la velocidad en 3.', 4000, 'credits', '1', '/do_img/global/items/equipment/generator/speed/g3n-2010_100x100.png', '1', 0, '', '', '', '', '', '', 'g3n2010Count', '', '', '', '', '', '', '', '', '', ''),
(258, 'Generator', 'G3N-3210', 'Generador de velocidad medio.Aumenta la velocidad en 4.\r\n\r\n', 8000, 'credits', '1', '/do_img/global/items/equipment/generator/speed/g3n-3210_100x100.png', '1', 0, '', '', '', '', '', '', 'g3n3210Count', '', '', '', '', '', '', '', '', '', ''),
(259, 'Generator', 'G3N-3310', 'Generador de velocidad medio.Aumenta la velocidad en 5.\r\n\r\n', 16000, 'credits', '1', '/do_img/global/items/equipment/generator/speed/g3n-3310_100x100.png', '1', 0, '', '', '', '', '', '', 'g3n3310Count', '', '', '', '', '', '', '', '', '', ''),
(260, 'Generator', 'G3N-6900', 'Generador de velocidad avanzado. Aumenta la velocidad en 7.\r\n\r\n', 500000, 'credits', '1', '/do_img/global/items/equipment/generator/speed/g3n-6900_100x100.png', '1', 0, '', '', '', '', '', '', 'g3n6900Count', '', '', '', '', '', '', '', '', '', ''),
(261, 'Generator', 'G3N-7900', 'Generador de velocidad elite.Aumenta la velocidad en 10.\r\n\r\n', 2000, 'uridium', '1', '/do_img/global/items/equipment/generator/speed/g3n-7900_100x100.png', '1', 0, '', '', '', '', '', '', 'g3nCount', '', '', '', '', '', '', '', '', '', ''),
(262, 'Drone', 'Spartan', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">HP</p> <p style=\"color: #009cf7;display: inline-block;\">50%</p><p style=\"color: #ffffff; display: inline-block;\"></p> ', 140000, 'uridium', '1', 'do_img/global/items/drone/designs/spartan_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', 'spartanCount', '', '', '', '', '', '', ''),
(282, 'Extra', 'Blue Key\r\n', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(208,224,227);display: inline-block;\">Contents: Weapon+E.C+Uri randomly=Prometeus weapon,LF-4,LF-4-SP,\r\nLF-4-HP,\r\nLF-4-MD,LF-4-PD,LF-4-UNSTABLE,LF3-NEUTRON,logdisks,\r\nUridium Random,\r\nBO3-Shield,E.C,All Ammo,silverKeys\r\nThese contents are available.  </p>\r\n\r\n', 150, 'event', '1', '/do_img/global/items/resource/booty-key-blue_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'blueKeys'),
(283, 'Extra', 'Red Key', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 37, 37);display: inline-block;\">You get them all at once\r\n40 prometheus,40BO3,30E.C key,100000 Log Disk,10 Hercules,10Havoc.  </p>', 75000, 'event', '1', '/do_img/global/items/resource/booty-key-red_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'redKeys'),
(284, 'Extra', 'Green Key', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(106,168,79);display: inline-block;\">Contents: Large quantity:The system gives it randomly= XCB-25,SMB-01,XCB-50,ISH-01,LXCB-75,UCB-100,EMP-01,It is needed to open valuable green pirate chests and collect priceless treasures.  </p>\r\n\r\n\r\n\r\n', 500000, 'uridium', '1', '/do_img/global/items/resource/booty-key_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'greenKeys'),
(512, 'Drone', 'Iris', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(211,232,234);display: inline-block;\">The Battle Drone (BD-02 I) commonly known as the Iris is an elite battle drone that has two equipment slots.</p>', 15000, 'uridium', '0', 'do_img/global/items/drone/iris-0_100x100.png', '1', 0, '', '', '', '', '', '', 'iriscount', '', '', '', '', '', '', '', '', '', ''),
(513, 'Drone', 'F-3D-DM', 'Augment your drone control unit with the Dome Formation.\r\n\r\nShield points are increased by 30% and regenerate by 0.5% per second. Cooldown times for rockets and rocket launchers are reduced by 25%; however, laser damage and speed are both reduced by 50%.\r\n\r\n', 150000, 'uridium', '0', '/do_img/global/items/drone/formation/f-3d-dm_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-dm', ''),
(514, 'Drone', 'F-3D-DR', 'Augment your drone control unit with the Drill Formation.\r\n\r\nLaser damage is increased by 20%; however, shield points are reduced by 25%, shield spread by 5%, and speed by 5%.\r\n\r\n', 150000, 'uridium', '0', '/do_img/global/items/drone/formation/f-3d-dr_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-dr', ''),
(515, 'Drone', 'F-3D-RG', 'Augment your drone control unit with the Ring Formation.\r\n\r\nShield points are increased by 85%; however, speed is reduced by 5%, laser damage is reduced by 25%, and cooldown times for rockets and rocket launchers are increased by 25%.\r\n\r\n', 150000, 'uridium', '0', '/do_img/global/items/drone/formation/f-3d-rg_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-rg', ''),
(516, 'Drone', 'F-3D-VT', 'Augment your drone control unit with the Veteran Formation.\r\n\r\nHonor is increased by 20%; however, laser damage, hit points, and shield points are all decreased by 20%.\r\n\r\n', 150000, 'uridium', '0', '/do_img/global/items/drone/formation/f-3d-vt_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-vt', ''),
(517, 'Drone', 'F-3D-WL', 'The Wheel Formation is mostly used for catching ships or fleeing from enemy ships but is definitely not the cheapest solution to do so.', 150000, 'uridium', '0', '/do_img/global/items/drone/formation/f-3d-wl_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-wl', ''),
(518, 'Drone', 'F-3D-WV', 'Jazz up your drones with the Wave Formation!\r\n\r\nDrones will make waves, but otherwise this formation grants neither benefits nor penalties.\r\n\r\n', 4950000, 'credits', '0', '/do_img/global/items/drone/formation/f-3d-wv_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-wv', ''),
(519, 'Drone', 'F-3D-X', 'Augment your drone control unit with the X Formation.\r\n\r\n-100% honor rewarded\r\n\r\nYour lasers cause no damage to enemy players\r\n\r\n+5% Laser Damage against aliens\r\n\r\n+5% XP from aliens\r\n\r\n+8% HP', 300000, 'credits', '0', '/do_img/global/items/drone/formation/f-3d-x_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'drone_formation_f-3d-x', ''),
(550, 'Weapon', 'Prometheus', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box.is an all-around great elite laser cannon that deals 480 damage per shot. </p>', 5, 'event', '1', '/do_img/global/items/equipment/weapon/laser/pr-l_100x100.png', '0', 0, '', '', '', '', '', '', 'lf5Count', '', '', '', '', '', '', '', '', '', ''),
(551, 'Weapon', 'LF-4', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">LF-4 is an all-around great elite laser cannon that deals 200 damage per shot.</p>', 5, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4Count', '', '', '', '', '', '', '', '', '', ''),
(552, 'Weapon', 'LF-3', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(188,188,188);display: inline-block;\">LF-3 is an all-around great elite laser cannon that deals 175 damage per shot.</p>', 10000, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-3_100x100.png', '1', 0, '', '', '', '', '', '', 'lf3Count', '', '', '', '', '', '', '', '', '', ''),
(553, 'Weapon', 'LF-2', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(188,188,188);display: inline-block;\">LF-2 is an elite laser cannon that deals 140 damage per shot. </p>', 5000, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-2_100x100.png', '1', 0, '', '', '', '', '', '', 'lf2Count', '', '', '', '', '', '', '', '', '', ''),
(554, 'Weapon', 'LF-1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(188,188,188);display: inline-block;\">LF-1 is the weakest laser cannon in the entire game, dealing up to 65 damage per shot.</p>', 10000, 'credits', '1', '/do_img/global/items/equipment/weapon/laser/lf-1_100x100.png', '1', 0, '', '', '', '', '', '', 'lf1Count', '', '', '', '', '', '', '', '', '', ''),
(555, 'Weapon', 'MP-1', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(188,188,188);display: inline-block;\">Average laser: causes up to 75 damage points per round.</p>', 40000, 'credits', '1', '/do_img/global/items/equipment/weapon/laser/mp-1_100x100.png', '1', 0, '', '', '', '', '', '', 'mp1Count', '', '', '', '', '', '', '', '', '', ''),
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
(3082, 'Rocket ammo', 'PLT-2021', 'Long-range rocket: causes up to 4,000 points per rocket fired', 4, 'uridium', '1', '/do_img/global/items/ammunition/rocket/plt-2021_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocket_plt-2021', '', '', '', '', '', ''),
(3083, 'Rocket ammo', 'PLT-2026', 'Mid-range rocket: causes up to 2,000 damage points per rocket fired', 500, 'credits', '1', '/do_img/global/items/ammunition/rocket/plt-2026_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocket_plt-2026', '', '', '', '', '', ''),
(3084, 'Rocket ammo', 'R-310', 'Short-range rocket: causes up to 1,000 damage points per rocket fired', 100, 'credits', '1', '/do_img/global/items/ammunition/rocket/r-310_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocket_r-310', '', '', '', '', '', ''),
(3085, 'Laser ammo', 'CBO-100', 'The CBO-100 (Combo Battery Ordnance) is an elite laser battery ammunition with a unique form of damage. It causes the same damage as MCB-50, as well as half the shielding effect of SAB-50 ammunition. Available in the store for a limited time only.', 5, 'uridium', '1', '/do_img/global/items/ammunition/laser/cbo-100_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_cbo-100', '', '', '', '', '', ''),
(3086, 'Laser ammo', 'JOB-100', 'JOB-100 (Jack-O-Battery) is elite special laser battery ammunition that was released during the Pumpkin Fest 2012. It deals 3.5 times the damage to Aliens and 2 times the damage to players. ', 7, 'uridium', '1', '/do_img/global/items/ammunition/laser/Job-100_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_job-100', '', '', '', '', '', ''),
(3087, 'Laser ammo', 'RB-214', 'It quadruples the damage caused by the laser with each shot. It causes 8 times damage to demaner casings and signal towers.', 8, 'uridium', '1', '/do_img/global/items/ammunition/laser/rb-214_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_rb-214', '', '', '', '', '', ''),
(3088, 'Laser ammo', 'XCB-25', 'This is the best standard laser ammo on the market. x6 laser damage per round', 8, 'uridium', '1', '/do_img/global/items/ammunition/laser/XCB-25_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_xcb-25', '', '', '', '', '', ''),
(3089, 'Laser ammo', 'XCB-50', 'This is the best standard laser ammo on the market. x7 laser damage per round', 10, 'uridium', '1', '/do_img/global/items/ammunition/laser/XCB-50_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_xcb-50', '', '', '', '', '', ''),
(3090, 'Laser ammo', 'LXCB-75', 'This is the best standard laser ammo on the market. x8 laser damage per round\r\n          \r\n', 12, 'uridium', '1', '/do_img/global/items/ammunition/laser/LXCB-75_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_laser_lxcb-75', '', '', '', '', '', ''),
(3091, 'PET', ' Pet Fuel', ' P.E.T Fuel \r\n1000 liters', 3000, 'uridium', '0', 'do_img/global/items/fuel-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '1000', '', '', ''),
(3092, 'PET', ' Pet Fuel', 'P.E.T Fuel \r\n6000 liters', 18000, 'uridium', '0', 'do_img/global/items/fuel-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '6000', '', '', ''),
(3093, 'PET', ' Pet Fuel', 'P.E.T Fuel \r\n25000 liters', 78000, 'uridium', '0', 'do_img/global/items/fuel-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '25000', '', '', ''),
(3094, 'PET', 'CGM-02', 'It combines the known protection method with the new instant shield. Uses 35% more fuel when active.\r\nAvoidance chance: 65%\r\nExtra consumption: 35 units. fuel', 100000, 'uridium', '0', 'do_img/global/items/equipment/petgear/cgm-02_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'GUARD', '', ''),
(3095, 'PET', 'G-KK1', 'The self-destruct device is activated when your spaceship or P.E.T. almost destroyed. Then the P.E.T. deals a final self-destruct attack against your opponent.\r\nEffect: deals 25000 spreading damage when detonated.\r\nRange: 250', 100000, 'uridium', '0', 'do_img/global/items/equipment/petgear/g-kk1_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'KAMIKAZE', '', ''),
(3096, 'PET', 'G-REP1', 'The repair equipment repairs your PET at 2000 HP per second.\r\nEffect: Heals 2000 health per second.\r\nTime: 120 seconds', 100000, 'uridium', '0', 'do_img/global/items/equipment/petgear/g-rep1_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'REPAIR_PET', '', ''),
(3097, 'PET', 'CSR-02', 'Repairs your spaceship while in flight. You need extra fuel to repair.\r\nEffect: Heals 10000 HP per second.\r\nTime: 5 seconds\r\nAvoidance chance: 65%\r\nConsumption: 200 units. fuel', 100000, 'uridium', '0', 'do_img/global/items/equipment/petgear/csr-02_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'COMBO_SHIP_REPAIR', '', ''),
(3098, 'Extra', 'Silver Key', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(208,224,227);display: inline-block;\">Contents: The system gives it randomly=Apis Parts,Zeus Parts,Havoc,Hercules,\r\nCyborg Drone,\r\nSilver Key,Red Key,logdisks,Uridium Random,\r\nThese contents are available.  </p>\r\n', 100000, 'uridium', '1', '/do_img/global/items/resource/silver-key_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'silverKeys'),
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
(3122, 'Booster', 'Experience XP-B50', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 30 Days, +50% Experience</p>', 10000, 'event', '0', '/do_img/global/items/booster/ep-b02_100x100.png', '0', 0, '', '', '', '-0', '4', '2628000', '', '', '', '', '', '', '', '', '', '', ''),
(3123, 'Booster', 'Honor HON-50', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 30 Days, +50% Honor</p>', 10000, 'event', '0', '/do_img/global/items/booster/hon-b02_100x100.png', '0', 0, '', '', '', '1', '7', '2628000', '', '', '', '', '', '', '', '', '', '', ''),
(3124, 'Booster', 'Damage DMG-BO3', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 30 Days, +50% Damage</p>', 10000, 'event', '0', '/do_img/global/items/booster/dmg-b02_100x100.png', '0', 0, '', '', '', '2', '27', '36000', '', '', '', '', '', '', '', '', '', '', ''),
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
(3139, 'Weapon', 'LF-3-N', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">LF-3 is an all-around great elite laser cannon that deals 175 damage per shot.</p>', 5, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-3-n_100x100.png', '0', 0, '', '', '', '', '', '', 'lf3nCount', '', '', '', '', '', '', '', '', '', ''),
(3140, 'PET', 'Pet Hammerclaw Carbonite', 'Pet Hammerclaw Carbonite', 62000, 'uridium', '0', 'do_img/global/items/pet/designs/pet-hammerclaw-carbonite_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '211', '', '', '', ''),
(3141, 'PET', 'Pet Hammerclaw Dusklight', 'Pet Hammerclaw Dusklight', 62000, 'uridium', '0', 'do_img/global/items/pet/design/hammerclaw-dusklight_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '269', '', '', '', ''),
(3142, 'Weapon', 'LF-3-Neutron', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">LF-3-Neutron is an all-around great elite laser cannon that deals 220 damage per shot.</p>', 5, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-3-n_100x100.png', '0', 0, '', '', '', '', '', '', 'lf3nCount', '', '', '', '', '', '', '', '', '', ''),
(3143, 'Weapon', 'LF-4-MD', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium. But it can also be found in a Silver Booty box,LF-4 Magmadrill is an all-around great elite laser cannon that deals 220 damage per shot.</p>', 5, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4mdCount', '', '', '', '', '', '', '', '', '', ''),
(3144, 'Weapon', 'LF-4-PD', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium. But it can also be found in a Silver Booty box,LF-4 Paritydrill is an all-around great elite laser cannon that deals 220 damage per shot.</p>', 5, 'uridium', '0', '/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4pdCount', '', '', '', '', '', '', '', '', '', ''),
(3145, 'Weapon', 'LF-4-HP', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box.LF-4-HP is an all-around great elite laser cannon that deals 225 damage per shot.</p>', 5, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4hpCount', '', '', '', '', '', '', '', '', '', ''),
(3146, 'Weapon', 'LF-4-SP', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Available for premium.\r\nBut it can also be found in a Silver Booty box.LF-4-SP is an all-around great elite laser cannon that deals 280 damage per shot.</p>', 5, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4spCount', '', '', '', '', '', '', '', '', '', ''),
(3147, 'Weapon', 'Unstable LF-4', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(101, 255, 37);display: inline-block;\">Unstable LF-4 is an all-around great elite laser cannon that deals 150-200 damage per shot.</p>', 5, 'uridium', '1', '/do_img/global/items/equipment/weapon/laser/lf-4-unstable_100x100.png', '0', 0, '', '', '', '', '', '', 'lf4unstableCount', '', '', '', '', '', '', '', '', '', ''),
(3149, 'Orcus', 'Orcus ullrin', '<p style=\"color: #f34242;display: inline-block;\">DMG</p> <p style=\"color: #f34242;display: inline-block;\">65%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">EXP</p> <p style=\"color: #009cf7;display: inline-block;\">50%</p><p style=\"color: #f3721f;; display: inline-block;\"></p></p> <p style=\"color: #009cf7;display: inline-block;\">HON</p> <p style=\"color: #009cf7;display: inline-block;\">50%</p><p style=\"color: #f3721f;; display: inline-block;\"></p> <p style=\"color: #f3721f;display: inline-block;\">HP</p> <p style=\"color: #f3721f;display: inline-block;\">60%</p> <p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: #009cf7;display: inline-block;\">SHD</p> <p style=\"color: #009cf7;display: inline-block;\">50%</p><p style=\"color: #f3721f;; display: inline-block;\"></p>', 30000, 'event', '0', 'do_img/global/items/ship/orcus/design/orcus-ullrin_100x100.png', '1', 1405, 'ship_orcus-ullrin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3150, 'Extra', 'Gold Key', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255,217,102);display: inline-block;\">Contents:The system gives it randomly=\r\nGoliath+Cyborg Desings.\r\nThese contents are available. </p>', 500, 'event', '1', '/do_img/global/items/resource/gold-key_100x100.png', '0', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'goldKeys'),
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
(4014, 'Vengeance', 'Lightning', '<div class=\"production-info\"><div class=\"info-item\"><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: rgb(255, 65, 65);display: inline-block;\">SHD</p> <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: rgb(255, 65, 65);display: inline-block;\">HON</p> <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: rgb(255, 65, 65);display: inline-block;\">EXP</p> <p style=\"color: #f34242;display: inline-block;\">20%</p><p style=\"color: #ffffff; display: inline-block;\"></p>', 50000, 'event', '0', 'do_img/global/items/ship/vengeance/design/lightning_100x100.png', '1', 0, 'ship_vengeance_design_lightning', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4015, 'Designs', 'Aegis Veteran', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">EXP</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HON</p> \r\n          <p style=\"color: #2be676;display: inline-block;\">10%</p>', 100000, 'uridium', '0', 'do_img/global/items/ship/a-veteran-eic_100x100.png', '1', 157, 'ship_aegis_design_aegis-elite', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4016, 'Designs', 'Venom', 'This ship has the following abilities: 5% extra damage, and the Singularity ability, which will paralyze enemy ships and cause them substantial damage over time!\r\n\r\n', 250000, 'uridium', '0', 'do_img/global/items/ship/venom_100x100.png', '1', 67, 'ship_goliath_design_venom', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4017, 'Designs', 'Spectrum', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p> <p style=\"color: #ffffff; display: inline-block;\"></p>', 250000, 'uridium', '0', 'do_img/global/items/ship/spectrum_100x100.png', '1', 65, 'ship_goliath_design_spectrum', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4018, 'Designs', 'Diminisher', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">Damage</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">5%</p><p style=\"color: #ffffff; display: inline-block;\"></p> ', 250000, 'uridium', '0', 'do_img/global/items/ship/diminisher_100x100.png', '1', 64, 'ship_goliath_design_diminisher', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4019, 'Goliath', 'Goliath Jade', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">HP</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">25%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(255, 65, 65);display: inline-block;\">DMG</p> \r\n          <p style=\"color: #f34242;display: inline-block;\">10%</p>\r\n<p style=\"color: #ffffff; display: inline-block;\"></p>', 250000, 'uridium', '0', 'do_img/global/items/ship/goliath/design/jade_100x100.png', '0', 19, 'ship_goliath_design_jade', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4020, 'Rocket ammo', 'UBR-100', 'Long-range rocket: causes up to 8.500 points per rocket fired', 30, 'uridium', '1', '/do_img/global/items/ammunition/rocketlauncher/ubr-100_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocketlauncher_ubr-100', '', '', '', '', '', ''),
(4021, 'Rocket ammo', 'ECO-10', 'Long-range rocket: causes up to 2.000 points per rocket fired', 1500, 'credits', '1', '/do_img/global/items/ammunition/rocketlauncher/eco-10_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocketlauncher_eco-10', '', '', '', '', '', ''),
(4022, 'Rocket ammo', 'SAR-01', 'Long-range rocket: causes up to 1.500 points per rocket fired', 2000, 'credits', '1', '/do_img/global/items/ammunition/rocketlauncher/sar-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocketlauncher_sar-01', '', '', '', '', '', ''),
(4023, 'Rocket ammo', 'SAR-02', 'Long-range rocket: causes up to 5.000 points per rocket fired', 15, 'uridium', '1', '/do_img/global/items/ammunition/rocketlauncher/sar-02_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocketlauncher_sar-02', '', '', '', '', '', ''),
(4024, 'Rocket ammo', 'HSTRM-01', 'Long-range rocket: causes up to 4,000 points per rocket fired', 20, 'uridium', '1', '/do_img/global/items/ammunition/rocketlauncher/hstrm-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_rocketlauncher_hstrm-01', '', '', '', '', '', ''),
(4025, 'Mines', 'ACM-1', 'Proximity mine: 20% damage upon detonation', 200, 'uridium', '1', '/do_img/global/items/ammunition/mine/acm-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_mine_acm-01', '', '', '', '', '', ''),
(4026, 'Mines', 'DD-M01', 'Proximity mine:\r\n20% direct damage calculated from ship\\\'s base HP and pilot-bio upgrades - powerful enough to destroy enemy ships entirely!', 150, 'uridium', '1', '/do_img/global/items/ammunition/mine/ddm-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_mine_ddm-01', '', '', '', '', '', ''),
(4027, 'Mines', 'EMP-M01', 'Proximity mine: causes 100% uncloaking upon detonation', 150, 'uridium', '1', '/do_img/global/items/ammunition/mine/empm-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_mine_empm-01', '', '', '', '', '', ''),
(4028, 'Mines', 'SAB-M01', 'Proximity mine:\r\n50% shield damage upon detonation; combinable with other mine types', 150, 'uridium', '1', '/do_img/global/items/ammunition/mine/sabm-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_mine_sabm-01', '', '', '', '', '', '');
INSERT INTO `shop_items` (`id`, `category`, `name`, `information`, `price`, `priceType`, `amount`, `image`, `active`, `shipId`, `design_name`, `moduleId`, `moduleType`, `boosterId`, `boosterType`, `boosterDuration`, `laserName`, `petName`, `skillTree`, `droneName`, `ammoId`, `typeKey`, `petDesign`, `petFuel`, `petModule`, `FormationName`, `nameBootyKey`) VALUES
(4029, 'Mines', 'SLM-01 ', 'Slowdown Mine\r\nSlows your opponent for 5 seconds by 50%.\r\nFurthermore, it takes effect in just 1 second.', 150, 'uridium', '1', '/do_img/global/items/ammunition/mine/sl-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_mine_slm-01', '', '', '', '', '', ''),
(4030, 'Mines', 'IM-01', 'Infection Mine\r\nA mine that damages other players and infects them with virulent spores.', 200, 'uridium', '1', '/do_img/global/items/ammunition/mine/im-01_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', 'ammunition_mine_im-01', '', '', '', '', '', ''),
(4031, 'Designs', 'Solace', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">10%</p><p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">HP</p><p style=\"color: rgb(0, 241, 118);display: inline-block;\">5%</p>\r\n          ', 250000, 'uridium', '0', 'do_img/global/items/ship/solace_100x100.png', '1', 63, 'ship_goliath_design_solace', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4032, 'Designs', 'Sentinel', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 156, 247);display: inline-block;\">Shield</p> \r\n          <p style=\"color: #009cf7;display: inline-block;\">8%</p> <p style=\"color: #ffffff; display: inline-block;\"></p>', 250000, 'uridium', '0', 'do_img/global/items/ship/sentinel_100x100.png', '1', 66, 'ship_goliath_design_sentinel', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4033, 'Elit.Premium Ship', 'Goliath Plus', 'Basic ship\r\nHe has no skills.\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n\r\n', 4000000, 'uridium', '0', 'do_img/global/items/ship/goliath-plus_100x100.png', '1', 163, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4034, 'Elit.Premium Ship', 'Citadel Plus', 'Basic ship\r\nHe has no skills.\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 700.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 10</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 20</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 250</p>\r\n', 4000000, 'uridium', '0', 'do_img/global/items/ship/citadel-plus_top.png', '1', 164, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4035, 'Elit.Premium Ship', 'Goliath Plus Amor', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/goliath-plus/design/goliath-plus-amor_100x100.png', '1', 166, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4036, 'Elit.Premium Ship', 'Goliath Plus Ullrin', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/goliath-plus/design/goliath-plus-ullrin_100x100.png', '1', 167, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4037, 'Elit.Premium Ship', 'Citadel Plus Frost', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 700.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">+30% Healt Bonus</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 10</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 20</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 250</p>', 50000, 'event', '0', 'do_img/global/items/ship/citadel-plus_frost_top.png', '1', 168, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4038, 'Elit.Premium Ship', 'Solace Plus', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP:+15%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD:+10%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON:+15%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>\r\n', 50000, 'event', '0', 'do_img/global/items/ship/solace-plus_100x100.png', '1', 169, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4043, 'Elit.Premium Ship', 'Solace Plus Phantasm', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP:+15%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD:+10%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON:+15%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 50000, 'event', '0', 'do_img/global/items/ship/plus-phantasm_100x100.png', '1', 188, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4044, 'Elit.Premium Ship', 'Solace Plus Tyrannos', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP:+15%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD:+10%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON:+15%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 50000, 'event', '0', 'do_img/global/items/ship/solace-plus-tyrannos_100x100.png', '1', 187, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4045, 'Elit.Premium Ship', 'Solace Plus Ullrin', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP:+15%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD:+10%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON:+15%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 300</p>', 50000, 'event', '0', 'do_img/global/items/ship/solace-plus-ullrin_100x100.png', '1', 186, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4046, 'Elit.Premium Ship', 'Goliath Plus Argon', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/goliath-plus/design/goliath-plus-argon_100x100.png', '1', 185, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4047, 'Elit.Premium Ship', 'Goliath Plus Nobilis', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/goliath-plus/design/goliath-plus-nobilis_100x100.png', '1', 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4048, 'Elit.Premium Ship', 'Goliath Plus Osiris', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/goliath-plus/design/goliath-plus-osiris_100x100.png', '1', 183, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4049, 'Elit.Premium Ship', 'Goliath Plus Spyche', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/goliath-plus/design/goliath-plus-psyche_100x100.png', '1', 182, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4050, 'Elit.Premium Ship', 'Goliath Plus Smite', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/goliath-plus/design/goliath-plus-smite_100x100.png', '1', 181, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4051, 'Elit.Premium Ship', 'Goliath Plus Frost', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/goliath-plus-frost_100x100.png', '1', 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4052, 'Elit.Premium Ship', 'Goliath Neon-Pink-Glow', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/neon-pink-glow_100x100.png', '1', 198, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4053, 'Elit.Premium Ship', 'Goliath Neon-Red-Glow', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/neon-red-glow_100x100.png', '1', 199, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4054, 'Elit.Premium Ship', 'Goliath Neon-Lightgreen-Glow', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/neon-lightgreen-glow_100x100.png', '1', 195, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4055, 'Elit.Premium Ship', 'Goliath Neon-Yellow-Glow', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/neon-yellow-glow_100x100.png', '1', 197, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4056, 'Elit.Premium Ship', 'Goliath Neon-White-Glow', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/neon-white-glow_100x100.png', '1', 196, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4057, 'Elit.Premium Ship', 'Goliath Neon-Lightblue', '<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Health: 356.000</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Laser: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Generator: 18</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">Speed: 330</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HON: +50%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">HP: +25%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">SHD: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">DMG: +20%</p>\r\n<br>\r\n<p style=\"display: unset;padding-left:35px;padding-top:35px\">EXP: +25%</p>\r\n<br>', 50000, 'event', '0', 'do_img/global/items/ship/neon-lightblue_100x100.png', '0', 200, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4058, 'Booster', 'Honor HON-B50', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hours, +35% Honor</p>', 1000, 'event', '0', '/do_img/global/items/booster/hon-b02_100x100.png', '1', 0, '', '', '', '1', '7', '36000', '', '', '', '', '', '', '', '', '', '', ''),
(4059, 'Booster', 'Experience XP-B50', '<p style=\"color: #ffffff; display: inline-block;\"></p> <p style=\"color: rgb(0, 241, 118);display: inline-block;\">Duration 10 Hour, +25% Experience</p>', 1000, 'event', '0', '/do_img/global/items/booster/ep-b02_100x100.png', '1', 0, '', '', '', '-0', '4', '36000', '', '', '', '', '', '', '', '', '', '', ''),
(4060, 'Extra', 'E.C Key', '<p style=\"color:#d029d6; display: inline-block;\"></p> <p style=\"color:#d029d6;display: inline-block;\">Box contents:Quantity is random:E.C+Random-uridium+HON+EP.</p>', 2000000, 'uridium', '1', '/do_img/global/items/resource/booty-key-blacklight-decoder_100x100.png', '1', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ecKeys');

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
(1, 'StarOrbitNew', 300, '', '30000', '', '100', '00:00:00.000000', '1');

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
-- A tábla indexei `bid_system`
--
ALTER TABLE `bid_system`
  ADD PRIMARY KEY (`bid_id`);

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
-- A tábla indexei `log_player_npc`
--
ALTER TABLE `log_player_npc`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `log_player_pve_kills`
--
ALTER TABLE `log_player_pve_kills`
  ADD UNIQUE KEY `userId` (`userId`,`npc`);

--
-- A tábla indexei `log_player_pvp_kills`
--
ALTER TABLE `log_player_pvp_kills`
  ADD UNIQUE KEY `userId` (`userId`,`ship`);

--
-- A tábla indexei `log_player_quests_state_tmp`
--
ALTER TABLE `log_player_quests_state_tmp`
  ADD UNIQUE KEY `userId` (`userId`,`questId`,`type`,`charId`);

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
-- A tábla indexei `player_quests`
--
ALTER TABLE `player_quests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId_questId` (`userId`,`questId`);

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
-- A tábla indexei `server_quests`
--
ALTER TABLE `server_quests`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `server_quests_rewards`
--
ALTER TABLE `server_quests_rewards`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `server_quests_tasks`
--
ALTER TABLE `server_quests_tasks`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `categoryupgradesystem`
--
ALTER TABLE `categoryupgradesystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `chat_log`
--
ALTER TABLE `chat_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `chat_permissions`
--
ALTER TABLE `chat_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `gg_log`
--
ALTER TABLE `gg_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `info_galaxygates`
--
ALTER TABLE `info_galaxygates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `log_player_kills`
--
ALTER TABLE `log_player_kills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `log_player_npc`
--
ALTER TABLE `log_player_npc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `manage_events`
--
ALTER TABLE `manage_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `newsclantablelog`
--
ALTER TABLE `newsclantablelog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `player_accounts`
--
ALTER TABLE `player_accounts`
  MODIFY `userId` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `player_designs`
--
ALTER TABLE `player_designs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `player_equipment`
--
ALTER TABLE `player_equipment`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `player_galaxygates`
--
ALTER TABLE `player_galaxygates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `player_quests`
--
ALTER TABLE `player_quests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `player_settings`
--
ALTER TABLE `player_settings`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `player_titles`
--
ALTER TABLE `player_titles`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `server_clan_applications`
--
ALTER TABLE `server_clan_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `server_quests`
--
ALTER TABLE `server_quests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT a táblához `server_quests_rewards`
--
ALTER TABLE `server_quests_rewards`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT a táblához `server_quests_tasks`
--
ALTER TABLE `server_quests_tasks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT a táblához `shop_category`
--
ALTER TABLE `shop_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT a táblához `shop_items`
--
ALTER TABLE `shop_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300005;

--
-- AUTO_INCREMENT a táblához `system_verification`
--
ALTER TABLE `system_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `uba_rewards`
--
ALTER TABLE `uba_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `upgradessystem`
--
ALTER TABLE `upgradessystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `user_bans`
--
ALTER TABLE `user_bans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `vouchers_uses`
--
ALTER TABLE `vouchers_uses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `voucher_log`
--
ALTER TABLE `voucher_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
