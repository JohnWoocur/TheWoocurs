-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2020 at 11:24 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `woocur`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@mirabilis.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_user` varchar(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `bid` varchar(255) NOT NULL,
  `cover_letter` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `f_user`, `job_id`, `bid`, `cover_letter`, `status`, `duration`) VALUES
(1, '1', 1, '500', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 'completed', '2'),
(3, '1', 4, '2000', 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', '', '3'),
(4, '1', 5, '9003', 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', '', '2'),
(5, '3', 5, '8000', 'tttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt', 'completed', '1'),
(6, '1', 7, '200', 'I can do it as well as I will make it this happen! so please consider me', 'accepted', '2'),
(7, '1', 11, '4500', 'I would like to get this job I have experience in House Wiring and Electric works!!!', 'accepted', '2');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_sort` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `skill_sort`) VALUES
(1, 'Web Design'),
(2, 'Web Development'),
(3, 'SEO'),
(4, 'Full Stack Development'),
(5, 'Mobile Application Development'),
(7, 'Cloud computing'),
(9, 'Logo Making');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `date`) VALUES
(1, 'thanu', 'thanurajsivakumar@gmail.com', 'Hi hello', '0000-00-00 00:00:00'),
(2, 'mirabilis', 'mirabilis@gmail.com', 'hello', '0000-00-00 00:00:00'),
(3, 'woocur', 'woocur@mirabilis.com', 'testing purpose', '2020-06-22 18:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `skill` varchar(255) NOT NULL,
  `e_user` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `cost` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `f_user` int(11) NOT NULL,
  `file` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `place` varchar(255) NOT NULL,
  `payment` tinyint(1) NOT NULL,
  `payment_file` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `title`, `description`, `category`, `skill`, `e_user`, `date`, `cost`, `status`, `f_user`, `file`, `time`, `place`, `payment`, `payment_file`, `method`) VALUES
(1, 'web', 'Design', 'Web Design', 'HTML', '2', '2020-06-19', '5000', 'completed', 1, 'user_data/2020-06-17-21-44-43-kuruvi.png', '2020-07-13 18:36:50', 'Online', 1, 'user_data/2020-07-14-00-06-50-PHOTO.jpg', 'bank'),
(4, 'seo', 'hi', 'Web Design', 'internet', '2', '2020-06-23', '10001', 'Pending', 0, '', '2020-07-17 09:18:56', 'Ampara', 0, '', ''),
(5, 'seo', 'hello', 'SEO', 'internet', '2', '2020-07-03', '10003', 'completed', 3, 'user_data/2020-06-20-23-13-24-i4.jpg', '2020-07-13 18:05:46', 'Kilinochi', 1, '5642123', 'ezcash'),
(6, 'mirabilis', 'develop', 'Web Design', 'JavaScript', '2', '2020-06-22', '6000', 'Pending', 0, '', '2020-07-17 09:19:10', 'Kandy', 0, '', ''),
(7, 'mirabilis', 'kkkk', 'Web Design', 'Java', '2', '2020-06-29', '222', 'ongoing', 1, '', '2020-07-17 09:19:21', 'Ratnapura', 0, '', ''),
(9, 'SRM LOGO', 'Have to make logo and design as well as attractive and It should be in png format', 'Logo Making', 'Graphics Designing', '2', '2020-07-29', '2000', 'Pending', 0, '', '2020-06-30 16:20:03', 'Online', 0, '', ''),
(11, 'House Wiring', 'Have to complete the House wiring works', 'Cloud computing', 'Electrician', '4', '2020-07-10', '5000', 'ongoing', 1, '', '2020-07-20 09:23:07', 'Jaffna', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `members_request`
--

CREATE TABLE IF NOT EXISTS `members_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(255) NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `expertise_description` varchar(255) NOT NULL,
  `bid` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `members_request`
--

INSERT INTO `members_request` (`id`, `member_id`, `project_id`, `expertise_description`, `bid`, `status`, `duration`) VALUES
(1, '1', '3', 'hi hello everyone llllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll', '2500', 'completed', '2'),
(2, '3', '1', '111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111', '300', 'completed', '3'),
(3, '3', '4', 'gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', '400', 'accepted', '3'),
(4, '3', '7', 'I like to with you and your team and I have experience in Electrical wiring works for houses', '2000', '', '2'),
(5, '5', '7', 'I like this project and I have some skills to accomplish this task', '2000', 'accepted', '1');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender`, `receiver`, `message`, `timestamp`) VALUES
(1, '1', '2', 'Hi this is thanu, I want to hire you', '2020-06-22 18:24:02'),
(2, '1', '3', 'hi da ', '2020-06-22 18:40:31'),
(3, '2', '1', 'I am ready ok lets satrt', '2020-06-24 16:12:16'),
(4, '1', '2', 'so finally we are connected!\r\nhere is the work and schedule are you ok with this?', '2020-06-24 16:13:02'),
(5, '2', '1', 'yes sure', '2020-06-24 16:13:25'),
(8, '1', '2', 'ok done!', '2020-06-24 16:45:23'),
(9, '1', '2', 'ok bye!', '2020-06-24 16:53:27'),
(10, '1', '2', 'hahha\r\n', '2020-06-24 17:02:07'),
(11, '1', '2', 'why', '2020-06-24 17:02:54'),
(12, '1', '2', 'now alright', '2020-06-24 17:06:07'),
(13, '1', '2', 'second time', '2020-06-24 17:06:14'),
(14, '2', '1', 'third time', '2020-06-24 17:06:37'),
(15, '2', '1', 'fourth time', '2020-06-24 17:06:45'),
(16, '1', '2', 'okok', '2020-06-24 17:08:01'),
(17, '1', '3', 'hi This is thanuraj', '2020-06-25 10:40:43'),
(18, '1', '2', 'tc', '2020-06-25 10:46:36'),
(19, '1', '3', 'hello', '2020-06-25 10:48:31'),
(25, '1', '2', 'finally finished!', '2020-06-27 10:27:39'),
(26, '2', '1', '', '2020-07-03 14:32:45'),
(27, '2', '1', ' ', '2020-07-03 14:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_user` varchar(255) NOT NULL,
  `ezcash` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `ac_name` varchar(255) NOT NULL,
  `ac_no` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `f_user`, `ezcash`, `bank`, `ac_name`, `ac_no`) VALUES
