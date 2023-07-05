-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2019 at 12:23 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `k_staff`
--

-- --------------------------------------------------------

--
-- Table structure for table `plan_display_assy`
--

CREATE TABLE IF NOT EXISTS `plan_display_assy` (
  `plan_dt` date NOT NULL,
  `U2` int(11) NOT NULL,
  `U3` int(11) NOT NULL,
  `U4` int(11) NOT NULL,
  `U5` int(11) NOT NULL,
  `U7` int(11) NOT NULL,
  `B5` int(11) NOT NULL,
  `B4` int(11) NOT NULL,
  `G0` int(11) NOT NULL,
  `G1` int(11) NOT NULL,
  `G2` int(11) NOT NULL,
  `G3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan_display_assy`
--

INSERT INTO `plan_display_assy` (`plan_dt`, `U2`, `U3`, `U4`, `U5`, `U7`, `B5`, `B4`, `G0`, `G1`, `G2`, `G3`) VALUES
('2019-07-19', 125, 125, 125, 125, 125, 125, 125, 25, 25, 25, 25),
('2019-07-20', 100, 100, 100, 100, 100, 100, 100, 20, 20, 0, 0),
('2019-07-21', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('2019-07-22', 131, 131, 131, 131, 131, 131, 131, 26, 26, 26, 26),
('2019-07-23', 131, 131, 131, 131, 131, 131, 131, 26, 26, 26, 26),
('2019-07-24', 131, 131, 131, 131, 131, 131, 131, 20, 20, 20, 20),
('2019-07-25', 131, 131, 131, 131, 131, 131, 131, 26, 26, 26, 26),
('2019-07-26', 125, 125, 125, 125, 125, 125, 125, 25, 25, 25, 25),
('2019-07-27', 100, 100, 100, 100, 100, 100, 100, 20, 20, 0, 0),
('2019-07-28', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('2019-07-29', 131, 131, 131, 131, 131, 131, 131, 26, 26, 26, 26),
('2019-07-30', 131, 131, 131, 131, 131, 131, 131, 20, 20, 20, 20),
('2019-07-31', 83, 83, 83, 83, 83, 83, 83, 16, 16, 16, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plan_display_assy`
--
ALTER TABLE `plan_display_assy`
 ADD PRIMARY KEY (`plan_dt`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
