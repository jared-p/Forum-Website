-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2021 at 05:42 AM
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
  `username` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentid`, `body`, `postid`, `username`) VALUES
(1, 'this is stupid', 1, 'jared'),
(2, 'love this', 3, 'jrod'),
(3, 'changed mind, love it', 1, 'jared');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `postdate` datetime NOT NULL,
  `topicName` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `title`, `body`, `postdate`, `topicName`, `username`) VALUES
(1, 'This is funny', 'fuck', '2019-10-16 18:00:00', 'funny', 'jrod'),
(2, 'This is stupid', 'testtt', '2019-10-16 18:00:00', 'stupid', 'jrod'),
(3, 'This is fail', 'trial', '2019-10-16 18:00:00', 'fail', 'jared'),
(4, 'This is indiferent', 'aight', '2019-10-16 18:00:00', 'funny', 'jared');

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
  `pic` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pass`, `firstName`, `lastName`, `email`, `pic`) VALUES
('jared', 'pass1', 'jrod', 'ded', 'fuck@gmail.com', ''),
('jrod', 'pass', 'jrock', 'hawk', 'fuck@gmail.com', '');

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
  ADD KEY `username` (`username`);

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
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
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
