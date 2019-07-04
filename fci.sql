-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2019 at 09:34 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fci`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `Name_Student` varchar(255) NOT NULL,
  `attendence_status` varchar(255) NOT NULL,
  `roll_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manage_class`
--

CREATE TABLE `manage_class` (
  `ID` int(11) NOT NULL,
  `ClassName` varchar(225) NOT NULL,
  `NumericName` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manage_class`
--

INSERT INTO `manage_class` (`ID`, `ClassName`, `NumericName`) VALUES
(9, 'one', 1),
(10, 'Two ', 2),
(11, 'Three', 3),
(12, 'Four', 4);

-- --------------------------------------------------------

--
-- Table structure for table `manage_section`
--

CREATE TABLE `manage_section` (
  `Sec_ID` int(11) NOT NULL,
  `Sec_Name` varchar(255) NOT NULL,
  `Teach_ID` int(11) NOT NULL,
  `Class_Sec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manage_section`
--

INSERT INTO `manage_section` (`Sec_ID`, `Sec_Name`, `Teach_ID`, `Class_Sec`) VALUES
(11, 'A', 8, 9),
(20, 'B', 10, 10),
(21, 'C', 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `manage_subject`
--

CREATE TABLE `manage_subject` (
  `Sub_ID` varchar(255) NOT NULL,
  `Sub_Name` varchar(255) NOT NULL,
  `Sub_Hour` int(11) NOT NULL,
  `Total_Mark` int(11) NOT NULL,
  `Teach_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manage_subject`
--

INSERT INTO `manage_subject` (`Sub_ID`, `Sub_Name`, `Sub_Hour`, `Total_Mark`, `Teach_ID`) VALUES
('CS110', 'Semiconductors', 3, 100, 9),
('CS111', 'Computer-Introduction', 3, 100, 8),
('CS131', 'Fundamentals-Programming', 3, 100, 8),
('CS132', 'Computer-Programming-1', 3, 100, 10),
('GN112', 'Fundamentals-Management', 3, 100, 9),
('GN170', 'English-Language-1', 3, 100, 11),
('GN180', 'Problem-Solving', 3, 100, 10),
('IS111', 'Introduction_IS', 3, 100, 9),
('IS212', 'System-Analysis&Design-1', 3, 100, 10),
('IS343', 'Is-Strategy&Managment&Acquisition', 3, 100, 8),
('IS373', 'E-Business', 3, 100, 10),
('IS449', 'EnterPrise-Architecture', 3, 100, 11),
('IT181', 'Introduction-to-Electronics', 3, 100, 11),
('MA111', 'Mathematics', 3, 100, 8),
('MA112', 'Mathematics-2', 3, 100, 9),
('OD111', 'Discrete-Mathematics', 3, 100, 11),
('ST190', 'Statics&Probabilities', 3, 100, 11);

-- --------------------------------------------------------

--
-- Table structure for table `manage_subject_four`
--

CREATE TABLE `manage_subject_four` (
  `Subj_Four_ID` varchar(255) NOT NULL,
  `Subj_Name` varchar(255) NOT NULL,
  `Subj_Hour` int(11) NOT NULL,
  `Subj_Mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_subject_four`
--

INSERT INTO `manage_subject_four` (`Subj_Four_ID`, `Subj_Name`, `Subj_Hour`, `Subj_Mark`) VALUES
('LP148', 'ZXBNMJ', 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `manage_subject_one`
--

CREATE TABLE `manage_subject_one` (
  `Subj_One_ID` varchar(255) NOT NULL,
  `Subj_Name` varchar(255) NOT NULL,
  `Teacher_Name` varchar(255) NOT NULL,
  `Subj_Hour` int(11) NOT NULL,
  `Subj_Mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manage_subject_one`
--

INSERT INTO `manage_subject_one` (`Subj_One_ID`, `Subj_Name`, `Teacher_Name`, `Subj_Hour`, `Subj_Mark`) VALUES
('CDD12', 'HJHOKPP', '', 3, 100),
('CS110', 'Semiconductors', '', 3, 100),
('CS111', 'Computer-Introduction', '', 3, 100),
('CS131', 'Fundamentals-Programming', '', 3, 100),
('Empty', 'Empty', '', 0, 0),
('GN112', 'Fundamentals-Management', '', 3, 100),
('GN170', 'English-Language-1', '', 3, 100),
('GN180', 'Problem-Solving', '', 3, 100),
('IS111', 'Introduction_IS', '', 3, 100),
('LDS124', 'LOPTREDF', '10', 3, 100),
('LU132', 'NLP', '8', 3, 100),
('MA111', 'Mathematics', '', 3, 100),
('OD111', 'Discrete-Mathematics', '', 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `manage_subject_three`
--

CREATE TABLE `manage_subject_three` (
  `Subj_Three_ID` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Subj_Name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Subj_Hour` int(11) NOT NULL,
  `Subj_Mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_subject_three`
--

INSERT INTO `manage_subject_three` (`Subj_Three_ID`, `Subj_Name`, `Subj_Hour`, `Subj_Mark`) VALUES
('BV123', 'MLJVBBC', 3, 100),
('GF325', 'MLOER', 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `manage_subject_two`
--

CREATE TABLE `manage_subject_two` (
  `Subj_Two_ID` varchar(255) NOT NULL,
  `Subj_Name` varchar(255) NOT NULL,
  `Subj_Hour` int(11) NOT NULL,
  `Subj_Mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manage_subject_two`
--

INSERT INTO `manage_subject_two` (`Subj_Two_ID`, `Subj_Name`, `Subj_Hour`, `Subj_Mark`) VALUES
('CS132', 'Computer-Programming-1', 3, 100),
('Empty', 'Empty', 0, 0),
('IS212', 'System-Analysis&Design-1', 3, 100),
('IS343', 'Is-Strategy&Managment&Acquisition', 3, 100),
('IS373', 'E-Business', 3, 100),
('IS449', 'EnterPrise-Architecture', 3, 100),
('IT181', 'Introduction-to-Electronics', 3, 100),
('MA112', 'Mathematics-2', 3, 100),
('ST190', 'Statics&Probabilities', 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `register_subject`
--

CREATE TABLE `register_subject` (
  `ID` int(11) NOT NULL,
  `Std_ID` int(11) NOT NULL,
  `Subject_ID` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Subject_ID_2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Degree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `User_Name` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `Semester` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Add_Date` date NOT NULL,
  `Observe` varchar(255) NOT NULL,
  `Contact` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `Register_Date` date NOT NULL,
  `Class_ID` int(11) NOT NULL,
  `Section_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_ID`, `Name`, `User_Name`, `Pass`, `Semester`, `Age`, `Add_Date`, `Observe`, `Contact`, `Email`, `Address`, `City`, `Country`, `Register_Date`, `Class_ID`, `Section_ID`, `User_ID`) VALUES
(12, 'Ahmed Ali Nabil', 'Ahmed', '8cb2237d0679ca88db6464eac60da96345513964', '1st', 20, '2019-05-19', '', 85556352, 'khaled@info.com', 'lopiuy', 'nuioyt', 'kiurt', '2019-03-11', 9, 11, 0),
(13, 'Hohsen Salah Fayed', 'Mohy', 'f350d780ea8aaa48030b4db64f790c14dbcd757f', '1st', 22, '2019-05-11', 'He IS a Good Boy', 346790, 'mohy@info.com', 'Shonshor', 'menofia', 'cairo', '2019-03-12', 9, 20, 0),
(25, 'Mohamed Tarek Yasen', 'Karmt', 'fc1200c7a7aa52109d762a9f005b149abef01479', '1st', 22, '2019-05-22', 'ejfevkrknv', 1244456965, 'kar@info.com', 'asder', 'qwer', 'yutr', '2019-03-14', 9, 20, 20),
(26, 'Ibrahim Mostafa Samy', 'ibrahim', 'd003eb01f6492f7429e2599c4d7961514cde0ce1', '1st', 20, '2019-06-21', '', 23457892, 'Ibra@info.com', 'Moiyt', 'Vrty', 'loputr', '2019-04-11', 9, 20, 0),
(27, 'Samy Reda Mohsen', 'Samy', '8cb2237d0679ca88db6464eac60da96345513964', '1st', 20, '2019-06-14', '', 2147483647, 'samy@info.com', 'mjtut', 'fmgk', 'irbjbjrg', '2019-04-24', 10, 20, 0),
(28, 'Ahmed Tawfik Serag', 'Ahmed', '2abd55e001c524cb2cf6300a89ca6366848a77d5', '1st', 22, '2019-06-05', '', 8666676, 'ahmed@info.com', 'kom', 'hamada', 'rigu', '2019-05-11', 10, 20, 0),
(29, 'Mosad Hassan Ehab', 'name', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1st', 20, '2019-06-17', '', 25545466, 'mogd@info.com', 'Cairo', 'tokyo', 'Qaluib', '2019-06-17', 11, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_payment`
--

CREATE TABLE `student_payment` (
  `Payment_ID` int(11) NOT NULL,
  `Class_Name` int(11) NOT NULL,
  `Section_Name` int(11) NOT NULL,
  `Student_Name` int(11) NOT NULL,
  `Payment_Name` varchar(255) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Total_Amount` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_payment`
--

INSERT INTO `student_payment` (`Payment_ID`, `Class_Name`, `Section_Name`, `Student_Name`, `Payment_Name`, `Start_Date`, `End_Date`, `Total_Amount`, `Status`) VALUES
(1, 9, 20, 13, '1000', '2019-06-16', '2019-06-28', 1000, 1),
(2, 9, 20, 25, 'Payment', '2019-06-23', '2019-06-30', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `Teacher_ID` int(11) NOT NULL,
  `Name` varchar(225) NOT NULL,
  `Age` int(11) NOT NULL,
  `Contact` int(11) NOT NULL,
  `Email` varchar(225) NOT NULL,
  `Address` varchar(225) NOT NULL,
  `City` varchar(225) NOT NULL,
  `Country` varchar(225) NOT NULL,
  `Register_Date` date NOT NULL,
  `Job_Type` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`Teacher_ID`, `Name`, `Age`, `Contact`, `Email`, `Address`, `City`, `Country`, `Register_Date`, `Job_Type`) VALUES
(8, 'Mohamed Samy Araby', 22, 1236456412, 'ahmed_talaat222@yahoo.com', 'khalafawy', 'nasar', 'cairo', '0000-00-00', '1'),
(9, 'Ahmed Ramy Sayed', 24, 1236456412, 'ahmed@info.com', 'khalafawy', 'mezalat', 'Europe', '0000-00-00', '2'),
(10, 'Samy Tolba Omar', 25, 315412121, 'samy@info.com', 'mioy', 'tiyt', 'chobra', '0000-00-00', '1'),
(11, 'Uioptr Mina', 36, 3654781, 'uo@info.com', 'lopiuy', 'poiyr', 'mkiuy', '0000-00-00', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '0',
  `TrustStatus` int(11) NOT NULL DEFAULT '0' COMMENT 'SellerRank',
  `RegStatus` int(11) NOT NULL DEFAULT '0' COMMENT 'User Approval',
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`) VALUES
(105, 'Mohamed', '601f1889667efaebb33b8c12572835da3f027f78', 'mohamedtal456@gmail.com', 'Mohamed Talaat', 1, 0, 0, '0000-00-00'),
(106, 'Hassan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'hassan@info.com', 'Hassan Tolba', 2, 0, 0, '0000-00-00'),
(107, 'Hatem', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'hatem@info.com', 'Hatem ElQshQr', 3, 0, 0, '0000-00-00'),
(108, 'Ahmed', '8cb2237d0679ca88db6464eac60da96345513964', 'khaled@info.com', 'Ahmed', 1, 0, 0, '0000-00-00'),
(109, 'Mohy', 'f350d780ea8aaa48030b4db64f790c14dbcd757f', 'mohy@info.com', 'Hohsen', 1, 0, 0, '0000-00-00'),
(121, 'Karmt', 'fc1200c7a7aa52109d762a9f005b149abef01479', 'kar@info.com', 'Mohamed', 1, 0, 0, '0000-00-00'),
(122, 'ibrahim', 'd003eb01f6492f7429e2599c4d7961514cde0ce1', 'Ibra@info.com', 'Ibrahim', 1, 0, 0, '0000-00-00'),
(123, 'Samy', '8cb2237d0679ca88db6464eac60da96345513964', 'samy@info.com', 'Samy', 1, 0, 0, '0000-00-00'),
(125, 'Ahmed123', '2abd55e001c524cb2cf6300a89ca6366848a77d5', 'ahmed@info.com', 'Ahmed', 1, 0, 0, '0000-00-00'),
(126, 'Hend123', '064e276c0732ca5fd2a82675ae1fbc2467e89d1e', 'hend@info.com', 'Hend', 1, 0, 0, '0000-00-00'),
(127, 'tarek123', '6643521711328a1e282daf5a5da43970eb11a089', 'tarek123@info.com', 'Tarek', 1, 0, 0, '0000-00-00'),
(128, 'emad123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'emad@info.com', 'Emad', 1, 0, 0, '0000-00-00'),
(129, 'sara123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sara@info.com', 'Sara', 1, 0, 0, '0000-00-00'),
(130, 'name', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mogd@info.com', 'Mosad', 1, 0, 0, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_class`
--
ALTER TABLE `manage_class`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `manage_section`
--
ALTER TABLE `manage_section`
  ADD PRIMARY KEY (`Sec_ID`),
  ADD KEY `teach_2` (`Teach_ID`),
  ADD KEY `class_section` (`Class_Sec`);

--
-- Indexes for table `manage_subject`
--
ALTER TABLE `manage_subject`
  ADD PRIMARY KEY (`Sub_ID`),
  ADD KEY `teach_1` (`Teach_ID`);

--
-- Indexes for table `manage_subject_four`
--
ALTER TABLE `manage_subject_four`
  ADD PRIMARY KEY (`Subj_Four_ID`);

--
-- Indexes for table `manage_subject_one`
--
ALTER TABLE `manage_subject_one`
  ADD PRIMARY KEY (`Subj_One_ID`);

--
-- Indexes for table `manage_subject_three`
--
ALTER TABLE `manage_subject_three`
  ADD PRIMARY KEY (`Subj_Three_ID`);

--
-- Indexes for table `manage_subject_two`
--
ALTER TABLE `manage_subject_two`
  ADD PRIMARY KEY (`Subj_Two_ID`);

--
-- Indexes for table `register_subject`
--
ALTER TABLE `register_subject`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `std_1` (`Std_ID`),
  ADD KEY `matsub_1` (`Subject_ID`),
  ADD KEY `reg_subj_2` (`Subject_ID_2`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_ID`),
  ADD KEY `section_1` (`Section_ID`),
  ADD KEY `class_1` (`Class_ID`);

--
-- Indexes for table `student_payment`
--
ALTER TABLE `student_payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `student_class` (`Class_Name`),
  ADD KEY `student_section` (`Section_Name`),
  ADD KEY `student_pay` (`Student_Name`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Teacher_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_class`
--
ALTER TABLE `manage_class`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `manage_section`
--
ALTER TABLE `manage_section`
  MODIFY `Sec_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `register_subject`
--
ALTER TABLE `register_subject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `student_payment`
--
ALTER TABLE `student_payment`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Teacher_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `manage_section`
--
ALTER TABLE `manage_section`
  ADD CONSTRAINT `class_section` FOREIGN KEY (`Class_Sec`) REFERENCES `manage_class` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teach_2` FOREIGN KEY (`Teach_ID`) REFERENCES `teacher` (`Teacher_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manage_subject`
--
ALTER TABLE `manage_subject`
  ADD CONSTRAINT `teach_1` FOREIGN KEY (`Teach_ID`) REFERENCES `teacher` (`Teacher_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `register_subject`
--
ALTER TABLE `register_subject`
  ADD CONSTRAINT `matsub_1` FOREIGN KEY (`Subject_ID`) REFERENCES `manage_subject_one` (`Subj_One_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reg_subj_2` FOREIGN KEY (`Subject_ID_2`) REFERENCES `manage_subject_two` (`Subj_Two_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `std_1` FOREIGN KEY (`Std_ID`) REFERENCES `student` (`Student_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `class_1` FOREIGN KEY (`Class_ID`) REFERENCES `manage_class` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `section_1` FOREIGN KEY (`Section_ID`) REFERENCES `manage_section` (`Sec_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_payment`
--
ALTER TABLE `student_payment`
  ADD CONSTRAINT `student_class` FOREIGN KEY (`Class_Name`) REFERENCES `manage_class` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_pay` FOREIGN KEY (`Student_Name`) REFERENCES `student` (`Student_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_section` FOREIGN KEY (`Section_Name`) REFERENCES `manage_section` (`Sec_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
