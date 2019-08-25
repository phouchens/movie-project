

--
-- Database: `houchen4_bcr`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `lateFeeFlag` tinyint(4) NOT NULL DEFAULT '0',
  `createdDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--Customer data for table `customer`
--

INSERT INTO `customer` (`customerId`, `role`, `firstName`, `lastName`, `email`, `phone`, `address`, `lateFeeFlag`, `createdDate`, `password`) VALUES
(1, 3, 'james', 'bond', 'jb@email.com', '123-123-1234', '123 something lane, Somewhere USA. 12345', 0, '2019-08-11 04:13:49', 'test'),
(2, 3, 'Thomas', 'Anderson', 'neo@matrix.com', '123-123-1233', '000 infinity way, The Matrix', 0, '2019-08-11 04:19:46', 'test'),
(6, 3, 'Jane', 'Foster', 'jf@email.com', '123-123-1233', '123 something lane, Somewhere USA. 12345', 0, '2019-08-13 13:26:57', 'test'),
(7, 3, 'Mike', 'Jordan', '23@email.com', '703-527-2007', '800 N Glebe Rd', 0, '2019-08-13 13:27:17', 'test'),
(8, 3, 'Wayne', 'Gretzky', 'thegreatone@email.com', '123-123-1233', '123 something lane, Somewhere USA. 12345', 0, '2019-08-13 13:27:32', 'test'),
(9, 3, 'Tom', 'Waits', 'tw@email.com', '', NULL, 0, '2019-08-24 00:44:42', 'test'),
(12, 3, 'John', 'Henry', 'jh@email.com', '', NULL, 0, '2019-08-24 16:41:15', 'test'),
(13, 3, 'Perry', 'Houchens', 'perry.houchens@gmail.com', '', NULL, 0, '2019-08-24 22:20:28', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeId` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `createTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Employee data for table `employee`
--

INSERT INTO `employee` (`employeeId`, `role`, `firstName`, `lastName`, `email`, `phone`, `createTime`, `password`) VALUES
(1, 5, 'John', 'Wick', 'john.wick@gmail.com', '111-111-1111', '2019-08-11 03:28:13', 'test'),
(4, 4, 'Jerri', 'Jones', 'jj@email.com', '111-111-1111', '2019-08-13 02:43:38', 'test'),
(10, 5, 'Luke', 'Skywalker', 'jedi@email.com', '123-123-1233', '2019-08-25 20:30:26', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movieId` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `genre` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `actors` varchar(45) DEFAULT NULL,
  `directors` varchar(45) DEFAULT NULL,
  `rating` varchar(45) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `rented` tinyint(4) NOT NULL DEFAULT '0',
  `returnDate` timestamp NULL DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Movie data for table `movie`
--

INSERT INTO `movie` (`movieId`, `title`, `genre`, `year`, `language`, `actors`, `directors`, `rating`, `dateCreated`, `rented`, `returnDate`, `price`) VALUES
(1, 'The Old Man & the Gun', 'Western', '2019', 'English', 'Robert Redford', 'David Lowery', 'R', '2019-08-14 11:34:41', 0, NULL, '10'),
(2, 'Avengers: Infinity War', 'Action', '2019', '', 'Robert Downey Jr. Chris Hemsworth, Chris Evan', 'Joe Russo', 'R', '2019-08-14 11:34:41', 1, '2019-09-02 05:00:00', '10'),
(3, 'Spider-Man: Into the Spiderverse', 'Action', '2019', 'English', 'Shameik Moore, Jake Johnson', 'Rodney Rothman', 'PG', '2019-08-14 11:53:54', 0, NULL, '7'),
(4, 'Bohemian Rhapsody', 'drama', '2019', 'English', 'Rami Malek', 'Anthony McCarten', 'R', '2019-08-14 11:53:54', 0, NULL, '7'),
(5, 'Black Panther', 'action', '2018', 'English', 'Chadwick Boseman', 'Ryan Coogler', 'PG', '2019-08-14 11:56:11', 0, NULL, '7'),
(6, 'Deadpool 2', 'action', '2018', 'English', 'Ryan Reynolds', 'David Leitch', 'R', '2019-08-14 11:56:11', 0, NULL, '7'),
(8, 'The Shawshank Redemption', 'Drama', '1994', '', 'Tim Robbins, Morgan Freeman', 'Frank Darabont', 'PG-13', '2019-08-21 23:44:49', 1, '2019-09-03 05:00:00', '5'),
(9, 'Phycho', 'Horrer', '1960', '', 'Anthony Perkins, Janet Leigh', 'Alfred Hitchcock', 'R', '2019-08-24 01:05:53', 0, NULL, '5'),
(10, 'Jaws', 'Horrer', '1975', '', 'Roy Scheider, Richard Dreyfuss', 'Steven Spielberg', 'PG', '2019-08-24 01:07:00', 1, '2019-09-03 05:00:00', '5'),
(11, 'The Exorcist', 'Horrer', '1973', '', 'Ellen Burstyn, Max von Sydow', 'William Friedkin', 'R', '2019-08-24 01:08:03', 0, NULL, '5'),
(12, 'North by Northwest', 'Mystery', '1959', '', 'Cary Grant, Eva Marie Saint', 'Alfred Hitchcock', 'NR', '2019-08-24 01:08:54', 0, NULL, '5'),
(13, 'The Silence of the Lambs', 'Thriller', '1991', '', 'Jodie Foster, Anthony Hopkins', 'Jonathan Demme', 'R', '2019-08-24 01:09:46', 0, NULL, '5'),
(14, 'The Godfather', 'Drama', '1972', '', 'Marlon Brando, Al Pacino', 'Francis Ford Coppola', 'R', '2019-08-24 01:10:50', 0, NULL, '5'),
(15, 'Deliverance', 'Drama', '1972', '', 'Jon Voight, Burt Reynolds', 'John Boorman', 'R', '2019-08-24 01:11:51', 0, NULL, '5'),
(16, 'The Deer Hunter', 'Drama', '1978', '', 'Robert De Niro, Christopher Walken', 'Michael Cimino', 'R', '2019-08-24 01:12:49', 0, NULL, '5'),
(17, 'The Shining', 'Horror', '1980', '', 'Jack Nicholson, Shelley Duval', 'Stanely Kubrick', 'R', '2019-08-24 01:13:52', 0, NULL, '5'),
(18, 'Pulp Fiction', 'Thriller', '1994', '', 'John Travolta, Samuel L. Jackson', 'Quentin Tarantino', 'R', '2019-08-24 01:15:03', 0, NULL, '5'),
(19, 'Platoon', 'Drama', '1986', '', 'Charlie Sheen, Willem Dafoe', 'Oliver Stone', 'R', '2019-08-24 01:16:10', 0, NULL, '5'),
(20, 'Blade Runner', 'Science Fiction', '1982', '', 'Harrison Ford, Rutger Hauer', 'Ridley Scott', 'R', '2019-08-24 01:17:06', 0, NULL, '5'),
(21, 'Terminator 2: Judgment Day', 'Science Fiction', '1991', '', 'Arnold Schwarzenegger, Linda Hamilton', 'James Cameron', 'R', '2019-08-24 01:19:38', 0, NULL, '5'),
(22, 'The Matrix', 'Science Fiction', '1999', '', 'Keanu Reeves, Laurence Fishburne', 'Lana Wachowski, Lilly Wachowski', 'R', '2019-08-24 01:21:49', 0, NULL, '5'),
(23, 'Goldfinger', 'Action', '1964', '', 'Sean Connery, Honor Blackman', 'Guy Hamilton', 'PG', '2019-08-24 01:22:48', 0, NULL, '5');

