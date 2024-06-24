-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 02:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicalsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `analyses`
--

CREATE TABLE `analyses` (
  `OrdonnanceID` int(11) NOT NULL,
  `ExamenID` int(11) NOT NULL,
  `typeAnalayses` varchar(2000) NOT NULL,
  `description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analyses`
--

INSERT INTO `analyses` (`OrdonnanceID`, `ExamenID`, `typeAnalayses`, `description`) VALUES
(4577002, 2, 'hjkjk', 'hjkhjkhjkhj'),
(4577018, 3, 'ahaze', 'qsdqlsld');

-- --------------------------------------------------------

--
-- Table structure for table `laboratoire`
--

CREATE TABLE `laboratoire` (
  `LaboratoireID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laboratoire`
--

INSERT INTO `laboratoire` (`LaboratoireID`, `Name`, `Address`, `PhoneNumber`, `Email`, `Password`) VALUES
(1, 'sdsd', 'sdsd', '45454', 'sdsd', 'sdsd'),
(2, 'kdha kdha', 'kdha kdha ', '02225', 'r@gmail.com', 'abc'),
(3, 'jjj', 'sadak', 'sdsd', 'testl@mail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `medcin`
--

CREATE TABLE `medcin` (
  `MedcinID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Specialty` varchar(100) DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `description` varchar(3000) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medcin`
--

INSERT INTO `medcin` (`MedcinID`, `Name`, `Specialty`, `location`, `PhoneNumber`, `description`, `Email`, `Password`) VALUES
(7777, 'hhhh', 'hhhh', '', '555', 'dfdsfdsfsdf', 'hay@mail.com', '123'),
(202420277, 'sdsd', 'sdsd', 'sdsd', 'sdsd', 'sdsdsd', 'sdsd', 'sdsd'),
(202420278, 'haythem', 'psy', 'rahmani', 'sdsdsd', 'sdsd', 'a@gmail.com', '123'),
(202420280, 'abd', 'psy', 'https://maps.app.goo.gl/5iwyw3a6evtnftPe8', '6544664', 'sdsdkl', 'abdo@gmail.com', '123'),
(202420281, 'abd', 'azea', 'https://maps.app.goo.gl/DvE7HqwsW3LVXUEe8', '4444', 'asjdfjsd', 'test@mail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `medicament`
--

CREATE TABLE `medicament` (
  `MedicamentID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `dosage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicament`
--

INSERT INTO `medicament` (`MedicamentID`, `Name`, `Description`, `dosage`) VALUES
(756, 'chmi3at\r\n', 'sdsd', 200),
(788, 'doliprane', 'dfdfdf', 500),
(1212, 'sdsd', 'sdsdsdsd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ordonnance`
--

CREATE TABLE `ordonnance` (
  `OrdonnanceID` int(222) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `MedcinID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordonnance`
--

INSERT INTO `ordonnance` (`OrdonnanceID`, `PatientID`, `MedcinID`, `Date`, `Type`) VALUES
(4576987, 89891, 7777, '2024-06-05', 'Type'),
(4576988, 89891, 7777, '2024-06-05', 'Type'),
(4576989, 89891, 7777, '2024-06-07', 'Type'),
(4576990, 89891, 7777, '2024-06-07', 'Type'),
(4576991, 89891, 7777, '2024-06-07', 'Type'),
(4576992, 89891, 7777, '2024-06-07', 'Type'),
(4576993, 89891, 7777, '2024-06-07', 'Type'),
(4576994, 89891, 7777, '2024-06-07', 'Type'),
(4576995, 89891, 7777, '2024-06-07', 'Type'),
(4576996, 89891, 7777, '2024-06-07', 'Type'),
(4576997, 89891, 7777, '2024-06-07', 'Type'),
(4576998, 89891, 7777, '2024-06-07', 'Type'),
(4576999, 89891, 7777, '2024-06-07', 'Type'),
(4577000, 89891, 7777, '2024-06-07', 'Type'),
(4577001, 89891, 7777, '2024-06-07', 'Type'),
(4577002, 89891, 7777, '2024-06-07', 'Type'),
(4577003, 89891, 7777, '2024-06-07', 'Type'),
(4577004, 89891, 7777, '2024-06-07', 'Type'),
(4577005, 89891, 7777, '2024-06-07', 'Type'),
(4577006, 89891, 7777, '2024-06-07', 'Type'),
(4577007, 89891, 7777, '2024-06-07', 'Type'),
(4577008, 89891, 7777, '2024-06-07', 'Type'),
(4577009, 89891, 7777, '2024-06-07', 'Type'),
(4577010, 89891, 7777, '2024-06-07', 'Type'),
(4577011, 89891, 7777, '2024-06-07', 'Type'),
(4577012, 89891, 7777, '2024-06-07', 'Type'),
(4577013, 89891, 7777, '2024-06-07', 'Type'),
(4577014, 89891, 7777, '2024-06-07', 'Type'),
(4577015, 89891, 202420278, '2024-06-19', 'Type'),
(4577016, 89891, 202420278, '2024-06-19', 'Type'),
(4577017, 89891, 202420281, '2024-06-24', 'Type'),
(4577018, 89891, 202420281, '2024-06-24', 'Type'),
(4577019, 89891, 202420281, '2024-06-24', 'Type'),
(4577020, 89891, 202420281, '2024-06-24', 'Type'),
(4577021, 89891, 202420281, '2024-06-24', 'Type'),
(4577022, 89891, 202420281, '2024-06-24', 'Type');

-- --------------------------------------------------------

--
-- Table structure for table `ordonnancemedicament`
--

CREATE TABLE `ordonnancemedicament` (
  `OrdonnanceID` int(11) NOT NULL,
  `MedicamentID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordonnancemedicament`
--

INSERT INTO `ordonnancemedicament` (`OrdonnanceID`, `MedicamentID`, `Quantity`, `description`) VALUES
(4576987, 788, 74575, 'description'),
(4577020, 756, 22, 'description'),
(4577020, 788, 48546, 'description'),
(4577020, 1212, 456, 'description');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `Name`, `Birthdate`, `Address`, `PhoneNumber`, `Email`, `Password`) VALUES
(89891, 'abdo ', '2001-01-05', 'dsfsd', '75757', 'abdo@mail.com', '123'),
(89892, 'sdfds', '2024-05-03', 'dsfdsf', 'sdfdsf', 'abd@mail.com', '123'),
(89893, 'ghyuyu', '2024-05-08', 'iuui', '555', 'abdelheqr@gmail.com', '123'),
(89894, 'rrr', '2024-05-01', 'dsfdsf', 'sdfdsf', 'abdm@mail.com', '123'),
(89895, 'gdfgdfg', '2024-06-06', 'sqsd', 'qsqdqs', 'abc@g.c', '111'),
(89896, 'haythe', '2024-05-29', 'sqkdklqsd', 'skjdkjsdf', 'testp@mail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacie`
--

CREATE TABLE `pharmacie` (
  `PharmacieID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacie`
--

INSERT INTO `pharmacie` (`PharmacieID`, `Name`, `Address`, `PhoneNumber`, `Email`, `Password`) VALUES
(111, 'nfidsa', 'el karmia chlef ', '555', 'abdaka@gmail.com', '123'),
(115, 'Noor', 'https://maps.app.goo.gl/wUeCbAexhZ3MpoXc8', 'sdfsdf', 'sdfsdf', 'sdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `rapport`
--

CREATE TABLE `rapport` (
  `OrdonnanceID` int(11) NOT NULL,
  `RapportID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rapport`
--

INSERT INTO `rapport` (`OrdonnanceID`, `RapportID`, `title`, `description`, `file`) VALUES
(4577001, 18, 'dfdfds', 'fdsfds', NULL),
(4577007, 19, 'sdsd', 'sdsd', 0x34),
(4577008, 20, 'dsfsdf', 'sdfsdf', 0x6466736466),
(4577009, 21, 'dsfsdf', 'sdfsdf', 0x6466736466),
(4577010, 22, 'dfdf', 'dfdf', 0x6466736466),
(4577011, 23, 'sdsd', 'sdsd', 0x73647364),
(4577012, 24, 'sdsd', 'sdsd', 0x73647364),
(4577013, 25, 'sdsd', 'sdsd', 0x73647364);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analyses`
--
ALTER TABLE `analyses`
  ADD PRIMARY KEY (`OrdonnanceID`,`ExamenID`),
  ADD UNIQUE KEY `ExamenID` (`ExamenID`);

--
-- Indexes for table `laboratoire`
--
ALTER TABLE `laboratoire`
  ADD PRIMARY KEY (`LaboratoireID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `medcin`
--
ALTER TABLE `medcin`
  ADD PRIMARY KEY (`MedcinID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`MedicamentID`);

--
-- Indexes for table `ordonnance`
--
ALTER TABLE `ordonnance`
  ADD PRIMARY KEY (`OrdonnanceID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `MedcinID` (`MedcinID`);

--
-- Indexes for table `ordonnancemedicament`
--
ALTER TABLE `ordonnancemedicament`
  ADD PRIMARY KEY (`OrdonnanceID`,`MedicamentID`),
  ADD KEY `MedicamentID` (`MedicamentID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PatientID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `pharmacie`
--
ALTER TABLE `pharmacie`
  ADD PRIMARY KEY (`PharmacieID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `rapport`
--
ALTER TABLE `rapport`
  ADD PRIMARY KEY (`RapportID`),
  ADD KEY `OrdonnanceID` (`OrdonnanceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analyses`
--
ALTER TABLE `analyses`
  MODIFY `ExamenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laboratoire`
--
ALTER TABLE `laboratoire`
  MODIFY `LaboratoireID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medcin`
--
ALTER TABLE `medcin`
  MODIFY `MedcinID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202420282;

--
-- AUTO_INCREMENT for table `medicament`
--
ALTER TABLE `medicament`
  MODIFY `MedicamentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1213;

--
-- AUTO_INCREMENT for table `ordonnance`
--
ALTER TABLE `ordonnance`
  MODIFY `OrdonnanceID` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4577023;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89897;

--
-- AUTO_INCREMENT for table `pharmacie`
--
ALTER TABLE `pharmacie`
  MODIFY `PharmacieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `rapport`
--
ALTER TABLE `rapport`
  MODIFY `RapportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analyses`
--
ALTER TABLE `analyses`
  ADD CONSTRAINT `analyses_ibfk_1` FOREIGN KEY (`OrdonnanceID`) REFERENCES `ordonnance` (`OrdonnanceID`);

--
-- Constraints for table `ordonnance`
--
ALTER TABLE `ordonnance`
  ADD CONSTRAINT `ordonnance_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`),
  ADD CONSTRAINT `ordonnance_ibfk_2` FOREIGN KEY (`MedcinID`) REFERENCES `medcin` (`MedcinID`);

--
-- Constraints for table `ordonnancemedicament`
--
ALTER TABLE `ordonnancemedicament`
  ADD CONSTRAINT `ordonnancemedicament_ibfk_1` FOREIGN KEY (`OrdonnanceID`) REFERENCES `ordonnance` (`OrdonnanceID`),
  ADD CONSTRAINT `ordonnancemedicament_ibfk_2` FOREIGN KEY (`MedicamentID`) REFERENCES `medicament` (`MedicamentID`);

--
-- Constraints for table `rapport`
--
ALTER TABLE `rapport`
  ADD CONSTRAINT `rapport_ibfk_1` FOREIGN KEY (`OrdonnanceID`) REFERENCES `ordonnance` (`OrdonnanceID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
