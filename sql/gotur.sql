-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 30 May 2021, 02:24:54
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `gotur`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Foods'),
(2, 'Fruits & Veg'),
(3, 'Snacks'),
(4, 'Ice Cream'),
(5, 'Fit & Form'),
(6, 'Personal Care'),
(7, 'Pet Food');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_email` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `order_price` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `order_status` enum('1','2') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`order_id`, `user_email`, `order_price`, `order_status`) VALUES
(1, 'mustafauysaltr@hotmail.com', '105', '2');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int(11) NOT NULL,
  `status_title` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `order_status`
--

INSERT INTO `order_status` (`status_id`, `status_title`) VALUES
(1, 'Preparing'),
(2, 'On the Way');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_img` text COLLATE utf8_turkish_ci NOT NULL,
  `product_title` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `product_price` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `product_weight` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_img`, `product_title`, `product_price`, `product_weight`) VALUES
(3, 2, 'http://cdn.getir.com/product/5e272b4e274d2044389632d9_tr_1579688208937.jpeg', 'Imported Bananas', '11,99', '600'),
(4, 2, 'http://cdn.getir.com/product/5e2703de3b1fe77969cb9bec_tr_1579687397707.jpeg', 'Strawberries', '10,99', '500'),
(5, 3, 'http://cdn.getir.com/product/5898a207d5b34d0004dcef4b_tr_1616677579634.jpeg', 'Ülker Milk', '5,35', '60'),
(6, 3, 'http://cdn.getir.com/product/55a0215035a77b0c0075d119_tr_1581714411533.jpeg', 'Ülker Chocolate', '1,50', '36'),
(7, 1, 'http://cdn.getir.com/product/5dc02578a75859d787b3c5dd_tr_1584699072631.jpeg', 'Tat Tomato Past', '30,90', '400');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `user_surname` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `user_password` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `user_authority` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_password`, `user_authority`) VALUES
(1, 'Mustafa', 'Uysal', 'mustafauyysl@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1'),
(2, 'Mustafadasd', 'dasdsa', 'dasd@dsad.om', 'e10adc3949ba59abbe56e057f20f883e', '0'),
(3, 'Mustafa', 'Uysal', 'mustafauysaltr@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0'),
(4, 'Mustafa', 'Uysal', 'm@m.com', '202cb962ac59075b964b07152d234b70', '0');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Tablo için indeksler `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
