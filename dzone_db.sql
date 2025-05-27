-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 09:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dzone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','ordered','processing','shipped','delivered') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `created_at`) VALUES
(14, 2, 26000.00, 'ordered', '2025-05-26 07:16:33'),
(16, 11, 182999.00, 'ordered', '2025-05-26 08:26:39'),
(17, 2, 1500.00, 'ordered', '2025-05-27 08:39:50'),
(18, 2, 22999.00, 'ordered', '2025-05-27 17:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(14, 14, 9, 1, 26000.00),
(16, 16, 7, 1, 180000.00),
(17, 16, 18, 1, 1500.00),
(18, 16, 23, 1, 1499.00),
(19, 17, 18, 1, 1500.00),
(20, 18, 12, 1, 22999.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_status_updates`
--

CREATE TABLE `order_status_updates` (
  `id` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `status` enum('pending','ordered','processing','shipped','delivered') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status_updates`
--

INSERT INTO `order_status_updates` (`id`, `order_item_id`, `status`, `updated_at`) VALUES
(11, 14, 'ordered', '2025-05-26 07:16:33'),
(12, 14, 'shipped', '2025-05-26 07:25:24'),
(13, 14, 'delivered', '2025-05-26 07:25:44'),
(15, 16, 'ordered', '2025-05-26 08:26:39'),
(16, 17, 'ordered', '2025-05-26 08:26:39'),
(17, 18, 'ordered', '2025-05-26 08:26:39'),
(18, 18, 'shipped', '2025-05-26 08:27:49'),
(19, 16, 'shipped', '2025-05-26 08:28:12'),
(20, 16, 'delivered', '2025-05-26 08:28:33'),
(21, 19, 'ordered', '2025-05-27 08:39:50'),
(22, 19, 'delivered', '2025-05-27 09:26:41'),
(23, 20, 'ordered', '2025-05-27 17:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `name`, `description`, `price`, `category`, `image`, `stock`, `created_at`) VALUES
(7, 1, 'Apple iPhone 16 - 256 GB - Teal', 'The Apple iPhone 16 128GB in Teal offers a sleek and stylish design with a stunning 6.1-inch Super Retina XDR display for vibrant colors and sharp details. Powered by the advanced A18 chip, it ensures smooth performance, efficient multitasking, and enhanced gaming. The dual-camera system captures stunning photos and videos, even in low-light conditions.', 180000.00, 'mobile', 'https://www.imagineonline.store/cdn/shop/files/iPhone_16_Teal_PDP_Image_Position_1__en-IN.jpg?v=1727248003', 9, '2025-05-26 06:05:33'),
(8, 7, 'Iphone 16 ', 'iPhone 16 Pro Max | Phone Plans, Colors & Storage | Bell Canada', 200000.00, 'mobile', 'https://www.bell.ca/Styles/wireless/iphone_16_pro_max/iPhone_16_Pro_Max_Desert_Titanium_lrg2.png', 5, '2025-05-26 06:07:02'),
(9, 1, 'pixel 6a', 'Google Pixel 6a (Charcoal, 128 GB)  (6 GB RAM)#JustHere', 26000.00, 'mobile', 'https://rukminim2.flixcart.com/image/312/312/xif0q/mobile/s/y/0/-original-imaggbrbxkqr3v3u.jpeg?q=70', 4, '2025-05-26 06:10:13'),
(10, 7, 'Google Pixel 9 Pro (Rose Quartz, 256 GB)', '6 GB RAM | 256 GB ROM\r\n16.0 cm (6.3 inch) Display\r\n50MP + 48MP + 48MP | 42MP Front Camera\r\n4700 mAh Battery\r\nG4 Tensor Chip Processor', 99999.00, 'mobile', 'https://rukminim2.flixcart.com/image/312/312/xif0q/mobile/r/t/d/-original-imah5mtmwj3kwvzt.jpeg?q=70', 25, '2025-05-26 06:11:59'),
(11, 1, 'MOTOROLA Edge 60 Pro (Pantone Shadow, 256 GB)', '12 GB RAM | 256 GB ROM\r\n17.02 cm (6.7 inch) Display\r\n50MP + 50MP + 10MP | 50MP Front Camera\r\n6000 mAh Battery\r\nDimensity 8350 Processor', 33999.00, 'mobile', 'https://rukminim2.flixcart.com/image/312/312/xif0q/mobile/0/a/z/-original-imahbpnynmcez9kj.jpeg?q=70', 30, '2025-05-26 06:14:05'),
(12, 1, 'MOTOROLA Edge 60 Fusion 5G (PANTONE Slipstream, 256 GB)', '8 GB RAM | 256 GB ROM | Expandable Upto 1 TB\r\n16.94 cm (6.67 inch) Display\r\n50MP + 13MP | 32MP Front Camera\r\n5500 mAh Battery\r\nDimensity 7400 Processor\r\n68W Charger', 22999.00, 'mobile', 'https://rukminim2.flixcart.com/image/312/312/xif0q/mobile/r/i/c/-original-imahbfmdzukyctut.jpeg?q=70', 19, '2025-05-26 06:15:51'),
(13, 7, 'REDMI 14C 5G (Starlight Blue, 128 GB)', '6 GB RAM | 128 GB ROM | Expandable Upto 1 TB\r\n17.48 cm (6.88 inch) HD+ Display\r\n50MP Rear Camera | 8MP Front Camera\r\n5160 mAh Battery\r\n4 Gen 2 5G Processor', 11499.00, 'mobile', 'https://rukminim2.flixcart.com/image/312/312/xif0q/mobile/f/a/l/14c-5g-2411drn471-redmi-original-imah89dek9zgzxcx.jpeg?q=70', 26, '2025-05-26 06:18:52'),
(14, 7, 'vivo V50 5G (Titanium Grey, 128 GB)', '8 GB RAM | 128 GB ROM\r\n17.2 cm (6.77 inch) Display\r\n50MP + 50MP | 50MP Front Camera\r\n6000 mAh Battery\r\n7 Gen 3 Processor', 34999.00, 'mobile', 'https://rukminim2.flixcart.com/image/312/312/xif0q/mobile/p/b/o/-original-imahc6hdyb4zbct8.jpeg?q=70', 50, '2025-05-26 06:20:47'),
(15, 7, 'OPPO K12x 5G with 45W SUPERVOOC Charger In-The-Box (Midnight Violet, 256 GB)', 'OPPO K12x 5G with 45W SUPERVOOC Charger In-The-Box (Midnight Violet, 256 GB)\r\n4.420,194 Ratings & 895 Reviews\r\n8 GB RAM | 256 GB ROM | Expandable Upto 1 TB\r\n16.94 cm (6.67 inch) HD Display\r\n32MP + 2MP | 8MP Front Camera\r\n5100 mAh Battery\r\nDimensity 6300 Processor\r\n', 15999.00, 'mobile', 'https://rukminim2.flixcart.com/image/312/312/xif0q/mobile/s/m/0/-original-imah37gw2wv2ayrf.jpeg?q=70', 200, '2025-05-26 06:23:44'),
(16, 1, 'OPPO Reno13 5G (Blue, 128 GB)', 'OPPO Reno13 5G (Blue, 128 GB)\r\n4.43,244 Ratings & 413 Reviews\r\n8 GB RAM | 128 GB ROM\r\n16.74 cm (6.59 inch) Display\r\n50MP + 8MP + 2MP | 50MP Front Camera\r\n5600 mAh Battery\r\nDimensity 8350 Processor\r\n1 Year Warranty on Handset and 6 Months Warranty on Accessories', 35999.00, 'mobile', 'https://rukminim2.flixcart.com/image/312/312/xif0q/mobile/f/i/o/-original-imah89yzwcfgufhv.jpeg?q=70', 23, '2025-05-26 06:25:16'),
(17, 7, 'OPPO Reno13 5G (Blue, 128 GB)', 'OPPO Reno13 5G (Blue, 128 GB)\r\n4.43,244 Ratings & 413 Reviews\r\n8 GB RAM | 128 GB ROM\r\n16.74 cm (6.59 inch) Display\r\n50MP + 8MP + 2MP | 50MP Front Camera\r\n5600 mAh Battery\r\nDimensity 8350 Processor\r\n1 Year Warranty on Handset and 6 Months Warranty on Accessories', 35000.00, 'mobile', 'https://rukminim2.flixcart.com/image/312/312/xif0q/mobile/y/q/p/-original-imaha4zmgr7qtqew.jpeg?q=70', 25, '2025-05-26 06:26:27'),
(18, 9, 'OnePlus Bullets Wireless Z2 Bluetooth  (Acoustic Red, In the Ear)', 'With Mic:Yes\r\nBluetooth version: 5\r\nBattery life: 20 Hrs | Charging time: 10 Mins\r\nBattery life: 20 Hrs\r\nCharging time: 10 mins', 1500.00, 'Headphone', 'https://rukminim2.flixcart.com/image/612/612/l4ei1e80/headphone/b/j/w/bullets-wireless-z2-oneplus-original-imagfaww7ga6nshz.jpeg?q=70', 48, '2025-05-26 06:30:14'),
(19, 9, 'OnePlus Bullets Wireless Z2 Bluetooth ', 'With Mic:Yes\r\nBluetooth version: 5\r\nBattery life: 20 Hrs | Charging time: 10 Mins\r\nBattery life: 20 Hrs\r\nCharging time: 10 mins', 1500.00, 'Headphone', 'https://rukminim2.flixcart.com/image/612/612/l0sgyvk0/headphone/e/w/c/buds-z2-oneplus-original-imagcg5gfpcg5ndv.jpeg?q=70', 25, '2025-05-26 06:31:02'),
(20, 9, 'boAt Rockerz 235 Pro with upto 20 Hours Playback & ASAP Charge Bluetooth  (Furious Blue, In the Ear)', 'With Mic:Yes\r\nBluetooth version: 5.2\r\nWireless range: 10 m\r\nBattery time: Upto 20 Hours|ASAP Charge: 10 Mins= 10 Hours\r\nENx Technology: Clear Voice Calls\r\nBeast Mode: Low Latency for Gaming\r\nCall Vibration Alert', 899.00, 'Headphone', 'https://rukminim2.flixcart.com/image/612/612/l2jcccw0/headphone/e/b/t/-original-imagduskzq2my6td.jpeg?q=70', 100, '2025-05-26 06:32:03'),
(21, 9, 'boAt Airdopes Alpha with 35 HRS Playback, 13mm Drivers, Dual Mics ENx & Beast Mode Bluetooth  (Peach Dusk, In the Ear)', 'With Mic:Yes\r\nBEAST Mode: Experience lag-free high-quality gaming with low latency of up to 50 ms. Visuals align with impactful audio for realistic action.\r\n35 HRS Playback & ASAP Charge: Airdopes Alpha TWS Earbuds offer up to 35 hours of playtime, giving you plenty of time to listen to your preferred tunes. 10 minutes of charging yields about 120 minutes of seamless performance.\r\nboAt Signature Sound: Powered by dual 13 mm drivers, these earbuds deliver matchless boAt Signature sound with superior bass.', 999.00, 'Headphone', 'https://rukminim2.flixcart.com/image/612/612/xif0q/headphone/v/f/8/-original-imahae3g84uzxbsz.jpeg?q=70', 50, '2025-05-26 06:44:33'),
(22, 9, 'OnePlus Buds 3 TWS, in Ear Earbuds with Sliding Volume Control and 49dB ANC Gaming Bluetooth  (Minty Green, True Wireless)', 'With Mic:Yes\r\n[Best-in-class Sound Quality]: 10.4mm+6mm dynamic dual driver, LHDC5.0 Bluetooth CODEC and high resolution certification makes the product best in its sound quality with deeper bass, delicate treble and clear vocals\r\n[Sliding Volume Control]: Slide on the surface of touch area of buds to adjust the volume.Sliding up increases the volume, while sliding down decreases the volume', 5499.00, 'Headphone', 'https://rukminim2.flixcart.com/image/612/612/xif0q/headphone/l/g/v/5481158721-oneplus-original-imah4rkhfmjzy7gb.jpeg?q=70', 50, '2025-05-26 06:47:13'),
(23, 9, 'boAt Lunar Discovery w/ Turn by Turn Navigation, 3.53 cm HD Display & BT Calling Smartwatch  (Mint Green Strap, Free Siz', 'Turn-By-Turn Navigation with MapMyIndia: Whether it\'s a new destination or a familiar place, find your way without being lost using the boAt Lunar Discovery Smartwatch.\r\n3.53(1.39\") HD Display: Check the time, navigation routes, activity records, & more on the 1.39\'\' (3.53 cm) TFT display. Designed with 240x240p resolution for high clarity, this watch makes it easy to view details round-the-clock.\r\nBluetooth Calling: Swiftly call your frequently contacted numbers from this watch. Save up to 20 contacts for easy access or use the inbuilt dialpad to dial any phone number.', 1499.00, 'Smart Watch', 'https://rukminim2.flixcart.com/image/612/612/xif0q/smartwatch/e/f/m/-original-imah5upfaspvy9dy.jpeg?q=70', 49, '2025-05-26 06:49:35'),
(24, 9, 'Noise Icon 2 Elite Edition 1.8\'\' Display with Metallic Body and Bluetooth Calling Smartwatch  (Elite Black Strap, Regular)', '1.8\" LCD display\r\nBluetooth Calling Smartwatch with AI voice assistance\r\nNoise Health SuiteTM: Blood Oxygen, 24*7 Heart rate monitor, Stress Monitor and Sleep Monitor\r\n60 Sports mode & 100+ watch faces\r\nNoiseFit app: Pair with the improved Noisefit app for better health insights\r\nWith Call Function\r\nTouchscreen\r\nFitness & Outdoor\r\nBattery Runtime: Upto 7 days', 1599.00, 'Smart Watch', 'https://rukminim2.flixcart.com/image/612/612/xif0q/smartwatch/m/v/i/-original-imah76cazsbbt8hu.jpeg?q=70', 25, '2025-05-26 06:50:55'),
(25, 9, 'Bxeno Buds Wireless 3 with MAGNETIC POWER OFF/ON ,48Hr Playback Headphone [5M] Bluetooth  (Yellow,black, In the Ear)', 'Bxeno Buds Wireless 3 with MAGNETIC POWER OFF/ON ,48Hr Playback Headphone [5M] Bluetooth  (Yellow,black, In the Ear)', 581.00, 'Headphone', 'https://rukminim2.flixcart.com/image/612/612/xif0q/shopsy-headphone/m/k/c/bluetooth-yes-buds-wireless-3-with-magnetic-power-off-on-48hr-original-imah9tyfhkeq3tgc.jpeg?q=70', 25, '2025-05-26 06:52:48'),
(26, 10, 'AnuElectronics Arduino UNO R3 Development Board with ATmega328P Electronic Components Electronic Hobby Kit', 'AnuElectronics Arduino UNO R3 Development Board with ATmega328P Electronic Components Electronic Hobby Kit', 799.00, 'Electronics', 'https://rukminim2.flixcart.com/image/612/612/xif0q/electronic-hobby-kit/m/a/k/arduino-uno-r3-development-board-with-atmega328p-anuelectronics-original-imagygc7cusr4s3s.jpeg?q=70', 200, '2025-05-26 06:55:18'),
(27, 10, 'Nano V3.0 Module ATmega328P 5V 16MHz CH340G Chip Microcontroller', 'Power Source: DC\r\nMaterial: Brass\r\nWeight: 20', 499.00, 'Electronics', 'https://rukminim2.flixcart.com/image/612/612/kf4ajrk0/electronic-hobby-kit/k/d/k/uno-r3-official-box-atmega16u2-mega328p-chip-and-usb-cable-original-imafvmupaw6zvctd.jpeg?q=70', 50, '2025-05-26 06:56:50'),
(28, 10, 'GoPro Hero11 with Extra Enduro Rechargeable Battery Sports and Action Camera  (Black, 27 MP)', 'Effective Pixels: 27 MP\r\n5.3K', 25000.00, 'Camera', 'https://rukminim2.flixcart.com/image/312/312/xif0q/sports-action-camera/m/a/d/hero11-with-extra-enduro-rechargeable-battery-hero11-2-27-27-original-imah2ftrjepwasrn.jpeg?q=70', 50, '2025-05-26 07:01:43'),
(29, 10, 'GoPro Hero Sports and Action Camera  (Black, 10 MP)#JustHere', 'GoPro Hero Sports and Action Camera  (Black, 10 MP)#JustHere', 30000.00, 'Camera', 'https://rukminim2.flixcart.com/image/312/312/jf751u80/sports-action-camera/m/z/k/na-hero-chdhb-501-gopro-original-imaf3qyp6hmyhk73.jpeg?q=70', 20, '2025-05-26 07:02:42'),
(30, 10, 'GoPro HERO13 Creator Edition -Volta, Media Mod, Light Mod, Enduro Battery, Mount Sports and Action Camera  (Black, 27 MP)', 'GoPro HERO13 Creator Edition -Volta, Media Mod, Light Mod, Enduro Battery, Mount Sports and Action Camera  (Black, 27 MP)', 14000.00, 'Camera', 'https://rukminim2.flixcart.com/image/312/312/xif0q/sports-action-camera/m/u/p/hero13-creator-edition-na-2-27-27-hero13-creator-edition-gopro-original-imah4cg9vvcyhmhx.jpeg?q=70', 20, '2025-05-26 07:04:41'),
(31, 10, 'Canon EOS R10 Mirrorless Camera Body with RF-S 18 - 45 mm f/4.5 - 6.3 IS STM Lens', 'Canon EOS R10 Mirrorless Camera Body with RF-S 18 - 45 mm f/4.5 - 6.3 IS STM Lens', 77820.00, 'Camera', 'https://rukminim2.flixcart.com/image/312/312/l5fnhjk0/dslr-camera/g/t/7/eos-r10-24-2-r10-canon-original-imagg4y52cybasdr.jpeg?q=70', 50, '2025-05-26 07:06:15'),
(32, 10, 'Canon EOS R50 Mirrorless Camera RF - S 18 - 45 mm f/4.5 - 6.3 IS STM and RF - S 55 - 210 mm f/5 - 7.1 ...', 'Canon EOS R50 Mirrorless Camera RF - S 18 - 45 mm f/4.5 - 6.3 IS STM and RF - S 55 - 210 mm f/5 - 7.1 ...', 80000.00, 'Camera', 'https://rukminim2.flixcart.com/image/312/312/xif0q/dslr-camera/8/g/b/eos-r50-24-2-r50-canon-original-imagngcb6vj5fmyg.jpeg?q=70', 20, '2025-05-26 07:07:20'),
(33, 10, 'brother DCP-T420W Multi-function WiFi Color Ink Tank Printer (Borderless Printing)  (4 Ink Bottles Included)', 'Output: Color\r\nUSB, WiFi, WiFi Direct | USB\r\nPrint Speed Mono A4: 16 ppm | Print Speed Color A4: 9.5 ppm\r\nSupported OS: Windows, macOS, Linux\r\nFunctions: Print, Copy, Scan', 15000.00, 'Printer', 'https://rukminim2.flixcart.com/image/612/612/xif0q/printer/l/q/c/dcp-t220-brother-original-imahce2wac2kuzqf.jpeg?q=70', 40, '2025-05-26 07:08:48'),
(34, 10, 'HP Smart Tank 670 All-in-One Multi-function WiFi Color Ink Tank Printer for Print/Copy/Scan with Automatic Ink Sensor, Auto Duplex feature - High Capacity Tank (Up to 6000 Black, 8000 Colour pages of ink in box)', 'HP Smart Tank 670 All-in-One Multi-function WiFi Color Ink Tank Printer for Print/Copy/Scan with Automatic Ink Sensor, Auto Duplex feature - High Capacity Tank (Up to 6000 Black, 8000 Colour pages of ink in box)', 17999.00, 'Printer', 'https://rukminim2.flixcart.com/image/612/612/xif0q/printer/x/m/j/-original-imagtxgyhxybqkpr.jpeg?q=70', 50, '2025-05-26 07:09:55'),
(35, 10, 'HP 1008W Single Function WiFi Monochrome Laser Printer ...', '', 12499.00, 'Printer', 'https://rukminim2.flixcart.com/image/612/612/xif0q/printer/7/x/p/1008w-hp-original-imah9ydxrrnxgswh.jpeg?q=70', 20, '2025-05-26 07:11:13'),
(36, 10, 'Egate Atom 3X | Native FHD 1080p & 4K Support, 13.0', 'Egate Atom 3X | Native FHD 1080p & 4K Support, 13.0', 7040.00, 'Electronics', 'https://rukminim2.flixcart.com/image/612/612/xif0q/projector/4/x/3/atom-3x-native-fhd-1080p-4k-support-13-0-android-projector-300-original-imahbxepqgqurfh7.jpeg?q=70', 10, '2025-05-26 07:12:59'),
(37, 10, 'Egate FireFlix 7X (EL9030) (700 lm / 1 Speaker / Wirele.', '', 179090.00, 'Electronics', 'https://rukminim2.flixcart.com/image/612/612/xif0q/projector/o/x/f/fireflix-7x-el9030-10-el9030-led-projector-egate-original-imahbt2gufuty5h6.jpeg?q=70', 20, '2025-05-26 07:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `return_requests`
--

CREATE TABLE `return_requests` (
  `id` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `status` enum('requested','approved','picked_up','refunded','rejected') NOT NULL DEFAULT 'requested',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reason` text DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '[]' CHECK (json_valid(`images`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_requests`
--

INSERT INTO `return_requests` (`id`, `order_item_id`, `status`, `created_at`, `updated_at`, `reason`, `images`) VALUES
(7, 14, 'rejected', '2025-05-26 07:26:34', '2025-05-27 10:32:12', NULL, '[]'),
(8, 16, 'refunded', '2025-05-26 08:28:55', '2025-05-26 08:29:53', NULL, '[]'),
(9, 19, 'rejected', '2025-05-27 09:27:04', '2025-05-27 10:10:45', 'Wrong Item', '[\"uploads\\/returns\\/68358568df033.png\"]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('customer','seller','admin') NOT NULL,
  `profile_image` varchar(255) DEFAULT 'https://via.placeholder.com/40',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_image`, `created_at`) VALUES
(1, 'som', '$2y$10$3vYLqi16Ie9LDEqJl5TDSOszq6P3CwZrcTfaYLRCh9dtYDV1TF28S', 'b@gmail.com', 'seller', 'https://e7.pngegg.com/pngimages/550/997/png-clipart-user-icon-foreigners-avatar-child-face.png', '2025-05-24 18:20:33'),
(2, 'dev', '$2y$10$6N8CFS3L3zqJ0CJWbfaCTup84CFFAFGEe533D2HvsPBWIXs78V1O6', 'a@gmail.com', 'customer', 'https://images-cdn.ubuy.co.in/65414af8fd4858736a695a7e-pre-owned-apple-iphone-x-256gb-factory.jpg', '2025-05-24 18:22:47'),
(4, 'ad1', '$2y$10$uRwlUfoNILQccbaDrMQm5uU3LqOh79KzLkmmwRL7V3WCq6Tbyg6.W', 'aa@gmail.com', 'admin', 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740', '2025-05-24 18:37:54'),
(6, 'ad2', '$2y$10$M6bxaPgUuL4jrxOtZz81PuamNokkYghUfCsnfct1ErnG14GFIfEPO', 'c@gmail.com', 'admin', 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740', '2025-05-25 08:12:08'),
(7, 'abc', '$2y$10$/yTWrEi/UPaRxk5HPIdppu.6AG3VQAodOY.teKJd5YWpoIU21pCSa', 'd@gmail.com', 'seller', 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740', '2025-05-25 18:20:26'),
(8, 'babu', '$2y$10$vtiLQuI7CTaWJ7V1yISpnOcHBHpJgZqh1ztn/BPWk/tr8vWKzbywi', 'bb@gmail.com', 'seller', 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740', '2025-05-25 19:17:55'),
(9, 'sel1', '$2y$10$KVt/mO6DiI00M8hzTdsAUeuu8apVK4xFksK6/sHJFWYoPHQZG354u', 'sel@gmail.com', 'seller', 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740', '2025-05-26 06:28:04'),
(10, 'sel2', '$2y$10$FybVO4s6xcZhArY//e3Y8uHVqnhRKkPZ6RScTGW2eUHygfcaXLSEC', 'sel2@gmail.com', 'seller', 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740', '2025-05-26 06:54:35'),
(11, 'soma', '$2y$10$5XkIJPyHj9odR3VeedUTO.TbjdzAtK2V00jSfvU54NQbx33RHOkae', 's@gmail.com', 'customer', 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740', '2025-05-26 08:25:09'),
(12, 'mmm', '$2y$10$VKjmtcDFav6NrvSLmOaITOdXwaCAybHKTFoikBL1i0sf.ktUIt.IG', 'm@gmail.com', 'customer', 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740', '2025-05-27 07:45:34'),
(13, 'ad3', '$2y$10$g5XGgiVDM.8JyxLPS80szOTo0tSndC6OHEq2fI6Wl6TtshMVOzsNC', 'ad3@gmail.com', 'admin', 'https://upload.wikimedia.org/wikipedia/commons/a/ac/NewTux.png', '2025-05-27 08:16:34'),
(14, 'ad4', '$2y$10$90YPmxnEcU1LQwGo4AiOPeb2IAvRF5wNLNxZ6WMBvB/8BRYPWNkwC', 'ad4@gmail.com', 'admin', 'https://t4.ftcdn.net/jpg/02/27/45/09/360_F_227450952_KQCMShHPOPebUXklULsKsROk5AvN6H1H.jpg', '2025-05-27 19:53:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_status_updates`
--
ALTER TABLE `order_status_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_id` (`order_item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `return_requests`
--
ALTER TABLE `return_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_id` (`order_item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_status_updates`
--
ALTER TABLE `order_status_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `return_requests`
--
ALTER TABLE `return_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `order_status_updates`
--
ALTER TABLE `order_status_updates`
  ADD CONSTRAINT `order_status_updates_ibfk_1` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `return_requests`
--
ALTER TABLE `return_requests`
  ADD CONSTRAINT `return_requests_ibfk_1` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
