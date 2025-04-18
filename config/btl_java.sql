-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 18, 2025 lúc 05:59 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

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
(1, 'Nguyễn Thành Hưng', 'admin', '123456', 'hung@gmail.com'),
(23, 'Trịnh Quốc Dũng', 'dung', '123456', 'dung@gmail.com'),
(25, 'Lê Đức Long', 'long', '123456', 'long@gmail.com');

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
  `Ngayvao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hopdong`
--

INSERT INTO `hopdong` (`id`, `Masinhvien`, `Hoten`, `Lop`, `Phong`, `Ngayvao`) VALUES
(3, '72DCHT20026', 'Lê Đức Long', 'HT21', 'PA02', '2024-05-17');

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
  `Ngayketthuc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ketthuc`
--

INSERT INTO `ketthuc` (`id`, `Masinhvien`, `Hoten`, `Lop`, `Phong`, `Ngayketthuc`) VALUES
(1, '72dcht20025', 'Trịnh Quốc Dũng', 'TT21', 'PA01', '2024-05-09'),
(2, '72DCHT20024', 'Nguyễn Thành Hưng', 'HT21', 'PA02', '2024-05-19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `Maphong` varchar(50) NOT NULL,
  `Tenphong` varchar(100) NOT NULL,
  `Daynha` varchar(50) NOT NULL,
  `Tinhtrang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`Maphong`, `Tenphong`, `Daynha`, `Tinhtrang`) VALUES
('MP1', 'PA02', 'A02', 'Đẹp'),
('MP2', 'PA01', 'A01', 'Sạch sẽ'),
('MP3', 'PB01', 'B01', 'Hơi bẩn'),
('MP4', 'PB02', 'B02', 'An ninh tốt'),
('MP5', 'PC01', 'C01', 'Sạch'),
('MP6', 'PC02', 'C02', 'Đẹp');

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
(6, '72DCHT20026', 'Lê Đức Long', 'Hệ thống thông tin', 'HT21', 'Nam', '09862485214', '0978476243', 'Hà Nội');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `Masinhvien` varchar(100) NOT NULL,
  `Phong` varchar(100) NOT NULL,
  `Tongtien` varchar(100) NOT NULL,
  `Thanhtoan` varchar(100) NOT NULL,
  `Ngaytao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhtoan`
--

INSERT INTO `thanhtoan` (`Masinhvien`, `Phong`, `Tongtien`, `Thanhtoan`, `Ngaytao`) VALUES
('72DCHT20024', 'PA02', '1120000', 'Đã thanh toán', '2024-04-06'),
('72dcht20025', 'PA01', '2000000', 'Chưa thanh toán', '2024-04-06'),
('72DCHT20026', 'PA02', '1025789', 'Chưa thanh toán', '2024-05-01');

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
  ADD PRIMARY KEY (`Maphong`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`Masinhvien`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dangnhap`
--
ALTER TABLE `dangnhap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `ketthuc`
--
ALTER TABLE `ketthuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
