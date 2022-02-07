-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2022 at 01:50 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(11) NOT NULL,
  `F_Name` varchar(255) DEFAULT NULL,
  `L_Name` varchar(255) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Phone_No` varchar(10) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Birth_Date` date DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `F_Name`, `L_Name`, `Gender`, `Phone_No`, `Email`, `Address`, `Birth_Date`, `Username`, `Password`) VALUES
(1, 'Abhishek', 'D', 'Male', '9739202870', 'abhishek@dummy.com', 'Bangalore', '2000-12-17', 'abhi9739', '9739');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_id` int(11) NOT NULL,
  `Salesman_id` int(11) DEFAULT NULL,
  `Customer_Name` varchar(255) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `S_P_Provided` varchar(255) DEFAULT NULL,
  `Phone_No` varchar(10) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Amount_Paid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_id`, `Salesman_id`, `Customer_Name`, `Gender`, `S_P_Provided`, `Phone_No`, `Email`, `Amount_Paid`) VALUES
(1, 11, NULL, 'male', '9876576809', NULL, NULL, NULL),
(2, 11, NULL, 'Male', '9876543897', NULL, NULL, NULL),
(3, 1, 'dummy', 'Male', 'Refrigerator', '9555586798', 'dumbo@gmail.com', 78999),
(4, 1, 'Abhishek D', 'Male', 'Refrigerator', '9739202870', 'abhishek95381@gmail.com', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Invoice_id` int(11) NOT NULL,
  `Customer_id` int(11) DEFAULT NULL,
  `Salesman_id` int(11) DEFAULT NULL,
  `Customer_Name` varchar(255) DEFAULT NULL,
  `Product_Name` varchar(255) NOT NULL,
  `Shipping_Date` date DEFAULT NULL,
  `Amount_Paid` int(11) DEFAULT NULL,
  `Phone_No` varchar(11) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Shipping_Address` varchar(255) DEFAULT NULL,
  `Payment_Status` varchar(255) DEFAULT NULL,
  `Processing_Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Invoice_id`, `Customer_id`, `Salesman_id`, `Customer_Name`, `Product_Name`, `Shipping_Date`, `Amount_Paid`, `Phone_No`, `Email`, `Shipping_Address`, `Payment_Status`, `Processing_Status`) VALUES
(1, 4, 1, 'dummy', 'Refrigerator', '2022-02-07', 890, '9876545678', 'dumbo@gmail.com', 'hi hi hi hi hi hi hi hi hi hi hihihi', 'Pending', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `Leads_id` int(11) NOT NULL,
  `Salesman_id` int(11) DEFAULT NULL,
  `Phone_No` varchar(11) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `P_S_Requested` varchar(255) DEFAULT NULL,
  `Priority` int(11) DEFAULT NULL,
  `FollowUp_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`Leads_id`, `Salesman_id`, `Phone_No`, `Name`, `P_S_Requested`, `Priority`, `FollowUp_Date`) VALUES
(16, 1, '9739202870', 'Abhishek', 'Refrigerator', 0, '2022-02-02'),
(17, 1, '8768756784', 'Jeff Winger', 'Refrigerator', 2, '2022-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Demand` varchar(10) DEFAULT NULL,
  `Units_is` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_id`, `Name`, `Price`, `Demand`, `Units_is`) VALUES
(1, 'Television', 80000, 'High', 5),
(2, 'Refrigerator', 45000, 'High', 3),
(3, 'Laptop', 65000, 'High', 5),
(4, 'SmartWatch', 3000, 'Medium', 2),
(5, 'Washing Machine', 45000, 'High', 10);

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `Salesman_id` int(11) NOT NULL,
  `F_Name` varchar(255) DEFAULT NULL,
  `L_Name` varchar(255) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Phone_No` varchar(10) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Branch` varchar(255) DEFAULT NULL,
  `Birth_Date` date DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`Salesman_id`, `F_Name`, `L_Name`, `Gender`, `Phone_No`, `Email`, `Address`, `Branch`, `Birth_Date`, `Username`, `Password`) VALUES
(1, 'Abhishek', 'D', 'Male', '9739202870', 'abhishek@dummy.com', 'Bangalore', 'BLR', '2000-12-17', 'abhishek95381', '95381'),
(11, 'Alison', 'Brie', 'Female', '9969696999', 'alison@community.com', NULL, NULL, NULL, 'alison69', 'jeff');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `Task_id` int(11) NOT NULL,
  `Salesman_id` int(11) DEFAULT NULL,
  `Customer_Name` varchar(255) DEFAULT NULL,
  `Notes` varchar(255) DEFAULT NULL,
  `Due_Date` date DEFAULT NULL,
  `Status` varchar(40) DEFAULT NULL,
  `Date_Created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`Task_id`, `Salesman_id`, `Customer_Name`, `Notes`, `Due_Date`, `Status`, `Date_Created`) VALUES
(1, 1, 'Abhishek', 'Do a follow up call', '2022-02-02', 'Pending', '2022-02-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_id`),
  ADD KEY `Salesman_id` (`Salesman_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Invoice_id`),
  ADD KEY `Customer_id` (`Customer_id`),
  ADD KEY `Salesman_id` (`Salesman_id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`Leads_id`),
  ADD KEY `Salesman_id` (`Salesman_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`Salesman_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`Task_id`),
  ADD KEY `Salesman_id` (`Salesman_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `Invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `Leads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `Salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `Task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`Salesman_id`) REFERENCES `salesman` (`Salesman_id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`Customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`Salesman_id`) REFERENCES `salesman` (`Salesman_id`) ON DELETE CASCADE;

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_ibfk_1` FOREIGN KEY (`Salesman_id`) REFERENCES `salesman` (`Salesman_id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`Salesman_id`) REFERENCES `salesman` (`Salesman_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
