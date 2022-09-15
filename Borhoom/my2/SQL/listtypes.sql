-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2019 at 10:55 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `childcare2`
--

-- --------------------------------------------------------

--
-- Table structure for table `listtypes`
--

DROP TABLE IF EXISTS `listtypes`;
CREATE TABLE IF NOT EXISTS `listtypes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code2` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listtypes`
--

INSERT INTO `listtypes` (`ID`, `Code2`, `Title`) VALUES
(1, '1', 'Governate'),
(2, '2', 'District'),
(3, '3', 'RelativeType'),
(4, '4', 'ServicecCategory'),
(5, '5', 'UserPriviledge'),
(6, '6', 'PriodType'),
(7, '7', 'UnitType'),
(8, '8', 'CaseType'),
(9, '9', 'CaseTypeChoices'),
(10, '10', 'CaseDecision'),
(11, '11', 'CaseTypeChoice'),
(12, '12', 'UserType'),
(13, '13', 'ServiceState'),
(14, '14', 'Rate'),
(15, '15', 'LivingStatus'),
(16, '16', 'VictimStatus'),
(17, '17', 'CurrentProblem'),
(18, NULL, 'Behavior Category'),
(19, '', 'Behavior '),
(20, NULL, 'PositionType');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
