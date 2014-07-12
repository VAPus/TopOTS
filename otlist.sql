-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 16 okt 2013 kl 19:08
-- Serverversion: 5.5.32
-- PHP-version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `otlist`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `list_acc`
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
  `ip` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumpning av Data i tabell `list_acc`
--

INSERT INTO `list_acc` (`id`, `login`, `pass`, `mail`, `points`, `admin`, `count`, `ban`, `accepted`, `accept_key`, `to_reset`, `reset_key`, `ip`) VALUES
(20, 'mirt40', '3164d65d094c05761e02669fb360b706', 'tko771@gmail.com', 0, 0, 0, 0, 1, '0', 0, '0', NULL),
(21, 'Naxtie', '767c24a10f9114d94a2d658189595144', 'naxtie@hotmail.com', 0, 0, 1, 0, 1, '0', 0, '0', NULL),
(22, '21999', '8249f49040593c52317dde0c5cb2465a', 'ahmada3435@hotmail.com', 0, 0, 5, 0, 1, '0', 0, '0', NULL),
(23, 'Magnetico', 'fc8a7634e7afb99be7f47f5bc21f979a', 'obregon.00@hotmail.com', 0, 0, 0, 0, 1, '0', 0, '0', NULL),
(24, 'Skyline', '4e769df52673189a8a72a3c6ff4e2a51', 'Nubwarz@hotmail.com', 0, 0, 1, 0, 1, '0', 0, '0', NULL),
(25, 'incam', '9f9f81e4fd4834d95b064994bff080f8', 'dougleachtdl@yahoo.com', 0, 0, 1, 0, 1, '0', 0, '0', NULL),
(26, 'Juh150', 'e33707346b85b7adf07dfd4fec532d46', 'tibiaserver99@hotmail.com', 0, 0, 0, 0, 1, '0', 0, '0', NULL),
(27, 'aridon', '733d7be2196ff70efaf6913fc8bdcabf', 'suporte@worldofaridon.org', 0, 0, 1, 0, 1, '0', 0, '0', NULL),
(28, 'Jaeded', '16bdcbc8fcf5533f54f64ff9c05bbf5e', 'jaeded89@live.com', 0, 0, 0, 0, 1, '0', 0, '0', NULL),
(29, 'averatec', '4eead8478419770bc54278f730b7ec81', 'kaker@wp.eu', 0, 0, 0, 0, 1, '0', 0, '0', NULL),
(30, 'monte321', '8f036369a5cd26454949e594fb9e0a2d', 'monte2@op.pl', 0, 0, 5, 0, 1, '0', 0, '0', NULL),
(31, 'fabricioc', '718ebe33aba45f3744edcec9a6d8878f', 'totalwar.suporte@gmail.com', 0, 0, 2, 0, 1, '0', 0, '0', NULL),
(32, 'Flatlander', '03b639402625da78bc4dc97c9706e87f', 'patman57@gmail.com', 0, 0, 1, 0, 1, '0', 0, '0', NULL),
(33, 'Kuuush', '99534636b0261b19a2d31b869d3ce3c5', 'nesart@live.cl', 0, 0, 0, 0, 1, '0', 0, '0', NULL),
(34, 'Himii', '7834aae660a2e2c2dbd3bbdfca34d393', 'axewes@gmail.com', 0, 0, 0, 0, 1, '0', 0, '0', NULL),
(35, 'Raggaer', '321fd4d1d2333f2e37df06f687eaa32a', 'raggaer@hotmail.com', 0, 0, 0, 0, 1, '0', 0, '0', NULL),
(38, 'gunzino', 'efe6398127928f1b2e9ef3207fb82663', 'gunzo@gunzo.eu', 0, 0, 1, 0, 1, '0', 0, '0', NULL),
(39, 'DDSoba', '0f21d01cf93f42b8915b2d4c1bfa265f', 'sobaakaabu@gmail.com', 0, 0, 0, 0, 1, '0', 0, '0', NULL),
(41, 'Fjramos', '86dbc824ad18ce5dc39117c579ff8ff2', 'fjramos@gmail.com', 0, 0, 0, 0, 1, '0', 0, '0', NULL),
(43, 'Amiroslo', 'b2bca814cfc8cf3e69928bcd7480fb83', 'amiroslo@hotmail.com', 6600, 0, 1, 0, 1, '0', 0, '0', NULL),
(44, 'XoriaOT', 'adc27bbb015d9eece732dde403449129', 'VJ2354@hotmail.com', 0, 0, 1, 0, 1, '0', 0, '0', NULL),
(46, 'cinara', 'fd13836312291f938d927a686844900d', 'cinara-shop@hotmail.com', 0, 0, 1, 0, 1, '0', 0, '0', 1383465097),
(48, 'STiX', 'c2cf58fad21b7bc7535b1123b6e60b48', 'stix@opentibia.net', 0, 0, 0, 0, 1, '0', 0, '0', 2090127810),
(49, 'Pifafa', '1b6994fd7158c4f4a0c0904c99595a9f', 'rafa_tolomeotti@hotmail.com.br', 0, 0, 1, 0, 1, '0', 0, '0', 3364344322),
(50, 'Aeluwin', '90896462dcfabde12f2ae46ca3708c61', 'aeluwin@gmail.com', 0, 0, 0, 0, 1, '0', 0, '0', 404508296),
(51, 'danipopeye', 'da8d320ab3640bdd23aa66db9f02d73e', 'danipopeye@hotmail.com', 0, 0, 1, 0, 1, '0', 0, '0', 1476401603),
(52, 'sn240', 'd2f20a44d77f078c1c8daf537f5fa258', 'sunsan97@hotmail.com', 0, 0, 1, 0, 1, '0', 0, '0', 1374544655),
(53, 'andreu400', '175d1929aed5fa7238087e37c45f5ae2', 'godsuimty@gmail.com', 0, 0, 1, 0, 1, '0', 0, '0', 1361414265),
(54, 'sidex', 'c5e3539121c4944f2bbe097b425ee774', 'dark_pvp@hotmail.com', 0, 0, 1, 0, 1, '0', 0, '0', 3186450438),
(55, 'didito', '89794b621a313bb59eed0d9f0f4e8205', 'didito_nf@hotmail.com', 0, 0, 1, 0, 1, '0', 0, '0', 3133272735),
(56, 'danpau3012', '104a1cc28d163fa23fef941bd67d7150', 'adwokat18@o2.pl', 0, 0, 0, 0, 1, '0', 0, '0', 1393206764),
(57, '5457854', '3e038dd2ff1d49dbbb9a2ca570ac7472', 'DarcknessOT@yahoo.com', 0, 0, 0, 0, 1, '0', 0, '0', 3642215874),
(58, 'chipsen', '003afd638996d7e6f8bd1258b47ede9e', 'chiphugo@live.se', 0, 0, 1, 0, 1, '0', 0, '0', 1426789399),
(59, 'opentibia', 'bc64207bbffb4a45b34371177c52bab6', 'otsers200@gmail.com', 0, 0, 4, 0, 1, '0', 0, '0', 1498117012),
(60, 'jollejkpg', '12370d3ccd5fedd22bf0e2f31e80e7b6', 'bergholm_16@hotmail.com', 0, 0, 0, 0, 1, '0', 0, '0', 3654544023),
(61, 'eriis', '2664684176bbcec12badf1f6296986cb', 'Eriistof@interia.eu', 0, 0, 1, 0, 1, '0', 0, '0', 2374465931),
(62, 'Shankote', '84d03011369c135f0ba48cdb37c63c12', 'kokom23@yahoo.com', 0, 0, 1, 0, 1, '0', 0, '0', 3307574993),
(63, 'shaheen', '9cab75e39d30e3c75db6eeb86749205a', 'mohamedshaheen502@yahoo.com', 0, 0, 0, 0, 1, '0', 0, '0', 690796096),
(64, 'skullcrusher', '0bacb77d4a4c11a9cb4b43370b76a641', 'skullcrusherserver@gmail.com', 0, 0, 1, 0, 1, '0', 0, '0', 636947186),
(65, 'sikret', '8c4709facc7e0e900c55f6c577ee9a74', 'underap1@gmail.com', 0, 0, 1, 0, 1, '0', 0, '0', 520156243),
(66, 'maschbdg', '4d2832fe0a85ea171b8ed2abe378d7d9', 'maschbdg@o2.pl', 0, 0, 2, 0, 1, '0', 0, '0', 1497447377),
(67, 'dineraots', '965f1724db8a109dfc60aed5943e3521', 'otsers100@gmail.com', 0, 0, 0, 0, 1, '0', 0, '0', 1498117012);

-- --------------------------------------------------------

--
-- Tabellstruktur `list_bans`
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

-- --------------------------------------------------------

--
-- Tabellstruktur `list_comments`
--

CREATE TABLE IF NOT EXISTS `list_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user` varchar(25) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=53 ;

--
-- Dumpning av Data i tabell `list_comments`
--

INSERT INTO `list_comments` (`id`, `server`, `comment`, `user`, `time`) VALUES
(51, 714, 'Best Tibia server!!!', 'chipsen', 1378890005),
(52, 705, 'good amiroslo', 'shaheen', 1379712944);

-- --------------------------------------------------------

--
-- Tabellstruktur `list_favorites`
--

