-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 15, 2023 lúc 09:59 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `main_parking`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `main_table`
--

CREATE TABLE `main_table` (
  `id` int(11) NOT NULL,
  `cName` varchar(255) NOT NULL DEFAULT 'N/A',
  `cPlate` varchar(255) NOT NULL DEFAULT 'N/A',
  `cTimeCheckIn` timestamp NULL DEFAULT current_timestamp(),
  `cTimeCheckOut` timestamp NULL DEFAULT current_timestamp(),
  `cParkArena` int(11) NOT NULL,
  `cStatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `main_table`
--

INSERT INTO `main_table` (`id`, `cName`, `cPlate`, `cTimeCheckIn`, `cTimeCheckOut`, `cParkArena`, `cStatus`) VALUES
(1, 'hmnu-t1', 'apt-ps1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(2, 'hnmu-t2', 'apt-ps2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(3, 'hnmu-t3', 'apt-ps3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(4, 'hnmu-t4', 'apt-ps4', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(5, 'hnmu-t5', 'apt-ps5', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 4),
(6, 'hnmu-t6', 'apt-ps6', '2023-05-09 17:00:00', '2023-05-19 17:00:00', 1, 4),
(7, 'hnmu-t7', 'apt-ps7', '2023-05-09 17:00:00', '2023-05-19 17:00:00', 2, 4),
(8, 'hnmu-t8', 'apt-ps8', '2023-05-09 17:00:00', '2023-05-19 17:00:00', 2, 4),
(9, 'hnmu-t9', 'apt-ps9', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 4),
(10, 'hnmu-t10', 'apt-ps10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 4),
(11, 'hnmu-t11', 'apt-ps11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 4),
(12, 'hnmu-t2', 'apt-ps12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `parking_arena`
--

CREATE TABLE `parking_arena` (
  `id` int(11) NOT NULL,
  `idParkArena` int(11) NOT NULL,
  `parkName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parkLocation` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `parking_arena`
--

INSERT INTO `parking_arena` (`id`, `idParkArena`, `parkName`, `parkLocation`, `description`) VALUES
(1, 1, 'A1', 1, 'Bãi đỗ cho cá nhân'),
(2, 1, 'A1', 2, 'Bãi đỗ cho cá nhân'),
(3, 1, 'A1', 3, 'Bãi đỗ cho cá nhân'),
(4, 1, 'A1', 4, 'Bãi đỗ cho cá nhân'),
(5, 1, 'A1', 5, 'Bãi đỗ cho cá nhân'),
(6, 1, 'A1', 6, 'Bãi đỗ cho doanh nghiệp'),
(7, 2, 'B1', 1, 'Bãi đỗ cho doanh nghiệp'),
(8, 2, 'B1', 2, 'Bãi đỗ cho doanh nghiệp'),
(9, 2, 'B1', 3, 'Bãi đỗ cho doanh nghiệp'),
(10, 2, 'B1', 4, 'Bãi đỗ cho doanh nghiệp'),
(11, 2, 'B1', 5, 'Bãi đỗ cho cá nhân'),
(12, 2, 'B1', 6, 'Bãi đỗ cho doanh nghiệp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status_code`
--

CREATE TABLE `status_code` (
  `id` int(11) NOT NULL,
  `sId` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `status_code`
--

INSERT INTO `status_code` (`id`, `sId`, `description`) VALUES
(1, 1, 'chỗ trống'),
(2, 2, 'đang sử dụng'),
(3, 3, 'đã đặt lịch'),
(4, 4, 'bảo trì');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `main_table`
--
ALTER TABLE `main_table`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `parking_arena`
--
ALTER TABLE `parking_arena`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `status_code`
--
ALTER TABLE `status_code`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `main_table`
--
ALTER TABLE `main_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `parking_arena`
--
ALTER TABLE `parking_arena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `status_code`
--
ALTER TABLE `status_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
