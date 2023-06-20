-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 11:43 PM
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
-- Database: `auth`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `Square` (`number` INT) RETURNS INT(11)  BEGIN
    DECLARE result INT;
    SET result = number * number;
    RETURN result;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `customRecommendation` decimal(10,0) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `type`, `capacity`, `transmission`, `price`, `customRecommendation`, `image`) VALUES
(3, 'Ford Mustang', 'Sports Car', 4, 'Manual', '50000.00', '90', './imgs/ford-mustang.png'),
(4, 'Chevrolet Tahoe', 'SUV', 8, 'Automatic', '60000.00', '75', './imgs/dale-earnhardt.png'),
(5, 'Volkswagen Golf', 'Hatchback', 5, 'Manual', '20000.00', '70', './imgs/volkswagen golf.png'),
(6, 'BMW X5', 'SUV', 5, 'Automatic', '80000.00', '85', './imgs/BMW X5.png'),
(8, 'Jeep Wrangler', 'SUV', 5, 'Manual', '35000.00', '70', './imgs/jeep-wrangler.png'),
(9, 'Audi A4', 'Sedan', 5, 'Automatic', '45000.00', '80', './imgs/audi-a4.png'),
(10, 'Mercedes-Benz E-Class', 'Sedan', 5, 'Automatic', '60000.00', '85', './imgs/Mercedes-Benz E-Class.png'),
(11, 'Toyota RAV4', 'SUV', 5, 'Automatic', '32000.00', '75', './imgs/rav4.png'),
(12, 'Ford F-150', 'Truck', 5, 'Automatic', '40000.00', '70', './imgs/ford-f-150.png'),
(13, 'Honda Accord', 'Sedan', 5, 'Automatic', '28000.00', '75', './imgs/honda-accord.png'),
(14, 'Chevrolet Silverado', 'Truck', 5, 'Automatic', '45000.00', '80', './imgs/chevy-silverado.png'),
(16, 'Volkswagen Jetta', 'Sedan', 5, 'Automatic', '23000.00', '70', './imgs/Volkswagen Jetta.png'),
(17, 'Audi Q5', 'SUV', 5, 'Automatic', '55000.00', '90', './imgs/Audi Q5.png'),
(18, 'Mercedes-Benz C-Class', 'Sedan', 5, 'Automatic', '55000.00', '80', './imgs/Mercedes-Benz C-Class.png'),
(19, 'BMW 3 Series', 'Sedan', 5, 'Automatic', '50000.00', '85', './imgs/BMW 3 Seriesbmw.png'),
(22, 'Porsche 911', 'Sports Car', 2, 'Automatic', '150000.00', '90', './imgs/porsche-911.png'),
(23, 'Tesla Model S', 'Electric', 5, 'Automatic', '80000.00', '80', './imgs/Tesla Model S.png'),
(25, 'Ford Focus', 'Hatchback', 5, 'Manual', '22000.00', '70', './imgs/ford-focus.png'),
(26, 'Chevrolet Camaro', 'Sports Car', 4, 'Manual', '40000.00', '85', './imgs/camaro.png'),
(28, 'Audi A6', 'Sedan', 5, 'Automatic', '55000.00', '75', './imgs/audi-a4.png'),
(29, 'BMW X3', 'SUV', 5, 'Automatic', '45000.00', '85', './imgs/BMW X3.png'),
(30, 'Volvo XC60', 'SUV', 5, 'Automatic', '48000.00', '75', './imgs/Volvo XC60r.png'),
(31, 'Toyota Prius', 'Hybrid', 5, 'Automatic', '28000.00', '75', './imgs/toyota-prius.png'),
(32, 'Ford Explorer', 'SUV', 7, 'Automatic', '45000.00', '80', './imgs/ford-explorer.png'),
(34, 'Chevrolet Equinox', 'SUV', 5, 'Automatic', '28000.00', '65', './imgs/Chevrolet Equinox.png'),
(35, 'Volkswagen Passat', 'Sedan', 5, 'Automatic', '27000.00', '70', './imgs/Volkswagen Passat.png'),
(36, 'BMW 5 Series', 'Sedan', 5, 'Automatic', '60000.00', '90', './imgs/BMW 5 Series.png'),
(37, 'Nissan Rogue', 'SUV', 5, 'Automatic', '29000.00', '75', './imgs/nissan-rogue.png'),
(38, 'Jeep Compass', 'SUV', 5, 'Automatic', '25000.00', '70', './imgs/Jeep Compass.png'),
(39, 'Audi Q7', 'SUV', 7, 'Automatic', '65000.00', '85', './imgs/Audi Q7.png'),
(40, 'Mercedes-Benz GLC', 'SUV', 5, 'Automatic', '55000.00', '80', './imgs/Mercedes-Benz GLC.png'),
(41, 'Toyota Corolla', 'Sedan', 5, 'Automatic', '24000.00', '70', './imgs/toyota-corolla.png'),
(42, 'Ford Edge', 'SUV', 5, 'Automatic', '35000.00', '75', './imgs/Ford Edge.png'),
(44, 'Chevrolet Malibu', 'Sedan', 5, 'Automatic', '26000.00', '70', './imgs/Chevrolet Malibu.png'),
(45, 'Volkswagen Tiguan', 'SUV', 5, 'Automatic', '29000.00', '75', './imgs/volkswagen.png'),
(46, 'BMW 7 Series', 'Sedan', 5, 'Automatic', '80000.00', '95', './imgs/BMW 7 Series.png'),
(47, 'Nissan Sentra', 'Sedan', 5, 'Automatic', '23000.00', '65', './imgs/nissan-sentra.png'),
(48, 'Jeep Renegade', 'SUV', 5, 'Automatic', '26000.00', '70', './imgs/jeep Renegade.png'),
(49, 'Audi A3', 'Sedan', 5, 'Automatic', '35000.00', '80', './imgs/Audi A3.png'),
(50, 'Mercedes-Benz GLA', 'SUV', 5, 'Automatic', '40000.00', '85', './imgs/Mercedes-Benz GLA.png'),
(51, 'Toyota Yaris', 'Hatchback', 5, 'Automatic', '20000.00', '60', './imgs/Toyota Yaris.png'),
(52, 'Nissan Altima', 'Sedan', 5, 'Automatic', '28000.00', '37', './imgs/nissan-altima.png'),
(53, 'Hyundai Tucson', 'SUV', 5, 'Automatic', '27000.00', '36', './imgs/Hyundai Tucson.png'),
(55, 'Honda Civic', 'Sedan', 5, 'Automatic', '25000.00', '33', './imgs/honda-civic.png'),
(56, 'Honda CR-V', 'SUV', 5, 'Automatic', '32000.00', '39', './imgs/Honda CR-V.png');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `car_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 14, 1, '2023-06-20 20:20:06', '2023-06-20 20:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `First Name` varchar(30) NOT NULL,
  `Last Name` varchar(30) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `is_admin` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `First Name`, `Last Name`, `Email`, `password`, `Token`, `is_admin`) VALUES
(1, 'Walid', 'Zakan', 'walid@gmail.com', '$2y$10$tZKiRoWLjevu847lopzGo.qQIDU54Qyk9UXHrki6RWKq.I9D40iYy', 'e6a84cee3a81fd4d8545ec23d421f296777cccc47c71e95d3e0def641e14b20f', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_car_id` (`car_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_car_id` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
