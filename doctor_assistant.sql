-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2021 at 01:57 PM
-- Server version: 10.3.30-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor_assistant`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `self` tinyint(4) NOT NULL,
  `symptom` text NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `blood_group` varchar(20) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `appoint_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doc_id`, `user_id`, `hospital_id`, `name`, `self`, `symptom`, `gender`, `blood_group`, `address`, `appoint_date`, `status`, `created_at`) VALUES
(1, 1, 2, 4, '', 1, 'Ratione eius aliquid', 1, 'O+', 'Veniam quisquam est', '2021-08-24 00:00:00', 1, '2021-08-15 00:00:00'),
(2, 3, 2, 8, 'Isabella Ayala', 0, 'Fugiat nisi excepteu', 0, 'O-', 'Asperiores labore mo', '2021-08-31 00:00:00', 1, '2021-06-27 21:26:45'),
(3, 1, 2, 8, 'Cassady Ochoa', 0, 'Id ratione quidem qu', 0, 'B+', 'Enim deserunt ipsum', '2021-06-29 09:07:00', 1, '2021-06-27 21:27:14'),
(4, 1, 7, 1, '', 1, 'I have a fever', 1, 'O+', 'Bogura, Bogura', '2021-09-15 10:19:00', 1, '2021-09-15 07:20:10'),
(5, 1, 7, 1, 'Barrett Davis', 0, 'Nihil odit culpa vo', 1, 'Impedit qui reprehe', 'Aspernatur rerum eiu', '2021-09-20 13:39:00', 1, '2021-09-18 07:46:06'),
(6, 3, 3, 6, '', 1, 'Voluptatibus nostrud', 0, 'Mollitia nulla hic r', 'Nihil repellendus O', '2021-09-19 10:29:00', 1, '2021-09-18 07:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `chamber_availability`
--

CREATE TABLE `chamber_availability` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chamber_availability`
--

INSERT INTO `chamber_availability` (`id`, `doc_id`, `hospital_id`, `time_from`, `time_to`) VALUES
(22, 1, 1, '07:00:00', '11:00:00'),
(23, 3, 6, '07:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Cardiac Surgery - Adult', 1, '2021-06-22 09:20:44'),
(2, 'Cardiology - Adult', 1, '2021-06-22 09:20:44'),
(3, 'Microbiology', 1, '2021-06-22 09:20:44'),
(4, 'Radiology', 1, '2021-06-22 09:25:48'),
(5, 'General Surgery', 1, '2021-06-22 09:25:48'),
(6, 'Gastroenterology - Medical', 1, '2021-06-22 09:25:48'),
(7, 'Electrophysiology', 1, '2021-06-22 09:25:48'),
(8, 'Gastroenterology - Surgical', 1, '2021-06-22 09:25:48'),
(9, 'Uro - Oncology', 1, '2021-06-22 09:25:48'),
(10, 'Orthopaedics', 1, '2021-06-22 09:25:48'),
(11, 'Kidney Transplant - Adult', 0, '2021-06-22 09:25:48'),
(12, 'Diabetology', 1, '2021-06-22 09:25:48'),
(13, 'Blood Bank', 0, '2021-06-22 09:25:48'),
(14, 'Emergency Medicine', 0, '2021-06-22 09:25:48'),
(15, 'Neurosurgery', 1, '2021-06-22 09:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `short_qualification` text NOT NULL,
  `about` text NOT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `specialist` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `qualification` text DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `membership` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `user_id`, `short_qualification`, `about`, `facebook`, `linkedin`, `specialist`, `experience`, `qualification`, `department_id`, `membership`, `status`, `created_at`) VALUES
