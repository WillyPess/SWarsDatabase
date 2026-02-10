-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 01:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `star_wars_ot`
--

-- --------------------------------------------------------

--
-- Table structure for table `alien_races`
--

CREATE TABLE `alien_races` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `average_height_cm` int(11) DEFAULT NULL,
  `homeworld` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alien_races`
--

INSERT INTO `alien_races` (`id`, `name`, `average_height_cm`, `homeworld`, `language`, `description`) VALUES
(1, 'Wookiee', 230, 'Kashyyyk', 'Shyriiwook', 'Tall, strong, and loyal species known for bravery.'),
(2, 'Ewok', 100, 'Endor', 'Ewokese', 'Small bear-like species that helped defeat the Empire.'),
(3, 'Twi\'lek', 180, 'Ryloth', 'Twi\'leki', 'Humanoids known for head-tails and cultural grace.');

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `affiliation` varchar(255) DEFAULT NULL,
  `homeworld` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id`, `name`, `affiliation`, `homeworld`, `biography`) VALUES
(1, 'Luke Skywalker', 'Rebel Alliance', 'Tatooine', 'Jedi Knight and hero of the Rebellion.'),
(2, 'Leia Organa', 'Rebel Alliance', 'Alderaan', 'Princess and leader of the Rebel Alliance.'),
(3, 'Han Solo', 'Rebel Alliance', 'Corellia', 'Smuggler turned hero.'),
(4, 'a', 'a', 'a', 'a'),
(5, 'a', 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `jedi`
--

CREATE TABLE `jedi` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rank` varchar(100) DEFAULT NULL,
  `lightsaber_color` varchar(50) DEFAULT NULL,
  `biography` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jedi`
--

INSERT INTO `jedi` (`id`, `name`, `rank`, `lightsaber_color`, `biography`) VALUES
(1, 'Luke Skywalker', 'Jedi Knight', 'Green', 'Trained by Obi-Wan and Yoda, he redeems his father.'),
(2, 'Obi-Wan Kenobi', 'Jedi Master', 'Blue', 'Mentor of Anakin and Luke Skywalker.'),
(3, 'Yoda', 'Grand Master', 'Green', 'Wise and powerful master of the Jedi Order.');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `release_year` int(11) NOT NULL,
  `director` varchar(100) NOT NULL,
  `producer` varchar(100) DEFAULT NULL,
  `runtime_min` int(11) DEFAULT NULL,
  `synopsis` text DEFAULT NULL,
  `summary` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `release_year`, `director`, `producer`, `runtime_min`, `synopsis`, `summary`) VALUES
(1, 'Star Wars: Episode IV – A New Hope', 1977, 'George Lucas', 'Gary Kurtz', 121, 'Farm boy Luke Skywalker discovers his destiny when he joins the Rebel Alliance, rescues Princess Leia, and helps destroy the Death Star, bringing hope to the galaxy. aaaaaaaaaaa', 'The film that started it all — introducing Luke Skywalker, Han Solo, Princess Leia, and Darth Vader in an epic tale of rebellion and redemption.'),
(2, 'Star Wars: Episode V – The Empire Strikes Back', 1980, 'Irvin Kershner', 'Gary Kurtz', 124, 'The Empire relentlessly pursues the Rebels after their defeat on Hoth. Luke trains with Jedi Master Yoda, while Han and Leia are hunted across the galaxy by Darth Vader.', 'The darkest chapter of the saga, showcasing Luke’s training on Dagobah and Vader’s shocking revelation — “I am your father.”'),
(3, 'Star Wars: Episode VI – Return of the Jedi', 1983, 'Richard Marquand', 'Howard G. Kazanjian', 131, 'Luke Skywalker leads a daring mission to rescue Han Solo from Jabba the Hutt, confronts Darth Vader, and faces the Emperor to bring balance to the Force.', 'The saga’s thrilling conclusion — the fall of the Empire, redemption of Anakin Skywalker, and restoration of peace to the galaxy.');

