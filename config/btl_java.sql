-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 19, 2024 lúc 05:52 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `btl_java`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangnhap`
--

CREATE TABLE `dangnhap` (
  `id` int(11) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `taikhoan` varchar(250) NOT NULL,
  `matkhau` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dangnhap`
--

INSERT INTO `dangnhap` (`id`, `hoten`, `taikhoan`, `matkhau`, `email`) VALUES
(28, 'Nguyễn Thành Hưng', 'admin', '123456', 'hung@gmail.com'),
(33, 'Trịnh Quốc Dũng', 'dung', '123456', 'dung@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hopdong`
--

CREATE TABLE `hopdong` (
  `id` int(11) NOT NULL,
  `Masinhvien` varchar(100) NOT NULL,
  `Hoten` varchar(255) NOT NULL,
  `Lop` varchar(100) NOT NULL,
  `Phong` varchar(50) NOT NULL,
  `Ngayvao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hopdong`
--

INSERT INTO `hopdong` (`id`, `Masinhvien`, `Hoten`, `Lop`, `Phong`, `Ngayvao`) VALUES
(39, '72DCHT20024', 'Nguyễn Thành Hưng', 'HT21', 'PA01', '2024-06-19 15:29:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ketthuc`
--

CREATE TABLE `ketthuc` (
  `id` int(11) NOT NULL,
  `Masinhvien` varchar(100) NOT NULL,
  `Hoten` varchar(255) NOT NULL,
  `Lop` varchar(100) NOT NULL,
  `Phong` varchar(50) NOT NULL,
  `Ngayketthuc` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ketthuc`
--

INSERT INTO `ketthuc` (`id`, `Masinhvien`, `Hoten`, `Lop`, `Phong`, `Ngayketthuc`) VALUES
(6, '72DCHT20024', 'Nguyễn Thành Hưng', 'HT21', 'PB01', '2024-06-17 15:29:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `id` int(11) NOT NULL,
  `Maphong` varchar(50) NOT NULL,
  `Tenphong` varchar(100) NOT NULL,
  `Daynha` varchar(50) NOT NULL,
  `Tinhtrang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`id`, `Maphong`, `Tenphong`, `Daynha`, `Tinhtrang`) VALUES
(1, 'MP1', 'PA01', 'A01', 'Sạch sẽ'),
(2, 'MP2', 'PA02', 'A01', 'Đẹp'),
(3, 'MP3', 'PB01', 'B01', 'Đẹp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` int(11) NOT NULL,
  `Masinhvien` varchar(100) NOT NULL,
  `Hoten` varchar(255) NOT NULL,
  `Khoa` varchar(100) NOT NULL,
  `Lop` varchar(50) NOT NULL,
  `Gioitinh` varchar(50) NOT NULL,
  `CCCD` varchar(100) NOT NULL,
  `Sodienthoai` varchar(100) NOT NULL,
  `Diachi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `Masinhvien`, `Hoten`, `Khoa`, `Lop`, `Gioitinh`, `CCCD`, `Sodienthoai`, `Diachi`) VALUES
(3, '72DCHT20025', 'Trịnh Quốc Dũng', 'Hệ thống thông tin', 'HT21', 'Nam', '09862485214', '0978476243', 'Nam Định'),
(5, '72DCHT20024', 'Nguyễn Thành Hưng', 'Hệ thống thông tin', 'HT21', 'Nam', '09862485213', '097847624', 'Thanh Hóa'),
(6, '72DCHT20026', 'Lê Đức Long', 'Hệ thống thông tin', 'HT21', 'Nam', '09862485214', '0978476243', 'Hà Nội'),
(8, '72DCHT20027', 'Cao Tuấn Anh', 'Hệ thống thông tin', 'HT21', 'Nam', '09862485214', '0978476243', 'Hà Nội');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `id` int(11) NOT NULL,
  `Masinhvien` varchar(100) NOT NULL,
  `Phong` varchar(100) NOT NULL,
  `Tongtien` varchar(100) NOT NULL,
  `Thanhtoan` varchar(100) NOT NULL,
  `Ngaytao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhtoan`
--

INSERT INTO `thanhtoan` (`id`, `Masinhvien`, `Phong`, `Tongtien`, `Thanhtoan`, `Ngaytao`) VALUES
(14, '72DCHT20024', 'PB01', '950000', 'Đã thanh toán', '2024-06-17 15:27:17');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dangnhap`
--
ALTER TABLE `dangnhap`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ketthuc`
--
ALTER TABLE `ketthuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dangnhap`
--
ALTER TABLE `dangnhap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `ketthuc`
--
ALTER TABLE `ketthuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `phong`
--
ALTER TABLE `phong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
