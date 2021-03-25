-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2021 at 04:54 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(15) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `pass`) VALUES
('jared', '1'),
('jrock', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentid` int(11) NOT NULL,
  `body` varchar(400) NOT NULL,
  `postid` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `parentid` int(11) DEFAULT NULL,
  `commentdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentid`, `body`, `postid`, `username`, `parentid`, `commentdate`) VALUES
(2, 'love this', 3, 'jrod', NULL, '2021-03-09 19:00:00'),
(3, 'saasssssssssssssss', 3, 'jrod', NULL, '2021-03-09 19:00:00'),
(5, 'love', 3, 'jrod', 2, '2021-03-09 19:00:00'),
(6, 'love hate', 3, 'jrod', 5, '2021-03-09 19:00:00'),
(7, 'Peace & Love', 3, 'jrod', 2, '2021-03-09 19:00:00'),
(8, 'work', 3, 'jared', 6, '2021-03-24 23:45:09'),
(10, 'test', 3, 'jared', 8, '2021-03-24 23:58:27'),
(11, 'Neat idea', 3, 'jared', 8, '2021-03-25 00:22:17'),
(12, 'You\'re an idiot', 3, 'jared', 11, '2021-03-25 00:22:45'),
(14, 'hello?', 3, 'jared', 8, '2021-03-24 16:27:42'),
(19, 'nice work', 5, 'jared', NULL, '2021-03-24 16:33:43'),
(20, 'youre a fool', 5, 'jared', 19, '2021-03-24 16:34:01'),
(21, 'sda', 5, 'jared', NULL, '2021-03-24 17:37:35'),
(22, 'great work :)', 14, 'jared', NULL, '2021-03-24 18:30:08'),
(23, 'work', 14, 'jared', 22, '2021-03-24 18:31:17'),
(24, 'fd', 14, 'jared', 23, '2021-03-24 18:32:55'),
(25, 'This is sick', 14, 'jared', NULL, '2021-03-24 18:33:08'),
(26, 'No way!', 14, 'jared', 25, '2021-03-24 18:33:33'),
(27, 'sadsad', 49, 'jared', NULL, '2021-03-24 20:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `body` varchar(5000) NOT NULL,
  `postdate` datetime NOT NULL,
  `topicName` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `title`, `body`, `postdate`, `topicName`, `username`) VALUES
(2, 'This is stupid', 'testtt', '2019-10-16 18:00:00', 'stupid', 'jrod'),
(3, 'sdadsa', 'sdadsadsa', '2019-10-16 18:00:00', 'stupid', 'jared'),
(4, 'This is indiferent', 'aight', '2019-10-16 18:00:00', 'funny', 'jared'),
(5, 'This is the ultimate test lol', 'Eleifend placerat at, efficitur nec justo. Nam iaculis elit ut nisl cursus, eu sollicitudin tortor interdum. Vestibulum bibendum aliquam rutrum. Aenean eget dolor et neque blandit porta id nec sapien. Fusce sit amet quam euismod, placerat felis nec, congue justo. Quisque pharetra sapien a luctus rhoncus. Phasellus sollicitudin elit in lectus interdum dictum. Vestibulum eleifend sed ligula eu laoreet. Sed id ultrices metus. Nam convallis a turpis in mollis. Cras posuere finibus justo in dignissim. Curabitur nunc libero, convallis non nulla eu, gravida blandit tortor. Ut viverra convallis leo at mollis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla lacinia volutpat massa, non blandit augue interdum vitae. Proin quis massa libero. Donec finibus, est eu porta sollicitudin, massa turpis aliquam justo, vitae fermentum leo purus eu lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', '2019-10-17 05:45:11', 'funny', 'jrod'),
(6, 'Test', 'test                        ', '2021-03-24 18:24:38', 'stupid', 'jared'),
(7, 'am i working?', 'I hope so :?                        ', '2021-03-24 18:24:59', 'fail', 'jared'),
(8, 'am i working?', 'I hope so :?                        ', '2021-03-24 18:25:23', 'fail', 'jared'),
(9, 'am i working?', 'I hope so :?                        ', '2021-03-24 18:25:35', 'fail', 'jared'),
(10, 'is this working', 'Yes this is fortunately working :)                        ', '2021-03-24 18:25:53', 'fail', 'jared'),
(11, 'is this working', 'Yes this is fortunately working :)                        ', '2021-03-24 18:27:26', 'fail', 'jared'),
(12, 'is this working', 'Yes this is fortunately working :)                        ', '2021-03-24 18:29:02', 'fail', 'jared'),
(13, 'is this working', 'Yes this is fortunately working :)                        ', '2021-03-24 18:29:32', 'fail', 'jared'),
(14, 'I would like to create a post', 'I hope this works :)                        ', '2021-03-24 18:29:56', 'fail', 'jared'),
(15, 'sad', '                  asd      ', '2021-03-24 18:35:24', 'fail', 'jared'),
(16, 'sad', '                  asd      ', '2021-03-24 18:38:12', 'fail', 'jared'),
(17, 'sda', '              sadsa          ', '2021-03-24 18:38:16', 'fail', 'jared'),
(18, 'sda', '              sadsa          ', '2021-03-24 18:38:44', 'fail', 'jared'),
(19, 'dsa', '                     dsa   ', '2021-03-24 18:38:47', 'fail', 'jared'),
(20, 'dsa', '                     dsa   ', '2021-03-24 18:39:32', 'fail', 'jared'),
(21, 'sdaf', '                        fds', '2021-03-24 18:39:35', 'fail', 'jared'),
(22, 'frewg', '           rgegre             ', '2021-03-24 18:42:30', 'fail', 'jared'),
(23, 'frewg', '           rgegre             ', '2021-03-24 18:42:42', 'fail', 'jared'),
(24, 'this', 'sdasdadsa                        ', '2021-03-24 18:42:55', 'fail', 'jared'),
(25, 'thr', '                 ry       ', '2021-03-24 18:43:10', 'fail', 'jared'),
(26, 'dasd', '                 sad       ', '2021-03-24 18:43:38', 'fail', 'jared'),
(27, 'ds', '                 asda       ', '2021-03-24 18:43:41', 'fail', 'jared'),
(28, 'dsqw', '                        sda', '2021-03-24 18:44:16', 'fail', 'jared'),
(29, 'dsad', '                     dsada   ', '2021-03-24 18:46:27', 'fail', 'jared'),
(30, 'www', '           www             ', '2021-03-24 18:46:31', 'fail', 'jared'),
(31, 'www', '           www             ', '2021-03-24 18:47:45', 'fail', 'jared'),
(32, 'www', '           www             ', '2021-03-24 18:47:59', 'fail', 'jared'),
(33, 'www', '           www             ', '2021-03-24 18:48:13', 'fail', 'jared'),
(34, 'www', '           www             ', '2021-03-24 18:49:15', 'fail', 'jared'),
(35, 'www', '           www             ', '2021-03-24 18:50:35', 'fail', 'jared'),
(36, 'www', '           www             ', '2021-03-24 18:50:41', 'fail', 'jared'),
(37, 'www', '           www             ', '2021-03-24 18:52:49', 'fail', 'jared'),
(38, 'www', '                    www    ', '2021-03-24 18:52:52', 'fail', 'jared'),
(39, 'www', '                    www    ', '2021-03-24 18:53:49', 'fail', 'jared'),
(40, 'www', '                    www    ', '2021-03-24 18:54:13', 'fail', 'jared'),
(41, 'www', '                    www    ', '2021-03-24 18:54:53', 'fail', 'jared'),
(42, 'www', '                    www    ', '2021-03-24 18:55:03', 'fail', 'jared'),
(43, 'www', '                    www    ', '2021-03-24 18:55:43', 'fail', 'jared'),
(44, 'www', '                    www    ', '2021-03-24 18:55:58', 'fail', 'jared'),
(45, 'www', '                    www    ', '2021-03-24 19:16:30', 'fail', 'jared'),
(46, 'Jared', 'Test\r\n', '2021-03-24 20:17:58', 'stupid', 'jared'),
(47, 'Jared', 'Test\r\n', '2021-03-24 20:18:40', 'stupid', 'jared'),
(48, 'Jared', 'Test\r\n', '2021-03-24 20:19:15', 'stupid', 'jared'),
(49, 'sad', 'asdasdas', '2021-03-24 20:19:24', 'funny', 'jared');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `topicName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topicName`) VALUES
('fail'),
('funny'),
('stupid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(320) NOT NULL,
  `pic` blob NOT NULL,
  `disable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pass`, `firstName`, `lastName`, `email`, `pic`, `disable`) VALUES
('jared', 'pass1', 'jrod', 'ded', 'fuck@gmail.com', '', 0),
('jrod', 'pass', 'jrock', 'hawk', 'fuckinghell@gmail.com', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentid`),
  ADD KEY `postid` (`postid`),
  ADD KEY `username` (`username`),
  ADD KEY `parentid` (`parentid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `topicName` (`topicName`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topicName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `uniqueEmail` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `commentparentconstraint` FOREIGN KEY (`parentid`) REFERENCES `comment` (`commentid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postidconstraint` FOREIGN KEY (`postid`) REFERENCES `post` (`postid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usernameconstraint` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `topicName` FOREIGN KEY (`topicName`) REFERENCES `topic` (`topicName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