-- --------------------------------------------------------

--
-- Table structure for table `planets`
--

CREATE TABLE `planets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `climate` varchar(255) DEFAULT NULL,
  `population` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planets`
--

INSERT INTO `planets` (`id`, `name`, `region`, `climate`, `population`, `description`) VALUES
(1, 'Tatooine', 'Outer Rim', 'Arid', '200,000', 'Desert planet and home of Anakin and Luke Skywalker.'),
(2, 'Hoth', 'Outer Rim', 'Frozen', 'Few', 'Icy planet hosting the Rebel base.'),
(3, 'Endor', 'Outer Rim', 'Forested', 'Unknown', 'Moon home to the Ewoks and site of the final battle.');

-- --------------------------------------------------------

--
-- Table structure for table `ships`
--

CREATE TABLE `ships` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `model` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `ship_class` varchar(100) DEFAULT NULL,
  `crew` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ships`
--

INSERT INTO `ships` (`id`, `name`, `model`, `manufacturer`, `ship_class`, `crew`, `description`) VALUES
(1, 'Millennium Falcon', 'YT-1300 Corellian Freighter', 'Corellian Engineering Corporation', 'Light Freighter', '4', 'The Millennium Falcon is a modified YT-1300 light freighter owned by Han Solo and Chewbacca, famous for making the Kessel Run in less than twelve parsecs.'),
(2, 'X-Wing Starfighter', 'T-65 X-wing', 'Incom Corporation', 'Starfighter', '1', 'The T-65 X-wing is a versatile Rebel Alliance starfighter armed with four laser cannons and proton torpedoes, used in key battles against the Empire.'),
(3, 'Imperial Star Destroyer', 'Imperial I-class Star Destroyer', 'Kuat Drive Yards', 'Capital Ship', '47,000', 'The Imperial Star Destroyer is the main warship of the Galactic Empire, symbolizing Imperial might and power across the galaxy.');

-- --------------------------------------------------------

--
-- Table structure for table `sith`
--

CREATE TABLE `sith` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `apprentice` varchar(255) DEFAULT NULL,
  `power` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sith`
--

INSERT INTO `sith` (`id`, `name`, `title`, `apprentice`, `power`, `description`) VALUES
(1, 'Darth Vader', 'Dark Lord of the Sith', 'Emperor Palpatine', 'Force choke and mastery of the dark side', 'Once Anakin Skywalker, turned to the dark side.'),
(2, 'Emperor Palpatine', 'Galactic Emperor', 'Darth Vader', 'Unlimited Power', 'Manipulative Sith Lord behind the Galactic Empire.'),
(3, 'Darth Maul', 'Sith Apprentice', 'None', 'Agility and double-bladed lightsaber', 'Zabrak warrior who served under Darth Sidious.');

-- --------------------------------------------------------

--
-- Table structure for table `the_force`
--

CREATE TABLE `the_force` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `the_force`
--

INSERT INTO `the_force` (`id`, `topic`, `description`) VALUES
(1, 'The Light Side', 'Represents peace, harmony, and compassion.'),
(2, 'The Dark Side', 'Fueled by anger, hate, and power.'),
(3, 'Balance of the Force', 'When both sides are in equilibrium.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'editor', 'editor', 'editor'),
(3, 'viewer', 'viewer', 'viewer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alien_races`
--
ALTER TABLE `alien_races`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jedi`
--
ALTER TABLE `jedi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planets`
--
ALTER TABLE `planets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sith`
--
ALTER TABLE `sith`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `the_force`
--
ALTER TABLE `the_force`
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
-- AUTO_INCREMENT for table `alien_races`
--
ALTER TABLE `alien_races`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jedi`
--
ALTER TABLE `jedi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `planets`
--
ALTER TABLE `planets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ships`
--
ALTER TABLE `ships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sith`
--
ALTER TABLE `sith`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `the_force`
--
ALTER TABLE `the_force`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
