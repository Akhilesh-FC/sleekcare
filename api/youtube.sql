-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 09:36 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youtube`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `details`, `added_on`) VALUES
(1, 'Home Maharashtra Releases MHT CET 2021 Syllabus, Marking Scheme; Details Here\r\n', 'The Maharashtra State Common Entrance Test Cell has released the syllabus and marking scheme for the MHT CET 2021 exam. The MHT CET 2021, conducted for two groups -- Physics, Chemistry and Biology (PCB) and Physics, Chemistry and Mathematics (PCM) -- will be conducted in an online format. The questions of MHT CET 2021 will be based on the Maharashtra State Board of Secondary and Higher Education syllabus.', '2020-12-26 12:46:32'),
(2, 'ACET 2021 Admit Card Released; Check Direct Link Here\r\n', 'New Delhi: The Institute of Actuaries of India (IAI) -- the conducting body of ACET, has released the ACET 2021 admit cards. Candidates who have applied online and paid the requisite fees can download the ACET admit cards from the official website -- actuariesindia.org. Actuarial Common Entrance Test (ACET) is a national level entrance exam for aspirants seeing a career in actuaries.\r\n', '2020-12-26 12:46:32'),
(3, 'JEE Main, NEET 2020 Live Updates: Students Gear Up For JEE Exams From Tomorrow, Check Last Minute Details\r\n', 'New Delhi: With JEE Main exam at the edge, students across the nation are gearing up to write the paper from tomorrow onwards. The National Testing Agency, or NTA, will conduct the Joint Entrance Examination Main (JEE Main) from tomorrow -- September 1.\r\nTo aid the students commuting from nook and corners of the country, the Indian Institute of Technology Delhi (IIT Delhi) students and alumni promptly came forward and launched a dedicated portal to connect with Samaritans who may want to help the needy candidates.\r\n\r\n', '2020-12-26 12:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `content`, `details`) VALUES
(1, 'Home', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce quam purus, blandit at scelerisque eu, malesuada ut massa. Sed eget viverra nisi, vel elementum eros. Nam auctor tristique dui, vel posuere quam placerat non. Pellentesque sit amet metus magna. In non pharetra nibh. Donec viverra eleifend ultricies. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut pretium arcu ut eros tempor laoreet. Proin sit amet lorem eget nisi rutrum pretium. Donec congue blandit ex, a hendrerit mi bibendum quis. Duis vehicula eros justo, vel varius dui commodo elementum. Morbi est sem, hendrerit eget elementum vitae, tristique at dolor.\r\n\r\n'),
(2, 'About', 'Cras est nulla, lobortis vitae dui et, pellentesque euismod tortor. Pellentesque eu laoreet elit. Aenean nec magna id augue vestibulum imperdiet at quis nibh. Mauris rutrum ipsum ante, at vestibulum nisl iaculis et. Suspendisse porttitor laoreet ultrices. Vestibulum interdum est ex, eu tempus ex condimentum quis. Morbi ut posuere sem. Sed et elementum turpis. Quisque vulputate id nulla non interdum. Maecenas bibendum nec erat id gravida. Duis sit amet arcu lobortis, vestibulum elit sit amet, tristique nunc. Aenean dapibus congue sollicitudin. Curabitur tincidunt metus a dui pretium, vitae ultrices leo euismod. Sed viverra ut neque in efficitur. Aliquam eu libero tincidunt eros sollicitudin ultrices feugiat vitae diam. In finibus nunc hendrerit nibh sodales, eu sollicitudin neque tincidunt.\r\n\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
