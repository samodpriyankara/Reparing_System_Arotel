-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2022 at 03:35 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile_device_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `client_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_tel` varchar(50) DEFAULT NULL,
  `customer_email` mediumtext DEFAULT NULL,
  `how_to_know` varchar(100) DEFAULT NULL,
  `customer_address` mediumtext DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `client_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`client_id`, `customer_name`, `customer_tel`, `customer_email`, `how_to_know`, `customer_address`, `stat`, `client_datetime`) VALUES
(1, 'Amazoft', '12121212999', 'info@amazoft.com', 'Friend', 'No 103 St Anthonys Mw, Colombo 03', '0', '2022-03-09 16:37:31'),
(2, 'Canada Gateway', '45515454', 'info@canadagateway.lk', 'Friend', 'gsdf hdf h', '0', '2022-03-09 16:38:42'),
(3, 'adsgsd123', 'gsdg', 'gsdg@mail.com', 'Friend', 'gsdgsd', '0', '2022-03-09 16:38:54');

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
  `note` mediumtext DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `grn_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_grn_details`
--

INSERT INTO `tbl_grn_details` (`grn_detail_id`, `supplier_id`, `user_name`, `user_id`, `invoice_number`, `grn_number`, `goods_received_date`, `note`, `stat`, `grn_datetime`) VALUES
(1, '1', 'Admin', '9', 'Amazoft01', '265493', '2022-02-01', 'Test GRN Invoice', '1', '2022-02-01 04:46:32'),
(2, '1', 'Sellathurai Ramesh', '11', '7777', '157432', '2022-02-01', '', '1', '2022-02-01 08:49:19'),
(8, '1', 'Admin', '1', 'degsdg', '374906', '2022-03-10', 'hgsdfg dsg s', '1', '2022-03-10 01:17:45'),
(9, '1', 'Admin', '1', 'gdsgd', '564281', '2022-03-10', 'dgd g', '1', '2022-03-10 01:51:06'),
(10, '1', 'Admin', '1', 'tutu', '283579', '2022-03-10', 'jgfjgfjf', '1', '2022-03-10 17:43:17');

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

--
-- Dumping data for table `tbl_grn_items`
--

INSERT INTO `tbl_grn_items` (`grn_items_id`, `grn_detail_id`, `item_id`, `price_batch_id`, `cost_price`, `selling_price`, `qty`, `stat`) VALUES
(1, '1', '379', '0', '5', '10', '6', '0'),
(3, '1', '379', '2', '250', '500', '10', '0'),
(6, '8', '1', '1', '100', '200', '10', '0'),
(8, '8', '2', '2', '60', '150', '5', '0'),
(9, '8', '2', '2', '60', '150', '5', '0'),
(10, '9', '1', '1', '100', '200', '5', '0'),
(11, '9', '2', '3', '800', '1500', '10', '0');

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

--
-- Dumping data for table `tbl_invoice_save`
--

INSERT INTO `tbl_invoice_save` (`invoice_save_id`, `job_id`, `labour_total`, `item_total`, `sub_total`, `vat`, `grand_total`, `pay`, `stat`, `invoice_save_datetime`) VALUES
(1, '1', '4975', '850', '5825', '0', '5825', '1', '1', '2022-03-10 16:56:00'),
(2, '2', '0', '0', '0', '0', '0', '2', '1', '2022-03-11 17:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `part_location` varchar(255) DEFAULT NULL,
  `part_number` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `item_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `part_name`, `part_location`, `part_number`, `remark`, `stat`, `item_date`) VALUES
(1, 'battry', 'new', '152365', 'fsfsf', '1', '2022-03-09 00:00:00'),
(2, 'Display', 'top floor', 'D1524898', 'test', '1', '2022-03-10 00:25:54');

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

--
-- Dumping data for table `tbl_item_price_batch`
--

