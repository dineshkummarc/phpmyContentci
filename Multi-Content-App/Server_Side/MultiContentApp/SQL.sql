-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2019 at 09:07 AM
-- Server version: 10.2.22-MariaDB-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contentinw24_multi`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_table`
--

CREATE TABLE `activity_table` (
  `activity_id` int(11) NOT NULL,
  `activity_user_id` int(11) NOT NULL,
  `activity_agent` varchar(60) NOT NULL,
  `activity_time` varchar(20) NOT NULL,
  `activity_ip` varchar(15) NOT NULL,
  `activity_login_status` tinyint(1) NOT NULL COMMENT '1: Success | 2: UnSuccess',
  `activity_desc` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Activity Table';

--
-- Dumping data for table `activity_table`
--

INSERT INTO `activity_table` (`activity_id`, `activity_user_id`, `activity_agent`, `activity_time`, `activity_ip`, `activity_login_status`, `activity_desc`) VALUES
(9, 1, 'Linux OS', '1552886776', '192.168.1.1', 1, 'User login into the Dashboard.');

-- --------------------------------------------------------

--
-- Table structure for table `api_table`
--

CREATE TABLE `api_table` (
  `api_id` int(11) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `api_status` tinyint(1) NOT NULL COMMENT '0: Inactive | 1: Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='API Table';

--
-- Dumping data for table `api_table`
--

INSERT INTO `api_table` (`api_id`, `api_key`, `api_status`) VALUES
(1, 'CvD98IFcjRKX4XjJQLusjXYsztp5qgS7XtUgbuJQ5SlbXqrSjMZZ1abxbGtHFiKDvviB22ej8XDu772o0.YM1g--', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookmark_table`
--

CREATE TABLE `bookmark_table` (
  `bookmark_id` int(11) NOT NULL,
  `bookmark_user_id` int(11) NOT NULL,
  `bookmark_content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bookmark Table';

-- --------------------------------------------------------

--
-- Table structure for table `captcha_table`
--

CREATE TABLE `captcha_table` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `captcha_ip_address` varchar(45) NOT NULL,
  `captcha_word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `captcha_table`
--

INSERT INTO `captcha_table` (`captcha_id`, `captcha_time`, `captcha_ip_address`, `captcha_word`) VALUES
(1005, 1552886756, '54.36.85.237', '87649');

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `category_id` int(11) NOT NULL,
  `category_parent_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL,
  `category_image` varchar(100) NOT NULL,
  `category_role_id` tinyint(4) NOT NULL,
  `category_status` tinyint(1) NOT NULL COMMENT '0: Inactive | 1: Active',
  `category_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Category Table';

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`category_id`, `category_parent_id`, `category_title`, `category_image`, `category_role_id`, `category_status`, `category_order`) VALUES
(1, 0, 'Video Content', 'e804eff3a32ced906edf9a854de11666.png', 0, 1, 1),
(2, 0, 'Music Content', 'd73ce162479d7d9637086a36db474ef4.png', 0, 1, 1),
(3, 0, 'HTML5 Games', '66111cfeb5614acf6157551bd3947e91.png', 0, 1, 1),
(4, 0, 'Article & News', '97a151d092a99303b43ecf7eccd18cba.png', 0, 1, 1),
(5, 0, 'Download', '0536f01c9e67114d26534f5840f0184b.png', 0, 1, 1),
(6, 0, 'Introduce', 'a7cda2341a2d0685365e59f6304ec40c.png', 0, 1, 1),
(7, 6, 'Website', '9761324a1104cd11fa8c34a9b368420f.png', 0, 1, 1),
(8, 6, 'Social Channel', '76303fe00460dd7f8852c334b4b701b3.png', 0, 1, 1),
(9, 6, 'Social Group', '45ffe2763cf5566a97412ebcb0e01855.png', 0, 1, 1),
(10, 6, 'Mobile App', '26d8d4e4d5682c11b893edc8ffc5f149.png', 0, 1, 1),
(11, 0, 'User\'s Manual', '0c42f063e559cf111935566b8b39dce2.png', 0, 1, 1),
(12, 11, 'Server Side', 'efad7abf67ab11ceca44f1defff6c7e3.png', 0, 1, 1),
(13, 11, 'Android Side', 'e4cc3486342f87adcdc4ccfd6eeb7b6d.png', 0, 1, 2),
(14, 11, 'Other', '9dac61122aa47cb54d7d7562b186645c.png', 0, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `content_table`
--

CREATE TABLE `content_table` (
  `content_id` int(11) NOT NULL,
  `content_title` varchar(120) NOT NULL,
  `content_description` mediumtext NOT NULL,
  `content_property1` varchar(100) NOT NULL COMMENT 'Custom Property',
  `content_property2` varchar(100) NOT NULL,
  `content_orientation` tinyint(1) NOT NULL COMMENT '1: It does not matter | 2: portrait | 3: landscape',
  `content_price` float NOT NULL,
  `content_type_id` tinyint(4) NOT NULL,
  `content_access` tinyint(1) NOT NULL COMMENT '1: Indirect Access | 2: Direct Access',
  `content_category_id` smallint(6) NOT NULL,
  `content_user_role_id` tinyint(4) NOT NULL,
  `content_image` varchar(100) DEFAULT NULL,
  `content_url` varchar(200) NOT NULL,
  `content_duration` varchar(15) NOT NULL,
  `content_viewed` int(11) NOT NULL,
  `content_liked` int(11) NOT NULL,
  `content_featured` tinyint(1) NOT NULL COMMENT '0: Not Featured | 1: Featured',
  `content_special` tinyint(1) NOT NULL COMMENT '0: Not Special | 1: Special',
  `content_publish_date` varchar(20) NOT NULL,
  `content_publish_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `content_expired_date` varchar(20) NOT NULL,
  `content_order` int(11) NOT NULL DEFAULT 1,
  `content_status` tinyint(1) NOT NULL COMMENT '0: Inactive | 1: Active | 2: Expired'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Item Tables';

--
-- Dumping data for table `content_table`
--

INSERT INTO `content_table` (`content_id`, `content_title`, `content_description`, `content_property1`, `content_property2`, `content_orientation`, `content_price`, `content_type_id`, `content_access`, `content_category_id`, `content_user_role_id`, `content_image`, `content_url`, `content_duration`, `content_viewed`, `content_liked`, `content_featured`, `content_special`, `content_publish_date`, `content_publish_timestamp`, `content_expired_date`, `content_order`, `content_status`) VALUES
(1, 'Dwayne Johnson (The Rock)', '<p>Dwayne Douglas Johnson (born May 2, 1972), also known by his ring name The Rock, is an American actor, producer, and semi-retired professional wrestler.</p>\r\n<p>Considered to be one of the greatest professional wrestlers of all-time, Johnson was born in Hayward, California, but moved to Florida in 1989, where he was a college football player for the University of Miami, with whom he won a national championship in 1991. After initially aspiring for a career in football, Johnson began training as a professional wrestler in the summer of 1995, after being cut from the Calgary Stampeders of the Canadian Football League (CFL).</p>', 'p1', 'p2', 1, 10, 8, 1, 8, 5, '1b34f4e85a9ac97cadaf35f75b9fb9cf.jpg', 'https://www.instagram.com/therock/?hl=en', '', 11, 0, 1, 0, '1552375887', '2019-03-12 07:31:27', '2340775887', 1, 1),
(2, 'Microsoft adds DirectX 12 support on Windows 7', '<p>Microsoft has announced that it is bringing DirectX 12 support for Windows 7. The company also announced that Blizzard Entertainment\'s hugely popular World of Warcraft will become the first title to support DirectX 12 on Windows 7.</p>\r\n<p>DirectX 12 is a low-level API launched alongside Windows 10. It aims to improve performance and efficiency by reducing driver overhead. DirectX 12 titles are able to better leverage multi-core CPUs and also enable multi-GPU systems without requiring hardware vendor technologies such as CrossFire or SLi.</p>\r\n<p>Over the past couple of years, developers have been increasingly adding support for DirectX 12 in their titles. When implemented properly, DX12 does show improved performance over DX11. However, because many gamers are still on Windows 7 for whatever reason, they could only run the game at DX11, which is the latest version supported by that OS.</p>\r\n<p>While working with Blizzard, Microsoft decided to port over the D3D12 runtime over to Windows 7. However, Microsoft has clarified that while this will enable developers to support DX12 on Windows 7, the best DX12 performance will still be found on Windows 10 as that OS was designed from the ground-up for this API. You also won\'t get any of the other features such as DXR (DirectX Raytracing) on Windows 7.</p>\r\n<p>If you are a Windows 8 or 8.1 users then you are out of luck as those will continue to remain on DX11.</p>\r\n<p>So far, WoW is the only title announced with DX12 support on Windows 7. However, Microsoft has said that it is working with a few other game developers to port their D3D12 games over to Windows 7.</p>\r\n<p>As for drivers, both AMD and NVIDIA has announced that they will be releasing drivers that enable support for DX12 on Windows 7 for compatible graphics cards.</p>\r\n<p> </p>', 'p1', 'p2', 1, 10, 5, 1, 4, 5, '042e1877400f7e6269b9b5d4f68a8734.jpg', '', '', 3, 0, 1, 0, '1552712601', '2019-03-16 05:03:21', '2341112601', 1, 1),
(3, 'Huawei P30 Pro shows up', '<p>Previous colors we’ve seen are Twilight and Aurora, which have much more distinct gradients, plus the staple Black color. The Huawei P30 was also seen in Twilight, Aurora, Black, so there’s a chance it will get Sunrise too (unless there are a few exclusive colors for each model).</p>\r\n<p>Anyway, there’s some good news to come out of these new renders as well – the P30 will have a 3.5mm headphone jack, the P30 Pro will have an IR blaster. Note that it’s either-or, neither phone has both.</p>', 'p1', 'p2', 1, 10, 5, 1, 4, 5, 'f77363495e078df89f2e20d04cb33df6.jpg', '', '', 2, 0, 1, 0, '1552712859', '2019-03-16 05:07:39', '2341112859', 1, 1),
(4, 'Steam Truncker', '<p>This is a <strong>HTML5 Game</strong> for demo. This game load from: www.envatousercontent.com</p>', 'p1', 'p2', 3, 10, 4, 1, 3, 5, 'd4421ff62adab041d8c4b00354536963.png', 'https://previews.envatousercontent.com/files/242891746/index.html', '', 2, 0, 1, 0, '1552713169', '2019-03-16 05:12:49', '2341113169', 1, 1),
(5, 'Volley Player', '<p>This is a <strong>HTML5 Game</strong> for demo. This game load from: www.codethislab.com</p>', 'p1', 'p2', 3, 10, 4, 1, 3, 5, 'dfd0427ee82e980c21708c7c1ca7b96d.png', 'http://showcase.codethislab.com/games/ultimate_swish/', '', 3, 0, 1, 0, '1552713398', '2019-03-16 05:16:38', '2341113398', 1, 1),
(6, 'Getting Started', '<p>test</p>', 'p1', 'p2', 1, 10, 5, 1, 12, 5, '6e31d535fe4edd35ca04c0cf995e3948.jpg', '', '', 12, 0, 0, 0, '1552801144', '2019-03-17 05:39:04', '2341201144', 1, 1),
(7, 'Database Creation', '<p>1. Click on the: <strong>MySQL Databases</strong></p>\r\n<p>2. Create database and give database name like you want, as example : \'inw24_mydb’</p>\r\n<p>3. Create user for your database</p>\r\n<p>4. Add user to your database and check ALL PRIVILEGES</p>\r\n<p> </p>\r\n<p><em>Please visit above video.</em></p>', 'p1', 'p2', 1, 10, 1, 1, 12, 5, '0d48e63832a3e65a2abdc05d9abc05f2.jpg', 'http://www.inw24.com/user_manual/multi_content_app/videos/01_DatabaseCreation-min.mp4', '01:38', 4, 0, 0, 0, '1552801524', '2019-03-17 05:45:24', '2341201524', 3, 1),
(8, 'Import Database .sql file', '<p>1. Click on the <strong>phpMyAdmin</strong> and select your database.<br> 2. Import file database SQL.sql from download package inside \'server_side\' folder.</p>\r\n<p> </p>\r\n<p><em>Please visit above video.</em></p>', 'p1', 'p2', 1, 10, 1, 1, 12, 5, 'dc9c50bb7f3f35791f5999acebafc421.jpg', 'http://www.inw24.com/user_manual/multi_content_app/videos/02_ImportSQL-min.mp4', '01:45', 2, 0, 0, 0, '1552801862', '2019-03-17 05:51:02', '2341201862', 4, 1),
(9, 'Upload PHP Scripts', '<p>1. Open <strong>File Manager</strong> via cpanel or ftp server, upload all php script inside Server_Side folder to folder destination on your hosting, highly recommended to compress all files into .zip file before you upload it and extract it after the .zip file is uploaded.</p>\r\n<p>2. Configure the database connection file, open \'database.php\' in folder \'application/config\' which is in the includes folder of your package.</p>\r\n<p>3. Put your database information on line: 78.<br> <code> \'hostname\' => \'localhost\',<br> \'username\' => \'YourDatabaseUsername\',<br> \'password\' => \'YourDatabasePassword\',<br> \'database\' => \'YourDatabaseName\', </code></p>\r\n<p>4. Login to Admin Dashboard:<br> <strong>       Login: www.YourDomain.com/dashboard<br>       Username: admin<br>       Password: 123456789 </strong></p>\r\n<p> </p>\r\n<p><em>Please visit above video.</em></p>', 'p1', 'p2', 1, 10, 1, 1, 12, 5, '615475874cec3cf5710c68196a58cb32.jpg', 'http://www.inw24.com/user_manual/multi_content_app/videos/03_UploadScripts-min.mp4', '03:22', 3, 0, 0, 0, '1552801976', '2019-03-17 05:52:56', '2341201976', 5, 1),
(10, 'Import in Android Studio', '<p>1. Open Android Studio → Open an existing Android Studio Project.</p>\r\n<p>2. New window will opened → Browse to directory where you place YourVideosChannel project → Ok.</p>\r\n<p>3. Wait for few minutes until all process import has finished.</p>\r\n<p>4. Change the package name. Follow the above video.</p>', 'p1', 'p2', 1, 10, 1, 1, 13, 5, 'f9889be179e116c623c4bf48b971628b.jpg', 'http://www.inw24.com/user_manual/multi_content_app/videos/04_ImportInAndroidStudio-min.mp4', '02:06', 3, 0, 0, 0, '1552802653', '2019-03-17 06:04:13', '2341202653', 1, 1),
(11, 'API Key Configuration', '<div class=\"col-md-9\">\r\n<p>1. Open Admin Dashboard →<br> www.YourDomain.com/dashboard</p>\r\n<p>2. Open: <strong>Settings</strong> → <strong>API Key</strong></p>\r\n<p>3. Write a random key (Number and Letter) in the API Key field and click on <strong>Save Key</strong>.</p>\r\n<p>4. Open Android Studio → Open app > java > Config.java</p>\r\n<p>5. Put your API key which obtained from admin dashboard<br>       <code> public static final String API_KEY = \"gyHg3xc5Za2FGb6hJ7hb1az\"; </code></p>\r\n<img title=\"Admin Dashboard\" src=\"http://www.inw24.com/user_manual/multi_content_app/images/api-key.jpg\" width=\"100%\" height=\"auto\"></div>\r\n<div class=\"col-md-9\"> <br> <img title=\"Android Studio\" src=\"http://www.inw24.com/user_manual/multi_content_app/images/config-api-key.jpg\" width=\"100%\" height=\"auto\"></div>', 'p1', 'p2', 1, 10, 5, 1, 13, 5, '37f40724e1e830ae93f6eab3556964f5.jpg', '', '', 4, 0, 0, 0, '1552802819', '2019-03-17 06:06:59', '2341202819', 2, 1),
(12, 'Change Logo', '<p>1. Open Android Studio → File → New → Image Asset</p>\r\n<p>2. You can choose 2 types of your icon type, that is Launcher Icon (Adaptive and Legacy) or (Legacy Only)</p>\r\n<p>3. Recommended to use Launcher Icon (Adaptive and Legacy)</p>\r\n<p>4. Browse and choose your image file icon (.png) format with square dimension and start customize your icon</p>\r\n<p>5. Make sure the resource name is \"ic_launcher\" → Next → Finish</p>', 'p1', 'p2', 1, 10, 5, 1, 13, 5, '6f492ba167cc135827f2ba2eb13401d2.jpg', '', '', 2, 0, 0, 0, '1552803037', '2019-03-17 06:10:37', '2341203037', 3, 1),
(13, 'Change Color', '<p>1. Open Android Studio → app → res → values → colors.xml</p>\r\n<p>2. Enter your color code inside each of strings tag</p>\r\n<p> <br> <img title=\"Change Color\" src=\"http://www.inw24.com/user_manual/multi_content_app/images/color.jpg\" width=\"100%\" height=\"auto\"></p>', 'p1', 'p2', 1, 10, 5, 1, 13, 5, 'a77551b6a38d0962a02bb3e2f49152a9.jpg', '', '', 0, 0, 0, 0, '1552803114', '2019-03-17 06:11:54', '2341203114', 4, 1),
(14, 'Change Name & Text', '<p>Change Application Name and Text Inside the Application:</p>\r\n<p>1. Open Android Studio → app → res → values → strings.xml</p>\r\n<p>2. Change value name in each strings tag according your needs.</p>', 'p1', 'p2', 1, 10, 5, 1, 13, 5, 'adc3f78a0194200944ecbe885f6b50e5.jpg', '', '', 1, 0, 0, 0, '1552803270', '2019-03-17 06:14:30', '2341203270', 5, 1),
(15, 'Change Font', '<p>If you want to change default font, first prepare a TTF format font that you like and then:</p>\r\n<p>1. Open Android Studio → app → assets → fonts</p>\r\n<p>2. Copy and overwrite your custom.ttf font.</p>', 'p1', 'p2', 1, 10, 5, 1, 13, 5, '428d35db356d04dfdcae7d6ad28ef025.jpg', '', '', 1, 0, 0, 0, '1552803406', '2019-03-17 06:16:46', '2341203406', 6, 1),
(16, 'Splash Image and other Required Image Assets', '<p>1. Open app → res → drawable and replace with your image or icon, all image are placed on there</p>\r\n<p>2. You also can change every image in app like via Explorer, open Explore and go to your project directory, select app\\src\\main\\res\\drawable</p>\r\n<p>3. Replace every image which you need to custom the application and highly recommended you using same resolution for each image</p>', 'p1', 'p2', 1, 10, 5, 1, 13, 5, 'b4a87fa171dbc6f7da39df4e75f9b777.jpg', '', '', 0, 0, 0, 0, '1552803546', '2019-03-17 06:19:06', '2341203546', 7, 1),
(17, 'RTL (Right To Left) Mode', '<p>1. Open Android Studio → app → java → YourPackageName → Config.java</p>\r\n<p>2. Change the value of \"ENABLE_RTL_MODE\" from <strong>false</strong> to <strong>true</strong></p>\r\n<p>2. Change the value of \"Direction\" from <strong>ltr</strong> to <strong>rtl</strong><br> <img title=\"RTL Mode\" src=\"http://www.inw24.com/user_manual/multi_content_app/images/rtl.jpg\" width=\"100%\"></p>', 'p1', 'p2', 1, 10, 5, 1, 13, 5, 'content.png', '', '', 1, 0, 0, 0, '1552803678', '2019-03-17 06:21:18', '2341203678', 8, 1),
(18, 'Generated Signed APK', '<p>To sign your app in release mode in Android Studio, follow these steps:</p>\r\n<p>1. On the menu bar, click Build → Generate Signed APK.</p>\r\n<p>If you already have a keystore, go to step 4.</p>\r\n<p>2. On the Generate Signed APK Wizard window, click Create new to create a new keystore.</p>\r\n<p>3. On the New Key Store window, provide the required information, your key should be valid for at least 25 years, so you can sign app updates with the same key through the lifespan of your app.</p>\r\n<p>4. On the Generate Signed APK Wizard window, select a keystore, a private key, and enter the passwords for both. Then click Next</p>\r\n<p>5. On the next window, select a destination for the signed APK and Signature Versions.</p>\r\n<p>6. Select Signature Version : V1 (Jar Signature)</p>\r\n<p>7. click Finish and the signed apk will generated.</p>', 'p1', 'p2', 1, 10, 5, 1, 13, 5, '30aa0f73725c7abb5929cd944f0be1cf.jpg', '', '', 1, 0, 0, 0, '1552803794', '2019-03-17 06:23:14', '2341203794', 9, 1),
(19, 'FCM Push Notification', '<p>1. Open <a title=\"Google FCM\" href=\"https://firebase.google.com\" target=\"_blank\">https://firebase.google.com</a> and login to your GMail account.</p>\r\n<p>2. Follow the above video.</p>', 'p1', 'p2', 1, 10, 1, 1, 13, 5, '712375cd0afb9cbb463792175201f667.jpg', 'http://www.inw24.com/user_manual/multi_content_app/videos/05_GoogleFCM-min.mp4', '05:45', 8, 0, 0, 0, '1552803941', '2019-03-17 06:25:41', '2341203941', 10, 1),
(20, 'Login To cPanel', '<p>Login to your cPanel: www.YourDomain.com:2082 or 2083</p>\r\n<p><img src=\"http://www.inw24.com/user_manual/multi_content_app/images/01.jpg\" alt=\"cPanel Login\" width=\"100%\" height=\"auto\"></p>', 'p1', 'p2', 1, 10, 5, 1, 12, 5, '7093b27bd5fd8f5f64b682550cca0422.jpg', '', '', 2, 0, 0, 0, '1552813906', '2019-03-17 09:11:46', '2341213906', 2, 1),
(21, 'Horse Racing', '<p>This is a <strong>HTML5 Game</strong> for demo. This game load from: www.codethislab.com</p>', 'p1', 'p2', 3, 10, 4, 1, 3, 5, '8e6dcac317f650576ab47c7656ad3d14.jpg', 'http://showcase.codethislab.com/games/horse_racing/', '', 2, 0, 1, 0, '1552827750', '2019-03-17 13:02:30', '2341227750', 1, 1),
(22, 'Goal Keeper', '<p>This is a <strong>HTML5 Game</strong> for demo. This game load from: www.codethislab.com</p>', 'p1', 'p2', 3, 10, 4, 1, 3, 5, '8978c61f283e599e2f48307be9e6e4c3.png', 'http://showcase.codethislab.com/games/goalkeeper_challenge/', '', 2, 0, 1, 0, '1552827854', '2019-03-17 13:04:14', '2341227854', 1, 1),
(23, 'Galactic Maze', '<p>This is a <strong>HTML5 Game</strong> for demo. This game load from: www.codethislab.com</p>', 'p1', 'p2', 3, 10, 4, 1, 3, 5, 'b49a6e893fe74e1c0dbab10e7cb83b87.png', 'http://showcase.codethislab.com/games/galactic_maze/', '', 0, 0, 0, 0, '1552828051', '2019-03-17 13:07:31', '2341228051', 1, 1),
(24, 'Cricket Fielder Challenge', '<p>This is a <strong>HTML5 Game</strong> for demo. This game load from: www.codethislab.com</p>', 'p1', 'p2', 3, 10, 4, 1, 3, 5, '56a12c783993aa592c0c2d53cb7dbe7f.jpg', 'http://showcase.codethislab.com/games/cricket_fielder_challenge/', '', 0, 0, 0, 0, '1552828507', '2019-03-17 13:15:07', '2341228507', 1, 1),
(25, 'Fast and Furious', '<p>Fast and Furious Presents: Hobbs and Shaw Trailer</p>', 'p1', 'p2', 1, 10, 1, 1, 1, 5, '9dd631f9c8b00138a0ea691ebe46374f.jpg', 'http://content.inw24.com/shaw.mp4', '03:06', 8, 0, 1, 0, '1552829097', '2019-03-17 13:24:57', '2341229097', 1, 1),
(26, 'Android Studio 3.3.2', '<div class=\"dac-landing-row-hero-description\">\r\n<p>Android Studio provides the fastest tools for building apps on every type of Android device.</p>\r\n</div>', 'p1', 'p2', 1, 10, 7, 1, 5, 5, 'cbc37a85c187f5d142387c2a1a77e0fe.jpg', 'https://developer.android.com/studio', '', 5, 0, 0, 0, '1552829900', '2019-03-17 13:38:20', '2341229900', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `content_type_table`
--

CREATE TABLE `content_type_table` (
  `content_type_id` int(11) NOT NULL,
  `content_type_title` varchar(40) NOT NULL,
  `content_type_description` varchar(60) NOT NULL,
  `content_type_status` tinyint(1) NOT NULL COMMENT '0: Inactive | 1: Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Content Type Table';

--
-- Dumping data for table `content_type_table`
--

INSERT INTO `content_type_table` (`content_type_id`, `content_type_title`, `content_type_description`, `content_type_status`) VALUES
(1, 'Video', 'mp4 video type', 1),
(2, 'Music', 'mp3 music type', 1),
(3, 'Images', 'image', 0),
(4, 'Game', 'Direct url for HTML5 or Flash games', 1),
(5, 'Text', 'News, Article and...', 1),
(6, 'Ads', 'Ads', 0),
(7, 'Download', 'download a file', 1),
(8, 'Hyperlink', 'website, social group or page', 1);

-- --------------------------------------------------------

--
-- Table structure for table `currency_table`
--

CREATE TABLE `currency_table` (
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(5) NOT NULL COMMENT 'eg. IRR, USD, GBP, etc...',
  `currency_prefix` varchar(15) NOT NULL,
  `currency_suffix` varchar(15) NOT NULL,
  `currency_decimals` tinyint(1) NOT NULL,
  `currency_rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Currency Table';

--
-- Dumping data for table `currency_table`
--

INSERT INTO `currency_table` (`currency_id`, `currency_code`, `currency_prefix`, `currency_suffix`, `currency_decimals`, `currency_rate`) VALUES
(1, 'USD', '', '$', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_setting_table`
--

CREATE TABLE `email_setting_table` (
  `email_setting_id` tinyint(4) NOT NULL,
  `email_setting_mailtype` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `email_setting_smtpport` smallint(6) NOT NULL,
  `email_setting_smtphost` varchar(60) COLLATE utf8_persian_ci NOT NULL,
  `email_setting_smtpuser` varchar(60) COLLATE utf8_persian_ci NOT NULL,
  `email_setting_smtppass` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `email_setting_crypto` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `email_setting_fromname` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `email_setting_fromemail` varchar(60) COLLATE utf8_persian_ci NOT NULL,
  `email_setting_cc` varchar(60) COLLATE utf8_persian_ci NOT NULL,
  `email_setting_signature` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `email_setting_status` tinyint(1) NOT NULL COMMENT '0: Disable | 1: Enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='Email Setting Table';

--
-- Dumping data for table `email_setting_table`
--

INSERT INTO `email_setting_table` (`email_setting_id`, `email_setting_mailtype`, `email_setting_smtpport`, `email_setting_smtphost`, `email_setting_smtpuser`, `email_setting_smtppass`, `email_setting_crypto`, `email_setting_fromname`, `email_setting_fromemail`, `email_setting_cc`, `email_setting_signature`, `email_setting_status`) VALUES
(1, 'mail', 0, '', '', 'TMY~esy5dpSPjecYqR33~iOL0tSirB8aDgFonLuvK7nfNI8cfQidFYU4j7Y~aU4Wi9j2trPrxbCVbgkNcjdcvA--', 'none', 'inw24', 'inw24.com@gmail.com', '', 'Best Regards,<br>\r\nwww.inw24.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page_table`
--

CREATE TABLE `page_table` (
  `page_id` int(11) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `page_slug` varchar(100) NOT NULL,
  `page_type` tinyint(2) NOT NULL COMMENT '1:News | 2: Annunciation | 3: Page | 4: Version',
  `page_content` mediumtext NOT NULL,
  `page_image` varchar(60) NOT NULL,
  `page_keyword` varchar(100) NOT NULL,
  `page_publish_time` varchar(15) NOT NULL,
  `page_status` tinyint(4) NOT NULL COMMENT '0:Inactive | 1: Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Page Table';

--
-- Dumping data for table `page_table`
--

INSERT INTO `page_table` (`page_id`, `page_title`, `page_slug`, `page_type`, `page_content`, `page_image`, `page_keyword`, `page_publish_time`, `page_status`) VALUES
(1, 'Terms of Service', 'terms-of-service', 3, '<p>You can edit this page from admin dashboard. All <strong>HTML5</strong> tag supported here.</p>\r\n<p>Lorem the It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.</p>', '', '', '1543481842', 1),
(2, 'Contact Us', 'contact-us', 3, '<p>You can edit this page from admin dashboard. All <strong>HTML5</strong> tag supported here.</p>\r\n<p>Lorem the It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.</p>', '', '', '1543481882', 1),
(3, 'About Us', 'about-us', 3, '<p>You can edit this page from admin dashboard. All <strong>HTML5</strong> tags supported here.</p>\r\n<p>Lorem the It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.</p>', '', '', '1543481894', 1),
(4, 'FAQ', 'faq', 3, '<p>You can edit this page from admin dashboard. All <strong>HTML5</strong> tags supported here.</p>\r\n<p>Lorem the It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.</p>', '', '', '1543481904', 1),
(5, 'How To Use', 'how-to-use', 3, '<p>You can edit this page from admin dashboard. All <strong>HTML5</strong> tags supported here.</p>\r\n<p>Lorem the It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.</p>', '', '', '1543731556', 1),
(6, 'Version 1.0.0', 'version-100', 4, '<p><code class=\"html plain\">Version 1.0.0 - March 17th, 2019</code></p>\r\n<p><code class=\"html plain\">- Initial release.</code></p>', '', '', '1543731622', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting_table`
--

CREATE TABLE `setting_table` (
  `setting_id` int(11) NOT NULL,
  `setting_app_name` varchar(50) NOT NULL,
  `setting_app_desc` varchar(100) NOT NULL,
  `setting_website` varchar(50) NOT NULL,
  `setting_email` varchar(50) NOT NULL,
  `setting_phone1` varchar(15) NOT NULL,
  `setting_phone2` varchar(15) NOT NULL,
  `setting_phone3` varchar(15) NOT NULL,
  `setting_sms_no` varchar(20) NOT NULL,
  `setting_address` varchar(100) NOT NULL,
  `setting_logo` varchar(50) NOT NULL,
  `setting_favicon` varchar(50) NOT NULL,
  `setting_version_code` smallint(6) NOT NULL,
  `setting_version_string` varchar(25) NOT NULL,
  `setting_skype` varchar(60) NOT NULL,
  `setting_telegram` varchar(60) NOT NULL,
  `setting_whatsapp` varchar(60) NOT NULL,
  `setting_instagram` varchar(60) NOT NULL,
  `setting_facebook` varchar(60) NOT NULL,
  `setting_twiiter` varchar(60) NOT NULL,
  `setting_custom1` varchar(60) NOT NULL,
  `setting_custom2` varchar(60) NOT NULL,
   `setting_one_signal_app_id` varchar(255) NOT NULL,
  `setting_one_signal_rest_api_key` varchar(255) NOT NULL,
  `setting_text_maintenance` varchar(255) NOT NULL,
  `setting_site_maintenance` tinyint(1) NOT NULL COMMENT '0: No | 1: Yes',
  `setting_android_maintenance` tinyint(1) NOT NULL COMMENT '0: No | 1: Yes',
  `setting_ios_maintenance` tinyint(1) NOT NULL COMMENT '0: No | 1: Yes',
  `setting_other_maintenance` tinyint(1) NOT NULL COMMENT '0: No | 1: Yes',
  `setting_disable_registration` tinyint(1) NOT NULL COMMENT '0: No | 1: Yes',
  `setting_checking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Setting Table';

--
-- Dumping data for table `setting_table`
--

INSERT INTO `setting_table` (`setting_id`, `setting_app_name`, `setting_app_desc`, `setting_website`, `setting_email`, `setting_phone1`, `setting_phone2`, `setting_phone3`, `setting_sms_no`, `setting_address`, `setting_logo`, `setting_favicon`, `setting_version_code`, `setting_version_string`, `setting_skype`, `setting_telegram`, `setting_whatsapp`, `setting_instagram`, `setting_facebook`, `setting_twiiter`, `setting_custom1`, `setting_custom2`, `setting_one_signal_app_id`, `setting_one_signal_rest_api_key`, `setting_text_maintenance`, `setting_site_maintenance`, `setting_android_maintenance`, `setting_ios_maintenance`, `setting_other_maintenance`, `setting_disable_registration`, `setting_checking`) VALUES
(1, 'Multi Content APP', 'Multi Content APP', 'http://www.inw24.com', 'inw24.com@gmail.com', '', '', '', '', '', '', '', 7, '2.6.0', '1', '2', '3', '4', '5', '6', '7', '8', 'xxx', 'xxx', 'We are under maintenance mode. Please try again later.', 1, 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider_table`
--

CREATE TABLE `slider_table` (
  `slider_id` int(11) NOT NULL,
  `slider_category_id` smallint(6) NOT NULL,
  `slider_title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `slider_description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `slider_url` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slider_image` varchar(120) CHARACTER SET utf8 NOT NULL,
  `slider_content_id` int(11) DEFAULT 0,
  `slider_status` tinyint(1) NOT NULL COMMENT '0: Inactive | 1: Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='Slider Table';

--
-- Dumping data for table `slider_table`
--

INSERT INTO `slider_table` (`slider_id`, `slider_category_id`, `slider_title`, `slider_description`, `slider_url`, `slider_image`, `slider_content_id`, `slider_status`) VALUES
(1, 0, 'Slider 1', 'Slider 1', 'http://www.inw24.com', '2abc9661e7004b3dba4963bf3c9d9bf2.jpg', 1, 1),
(2, 0, 'Slider 2', 'Slider 2', 'http://www.inw24.com', '1e7bdc61858a6a16a46cf6bc25146420.jpg', 2, 1),
(3, 0, 'Slider 3', 'Slider 3', 'http://www.inw24.com', '944698e1de5bd924135fcde5f28d728c.png', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role_table`
--

CREATE TABLE `user_role_table` (
  `user_role_id` smallint(6) NOT NULL,
  `user_type_id` smallint(6) NOT NULL,
  `user_role_title` varchar(30) NOT NULL,
  `user_role_price` float NOT NULL,
  `user_role_permission` text NOT NULL COMMENT 'Seprrate laste segment with |',
  `user_role_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: Active | 2: Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Role Table';

--
-- Dumping data for table `user_role_table`
--

INSERT INTO `user_role_table` (`user_role_id`, `user_type_id`, `user_role_title`, `user_role_price`, `user_role_permission`, `user_role_status`) VALUES
(1, 1, 'Super Admin', 0, 'No need to set permission for Super Admin.', 1),
(2, 1, 'Admin', 0, 'index users_list show_user add_user delete_user users_role delete_role general_settings email_settings sliders delete_slider edit_slider pages add_page delete_page edit_page users_activity categories edit_category delete_category tickets_list submit_ticket show_ticket close_ticket departments edit_department delete_department bank_gateways content_list add_content edit_content delete_content', 1),
(3, 1, 'Employee', 0, 'index users_list show_user add_user delete_user users_role delete_role general_settings email_settings sliders delete_slider edit_slider pages add_page delete_page edit_page users_activity categories edit_category delete_category tickets_list submit_ticket show_ticket close_ticket departments edit_department delete_department bank_gateways content_list add_content edit_content delete_content', 1),
(4, 1, 'Admin Demo', 0, 'index users_list show_user add_user users_role general_settings email_settings sliders edit_slider pages add_page edit_page users_activity categories edit_category tickets_list submit_ticket show_ticket close_ticket departments edit_department content_list add_content edit_content api_key', 1),
(5, 2, 'Regular User', 0, 'index submit_ticket tickets_list show_ticket close_ticket transactions show_transaction zarinpal_payment_verify mellat_payment_verify', 1),
(6, 2, 'VIP User', 0, 'index submit_ticket tickets_list show_ticket close_ticket transactions show_transaction zarinpal_payment_verify mellat_payment_verify', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_image` varchar(80) NOT NULL DEFAULT 'avatar.png',
  `user_credit` float NOT NULL,
  `user_coin` int(11) NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1: Staff | 2: User | 3: Guest',
  `user_role_id` smallint(6) NOT NULL DEFAULT 5,
  `user_duration` int(11) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mobile` varchar(15) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Deactive | 1: Active',
  `user_reg_date` varchar(12) NOT NULL,
  `user_last_login` varchar(12) NOT NULL,
  `user_reg_from` tinyint(1) NOT NULL COMMENT '1: Admin | 2: Website | 3: Android | 4: iOS | 5: Other',
  `user_note` text NOT NULL,
  `user_referral` int(11) NOT NULL,
  `user_mobile_verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: No| 1: Yes',
  `user_email_verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: No| 1: Yes',
  `user_document_verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: No| 1: Yes',
  `user_online` tinyint(1) NOT NULL COMMENT '0: Offline | 1: Online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Table';

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_username`, `user_firstname`, `user_lastname`, `user_image`, `user_credit`, `user_coin`, `user_type`, `user_role_id`, `user_duration`, `user_email`, `user_password`, `user_mobile`, `user_phone`, `user_status`, `user_reg_date`, `user_last_login`, `user_reg_from`, `user_note`, `user_referral`, `user_mobile_verified`, `user_email_verified`, `user_document_verified`, `user_online`) VALUES
(1, 'admin', 'Demo', 'Admin', '0fa051c093081291d7d660ba23018a57.png', 0, 0, 1, 1, 0, 'inw24.com@gmail.com', 'd21933a6ee50e4dcaa8424f85582c3f51abf6379', '920', '', 0, '1542740963', '', 0, '', 0, 0, 0, 0, 0),
(2, 'demoadmin', 'Demo', 'Admin', 'avatar.png', 0, 0, 1, 4, 0, 'demoadmin@gmail.com', 'd21933a6ee50e4dcaa8424f85582c3f51abf6379', '919', '', 0, '1552569558', '', 0, '', 1, 0, 0, 0, 0),
(3, 'demouser', 'Demo', 'User', 'avatar.png', 0, 0, 2, 5, 0, 'demouser@gmail.com', 'd21933a6ee50e4dcaa8424f85582c3f51abf6379', '918', '', 0, '1552569577', '', 0, '', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type_table`
--

CREATE TABLE `user_type_table` (
  `user_type_id` smallint(6) NOT NULL COMMENT '1: Staff | 2: User | 3: Guest',
  `user_type_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Type Table';

--
-- Dumping data for table `user_type_table`
--

INSERT INTO `user_type_table` (`user_type_id`, `user_type_title`) VALUES
(1, 'Staff'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_table`
--
ALTER TABLE `activity_table`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `api_table`
--
ALTER TABLE `api_table`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `bookmark_table`
--
ALTER TABLE `bookmark_table`
  ADD PRIMARY KEY (`bookmark_id`);

--
-- Indexes for table `captcha_table`
--
ALTER TABLE `captcha_table`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `captcha_word` (`captcha_word`);

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `content_table`
--
ALTER TABLE `content_table`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `content_type_table`
--
ALTER TABLE `content_type_table`
  ADD PRIMARY KEY (`content_type_id`);

--
-- Indexes for table `currency_table`
--
ALTER TABLE `currency_table`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `email_setting_table`
--
ALTER TABLE `email_setting_table`
  ADD PRIMARY KEY (`email_setting_id`);

--
-- Indexes for table `page_table`
--
ALTER TABLE `page_table`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `setting_table`
--
ALTER TABLE `setting_table`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `slider_table`
--
ALTER TABLE `slider_table`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `user_role_table`
--
ALTER TABLE `user_role_table`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type_table`
--
ALTER TABLE `user_type_table`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_table`
--
ALTER TABLE `activity_table`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `api_table`
--
ALTER TABLE `api_table`
  MODIFY `api_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookmark_table`
--
ALTER TABLE `bookmark_table`
  MODIFY `bookmark_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `captcha_table`
--
ALTER TABLE `captcha_table`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `content_table`
--
ALTER TABLE `content_table`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `content_type_table`
--
ALTER TABLE `content_type_table`
  MODIFY `content_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `currency_table`
--
ALTER TABLE `currency_table`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_setting_table`
--
ALTER TABLE `email_setting_table`
  MODIFY `email_setting_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_table`
--
ALTER TABLE `page_table`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting_table`
--
ALTER TABLE `setting_table`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider_table`
--
ALTER TABLE `slider_table`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role_table`
--
ALTER TABLE `user_role_table`
  MODIFY `user_role_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_type_table`
--
ALTER TABLE `user_type_table`
  MODIFY `user_type_id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '1: Staff | 2: User | 3: Guest', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
