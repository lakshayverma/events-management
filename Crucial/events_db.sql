-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2017 at 02:26 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `events_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checklist`
--

INSERT INTO `checklist` (`id`, `title`, `user`, `event`, `created_on`, `img`) VALUES
(1, 'Checklist 1', 3, 1, '2017-03-25 01:35:41', '1490448967-6998-1489392994-8794-LegendarY-wallpaper-10232789.jpg'),
(2, 'Another List', 2, 2, '2017-03-25 01:36:13', '1490448979-9528-1489564707-1364-1543 - Clients.png'),
(3, 'Food', 1, 1, '2017-03-25 01:36:23', '1490449002-6550-f5.jpg'),
(4, 'Beverages', 2, 1, '2017-03-25 02:15:15', '1490451345-8498-dro.jpg'),
(5, 'Study', 1, 2, '2017-03-25 01:36:59', '1490449029-6344-p2.jpg'),
(6, 'Custom List #6', 1, 1, '2017-03-25 02:15:51', '1490451380-5674-chee.png'),
(7, 'Custom List #7', 3, 4, '2017-03-25 02:14:59', '1490451307-2969-1490426947-3986-mickeyface.gif'),
(8, 'Result', 2, 2, '2017-03-25 01:38:02', '1490449091-9070-1489568768-6211-95 - Cheque.png'),
(9, 'Funding', 3, 5, '2017-03-25 01:38:18', '1490449121-9389-1489653937-4158-Planet Jupiter.png'),
(10, 'Party Decorations', 1, 7, '2017-03-31 08:23:53', 'defaults\\party.png'),
(11, 'Sound', 1, 8, '2017-03-31 08:34:54', 'defaults\\microphone.png'),
(12, 'Guest Management', 1, 8, '2017-03-31 08:34:54', 'defaults\\guests.png'),
(13, 'Party Visuals', 1, 8, '2017-03-31 08:34:54', 'defaults\\confetti.png'),
(14, 'Party Decorations', 1, 8, '2017-03-31 08:34:54', 'defaults\\party.png'),
(15, 'Artist', 1, 8, '2017-03-31 08:34:54', 'defaults\\singer.png'),
(16, 'Sound', 1, 9, '2017-03-31 08:42:26', 'defaults\\microphone.png'),
(17, 'Lights and Electricity', 1, 9, '2017-03-31 08:42:26', 'defaults\\light-bulb.png'),
(18, 'Sound', 1, 10, '2017-03-31 08:59:07', 'defaults\\microphone.png'),
(19, 'Lights and Electricity', 1, 10, '2017-03-31 08:59:07', 'defaults\\light-bulb.png'),
(20, 'Party Decorations', 1, 10, '2017-03-31 08:59:07', 'defaults\\party.png'),
(21, 'Legal Docs', 1, 10, '2017-03-31 08:59:07', 'defaults\\contract.png'),
(22, 'Agenda', 1, 10, '2017-03-31 08:59:07', 'defaults\\notebook.png'),
(23, 'Sound', 1, 11, '2017-04-23 02:55:43', 'defaults\\microphone.png'),
(24, 'Lights and Electricity', 1, 11, '2017-04-23 02:55:43', 'defaults\\light-bulb.png'),
(25, 'Party Decorations', 1, 11, '2017-04-23 02:55:43', 'defaults\\party.png');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `organiser` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `description`, `organiser`, `datetime`, `img`) VALUES
(1, 'MCA Project', 'Qui tation vivendum ex. Vim ex brute animal eloquentiam, assum summo cum cu. Veritus delectus ea mel, et cum doctus laoreet, eu congue latine omittam per. Recteque instructior usu ei, has harum inimicus conceptam et, ne porro clita tollit has.', 1, '2017-03-23 19:25:03', '1490449184-3108-party-poster-retro-design_23-2147493281.jpg'),
(2, 'Term end examinations', 'An event that happens half yearly.', 2, '2017-03-29 13:31:00', '1490449218-4495-battle.jpg'),
(3, 'Upload Image', 'An event of uploading images on server.', 1, '2017-03-23 11:28:00', '1490449251-6534-summer.jpg'),
(4, 'Testing images', 'Hello there', 2, '2017-03-23 15:25:03', '1490449297-3983-foodfe.jpg'),
(5, 'Defiance', 'Legacy of kain is one thing but Raziel will prevail always.', 3, '2017-03-10 11:46:00', '1490449336-9306-ju.jpg'),
(6, 'Soul Reaver 2', 'Travelling to NOSGOTH to meet Raziel and Mobius.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas elementum rutrum velit eget pretium. Integer vel dui quis arcu euismod facilisis sed non purus. Donec at nisi purus. Pellentesque ut laoreet sapien. Sed eget est interdum, tempor metus commodo, interdum diam. Nam et mauris metus. Nunc congue eleifend orci, id.', 3, '2017-03-10 11:46:00', '1490449357-5741-brree.jpg'),
(7, 'Party on 4th', 'Party all night', 1, '2017-04-04 20:00:00', '1490948633-9582-party_all.jpg'),
(8, 'Party on 11th', 'Party all night', 1, '2017-04-11 14:04:00', '1490949294-2547-party_all.jpg'),
(9, 'April Fools Party', 'The party where nobody is a fool but still all are. As there will be no party there....', 1, '2017-04-01 20:15:00', '1490949746-2345-april_fool.jpg'),
(10, 'Closing Day', 'Keep record for financial year and make decisions for next year. Also have a little bit of party for everyone\'s motivation.', 1, '2017-03-31 23:59:00', '1490950747-8488-book.jpg'),
(11, 'Project Submission', 'The event will make sure everyone submits their project reports before deadline.', 1, '2017-04-29 00:00:00', '1492916142-6931-nl3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `eventitem`
--

CREATE TABLE `eventitem` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventitem`
--

INSERT INTO `eventitem` (`id`, `event`, `item`, `note`) VALUES
(1, 1, 1, 'Yummy starters for everyone. <strong>On the house</strong>'),
(2, 1, 2, 'This is the best! <em>Everyone is gonna love it</em>'),
(3, 8, 1, 'Pre selected in package.'),
(4, 8, 4, 'Necessary for the event'),
(5, 8, 2, 'Pre selected in package.'),
(6, 9, 5, 'Pre selected in package.'),
(7, 9, 7, 'Good option for the event'),
(8, 9, 2, 'Pre selected in package.'),
(9, 10, 1, 'Pre selected in package.'),
(10, 10, 4, 'A must have.'),
(11, 10, 2, 'Trying is must.'),
(12, 10, 3, 'Pre selected in package.'),
(13, 11, 1, 'Admin recommended.'),
(14, 11, 5, 'Pre selected in package.'),
(15, 11, 7, 'Pre selected in package.');

-- --------------------------------------------------------

--
-- Table structure for table `eventreview`
--

CREATE TABLE `eventreview` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `posted_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` enum('Poor','Below Average','Average','Good','Great','Fantastic') COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `eventreview`
--

INSERT INTO `eventreview` (`id`, `event`, `user`, `title`, `description`, `posted_on`, `rating`, `img`) VALUES
(1, 5, 3, 'It really was awesome', 'Lorem ipsum dolor sit amet, netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.', '2017-03-25 01:42:53', 'Good', '1490449409-9265-car-1.jpg'),
(2, 5, 2, 'Well Done', 'I am preparing for exams as well.', '2017-03-25 01:43:35', 'Fantastic', '1490449448-7927-car-2.gif-c200'),
(3, 3, 1, 'A helping hand', 'PHP is a lot of fun.', '2017-03-25 01:44:14', 'Average', '1490449484-4971-gold.jpg'),
(4, 5, 3, 'Yaes', 'Hellow', '2017-03-25 01:44:47', 'Fantastic', '1490449522-5255-pip.jpg'),
(5, 5, 4, 'LaLALA', 'Hehe', '2017-03-25 01:45:25', 'Good', '1490449559-1352-hurray.gif'),
(6, 5, 5, 'Rated', 'NO', '2017-03-25 01:46:02', 'Below Average', '1490449604-7884-mae.jpg'),
(7, 5, 1, 'Raziel is the best', 'Being modest! Am I?', '2017-03-25 02:28:48', 'Average', '1490449632-5901-toad.png');

-- --------------------------------------------------------

--
-- Table structure for table `eventvenue`
--

CREATE TABLE `eventvenue` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `venue` int(11) NOT NULL,
  `bookedBy` int(11) NOT NULL,
  `bookedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `eventvenue`
--

INSERT INTO `eventvenue` (`id`, `event`, `venue`, `bookedBy`, `bookedOn`) VALUES
(1, 2, 1, 1, '2017-03-03 12:24:41'),
(2, 1, 1, 2, '2017-03-03 02:08:00'),
(3, 6, 2, 3, '2017-03-13 08:49:02'),
(5, 6, 1, 1, '2017-03-13 08:51:57'),
(6, 5, 1, 1, '2017-03-03 12:55:06'),
(7, 11, 2, 1, '2017-04-23 02:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `note` text NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `event`, `note`, `img`) VALUES
(1, 1, 'Hallway! Gate.', '1490449831-4787-Phoenix_Auditorium.jpg'),
(2, 1, 'It was awesome!!!', '1490449879-7282-ev1.jpg'),
(3, 1, 'Croud was great!', '1490449905-9638-ev2.jpg'),
(4, 1, 'A beautiful image of event!', '1490449948-4604-ev3.jpg'),
(5, 3, 'Butter Butter Butter fly!', '1490450723-9922-ev4.jpg'),
(6, 3, 'Autumn has come!', '1490450778-5013-ev6.jpg'),
(7, 3, 'Autumn has come! A beautiful one!', '1490450803-4557-ev7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `position` enum('Guest of Honor','V.I.P','Guest','Member','Admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Guest',
  `status` enum('Attending','Not Attending','May Be') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `user`, `event`, `position`, `status`) VALUES
(1, 2, 1, 'Guest of Honor', 'Attending'),
(2, 3, 2, 'Guest of Honor', 'Attending'),
(3, 1, 1, 'Admin', 'Attending'),
(4, 3, 4, 'Member', 'Not Attending'),
(5, 4, 3, 'Member', 'May Be'),
(6, 5, 2, 'Guest', 'May Be'),
(7, 1, 3, 'V.I.P', 'Not Attending'),
(8, 1, 5, 'Guest of Honor', 'Attending'),
(9, 4, 1, 'Member', 'Not Attending'),
(10, 6, 1, 'Guest', 'May Be'),
(11, 5, 1, 'V.I.P', 'May Be'),
(12, 3, 3, 'Member', 'Not Attending'),
(13, 5, 3, 'Member', 'May Be'),
(14, 7, 3, 'Member', 'May Be'),
(15, 3, 5, 'Admin', 'Attending'),
(16, 2, 3, 'Guest of Honor', 'May Be'),
(17, 6, 5, 'Guest', 'May Be'),
(18, 8, 5, 'Guest', 'May Be'),
(19, 2, 4, 'V.I.P', 'Attending'),
(20, 1, 4, 'Member', 'Attending'),
(21, 2, 2, 'Admin', 'Attending'),
(22, 3, 1, 'Guest', 'May Be'),
(23, 3, 6, 'Admin', 'May Be'),
(24, 1, 7, 'Admin', 'Attending'),
(25, 1, 8, 'Admin', 'Attending'),
(26, 1, 9, 'Admin', 'Attending'),
(27, 1, 10, 'Admin', 'Attending'),
(28, 1, 11, 'Admin', 'Attending'),
(29, 6, 11, 'Guest of Honor', 'May Be'),
(30, 7, 11, 'Guest of Honor', 'May Be');

-- --------------------------------------------------------

--
-- Table structure for table `imagecomment`
--

CREATE TABLE `imagecomment` (
  `id` int(11) UNSIGNED NOT NULL,
  `image` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `comment` text,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagecomment`
--

INSERT INTO `imagecomment` (`id`, `image`, `user`, `comment`, `datetime`) VALUES
(1, 1, 1, 'My Hallway is tremendously big.', '2017-03-25 22:27:27'),
(2, 1, 1, 'Ho HO HO!!', '2017-03-25 23:00:27'),
(3, 1, 2, 'The venue was quite nice... I just loved it. Looking forward to do more events like this.', '2017-03-25 23:01:39'),
(4, 1, 2, 'Can you tell when next event will be?', '2017-03-25 23:04:24'),
(5, 1, 3, 'Yes please!', '2017-03-25 23:05:49'),
(6, 1, 3, 'I am waiting...', '2017-03-25 23:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE `invitation` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `message` text,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`id`, `event`, `user`, `message`, `date`) VALUES
(1, 1, 2, 'You are requested to visit.', '2017-03-11 12:13:21'),
(2, 2, 3, 'Hello there!!!', '2017-03-11 12:13:21'),
(3, 1, 1, 'Please Come', '2017-03-11 12:13:21'),
(4, 4, 3, 'Coming right?', '2017-03-11 12:13:21'),
(5, 3, 4, 'Welcome!', '2017-03-11 12:13:21'),
(6, 2, 5, 'Ho HO HO OHOHOHOH', '2017-03-11 12:13:21'),
(7, 3, 1, 'Will you?', '2017-03-11 12:13:21'),
(8, 5, 1, 'Please visit and play with us.', '2017-03-11 12:13:21'),
(9, 1, 4, 'You are allowed to visit and complete the projects. Please be on time and you can always bring a +1 with you.', '2017-03-11 12:13:21'),
(10, 1, 6, 'You are allowed to visit and complete the projects. Please be on time and you can always bring a +1 with you.', '2017-03-11 12:13:21'),
(11, 1, 5, 'You are the legend!! TEKKEN 7', '2017-03-11 12:13:21'),
(12, 3, 3, 'This is a testing event to find if users visit and enjoy.', '2017-03-11 12:13:21'),
(13, 3, 5, 'This is a testing event to find if users visit and enjoy.', '2017-03-11 12:13:21'),
(14, 3, 7, 'This is a testing event to find if users visit and enjoy.', '2017-03-11 12:13:21'),
(15, 5, 3, 'You created the event!', '2017-03-11 12:13:21'),
(16, 3, 2, 'Welcome!!', '2017-03-11 12:13:21'),
(17, 5, 6, 'Please come to the event. We all are waiting for you.', '2017-03-13 09:05:14'),
(18, 5, 8, 'Please come to the event. We all are waiting for you.', '2017-03-13 09:05:14'),
(19, 4, 2, 'Will you come? Please??', '2017-03-13 09:11:41'),
(20, 4, 1, 'Chup chaap aa jaa!!!!', '2017-03-13 09:12:33'),
(21, 2, 2, 'You are the organizer!', '2017-03-15 07:52:35'),
(22, 1, 3, 'You are valuable to us!', '2017-03-15 09:07:36'),
(23, 6, 3, 'You organized the event!', '2017-03-15 09:27:33'),
(24, 7, 1, 'You created the event!', '2017-03-31 08:23:53'),
(25, 8, 1, 'You created the event!', '2017-03-31 08:34:54'),
(26, 9, 1, 'You created the event!', '2017-03-31 08:42:26'),
(27, 10, 1, 'You created the event!', '2017-03-31 08:59:07'),
(28, 11, 1, 'You created the event!', '2017-04-23 02:55:43'),
(29, 11, 6, 'Please visit and check', '2017-04-23 02:58:20'),
(30, 11, 7, 'Please visit and check', '2017-04-23 02:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `title`, `description`, `type`, `img`) VALUES
(1, 'Pasta', 'Yummy Pasta for starters.', 'Chineese', '1490450857-5255-pasta.jpg'),
(2, 'Mc Aloo Tikki', 'A great meal.', 'Fast Food', '1490450879-3780-mcall.jpg'),
(3, 'Mc Wrap', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'Fast Food', '1490450910-7778-mcwra.jpg'),
(4, 'Ramen', 'Pasta of china. ;)', 'Chineese', '1490450943-8629-ramen.jpg'),
(5, 'Donalad Duck', 'Quack Quack Quack, the signature.', 'Disney', '1490451034-9249-don.jpg'),
(6, 'Chip\'n\'Dale', 'Rescue Rangers', 'Disney', '1490451066-4123-chip.jpg'),
(7, 'Ariel', 'The little mermaid. Aquatic themed party elements.', 'Disney', '1490451115-3259-ariel.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `itemreview`
--

CREATE TABLE `itemreview` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `posted_on` datetime NOT NULL,
  `rating` enum('Poor','Below Average','Average','Good','Great','Fantastic') COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `itemreview`
--

INSERT INTO `itemreview` (`id`, `event`, `item`, `user`, `title`, `description`, `posted_on`, `rating`, `img`) VALUES
(1, 1, 1, 1, 'Good', 'It was really yummy!!', '2017-03-25 02:12:04', 'Fantastic', '1490451191-9840-lv.jpg'),
(2, 2, 1, 2, 'Not so good', 'I really can\'t say', '2017-03-25 02:13:14', 'Average', '1490451206-6669-1000.jpg'),
(3, 2, 1, 3, 'Not so good', 'It was okay', '2017-03-25 07:13:14', 'Average', '1490451206-6669-1000.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `event`, `title`, `description`, `datetime`) VALUES
(1, 1, 'Synopsis', 'Submitting the synopsis for project before 31st December is a must.', '2016-11-20 11:00:00'),
(2, 1, 'Project Design', 'Creating design for a project helps to know what to do, when to do and how to do.', '2016-11-25 08:15:00'),
(3, 3, 'Checks', 'Test test and TEST', '2017-03-03 14:26:00'),
(4, 1, 'Another task', 'Create and edit and modify', '2017-03-12 12:24:00'),
(5, 6, 'Induction', 'Welcome all the guests and see if they are up for the journey..', '2017-10-03 12:00:00'),
(6, 6, 'Tally Guests', 'Hello Hello mic testing.', '2017-03-10 14:36:00'),
(7, 11, 'Coding', 'Validate Coding', '2017-04-29 12:15:00'),
(8, 11, 'Diagrams', 'Confirm report diagrams', '2017-04-29 01:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `checklist` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Assigned','Started','Working','Completed','Failed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Assigned',
  `deadline` datetime NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assigned_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `checklist`, `title`, `details`, `status`, `deadline`, `img`, `assigned_to`) VALUES
(1, 1, 'Bring Study Material', 'It is a must have.', 'Assigned', '2017-03-25 01:23:45', '1490451281-8060-ts1.jpg', 1),
(2, 4, 'New Created Task', 'Do it DO IT CSS', 'Working', '2017-03-04 11:13:00', '1490451290-4455-1489646774-8179-93 - Record Clearance.png', 2),
(3, 1, 'Another task calculation', 'Do it complete and get rewarded.', 'Completed', '2017-03-10 15:15:00', '1490451436-4473-bv1.jpg', 1),
(4, 9, 'Go to bank', 'Go and find all the details for loan process.', 'Completed', '2017-03-11 15:15:00', '1490451451-9479-1489568976-6422-1553 - Lock.png', 3),
(5, 9, 'Find Manager', 'If he helps!', 'Completed', '2017-03-11 15:40:00', '1490451480-1828-per.jpg', 3),
(6, 7, 'A new task', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam molestie odio ut massa vehicula viverra. Nulla a enim massa. Proin semper, neque vitae laoreet volutpat, dolor elit dapibus urna, id pulvinar lectus dui vitae ligula.', 'Assigned', '2017-03-16 12:15:00', '1490451507-3557-limie.jpg', 1),
(7, 7, 'Another task', 'Nam condimentum odio faucibus tellus vestibulum et convallis enim consectetur. Etiam lacinia ornare orci aliquam pretium.', 'Assigned', '2017-03-16 13:15:00', '1490451531-5185-c.jpg', 2),
(8, 1, 'New Task', 'A new task just to ensure the aside works.', 'Assigned', '2017-03-31 23:59:00', '1490451550-1641-te.jpg', 1),
(9, 11, 'Arrange Mics', 'You should find if they can be used.', 'Assigned', '2017-04-10 00:00:00', '1491024345-6189-microphone.png', 1),
(10, 23, 'Mics', 'Find a good mic provider', 'Assigned', '2017-04-29 13:12:00', '1492916357-3889-default-discount.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('admin','user','client') COLLATE utf8_unicode_ci DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `user_name`, `password`, `address`, `email`, `img`, `type`) VALUES
(1, 'Lakshay', 'Verma', 'lakshay', '8946553', 'Jalandhar Cantt', 'verma_lakshay@live.in', '1490450106-6262-lk.jpg', 'admin'),
(2, 'Mandeep', 'Kaur', 'mandeep', '1234567', 'Jalandhar', 'mandeepshabina@gmail.com', '1490448145-4361-1489396258-4222-Anime_Girl-wallpaper-9816582.jpg', 'admin'),
(3, 'Raziel', 'Sarafan', 'Raziel', '123456', 'Nosgoth', 'raziel@outlook.in', '1490451605-7488-lok.png', 'admin'),
(4, 'Dastan', 'Timeer', 'Dastan', '123456', 'Persia', 'lakshayverma@outlook.in', '1490448482-1468-1488528010-2486-cyanogenmod logo.png', 'admin'),
(5, 'Heihachi', 'Mishima', 'heihachi', 'tekken', 'Japan', 'heihachi@tekken.com', '1490448615-9277-mario.jpg', 'admin'),
(6, 'Jhon', 'Constantine', 'jhonny', 'lalala', 'New Orleans', 'jhonny.boy@constantine.us', '1490450280-3102-dead.png', 'admin'),
(7, 'Luffy', 'Monkey', 'hancock', '123456', 'Grand Line', 'luffy@strawhats.jp', '1490448660-4437-main-qimg-c0f2e7c8e5fb40c52acd389e5de0d314.png', 'admin'),
(8, 'Boa', 'Hancock', 'hanboa', '987654', 'Amazon', 'boa@op.com', '1490448716-9016-boa.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `capacity` int(5) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `name`, `address`, `description`, `capacity`, `img`) VALUES
(1, 'Vegas Paladium', 'House No 8 Mohalla No 14\r\nJalandhar Cantt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas elementum rutrum velit eget pretium. Integer vel dui quis arcu euismod facilisis sed non purus. Donec at nisi purus. Pellentesque ut laoreet sapien. Sed eget est interdum, tempor metus commodo, interdum diam. Nam et mauris metus.', 85, '1490448816-9151-vegas.jpg'),
(2, 'Nevada Consertium', 'Mel ullum vulputate eu. Usu essent aperiam erroribus id. Dicam dolorem has ex, no liber iusto accusamus mei, ad sed vivendo pertinacia. Soleat nonumes sea ea, cum quem fabulas fastidii in, patrioque conclusionemque eos eu. Eam an probo tibique adversarium, duo ne quas dicant. Cum cu reque liber, fugit timeam lucilius ius in. Aliquam maluisset sea at, ius at feugiat alienum.', 'Mea ad inani aeque interesset, pri mucius principes no. Tantas deleniti lobortis quo no, usu corpora splendide consequat at. Vel id amet noluisse. Iudico fierent no quo. Enim menandri temporibus per eu, liber error ad vel. Mei ad audiam denique, et usu soluta cetero reprehendunt.', 150, '1490448869-5649-dinner.jpg'),
(3, 'Next Gen Hall', 'Aliquam rhoncus magna nec elit placerat commodo. Aenean non ipsum sit amet dolor lacinia blandit. Nam condimentum odio faucibus tellus vestibulum et convallis enim.', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras ullamcorper ipsum sed nunc scelerisque scelerisque. Suspendisse sodales quam eget nulla elementum pretium. Vivamus consectetur luctus dui sit amet ultrices.', 150, '1490448921-4705-room.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by_idx` (`user`),
  ADD KEY `created_for_idx` (`event`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organiser_idx` (`organiser`);

--
-- Indexes for table `eventitem`
--
ALTER TABLE `eventitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `selected_for_idx` (`event`),
  ADD KEY `selected_item_idx` (`item`);

--
-- Indexes for table `eventreview`
--
ALTER TABLE `eventreview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posted_by_idx` (`user`),
  ADD KEY `posted_for_idx` (`event`);

--
-- Indexes for table `eventvenue`
--
ALTER TABLE `eventvenue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booked_idx` (`venue`),
  ADD KEY `booked_for_idx` (`event`),
  ADD KEY `booked_by_idx` (`bookedBy`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clicked_for_idx` (`event`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invited_for_idx` (`event`),
  ADD KEY `guest_is_idx` (`user`);

--
-- Indexes for table `imagecomment`
--
ALTER TABLE `imagecomment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_for_idx` (`image`),
  ADD KEY `comment_by_idx` (`user`);

--
-- Indexes for table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invitation_for_idx` (`user`),
  ADD KEY `invited_event_idx` (`event`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemreview`
--
ALTER TABLE `itemreview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_for_idx` (`event`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `belongs_to_idx` (`checklist`),
  ADD KEY `given_to_idx` (`assigned_to`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `eventitem`
--
ALTER TABLE `eventitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `eventreview`
--
ALTER TABLE `eventreview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `eventvenue`
--
ALTER TABLE `eventvenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `imagecomment`
--
ALTER TABLE `imagecomment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `itemreview`
--
ALTER TABLE `itemreview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `created_by` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `created_for` FOREIGN KEY (`event`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `organiser` FOREIGN KEY (`organiser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `eventitem`
--
ALTER TABLE `eventitem`
  ADD CONSTRAINT `selected_for` FOREIGN KEY (`event`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `selected_item` FOREIGN KEY (`item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `eventreview`
--
ALTER TABLE `eventreview`
  ADD CONSTRAINT `posted_by` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `posted_for` FOREIGN KEY (`event`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `eventvenue`
--
ALTER TABLE `eventvenue`
  ADD CONSTRAINT `booked` FOREIGN KEY (`venue`) REFERENCES `venue` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `booked_by` FOREIGN KEY (`bookedBy`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `booked_for` FOREIGN KEY (`event`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `clicked_for` FOREIGN KEY (`event`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `guest`
--
ALTER TABLE `guest`
  ADD CONSTRAINT `guest_is` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `invited_for` FOREIGN KEY (`event`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `imagecomment`
--
ALTER TABLE `imagecomment`
  ADD CONSTRAINT `comment_by` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comment_for` FOREIGN KEY (`image`) REFERENCES `gallery` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invitation`
--
ALTER TABLE `invitation`
  ADD CONSTRAINT `invitation_for` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `invited_event` FOREIGN KEY (`event`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_for` FOREIGN KEY (`event`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `belongs_to` FOREIGN KEY (`checklist`) REFERENCES `checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `given_to` FOREIGN KEY (`assigned_to`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
