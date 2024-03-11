-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 12:18 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pup_profiles`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_appointments`
--

CREATE TABLE `academic_appointments` (
  `academic_appointment_id` int(100) NOT NULL,
  `academic_appointment_user_id` int(100) NOT NULL,
  `academic_position` varchar(100) DEFAULT NULL,
  `academic_field` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_appointments`
--

INSERT INTO `academic_appointments` (`academic_appointment_id`, `academic_appointment_user_id`, `academic_position`, `academic_field`) VALUES
(4, 43, 'Associate Professor', 'Polytechnic University of the Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `access_codes`
--

CREATE TABLE `access_codes` (
  `access_code_id` int(100) NOT NULL,
  `access_course_id` int(100) NOT NULL,
  `access_code` varchar(50) DEFAULT NULL,
  `access_code_start_date` date DEFAULT NULL,
  `access_code_end_date` date DEFAULT NULL,
  `access_code_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_codes`
--

INSERT INTO `access_codes` (`access_code_id`, `access_course_id`, `access_code`, `access_code_start_date`, `access_code_end_date`, `access_code_status`) VALUES
(29, 1, 'ZL8HU-5C8ME-3GM2L', '2023-11-30', '2024-07-19', 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `administrative_appointments`
--

CREATE TABLE `administrative_appointments` (
  `administrative_appointment_id` int(100) NOT NULL,
  `administrative_appointment_user_id` int(100) NOT NULL,
  `administrative_position` varchar(100) DEFAULT NULL,
  `administrative_organization` varchar(100) DEFAULT NULL,
  `administrative_start_date` date DEFAULT NULL,
  `administrative_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrative_appointments`
--

INSERT INTO `administrative_appointments` (`administrative_appointment_id`, `administrative_appointment_user_id`, `administrative_position`, `administrative_organization`, `administrative_start_date`, `administrative_end_date`) VALUES
(3, 43, 'CCIS Research Lead', 'Department of Computer Science', '2024-12-01', '2024-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(100) NOT NULL,
  `book_user_id` int(100) NOT NULL,
  `book_title` varchar(100) DEFAULT NULL,
  `book_author` varchar(100) DEFAULT NULL,
  `book_description` text DEFAULT NULL,
  `book_url` varchar(255) DEFAULT NULL,
  `book_publish_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_user_id`, `book_title`, `book_author`, `book_description`, `book_url`, `book_publish_date`) VALUES
(2, 43, 'Incorporating deblurring techniques in multiple recognition of license plates from video sequences', 'Ria A. Sagum', 'This project focuses on enhancing the accuracy of license plate recognition in video sequences by incorporating advanced deblurring techniques. By addressing the challenges posed by blurred or distorted images, the system aims to improve the overall performance of license plate recognition systems, ensuring more reliable and efficient identification of license plates in dynamic video environments. The integration of deblurring techniques enhances the system\'s ability to handle various real-world scenarios, such as motion blur or poor lighting conditions, ultimately contributing to the robustness and effectiveness of the license plate recognition process in surveillance and traffic monitoring applications.', 'https://www.turcomat.org/index.php/turkbilmat/article/download/2194/1918', '2021-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(100) NOT NULL,
  `course_user_id` int(100) NOT NULL,
  `course_title` varchar(100) DEFAULT NULL,
  `course_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_user_id`, `course_title`, `course_description`) VALUES
(1, 33, 'Capstone 2', 'The Capstone Project is a two-semester process in which students pursue independent research on a question or problem of their choice, engage with the scholarly debates in the relevant disciplines, and - with the guidance of a faculty mentor - produce a substantial paper that reflects a deep understanding of the topic.');

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `extension_id` int(100) NOT NULL,
  `extension_user_id` int(100) NOT NULL,
  `extension_name` varchar(100) DEFAULT NULL,
  `extension_relationship` varchar(100) DEFAULT NULL,
  `extension_start_date` varchar(20) DEFAULT NULL,
  `extension_end_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`extension_id`, `extension_user_id`, `extension_name`, `extension_relationship`, `extension_start_date`, `extension_end_date`) VALUES