(3, '1', '0772127086', 'HNB', 'Thanuraj S', '206020051248');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `skill` varchar(255) NOT NULL,
  `project_leader` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `cost` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `f_user` varchar(255) NOT NULL,
  `file` text NOT NULL,
  `payment` tinyint(1) NOT NULL,
  `place` varchar(255) NOT NULL,
  `payment_file` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `method` varchar(255) NOT NULL,
  `ref_job` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `title`, `description`, `category`, `skill`, `project_leader`, `date`, `cost`, `status`, `f_user`, `file`, `payment`, `place`, `payment_file`, `time`, `method`, `ref_job`) VALUES
(1, 'healthcare', 'hello', 'Web Design', 'Java', '1', '2020-07-11', '2220', 'completed', '3', 'user_data/2020-06-19-21-45-06-i1.jpg', 1, 'Online', 'user_data/2020-07-13-23-47-17-photo 2.jpg', '2020-07-16 10:16:03', 'bank', 'mirabilis'),
(3, 'seo', 'hi', 'SEO', 'internet', '3', '2020-07-21', '1111', 'completed', '1', 'user_data/2020-06-19-21-37-34-bannerH.jpg', 1, 'Kilinochi', '54658452125', '2020-07-17 09:25:40', 'ezcash', 'seo'),
(4, 'extreme', 'extreme', 'SEO', 'internet', '1', '2020-07-17', '500', 'ongoing', '3', '', 0, 'Online', '', '2020-07-16 13:56:35', '', 'web'),
(5, 'woocur', 'hi', 'SEO', 'internet', '1', '2020-07-01', '111', 'Pending', '', '', 0, 'Trincomalee', '', '2020-07-17 09:21:28', '', 'web'),
(7, 'wiring', 'Electrical Wiring works', 'Cloud computing', 'Electrician', '1', '2020-07-10', '2500', 'ongoing', '5', '', 0, 'Jaffna', '', '2020-07-05 12:50:49', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_id` varchar(255) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `f_id`, `u_id`, `rating`, `review`, `time`) VALUES
(1, '3', '1', 5, 'Good work!!!', '2020-06-23 08:01:30'),
(2, '3', '2', 3, 'satisfied, Job done!!!', '2020-06-23 08:18:45'),
(3, '3', '1', 2, 'third one!!!', '2020-06-23 10:31:51'),
(4, '3', '1', 2, 'not bad!', '2020-06-25 11:01:47'),
(5, '1', '1', 5, 'I have confidence!', '2020-06-25 16:33:00'),
(6, '1', '2', 5, 'All are ok!', '2020-06-27 10:47:21'),
(7, '1', '2', 2, 'ok!!', '2020-06-27 10:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `verification` tinyint(4) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `identy` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `address`, `email`, `contact`, `dob`, `gender`, `usertype`, `photo`, `verification`, `cv`, `identy`) VALUES
(1, 'thanu', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'kurumankadu,\r\nvavuniya', 'sivakumarthanuraj1@gmail.com', '772127086', '1995-10-29', 'male', 'freelancer', '', 1, 'user_data/2020-07-03-21-50-45-letter head.jpg', ''),
(2, 'raj', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'colombo', 'thanurajsivakumar@gmail.com', '701381932', '2000-01-01', 'male', 'client', 'user_images/2020-06-24-23-41-55-PASSPORT New.jpg', 1, '', ''),
(3, 'mirabilis', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'vavuniya', 'mirabilis@gmail.com', '772127086', '1995-05-02', 'female', 'freelancer', '', 0, 'user_data/2020-06-24-23-24-42-Letter Of Excellence - 2 years.pdf', ''),
(4, 'woocur', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 'woocur@mirabilis.com', '', '0000-00-00', '', 'client', 'user_images/2020-07-03-19-57-05-logo_png_Yxx_icon.ico', 0, '', 'user_data/2020-06-24-20-03-35-National Identity.jpg'),
(5, 'thanuvinu', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 'thanuvinu@gmail.com', '', '0000-00-00', '', 'freelancer', '', 0, '', 'user_data/2020-07-03-21-14-48-pink-hibiscus-flower-7595231.jpg'),
(6, 'thanuvinu1', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 'thanuvinu1@gmail.com', '', '0000-00-00', '', 'client', '', 0, '', 'user_data/2020-07-03-21-17-16-maxresdefault.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
