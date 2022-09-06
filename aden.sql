-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2022 at 10:27 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aden`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodation_type`
--

CREATE TABLE `accommodation_type` (
  `id_acc_type` int(50) NOT NULL,
  `name_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accommodation_type`
--

INSERT INTO `accommodation_type` (`id_acc_type`, `name_type`) VALUES
(1, 'Breakfast in Tokyo'),
(2, 'Retreat for Recovery');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id_facility` int(20) NOT NULL,
  `pic_src` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id_facility`, `pic_src`, `name`, `text`, `icon`) VALUES
(1, 'images/resturantf.jpg', 'Restaurant', 'Whether you are planning a business meeting, seminar, team building session, presentation, press conference or gala dinner, both of our multipurpose event rooms will suit you perfectly.\r\n										Our dedicated and experienced staff will make sure all the essentials for a successful event are handled with attention to every little detail.', 'flaticon-restaurant icon'),
(2, 'images/coctails.png', 'Bar', 'The meeting place of hotel guests, diplomats and business people undoubtedly is Aden Bar and Restaurant just off the lobby of the hotel.', 'flaticon-cup icon'),
(3, 'images/pickup.jpg', 'Parking', 'Aden hotel offers 24-hour indoor parking for its guests.The indoor parking and valet services are free for accommodating hotel guests. Car washing service is also available with an additional cost.', 'flaticon-car icon'),
(4, 'images/swimming_pool.jpg', 'Swimming Pool', 'The 30-metre swimming pool stretches across the skyscape. Comfortable daybeds provide the ultimate perch from which to gaze onto the bustling city below.', 'flaticon-swimming icon'),
(5, 'images/spa.jpg', 'Spa', 'Aden Spa Tokyo is a vast, light-filled sanctuary set high among the Tokyo skyline. A complete range of treatments, therapies and facilities draw on the Japanese principles of nature and balance. Multiple treatment rooms are available, and the signature Spa Journeys focus on Japanese natural ingredients and philosophies.', 'flaticon-massage icon'),
(6, 'images/gym.png', 'Gym', 'Time for today\'s workout? We welcome you to our brand-new fitness which is located on the 4th floor. The room is about 60 square meters and available for all our guests.', 'flaticon-bicycle icon');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int(20) NOT NULL,
  `href` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `href`) VALUES
(1, 'images/resturant.png'),
(2, 'images/swimming_pool.jpg'),
(3, 'images/the_restaurant.jpg'),
(4, 'images/inner_garden.jpg'),
(5, 'images/suite_bathroom.jpg'),
(6, 'images/coctails.png'),
(7, 'images/lobi.png'),
(8, 'images/sushi.png'),
(9, 'images/fumoir.jpg'),
(10, 'images/lemon.png'),
(11, 'images/restaurant-by-aman.jpg'),
(12, 'images/lobby_high_res.jpg'),
(13, 'images/spa_high_res.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(50) NOT NULL,
  `href` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `href`, `text`) VALUES
(1, 'home', 'Home'),
(2, 'accommodation', 'Accommodation'),
(3, 'gallery', 'Gallery'),
(4, 'contact', 'Contact'),
(6, 'register', 'Register'),
(7, 'admin', 'Admin panel'),
(8, 'login', 'Log in');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id_price` int(50) NOT NULL,
  `number_ppl` int(2) NOT NULL,
  `id_room_type` int(50) NOT NULL,
  `price` decimal(30,0) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id_price`, `number_ppl`, `id_room_type`, `price`, `date`) VALUES
