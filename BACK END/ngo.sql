-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2018 at 06:23 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngo`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `MyBeneficiary` (IN `username` VARCHAR(20))  NO SQL
SELECT * FROM beneficiary where tracker=(Select EID from login l where l.username= username)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MyDonation` (IN `username` VARCHAR(20))  NO SQL
SELECT * FROM donation where collected_by=(Select EID from login l where l.username= username)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MyEvents` (IN `username` VARCHAR(20))  NO SQL
SELECT * FROM event where manager=(Select EID from login l where l.username= username)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MyVolunteers` (IN `username` VARCHAR(20))  NO SQL
SELECT * FROM volunteer where guide=(Select EID from login l where l.username= username)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary`
--

CREATE TABLE `beneficiary` (
  `BID` int(11) NOT NULL,
  `bname` varchar(60) NOT NULL,
  `prob` varchar(100) NOT NULL,
  `contactno` varchar(16) DEFAULT NULL,
  `tracker` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=hp8;

--
-- Dumping data for table `beneficiary`
--

INSERT INTO `beneficiary` (`BID`, `bname`, `prob`, `contactno`, `tracker`) VALUES
(1, 'Sanskar Orphanage', 'abondoned children with no basic facilities', '23476809', 5),
(2, 'Ekta', '5 year old living in slum', '', 5),
(3, 'Mihir Roy', 'child labour to earn school fees', '', 5),
(4, 'Shristhi Home', 'ophanage for girls', '08026866700', 4),
(5, 'Sakara Home', 'orphanage for disabled children', '08025788569', 3),
(6, 'Shubh Homes', 'orphanage for kids', '08026511788', 6);

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `DID` int(11) NOT NULL,
  `dname` varchar(100) NOT NULL,
  `ddate` date NOT NULL,
  `amt` float NOT NULL,
  `paymode` varchar(40) NOT NULL,
  `contact_no` bigint(20) DEFAULT '0',
  `collected_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=hp8;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`DID`, `dname`, `ddate`, `amt`, `paymode`, `contact_no`, `collected_by`) VALUES
(1, 'Ruchi Mishra', '2018-11-09', 10000, 'Cash', 9877665434, 3),
(2, 'Amy Jackson', '2018-11-08', 2300, 'Cash', 7066554589, 4),
(3, 'Sameer ', '2018-11-22', 1500, 'Cash', 9877662345, 4),
(4, 'Ashley Rowan', '2018-11-16', 2000, 'Cash', 9877224597, 5),
(5, 'Puja Gupta', '2018-11-22', 2000, 'Cash', 9811661265, 5),
(6, 'Ram Krishna Mishra', '2018-11-29', 1500, 'Cash', 9866553486, 3),
(7, 'Kate Collins', '2018-10-09', 1000, 'Cash', 9766112453, 6),
(8, 'Anjali', '2018-12-01', 4000, 'Cash', 9778116524, 6);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `salary` float NOT NULL DEFAULT '0',
  `dob` date NOT NULL,
  `sex` varchar(6) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=hp8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EID`, `name`, `designation`, `salary`, `dob`, `sex`, `phone`, `address`, `age`) VALUES
(1, 'Alexander Martin', 'DBA', 90000, '1993-11-01', 'male', 9980793821, '#309,Golden Park Apartments,R.T Nagar,Bengaluru-76', 25),
(2, 'Anisha Thakur', 'Web Developer', 75000, '1995-02-08', 'female', 9970793818, '#432,6th Block,Koramangala,Bengaluru-95', 23),
(3, 'Ashtha Mishra', 'Manager', 90000, '1989-01-23', 'female', 8618266105, '#512, Park Street, Bengaluru-98', 29),
(4, 'Maya Kapoor', 'Child Counselor', 65000, '1993-07-12', 'female', 9611551278, '#311,Hyde Towers, Benagluru-34', 25),
(5, 'Mark Manson', 'H.R Manager', 75000, '1992-05-11', 'male', 9880578965, '#441,BEML Layout, Bengaluru-66', 26),
(6, 'Perry Matthew', 'Senior Consultant', 71000, '1985-07-12', 'male', 9811223465, '#321, Luna road, Bengaluru-73', 33),
(7, 'Jane Jackson', 'Legal Consultant', 60000, '1988-03-03', 'female', 9611661296, '#612, St.Marks Road, Bengaluru-77', 30);

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `AddAge` BEFORE INSERT ON `employee` FOR EACH ROW IF (NEW.dob is not NULL)
	Then SET NEW.age=TIMESTAMPDIFF(year,NEW.dob,curdate());
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateAge` BEFORE UPDATE ON `employee` FOR EACH ROW IF (NEW.dob is not NULL)
	Then SET NEW.age=TIMESTAMPDIFF(year,NEW.dob,curdate());
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EvID` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `manager` int(11) DEFAULT NULL,
  `edate` date NOT NULL,
  `stime` time NOT NULL,
  `venue` varchar(100) NOT NULL,
  `edescription` varchar(600) DEFAULT NULL,
  `sponsor` varchar(60) DEFAULT NULL,
  `funds` float NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=hp8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EvID`, `title`, `manager`, `edate`, `stime`, `venue`, `edescription`, `sponsor`, `funds`, `status`) VALUES
