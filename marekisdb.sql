-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2016 at 09:21 PM
-- Server version: 5.5.40-36.1-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skyviews_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard User', ''),
(2, 'Administrator', '{"admin":1}');

-- --------------------------------------------------------

--
-- Table structure for table `mareki_aps`
--

CREATE TABLE IF NOT EXISTS `mareki_aps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `mac` varchar(64) NOT NULL,
  `serial` varchar(64) NOT NULL,
  `tags` varchar(64) NOT NULL,
  `parque` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=144 ;

--
-- Dumping data for table `mareki_aps`
--

INSERT INTO `mareki_aps` (`id`, `name`, `mac`, `serial`, `tags`, `parque`) VALUES
(1, '', '00:18:0a:04:ae:c4', 'Q2CK-6H58-3VBR', ' PPX managua ', 'PPX'),
(2, '', '00:18:0a:04:b1:44', 'Q2CK-7F3D-ZPEP', ' Managua PPX ', 'PPX'),
(3, '', '00:18:0a:04:aa:9e', 'Q2CK-4RDH-UH9R', ' PPX managua ', 'PPX'),
(4, '', '00:18:0a:04:ba:be', 'Q2CK-B32R-EP3Y', ' PPX managua ', 'PPX'),
(5, '', '00:18:0a:04:b9:3e', 'Q2CK-AJ56-Z5NU', ' PPX managua ', 'PPX'),
(6, '', '00:18:0a:04:ad:ba', 'Q2CK-5ZX9-QYSA', ' PPX managua ', 'PPX'),
(7, '', '00:18:0a:04:ac:3a', 'Q2CK-5F22-ACGG', ' PPX managua ', 'PPX'),
(8, '', '00:18:0a:04:ae:b6', 'Q2CK-6GBE-JMRW', ' PPX managua ', 'PPX'),
(9, '', '00:18:0a:04:ab:cc', 'Q2CK-57PJ-QD6D', ' PPX managua ', 'PPX'),
(10, '', '00:18:0a:04:ab:78', 'Q2CK-53R3-6ZRL', ' PPX managua ', 'PPX'),
(11, 'NIASNG-PMNG-03', '00:18:0a:04:b0:10', 'Q2CK-6YQ8-ZFBW', ' NuevaGuinea ', ' NuevaGuinea '),
(12, 'NIASNG-PMNG-06', '00:18:0a:04:ac:5a', 'Q2CK-5GEK-XJE7', ' NuevaGuinea ', ' PLV '),
(13, 'NIRSSC-PMSC-07', '00:18:0a:04:ac:d0', 'Q2CK-5MJG-NSKK', ' SanCarlos ', ' PLV '),
(14, 'NIRIRI-PMRI-07', '00:18:0a:04:aa:ec', 'Q2CK-4V5P-ZEMK', ' Rivas ', ' PLV '),
(15, 'NIOCOC-PMOC-01', '00:18:0a:04:ab:fa', 'Q2CK-5BQS-TDVG', ' Ocotal ', ' PLV '),
(16, 'NIMZSM-PMSM-07', '00:18:0a:04:b0:32', 'Q2CK-72CD-3MVU', ' Somoto ', ' PLV '),
(17, 'NIMYMY-PMMY-07', '00:18:0a:04:ba:d2', 'Q2CK-B44L-LD45', ' Masaya ', ' PLV '),
(18, 'NIMNMN-PLVI-05', '00:18:0a:04:b1:b2', 'Q2CK-7KEJ-8NAS', ' PLV ', ' PLV '),
(19, 'NIMNMN-PLAV-T2-02', '00:18:0a:04:b4:04', 'Q2CK-8H9D-YDSL', ' LAV Managua ', 'LAV'),
(20, 'NIMNMN-PLAV-T1-01', '00:18:0a:04:ba:7c', 'Q2CK-AYD4-FJNY', ' LAV Managua ', 'LAV'),
(21, 'NIMNMN-PLAV-C1-16', '00:18:0a:04:ac:2e', 'Q2CK-5EK3-VFSJ', ' LAV Managua ', 'LAV'),
(22, 'NIMNMN-PCPA-05', '00:18:0a:04:ac:d2', 'Q2CK-5MK5-BB33', ' CP Managua ', 'CP'),
(23, 'NIMNMN-PBTL-06', '00:18:0a:04:ac:30', 'Q2CK-5ELE-YK3S', ' Batahola Managua ', 'Batahola'),
(24, 'NILELE-PMLE-06', '00:18:0a:04:b6:c2', 'Q2CK-9JCF-25DX', ' Leon ', ' Leon '),
(25, 'NIJIJI-PMJI-01', '00:18:0a:04:ab:16', 'Q2CK-4X64-S88M', ' Jinotega ', ' Jinotega '),
(26, 'NIGRGR-PMGR-05', '00:18:0a:04:ab:ce', 'Q2CK-57XX-PF34', ' Granada ', ' Granada '),
(27, 'NIESES-PMES-01', '00:18:0a:04:aa:ac', 'Q2CK-4RVH-7TTW', ' Esteli ', ' Esteli '),
(28, 'NICZJP-PMJP-06', '00:18:0a:04:b5:08', 'Q2CK-8VCL-4688', ' Jinotepe ', ' Jinotepe '),
(29, 'NICHCH-PMCH-06', '00:18:0a:04:ac:2c', 'Q2CK-5EFZ-JYQW', ' Chinandega ', ' Chinandega '),
(30, '', '00:18:0a:04:ae:66', 'Q2CK-6BB6-GVTQ', ' Juigalpa ', ' Juigalpa '),
(31, '', '00:18:0a:04:b0:9a', 'Q2CK-773S-2JPB', ' Boaco ', ' Boaco '),
(32, '', '00:18:0a:04:ad:26', 'Q2CK-5RLT-RC75', ' Matagalpa ', ' Matagalpa '),
(33, 'NIMNMN-PLAV-C3-17', '00:18:0a:04:b1:dc', 'Q2CK-7N4T-WQ2H', ' LAV Managua ', 'LAV'),
(34, 'NIMNMN-PLAV-D3-22', '00:18:0a:04:af:f8', 'Q2CK-6XEY-XXN3', ' LAV Managua ', 'LAV'),
(35, '', '00:18:0a:04:ac:1c', 'Q2CK-5DK6-567K', ' Juigalpa ', ' Juigalpa '),
(36, 'NIMNMN-PLVI-01', '00:18:0a:04:b2:4c', 'Q2CK-7U6L-J3DV', ' PLV ', ' PLV '),
(37, 'NIMNMN-PLVI-02', '00:18:0a:04:ba:3e', 'Q2CK-AW9A-QZKQ', ' PLV ', ' PLV '),
(38, 'NIMNMN-PLVI-03', '00:18:0a:04:ba:5e', 'Q2CK-AWWG-QMJT', ' PLV ', ' PLV '),
(39, 'NIMYMY-PMMY-06', '00:18:0a:04:b9:9c', 'Q2CK-ANZX-9MCU', ' Masaya ', ' Masaya '),
(40, 'NIMYMY-PMMY-05', '00:18:0a:04:aa:16', 'Q2CK-4GXC-NLBB', ' Masaya ', ' Masaya '),
(41, 'NIMYMY-PMMY-03', '00:18:0a:04:ae:ca', 'Q2CK-6HBW-N2MU', ' Masaya ', ' Masaya '),
(42, 'NIMYMY-PMMY-04', '00:18:0a:04:ae:86', 'Q2CK-6D9N-XZS7', ' Masaya ', ' Masaya '),
(43, 'NIMYMY-PMMY-02', '00:18:0a:04:ae:9a', 'Q2CK-6E6Z-SQBT', ' Masaya ', ' Masaya '),
(44, '', '00:18:0a:04:b5:d0', 'Q2CK-96TE-GDL4', ' Boaco ', ' Boaco '),
(45, '', '00:18:0a:04:b0:66', 'Q2CK-74ZQ-FKA3', ' Boaco ', ' Boaco '),
(46, '', '00:18:0a:04:ac:22', 'Q2CK-5E2A-Q4D6', ' Boaco ', ' Boaco '),
(47, '', '00:18:0a:04:ac:0c', 'Q2CK-5CRW-GH4H', ' Boaco ', ' Boaco '),
(48, '', '00:18:0a:04:ab:f0', 'Q2CK-5AU4-JVF2', ' Boaco ', ' Boaco '),
(49, 'NIJIJI-PMJI-02', '00:18:0a:04:ac:de', 'Q2CK-5MTL-KGDC', ' Jinotega ', ' Jinotega '),
(50, 'NIJIJI-PMJI-03', '00:18:0a:04:ae:da', 'Q2CK-6JKR-EVJD', ' Jinotega ', ' Jinotega '),
(51, 'NIJIJI-PMJI-06', '00:18:0a:04:b0:9c', 'Q2CK-7768-RMZ5', ' Jinotega ', ' Jinotega '),
(52, 'NIJIJI-PMJI-04', '00:18:0a:04:ad:0c', 'Q2CK-5QBL-X7RN', ' Jinotega ', ' Jinotega '),
(53, '', '00:18:0a:04:aa:66', 'Q2CK-4LSK-Z5XU', ' Matagalpa ', ' Matagalpa '),
(54, '', '00:18:0a:04:ba:02', 'Q2CK-ATLK-BYNX', ' Matagalpa ', ' Matagalpa '),
(55, '', '00:18:0a:04:ad:1a', 'Q2CK-5QT9-5WQC', ' Matagalpa ', ' Matagalpa '),
(56, '', '00:18:0a:04:ae:ba', 'Q2CK-6GLR-NB6K', ' Matagalpa ', ' Matagalpa '),
(57, '', '00:18:0a:04:aa:c0', 'Q2CK-4SW7-QSTR', ' Matagalpa ', ' Matagalpa '),
(58, 'NIMNMN-PBTL-04', '00:18:0a:04:af:a8', 'Q2CK-6TLH-GAGU', ' Batahola Managua ', 'Batahola'),
(59, '', '00:18:0a:04:ad:04', 'Q2CK-5PXQ-A6TS', ' Juigalpa ', ' Juigalpa '),
(60, '', '00:18:0a:04:ae:c0', 'Q2CK-6H2W-G2MV', ' Juigalpa ', ' Juigalpa '),
(61, '', '00:18:0a:04:b2:f0', 'Q2CK-83YR-2K73', ' Juigalpa ', ' Juigalpa '),
(62, '', '00:18:0a:04:b3:04', 'Q2CK-8592-52H8', ' Juigalpa ', ' Juigalpa '),
(63, '', '00:18:0a:04:b8:b0', 'Q2CK-AB2S-7U4Y', ' Esteli ', ' Esteli '),
(64, '', '00:18:0a:04:af:86', 'Q2CK-6RJJ-FSPL', ' Esteli ', ' Esteli '),
(65, 'NIESES-PMES-04', '00:18:0a:04:ba:88', 'Q2CK-AYLA-CPV2', ' Esteli ', ' Esteli '),
(66, 'NIESES-PMES-02', '00:18:0a:04:ac:d8', 'Q2CK-5MMH-3E7E', ' Esteli ', ' Esteli '),
(67, 'NIESES-PMES-03', '00:18:0a:04:ab:d4', 'Q2CK-58C9-XWH3', ' Esteli ', ' Esteli '),
(68, 'NIMYMY-PMMY-01', '00:18:0a:04:ae:b0', 'Q2CK-6F6J-KWGF', ' Masaya ', ' Masaya '),
(69, 'NIRSSC-PMSC-04', '00:18:0a:04:ba:26', 'Q2CK-AV7V-B35G', ' SanCarlos ', ' SanCarlos '),
(70, 'NIRSSC-PMSC-03', '00:18:0a:04:ab:46', 'Q2CK-525C-ZKKG', ' SanCarlos ', ' SanCarlos '),
(71, 'NIRSSC-PMSC-01', '00:18:0a:04:ba:4c', 'Q2CK-AWFF-2363', ' SanCarlos ', ' SanCarlos '),
(72, 'NIRSSC-PMSC-06', '00:18:0a:04:ac:24', 'Q2CK-5E7G-GM32', ' SanCarlos ', ' SanCarlos '),
(73, 'NIRSSC-PMSC-02', '00:18:0a:04:ba:4a', 'Q2CK-AWED-SGXG', ' SanCarlos ', ' SanCarlos '),
(74, 'NIMZSM-PMSM-03', '00:18:0a:04:ae:70', 'Q2CK-6C9G-BPKX', ' Somoto ', ' Somoto '),
(75, 'NIMZSM-PMSM-04', '00:18:0a:04:ae:9e', 'Q2CK-6EJQ-5KKC', ' Somoto ', ' Somoto '),
(76, 'NIMZSM-PMSM-02', '00:18:0a:04:b1:4e', 'Q2CK-7F9W-E232', ' Somoto ', ' Somoto '),
(77, 'NIMZSM-PMSM-05', '00:18:0a:04:ac:38', 'Q2CK-5ETM-JRHM', ' Somoto ', ' Somoto '),
(78, 'NIRIRI-PMRI-03', '00:18:0a:04:ba:6a', 'Q2CK-AXGV-VYPB', ' Rivas ', ' Rivas '),
(79, 'NIOCOC-PMOC-02', '00:18:0a:04:b8:dc', 'Q2CK-AD2Z-FXNZ', ' Ocotal ', ' Ocotal '),
(80, 'NIOCOC-PMOC-05', '00:18:0a:04:ab:bc', 'Q2CK-56SU-98ZF', ' Ocotal ', ' Ocotal '),
(81, 'NIGRGR-PMGR-03', '00:18:0a:04:ac:46', 'Q2CK-5FFC-3Y9C', ' Granada ', ' Granada '),
(82, 'NIGRGR-PMGR-01', '00:18:0a:04:b0:40', 'Q2CK-72ZZ-8PAY', ' Granada ', ' Granada '),
(83, 'NIGRGR-PMGR-02', '00:18:0a:04:ac:50', 'Q2CK-5FWE-GCLA', ' Granada ', ' Granada '),
(84, 'NIMNMN-PLAV-D1-20', '00:18:0a:04:af:ee', 'Q2CK-6X5C-2L3G', ' LAV Managua ', 'LAV'),
(85, 'NIMNMN-PLAV-D2-21', '00:18:0a:04:ad:12', 'Q2CK-5QFE-S3TE', ' LAV Managua ', 'LAV'),
(86, 'NIMNMN-PLAV-C5-19', '00:18:0a:04:b0:7c', 'Q2CK-764B-SAP6', ' LAV Managua ', 'LAV'),
(87, 'NIMNMN-PLAV-C02-02', '00:18:0a:04:ad:14', 'Q2CK-5QFX-WPVX', ' LAV Managua ', 'LAV'),
(88, 'NIMNMN-PLAV-B7-11', '00:18:0a:04:ac:0e', 'Q2CK-5CS7-YECA', ' LAV Managua ', 'LAV'),
(89, 'NIMNMN-PLAV-B6-10', '00:18:0a:04:ab:d2', 'Q2CK-583Y-G2U4', ' LAV Managua ', 'LAV'),
(90, 'NIMNMN-PLAV-C4-18', '00:18:0a:04:ab:dc', 'Q2CK-58ZV-7MPM', ' LAV Managua ', 'LAV'),
(91, 'NIMNMN-PLAV-B4-08', '00:18:0a:04:ab:64', 'Q2CK-533G-SLDP', ' LAV Managua ', 'LAV'),
(92, 'NIMNMN-PLAV-B5-09', '00:18:0a:04:ba:66', 'Q2CK-AXCK-Q2CS', ' LAV Managua ', 'LAV'),
(93, 'NIMNMN-PLAV-B2-06', '00:18:0a:04:ab:be', 'Q2CK-5756-YULQ', ' LAV Managua ', 'LAV'),
(94, 'NIMNMN-PLAV-B1-15', '00:18:0a:04:ab:ee', 'Q2CK-5AAK-T5E4', ' LAV Managua ', 'LAV'),
(95, 'NIMNMN-PLAV-B3-07', '00:18:0a:04:aa:0a', 'Q2CK-4FZS-NTD7', ' LAV Managua ', 'LAV'),
(96, 'NIMNMN-PLAV-A5-14', '00:18:0a:04:ae:bc', 'Q2CK-6GW2-B3QN', ' LAV Managua ', 'LAV'),
(97, 'NIMNMN-PLAV-A3-12', '00:18:0a:04:ae:80', 'Q2CK-6CPE-E4ST', ' LAV Managua ', 'LAV'),
(98, 'NIMNMN-PLAV-A4-13', '00:18:0a:04:ad:32', 'Q2CK-5SHR-PQWL', ' LAV Managua ', 'LAV'),
(99, 'NIMNMN-PLAV-A2-05', '00:18:0a:04:b0:7a', 'Q2CK-763Z-SQ9B', ' LAV Managua ', 'LAV'),
(100, 'NIMNMN-PLAV-A1-04', '00:18:0a:04:ac:5e', 'Q2CK-5GK7-J63A', ' LAV Managua ', 'LAV'),
(101, 'NIMNMN-PLAV-D4-23', '00:18:0a:04:af:5c', 'Q2CK-6PXN-H9CC', ' LAV Managua ', 'LAV'),
(102, 'NIMNMN-PLAV-T3-03', '00:18:0a:04:bc:be', 'Q2CK-BVYX-47KS', ' LAV Managua ', 'LAV'),
(103, 'NILELE-PMLE-01', '00:18:0a:04:b2:1a', 'Q2CK-7RGZ-XERR', ' Leon ', ' Leon '),
(104, 'NILELE-PMLE-02', '00:18:0a:04:b1:20', 'Q2CK-7DSM-WPC2', ' Leon ', ' Leon '),
(105, 'NILELE-PMLE-03', '00:18:0a:04:b1:2a', 'Q2CK-7E5T-KGNN', ' Leon ', ' Leon '),
(106, 'NILELE-PMLE-04', '00:18:0a:04:bc:b8', 'Q2CK-BVML-ME56', ' Leon ', ' Leon '),
(107, 'NILELE-PMLE-05', '00:18:0a:04:b6:b4', 'Q2CK-9HK4-FZUP', ' Leon ', ' Leon '),
(108, 'NIRSSC-PMSC-05', '00:18:0a:04:ab:76', 'Q2CK-53PP-VPJT', ' SanCarlos ', ' SanCarlos '),
(109, 'NIOCOC-PMOC-03', '00:18:0a:04:ae:6a', 'Q2CK-6C5N-Y9MW', ' Ocotal ', ' Ocotal '),
(110, 'NIMZSM-PMSM-01', '00:18:0a:04:ae:6c', 'Q2CK-6C5U-KLTZ', ' Somoto ', ' Somoto '),
(111, 'NIJIJI-PMJI-05', '00:18:0a:04:ae:d2', 'Q2CK-6J9J-3LKL', ' Jinotega ', ' Jinotega '),
(112, 'NIASNG-PMNG-05', '00:18:0a:04:af:d8', 'Q2CK-6VWG-4EM8', ' NuevaGuinea ', ' NuevaGuinea '),
(113, 'NIASNG-PMNG-02', '00:18:0a:04:af:fa', 'Q2CK-6XGZ-EP6U', ' NuevaGuinea ', ' NuevaGuinea '),
(114, 'NIASNG-PMNG-01', '00:18:0a:04:b0:0a', 'Q2CK-6YCY-84CZ', ' NuevaGuinea ', ' NuevaGuinea '),
(115, 'NIOCOC-PMOC-04', '00:18:0a:04:b0:48', 'Q2CK-73SB-Q487', ' Ocotal ', ' Ocotal '),
(116, 'NIASNG-PMNG-04', '00:18:0a:04:b0:68', 'Q2CK-75EX-H5X5', ' NuevaGuinea ', ' NuevaGuinea '),
(117, 'NIASNG-PMNG-07', '00:18:0a:04:ac:02', 'Q2CK-5BWF-868Q', ' NuevaGuinea ', ' NuevaGuinea '),
(118, 'NIOCOC-PMOC-06', '00:18:0a:04:ab:d0', 'Q2CK-583F-RZU5', ' Ocotal ', ' Ocotal '),
(119, 'NIMZSM-PMSM-06', '00:18:0a:04:ab:80', 'Q2CK-53XM-XAWQ', ' Somoto ', ' Somoto '),
(120, 'NIMNMN-PCPA-01', '00:18:0a:04:aa:0e', 'Q2CK-4GHK-TAHZ', ' CP Managua ', 'CP'),
(121, 'NIMNMN-PCPA-02', '00:18:0a:04:aa:22', 'Q2CK-4H97-FWQG', ' CP Managua ', 'CP'),
(122, 'NIMNMN-PCPA-04', '00:18:0a:04:ba:28', 'Q2CK-AV7Y-F9GP', ' CP Managua ', 'CP'),
(123, 'NIMNMN-PCPA-03', '00:18:0a:04:ab:fe', 'Q2CK-5BSJ-5WBB', ' CP Managua ', 'CP'),
(124, 'NIGRGR-PMGR-06', '00:18:0a:04:aa:00', 'Q2CK-4FKV-TH6Y', ' Granada ', ' Granada '),
(125, 'NIMNMN-PBTL-05', '00:18:0a:04:b1:80', 'Q2CK-7HAN-2ZWU', ' Batahola Managua ', 'Batahola'),
(126, 'NIMNMN-PBTL-03', '00:18:0a:04:ac:5c', 'Q2CK-5GHP-Q934', ' Batahola Managua ', 'Batahola'),
(127, 'NIMNMN-PBTL-02', '00:18:0a:04:ac:62', 'Q2CK-5GN4-BQPR', ' Batahola Managua ', 'Batahola'),
(128, 'NIGRGR-PMGR-04', '00:18:0a:04:ac:18', 'Q2CK-5DE4-3MG3', ' Granada ', ' Granada '),
(129, 'NIRIRI-PMRI-05', '00:18:0a:04:aa:0c', 'Q2CK-4GBR-RHAG', ' Rivas ', ' Rivas '),
(130, 'NIRIRI-PMRI-04', '00:18:0a:04:ab:fc', 'Q2CK-5BQT-V7MX', ' Rivas ', ' Rivas '),
(131, 'NIRIRI-PMRI-02', '00:18:0a:04:ac:66', 'Q2CK-5GUU-AEG2', ' Rivas ', ' Rivas '),
(132, 'NIRIRI-PMRI-06', '00:18:0a:04:b0:86', 'Q2CK-76DN-XXWG', ' Rivas ', ' Rivas '),
(133, 'NIRIRI-PMRI-01', '00:18:0a:04:b3:68', 'Q2CK-89PS-366B', ' Rivas ', ' Rivas '),
(134, 'NICZJP-PMJP-05', '00:18:0a:04:ab:e4', 'Q2CK-59MG-YAE6', ' Jinotepe ', ' Jinotepe '),
(135, 'NICZJP-PMJP-04', '00:18:0a:04:ab:d6', 'Q2CK-58DP-78D4', ' Jinotepe ', ' Jinotepe '),
(136, 'NICZJP-PMJP-03', '00:18:0a:04:ab:f2', 'Q2CK-5AU8-CQUF', ' Jinotepe ', ' Jinotepe '),
(137, 'NICZJP-PMJP-02', '00:18:0a:04:aa:68', 'Q2CK-4LUK-3KEE', ' Jinotepe ', ' Jinotepe '),
(138, 'NICZJP-PMJP-01', '00:18:0a:04:ab:12', 'Q2CK-4X4L-PTRH', ' Jinotepe ', ' Jinotepe '),
(139, 'NICHCH-PMCH-02', '00:18:0a:04:ad:ee', 'Q2CK-64YZ-BX3W', ' Chinandega ', ' Chinandega '),
(140, 'NICHCH-PMCH-05', '00:18:0a:04:ac:1a', 'Q2CK-5DJ4-NP4V', ' Chinandega ', ' Chinandega '),
(141, 'NICHCH-PMCH-04', '00:18:0a:04:ad:60', 'Q2CK-5VB4-HX3R', ' Chinandega ', ' Chinandega '),
(142, 'NICHCH-PMCH-03', '00:18:0a:04:ac:70', 'Q2CK-5HHC-TWR2', ' Chinandega ', ' Chinandega '),
(143, 'NICHCH-PMCH-01', '00:18:0a:04:bd:6c', 'Q2CK-C4TQ-EEKD', ' Chinandega ', ' Chinandega ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(128) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `age` int(16) NOT NULL,
  `sex` varchar(16) NOT NULL,
  `cell_number` varchar(16) NOT NULL,
  `cell_hash` varchar(128) NOT NULL,
  `date_register` datetime NOT NULL,
  `group` int(11) NOT NULL,
  `mareki_meta` longtext NOT NULL,
  `divice_mac` varchar(52) NOT NULL,
  `parks_tags` varchar(256) DEFAULT NULL,
  `facebook_register` varchar(256) NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `user_name`, `password`, `salt`, `name`, `last_name`, `age`, `sex`, `cell_number`, `cell_hash`, `date_register`, `group`, `mareki_meta`, `divice_mac`, `parks_tags`, `facebook_register`) VALUES
(54, 'loreias@hotmail.com', '', 'dd91e87cb422c20e46e8143a86cf34d743ab016a9c8938d1c526ee93bc50a661', '%0B%85%16L%E5-%FB%DA%08%DD%15%D1%7D%E3%7DC%ED%27%9C%8Bc%F2.%BE%01u%24%96%E8%06Uw', 'loreias Mendoza', '', 35, 'male', '88889999', '98a05e0246952a76c4b8b162c53958112d6f797b3e3ec6e0f510ce5e439aa7d6', '2014-08-11 04:29:15', 2, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:04:b0:10";s:7:"node_id";s:6:"306142";s:10:"gateway_id";s:6:"306142";s:9:"client_ip";s:10:"10.28.1.57";s:10:"client_mac";s:17:"e0:ca:94:c8:f8:4e";s:9:"grant_url";s:108:"https://n98.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', 'e0:ca:94:c8:f8:4e', 'LAV Managua ', 'false'),
(63, 'test@test.com', '', '63f37f41289a44965ac85206fe06e1666f04f0ef13c0c96596b7cd1854c7ccfc', '%23%8F%85%12%F7%89%FF%CC%C0%0F%9A%12%15%29%8A%85%CF%5E%27%0C%D8%FB%E0%1A%F3%A4%99P%89%40F%91', 'loreias', '', 25, 'female', '', 'd0ae97bd44667b27b33f0802653c75532609c70b0ce27c250a6413e5ef759a3a', '2014-08-17 21:39:40', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:04:ab:de";s:7:"node_id";s:6:"306142";s:10:"gateway_id";s:6:"306142";s:9:"client_ip";s:10:"10.28.1.57";s:10:"client_mac";s:17:"e0:ca:94:c8:f8:4e";s:9:"grant_url";s:108:"https://n98.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', 'e0:ca:94:c8:f8:4e', '', 'false'),
(64, 'test2@test.com', '', '662c0b768c439b3733fa5c6c33d4a9c441484b1e5b7b338b0a78be1b9428cb8a', '%DF%18%06k%AE%8A%E9%9A%B4z%FF%8D%86%02i%EC2%8E%3E%A1%CF%E2%E0S%96%BA%FCE%CB%7F%DE%FB', 'test2', '', 25, 'female', '22223333', '7343fb3ed53b57bf5e789cde69fd1be98404072f3883e6384413679afb9ae1af', '2014-08-17 22:51:35', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:04:ab:de";s:7:"node_id";s:6:"306142";s:10:"gateway_id";s:6:"306142";s:9:"client_ip";s:10:"10.28.1.57";s:10:"client_mac";s:17:"e0:ca:94:c8:f8:4e";s:9:"grant_url";s:108:"https://n98.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', 'e0:ca:94:c8:f8:4e', NULL, 'false'),
(65, 'test3@test.com', '', 'ec2f578c7cc9876ac06cda2d641e41c64405a46ae5585ae9a630dbd35de7c199', '%84%27%01%EA%F2%04%C5%07%FD%D5%C0B%C6%1D%22%3C%AE6%C1T%C7%9EC%9EC%D5%E5%B5%F9%BF%0F%2B', 'test 3', '', 25, 'female', '33334444', '695dbd3016f0adca7fa16485de52e4abc05bb028703adbff6b11eecb101aa494', '2014-08-17 22:57:32', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:04:b1:44";s:7:"node_id";s:6:"306142";s:10:"gateway_id";s:6:"306142";s:9:"client_ip";s:10:"10.28.1.57";s:10:"client_mac";s:17:"e0:ca:94:c8:f8:4e";s:9:"grant_url";s:108:"https://n98.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', 'e0:ca:94:c8:f8:4e', ' Managua PPX ', 'false'),
(67, 'test4@test.com', '', '13ce43a89db8ac5641dcecec1258851f3194bb6d74ecab200c10a50a250ec1fc', 'mv%05%05%18Vk%D6%C6%01%28q%7F%93%29%14u%09s4%FFwC%1A%86L%E1~%22%F3%19%D1', 'test4', '', 23, 'female', '44445555', '973027faf5ae2fa5187a727d6b3e1bac35ff6a361ebd65b14647216ba3ffac40', '2014-08-17 23:15:17', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:04:ab:de";s:7:"node_id";s:6:"306142";s:10:"gateway_id";s:6:"306142";s:9:"client_ip";s:14:"10.132.174.197";s:10:"client_mac";s:17:"70:f1:a1:cc:60:47";s:9:"grant_url";s:108:"https://n98.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', '70:f1:a1:cc:60:47', NULL, 'false'),
(68, 'test5@test.com', '', 'ba748c0bc8a363c644690dd42db82245fc27fd9f20ddde334ccfde62dab0b041', '%88%A8%DD%5E%B0%86%E2D%7D%DCF8%BA%26%911%18%A6%7C%3A%CAs%18%A7b%99%E4%86%AF%CE%98%C0', 'test5', 'Mendoza', 25, 'mujer', '55556666', 'a933c897def51b4f43c593f92b1637f809e3a95572468f5de863bd6b2d63d0b3', '2014-08-17 23:55:31', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:04:ab:de";s:7:"node_id";s:6:"306142";s:10:"gateway_id";s:6:"306142";s:9:"client_ip";s:10:"10.28.1.57";s:10:"client_mac";s:17:"e0:ca:94:c8:f8:4e";s:9:"grant_url";s:108:"https://n98.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', 'e0:ca:94:c8:f8:4e', NULL, 'false'),
(69, 'camilolenin@gmail.com', '', '7eeed8575ab36463a68d9e87878801f598b9521cb93fb264bfea0e7a3b66b88a', '%19%A9%B5%7D%A5%40%05%9A%B4%9D%10%8D%18%95%81S%80%E5%EF%E8%8EF%A6%07%F2%FBO%E7%3F%94%B1%7D', 'Camilo Lenin', 'Otero Escorcia', 33, 'hombre', '89119520', 'd3a05fd6f785643d846a736cb43a651788f664c88e21a552ee346570b7531f64', '2014-08-18 15:54:18', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:04:b1:b2";s:7:"node_id";s:6:"307634";s:10:"gateway_id";s:6:"307634";s:9:"client_ip";s:14:"10.132.174.197";s:10:"client_mac";s:17:"70:f1:a1:cc:60:47";s:9:"grant_url";s:108:"https://n98.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', '70:f1:a1:cc:60:47', ' PLV ', 'false'),
(70, 'alex.asm2003@gmail.com', '', '3ec470e4af3cdb1d9d7b1bda15ece9675303fcaf57ffd6c3ef0c2e66cf460c3a', '%9F9%08%2AK%16s%2A%BC%A8y%10A%1D%F5_%E8%8E%96kF%11%92%E8%18%BE%97_%17b%26%99', 'alex', 'serrano', 26, 'hombre', '12345678', '58c3d8a4c559d5e3019ee4433211da10e7100773cc9dfcbd52116dd81ac206cb', '2014-08-18 16:02:37', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:04:ab:de";s:7:"node_id";s:6:"306142";s:10:"gateway_id";s:6:"306142";s:9:"client_ip";s:14:"10.253.244.249";s:10:"client_mac";s:17:"00:22:f4:9c:a9:46";s:9:"grant_url";s:108:"https://n98.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', '00:22:f4:9c:a9:46', NULL, 'false'),
(71, 'roxauxlopez@hotmail.com', '', '538974dca3e532a5bea65739dd8c380a9fca54a05268dcfb607c0891f07e0d68', '%3D%7D%E5%8A%C7m%A9L%7F%FD%F2w%11%D7%EA8%E5%C7IN%E9m3%F2%12%9D%1DB%E6%0E%82%DD', 'Roxanna Auxiliadora', 'López Guadamuz', 25, 'mujer', '87018916', '97ec1546441a58bd379970e8cb55eb38440ad114ecc528f36e46eee475ca9c01', '2014-08-18 16:20:09', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:04:ab:de";s:7:"node_id";s:6:"306142";s:10:"gateway_id";s:6:"306142";s:9:"client_ip";s:14:"10.132.174.197";s:10:"client_mac";s:17:"70:f1:a1:cc:60:47";s:9:"grant_url";s:108:"https://n98.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', '70:f1:a1:cc:60:47', NULL, 'false'),
(72, 'lingallegos@hotmail.com', '', '', '', 'Sthella', 'Cajina', 33, 'female', '', '', '2014-10-21 13:11:24', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:xx:xx:xx";s:7:"node_id";s:7:"0000000";s:10:"gateway_id";s:7:"0000000";s:9:"client_ip";s:14:"10.128.128.120";s:10:"client_mac";s:17:"xx:xx:xx:xx:xx:xx";s:9:"grant_url";s:74:"testurl?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', 'xx:xx:xx:xx:xx:xx', NULL, '10152519774424217');

-- --------------------------------------------------------

--
-- Table structure for table `users_sessions`
--

CREATE TABLE IF NOT EXISTS `users_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `users_sessions`
--

INSERT INTO `users_sessions` (`id`, `user_id`, `hash`) VALUES
(5, 11, 'bb333dcbb2f37e6e8c1cb830b269451b7f35701d7edc0ea4bbd1342bb5100b2f'),
(29, 29, '92dd50470ad980cc2aad305f57162758b11d12c743f6a231db81d89454fd8ab5'),
(30, 30, '399b676d767a5b475e69009f60be8887df7b162d5b02de6cc45bbe19e1404c01'),
(38, 48, '714aff6f75128dcbf524777c60057d503c94ddec37bcc1b354eee54ca8525549'),
(45, 51, 'c63791f65eb2bcbb8ce33013dae439993e9aec84d26bc0ee337e19d5fbc9df78'),
(90, 70, 'be6b812d8b6548ff401291a90efbf4b8155c207ada4743e4749e637ddbdf5b66'),
(97, 72, 'd74036fefe8934fd57feddcced0fc41e743886a05ed3ef1e234aaa8ebe45a279'),
(99, 54, '8ae121ca13ce79ce4b91e010c5620604e587b9a2fd6e17f2d6df6cf3271a7f1c');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
