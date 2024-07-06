-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 20, 2024 at 11:48 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercedb`
--
CREATE DATABASE IF NOT EXISTS `ecommercedb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `ecommercedb`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `usertype` varchar(20) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `password`, `address`, `city`, `state`, `country`, `zip_code`, `gender`, `usertype`) VALUES
(1, 'Zekarias', 'Solomon', 'www.zak@12gmail.com', '12345678', 'debremarkos', 'dm', 'amhara', 'dm', '1000', 'male', 'user'),
(2, 'Zekarias', 'Solomon', 'www.zeki3456@gmail.com', '12345678', 'Debere Markos', 'bahir dar', 'Amhara', 'Ethiopia', '1000', 'male', 'user'),
(3, 'roza', 'alemu', 'rozina@gmail.com', '12345678', 'Debere Markos', 'bahir dar', 'Amhara', 'Ethiopia', '1000', 'female', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `image_url`, `category_id`) VALUES
(35, 't-shert', 'To retrieve and display products from the product table in the provided HTML code, you can use PHP to fetch the product data from the database and dynamically generate the HTML for each product. Here\'s an example of how you can modify the code:', '2000.00', 'images/6643eabb01cc1_Ethiopian Traditional Clothes, የኢትዮጵያ Long T-shirt by Moltotal-fotor-2024041825929.png', 1),
(34, 't-shert', 'zd', '2000.00', 'images/6643e5247990b__Habesha_ A-Line Dress for Sale by Abelfashion.jfif', 1),
(36, 'dfsg', 'sdfsdf', '230.00', 'images/6643ef6d1ad4f_Ethiopian Traditional Dress _ Eritrean Dress _ Zuria _ Ethiopian Kids _ethiopian Gift _ Custom Order _ 3-5 Weeks to Deliver - Etsy.jfif', 2);
--
-- Database: `formuserdb`
--
CREATE DATABASE IF NOT EXISTS `formuserdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `formuserdb`;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `comment` text,
  `file_path` varchar(255) DEFAULT NULL,
  `submission_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
-- Database: `form_database`
--
CREATE DATABASE IF NOT EXISTS `form_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `form_database`;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `comment` text,
  `upload` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `father_name`, `age`, `sex`, `phone`, `department`, `college`, `email`, `password`, `comment`, `upload`) VALUES
(30, ' Solomon', 'jkdjkf', 788, 'male', '0903511062', 'Computer Scince', 'Agriculture', 'zak@gmail.com', '12345678', 'sdf', 0x66382e6a7067),
(29, ' Solomon', 'jkdjkf', 788, 'male', '0903511062', 'Computer Scince', 'Agriculture', 'zak@gmail.com', '12345678', 'sdf', 0x66382e6a7067),
(27, ' Solomon', 'jkdjkf', 788, 'male', '0903511062', 'Computer Scince', 'Agriculture', 'zak@gmail.com', '12345678', 'sdf', 0x66382e6a7067),
(28, ' Solomon', 'jkdjkf', 788, 'male', '0903511062', 'Computer Scince', 'Agriculture', 'zak@gmail.com', '12345678', 'sdf', 0x66382e6a7067);
--
-- Database: `info`
--
CREATE DATABASE IF NOT EXISTS `info` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `info`;

-- --------------------------------------------------------

--
-- Table structure for table `form_data`
--

DROP TABLE IF EXISTS `form_data`;
CREATE TABLE IF NOT EXISTS `form_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `sex` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `department` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `comment` text,
  `upload` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `form_data`
--

