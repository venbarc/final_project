-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2023 at 08:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@123', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `concerns`
--

CREATE TABLE `concerns` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `concern_title` varchar(255) NOT NULL,
  `concern_msg` varchar(500) NOT NULL,
  `admin_feedback` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prof_class`
--

CREATE TABLE `prof_class` (
  `id` int(11) NOT NULL,
  `prof_email` varchar(255) NOT NULL,
  `prof_name` varchar(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_fname` varchar(255) NOT NULL,
  `student_lname` varchar(255) NOT NULL,
  `student_gender` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `subject_token` varchar(255) NOT NULL,
  `image_upload` varchar(255) NOT NULL,
  `approval` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `badges` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prof_class`
--

INSERT INTO `prof_class` (`id`, `prof_email`, `prof_name`, `student_email`, `student_fname`, `student_lname`, `student_gender`, `subject`, `subject_token`, `image_upload`, `approval`, `score`, `badges`) VALUES
(167, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'opt707@macr2.com', 'Mary', 'Cruz', 'Female', 'English', 'subj-5861180', '', 1, 1000, 'assets/img/badges/silver.png'),
(168, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'tenmobgut@choco.la', 'Hanna', 'Reyes', 'Female', 'English', 'subj-5861180', '', 1, 900, 'assets/img/badges/bronze.png'),
(169, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'oggtpmq117@litemail.cf', 'Kyle ', 'Lopez', 'Male', 'English', 'subj-5861180', '', 1, 900, ' '),
(170, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'optsue@hamham.uk', 'Christian ', 'Ventigan ', 'Male', 'English', 'subj-5861180', '', 1, 500, ' '),
(171, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'opt707@macr2.com', 'Mary', 'Cruz', 'Female', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(172, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'tenmobgut@choco.la', 'Hanna', 'Reyes', 'Female', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(173, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'oggtpmq117@litemail.cf', 'Kyle ', 'Lopez', 'Male', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(174, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'optsue@hamham.uk', 'Christian ', 'Ventigan ', 'Male', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(175, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'gagpin@hotsoup.be', 'Kath', 'Mendoza', 'Female', 'English', 'subj-5861180', '', 1, 500, ' '),
(176, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'gagpin@hotsoup.be', 'Kath', 'Mendoza', 'Female', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(177, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'fax745@moimoi.re', 'Jasmine', 'Cortez', 'Female', 'English', 'subj-5861180', '', 1, 700, ' '),
(178, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'fax745@moimoi.re', 'Jasmine', 'Cortez', 'Female', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(179, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'pegbatwhy@eay.jp', 'Kurt', 'Dela Cruz', 'Female', 'English', 'subj-5861180', '', 1, 0, ''),
(180, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'pegbatwhy@eay.jp', 'Kurt', 'Dela Cruz', 'Female', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(181, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'hastop692@usako.net', 'Tristhan', 'Villanueva', 'Female', 'English', 'subj-5861180', '', 1, 600, ' '),
(182, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'hastop692@usako.net', 'Tristhan', 'Villanueva', 'Female', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(183, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'palyesits@fuwari.be', 'Sophia', 'Santos', 'Female', 'English', 'subj-5861180', '', 1, 400, ' '),
(184, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'palyesits@fuwari.be', 'Sophia', 'Santos', 'Female', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(185, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'ayebaglap@usako.net', 'George', 'Acosta', 'Female', 'English', 'subj-5861180', '', 1, 0, ''),
(186, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'ayebaglap@usako.net', 'George', 'Acosta', 'Female', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(187, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'g.maryloid@gmail.com', 'Mary Loid', 'Garcia', 'Female', 'English', 'subj-5861180', '', 1, 1600, 'assets/img/badges/gold.png'),
(188, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'g.maryloid@gmail.com', 'Mary Loid', 'Garcia', 'Female', 'Mathematics', 'subj-4350698', '', 1, 0, ''),
(189, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'beomica0130@gmail.com', 'Imeren Micaella', 'Beo', 'Female', 'English', 'subj-5861180', '', 1, 0, ''),
(190, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'beomica0130@gmail.com', 'Imeren Micaella', 'Beo', 'Female', 'Mathematics', 'subj-4350698', '', 0, 0, ''),
(191, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'christianfernando267@gmail.com', 'Christian Joel', 'Fernando', 'Male', 'English', 'subj-5861180', '', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `prof_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `subject_token` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `opt1` varchar(255) NOT NULL,
  `opt2` varchar(255) NOT NULL,
  `opt3` varchar(255) NOT NULL,
  `opt4` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text_tool` varchar(255) NOT NULL,
  `color_tool` varchar(255) NOT NULL,
  `img_tool` varchar(255) NOT NULL,
  `quiz_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `prof_email`, `subject`, `subject_token`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `answer`, `image`, `text_tool`, `color_tool`, `img_tool`, `quiz_token`) VALUES