(1, 'Walkathon', 3, '2018-11-14', '06:30:00', 'Cubbon Park', '4KM walk till the main office to raise funds for underpriviled kids', 'CookieMan', 6000, 'complete'),
(2, 'Sandwich Seva', 3, '2018-11-02', '11:00:00', 'Cubbon Park', 'fireless cooking to prepare meals for poor kids', 'Mr.Brown ', 1000, 'complete'),
(3, 'BAKE-a-THON', 4, '2018-12-25', '16:00:00', 'Mahalaxmi Ground, opp Light of Hope office', 'a baking contest open to all.The baked items will be served to poor kids', 'Pillsbury', 0, 'pending'),
(4, 'Car Wash', 5, '2018-12-29', '08:30:00', 'Light of Hope office driveway', 'You will our driveway with sparkling cars in less than 30 mins', 'CarShine', 0, 'pending'),
(5, 'HotChocolate-Day!', 3, '2018-12-13', '04:30:00', 'Backyard, Light of Hope office', 'Come and enjoy the weather with the perfect beverage', 'Hershey Chocolates', 0, 'pending'),
(6, 'Buy-a-Sapling', 6, '2018-12-27', '09:00:00', 'Backyard,Light of Hope office', 'Take a little sapling to help build a child\'s future', '--', 0, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `involves`
--

CREATE TABLE `involves` (
  `EvID` int(11) NOT NULL,
  `VID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=hp8;

--
-- Dumping data for table `involves`
--

INSERT INTO `involves` (`EvID`, `VID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 4),
(2, 5),
(3, 2),
(3, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `EID` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `access_per` varchar(12) NOT NULL DEFAULT 'non-admin'
) ENGINE=InnoDB DEFAULT CHARSET=hp8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`EID`, `username`, `password`, `access_per`) VALUES
(1, 'alexmartin', 'alex1', 'admin'),
(2, 'anishathakur', 'anisha2', 'admin'),
(3, 'ashthamishra', 'ashtha3', 'non-admin'),
(4, 'mayakapoor', 'maya4', 'non-admin'),
(5, 'markmanson', 'mark5', 'non-admin'),
(6, 'perrymatthew', 'perry6', 'non-admin'),
(7, 'janejackson', 'jane7', 'non-admin');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `VID` int(11) NOT NULL,
  `vname` varchar(60) NOT NULL,
  `qualification` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phno` bigint(20) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `guide` int(11) DEFAULT NULL,
  `vage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=hp8;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`VID`, `vname`, `qualification`, `email`, `phno`, `addr`, `dob`, `gender`, `guide`, `vage`) VALUES
(1, 'Advaith Nair', '10 th Pass', 'advith.nair@gmail.com', 9822663452, 'C-1002, SJR Sanctity,Bengaluru-55', '2003-06-20', 'male', 2, 15),
(2, 'Utkarsh Mishra', '11th Pass', 'utkarsh.mishra@gmail.com', 9711553400, '#616,6th block,Koramangala,Bengauru-80', '2002-05-12', 'male', 4, 16),
(3, 'Ria Mishra', 'BBA student', 'ria.mishra@gmail.com', 9002387451, '#518, Janhavi Enclave, Bengaluru-76', '1997-01-23', 'female', 4, 21),
(4, 'Neha Thakur', 'Engineering student', 'neha.thakur@gmail.com', 8007858625, '#508,Janhavi Enclave,Bengaluru-76', '1996-02-07', 'female', 4, 22),
(5, 'Darshita Goyal', 'B.A student', 'darshita.goyal@gmail.com', 9880673426, '#510, Janhavi Enclave,Bengaluru-76', '1998-06-17', 'female', 5, 20),
(6, 'Dev Kushal', 'BBA student', 'dev.kushal@gmail.com', 9880579868, '#622, BEML, Bengaluru-88', '1997-06-27', 'male', 6, 21),
(7, 'Kate Collins', 'Engg student', 'kate.collins@yahoo.com', 9766112453, '#231, Green Heights, Bengaluru-65', '1997-10-09', 'female', 6, 21);

--
-- Triggers `volunteer`
--
DELIMITER $$
CREATE TRIGGER `AgeAdd` BEFORE INSERT ON `volunteer` FOR EACH ROW IF (NEW.dob is not NULL)
	Then SET NEW.vage=TIMESTAMPDIFF(year,NEW.dob,curdate());
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AgeUpdate` BEFORE UPDATE ON `volunteer` FOR EACH ROW IF (NEW.dob is not NULL)
	Then SET NEW.vage=TIMESTAMPDIFF(year,NEW.dob,curdate());
END IF
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beneficiary`
--
ALTER TABLE `beneficiary`
  ADD PRIMARY KEY (`BID`),
  ADD UNIQUE KEY `bname` (`bname`),
  ADD KEY `beneficiary_ibfk_1` (`tracker`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`DID`),
  ADD KEY `donation_ibfk_1` (`collected_by`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EvID`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `event_ibfk_1` (`manager`);

--
-- Indexes for table `involves`
--
ALTER TABLE `involves`
  ADD PRIMARY KEY (`EvID`,`VID`),
  ADD KEY `involves_ibfk_2` (`VID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`EID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`VID`),
  ADD KEY `guide` (`guide`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beneficiary`
--
ALTER TABLE `beneficiary`
  ADD CONSTRAINT `beneficiary_ibfk_1` FOREIGN KEY (`tracker`) REFERENCES `employee` (`EID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`collected_by`) REFERENCES `employee` (`EID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`manager`) REFERENCES `employee` (`EID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `involves`
--
ALTER TABLE `involves`
  ADD CONSTRAINT `involves_ibfk_1` FOREIGN KEY (`EvID`) REFERENCES `event` (`EvID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `involves_ibfk_2` FOREIGN KEY (`VID`) REFERENCES `volunteer` (`VID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`EID`) REFERENCES `employee` (`EID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`guide`) REFERENCES `employee` (`EID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
