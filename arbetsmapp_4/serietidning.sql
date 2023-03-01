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
-- Table structure for table `serie`
--

CREATE TABLE IF NOT EXISTS `serietidning` (
  `serieid` int(11) NOT NULL AUTO_INCREMENT,
  `Titel` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `Manus` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `Teckning` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`serieid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `person`
--

INSERT INTO `serietidning` (`serieid`, `Titel`, `Manus`, `Teckning`) VALUES
(1, 'Spider-Man', 'Stan Lee', 'Steve Ditko'),
(2, 'Watchmen', 'Alan Moore', 'Dave Gibbons');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
