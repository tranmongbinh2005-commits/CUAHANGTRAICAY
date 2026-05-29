-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table if0_41924609_bai1.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table if0_41924609_bai1.category: ~5 rows (approximately)
INSERT INTO `category` (`id`, `name`, `description`) VALUES
	(1, 'Trái cây nội địa', 'Các loại trái cây đặc sản trong nước như xoài, nhãn, vải...'),
	(2, 'Trái cây nhập khẩu', 'Trái cây cao cấp nhập khẩu từ Mỹ, Úc, Nhật Bản, Hàn Quốc...'),
	(3, 'Giỏ quà trái cây', 'Các set quà tặng, giỏ trái cây sang trọng cho dịp lễ, biếu tặng'),
	(4, 'Trái cây sấy khô', 'Các loại hoa quả sấy, mứt trái cây dinh dưỡng'),
	(5, 'Nước ép hoa quả', 'Nước ép nguyên chất từ trái cây tươi mỗi ngày');

-- Dumping structure for table if0_41924609_bai1.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table if0_41924609_bai1.orders: ~0 rows (approximately)

-- Dumping structure for table if0_41924609_bai1.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table if0_41924609_bai1.order_details: ~0 rows (approximately)

-- Dumping structure for table if0_41924609_bai1.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table if0_41924609_bai1.product: ~5 rows (approximately)
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
	(1, 'Xoài Cát Hòa Lộc', 'Xoài cát chín vàng, ngọt lịm, thơm lừng, chuẩn loại 1.', 85000.00, 'uploads/xoài cát.jpg', 1),
	(2, 'Vải thiều Bắc Giang', 'Vải thiều lùi cùi dày, hạt nhỏ, ngọt lịm.', 45000.00, 'uploads/vải.jpg', 1),
	(3, 'Táo Envy Mỹ', 'Táo Envy nhập khẩu chính ngạch, giòn ngọt, mọng nước.', 150000.00, 'uploads/táo.jpg', 2),
	(4, 'Nho mẫu đơn Hàn Quốc', 'Nho sữa Shine Muscat, trái to, thơm mùi sữa đặc trưng.', 450000.00, 'uploads/515154-nho-mau-don-han-quoc.jpg', 2),
	(5, 'Giỏ quà Phú Quý', 'Giỏ quà kết hợp táo Envy, nho xanh Úc và hoa tươi trang trí.', 850000.00, 'uploads/hinh-anh-gio-trai-cay-6.jpg', 3);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