(4, 43, 'UCD Postgraduate Journal of Computer Science', 'Editor in Chief', '2017', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `honors_awards`
--

CREATE TABLE `honors_awards` (
  `awards_id` int(100) NOT NULL,
  `awards_user_id` int(100) NOT NULL,
  `award_title` varchar(100) DEFAULT NULL,
  `award_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `honors_awards`
--

INSERT INTO `honors_awards` (`awards_id`, `awards_user_id`, `award_title`, `award_date`) VALUES
(2, 43, 'Neural Network Breakthrough Recognition', '2020-02-07'),
(3, 43, 'AI Innovation Excellence Award', '2022-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_materials`
--

CREATE TABLE `lecture_materials` (
  `lecture_material_id` int(100) NOT NULL,
  `lecture_course_id` int(100) NOT NULL,
  `lecture_title` varchar(50) DEFAULT NULL,
  `lecture_description` text DEFAULT NULL,
  `lecture_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecture_materials`
--

INSERT INTO `lecture_materials` (`lecture_material_id`, `lecture_course_id`, `lecture_title`, `lecture_description`, `lecture_url`) VALUES
(14, 1, 'System Analysis and Design', 'It is a process of collecting and interpreting facts, identifying the problems, and decomposition of a system into its components.\r\n\r\nSystem analysis is conducted for the purpose of studying a system or its parts in order to identify its objectives. It is a problem solving technique that improves the system and ensures that all the components of the system work efficiently to accomplish their purpose.\r\n\r\nAnalysis specifies what the system should do.', 'https://www.tutorialspoint.com/system_analysis_and_design/system_analysis_and_design_overview.htm');

-- --------------------------------------------------------

--
-- Table structure for table `other_accounts`
--

CREATE TABLE `other_accounts` (
  `link_id` int(100) NOT NULL,
  `link_user_id` int(100) NOT NULL,
  `link_name` varchar(20) DEFAULT NULL,
  `link_url` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `other_accounts`
--

INSERT INTO `other_accounts` (`link_id`, `link_user_id`, `link_name`, `link_url`) VALUES
(1, 33, 'icon-facebook', 'https://www.facebook.com/Vincent821'),
(2, 33, 'icon-x', 'some link'),
(4, 43, 'icon-orcid', 'https://www.scopus.com/redirect.uri?url=https://orcid.org/0000-0002-7343-5297&authorId=56741141100&origin=AuthorProfile&orcId=0000-0002-7343-5297&category=orcidLink'),
(5, 43, 'icon-google-scholar', ' https://scholar.google.com.ph/citations?user=17uBX7AAAAAJ&hl=en'),
(8, 43, 'icon-info-circle', 'some link'),
(9, 43, 'icon-info-circle', 'some link');

-- --------------------------------------------------------

--
-- Table structure for table `pup_advisees`
--

CREATE TABLE `pup_advisees` (
  `advisee_id` int(100) NOT NULL,
  `advisee_user_id` int(100) NOT NULL,
  `advisee_course_name` varchar(100) DEFAULT NULL,
  `advisee_course_year` varchar(20) DEFAULT NULL,
  `advisee_course_section` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pup_advisees`
--

INSERT INTO `pup_advisees` (`advisee_id`, `advisee_user_id`, `advisee_course_name`, `advisee_course_year`, `advisee_course_section`) VALUES
(2, 43, 'BSIT', '4', '2N'),
(3, 43, 'BSIT', '4', '1N');

-- --------------------------------------------------------

--
-- Table structure for table `research_interests`
--

CREATE TABLE `research_interests` (
  `research_interest_id` int(100) NOT NULL,
  `research_interest_user_id` int(100) NOT NULL,
  `research_interest_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `research_interests`
--

INSERT INTO `research_interests` (`research_interest_id`, `research_interest_user_id`, `research_interest_description`) VALUES
(2, 43, 'System Analysis Design');

-- --------------------------------------------------------

--
-- Table structure for table `selected_publications`
--

CREATE TABLE `selected_publications` (
  `publication_id` int(100) NOT NULL,
  `publication_user_id` int(100) NOT NULL,
  `publication_title` varchar(100) DEFAULT NULL,
  `publication_description` text DEFAULT NULL,
  `publication_author` varchar(100) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `publication_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `selected_publications`
--

INSERT INTO `selected_publications` (`publication_id`, `publication_user_id`, `publication_title`, `publication_description`, `publication_author`, `publication_date`, `publication_link`) VALUES
(2, 43, 'Interbot: A credential verification chatbot using an enhanced example based dialog model', 'Traditional resume based recruitment interviews and in-person interviews only allow companies to handle only a limited number of job applicants at a time. As a result, a substantial amount of time and money is misdirected on interviewing unqualified job applicants. The proponents developed a resume based employment interview chatbot, using an enhanced example based dialog model, to evaluate job applicants’ consistency in their resume details and interview answers. The chatbot will replace the HR interviewer while maintaining the fundamental quality and naturalness of a resume based interview. The study aimed to improve the current hiring process, specifically the initial resume based interview conducted during job applicants’ screening and also utilized the potential of chatbots to further improve their simulation of intelligent conversations by having an in-depth analysis on the content and meaning of the user’s input.', 'Andrea G. Aquino, Katherine R. Bayona, Kimberly D. Gonzales, Gabrielle D. Reyes, Ria A. Sagum', '2014-08-01', 'https://www.academia.edu/download/73330639/8666cc46ad5c3258abdcc856b72e82e60fc8.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `timeline_posts`
--

CREATE TABLE `timeline_posts` (
  `timeline_post_id` int(100) NOT NULL,
  `timeline_post_user_id` int(100) NOT NULL,
  `timeline_post_type` varchar(20) DEFAULT NULL,
  `timeline_post_title` varchar(100) DEFAULT NULL,
  `timeline_post_description` text DEFAULT NULL,
  `timeline_post_start_date` datetime DEFAULT NULL,
  `timeline_post_end_date` datetime DEFAULT NULL,
  `timeline_post_url` varchar(255) DEFAULT NULL,
  `timeline_post_media` varchar(255) DEFAULT NULL,
  `timeline_post_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeline_posts`
--

INSERT INTO `timeline_posts` (`timeline_post_id`, `timeline_post_user_id`, `timeline_post_type`, `timeline_post_title`, `timeline_post_description`, `timeline_post_start_date`, `timeline_post_end_date`, `timeline_post_url`, `timeline_post_media`, `timeline_post_date`) VALUES
(23, 34, 'Post', NULL, 'Training of Trainers 1 Study Visit at the University of Alicante: A Deep Dive into Entrepreneurship and Tourism', NULL, NULL, NULL, '1701150914.jpg', '2023-11-28 13:55:14'),
(24, 39, 'Announcement', 'We did it again!', 'A great ranking of our university.', NULL, NULL, 'https://www.pup.edu.ph/', '1701160165.jpg', '2023-11-28 16:29:25'),
(25, 40, 'Post', NULL, 'Joint conference with international students from Ukraine.', NULL, NULL, NULL, '1701160275.jpg', '2023-11-28 16:31:15'),
(26, 36, 'Event', 'Google Cloud Knowledge Conference', 'Sharing our knowledge with the young minds of the future. Come join us as we further celebrate this battle of minds.', '2024-01-25 08:00:00', '2024-01-31 17:00:00', 'https://www.pup.edu.ph/news/?go=27zN3HlxAFM%3d', '1701160429.jpg', '2023-11-28 16:33:49'),
(27, 35, 'Announcement', 'Biology students bag best oral presenter award in Asian Mycological Congress 2023', 'Three outstanding biology researcher-students of Polytechnic University of the Philippines (PUP) Rommel Aban, Abigail Indong, and Alethea Lopez presented their innovative study in Asian Mycology Congress 2023, clinching the best oral presenter award, in Busan South Korea on October 10–13, 2023.\\r\\n\\r\\nThe trio’s thesis, titled “Validation of Colletotrichum asianum Detection: A Comparative Study between PUP DETECT LAMP Assay Kit and Conventional PCR,” presented by Lopez, who won the best oral presenter, focused to validate the recently developed PUP DETECT LAMP Assay Kit (PDLAK) vs. Polymerase Chain Reaction (PCR), both methods to detect Colletotrichum asianum (C. asianum) to the renowned Philippine carabao mangoes.\\r\\n\\r\\nAccording to Lopez, C. asianum silently infects healthy mango plant tissues, remaining symptomless until the post-harvest stage when it causes unsightly black, rotten-like spots on mango skins.\\r\\n\\r\\n“In the case of C. asianum, it infects healthy mango plant tissues as an endophyte, and the infection’s visible effects are typically most pronounced during the post-harvest stage.” Lopez mentioned.', NULL, NULL, 'https://www.pup.edu.ph/news/?go=uASQLX40JGU%3d', '1701160534.jpg', '2023-11-28 16:35:34'),
(28, 43, 'Post', NULL, 'Paper presentation incoming. Look forward to it.', NULL, NULL, NULL, '1701164251.jpg', '2023-11-28 17:37:12'),
(29, 43, 'Event', ' International Research Conference on Higher Education (IRCHE) 2021', 'As part of the organizing committee, I, Ria A. Sagum, would like to invite you to participate as oral presenter or attendee in the International Research Conference on Higher Education (IRCHE) 2021 on December 13-16, 2021. Aside from being organized by the Polytechnic University of the Philippines, this multidisciplinary research conference is endorsed by the Commission on Higher Education (CHED) Region 3 and the Philippine Association of State Universities and Colleges (PASUC).', '2024-01-01 08:00:00', '2024-02-01 12:00:00', 'https://irche2021.wixsite.com/irche2021?fbclid=IwAR1HjPfR3siVD_abY8OcnMtXHZHRPyIN6J5h4XOkNW6xBtrLeqIYjs5TfnU', '1701164310.jpg', '2023-11-28 17:38:30'),
(45, 43, 'Post', NULL, '1', NULL, NULL, NULL, NULL, '2024-01-09 13:33:39'),
(46, 43, 'Post', NULL, '2', NULL, NULL, NULL, NULL, '2024-01-09 13:33:45'),
(47, 43, 'Post', NULL, '3', NULL, NULL, NULL, NULL, '2024-01-09 13:33:53'),
(48, 43, 'Post', NULL, '4', NULL, NULL, NULL, NULL, '2024-01-09 13:33:59'),
(49, 43, 'Post', NULL, '5', NULL, NULL, NULL, NULL, '2024-01-09 13:34:05'),
(50, 43, 'Post', NULL, '6', NULL, NULL, NULL, NULL, '2024-01-09 13:34:12'),
(51, 43, 'Post', NULL, '7', NULL, NULL, NULL, NULL, '2024-01-09 13:34:17'),
(52, 43, 'Post', NULL, '8', NULL, NULL, NULL, NULL, '2024-01-09 13:34:24'),
(53, 43, 'Post', NULL, '9', NULL, NULL, NULL, NULL, '2024-01-09 13:34:31'),
(54, 43, 'Post', NULL, '10', NULL, NULL, NULL, NULL, '2024-01-09 13:34:38'),
(55, 43, 'Post', NULL, '11', NULL, NULL, NULL, NULL, '2024-01-09 13:34:44'),
(56, 43, 'Post', NULL, '12', NULL, NULL, NULL, NULL, '2024-01-09 13:34:51'),
(57, 43, 'Post', NULL, '13', NULL, NULL, NULL, NULL, '2024-01-09 13:34:58'),
(58, 43, 'Post', NULL, '14', NULL, NULL, NULL, NULL, '2024-01-09 13:35:05'),
(59, 43, 'Post', NULL, '15', NULL, NULL, NULL, NULL, '2024-01-09 13:35:12'),
(60, 43, 'Post', NULL, '16', NULL, NULL, NULL, NULL, '2024-01-09 13:53:02'),
(61, 43, 'Post', NULL, '17', NULL, NULL, NULL, NULL, '2024-01-09 13:53:08'),
(62, 43, 'Post', NULL, '18', NULL, NULL, NULL, NULL, '2024-01-09 13:53:15'),
(63, 43, 'Post', NULL, '19', NULL, NULL, NULL, NULL, '2024-01-09 13:53:22'),
(64, 43, 'Post', NULL, '20', NULL, NULL, NULL, NULL, '2024-01-09 13:53:28'),
(65, 43, 'Post', NULL, '21', NULL, NULL, NULL, NULL, '2024-01-09 13:55:00'),
(66, 43, 'Post', NULL, '22', NULL, NULL, NULL, NULL, '2024-01-09 13:55:52'),
(67, 43, 'Post', NULL, '23', NULL, NULL, NULL, NULL, '2024-01-09 14:02:23'),
(68, 43, 'Post', NULL, '24', NULL, NULL, NULL, NULL, '2024-01-09 14:04:16'),
(69, 43, 'Post', NULL, '25', NULL, NULL, NULL, NULL, '2024-01-09 14:05:53'),
(70, 43, 'Post', NULL, '26', NULL, NULL, NULL, NULL, '2024-01-09 14:11:51'),
(72, 43, 'Post', NULL, '27', NULL, NULL, NULL, NULL, '2024-01-09 14:13:10'),
(73, 43, 'Post', NULL, '28', NULL, NULL, NULL, NULL, '2024-01-09 14:35:12'),
(74, 43, 'Post', NULL, '29', NULL, NULL, NULL, NULL, '2024-01-09 14:35:40'),
(76, 43, 'Post', NULL, '30', NULL, NULL, NULL, NULL, '2024-01-09 14:45:16'),
(77, 43, 'Post', NULL, '31', NULL, NULL, NULL, NULL, '2024-01-09 14:48:32'),
(78, 43, 'Post', NULL, '32', NULL, NULL, NULL, NULL, '2024-01-09 14:50:11'),
(79, 43, 'Post', NULL, '33', NULL, NULL, NULL, NULL, '2024-01-09 14:50:45'),
(80, 43, 'Post', NULL, '34', NULL, NULL, NULL, NULL, '2024-01-09 14:58:57'),
(81, 43, 'Post', NULL, '35', NULL, NULL, NULL, NULL, '2024-01-09 14:59:33'),
(82, 43, 'Post', NULL, '36', NULL, NULL, NULL, NULL, '2024-01-09 15:01:07'),
(83, 43, 'Post', NULL, '37', NULL, NULL, NULL, NULL, '2024-01-09 15:01:58'),
(84, 43, 'Post', NULL, '38', NULL, NULL, NULL, NULL, '2024-01-09 15:04:40'),
(85, 43, 'Post', NULL, '39', NULL, NULL, NULL, NULL, '2024-01-09 15:08:16'),
(86, 43, 'Post', NULL, '40', NULL, NULL, NULL, NULL, '2024-01-09 15:10:10'),
(87, 43, 'Post', NULL, '41', NULL, NULL, NULL, NULL, '2024-01-09 15:12:23'),
(88, 43, 'Post', NULL, '42', NULL, NULL, NULL, NULL, '2024-01-09 15:13:05'),
(89, 43, 'Post', NULL, '43 updated', NULL, NULL, NULL, NULL, '2024-01-09 15:14:05'),
(90, 43, 'Post', NULL, '44', NULL, NULL, NULL, NULL, '2024-01-09 15:14:22'),
(91, 43, 'Post', NULL, '45', NULL, NULL, NULL, NULL, '2024-01-09 15:15:23'),
(92, 43, 'Post', NULL, '46', NULL, NULL, NULL, NULL, '2024-01-09 15:16:14'),
(93, 43, 'Post', NULL, '47', NULL, NULL, NULL, NULL, '2024-01-09 15:20:38'),
(94, 43, 'Post', NULL, '48', NULL, NULL, NULL, NULL, '2024-01-09 15:21:23'),
(95, 43, 'Post', NULL, '49', NULL, NULL, NULL, NULL, '2024-01-09 15:23:16'),
(96, 43, 'Post', NULL, '50', NULL, NULL, NULL, NULL, '2024-01-09 15:24:16'),
(97, 43, 'Post', NULL, '51', NULL, NULL, NULL, NULL, '2024-01-09 15:25:11'),
(98, 43, 'Post', NULL, '52', NULL, NULL, NULL, NULL, '2024-01-09 15:25:34'),
(99, 43, 'Post', NULL, '53', NULL, NULL, NULL, NULL, '2024-01-09 15:28:46'),
(100, 43, 'Post', NULL, '54', NULL, NULL, NULL, NULL, '2024-01-09 15:31:10'),
(101, 43, 'Post', NULL, '55', NULL, NULL, NULL, NULL, '2024-01-09 15:32:17'),
(102, 43, 'Post', NULL, '56', NULL, NULL, NULL, NULL, '2024-01-09 15:35:27'),
(103, 43, 'Post', NULL, '57', NULL, NULL, NULL, NULL, '2024-01-09 15:35:56'),
(104, 43, 'Post', NULL, '58', NULL, NULL, NULL, NULL, '2024-01-09 15:38:26'),
(105, 43, 'Post', NULL, '59', NULL, NULL, NULL, NULL, '2024-01-09 15:39:45'),
(106, 43, 'Post', NULL, '60', NULL, NULL, NULL, NULL, '2024-01-09 15:40:38'),
(107, 43, 'Post', NULL, '61', NULL, NULL, NULL, NULL, '2024-01-09 15:41:15'),
(108, 43, 'Post', NULL, '62', NULL, NULL, NULL, NULL, '2024-01-09 15:42:41'),
(109, 43, 'Post', NULL, '63', NULL, NULL, NULL, NULL, '2024-01-09 15:43:18'),
(110, 43, 'Post', NULL, '64', NULL, NULL, NULL, NULL, '2024-01-09 15:43:46'),
(111, 43, 'Post', NULL, '65', NULL, NULL, NULL, NULL, '2024-01-09 15:44:02'),
(112, 43, 'Post', NULL, '66', NULL, NULL, NULL, NULL, '2024-01-09 15:45:14'),
(113, 43, 'Post', NULL, '67', NULL, NULL, NULL, NULL, '2024-01-09 15:45:34'),
(114, 43, 'Post', NULL, '68', NULL, NULL, NULL, NULL, '2024-01-09 15:45:58'),
(115, 43, 'Post', NULL, '69', NULL, NULL, NULL, NULL, '2024-01-09 15:48:41'),
(116, 43, 'Post', NULL, '70', NULL, NULL, NULL, NULL, '2024-01-09 15:50:36'),
(117, 43, 'Post', NULL, '71', NULL, NULL, NULL, NULL, '2024-01-09 15:51:08'),
(118, 43, 'Post', NULL, '72', NULL, NULL, NULL, NULL, '2024-01-09 15:51:21'),
(119, 43, 'Post', NULL, '73', NULL, NULL, NULL, NULL, '2024-01-09 15:51:31'),
(120, 43, 'Post', NULL, '74', NULL, NULL, NULL, NULL, '2024-01-09 15:51:44'),
(121, 43, 'Post', NULL, '75', NULL, NULL, NULL, NULL, '2024-01-09 15:51:53'),
(122, 43, 'Post', NULL, '76', NULL, NULL, NULL, NULL, '2024-01-09 15:55:33'),
(125, 43, 'Post', NULL, '77', NULL, NULL, NULL, NULL, '2024-01-09 16:01:36'),
(126, 43, 'Post', NULL, '78', NULL, NULL, NULL, NULL, '2024-01-09 16:04:18'),
(127, 43, 'Post', NULL, '79 updated again', NULL, NULL, NULL, NULL, '2024-01-09 16:04:31'),
(128, 43, 'Post', NULL, '80 updated again', NULL, NULL, NULL, NULL, '2024-01-09 16:04:41'),
(132, 43, 'Post', NULL, '81', NULL, NULL, NULL, NULL, '2024-01-09 16:14:09'),
(133, 43, 'Post', NULL, 'New post with pagination updated once', NULL, NULL, NULL, NULL, '2024-01-09 16:20:59'),
(134, 43, 'Event', 'event with pagination updated once', 'event', '2024-01-09 16:27:00', '2024-01-09 16:27:00', 'https://www.scps.virginia.edu/bachelor-of-liberal-arts/capstone#:~:text=The%20Capstone%20Project%20is%20a,deep%20understanding%20of%20the%20topic.', NULL, '2024-01-09 16:21:42'),
(135, 43, 'Announcement', 'announcement with pagination iupdated once', 'ann', NULL, NULL, 'ann', NULL, '2024-01-09 16:22:01'),
(142, 43, 'Event', 'asd', 'asd\\r\\n\\r\\nasd\\r\\n\\r\\n\\r\\nasd\\r\\n\\r\\n\\r\\nasd', '2024-01-10 00:16:00', '2024-01-10 00:16:00', 'asdasdasd', '1704816616.jpeg', '2024-01-10 00:10:16'),
(143, 43, 'Event', 'asd', 'asd', '2024-01-25 13:39:00', '2024-01-26 13:39:00', 'asd', NULL, '2024-01-14 13:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `user_id` int(100) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_account_username` varchar(100) NOT NULL,
  `user_honorifics` varchar(25) DEFAULT NULL,
  `user_college` varchar(100) NOT NULL,
  `user_department` varchar(100) NOT NULL,
  `user_university_position` varchar(20) NOT NULL,
  `user_faculty_rank` varchar(100) DEFAULT 'Faculty Member',
  `user_contactno` varchar(11) NOT NULL,
  `user_image` varchar(25) NOT NULL,
  `user_type` varchar(25) NOT NULL,
  `user_verification_code` varchar(25) NOT NULL,
  `user_verification_date` datetime DEFAULT NULL,
  `user_biography` text DEFAULT NULL,
  `user_account_views` int(100) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`user_id`, `user_name`, `user_email`, `user_password`, `user_account_username`, `user_honorifics`, `user_college`, `user_department`, `user_university_position`, `user_faculty_rank`, `user_contactno`, `user_image`, `user_type`, `user_verification_code`, `user_verification_date`, `user_biography`, `user_account_views`) VALUES
(33, 'Vincent Arellano', 'papaviiiiinch0821@gmail.com', '$2y$10$srQazc.1Wvuxn.D.dqLGwuSl6PIevSxtCf8.14P0Rkq7O2fIavT1.', 'Vincent0821', 'DIT', 'College of Computer and Information Sciences (CCIS)', 'Department of Information Systems and Sciences', 'OfficialStaff', 'Associate Professor IV', '9217568778', '1701016711.jpg', 'Admin', '668524', '2023-11-26 12:20:45', NULL, 6),
(34, 'Melvin C. Roxas', 'melven.roxas@gmail.com', '$2y$10$pPpAfJ3xs2ymsAXxPUfRaeh05aaBp82XYWMELK4E78a23UCb8Xi3y', 'MelvinRoxas', ' MSGITS', 'College of Computer and Information Sciences (CCIS)', 'Department of Computer Science', 'Faculty', 'Assistant Professor IV', '9123456789', '1700972649.jpg', 'User', '173759', '2023-11-26 12:24:27', NULL, 13),
(35, 'Marian G. Arada', 'marian.arada@gmail.com', '$2y$10$xeWkIIuWf0YuNt8HrQG/L.zaWnRkPHn6EQRfmZsH4SNxXzIbSWwti', 'MarianArada', 'MIT', 'College of Computer and Information Sciences (CCIS)', 'Department of Information Technology', 'Faculty', 'Assistant Professor III', '9123456789', '1700972846.jpg', 'User', '138706', '2023-11-26 12:27:37', NULL, 3),
(36, 'Augusto Sandino B. Cardenas', 'sandino.cardenas@gmail.com', '$2y$10$XMcKJ5PJ0D3YR2TTIOfj7OSov6FsIURFTMngJEcTtL2xh2FkywW8K', 'SandinoCardenas', '', 'College of Computer and Information Sciences (CCIS)', 'None', 'Faculty', 'Administrative Aide IV', '9123456789', '1700973189.jpg', 'User', '321205', '2023-11-26 12:33:25', NULL, 4),
(38, 'Michael B. dela Fuente', 'michael.delafuente@gmai.com', '$2y$10$R6qKQCqCdoq2vj5BMBVC9.Ekttbfk7HmtCXaRpjulEy512kcMktfy', 'MichaelDelaFuente', 'MSGITS', 'College of Computer and Information Sciences (CCIS)', 'Department of Computer Science', 'OfficialStaff', 'Associate Professor II', '9123456789', '1700974606.jpg', 'User', '907812', '2023-11-26 12:57:01', NULL, 5),
(39, 'Rachel A. Nayre', 'rachel.nayre@gmail.com', '$2y$10$ejTC1MRewg1kAWRLYqFKoudkqWgUeB9am9sAhiaU6mstLI4.1nYGW', 'RachelNayre', 'MSIT', 'College of Computer and Information Sciences (CCIS)', 'Department of Information Technology', 'OfficialStaff', 'Assistant Professor IV', '9123456789', '1700974697.jpg', 'User', '212986', '2023-11-26 12:58:31', NULL, 1),
(40, 'Arlene E. Carpizo', 'arlene.carpizo@pup.edu.ph', '$2y$10$xQCdXGagSeMnk2d.79sVguR8x8wBjfZD2nn93mP.gn5dlIIE/DxFG', 'arlenecarpizo', '', 'College of Arts and Letters (CAL)', 'None', 'OfficialStaff', '', '9123456789', '1701155916.jpg', 'User', '135414', '2023-11-28 15:19:44', NULL, 4),
(43, 'Ria A. Sagum', 'riasagum6@gmail.com', '$2y$10$7CeItiL/7yBsGW9acZPgxeSHmrJcxFeS98j9GHFLNirQvumNWmPqC', 'riasagum6', 'MCS, MSIT', 'College of Computer and Information Sciences (CCIS)', 'Department of Computer Science', 'Faculty', 'Associate Professor II', '9123456789', '1710155077.jpg', 'User', '250406', '2023-11-28 17:19:11', 'John Christopher P. Gonzaga, Jemimah A. Seguerra, Jhonnel A. Turingan, Mel Patrick A. Ulit, Ria A. Sagum\r\nBook Description: This study is specifically concerned in developing a storyteller application which uses sentiment analysis and includes Text-to-Speech (TTS) that converts the input text story into its audio output. \r\n\r\n\r\nConcatenative synthesis was the algorithm used in the TTS process wherein every speech audio that represents each syllables will be concatenated to each other with some pauses for speech turns and delimiters. Also, the researchers used N-Gram in order to syllabicate every word in the story input. This study is aimed to determine its acceptability to the users and its accuracy in terms of its audio modification. The accuracy of the said application is measured by precision and its error rate.\r\n', 3),
(44, 'Vincent Arellano', 'viiiiinch0821@gmail.com', '$2y$10$ctDalT7Cnig2UQycDxbjWOI7PqXevhTZUKlfAGbvwqx69dFKdjVhi', 'Vincent082102', 'MSIT', 'College of Computer and Information Sciences (CCIS)', 'Department of Information Technology', 'Faculty', 'Assistant Professor IV', '9123456789', '1704552274.jpg', 'User', '954787', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_appointments`
--
ALTER TABLE `academic_appointments`
  ADD PRIMARY KEY (`academic_appointment_id`),
  ADD KEY `academic_appointment_user_id` (`academic_appointment_user_id`);

--
-- Indexes for table `access_codes`
--
ALTER TABLE `access_codes`
  ADD PRIMARY KEY (`access_code_id`),
  ADD KEY `access_course_id` (`access_course_id`);

--
-- Indexes for table `administrative_appointments`
--
ALTER TABLE `administrative_appointments`
  ADD PRIMARY KEY (`administrative_appointment_id`),
  ADD KEY `administrative_appointment_user_id` (`administrative_appointment_user_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_user_id` (`book_user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `course_user_id` (`course_user_id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`extension_id`),
  ADD KEY `extension_user_id` (`extension_user_id`);

--
-- Indexes for table `honors_awards`
--
ALTER TABLE `honors_awards`
  ADD PRIMARY KEY (`awards_id`),
  ADD KEY `awards_user_id` (`awards_user_id`);

--
-- Indexes for table `lecture_materials`
--
ALTER TABLE `lecture_materials`
  ADD PRIMARY KEY (`lecture_material_id`),
  ADD KEY `lecture_course_id` (`lecture_course_id`);

--
-- Indexes for table `other_accounts`
--
ALTER TABLE `other_accounts`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_user_id` (`link_user_id`);

--
-- Indexes for table `pup_advisees`
--
ALTER TABLE `pup_advisees`
  ADD PRIMARY KEY (`advisee_id`),
  ADD KEY `advisee_user_id` (`advisee_user_id`);

--
-- Indexes for table `research_interests`
--
ALTER TABLE `research_interests`
  ADD PRIMARY KEY (`research_interest_id`),
  ADD KEY `research_interest_user_id` (`research_interest_user_id`);

--
-- Indexes for table `selected_publications`
--
ALTER TABLE `selected_publications`
  ADD PRIMARY KEY (`publication_id`),
  ADD KEY `publication_user_id` (`publication_user_id`);

--
-- Indexes for table `timeline_posts`
--
ALTER TABLE `timeline_posts`
  ADD PRIMARY KEY (`timeline_post_id`),
  ADD KEY `timeline_post_user_id` (`timeline_post_user_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_appointments`
--
ALTER TABLE `academic_appointments`
  MODIFY `academic_appointment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `access_codes`
--
ALTER TABLE `access_codes`
  MODIFY `access_code_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `administrative_appointments`
--
ALTER TABLE `administrative_appointments`
  MODIFY `administrative_appointment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `extension_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `honors_awards`
--
ALTER TABLE `honors_awards`
  MODIFY `awards_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lecture_materials`
--
ALTER TABLE `lecture_materials`
  MODIFY `lecture_material_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `other_accounts`
--
ALTER TABLE `other_accounts`
  MODIFY `link_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pup_advisees`
--
ALTER TABLE `pup_advisees`
  MODIFY `advisee_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `research_interests`
--
ALTER TABLE `research_interests`
  MODIFY `research_interest_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `selected_publications`
--
ALTER TABLE `selected_publications`
  MODIFY `publication_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timeline_posts`
--
ALTER TABLE `timeline_posts`
  MODIFY `timeline_post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_appointments`
--
ALTER TABLE `academic_appointments`
  ADD CONSTRAINT `academic_appointments_ibfk_1` FOREIGN KEY (`academic_appointment_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `access_codes`
--
ALTER TABLE `access_codes`
  ADD CONSTRAINT `access_codes_ibfk_1` FOREIGN KEY (`access_course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `administrative_appointments`
--
ALTER TABLE `administrative_appointments`
  ADD CONSTRAINT `administrative_appointments_ibfk_1` FOREIGN KEY (`administrative_appointment_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`book_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`course_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `extensions`
--
ALTER TABLE `extensions`
  ADD CONSTRAINT `extensions_ibfk_1` FOREIGN KEY (`extension_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `honors_awards`
--
ALTER TABLE `honors_awards`
  ADD CONSTRAINT `honors_awards_ibfk_1` FOREIGN KEY (`awards_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `lecture_materials`
--
ALTER TABLE `lecture_materials`
  ADD CONSTRAINT `lecture_materials_ibfk_1` FOREIGN KEY (`lecture_course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `other_accounts`
--
ALTER TABLE `other_accounts`
  ADD CONSTRAINT `other_accounts_ibfk_1` FOREIGN KEY (`link_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `pup_advisees`
--
ALTER TABLE `pup_advisees`
  ADD CONSTRAINT `pup_advisees_ibfk_1` FOREIGN KEY (`advisee_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `research_interests`
--
ALTER TABLE `research_interests`
  ADD CONSTRAINT `research_interests_ibfk_1` FOREIGN KEY (`research_interest_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `selected_publications`
--
ALTER TABLE `selected_publications`
  ADD CONSTRAINT `selected_publications_ibfk_1` FOREIGN KEY (`publication_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `timeline_posts`
--
ALTER TABLE `timeline_posts`
  ADD CONSTRAINT `timeline_posts_ibfk_1` FOREIGN KEY (`timeline_post_user_id`) REFERENCES `user_profiles` (`user_id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `expire_access_codes` ON SCHEDULE EVERY 1 SECOND STARTS '2023-12-05 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE access_codes
SET access_code_status = 'Expired'
WHERE access_code_end_date < CURRENT_DATE$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
