-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 10:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `Admin_id` int(20) UNSIGNED NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`Admin_id`, `Email`, `username`, `Password`) VALUES
(1, 'admin1@gmail.com', 'admin1', 'admin1@135');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `conatact_personname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `Image_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `conatact_personname`, `email`, `phone`, `password`, `location`, `website`, `contact_email`, `category`, `description`, `Image_name`) VALUES
(1, 'Techpana', 'Alex shrestha', 'techpana@gmail.com', '9876543210', '$2y$10$4MdYl0dXIN91nKh70GRYcuU7r7mAESdUFuqXoYynInA1psdJlUMiO', 'kathmandu', 'https://techpana.com', '', '', 'This is an online based news portal', 'techpana.png'),
(2, 'Esewa', 'Harry neupane', 'esewa@gmail.com', '9865060905', '$2y$10$4MdYl0dXIN91nKh70GRYcuU7r7mAESdUFuqXoYynInA1psdJlUMiO', 'kathmandu', 'https://esewa.com', '', '', 'Esewa is one of the popular e-wallet.', 'esewa.png'),
(3, 'Cedar Gate', 'Anish sapkota', 'cedargate@gmail.com', '9865525453', '$2y$10$QP5Dkbw5QHOk2CSm.zqrW.JL.FHoFNf5iLvO.vPRZhpN9oq0Q5tzO', '', NULL, '', '', '', ''),
(4, 'ar group of company', 'Alex shrestha', 'argroup@gmail.com', '9876543210', '$2y$10$TGEvucUlJg50tiMvvIdGFOOdkBgMzLOBYS0cev0dSxnmsdhOQAKJm', '', NULL, '', '', '', ''),
(5, 'ar group of company', 'alex shrestha', 'argroup@gamil.com', '9876543210', '$2y$10$gKjrtoecA6MsfX6uLQzwKOa22g.exzYY0xFmHmOhExxTw..rUNb1q', '', NULL, '', '', '', ''),
(6, 'ar group of company', 'Alex shrestha', 'Argroup@gmail.com', '9843448387', '$2y$10$3tCt/.0G2cUhkipWFshgxuS1LYTS1pgAkHb4k6.6800apKJjKkT9K', '', NULL, '', '', '', ''),
(7, 'ar group of company', 'alex shrestha', 'argroup123@gmail.com', '9876543210', '$2y$10$M8M10wtXOb3q/JCkV/IlWuL2Zruux3AMpyYdddfQPId98DOBRIo0y', '', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(10) UNSIGNED NOT NULL,
  `category` varchar(200) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `posted_date` datetime DEFAULT NULL,
  `deadline_date` datetime DEFAULT NULL,
  `Experience` varchar(100) NOT NULL,
  `estimated_salary` varchar(100) DEFAULT NULL,
  `no_of_vacancy` int(11) NOT NULL,
  `job_address` varchar(200) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `job_description` longtext NOT NULL,
  `companyID` int(10) UNSIGNED DEFAULT NULL,
  `CompanyName` varchar(200) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `category`, `job_title`, `posted_date`, `deadline_date`, `Experience`, `estimated_salary`, `no_of_vacancy`, `job_address`, `job_type`, `job_description`, `companyID`, `CompanyName`, `Status`) VALUES
