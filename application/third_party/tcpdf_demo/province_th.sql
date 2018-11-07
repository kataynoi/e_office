-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2017 at 08:11 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `province_th`
--

CREATE TABLE `province_th` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(200) NOT NULL DEFAULT '',
  `province_part` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

--
-- Dumping data for table `province_th`
--

INSERT INTO `province_th` (`province_id`, `province_name`, `province_part`) VALUES
(1, 'กระบี่', 0),
(2, 'กรุงเทพมหานคร', 0),
(3, 'กาญจนบุรี', 0),
(4, 'กาฬสินธุ์', 0),
(5, 'กำแพงเพชร', 0),
(6, 'ขอนแก่น', 0),
(7, 'จันทบุรี', 0),
(8, 'ฉะเชิงเทรา', 0),
(9, 'ชลบุรี', 0),
(10, 'ชัยนาท', 0),
(11, 'ชัยภูมิ', 0),
(12, 'ชุมพร', 0),
(13, 'เชียงราย', 0),
(14, 'เชียงใหม่', 0),
(15, 'ตรัง', 0),
(16, 'ตราด', 0),
(17, 'ตาก', 0),
(18, 'นครนายก', 0),
(19, 'นครปฐม', 0),
(20, 'นครพนม', 0),
(21, 'นครราชสีมา', 0),
(22, 'นครศรีธรรมราช', 0),
(23, 'นครสวรรค์', 0),
(24, 'นนทบุรี', 0),
(25, 'นราธิวาส', 0),
(26, 'น่าน', 0),
(27, 'บุรีรัมย์', 0),
(28, 'ปทุมธานี', 0),
(29, 'ประจวบคีรีขันธ์', 0),
(30, 'ปราจีนบุรี', 0),
(31, 'ปัตตานี', 0),
(32, 'พระนครศรีอยุธยา', 0),
(33, 'พะเยา', 0),
(34, 'พังงา', 0),
(35, 'พัทลุง', 0),
(36, 'พิจิตร', 0),
(37, 'พิษณุโลก', 0),
(38, 'เพชรบุรี', 0),
(39, ' เพชรบูรณ์', 0),
(40, 'แพร่', 0),
(41, 'ภูเก็ต', 0),
(42, 'มหาสารคาม', 0),
(43, 'มุกดาหาร', 0),
(44, 'แม่ฮ่องสอน', 0),
(45, 'ยโสธร', 0),
(46, 'ยะลา', 0),
(47, 'ร้อยเอ็ด', 0),
(48, 'ระนอง', 0),
(49, 'ระยอง', 0),
(50, 'ราชบุรี', 0),
(51, 'ลพบุรี', 0),
(52, 'ลำปาง', 0),
(53, 'ลำพูน', 0),
(54, 'เลย', 0),
(55, 'ศรีสะเกษ', 0),
(56, 'สกลนคร', 0),
(57, 'สงขลา', 0),
(58, 'สตูล', 0),
(59, 'สมุทรปราการ', 0),
(60, 'สมุทรสงคราม', 0),
(61, 'สมุทรสาคร', 0),
(62, 'สระแก้ว', 0),
(63, 'สระบุรี', 0),
(64, 'สิงห์บุรี', 0),
(65, 'สุโขทัย', 0),
(66, 'สุพรรณบุรี', 0),
(67, 'สุราษฎร์ธานี', 0),
(68, 'สุรินทร์', 0),
(69, 'หนองคาย', 0),
(70, 'หนองบัวลำภู', 0),
(71, 'อ่างทอง', 0),
(72, 'อำนาจเจริญ', 0),
(73, 'อุดรธานี', 0),
(74, 'อุตรดิตถ์', 0),
(75, 'อุทัยธานี', 0),
(76, 'อุบลราชธานี', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `province_th`
--
ALTER TABLE `province_th`
  ADD PRIMARY KEY (`province_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `province_th`
--
ALTER TABLE `province_th`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
