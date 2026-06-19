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
CREATE DATABASE cuahangtraicay
USE cuahangtraicay
-- Dumping structure for table cuahangtraicay.account
CREATE TABLE IF NOT EXISTS `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuahangtraicay.account: ~2 rows (approximately)
INSERT INTO `account` (`id`, `username`, `fullname`, `password`, `role`, `email`, `phone`, `address`) VALUES
	(3, 'admin', 'Trần Mộng Bình', '$2y$10$eXcVEaKFUC4bNleOXy34m.yacFYNzsJquvabCt2hJz73wGyRZ1Boe', 'admin', NULL, NULL, NULL),
	(4, 'user', 'Nguyễn Thanh Hiến', '$2y$10$7FBdjHJ1i0EQ7.ykzofKUu2mlABk7hGBPS37me87a1VM.VNfPmj7C', 'user', 'hien123@gmail.com', '0935643', 'S10.06 Long Bình');

-- Dumping structure for table cuahangtraicay.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuahangtraicay.category: ~5 rows (approximately)
INSERT INTO `category` (`id`, `name`, `description`) VALUES
	(1, 'Trái cây nội địa', 'Các loại trái cây đặc sản trong nước như xoài, nhãn, vải...'),
	(2, 'Trái cây nhập khẩu', 'Trái cây cao cấp nhập khẩu từ Mỹ, Úc, Nhật Bản, Hàn Quốc...'),
	(3, 'Giỏ quà trái cây', 'Các set quà tặng, giỏ trái cây sang trọng cho dịp lễ, biếu tặng'),
	(4, 'Trái cây sấy khô', 'Các loại hoa quả sấy, mứt trái cây dinh dưỡng'),
	(5, 'Nước ép hoa quả', 'Nước ép nguyên chất từ trái cây tươi mỗi ngày');

-- Dumping structure for table cuahangtraicay.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(50) DEFAULT 'cod',
  `notes` text,
  `total_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuahangtraicay.orders: ~3 rows (approximately)
INSERT INTO `orders` (`id`, `customer_name`, `email`, `phone`, `address`, `payment_method`, `notes`, `total_price`, `created_at`) VALUES
	(1, 'Nguyễn Thanh Hiến', 'hien123@gmail.com', '0935643', 'S10.06 Long Bình', 'cod', '14g', 525000.00, '2026-06-05 03:21:38'),
	(2, 'Nguyễn Thanh Hiến', 'hien123@gmail.com', '0935643', 'S10.06 Long Bình', 'bank_transfer', '', 3865000.00, '2026-06-05 03:22:10'),
	(3, 'Nguyễn Thanh Hiến', 'hien123@gmail.com', '0935643', 'S10.06 Long Bình', 'bank_transfer', '', 390000.00, '2026-06-05 03:25:05');