(1, 3, 'MBBS, FCPS (SURGERY)', '<p>I am an Assistant Professor, Department of Surgery at Dhaka Central International Medical College &amp; Hospital. My sub-specialty interest is to ensure continued medical education and side by side medical research.</p>', 'www.facebook.com', 'linkedin.com', '<ul style=\"list-style-type: square;\">\r\n<li>Interactive exchange of theoretical knowledge with undergraduate MBBS students.</li>\r\n<li>Hands-on teaching on clinical approach towards the surgical patient with methods, especially during evening ward classes.</li>\r\n<li>Efficient management of emergency surgical patients in words.</li>\r\n<li>Capable of performing most emergency surgical procedures and common elective procedures.</li>\r\n<li>Habituated to assisting medical research.</li>\r\n</ul>', '<ul>\r\n<li>Completed Internship in Bangladesh Medical College Hospital. (20.11.2011 to 19.11.2012).</li>\r\n<li>One year training as Honorary Medical Officer (Surgery) at Bangladesh Medical College Hospital. (01.01.2013 to 31.12.2013).</li>\r\n<li>6 months training in Casualty at Dhaka Medical College Hospital, Dhaka. (01.01.2014 to 30.06.2014).</li>\r\n<li>1 &frac12; year training as Honorary Medical Officer (Surgery) at Dhaka Medical College Hospital, Dhaka. (01.07.14 to 31.12.2015).</li>\r\n<li>FCPS Part-II Surgery course student of DMCH [1st Batch]. (January 2016).</li>\r\n<li>Working as Assistant professor of Surgery from 02.05.2017 in Dhaka Central International Medical College. (Regularized on 20/07/17).</li>\r\n</ul>', '<ul>\r\n<li>SECONDARY SCHOOL CERTIFICATE (SSC) (2003)</li>\r\n<li>HIGHER SECONDARY SCHOOL CERTIFICATE (HSC) (2005)</li>\r\n<li>BACHELOR OF MEDICINE AND BACHELOR OF SURGERY (MBBS) (2011)</li>\r\n<li>FCPS (PART -1) IN GENERAL SURGERY (2013)</li>\r\n<li>FCPS (SURGERY) (2017)</li>\r\n</ul>', 1, '<table style=\"border-collapse: collapse; width: 100%; height: 88px; border-color: #7e8c8d; border-style: double;\" border=\"1\" cellspacing=\"1\" cellpadding=\"10\">\r\n<tbody>\r\n<tr style=\"height: 22px;\">\r\n<td style=\"width: 49.0245%; height: 22px; border: 1px dashed #7e8c8d;\">Bangladesh College of Physicians &amp; Surgeons</td>\r\n<td style=\"width: 49.0245%; height: 22px; border: 1px dashed #7e8c8d;\">Fellow of Surgery and life member</td>\r\n</tr>\r\n<tr style=\"height: 22px;\">\r\n<td style=\"width: 49.0245%; height: 22px; border: 1px dashed #7e8c8d;\">Society of Surgeons of Bangladesh</td>\r\n<td style=\"width: 49.0245%; height: 22px; border: 1px dashed #7e8c8d;\">Life member</td>\r\n</tr>\r\n<tr style=\"height: 22px;\">\r\n<td style=\"width: 49.0245%; height: 22px; border: 1px dashed #7e8c8d;\">Society of Laparoscopic Surgeons of Bangladesh</td>\r\n<td style=\"width: 49.0245%; height: 22px; border: 1px dashed #7e8c8d;\">Life Member</td>\r\n</tr>\r\n<tr style=\"height: 22px;\">\r\n<td style=\"width: 49.0245%; height: 22px; border: 1px dashed #7e8c8d;\">Hernia Society of Bangladesh</td>\r\n<td style=\"width: 49.0245%; height: 22px; border: 1px dashed #7e8c8d;\">Life Member</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, '2021-06-23 11:22:14'),
(3, 5, 'MS,FCPS, MRCS, MRCPS, WHO Fellow, Urology & Renal Transplant', 'Assistant Professor,\r\nDept. of Urology,\r\nShaheed Suhrawardy Medical College and Hospital, Dhaka.\r\n\r\nWHO Fellow in Urology and Renal Transplant.\r\n\r\nEx. Specialist Registrar,\r\nUrology, National Health Services, UK', '#', '#', '<ul style=\"list-style-type: square;\">\r\n<li>Interactive exchange of theoretical knowledge with undergraduate MBBS students.</li>\r\n<li>Hands-on teaching on clinical approach towards the surgical patient with methods, especially during evening ward classes.</li>\r\n<li>Efficient management of emergency surgical patients in words.</li>\r\n<li>Capable of performing most emergency surgical procedures and common elective procedures.</li>\r\n<li>Habituated to assisting medical research.</li>\r\n</ul>', '<ul>\r\n<li>Completed Internship in Bangladesh Medical College Hospital. (20.11.2011 to 19.11.2012).</li>\r\n<li>One year training as Honorary Medical Officer (Surgery) at Bangladesh Medical College Hospital. (01.01.2013 to 31.12.2013).</li>\r\n<li>6 months training in Casualty at Dhaka Medical College Hospital, Dhaka. (01.01.2014 to 30.06.2014).</li>\r\n<li>1 &frac12; year training as Honorary Medical Officer (Surgery) at Dhaka Medical College Hospital, Dhaka. (01.07.14 to 31.12.2015).</li>\r\n<li>FCPS Part-II Surgery course student of DMCH [1st Batch]. (January 2016).</li>\r\n<li>Working as Assistant professor of Surgery from 02.05.2017 in Dhaka Central International Medical College. (Regularized on 20/07/17).</li>\r\n</ul>', '<ul>\r\n<li>SECONDARY SCHOOL CERTIFICATE (SSC) (2003)</li>\r\n<li>HIGHER SECONDARY SCHOOL CERTIFICATE (HSC) (2005)</li>\r\n<li>BACHELOR OF MEDICINE AND BACHELOR OF SURGERY (MBBS) (2011)</li>\r\n<li>FCPS (PART -1) IN GENERAL SURGERY (2013)</li>\r\n<li>FCPS (SURGERY) (2017)</li>\r\n</ul>', 1, NULL, 1, '2021-06-24 20:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `district` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `district`, `status`, `created_at`) VALUES
(1, 'Saic General Hospital', 'Bogra', 1, '2021-06-22 09:32:01'),
(2, 'Independent General Hospital', 'Bogra', 1, '2021-06-22 09:32:01'),
(3, 'Ibn Sina Diagnostic & Consultation Center', 'Bogra', 1, '2021-06-22 09:32:01'),
(4, 'MCH Hospital', 'Bogra', 1, '2021-06-22 09:32:01'),
(5, 'Shondhani General Hospital', 'Bogra', 1, '2021-06-22 09:32:01'),
(6, 'Mohammad Ali Hospital', 'Bogra', 1, '2021-06-22 09:32:01'),
(7, 'Bogura Nursing Home', 'Bogra', 1, '2021-06-22 09:32:01'),
(8, 'Shaheed Ziaur Rahman Medical College Hospital (SZMCH)', 'Bogra', 1, '2021-06-22 09:33:39'),
(9, 'Doctors Clinic Unit 1', 'Bogra', 1, '2021-06-22 09:33:39'),
(10, 'Doctors Clinic Unit 2', 'Bogra', 1, '2021-06-22 09:33:39'),
(11, 'Rainbow Community Hospital & Diagnostic Centre', 'Bogra', 1, '2021-06-22 09:33:39'),
(12, 'Central General Hospital', 'Bogra', 1, '2021-06-22 09:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `prescription` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `doc_id`, `appoint_id`, `title`, `prescription`, `created_at`) VALUES
(1, 1, 3, 'Testing Report', '&lt;!-- [if !mso]&gt;&lt;!--&gt; &lt;!--&lt;![endif]--&gt; &lt;!-- [if (gte mso 9)|(IE)]&gt;\r\n				&lt;style type=&quot;text/css&quot;&gt;\r\n					table {border-collapse: collapse;}\r\n				&lt;/style&gt;\r\n				&lt;![endif]--&gt;&lt;center class=&quot;wrapper&quot;&gt;\r\n&lt;div class=&quot;webkit&quot;&gt;&lt;!-- [if (gte mso 9)|(IE)]&gt;\r\n						&lt;table width=&quot;600&quot; align=&quot;center&quot;&gt;\r\n						&lt;tr&gt;\r\n						&lt;td&gt;\r\n						&lt;![endif]--&gt;\r\n&lt;table align=&quot;center&quot; style=&quot;width: 100%; max-width: 600px; border-spacing: 0;&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;padding: 0;&quot;&gt;\r\n&lt;h1 style=&quot;margin: 0; font-size: 26px; font-weight: bold; text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-top: 40px;&quot;&gt;{{DATA::SITE_TITLE}}&lt;/h1&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;padding: 0;&quot;&gt;\r\n&lt;div style=&quot;padding: 0 40px;&quot;&gt;\r\n&lt;h4 style=&quot;margin: 30px 0 10px; font-weight: bold; font-size: 20px;&quot;&gt;Hi, {{DATA::USER_NAME}}&lt;/h4&gt;\r\n&lt;p style=&quot;margin: 10px 0; font-size: 15px; color: #444;&quot;&gt;Thank you for choosing {{DATA::SITE_TITLE}}&lt;/p&gt;\r\n&lt;p style=&quot;margin: 5px 0; font-size: 15px; color: #444;&quot;&gt;Please confirm that {{DATA::USER_EMAIL}} is your e-mail address by clicking the button below or use the following link &lt;a href=&quot;{{DATA::VERYFY_LINK}}&quot;&gt;{{DATA::VERYFY_LINK}}&lt;/a&gt; within 24 hours.&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div style=&quot;padding: 0 120px;&quot;&gt;&lt;a href=&quot;{{DATA::VERYFY_LINK}}&quot; style=&quot;display: block; margin: 30px 0; background-color: #2d9900; color: #ffffff; font-size: 20px; text-decoration: none; padding: 10px; font-weight: bold; text-align: center; border-radius: 50px;&quot;&gt;Verify you Email&lt;/a&gt;&lt;/div&gt;\r\n&lt;p style=&quot;padding: 0 40px; font-size: 15px; color: #444;&quot;&gt;If you did not create an account using this address, please ignore this email.&lt;/p&gt;\r\n&lt;div style=&quot;margin: 40px 0 0; text-align: center; color: #777;&quot;&gt;\r\n&lt;h4 style=&quot;margin: 0; font-weight: bold; font-size: 16px;&quot;&gt;Need Help?&lt;/h4&gt;\r\n&lt;p style=&quot;margin: 10px 0;&quot;&gt;Please send any feedback or bug reports&lt;br /&gt;to support@{{DATA::DOMAIN}}&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;padding: 0;&quot;&gt;\r\n&lt;p style=&quot;color: #777; border-top: 1px solid #ddd; text-align: center; padding-top: 8px; margin-bottom: 50px;&quot;&gt;Â© Copyright {{DATA::YEAR}} {{DATA::DOMAIN}}. All rights reserved.&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;!-- [if (gte mso 9)|(IE)]&gt;\r\n						&lt;/td&gt;\r\n						&lt;/tr&gt;\r\n						&lt;/table&gt;\r\n						&lt;![endif]--&gt;&lt;/div&gt;\r\n&lt;/center&gt;', '2021-08-05 00:00:00'),
(7, 1, 1, 'User\'s Report', '&lt;table border=&quot;1&quot; cellpadding=&quot;5px&quot; style=&quot;border-collapse: collapse; width: 100%; height: 110px;&quot;&gt;\r\n&lt;thead&gt;\r\n&lt;tr style=&quot;height: 22px; text-align: left;&quot;&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;SL&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Type&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Name&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Dose&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Duration&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Comments&lt;/th&gt;\r\n&lt;/tr&gt;\r\n&lt;/thead&gt;\r\n&lt;tbody&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;01&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;TAB. XFIN 250 mg&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1+0+0&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;02&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;TAB. FEXO 120 mg&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;0+0+1&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;03&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;TERBIN CREAM&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;twice a day&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;à§¨ à¦¬à¦¾à¦° à¦•à¦°à§‡ à¦†à¦•à§à¦°à¦¾à¦¨à§à¦¤ à¦¸à§à¦¥à¦¾à¦¨à§‡ à¦²à¦¾à¦—à¦¾à¦¬à§‡à¦¨&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;04&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;DANCEL SHAMPOO&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Every three days&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;2 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;à§© à¦¦à¦¿à¦¨ à¦ªà¦° à¦ªà¦° à¦¬à§à¦¯à¦¾à¦¬à¦¹à¦¾à¦° à¦•à¦°à¦¬à§‡à¦¨&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;h4&gt;&lt;br /&gt;Advice:&lt;/h4&gt;\r\n&lt;ul style=&quot;list-style-type: square;&quot;&gt;\r\n&lt;li&gt;à¦à¦²à¦¾à¦°à§à¦œà¦¿ à¦œà¦¾à¦¤à§€à§Ÿ à¦–à¦¾à¦¬à¦¾à¦° à¦¬à¦¨à§à¦§ à¦°à¦¾à¦–à¦¬à§‡à¦¨ à¥¤&lt;br /&gt;&lt;br /&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', '2021-08-25 07:28:59'),
(8, 1, 1, 'User\'s Report', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\nasdasdasdasd\r\n&lt;/body&gt;\r\n&lt;/html&gt;', '2021-08-25 07:40:02'),
(9, 1, 4, 'MD RIAZ\'s Report', '&lt;table border=&quot;1&quot; cellpadding=&quot;5px&quot; style=&quot;border-collapse: collapse; width: 100%; height: 110px;&quot;&gt;\r\n&lt;thead&gt;\r\n&lt;tr style=&quot;height: 22px; text-align: left;&quot;&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;SL&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Type&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Name&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Dose&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Duration&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Comments&lt;/th&gt;\r\n&lt;/tr&gt;\r\n&lt;/thead&gt;\r\n&lt;tbody&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;01&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;TAB. XFIN 250 mg&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1+0+0&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;02&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;TAB. FEXO 120 mg&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;0+0+1&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;03&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;TERBIN CREAM&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;twice a day&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;04&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;DANCEL SHAMPOO&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Every three days&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;2 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;h4&gt;&lt;br /&gt;Advice:&lt;/h4&gt;', '2021-09-15 08:00:24'),
(10, 1, 5, 'Barrett Davis\'s Report', '&lt;table border=&quot;1&quot; cellpadding=&quot;5px&quot; style=&quot;border-collapse: collapse; width: 100%; height: 110px;&quot;&gt;\r\n&lt;thead&gt;\r\n&lt;tr style=&quot;height: 22px; text-align: left;&quot;&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;SL&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Type&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Name&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Dose&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Duration&lt;/th&gt;\r\n&lt;th scope=&quot;col&quot; style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Comments&lt;/th&gt;\r\n&lt;/tr&gt;\r\n&lt;/thead&gt;\r\n&lt;tbody&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;01&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;TAB. XFIN 250 mg&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1+0+0&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;02&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;TAB. FEXO 120 mg&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;0+0+1&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;03&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;TERBIN CREAM&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;twice a day&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;1 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 22px;&quot;&gt;\r\n&lt;td style=&quot;width: 4.63661%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;04&lt;/td&gt;\r\n&lt;td style=&quot;width: 8.84263%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Medicine&lt;/td&gt;\r\n&lt;td style=&quot;width: 25.3233%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;DANCEL SHAMPOO&lt;/td&gt;\r\n&lt;td style=&quot;width: 11.5036%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;Every three days&lt;/td&gt;\r\n&lt;td style=&quot;width: 9.22872%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;2 Month&lt;/td&gt;\r\n&lt;td style=&quot;width: 34.4648%; height: 22px; border-style: solid; border-width: 1px;&quot;&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;h4&gt;&lt;br /&gt;Advice:&lt;/h4&gt;', '2021-09-18 07:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `group_id`, `status`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01797810793', '$2y$10$2Egauzcwf.4qa8Sqa91H0eQGoNOrSf4hWYFykjuR3/AasqBAy4xxa', 1, 1, '2021-06-22 09:35:52'),
(2, 'User', 'user@gmail.com', '01797810793', '$2y$10$f0fqqxKFmyJyI1T6HHwdfOlX25oqjIGyl/8Kv/ou1Sj8gzK9hO2uu', 0, 1, '2021-06-22 09:35:52'),
(3, 'Dr. Hasnat Zaman Zim', 'doctor@gmail.com', '1700000000', '$2y$10$mKMkcm4lR87nffn7rZDrkuOTdgpdBiNToGvpXe1B48OW1USJGZNGy', 2, 1, '2021-06-22 09:35:52'),
(5, 'Dr. Md. Fazal Naser', 'fazalnasir@gmail.com', '017966699366', '$2y$10$Y.bYbjOye.bJBV8FwOECc.rD0XqSidX55hd2PtLPjrJhnyusWyhHO', 2, 1, '2021-06-24 20:01:50'),
(6, 'Mr. Test', 'test-bd@gmail.com', '', '$2y$10$Sb5kgJCc9tfSTAaXY.TjOek7TIhw1q5ctbotprqXmwnrDOjfWFXF6', 0, 1, '2021-06-30 18:33:39'),
(7, 'MD RIAZ', 'mdhosain377@gmail.com', '', '$2y$10$juQgUvjOISyKejVKq000QeX/3ReEdIjkhoFux.jgcSf1egmm6gWGW', 0, 1, '2021-09-15 06:48:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chamber_availability`
--
ALTER TABLE `chamber_availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chamber_availability`
--
ALTER TABLE `chamber_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
