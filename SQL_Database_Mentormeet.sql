-- This database will be used for managing faculty-student appointments.  
-- Since we are adapting a Doctor-to-Patient Appointment Management System for this project,  
-- Due to limited time, the Doctor table is used to represent Faculty, and the Patient table is used to represent Students.  


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Table structure for table `admin`

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aemail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@mentormeet.com', '12345');

-- Table structure for table `appointment`

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appoid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(10) DEFAULT NULL,
  `apponum` int(3) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL,
  PRIMARY KEY (`appoid`),
  KEY `pid` (`pid`),
  KEY `scheduleid` (`scheduleid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table `appointment`

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`) VALUES
(1, 1, 1, 1, '2025-01-25');


DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `docid` int(11) NOT NULL AUTO_INCREMENT,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL,
  PRIMARY KEY (`docid`),
  KEY `specialties` (`specialties`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
(1, 'mahadi@gmail.com', 'Md Mahadi Hasan', 'cse2291', '41220300200', '01798432126', 1);

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pemail` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) DEFAULT NULL,
  `pnic` varchar(15) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
(1, 'student@mentormeet.com', 'Test Student', '123', 'Bangladesh', '4123020040', '2000-01-01', '0120000000'),
(2, 'sohelrana@gmail.com', 'Sohel Rana', '123', 'Bangladesh', '41220300573', '2001-05-08', '0700000000'),
(3, 'mohaimin@gmail.com', 'Mohaimin', '123', 'Dhaka, Bangladesh', '41230100733', '2002-05-15', '0170000000');

-- Table structure for table `schedule`

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `scheduleid` int(11) NOT NULL AUTO_INCREMENT,
  `docid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL,
  PRIMARY KEY (`scheduleid`),
  KEY `docid` (`docid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table `schedule`

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`) VALUES
(1, '2', 'CSE-2291 VIVA', '2025-01-30', '10:00:00', 6);

-- Table structure for table `specialties`

DROP TABLE IF EXISTS `specialties`;
CREATE TABLE IF NOT EXISTS `specialties` (
  `id` int(2) NOT NULL,
  `sname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table `specialties`


INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'Software Development'),
(2, 'Data Structure'),
(3, 'Algorithm'),
(4, 'Data Communication'),
(5, 'Database'),
(6, 'Data Structures and Algorithms'),
(7, 'Operating Systems'),
(8, 'Database Management Systems'),
(9, 'Computer Networks'),
(10, 'Software Engineering'),
(11, 'Artificial Intelligence'),
(12, 'Machine Learning'),
(13, 'Deep Learning'),
(14, 'Cybersecurity'),
(15, 'Web Development'),
(16, 'Mobile Application Development'),
(17, 'Cloud Computing'),
(18, 'Blockchain Technology'),
(19, 'Internet of Things (IoT)'),
(20, 'Distributed Systems'),
(21, 'Theory of Computation'),
(22, 'Big Data Analytics'),
(23, 'Information Security'),
(24, 'Programming Languages - Python'),
(25, 'Programming Languages - Java'),
(26, 'Programming Languages - C++'),
(27, 'Programming Languages - JavaScript'),
(28, 'English Literature'),
(29, 'History'),
(30, 'Economics'),
(31, 'Statistics'),
(32, 'Philosophy'),
(33, 'Psychology'),
(34, 'Sociology'),
(35, 'Anthropology'),
(36, 'Environmental Science'),
(37, 'Business Studies'),
(38, 'Finance'),
(39, 'Law'),
(40, 'Education - Primary'),
(41, 'Education - Secondary'),
(42, 'Linguistics'),
(43, 'Arts - Fine Arts'),
(44, 'Music'),
(45, 'Astronomy'),
(46, 'Data Science'),
(47, 'Human-Computer Interaction'),
(48, 'Software Testing and Quality Assurance'),
(49, 'Bioinformatics Computing'),
(50, 'Ethical Hacking');

-- Table structure for table `webuser`

DROP TABLE IF EXISTS `webuser`;
CREATE TABLE IF NOT EXISTS `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table `webuser`

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@mentormeet.com', 'a'),
('mahadi@gmail.com', 'd'),
('student@mentormeet.com', 'p'),
('sohelrana@gmail.com', 'p'),
('mohaimin@gmail.com', 'p');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;