(3, 'IT&Telecommunication', 'software engineering', '2023-05-30 00:00:00', '2023-07-08 00:00:00', '', '100000', 2, 'lalitpur', 'Full-time', '', 2, 'Esewa', 'Active'),
(4, 'IT&Telecommunication', 'software engineering', '2023-05-30 03:22:20', '2023-07-08 05:40:32', '', '100000', 2, 'lalitpur', 'Full-time', '', 2, 'Esewa', 'Active'),
(5, 'IT&Telecommunication', 'software engineering', '2023-05-30 00:00:00', '2023-07-08 00:00:00', '', '100000', 2, 'lalitpur', 'Full-time', '', 2, 'Esewa', 'Active'),
(7, 'IT&Telecommunication', 'software engineering', '2023-05-31 00:00:00', '2023-07-08 00:00:00', '', '100000', 2, 'lalitpur', 'Full-time', '', 2, 'Esewa', 'Active'),
(8, 'IT&Telecommunication', 'software engineering', '2023-06-02 00:00:00', '2023-07-08 00:00:00', '', '100000', 2, 'lalitpur', 'Full-time', '', 2, 'Esewa', 'Active'),
(9, 'IT&Telecommunication', 'software engineering', '2023-06-02 00:00:00', '2023-07-08 00:00:00', '', '100000', 2, 'lalitpur', 'Full-time', '', 2, 'Esewa', 'Active'),
(10, 'IT&Telecommunication', 'software engineering', '2023-06-02 00:00:00', '2023-07-08 00:00:00', '', '100000', 2, 'lalitpur', 'Full-time', '', 2, 'Esewa', 'Active'),
(11, 'IT&Telecommunication', 'software engineering', '2023-06-03 00:00:00', '2023-07-08 00:00:00', '', '100000', 2, 'lalitpur', 'Full-time', '', 2, 'Esewa', 'Active'),
(12, 'IT&Telecommunication', 'software engineering', '2023-06-03 00:00:00', '2023-07-08 00:00:00', '', '100000', 2, 'lalitpur', 'Full-time', '', 2, 'Esewa', 'Active'),
(13, 'Medical', 'doctor', '2023-06-04 00:00:00', '2023-06-03 00:00:00', '', '100000', 2, 'kathmandu', 'Full-time', '', 1, 'Techpana', 'Expire'),
(14, 'finance', 'Accountant', '2023-06-04 00:00:00', '2023-06-03 00:00:00', '', '100000', 2, 'lalitpur', 'Full-time', '', 1, 'Techpana', 'Expire'),
(15, 'Graphic Designing', 'Graphic Designer', '2023-06-04 00:00:00', '2023-06-03 00:00:00', '', '500000', 2, 'lalitpur', 'part-time', '', 1, 'Techpana', 'Expire'),
(16, 'E-comerce', 'Graphic Designer', '2023-06-04 00:00:00', '2023-06-03 00:00:00', '', '100000', 2, 'pokhara', 'Remote', '', 1, 'Techpana', 'Expire'),
(17, 'finance', 'Accountant', '2023-06-04 00:00:00', '2023-06-03 00:00:00', '', '500000', 1, 'pokhara', 'Full-time', '', 1, 'Techpana', 'Expire'),
(18, 'E-comerce', 'Data Analysist', '2023-06-04 00:00:00', '2023-06-02 00:00:00', '2-3 years', '100000', 2, 'kathmandu', 'Full-time', '', 1, 'Techpana', 'Expire'),
(21, 'NGO/INGO', 'Social Activist', '2023-06-04 00:00:00', '2023-06-03 00:00:00', '', '100000', 2, 'pokhara', 'Full time', '', 2, 'Esewa', 'Expire'),
(22, 'Tour/Travel', 'Traveller', '2023-06-04 00:00:00', '2023-06-14 00:00:00', '', '500000', 2, 'pokhara', 'Parttime', '', 2, 'Esewa', 'Active'),
(23, 'Account/Finance', 'Accountant', '2023-06-05 00:00:00', '2023-06-14 00:00:00', '', '100000', 2, 'kathmandu', 'Full time', '', 1, 'Techpana', 'Active'),
(24, 'Design/Graphics', 'Graphic Designer', '2023-06-06 00:00:00', '2023-06-05 00:00:00', '', '100000', 3, 'lalitpur', 'Full time', '', 1, 'Techpana', 'Expire'),
(25, 'Medical', 'Doctor', '2023-06-07 03:52:54', '2023-06-16 00:00:00', '', '100000', 2, 'lalitpur', 'Full time', '', 1, 'Techpana', 'Active'),
(26, 'Account/Finance', 'Accountant', '2023-06-07 03:56:39', '2023-06-16 00:00:00', '', '100000', 2, 'lalitpur', 'Full time', '', 1, 'Techpana', 'Active'),
(27, 'IT&Telecommunication', 'software engineering', '2023-06-07 04:04:32', '2023-06-16 00:00:00', '', '100000', 2, 'kathmandu', 'Full time', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem harum, deserunt sunt omnis quam incidunt ipsa! Accusamus atque optio molestias molestiae, asperiores veniam aliquid sapiente, eligendi voluptate alias nulla sit quaerat, fugiat esse voluptat', 1, 'Techpana', 'Active'),
(28, 'IT&Telecommunication', 'software engineering', '2023-06-07 04:15:35', '2023-06-15 00:00:00', '', '100000', 2, 'kathmandu', 'Full time', 'Lorem ipsum dolor, sit    Lorem ipsum dolor sit amet consectetur adipisicing elit. At quos cum odit necessitatibus possimus fugiat exercitationem corporis quaerat totam quam dolor aperiam inventore, commodi nostrum cupiditate, dignissimos quisquam provident? Cupiditate, vitae culpa eius, itaque neque voluptatibus at perspiciatis hic omnis fugiat modi aliquam consectetur, ipsam placeat dolor dolorem ab amet praesentium dolores corporis adipisci veritatis ex? Nisi, totam explicabo! Libero illum pariatur delectus laborum fuga fugit vero ea iusto velit aperiam! Temporibus fugiat voluptatum suscipit recusandae numquam expedita, consequuntur quisquam? Fuga in nostrum ipsam hic temporibus omnis eligendi corporis inventore vitae enim id dolores culpa ab saepe, repudiandae molestias cumque quos cum. Molestiae dolore suscipit neque quo labore eaque, sunt voluptates, minus magni officia dolor ab quas commodi delectus sint nostrum id recusandae consequuntur voluptatem ducimus optio nobis. Reiciendis quisquam incidunt, aliquam reprehenderit itaque nulla soluta aperiam explicabo, neque sint minima quia eum at ad. Tenetur deleniti itaque cumque saepe nesciunt iure quia reiciendis, architecto qui fugit dolorum soluta reprehenderit recusandae minus optio laborum similique laboriosam culpa quas labore. Recusandae fuga distinctio sed impedit animi nam repudiandae illo dolor pariatur eum expedita et voluptates, veritatis quam minima eius repellat magnam iusto quis quae, ea ipsa voluptatem officia eveniet? Placeat, repellat?\n amet consectetur adipisicing elit. Alias sunt eligendi assumenda aliquam quo, odio minus magnam eum consequuntur voluptas quibusdam quod harum suscipit voluptatibus repudiandae perferendis doloribus fuga cumque nam sed? Labore dolor', 2, 'Esewa', 'Active'),
(29, 'Account/Finance', 'Accountant', '2023-06-07 04:20:14', '2023-06-24 00:00:00', '', '100000', 2, 'kathmandu', 'Full time', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate nihil, quod ut voluptate reprehenderit molestiae velit, quae ratione illum mollitia sapiente nesciunt deleniti fugiat quam incidunt. Rerum fugiat aperiam, quam sed velit tenetur reiciendis, laborum incidunt alias voluptates facilis ex cupiditate consequatur cum. Unde voluptatum voluptates placeat facilis perspiciatis! Rerum aperiam libero reiciendis, harum possimus voluptatibus beatae consectetur quisquam esse ratione assumenda. Labore perferendis iste quos consequuntur, commodi quam ex iure consequatur ea, perspiciatis impedit. Rem minima impedit quisquam ipsa illo quod ullam ducimus, ut accusamus non officiis expedita suscipit natus commodi nulla tempore itaque cum magnam enim dolorem deserunt harum. Voluptates ducimus eos aspernatur neque error quae reiciendis quos nulla. Ullam facilis quaerat sunt quae nesciunt temporibus consequatur omnis esse voluptate, quasi velit modi a rerum itaque quis! Minus, doloremque tempore, minima quas enim accusantium alias nulla obcaecati molestias ullam tempora blanditiis libero vero neque molestiae nobis corporis consectetur eos temporibus pariatur! Harum exercitationem ut recusandae tempora, deleniti, nostrum enim nihil, praesentium illo autem repellat perferendis non dolores aliquam unde provident explicabo consequatur animi molestiae! Rerum sunt, placeat nobis distinctio cupiditate mollitia iusto fugit excepturi repellendus esse veritatis repellat alias maiores! Inventore soluta nesciunt veniam explicabo! Quod, labore temporibus?\r\n    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate nihil, quod ut voluptate reprehenderit molestiae velit, quae ratione illum mollitia sapiente nesciunt deleniti fugiat quam incidunt. Rerum fugiat aperiam, quam sed velit tenetur reiciendis, laborum incidunt alias voluptates facilis ex cupiditate consequatur cum. Unde voluptatum voluptates placeat facilis perspiciatis! Rerum aperiam libero reiciendis, harum possimus voluptatibus beatae consectetur quisquam esse ratione assumenda. Labore perferendis iste quos consequuntur, commodi quam ex iure consequatur ea, perspiciatis impedit. Rem minima impedit quisquam ipsa illo quod ullam ducimus, ut accusamus non officiis expedita suscipit natus commodi nulla tempore itaque cum magnam enim dolorem deserunt harum. Voluptates ducimus eos aspernatur neque error quae reiciendis quos nulla. Ullam facilis quaerat sunt quae nesciunt temporibus consequatur omnis esse voluptate, quasi velit modi a rerum itaque quis! Minus, doloremque tempore, minima quas enim accusantium alias nulla obcaecati molestias ullam tempora blanditiis libero vero neque molestiae nobis corporis consectetur eos temporibus pariatur! Harum exercitationem ut recusandae tempora, deleniti, nostrum enim nihil, praesentium illo autem repellat perferendis non dolores aliquam unde provident explicabo consequatur animi molestiae! Rerum sunt, placeat nobis distinctio cupiditate mollitia iusto fugit excepturi repellendus esse veritatis repellat alias maiores! Inventore soluta nesciunt veniam explicabo! Quod, labore temporibus?\r\n    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate nihil, quod ut voluptate reprehenderit molestiae velit, quae ratione illum mollitia sapiente nesciunt deleniti fugiat quam incidunt. Rerum fugiat aperiam, quam sed velit tenetur reiciendis, laborum incidunt alias voluptates facilis ex cupiditate consequatur cum. Unde voluptatum voluptates placeat facilis perspiciatis! Rerum aperiam libero reiciendis, harum possimus voluptatibus beatae consectetur quisquam esse ratione assumenda. Labore perferendis iste quos consequuntur, commodi quam ex iure consequatur ea, perspiciatis impedit. Rem minima impedit quisquam ipsa illo quod ullam ducimus, ut accusamus non officiis expedita suscipit natus commodi nulla tempore itaque cum magnam enim dolorem deserunt harum. Voluptates ducimus eos aspernatur neque error quae reiciendis quos nulla. Ullam facilis quaerat sunt quae nesciunt temporibus consequatur omnis esse voluptate, quasi velit modi a rerum itaque quis! Minus, doloremque tempore, minima quas enim accusantium alias nulla obcaecati molestias ullam tempora blanditiis libero vero neque molestiae nobis corporis consectetur eos temporibus pariatur! Harum exercitationem ut recusandae tempora, deleniti, nostrum enim nihil, praesentium illo autem repellat perferendis non dolores aliquam unde provident explicabo consequatur animi molestiae! Rerum sunt, placeat nobis distinctio cupiditate mollitia iusto fugit excepturi repellendus esse veritatis repellat alias maiores! Inventore soluta nesciunt veniam explicabo! Quod, labore temporibus?\r\n    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate nihil, quod ut voluptate reprehenderit molestiae velit, quae ratione illum mollitia sapiente nesciunt deleniti fugiat quam incidunt. Rerum fugiat aperiam, quam sed velit tenetur reiciendis, laborum incidunt alias voluptates facilis ex cupiditate consequatur cum. Unde voluptatum voluptates placeat facilis perspiciatis! Rerum aperiam libero reiciendis, harum possimus voluptatibus beatae consectetur quisquam esse ratione assumenda. Labore perferendis iste quos consequuntur, commodi quam ex iure consequatur ea, perspiciatis impedit. Rem minima impedit quisquam ipsa illo quod ullam ducimus, ut accusamus non officiis expedita suscipit natus commodi nulla tempore itaque cum magnam enim dolorem deserunt harum. Voluptates ducimus eos aspernatur neque error quae reiciendis quos nulla. Ullam facilis quaerat sunt quae nesciunt temporibus consequatur omnis esse voluptate, quasi velit modi a rerum itaque quis! Minus, doloremque tempore, minima quas enim accusantium alias nulla obcaecati molestias ullam tempora blanditiis libero vero neque molestiae nobis corporis consectetur eos temporibus pariatur! Harum exercitationem ut recusandae tempora, deleniti, nostrum enim nihil, praesentium illo autem repellat perferendis non dolores aliquam unde provident explicabo consequatur animi molestiae! Rerum sunt, placeat nobis distinctio cupiditate mollitia iusto fugit excepturi repellendus esse veritatis repellat alias maiores! Inventore soluta nesciunt veniam explicabo! Quod, labore temporibus?', 2, 'Esewa', 'Active'),
(30, 'IT&Telecommunication', 'software engineering', '2023-06-07 12:00:06', '2023-06-17 17:00:00', '', '100000', 2, 'lalitpur', 'Part time', 'lorem', 1, 'Techpana', 'Active'),
(31, 'IT&Telecommunication', 'software engineering', '2023-06-07 15:58:09', '2023-06-17 17:00:00', '', '100000', 2, 'pokhara', 'Full time', 'lorem', 1, 'Techpana', 'Active'),
(32, 'NGO/INGO', 'Social Activist', '2023-06-07 16:31:24', '2023-06-10 17:00:00', '', '100000', 2, 'pokhara', 'Full time', 'lorem', 1, 'Techpana', 'Expire'),
(33, 'Design/Graphics', 'Graphic Designer', '2023-06-11 09:15:24', '2023-06-13 16:00:00', '', '100000', 2, 'pokhara', 'Full time', 'lorem', 1, 'Techpana', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_certs`
--

CREATE TABLE `jobseeker_certs` (
  `id` int(10) UNSIGNED NOT NULL,
  `Title` varchar(255) NOT NULL,
  `year` varchar(100) NOT NULL,
  `awarded_by` varchar(255) NOT NULL,
  `jobseeker_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobseeker_certs`
--

INSERT INTO `jobseeker_certs` (`id`, `Title`, `year`, `awarded_by`, `jobseeker_id`) VALUES
(1, 'Social Activist', '2076', 'Tech Talk', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_education`
--

CREATE TABLE `jobseeker_education` (
  `id` int(10) UNSIGNED NOT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `Board` varchar(100) DEFAULT NULL,
  `institute` varchar(100) DEFAULT NULL,
  `started_year` int(11) DEFAULT NULL,
  `end_year` int(11) DEFAULT NULL,
  `jobseeker_id` int(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobseeker_education`
--

INSERT INTO `jobseeker_education` (`id`, `Course`, `Board`, `institute`, `started_year`, `end_year`, `jobseeker_id`) VALUES
(1, 'SLC/SEE', 'NEB', 'City school', 2063, 2074, 2),
(2, 'Plus two', 'NEB', 'Triton international college', 2074, 2077, 2),
(3, 'SLC/SEE', 'NEB', 'DAV school', 2063, 2074, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_experience`
--

CREATE TABLE `jobseeker_experience` (
  `id` int(10) UNSIGNED NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `jobseeker_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobseeker_experience`
--

INSERT INTO `jobseeker_experience` (`id`, `companyName`, `startDate`, `endDate`, `jobseeker_id`) VALUES
(1, 'F1soft', '2020-02-24', '2023-02-25', 2),
(2, 'Techpana', '2022-02-21', '2023-06-08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_skill`
--

CREATE TABLE `jobseeker_skill` (
  `id` int(10) UNSIGNED NOT NULL,
  `Title` varchar(200) NOT NULL,
  `progress` int(11) NOT NULL,
  `jobseeker_id` int(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobseeker_skill`
--

INSERT INTO `jobseeker_skill` (`id`, `Title`, `progress`, `jobseeker_id`) VALUES
(1, 'Java', 80, 2),
(2, 'Python', 100, 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker`
--

CREATE TABLE `job_seeker` (
  `Job_seeker_id` int(20) UNSIGNED NOT NULL,
  `Full_name` varchar(100) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) NOT NULL,
  `jobseeker_address` varchar(200) NOT NULL,
  `Phone` varchar(100) NOT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `Image_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `jobseeker_description` varchar(255) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `Age` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_seeker`
--

INSERT INTO `job_seeker` (`Job_seeker_id`, `Full_name`, `Email`, `Password`, `jobseeker_address`, `Phone`, `Position`, `Image_name`, `contact_email`, `website`, `gender`, `jobseeker_description`, `Mobile`, `Age`) VALUES
(1, 'Anish Sapkota', 'anish@gmail.com', '$2y$10$1DVnk4y6zThvA6M1C14rheE4S0gRGIlnKZTvKfsaFvBZbyxPA740O', 'kathmandu', '9876543210', NULL, '', 'anish123@gmail.com', 'https:///anish.com', 'Male', 'this is anish sapkota from kritipur kathmandu', '', NULL),
(2, 'oham shakya', 'oham@gmail.com', '$2y$10$vX5x7d2ILacc6QnENQ/qJem3fKC6qWFB9M0DlSv1N8MxTc7YAXm7i', 'kathmandu', '9865060905', NULL, '', 'oham123@gmail.com', 'https://oham.com', 'Male', 'hey', '', '2003-06-03'),
(3, 'aayush limbu', 'aayush@gmail.com', '$2y$10$AGt1.jUlthABypLRLTqfE.T2NN2bWw1PD75sv3Gc8nitTy7GH0Qau', '', '9843448387', NULL, '', '', '', '', '', '', NULL),
(4, 'Alex shrestha', 'alex@gmail.com', '$2y$10$UbVIt5HBWik.k7dQ9w/yreRT4L/cAuHDsWncZG/2v63uPSEHRdW1O', '', '9865060905', NULL, '', '', '', '', '', '', NULL),
(6, 'Hari oham', 'harioham@gmial.com', '$2y$10$tzjOl4j9FPi.yRJEHA1RRe6KEzIYd.8vGD6LDQFdBkV4KM2gsarU.', '', '9876543210', NULL, '', '', '', '', '', '', NULL),
(7, 'Harry shrestha', 'harry@gmail.com', '$2y$10$gwbe5EGFuZuYdyHmgMYx0uIeq6kwgOx7wUEPFr3DZDfDrvOStdpxK', '', '9876543210', NULL, '', '', '', '', '', '', NULL),
(8, 'milan karki', 'milan@gmail.com', '$2y$10$NRTWCCpjBlsV8FZ66.Kfw.D.Rnh04HF3CqN.fJ.3sAyY79plItxmy', '', '9843448387', NULL, '', '', '', '', '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`Admin_id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `jobseeker_certs`
--
ALTER TABLE `jobseeker_certs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobseeker_id` (`jobseeker_id`);

--
-- Indexes for table `jobseeker_education`
--
ALTER TABLE `jobseeker_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobseeker_id` (`jobseeker_id`);

--
-- Indexes for table `jobseeker_experience`
--
ALTER TABLE `jobseeker_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobseeker_id` (`jobseeker_id`);

--
-- Indexes for table `jobseeker_skill`
--
ALTER TABLE `jobseeker_skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobseeker_id` (`jobseeker_id`);

--
-- Indexes for table `job_seeker`
--
ALTER TABLE `job_seeker`
  ADD PRIMARY KEY (`Job_seeker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `Admin_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `jobseeker_certs`
--
ALTER TABLE `jobseeker_certs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobseeker_education`
--
ALTER TABLE `jobseeker_education`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobseeker_experience`
--
ALTER TABLE `jobseeker_experience`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobseeker_skill`
--
ALTER TABLE `jobseeker_skill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_seeker`
--
ALTER TABLE `job_seeker`
  MODIFY `Job_seeker_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`companyID`) REFERENCES `company` (`company_id`);

--
-- Constraints for table `jobseeker_certs`
--
ALTER TABLE `jobseeker_certs`
  ADD CONSTRAINT `jobseeker_certs_ibfk_1` FOREIGN KEY (`jobseeker_id`) REFERENCES `job_seeker` (`Job_seeker_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobseeker_education`
--
ALTER TABLE `jobseeker_education`
  ADD CONSTRAINT `jobseeker_education_ibfk_1` FOREIGN KEY (`jobseeker_id`) REFERENCES `job_seeker` (`Job_seeker_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobseeker_experience`
--
ALTER TABLE `jobseeker_experience`
  ADD CONSTRAINT `jobseeker_experience_ibfk_1` FOREIGN KEY (`jobseeker_id`) REFERENCES `job_seeker` (`Job_seeker_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobseeker_skill`
--
ALTER TABLE `jobseeker_skill`
  ADD CONSTRAINT `jobseeker_skill_ibfk_1` FOREIGN KEY (`jobseeker_id`) REFERENCES `job_seeker` (`Job_seeker_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
