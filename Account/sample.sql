-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 01:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getUser` (IN `p_user_id` INT)   SELECT * from tbl_users where userid = p_user_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login` (IN `spusername` TEXT, IN `sppassword` TEXT)   select * from tbl_users where username = spusername and password = sppassword$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_reg` (IN `p_userid` INT, IN `p_fullname` TEXT, IN `p_username` TEXT, IN `p_password` TEXT, IN `p_address` TEXT, IN `p_email` TEXT)   BEGIN

if p_userid = 0 THEN
insert into tbl_users(fullname,username,password,address,email,user_role,date_created,status) values(p_fullname,p_username,p_password,p_address,p_email,1,now(),1);
ELSE
update tbl_users set fullname = p_fullname,username = p_username,address = p_address,email = p_email where userid = p_userid;
end if;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userid` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `user_role` text NOT NULL,
  `date_created` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `counterlock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userid`, `fullname`, `username`, `password`, `address`, `email`, `user_role`, `date_created`, `status`, `counterlock`) VALUES
(156, 'welmark', 'Welmark', 'e00cf25ad42683b3df678c61f42c6bda', 'lapulapu cebu city', 'welmarksevelllita@gmail.com', '2', '2023-11-17 11:52:37', 1, 0),
(157, 'Glorious Hope Cuyos', 'Cuyos', '8c728e685ddde9f7fbbc452155e29639', 'lapulapu cebu city', 'royroycuyos@gmail.com', '1', '2023-11-17 12:27:23', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
