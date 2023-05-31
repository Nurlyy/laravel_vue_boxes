-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 04 2023 г., 10:44
-- Версия сервера: 8.0.32-0ubuntu0.22.04.2
-- Версия PHP: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `coreui_laravel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contact`
--

INSERT INTO `contact` (`id`, `phone_number`, `email`, `address`) VALUES
(0, '+7 812 209-70-45', 'public@propako.ru', 'Россия Санкт-Петербург Петровская коса д 1 кор 1 БЦ Петровский');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `filter`
--

CREATE TABLE `filter` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `filter`
--

INSERT INTO `filter` (`id`, `name`) VALUES
(22, 'Коробка крышка-дно'),
(23, 'Коробка с магнитами'),
(24, 'Коробка с лентами'),
(25, 'Коробка с ручками'),
(26, 'Черная коробка'),
(27, 'Коробка пенал (слайдер)'),
(28, 'Коробка складная'),
(29, 'Коробка двухцветная'),
(30, 'Коробка для обуви'),
(31, 'Коробка для постельного белья'),
(32, 'Коробка для шелковых изделий'),
(33, 'Коробка для ремней, кошельков'),
(34, 'Коробка для одежды'),
(35, 'Бумажный пакет');

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `path`, `description`) VALUES
(83, '/uploads/1682893450.jpg', 'null'),
(84, '/uploads/1682893470.jpg', 'null'),
(85, '/uploads/1682893476.jpg', 'null'),
(86, '/uploads/1682893483.jpg', 'null'),
(87, '/uploads/1682893489.jpg', 'null'),
(88, '/uploads/1682893496.jpg', 'null'),
(89, '/uploads/1682893506.jpg', 'null'),
(90, '/uploads/1682893512.jpg', 'null'),
(91, '/uploads/1682893518.jpg', 'null'),
(92, '/uploads/1682893524.jpg', 'null'),
(93, '/uploads/1682893530.jpg', 'null'),
(94, '/uploads/1682893536.jpg', 'null'),
(95, '/uploads/1682893544.jpg', 'null'),
(96, '/uploads/1682893550.jpg', 'null'),
(97, '/uploads/1682893556.jpg', 'null'),
(98, '/uploads/1682893563.jpg', 'null'),
(99, '/uploads/1682893570.jpg', 'null'),
(100, '/uploads/1682893578.jpg', 'null'),
(101, '/uploads/1682893589.jpg', 'null'),
(102, '/uploads/1682893594.jpg', 'null'),
(103, '/uploads/1682893600.jpg', 'null'),
(104, '/uploads/1682893605.jpg', 'null'),
(105, '/uploads/1682893610.jpg', 'null'),
(106, '/uploads/1682893650.jpg', 'null'),
(107, '/uploads/1682893656.jpg', 'null'),
(108, '/uploads/1682893662.jpg', 'null'),
(109, '/uploads/1682893678.jpg', 'null'),
(110, '/uploads/1682893686.jpg', 'null'),
(111, '/uploads/1682893696.jpg', 'null'),
(112, '/uploads/1682893705.jpg', 'null'),
(113, '/uploads/1682893713.jpg', 'null'),
(114, '/uploads/1682893719.jpg', 'null');

-- --------------------------------------------------------

--
-- Структура таблицы `images_filter`
--

