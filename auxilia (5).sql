-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2020 at 12:04 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `auxilia`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_infos`
--

CREATE TABLE IF NOT EXISTS `academic_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Actual` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `New` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Average` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Remarks` text COLLATE utf8mb4_unicode_ci,
  `familymember_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `academic_infos`
--

INSERT INTO `academic_infos` (`id`, `Actual`, `New`, `Average`, `Remarks`, `familymember_id`, `created_at`, `updated_at`) VALUES
(1, '60', '70', '65', 'a little bit of improvement', 3, NULL, NULL),
(2, '10', '15', '12.5', 'sag fd sh', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Ref` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Debit` double DEFAULT '0',
  `cDebit` double DEFAULT '0',
  `currency_id` int(11) NOT NULL,
  `Bank` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PaymentMode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Notes` text COLLATE utf8mb4_unicode_ci,
  `sponsor_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Dat` timestamp NULL DEFAULT NULL,
  `Credit` double NOT NULL DEFAULT '0',
  `cCredit` double NOT NULL DEFAULT '0',
  `family_main_account_id` int(11) NOT NULL DEFAULT '0',
  `Type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `Ref`, `Debit`, `cDebit`, `currency_id`, `Bank`, `PaymentMode`, `Notes`, `sponsor_id`, `deleted_at`, `created_at`, `updated_at`, `Dat`, `Credit`, `cCredit`, `family_main_account_id`, `Type`) VALUES
(1, '123', 150000, 75, 1, 'Audi', 'Cash', 'khvhkg ug ghv hgv hgv hg', 1, NULL, '2020-03-24 05:05:59', '2020-04-22 09:32:36', '2020-03-23 22:00:00', 0, 0, 0, ''),
(3, 'ref', 2150, 2150, 6, 'Audi', 'Cash', 'testtttttttttttttttt', 1, NULL, '2020-03-26 12:43:27', '2020-05-05 03:05:59', '2020-02-18 22:00:00', 0, 0, 0, 'Allocation'),
(11, NULL, 0, 0, 6, NULL, NULL, 'test', 1, NULL, NULL, NULL, NULL, 150, 150, 2, ''),
(12, NULL, 0, 0, 1, NULL, NULL, 'Notes', 1, NULL, NULL, NULL, '2020-04-27 21:00:00', 450000, 225, 9, 'Allocation'),
(13, 'Ref', 100, 100, 6, 'Bank', 'Cash', 'Notes', 1, NULL, '2020-04-30 03:31:54', '2020-04-30 03:31:54', '2020-04-29 21:00:00', 0, 0, 0, 'Medicale'),
(14, 'Ref', 100, 100, 6, 'Bank', 'Cash', 'Notes', 1, NULL, '2020-04-30 03:32:31', '2020-04-30 03:32:31', '2020-04-29 21:00:00', 0, 0, 0, 'Medicale'),
(15, NULL, 0, 0, 6, NULL, NULL, 'Notes', 1, NULL, NULL, NULL, '2020-04-29 21:00:00', 100, 100, 10, 'Allocation');

-- --------------------------------------------------------

--
-- Table structure for table `changements`
--