(269, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 9 - 4?', '4', '2', '3', '1', '4', '', 'p', 'black', '100', 'quiz-5667470'),
(270, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 24 - 16?', '5', '7', '6', '8', '8', '', 'p', 'black', '100', 'quiz-5667470'),
(271, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 7 - 2?', '5', '4', '3', '1', '5', '', 'p', 'black', '100', 'quiz-5667470'),
(272, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 10 - 5?', '6', '5', '7', '8', '5', '', 'p', 'black', '100', 'quiz-5667470'),
(273, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is 16 - 9?', '5', '8', '6', '7', '7', '', 'p', 'black', '100', 'quiz-5667470'),
(275, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 5+7?', '11', '13', '12', '14', '12', '', 'p', 'black', '100', 'quiz-2344714'),
(276, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 9 + 9?', '16', '18', '17', '19', '18', '', 'p', 'black', '100', 'quiz-2344714'),
(277, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 3 + 2?', '3', '5', '4', '6', '5', '', 'p', 'black', '100', 'quiz-2344714'),
(278, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 11 + 6?\r\n\r\n', '17', '14', '15', '16', '17', '', 'p', 'black', '100', 'quiz-2344714'),
(279, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 4 + 8?', '10', '12', '11', '14', '12', '', 'p', 'black', '100', 'quiz-2344714'),
(280, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 12- 5?', '6', '8', '7', '9', '7', '', 'p', 'black', '100', 'quiz-2344714'),
(281, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 8 - 4?', '2', '4', '3', '5', '4', '', 'p', 'black', '100', 'quiz-2344714'),
(282, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 15 - 7?', '6', '8', '7', '9', '9', '', 'p', 'black', '100', 'quiz-2344714'),
(283, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 20 - 12?', '6', '8', '7', '9', '8', '', 'p', 'black', '100', 'quiz-2344714'),
(284, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is the value of 14 - 6?', '6', '8', '7', '9', '7', '', 'p', 'black', '100', 'quiz-2344714'),
(285, 'bentf24@gmail.com', 'Mathematics', 'subj-5448256', 'What is 5 + 20?', '20', '24', '22', '25', '25', '', 'p', 'black', '100', 'quiz-2344714'),
(320, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a common noun?', 'Apple', 'John', 'Rome', 'Mr. Smith', 'Apple', '', 'p', 'black', '100', 'quiz-4913220'),
(321, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a proper noun?', 'Car', 'City', 'New York', 'Teacher', 'New York', '', 'p', 'black', '100', 'quiz-4913220'),
(322, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a concrete noun?', 'Happiness', 'Honesty', 'Chair', 'Freedom', 'Chair', '', 'p', 'black', '100', 'quiz-4913220'),
(323, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an abstract noun?', 'Desk', 'Love', 'Tree', 'Book', 'Love', '', 'p', 'black', '100', 'quiz-4913220'),
(324, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a countable noun?', 'Water', 'Air', 'Furniture', 'Table', 'Table', '', 'p', 'black', '100', 'quiz-4913220'),
(325, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an uncountable noun?', 'Flower', 'Bread', 'Bicycle', 'Radio', 'Bread', '', 'p', 'black', '100', 'quiz-4913220'),
(326, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a collective noun?', 'Team', 'Car', 'House', 'Bottle', 'Team', '', 'p', 'black', '100', 'quiz-4913220'),
(327, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a proper noun that is also a common noun?', 'Amazon', 'Book', 'Elephant', 'Boat', 'Book', '', 'p', 'black', '100', 'quiz-4913220'),
(328, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a noun that cannot be pluralized?', 'Sheep', 'Deer', 'Fish', 'All of the above', 'All of the above', '', 'p', 'black', '100', 'quiz-4913220'),
(329, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an example of a gerund?', 'Running', 'Run', 'Ran', 'Runs', 'Running', '', 'p', 'black', '100', 'quiz-4913220'),
(330, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an example of a noun phrase?', 'The quick brown fox jumps over the lazy dog.', 'She plays tennis every day.', 'He is a talented musician.', 'All of the above', 'All of the above', '', 'p', 'black', '100', 'quiz-4913220'),
(331, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an example of a proper noun that can also function as a common noun?', 'Ford', 'Car', 'Coca-Cola', 'Drink', 'Car', '', 'p', 'black', '100', 'quiz-4913220'),
(333, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a compound noun?', 'Money', 'Bedroom', 'Hat', 'School', 'Bedroom', '', 'p', 'black', '100', 'quiz-4913220'),
(334, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a noun that can be both countable and uncountable?', 'Fruit', 'Book', 'Child', 'Glass', 'Glass', '', 'p', 'black', '100', 'quiz-4913220'),
(335, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an example of a noun phrase?', 'The big elephant', 'Running', 'Crying', 'Jumping', 'The big elephant', '', 'p', 'black', '100', 'quiz-4913220'),
(336, 'mendovamariejean@gmail.com', 'Mathematics', 'subj-4350698', 'What is 3/5 as a decimal?', '0.6', ' 0.8', '0.2', ' 1.5', '0.6', '', 'p', 'black', '100', 'quiz-8124222'),
(337, 'mendovamariejean@gmail.com', 'Mathematics', 'subj-4350698', 'What is 1/4 as a percentage?', '0.25%', ' 25%', ' 2.5%', '250%', '0.25%', '', 'p', 'black', '100', 'quiz-8124222'),
(338, 'mendovamariejean@gmail.com', 'Mathematics', 'subj-4350698', 'Which of the following fractions is equivalent to 3/4?', '1/2', '6/8', '2/3', '5/6', '6/8', '', 'p', 'black', '100', 'quiz-8124222'),
(339, 'mendovamariejean@gmail.com', 'Mathematics', 'subj-4350698', 'What is the reciprocal of 2/3?', ' 1/3', '3/4', '2', '3/2', '3/2', '', 'p', 'black', '100', 'quiz-8124222'),
(340, 'mendovamariejean@gmail.com', 'Mathematics', 'subj-4350698', 'Which of the following fractions is in simplest form?', '2/4', '1/3', '2/4 B. 3/6', ' 5/10', '1/3', '', 'p', 'black', '100', 'quiz-8124222'),
(341, 'mendovamariejean@gmail.com', 'Mathematics', 'subj-4350698', 'What is the product of 2/5 and 3/4?', '6/20', '3/10', '5/12', '8/15', '5/12', '', 'p', 'black', '100', 'quiz-8124222'),
(342, 'mendovamariejean@gmail.com', 'Mathematics', 'subj-4350698', 'What is the quotient of 2/3 and 4/5?', '8/15', '5/8', '10/12', '15/8', '5/8', '', 'p', 'black', '100', 'quiz-8124222'),
(343, 'mendovamariejean@gmail.com', 'Mathematics', 'subj-4350698', 'What is the sum of 1/2 and 1/3?', '2/5', '5/6', '3/5', '6/5', '5/6', '', 'p', 'black', '100', 'quiz-8124222'),
(344, 'mendovamariejean@gmail.com', 'Mathematics', 'subj-4350698', 'Which of the following fractions is greater than 3/4?', '2/5', '1/2', '5/6', '7/10', '5/6', '', 'p', 'black', '100', 'quiz-8124222'),
(345, 'mendovamariejean@gmail.com', 'Mathematics', 'subj-4350698', 'Which of the following fractions is between 1/3 and 1/2?', '2/5', '3/4', '1/4', '1/5', '2/5', '', 'p', 'black', '100', 'quiz-8124222'),
(347, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a common noun?', 'Apple', 'John', 'Rome', 'Mr. Smith', 'Apple', '', 'p', 'black', '100', 'quiz-1456140'),
(348, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a proper noun?', 'Car', 'City', 'New York', 'Teacher', 'New York', '', 'p', 'black', '100', 'quiz-1456140'),
(349, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a concrete noun?', 'Happiness', 'Honesty', 'Chair', 'Freedom', 'Chair', '', 'p', 'black', '100', 'quiz-1456140'),
(350, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an abstract noun?', 'Desk', 'Love', 'Tree', 'Book', 'Love', '', 'p', 'black', '100', 'quiz-1456140'),
(351, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a countable noun?', 'Water', 'Air', 'Furniture', 'Table', 'Table', '', 'p', 'black', '100', 'quiz-1456140'),
(352, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'sample', '1', '3', '2', '4', '1', '', 'p', 'black', '100', 'quiz-1456140');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_display`
--

CREATE TABLE `quiz_display` (
  `id` int(11) NOT NULL,
  `prof_email` varchar(255) NOT NULL,
  `subject` varchar(225) NOT NULL,
  `subject_token` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `opt1` varchar(255) NOT NULL,
  `opt2` varchar(255) NOT NULL,
  `opt3` varchar(255) NOT NULL,
  `opt4` varchar(255) NOT NULL,
  `answer` varchar(225) NOT NULL,
  `image` varchar(225) NOT NULL,
  `text_tool` varchar(225) NOT NULL,
  `color_tool` varchar(225) NOT NULL,
  `img_tool` varchar(225) NOT NULL,
  `quiz_token` varchar(225) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `incorrect_count` int(11) NOT NULL,
  `correct_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_display`
--

INSERT INTO `quiz_display` (`id`, `prof_email`, `subject`, `subject_token`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `answer`, `image`, `text_tool`, `color_tool`, `img_tool`, `quiz_token`, `quiz_id`, `incorrect_count`, `correct_count`) VALUES
(189, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a common noun?', 'Apple', 'John', 'Rome', 'Mr. Smith', 'Apple', '', 'p', 'black', '100', 'quiz-4913220', 320, 3, 5),
(190, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a proper noun?', 'Car', 'City', 'New York', 'Teacher', 'New York', '', 'p', 'black', '100', 'quiz-4913220', 321, 6, 3),
(191, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a concrete noun?', 'Happiness', 'Honesty', 'Chair', 'Freedom', 'Chair', '', 'p', 'black', '100', 'quiz-4913220', 322, 7, 2),
(192, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an abstract noun?', 'Desk', 'Love', 'Tree', 'Book', 'Love', '', 'p', 'black', '100', 'quiz-4913220', 323, 2, 7),
(193, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a countable noun?', 'Water', 'Air', 'Furniture', 'Table', 'Table', '', 'p', 'black', '100', 'quiz-4913220', 324, 3, 6),
(194, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an uncountable noun?', 'Flower', 'Bread', 'Bicycle', 'Radio', 'Bread', '', 'p', 'black', '100', 'quiz-4913220', 325, 6, 3),
(195, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a collective noun?', 'Team', 'Car', 'House', 'Bottle', 'Team', '', 'p', 'black', '100', 'quiz-4913220', 326, 6, 3),
(196, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a proper noun that is also a common noun?', 'Amazon', 'Book', 'Elephant', 'Boat', 'Book', '', 'p', 'black', '100', 'quiz-4913220', 327, 1, 8),
(197, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a noun that cannot be pluralized?', 'Sheep', 'Deer', 'Fish', 'All of the above', 'All of the above', '', 'p', 'black', '100', 'quiz-4913220', 328, 4, 5),
(198, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an example of a gerund?', 'Running', 'Run', 'Ran', 'Runs', 'Running', '', 'p', 'black', '100', 'quiz-4913220', 329, 5, 4),
(199, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an example of a noun phrase?', 'The quick brown fox jumps over the lazy dog.', 'She plays tennis every day.', 'He is a talented musician.', 'All of the above', 'All of the above', '', 'p', 'black', '100', 'quiz-4913220', 330, 6, 3),
(200, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an example of a proper noun that can also function as a common noun?', 'Ford', 'Car', 'Coca-Cola', 'Drink', 'Car', '', 'p', 'black', '100', 'quiz-4913220', 331, 7, 2),
(201, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a compound noun?', 'Money', 'Bedroom', 'Hat', 'School', 'Bedroom', '', 'p', 'black', '100', 'quiz-4913220', 333, 3, 6),
(202, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a noun that can be both countable and uncountable?', 'Fruit', 'Book', 'Child', 'Glass', 'Glass', '', 'p', 'black', '100', 'quiz-4913220', 334, 3, 6),
(203, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an example of a noun phrase?', 'The big elephant', 'Running', 'Crying', 'Jumping', 'The big elephant', '', 'p', 'black', '100', 'quiz-4913220', 335, 4, 5),
(214, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a common noun?', 'Apple', 'John', 'Rome', 'Mr. Smith', 'Apple', '', 'p', 'black', '100', 'quiz-1456140', 347, 0, 1),
(215, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a proper noun?', 'Car', 'City', 'New York', 'Teacher', 'New York', '', 'p', 'black', '100', 'quiz-1456140', 348, 0, 1),
(216, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a concrete noun?', 'Happiness', 'Honesty', 'Chair', 'Freedom', 'Chair', '', 'p', 'black', '100', 'quiz-1456140', 349, 1, 0),
(217, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is an abstract noun?', 'Desk', 'Love', 'Tree', 'Book', 'Love', '', 'p', 'black', '100', 'quiz-1456140', 350, 0, 1),
(218, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'Which of the following is a countable noun?', 'Water', 'Air', 'Furniture', 'Table', 'Table', '', 'p', 'black', '100', 'quiz-1456140', 351, 1, 0),
(219, 'mendovamariejean@gmail.com', 'English', 'subj-5861180', 'sample', '1', '3', '2', '4', '1', '', 'p', 'black', '100', 'quiz-1456140', 352, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_result`
--

CREATE TABLE `quiz_result` (
  `id` int(11) NOT NULL,
  `prof_email` varchar(255) NOT NULL,
  `prof_name` varchar(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `subject_token` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `quiz_description` varchar(255) NOT NULL,
  `num_ques` int(11) NOT NULL,
  `quiz_token` varchar(255) NOT NULL,
  `correct` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `unanswered` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `score_percent` int(11) NOT NULL,
  `passing` int(11) NOT NULL,
  `verdict` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_result`
--

INSERT INTO `quiz_result` (`id`, `prof_email`, `prof_name`, `student_email`, `subject_token`, `subject`, `quiz_title`, `quiz_description`, `num_ques`, `quiz_token`, `correct`, `wrong`, `unanswered`, `score`, `score_percent`, `passing`, `verdict`, `date`) VALUES
(228, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'opt707@macr2.com', 'subj-5861180', 'English', 'Noun', 'Quiz 1', 15, 'quiz-4913220', 10, 5, 0, 1000, 67, 60, 'passed', '2023-05-03'),
(229, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'tenmobgut@choco.la', 'subj-5861180', 'English', 'Noun', 'Quiz 1', 15, 'quiz-4913220', 9, 5, 1, 900, 60, 60, 'passed', '2023-05-03'),
(230, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'oggtpmq117@litemail.cf', 'subj-5861180', 'English', 'Noun', 'Quiz 1', 15, 'quiz-4913220', 9, 6, 0, 900, 60, 60, 'passed', '2023-05-03'),
(231, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'optsue@hamham.uk', 'subj-5861180', 'English', 'Noun', 'Quiz 1', 15, 'quiz-4913220', 5, 10, 0, 500, 33, 60, 'failed', '2023-05-03'),
(232, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'gagpin@hotsoup.be', 'subj-5861180', 'English', 'Noun', 'Quiz 1', 15, 'quiz-4913220', 5, 10, 0, 500, 33, 60, 'failed', '2023-05-03'),
(233, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'fax745@moimoi.re', 'subj-5861180', 'English', 'Noun', 'Quiz 1', 15, 'quiz-4913220', 7, 8, 0, 700, 47, 60, 'failed', '2023-05-03'),
(234, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'hastop692@usako.net', 'subj-5861180', 'English', 'Noun', 'Quiz 1', 15, 'quiz-4913220', 6, 9, 0, 600, 40, 60, 'failed', '2023-05-03'),
(235, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'palyesits@fuwari.be', 'subj-5861180', 'English', 'Noun', 'Quiz 1', 15, 'quiz-4913220', 4, 11, 0, 400, 27, 60, 'failed', '2023-05-03'),
(236, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'g.maryloid@gmail.com', 'subj-5861180', 'English', 'Noun', 'Quiz 1', 15, 'quiz-4913220', 13, 2, 0, 1300, 87, 60, 'passed', '2023-05-03'),
(237, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'g.maryloid@gmail.com', 'subj-5861180', 'English', 'Noun2', 'Quiz2', 10, 'quiz-1456140', 3, 3, 0, 300, 50, 60, 'failed', '2023-05-03');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_type`
--

CREATE TABLE `quiz_type` (
  `id` int(11) NOT NULL,
  `prof_email` varchar(255) NOT NULL,
  `prof_name` varchar(255) NOT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `quiz_description` varchar(255) NOT NULL,
  `quiz_time` int(11) NOT NULL,
  `num_ques` int(11) NOT NULL,
  `passing` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `subject_token` varchar(255) NOT NULL,
  `quiz_token` varchar(255) NOT NULL,
  `publish_stat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_type`
--

INSERT INTO `quiz_type` (`id`, `prof_email`, `prof_name`, `quiz_title`, `quiz_description`, `quiz_time`, `num_ques`, `passing`, `subject`, `subject_token`, `quiz_token`, `publish_stat`) VALUES
(88, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'Noun', 'Quiz 1', 10, 15, 60, 'English', 'subj-5861180', 'quiz-4913220', 1),
(89, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'Fraction ', 'Quiz1', 10, 10, 55, 'Mathematics', 'subj-4350698', 'quiz-8124222', 1),
(90, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'Addition ', 'Quiz 2', 10, 15, 60, 'Mathematics', 'subj-4350698', 'quiz-7407737', 0),
(91, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'Noun2', 'Quiz2', 5, 10, 60, 'English', 'subj-5861180', 'quiz-1456140', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `prof_email` varchar(255) NOT NULL,
  `prof_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `subject_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `prof_email`, `prof_name`, `subject`, `subject_token`) VALUES
(92, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'English', 'subj-5861180'),
(93, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'Mathematics', 'subj-4350698'),
(94, 'mendovamariejean@gmail.com', 'Marie Jean  Mendova', 'Science', 'subj-6661625'),
(95, 'bentf24@gmail.com', 'Benedict Barcebal', 'Calculus 2', 'subj-3909209');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `activation` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `special` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `image_upload` varchar(255) NOT NULL,
  `date_reg` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `activation`, `pin`, `fname`, `lname`, `email`, `password`, `gender`, `contact`, `special`, `user_type`, `image_upload`, `date_reg`) VALUES
(75, 1, 16844, 'Lyza', 'Cedilla', 'lyzacedilla@gmail.com', '$2y$10$63XbO2B.mIlK/SPBdDVptOH9olxtQWCyewNF0HSpvOSglZnN3Fso2', 'Female', '', '', 'prof', '', '2023-05-02'),
(76, 1, 27820, 'Mary', 'Cruz', 'opt707@macr2.com', '$2y$10$t9c.d9qVAHJDzHLdtcbgdOfM6rlRo2gWbTF5BUB.FJojGGgDBnwgK', 'Female', '', '', 'student', '', '2023-05-03'),
(77, 1, 74883, 'Marie Jean ', 'Mendova', 'mendovamariejean@gmail.com', '$2y$10$1LMKbl6cpqVyNlXyUxvv7.Y8aKRdP6M18E4P7rctMeo9PBd2QSyXm', 'Female', '', '', 'prof', '', '2023-05-03'),
(78, 1, 27282, 'Hanna', 'Reyes', 'tenmobgut@choco.la', '$2y$10$./7y3NDlty0XiWpX3cHZS.uQpihwNDRnSJyYY98wkOIWh81ofP4W2', 'Female', '', '', 'student', '', '2023-05-03'),
(79, 1, 56114, 'Kyle ', 'Lopez', 'oggtpmq117@litemail.cf', '$2y$10$n7vIJrIYlNQEKejF0glf6.63lvVQCpZJPXIMTs5TlmNsNejypO0/y', 'Male', '', '', 'student', '', '2023-05-03'),
(80, 1, 46130, 'Christian ', 'Ventigan ', 'optsue@hamham.uk', '$2y$10$JQWQDJfIJ4Rw7PRseD/t9.Rtc1fwfpRt/i1dZD3Zuv8GaxU4W6.te', 'Male', '', '', 'student', '', '2023-05-03'),
(81, 1, 38965, 'Kath', 'Mendoza', 'gagpin@hotsoup.be', '$2y$10$6UAMDRYjOUFlcu3e6tgOz.OuRyJIahtRRjOsHjaQLxsoWdtVehO9O', 'Female', '', '', 'student', '', '2023-05-03'),
(82, 1, 72543, 'Jasmine', 'Cortez', 'fax745@moimoi.re', '$2y$10$B8EVaaB0jJEYhF69ApmiNeXehDVOEJqmKQmU71sGWb0Q196c0ryyO', 'Female', '', '', 'student', '', '2023-05-03'),
(83, 1, 50666, 'Kurt', 'Dela Cruz', 'pegbatwhy@eay.jp', '$2y$10$RCCHpX04kf2WiAo1H/3n2OP0LCWqejs6J4c2fedxeSYnifK5J/Z4u', 'Female', '', '', 'student', '', '2023-05-03'),
(84, 1, 38855, 'Tricia', 'Villanueva', 'hastop692@usako.net', '$2y$10$fLBHNNiLQuF3M/JyT0hn4OXW4H6fWmNHig15k3RWd/TAEiAfDiZli', 'Female', '', '', 'student', '', '2023-05-03'),
(85, 1, 12002, 'Sophia', 'Santos', 'palyesits@fuwari.be', '$2y$10$8rTHQfFK3LUNU9qiTU/EK.gXfx97pamKoQRZiOHqHIPdJ8BjMvMxy', 'Female', '', '', 'student', '', '2023-05-03'),
(86, 1, 59347, 'George', 'Acosta', 'ayebaglap@usako.net', '$2y$10$RC5Qbj3QuscdZihZEPaAQ.66SKehQJqyveBMcct4nUk1yDAnWXhzu', 'Female', '', '', 'student', '', '2023-05-03'),
(87, 1, 27110, 'Mary Loid', 'Garcia', 'g.maryloid@gmail.com', '$2y$10$YQrrYPYE3GqGPyN.V4Yzv.0faT3R4FMJltyX.o31N5vvyGVvGB2Vy', 'Female', '', '', 'student', '', '2023-05-03'),
(88, 1, 46594, 'Imeren Micaella', 'Beo', 'beomica0130@gmail.com', '$2y$10$2RXXxGRpwLkAs03cEYa/..lp4ynC1HgdcIHzmpmbpTKGiNAuzXKca', 'Female', '', '', 'student', '', '2023-05-03'),
(89, 1, 33100, 'Christian Joel', 'Fernando', 'christianfernando267@gmail.com', '$2y$10$v5o3HJJ/19x0px9naL2iBu0zVYfh0m0zvO5yg5EuT4YBHytW.cXhq', 'Male', '', '', 'student', '', '2023-05-03'),
(93, 1, 16418, 'benedict', 'barcebal', 'bentf24@gmail.com', '$2y$10$g.VgToDqzX91pKEkQlBMs..ixoU74PJ61at5ckI9w1Qcp.8zSe77q', 'Male', '', '', 'prof', '', '2023-05-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concerns`
--
ALTER TABLE `concerns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prof_class`
--
ALTER TABLE `prof_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_display`
--
ALTER TABLE `quiz_display`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_result`
--
ALTER TABLE `quiz_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_type`
--
ALTER TABLE `quiz_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `concerns`
--
ALTER TABLE `concerns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prof_class`
--
ALTER TABLE `prof_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=356;

--
-- AUTO_INCREMENT for table `quiz_display`
--
ALTER TABLE `quiz_display`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `quiz_result`
--
ALTER TABLE `quiz_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `quiz_type`
--
ALTER TABLE `quiz_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
