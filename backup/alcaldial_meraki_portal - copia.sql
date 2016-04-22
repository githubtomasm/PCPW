-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-08-2014 a las 10:28:20
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `a9872772_test`
--
CREATE DATABASE IF NOT EXISTS `a9872772_test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `a9872772_test`;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `user_name`, `password`, `salt`, `name`, `age`, `sex`, `cell_number`, `date_register`, `group`, `mareki_meta`, `divice_mac`) VALUES
(10, 'test@test.com', '', 'd5e06610a2f3a35217101b078b4332103a82099f0239b85addd945c11c7af0ba', 'k!Ø£òW€—âüb+€"‰\Z‡Ê³Ï-ùÄ&AbS[”', 'test 1', 20, 'male', '883215478', '2014-08-05 06:40:34', 1, 'a:5:{s:6:"mac_ap";s:17:"00:18:0a:xx:xx:xx";s:7:"node_id";s:7:"0000000";s:10:"gateway_id";s:7:"0000000";s:9:"client_ip";s:14:"10.128.128.120";s:10:"client_mac";s:17:"xx:xx:xx:xx:xx:xx";}', 'xx:xx:xx:xx:xx:xx'),
(11, 'loreias@hotmail.com', '', '64e187f4f62925ace206a28b6d475e5b4c5f9b848a56152ca28cb75a5df0fc77', 'µJôÈ\0:k á®ûr,,z*ÕËÝ‰ÅÕ\ni¤,ÉÊA³è', 'loreias', 25, 'male', '226598944545', '2014-08-05 06:54:08', 2, 'a:5:{s:6:"mac_ap";s:17:"00:18:0a:xx:xx:xx";s:7:"node_id";s:7:"0000000";s:10:"gateway_id";s:7:"0000000";s:9:"client_ip";s:14:"10.128.128.120";s:10:"client_mac";s:17:"xx:xx:xx:xx:xx:xx";}', 'xx:xx:xx:xx:xx:xx'),
(12, 'test2@test.com', '', 'b60372d277c33c9c8324ca7b85621b39d4816d65045b27dbe4d65e6b1055604e', 'þñöWÏ(ö Ë	ªçåXNxÝbNUjn[V™BFrïA', 'test2@test.com', 22, 'female', '987789876768768', '2014-08-05 07:24:10', 1, 'a:5:{s:6:"mac_ap";s:17:"00:18:0a:xx:xx:xx";s:7:"node_id";s:7:"0000000";s:10:"gateway_id";s:7:"0000000";s:9:"client_ip";s:14:"10.128.128.120";s:10:"client_mac";s:17:"xx:xx:xx:xx:xx:32";}', 'xx:xx:xx:xx:xx:32'),
(13, 'test3@test.com', '', 'f4ca55d0f82e3deab52c254f178501cb3a14ac9e46ff5a10285f7b8320d45685', 'É9Þ´R00B›ó\\ø§Xnx´Ý:³7ž®K', 'test3', 22, 'male', '1234123345', '2014-08-05 07:28:14', 1, 'a:5:{s:6:"mac_ap";s:17:"00:18:0a:xx:xx:xx";s:7:"node_id";s:7:"0000000";s:10:"gateway_id";s:7:"0000000";s:9:"client_ip";s:14:"10.128.128.120";s:10:"client_mac";s:17:"xx:xx:xx:xx:xx:32";}', 'xx:xx:xx:xx:xx:32'),
(14, 'test4@test.com', '', '6eb29dee835d926405b8def7152b52a1efcda4c8b52b4ce98b5e6a3d6d86a876', 'àR&FÝ.IâY]%j_d×8²ª}Æë}2+;ÔO', 'test4', 33, 'male', '11112222', '2014-08-05 08:04:04', 1, 'a:5:{s:6:"mac_ap";s:17:"00:18:0a:xx:xx:xx";s:7:"node_id";s:7:"0000000";s:10:"gateway_id";s:7:"0000000";s:9:"client_ip";s:14:"10.128.128.120";s:10:"client_mac";s:17:"xx:xx:xx:xx:xx:44";}', 'xx:xx:xx:xx:xx:44'),
(15, 'test5@test.com', '', '4a662f267997b426d63317205be4a7fac7a01be683c8461216f4671d55b50295', 'p@dMŒ[ÊÓ×ÌÙÿ§N™™¯Jöo\Z <–''3°F¿', 'test5', 44, 'female', '55554444', '2014-08-05 08:12:14', 1, 'a:5:{s:6:"mac_ap";s:17:"00:18:0a:xx:xx:xx";s:7:"node_id";s:7:"0000000";s:10:"gateway_id";s:7:"0000000";s:9:"client_ip";s:14:"10.128.128.120";s:10:"client_mac";s:17:"xx:xx:xx:xx:xx:52";}', 'xx:xx:xx:xx:xx:52'),
(16, 'test6@test.com', '', 'd57687579d9a8f9cdbcb32e86f0136fbac8b2e64f5d02271fb1b24408c903023', 'tfmú¼^(Ã\\k½rx''<ìÿ–ü»1e$ÜLmx', 'test6', 34, 'male', '22223333', '2014-08-05 10:07:20', 1, 'a:6:{s:6:"mac_ap";s:17:"00:18:0a:xx:xx:xx";s:7:"node_id";s:7:"0000000";s:10:"gateway_id";s:7:"0000000";s:9:"client_ip";s:14:"10.128.128.120";s:10:"client_mac";s:17:"xx:xx:xx:xx:xx:21";s:9:"grant_url";s:108:"https\0\0\0n00.network-auth.com/splash/grant?continue_url=https%3A%2F%2Fes-es.facebook.com%2FJuventudPresidente";}', 'xx:xx:xx:xx:xx:21');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
