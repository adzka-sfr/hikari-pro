-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 07:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hikari`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` varchar(10) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenkel` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `pass`, `nama`, `jenkel`, `jabatan`, `dept`, `role`) VALUES
('11111', '1', 'Agus Suminto', 'Male', 'Manager', 'Assembly GP', 'managerial'),
('12345', 'guest1', 'Guest 1', 'Male', 'Guest', 'General', 'guest'),
('20104', '20104', 'Tulud Riyanto', 'Male', 'Manager', 'Assembly UP', 'managerial'),
('20211', '20211', 'Faizin', 'Male', 'Manager', 'Painting', 'managerial'),
('20577', '20577', 'Gatot Sapto W', 'Male', 'Leader', 'Assembly UP', 'pic'),
('20607', '20607', 'Agung Sumiaji', 'Male', 'Assistant Manager', 'ICTM', 'managerial'),
('20612', '20612', 'Rian Dwi O', 'Female', 'Staff', 'ICTM', 'managerial'),
('20621', '20621', 'Nana Suryana', 'Male', 'Staff', 'ICTM', 'managerial'),
('21884', '21884', 'Fajar Sahara E S', 'Male', 'Staff', 'ICTM', 'managerial'),
('22222', '2', 'Agus Triatmojo', 'Male', 'Karyawan Tetap', 'Assembly GP', 'pic'),
('24891', 'adzka', 'M Adzka SFR', 'Male', 'Staff', 'Assembly UP', 'managerial'),
('67890', 'guest2', 'Guest 2', 'Female', 'Guest', 'General', 'guest'),
('i1', 'i1', 'Daffa', 'male', 'operator', 'Assembly UP', 'pic in check'),
('in', 'in', 'Display In Check', '-', '-', 'Assembly UP', 'display_in'),
('m1', 'm1', 'Rudi Haryanto', 'male', 'Manager', 'Quality Assurance', 'management'),
('o1', 'o1', 'Vera', 'male', 'operator', 'Assembly UP', 'pic out check1'),
('o2', 'o2', 'Sambo', 'male', 'operator', 'Assembly UP', 'pic out check2'),
('o3', 'o3', 'John Cena', 'male', 'operator', 'Assembly UP', 'pic out check3'),
('out', 'out', 'Display Out Check', '-', '-', 'Assembly UP', 'display_out'),
('r1', 'r1', 'Solihin', 'male', 'operator', 'Assembly UP', 'repair in check'),
('r2', 'r2', 'Suparmin', 'male', 'operator', 'Assembly UP', 'repair out check');

-- --------------------------------------------------------

--
-- Table structure for table `t_app`
--

CREATE TABLE `t_app` (
  `c_id` int(50) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_dir` varchar(100) NOT NULL,
  `c_img` varchar(100) NOT NULL,
  `c_group` varchar(100) NOT NULL,
  `c_subgroup` varchar(100) NOT NULL,
  `c_status` varchar(50) NOT NULL,
  `c_manual` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_app`
--

INSERT INTO `t_app` (`c_id`, `c_name`, `c_dir`, `c_img`, `c_group`, `c_subgroup`, `c_status`, `c_manual`) VALUES
(1, 'Expense', 'expense', 'expense', 'managerial', '', 'deploy', ''),
(2, 'Agreement', 'agreement', 'agreement', 'managerial', '', 'deploy', ''),
(3, 'HRM', 'hrm', 'management', 'managerial', '', 'develop', ''),
(4, 'Compatibility Model', 'compatibility_model/d', 'compatibility_model', 'production', 'painting', 'deploy', 'coming_soon'),
(5, 'Display Assy', 'display_assy', 'display', 'production', 'assembly', 'deploy', ''),
(6, 'Phantom Result', 'phantom_result', 'scanner', 'production', '', 'develop', ''),
(7, 'SAP', '1a_sap', '1a_sap', 'managerial', '', 'deploy', ''),
(8, 'Ratio Set Assy GP', 'rsagp/d', 'bar_chart', 'production', 'assembly', 'deploy', ''),
(9, 'Ratio Set Assy UP', 'rsaup/d', 'bar_chart', 'production', 'assembly', 'deploy', ''),
(10, 'Form NG', 'form_ng/d', 'ratio_set_ww', 'production', 'assembly', 'deploy', 'coming_soon'),
(11, 'Lawsy', 'lawsy', 'lawsy', 'managerial', '', 'deploy', ''),
(20, 'Mezzanine', 'mezzanine/d', 'mezzanine', 'production', 'painting', 'deploy', 'coming_soon'),
(21, 'On Time Rate Assy', 'otr_assy/d', 'mezzanine', 'production', 'assembly', 'deploy', 'coming_soon'),
(22, 'On Time Rate', 'otr_main/d', 'mezzanine', 'production', '', 'deploy', 'coming_soon'),
(101, 'Full Template', 'full_template', 'setting', 'production', '', 'deploy', 'coming_soon'),
(102, 'Not Full Template', 'not_full_template', 'setting', 'production', '', 'deploy', 'coming_soon'),
(103, 'Employee Management', 'employee_management', 'employee_management', 'superuser', '', 'deploy', ''),
(104, 'Register User', 'register_user', 'add_user', 'superuser', '', 'deploy', ''),
(105, 'Register RFID', 'regrfid', 'rfid', 'superuser', '', 'deploy', ''),
(106, 'Log Activity', 'logactivity', 'log', 'superuser', '', 'deploy', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_employee`
--

