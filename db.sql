-- phpMyAdmin SQL Dump
-- version 3.3.10.3
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2014 at 05:47 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `grover_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='List of admin users' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `user_name`, `password`, `created_at`, `modified_at`) VALUES
(1, 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', '2013-10-23 00:00:00', '2013-10-24 14:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL,
  `archive` varchar(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `packing_sheet_url` varchar(250) NOT NULL,
  `Address1` varchar(250) NOT NULL,
  `Address2` varchar(250) NOT NULL,
  `Address3` varchar(250) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Name2` varchar(100) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `CountryCode` varchar(20) NOT NULL,
  `Zip` varchar(20) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `weight` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `orders`
--


-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `LineItemId` varchar(100) NOT NULL,
  `OrderId` varchar(100) NOT NULL,
  `LineItemType` varchar(100) NOT NULL,
  `Quantity` varchar(20) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Attributes` varchar(250) NOT NULL,
  `Price` varchar(100) NOT NULL,
  `ProductId` varchar(100) NOT NULL,
  `PrintFiles` varchar(250) NOT NULL,
  `Previews` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `order_items`
--


-- --------------------------------------------------------

--
-- Table structure for table `order_messages`
--

DROP TABLE IF EXISTS `order_messages`;
CREATE TABLE IF NOT EXISTS `order_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `message_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `order_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `order_print_files`
--

DROP TABLE IF EXISTS `order_print_files`;
CREATE TABLE IF NOT EXISTS `order_print_files` (
  `id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(250) NOT NULL,
  `file_type` varchar(15) NOT NULL,
  `file_url` text NOT NULL,
  `file_description` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_print_files`
--

