-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2018 at 08:34 AM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutoriel`
--
CREATE DATABASE IF NOT EXISTS `tutoriel` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tutoriel`;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `album` (`id`,`artist`, `title`) VALUES
(1, 'The Military Wives', 'In My Dreams', ''),
(2, 'Adele', '21', ''),
(3, 'Bruce Springsteen', 'Wrecking Ball (Deluxe)', ''),
(4, 'Lana Del Rey', 'Born To Die', ''),
(5, 'Gotye', 'Making Mirrors', '');
-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`) VALUES
(1, 'Blog #1a', 'Welcome to my first blog post'),
(2, 'Blog #2', 'Welcome to my second blog post'),
(3, 'Blog #3', 'Welcome to my third blog post'),
(4, 'Blog #4', 'Welcome to my fourth blog post'),
(5, 'Blog #5', 'Welcome to my fifth blog post'),
(6, 'Blog #6', 'Welcome to my sixth blog post'),
(7, 'Title Yan', 'Text Yan'),
(11, 'Pâté pour chien', 'Pâté pour chien Pâté pour chien Pâté pour chien\r\n\r\nPâté pour chien Pâté pour chien'),
(9, 'Title 9', '#9 Text; \"!!'),
(10, 'Title 10', 'Text 10 ;) bis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

ALTER TABLE `album` 
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
