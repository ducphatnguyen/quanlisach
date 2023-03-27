-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 30, 2022 at 03:10 AM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql_sach`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `chinhsuadocgia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chinhsuadocgia` (IN `tendg` VARCHAR(40) CHARSET utf8, IN `ngaysinh` DATE, IN `diachi` VARCHAR(255), IN `id1` INT(11))  UPDATE docgia SET tendg=tendg, ngaysinh=ngaysinh, diachi=diachi WHERE id=id1$$

DROP PROCEDURE IF EXISTS `chinhsuamuontra`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chinhsuamuontra` (IN `id_sach` INT(11), IN `id_dg` INT(11), IN `ngaymuon` DATE, IN `ngaytra` DATE, IN `tinhtrang` VARCHAR(40) CHARSET utf8, IN `id1` INT(10))  UPDATE muontra SET id_sach=id_sach, id_dg=id_dg, ngaymuon=ngaymuon, ngaytra=ngaytra, tinhtrang=tinhtrang WHERE id=id1$$

DROP PROCEDURE IF EXISTS `chinhsuasach`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chinhsuasach` (IN `tensach` VARCHAR(100) CHARSET utf8, IN `tentg` VARCHAR(100) CHARSET utf8, IN `nhaxuatban` VARCHAR(100) CHARSET utf8, IN `ngayxb` DATE, IN `sotrang` INT(11), IN `tomtat` VARCHAR(255) CHARSET utf8, IN `id1` INT(11))  UPDATE sach SET tensach=tensach, tentg=tentg, nhaxuatban=nhaxuatban, ngayxb=ngayxb, sotrang=sotrang, tomtat=tomtat WHERE id=id1$$

DROP PROCEDURE IF EXISTS `hienthidocgia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `hienthidocgia` ()  SELECT * FROM docgia$$

DROP PROCEDURE IF EXISTS `hienthisach`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `hienthisach` ()  SELECT * FROM sach$$

DROP PROCEDURE IF EXISTS `themdocgia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `themdocgia` (IN `tendg` VARCHAR(40) CHARSET utf8, IN `ngaysinh` DATE, IN `diachi` VARCHAR(255) CHARSET utf8)  INSERT INTO docgia(tendg, ngaysinh, diachi) VALUES(tendg, ngaysinh, diachi)$$

DROP PROCEDURE IF EXISTS `themmuontra`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `themmuontra` (IN `id_sach` INT(11), IN `id_dg` INT(11), IN `ngaymuon` DATE, IN `ngaytra` DATE, IN `tinhtrang` VARCHAR(40) CHARSET utf8)  INSERT INTO muontra(id_sach,id_dg,ngaymuon,ngaytra,tinhtrang) VALUES(id_sach,id_dg,ngaymuon,ngaytra,tinhtrang)$$

DROP PROCEDURE IF EXISTS `themsach`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `themsach` (IN `tensach` VARCHAR(100) CHARSET utf8, IN `tentg` VARCHAR(100) CHARSET utf8, IN `nhaxuatban` VARCHAR(100) CHARSET utf8, IN `ngayxb` DATE, IN `sotrang` INT(11), IN `tomtat` VARCHAR(255) CHARSET utf8)  INSERT INTO sach(tensach,tentg,nhaxuatban,ngayxb,sotrang,tomtat) VALUES(tensach,tentg,nhaxuatban,ngayxb,sotrang,tomtat)$$

DROP PROCEDURE IF EXISTS `xoadocgia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `xoadocgia` (IN `id1` INT(10))  DELETE FROM docgia WHERE id=id1$$

DROP PROCEDURE IF EXISTS `xoamuontra`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `xoamuontra` (IN `id1` INT(10))  DELETE FROM muontra WHERE id=id1$$

DROP PROCEDURE IF EXISTS `xoa_sach`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `xoa_sach` (IN `id1` INT(10))  DELETE FROM sach WHERE id=id1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tk` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mk` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `tk`, `mk`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `docgia`
--

DROP TABLE IF EXISTS `docgia`;
CREATE TABLE IF NOT EXISTS `docgia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tendg` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngaysinh` date NOT NULL,
  `diachi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `docgia`
--

INSERT INTO `docgia` (`id`, `tendg`, `ngaysinh`, `diachi`) VALUES
(1, 'TRAN TUONG DOAN', '2001-08-24', 'Can Tho'),
(3, 'NGUYEN NHAT ANH', '1996-10-02', 'Vinh Long'),
(6, 'HUYNH ANH KHOI', '2001-07-16', 'Ca Mau'),
(7, 'PHAM HONG PHU', '1994-09-27', 'Vinh Long');

-- --------------------------------------------------------

--
-- Table structure for table `muontra`
--

DROP TABLE IF EXISTS `muontra`;
CREATE TABLE IF NOT EXISTS `muontra` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_sach` int NOT NULL,
  `id_dg` int NOT NULL,
  `ngaymuon` date NOT NULL,
  `ngaytra` date NOT NULL,
  `tinhtrang` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sach` (`id_sach`),
  KEY `id_dg` (`id_dg`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `muontra`
--

INSERT INTO `muontra` (`id`, `id_sach`, `id_dg`, `ngaymuon`, `ngaytra`, `tinhtrang`) VALUES
(1, 4, 3, '2022-10-28', '2022-11-04', 'Trả muộn'),
(6, 5, 1, '2022-10-28', '2022-11-03', 'Đã trả'),
(9, 7, 3, '2022-10-12', '2022-11-04', 'Đã mượn'),
(10, 9, 7, '2022-10-08', '2022-11-15', 'Đã trả');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

DROP TABLE IF EXISTS `sach`;
CREATE TABLE IF NOT EXISTS `sach` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tensach` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tentg` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhaxuatban` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngayxb` date NOT NULL,
  `sotrang` int NOT NULL,
  `tomtat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`id`, `tensach`, `tentg`, `nhaxuatban`, `ngayxb`, `sotrang`, `tomtat`) VALUES
(2, 'DOREMON', 'Fujiko F. Fujio', 'Kim Dong', '2014-12-18', 120, 'Doraemon - chú mèo máy đến từ tương lai'),
(4, 'DE MEN PHIEU LUU KY', 'To Hoai', 'Ha Noi', '2015-05-31', 96, 'Dành cho lứa tuổi thiếu nhi'),
(5, 'HARRY POTTER', 'J. K. Rowling', 'Kim Dong', '2020-05-14', 255, 'Harry Potter và Phòng chứa Bí mật'),
(7, 'DA VINCI CODE', 'Dan Brown', 'Dong Thap', '2018-09-14', 219, 'Về mật mã Da Vinci'),
(9, 'NHAT THUC', 'Meyer', 'Thanh Nien', '2021-09-16', 340, 'Dành cho độ tuổi thiếu niên');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `muontra`
--
ALTER TABLE `muontra`
  ADD CONSTRAINT `muontra_ibfk_1` FOREIGN KEY (`id_sach`) REFERENCES `sach` (`id`),
  ADD CONSTRAINT `muontra_ibfk_2` FOREIGN KEY (`id_dg`) REFERENCES `docgia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
