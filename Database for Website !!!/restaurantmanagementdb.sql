-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2022 at 06:11 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantmanagementdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `category`, `registertime`) VALUES
(3, 'Main-Dish', '2022-02-16 10:33:25'),
(4, 'Side-Dish', '2022-02-16 10:33:30'),
(7, 'Dessert', '2022-03-20 14:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentid` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `commentdate` date NOT NULL,
  `commenttime` time NOT NULL,
  `customerid` varchar(20) NOT NULL,
  `menuid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentid`, `comment`, `commentdate`, `commenttime`, `customerid`, `menuid`) VALUES
('C-000001', 'Great Taste', '2022-04-02', '10:55:00', 'CU-000002', 'M-000003'),
('C-000002', 'Tasty & Many Amount', '2022-04-02', '11:40:00', 'CU-000002', 'M-000003'),
('C-000003', 'Food Decoration is Excellent', '2022-04-02', '12:31:00', 'CU-000004', 'M-000003'),
('C-000004', 'Nice & Great Taste. Smell is also Great. Looks Delicious. I always want to eat this Menu Again & Again.', '2022-04-03', '19:41:00', 'CU-000003', 'M-000002'),
('C-000005', 'Tasty & always wants to eat. Fresh & Food Service is great.', '2022-04-16', '17:41:00', 'CU-000004', 'M-000004');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `image` text NOT NULL,
  `password` varchar(30) NOT NULL,
  `customername` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `username`, `image`, `password`, `customername`, `email`, `phonenumber`, `registertime`) VALUES