CREATE TABLE `t_employee` (
  `c_id` varchar(10) NOT NULL,
  `c_name` varchar(200) NOT NULL,
  `c_status` varchar(200) NOT NULL,
  `c_position` varchar(200) NOT NULL,
  `c_division` varchar(200) NOT NULL,
  `c_department` varchar(200) NOT NULL,
  `c_part_of` varchar(200) NOT NULL,
  `c_section` varchar(200) NOT NULL,
  `c_join_date` date NOT NULL,
  `c_resign_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_previlege`
--

CREATE TABLE `t_previlege` (
  `num` int(11) NOT NULL,
  `c_id` varchar(100) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_dir` varchar(200) NOT NULL,
  `c_img` varchar(100) NOT NULL,
  `c_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_previlege`
--

INSERT INTO `t_previlege` (`num`, `c_id`, `c_name`, `c_dir`, `c_img`, `c_status`) VALUES
(1, '24891', 'Employee Management', 'superuser/empoyee_management', 'display', 'deploy'),
(2, '24891', 'Prioritas SB', 'production/rsaup/p', 'task', 'deploy'),
(3, '11111', 'Set Plan</br>Ratio Set Assy GP', 'production/rsagp/p', 'task', 'deploy'),
(4, '22222', 'Input Inventory</br>Ratio Set Assy GP', 'production/rsagp/p', 'task', 'deploy'),
(5, '20211', 'Prioritas SB', 'production/rsaup/p', 'task', 'develop'),
(6, '24891', 'Register User', 'superuser/register_user', 'add_user', 'deploy'),
(7, '24891', 'Form NG', 'production/form_ng/p', 'ratio_set_ww', 'deploy'),
(8, '24891', 'Compatibility Model', 'production/compatibility_model/p', 'compatibility_model', 'deploy'),
(9, '24891', 'Mezzanine', 'production/mezzanine/p', 'mezzanine', 'deploy'),
(10, '24891', 'Register RFID', 'superuser/regrfid', 'rfid', 'deploy'),
(11, '24891', 'On Time Rate', 'production/otr/p', 'mezzanine', 'deploy'),
(12, 'out', 'Display Out Check', 'production/form_ng/d', 'display', 'deploy'),
(13, 'in', 'Display In Check', 'production/form_ng/d', 'display', 'deploy'),
(14, 'i1', 'Inside Check', 'production/form_ng/p/index/ng1', 'display', 'deploy'),
(15, 'r1', 'Repair Inside', 'production/form_ng/p/index/ng1a', 'display', 'deploy'),
(16, 'o1', 'Out Side Check 1', 'production/form_ng/p/index/ng2', 'display', 'deploy'),
(17, 'o2', 'Out Side Check 2', 'production/form_ng/p/index/ng3', 'display', 'deploy'),
(18, 'r2', 'Repair Outside', 'production/form_ng/p/index/ng2a', 'display', 'deploy'),
(19, '20612', 'Meals Coupon', 'managerial/meals_coupon/coupon', 'meal', 'deploy'),
(20, '20612', 'Meals Coupon Report', 'managerial/meals_coupon/report', 'meal_report', 'deploy'),
(21, 'o3', 'Out Side Check 3', 'production/form_ng/p/index/ng4', 'display', 'deploy'),
(22, 'm1', 'Final Check Report', 'production/form_ng/p/index/report', 'display', 'deploy'),
(23, '24891', 'Log Activity', 'superuser/logactivity', 'log', 'deploy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_app`
--
ALTER TABLE `t_app`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `t_employee`
--
ALTER TABLE `t_employee`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `t_previlege`
--
ALTER TABLE `t_previlege`
  ADD PRIMARY KEY (`num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_previlege`
--
ALTER TABLE `t_previlege`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