INSERT INTO `tbl_item_price_batch` (`price_batch_id`, `item_id`, `grn`, `cost_price`, `selling_price`, `qty`, `batch_label`, `stat`) VALUES
(1, '1', 'new', '100', '200', '3', 'new', '0'),
(2, '2', 'aluth', '60', '150', '7', 'aluth', '0'),
(3, '2', 'yes', '800', '1500', '10', 'yes', '0');

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
(1, '2', '1', '1', '2022-03-10 02:07:56'),
(2, '1', '1', '1', '2022-03-11 13:29:00'),
(4, '2', '1', '1', '2022-03-11 14:50:48');

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
(1, '1', '1', 'Yes', 'No', 'No', '', 'N/A', '', '', '', '', '', '', '', 'Yes', '', '', '', '', '', '', ''),
(2, '2', '2', 'Yes', 'No', 'No', 'Yes', 'No', 'No', 'Yes', 'No', 'No', 'Yes', 'Yes', 'Yes', '', '', '', '', '', '', '', ''),
(4, '4', '4', 'Yes', '', 'No', '', '', '', '', '', '', '', '', '', 'Yes', '', '', '', '', '', '', '');

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
  `customer_email` mediumtext DEFAULT NULL,
  `customer_address` mediumtext DEFAULT NULL,
  `m_imei` varchar(255) DEFAULT NULL,
  `s_imei` varchar(255) DEFAULT NULL,
  `make` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `fault_note` mediumtext DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `pattern` varchar(255) DEFAULT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `job_detail_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job_details`
--

INSERT INTO `tbl_job_details` (`job_details_id`, `job_id`, `client_id`, `customer_name`, `customer_tel`, `customer_email`, `customer_address`, `m_imei`, `s_imei`, `make`, `model`, `fault_note`, `note`, `stat`, `pattern`, `pin_code`, `job_detail_date_time`) VALUES
(1, '1', '0', 'Oshan Premachandra', '0774270018', 'Oshanpremachandra11@gmail.com', '14/A Sagara Lane , Egoda Uyana , Moratuwa , Colombo District ,', '022020', '65656598', 'Apple', 'XR', 'gdsagdsa g', 'gdsag dsag', '1', '', '', '2022-03-10 02:08:09'),
(2, '2', '1', 'Amazoft', '12121212', 'info@amazoft.com', 'fsdgsdg', 'gfbfdb', 'bdfbdfb', 'Apple', 'iphone 6S+', 'gdsgsdg', 'gsdgd', '1', '', '', '2022-03-11 14:04:34'),
(3, '3', '0', 'Oshan Premachandra', '43243', 'oshan.amazoft@gmail.com', 'dgsgdsgds', 'fsdfs', 'fsf', 'Apple', '320D', 'gds gd', 'dsg sdg ', '0', '', '', '2022-03-11 14:49:19'),
(4, '4', '0', 'Oshan123', '12121212', 'oshan.amazoft@gmail.com', 'dgsgdsgds', 'dgdsgsd', 'dsgsdg', 'Apple', 'March K12', 'f saf', 'fa sf', '0', '', '', '2022-03-11 14:51:02');

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
  `remark` mediumtext DEFAULT NULL,
  `part_discount` varchar(255) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job_item`
--

INSERT INTO `tbl_job_item` (`job_item_id`, `job_id`, `user_id`, `labour_id`, `item_id`, `qty`, `remark`, `part_discount`, `stat`, `price`, `datetime`) VALUES
(2, '1', '1', '1', '2', '3', 'fsfs', '0', '2', '150', '2022-03-10 06:39:16'),
(3, '1', '1', '2', '1', '2', '', '0', '1', '200', '2022-03-10 07:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_labour`
--

