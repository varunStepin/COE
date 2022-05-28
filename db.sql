-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2022 at 09:18 PM
-- Server version: 5.6.51
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `raghuato_coe_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_project_based_courses`
--

CREATE TABLE `advance_project_based_courses` (
  `id` int(11) NOT NULL,
  `internship_program_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `resource_person` varchar(200) NOT NULL,
  `details` text NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `advance_project_students`
--

CREATE TABLE `advance_project_students` (
  `id` int(11) NOT NULL,
  `advance_project_based_course_id` int(11) NOT NULL,
  `attendee_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `branch` varchar(30) DEFAULT NULL,
  `institute_name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aerospace_defense_bootcamps`
--

CREATE TABLE `aerospace_defense_bootcamps` (
  `id` int(11) NOT NULL,
  `bootcamp` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `institute` varchar(100) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `resource_person` varchar(200) NOT NULL,
  `details` text NOT NULL,
  `types` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `is_delete` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aerospace_defense_courses`
--

CREATE TABLE `aerospace_defense_courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `resource_person` varchar(200) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `details` text NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `is_delete` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aerospace_defense_embedded_courses`
--

CREATE TABLE `aerospace_defense_embedded_courses` (
  `id` int(11) NOT NULL,
  `embedded_course` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `institute` varchar(100) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `resource_person` varchar(200) NOT NULL,
  `details` text NOT NULL,
  `types` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `is_delete` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aerospace_defense_skillings`
--

CREATE TABLE `aerospace_defense_skillings` (
  `id` int(11) NOT NULL,
  `skill_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `resource_person` varchar(200) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `man_power` varchar(20) NOT NULL,
  `man_hour` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `is_delete` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aerospace_defense_training_processes`
--

CREATE TABLE `aerospace_defense_training_processes` (
  `id` int(11) NOT NULL,
  `training_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `institute` varchar(100) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `resource_person` varchar(200) NOT NULL,
  `details` text NOT NULL,
  `types` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `is_delete` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aerospace_students`
--

CREATE TABLE `aerospace_students` (
  `id` int(11) NOT NULL,
  `manage_aerospace_training_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` int(11) NOT NULL,
  `types` varchar(200) NOT NULL,
  `budget_allocation` varchar(200) NOT NULL,
  `budget_used` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `current_year` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cif_connects`
--

CREATE TABLE `cif_connects` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `startup_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connect_program_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `investor_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` datetime NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_customer_satisfactions`
--

CREATE TABLE `cif_customer_satisfactions` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `feedback_date` date NOT NULL,
  `no_feedback` int(15) NOT NULL,
  `satisfaction_pecentage` int(15) NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_expenditures`
--

CREATE TABLE `cif_expenditures` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `types` int(11) NOT NULL,
  `amount_spent` int(100) NOT NULL,
  `expense_type` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `end_date` date NOT NULL,
  `details` text NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `financial_year_id` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cif_external_events`
--

CREATE TABLE `cif_external_events` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `event_type` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `no_participants` int(15) NOT NULL,
  `no_woman_participants` int(15) NOT NULL,
  `percentage_woman_participants` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_external_event_participants`
--

CREATE TABLE `cif_external_event_participants` (
  `id` int(11) NOT NULL,
  `cif_external_event_id` int(11) NOT NULL,
  `participant_name` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_funds`
--

CREATE TABLE `cif_funds` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `types` int(11) NOT NULL,
  `approved_amount` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_utilized` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_unutilized` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `financial_year_id` int(11) NOT NULL,
  `upload_uc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_bs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expenses_type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_gender_diversities`
--

CREATE TABLE `cif_gender_diversities` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `event_type` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `no_participants` int(15) NOT NULL,
  `no_woman_participants` int(70) NOT NULL,
  `percentage_woman_participants` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_gender_diversity_participants`
--

CREATE TABLE `cif_gender_diversity_participants` (
  `id` int(11) NOT NULL,
  `cif_gender_diversity_id` int(11) NOT NULL,
  `participant_name` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_organizations`
--

CREATE TABLE `cif_organizations` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_publicity_mentions`
--

CREATE TABLE `cif_publicity_mentions` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `media_type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_date` date NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_roundtables`
--

CREATE TABLE `cif_roundtables` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `event_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `speaker` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_participant` int(50) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_roundtable_participants`
--

CREATE TABLE `cif_roundtable_participants` (
  `id` int(11) NOT NULL,
  `cif_roundtable_id` int(11) NOT NULL,
  `participant_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_startups`
--

CREATE TABLE `cif_startups` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startup_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incubation_date` date NOT NULL,
  `graduation_date` date NOT NULL,
  `founder_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `founder_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_employees` int(11) NOT NULL,
  `no_employees_women` int(11) NOT NULL,
  `is_women_founder` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_startup_rised_funds`
--

CREATE TABLE `cif_startup_rised_funds` (
  `id` int(11) NOT NULL,
  `cif_startup_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `funding_agency` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cif_targets`
--

CREATE TABLE `cif_targets` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` bigint(10) NOT NULL,
  `year` year(4) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coe_details`
--

CREATE TABLE `coe_details` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `coe_type` varchar(200) NOT NULL,
  `sub_type` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `coe_name` varchar(200) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `website` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name` varchar(500) NOT NULL,
  `company_type` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `product` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `website` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `deleted` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company_team_details`
--

CREATE TABLE `company_team_details` (
  `id` int(11) NOT NULL,
  `companies_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `qualification` text NOT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dept_followups`
--

CREATE TABLE `dept_followups` (
  `id` int(11) NOT NULL,
  `dept_followup_for_each_solution` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_ai_pathshalas`
--

CREATE TABLE `ds_ai_pathshalas` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `topic` varchar(80) NOT NULL,
  `date` varchar(15) NOT NULL,
  `speaker_name` varchar(30) NOT NULL,
  `industry` varchar(80) NOT NULL,
  `startups` varchar(80) NOT NULL,
  `student_name` varchar(80) NOT NULL,
  `student_email` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_ai_phy_acc_startups`
--

CREATE TABLE `ds_ai_phy_acc_startups` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `start_up_name` varchar(100) NOT NULL,
  `date_of_incubation` varchar(20) NOT NULL,
  `date_of_graduation` varchar(20) NOT NULL,
  `founder_name` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `founder_email` varchar(150) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `no_employees` varchar(10) NOT NULL,
  `no_employees_women` varchar(10) NOT NULL,
  `no_women_cofounder` varchar(11) NOT NULL,
  `founder_education` varchar(200) NOT NULL,
  `founders_total_man_year` varchar(200) NOT NULL,
  `valuation_at_start` varchar(20) NOT NULL,
  `valuation_current` varchar(20) NOT NULL,
  `head_count_at_start` varchar(20) NOT NULL,
  `head_count_current` varchar(20) NOT NULL,
  `status_at_start` varchar(200) NOT NULL,
  `is_graduated` int(11) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(5) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ds_ai_trained_faculties`
--

CREATE TABLE `ds_ai_trained_faculties` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `collage_name` varchar(80) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `city` varchar(50) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_ai_trained_professionals`
--

CREATE TABLE `ds_ai_trained_professionals` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `collage_name` varchar(80) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `city` varchar(50) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_ai_trained_students`
--

CREATE TABLE `ds_ai_trained_students` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `collage_name` varchar(80) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_ai_virtual_acc_startups`
--

CREATE TABLE `ds_ai_virtual_acc_startups` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `start_up_name` varchar(100) NOT NULL,
  `date_of_incubation` varchar(20) NOT NULL,
  `date_of_graduation` varchar(20) NOT NULL,
  `founder_name` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `founder_email` varchar(150) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `no_employees` varchar(10) NOT NULL,
  `no_employees_women` varchar(10) NOT NULL,
  `no_women_cofounder` varchar(11) NOT NULL,
  `founder_education` varchar(200) NOT NULL,
  `founders_total_man_year` varchar(200) NOT NULL,
  `valuation_at_start` varchar(20) NOT NULL,
  `valuation_current` varchar(20) NOT NULL,
  `head_count_at_start` varchar(20) NOT NULL,
  `head_count_current` varchar(20) NOT NULL,
  `status_at_start` varchar(200) NOT NULL,
  `is_graduated` int(11) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(5) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ds_hackathons`
--

CREATE TABLE `ds_hackathons` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `hackathon_type` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_hackathon_participants`
--

CREATE TABLE `ds_hackathon_participants` (
  `id` int(11) NOT NULL,
  `ds_hackathon_id` int(11) NOT NULL,
  `participant_name` varchar(50) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `organization` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_investor_connects`
--

CREATE TABLE `ds_investor_connects` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `date` varchar(15) NOT NULL,
  `investor_name` varchar(80) NOT NULL,
  `startup` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_master_classes`
--

CREATE TABLE `ds_master_classes` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `topic` varchar(80) NOT NULL,
  `date` varchar(15) NOT NULL,
  `speaker_name` varchar(30) NOT NULL,
  `industry` varchar(80) NOT NULL,
  `startups` varchar(80) NOT NULL,
  `student_name` varchar(80) NOT NULL,
  `student_email` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_ms_ai_participants`
--

CREATE TABLE `ds_ms_ai_participants` (
  `id` int(11) NOT NULL,
  `program_type` varchar(50) NOT NULL,
  `program_id` int(11) NOT NULL,
  `participant_name` varchar(50) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `organization` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_report_processes`
--

CREATE TABLE `ds_report_processes` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `topic_covered` varchar(50) NOT NULL,
  `tentative_date` varchar(15) NOT NULL,
  `research_partner` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_report_publisheds`
--

CREATE TABLE `ds_report_publisheds` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `topic_covered` varchar(50) NOT NULL,
  `research_partner` varchar(80) NOT NULL,
  `published_date` varchar(20) NOT NULL,
  `downloads` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_solutions_adopteds`
--

CREATE TABLE `ds_solutions_adopteds` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `enterprise` varchar(50) NOT NULL,
  `startup` varchar(50) NOT NULL,
  `category` varchar(30) NOT NULL,
  `focus_area` varchar(50) NOT NULL,
  `start_date` varchar(15) NOT NULL,
  `end_date` varchar(15) NOT NULL,
  `date` varchar(15) NOT NULL,
  `notes` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_solution_proposeds`
--

CREATE TABLE `ds_solution_proposeds` (
  `id` int(11) NOT NULL,
  `proposed_department` varchar(80) NOT NULL,
  `impact_department` varchar(80) NOT NULL,
  `proposal_date` varchar(15) NOT NULL,
  `meeting_date` varchar(15) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ds_tech_mentorings`
--

CREATE TABLE `ds_tech_mentorings` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `topic` varchar(80) NOT NULL,
  `date` varchar(15) NOT NULL,
  `speaker_name` varchar(50) NOT NULL,
  `startups` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_trainers`
--

CREATE TABLE `enrolled_trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `college` varchar(200) NOT NULL,
  `district` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exited_companies`
--

CREATE TABLE `exited_companies` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name` varchar(500) NOT NULL,
  `company_type` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `website` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `deleted` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE `expenditures` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `types` varchar(200) NOT NULL,
  `amount_spent` int(100) NOT NULL,
  `expense_type` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `end_date` date NOT NULL,
  `details` text NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `financial_year_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fabless_coe_teams`
--

CREATE TABLE `fabless_coe_teams` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `coe_detail_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `doj` varchar(15) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `financials`
--

CREATE TABLE `financials` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `types` varchar(200) NOT NULL,
  `approved_amount` varchar(100) NOT NULL,
  `amount_utilized` varchar(200) NOT NULL,
  `amount_unutilized` varchar(100) NOT NULL,
  `financial_year_id` int(11) NOT NULL,
  `upload_uc` varchar(200) NOT NULL,
  `upload_bs` varchar(200) NOT NULL,
  `opening_balance` varchar(20) NOT NULL,
  `expenses_type` varchar(15) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `financial_years`
--

CREATE TABLE `financial_years` (
  `id` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `current` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `generated_employments`
--

CREATE TABLE `generated_employments` (
  `id` int(11) NOT NULL,
  `iot_start_up_id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL COMMENT 'No. of internships provided cumulative',
  `email_id` varchar(100) NOT NULL COMMENT 'incubation_date',
  `mobile_no` varchar(10) NOT NULL COMMENT 'Current No. of employee',
  `designation` varchar(100) NOT NULL,
  `type_of_project` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `CTC` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  `month` varchar(150) NOT NULL,
  `other_details` text NOT NULL COMMENT 'Names of main /full time employees',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `graduate_schools`
--

CREATE TABLE `graduate_schools` (
  `id` int(11) NOT NULL,
  `graduation_name` varchar(100) NOT NULL,
  `batch_no` varchar(20) NOT NULL,
  `date_of_graduation` varchar(100) NOT NULL,
  `name_of_the_graduate` varchar(200) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(5) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hackathons`
--

CREATE TABLE `hackathons` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `place` longtext NOT NULL,
  `date` varchar(100) NOT NULL,
  `participants` longtext NOT NULL,
  `speakers` longtext NOT NULL,
  `hackathon_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incubatee_details`
--

CREATE TABLE `incubatee_details` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `incubatee_type` varchar(100) NOT NULL,
  `sub_type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `website` varchar(200) NOT NULL,
  `city_state` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incubatee_team_details`
--

CREATE TABLE `incubatee_team_details` (
  `id` int(11) NOT NULL,
  `team_member_name` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `qualification` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city_name` varchar(200) NOT NULL,
  `date_of_joining` varchar(200) NOT NULL,
  `date_of_birth` varchar(200) NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `internship_foundation_courses`
--

CREATE TABLE `internship_foundation_courses` (
  `id` int(11) NOT NULL,
  `internship_program_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `resource_person` varchar(200) NOT NULL,
  `details` text NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `internship_pool_interns`
--

CREATE TABLE `internship_pool_interns` (
  `id` int(11) NOT NULL,
  `manage_internship_pool_id` int(11) NOT NULL,
  `intern_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `internship_students`
--

CREATE TABLE `internship_students` (
  `id` int(11) NOT NULL,
  `internship_foundation_course_id` int(11) NOT NULL,
  `attendee_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `institute_name` varchar(80) DEFAULT NULL,
  `branch` varchar(30) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email_id` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `investor_connects`
--

CREATE TABLE `investor_connects` (
  `id` int(11) NOT NULL,
  `participants` varchar(100) NOT NULL,
  `event_name` longtext NOT NULL,
  `location` longtext NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_academia_connecteds`
--

CREATE TABLE `iot_academia_connecteds` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `college_name` varchar(30) NOT NULL,
  `date_initiation_course` date NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(20) NOT NULL,
  `iot_curriculum` varchar(80) NOT NULL,
  `other` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_delegations`
--

CREATE TABLE `iot_delegations` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `arrived_from` text NOT NULL,
  `date_of_visit` varchar(15) NOT NULL,
  `no_of_people` bigint(15) NOT NULL,
  `industry_type` varchar(100) NOT NULL,
  `month` varchar(15) NOT NULL,
  `phase` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_event_workshops`
--

CREATE TABLE `iot_event_workshops` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `title` varchar(80) NOT NULL,
  `date` varchar(40) NOT NULL,
  `location` varchar(80) DEFAULT NULL,
  `no_registered` varchar(15) DEFAULT NULL,
  `no_attended` varchar(15) DEFAULT NULL,
  `month` varchar(15) DEFAULT NULL,
  `year` int(5) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_global_conference_papers`
--

CREATE TABLE `iot_global_conference_papers` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `publication_date` varchar(20) NOT NULL,
  `conference_name` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `upload_doc` varchar(200) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` varchar(5) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_incubated_researchers`
--

CREATE TABLE `iot_incubated_researchers` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `researcher_name` varchar(200) NOT NULL,
  `date_of_incubation` varchar(20) NOT NULL,
  `research_title` varchar(200) NOT NULL,
  `researcher_email` varchar(150) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` varchar(5) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_industry_connecteds`
--

CREATE TABLE `iot_industry_connecteds` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `company_name` varchar(80) NOT NULL,
  `purpose` text NOT NULL,
  `tech_support` varchar(80) NOT NULL,
  `adopter` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(5) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_intellectual_properties`
--

CREATE TABLE `iot_intellectual_properties` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `iot_start_up_id` int(11) NOT NULL,
  `date_of_filling` varchar(15) DEFAULT NULL,
  `date_of_examination` varchar(15) DEFAULT NULL,
  `geography` varchar(200) DEFAULT NULL,
  `date_of_grant` varchar(15) DEFAULT NULL,
  `corresponding_date` varchar(100) DEFAULT NULL,
  `appl_patent_no` varchar(150) DEFAULT NULL,
  `title` text,
  `is_incubation_start` int(11) DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_mentorings`
--

CREATE TABLE `iot_mentorings` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `date` varchar(15) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `time` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `image` varchar(100) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_occupancies`
--

CREATE TABLE `iot_occupancies` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `seats_occupaid` int(11) NOT NULL,
  `seats_available` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_other_programs`
--

CREATE TABLE `iot_other_programs` (
  `id` int(11) NOT NULL,
  `prog_type` varchar(50) NOT NULL,
  `women_event` varchar(4) NOT NULL,
  `session_date` varchar(15) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `speaker` text NOT NULL,
  `no_of_attended` int(11) NOT NULL,
  `email` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_pilots_projects`
--

CREATE TABLE `iot_pilots_projects` (
  `id` int(11) NOT NULL,
  `iot_start_up_id` int(11) NOT NULL,
  `date_of_started` varchar(15) NOT NULL,
  `date_of_end` varchar(15) NOT NULL,
  `industry_category` varchar(15) NOT NULL,
  `details` text NOT NULL,
  `impact_expected` varchar(150) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_research_incubations`
--

CREATE TABLE `iot_research_incubations` (
  `id` int(11) NOT NULL,
  `selected_type` varchar(100) NOT NULL,
  `name_of_the_startup` varchar(200) NOT NULL,
  `target_year` varchar(50) NOT NULL,
  `target` varchar(100) NOT NULL,
  `detail_of_team` varchar(200) NOT NULL,
  `type_project_handled` varchar(200) NOT NULL,
  `incubation_start_date` date NOT NULL,
  `current_status` varchar(100) NOT NULL,
  `incubation_outcome` varchar(100) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `iot_showcased_prototypes`
--

CREATE TABLE `iot_showcased_prototypes` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `prototype_name` varchar(200) NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `event_date` varchar(20) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` varchar(5) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_startups_rised_funds`
--

CREATE TABLE `iot_startups_rised_funds` (
  `id` int(11) NOT NULL,
  `iot_start_up_id` int(11) NOT NULL,
  `date_of_funding` varchar(15) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `founder_name` varchar(100) DEFAULT NULL,
  `public_announcement_link` varchar(150) DEFAULT NULL,
  `is_incubation_start` int(11) DEFAULT NULL,
  `month` varchar(15) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iot_start_ups`
--

CREATE TABLE `iot_start_ups` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `start_up_name` varchar(100) NOT NULL,
  `vertical` varchar(200) NOT NULL,
  `date_of_incubation` varchar(20) NOT NULL,
  `date_of_graduation` varchar(20) NOT NULL,
  `founder_name` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `founder_email` varchar(150) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `no_employees` varchar(10) NOT NULL,
  `no_employees_women` varchar(10) NOT NULL,
  `no_women_cofounder` varchar(11) NOT NULL,
  `founder_education` varchar(200) NOT NULL,
  `founders_total_man_year` varchar(200) NOT NULL,
  `status_at_start` varchar(200) NOT NULL,
  `is_graduated` int(11) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(5) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ktech_event_conducteds`
--

CREATE TABLE `ktech_event_conducteds` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `title` varchar(80) NOT NULL,
  `date` varchar(15) NOT NULL,
  `speakers` varchar(80) NOT NULL,
  `no_participants` varchar(50) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ktech_fund_raised_startups`
--

CREATE TABLE `ktech_fund_raised_startups` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `startup_name` varchar(50) NOT NULL,
  `fund_amount` varchar(50) NOT NULL,
  `funding_agency` varchar(50) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ktech_mentors`
--

CREATE TABLE `ktech_mentors` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `designation` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ktech_partnerships`
--

CREATE TABLE `ktech_partnerships` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `organization` varchar(80) NOT NULL,
  `partnership_nature` varchar(80) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `liasoning_depts`
--

CREATE TABLE `liasoning_depts` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `dept_name` text NOT NULL,
  `solution_name` longtext NOT NULL,
  `stage` longtext NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_aerospace_defense_trainings`
--

CREATE TABLE `manage_aerospace_defense_trainings` (
  `id` int(11) NOT NULL,
  `internship_program_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `resource_person` varchar(200) NOT NULL,
  `details` text NOT NULL,
  `types` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_aerospace_trainings`
--

CREATE TABLE `manage_aerospace_trainings` (
  `id` int(11) NOT NULL,
  `no_of_training_program` varchar(100) NOT NULL,
  `training_program_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_agriculture_innovations`
--

CREATE TABLE `manage_agriculture_innovations` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `broad_areas_agri_innovation` varchar(200) NOT NULL,
  `no_of_concepts_registered` varchar(100) NOT NULL,
  `detail_innovation` varchar(200) NOT NULL,
  `shortlisted_innvoation_detail` varchar(250) NOT NULL,
  `current_status` varchar(200) NOT NULL,
  `incubation_start_date` date NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `incubation_outcome` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `manage_attendees`
--

CREATE TABLE `manage_attendees` (
  `id` int(11) NOT NULL,
  `manage_training_id` int(11) NOT NULL,
  `attendee_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_bootcamp_attendees`
--

CREATE TABLE `manage_bootcamp_attendees` (
  `id` int(11) NOT NULL,
  `aerospace_defense_bootcamp_id` int(11) NOT NULL,
  `attendee_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_capacity_buildings`
--

CREATE TABLE `manage_capacity_buildings` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `trainer_name` varchar(100) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_capacity_student_details`
--

CREATE TABLE `manage_capacity_student_details` (
  `id` int(11) NOT NULL,
  `manage_capacity_building_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_courses_attendees`
--

CREATE TABLE `manage_courses_attendees` (
  `id` int(11) NOT NULL,
  `aerospace_defense_course_id` int(11) NOT NULL,
  `attendee_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_cyber_securities`
--

CREATE TABLE `manage_cyber_securities` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `list_of_workshops_conducted` text NOT NULL,
  `person_details` text NOT NULL,
  `students_details` text NOT NULL,
  `duration` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_embedded_course_attendees`
--

CREATE TABLE `manage_embedded_course_attendees` (
  `id` int(11) NOT NULL,
  `aerospace_defense_embedded_course_id` int(11) NOT NULL,
  `attendee_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_facilities`
--

CREATE TABLE `manage_facilities` (
  `id` int(11) NOT NULL,
  `list_of_equipments` varchar(100) NOT NULL,
  `no_of_hours_utilized` varchar(100) NOT NULL,
  `yearwise_target` varchar(100) NOT NULL,
  `details_of_revenue` varchar(100) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_intellectual_properties`
--

CREATE TABLE `manage_intellectual_properties` (
  `id` int(11) NOT NULL,
  `ipname` varchar(100) NOT NULL,
  `belongto` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `contact_number` varchar(12) NOT NULL,
  `details` text NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_internship_pools`
--

CREATE TABLE `manage_internship_pools` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `no_of_internships` varchar(100) NOT NULL,
  `internship_program_name` varchar(100) NOT NULL,
  `candidates_registered_details` text NOT NULL,
  `duration` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_iot_curriculums`
--

CREATE TABLE `manage_iot_curriculums` (
  `id` int(11) NOT NULL,
  `name_of_college` varchar(100) NOT NULL,
  `no_of_students` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_iot_student_details`
--

CREATE TABLE `manage_iot_student_details` (
  `id` int(11) NOT NULL,
  `manage_iot_curriculum_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_problem_statements`
--

CREATE TABLE `manage_problem_statements` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `details` varchar(200) NOT NULL,
  `types` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `is_delete` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_problem_statement_details`
--

CREATE TABLE `manage_problem_statement_details` (
  `id` int(11) NOT NULL,
  `manage_problem_statement_id` int(11) NOT NULL,
  `problem_statements` varchar(200) NOT NULL,
  `is_delete` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_research_projects`
--

CREATE TABLE `manage_research_projects` (
  `id` int(11) NOT NULL,
  `no_of_institutes` varchar(100) NOT NULL,
  `research_project_name` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_research_project_industries`
--

CREATE TABLE `manage_research_project_industries` (
  `id` int(11) NOT NULL,
  `no_of_projects` varchar(100) NOT NULL,
  `industry_name` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_skilling_attendees`
--

CREATE TABLE `manage_skilling_attendees` (
  `id` int(11) NOT NULL,
  `aerospace_defense_skilling_id` int(11) NOT NULL,
  `attendee_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_skills`
--

CREATE TABLE `manage_skills` (
  `id` int(11) NOT NULL,
  `no_of_institutes` varchar(100) NOT NULL,
  `training_program_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_skill_attendees`
--

CREATE TABLE `manage_skill_attendees` (
  `id` int(11) NOT NULL,
  `manage_skill_id` int(11) NOT NULL,
  `attendee_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_startups`
--

CREATE TABLE `manage_startups` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `incubation_startup_name` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `type_of_projects` varchar(200) NOT NULL,
  `current_status_project` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `outcome` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_startup_facilitations`
--

CREATE TABLE `manage_startup_facilitations` (
  `id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `man_power` varchar(20) NOT NULL,
  `man_hour` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_trainings`
--

CREATE TABLE `manage_trainings` (
  `id` int(11) NOT NULL,
  `resource_person` varchar(100) NOT NULL,
  `company` varchar(80) NOT NULL,
  `program_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_training_process_attendees`
--

CREATE TABLE `manage_training_process_attendees` (
  `id` int(11) NOT NULL,
  `aerospace_defense_training_process_id` int(11) NOT NULL,
  `attendee_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_white_papers`
--

CREATE TABLE `manage_white_papers` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `no_of_white_papers` varchar(100) NOT NULL,
  `doc_type` varchar(30) NOT NULL,
  `publication_date` varchar(20) NOT NULL,
  `url_link` text NOT NULL,
  `newsletter_upload` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_workings`
--

CREATE TABLE `manage_workings` (
  `id` int(11) NOT NULL,
  `no_of_training` varchar(100) NOT NULL,
  `program_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manage_working_attendees`
--

CREATE TABLE `manage_working_attendees` (
  `id` int(11) NOT NULL,
  `manage_working_id` int(11) NOT NULL,
  `attendee_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `market_researches`
--

CREATE TABLE `market_researches` (
  `id` int(11) NOT NULL,
  `research_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mentors`
--

CREATE TABLE `mentors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `no_of_events` varchar(20) NOT NULL,
  `event_name` longtext NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mentor_details`
--

CREATE TABLE `mentor_details` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `mentor_group` varchar(100) NOT NULL,
  `mentor_interests` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `mentor_company_name` varchar(200) NOT NULL,
  `mentor_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `minro_workshops`
--

CREATE TABLE `minro_workshops` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `title` varchar(80) NOT NULL,
  `date` varchar(40) NOT NULL,
  `location` varchar(80) DEFAULT NULL,
  `resource_person` varchar(200) NOT NULL,
  `no_registered` varchar(15) DEFAULT NULL,
  `no_attended` varchar(15) DEFAULT NULL,
  `month` varchar(15) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_ic_participants`
--

CREATE TABLE `mi_ic_participants` (
  `id` int(11) NOT NULL,
  `mi_international_conferences_id` int(11) NOT NULL,
  `participant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `qualification` varchar(30) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_international_conferences`
--

CREATE TABLE `mi_international_conferences` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `conference_name` varchar(80) NOT NULL,
  `conference_date` date NOT NULL,
  `conference_details` text NOT NULL,
  `workshops` text NOT NULL,
  `paper_presentations` text NOT NULL,
  `plan_for_next_year_conference` text NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_mentorships`
--

CREATE TABLE `mi_mentorships` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `mentor_name` varchar(200) NOT NULL,
  `mentor_company` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `mentorship_start_date` varchar(100) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(5) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mi_officials`
--

CREATE TABLE `mi_officials` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `organization_name` varchar(200) NOT NULL,
  `organization_details` text NOT NULL,
  `department` varchar(200) NOT NULL,
  `date` varchar(10) NOT NULL,
  `training_details` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mi_open_experience_centres`
--

CREATE TABLE `mi_open_experience_centres` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name_of_the_experience_center` varchar(200) NOT NULL,
  `location` varchar(100) NOT NULL,
  `date_of_establishment` varchar(100) NOT NULL,
  `contact_person` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(5) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mi_patents`
--

CREATE TABLE `mi_patents` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `patent_id` varchar(200) NOT NULL,
  `complete_details` text NOT NULL,
  `belongs_to` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL,
  `team_work_details` text NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(5) NOT NULL,
  `deleted` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mi_programs`
--

CREATE TABLE `mi_programs` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `program_name` varchar(100) NOT NULL,
  `program_date` date NOT NULL,
  `program_details` text NOT NULL,
  `program_type` varchar(10) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_program_participants`
--

CREATE TABLE `mi_program_participants` (
  `id` int(11) NOT NULL,
  `mi_programs_id` int(11) NOT NULL,
  `participant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `qualification` varchar(30) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_program_students`
--

CREATE TABLE `mi_program_students` (
  `id` int(11) NOT NULL,
  `mi_programs_id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `collage_name` varchar(80) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_startup_conferences`
--

CREATE TABLE `mi_startup_conferences` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `conference_name` varchar(80) NOT NULL,
  `conference_date` date NOT NULL,
  `conference_details` text NOT NULL,
  `workshops` text NOT NULL,
  `paper_presentations` text NOT NULL,
  `plan_for_next_year_conference` text NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_startup_participants`
--

CREATE TABLE `mi_startup_participants` (
  `id` int(11) NOT NULL,
  `mi_startup_conferences_id` int(11) NOT NULL,
  `participant_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_student_enrollments`
--

CREATE TABLE `mi_student_enrollments` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `clg_details` text NOT NULL,
  `student_type` varchar(20) NOT NULL,
  `thesis_details` text NOT NULL,
  `thesis_status` varchar(20) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(5) NOT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orientation_awareness_courses`
--

CREATE TABLE `orientation_awareness_courses` (
  `id` int(11) NOT NULL,
  `internship_program_name` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `phase` varchar(12) NOT NULL,
  `resource_person` varchar(200) NOT NULL,
  `details` text NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orientation_awareness_students`
--

CREATE TABLE `orientation_awareness_students` (
  `id` int(11) NOT NULL,
  `orientation_awareness_course_id` int(11) DEFAULT NULL,
  `attendee_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `institute_name` varchar(80) DEFAULT NULL,
  `branch` varchar(30) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email_id` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participants_details`
--

CREATE TABLE `participants_details` (
  `id` int(11) NOT NULL,
  `program_type` varchar(30) NOT NULL,
  `program_id` int(11) NOT NULL,
  `participant_name` varchar(30) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `designation` varchar(80) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `partner_details`
--

CREATE TABLE `partner_details` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `partner_type` varchar(100) NOT NULL,
  `sub_type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `partner_name` varchar(200) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `website` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pocs`
--

CREATE TABLE `pocs` (
  `id` int(11) NOT NULL,
  `name_of_the_startup` varchar(200) NOT NULL,
  `after_poc` varchar(200) NOT NULL,
  `target_for_poc` varchar(100) NOT NULL,
  `comercialization` varchar(10) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `research_project_industry_teams`
--

CREATE TABLE `research_project_industry_teams` (
  `id` int(11) NOT NULL,
  `manage_research_project_industry_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `research_project_teams`
--

CREATE TABLE `research_project_teams` (
  `id` int(11) NOT NULL,
  `manage_research_project_id` int(11) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `revenue_generateds`
--

CREATE TABLE `revenue_generateds` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `belongs_to` varchar(20) NOT NULL,
  `quarter` varchar(10) NOT NULL,
  `month` varchar(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(11) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `is_delete` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `societal_projects`
--

CREATE TABLE `societal_projects` (
  `id` int(11) NOT NULL,
  `name_of_the_project` varchar(250) NOT NULL,
  `project_detail` varchar(500) NOT NULL,
  `project_current_status` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `solution_supports`
--

CREATE TABLE `solution_supports` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `solution_name` varchar(200) NOT NULL,
  `type_name` varchar(200) NOT NULL,
  `dept_name` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `successful_companies`
--

CREATE TABLE `successful_companies` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `name` varchar(500) NOT NULL,
  `company_type` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `website` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `deleted` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE `targets` (
  `id` int(11) NOT NULL,
  `type` varchar(40) NOT NULL,
  `count` bigint(10) NOT NULL,
  `year` varchar(50) NOT NULL,
  `month` varchar(10) NOT NULL,
  `phase` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbi_events`
--

CREATE TABLE `tbi_events` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `event_location` varchar(175) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbi_event_participants`
--

CREATE TABLE `tbi_event_participants` (
  `id` int(11) NOT NULL,
  `tbi_event_id` int(11) NOT NULL,
  `participant_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` bigint(20) NOT NULL,
  `email` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbi_startups`
--

CREATE TABLE `tbi_startups` (
  `id` int(11) NOT NULL,
  `phase` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startup_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `startup_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_selected` int(11) NOT NULL,
  `is_incubated` int(11) NOT NULL,
  `incubation_start_date` date NOT NULL,
  `is_innovations_commercialized` int(11) NOT NULL,
  `innovation_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outcome` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_incubated_off_tbi` int(11) NOT NULL,
  `tbi_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tbi_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tbi_outcome` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_graduated` int(11) NOT NULL,
  `graduated_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_event_conducted` int(11) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbi_targets`
--

CREATE TABLE `tbi_targets` (
  `id` int(11) NOT NULL,
  `phase` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` bigint(10) NOT NULL,
  `year` year(4) NOT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainees`
--

CREATE TABLE `trainees` (
  `id` int(11) NOT NULL,
  `trainee` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trainee_secured_jobs`
--

CREATE TABLE `trainee_secured_jobs` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `DOJ` varchar(100) NOT NULL,
  `position` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `college_detail_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `website` varchar(50) NOT NULL,
  `alternate_mobile` varchar(15) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `is_delete` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `sector_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `white_papers`
--

CREATE TABLE `white_papers` (
  `id` int(11) NOT NULL,
  `title_of_the_paper` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `paper_topic` varchar(200) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `author_mail_id` varchar(200) NOT NULL,
  `author_address` varchar(100) NOT NULL,
  `published_status` varchar(10) NOT NULL,
  `published_date` date NOT NULL,
  `year` varchar(20) NOT NULL,
  `month` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_project_based_courses`
--
ALTER TABLE `advance_project_based_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advance_project_students`
--
ALTER TABLE `advance_project_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aerospace_defense_bootcamps`
--
ALTER TABLE `aerospace_defense_bootcamps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aerospace_defense_courses`
--
ALTER TABLE `aerospace_defense_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aerospace_defense_embedded_courses`
--
ALTER TABLE `aerospace_defense_embedded_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aerospace_defense_skillings`
--
ALTER TABLE `aerospace_defense_skillings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aerospace_defense_training_processes`
--
ALTER TABLE `aerospace_defense_training_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aerospace_students`
--
ALTER TABLE `aerospace_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_connects`
--
ALTER TABLE `cif_connects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_customer_satisfactions`
--
ALTER TABLE `cif_customer_satisfactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_expenditures`
--
ALTER TABLE `cif_expenditures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_external_events`
--
ALTER TABLE `cif_external_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_external_event_participants`
--
ALTER TABLE `cif_external_event_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_funds`
--
ALTER TABLE `cif_funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_gender_diversities`
--
ALTER TABLE `cif_gender_diversities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_gender_diversity_participants`
--
ALTER TABLE `cif_gender_diversity_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_organizations`
--
ALTER TABLE `cif_organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_publicity_mentions`
--
ALTER TABLE `cif_publicity_mentions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_roundtables`
--
ALTER TABLE `cif_roundtables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_roundtable_participants`
--
ALTER TABLE `cif_roundtable_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_startups`
--
ALTER TABLE `cif_startups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_startup_rised_funds`
--
ALTER TABLE `cif_startup_rised_funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cif_targets`
--
ALTER TABLE `cif_targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coe_details`
--
ALTER TABLE `coe_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_team_details`
--
ALTER TABLE `company_team_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_followups`
--
ALTER TABLE `dept_followups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_ai_pathshalas`
--
ALTER TABLE `ds_ai_pathshalas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_ai_phy_acc_startups`
--
ALTER TABLE `ds_ai_phy_acc_startups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_ai_trained_faculties`
--
ALTER TABLE `ds_ai_trained_faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_ai_trained_professionals`
--
ALTER TABLE `ds_ai_trained_professionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_ai_trained_students`
--
ALTER TABLE `ds_ai_trained_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_ai_virtual_acc_startups`
--
ALTER TABLE `ds_ai_virtual_acc_startups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_hackathons`
--
ALTER TABLE `ds_hackathons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_hackathon_participants`
--
ALTER TABLE `ds_hackathon_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_investor_connects`
--
ALTER TABLE `ds_investor_connects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_master_classes`
--
ALTER TABLE `ds_master_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_ms_ai_participants`
--
ALTER TABLE `ds_ms_ai_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_report_processes`
--
ALTER TABLE `ds_report_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_report_publisheds`
--
ALTER TABLE `ds_report_publisheds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_solutions_adopteds`
--
ALTER TABLE `ds_solutions_adopteds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_solution_proposeds`
--
ALTER TABLE `ds_solution_proposeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_tech_mentorings`
--
ALTER TABLE `ds_tech_mentorings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolled_trainers`
--
ALTER TABLE `enrolled_trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exited_companies`
--
ALTER TABLE `exited_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fabless_coe_teams`
--
ALTER TABLE `fabless_coe_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financials`
--
ALTER TABLE `financials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_years`
--
ALTER TABLE `financial_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generated_employments`
--
ALTER TABLE `generated_employments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graduate_schools`
--
ALTER TABLE `graduate_schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hackathons`
--
ALTER TABLE `hackathons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incubatee_details`
--
ALTER TABLE `incubatee_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incubatee_team_details`
--
ALTER TABLE `incubatee_team_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internship_foundation_courses`
--
ALTER TABLE `internship_foundation_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internship_pool_interns`
--
ALTER TABLE `internship_pool_interns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internship_students`
--
ALTER TABLE `internship_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investor_connects`
--
ALTER TABLE `investor_connects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_academia_connecteds`
--
ALTER TABLE `iot_academia_connecteds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_delegations`
--
ALTER TABLE `iot_delegations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_event_workshops`
--
ALTER TABLE `iot_event_workshops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_global_conference_papers`
--
ALTER TABLE `iot_global_conference_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_incubated_researchers`
--
ALTER TABLE `iot_incubated_researchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_industry_connecteds`
--
ALTER TABLE `iot_industry_connecteds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_intellectual_properties`
--
ALTER TABLE `iot_intellectual_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_mentorings`
--
ALTER TABLE `iot_mentorings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_occupancies`
--
ALTER TABLE `iot_occupancies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_other_programs`
--
ALTER TABLE `iot_other_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_pilots_projects`
--
ALTER TABLE `iot_pilots_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_research_incubations`
--
ALTER TABLE `iot_research_incubations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_showcased_prototypes`
--
ALTER TABLE `iot_showcased_prototypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_startups_rised_funds`
--
ALTER TABLE `iot_startups_rised_funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iot_start_ups`
--
ALTER TABLE `iot_start_ups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ktech_event_conducteds`
--
ALTER TABLE `ktech_event_conducteds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ktech_fund_raised_startups`
--
ALTER TABLE `ktech_fund_raised_startups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ktech_mentors`
--
ALTER TABLE `ktech_mentors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ktech_partnerships`
--
ALTER TABLE `ktech_partnerships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liasoning_depts`
--
ALTER TABLE `liasoning_depts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_aerospace_defense_trainings`
--
ALTER TABLE `manage_aerospace_defense_trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_aerospace_trainings`
--
ALTER TABLE `manage_aerospace_trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_agriculture_innovations`
--
ALTER TABLE `manage_agriculture_innovations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_attendees`
--
ALTER TABLE `manage_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_bootcamp_attendees`
--
ALTER TABLE `manage_bootcamp_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_capacity_buildings`
--
ALTER TABLE `manage_capacity_buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_capacity_student_details`
--
ALTER TABLE `manage_capacity_student_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_courses_attendees`
--
ALTER TABLE `manage_courses_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_cyber_securities`
--
ALTER TABLE `manage_cyber_securities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_embedded_course_attendees`
--
ALTER TABLE `manage_embedded_course_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_facilities`
--
ALTER TABLE `manage_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_intellectual_properties`
--
ALTER TABLE `manage_intellectual_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_internship_pools`
--
ALTER TABLE `manage_internship_pools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_iot_curriculums`
--
ALTER TABLE `manage_iot_curriculums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_iot_student_details`
--
ALTER TABLE `manage_iot_student_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_problem_statements`
--
ALTER TABLE `manage_problem_statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_problem_statement_details`
--
ALTER TABLE `manage_problem_statement_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_research_projects`
--
ALTER TABLE `manage_research_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_research_project_industries`
--
ALTER TABLE `manage_research_project_industries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_skilling_attendees`
--
ALTER TABLE `manage_skilling_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_skills`
--
ALTER TABLE `manage_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_skill_attendees`
--
ALTER TABLE `manage_skill_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_startups`
--
ALTER TABLE `manage_startups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_startup_facilitations`
--
ALTER TABLE `manage_startup_facilitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_trainings`
--
ALTER TABLE `manage_trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_training_process_attendees`
--
ALTER TABLE `manage_training_process_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_white_papers`
--
ALTER TABLE `manage_white_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_workings`
--
ALTER TABLE `manage_workings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_working_attendees`
--
ALTER TABLE `manage_working_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market_researches`
--
ALTER TABLE `market_researches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentors`
--
ALTER TABLE `mentors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentor_details`
--
ALTER TABLE `mentor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minro_workshops`
--
ALTER TABLE `minro_workshops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_ic_participants`
--
ALTER TABLE `mi_ic_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_international_conferences`
--
ALTER TABLE `mi_international_conferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_mentorships`
--
ALTER TABLE `mi_mentorships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_officials`
--
ALTER TABLE `mi_officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_open_experience_centres`
--
ALTER TABLE `mi_open_experience_centres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_patents`
--
ALTER TABLE `mi_patents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_programs`
--
ALTER TABLE `mi_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_program_participants`
--
ALTER TABLE `mi_program_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_program_students`
--
ALTER TABLE `mi_program_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_startup_conferences`
--
ALTER TABLE `mi_startup_conferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_startup_participants`
--
ALTER TABLE `mi_startup_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_student_enrollments`
--
ALTER TABLE `mi_student_enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orientation_awareness_courses`
--
ALTER TABLE `orientation_awareness_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orientation_awareness_students`
--
ALTER TABLE `orientation_awareness_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants_details`
--
ALTER TABLE `participants_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_details`
--
ALTER TABLE `partner_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pocs`
--
ALTER TABLE `pocs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `research_project_industry_teams`
--
ALTER TABLE `research_project_industry_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `research_project_teams`
--
ALTER TABLE `research_project_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenue_generateds`
--
ALTER TABLE `revenue_generateds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `societal_projects`
--
ALTER TABLE `societal_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solution_supports`
--
ALTER TABLE `solution_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `successful_companies`
--
ALTER TABLE `successful_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbi_events`
--
ALTER TABLE `tbi_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbi_event_participants`
--
ALTER TABLE `tbi_event_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbi_startups`
--
ALTER TABLE `tbi_startups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbi_targets`
--
ALTER TABLE `tbi_targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainee_secured_jobs`
--
ALTER TABLE `trainee_secured_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `white_papers`
--
ALTER TABLE `white_papers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_project_based_courses`
--
ALTER TABLE `advance_project_based_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advance_project_students`
--
ALTER TABLE `advance_project_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aerospace_defense_bootcamps`
--
ALTER TABLE `aerospace_defense_bootcamps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aerospace_defense_courses`
--
ALTER TABLE `aerospace_defense_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aerospace_defense_embedded_courses`
--
ALTER TABLE `aerospace_defense_embedded_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aerospace_defense_skillings`
--
ALTER TABLE `aerospace_defense_skillings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aerospace_defense_training_processes`
--
ALTER TABLE `aerospace_defense_training_processes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aerospace_students`
--
ALTER TABLE `aerospace_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_connects`
--
ALTER TABLE `cif_connects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_customer_satisfactions`
--
ALTER TABLE `cif_customer_satisfactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_expenditures`
--
ALTER TABLE `cif_expenditures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_external_events`
--
ALTER TABLE `cif_external_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_external_event_participants`
--
ALTER TABLE `cif_external_event_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_funds`
--
ALTER TABLE `cif_funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_gender_diversities`
--
ALTER TABLE `cif_gender_diversities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_gender_diversity_participants`
--
ALTER TABLE `cif_gender_diversity_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_organizations`
--
ALTER TABLE `cif_organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_publicity_mentions`
--
ALTER TABLE `cif_publicity_mentions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_roundtables`
--
ALTER TABLE `cif_roundtables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_roundtable_participants`
--
ALTER TABLE `cif_roundtable_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_startups`
--
ALTER TABLE `cif_startups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_startup_rised_funds`
--
ALTER TABLE `cif_startup_rised_funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cif_targets`
--
ALTER TABLE `cif_targets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coe_details`
--
ALTER TABLE `coe_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_team_details`
--
ALTER TABLE `company_team_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dept_followups`
--
ALTER TABLE `dept_followups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_ai_pathshalas`
--
ALTER TABLE `ds_ai_pathshalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_ai_phy_acc_startups`
--
ALTER TABLE `ds_ai_phy_acc_startups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_ai_trained_faculties`
--
ALTER TABLE `ds_ai_trained_faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_ai_trained_professionals`
--
ALTER TABLE `ds_ai_trained_professionals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_ai_trained_students`
--
ALTER TABLE `ds_ai_trained_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_ai_virtual_acc_startups`
--
ALTER TABLE `ds_ai_virtual_acc_startups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_hackathons`
--
ALTER TABLE `ds_hackathons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_hackathon_participants`
--
ALTER TABLE `ds_hackathon_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_investor_connects`
--
ALTER TABLE `ds_investor_connects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_master_classes`
--
ALTER TABLE `ds_master_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_ms_ai_participants`
--
ALTER TABLE `ds_ms_ai_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_report_processes`
--
ALTER TABLE `ds_report_processes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_report_publisheds`
--
ALTER TABLE `ds_report_publisheds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_solutions_adopteds`
--
ALTER TABLE `ds_solutions_adopteds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_solution_proposeds`
--
ALTER TABLE `ds_solution_proposeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ds_tech_mentorings`
--
ALTER TABLE `ds_tech_mentorings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrolled_trainers`
--
ALTER TABLE `enrolled_trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exited_companies`
--
ALTER TABLE `exited_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenditures`
--
ALTER TABLE `expenditures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fabless_coe_teams`
--
ALTER TABLE `fabless_coe_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financials`
--
ALTER TABLE `financials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_years`
--
ALTER TABLE `financial_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generated_employments`
--
ALTER TABLE `generated_employments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `graduate_schools`
--
ALTER TABLE `graduate_schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hackathons`
--
ALTER TABLE `hackathons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incubatee_details`
--
ALTER TABLE `incubatee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incubatee_team_details`
--
ALTER TABLE `incubatee_team_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internship_foundation_courses`
--
ALTER TABLE `internship_foundation_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internship_pool_interns`
--
ALTER TABLE `internship_pool_interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internship_students`
--
ALTER TABLE `internship_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investor_connects`
--
ALTER TABLE `investor_connects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_academia_connecteds`
--
ALTER TABLE `iot_academia_connecteds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_delegations`
--
ALTER TABLE `iot_delegations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_event_workshops`
--
ALTER TABLE `iot_event_workshops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_global_conference_papers`
--
ALTER TABLE `iot_global_conference_papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_incubated_researchers`
--
ALTER TABLE `iot_incubated_researchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_industry_connecteds`
--
ALTER TABLE `iot_industry_connecteds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_intellectual_properties`
--
ALTER TABLE `iot_intellectual_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_mentorings`
--
ALTER TABLE `iot_mentorings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_occupancies`
--
ALTER TABLE `iot_occupancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_other_programs`
--
ALTER TABLE `iot_other_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_pilots_projects`
--
ALTER TABLE `iot_pilots_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_research_incubations`
--
ALTER TABLE `iot_research_incubations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_showcased_prototypes`
--
ALTER TABLE `iot_showcased_prototypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_startups_rised_funds`
--
ALTER TABLE `iot_startups_rised_funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iot_start_ups`
--
ALTER TABLE `iot_start_ups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ktech_event_conducteds`
--
ALTER TABLE `ktech_event_conducteds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ktech_fund_raised_startups`
--
ALTER TABLE `ktech_fund_raised_startups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ktech_mentors`
--
ALTER TABLE `ktech_mentors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ktech_partnerships`
--
ALTER TABLE `ktech_partnerships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liasoning_depts`
--
ALTER TABLE `liasoning_depts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_aerospace_defense_trainings`
--
ALTER TABLE `manage_aerospace_defense_trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_aerospace_trainings`
--
ALTER TABLE `manage_aerospace_trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_agriculture_innovations`
--
ALTER TABLE `manage_agriculture_innovations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_attendees`
--
ALTER TABLE `manage_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_bootcamp_attendees`
--
ALTER TABLE `manage_bootcamp_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_capacity_buildings`
--
ALTER TABLE `manage_capacity_buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_capacity_student_details`
--
ALTER TABLE `manage_capacity_student_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_courses_attendees`
--
ALTER TABLE `manage_courses_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_cyber_securities`
--
ALTER TABLE `manage_cyber_securities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_embedded_course_attendees`
--
ALTER TABLE `manage_embedded_course_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_facilities`
--
ALTER TABLE `manage_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_intellectual_properties`
--
ALTER TABLE `manage_intellectual_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_internship_pools`
--
ALTER TABLE `manage_internship_pools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_iot_curriculums`
--
ALTER TABLE `manage_iot_curriculums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_iot_student_details`
--
ALTER TABLE `manage_iot_student_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_problem_statements`
--
ALTER TABLE `manage_problem_statements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_problem_statement_details`
--
ALTER TABLE `manage_problem_statement_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_research_projects`
--
ALTER TABLE `manage_research_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_research_project_industries`
--
ALTER TABLE `manage_research_project_industries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_skilling_attendees`
--
ALTER TABLE `manage_skilling_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_skills`
--
ALTER TABLE `manage_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_skill_attendees`
--
ALTER TABLE `manage_skill_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_startups`
--
ALTER TABLE `manage_startups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_startup_facilitations`
--
ALTER TABLE `manage_startup_facilitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_trainings`
--
ALTER TABLE `manage_trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_training_process_attendees`
--
ALTER TABLE `manage_training_process_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_white_papers`
--
ALTER TABLE `manage_white_papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_workings`
--
ALTER TABLE `manage_workings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_working_attendees`
--
ALTER TABLE `manage_working_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `market_researches`
--
ALTER TABLE `market_researches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mentors`
--
ALTER TABLE `mentors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mentor_details`
--
ALTER TABLE `mentor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `minro_workshops`
--
ALTER TABLE `minro_workshops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_ic_participants`
--
ALTER TABLE `mi_ic_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_international_conferences`
--
ALTER TABLE `mi_international_conferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_mentorships`
--
ALTER TABLE `mi_mentorships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_officials`
--
ALTER TABLE `mi_officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_open_experience_centres`
--
ALTER TABLE `mi_open_experience_centres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_patents`
--
ALTER TABLE `mi_patents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_programs`
--
ALTER TABLE `mi_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_program_participants`
--
ALTER TABLE `mi_program_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_program_students`
--
ALTER TABLE `mi_program_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_startup_conferences`
--
ALTER TABLE `mi_startup_conferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_startup_participants`
--
ALTER TABLE `mi_startup_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_student_enrollments`
--
ALTER TABLE `mi_student_enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orientation_awareness_courses`
--
ALTER TABLE `orientation_awareness_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orientation_awareness_students`
--
ALTER TABLE `orientation_awareness_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants_details`
--
ALTER TABLE `participants_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partner_details`
--
ALTER TABLE `partner_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pocs`
--
ALTER TABLE `pocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `research_project_industry_teams`
--
ALTER TABLE `research_project_industry_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `research_project_teams`
--
ALTER TABLE `research_project_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revenue_generateds`
--
ALTER TABLE `revenue_generateds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `societal_projects`
--
ALTER TABLE `societal_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solution_supports`
--
ALTER TABLE `solution_supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `successful_companies`
--
ALTER TABLE `successful_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `targets`
--
ALTER TABLE `targets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbi_events`
--
ALTER TABLE `tbi_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbi_event_participants`
--
ALTER TABLE `tbi_event_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbi_startups`
--
ALTER TABLE `tbi_startups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbi_targets`
--
ALTER TABLE `tbi_targets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainee_secured_jobs`
--
ALTER TABLE `trainee_secured_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `white_papers`
--
ALTER TABLE `white_papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
