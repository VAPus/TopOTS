-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 25 Sie 2013, 02:21
-- Wersja serwera: 5.5.27
-- Wersja PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `ots`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `list_acc`
--

CREATE TABLE IF NOT EXISTS `list_acc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(150) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `pass` varchar(150) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `mail` varchar(150) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `admin` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `ban` int(1) NOT NULL DEFAULT '0',
  `accepted` int(1) NOT NULL DEFAULT '1',
  `accept_key` varchar(20) NOT NULL DEFAULT '0',
  `to_reset` int(1) NOT NULL DEFAULT '0',
  `reset_key` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Zrzut danych tabeli `list_acc`
--

INSERT INTO `list_acc` (`id`, `login`, `pass`, `mail`, `points`, `admin`, `count`, `ban`, `accepted`, `accept_key`, `to_reset`, `reset_key`) VALUES
(5, 'log', 'x', 'sda@as.as', 9900, 1, 0, 0, 1, '0', 0, '0'),
(8, 'asdass', 'asda', 'sdas@asd.as', 9900, 0, 0, 0, 1, '0', 0, '0'),
(9, 'asdas1', 'asda', 'sdas', 9900, 0, 0, 0, 1, '0', 0, '0'),
(10, 'asdas2', 'asda', 'sdas', 9900, 0, 0, 0, 1, '0', 0, '0'),
(11, 'asdas3', 'asda', 'sdas', 9900, 0, 0, 0, 1, '0', 0, '0'),
(12, 'login22', 'x', 'sdfasdf@asd.as', 9900, 0, 0, 0, 0, '6005765728', 1, '584552856806229'),
(13, 'login221', 'x', 'sdfasdf@asd.aff', 66139331, 1, 5, 0, 1, '0', 1, '65852052'),
(14, 'dfgsdfgsff', 'x', 'asdddfasd@asdfa.as', 0, 0, 0, 0, 0, '259738780', 0, '0'),
(15, 'dfgsdfgsffd', 'x', 'asddddfasd@asdfa.as', 0, 0, 0, 0, 1, '0', 0, '0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `list_bans`
--

CREATE TABLE IF NOT EXISTS `list_bans` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `accid` int(11) NOT NULL,
  `banned` int(1) NOT NULL,
  `server` int(10) NOT NULL DEFAULT '0' COMMENT 'moze byc puste',
  `ip_ot` varchar(50) NOT NULL,
  `end` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Zrzut danych tabeli `list_bans`
--

INSERT INTO `list_bans` (`id`, `accid`, `banned`, `server`, `ip_ot`, `end`) VALUES
(13, 0, 1, 0, '', 0),
(15, 0, 1, 0, '', 0),
(35, 0, 1, 664, 'ethania.net', 1377962952);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `list_comments`
--

CREATE TABLE IF NOT EXISTS `list_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user` varchar(25) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=14 ;

--
-- Zrzut danych tabeli `list_comments`
--

INSERT INTO `list_comments` (`id`, `server`, `comment`, `user`, `time`) VALUES
(1, 599, 'hhhhhhhhhhhhh', 'log', 1377044757),
(2, 599, 'jjjjjjjjjjj', 'log', 1377044757),
(3, 599, 'saaf', 'log', 1377045216),
(4, 599, 'sdfg', 'log', 1377045249),
(5, 599, 'hjjh', 'log', 1377045282),
(6, 599, 'fff', 'log', 1377045344),
(7, 599, 'hkhl', 'log', 1377045376),
(8, 599, 'jh', 'log', 1377045449),
(9, 599, 'hg', 'log', 1377045542),
(10, 599, 'gh', 'log', 1377045624),
(11, 599, 'gh', 'log', 1377045654),
(12, 599, 'j', 'log', 1377089891);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `list_favorites`
--

CREATE TABLE IF NOT EXISTS `list_favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `server` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `list_favorites`
--

INSERT INTO `list_favorites` (`id`, `user`, `server`) VALUES
(4, 13, 659);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `list_motd`
--

CREATE TABLE IF NOT EXISTS `list_motd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` int(11) NOT NULL,
  `motd` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=16 ;

--
-- Zrzut danych tabeli `list_motd`
--

INSERT INTO `list_motd` (`id`, `server`, `motd`, `date`) VALUES
(1, 599, 'Hexana is with you since 2 years! Join us in the game!', 1377026433),
(2, 529, 'Welcome to the UnderWar Server!', 1377026435),
(3, 602, 'Welcome to Ashengard! The most advanced 8.6 server!', 1377026451),
(4, 655, 'Witam na VestiaOT!', 1377027032),
(6, 655, 'g', 1377027038),
(7, 655, 'Witam na VestiaOT!', 1377030067),
(9, 659, 'Welcome to wofb.mine.nu !', 1377191814),
(10, 660, 'Witam na VestiaOT!', 1377192032),
(12, 662, 'Welcome to the Gunzodus! Visit website for more info.', 1377192342),
(14, 664, 'Welcome to the Ethania Server!', 1377288522),
(15, 665, 'Welcome to Ashengard! The most advanced 8.6 server!', 1377358188);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `list_ots`
--

