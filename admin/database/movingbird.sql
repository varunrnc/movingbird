-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2022 at 09:02 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movingbird`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(1, 'Sports', 2),
(2, 'Entertainment', 4),
(3, 'Education', 2),
(5, 'Marvel', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` int(11) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(31, 'Steven Gerrard sacked by Aston Villa', 'Aston Villa fired Steven Gerrard in less than two hours after a 3-0 loss to Fulham on Thursday.\r\n\r\nThe writing was on the wall for Gerrard after a dismal display that left his side in 17th place after 11 games and only out of the relegation zone on goals scored.\r\n\r\n“Head Coach Steven Gerrard has left the club with immediate effect. We would like to thank Steven for his hard work and commitment and wish him well for the future,” Aston Villa said in a statement on their website.\r\n\r\nThe Liverpool great was hired last November in a Premier League return that many expected would eventually lead to the manager’s role back at Liverpool, where he played 710 matches — many as captain — and is widely regarded as one of its best players.\r\n\r\n', 1, '21 Oct, 2022', 3, '1666320199_steven.png'),
(32, 'Wolves interim manager Davis to stay on until end of year', 'Wolverhampton Wanderers caretaker manager Steve Davis will remain in charge of the team until the end of the year after taking over from Bruno Lage, the Premier League club said on Thursday.\r\n\r\nDavis has guided Wolves to one victory in three league games and they are 18th in the standings with nine points from 11 matches.\r\n\r\n“The move provides continuity and stability within the first-team group until a permanent head coach is appointed,” Wolves said in a statement.\r\n\r\n', 1, '21 Oct, 2022', 3, '1666320286_wolves.png'),
(33, 'Shammi Kapoor married Geeta Bali without telling his family, she had one condition: ‘Wedding will ta', 'The late actor Shammi Kapoor is remembered for his on-screen Yahoo persona and his Elvis-like moves on the silver screen. The actor presented a new version of the Hindi movie lover boy and when it came to his real life love story with his wife, actor Geeta Bali, he was just as filmy.\r\n\r\nShammi and Geeta met each other on the sets of a movie and before they knew it, they were in love. Their social status was vastly different at the time with Geeta being a successful film actor and Shammi being a newbie, yet their love found each other. Shammi Kapoor told Mrityunjoy Kumar Jha in a 2003 interview, “She was a star and I was a nobody, yet she believed in me.”\r\n\r\nThe Kashmir Ki Kali actor shared that he would ask her to get married often but she would brush it off. This went on for almost three years until one day, Geeta agreed but presented a condition – the wedding had to happen on the same day or it wouldn’t happen at all. “In 1955, we got married, here at Bandra at 4 am. Saat phere maare, then she took out a lipstick from her purse and gave it me. ‘Meri maang bhar dijiye’, she said and that’s what I did. It was beautiful,” he recalled in the same interview.\r\n\r\n', 2, '21 Oct, 2022', 3, '1666320403_shasi.png'),
(34, 'Over 60,000 students say yes to DU’s offer', 'This is best illustrated with the example of the most popular arts and science programmes at Miranda House. In unreserved seats, the highest CUET score against which a candidate has been allotted a seat in its BA (Hons) Political Science programme is 800/800 — in fact, 8 candidates who have been allotted seats in that programme have that perfect score — while the lowest score against which an allotment has been made is 787/800. In its BSc. (Hons) Physics programme, the highest score against which a seat has been allotted in the unreserved category is 518/600 and the lowest is 401/600. In percentage terms, that would mean that seat allotments closed at 99.38% in BA (Hons) Political Science and at 66.83% in BSc. (Hons) Physics. Among other popular courses, in BA (Hons) English, the highest score in unreserved seats was 800/800 and lowest was 760/800. In BA (Hons) Economics, where candidates compulsorily had to have Math as a CUET paper, the highest was 753/800 and the lowest was 715/800.', 3, '21 Oct, 2022', 5, '1666320607_delhi.png'),
(35, 'NEET UG 2022 Counselling: MCC releases provisional allotment list', 'NEET UG 2022 Counselling: The Medical Counselling Committee today (October 20) released the provisional result for round 1 of National Eligibility cum Entrance Test (NEET) UG 2022 counselling. Candidates can check the result at the official website– mcc.nic.in.', 3, '21 Oct, 2022', 5, '1666321323_neet.png'),
(36, 'When Jaya Bachchan said Amitabh Bachchan was not romantic with her: ‘Maybe if he had a girlfriend…’', 'Amitabh Bachchan and Jaya Bachchan have been married for almost five decades and during this time, their relationship has been admired and closely scrutinised by their fans and followers. While the two have often spoken about how they met and started going out with each other, they once talked about how Amitabh does not believe in overtly romantic gestures.\r\n\r\nIn a chat with Simi Grewal, the two were asked if Amitabh was a romantic, to which Amitabh said no and Jaya looked at him and replied, “Not with me.” As Amitabh gave her a puzzled look, she started laughing and said, “I’ve started trouble.”\r\n\r\nAmitabh then asked Simi what she meant by being a romantic, which Jaya explained as getting wine and flowers for their partner. Jaya then said, “He’s very shy. I don’t think he is…” Amitabh interrupted, “I’ve never done that.” Jaya added, “Maybe if he had a girlfriend he’d do it, but I don’t think…”', 2, '21 Oct, 2022', 5, '1666321403_amitabh.png'),
(37, 'Raymond & Ray movie review: Ewan McGregor and Ethan Hawke’s funeral comedy is buried under cliches', 'Raymond & Ray is such an aggressively strange blend of styles that virtually every living person in it demands to be plucked out of the screen and plonked on a stage somewhere, because that way, there would’ve at least been a chance that it all comes together. But as directed by filmmaker Rodrigo García, this quirky comedy about two half-brothers who bond over a shared hatred for their recently deceased father, is less a movie and more a stage play that someone just happened to film.\r\n\r\nThere is nothing inherently cinematic about this movie, which promises the tantalising team-up of Ewan McGregor and Ethan Hawke, only to reduce them to broad caricatures in a story that is riddled with so many cliches that you’d be able to correctly predict the ending before the brothers enter a friendly fistfight for the first time.', 2, '21 Oct, 2022', 4, '1666321480_raymond.png'),
(38, 'Paris Hilton launches fragrance line in Mumbai. See photosParis Hilton launches fragrance line in Mu', 'American reality show star and actor Paris Hilton launched her new range of fragrances in Mumbai on Thursday. Paris attended the event in a red Indian outfit and posed for photographers.', 2, '21 Oct, 2022', 4, '1666321604_singer.png');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `website_name` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `footerdesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `website_name`, `logo`, `footerdesc`) VALUES
(1, 'Moving Bird', 'logo.png', '© Copyright 2022 - 2023 Moving Bird | Powered by <a href=\"https://github.com/varunrnc/movingbird.git\" target=\"_blank\">Barun</a>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(3, 'Bootstrap', 'Varun', 'varun', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(4, 'Rakhi', 'Kumari', 'rakhi', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(5, 'Kajal', 'Kumari', 'kajal', '827ccb0eea8a706c4c34a16891f84e7b', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name_UNIQUE` (`category_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
