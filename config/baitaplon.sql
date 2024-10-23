-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 22, 2024 lúc 02:24 PM
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
-- Cơ sở dữ liệu: `baitaplon`
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
  `Mahopdong` varchar(50) NOT NULL,
  `Masinhvien` varchar(100) DEFAULT NULL,
  `Hoten` varchar(50) DEFAULT NULL,
  `Lop` varchar(50) DEFAULT NULL,
  `Maphong` varchar(50) DEFAULT NULL,
  `Ngaytao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hopdong`
--

INSERT INTO `hopdong` (`id`, `Mahopdong`, `Masinhvien`, `Hoten`, `Lop`, `Maphong`, `Ngaytao`) VALUES
(7, 'HD1', '72DCHT20024', 'Nguyễn Thành Hưng', '72DCHT21', 'MP1', '2024-10-21 00:17:45'),
(8, 'HD2', '72DCHT20025', 'Trịnh Quốc Dũng', '72DCHT21', 'MP1', '2024-10-21 00:17:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ketthuc`
--

CREATE TABLE `ketthuc` (
  `id` int(11) NOT NULL,
  `Mathanhtoan` varchar(50) DEFAULT NULL,
  `Mahopdong` varchar(50) NOT NULL,
  `Hoten` varchar(100) DEFAULT NULL,
  `Thanhtoan` varchar(50) DEFAULT NULL,
  `Maphong` varchar(50) DEFAULT NULL,
  `Ngaytao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `id` int(11) NOT NULL,
  `Maphong` varchar(50) NOT NULL,
  `Tenphong` varchar(100) DEFAULT NULL,
  `Daynha` varchar(50) DEFAULT NULL,
  `Tinhtrang` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`id`, `Maphong`, `Tenphong`, `Daynha`, `Tinhtrang`) VALUES
(1, 'MP1', 'PA01', 'A01', 'Sạch '),
(2, 'MP3', 'PB01', 'B01', 'Đẹp'),
(3, 'MP5', 'PA21', 'A01', 'Bửn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` int(11) NOT NULL,
  `Masinhvien` varchar(50) NOT NULL,
  `Hoten` varchar(100) DEFAULT NULL,
  `Khoa` varchar(50) DEFAULT NULL,
  `Lop` varchar(50) DEFAULT NULL,
  `Gioitinh` varchar(50) DEFAULT NULL,
  `CCCD` varchar(50) DEFAULT NULL,
  `Sodienthoai` varchar(50) DEFAULT NULL,
  `Diachi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `Masinhvien`, `Hoten`, `Khoa`, `Lop`, `Gioitinh`, `CCCD`, `Sodienthoai`, `Diachi`) VALUES
(1, '72DCHT20024', 'Nguyễn Thành Hưng', 'Hệ thống thông tin', '72DCHT21', 'Nam', '09827425352', '08927824', 'Thanh Hóa'),
(2, '72DCHT20025', 'Trịnh Quốc Dũng', 'Hệ thống thông tin', '72DCHT21', 'Nam', '09827425352', '08927824', 'Nam dinh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `id` int(11) NOT NULL,
  `Mathanhtoan` varchar(50) NOT NULL,
  `Mahopdong` varchar(50) DEFAULT NULL,
  `Hoten` varchar(100) DEFAULT NULL,
  `Maphong` varchar(50) DEFAULT NULL,
  `Tongtien` varchar(50) DEFAULT NULL,
  `Thanhtoan` varchar(50) NOT NULL,
  `Ngaytao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhtoan`
--

INSERT INTO `thanhtoan` (`id`, `Mathanhtoan`, `Mahopdong`, `Hoten`, `Maphong`, `Tongtien`, `Thanhtoan`, `Ngaytao`) VALUES
(10, 'TT1', 'HD2', 'Trịnh Quốc Dũng', 'MP1', '950000', 'Đã thanh toán', '2024-10-21 00:18:12');

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
  ADD PRIMARY KEY (`Mahopdong`),
  ADD KEY `id` (`id`),
  ADD KEY `Masinhvien` (`Masinhvien`,`Maphong`),
  ADD KEY `Maphong` (`Maphong`);

--
-- Chỉ mục cho bảng `ketthuc`
--
ALTER TABLE `ketthuc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Mathanhtoan` (`Mathanhtoan`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`Maphong`),
  ADD KEY `id` (`id`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`Masinhvien`),
  ADD KEY `id` (`id`);

--
-- Chỉ mục cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`Mathanhtoan`),
  ADD KEY `id` (`id`),
  ADD KEY `Mahopdong` (`Mahopdong`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dangnhap`
--
ALTER TABLE `dangnhap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `ketthuc`
--
ALTER TABLE `ketthuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `phong`
--
ALTER TABLE `phong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  ADD CONSTRAINT `hopdong_ibfk_1` FOREIGN KEY (`Masinhvien`) REFERENCES `sinhvien` (`Masinhvien`),
  ADD CONSTRAINT `hopdong_ibfk_2` FOREIGN KEY (`Maphong`) REFERENCES `phong` (`Maphong`);

--
-- Các ràng buộc cho bảng `ketthuc`
--
ALTER TABLE `ketthuc`
  ADD CONSTRAINT `ketthuc_ibfk_1` FOREIGN KEY (`Mathanhtoan`) REFERENCES `thanhtoan` (`Mathanhtoan`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD CONSTRAINT `thanhtoan_ibfk_1` FOREIGN KEY (`Mahopdong`) REFERENCES `hopdong` (`Mahopdong`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
