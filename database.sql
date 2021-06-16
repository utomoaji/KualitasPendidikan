-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 16, 2021 at 07:37 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `qualityEdu`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(16) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(8, 'testing tambah data kategori');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(16) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama`) VALUES
(73, 'SUMATERA UTARA'),
(74, 'SUMATERA BARAT'),
(75, 'RIAU'),
(76, 'JAMBI'),
(77, 'SUMATERA SELATAN'),
(78, 'BENGKULU'),
(79, 'LAMPUNG'),
(80, 'KEP. BANGKA BELITUNG'),
(81, 'KEP. RIAU'),
(82, 'DKI JAKARTA'),
(83, 'JAWA BARAT'),
(84, 'JAWA TENGAH'),
(85, 'DI YOGYAKARTA'),
(86, 'JAWA TIMUR'),
(87, 'BANTEN'),
(88, 'BALI'),
(89, 'NUSA TENGGARA BARAT'),
(90, 'NUSA TENGGARA TIMUR'),
(91, 'KALIMANTAN BARAT'),
(92, 'KALIMANTAN TENGAH'),
(93, 'KALIMANTAN SELATAN'),
(94, 'KALIMANTAN TIMUR'),
(95, 'KALIMANTAN UTARA'),
(96, 'SULAWESI UTARA'),
(97, 'SULAWESI TENGAH'),
(98, 'SULAWESI SELATAN'),
(99, 'SULAWESI TENGGARA'),
(100, 'GORONTALO'),
(101, 'SULAWESI BARAT'),
(102, 'MALUKU'),
(103, 'MALUKU UTARA'),
(104, 'PAPUA BARAT'),
(105, 'PAPUA'),
(106, 'INDONESIA');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(16) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama`) VALUES
(1, 'admin\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `sdgs`
--

CREATE TABLE `sdgs` (
  `id` int(16) NOT NULL,
  `nilai` varchar(255) NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tahun` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sdgs`
--

INSERT INTO `sdgs` (`id`, `nilai`, `provinsi_id`, `kategori_id`, `user_id`, `tahun`) VALUES
(143, '99.68', 73, 8, 5, '2020'),
(144, '99.77', 74, 8, 5, '2020'),
(145, '99.93', 75, 8, 5, '2020'),
(146, '99.67', 76, 8, 5, '2020'),
(147, '99.57', 77, 8, 5, '2020'),
(148, '99.7', 78, 8, 5, '2020'),
(149, '99.3', 79, 8, 5, '2020'),
(150, '99.07', 80, 8, 5, '2020'),
(151, '99.61', 81, 8, 5, '2020'),
(152, '99.89', 82, 8, 5, '2020'),
(153, '99.9', 83, 8, 5, '2020'),
(154, '97.97', 84, 8, 5, '2020'),
(155, '99.02', 85, 8, 5, '2020'),
(156, '96.79', 86, 8, 5, '2020'),
(157, '99.11', 87, 8, 5, '2020'),
(158, '98.34', 88, 8, 5, '2020'),
(159, '92.48', 89, 8, 5, '2020'),
(160, '95.76', 90, 8, 5, '2020'),
(161, '96.46', 91, 8, 5, '2020'),
(162, '99.91', 92, 8, 5, '2020'),
(163, '99.66', 93, 8, 5, '2020'),
(164, '99.74', 94, 8, 5, '2020'),
(165, '98.6', 95, 8, 5, '2020'),
(166, '99.84', 96, 8, 5, '2020'),
(167, '99.44', 97, 8, 5, '2020'),
(168, '95.89', 98, 8, 5, '2020'),
(169, '97.53', 99, 8, 5, '2020'),
(170, '99.33', 100, 8, 5, '2020'),
(171, '95.54', 101, 8, 5, '2020'),
(172, '99.56', 102, 8, 5, '2020'),
(173, '99.71', 103, 8, 5, '2020'),
(174, '98.23', 104, 8, 5, '2020'),
(175, '77.97', 105, 8, 5, '2020'),
(176, '98.29', 106, 8, 5, '2020'),
(177, '99.66', 73, 8, 5, '2019'),
(178, '99.79', 74, 8, 5, '2019'),
(179, '99.92', 75, 8, 5, '2019'),
(180, '99.73', 76, 8, 5, '2019'),
(181, '99.59', 77, 8, 5, '2019'),
(182, '99.69', 78, 8, 5, '2019'),
(183, '99.17', 79, 8, 5, '2019'),
(184, '99.16', 80, 8, 5, '2019'),
(185, '99.59', 81, 8, 5, '2019'),
(186, '99.94', 82, 8, 5, '2019'),
(187, '99.85', 83, 8, 5, '2019'),
(188, '97.82', 84, 8, 5, '2019'),
(189, '98.83', 85, 8, 5, '2019'),
(190, '96.72', 86, 8, 5, '2019'),
(191, '98.83', 87, 8, 5, '2019'),
(192, '98.11', 88, 8, 5, '2019'),
(193, '92.54', 89, 8, 5, '2019'),
(194, '95.76', 90, 8, 5, '2019'),
(195, '96.19', 91, 8, 5, '2019'),
(196, '99.92', 92, 8, 5, '2019'),
(197, '99.68', 93, 8, 5, '2019'),
(198, '99.76', 94, 8, 5, '2019'),
(199, '98.19', 95, 8, 5, '2019'),
(200, '99.88', 96, 8, 5, '2019'),
(201, '99.47', 97, 8, 5, '2019'),
(202, '95.78', 98, 8, 5, '2019'),
(203, '97.46', 99, 8, 5, '2019'),
(204, '99.33', 100, 8, 5, '2019'),
(205, '96.02', 101, 8, 5, '2019'),
(206, '99.56', 102, 8, 5, '2019'),
(207, '99.79', 103, 8, 5, '2019'),
(208, '98.47', 104, 8, 5, '2019'),
(209, '78.1', 105, 8, 5, '2019'),
(210, '98.22', 106, 8, 5, '2019'),
(211, '99.58', 73, 8, 5, '2018'),
(212, '99.73', 74, 8, 5, '2018'),
(213, '99.92', 75, 8, 5, '2018'),
(214, '99.66', 76, 8, 5, '2018'),
(215, '99.53', 77, 8, 5, '2018'),
(216, '99.56', 78, 8, 5, '2018'),
(217, '99.02', 79, 8, 5, '2018'),
(218, '98.79', 80, 8, 5, '2018'),
(219, '99.47', 81, 8, 5, '2018'),
(220, '99.95', 82, 8, 5, '2018'),
(221, '99.81', 83, 8, 5, '2018'),
(222, '97.73', 84, 8, 5, '2018'),
(223, '98.71', 85, 8, 5, '2018'),
(224, '96.58', 86, 8, 5, '2018'),
(225, '98.84', 87, 8, 5, '2018'),
(226, '97.01', 88, 8, 5, '2018'),
(227, '92.49', 89, 8, 5, '2018'),
(228, '94.76', 90, 8, 5, '2018'),
(229, '95.79', 91, 8, 5, '2018'),
(230, '99.91', 92, 8, 5, '2018'),
(231, '99.66', 93, 8, 5, '2018'),
(232, '99.7', 94, 8, 5, '2018'),
(233, '97.46', 95, 8, 5, '2018'),
(234, '99.92', 96, 8, 5, '2018'),
(235, '99.19', 97, 8, 5, '2018'),
(236, '95.37', 98, 8, 5, '2018'),
(237, '97.27', 99, 8, 5, '2018'),
(238, '99.26', 100, 8, 5, '2018'),
(239, '95.36', 101, 8, 5, '2018'),
(240, '99.41', 102, 8, 5, '2018'),
(241, '99.77', 103, 8, 5, '2018'),
(242, '98.16', 104, 8, 5, '2018'),
(243, '77.12', 105, 8, 5, '2018'),
(244, '98.07', 106, 8, 5, '2018');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(16) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `avatar`, `email`, `password`, `role_id`) VALUES
(5, 'admin', 'admin', 'https://ui-avatars.com/api/?name=admin', 'admin@email.com', '$2y$10$4BZd.eviY7RsNR49yRF0JOBC07fsAuRPe.C3yKJligkAXVVpMS/lG', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sdgs`
--
ALTER TABLE `sdgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `provinsi_id` (`provinsi_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `sdgs`
--
ALTER TABLE `sdgs`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sdgs`
--
ALTER TABLE `sdgs`
  ADD CONSTRAINT `kategori_id` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `provinsi_id` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
