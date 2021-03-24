-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 09:56 PM
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
(2, 'love this', 3, 'jrod', NULL, '2021-03-09 19:00:00');
INSERT INTO `comment` (`commentid`, `body`, `postid`, `username`, `parentid`, `commentdate`) VALUES
(3, 'this', 3, 'jrod', NULL, '2021-03-09 19:00:00');
INSERT INTO `comment` (`commentid`, `body`, `postid`, `username`, `parentid`, `commentdate`) VALUES
(4, 'YAAAA this', 3, 'jared', NULL, '2021-03-09 19:00:00');
INSERT INTO `comment` (`commentid`, `body`, `postid`, `username`, `parentid`, `commentdate`) VALUES
(5, 'love', 3, 'jrod', 2, '2021-03-09 19:00:00');
INSERT INTO `comment` (`commentid`, `body`, `postid`, `username`, `parentid`, `commentdate`) VALUES
(6, 'love hate', 3, 'jrod', 5, '2021-03-09 19:00:00');
INSERT INTO `comment` (`commentid`, `body`, `postid`, `username`, `parentid`, `commentdate`) VALUES
(7, 'Peace & Love', 3, 'jrod', 2, '2021-03-09 19:00:00');
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
(3, 'Is this working?', 'Yay this is working!', '2019-10-16 18:00:00', 'stupid', 'jared'),
(4, 'This is indiferent', 'aight', '2019-10-16 18:00:00', 'funny', 'jared'),
(5, 'This is the ultimate test lol', 'Eleifend placerat at, efficitur nec justo. Nam iaculis elit ut nisl cursus, eu sollicitudin tortor interdum. Vestibulum bibendum aliquam rutrum. Aenean eget dolor et neque blandit porta id nec sapien. Fusce sit amet quam euismod, placerat felis nec, congue justo. Quisque pharetra sapien a luctus rhoncus. Phasellus sollicitudin elit in lectus interdum dictum. Vestibulum eleifend sed ligula eu laoreet. Sed id ultrices metus. Nam convallis a turpis in mollis. Cras posuere finibus justo in dignissim. Curabitur nunc libero, convallis non nulla eu, gravida blandit tortor. Ut viverra convallis leo at mollis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla lacinia volutpat massa, non blandit augue interdum vitae. Proin quis massa libero. Donec finibus, est eu porta sollicitudin, massa turpis aliquam justo, vitae fermentum leo purus eu lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', '2019-10-17 05:45:11', 'funny', 'jrod');

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
('jrod', 'pass', 'jrock', 'hawk', 'fuck@gmail.com', '', 1);

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
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