('CU-000001', 'hla', 'customerphoto/_dawhla.jpg', '12345', 'Daw Hla', 'hla@gmail.com', '09789878675', '2022-04-02 10:30:50'),
('CU-000002', 'UHtay', 'customerphoto/_uhtay.jpg', '12345', 'U Htay', 'uhtay@gmail.com', '0965789345', '2022-04-14 14:59:29'),
('CU-000003', 'kaung myint', 'customerphoto/_kaungmyint.jpg', '12345', 'Kaung Myint', 'kaung@gmail.com', '0934567657', '2022-04-02 10:30:33'),
('CU-000004', 'ayehla', 'customerphoto/_ayehla.jpg', '12345', 'Aye Hla', 'ayehla@gmail.com', '11111111', '2022-04-02 10:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

CREATE TABLE `customerorder` (
  `orderid` varchar(20) NOT NULL,
  `orderdate` date NOT NULL,
  `ordertime` time NOT NULL,
  `totalquantity` int(11) NOT NULL,
  `totalamount` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `grandtotal` int(11) NOT NULL,
  `estimatereceivetime` time NOT NULL,
  `receivetime` time NOT NULL,
  `fulladdress` text NOT NULL,
  `cancel` varchar(15) NOT NULL,
  `discountid` int(11) NOT NULL,
  `customerid` varchar(20) NOT NULL,
  `paymenttype` varchar(15) DEFAULT NULL,
  `cardnumber` varchar(30) DEFAULT NULL,
  `deliveryscheduleid` varchar(20) DEFAULT NULL,
  `paymentstatus` varchar(15) NOT NULL,
  `deliverystatus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerorder`
--

INSERT INTO `customerorder` (`orderid`, `orderdate`, `ordertime`, `totalquantity`, `totalamount`, `tax`, `grandtotal`, `estimatereceivetime`, `receivetime`, `fulladdress`, `cancel`, `discountid`, `customerid`, `paymenttype`, `cardnumber`, `deliveryscheduleid`, `paymentstatus`, `deliverystatus`) VALUES
('CO-000001', '2022-03-16', '07:03:00', 2, 45000, 2250, 42750, '00:00:00', '17:11:00', 'Hlaing', 'No', 6, 'CU-000002', 'Cash', NULL, 'DS-000001', 'Confirmed', 'Delivered'),
('CO-000002', '2022-03-16', '10:46:00', 1, 30000, 1500, 28500, '08:22:00', '17:53:00', 'Hledan', 'No', 6, 'CU-000002', 'Cash', NULL, 'DS-000002', 'Confirmed', 'Delivered'),
('CO-000003', '2022-03-16', '18:03:00', 2, 100, 5, 95, '13:24:00', '17:54:00', 'Hlaing, Yangon', 'No', 6, 'CU-000002', 'Cash', NULL, 'DS-000002', 'Confirmed', 'Delivered'),
('CO-000004', '2022-04-03', '06:52:00', 5, 430, 22, 452, '00:00:00', '00:00:00', 'Hlaing', 'No', 1, 'CU-000002', 'Cash', NULL, 'DS-000001', 'Confirmed', 'Delivered'),
('CO-000005', '2022-04-05', '09:17:00', 4, 160, 8, 168, '15:00:00', '17:20:00', 'Hlaing', 'No', 1, 'CU-000003', 'Card', 'A23456YT', 'DS-000002', 'Confirmed', 'Delivered'),
('CO-000006', '2022-04-05', '09:27:00', 1, 50, 3, 53, '15:00:00', '09:31:00', 'Hlaing', 'No', 1, 'CU-000003', 'Cash', 'NULL', 'DS-000001', 'Confirmed', 'Delivered'),
('CO-000007', '2022-04-14', '18:57:00', 1, 50, 3, 53, '00:00:00', '00:00:00', 'Hlaing,Yangon', 'Yes', 1, 'CU-000002', 'Cash', 'NULL', NULL, 'Pending', 'Pending'),
('CO-000008', '2022-04-16', '17:10:00', 1, 100, 5, 105, '09:00:00', '17:38:00', 'Hlaing, Yangon', 'No', 1, 'CU-000004', 'Cash', 'NULL', 'DS-000001', 'Confirmed', 'Delivered'),
('CO-000009', '2022-04-24', '17:44:00', 2, 100, 5, 105, '13:00:00', '17:49:00', 'Hlaing, Yangon', 'No', 1, 'CU-000002', 'Cash', 'NULL', 'DS-000001', 'Confirmed', 'Delivered'),
('CO-000010', '2022-04-26', '15:59:00', 2, 100, 5, 105, '10:00:00', '16:04:00', 'Hlaing,Yangon', 'No', 1, 'CU-000002', 'Cash', 'NULL', 'DS-000002', 'Confirmed', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `customerorderdetail`
--

CREATE TABLE `customerorderdetail` (
  `orderid` varchar(20) NOT NULL,
  `menuid` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerorderdetail`
--

INSERT INTO `customerorderdetail` (`orderid`, `menuid`, `quantity`, `totalprice`) VALUES
('CO-000001', 'M-000002', 1, 15000),
('CO-000001', 'M-000001', 1, 30000),
('CO-000002', 'M-000001', 1, 30000),
('CO-000003', 'M-000003', 2, 100),
('CO-000004', 'M-000002', 4, 400),
('CO-000004', 'M-000004', 1, 30),
('CO-000005', 'M-000003', 2, 100),
('CO-000005', 'M-000004', 2, 60),
('CO-000006', 'M-000003', 1, 50),
('CO-000007', 'M-000003', 1, 50),
('CO-000008', 'M-000002', 1, 100),
('CO-000009', 'M-000003', 2, 100),
('CO-000010', 'M-000006', 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `deliveryschedule`
--

CREATE TABLE `deliveryschedule` (
  `deliveryscheduleid` varchar(15) NOT NULL,
  `depaturetime` time NOT NULL,
  `staffid` varchar(15) NOT NULL,
  `vehicleid` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliveryschedule`
--

INSERT INTO `deliveryschedule` (`deliveryscheduleid`, `depaturetime`, `staffid`, `vehicleid`, `status`) VALUES
('DS-000001', '07:00:00', 'S-000005', 'V-000002', 'Available'),
('DS-000002', '13:00:00', 'S-000004', 'V-000001', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discountid` int(11) NOT NULL,
  `discountname` varchar(30) NOT NULL,
  `percentage` int(11) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discountid`, `discountname`, `percentage`, `startdate`, `enddate`, `status`, `registertime`) VALUES
(1, 'No Discount', 0, NULL, NULL, 'Active', '2022-02-20 15:43:24'),
(6, '5% Discount', 5, '2022-04-01', '2022-04-30', 'InActive', '2022-04-13 16:04:34'),
(9, '20% Discount', 20, '2022-03-01', '2022-03-30', 'InActive', '2022-03-30 11:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuid` varchar(20) NOT NULL,
  `menuname` varchar(30) NOT NULL,
  `menuimage` text NOT NULL,
  `mainingredient` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `categoryid` int(11) NOT NULL,
  `regionid` int(11) NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuid`, `menuname`, `menuimage`, `mainingredient`, `price`, `description`, `categoryid`, `regionid`, `registertime`) VALUES
('M-000005', 'Cheese Cake', 'menuphoto/_cheesecake.jpg', 'Cheese', 15, 'Very Popular in American. Mainly made with cheese. ', 7, 12, '2022-04-26 08:36:35'),
('M-000006', 'Chicken Curry', 'menuphoto/_chickencurry.jpg', 'Chicken', 50, 'Based on the traditional foods of Myanmar. Improve the order with Indian Method.', 3, 5, '2022-04-26 08:38:48'),
('M-000003', 'Chicken Dumpling', 'menuphoto/_chickendumpling.jpg', 'Chicken', 50, 'Chicken Dumpling is the traditional foods from China. In China, there are a wide variety of Dumplings. They taste good & they are good for health.', 4, 9, '2022-03-20 15:02:06'),
('M-000002', 'Chicken Soup', 'menuphoto/_chickensoup.jpg', 'Chicken', 100, 'Best Choice for Light Weight Eaters. Include fair amount of chicken, noodles & vegetables. Great for Health. Include in Most Popular Menu of the Restaurant', 3, 9, '2022-03-20 12:45:34'),
('M-000001', 'Duck Soup', 'menuphoto/_ducksoup.jpg', 'Duck', 150, 'Traditional Chinese Food, Mix with great amount of vegetables including healthy vegetables like mushroom and others. It is quite popular in Chinese. ', 3, 9, '2022-03-20 12:43:52'),
('M-000004', 'Stawberry Ice-Cream', 'menuphoto/_stawberryicecream.jpg', 'Stawberry', 30, 'Favourite Dessert for Kids. Cover with Stawberry Flavour. Great Taste but no recommand for eating too much', 7, 7, '2022-03-20 16:52:10'),
('M-000007', 'Vegetable Stir Fri', 'menuphoto/_vegetablefry.jpg', 'Vegetables', 30, 'Mainly made with Vegetables. There is no meat involved therefore, vegetarians can also eat. ', 4, 9, '2022-04-26 08:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `regionid` int(11) NOT NULL,
  `region` varchar(30) NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`regionid`, `region`, `registertime`) VALUES
(5, 'Burmese', '2022-02-16 10:33:36'),
(6, 'Italian', '2022-02-16 10:33:42'),
(7, 'Thailand', '2022-02-16 10:50:48'),
(9, 'Chinese', '2022-03-04 15:50:39'),
(12, 'New York', '2022-04-26 08:36:22'),
(13, 'Spanish', '2022-04-26 13:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reserveid` varchar(30) NOT NULL,
  `reservedate` date NOT NULL,
  `reservetime` time NOT NULL,
  `arrivedate` date NOT NULL,
  `arrivetime` time NOT NULL,
  `finishtime` time NOT NULL,
  `numberofpeople` int(11) NOT NULL,
  `customerid` varchar(30) NOT NULL,
  `confirmbyrestaurant` varchar(20) NOT NULL,
  `confirmbycustomer` varchar(20) NOT NULL,
  `tableid` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reserveid`, `reservedate`, `reservetime`, `arrivedate`, `arrivetime`, `finishtime`, `numberofpeople`, `customerid`, `confirmbyrestaurant`, `confirmbycustomer`, `tableid`) VALUES
('RE-000001', '2022-02-27', '11:51:00', '2022-02-28', '19:00:00', '21:00:00', 10, 'CU-000002', 'Confirmed', 'Confirmed', 'TA-000007'),
('RE-000002', '2022-02-27', '12:23:00', '2022-02-28', '19:00:00', '21:00:00', 10, 'CU-000002', 'Confirmed', 'Confirmed', 'TA-000007'),
('RE-000003', '2022-02-27', '12:23:00', '2022-03-01', '17:00:00', '18:00:00', 10, 'CU-000002', 'Confirmed', 'Confirmed', 'TA-000007'),
('RE-000004', '2022-02-27', '12:23:00', '2022-02-28', '20:00:00', '22:00:00', 10, 'CU-000002', 'Confirmed', 'Confirmed', 'TA-000007'),
('RE-000005', '2022-03-05', '17:13:00', '2022-03-06', '19:00:00', '21:00:00', 4, 'CU-000002', 'Confirmed', 'Confirmed', 'TA-000001'),
('RE-000006', '2022-03-05', '17:46:00', '2022-03-06', '19:00:00', '21:00:00', 4, 'CU-000001', 'UnAvailable', 'Cancel', NULL),
('RE-000007', '2022-04-03', '19:35:00', '2022-04-10', '13:00:00', '15:00:00', 10, 'CU-000004', 'Confirmed', 'Confirmed', 'TA-000007'),
('RE-000008', '2022-04-05', '09:35:00', '2022-04-06', '17:00:00', '19:00:00', 4, 'CU-000002', 'Confirmed', 'Confirmed', 'TA-000001'),
('RE-000009', '2022-04-05', '13:15:00', '2022-04-06', '17:00:00', '20:00:00', 6, 'CU-000004', 'Confirmed', 'Confirmed', 'TA-000003'),
('RE-000010', '2022-04-05', '13:19:00', '2022-04-06', '17:00:00', '20:00:00', 6, 'CU-000003', 'Confirmed', 'Confirmed', 'TA-000010'),
('RE-000011', '2022-04-24', '17:17:00', '2022-04-25', '19:00:00', '21:00:00', 4, 'CU-000002', 'UnAvailable', 'Cancel', NULL),
('RE-000012', '2022-04-24', '17:42:00', '2022-04-26', '21:00:00', '22:12:00', 4, 'CU-000002', 'Confirmed', 'Confirmed', 'TA-000001'),
('RE-000013', '2022-04-26', '15:57:00', '2022-04-27', '20:00:00', '21:00:00', 4, 'CU-000002', 'Confirmed', 'Confirmed', 'TA-000006');

-- --------------------------------------------------------

--
-- Table structure for table `restauranttable`
--

CREATE TABLE `restauranttable` (
  `tableid` varchar(20) NOT NULL,
  `numberofchair` int(11) NOT NULL,
  `tabletypeid` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restauranttable`
--

INSERT INTO `restauranttable` (`tableid`, `numberofchair`, `tabletypeid`, `status`, `registertime`) VALUES
('TA-000001', 4, 1, 'Available', '2022-02-17 15:46:29'),
('TA-000002', 2, 1, 'Available', '2022-02-17 15:46:29'),
('TA-000003', 6, 2, 'Available', '2022-02-17 15:46:29'),
('TA-000004', 10, 2, 'Out Of Order', '2022-02-17 15:46:29'),
('TA-000005', 2, 1, 'Available', '2022-03-04 14:28:09'),
('TA-000006', 4, 2, 'Available', '2022-02-27 05:00:45'),
('TA-000007', 10, 4, 'Available', '2022-02-27 10:52:41'),
('TA-000008', 4, 2, 'Out Of Order', '2022-03-04 14:27:12'),
('TA-000009', 2, 1, 'Out Of Order', '2022-03-04 17:21:16'),
('TA-000010', 6, 2, 'Available', '2022-04-05 11:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` varchar(30) NOT NULL,
  `staffname` varchar(50) NOT NULL,
  `staffimage` text NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `dateofbirth` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `stafftypeid` int(11) NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `staffname`, `staffimage`, `phonenumber`, `dateofbirth`, `address`, `email`, `username`, `password`, `stafftypeid`, `registertime`) VALUES
('S-000001', 'Aye Aye', 'staffphoto/_ayeaye.jpg', '0976587646', '02/28/1985', 'Insein,Yangon', 'aye@gmail.com', 'ayeaye', '11111', 6, '2022-03-20 12:39:30'),
('S-000002', 'Kyaw Kyaw', 'staffphoto/_kyawkyaw.jpg', '0978987865', '02/17/1986', 'Insein,Yangon', 'kyaw@gmail.com', 'kyawkyaw', '12345', 1, '2022-03-20 12:40:35'),
('S-000003', 'Htay Htay', 'staffphoto/_htayhtay.jpeg', '0998978976', '02/24/2000', 'Taungyi', 'htay@gmail.com', 'htayhtay', '12345', 4, '2022-03-20 12:41:53'),
('S-000004', 'Tun Tun', 'staffphoto/_tuntun.jpg', '09756787646', '03/21/1990', 'Hlaing,Yangon', 'tun@gmail.com', 'tuntun', '12345', 2, '2022-03-21 17:29:36'),
('S-000005', 'Htun Htun', 'staffphoto/_htunhtun.jpg', '097898789657', '03/28/1945', 'Yangon', 'htun@gmail.com', 'htunhtun', '12345', 2, '2022-03-28 04:12:05'),
('S-000006', 'Kaung Htay', 'staffphoto/_kaunghtay.jpg', '0912345764', '04/03/1995', 'Yangon', 'kaunghtay@gmail.com', 'kaunghtay', '12345', 8, '2022-04-03 16:31:07'),
('S-000007', 'Hla Aye', 'staffphoto/_hlaaye.jpg', '098769876', '04/04/1968', 'Mandalay', 'hlaaye@gmail.com', 'hlaaye', '12345', 9, '2022-04-03 16:32:58'),
('S-000008', 'Htay Kyaw', 'staffphoto/_htaykyaw.png', '09786353388', '04/16/1995', 'Mandalay, Myanmar', 'htaykyaw@gmail.com', 'htay kyaw', '12345', 2, '2022-04-16 14:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `stafftype`
--

CREATE TABLE `stafftype` (
  `stafftypeid` int(11) NOT NULL,
  `stafftype` varchar(30) NOT NULL,
  `salary` int(11) NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stafftype`
--

INSERT INTO `stafftype` (`stafftypeid`, `stafftype`, `salary`, `registertime`) VALUES
(1, 'Restaurant Manager', 500, '2022-03-20 12:36:26'),
(2, 'Delivery Staff', 100, '2022-03-20 12:36:31'),
(4, 'Waiter', 100, '2022-03-20 12:36:37'),
(6, 'Delivery Branch Manager', 400, '2022-03-20 12:36:44'),
(8, 'Head Chef', 300, '2022-03-20 12:37:00'),
(9, 'Chef', 250, '2022-03-20 12:37:08'),
(10, 'Head Waiter', 200, '2022-03-31 05:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `tableorder`
--

CREATE TABLE `tableorder` (
  `tableorderid` varchar(20) NOT NULL,
  `orderdate` date NOT NULL,
  `totalquantity` int(11) NOT NULL,
  `totalamount` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `grandtotal` int(11) NOT NULL,
  `tableid` varchar(20) NOT NULL,
  `discountid` int(11) NOT NULL,
  `paymenttype` varchar(15) DEFAULT NULL,
  `cardnumber` varchar(30) DEFAULT NULL,
  `paymentstatus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tableorder`
--

INSERT INTO `tableorder` (`tableorderid`, `orderdate`, `totalquantity`, `totalamount`, `tax`, `grandtotal`, `tableid`, `discountid`, `paymenttype`, `cardnumber`, `paymentstatus`) VALUES
('TO-000001', '2022-03-14', 3, 60000, 3000, 57000, 'TA-000005', 6, 'Cash', NULL, 'Confirmed'),
('TO-000002', '2022-03-16', 1, 15000, 750, 14250, 'TA-000001', 6, 'Cash', NULL, 'Confirmed'),
('TO-000003', '2022-03-18', 1, 15000, 750, 14250, 'TA-000001', 6, 'Cash', NULL, 'Confirmed'),
('TO-000004', '2022-03-23', 3, 130, 7, 124, 'TA-000005', 6, 'Cash', NULL, 'Confirmed'),
('TO-000005', '2022-04-05', 1, 50, 3, 53, 'TA-000006', 1, 'Cash', 'NULL', 'Confirmed'),
('TO-000006', '2022-04-24', 1, 50, 3, 53, 'TA-000002', 1, 'Cash', 'NULL', 'Confirmed'),
('TO-000007', '2022-04-26', 1, 15, 1, 16, 'TA-000001', 1, 'Cash', 'NULL', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `tableorderdetail`
--

CREATE TABLE `tableorderdetail` (
  `tableorderid` varchar(20) NOT NULL,
  `menuid` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tableorderdetail`
--

INSERT INTO `tableorderdetail` (`tableorderid`, `menuid`, `quantity`, `totalprice`) VALUES
('TO-000001', 'M-000001', 1, 30000),
('TO-000001', 'M-000002', 2, 30000),
('TO-000002', 'M-000002', 1, 15000),
('TO-000003', 'M-000002', 1, 15000),
('TO-000004', 'M-000003', 2, 100),
('TO-000004', 'M-000004', 1, 30),
('TO-000005', 'M-000003', 1, 50),
('TO-000006', 'M-000003', 1, 50),
('TO-000007', 'M-000005', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tabletype`
--

CREATE TABLE `tabletype` (
  `tabletypeid` int(11) NOT NULL,
  `tabletype` varchar(20) DEFAULT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabletype`
--

INSERT INTO `tabletype` (`tabletypeid`, `tabletype`, `registertime`) VALUES
(1, 'Small Table', '2022-02-17 15:46:07'),
(2, 'Family Table', '2022-02-17 15:46:07'),
(4, 'Group Table', '2022-02-17 15:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleid` varchar(20) NOT NULL,
  `vehiclebrand` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `vehicletypeid` int(11) NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleid`, `vehiclebrand`, `model`, `status`, `vehicletypeid`, `registertime`) VALUES
('V-000001', 'Procaliber 9.6', '35113', 'Good', 1, '2022-03-20 12:48:32'),
('V-000002', 'Whistle', 'B-Rush C10.2', 'Good', 3, '2022-03-20 12:51:04'),
('V-000003', 'Procaliber 9.6', '35113', 'Good', 1, '2022-03-20 12:48:15'),
('V-000004', 'Procaliber 9.6', '35113', 'In Repair', 1, '2022-03-05 06:09:43'),
('V-000005', 'Whistle', 'B-Rush C10.2', 'Good', 3, '2022-03-20 12:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `vehicletype`
--

CREATE TABLE `vehicletype` (
  `vehicletypeid` int(11) NOT NULL,
  `vehicletype` varchar(30) NOT NULL,
  `registertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicletype`
--

INSERT INTO `vehicletype` (`vehicletypeid`, `vehicletype`, `registertime`) VALUES
(1, 'Bike', '2022-02-17 16:44:59'),
(3, 'Electric-Bike', '2022-02-17 16:45:08'),
(4, 'Scooter', '2022-03-05 04:52:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `deliveryschedule`
--
ALTER TABLE `deliveryschedule`
  ADD PRIMARY KEY (`deliveryscheduleid`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discountid`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuname`),
  ADD KEY `categoryid` (`categoryid`),
  ADD KEY `regionid` (`regionid`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`regionid`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reserveid`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `tableid` (`tableid`);

--
-- Indexes for table `restauranttable`
--
ALTER TABLE `restauranttable`
  ADD PRIMARY KEY (`tableid`),
  ADD KEY `tabletypeid` (`tabletypeid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`),
  ADD KEY `stafftypeid` (`stafftypeid`);

--
-- Indexes for table `stafftype`
--
ALTER TABLE `stafftype`
  ADD PRIMARY KEY (`stafftypeid`);

--
-- Indexes for table `tableorder`
--
ALTER TABLE `tableorder`
  ADD PRIMARY KEY (`tableorderid`);

--
-- Indexes for table `tabletype`
--
ALTER TABLE `tabletype`
  ADD PRIMARY KEY (`tabletypeid`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicleid`),
  ADD KEY `vehicletypeid` (`vehicletypeid`);

--
-- Indexes for table `vehicletype`
--
ALTER TABLE `vehicletype`
  ADD PRIMARY KEY (`vehicletypeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discountid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `regionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stafftype`
--
ALTER TABLE `stafftype`
  MODIFY `stafftypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tabletype`
--
ALTER TABLE `tabletype`
  MODIFY `tabletypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicletype`
--
ALTER TABLE `vehicletype`
  MODIFY `vehicletypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `category` (`categoryid`),
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`regionid`) REFERENCES `region` (`regionid`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`tableid`) REFERENCES `restauranttable` (`tableid`);

--
-- Constraints for table `restauranttable`
--
ALTER TABLE `restauranttable`
  ADD CONSTRAINT `restauranttable_ibfk_1` FOREIGN KEY (`tabletypeid`) REFERENCES `tabletype` (`tabletypeid`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`stafftypeid`) REFERENCES `stafftype` (`stafftypeid`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`vehicletypeid`) REFERENCES `vehicletype` (`vehicletypeid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
