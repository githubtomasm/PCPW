-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-07-2014 a las 18:51:03
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `alcaldial_meraki_portal`
--
CREATE DATABASE IF NOT EXISTS `alcaldial_meraki_portal` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `alcaldial_meraki_portal`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard User', ''),
(2, 'Administrator', '{"admin":1}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_register` datetime NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `salt`, `name`, `date_register`, `group`) VALUES
(7, 'test', '8892fd4cf70dd62b3f8cab14fc2a3dd46ebf2ec6ad64b94cc897fcee195ef524', 'ÍáÚFÊ‡ïyÔ¿Ÿ{g¬K®z¿ŸÛÒ9¡e„eÐ²', 'name test updated', '2014-07-27 07:36:40', 2),
(8, 'test2', '6f81fc5591f9793c0fd384e8387f183ccf7ef2959e748298f2c72bba92f340fb', '¼É!Y›Ñ_@V5¦UÃ„Ø''ÀyÊEH1ÆOg¤øôÄ', 'name test2', '2014-07-27 20:00:55', 1),
(9, 'loreias', 'a0492dddd7500d721293de8f93e6db4f0838eb3d1c76df32842cef861a55c65e', 'Ð‡ˆ¸Y§d<’ÅÒÔc9áòkÔèaœpÈö–Û™J…', 'DJ Mendoza', '2014-07-29 10:03:28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_sessions`
--

CREATE TABLE IF NOT EXISTS `users_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
