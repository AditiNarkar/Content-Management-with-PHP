-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 06:59 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `title`) VALUES
(1, 'Javascript'),
(2, 'Bootstrap'),
(3, 'PHP'),
(4, 'Node'),
(5, 'Java'),
(7, 'Python'),
(8, 'Ruby');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cmt_id` int(3) NOT NULL,
  `cmt_post_id` int(3) NOT NULL,
  `cmt_writer` varchar(20) NOT NULL,
  `cmt_email` varchar(50) NOT NULL,
  `cmt_content` text NOT NULL,
  `cmt_status` varchar(20) NOT NULL,
  `cmt_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cmt_id`, `cmt_post_id`, `cmt_writer`, `cmt_email`, `cmt_content`, `cmt_status`, `cmt_date`) VALUES
(9, 25, 'sansa', 'sansa@gmail.com', 'good', 'unapproved', '2021-08-08'),
(10, 24, 'adt', 'abc@gmail.com', 'DGI and Dawn did a very good job simplifying difficult material.', 'unapproved', '2021-08-08'),
(11, 15, 'theon', 'theon@greyjoy.com', 'amazing', 'unapproved', '2021-08-08'),
(12, 22, 'preet', 'preet@gmail.com', 'beautiful', 'approved', '2021-08-08'),
(13, 13, 'julia', 'julia@gamil.com', 'consistent', 'unapproved', '2021-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`id`, `session`, `time`) VALUES
(1, 'f09jn2baktlop1q6cv0o2upoqh', 1628531177),
(2, 'deofnp7hfp0uq8fl4ifcgk91e8', 1627924698);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(50) NOT NULL,
  `post_author` varchar(25) NOT NULL,
  `post_user` varchar(50) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(200) NOT NULL,
  `post_cmt_count` int(11) NOT NULL,
  `post_status` varchar(200) NOT NULL DEFAULT 'draft',
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_cmt_count`, `post_status`, `views`) VALUES
(6, 1, 'buffaloo university', 'raavy', 'riyon', '2021-08-08', 'image_4.jpg', 'The University at Buffalo offers superior academics, a life-changing student experience and true affordability.\r\n        ', 'buffalo', 0, 'draft', 0),
(12, 2, 'Kalindaa', 'jasmine', 'daisy', '2021-08-08', 'image_3.jpg', 'Kalinda university,Raipur has emerged as a Best Private University in Raipur, Chhattisgarh. Strategically located in the Smart City of New Raipur.', 'kalinda,jasmine', 4, 'draft', 0),
(13, 4, 'ABC company', 'rose', 'daisy', '2021-08-08', 'img3.png', 'Consultants is the pioneer of organized recruitment services in India hiring leaders for the leading organizations.', 'abc', 5, 'published', 6),
(14, 1, 'Javascript course', 'jasmine', 'adt', '2021-08-08', 'js_course.png', 'JavaScript for Beginners: University of California, Davis. HTML, CSS, and Javascript for Web Developers: Johns Hopkins University. Full-Stack Web Development with React: The Hong Kong University of Science and Technology. Web Design for Everybody: Basics of Web Development & Coding: University of Michigan.', 'javascript, web development', 0, 'draft', 0),
(15, 3, 'PHP course', 'Big Fat Rat', 'fukryy', '2021-08-08', 'php_course.jfif', 'Introduction to web application development. University of Michigan. Enroll! Univ. of Michigan Course. Build Web Applications. 100% Online Course. Finish in 4 Courses. Courses: Web Applications in PHP, Structured Query Language, Database Applications, JavaScript, jQuery.', 'PHP, course, Big Fat Rat', 4, 'published', 7),
(17, 4, 'TEST 1', '', 'daisy', '2021-08-08', 'image_1.jpg', 'The definition of a CMS is an application (more likely web-based), that provides capabilities for multiple users with different permission levels to manage (all or a section of) content, data or information of a website project, or internet / intranet application.', 'cms,test', 0, 'draft', 2),
(21, 4, 'TEST 2', '', 'dany', '2021-08-08', 'img5.jpg', 'A computing platform or digital platform is an environment in which a piece of software is executed. It may be the hardware or the operating system (OS), Provides information about storage systems, networks, servers, automated teller machines, scanners, micro devices, middleware and platform software.', 'cms,test', 0, 'published', 2),
(22, 2, 'TEST 3', '', 'sansa', '2021-08-08', 'img6.jfif', 'Photography is the art, application, and practice of creating durable images by recording light, either electronically by means of an image sensor, or chemically by means of a light-sensitive material such as photographic film. It is employed in many fields of science, manufacturing (e.g., photolithography), and business, as well as its more direct uses for art, film and video production, recreational purposes, hobby, and mass communication.', 'test3, scene', 1, 'published', 0),
(23, 7, 'Rubina Telefox', '', 'adt', '2021-08-09', '', 'Course of great help. amazing coordination of staffs and handling of team.', 'rubina, telefox, project', 0, 'draft', 0),
(24, 7, 'MEDIA Markt', '', 'daisy', '2021-08-09', 'media_markt.png', 'mediamart is one of the best known companies in Europe and is renowned for its attention-grabbing advertising. ', 'media markt, python, daisy', 1, 'draft', 0),
(25, 8, 'hanpass', '', 'adt', '2021-08-08', 'hanpass.png', 'Cash-back Event.Send money & Get Cash 10,000 KRW! For only those customers who receive a Secret Payback Event Coupon are eligible for this event.', 'hanpass', 1, 'published', 5),
(26, 2, 'SKILLshare', '', 'sansa', '2021-08-08', 'skillshare.png', 'Get Inspired and Move Your Creative Journey Forward. Get Access To Thousands of Inspiring Classes and the Support of a Creative Community. On-Demand. 8M+ students. Projects included. ', 'skillshare, sansa', 0, 'published', 0),
(27, 7, 'Redlands', '', 'adt', '2021-08-09', 'redlands.png', 'Redlands Ashlyn Group is headquartered in Thrissur, Kerala State, South India. In 1989.', 'redlands', 0, 'published', 0),
(30, 2, 'TEST 3', '', 'sansa', '2021-08-09', 'img6.jfif', 'Photography is the art, application, and practice of creating durable images by recording light, either electronically by means of an image sensor, or chemically by means of a light-sensitive material such as photographic film. It is employed in many fields of science, manufacturing (e.g., photolithography), and business, as well as its more direct uses for art, film and video production, recreational purposes, hobby, and mass communication.', 'test3, scene', 1, 'published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `user_image` text NOT NULL,
  `role` varchar(25) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`, `email`, `user_image`, `role`, `randSalt`, `token`) VALUES
(17, 'daisy', '$2y$10$iusesomecrazystrings2uQ4CTdPqdPbHofeg7lAuRDpzFUGwtLpK', '', '', 'daisy@yahoo.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', '0'),
(18, 'sansa', '2222', 'Sansa', 'Stark', 'sansa@stark.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', '0'),
(20, 'dany', '$2y$12$2bzXDTS./UJc6AAch1QkIeyibVNTn7hn6YJD5.CNcEBknUdEpnEMW', '', '', 'dany@targay.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', '0'),
(24, 'windy', '$2y$12$jAkvPAtaXF2rjZmAPTERuebPfs/IGQCnXckQReOJaMcJ7l/3Ts2si', '', '', 'windy@uhnj.com', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', '0'),
(25, 'julia', '$2y$12$wKhlyzJ3yH.HKqWS5fR7U.nKr2IuwcPbw93gnOMf//1dnz2xhx0RO', '', '', 'julia@uhy.com', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', '0'),
(26, 'theon', '$2y$12$E0hKjfdYIqRCWxaHcbHBMOgoUgjy1EjI9yT7eVQviyUP6IzpXrBwm', '', '', 'theon@greyjoy.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', ''),
(27, 'adt', '$2y$12$KzqzcmjSqC.fhSGm26wLKe14tDpupDLRTKIXGL6ruyqO71rXDOUPC', '', '', 'abc@gmail.com', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', ''),
(28, 'fukryy', '$2y$12$MX0M3T7TzOadntEjzCZU6.EFxtFSXLGFrPm.7pRERfI9fD8u2n2Gq', '', '', 'abc1@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', ''),
(30, 'manuu', '$2y$12$CnkXlSGhLrKvERhCL/25NuzPy5EcwJn4cGeO3bdV1XjRYdhlf4Vz6', '', '', 'abc3@gmail.com', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', ''),
(31, 'jon', '$2y$12$XgBfatDtnWWlt5i1pY2MGejN9ItysZ5dTeP7X/dQCZ/v3v.58FS26', 'jon', 'Pathew', 'jon@gmail.com', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', ''),
(32, 'riyon', '$2y$12$u6lg/383KIPOa8hvrDja8O7pD1Z4LZhxDoLv56cwiAERzKR10VG3q', '', '', 'riyon@uihy.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', ''),
(33, 'preet', '$2y$12$vOxq0jK/5jjji3hQ7T1B5uLR0sxKvOlYyTCdg7V3sKH.RFtbYSEg6', '', '', 'preet@gmail.com', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', ''),
(34, 'Kittoo', '$2y$12$mTPqlOfDbcIvCFn3UC7jo.gjH1eRMKsbAAoZnsnEl0kcIoVC8C/zO', '', '', 'kitto@gmailcom', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cmt_id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cmt_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
