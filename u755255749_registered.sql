-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 17, 2023 at 02:47 AM
-- Server version: 10.6.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u755255749_registered`
--

-- --------------------------------------------------------

--
-- Table structure for table `citizen_groups`
--

CREATE TABLE `citizen_groups` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Contact_Information` varchar(255) NOT NULL,
  `Business_Description` text DEFAULT NULL,
  `Funding_Proposal` text DEFAULT NULL,
  `Number_of_People` int(11) DEFAULT NULL,
  `Amount_for_Funding` decimal(10,2) DEFAULT NULL,
  `village` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `Post_ID` int(11) NOT NULL,
  `Topic_Title` varchar(255) NOT NULL,
  `Subject` text NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `government_bodies`
--

CREATE TABLE `government_bodies` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Contact_Information` varchar(255) NOT NULL,
  `Role` text DEFAULT NULL,
  `Authority` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsRead` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `name`, `email`, `Subject`, `Message`, `Timestamp`, `IsRead`) VALUES
(3, 'Anonymous', 'Anonymous', 'Suggestion', 'Hello', '2023-07-27 15:04:14', 0),
(4, 'SENTONGO HAMZA 2000703505', 'sentsdrimma123@gmail.com', 'Test', 'Helo test ', '2023-08-16 11:37:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ID`, `Name`, `Description`) VALUES
(22, 'HAMZA SENTONGO', 'xt of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It hasxt of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has'),
(23, 'knjnjnjn', 'lorem');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `responsibilities` varchar(200) NOT NULL,
  `skill` varchar(100) NOT NULL,
  `age` int(5) NOT NULL,
  `village` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `reg_date`, `responsibilities`, `skill`, `age`, `village`) VALUES
(13, 'Hatifah', 'nampeebwahatifah01@gmail.com', '$2y$10$QKryIh9PLchbvhDxyDioq.r1nemnkIlcWaW2JI8wAfQPXZtT9MrKS', '2023-08-04 12:25:35', 'Editor ', 'Computer skills ', 22, 'Wampewo '),
(14, 'Admin2', 'admin2@gmail.com', '$2y$10$PLWS3PzG8ekJ20bkHc.Cue.R5FncBY7pdbwyoyVnC.FhHkdaR2SJ6', '2023-08-16 11:32:45', 'General', 'All ', 20, 'Mugongo A');

-- --------------------------------------------------------

--
-- Table structure for table `wampewo_citizens`
--

CREATE TABLE `wampewo_citizens` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `Income` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `Village` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wampewo_citizens`
--

INSERT INTO `wampewo_citizens` (`ID`, `Name`, `phone`, `email`, `age`, `gender`, `occupation`, `Income`, `education`, `Village`) VALUES
(5, 'Hatifah ', '0781498921', 'nampeebwahatifah01@gmail.com', 18, 'Female ', 'Poultry keeping', '500000', 'UACE', 'Wampewo '),
(6, 'HAMZA SENTONGO', '+256708566302', 'sentsdrimma123@gmail.com', 23, 'M', 'time', '2344532', 'degree', 'Mugongo A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citizen_groups`
--
ALTER TABLE `citizen_groups`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`Post_ID`);

--
-- Indexes for table `government_bodies`
--
ALTER TABLE `government_bodies`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wampewo_citizens`
--
ALTER TABLE `wampewo_citizens`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citizen_groups`
--
ALTER TABLE `citizen_groups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `Post_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `government_bodies`
--
ALTER TABLE `government_bodies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wampewo_citizens`
--
ALTER TABLE `wampewo_citizens`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
