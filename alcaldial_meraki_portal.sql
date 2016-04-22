-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-08-2014 a las 01:04:10
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `skyviews_test`
--
CREATE DATABASE IF NOT EXISTS `skyviews_test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `skyviews_test`;

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
  `email` varchar(256) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(16) NOT NULL,
  `sex` varchar(16) NOT NULL,
  `cell_number` varchar(16) NOT NULL,
  `date_register` datetime NOT NULL,
  `group` int(11) NOT NULL,
  `mareki_meta` longtext NOT NULL,
  `divice_mac` varchar(52) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `user_name`, `password`, `salt`, `name`, `age`, `sex`, `cell_number`, `date_register`, `group`, `mareki_meta`, `divice_mac`) VALUES
(11, 'loreias@hotmail.com', '', '64e187f4f62925ace206a28b6d475e5b4c5f9b848a56152ca28cb75a5df0fc77', 'µJôÈ\0:k á®ûr,,z*ÕËÝ‰ÅÕ\ni¤,ÉÊA³è', 'loreias Mendoza', 25, 'male', '226598944545', '2014-08-05 06:54:08', 2, 'a:5:{s:6:"mac_ap";s:17:"00:18:0a:xx:xx:xx";s:7:"node_id";s:7:"0000000";s:10:"gateway_id";s:7:"0000000";s:9:"client_ip";s:14:"10.128.128.120";s:10:"client_mac";s:17:"xx:xx:xx:xx:xx:xx";}', 'xx:xx:xx:xx:xx:xx'),
(17, 'test@test.com', '', 'ab1d3c9ccff3ad12184f7e8cd4d875325294c2b2bad77cd46a62cfb393ee4640', 's±G~~''°ñ‘¶C\r^Š%™Þç¯#2¦%#µ', 'test', 22, 'female', '44445555', '2014-08-07 21:08:37', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:xx:xx:xx";s:7:"node_id";s:7:"0000000";s:10:"gateway_id";s:7:"0000000";s:9:"client_ip";s:14:"10.128.128.120";s:10:"client_mac";s:17:"xx:xx:xx:xx:xx:1x";s:9:"grant_url";s:108:"https\0\0\0n00.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', 'xx:xx:xx:xx:xx:1x');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_sessions`
--

CREATE TABLE IF NOT EXISTS `users_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `users_sessions`
--

INSERT INTO `users_sessions` (`id`, `user_id`, `hash`) VALUES
(5, 11, 'bb333dcbb2f37e6e8c1cb830b269451b7f35701d7edc0ea4bbd1342bb5100b2f');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