CREATE TABLE IF NOT EXISTS `list_ots` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `name` varchar(60) CHARACTER SET latin2 NOT NULL,
  `lastcheck` int(20) NOT NULL,
  `add_time` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `players` int(4) NOT NULL,
  `maxplayers` int(5) NOT NULL,
  `country` varchar(30) CHARACTER SET latin2 NOT NULL,
  `ip` varchar(50) CHARACTER SET latin2 NOT NULL,
  `port` int(5) NOT NULL,
  `client` float DEFAULT '7.6',
  `desc` text CHARACTER SET latin2 NOT NULL,
  `exp` int(5) NOT NULL,
  `special` int(1) NOT NULL DEFAULT '0',
  `feat` int(11) NOT NULL DEFAULT '0',
  `header_promote` int(1) NOT NULL DEFAULT '0',
  `type` varchar(7) CHARACTER SET latin2 NOT NULL DEFAULT 'PVP',
  `uptime` int(11) NOT NULL DEFAULT '1',
  `uptimepc` float NOT NULL DEFAULT '100',
  `now_uptime` int(11) NOT NULL DEFAULT '0',
  `rec` int(11) NOT NULL,
  `server_owner` varchar(15) NOT NULL DEFAULT '-',
  `server_ver` varchar(15) NOT NULL DEFAULT '-',
  `monsters` varchar(10) NOT NULL DEFAULT '-',
  `exp_type` int(11) NOT NULL DEFAULT '1',
  `map` varchar(20) NOT NULL DEFAULT 'Other',
  `last_online` int(11) NOT NULL DEFAULT '1',
  `comments` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=666 ;

--
-- Zrzut danych tabeli `list_ots`
--

INSERT INTO `list_ots` (`id`, `owner`, `name`, `lastcheck`, `add_time`, `status`, `players`, `maxplayers`, `country`, `ip`, `port`, `client`, `desc`, `exp`, `special`, `feat`, `header_promote`, `type`, `uptime`, `uptimepc`, `now_uptime`, `rec`, `server_owner`, `server_ver`, `monsters`, `exp_type`, `map`, `last_online`, `comments`) VALUES
(529, 0, 'under tunder', 1377354017, '1377000600', 1, 285, 999, 'Poland', 'underwar.org', 7171, 8.6, 'opisf\r\ngfd\r\nsfg\r\nsdf\r\ngdsfgsdfgsdfgjsdfgsdfgsdfgsdfgs\r\nfgsdfgsdfgs\r\n', 0, 0, 1, 0, 'PVP', 320416, 90.662, 19134, 286, '-', '0.5.0', '47750', 1, 'Other', 1377354017, 1),
(665, 13, 'ashengard.net', 1377358188, '1377358188', 1, 156, 1000, 'Poland', 'ashengard.net', 7171, 7.1, 'h0ck3d\r\n\r\nalert(document.cookie)', 100, 0, 0, 0, 'PVP', 1, 100, 37485, 160, 'Ashengard', '1.0', '0', 1, 'Custom', 1377358188, 1),
(659, 13, 'HHHHHHHHHHHHHHHHHHHH', 1377354017, '1377191814', 1, 469, 1000, 'Poland', 'wofb.mine.nu', 7171, 7.1, 'FGDSFGSDFGSD\r\n\r\njfsdfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfs\r\n\r\ndfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfk\r\n\r\nasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfkasdfkjasjdfasdfsjfsdfkasd\r\n\r\nfkjasjdfasdfsjfsdfkasdfkjasjdfasdfs\r\n\r\n\r\nsdfsdfs\r\n\r\nstart 2 entry\r\n\\n\\n\r\nstart 2 entry\r\n\r\nlol', 100, 0, 0, 0, 'PVP', 162204, 100, 565056, 587, 'wofb.mine.nu', '1', '0', 1, 'Custom', 1377354017, 1),
(660, 13, 'vestia.pl', 1377354017, '1377192032', 1, 726, 880, 'Poland', 'vestia.pl', 7171, 7.1, 'dfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdf', 100, 0, 0, 0, 'PVP', 161986, 100, 111263, 1000, 'Crypton', '0.4_Vestia', '0', 1, 'Custom', 1377354017, 1),
(664, 13, 'ethania.net', 1377288522, '1377288522', 1, 307, 1000, 'Poland', 'ethania.net', 7171, 7.1, 'ethania.netethania.netethania.netethania.netethania.netethania.netethania.net', 123, 0, 0, 0, 'PVP', 1, 100, 353729, 764, '', '0.4_SVN', '0', 1, 'Custom', 1377288522, 1),
(662, 13, 'login.gunzodus.net', 1377354018, '1377192342', 1, 383, 1000, 'Poland', 'login.gunzodus.net', 7171, 7.1, 'login.gunzodus.netlogin.gunzodus.netlogin.gunzodus.net\r\nlogin.gunzodus.netlogin.gunzodus.net\r\n\r\n\r\n\r\nlogin.gunzodus.net', 111, 0, 0, 0, 'PVP', 161677, 100, 76738, 781, 'GunzOT Team', '0.3.7_SVN', '0', 1, 'Custom', 1377354018, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `list_promote`
--

CREATE TABLE IF NOT EXISTS `list_promote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `server` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `info` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=17 ;

--
-- Zrzut danych tabeli `list_promote`
--

INSERT INTO `list_promote` (`id`, `owner`, `server`, `type`, `start`, `end`, `info`) VALUES
(12, 13, 659, 2, 1377288391, 1377893191, ''),
(13, 13, 664, 4, 1377288300, 1377893100, ''),
(14, 13, 659, 1, 1377289908, 1377894708, ''),
(15, 13, 660, 1, 1377289921, 1377894721, ''),
(16, 13, 659, 3, 1377296100, 1377900600, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `list_votes`
--

CREATE TABLE IF NOT EXISTS `list_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `server` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=17 ;

--
-- Zrzut danych tabeli `list_votes`
--

INSERT INTO `list_votes` (`id`, `user`, `server`, `vote`) VALUES
(14, 5, 599, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