(1, 2, 1, '96000', '2021-05-29 14:26:51'),
(3, 2, 2, '179000', '2021-05-29 14:26:51'),
(4, 3, 1, '111000', '2021-05-29 14:26:51'),
(5, 3, 2, '238500', '2021-05-29 14:26:51'),
(6, 2, 3, '186000', '2021-05-29 14:26:51'),
(7, 2, 4, '269000', '2021-05-29 14:26:51'),
(8, 3, 3, '201000', '2021-05-29 14:26:51'),
(9, 3, 4, '328500', '2021-05-29 14:26:51'),
(10, 2, 5, '121000', '2021-05-29 14:26:51'),
(11, 2, 6, '204000', '2021-05-29 14:26:51'),
(12, 3, 5, '136000', '2021-05-29 14:26:51'),
(13, 3, 6, '263500', '2021-05-29 14:26:51'),
(18, 2, 2, '179500', '2021-06-06 20:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_price` int(50) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_user`, `id_price`, `check_in`, `check_out`) VALUES
(2, 3, 8, '2021-03-10', '2021-03-15'),
(9, 3, 18, '2021-06-13', '2021-06-21'),
(11, 3, 11, '2021-07-18', '2021-07-22'),
(12, 23, 8, '2021-06-20', '2021-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(10) NOT NULL,
  `role_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id_room` int(50) NOT NULL,
  `room_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `album` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id_room`, `room_name`, `description`, `album`) VALUES
(1, 'Deluxe Palace Garden Room', 'Deluxe Rooms are the largest entry-level rooms in the city, offering space and privacy at 71 square metres (764 square feet), overlooking the Tokyo skyline.', 'deluxe-room'),
(2, 'Aden Suite', 'Positioned in the northwest corner of the Otemachi Tower, Aden Suites are Aden Tokyo’s largest at 157 square metres (1,689 square feet). Each offers a separate bedroom and a living room with dining area and pantry.', 'suite'),
(3, 'Premier Room', 'Facing the Tokyo skyline, the 80-square-metre (861 square feet) Premier Rooms include a large foyer and expansive bathroom.', 'premier');

-- --------------------------------------------------------

--
-- Table structure for table `room_pic`
--

CREATE TABLE `room_pic` (
  `id_room_pic` int(50) NOT NULL,
  `src` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_room` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room_pic`
--

INSERT INTO `room_pic` (`id_room_pic`, `src`, `alt`, `id_room`) VALUES
(1, 'deluxe_palace.jpg', 'Deluxe room twin beds', 1),
(2, 'deluxe.jpg', 'Deluxe room toilet', 1),
(3, 'deluxe_room.jpg', 'Deluxe room king size bed', 1),
(4, 'deluxe_office.jpg', 'Deluxe office', 1),
(5, 'premier_room.jpg', 'Deluxe living room', 1),
(6, 'suite.jpg', 'Suite kitchen', 2),
(7, 'corner_suite.jpg', 'Corner suite', 2),
(8, 'aman_office.jpg', 'Aden office', 2),
(9, 'suite_bath.jpg', 'Suite bath', 2),
(10, 'aman_suite.jpg', 'Suite king size bed', 2),
(11, 'premier_palace.jpg', 'Premier room', 3),
(12, 'premier_room_office.jpg', 'Premier room at night', 3),
(13, 'premier_room.jpg', 'Premier beds', 3),
(14, 'premier_room_set-up.jpg', 'Set up', 3),
(15, 'premier_suite.jpg', 'Premier king size bed', 3);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id_room_type` int(50) NOT NULL,
  `id_room` int(50) NOT NULL,
  `id_acc_type` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id_room_type`, `id_room`, `id_acc_type`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(255) NOT NULL,
  `first_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `last_name`, `phone`, `email`, `password`, `date_reg`, `id_role`) VALUES
(3, 'Jovana', 'Bosnić', '065 747 8487', 'jovananbosnic@gmail.com', '87c7534fa3887fdbe17fe85e692fa6b8', '2021-02-26 19:35:19', 2),
(4, 'Pera', 'Pericic', '065 543 354', 'pera@gmail.com', 'bf676ed1364b5857fba69b5623c81b64', '2021-02-28 12:28:54', 2),
(17, 'Jovana', 'Bosnić', '065 654 345', 'jovana.bosnic.90.18@ict.edu.rs', '756716163a1be1d9fc897f4a4d87b348', '2021-03-07 17:28:45', 1),
(18, 'Jason', 'Statham', '064 373 4286', 'jasonstatham@gmail.com', 'ad87459c91905d2fa09950f5889cf9f7', '2021-03-08 11:56:12', 2),
(19, 'Scarlett', 'Johansson', '063 333 222', 'scarlett.jo@gmail.com', '793bb9e5bcfbaddbd7452f6b7614eda9', '2021-03-08 12:00:35', 2),
(20, 'Natalie', 'Portman', '062 485 5467', 'natalie2323@gmail.com', '338617d7a32a4cfb3bb39444b3607c9a', '2021-03-08 12:06:28', 2),
(22, 'Denzel', 'Washington', '065 555 4444', 'denzel123@gmail.com', 'a2b619356fa7f60f205fd315a4be77de', '2021-06-06 13:59:29', 2),
(23, 'Ognjen', 'Cmiljanović', '065 565 333', 'ogicmilja@gmail.com', 'e787c647778d25d419749b1b2862b7bf', '2021-06-11 17:57:55', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_messages`
--

CREATE TABLE `users_messages` (
  `id_message` int(255) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(255) NOT NULL,
  `show_on_page` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_messages`
--

INSERT INTO `users_messages` (`id_message`, `message`, `id_user`, `show_on_page`) VALUES
(1, 'Me and my wife had a delightful weekend get away here, the staff were so friendly and attentive.', 18, 1),
(2, 'If you’re looking for a top quality hotel look no further. I would recommend everyone to book a Deluxe room.', 19, 1),
(3, 'Probably one of the best hotels in the city. Extreme clean, new, luxurious and organized. My recommendations!', 20, 1),
(6, 'Beautiful interior and quality food in the restaurant of this hotel. I will be happy to visit you again.', 22, 1),
(8, 'Jovana is the best programmer!', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodation_type`
--
ALTER TABLE `accommodation_type`
  ADD PRIMARY KEY (`id_acc_type`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id_facility`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id_price`),
  ADD KEY `id_room_type` (`id_room_type`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_price` (`id_price`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id_room`),
  ADD UNIQUE KEY `room_name` (`room_name`);

--
-- Indexes for table `room_pic`
--
ALTER TABLE `room_pic`
  ADD PRIMARY KEY (`id_room_pic`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id_room_type`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_acc_type` (`id_acc_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `users_messages`
--
ALTER TABLE `users_messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodation_type`
--
ALTER TABLE `accommodation_type`
  MODIFY `id_acc_type` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id_facility` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id_price` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id_room` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room_pic`
--
ALTER TABLE `room_pic`
  MODIFY `id_room_pic` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id_room_type` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users_messages`
--
ALTER TABLE `users_messages`
  MODIFY `id_message` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`id_room_type`) REFERENCES `room_type` (`id_room_type`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_price`) REFERENCES `price` (`id_price`);

--
-- Constraints for table `room_pic`
--
ALTER TABLE `room_pic`
  ADD CONSTRAINT `room_pic_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`);

--
-- Constraints for table `room_type`
--
ALTER TABLE `room_type`
  ADD CONSTRAINT `room_type_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`),
  ADD CONSTRAINT `room_type_ibfk_2` FOREIGN KEY (`id_acc_type`) REFERENCES `accommodation_type` (`id_acc_type`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Constraints for table `users_messages`
--
ALTER TABLE `users_messages`
  ADD CONSTRAINT `users_messages_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