CREATE TABLE `tbl_job_labour` (
  `job_labour_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `job_fru` varchar(255) DEFAULT NULL,
  `labour_discount` varchar(255) DEFAULT NULL,
  `labour_name` mediumtext DEFAULT NULL,
  `fru_price` varchar(255) DEFAULT NULL,
  `labour_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job_labour`
--

INSERT INTO `tbl_job_labour` (`job_labour_id`, `job_id`, `job_fru`, `labour_discount`, `labour_name`, `fru_price`, `labour_datetime`) VALUES
(1, '1', '5', '2', 'test 1', '250', '2022-03-09 20:38:31'),
(2, '1', '15', '0', 'test 2', '250', '2022-03-09 20:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labour`
--

CREATE TABLE `tbl_labour` (
  `labour_id` int(11) NOT NULL,
  `labour_name` varchar(255) DEFAULT NULL,
  `fru` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_labour`
--

INSERT INTO `tbl_labour` (`labour_id`, `labour_name`, `fru`, `datetime`) VALUES
(1, 'test 1', '5', '2022-03-09 15:44:41'),
(2, 'test 2', '10', '2022-03-09 15:44:49'),
(3, 'test 3', '15', '2022-03-11 14:22:31');

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
  `note` mediumtext DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receipt`
--

INSERT INTO `tbl_receipt` (`receipt_id`, `invoice_save_id`, `job_id`, `price`, `payment_method`, `note`, `datetime`) VALUES
(1, '1', '1', '5825', 'Cash', 's g hh df\r\n hdfhdfhf', '2022-03-10 11:26:38'),
(2, '2', '2', '0', 'Credit', 'df dfh ', '2022-03-11 11:56:42');

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
  `supplier_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `supplier_name`, `supplier_company_name`, `address`, `phone_no`, `email`, `stat`, `supplier_datetime`) VALUES
(1, 'Oshan Premachandra', 'Amazoft', 'No 103 St. Anthonys lane, Colombo 00300', '0771188218', 'oshan@amazoft.com', '0', '2022-01-31 23:15:47'),
(2, 'test', 'test company', 'fasfasfsa', '0774270018', 'admin@gmail.com', '0', '2022-03-11 14:18:24');

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
  `note` mediumtext DEFAULT NULL,
  `additional_price` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tax`
--

INSERT INTO `tbl_tax` (`tax_id`, `job_id`, `user_id`, `vat`, `discount`, `note`, `additional_price`, `datetime`, `client_id`) VALUES
(1, '1', '1', '0', '0', 'gsdgsdg', NULL, '2022-03-10 16:56:00', '0'),
(2, '2', '1', '0', '0', NULL, NULL, '2022-03-11 17:26:34', '1'),
(4, '4', '1', '0', '0', NULL, NULL, '2022-03-11 14:51:02', '0');

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
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_login`
--

INSERT INTO `users_login` (`user_id`, `name`, `email`, `password`, `role`, `tel`, `create_date`) VALUES
(1, 'Admin', 'admin@mail.com', '$2y$10$MMMKgwps5FkKP9erlJhyQOYzSC2IrULzLeiFi7sfQv20LkCAjL9Mq', '1', '0764415555', '2020-08-12 13:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile_pic`
--

CREATE TABLE `users_profile_pic` (
  `users_profile_pic_id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `profile_pic_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_grn_details`
--
ALTER TABLE `tbl_grn_details`
  MODIFY `grn_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_grn_items`
--
ALTER TABLE `tbl_grn_items`
  MODIFY `grn_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_invoice_save`
--
ALTER TABLE `tbl_invoice_save`
  MODIFY `invoice_save_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_item_price_batch`
--
ALTER TABLE `tbl_item_price_batch`
  MODIFY `price_batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_job`
--
ALTER TABLE `tbl_job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_job_accessory_fault`
--
ALTER TABLE `tbl_job_accessory_fault`
  MODIFY `accessory_fault_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_job_details`
--
ALTER TABLE `tbl_job_details`
  MODIFY `job_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_job_item`
--
ALTER TABLE `tbl_job_item`
  MODIFY `job_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_job_labour`
--
ALTER TABLE `tbl_job_labour`
  MODIFY `job_labour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_labour`
--
ALTER TABLE `tbl_labour`
  MODIFY `labour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_profile_pic`
--
ALTER TABLE `users_profile_pic`
  MODIFY `users_profile_pic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
