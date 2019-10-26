-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2019 lúc 03:34 PM
-- Phiên bản máy phục vụ: 10.1.39-MariaDB
-- Phiên bản PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nhom9`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `book_name` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(11) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`id`, `book_name`, `category_id`, `image`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Thám tử lừng danh Conan', 1, '/public/lib/images/Conan.jpg', '<p>Th&aacute;m tử lừng danh Conan</p>\r\n', 25, '2019-10-25 10:53:55', '2019-10-25 15:53:55'),
(2, 'Số đỏ', 2, '/public/lib/images/S%E1%BB%91%20%C4%91%E1%BB%8F.jpg', '<p>Truyện d&agrave;i 20 chương v&agrave; được bắt đầu khi b&agrave; Ph&oacute; Đoan đến chơi ở s&acirc;n quần vợt&nbsp;nơi Xu&acirc;n t&oacute;c đỏ l&agrave;m việc.&nbsp;</p>\r\n', 150000, '2019-10-25 16:11:14', '2019-10-25 11:11:14'),
(3, 'Chìa khóa vũ trụ của George', 3, '/public/lib/images/Ch%C3%ACa%20kh%C3%B3a%20v%C5%A9%20tr%E1%BB%A5.jpg', '<p>Cuốn s&aacute;ch lồng gh&eacute;p những kiến thức cơ bản nhất về vũ trụ xung quanh ch&uacute;ng ta v&agrave;o c&acirc;u chuyện đời thường của một cậu b&eacute; đam m&ecirc; khoa học George.</p>\r\n', 50000, '2019-10-25 22:46:59', '2019-10-26 03:46:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Truyện tranh', '2019-10-25 08:37:58', '2019-10-25 13:37:58'),
(2, 'Tiểu thuyết', '2019-10-25 08:38:18', '2019-10-25 13:38:18'),
(3, 'Sách khoa học - viễn tưởng', '2019-10-25 15:51:20', '2019-10-25 10:51:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `phone`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Trịnh Ngọc Kiềm', 'kiemhoangtunho98@gmail.com', 358508484, '$2y$10$W/Yaw3gqSUj9gBoTRyS1hOF6ZYcEpgYVT6zklgyxoUE.DmzO/tf0W', 1, '2019-10-24 03:38:34', '2019-10-23 17:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
