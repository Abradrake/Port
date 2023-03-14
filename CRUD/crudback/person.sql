-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2020 at 04:15 PM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 7.2.17-1+ubuntu14.04.1+deb.sury.org+3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xx`
--

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `personid` int(11) NOT NULL AUTO_INCREMENT,
  `fnamn` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `enamn` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `postnummer` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `gatuadress` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `postadress` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `telefon` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `epost` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`personid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`personid`, `fnamn`, `enamn`, `postnummer`, `gatuadress`, `postadress`, `telefon`, `epost`) VALUES
(1, 'förnamn1', 'efternamn1', '12345', 'Gatan 1', 'Flemingsberg', '0701111111', 'testperson1@test.se'),
(2, 'förnamn2', 'efternamn2', '23456', 'Gatan 2', 'Sundbyberg', '0702222222', 'testperson2@test.se');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