CREATE TABLE `images_filter` (
  `id` int NOT NULL,
  `image_id` int NOT NULL,
  `filter_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `images_filter`
--

INSERT INTO `images_filter` (`id`, `image_id`, `filter_id`) VALUES
(171, 83, 22),
(172, 84, 22),
(173, 85, 22),
(174, 86, 22),
(175, 87, 22),
(176, 88, 22),
(177, 89, 24),
(178, 90, 24),
(179, 91, 24),
(180, 92, 24),
(181, 93, 24),
(182, 94, 24),
(183, 95, 23),
(184, 96, 23),
(185, 97, 23),
(186, 98, 23),
(187, 99, 23),
(188, 100, 23),
(189, 101, 30),
(190, 102, 30),
(191, 103, 30),
(192, 104, 30),
(193, 105, 30),
(194, 106, 35),
(195, 107, 35),
(196, 108, 35),
(197, 109, 35),
(198, 110, 35),
(199, 111, 35),
(200, 112, 35),
(201, 113, 35),
(202, 114, 35);

-- --------------------------------------------------------

--
-- Структура таблицы `main_page`
--

CREATE TABLE `main_page` (
  `id` int NOT NULL,
  `header` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `main_page`
--

INSERT INTO `main_page` (`id`, `header`, `title`, `body`) VALUES
(0, 'Propako - Производство упаковки по всей России', 'Эмоции начинаются с упаковки', 'Уникальная фирменная упаковка на заказ: производство коробок из переплётного и плотного картона по индивидуальным размерам. Наша компания предоставляет услуги по изготовлению коробок на заказ, которые могут быть украшены вашим логотипом. Мы гарантируем высокое качество продукции и быстрое выполнение заказов. Красивая упаковка поможет привлечь внимание к вашему бренду и создать положительный имидж. Обратитесь к нам, чтобы сделать вашу продукцию более привлекательной и уникальной!');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(6, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(8, '2016_06_01_000004_create_oauth_clients_table', 2),
(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0638bdd1606b8e765e09d8edaa6a8b24345874d1015188c045c3e8b7cbf6aa709dbda015f121533a', 1, 1, 'authToken', '[]', 1, '2023-04-26 06:06:53', '2023-04-26 10:22:40', '2024-04-26 12:06:53'),
('154389d5e0092f899470b710045e20c0c7821964e76e6197937827fd5c89c80936f6147442cb6eee', 1, 1, 'authToken', '[]', 1, '2023-04-26 05:56:23', '2023-04-26 06:06:52', '2024-04-26 11:56:23'),
('1ba4b7e28e225a38ac4447cca9407a262d7d1ff7cf4a9e2590d0d441015f0517fbb91d8689f82027', 1, 3, 'authToken', '[]', 0, '2023-04-30 19:19:44', '2023-04-30 19:19:44', '2024-04-30 22:19:44'),
('265e2420bf3ce3d7c6147a91d09d80f418f6a9fa54e1694c54aef977ed04ef13aeaa9af73f9a420f', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:04:28', '2023-04-26 02:04:28', '2024-04-26 08:04:28'),
('2e43ea498da700130f9a36ccecf15c3fa20388f7857b0aedca9d7a17348f222d8f8c229de315b87d', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:12:48', '2023-04-26 02:12:48', '2024-04-26 08:12:48'),
('30a7296c4e185ae400682d4ec975d26d924f4416a2cb4b252a02ed4336617e5d74b78b611160927c', 1, 3, 'authToken', '[]', 0, '2023-04-30 18:53:10', '2023-04-30 18:53:10', '2024-04-30 21:53:10'),
('3be1a1b32f39f95393fcc72d766118e2222ac76ffeb44fa564c5600f4794c2a60fbd0eb6e961acd2', 1, 1, 'authToken', '[]', 0, '2023-04-25 23:56:52', '2023-04-25 23:56:52', '2024-04-26 05:56:52'),
('3dd1894e5ec499c7c4ae31bb8db2b2e2556bb4c780f910460af1c7353b7079c89992591f5cbf569a', 1, 1, 'authToken', '[]', 1, '2023-04-26 02:27:49', '2023-04-26 02:27:51', '2024-04-26 08:27:49'),
('3e8a7750c621b1343bf1cc55fdf5ac52462f56193c3f34b3710155f4e49a8c7f93863cc0f1e132c5', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:12:44', '2023-04-26 02:12:44', '2024-04-26 08:12:44'),
('4170c8a202c345d54a981f291d69a40d5b4c71b42eac0e09fef28766413454c23fa0820bae986f1b', 1, 1, 'authToken', '[]', 0, '2023-04-26 00:05:57', '2023-04-26 00:05:57', '2024-04-26 06:05:57'),
('4208b58f316081f5ba3db92d2b7e0f670471cf2664607e4bb1c253dd8a8f30b1be9e3449a8557004', 1, 3, 'authToken', '[]', 0, '2023-04-30 18:37:15', '2023-04-30 18:37:15', '2024-04-30 21:37:15'),
('5767f2c00cb4cf6dcbae045ff9b1b6048e44c7ebce64b0320bf2943ca0ffe039f472864b5ad20dfd', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:20:17', '2023-04-26 02:20:17', '2024-04-26 08:20:17'),
('613f4d53a5ace53878e2a329c3d1b45148fb8e10122a5be8849b8a38dfaa94d204c791219765f4c1', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:24:24', '2023-04-26 02:24:24', '2024-04-26 08:24:24'),
('66c92fefeefefd3c9b8150aa800424210bff584f5fa7b85cf1c9ce84da6ab7618d817b2ed61950d5', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:01:45', '2023-04-26 02:01:45', '2024-04-26 08:01:45'),
('73cdea36ba07244244c84945203104657e28f6da1bcfbd13e26f10c7f7c91f350accf2749f4af97d', 1, 3, 'authToken', '[]', 0, '2023-04-30 19:22:40', '2023-04-30 19:22:40', '2024-04-30 22:22:40'),
('79e1e666d418b8ccd717c6b0e4525b280ff8fd1f4e0626fa49ad202a28113c795c46b87371ca59a1', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:16:10', '2023-04-26 02:16:10', '2024-04-26 08:16:10'),
('7a0f1f6a4b6e87cf8d86531c841eefbaac915e75d7a47bb534cc9cb21b34387d3ac3711498e258ac', 1, 1, 'authToken', '[]', 1, '2023-04-26 02:27:53', '2023-04-26 04:24:07', '2024-04-26 08:27:53'),
('86ff886369ad86b43a0c016ee42f8b390cadee968ee8a22b162feabae4c1b7b64403c76a1fd1d5e0', 1, 3, 'authToken', '[]', 0, '2023-05-01 11:39:15', '2023-05-01 11:39:15', '2024-05-01 14:39:15'),
('89f4ebafe727b376ed06a35d1722a273f9ef3c240a18607fe46f8f331987487346bed471422fa7eb', 1, 1, 'authToken', '[]', 0, '2023-04-25 23:59:44', '2023-04-25 23:59:44', '2024-04-26 05:59:44'),
('8c3d7079ba88a499177886b1a3d1e030afc2ab107e7167fe8864086f0853af54b41f9d10337b3251', 1, 3, 'authToken', '[]', 0, '2023-04-30 11:35:51', '2023-04-30 11:35:51', '2024-04-30 14:35:51'),
('8f4729dfce462de0d4f9f1716daf6e7df3bfe9451efe302d215142e4d8f8bcfe1ca2367b1921964d', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:01:31', '2023-04-26 02:01:31', '2024-04-26 08:01:31'),
('977c08fa5a1bb3dc9d75fa3c76aaeb2859837efe1ac3544650626b03d9ad8f6a2cf727732aae0886', 1, 1, 'authToken', '[]', 1, '2023-04-27 10:24:47', '2023-04-28 06:25:42', '2024-04-27 16:24:47'),
('985781f41c7b67f4d6c3ffcdd4ae3385fdec3a2c4f939bae277b1e6a86016c17aaf2e204230fb4a4', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:08:41', '2023-04-26 02:08:41', '2024-04-26 08:08:41'),
('a3e555c20230586c0f7dc1a01ee9f2b1f27bbd940525e8a4607ae2d83ecff0578fd01f181345b105', 1, 1, 'authToken', '[]', 1, '2023-04-26 02:27:15', '2023-04-26 02:27:23', '2024-04-26 08:27:15'),
('a57e694ee60d0fe82b88f4aefa42f92abf591462a1dc235374b38642741874ff0c0df5da3cdca640', 1, 3, 'authToken', '[]', 1, '2023-04-30 11:35:54', '2023-04-30 15:43:53', '2024-04-30 14:35:54'),
('af0b56be47425626d1ce5db1a80187c52ddba4fdac8febfdb23219db585f21d94a643a688ab48f73', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:08:44', '2023-04-26 02:08:44', '2024-04-26 08:08:44'),
('b0710e671e08c6e88d6ee560b2a5767b083b91c081717a5aadc68fb3373876da8bbf42462f0488df', 1, 1, 'authToken', '[]', 0, '2023-04-28 06:26:17', '2023-04-28 06:26:17', '2024-04-28 12:26:17'),
('c30fee1d6ac13bec905fea28aef5e40efbe795d599efe459932ce68a8746e3f7453256470007a540', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:01:57', '2023-04-26 02:01:57', '2024-04-26 08:01:57'),
('c31e77720f966fc5124d2028ebfaa42f175da5cdcbcb4fd26e65c1df1af3e273c4580074f93994c1', 1, 1, 'authToken', '[]', 1, '2023-04-27 01:13:02', '2023-04-27 10:24:41', '2024-04-27 07:13:02'),
('d0e845a8ecfcb49fbb6e40968bbab7b7501f9d74c97711c96a4c990a9a6e84b5105813a7999a9b8b', 1, 1, 'authToken', '[]', 1, '2023-04-26 04:24:11', '2023-04-26 05:56:20', '2024-04-26 10:24:11'),
('d317f74c7930b3170147a5ec4f7efad44b3dd37342cd6b43b991d7bdf07939bf773f2339dc6d4af0', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:24:11', '2023-04-26 02:24:11', '2024-04-26 08:24:11'),
('d5c12f983457ed4cb604f5b7b69d1c958f51f1f8d501597be3040b7d962397089600854cfb33093c', 1, 1, 'authToken', '[]', 1, '2023-04-26 10:23:50', '2023-04-26 10:23:53', '2024-04-26 16:23:50'),
('db1f8ee3a020e022c7088d403aeb5c9aadb8eb9013172acba0d555a44d5570c3b47b0e0c2b81182d', 1, 3, 'authToken', '[]', 0, '2023-04-30 12:11:05', '2023-04-30 12:11:05', '2024-04-30 15:11:05'),
('e021c2f3d3e46cf451355e2d09cbc62cff3e396ad5a9ed10726ccdd9182193a3bd38b361e328617e', 1, 3, 'authToken', '[]', 0, '2023-04-30 18:40:44', '2023-04-30 18:40:44', '2024-04-30 21:40:44'),
('eb2189e87fb619d15051e5b4f3e94d8338a67b756b1151710a7699f3ecd311a18a8e0182ce02cfaf', 1, 1, 'authToken', '[]', 0, '2023-04-25 23:47:50', '2023-04-25 23:47:50', '2024-04-26 05:47:50'),
('ebf7edc6a7db0efda6ac0641b160c8da190a84399d512f9facf312c0ab1fbda3a0689e00b6c0f87d', 1, 1, 'authToken', '[]', 0, '2023-04-26 02:22:44', '2023-04-26 02:22:44', '2024-04-26 08:22:44');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'UKjF6xaghY2GGt7lBpPt3ZijETvTJEo8MOeX6TeO', NULL, 'http://localhost', 1, 0, 0, '2023-04-25 22:02:54', '2023-04-25 22:02:54'),
(2, NULL, 'Laravel Password Grant Client', 'nNlfiTT1bJmRcPqRJEUVDRdUSfyPR3dO7FTooNpe', 'users', 'http://localhost', 0, 1, 0, '2023-04-25 22:02:54', '2023-04-25 22:02:54'),
(3, NULL, 'Laravel Personal Access Client', 'HvTk8XGYFB2HjXEJ1QYDZMVtj47LhlMNHCzEib7C', NULL, 'http://localhost', 1, 0, 0, '2023-04-30 11:35:47', '2023-04-30 11:35:47'),
(4, NULL, 'Laravel Password Grant Client', '8wfxQhXhOfcGXsojJA2Wobtk07YlBpRn3uHS10Yc', 'users', 'http://localhost', 0, 1, 0, '2023-04-30 11:35:47', '2023-04-30 11:35:47');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-04-25 22:02:54', '2023-04-25 22:02:54'),
(2, 3, '2023-04-30 11:35:47', '2023-04-30 11:35:47');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE `page` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `header_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `keyword` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `show` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `name`, `slug`, `title`, `header_title`, `body`, `keyword`, `description`, `show`) VALUES
(7, 'contacts', 'contacts', 'Контакты', 'PROPAKO - Контакты компании', '<p><br></p><p><strong>Телефон: </strong>+7 812 209-70-45</p><p><strong>E-Mail:</strong> public@propako.ru</p><p><strong>Адрес:</strong> Россия Санкт-Петербург Петровская коса д 1 кор 1 БЦ Петровский</p>', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bearer_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `bearer_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$G81D2w2OGGYBNRmJP7UgeOa9bwiDtYp7qWOIFD0jXAcqwnX1PbCRO', NULL, '!_5Yg4Z+}UhR))H79VJ)%Wa{mLSz)e@7bhAzH#&g:*Rhe&WSpGXern2H#_zbxk4J', '2023-04-25 15:40:11', '2023-04-30 12:03:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `filter`
--
ALTER TABLE `filter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images_filter`
--
ALTER TABLE `images_filter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `fk_filter` (`filter_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `filter`
--
ALTER TABLE `filter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT для таблицы `images_filter`
--
ALTER TABLE `images_filter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `images_filter`
--
ALTER TABLE `images_filter`
  ADD CONSTRAINT `fk_filter` FOREIGN KEY (`filter_id`) REFERENCES `filter` (`id`),
  ADD CONSTRAINT `images_filter_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