INSERT INTO `form_data` (`id`, `name`, `father_name`, `age`, `sex`, `phone`, `department`, `college`, `email`, `password`, `comment`, `upload`) VALUES
(1, 'sdf', 'sadf', 23, 'male', 'sdf', 'sdf', 'sdf', 'zak@gmail.com', '12345678', 'sdf', NULL),
(2, 'sdf', 'sadf', 23, 'male', 'sdf', 'sdf', 'sdf', 'zak@gmail.com', '12345678', 'sdf', NULL),
(3, 'sdf', 'sadf', 23, 'male', 'sdf', 'sdf', 'sdf', 'zak@gmail.com', '12345678', 'sdf', NULL),
(4, 'sdf', 'sadf', 23, 'male', 'sdf', 'sdf', 'sdf', 'zak@gmail.com', '12345678', 'sdf', ''),
(5, 'sdf', 'sadf', 23, 'male', 'sdf', 'sdf', 'sdf', 'zak@gmail.com', '12345678', 'sdf', ''),
(6, 'asd', 'sd', 34, 'male', 'sdf', 'sdf', 'sdf', 'zak@gmail.com', '12345678', '', ''),
(7, 'asd', 'sd', 34, 'male', 'sdf', 'sdf', 'sdf', 'zak@gmail.com', '12345678', '', ''),
(8, 'asd', 'sd', 34, 'male', 'sdf', 'sdf', 'sdf', 'zak@gmail.com', 'sdf', '', '');
--
-- Database: `node`
--
CREATE DATABASE IF NOT EXISTS `node` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `node`;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `auther` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `auther`) VALUES
(1, 'Dorice', 'Robert Adam'),
(2, 'Heven Road', 'Jon Adams'),
(3, 'Ye Netsanet mneged', 'Zekarias Solomon'),
(4, 'Love King', 'Lawra Smiz'),
(3, 'Ye Netsanet mneged', 'Zekarias Solomon'),
(4, 'Love King', 'Lawra Smiz');

-- --------------------------------------------------------

--
-- Table structure for table `cart_list`
--

DROP TABLE IF EXISTS `cart_list`;
CREATE TABLE IF NOT EXISTS `cart_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` int DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_list`
--
-- --------------------------------------------------------

--
-- Table structure for table `list`
--

DROP TABLE IF EXISTS `list`;
CREATE TABLE IF NOT EXISTS `list` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `Address` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id`, `name`, `last_name`, `Address`) VALUES
(1, 'Akials', 'solo', 'addis abeba'),
(2, 'Romario', 'Adam', 'BD'),
(3, 'Bruk', 'undefined', 'Debere Markos'),
(5, 'robel', 'undefined', 'adama'),
(6, 'Zak', 'solo', 'Adiss Abeba'),
(6, 'Alemu', 'solo', 'Adiss Abeba'),
(0, 'undefined', 'undefined', 'undefined'),
(0, 'undefined', 'undefined', 'undefined'),
(7, 'Abebe', 'solo', 'Adiss Abeba'),
(8, 'redet', 'solo', 'Adiss Abeba'),
(0, '', '', ''),
(10, 'Zekarias', 'Solomon', 'Debere Markos'),
(343, 'dfgfg', 'df', 'dfg');

-- --------------------------------------------------------

--
-- Table structure for table `new_cart`
--

DROP TABLE IF EXISTS `new_cart`;
CREATE TABLE IF NOT EXISTS `new_cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cart_name` varchar(255) NOT NULL,
  `cart_image` blob,
  `cart_description` text,
  `cart_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `new_cart`
-- 
--
-- Database: `phpex`
--
CREATE DATABASE IF NOT EXISTS `phpex` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `phpex`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
-- Database: `users`
--
CREATE DATABASE IF NOT EXISTS `users` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `users`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(2) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `last_name`, `email`, `address`, `gender`, `password`, `usertype`) VALUES
(1, 'Ze', 'Solomon', 'www.zeki3456@gmail.com', 'Debere Markos', 'male', '12345678', 'user'),
(3, 'ze', 'solomon', 'sami23@gmail.com', 'db', 'male', '12345678', 'admin'),
(4, 'ze', 'sola', 'zak@gmail.com', 'df', 'male', '12345678', 'Admin'),
(5, 'ro', 'solo', 'robi23@gmail.com', 'db', 'male', '12345678', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
