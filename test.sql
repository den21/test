-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 28, 2019 at 08:45 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_countries`
--

CREATE TABLE `t_countries` (
  `id` int(11) UNSIGNED NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_countries`
--

INSERT INTO `t_countries` (`id`, `country`) VALUES
(22, 'USA'),
(24, 'Austria');

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`id`, `name`, `email`, `country_id`) VALUES
(22, 'Denys', 'denant1234@gmail.com', 22),
(24, 'Vasiliy', 'antonyuk95@mail.com', 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_countries`
--
ALTER TABLE `t_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_countries`
--
ALTER TABLE `t_countries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