CREATE TABLE IF NOT EXISTS `changements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Group1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `changements`
--

INSERT INTO `changements` (`id`, `Name`, `Group1`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tset', 'Group', NULL, '2020-04-06 07:00:54', '2020-04-06 07:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `changement_declarations`
--

CREATE TABLE IF NOT EXISTS `changement_declarations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `changement_id` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `Remarks` text COLLATE utf8mb4_unicode_ci,
  `Date` timestamp NULL DEFAULT NULL,
  `Type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `changement_declarations`
--

INSERT INTO `changement_declarations` (`id`, `changement_id`, `family_id`, `Remarks`, `Date`, `Type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'test2', '2020-05-03 21:00:00', 'Other', NULL, NULL, NULL),
(2, 1, 1, 'j', '2020-05-02 21:00:00', 'Other', NULL, NULL, NULL),
(3, 1, 1, 'ty', NULL, 'Changement Declaration', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE IF NOT EXISTS `charges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `Name`, `deleted_at`, `created_at`, `updated_at`, `Type`) VALUES
(1, 'loyer', NULL, '2020-04-06 06:11:17', '2020-05-04 11:29:59', 'Resource'),
(2, 'salary', NULL, '2020-04-07 07:53:09', '2020-05-04 11:26:16', 'Charge');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `currencies_symbol_unique` (`symbol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `symbol`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LBP', '2020-03-16 13:23:03', '2020-03-16 13:23:03', NULL),
(6, 'USD', '2020-03-17 09:11:12', '2020-03-17 09:11:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE IF NOT EXISTS `donations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `Name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Housing', NULL, '2020-04-07 04:23:12', '2020-04-07 04:23:23'),
(2, 'test', '2020-05-11 04:48:49', '2020-05-11 04:48:41', '2020-05-11 04:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `exchanges`
--

CREATE TABLE IF NOT EXISTS `exchanges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Dat` timestamp NULL DEFAULT NULL,
  `FromCurrency` int(11) NOT NULL,
  `ToCurrency` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `FromAmount` double NOT NULL,
  `ToAmount` double NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `exchanges`
--

INSERT INTO `exchanges` (`id`, `Dat`, `FromCurrency`, `ToCurrency`, `created_at`, `updated_at`, `FromAmount`, `ToAmount`, `deleted_at`) VALUES
(1, '2020-03-10 22:00:00', 6, 1, '2020-03-17 09:12:51', '2020-03-17 13:14:18', 1, 2000, NULL),
(2, '2020-03-09 22:00:00', 6, 1, '2020-03-17 09:13:10', '2020-03-17 13:12:15', 1, 2000, '2020-03-17 13:12:15'),
(3, '2020-02-29 22:00:00', 1, 6, '2020-04-16 07:41:47', '2020-04-16 07:41:47', 2000, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE IF NOT EXISTS `families` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MotherName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SocialHelper` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `FamilyName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Date` timestamp NULL DEFAULT NULL,
  `Place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Building` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Floor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RelativeName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LevelOfStudy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DrivingLicense` tinyint(1) NOT NULL DEFAULT '0',
  `Car` tinyint(1) NOT NULL DEFAULT '0',
  `CompanyName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CompanyLocation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PaymentMode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HealthCare` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HomeProperty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NumberOfRooms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LivingRoom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Kitchen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Bathroom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `State` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Remarks` text COLLATE utf8mb4_unicode_ci,
  `CNSSNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Valid` tinyint(1) NOT NULL DEFAULT '0',
  `Religion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`id`, `MotherName`, `Address`, `Phone`, `Mobile`, `Email`, `Region`, `SocialHelper`, `deleted_at`, `created_at`, `updated_at`, `FamilyName`, `Date`, `Place`, `Street`, `Building`, `Floor`, `RelativeName`, `LevelOfStudy`, `DrivingLicense`, `Car`, `CompanyName`, `CompanyLocation`, `PaymentMode`, `HealthCare`, `HomeProperty`, `NumberOfRooms`, `LivingRoom`, `Kitchen`, `Bathroom`, `State`, `Remarks`, `CNSSNumber`, `Valid`, `Religion`) VALUES
(1, 'Mother', 'Address', 'Phone', 'Mobile', 'Email@example.com', 'Keserwan', 1, NULL, '2020-03-23 18:16:13', '2020-05-14 05:05:36', 'Family Name', '2020-04-01 21:00:00', 'Place', 'Street', NULL, NULL, NULL, 'Primary', 1, 0, 'asd', 'asd', 'Daily', 'CNSS', 'Owner', '1', '2', '3', '4', 'Good', 'sdf gds', '', 0, 'religion'),
(2, 'Mother 2', 'address 2', '+9615054150', '+9610140513', 'Email@email.com', 'Region 2', 1, '2020-03-24 04:46:34', '2020-03-24 04:45:54', '2020-03-24 04:46:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, ''),
(3, 'tset', 'fds', 'sdf', 'dsf', 'Email@resr.com', 'Keserwan', 1, NULL, NULL, '2020-04-29 11:00:20', 'Family Name 2', '2020-04-28 21:00:00', 'Place', 'Street', 'Building', 'Floor', 'Relative', '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `family_accounts`
--

CREATE TABLE IF NOT EXISTS `family_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Amount` double NOT NULL,
  `currency_id` int(11) NOT NULL,
  `Notes` text COLLATE utf8mb4_unicode_ci,
  `period_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `family_accounts`
--

INSERT INTO `family_accounts` (`id`, `Name`, `family_id`, `member_id`, `Type`, `Amount`, `currency_id`, `Notes`, `period_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 2, 2, 123, 1, NULL, 1, NULL, NULL, NULL),
(3, 1, 1, 2, 2, 1243142, 1, NULL, 1, NULL, NULL, NULL),
(4, 1, 1, 2, 2, 1234, 6, NULL, 1, NULL, NULL, NULL),
(5, 1, 1, 17, 1, 150, 6, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `family_followups`
--

CREATE TABLE IF NOT EXISTS `family_followups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Problem` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Solution` text COLLATE utf8mb4_unicode_ci,
  `EndOfTherapy` timestamp NULL DEFAULT NULL,
  `FamilyTherapy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EndOfFamilyTherapy` timestamp NULL DEFAULT NULL,
  `Psychologist` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NumberOfVisits` int(11) NOT NULL DEFAULT '0',
  `family_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `family_followups`
--

INSERT INTO `family_followups` (`id`, `Problem`, `Solution`, `EndOfTherapy`, `FamilyTherapy`, `EndOfFamilyTherapy`, `Psychologist`, `NumberOfVisits`, `family_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Problem 1', 'Solutions', NULL, 'Yes', '2020-04-07 21:00:00', NULL, 4, 1, NULL, NULL, NULL),
(2, 'Problem', 'Solution', '2020-04-21 21:00:00', 'No', NULL, 'Psychologist', 1, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `family_main_accounts`
--

CREATE TABLE IF NOT EXISTS `family_main_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) NOT NULL,
  `Notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Amount` double NOT NULL,
  `currency_id` int(11) NOT NULL,
  `sponsor_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cAmount` double NOT NULL DEFAULT '0',
  `Date` timestamp NULL DEFAULT NULL,
  `Type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_member_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cheque` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `family_main_accounts`
--

INSERT INTO `family_main_accounts` (`id`, `family_id`, `Notes`, `Amount`, `currency_id`, `sponsor_id`, `deleted_at`, `created_at`, `updated_at`, `cAmount`, `Date`, `Type`, `family_member_id`, `Cheque`, `Bank`) VALUES
(1, 3, 'test', 150000, 1, 1, NULL, NULL, NULL, 75, '2020-04-22 21:00:00', 'Allocation', '', '', ''),
(2, 3, 'test', 150, 6, 1, NULL, NULL, NULL, 150, NULL, NULL, '', '', ''),
(3, 1, 'test1', 10000, 1, 1, NULL, NULL, NULL, 5, '2020-04-23 21:00:00', 'Allocation', '2', '', ''),
(6, 1, 'test23', 10, 6, 1, NULL, NULL, NULL, 10, '2020-04-22 21:00:00', 'Medicale', '17', '', ''),
(7, 1, 'Notes', 100, 6, 1, NULL, NULL, NULL, 100, NULL, 'Allocation', '', '', ''),
(8, 1, 'Notes', 100, 6, 1, NULL, NULL, NULL, 100, NULL, 'Allocation', '', '', ''),
(9, 1, 'Notes', 450000, 1, 1, NULL, NULL, NULL, 225, '2020-04-27 21:00:00', 'Allocation', '17', '1234567', 'Audi'),
(10, 1, 'Notes', 100, 6, 1, NULL, NULL, NULL, 100, '2020-04-29 21:00:00', 'Allocation', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `family_members`
--

CREATE TABLE IF NOT EXISTS `family_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateOfBirth` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `family_id` int(11) NOT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT ' ',
  `Profession` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT ' ',
  `Description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT ' ',
  `InHouse` tinyint(1) NOT NULL,
  `Position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `family_members`
--

INSERT INTO `family_members` (`id`, `Name`, `DateOfBirth`, `deleted_at`, `created_at`, `updated_at`, `family_id`, `Status`, `Profession`, `Description`, `InHouse`, `Position`) VALUES
(2, 'rami', '2018-12-31 22:00:00', NULL, '2020-03-26 12:35:02', '2020-03-26 13:06:19', 1, '', '', '', 0, ''),
(11, 'miledd', '2020-04-01 21:00:00', NULL, NULL, NULL, 3, '', '', '', 0, ''),
(12, 'test', '2020-04-27 21:00:00', NULL, NULL, NULL, 3, '', '', '', 0, ''),
(13, 'ws', '2020-03-30 21:00:00', NULL, NULL, NULL, 3, NULL, 'Work', NULL, 0, ''),
(14, 'Miled', '2020-03-31 21:00:00', NULL, NULL, NULL, 3, 'sa', 'Work', 'h', 0, ''),
(17, 'Miled', '1993-08-16 21:00:00', NULL, NULL, NULL, 1, NULL, 'Work', NULL, 0, ''),
(19, 'Name', '2020-03-31 21:00:00', NULL, NULL, NULL, 3, 'Status', 'Work', 'Description', 1, ''),
(20, 'alex', '2020-04-06 21:00:00', NULL, NULL, NULL, 1, 'Single', 'Work', 'Software Developer', 0, 'Father'),
(21, 'daily', '2020-05-03 21:00:00', NULL, NULL, NULL, 1, 'tset', 'Other', 'test', 0, 'Daughter'),
(22, 'test', '2020-05-04 21:00:00', NULL, NULL, NULL, 1, 'Status', 'School', NULL, 1, 'aunt'),
(23, 'Keserwan', '2020-05-04 21:00:00', NULL, NULL, NULL, 1, 'staus', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tablename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tableserial` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `Name`, `tablename`, `tableserial`, `deleted_at`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'familyaccount/cr9xcKgLfDB6pqzBKl2P0Hzl7MuneNOp2RDgmXPV.png', '', 6, NULL, NULL, NULL, 0),
(2, 'familyaccount/Ugseq13JrtT753hZEoU39uxCoVJ2JdkDo0KYYd5O.png', '', 6, NULL, NULL, NULL, 0),
(3, 'familyaccount/isLzUbu6YOVAuRTCA83br2b8U9RAYWOXZSs0qbub.png', 'familyaccount', 6, NULL, NULL, NULL, 0),
(4, 'familyaccount/1fuCP2o8cJ3YUEX3B9AkVgXLr2KfaH1UKjS4XNqI.png', 'familyaccount', 9, NULL, NULL, NULL, 0),
(6, 'familyaccount/ZOuaOCnqLATYXU4qMHg4Shd2CQ1L2xRYucWphtHa.jpeg', 'familyaccount', 10, NULL, NULL, NULL, 1),
(8, 'familyaccount/1sEJaH2wHDQJoIrueZW8FYdrWXJY6BY4RVqtp5VH.jpeg', 'familyaccount', 10, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member_details`
--

CREATE TABLE IF NOT EXISTS `member_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Handicap` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `familymember_id` int(11) NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `member_details`
--

INSERT INTO `member_details` (`id`, `Handicap`, `familymember_id`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'test', 2, 'test', NULL, NULL),
(2, 'test', 1, 'test', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=75 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 1),
(13, '2019_08_19_000000_create_failed_jobs_table', 1),
(14, '2020_03_16_114728_create_currencies_table', 1),
(15, '2020_03_16_123818_create_exchanges_table', 1),
(16, '2020_03_17_071524_add_soft_deletes_to_currencies_table', 2),
(17, '2020_03_17_072523_add_soft_deletes_to_users_table', 3),
(18, '2020_03_17_080700_add__to_amount_to_table_exchanges', 4),
(19, '2020_03_17_090308_add_image_to_users', 5),
(20, '2020_03_18_084427_create_sponsors_table', 6),
(21, '2020_03_18_093545_add_soft_deletes_to_sponsors_table', 7),
(23, '2020_03_18_101458_create_accounts_table', 8),
(24, '2020_03_18_144704_add_date_to_accounts', 9),
(26, '2020_03_23_184659_create_user_accounts_table', 10),
(27, '2020_03_23_192338_create_families_table', 11),
(28, '2020_03_24_065339_create_family_members_table', 12),
(30, '2020_03_24_104939_add_fields_to_users', 13),
(31, '2020_03_24_113602_create_salary_break_downs_table', 14),
(33, '2020_03_26_132954_add_family_id_to_family_member', 15),
(34, '2020_04_02_063032_add_fields_to_family_table', 16),
(37, '2020_04_02_074258_add_fields_to_table_family_member', 17),
(38, '2020_04_02_092239_create_regions_table', 18),
(43, '2020_04_03_072039_add_fields_to_table_families', 19),
(44, '2020_04_03_085311_create_periods_table', 20),
(45, '2020_04_06_085634_create_charges_table', 21),
(46, '2020_04_06_092530_create_changements_table', 22),
(47, '2020_04_06_114702_create_member_details_table', 23),
(48, '2020_04_07_070956_create_donations_table', 24),
(49, '2020_04_07_082904_create_family_accounts_table', 25),
(51, '2020_04_07_102546_add_type_to_table_charges', 26),
(52, '2020_04_08_070236_delete_fields_in_changements_table', 26),
(54, '2020_04_08_080139_create_family_followups_table', 27),
(57, '2020_04_09_150729_create_academic_infos_table', 28),
(59, '2020_04_14_074955_create_changement_declarations_table', 29),
(60, '2020_04_16_093620_create_family_main_accounts_table', 30),
(61, '2020_04_16_100151_add_fields_to_table_accounts', 31),
(63, '2020_04_16_101542_add_camount_to_table_family_main_accounts', 32),
(64, '2020_04_16_102404_add_family_main_account_id_to_table_accounts', 33),
(65, '2020_04_16_102957_add_date_to_table_family_main_account', 34),
(66, '2020_04_21_121306_add_type_to_family_main_accounts', 35),
(67, '2020_04_24_071646_create_images_table', 36),
(68, '2020_04_30_062216_add_type_to_account', 37),
(69, '2020_05_04_135643_add_position_to_family_member_table', 38),
(70, '2020_05_05_114705_add_family_member_id_to_table_family_main_accounts', 39),
(71, '2020_05_05_142650_add_user_id_to_images', 40),
(72, '2020_05_06_080710_add_fields_to_family_main_accounts', 41),
(74, '2020_05_14_074227_add_fields_to_families', 42);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE IF NOT EXISTS `periods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `Name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'daily', NULL, '2020-04-06 05:54:54', '2020-04-06 05:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `Name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Keserwan', NULL, '2020-04-02 06:44:49', '2020-04-02 06:45:01'),
(2, 'Baabda', '2020-04-02 06:50:37', '2020-04-02 06:50:33', '2020-04-02 06:50:37'),
(3, 'weekly', NULL, '2020-04-06 05:49:48', '2020-04-06 05:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `salary_break_downs`
--

CREATE TABLE IF NOT EXISTS `salary_break_downs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `salary_break_downs`
--

INSERT INTO `salary_break_downs` (`id`, `Description`, `Amount`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tsetst', '20000', 1, NULL, '2020-03-24 11:33:40', '2020-03-24 11:33:40');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE IF NOT EXISTS `sponsors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` text COLLATE utf8mb4_unicode_ci,
  `Address2` text COLLATE utf8mb4_unicode_ci,
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `Fullname`, `Address`, `Address2`, `Email`, `Mobile`, `Phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Miled El Kareh', 'Lebanon, Keserwan, nammoura', 'St Edna Street', 'miled.elkareh@live.com', '+961 70 941 652', '+961 09444309', '2020-03-18 07:59:01', '2020-03-20 09:17:07', NULL),
(2, 'Fullname', 'Address', 'Address 22', 'Email@test.com', 'Mobile', 'Phone', '2020-05-04 05:46:39', '2020-05-04 05:46:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CNSS_StartDate` timestamp NULL DEFAULT NULL,
  `CNSS_EndDate` timestamp NULL DEFAULT NULL,
  `Phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `image`, `CNSS_StartDate`, `CNSS_EndDate`, `Phone`) VALUES
(1, 'admin', 'admin@dsoft-lb.com', NULL, '$2y$10$LVAHxx6tJ5H5Cabbrbu2jeq3VZuEu.5Vq7sO4Pkmbxt8Pa1WuZvaW', NULL, '2020-03-16 13:15:18', '2020-03-24 09:08:55', NULL, 'users/0jgvuR5yr4L6SwBts8kspigmxCStqoAi0o18sQv7.jpeg', '2020-03-24 22:00:00', '2020-03-23 22:00:00', '7094212'),
(2, 'miled', 'miled.elkareh@live.com', NULL, '$2y$10$LVAHxx6tJ5H5Cabbrbu2jeq3VZuEu.5Vq7sO4Pkmbxt8Pa1WuZvaW', NULL, '2020-03-17 05:27:24', '2020-03-17 05:28:33', '2020-03-17 05:28:33', '', NULL, NULL, ''),
(3, 'Miled', 'mkareh@dsoft-lb.com', NULL, '$2y$10$mpYyC1TAB6roWPdntua2leISJ6X3NoXXFDevJ0IVFdj3ElphR2SFq', NULL, '2020-03-18 06:41:57', '2020-03-18 06:41:57', NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE IF NOT EXISTS `user_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Debit` double NOT NULL,
  `Credit` double NOT NULL,
  `cDebit` double NOT NULL,
  `cCredit` double NOT NULL,
  `currency_id` int(11) NOT NULL,
  `Dat` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
