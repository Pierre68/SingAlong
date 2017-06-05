-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2017 at 04:45 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id1617443_exds`
--

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` int(8) NOT NULL,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `artist` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `album` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `length` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `title`, `artist`, `album`, `year`, `length`) VALUES
(1, 'Manhattan Kaboul', 'Renaud', 'Boucan d\'enfer', 2002, 232),
(2, '---', '---', '---', 0, 0),
(3, 'Castle Of Glass', 'Linkin Park', 'Living things', 2012, 205),
(4, 'Powerless', 'Linkin Park', 'Living things', 2012, 206),
(5, 'Heathens', 'Twenty One Pilots', 'Heathens', 2016, 206),
(6, 'Wake Me Up When September Ends', 'Green Day', 'American Idiot', 2004, 286),
(7, 'Radioactive', 'Imagine Dragons', 'Night Vision', 2012, 187);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id` int(8) NOT NULL,
  `userId` int(8) NOT NULL,
  `songId` int(8) NOT NULL,
  `score` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(8) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(16) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(2, 'hebinger.68@gmail.com', 'Rhym', '$2y$10$Kd5i.F6QHoyUkpA8qJpZm.GfKMpLMXIqWIpFOSGrdJdZAtBXu0qlO'),
(3, 'isentarel@hotmail.com', 'Isentarel', '$2y$10$jYCxOpWj2gdaOHaiXj0y5.ch1w5OW6S9Y9sqn4HumPvONPeHGRyti'),
(4, 'hebinger.68@gmyuiail.com', 'test', '$2y$10$kaJQrBrB9uyl76rieQhu4OnU9iZn2cKl40nJUlYKhjeUj3dRCqNRS'),
(5, 'zentesent@yopmail.com', 'Zentesent', '$2y$10$hRrNzGW/1HxAeO0I.4aKmupo45XKiSvQiOfGCtnZncbA73QQo7Xve'),
(6, 'aymeric.moehn@gmail.com', 'AYMERIC', '$2y$10$Z95QgwevtAIt04wEAiq9JuRS/BXplp68mUGskKpFWR/89P8v5m/Me'),
(7, 'grosjean.justin.68@gmail.com', 'Justin', '$2y$10$B07ERqe7AvhlO3t.6nxyN.FDBF3TOqKoFsnWq.31CPiVV.LXVdz2S'),
(8, 'slashgreg12@gmail.com', 'Macabroute', '$2y$10$5FlC.bnQPzvxT8BcLgonFOP203COaKRlI1i0XGvMJyWQH/8HazUlK'),
(9, 'chanel29_msn@hotmail.fr', 'ChaliSky', '$2y$10$Xmnw.Y1GYxL.SeOL7mIxd.qffBBjYeZ4cmZk5WPBCyEu6XcSRemWy'),
(10, 'louis.eckler@gmail.com', 'Cosm', '$2y$10$LSRc2YvuHSf.b2w5qys23OOByHLANrHnrjo7WAoVK4P8.2Ho2j.P.'),
(11, 'bababutch@orange.fr', 'Bouni', '$2y$10$4RbZb9rBBu6CJr4SoTdXlu35mqY0XeS7RQE1SunmWbAEMv88bUn0O');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
