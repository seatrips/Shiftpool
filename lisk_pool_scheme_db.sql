-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 27, 2016 at 06:54 AM
-- Server version: 5.5.49-MariaDB-1ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lisk_pool_scheme_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blockid` int(19) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `miners`
--

CREATE TABLE IF NOT EXISTS `miners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(64) NOT NULL,
  `balance` bigint(19) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `address` (`address`),
  KEY `balance` (`balance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `miner_balance`
--

CREATE TABLE IF NOT EXISTS `miner_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `miner` varchar(64) NOT NULL,
  `value` varchar(64) NOT NULL,
  `var_timestamp` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payout_history`
--

CREATE TABLE IF NOT EXISTS `payout_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(64) NOT NULL,
  `balance` varchar(64) NOT NULL,
  `time` varchar(32) NOT NULL,
  `txid` varchar(128) NOT NULL,
  `fee` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `address` (`address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pool_balance`
--

CREATE TABLE IF NOT EXISTS `pool_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) NOT NULL,
  `var_timestamp` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pool_rank`
--

CREATE TABLE IF NOT EXISTS `pool_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) NOT NULL,
  `var_timestamp` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pool_votepower`
--

CREATE TABLE IF NOT EXISTS `pool_votepower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `votepower` varchar(64) NOT NULL,
  `val_timestamp` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pool_voters`
--

CREATE TABLE IF NOT EXISTS `pool_voters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) NOT NULL,
  `var_timestamp` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(64) NOT NULL,
  `userid` varchar(16) NOT NULL,
  `hashrate` varchar(64) NOT NULL,
  `val_timestamp` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