CREATE TABLE IF NOT EXISTS `list_favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `server` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=11 ;

--
-- Dumpning av Data i tabell `list_favorites`
--

INSERT INTO `list_favorites` (`id`, `user`, `server`) VALUES
(6, 21, 668),
(7, 24, 676),
(8, 29, 678),
(9, 31, 685),
(10, 34, 673);

-- --------------------------------------------------------

--
-- Tabellstruktur `list_motd`
--

CREATE TABLE IF NOT EXISTS `list_motd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` int(11) NOT NULL,
  `motd` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=92 ;

--
-- Dumpning av Data i tabell `list_motd`
--

INSERT INTO `list_motd` (`id`, `server`, `motd`, `date`) VALUES
(18, 668, 'Shivera EVO 8.6', 1377541406),
(24, 673, 'PandaOTS', 1377617162),
(26, 676, 'Welcome to Skyline War!', 1377694622),
(27, 677, 'Welcome to the Ascalon!', 1377696807),
(28, 678, 'Bem vindo ao World of Aridon Servidor 9.83 ate 9.86!', 1377709864),
(29, 679, 'Welcome to AlveraOT!', 1377727370),
(30, 680, 'Presents week is coming!', 1377727411),
(31, 681, 'Welcome to the Noobwar.eu!', 1377727742),
(32, 682, 'Welcome to Euforia Real Map!', 1377727796),
(33, 683, 'Witaj Graczu na Tiberi', 1377727853),
(34, 684, 'Welcome to Sv-Turion OldSchool Server!', 1377729304),
(35, 685, '*Bem Vindo ao Total War.*', 1377729392),
(36, 686, 'Stat Points were reset!', 1377730341),
(37, 686, 'Welcome to The Species Mega Server!', 1377742519),
(38, 668, 'Welcome to Ataria 8.60!', 1377802202),
(39, 687, 'Welcome to the Cantebia Server!', 1377818293),
(40, 689, 'Witaj na Elficki OTS 9.6 - Mistyczny swiat Elfow!', 1377862623),
(41, 690, 'PandaOTS', 1377863695),
(42, 692, 'Welcome to the Gunzodus! Visit website for more info.', 1377863811),
(44, 693, 'Welcome to Evolera, view help channel, or contact Staff if you need any help.', 1377864495),
(45, 695, 'Welcome to the Exoria-OT!', 1377875266),
(46, 696, 'Welcome to the Xerazx-OTS Update Server!', 1377881961),
(48, 699, 'Welcome to the Xoria 8.6 Open Tibia Server!', 1377895214),
(49, 698, 'Welcome to Eurotibia Server!', 1377898525),
(50, 700, 'Welcome to the Xerazx-OTS Update Server!', 1377903473),
(51, 701, 'Welcome to ShadowCores!', 1377903489),
(52, 703, 'Welcome to Cinara 8.6!', 1377907525),
(53, 704, 'Welcome to Cinara 8.6!', 1377908336),
(54, 705, 'PandaOTS', 1377962948),
(55, 706, 'Bem vindo ao Cn Server!', 1377974232),
(58, 668, 'Shivera EVO 8.6', 1378036201),
(59, 686, 'Stat Points were reset!', 1378158625),
(60, 686, 'Welcome to Origins Alpha!', 1378161932),
(61, 686, 'Stat Points were reset!', 1378171225),
(63, 710, 'Welcome!', 1378418919),
(64, 711, 'Welcome to Adictive !', 1378418928),
(65, 712, 'Welcome to MythWorld!', 1378424294),
(66, 713, 'Obrigado por se conectar, espero que se diverta muito aqui hoje!', 1378483631),
(67, 686, 'This is Survival Beta Phase 1.', 1378615214),
(68, 686, 'Stat Points were reset!', 1378686924),
(69, 714, 'Welcome to SweSpel!', 1378835817),
(70, 715, 'Welcome To Dinera OTS www.dinera.net', 1378843717),
(71, 716, 'Welcome To Openka OTS www.openka.net', 1378843783),
(72, 717, 'Welcome to Simson OTS www.simsonots.eu', 1378843858),
(73, 718, 'Welcome to Axera OTS www.axera.pl', 1378843985),
(74, 711, 'Welcome to the OTX Emporia!', 1378908340),
(75, 711, 'Welcome to Adictive !', 1378927239),
(76, 719, 'Welcome to the Fearless. If you want to report bug/cave bot use CTRL + Z, please. To buy bless use !bless, it costs 50k, you dont need aol.', 1379168198),
(77, 680, 'Aurera is coming!', 1379242213),
(78, 720, 'FruitLoop 8.6', 1379670169),
(79, 720, 'Welcome TO forg Ot~~!!', 1379846189),
(80, 721, 'Welcome to the SkullCrusher Server', 1379909839),
(81, 722, 'Welcome to Evolva!', 1380057949),
(82, 723, 'Witamy na serwerze Tutors!', 1380287645),
(83, 723, 'Welcome to tutors 10.10 Ot', 1380469600),
(84, 681, 'Welcome on Enemia World! Report all bugs ;)', 1380553832),
(85, 713, 'Seja bem vindo ao Soldadinhos ATS!', 1380833768),
(86, 681, 'otservlist.org-delete', 1380914432),
(87, 681, 'Welcome on Enemia World! Report all bugs ;)', 1380915033),
(88, 680, 'Reptera is coming!', 1380980153),
(89, 724, 'Welcome to the Szof!', 1381167765),
(90, 725, 'Welcome to the Ramira!', 1381167814),
(91, 678, 'Bem vindo ao WoA - Centrum World! Servidor 9.83 ate 9.86!', 1381441513);

-- --------------------------------------------------------

--
-- Tabellstruktur `list_ots`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=726 ;

--
-- Dumpning av Data i tabell `list_ots`
--

INSERT INTO `list_ots` (`id`, `owner`, `name`, `lastcheck`, `add_time`, `status`, `players`, `maxplayers`, `country`, `ip`, `port`, `client`, `desc`, `exp`, `special`, `feat`, `header_promote`, `type`, `uptime`, `uptimepc`, `now_uptime`, `rec`, `server_owner`, `server_ver`, `monsters`, `exp_type`, `map`, `last_online`, `comments`) VALUES
(679, 30, 'AlveraOT 9.8', 1381943101, '1377727370', 1, 3, 1000, 'Poland', 'alveraot.net', 7171, 9.8, 'AlveraOT starts August 28 at 18:00\r\n\r\nAlveraOT - one of the most polished Server 9.8. You will find here all the quests, missions and areas to hunt. We worked hard on creating this server - now we can say that every player who will come here will be happy.\r\n\r\nBut why did you choose this server and not another? The answer is - it does not exist :D We can write why you should choose this server. Each player have different tastes, one likes to hunt, one likes to fight with other players, and another like to make quests. We can only write to you the advantages of a server, which can be found here, and there are really a lot!\r\n\r\nKick System - the AlveraOT find a system by which the absence of the internet will not be killed by a monster! But how does it work? When a player suffers the kick, the system automatically blocks the impact you by monsters. This allows not lose time in making up for the lost levels and gold. And if you do not attack another player, you will be thrown out of the game after 60 seconds.\r\nNew areas - we have all the sites available with version 9.8, we also have a number of new sites have been added in the new client.\r\nA huge number of quests - you will find with us all the quests from the quest boxes, with extensive quests and Thieves Guild Quest and The Inquisition. We guarantee that all work perfectly!\r\nThe perfect balance of form - not once seen underdeveloped characters on multiple servers, but here you can ensure that each profession is slippery and no one will impose his superiority, just remember that every profession has its own strengths and weaknesses!\r\nRaids - the AlveraOT are all global rallies, both small and those for which you go with your friends! All bossy May properly selected loot and attack!\r\nBlessings - all blessings can buy in any temple, both to protect the five blessings of monsters, as well as the Twist of Fate, which makes the start of the death of the player.\r\nQuick Support - certainly many times have you that support improved something for a long time. Here it is different! Support strives to improve the bugs immediately after reporcie! However, some bugs need to be improved when saving the server!\r\nAchievements - this is something of which we are most proud of, because few servers can boast such a large amount of Achievements! To get give you more than 200 different achievements, the sum is more than 500 points!\r\n\r\n\r\nThat''s not all you can find on the server, but that''s all I was able to describe these bigger things. But it is not all about what he wants to write here! We rely on advertising by the administration and players! So, can you help us on the tin! All you have to write a post on a forum on tibia or other games. Links to posts, along with the name of your character should be placed on the board! You can also advertise your server in a way that will suit you! We guarantee that we will repay you points to our store! Photos and other things, also please place in our forums! I guess so, I wish you a nice game and a short wait for the start of the server!\r\n', 48, 0, 0, 0, 'PVP', 4163814, 98.7685, 32383, 35, 'Kalvera Evo', '0.3.7_SVN', '0', 1, 'Real Map', 1381943101, 1),
(668, 21, 'Shivera Ots', 1381943111, '1377541406', 0, 0, 1000, 'Sweden', 'shivera-ot.sytes.net', 7171, 8.6, 'BEST EVOLUTION EVER!!!\r\n\r\nDAAAAYUMM!!', 450, 0, 0, 0, 'PVP-E', 78302, 1.7789, 0, 10, 'Naxtie@OtLand', '0.3.6', '0', 1, 'Edited Evolution', 1380396601, 1),
(719, 61, 'Fearless OTserver', 1381943111, '1379168198', 1, 26, 600, 'Poland', 'fearless.sytes.net', 7171, 10.1, 'Server Information:\r\nIP:	fearless.sytes.net\r\nPort:	7171\r\nClient:	10.10\r\n\r\nMain Information:\r\nEdited RL MAP\r\nOfline Training\r\nNEW Ab dendriel, DREFIA, Fury Dungeon and more 10.0+ spawns!\r\nGNOME BASE with Warzones\r\nNEW Venore and 9.8 Spawns\r\nQuirefang, Pyre/Oken/Gengia added and Terrace city, Fort Courage(cities created by our team!)!\r\n\r\nOT Features:\r\nUptime 24/7 at dedicated server\r\nFriendly admins\r\nOpen-PvP\r\nFully Working Questlog\r\nGrizzly Adams Task System (read section in library at website)\r\nMount system (read section in library at website)\r\nAddon system (read section in library at website)\r\nBalanced vocations\r\nBalanced spells\r\nCool Events everyday\r\nIn game report system (ctrl + z)\r\nGuild War System (with shields, for cash too)\r\nLess cooldowns than RL Tibia\r\nAll Monsters are balanced\r\nEdited Items\r\nFrags\r\nDaily frags to Red Skull:	 6\r\nDaily frags to Black Skull:	 12\r\nSkulls time:\r\nRed Skull:	2 days\r\nBlack Skull: 3 days\r\nProtection Level (pvp): 80 \r\n\r\nLevel to buy house: 150 \r\nIf you dont log in for 10 days, you will lose your house \r\n\r\nBanishments:\r\nBanishment:	3 days (first banishment)\r\nFinal Banishment: 7 days (second banishment)\r\nThird banishment = deletion\r\n\r\nExperience Stages:\r\n1-30 lvl 300x\r\n31-50 lvl 200\r\n51-70 lvl 150\r\n71-100 lvl 120\r\n101-130 lvl 100x\r\n131-160 lvl 70x\r\n161-200 lvl 45x\r\n201-250 lvl 30x\r\n251-300 lvl 15x\r\n301-350 lvl 7x\r\n351-400 lvl 3x\r\n401+ lvl 2x', 45, 0, 0, 0, 'PVP', 2736501, 98.6157, 198810, 63, 'GOD Fearless', '0.3.7_SVN', '0', 1, 'Custom', 1381943111, 1),
(678, 27, 'World of Aridon', 1381943112, '1377709864', 1, 14, 200, 'Brazil', 'go.worldofaridon.org', 7171, 9.8, 'Dados de ConexĂŁo:\r\nIP: go.worldofaridon.org\r\nVersĂŁo: 9.83 atĂŠ 9.86\r\nPort: 7171\r\nServidor Dedicado nos EUA.\r\n\r\nSite: http://www.worldofaridon.org\r\n\r\nCriar conta no Site\r\nCriar Personagem no Site\r\nCriar Guild no Site\r\nRanking no Site\r\n\r\n\r\nFeatures:\r\n- Mounts e Outfits 9.80\r\n- Quirefang annd Gray Island\r\n- Mounts free. (Taming global. REAL)\r\n- Guild Wars (Escudos)\r\n- Mounts 100% Global\r\n- Mapa Global Full custom\r\n- Updates constantes para melhor diversĂŁo\r\n- Bank System\r\n- Quests Global 100%\r\n- Site com recursos Ăşnicos e inĂŠditos\r\n- Market system 100%\r\n- System Aluguel de Mounts 100%\r\n- TASK System 100%\r\n- GnomeBase e Warzone 1 2 3\r\n- Segunda DimenĂ§ĂŁo\r\n- MadMage Tower\r\n- Venore nova completa\r\n- Training offline\r\n- Caverna de Drillworms e Giant Spiders em Kazordoon\r\n- Todas novas caves de Kazordoon com os novos dwarvens\r\n\r\nExp: 600x Stages\r\nSkill: 85x\r\nMagic Level: 30x\r\nLoot: 3x', 600, 0, 0, 0, 'PVP', 4211635, 99.4894, 501377, 87, 'World of Aridon', '0.3.7_SVN', '0', 1, 'Real Map', 1381943112, 1),
(676, 24, 'WAR 9.80 - 9.86', 1381943122, '1377694622', 0, 0, 200, 'United States', 'SkylineWar.no-ip.org', 7171, 9.8, 'Hello everyone and welcome to Skyline War! \r\nThe new generation of War! \r\n\r\nClient: 9.80 - 9.86\r\nSkylineWar.no-ip.org\r\n\r\nYou can download both the IP Changer and the 9.86 Tibia client on the website: SkylineWar.no-ip.org\r\n\r\nCome check it out, dominate, and destroy!\r\nSkylineWar.no-ip.org\r\n', 5, 0, 0, 0, 'WAR', 1042328, 24.534, 0, 31, '[Admin] Skyline', '2', '0', 2, 'Edited Real Map', 1379265680, 1),
(677, 25, 'Ascalon CUSTOM RPG', 1381943132, '1377696807', 0, 0, 1000, 'Sweden', 'ascalon-world.com', 7173, 8.7, 'Ascalon is a custom RPG server. \r\nWe use custom experience formulas which allow you to gain levels quickly but still require you to put some effort into leveling. \r\n\r\nOur map is fully custom and detailed. Many secrets await to be discovered by players of all levels. \r\n\r\nWhen dying, players with a red skull lose one random item from their inventory instead of everything. Its not possible to lose backpack upon a death, however there is no amulet of loss ingame, so only way to lower chance of losing an item is buying a bless. Blessings are lowering experience penalty and decreasing chance to drop an item upon a death. \r\n\r\nMonsters are fully custom and their difficulty had been changed. While rotworms still are something you kill right after joining the game, killing a cyclop drone may be a challenge even for quite experienced explorers. But do not worry! To get an edge against the tough monsters, you can use a vast amount of spells and all of them are custom aswell! This gives you an unique feeling while going on a hunt or trying to complete a quest. \r\n\r\nRight, quests! There are tons of them, spread all over the map. Our quests are innovative and fresh. Both old, dedicated players and newcomers will find something suiting themselves! \r\n\r\nWe hope to see you on the lands of Ascalon.\r\n\r\nIP: ascalon-world.com\r\nPort: 7173\r\nClient: Custom(based on 8.70 protocol)\r\nWorld Type: Open-PvP\r\nProtection level: 50\r\nRequired level to create guild: 50\r\nWhite skull time: 10 minutes\r\nDaily frag limit: 5\r\nRed skull lenght: 5 days\r\nRequired level to buy a house: 50\r\nHouse rent: Daily', 25, 0, 0, 0, 'PVP', 2120588, 49.9394, 0, 132, 'Fare', 'ASC3665', '0', 2, 'Custom', 1379833522, 0),
(680, 30, 'Reptera 9.8', 1381943132, '1377727411', 1, 9, 900, 'Poland', 'reptera.net', 7171, 9.8, 'Hello all tibia player!\r\nReptera.net starts on 28.07.2013 at 19:00!! All are invited to our start! Reptera is 9.8 global map with all quests, terains and achievements. You can try doing quests here or just fight with anothers players. We got also unique page and some systems like Kick System. All this you can test in game!\r\n\r\nWhy our server?\r\n\r\n\r\n\r\nYou can buy all blessings from temple npc in one price. You can buy also twist of fate from this same npc!\r\n\r\n\r\n\r\nOn reptera you can find all warzone missions and warzone tasks. You can also get achievements or money hunting here.\r\n\r\n\r\n\r\nYou can find here all new exp places like quaras, war golems and others!\r\n\r\n\r\n\r\nGreat balance - all vocations are balanced, you won''t find here any powerfull vocation, all are great!\r\n\r\nAround 100 working quests - all quests have many missions and they works 100%\r\n\r\n50 working raids - you can easly fight with bosses everyday on Reptera\r\n\r\n500 achivements points - YES, you can get 500 achievements points on reptera by doing quests or simple tasks\r\n\r\nAll missions from Grizzly Adams work with achievements and bosses, also all bosses work fine\r\n\r\nOur support can help you with all problems, we know all about quests system and pvp!\r\n\r\nOn reptera you will gain experience for doing quests! You can find more informations here: Link\r\n\r\n', 28, 0, 0, 0, 'PVP', 4162341, 98.7338, 373393, 20, 'Reptera Team', '0.3.7_SVN', '0', 1, 'Real Map', 1381943132, 1),
(681, 30, 'Noobwar 8.6', 1381943132, '1377727742', 1, 145, 1500, 'Poland', 'noobwar.eu', 7171, 8.6, 'Noobwar.eu is back. We started on 14.08.2013 at 16:00\r\n\r\nCreate account and kill :D ', 1, 0, 0, 0, 'PVP', 4195518, 99.5286, 50350, 943, 'Yanger', '3.0', '0', 2, 'Custom', 1381943132, 1),
(682, 30, 'RealMap Free Points', 1381943132, '1377727796', 0, 0, 1000, 'Poland', 'euforia.zapto.org', 7171, 8.6, 'Information:\r\n\r\nÂť Client: 8.60\r\nÂť IP: euforia.zapto.org\r\nÂť Map: Edited Real Map + Gengia, Oken, Pyre.\r\n\r\nStages:\r\n\r\nÂť 1 70 900x\r\nÂť 71 100 700x\r\nÂť 101 130 500x\r\nÂť 131 160 300x\r\nÂť 161 190 200x\r\nÂť 191 220 100x\r\nÂť 221 240 70x\r\nÂť 241 270 50x\r\nÂť 271 290 30x\r\nÂť 291 310 15x\r\nÂť 311 330 7x\r\nÂť 331 360 4x\r\nÂť 360 390 2x\r\nÂť 391 999 1x\r\n\r\n\r\nRates:\r\n\r\nÂť Skill - 40x\r\nÂť Magic - 30x\r\nÂť Loot - 3x\r\nÂť Spawn - 2x\r\n\r\n\r\nFeatures:\r\n\r\nÂť Vip System With Custom Castles.\r\nÂť Free Points.\r\nÂť Addons Bonus [Check].\r\nÂť War System.\r\nÂť All Quests Work (Example: INQ, Poi, DH, Annihilator,\r\nYalahari Quest, HardCore Quest, AND MORE MUCH MORE).\r\nÂť Hosted 24/7.\r\n\r\n\r\nPoints :\r\n\r\nÂť Level 250 - 50 Shop Points to your account.\r\nÂť Level 300 - 50 Shop Points to your account.\r\nÂť Level 350 - 100 Shop Points to your account.\r\n\r\n\r\nEvents :\r\n\r\nÂť Zombie Event - 50cc .\r\nÂť Last Man Standing - 30cc .\r\nÂť BomberMan.\r\nÂť Casino. ', 300, 0, 0, 0, 'PVP', 545688, 12.9453, 0, 182, 'Nova', '0.4_SVN', '0', 1, 'Edited Real Map', 1378281382, 1),
(683, 30, 'Update Hight Exp', 1381943132, '1377727853', 1, 68, 250, 'Poland', 'tiberia.pl', 7171, 8.5, 'Zapraszam Na Legendarny Ots Tiberia.pl Najlepszy Ots FUN !\r\nInfo o Serwerze :\r\n\r\nSERWER DEDYK 24/7\r\n_______________________\r\nExp Stages\r\n1-1000 EXP: 99999\r\n1001-5000 EXP: 6666\r\n5001-10000 EXP: 4444\r\n10001-20000 EXP: 3333\r\n20001-30000 EXP: 1111\r\n30001-50000 EXP: 999\r\n50001-75000 EXP: 600\r\n75000-100000 EXP: 500\r\n100001-200000 EXP: 200\r\n20001+ EXP: 100\r\n________________________\r\nQuest NEW Tiberia.pl\r\n\r\n$Roller Coster Quest\r\n$Poi Quest in Tiberia\r\n$Demon Oak in Tiberia\r\n$Mega Quest in Tiberia\r\n$Inq Quest in Tiberia\r\n$New Addons Quest\r\n$New Arena Quest in Tiberia\r\n$Shinobi Set Quest\r\n$Soul Set Quest\r\n$New Profesion Quest (PROMOTE)\r\n$New Freestyle Quest\r\n_________________________\r\nNEW Events Tiberia.pl\r\n\r\n# Capture The Flag\r\n# King of The Hill ( HIT )\r\n# Castle War\r\n# Zommbi Event\r\n# Arena Gladiatus\r\n# Run Event\r\n# Gladiator Hill\r\n__________________________\r\nNew Profesion Tiberia.pl\r\n\r\n1. Knight 2. Elite Knight 3. Dark Warrior 4. Hell Slayer\r\n\r\n1. Paladin 2. Royal Paladin 3. Ninja 4. Shinobi\r\n\r\n1. Druid 2. Elder Druid 3. Priest 4. Heal Maker\r\n\r\n1. Sorcerer 2. Master Sorcerer 3. Evil Master 4. Soul Mage\r\n\r\n_________________________\r\nNew Items\r\n\r\nSuper Health Shield, Super Mana Shield, Slingshot, Ninja Armor, Silvers Set,Soul Set, Dark Warrior Set, Pro Sword Pro Slayer, Excalibur , Damage Aol Amulet , Damage Amulet\r\nHoly Flacon, Golden Flacon , Upgrade Rune\r\n\r\nOraz Wiele Wiele Innych :)\r\n\r\nNew Client dowload: http://tiberia.pl/Tiberia_install*****', 999, 0, 0, 0, 'PVP', 4168147, 98.8819, 49779, 476, '', '0.3.6_SVN', '0', 1, 'Custom', 1381943132, 1),
(684, 31, 'Turion Guild War', 1381943133, '1377729304', 0, 0, 1000, 'Brazil', 'sv-turion.no-ip.info', 7171, 7.6, 'WEBPAGE\r\nhttp://sv-turion.no-ip.info\r\n\r\nOldschool is quite different from other Open Tibia Servers, as Turion is a 7.6 OT. Just a small selection of what we offer\r\n* Oldskool Tibia feeling\r\n* No item hotkeys\r\n* Custom (OLD-TURION MAP)\r\n* Perfect Balancing\r\n* Custom Client\r\n* Active crew\r\n* Running on a stable distribution\r\n* Contains every quest from the good old times\r\n* Free premium Account !\r\n* Hosted on a proper dedicated server.\r\n\r\n*Exp: \r\n1 to 100 6x\r\n101+ 3x\r\n*Skills: 7x\r\n*ML: 4x\r\n*Loot: 2x\r\n\r\n*IP: sv-turion.no-ip.info\r\n*Port: 7171\r\n*PvP type: PvP/RPG\r\n*Map: Turion Map\r\nhttp://imageshack.us/photo/my-images/715/turion.png/\r\n\r\n\r\n*Skull System\r\nRedSkull: 4 Frags\r\nBan: 6 Frags\r\nFrag Time: 12H\r\nWhiteSkull Time: 8 minute\r\n\r\n*Connnection\r\n4x 3.60Ghz\r\n4G RAM\r\n1GB Full Duplex internet connnation\r\n\r\n*Create account:\r\nhttp://sv-turion.no-ip.info/register.php\r\n\r\n|sv-turion.no-ip.info|', 6, 0, 0, 0, 'PVP', 2631697, 62.4538, 0, 98, '', '0.4_SVN', '0', 1, 'Custom', 1380669334, 1),
(685, 31, 'Total-War 24h', 1381943133, '1377729392', 1, 148, 1000, 'Brazil', 'total-war.org', 7171, 8.6, 'WebSite: http://total-war.org\r\n\r\nIp: Total-War.Org\r\n\r\nClient: 8.6\r\n\r\nCustom Exp\r\n\r\nServer type: War Server\r\n\r\nSkills & Magic rates: 40x Skill and 7x Magic.\r\n\r\nMap: Edron, Fibula, Thais, Venore, Carlin, Kazordoon, Desert, Yalahar and Rookgaard\r\n\r\nCustom !online: 90 players online:\r\nIn Edron: 0, in Fibula: 20, in Treiner: 32, in Thais: 1, in Venore: 35, in Carlin: 0, in Kazordoon: 0, in Desert: 2, in Yalahar: 0, in Rookgaard: 0.\r\n\r\nEvents: Arena 5x5 and Capture The Flag\r\n\r\nForum: Forum.Total-War.Org\r\n\r\nTeamSpeak 3: TS.Total-War.Org\r\n\r\nGuild War With Shields', 100, 0, 0, 0, 'WAR', 4116092, 97.6826, 113403, 210, '', '0.4_DEV', '0', 2, 'Custom', 1381943133, 1),
(686, 32, 'Species Mega Server', 1381943145, '1377730341', 0, 0, 1000, 'USA', 'species.no-ip.biz', 7171, 10.1, 'This is my Species Mega Server (Currently being updated to 10.10)\\r\\nThis will have multiple game-types all featuring the Species Theme.\\r\\nIncluding:\\r\\n\\r\\nSpecies War\\r\\n\\r\\nSpecies Bombers\\r\\n\\r\\nSpecies Survival\\r\\n\\r\\nI will update this more later.', 1, 0, 0, 0, 'WAR', 707621, 16.7969, 0, 26, 'Eiffel and Spor', '0.3.7_SVN', '0', 2, 'Custom', 1381793135, 1),
(700, 22, 'highexp', 1381943145, '1377903473', 1, 85, 1000, 'Sweden', 'highexp.eu', 7171, 9.8, 'Xerazx OTSes', 9999, 0, 0, 0, 'PVP', 4000660, 99.0343, 77288, 300, 'Xerazx-OTS', '0.0.0', '0', 2, 'Custom', 1381943145, 1),
(699, 44, 'XoriaOT 8.6 RL', 1381943145, '1377895214', 0, 0, 1000, 'Sweden', 'XoriaOT.no-ip.org', 7171, 8.6, 'Server Information:-\r\nIP: XoriaOT.No-Ip.org\r\nMap: Real Tibia 8.6\r\nClient: 8.60\r\nPort: 7171\r\nOnline 24/7\r\nUptime 99.x%\r\n\r\n\r\nStaged EXP:-\r\n1 - 50 = 1000x EXP\r\n51 - 75 = 500x EXP\r\n76 - 100 = 250x EXP\r\n101 - 125 = 100x EXP\r\n126 - 150 = 50x EXP\r\n151 - 175 = 25x EXP\r\n176 - 200 = 10x EXP\r\n201+ = 5x EXP\r\n\r\nRates:-\r\nSkill rate: x120\r\nMagic rate: x40\r\nLoot rate: x5\r\n\r\nPVP System:-\r\nProtection level: 30\r\nWhite Skull Time: 15 minutes\r\nFrags to Red Skull: 5 (Day)\r\nFrags to Red Skull: 10 (Week)\r\nFrags to Red Skull: 15 (Month)\r\n\r\nOKEN, GENGIA AND PYRE ALSO ADDED TO MAP. ACCESS ONLY THROUGH THAIS BOAT', 1000, 0, 0, 0, 'PVP', 1169413, 28.8891, 0, 74, 'Admin Blitz', '0.3.7_SVN', '0', 1, 'Real Map', 1379070925, 1),
(705, 43, 'PandaOTS', 1381943145, '1377962948', 1, 12, 1000, 'Sweden', 'Pandaots.sytes.net', 7171, 8.6, 'IP: PandaOTS.sytes.net\r\nPort: 7171\r\nHosted in: Sweden\r\nUptime: 24/7 (expect when update)\r\nWebsite: http://PandaOTS.sytes.net/\r\n', 9999, 0, 0, 0, 'PVP', 3855017, 96.8549, 543216, 113, 'Admin Amir', '0.4_SVN', '0', 1, 'Custom', 1381943145, 1),
(703, 45, 'BEST SERVER EU', 1381943155, '1377907410', 0, 0, 1000, 'Poland', '88.156.7.200', 7171, 7.1, 'BEST SERVER IN WHOLE OF EUROPE!\r\nplease come..', 42, 0, 0, 0, 'PVP', 415, 0.0102831, 0, 177, '', '0.3.6', '0', 1, 'Custom', 1377908424, 1),
(704, 46, 'Cinara', 1381943155, '1377908336', 1, 150, 1000, 'Sweden', 'cinara.net', 7171, 8.6, 'The server has launched Monday 17th June @ 18:00 CET!\r\n- Connection Info -\r\n\r\nIP: Cinara.net\r\nClient: 8.60, Custom client downloadable on website (Downloads)\r\n\r\n- Rates -\r\n\r\nExperience Stages:\r\n1 - 99 x450\r\n100 - 149 x250\r\n150 - 199 x150\r\n200 - 249 x75\r\n250 - 299 x35\r\n300 - 349 x22\r\n350 - 399 x12\r\n400 - 449 x5\r\n450 - 499 x2\r\n500 - 599 x1\r\n600 - 699 x0.5\r\n700 + x0.3\r\n\r\nMagic Rate: x25\r\nSkill Rate: x15\r\nLoot Rate: x3\r\n\r\n- PVP -\r\n\r\nRed Skull: 35 frags in 24 hours, lasts 1 day\r\nBlack Skull: 50 frags in 24 hours, lasts 2 days\r\nPZ lock: 60 seconds\r\nWhite skull: 6 minutes\r\nExperience gain from PvP: x1\r\n\r\n- Events -\r\n\r\nLast Man Standing\r\nCapture the Flag\r\nOpen battle arena\r\nEgg Event\r\nZombie Event!\r\n\r\n- Advance Rewards -\r\n\r\nLevel 100: 10 crystal coins\r\nLevel 150: 15 crystal coins\r\nLevel 200: 20 crystal coins', 300, 0, 0, 0, 'PVP', 3996956, 99.0616, 2080245, 205, 'NoName', '0.3.6', '0', 1, 'Custom', 1381943155, 1),
(706, 49, 'Cnserver 24h', 1381943155, '1377974232', 1, 4, 200, 'USA', 'cnserver.servegame.com', 7171, 9.6, 'Site: http://cnserver.servegame.com/\r\n\r\n~/~\r\nExp rate:(por estĂĄgios entre no site para mais detalhes)\r\nSkill rate: 25x\r\nMagic Level Rate: 20x\r\nLoot Rate: 3x\r\n~/~\r\n\r\n>Servidor dedicado 24 horas, Staff nĂŁo joga.\r\n\r\n>Mapa Alissow, com quest''s globais, e quest exclusivas.\r\n\r\n>Premium do ot, ĂŠ gratuita para acesso em todas as ĂĄreas.\r\n\r\n>Possui e Warzone, Drakens Towers, Yalahar City, e cidades exclusivas.\r\n\r\n>Runas Infinitas e moniĂ§Ăľes, potes nĂŁo, hits parecidos com a versĂŁo 7.6.\r\n\r\n>Sistema de Raids, diĂĄrios e automĂĄtico.\r\n\r\n>Montarias, exclusivas e Ăşnicas, e montarias normais.\r\n\r\n>War system 100%.\r\n\r\n>Mais de 200 houses, e mais de 300 lugares de huntes.\r\n\r\n>>NĂŁo perca tempo, ĂŠ facil upar e bom de jogar, para uma warzinha entĂŁo nĂŁo temo mais nem o que falar, venha faze muita war com seus amigos, vale a pena. Dedicated server 24 hours, Staff does not play.\r\n\r\n> Map Alissow with Quest''s comprehensive and unique quest.\r\n\r\n> Premium ot, is free to access all areas.\r\n\r\n> Features and Warzone, Drakens Towers, Thais City, and unique cities.\r\n\r\n> Runes Infinite and apposite, not pots, hits like version 7.6.\r\n\r\n> System Raids, and automatic daily.\r\n\r\n> Mounts, exclusive and unique, and normal mounts.\r\n\r\n> War system 100%.\r\n\r\n> More than 200 houses and more than 300 places Huntes.\r\n\r\n>> Do not waste time, leveling is easy and good to play for a warzinha then no longer fear nor to speak, will make a lot of war with your friends, it''s worth it. ', 400, 0, 0, 0, 'PVP', 3943942, 99.3706, 28858, 37, 'Cn Server', '2', '0', 1, 'Custom', 1381943155, 0),
(692, 38, 'Gunzodus 10.10', 1381943155, '1377863811', 1, 331, 1000, 'Sweden', 'gunzodus.net', 7171, 10.1, 'Hello, Welcome to Gunzodus!\r\n\r\nWebsite: www.gunzodus.net\r\n\r\nClient: http://www.gunzodus.net/?subtopic=downloadclient\r\n\r\nFeatures:\r\n- This server is based on 8.7 server.\r\n- You''ll get all mounts on your first login\r\n- RL Tibia war system\r\n- New unique quests to survive\r\n- 0% Loss till level 100\r\n\r\nEvents:\r\n- Last Man Standing\r\n- Zombie Event\r\n- Rush Event (Blue vs Red team PvP)\r\n- Football event\r\n\r\nMap Information:\r\n- RL Tibia map customized\r\n- Full Zao with full Razachai\r\n- DHQ, POI, Demon Oak, Annihi, Azerus and a lot of quests working\r\n- Custom islands: Oken, Gengia, Pyre, Ethno + VIP Island\r\n\r\nUsefull commands:\r\n!bless - buy all blessings for 50k\r\n!pvpinfo - show information about frags & skulls\r\n\r\nServer Information:\r\nCPU: Intel Core i5-2300 2.80GHz\r\nRAM: 16GB DDR3\r\nConnection: 100Mbps\r\nUptime: 99,9%\r\n\r\nExp stages:\r\n20 - 50 level = 300x\r\n51 - 80 level = 200x\r\n81 - 100 level = 150x\r\n100 - 120 level = 70x\r\n121 - 150 level = 50x\r\n151 - 180 level = 25x\r\n181 - 200 level = 15x\r\n201 - 220 level = 12x\r\n221 - 250 level = 8x\r\n251 - 270 level = 5x\r\n271 - 300 level = 3x\r\n301 - all = 2x\r\n\r\nJoin us as soon as possible!\r\nYours,\r\nGunzOT Team', 200, 0, 0, 0, 'PVP', 3928875, 96.3114, 82558, 781, 'GunzOT Team', '0.3.7_SVN', '0', 1, 'Edited Real Map', 1381943155, 1),
(710, 52, 'RoXoR 8.60', 1381943156, '1378418919', 0, 0, 2000, 'Sweden', 'roxor.zapto.org', 7171, 8.6, 'Server Information:-\r\nIP: Roxor.zapto.org\r\nMap: Edited Roxor map 8.6\r\nClient: 8.60\r\nPort: 7171\r\nOnline 24/7\r\nUptime 99.9%\r\n\r\nRates:-\r\nExp: Stages\r\nSkill rate: x80\r\nMagic Rate: x40\r\nLoot Rate: x3\r\n\r\nPVP System:-\r\nProtection level: 80\r\nWhite Skull Time: 1 minute\r\nBalanced Vocations!\r\n\r\n*Free Donates in quests!\r\n\r\n\r\n\r\nENJOY YOUR STAY!', 999, 0, 0, 0, 'PVP', 735696, 20.8753, 0, 7, 'Roxor Team', '0.3.6', '0', 1, 'Custom', 1380057658, 1),
(711, 53, 'Adictive 24H', 1381943166, '1378418928', 0, 0, 200, 'Sweden', 'adictive.sytes.net', 7171, 8.6, 'Hello, I want to announce the Opening of adictiveot.sytes.net, we are using a full costumized Armonia map, completly revamped.\r\nThe ot is rpg, no tlprts.\r\nThe server is based on the gamestyle of the old Armonia, in which there aren''t teleports, but you dont have to actually work a lot to go to places, I puted everything together so it''s not hard to get into places.\r\nProtocol: 8.6\r\nPort: 7171\r\nWebsite: adictiveot.sytes.net\r\nUptime: 24h\r\nMap: Armonia Revamped by Vctr\r\nLoot Rate: 2,5\r\nRunes: Normal charges & prices.\r\nServer Type: Pvp-Rpg. 3 kills gives you Red skull and 6 lends you to a ban.\r\nSkills & Magic rates: 15x Skill and 35x Magic.\r\nExp: Stages ( starting from 250x to 100x).\r\nCostumized monsters.\r\nCostumized equipment.\r\nCostumized weapons.\r\nLots of Hunt Zons.\r\nLots of Quests. (Rl quest added, and custom quests.\r\nUnique cities: For the BETA we opened only 3 cities from the 7 avaliable: Armonia, principal city. Ignis, fire city. Virdis, plants city.\r\nAddons: Like Tibia Rl.\r\nVip Sytem/Vip Shop.\r\nJust 1 new spell, to make vocations more balanced: Exevo Gran Mas Mort, for sorc & druid.\r\nRPG ot, no teleports.\r\nImages:\r\nhttp://prntscr.com/1nq2v1\r\nhttp://prntscr.com/1nz4wm\r\nhttp://prntscr.com/1nz5le\r\nhttp://prntscr.com/1nz725\r\nhttp://prntscr.com/1nz7mf\r\nTHE SERVER IS ONLINE.', 175, 0, 0, 0, 'PVP', 2809853, 79.7294, 0, 63, 'Suimt', '2', '0', 1, 'Other', 1381356656, 1),
(712, 54, 'RL Free Mount 9.10', 1381943176, '1378424294', 0, 0, 1000, 'Mexico', 'mythot.no-ip.org', 7171, 10.1, 'Welcome to MythOT\r\n\r\nYou''ll recieve a FREE mount when you login in.\r\n\r\nConnection:\r\nIP: MythOT.no-ip.org\r\nPort: 7171\r\nClient: 10.10\r\nDownloads: Version 10.10 and download OtLand''s Ip Changer\r\n\r\nFeatures:\r\n*Customized Thais city.\r\n*Full WarZones\r\n*RL Map FULL 10.10 + few custom cities.\r\n*Balanced vocations.\r\n*We''re looking for staff.\r\n*Donation System.\r\n*Offline Training System 100% working.\r\n*Mounts like RL.\r\n*Own mounts.\r\n\r\nRewards x Level\r\nLevel 45 - 5 crystal coins + slingshot to try to tame a bear.\r\nLevel 100 - 10 crystal coins + reins to try to tame a black sheep.\r\nLevel 150 - Lady Bug mount + 15 crystal coins.\r\nLevel 200 - Fire Horse mount + 20 crystal coins.\r\nLevel 250 - Red Manta + 30 crystal coins.\r\nLevel 300 - 10 premium shop points.', 240, 0, 0, 0, 'PVP', 1015291, 28.8526, 0, 78, 'Sid', '2', '0', 1, 'Edited Real Map', 1379454939, 1),
(713, 55, 'TibiaEmperium Global', 1381943177, '1378483631', 1, 94, 1000, 'Brazil', 'www.tibiaemperium.com', 7171, 8.6, '\r\nâ IP: www.tibiaemperium.com\r\nâ Port: 7171\r\nâ VersĂŁo: 8.60\r\nâ Uptime: 24/7\r\nâ Tipo: Open PVP\r\n\r\nSistema VIP:\r\nâ +30% de experiĂŞncia extra\r\nâ Sistema de treino offline 100%\r\nâ Ilhas Vips Exclusivas com respaw full\r\nâ Logar sem fila e muito mais...\r\n\r\nSistemas:\r\nâ Achievements\r\nâ Gateway Channel\r\nâ ''kick'' nos barcos para prevenis traps\r\nâ ProteĂ§ĂŁo para level 8-\r\nâ Raids\r\nâ Tasks 100%\r\nâ Twist of Fate (PVP Bless LeveL 50-)\r\nâ War System com emblemas\r\n\r\nEventos a ser definidos:\r\nâ Bloodshed Castle\r\nâ Infected Area \r\nâ Capture The Flag\r\nâ War of Emperium\r\nâ Defense of the Ancients\r\nâ Lightbearer\r\n\r\nRaid events:\r\nâ April''s Fools Day\r\nâ Christmas\r\nâ Cooking Event\r\nâ Flower Month\r\nâ Halloween\r\nâ Lightbearer\r\nâ New Year''s Season\r\nâ Rise of Devovorga\r\nâ Valentine''s Day and Masquerade Day\r\n\r\nQuests:\r\nâ Demon Helmet\r\nâ Bigfoots Burden''s Quest\r\nâ Quirefang Quest\r\nâ Unnatural Selection\r\nâ Crystal Warlord Outfit Quest\r\nâ Soil Guardian Outfit Quest\r\nâ Demon Outfit Quest\r\nâ Wizard Outfit Quest\r\nâ ZAO Quest\r\nâ Dreamer''s Challenge\r\nâ Firewalker Boots\r\nâ In Service of Yalahar\r\nâ Koshei the Deathless\r\nâ Pits of Inferno\r\nâ Svargrond Arena\r\nâ The Ancient Tombs\r\nâ The Annihilator\r\nâ The Ice Islands\r\nâ The Inquisition\r\nâ The Demon Oak - Task 6666 Demons\r\nâ The Elemental Spheres\r\nâ The New Frontier\r\nâ The Queen of the Banshees\r\nâ The Postman Missions\r\nâ The Spirit Will Get You\r\nâ Tomes of Knowledge\r\nâ Vampire Hunter\r\nâ Wrath of the Emperor\r\nâ The Pits of Inferno Quest\r\nâ The Inquisition Quest', 500, 0, 0, 0, 'PVP', 1216801, 35.1723, 32688, 289, 'TibiaEmperium', '2', '0', 1, 'Real Map', 1381943177, 1),
(714, 58, 'SweSpel 8.60', 1381943187, '1378835817', 0, 0, 1000, 'Sweden', 'swespel.se', 7171, 8.6, '\r\nEvoCustom Map | 8.6 | Server hosted in Sweden!\r\n[Image: QD6iuRJ.png]\r\nUnlimited Ammo/Runes.\r\nMana Rune.\r\nTraining Room.\r\nTeleport Room.\r\nQuest Room.\r\nCustom Item''s.\r\nCustom Monster''s.\r\nCustom Spell''s.\r\nZombie Event!.\r\nWar Arena.\r\nAuto Raid System.\r\nSlot Machine.\r\nAuto House Cleaner\r\n\r\nGMs\r\nGm''s cant give items\r\nGm''s cant give level/skills\r\n\r\n\r\nConnect:\r\n\r\nIP - SweSpel.se\r\nPORT - 7171\r\n\r\nCLIENT - 8.60\r\n\r\nWEBSITE - www.swespel.se\r\n\r\nRates:\r\n\r\nLoot Rate - 3\r\n\r\nMagic Rate - 30\r\n\r\nSkills Rate - 60\r\n\r\nXp Stage:\r\n\r\n1 - 50 = 1200\r\n51 - 100 = 700\r\n101 - 150 = 600\r\n151 - 200 = 300\r\n201 - 250 = 200\r\n251 - 300 = 100\r\n301 - 350 = 45\r\n351 - 400 = 22\r\n401 - 451 = 16\r\n451 - 500 = 12\r\n500 - 551 = 7\r\n551 - 9999 = 3\r\n\r\nMore info comeing soon...\r\nJoin us today!!', 555, 0, 0, 0, 'PVP-E', 192792, 6.20434, 0, 7, '', '0.3.6 V5 - Edit', '0', 1, 'Edited Evolution', 1379094048, 1),
(715, 59, 'Rl Map Ots', 1381943187, '1378843717', 1, 176, 1500, 'Poland', 'dinera.net', 7171, 8.6, 'Server Informations:\r\nDinera OTS\r\n\r\nTibia 8.60\r\n\r\nport 7171\r\n\r\nip dinera.net\r\n\r\nExp Stages\r\n\r\n1-40: x 400\r\n\r\n40-60: x 300\r\n\r\n60-80: x 150\r\n\r\n80-100: x 80\r\n\r\n100-120: x 60\r\n\r\n120-140: x 30\r\n\r\n140-160: x 10\r\n\r\n160-180: x 5\r\n\r\n180-200: x 3\r\n\r\n200 +: x 1.5\r\n\r\nSkills: x 30\r\n\r\nMagic Level: x 5\r\n\r\nLoot: x 3\r\n\r\nHouses: 150 lvl +\r\n\r\nProtection level: 100 lvl +\r\n\r\nPZ Lock: 60 seconds\r\n\r\nWhite Skull Time: 5 minutes\r\n\r\nod 50 lvla co kazde nastepne 50 lvli otrzymasz okreslona ilosc crystal coins!\r\n\r\nod 180 lvla co kazde nastepne 20 lvli otrzymasz 30 premium points do sms shopu!\r\n\r\n10 pierwszych osob z lvlem 100 otrzyma 300 premium points do sms shopu i tak co kazde nastepne 100 lvli!\r\n\r\nFrags & Skull system:\r\n\r\n* Red skull length: 1 day\r\n\r\no You will get red skull if you gain:\r\n\r\n+ 25 unjustified kills per a day\r\n\r\n+ 175 unjustified kills per a week\r\n\r\n+ 700 unjustified kills per a month\r\n\r\n* Black skull length: 2 days\r\n\r\no You will get black skull if you gain:\r\n\r\n+ 30 unjustified kills per a day\r\n\r\n+ 210 unjustified kills per a week\r\n\r\n+ 840 unjustified kills per a month\r\n\r\nKomendy:\r\n\r\n!promotion = zakup promocji\r\n\r\n!buyhouse = kupowanie domku\r\n\r\nalana grav nick postaci = sprzedawanie domku\r\n\r\nalana sio = ucieczka z domku\r\n\r\n!leavehouse = pozbycie sie domku\r\n\r\n!go = zmiana outfitu wszystkim w gildii\r\n\r\n!all "tekst" = wiadomosc do wszystkich z gildii\r\n\r\n!uptime = ile czasu server jest online\r\n\r\n!frags = ile masz fragow\r\n\r\n!spells = sprawdza twoje czary\r\n\r\n!soft = ladowanie soft boots\r\n\r\n!fire = ladowanie firewalker boots\r\n\r\n!serverinfo = informacja na temat servera\r\n\r\n!bless = zakup wszystkich blessow koszt 2 crystal coins\r\n\r\n!bless on = automatyczny zakup wszystkich blessow koszt 2 crystal coins\r\n\r\n!aol = zakup amulet of loss koszt 1 crystal coins\r\n\r\n!aol on = automatyczny zakup amulet of loss koszt 1 crystal coins\r\n\r\n!rs = usuniecie red skulla koszt 30 points\r\n\r\n!bs = usuniecie black skulla koszt 60 points\r\n\r\n!backpack = zakup backpacka koszt 20 gold coins\r\n\r\n!rope = zakup rope koszt 50 gold coins\r\n\r\n!shovel = zakup shovel koszt 50 gold coins\r\n\r\n!pick = zakup pick koszt 50 gold coins\r\n\r\n!scythe = zakup scythe koszt 50 gold coins\r\n\r\n!machete = zakup machete koszt 35 gold coins\r\n\r\n!fishing = zakup fishing rod koszt 150 gold coins\r\n\r\n!save = zapis postaci mozna uzywac raz na 10 minut', 400, 0, 0, 0, 'PVP', 3058812, 98.6882, 75286, 1955, '', '0.4_SVN', '0', 1, 'Edited Real Map', 1381943187, 0),
(716, 59, 'RL MAP Guild Points', 1381943187, '1378843783', 1, 360, 1500, 'Poland', 'openka.net', 7171, 8.6, 'Server Informations:\r\nOpenka OTS\r\n\r\nTibia 8.60\r\n\r\nport 7171\r\n\r\nip openka.net\r\n\r\nExp Stages\r\n\r\n1-40: x 400\r\n\r\n40-60: x 300\r\n\r\n60-80: x 150\r\n\r\n80-100: x 80\r\n\r\n100-120: x 60\r\n\r\n120-140: x 30\r\n\r\n140-160: x 10\r\n\r\n160-180: x 5\r\n\r\n180-200: x 3\r\n\r\n200 +: x 1.5\r\n\r\nSkills: x 30\r\n\r\nMagic Level: x 10\r\n\r\nLoot: x 3\r\n\r\nHouses: 150 lvl +\r\n\r\nProtection level: 100 lvl +\r\n\r\nPZ Lock: 60 seconds\r\n\r\nWhite Skull Time: 5 minutes\r\n\r\nod 50 lvla co kazde nastepne 50 lvli otrzymasz okreslona ilosc crystal coins!\r\n\r\nod 180 lvla co kazde nastepne 20 lvli otrzymasz 30 premium points do sms shopu!\r\n\r\n20 pierwszych osob z lvlem 100 otrzyma 300 premium points do sms shopu i tak co kazde nastepne 100 lvli!\r\n\r\nFrags & Skull system:\r\n\r\n* Red skull length: 1 day\r\n\r\no You will get red skull if you gain:\r\n\r\n+ 25 unjustified kills per a day\r\n\r\n+ 175 unjustified kills per a week\r\n\r\n+ 700 unjustified kills per a month\r\n\r\n* Black skull length: 2 days\r\n\r\no You will get black skull if you gain:\r\n\r\n+ 30 unjustified kills per a day\r\n\r\n+ 210 unjustified kills per a week\r\n\r\n+ 840 unjustified kills per a month\r\n\r\nKomendy:\r\n\r\n!promotion = zakup promocji\r\n\r\n!buyhouse = kupowanie domku\r\n\r\nalana grav nick postaci = sprzedawanie domku\r\n\r\nalana sio = ucieczka z domku\r\n\r\n!leavehouse = pozbycie sie domku\r\n\r\n!go = zmiana outfitu wszystkim w gildii\r\n\r\n!all "tekst" = wiadomosc do wszystkich z gildii\r\n\r\n!uptime = ile czasu server jest online\r\n\r\n!frags = ile masz fragow\r\n\r\n!spells = sprawdza twoje czary\r\n\r\n!soft = ladowanie soft boots\r\n\r\n!fire = ladowanie firewalker boots\r\n\r\n!serverinfo = informacja na temat servera\r\n\r\n!bless = zakup wszystkich blessow koszt 2 crystal coins\r\n\r\n!bless on = automatyczny zakup wszystkich blessow koszt 2 crystal coins\r\n\r\n!aol = zakup amulet of loss koszt 1 crystal coins\r\n\r\n!aol on = automatyczny zakup amulet of loss koszt 1 crystal coins\r\n\r\n!rs = usuniecie red skulla koszt 30 points\r\n\r\n!bs = usuniecie black skulla koszt 60 points\r\n\r\n!backpack = zakup backpacka koszt 20 gold coins\r\n\r\n!rope = zakup rope koszt 50 gold coins\r\n\r\n!shovel = zakup shovel koszt 50 gold coins\r\n\r\n!pick = zakup pick koszt 50 gold coins\r\n\r\n!scythe = zakup scythe koszt 50 gold coins\r\n\r\n!machete = zakup machete koszt 35 gold coins\r\n\r\n!fishing = zakup fishing rod koszt 150 gold coins\r\n\r\n!save = zapis postaci mozna uzywac raz na 10 minut', 400, 0, 0, 0, 'PVP', 2757832, 88.9794, 75336, 1068, '', '0.4_SVN', '0', 1, 'Edited Real Map', 1381943187, 0),
(717, 59, 'Best Evo Ots', 1381943187, '1378843858', 1, 222, 1000, 'Poland', 'simsonots.eu', 7171, 8.6, 'Server Informations:\r\nSimson OTS\r\n\r\nTibia 8.60\r\n\r\nport 7171\r\n\r\nip simsonots.eu\r\n\r\nExp Stages\r\n\r\n1-50: x 400\r\n\r\n50-100: x 300\r\n\r\n100-150: x 200\r\n\r\n150-200: x 150\r\n\r\n200-250: x 100\r\n\r\n250-300: x 80\r\n\r\n300-350: x 40\r\n\r\n350-400: x 20\r\n\r\n400 +: x 6\r\n\r\nSkills: x 30\r\n\r\nMagic Level: x 10\r\n\r\nLoot: x 2\r\n\r\nHouses: 500 lvl +\r\n\r\nProtection level: 150 lvl +\r\n\r\nPZ Lock: 60 seconds\r\n\r\nWhite Skull Time: 5 minutes\r\n\r\nod 50 lvla co kazde nastepne 50 lvli otrzymasz okreslona ilosc crystal coins!\r\n\r\nFrags & Skull system:\r\n\r\n* Red skull length: 1 day\r\n\r\no You will get red skull if you gain:\r\n\r\n+ 12 unjustified kills per a day\r\n\r\n+ 84 unjustified kills per a week\r\n\r\n+ 336 unjustified kills per a month\r\n\r\n* Black skull length: 2 days\r\n\r\no You will get black skull if you gain:\r\n\r\n+ 15 unjustified kills per a day\r\n\r\n+ 105 unjustified kills per a week\r\n\r\n+ 420 unjustified kills per a month\r\n\r\nKomendy:\r\n\r\n!go = zmiana outfitu wszystkim w gildii\r\n\r\n!all "tekst" = wiadomosc do wszystkich z gildii\r\n\r\n!uptime = ile czasu server jest online\r\n\r\n!frags = ile masz fragow\r\n\r\n!spells = sprawdza twoje czary\r\n\r\n!soft = ladowanie soft boots\r\n\r\n!fire = ladowanie firewalker boots\r\n\r\n!helmet = ladowanie helmet of the ancients\r\n\r\n!boots = ladowanie donator boots\r\n\r\n!shield = ladowanie donator shield\r\n\r\n!buyhouse = kupowanie domku\r\n\r\nalana sio = ucieczka z domku\r\n\r\n!leavehouse = pozbycie sie domku\r\n\r\nalana grav nick postaci = sprzedawanie domku\r\n\r\n!serverinfo = informacja na temat servera\r\n\r\n!bless = zakup wszystkich blessow koszt 10 crystal coins\r\n\r\n!bless on = automatyczny zakup wszystkich blessow koszt 10 crystal coins\r\n\r\n!aol = zakup amulet of loss koszt 5 crystal coins\r\n\r\n!aol on = automatyczny zakup amulet of loss koszt 5 crystal coins\r\n\r\n!rs = usuniecie red skulla koszt 10 points\r\n\r\n!bs = usuniecie black skulla koszt 20 points\r\n\r\n!backpack = zakup backpacka koszt 20 gold coins\r\n\r\n!rope = zakup rope koszt 50 gold coins\r\n\r\n!shovel = zakup shovel koszt 50 gold coins\r\n\r\n!pick = zakup pick koszt 50 gold coins\r\n\r\n!scythe = zakup scythe koszt 50 gold coins\r\n\r\n!machete = zakup machete koszt 35 gold coins\r\n\r\n!fishing = zakup fishing rod koszt 150 gold coins\r\n\r\n!save = zapis postaci mozna uzywac raz na 10 minut', 400, 0, 0, 0, 'PVP', 3065698, 98.9149, 75263, 608, '', '0.4_SVN', '0', 1, 'Edited Evolution', 1381943187, 1),
(718, 59, 'New Evo Server Ots', 1381943187, '1378843985', 1, 121, 1000, 'Poland', 'axera.pl', 7171, 7.1, '\r\nWersja klienta 8.60\r\n	\r\n\r\nPort: 7171\r\n	\r\n\r\nIP: Axera.pl\r\nEtapy zdobywania poziomĂłw:\r\n\r\n1-50: x 400\r\n\r\n51-75: x 300\r\n\r\n76-100: x 200\r\n\r\n101-150: x 150\r\n\r\n151-175: x 100\r\n\r\n176-190: x 75\r\n\r\n191-230: x 35\r\n\r\n231-250: x 20\r\n\r\n251-280: x 10\r\n\r\n281-300: x 5\r\n\r\n301 +: x 1.5\r\nOgĂłlne:\r\n\r\nSkills: x 30\r\n\r\nMagic Level: x 15\r\n\r\nLoot: x 3\r\n\r\nSpawn: x 3\r\n\r\nDomki: 300 lvl +\r\n\r\nPVP: 100 lvl +\r\n\r\nPZ Lock: 60 sekund\r\n\r\nWhite Skull Time: 5 minut\r\n\r\nco 50 lvli otrzymasz troche crystal coins!\r\nFragi & Skull system:\r\n\r\n* Czas trwania red skulla: 1 dzieĹ\r\n\r\nPostaÄ dostaje red skulla po wbiciu:\r\n\r\n+ 25 unjustified kills w ciÄgu 24 godzin\r\n\r\n+ 175 unjustified kills w ciÄgu tygodnia\r\n\r\n+ 700 unjustified kills w ciÄgu miesiÄca\r\n\r\n* Czas trwania black skulla: 2 dni\r\n\r\no PostaÄ dostaje black skulla po wbiciu:\r\n\r\n+ 30 unjustified kills w ciÄgu 24 godzin\r\n\r\n+ 210 unjustified kills w ciÄgu tygodnia\r\n\r\n+ 840 unjustified kills w ciÄgu miesiÄca\r\nKomendy:\r\n\r\n!promotion = zakup promocji\r\n\r\n!buyhouse = kupowanie domku\r\n\r\nalana grav nick postaci = sprzedawanie domku\r\n\r\nalana sio = ucieczka z domku\r\n\r\n!leavehouse = pozbycie siÄ domku\r\n\r\n!go = zmiana outfitu wszystkim graczom online w gildii\r\n\r\n!all "tekst" = wiadomosc do wszystkich z gildii\r\n\r\n!uptime = ile czasu serwer jest online\r\n\r\n!frags = ile masz fragĂłw\r\n\r\n!spells = sprawdza Twoje czary\r\n\r\n!soft = Ĺadowanie soft boots\r\n\r\n!fire = Ĺadowanie firewalker boots\r\n\r\n!rabbit = Ĺadowanie rabbit boots\r\n\r\n!serverinfo = informacja na temat serwera\r\n\r\n!bless = zakup wszystkich blessĂłw - koszt 5 crystal coins\r\n\r\n!bless on = automatyczny zakup wszystkich blessĂłw - koszt 5 crystal coins\r\n\r\n!aol = zakup amulet of loss koszt - 1 crystal coin\r\n\r\n!aol on = automatyczny zakup amulet of loss - koszt 1 crystal coin\r\n\r\n!rs = usuniÄcie red skulla - koszt 30 points\r\n\r\n!bs = usuniÄcie black skulla - koszt 60 points\r\n\r\n!backpack = zakup plecaka - koszt 20 gold coins\r\n\r\n!rope = zakup liny koszt - 50 gold coins\r\n\r\n!shovel = zakup Ĺopaty koszt - 50 gold coins\r\n\r\n!pick = zakup kilofa koszt - 50 gold coins\r\n\r\n!scythe = zakup scythe koszt 50 gold coins\r\n\r\n!machete = zakup maczety - koszt 35 gold coins\r\n\r\n!fishing = zakup wÄdki - koszt 150 gold coins\r\n\r\n!save = zapis postaci, komendy moĹźna uĹźyÄ raz na 10 minut\r\n', 400, 0, 0, 0, 'PVP', 2748591, 88.687, 34658, 497, 'God Axera', '0.4_SVN', '0', 1, 'Custom', 1381943187, 1),
(720, 62, 'ParadiseOt', 1381943187, '1379670169', 0, 0, 1000, 'Sweden', 'Exelia.hopto.org', 7171, 8.6, 'Its Really Cool', 999, 0, 0, 0, 'PVP', 1712, 0.0753183, 0, 1, 'Admin RoHaN', '0.4.1', '0', 1, 'Evolution', 1379846189, 1),
(721, 64, 'CustomPVE8.6 RealMap', 1381943188, '1379909839', 1, 1, 1000, 'Sweden', 'Skullcrusher.hopto.org', 7171, 8.6, 'SkullCrusher Server is a 8.60 Custom Real Map server with a lot of fun. The server has just started and we currently looking for Tutors and Gamemasters.\r\n\r\n[Server Info]\r\n- Exp Rate starts at 3000x\r\n- PVP-E\r\n- Loot Rate 3x.\r\n- Skill Rate 45x.\r\n- Magic Rate 30x.\r\n\r\n[Features]\r\nÂť Alot of Quests and infinity challenge\r\nÂť Full Custom 8.60 Reap-Map Server.\r\nÂť All Quests are working perfectly\r\nÂť Houses At all Cities are Working 100%.\r\nÂť Active Support Team in game.\r\nÂť Balanced Vocations.\r\nÂť Fair donations with cheap prices.\r\nÂť Custom Pyre, Oken, Gengia for highlevels\r\nÂť A lot of fun Mods\r\nÂť Added Message System\r\nÂť Auto Loot system\r\nÂť Loot Ring\r\nÂť Military Rank\r\nÂť Offline Message\r\nÂť Rank Hit\r\nÂť Points on Advanced Level \r\n\r\n\r\nWe are currently looking for -\r\nTutor\r\nGame Master\r\n\r\nPlease send your application to Skullcrusherserver@gmail.com\r\nName\r\nAge\r\nExperience\r\nCountry\r\n\r\nWe Hope You Enjoy a new fresh SkullCrusher Server And lets grow up together!\r\n\r\nBest Regard,\r\nSkullCrusher Team', 3000, 0, 0, 0, 'PVP-E', 2027045, 99.6899, 967255, 15, 'William', '0.3.6 - Edited ', '0', 1, 'Edited Real Map', 1381943188, 0),
(722, 51, 'Evolva', 1381943198, '1380057949', 0, 0, 1000, 'Spain', 'evolva.servegame.com', 7171, 8.6, 'Evolva is one of the oldest and most successful massively multiplayer online role-playing games (MMORPG) created in Europe. In an MMORPG people from all over the world meet on a virtual playground to explore areas, solve tricky riddles and undertake heroic exploits.\r\n\r\nActing as knights, paladins, sorcerers or druids, players are faced with the challenge of developing the skills of their selected characters, exploring a large variety of areas and dangerous dungeons and interacting with other players on a social and diplomatic level. Besides the sophisticated chat tools it is especially the unique freedom players enjoy in Evolva, that create an enormously immersive gaming experience.\r\n\r\nEvolva can be played free of charge as a matter of principle. However, you can make a donation and get points to spend in our shop.\r\n\r\nA great helper team consisting of tutors answers questions from unexperienced players in the help channel.', 999, 0, 0, 0, 'PVP', 293423, 15.5641, 0, 5, 'Don Daniello', '0.4_SVN', '0', 1, 'Custom', 1381267578, 1),
(723, 65, 'Tutors 9.83 25/09 st', 1381943198, '1380287645', 1, 2, 1000, 'Poland', 'tutorsot.com', 7171, 9.8, '~~ Tutors Server ~~ 9.83 ~~\r\n\r\nServer Informations\r\nPVP protection	to 100 level\r\nExp rate	1 - 50 level, 400x\r\n51 - 100 level, 250x\r\n101 - 150 level, 100x\r\n151 - 200 level, 70x\r\n201 - 250 level, 50x\r\n251 - 300 level, 30x\r\n301 - 350 level, 15x\r\n351 - 500 level, 7x\r\n501+ level, 2x\r\nSkill rate	30x\r\nMagic rate	15x\r\nLoot rate	2x\r\n\r\n\r\n\r\n24/7 Hosted!\r\n12 Cities!\r\nMany exp spawns and quests!\r\n\r\n\r\nOfficial website:\r\nwww.tutorsot.com\r\n\r\nIP: tutorsot.com\r\nPORT: 7171\r\n\r\nE n j o y !', 400, 0, 0, 0, 'PVP', 1594187, 96.2933, 165309, 30, 'Sikret', '0.3.7_SVN', '0', 1, 'Other', 1381943198, 1),
(724, 66, 'szof.pl', 1381943198, '1381167765', 1, 18, 310, 'Poland', 'szof.pl', 7171, 8.6, 'Zapraszamy!', 250, 0, 0, 0, 'PVP', 770666, 99.3851, 5868, 57, '', '2.0', '0', 1, 'Edited Evolution', 1381943198, 0),
(725, 66, 'ramira.pl', 1381943198, '1381167814', 1, 337, 625, 'Poland', 'ramira.pl', 7171, 8.6, 'Zapraszamy!', 999, 0, 0, 0, 'PVP', 770294, 99.3434, 491256, 354, '', '2.0', '0', 1, 'Edited Evolution', 1381943198, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `list_promote`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=30 ;

--
-- Dumpning av Data i tabell `list_promote`
--

INSERT INTO `list_promote` (`id`, `owner`, `server`, `type`, `start`, `end`, `info`) VALUES
(28, 43, 705, 1, 1378675064, 1381267064, ''),
(29, 43, 705, 1, 1381525040, 1384117040, '');

-- --------------------------------------------------------

--
-- Tabellstruktur `list_votes`
--

CREATE TABLE IF NOT EXISTS `list_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `server` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=41 ;

--
-- Dumpning av Data i tabell `list_votes`
--

INSERT INTO `list_votes` (`id`, `user`, `server`, `vote`) VALUES
(18, 21, 668, 1),
(20, 21, 673, 1),
(21, 24, 676, 1),
(22, 25, 677, 1),
(23, 31, 685, 1),
(24, 34, 673, 1),
(32, 45, 701, 2),
(34, 45, 703, 2),
(38, 49, 706, 1),
(39, 58, 714, 1),
(40, 65, 723, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