-- --------------------------------------------------------

--
-- Table structure for table `rental_transaction`
--

CREATE TABLE `rental_transaction` (
  `transactionId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `rentalDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `returnDate` date NOT NULL,
  `actualReturnDate` date DEFAULT NULL,
  `movieId` int(11) NOT NULL,
  `movieTitle` varchar(100) NOT NULL,
  `creditCardNumber` int(11) NOT NULL,
  `creditCardType` varchar(15) NOT NULL,
  `price` int(11) NOT NULL,
  `completed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Transaction data for table `rental_transaction`
--

INSERT INTO `rental_transaction` (`transactionId`, `customerId`, `employeeId`, `rentalDate`, `returnDate`, `actualReturnDate`, `movieId`, `movieTitle`, `creditCardNumber`, `creditCardType`, `price`, `completed`) VALUES
(27, 1, 1, '2019-08-23 23:02:58', '2019-09-02', NULL, 2, 'Avengers: Infinity War', 123213213, 'Visa', 5, 0),
(28, 1, 1, '2019-08-24 00:22:31', '2019-09-03', NULL, 8, 'The Shawshank Redemption', 213, 'Visa', 5, 0),
(29, 10, 1, '2019-08-24 01:36:49', '2019-09-03', NULL, 10, 'Jaws', 123213123, 'Visa', 5, 0),
(30, 1, 4, '2019-08-25 19:15:50', '2019-09-01', '2019-08-25', 14, 'The Godfather', 2147483647, 'MasterCard', 5, 1),
(31, 1, 1, '2019-08-25 19:19:07', '2019-09-01', '2019-08-25', 13, 'The Silence of the Lambs', 2147483647, 'Visa', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data for table `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`) VALUES
(3, 'customer'),
(4, 'employee'),
(5, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `roleId_idx` (`role`),
  ADD KEY `ro_index` (`role`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeId`),
  ADD UNIQUE KEY `employeeId_UNIQUE` (`employeeId`),
  ADD KEY `roleName_idx` (`role`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movieId`),
  ADD KEY `movieId` (`movieId`);

--
-- Indexes for table `rental_transaction`
--
ALTER TABLE `rental_transaction`
  ADD PRIMARY KEY (`transactionId`),
  ADD KEY `customer` (`customerId`),
  ADD KEY `employeeFK` (`employeeId`),
  ADD KEY `movieFK` (`movieId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`),
  ADD KEY `roleId` (`roleId`),
  ADD KEY `role` (`roleId`),
  ADD KEY `rolei` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `rental_transaction`
--
ALTER TABLE `rental_transaction`
  MODIFY `transactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `roles` (`roleId`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `roleId` FOREIGN KEY (`role`) REFERENCES `roles` (`roleId`);

--
-- Constraints for table `rental_transaction`
--
ALTER TABLE `rental_transaction`
  ADD CONSTRAINT `employeeFK` FOREIGN KEY (`employeeId`) REFERENCES `employee` (`employeeId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `movieFK` FOREIGN KEY (`movieId`) REFERENCES `movie` (`movieId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

