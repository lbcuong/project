-- Adminer 4.8.1 MySQL 5.7.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reorder_guideline_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_goods_reorder_guidelines_id` (`reorder_guideline_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `goods` (`id`, `reorder_guideline_id`, `created_at`, `updated_at`) VALUES
(1,	5,	'2022-05-09 06:59:48',	'2022-06-08 06:18:40'),
(2,	4,	'2022-05-09 07:14:12',	'2022-06-08 03:35:52'),
(3,	NULL,	'2022-05-09 07:19:16',	'2022-05-09 07:19:16');

DROP TABLE IF EXISTS `measuring_units`;
CREATE TABLE `measuring_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `measuring_units` (`id`, `code`, `name`, `comment`, `created_at`, `updated_at`) VALUES
(9,	'VT00009',	'MARIAH',	NULL,	'2022-06-08 04:19:29',	'2022-06-08 04:19:29'),
(10,	'VT00010',	'Toan Dao',	'aaaaxccc',	'2022-06-08 06:18:56',	'2022-06-08 06:19:01');

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_other` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cluster` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `warranty` date DEFAULT NULL,
  `product_group_id` int(11) DEFAULT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `measuring_unit_id` int(11) DEFAULT NULL,
  `measuring_unit_conversion_id` int(11) DEFAULT NULL,
  `producer_id` int(11) DEFAULT NULL,
  `container_id` int(11) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `limit` varchar(255) DEFAULT NULL,
  `storage_time` date DEFAULT NULL,
  `productable_type` varchar(255) DEFAULT NULL,
  `productable_id` int(11) DEFAULT NULL,
  `introduction_date` date DEFAULT NULL,
  `sales_discontinuation_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_products_measuring_units_id` (`name`),
  KEY `FK_products_product_categories_id` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `products` (`id`, `code`, `name`, `name_other`, `description`, `cluster`, `color`, `size`, `warranty`, `product_group_id`, `product_category_id`, `measuring_unit_id`, `measuring_unit_conversion_id`, `producer_id`, `container_id`, `barcode`, `image`, `comment`, `limit`, `storage_time`, `productable_type`, `productable_id`, `introduction_date`, `sales_discontinuation_date`, `created_at`, `updated_at`) VALUES
(1,	'Dmvt00001',	'Khóa nước Ø21',	'Khóa',	'nước',	NULL,	NULL,	'Ø21',	'2022-05-09',	1,	1,	1,	NULL,	2,	NULL,	NULL,	'app-assets/images/inventory/Turkish_Van_Cat.jpeg',	NULL,	NULL,	'2022-05-09',	'App\\Models\\Goods',	1,	NULL,	NULL,	'2022-05-09 06:59:48',	'2022-05-09 07:49:34'),
(2,	'Dmvt00002',	'Sơn trắng TOA',	'Sơn',	NULL,	NULL,	'Trắng',	NULL,	'2022-05-11',	1,	3,	2,	NULL,	7,	NULL,	'0111234',	NULL,	NULL,	NULL,	'2022-05-09',	'App\\Models\\Goods',	2,	NULL,	NULL,	'2022-05-09 07:14:12',	'2022-05-09 07:14:12'),
(3,	'Dmvt00003',	'Sơn BENDE',	'Sơn',	NULL,	NULL,	NULL,	NULL,	'2022-05-10',	1,	3,	2,	NULL,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-05-18',	'App\\Models\\Goods',	3,	NULL,	NULL,	'2022-05-09 07:19:16',	'2022-05-09 07:19:16'),
(4,	'Dmvt00003',	'Sơn BENDE',	'Sơn',	NULL,	NULL,	NULL,	NULL,	'2022-05-10',	1,	3,	2,	NULL,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-05-18',	'App\\Models\\Goods',	4,	NULL,	NULL,	'2022-05-09 07:19:16',	'2022-05-09 07:19:16');

DROP TABLE IF EXISTS `reorder_guidelines`;
CREATE TABLE `reorder_guidelines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `reorder_quantity` int(11) DEFAULT NULL,
  `reorder_level` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `approve_comment` varchar(255) DEFAULT NULL,
  `is_approve` smallint(6) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `reorder_guidelines` (`id`, `code`, `reorder_quantity`, `reorder_level`, `comment`, `approve_comment`, `is_approve`, `created_at`, `updated_at`) VALUES
(4,	'Pycvt00004',	NULL,	NULL,	'Abc cvvv',	NULL,	0,	'2022-06-08 03:35:52',	'2022-06-08 06:18:27'),
(5,	'Pycvt00005',	NULL,	NULL,	'Abc',	NULL,	0,	'2022-06-08 06:18:40',	'2022-06-08 06:18:40');

DROP TABLE IF EXISTS `reorder_items`;
CREATE TABLE `reorder_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reorder_quantity` int(11) DEFAULT NULL,
  `reorder_guideline_id` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reorderable_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reorderable_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `reorder_items` (`id`, `reorder_quantity`, `reorder_guideline_id`, `goods_id`, `comment`, `reorderable_type`, `reorderable_id`, `created_at`, `updated_at`) VALUES
(1,	22,	NULL,	1,	NULL,	'App\\Models\\GoodsReceipt',	1,	'2022-05-10 09:50:31',	'2022-05-10 09:50:31'),
(2,	11,	NULL,	3,	NULL,	'App\\Models\\GoodsReceipt',	1,	'2022-05-10 09:50:31',	'2022-05-10 09:50:31'),
(3,	10,	NULL,	1,	NULL,	'App\\Models\\GoodsIssue',	1,	'2022-05-10 09:51:54',	'2022-05-10 09:51:54'),
(4,	201100,	NULL,	2,	'abcde',	'App\\Models\\GoodsIssue',	2,	'2022-05-11 04:17:35',	'2022-05-25 01:40:50'),
(5,	101131,	NULL,	1,	'abcd',	'App\\Models\\GoodsIssue',	2,	'2022-05-11 06:48:16',	'2022-05-25 01:40:40'),
(6,	50,	NULL,	1,	NULL,	'App\\Models\\GoodsIssue',	4,	'2022-05-11 06:49:47',	'2022-05-25 01:41:49'),
(7,	50,	NULL,	1,	'20',	'App\\Models\\GoodsIssue',	5,	'2022-05-11 08:39:42',	'2022-05-11 08:39:42'),
(8,	40,	3,	2,	'3000',	'App\\Models\\ReorderGuideline',	3,	'2022-05-13 02:49:02',	'2022-05-13 02:49:02'),
(9,	10,	4,	2,	'10',	'App\\Models\\ReorderGuideline',	4,	'2022-06-08 03:35:52',	'2022-06-08 03:35:52'),
(10,	10,	NULL,	1,	'10xxx',	'App\\Models\\ReorderGuideline',	4,	'2022-06-08 06:18:18',	'2022-06-08 06:18:23'),
(11,	10,	5,	1,	'10',	'App\\Models\\ReorderGuideline',	5,	'2022-06-08 06:18:40',	'2022-06-08 06:18:40');

-- 2022-06-08 06:59:28
