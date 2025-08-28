-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2025 at 10:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `album_name` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) DEFAULT NULL,
  `artist_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liked_songs`
--

CREATE TABLE `liked_songs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `liked_songs`
--

INSERT INTO `liked_songs` (`id`, `user_id`, `song_id`, `liked_at`) VALUES
(1, 1, 20, '2025-07-21 13:07:07'),
(4, 1, 22, '2025-07-22 09:31:13'),
(5, 3, 20, '2025-07-22 09:44:04'),
(6, 3, 21, '2025-07-22 09:44:07'),
(7, 3, 27, '2025-07-22 09:59:54'),
(8, 3, 28, '2025-07-22 10:00:05'),
(9, 5, 20, '2025-07-25 10:20:48'),
(10, 6, 30, '2025-07-25 10:54:00'),
(11, 6, 29, '2025-07-25 10:54:03'),
(12, 6, 31, '2025-07-25 11:38:41'),
(13, 6, 22, '2025-07-25 13:00:34'),
(14, 1, 21, '2025-07-29 12:19:24'),
(15, 1, 43, '2025-07-29 12:19:29'),
(16, 1, 41, '2025-07-29 12:19:32'),
(17, 8, 20, '2025-08-04 13:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `playlist_name` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlist_songs`
--

CREATE TABLE `playlist_songs` (
  `id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist_songs`
--

INSERT INTO `playlist_songs` (`id`, `song_id`, `user_id`, `created_at`) VALUES
(2, 19, 1, '2025-07-21 10:24:52'),
(3, 17, 1, '2025-07-21 10:25:07'),
(4, 16, 1, '2025-07-21 10:25:09'),
(5, 11, 1, '2025-07-21 10:25:11'),
(6, 13, 1, '2025-07-21 10:25:12'),
(7, 14, 1, '2025-07-21 10:25:14'),
(9, 26, 1, '2025-07-21 12:44:22'),
(12, 29, 1, '2025-07-22 09:57:17'),
(19, 30, 6, '2025-07-25 10:53:57'),
(34, 30, 5, '2025-07-25 12:21:03'),
(35, 21, 5, '2025-07-25 12:25:26'),
(36, 26, 5, '2025-07-25 12:25:28'),
(37, 21, 6, '2025-07-25 12:57:55'),
(38, 26, 6, '2025-07-25 12:57:57'),
(39, 40, 1, '2025-07-29 08:59:08'),
(40, 22, 7, '2025-07-30 09:02:44'),
(41, 23, 7, '2025-07-30 09:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id` int(11) NOT NULL,
  `song_name` varchar(225) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `file_url` varchar(225) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `upload_date` timestamp NULL DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `song_name`, `artist_id`, `album_id`, `file_url`, `duration`, `upload_date`, `image_url`, `language`, `description`) VALUES
(20, 'LAAL PARI', 1, 1, 'uploads/SSYouTube.online_LAAL PARI (Song)_ Yo Yo Honey Singh _ Sajid Nadiadwala _ Tarun Mansukhani _ Housefull 5 - 6th June_480p.mp4', NULL, NULL, 'uploads/lalpar.png', 'Hindi', 'LAAL PARI (Song): Yo Yo Honey Singh | Sajid Nadiadwala | Tarun Mansukhani'),
(21, 'Aata Majhi Satakli ', 2, 2, 'uploads/SSYouTube.online_Exclusive_ Aata Majhi Satakli _ Singham Returns _ Ajay Devgan _ Kareena Kapoor _ Yo Yo Honey Singh_480p.mp4', NULL, NULL, 'uploads/atamaji.jpg', 'Hindi', 'Exclusive: Aata Majhi Satakli | Singham Returns | Ajay Devgan | Kareena Kapoor'),
(22, 'Dishoom ', 3, 3, 'uploads/SSYouTube.online_Toh Dishoom Full Video Song_ Dishoom _ John Abraham, Varun Dhawan _ Pritam, Raftaar, Shahid Mallya_480p.mp4', NULL, NULL, 'uploads/Dishoom.jpg', 'Hindi', 'Toh Dishoom Full Video Song: Dishoom | John Abraham, Varun Dhawan'),
(23, 'Satisfya ', 4, 4, 'uploads/SSYouTube.online_Imran Khan - Satisfya (Official Music Video)_480p.mp4', NULL, NULL, 'uploads/Satisfya.jpg', 'englies', 'Imran Khan - Satisfya '),
(24, 'Vishay Khatam', 5, 5, 'uploads/SSYouTube.online_Vishay Khatam _ Naam Sujal _ MTV Hustle 4_480p.mp4', NULL, NULL, 'uploads/Vishay_Khatam.png', 'rep', 'Vishay Khatam | Naam Sujal | MTV Hustle 4'),
(26, 'Majja Ni Life ', 6, 6, 'uploads/SSYouTube.online_Majja Ni Life l Mad Trip _ MTV Hustle 4_480p.mp4', NULL, NULL, 'uploads/Majja Ni Life.png', 'gujarate', 'Majja Ni Life l Mad Trip | MTV Hustle 4'),
(27, 'MC STΔN - EK DIN PYAAR', 7, 7, 'uploads/SSYouTube.online_MC STΔN - EK DIN PYAAR _ TADIPAAR _ 2K20_480p.mp4', NULL, NULL, 'uploads/MC STΔN.png', 'repars', 'MC STΔN - EK DIN PYAAR | TADIPAAR | 2K20'),
(28, ' Gym Motivation', 8, 8, 'uploads/SSYouTube.online_Gym Motivation Music _ Best Gym Workout Songs _ Gym Music _ 7 Power Fitness_480p.mp4', NULL, NULL, 'uploads/wrokout.png', 'work out', 'Gym Motivation Music | Best Gym Workout Songs | Gym Music | 7 Power Fitness'),
(29, 'KHATAM HUE WAANDE', 9, 9, 'uploads/SSYouTube.online_EMIWAY - KHATAM HUE WAANDE (Prod.YOKI) (OFFICIAL MUSIC VIDEO)_480p.mp4', NULL, NULL, 'uploads/KHATAM HUE WAANDE.png', 'Hindi', 'EMIWAY - KHATAM HUE WAANDE'),
(30, 'Chokra Jawaan', 10, 10, 'uploads/SSYouTube.online_Chokra Jawaan _ Full Song _ Ishaqzaade _ Arjun Kapoor, Gauhar Khan _ Amit Trivedi _ Sunidhi, Vishal_480p.mp4', NULL, NULL, 'uploads/Chokra Jawaan.png', 'Hindi', 'Chokra Jawaan | Full Song | Ishaqzaade | Arjun Kapoor, Gauhar Khan | Amit Trivedi | Sunidhi, Vishal'),
(31, ' વિયોગ ના વેણ', 11, 11, 'uploads/SSYouTube.online_Viyog Na Ven  વિયોગ ના વેણ  Vipul Susra  Mashup  DJ Remix  ChillOut Mix @Vipul Susra Official_480p.mp4', NULL, NULL, 'uploads/વિયોગ ના વેણ.jpg', 'gujarati', 'Viyog Na Ven | વિયોગ ના વેણ | Vipul Susra | Mashup | DJ Remix | ChillOut Mix @Vipul Susra Official'),
(32, 'Val val val mari vela re val ', 21, 21, 'uploads/SSYouTube.online_Val val val mari vela re val  વાળ વાળ વાળ મારી વેળા રે વાળ Singer Gaman Santhal  Treding_480p.mp4', NULL, NULL, 'uploads/val val.jpg', 'gujarati', 'Val val val mari vela re val || વાળ વાળ વાળ મારી વેળા રે વાળ ||Singer Gaman Santhal || Treding'),
(40, 'Halaji Tara ', 13, 13, 'uploads/Halaji Tara Hath Vakhanu _ હાલાજી તારા _ Aditya Gadhvi New Song _ Viral Song _ New Garba.mp4', NULL, NULL, 'uploads/Halaji Tara.png', 'gujarati', 'Halaji Tara Hath Vakhanu | હાલાજી તારા | Aditya Gadhvi New Song | Viral Song | New Garba'),
(41, 'Rajvadu Ne Rupiya', 14, 14, 'uploads/Rajvadu Ne Rupiya To Kale Nethi Jase (Remix).mp4', NULL, NULL, 'uploads/Rajvadu Ne Rupiya.jpeg', 'gujarati', 'Rajvadu Ne Rupiya To Kale Nethi Jase (Remix)'),
(43, 'Nagar Seth', 15, 15, 'uploads/Nagar Seth.mp4', NULL, NULL, 'uploads/Nagar Seth.jpeg', 'gujarati', 'Nagar Seth'),
(44, 'Party All Night Feat. ', 16, 16, 'uploads/Party All Night Feat. Honey Singh (Full Video) Boss _ Akshay Kumar, Sonakshi Sinha.mp4', NULL, NULL, 'uploads/Party All Night.jpeg', 'Party song', 'Party All Night Feat.'),
(45, 'Ed Sheeran ', 19, 19, 'uploads/Ed Sheeran - Sapphire (Official Music Video).mp4', NULL, NULL, 'uploads/ed.jpeg', 'englies', 'Ed Sheeran - Sapphire (Official Music Video)');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `profile_img`) VALUES
(1, 'umang', 'upkaklotar@gmail.com', '$2y$10$8GEL90F2RrLtxdi.rqMtI.oaulZNYetqQUmLqwEaZV7ezVbKR5y1G', 'Weponized.png'),
(4, 'umang@gmail.com', 'umang@gmail.com', '$2y$10$wBt4eDnOHrg4xg5FBSGVTudUzZ4.2kxPMGz6SR7yYxwQ6IT5CoCte', '1753168431_IMG-20240721-WA0002.jpg'),
(5, 'Jay Raval', 'jay@gmail.com', '$2y$10$PMnWscsMF59x3lSV1nqoSeUt9YHhqOiZc6yF.wwRDD0xjkU28Fpw.', '1753438805_WhatsApp Image 2025-04-12 at 6.32.50 PM.jpeg'),
(6, 'kohli', 'kohli@gmail.com', '$2y$10$a.nFhYDEFjGUzzOfR00PR.kTUjRWCnvaIgxb03Vp8b8UYcoyorMEm', '1753440812_kohli.jpeg'),
(7, 'Jemish', 'jemish@gmail.com', '$2y$10$gac54Bihqm4CqC/B6r/pc.6hkwgH1PbcWso2blYdhl7i/nMhpU.Xu', '1753866135_1000052439.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liked_songs`
--
ALTER TABLE `liked_songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liked_songs`
--
ALTER TABLE `liked_songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