-- Dumping structure for table cuahangtraicay.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL DEFAULT '',
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuahangtraicay.order_details: ~9 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`) VALUES
	(1, 1, 2, 'Vải thiều Bắc Giang', 1, 45000.00),
	(2, 1, 7, 'Trái Cây Sấy', 1, 65000.00),
	(3, 1, 9, 'Nước Ép Cam(Vinamilk)', 1, 330000.00),
	(4, 1, 1, 'Xoài Cát Hòa Lộc', 1, 85000.00),
	(5, 2, 1, 'Xoài Cát Hòa Lộc', 1, 85000.00),
	(6, 2, 4, 'Nho mẫu đơn Hàn Quốc', 1, 450000.00),
	(7, 2, 11, 'Nước Ép Lựu Táo(Vinamilk)', 1, 3330000.00),
	(8, 3, 3, 'Táo Envy Mỹ', 1, 150000.00),
	(9, 3, 6, 'Sầu Riêng MusangKing', 1, 240000.00);

-- Dumping structure for table cuahangtraicay.product
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuahangtraicay.product: ~5 rows (approximately)
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
	(1, 'Xoài Cát Hòa Lộc', 'Xoài cát chín vàng, ngọt lịm, thơm lừng, chuẩn loại 1.', 85000.00, 'uploads/159-95431.jpg', 1),
	(2, 'Vải thiều Bắc Giang', 'Vải thiều lùi cùi dày, hạt nhỏ, ngọt lịm.', 45000.00, 'uploads/20190604140134-vt8.jpg', 1),
	(3, 'Táo Envy Mỹ', 'Táo Envy nhập khẩu chính ngạch, giòn ngọt, mọng nước.', 150000.00, 'uploads/png.jpg', 2),
	(4, 'Nho mẫu đơn Hàn Quốc', 'Nho sữa Shine Muscat, trái to, thơm mùi sữa đặc trưng.', 450000.00, 'uploads/515154-nho-mau-don-han-quoc.jpg', 2),
	(5, 'Giỏ quà Phú Quý', 'Giỏ quà kết hợp táo Envy, nho xanh Úc và hoa tươi trang trí.', 850000.00, 'uploads/hinh-anh-gio-trai-cay-6.jpg', 3),
	(6, 'Sầu Riêng MusangKing', 'Hương vị đẳng cấp: Cơm sầu béo ngậy như bơ, dẻo mịn, ngọt đậm đà hòa quyện cùng hậu vị đắng nhẹ tinh tế khó quên.Màu sắc &amp; Kết cấu: Thịt sầu có màu vàng óng hoặc vàng nghệ đậm, múi dày dặn, không bị xơ và đặc biệt có tỷ lệ hạt lép cực cao (lên tới 85% - 90%).Mùi thơm: Thơm nồng nàn, quyến rũ đặc trưng nhưng thanh thoát, không bị hắc hay quá nồng.', 240000.00, 'uploads/3-67ba133a-54f7-451d-a46c-54b0053119dd.jpg', 1),
	(7, 'Trái Cây Sấy', 'à sản phẩm từ nhiều loại rau củ, quả tươi ngon tại Đà Lạt, thiết bị sấy tiên tiến hiện đại nên vẫn giữ được hương vị tự nhiên của quả, độ thơm, ngon, giòn và rất hợp khẩu vị. Cung cấp nhiều chất dinh dưỡng, muối khoáng thiết yếu cho cơ thể. THẬP CẨM SẤY chứa nhiều chất xơ, khoáng chất, Vitamin A, B1, B2, B3, B5, B6, các nguyên tố vi lượng, kali, sắt…\r\nĐảm bảo hàng chuẩn xuất khẩu, chất lượng cao, không hôi dầu, không chất bảo quản, không đường, hoàn toàn tử rau củ quả tươi 100%', 65000.00, 'uploads/thap-cam-say-kho.jpg', 4),
	(8, 'Dâu Hàn Quốc', 'dâu tây Hàn Quốc có kích thước lớn gấp đôi, nhiều nước, kết hợp hài hòa giữa vị ngọt và chua, phần thịt dâu mềm và hàm lượng đường cao. Đây là một loại trái cây cao cấp, có hương thơm rõ rệt và khác biệt so với các loại dâu được trồng ở xứ nóng.\r\n\r\nMùa dâu tây ở Hàn Quốc thường bắt đầu từ tháng 12 đến tháng 6 năm sau. Dâu Hàn Quốc phát triển tốt nhất vào mùa xuân trong điều kiện khí hậu ôn hòa, nhiều nắng và bắt đầu chín từ 20 ngày. Do đó, theo người Hàn, thời điểm thích hợp để thu hoạch và phân phối dâu tây cho hương vị ngon ngọt nhất là vào tháng 1, 2.\r\n\r\nLà dòng trái cây cao cấp, đẹp về hình thức và ngon ngọt về hương vị, dâu tây Hàn Quốc phù hợp để làm quà biếu tặng, là nguyên liệu đặc biệt cho các món tráng miệng trong dịp lễ, Tết hoặc những sự kiện quan trọng.', 230000.00, 'uploads/dau-tay-han-quoc-fuji-4.jpg', 2),
	(9, 'Nước Ép Cam(Vinamilk)', 'Cam tùy mùa từ Địa Trung Hải\r\nChỉ tuyển chọn từ top 10 giống cam tiếng tăm. Trứ danh nhất là Navel chua ngọt cân đối. Tiếp đến là Valencia chín vàng nức mũi. Cam Shamouti và Hamlin ít hạt, tép kín đầy nước. Riêng gương mặt mới nổi Pera dáng dài vỏ mỏng, chính là một ẩn số thơm lừng tạo nên sự khác biệt.\r\n\r\nCông thức phối trộn độc quyền\r\nNước trái cây của Vinamilk mang tỉ lệ độc nhất giữa các giống cam tiếng tăm từ Địa Trung Hải.\r\n\r\nVị ngọt tự nhiên từ cam mọng nước - Không bổ sung đường\r\nVị ngọt tự nhiên từ đường có sẵn trong nguyên liệu trái cây khi ép. Vinamilk không bổ sung thêm đường trong quá trình sản xuất.\r\n\r\n1 lít chứa 190 mg Vitamin C\r\nMỗi hộp nước ép cam Vinamilk 1 lít chứa 190 mg Vitamin C hoàn toàn tự nhiên, giúp hỗ trợ miễn dịch, tăng cường đề kháng, giúp bạn khỏe mạnh mỗi ngày.\r\n\r\nChất lượng 3 Không\r\nHoàn toàn không chứa chất bảo quản, không sử dụng màu, 100% không biến đổi gen.', 330000.00, 'uploads/NGK_Nuocep_Cam_1_Lvuong_01_8e8c6f98b2_80738983ad.png', 5),
	(10, 'Nước Ép Táo(Vinamilk)', 'Là giống táo Mỹ, Red Delicious đỏ sẫm chắc ruột, Golden Delicious vàng mướt ngọt như mật ong, sánh cùng nàng thơ gốc Úc Granny Smith xanh bóng chua nhẹ, và táo Lady thơm lừng mùa Giáng Sinh của Pháp. Bất ngờ cuối đến từ viên ngọc rực lửa của Thổ Nhĩ Kỳ: táo Amasya vỏ đỏ hồng, ruột trắng xanh, nước ngọt lịm. Tất cả những giống táo thơm ngon nhất hạng đều được chúng tôi kỳ công dành riêng tặng bạn. \r\n\r\nCông thức phối trộn độc quyền\r\nNước trái cây của Vinamilk là sự kết hợp có một không hai từ các giống táo thơm ngon nhất hạng khắp thế giới.\r\n\r\nVị ngọt tự nhiên từ táo ruột giòn - Không bổ sung đường\r\nVị ngọt tự nhiên từ đường có sẵn trong nguyên liệu trái cây khi ép. Vinamilk không bổ sung thêm đường trong quá trình sản xuất.\r\n\r\n \r\n\r\n1 lít chứa 100 mg Vitamin C\r\nMỗi hộp nước ép táo Vinamilk 1 lít chứa 100 mg Vitamin C hoàn toàn tự nhiên, giúp hỗ trợ miễn dịch, tăng cường đề kháng, giúp bạn khỏe mạnh mỗi ngày.\r\n\r\nChất lượng 3 Không\r\nHoàn toàn không chứa chất bảo quản, không sử dụng màu, 100% không biến đổi gen.', 333000.00, 'uploads/NGK_Nuocep_Tao_1_Lvuong_01_36b913df17_cccdfe5ac6.png', 5),
	(11, 'Nước Ép Lựu Táo(Vinamilk)', 'Lựu và táo được chúng tôi tuyển chọn từ Nam Phi, Hungary, Israel, Thổ Nhĩ Kỳ, Tây Ban Nha, đảm bảo hái đúng mùa trái chín.\r\n\r\n1 Hộp chứa 500 mg collagen thủy phân\r\nCollagen thủy phân có hoạt tính sinh học với trọng lượng phân tử nhỏ hơn khoảng 150 lần so với collagen thô, có tác dụng hỗ trợ: giảm nếp nhăn cho da đàn hồi, thúc đẩy tóc mọc dày, giảm tình trạng gãy móng.\r\n\r\nGiảm nếp nhăn cho da đàn hồi:\r\n\r\nGiảm 20% độ sâu nếp nhăn mắt, tăng 18% độ đàn hồi. Đối tượng nghiên cứu: 45-65 tuổi với liều dùng 2.5g/ ngày, 8 tuần.\r\nRef:  E. Proksch, M. Schunck b V. Zague, D. Segger, J. Degwert, S. Oesser: Oral Intake of Specific Bioactive Collagen Peptides Reduces Skin Wrinkles and Increases Dermal Matrix Synthesis. Skin Pharmacol Physiol 2014;27:113–119.\r\nGiảm 11% tình trạng lồi lõm. Đối tượng nghiên cứu: 25-50 tuổi với liều dùng 2.5g/ ngày, 6 tháng.\r\nRef: Michael Schunck, Vivian Zague, Steffen Oesser, and Ehrhardt Proksch: Dietary Supplementation with Specific Collagen Peptides Has a Body Mass Index-Dependent Beneficial Effect on Cellulite Morphology. J Med Food 18 (12) 2015, 1340–1348.\r\nThúc đẩy tóc mọc dày:\r\n\r\nTăng 1.93±0.42 µm độ dày tóc. Đối tượng nghiên cứu: 39-75 tuổi với liều dùng 2.5g/ ngày, 16 tuần.\r\nThử nghiệm trong ống nghiệm, sau 4 giờ ủ: tỷ lệ tăng sinh tế bào tóc cao hơn 31%\r\nRef: Steffen Oesser: The oral intake of specific Bioactive Collagen Peptides has a positive effect on hair thickness.Nutrafodds (2020) 1:134-138.\r\nGiảm tình trạng gãy móng:\r\n\r\nGiúp tăng 12% tốc độ phát triển của móng và giảm 42% tần suất gãy móng. Đối tượng nghiên cứu: 18 - 50 tuổi với liều dùng 2.5g/ ngày, 24 tuần.  \r\nRef: Hexsel D, Zague V, Schunck M, Siega C, Camozzato FO, Oesser S. Oral supplementation with specific bioactive collagen peptides improves nail growth and reduces symptoms of brittle nails. J Cosmet Dermatol. 2017;16:520–526. https://doi.org/10.1111/jocd.12393  \r\nCông thức phối trộn độc quyền\r\nNước trái cây của Vinamilk mang tỉ lệ độc nhất giữa các giống táo và lựu tiếng tăm từ khắp nơi trên thế giới.\r\n\r\nVị ngọt tự nhiên từ lựu táo giòn - Không bổ sung đường\r\nVị ngọt tự nhiên từ đường có sẵn trong nguyên liệu trái cây khi ép. Vinamilk không bổ sung thêm đường trong quá trình sản xuất.\r\n\r\nChất lượng 3 không\r\nHoàn toàn không chứa chất bảo quản, không sử dụng màu, 100% không biến đổi gen.', 3330000.00, 'uploads/NGK_Nuocep_Collagen_Luu_Tao_01_d138de2b15_c651082f10.png', 5);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
