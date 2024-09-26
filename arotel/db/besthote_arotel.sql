-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2024 at 12:00 PM
-- Server version: 5.7.44-log-cll-lve
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `besthote_arotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `client_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_tel` varchar(50) DEFAULT NULL,
  `customer_email` mediumtext,
  `how_to_know` varchar(100) DEFAULT NULL,
  `customer_address` mediumtext,
  `stat` varchar(3) DEFAULT NULL,
  `client_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn_details`
--

CREATE TABLE `tbl_grn_details` (
  `grn_detail_id` int(11) NOT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `grn_number` varchar(255) DEFAULT NULL,
  `goods_received_date` varchar(255) DEFAULT NULL,
  `note` mediumtext,
  `stat` varchar(3) DEFAULT NULL,
  `grn_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn_items`
--

CREATE TABLE `tbl_grn_items` (
  `grn_items_id` int(11) NOT NULL,
  `grn_detail_id` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `price_batch_id` varchar(255) DEFAULT NULL,
  `cost_price` varchar(255) DEFAULT NULL,
  `selling_price` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_save`
--

CREATE TABLE `tbl_invoice_save` (
  `invoice_save_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `labour_total` varchar(255) DEFAULT NULL,
  `item_total` varchar(255) DEFAULT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL,
  `pay` varchar(3) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `invoice_save_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `part_location` varchar(255) DEFAULT NULL,
  `part_number` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `stat` varchar(3) DEFAULT NULL,
  `item_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_price_batch`
--

CREATE TABLE `tbl_item_price_batch` (
  `price_batch_id` int(11) NOT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `grn` varchar(255) DEFAULT NULL,
  `cost_price` varchar(255) DEFAULT NULL,
  `selling_price` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `batch_label` varchar(255) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job`
--

CREATE TABLE `tbl_job` (
  `job_id` int(11) NOT NULL,
  `job_type` varchar(3) DEFAULT NULL,
  `user_id` varchar(3) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `job_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job`
--

INSERT INTO `tbl_job` (`job_id`, `job_type`, `user_id`, `stat`, `job_datetime`) VALUES
(1, '2', '1', '1', '2022-03-12 07:22:04'),
(2, '1', '1', '0', '2022-03-12 07:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_accessory_fault`
--

CREATE TABLE `tbl_job_accessory_fault` (
  `accessory_fault_id` int(11) NOT NULL,
  `job_details_id` varchar(255) DEFAULT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `battry` varchar(255) DEFAULT NULL,
  `charger` varchar(255) DEFAULT NULL,
  `hfree` varchar(255) DEFAULT NULL,
  `bcover` varchar(255) DEFAULT NULL,
  `sim` varchar(255) DEFAULT NULL,
  `msd` varchar(255) DEFAULT NULL,
  `bhf` varchar(255) DEFAULT NULL,
  `warrenty_card` varchar(255) DEFAULT NULL,
  `box` varchar(255) DEFAULT NULL,
  `power_fault` varchar(255) DEFAULT NULL,
  `display_fault` varchar(255) DEFAULT NULL,
  `keypad_fault` varchar(255) DEFAULT NULL,
  `audio_fault` varchar(255) DEFAULT NULL,
  `signal_fault` varchar(255) DEFAULT NULL,
  `charging_fault` varchar(255) DEFAULT NULL,
  `functionality_fault` varchar(255) DEFAULT NULL,
  `software_fault` varchar(255) DEFAULT NULL,
  `accessory_fault` varchar(255) DEFAULT NULL,
  `other_fault` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job_accessory_fault`
--

INSERT INTO `tbl_job_accessory_fault` (`accessory_fault_id`, `job_details_id`, `job_id`, `phone`, `battry`, `charger`, `hfree`, `bcover`, `sim`, `msd`, `bhf`, `warrenty_card`, `box`, `power_fault`, `display_fault`, `keypad_fault`, `audio_fault`, `signal_fault`, `charging_fault`, `functionality_fault`, `software_fault`, `accessory_fault`, `other_fault`) VALUES
(1, '1', '1', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'No', 'Yes', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_details`
--

CREATE TABLE `tbl_job_details` (
  `job_details_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_tel` varchar(50) DEFAULT NULL,
  `customer_email` mediumtext,
  `customer_address` mediumtext,
  `m_imei` varchar(255) DEFAULT NULL,
  `s_imei` varchar(255) DEFAULT NULL,
  `make` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `fault_note` mediumtext,
  `note` mediumtext,
  `stat` varchar(3) DEFAULT NULL,
  `pattern` varchar(255) DEFAULT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `job_detail_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job_details`
--

INSERT INTO `tbl_job_details` (`job_details_id`, `job_id`, `client_id`, `customer_name`, `customer_tel`, `customer_email`, `customer_address`, `m_imei`, `s_imei`, `make`, `model`, `fault_note`, `note`, `stat`, `pattern`, `pin_code`, `job_detail_date_time`) VALUES
(1, '1', '0', 'tom', '0712645264', '', '', '869092034099892', '', 'teeipo', '900', 'device, not sitch on', '', '0', '', '', '2022-03-12 07:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_item`
--

CREATE TABLE `tbl_job_item` (
  `job_item_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `labour_id` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `part_discount` varchar(255) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_labour`
--

CREATE TABLE `tbl_job_labour` (
  `job_labour_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `job_fru` varchar(255) DEFAULT NULL,
  `labour_discount` varchar(255) DEFAULT NULL,
  `labour_name` mediumtext,
  `fru_price` varchar(255) DEFAULT NULL,
  `labour_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job_labour`
--

INSERT INTO `tbl_job_labour` (`job_labour_id`, `job_id`, `job_fru`, `labour_discount`, `labour_name`, `fru_price`, `labour_datetime`) VALUES
(1, '1', '1', '0', '', '250', '2024-09-26 06:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labour`
--

CREATE TABLE `tbl_labour` (
  `labour_id` int(11) NOT NULL,
  `labour_name` varchar(255) DEFAULT NULL,
  `fru` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipt`
--

CREATE TABLE `tbl_receipt` (
  `receipt_id` int(11) NOT NULL,
  `invoice_save_id` varchar(255) DEFAULT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `note` mediumtext,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `supplier_company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `supplier_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax`
--

CREATE TABLE `tbl_tax` (
  `tax_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `note` mediumtext,
  `additional_price` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tax`
--

INSERT INTO `tbl_tax` (`tax_id`, `job_id`, `user_id`, `vat`, `discount`, `note`, `additional_price`, `datetime`, `client_id`) VALUES
(1, '1', '1', '0', '0', 'repair not done', NULL, '2022-03-12 07:25:19', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_login`
--

CREATE TABLE `users_login` (
  `user_id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(3) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_login`
--

INSERT INTO `users_login` (`user_id`, `name`, `email`, `password`, `role`, `tel`, `create_date`) VALUES
(1, 'Admin', 'admin@mail.com', '$2y$10$MMMKgwps5FkKP9erlJhyQOYzSC2IrULzLeiFi7sfQv20LkCAjL9Mq', '1', '0764415555', '2020-08-12 13:30:20'),
(3, 'Arotel Mobile', 'arotel@mail.com', '$2y$10$vlK6uYF67zHPmT7EhQ5NJ.5rcZGTUp6fCCM/A7FGmKbpKmdg7mHA6', '1', '0777276161', '2022-03-12 10:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile_pic`
--

CREATE TABLE `users_profile_pic` (
  `users_profile_pic_id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `profile_pic_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_profile_pic`
--

INSERT INTO `users_profile_pic` (`users_profile_pic_id`, `user_id`, `profile_image`, `profile_pic_datetime`) VALUES
(1, '1', '1646984794.jpg', '2022-03-11 07:46:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_grn_details`
--
ALTER TABLE `tbl_grn_details`
  ADD PRIMARY KEY (`grn_detail_id`);

--
-- Indexes for table `tbl_grn_items`
--
ALTER TABLE `tbl_grn_items`
  ADD PRIMARY KEY (`grn_items_id`);

--
-- Indexes for table `tbl_invoice_save`
--
ALTER TABLE `tbl_invoice_save`
  ADD PRIMARY KEY (`invoice_save_id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_item_price_batch`
--
ALTER TABLE `tbl_item_price_batch`
  ADD PRIMARY KEY (`price_batch_id`);

--
-- Indexes for table `tbl_job`
--
ALTER TABLE `tbl_job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tbl_job_accessory_fault`
--
ALTER TABLE `tbl_job_accessory_fault`
  ADD PRIMARY KEY (`accessory_fault_id`);

--
-- Indexes for table `tbl_job_details`
--
ALTER TABLE `tbl_job_details`
  ADD PRIMARY KEY (`job_details_id`);

--
-- Indexes for table `tbl_job_item`
--
ALTER TABLE `tbl_job_item`
  ADD PRIMARY KEY (`job_item_id`);

--
-- Indexes for table `tbl_job_labour`
--
ALTER TABLE `tbl_job_labour`
  ADD PRIMARY KEY (`job_labour_id`);

--
-- Indexes for table `tbl_labour`
--
ALTER TABLE `tbl_labour`
  ADD PRIMARY KEY (`labour_id`);

--
-- Indexes for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_profile_pic`
--
ALTER TABLE `users_profile_pic`
  ADD PRIMARY KEY (`users_profile_pic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_grn_details`
--
ALTER TABLE `tbl_grn_details`
  MODIFY `grn_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_grn_items`
--
ALTER TABLE `tbl_grn_items`
  MODIFY `grn_items_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice_save`
--
ALTER TABLE `tbl_invoice_save`
  MODIFY `invoice_save_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item_price_batch`
--
ALTER TABLE `tbl_item_price_batch`
  MODIFY `price_batch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_job`
--
ALTER TABLE `tbl_job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_job_accessory_fault`
--
ALTER TABLE `tbl_job_accessory_fault`
  MODIFY `accessory_fault_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_job_details`
--
ALTER TABLE `tbl_job_details`
  MODIFY `job_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_job_item`
--
ALTER TABLE `tbl_job_item`
  MODIFY `job_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_job_labour`
--
ALTER TABLE `tbl_job_labour`
  MODIFY `job_labour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_labour`
--
ALTER TABLE `tbl_labour`
  MODIFY `labour_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_profile_pic`
--
ALTER TABLE `users_profile_pic`
  MODIFY `users_profile_pic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
