-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2017 at 04:13 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oj`
--

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `langid` int(11) UNSIGNED NOT NULL,
  `lname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`langid`, `lname`) VALUES
(1, 'cpp');

-- --------------------------------------------------------

--
-- Table structure for table `probdesc`
--

CREATE TABLE `probdesc` (
  `probid` int(11) UNSIGNED DEFAULT NULL,
  `body` text NOT NULL,
  `input` text NOT NULL,
  `output` text NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `probdesc`
--

INSERT INTO `probdesc` (`probid`, `body`, `input`, `output`, `note`) VALUES
(1, 'a+b', 'a+b', 'a+b', ''),
(2, 'This should contain body', 'This should contain input specification', 'This should contain output specification', '');

-- --------------------------------------------------------

--
-- Table structure for table `probio`
--

CREATE TABLE `probio` (
  `probid` int(11) UNSIGNED DEFAULT NULL,
  `inp` text NOT NULL,
  `outp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `probio`
--

INSERT INTO `probio` (`probid`, `inp`, `outp`) VALUES
(1, '1 2', '3'),
(2, 'This should contain sample input', 'This should contain sample output');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `probid` int(11) UNSIGNED NOT NULL,
  `userid` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `solved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`probid`, `userid`, `title`, `solved`) VALUES
(1, 3, 'a+b', 0),
(2, 3, 'arekta', 0);

-- --------------------------------------------------------

--
-- Table structure for table `problimit`
--

CREATE TABLE `problimit` (
  `probid` int(11) UNSIGNED DEFAULT NULL,
  `cpu` int(11) NOT NULL DEFAULT '1',
  `memory` int(11) NOT NULL DEFAULT '512',
  `source` int(11) NOT NULL DEFAULT '32'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problimit`
--

INSERT INTO `problimit` (`probid`, `cpu`, `memory`, `source`) VALUES
(1, 1, 512, 32),
(2, 1, 512, 32);

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `subid` int(11) UNSIGNED NOT NULL,
  `userid` int(11) UNSIGNED DEFAULT NULL,
  `probid` int(11) UNSIGNED DEFAULT NULL,
  `langid` int(11) UNSIGNED DEFAULT NULL,
  `verdict` int(11) NOT NULL,
  `soln` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`subid`, `userid`, `probid`, `langid`, `verdict`, `soln`, `fname`) VALUES
(1, 3, 1, 1, 0, '#incl', 'myFile'),
(2, 2, 1, 1, 0, '#incl', 'myFile'),
(8, 1, 2, 1, 0, '#include<bits/stdc++.h>\r\n\r\nusing namespace std;\r\n\r\n#define PB push_back\r\n#define MEM(n, val) memset(n, val, sizeof(n))\r\n#define FOR(i, j, k) for(int i = j; i <= k; i++)\r\n#define ROF(i, j, k) for(int i = j; i >= k; i--)\r\n#define LL long long\r\n#define F fir', 'hi'),
(9, 1, 2, 1, 0, '#include<bits/stdc++.h>\r\n\r\nusing namespace std;\r\n\r\n#define PB push_back\r\n#define MEM(n, val) memset(n, val, sizeof(n))\r\n#define FOR(i, j, k) for(int i = j; i <= k; i++)\r\n#define ROF(i, j, k) for(int i = j; i >= k; i--)\r\n#define LL long long\r\n#define F fir', 'file9'),
(10, 1, 2, 1, 0, '#include<bits/stdc++.h>\r\n\r\nusing namespace std;\r\n\r\n#define PB push_back\r\n#define MEM(n, val) memset(n, val, sizeof(n))\r\n#define FOR(i, j, k) for(int i = j; i <= k; i++)\r\n#define ROF(i, j, k) for(int i = j; i >= k; i--)\r\n#define LL long long\r\n#define F fir', 'file10'),
(11, 1, 2, 1, 0, '#include<bits/stdc++.h>\r\n\r\nusing namespace std;\r\n\r\n#define PB push_back\r\n#define MEM(n, val) memset(n, val, sizeof(n))\r\n#define FOR(i, j, k) for(int i = j; i <= k; i++)\r\n#define ROF(i, j, k) for(int i = j; i >= k; i--)\r\n#define LL long long\r\n#define F fir', 'file11'),
(12, 1, 1, 1, 0, '#include<bits/stdc++.h>\r\n\r\nusing namespace std;\r\n\r\n#define PB push_back\r\n#define MEM(n, val) memset(n, val, sizeof(n))\r\n#define FOR(i, j, k) for(int i = j; i <= k; i++)\r\n#define ROF(i, j, k) for(int i = j; i >= k; i--)\r\n#define LL long long\r\n#define F fir', 'file12'),
(13, 1, 1, 1, 0, '#include<bits/stdc++.h>\r\n\r\nusing namespace std;\r\n\r\n#define PB push_back\r\n#define MEM(n, val) memset(n, val, sizeof(n))\r\n#define FOR(i, j, k) for(int i = j; i <= k; i++)\r\n#define ROF(i, j, k) for(int i = j; i >= k; i--)\r\n#define LL long long\r\n#define F fir', 'file13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) UNSIGNED NOT NULL,
  `handle` varchar(20) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `solved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `handle`, `fname`, `lname`, `hash`, `email`, `status`, `solved`) VALUES
(1, 'rawn', 'Rawnak', 'Sarker', '$2y$10$ChIMRMFoEvK66LMCxV/.MOOWUbItIsjQ4OnoY4Vwi4cI/r7XAzS0K', 'eltonrawn@gmail.com', 4, 0),
(2, 'priya', 'Tahsina', 'Priya', '$2y$10$BtHxTt1v3Z4UBSjC1TgquOMqlDwnOAhXSWrgSJYcGRj654fAmUcXa', 'priya@gmail.com', 3, 0),
(3, 'elton', 'Elton', 'Rawn', '$2y$10$s6pdu9S1H6dUsRu2HQxHs.rYWtEoNbDhOA5Zg6ZuRyzuu2s7SKMWe', 'rawn@gmail.com', 2, 0),
(4, 'moka', 'Moka', 'Moka', '$2y$10$LzPK4TB2Od2u8iv4s2HABOrursugV.mLT8QVaTv4tGRkg.3BeWpay', 'moka@gmail.com', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`langid`),
  ADD UNIQUE KEY `lname` (`lname`);

--
-- Indexes for table `probdesc`
--
ALTER TABLE `probdesc`
  ADD UNIQUE KEY `probid` (`probid`);

--
-- Indexes for table `probio`
--
ALTER TABLE `probio`
  ADD KEY `probid` (`probid`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`probid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `problimit`
--
ALTER TABLE `problimit`
  ADD UNIQUE KEY `probid` (`probid`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`subid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `probid` (`probid`),
  ADD KEY `langid` (`langid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `handle` (`handle`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `langid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `probid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `subid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `probdesc`
--
ALTER TABLE `probdesc`
  ADD CONSTRAINT `probdesc_ibfk_1` FOREIGN KEY (`probid`) REFERENCES `problems` (`probid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `probio`
--
ALTER TABLE `probio`
  ADD CONSTRAINT `probio_ibfk_1` FOREIGN KEY (`probid`) REFERENCES `problems` (`probid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `problems_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `problimit`
--
ALTER TABLE `problimit`
  ADD CONSTRAINT `problimit_ibfk_1` FOREIGN KEY (`probid`) REFERENCES `problems` (`probid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `submission_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submission_ibfk_2` FOREIGN KEY (`probid`) REFERENCES `problems` (`probid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submission_ibfk_3` FOREIGN KEY (`langid`) REFERENCES `language` (`langid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
