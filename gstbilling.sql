-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2017 at 01:28 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gstbilling`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `prevliges` varchar(200) NOT NULL,
  `lastlogin` bigint(20) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `fname`, `lname`, `email`, `password`, `fax`, `mobile`, `address`, `prevliges`, `lastlogin`, `modifieddate`, `status`) VALUES
(1, 'admin', 'Ritesh', 'Jain', 'info@sungoldenterprises.com', '21232f297a57a5a743894a0e4a801fc3', '1134461212', '9929668779', 'Vaishali Nagar , Jaipur', '1,2,3,4,5,6,7,8,9,10,11', 1499934339, '2009-12-10 16:59:31', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `client_id` int(11) NOT NULL,
  `client_firm_name` varchar(51) NOT NULL,
  `client_name` varchar(51) NOT NULL,
  `client_tin` varchar(51) NOT NULL,
  `client_role` varchar(51) NOT NULL,
  `client_address` text NOT NULL,
  `client_desc` text NOT NULL,
  `client_mobile` varchar(51) NOT NULL,
  `client_email` varchar(51) NOT NULL,
  `client_status` enum('A','I') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`client_id`, `client_firm_name`, `client_name`, `client_tin`, `client_role`, `client_address`, `client_desc`, `client_mobile`, `client_email`, `client_status`) VALUES
(1, 'Cash', '', '', '', '', '', '', '', 'A'),
(2, 'Sungold Enterprises', 'Vikas Jain', '08884057433', 'SELF', 'Plot No. 29 , Devanda Vatika , Maharana Pratap Road ,&nbsp;<span style="font-size: 10pt;">Panchyawala , Jaipur , Rajasthan</span>', '', '9782444999', 'vjain@gmail.com', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_direct_local_billing`
--

CREATE TABLE `tbl_direct_local_billing` (
  `direct_local_bill_id` int(11) NOT NULL,
  `direct_local_bill_number` int(11) NOT NULL,
  `direct_local_bill_description` text NOT NULL,
  `direct_local_bill_quantity` decimal(10,2) NOT NULL,
  `direct_local_bill_unit_price` decimal(10,2) NOT NULL,
  `direct_local_bill_total_amount` decimal(10,2) NOT NULL,
  `direct_local_bill_party_phone` int(11) NOT NULL,
  `direct_local_bill_party_name` varchar(51) NOT NULL,
  `direct_local_bill_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tin_sales`
--

CREATE TABLE `tbl_tin_sales` (
  `tin_sales_bill_id` int(11) NOT NULL,
  `tin_sales_bill_number` int(11) NOT NULL,
  `tin_sales_bill_description` text NOT NULL,
  `tin_sales_bill_quantity` decimal(10,2) NOT NULL,
  `tin_sales_bill_unit_price` decimal(10,2) NOT NULL,
  `tin_sales_bill_total_price` decimal(10,2) NOT NULL,
  `tin_sales_bill_cgst` decimal(10,2) NOT NULL,
  `tin_sales_bill_cgst_amount` decimal(10,2) NOT NULL,
  `tin_sales_bill_rgst` decimal(10,2) NOT NULL,
  `tin_sales_bill_rgst_amount` decimal(10,2) NOT NULL,
  `tin_sales_bill_total_amount` decimal(10,2) NOT NULL,
  `tin_sales_bill_party_id` int(11) NOT NULL,
  `tin_sales_bill_party_name` varchar(51) NOT NULL,
  `tin_sales_bill_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vat`
--

CREATE TABLE `tbl_vat` (
  `vat_id` int(11) NOT NULL,
  `vat_cat` varchar(51) NOT NULL,
  `vat_rate` int(11) NOT NULL,
  `vat_effective_date` date NOT NULL,
  `vat_status` enum('A','I') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vat`
--

INSERT INTO `tbl_vat` (`vat_id`, `vat_cat`, `vat_rate`, `vat_effective_date`, `vat_status`) VALUES
(1, 'dish1', 18, '2016-07-12', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email_address` (`email`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_direct_local_billing`
--
ALTER TABLE `tbl_direct_local_billing`
  ADD PRIMARY KEY (`direct_local_bill_id`);

--
-- Indexes for table `tbl_tin_sales`
--
ALTER TABLE `tbl_tin_sales`
  ADD PRIMARY KEY (`tin_sales_bill_id`);

--
-- Indexes for table `tbl_vat`
--
ALTER TABLE `tbl_vat`
  ADD PRIMARY KEY (`vat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `tbl_direct_local_billing`
--
ALTER TABLE `tbl_direct_local_billing`
  MODIFY `direct_local_bill_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_tin_sales`
--
ALTER TABLE `tbl_tin_sales`
  MODIFY `tin_sales_bill_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_vat`
--
ALTER TABLE `tbl_vat`
  MODIFY `vat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
