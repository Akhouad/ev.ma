-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 12, 2018 at 01:30 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `evapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_types`
--

CREATE TABLE `access_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendings`
--

CREATE TABLE `attendings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendings`
--

INSERT INTO `attendings` (`id`, `user_id`, `event_id`, `ip_address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 22, '127.0.0.1', NULL, '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(3, 4, 22, '127.0.0.1', NULL, '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(4, 5, 22, '127.0.0.1', NULL, '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(5, 6, 22, '127.0.0.1', NULL, '2018-04-02 12:16:24', '2018-04-02 12:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_to` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `send_count` int(11) NOT NULL,
  `delivered_count` int(11) NOT NULL,
  `organizer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `name`, `subject`, `message`, `send_to`, `status`, `send_count`, `delivered_count`, `organizer_id`, `user_id`, `event_id`, `ip_address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'cam 22', 'title camp19', 'test message camp1', 1, 0, 0, 0, 1, 1, 22, '127.0.0.1', '2018-05-08 09:53:03', '2018-05-02 08:51:48', '2018-05-08 09:53:03'),
(2, 'cam 2', 'title camp1', 'test message camp1', 1, 0, 0, 0, 1, 1, 22, '127.0.0.1', '2018-05-02 09:46:23', '2018-05-02 09:46:07', '2018-05-02 09:46:23'),
(3, 'cam 2', 'title camp1', 'test message camp1', 1, 0, 0, 0, 1, 1, 22, '127.0.0.1', '2018-05-02 09:49:54', '2018-05-02 09:49:46', '2018-05-02 09:49:54'),
(4, 'camp 2222', 'titre camp 2', 'body camp 2', 0, 0, 0, 0, 1, 1, 22, '127.0.0.1', '2018-05-02 11:04:55', '2018-05-02 11:04:45', '2018-05-02 11:04:55'),
(5, 'mwa campagne 2', 'titre mwa12', '', 1, 0, 0, 0, 1, 1, 22, '127.0.0.1', '2018-05-09 14:01:31', '2018-05-02 11:17:28', '2018-05-09 14:01:31'),
(6, 'camp test trumbowyg', 'trumbowyg', '<p><strong><del>Veuillez confirmer votre inscription a notre evenement....</del></strong></p><p><strong><del><a href=\"http://ev.ma\">amine</a></del></strong></p><p><img src=\"https://artisansweb.net/wp-content/themes/llorix-one-lite/logo.png\" alt=\"\"><strong><br></strong></p>', 1, 0, 0, 0, 1, 1, 22, '127.0.0.1', NULL, '2018-05-02 11:50:53', '2018-05-02 12:43:58'),
(7, 'nouvelle campagne', 'campagne objet', 'test campagne', 1, 0, 0, 0, 1, 1, 22, '127.0.0.1', '2018-05-02 12:26:00', '2018-05-02 12:24:16', '2018-05-02 12:26:00'),
(8, 'camp 999', 'titre camp 999', '<p><strong><em>salut tout le monde</em></strong></p>', 0, 0, 0, 0, 1, 1, 22, '127.0.0.1', '2018-05-02 14:18:28', '2018-05-02 14:17:21', '2018-05-02 14:18:28'),
(9, 'camp 990', 'titre 99', '', 0, 0, 0, 0, 1, 1, 22, '127.0.0.1', NULL, '2018-05-02 14:24:11', '2018-05-02 14:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Arts', 'arts', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(3, 'Associatifs', 'associatifs', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(4, 'Cinéma', 'cinema', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(5, 'Culture', 'culture', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(6, 'Divers', 'divers', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(7, 'Divertissement', 'divertissement', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(8, 'Education', 'education', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(9, 'Geek', 'geek', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(10, 'Jeunesse', 'jeunesse', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(11, 'Loisirs', 'loisirs', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(12, 'Musées', 'musees', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(13, 'Musique', 'musique', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(14, 'Professionnels', 'professionnels', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(15, 'Sciences', 'sciences', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(16, 'Sports', 'sports', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(17, 'Startups', 'startups', '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(18, 'Technologies', 'technologies', '2018-04-02 12:16:24', '2018-04-02 12:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `checkins`
--

CREATE TABLE `checkins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkins`
--

INSERT INTO `checkins` (`id`, `user_id`, `event_id`, `ip_address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 22, '127.0.0.1', NULL, '2018-04-02 12:16:24', '2018-04-02 12:16:24'),
(2, 1, 21, '127.0.0.1', NULL, '2018-04-02 12:16:24', '2018-04-02 12:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `prior` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `slug`, `cover`, `lat`, `lng`, `prior`, `created_at`, `updated_at`) VALUES
(1, 'Agadir', 'agadir', 'agadir.jpg', 30.42018, -9.59815, 1, NULL, NULL),
(2, 'Ighrem', 'ighrem', 'ville.jpg', 29.462122, -9.675904, 0, NULL, NULL),
(3, 'Ain Chair', 'ain-chair', 'ville.jpg', 32.20145, -2.525522, 0, NULL, NULL),
(4, 'Akka', 'akka', 'ville.jpg', 29.391047, -8.256851, 0, NULL, NULL),
(5, 'Aknoul', 'aknoul', 'ville.jpg', 34.65, -3.866667, 0, NULL, NULL),
(6, 'Araich', 'araich', 'ville.jpg', 35.183333, -6.15, 0, NULL, NULL),
(7, 'Arbaoua', 'arbaoua', 'ville.jpg', 34.911831, -5.913782, 0, NULL, NULL),
(8, 'Arfoud', 'arfoud', 'ville.jpg', 31.436633, -4.234383, 0, NULL, NULL),
(9, 'Assa', 'assa', 'ville.jpg', 28.608611, -9.426944, 0, NULL, NULL),
(10, 'Assila', 'assila', 'ville.jpg', 35.466667, -6.033333, 0, NULL, NULL),
(11, 'Azemmour', 'azemmour', 'ville.jpg', 33.287778, -8.342222, 0, NULL, NULL),
(12, 'Azilal', 'azilal', 'ville.jpg', 31.966944, -6.569444, 0, NULL, NULL),
(13, 'Azrou', 'azrou', 'ville.jpg', 33.441448, -5.224798, 0, NULL, NULL),
(14, 'Berkane', 'berkane', 'ville.jpg', 34.916667, -2.316667, 0, NULL, NULL),
(15, 'Bengrir', 'bengrir', 'ville.jpg', 32.24419, -7.953318, 0, NULL, NULL),
(16, 'Beni Mellal', 'beni-mellal', 'ville.jpg', 32.339444, -6.360833, 0, NULL, NULL),
(17, 'Benslimane', 'benslimane', 'ville.jpg', 33.499201, -7.179026, 0, NULL, NULL),
(18, 'Berrchid', 'berrchid', 'ville.jpg', 33.266667, -7.583333, 0, NULL, NULL),
(19, 'Bouanane', 'bouanane', 'ville.jpg', 32.0275, -3.04, 0, NULL, NULL),
(20, 'Bouarfa', 'bouarfa', 'ville.jpg', 32.518889, -1.9775, 0, NULL, NULL),
(21, 'Boujdour', 'boujdour', 'ville.jpg', 26.133333, -14.466667, 0, NULL, NULL),
(22, 'Autre', 'autre', 'ville.jpg', 31.791702, -7.09262, 0, NULL, NULL),
(25, 'Bouzniqua', 'bouzniqua', 'ville.jpg', 33.789722, -7.1575, 0, NULL, NULL),
(26, 'Casablanca', 'casablanca', 'casablanca.jpg', 33.58831, -7.61138, 1, NULL, NULL),
(27, 'Chefchaoun', 'chefchaoun', 'ville.jpg', 35.171389, -5.269722, 0, NULL, NULL),
(28, 'Dakhla', 'dakhla', 'ville.jpg', 30.41071, -9.55572, 0, NULL, NULL),
(29, 'Demnat', 'demnat', 'ville.jpg', 31.73443, -7.00505, 0, NULL, NULL),
(30, 'El Gara', 'el-gara', 'ville.jpg', 33.278791, -7.227534, 0, NULL, NULL),
(31, 'El Jadida', 'el-jadida', 'eljadida.jpg', 33.25492, -8.50602, 1, NULL, NULL),
(32, 'Essmara', 'essmara', 'ville.jpg', 26.739444, -11.670278, 0, NULL, NULL),
(34, 'Fès', 'fes', 'fes.jpg', 33.33333, -4.25, 1, NULL, NULL),
(35, 'Figuig', 'figuig', 'ville.jpg', 32.109261, -1.229806, 0, NULL, NULL),
(36, 'Gouira', 'gouira', 'ville.jpg', 20.833333, -17.091667, 0, NULL, NULL),
(37, 'Guelmima', 'guelmima', 'ville.jpg', 31.689175, -4.957495, 0, NULL, NULL),
(38, 'Guersif', 'guersif', 'ville.jpg', 34.425036, -3.398895, 0, NULL, NULL),
(39, 'Hajeb', 'hajeb', 'ville.jpg', 33.68786, -5.371, 0, NULL, NULL),
(41, 'Al Hoceima', 'al-hoceima', 'ville.jpg', 35.249299, -3.937112, 0, NULL, NULL),
(42, 'Ifrane', 'ifrane', 'ville.jpg', 33.33333, -5.25, 0, NULL, NULL),
(43, 'Imouzzer-Kandar', 'imouzzer-kandar', 'ville.jpg', 33.73, -5.01, 0, NULL, NULL),
(44, 'Jerada', 'jerada', 'ville.jpg', 34.311667, -2.163611, 0, NULL, NULL),
(45, 'Kénitra', 'kenitra', 'ville.jpg', 34.264061, -6.578296, 0, NULL, NULL),
(46, 'Kalaat Magouna', 'kalaat-magouna', 'ville.jpg', 31.241389, -6.128333, 0, NULL, NULL),
(47, 'Kalaat Sraghna', 'kalaat-sraghna', 'ville.jpg', 32.048056, -7.408333, 0, NULL, NULL),
(48, 'Ksar El-kébir', 'ksar-el-kébir', 'ville.jpg', 35.003531, -5.915537, 0, NULL, NULL),
(49, 'Kesba Tadla', 'kesba-tadla', 'ville.jpg', 32.6, -6.266667, 0, NULL, NULL),
(50, 'Khemissat', 'khemissat', 'ville.jpg', 33.816667, -6.066667, 0, NULL, NULL),
(51, 'Khenifra', 'khenifra', 'ville.jpg', 32.9391, -5.6686, 0, NULL, NULL),
(52, 'Khouribga', 'khouribga', 'ville.jpg', 32.88108, -6.9063, 0, NULL, NULL),
(53, 'Laayoune', 'laayoune', 'ville.jpg', 27.08358, -13.24127, 0, NULL, NULL),
(54, 'Marrakech', 'marrakech', 'marrakech.jpg', 31.63416, -7.99994, 1, NULL, NULL),
(55, 'Meknès', 'meknes', 'ville.jpg', 32.58333, -5, 0, NULL, NULL),
(57, 'Midelt', 'midelt', 'ville.jpg', 32.6852, -4.74512, 0, NULL, NULL),
(58, 'Missour', 'missour', 'ville.jpg', 33.0401, -3.99783, 0, NULL, NULL),
(59, 'Mohammedia', 'mohammedia', 'ville.jpg', 33.683333, -7.383333, 0, NULL, NULL),
(60, 'Moulay Bouazza', 'moulay-bouazza', 'ville.jpg', 33.225344, -6.197785, 0, NULL, NULL),
(61, 'Moulay Yaqoub', 'moulay-yaqoub', 'ville.jpg', 34.087778, -5.181111, 0, NULL, NULL),
(62, 'Nador', 'nador', 'ville.jpg', 35.16813, -2.93352, 0, NULL, NULL),
(63, 'Ouad Amlil', 'ouad-amlil', 'ville.jpg', 34.187662, -4.266668, 0, NULL, NULL),
(64, 'Ouad Zem', 'ouad-zem', 'ville.jpg', 32.866667, -6.566667, 0, NULL, NULL),
(65, 'Ouarzazate', 'ouarzazate', 'ville.jpg', 30.91894, -6.89341, 0, NULL, NULL),
(66, 'Ouazzane', 'ouazzane', 'ville.jpg', 34.8, -5.583333, 0, NULL, NULL),
(67, 'Oujda', 'oujda', 'oujda.jpg', 34.68052, -1.90764, 1, NULL, NULL),
(68, 'Rabat', 'rabat', 'rabat.jpg', 34.015049, -6.83272, 1, NULL, NULL),
(69, 'Rachidia', 'rachidia', 'ville.jpg', 31.75, -4.5, 0, NULL, NULL),
(70, 'Rich', 'rich', 'ville.jpg', 28.23776, -10.66591, 0, NULL, NULL),
(71, 'Rissani', 'rissani', 'ville.jpg', 31.28464, -4.26883, 0, NULL, NULL),
(72, 'Rommani', 'rommani', 'ville.jpg', 33.52838, -6.60348, 0, NULL, NULL),
(73, 'Safi', 'safi', 'ville.jpg', 32.29939, -9.23718, 0, NULL, NULL),
(74, 'Essaouira', 'essaouira', 'ville.jpg', 31.513056, -9.769722, 0, NULL, NULL),
(75, 'Sefrou', 'sefrou', 'ville.jpg', 33.83186, -4.828, 0, NULL, NULL),
(76, 'Settat', 'settat', 'ville.jpg', 33.00103, -7.61662, 0, NULL, NULL),
(77, 'Sidi Ifni', 'sidi-ifni', 'ville.jpg', 29.38381, -10.17576, 0, NULL, NULL),
(78, 'Sidi Kacem', 'sidi-kacem', 'ville.jpg', 34.230518, -5.710314, 0, NULL, NULL),
(79, 'Sidi Slimane', 'sidi-slimane', 'ville.jpg', 34.26, -5.92, 0, NULL, NULL),
(80, 'Sidi Yehya', 'sidi-yehya', 'ville.jpg', 33.75, -4.316667, 0, NULL, NULL),
(81, 'Souk Elarbaa', 'souk-elarbaa', 'ville.jpg', 34.69265, -6.000483, 0, NULL, NULL),
(82, 'Tétouan', 'tetouan', 'tetouan.jpg', 35.57845, -5.36837, 1, NULL, NULL),
(83, 'Tafraout', 'tafraout', 'ville.jpg', 35.11462, -4.92086, 0, NULL, NULL),
(84, 'Tahla', 'tahla', 'ville.jpg', 34.0476, -4.42889, 0, NULL, NULL),
(85, 'Taliouine', 'taliouine', 'ville.jpg', 30.532778, -7.925556, 0, NULL, NULL),
(86, 'Tandit', 'tandit', 'ville.jpg', 29.55, -10.03, 0, NULL, NULL),
(87, 'Tanger', 'tanger', 'tanger.jpg', 35.76727, -5.79975, 1, NULL, NULL),
(88, 'Tantan', 'tantan', 'ville.jpg', 28.43799, -11.10321, 0, NULL, NULL),
(89, 'Taounat', 'taounat', 'ville.jpg', 34.53661, -4.64009, 0, NULL, NULL),
(90, 'Taourirt', 'taourirt', 'ville.jpg', 34.4073, -2.89732, 0, NULL, NULL),
(91, 'Taroudant', 'taroudant', 'ville.jpg', 30.47028, -8.87695, 0, NULL, NULL),
(92, 'Tata', 'tata', 'ville.jpg', 29.66667, -7.83333, 0, NULL, NULL),
(93, 'Taza', 'taza', 'ville.jpg', 35.25165, -3.93723, 0, NULL, NULL),
(94, 'Tarfaya', 'tarfaya', 'ville.jpg', 27.93556, -12.91871, 0, NULL, NULL),
(95, 'Tiffelt', 'tiffelt', 'ville.jpg', 33.893056, -6.306944, 0, NULL, NULL),
(96, 'Tinejdad', 'tinejdad', 'ville.jpg', 31.512853, -5.023447, 0, NULL, NULL),
(98, 'Tiznit', 'tiznit', 'ville.jpg', 29.69742, -9.73162, 0, NULL, NULL),
(99, 'Youssoufia', 'youssoufia', 'ville.jpg', 32.24634, -8.52941, 0, NULL, NULL),
(100, 'Zagoura', 'zagoura', 'ville.jpg', 30.330556, -5.838056, 0, NULL, NULL),
(101, 'Zerhoun', 'zerhoun', 'ville.jpg', 34.05594, -5.51832, 0, NULL, NULL),
(102, 'Tissa', 'tissa', 'ville.jpg', 32.06857, -6.21178, 0, NULL, NULL),
(103, 'Salé', 'sale', 'ville.jpg', 34.033333, -6.8, 0, NULL, NULL),
(104, 'Merzouga', 'merzouga', 'ville.jpg', 30.4469814, -4.4577396, 0, NULL, NULL),
(105, 'Essaidia', 'essaidia', 'ville.jpg', 35.0919919, -2.2634122, 0, NULL, NULL),
(106, 'Larache', 'larache', 'ville.jpg', 35.1759075, -6.1554766, 0, NULL, NULL),
(107, 'Imilchil', 'imilchil', 'ville.jpg', 32.1550866, -5.6293988, 0, NULL, NULL),
(108, 'Skhirat', 'skhirat', 'ville.jpg', 33.8593452, -7.039724, 0, NULL, NULL),
(109, 'Maroc', 'maroc', 'ville.jpg', 31.7948264, -7.084723, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating_id` int(11) DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `reported` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `event_id`, `comment`, `rating_id`, `ip_address`, `created_at`, `updated_at`, `deleted_at`, `reported`) VALUES
(2, 1, 2, 'test comment', 2, '127.0.0.1', '2018-04-29 14:28:42', '2018-04-30 13:29:28', NULL, 0),
(3, 1, 22, 'commentaire 1', NULL, '127.0.0.1', '2018-04-29 15:47:40', '2018-05-02 14:26:24', NULL, 10),
(4, 1, 22, 'commentaire 2', 3, '127.0.0.1', '2018-04-29 15:47:54', '2018-05-02 14:26:24', NULL, 0),
(6, 4, 22, 'Commentaire 3 par john doe', 4, '127.0.0.1', '2018-04-29 15:50:35', '2018-04-30 14:12:32', NULL, 0),
(7, 18, 22, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 5, '127.0.0.1', '2018-04-29 15:53:16', '2018-05-02 11:14:51', NULL, 0),
(8, 1, 22, 'check', NULL, '127.0.0.1', '2018-04-29 18:38:25', '2018-04-29 18:38:25', NULL, 0),
(23, 1, 22, 'comment', 9, '127.0.0.1', '2018-04-30 07:22:08', '2018-04-30 12:59:32', '2018-04-30 13:59:32', 0),
(24, 1, 22, 'salut', 10, '127.0.0.1', '2018-04-30 12:52:56', '2018-04-30 12:59:32', '2018-04-30 13:59:32', 0),
(25, 1, 22, 'salut', NULL, '127.0.0.1', '2018-04-30 12:55:20', '2018-04-30 12:59:32', '2018-04-30 13:59:32', 0),
(26, 1, 2, 'test', 11, '127.0.0.1', '2018-05-09 14:26:06', '2018-05-09 14:26:06', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type_id` int(11) NOT NULL,
  `access_type` int(11) NOT NULL,
  `tickets_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_original` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_sponsored` int(11) NOT NULL,
  `is_editor_choice` int(11) NOT NULL,
  `organizer_id` int(11) NOT NULL,
  `attending_count` int(11) NOT NULL,
  `pin_count` int(11) NOT NULL,
  `checkin_count` int(11) NOT NULL,
  `comment_count` int(11) NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_organizer_owner` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `slug`, `description`, `start_timestamp`, `end_timestamp`, `type_id`, `access_type`, `tickets_url`, `cover`, `cover_original`, `youtube_url`, `venue_id`, `email`, `phone`, `website`, `schedule`, `is_sponsored`, `is_editor_choice`, `organizer_id`, `attending_count`, `pin_count`, `checkin_count`, `comment_count`, `facebook`, `twitter`, `youtube`, `is_organizer_owner`, `status`, `status_date`, `published_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'timitar 2017', 'timitar-2018', 'description timitar 2018', '2018-04-10 09:09:43', '2018-04-30 18:00:00', 247, 1, NULL, 'FRnql7nVtBkc8VcV8pCjyyKgmWZS9wCQeyjZc16v.jpeg', 'MP9004424881.jpg', NULL, 3, NULL, NULL, NULL, '', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-04-07 17:51:27', '2018-04-23 17:29:46'),
(3, '1er trophée de pétanque des etoiles \"henri salvador\"', 'johns-event', '1ER TROPHÉE DE PÉTANQUE DES ETOILES \"HENRI SALVADOR\"', '2018-04-12 09:09:17', '2018-04-24 18:00:00', 246, 1, NULL, 'XPsUSjhzbDepDvYuWee16Q0Onz7jwQsZLGSbHZy2.jpeg', 'MP9004424881.jpg', NULL, 1, NULL, NULL, NULL, '', 0, 0, 2, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'published', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-04-10 10:37:00', '2018-05-09 18:30:16'),
(4, 'mwa 2018', 'mwa-2018', 'description mwa', '2018-04-11 09:25:56', '2018-04-27 10:00:00', 247, 1, NULL, 'nAqiEkqWD9TzREFgZR3AWs8DBCxoQTCy18m65QJM.jpeg', 'MP9004424881.jpg', NULL, 1, NULL, NULL, NULL, '', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-04-10 13:25:40', '2018-04-11 08:25:56'),
(5, 'mwa 2020', 'mwa-2020', 'description 2020', '2018-04-11 07:00:00', '2018-04-27 17:30:00', 246, 1, NULL, 'WQX5bsmFtlCeNuQZfmpHCfS93zobscyEyKsVDtH6.jpeg', 'MP9004424881.jpg', NULL, 3, NULL, NULL, NULL, '', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'published', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-04-11 07:36:53', '2018-05-10 21:01:32'),
(21, 'maroc web awards 2018', 'maroc-web-awards-2018', 'Nous vous avions promis un retour en BEAUTÉ ce semestre...\nChose promise chose due ! Après une 1ère édition brillamment réussie, le club Musi\'k de l\'École Nationale de Commerce et de Gestion revient plus ambitieux et prometteur en vue d\'organiser la 2ème édition de son Festival, ce dernier s’efforcera autant de maintenir les acquis de l\'édition précédente dans le but d’assurer l’avenir de la manifestation que de parfaire son enveloppe, cet événement est une belle opportunité pour tout amateur d\'art et de Musique, une occasion rêvée de partager sa passion pour la Musique et vivre des expériences musicales vertigineuses !\nL\'FUM sera le rendez-vous de différentes équipes venues des plus grandes écoles, instituts supérieurs et universités du royaume afin de se disputer les trois prix du jury et seront donc jugées pour leurs qualités techniques artistiques ainsi que leurs sensibilités musicales.\nPour cette édition, la compétition de L\'FUM aura lieu le SAMEDI 14 AVRIL au complexe culturel de Kenitra à 50Dh l\'entrée et sera présidée par un jury composé de RENOMS de la Musique marocaine ! \nRestez branchés', '2018-04-27 09:10:12', '2018-04-30 18:42:23', 247, 2, NULL, 'VbZL3qrTzwncpUmZlUsf8eaYBp06DYAsq9O2JKiW.jpeg', 'MP9004424881.jpg', NULL, 1, NULL, NULL, NULL, '', 0, 0, 1, 0, 0, 0, 0, 'https://facebook.com/a.cooldes', 'https://facebook.com/a.cooldes', 'https://facebook.com/a.cooldes', 1, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-04-11 13:22:40', '2018-04-11 15:29:13'),
(22, 'world cup 2019', 'world-cup-2018', 'description world cup 2018', '2018-04-27 09:10:00', '2018-04-30 18:42:00', 246, 1, NULL, '4y8nbUgKLRrFuY3f0tZSdGjHu3kCQ2ZTRUSWm3uK.jpeg', '22221781_1893998800919424_5097136805633816144_n.jpg', NULL, 7, NULL, NULL, NULL, '', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-04-13 10:36:40', '2018-05-11 08:45:11'),
(23, 'mawazine', 'mawazine', 'mawazine description', '2018-05-16 08:00:00', '2018-05-30 18:00:00', 256, 2, NULL, '00spa6NPLewgX24ivU7fbR89YbE2VpzsIlF33azg.png', 'Screen Shot 2018-05-07 at 10.53.01 PM.png', NULL, 9, NULL, NULL, NULL, '', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-05-08 09:21:56', '2018-05-08 12:21:19'),
(24, 'mawazine 2020', 'mawazine-2020', 'mawazine description 2020', '2018-05-09 07:00:00', '2018-05-24 18:00:00', 256, 2, NULL, 'bJpbylPAc8LDV3Dm7ZZtv059ggsuHuJsT31HeRkq.png', 'Screen Shot 2018-05-07 at 10.53.01 PM.png', NULL, 8, NULL, NULL, NULL, '', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'published', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-05-08 09:29:16', '2018-05-08 12:00:20'),
(25, 'world cup 2018', 'world-cup-2018', 'description world cup 2018', '2018-05-08 07:00:00', '2018-05-30 18:00:00', 294, 1, NULL, 'WMgmOrtUlEMG9yGdsJmGiIRzOXzxTMso3HTgBvjG.jpeg', '22221781_1893998800919424_5097136805633816144_n.jpg', NULL, 7, NULL, NULL, NULL, '', 0, 0, 7, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-05-08 12:06:49', '2018-05-08 12:14:07'),
(26, 'world cup 2026', 'world-cup-2026', 'ici c\'est la description de l\'evenement world cup 2026', '2025-06-19 07:00:00', '2026-05-21 17:00:00', 246, 1, NULL, '122WnIGJfl2by24pJGGdy4ntJQbH6MR1ckRRvCjg.png', 'Screen Shot 2018-05-09 at 6.14.16 PM.png', NULL, 7, NULL, NULL, NULL, '', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-05-10 21:04:52', '2018-05-10 21:04:52'),
(31, 'festival de gnaoua', 'festival-de-gnaoua', 'description du festival de gnaoua', '2018-11-07 00:00:00', '2018-11-30 00:00:00', 256, 1, NULL, '8EL8hSHDAFI1ycENs7fVV3OjZTncAhoPwEq4OYkr.jpeg', '22221781_1893998800919424_5097136805633816144_n.jpg', NULL, 10, NULL, NULL, NULL, '', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-05-11 09:06:48', '2018-05-11 13:08:33'),
(34, 'festival de merzouga', 'festival-de-merzouga', 'description du festival', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 256, 1, NULL, 'owzUXORtizIeWhzcVxjxhQSXpUXksn1LKmAWQ4Xf.jpeg', '29101081_1753483118045690_4723733668831449476_n.jpg', NULL, 11, NULL, NULL, NULL, '', 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-05-11 13:28:52', '2018-05-11 13:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `events_options`
--

CREATE TABLE `events_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events_options`
--

INSERT INTO `events_options` (`id`, `event_id`, `label`, `value`, `created_at`, `updated_at`) VALUES
(15, 12, 'queued', '0000-00-00 00:00:00', '2018-04-05 09:57:38', '2018-04-05 09:57:38'),
(16, 14, 'queued', '0000-00-00 00:00:00', '2018-04-05 09:58:43', '2018-04-05 09:58:43'),
(17, 15, 'queued', '0000-00-00 00:00:00', '2018-04-05 09:59:30', '2018-04-05 09:59:30'),
(18, 16, 'queued', '0000-00-00 00:00:00', '2018-04-05 10:49:02', '2018-04-05 10:49:02'),
(19, 17, 'queued', '0000-00-00 00:00:00', '2018-04-05 10:50:28', '2018-04-05 10:50:28'),
(20, 18, 'queued', '0000-00-00 00:00:00', '2018-04-05 10:50:44', '2018-04-05 10:50:44'),
(21, 19, 'queued', '0000-00-00 00:00:00', '2018-04-05 10:51:37', '2018-04-05 10:51:37'),
(22, 20, 'queued', '0000-00-00 00:00:00', '2018-04-05 10:52:16', '2018-04-05 10:52:16'),
(24, 22, 'queued', '0000-00-00 00:00:00', '2018-04-05 10:53:15', '2018-04-05 10:53:15'),
(25, 23, 'queued', '0000-00-00 00:00:00', '2018-04-05 10:53:29', '2018-04-05 10:53:29'),
(26, 24, 'queued', '0000-00-00 00:00:00', '2018-04-05 10:54:05', '2018-04-05 10:54:05'),
(27, 25, 'queued', '0000-00-00 00:00:00', '2018-04-05 11:01:35', '2018-04-05 11:01:35'),
(28, 26, 'queued', '0000-00-00 00:00:00', '2018-04-05 11:04:34', '2018-04-05 11:04:34'),
(29, 27, 'queued', '0000-00-00 00:00:00', '2018-04-05 11:07:23', '2018-04-05 11:07:23'),
(30, 28, 'queued', '0000-00-00 00:00:00', '2018-04-05 11:10:56', '2018-04-05 11:10:56'),
(31, 29, 'queued', '0000-00-00 00:00:00', '2018-04-05 11:11:12', '2018-04-05 11:11:12'),
(32, 30, 'queued', '0000-00-00 00:00:00', '2018-04-05 11:12:02', '2018-04-05 11:12:02'),
(33, 31, 'queued', '0000-00-00 00:00:00', '2018-04-05 11:12:09', '2018-04-05 11:12:09'),
(34, 32, 'queued', '0000-00-00 00:00:00', '2018-04-05 11:13:05', '2018-04-05 11:13:05'),
(35, 2, 'queued', '0000-00-00 00:00:00', '2018-04-07 17:51:27', '2018-04-07 17:51:27'),
(36, 3, 'queued', '0000-00-00 00:00:00', '2018-04-10 10:37:00', '2018-04-10 10:37:00'),
(37, 4, 'queued', '0000-00-00 00:00:00', '2018-04-10 13:25:40', '2018-04-10 13:25:40'),
(38, 5, 'queued', '0000-00-00 00:00:00', '2018-04-11 07:36:53', '2018-04-11 07:36:53'),
(39, 7, 'queued', '2018-04-11 00:00:00', '2018-04-11 09:26:33', '2018-04-11 09:26:33'),
(40, 8, 'recurrent', 'a:3:{s:4:\"type\";s:7:\"monthly\";s:12:\"monthly_type\";s:11:\"week_number\";s:7:\"monthly\";a:2:{s:11:\"week_number\";s:1:\"1\";s:3:\"day\";s:1:\"2\";}}', '2018-04-11 11:40:17', '2018-04-11 11:40:17'),
(41, 8, 'queued', '2018-04-11 00:00:00', '2018-04-11 11:40:17', '2018-04-11 11:40:17'),
(42, 9, 'recurrent', 'a:3:{s:4:\"type\";s:7:\"monthly\";s:12:\"monthly_type\";s:11:\"week_number\";s:7:\"monthly\";a:2:{s:11:\"week_number\";s:1:\"1\";s:3:\"day\";s:1:\"2\";}}', '2018-04-11 11:47:44', '2018-04-11 11:47:44'),
(43, 9, 'queued', '2018-04-11', '2018-04-11 11:47:44', '2018-04-11 11:47:44'),
(44, 10, 'recurrent', 'a:6:{s:9:\"time_from\";s:5:\"08:00\";s:7:\"time_to\";s:5:\"18:00\";s:9:\"date_from\";s:10:\"04/12/2018\";s:7:\"date_to\";s:10:\"04/26/2018\";s:4:\"type\";s:6:\"weekly\";s:7:\"weekday\";s:1:\"1\";}', '2018-04-11 12:33:17', '2018-04-11 12:33:17'),
(45, 10, 'queued', '2018-04-11', '2018-04-11 12:33:17', '2018-04-11 12:33:17'),
(46, 18, 'recurrent', 'a:7:{s:9:\"time_from\";s:5:\"08:00\";s:7:\"time_to\";s:5:\"18:00\";s:9:\"date_from\";s:10:\"04/21/2018\";s:7:\"date_to\";s:10:\"04/25/2018\";s:4:\"type\";s:7:\"monthly\";s:12:\"monthly_type\";s:10:\"day_number\";s:7:\"monthly\";a:1:{s:10:\"day_number\";s:1:\"3\";}}', '2018-04-11 13:17:36', '2018-04-11 13:17:36'),
(47, 18, 'queued', '2018-04-11', '2018-04-11 13:17:36', '2018-04-11 13:17:36'),
(48, 19, 'recurrent', 'a:7:{s:9:\"time_from\";s:5:\"08:00\";s:7:\"time_to\";s:5:\"18:00\";s:9:\"date_from\";s:10:\"04/12/2018\";s:7:\"date_to\";s:10:\"04/27/2018\";s:4:\"type\";s:7:\"monthly\";s:12:\"monthly_type\";s:10:\"day_number\";s:7:\"monthly\";a:1:{s:10:\"day_number\";s:1:\"6\";}}', '2018-04-11 13:19:01', '2018-04-11 13:19:01'),
(49, 19, 'queued', '2018-04-11', '2018-04-11 13:19:01', '2018-04-11 13:19:01'),
(50, 20, 'recurrent', 'a:5:{s:9:\"time_from\";s:5:\"08:00\";s:7:\"time_to\";s:5:\"18:00\";s:9:\"date_from\";s:10:\"04/12/2018\";s:7:\"date_to\";s:10:\"04/27/2018\";s:4:\"type\";s:5:\"daily\";}', '2018-04-11 13:20:36', '2018-04-11 13:20:36'),
(51, 20, 'queued', '2018-04-11', '2018-04-11 13:20:36', '2018-04-11 13:20:36'),
(54, 22, 'queued', 'a:7:{s:9:\"time_from\";s:5:\"20:00\";s:7:\"time_to\";s:5:\"06:00\";s:9:\"date_from\";s:10:\"05/11/2018\";s:7:\"date_to\";s:10:\"05/11/2018\";s:4:\"type\";s:7:\"monthly\";s:7:\"weekday\";s:1:\"7\";s:7:\"monthly\";a:1:{s:10:\"day_number\";s:1:\"4\";}}', '2018-04-13 10:36:40', '2018-05-11 08:41:44'),
(55, 23, 'queued', '2018-05-08', '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(56, 24, 'queued', '2018-05-08', '2018-05-08 09:29:16', '2018-05-08 09:29:16'),
(57, 25, 'queued', '2018-05-08', '2018-05-08 12:06:49', '2018-05-08 12:06:49'),
(58, 26, 'queued', '2018-05-10', '2018-05-10 21:04:52', '2018-05-10 21:04:52'),
(61, 28, 'queued', '2018-05-11', '2018-05-11 09:02:09', '2018-05-11 09:02:09'),
(62, 28, 'recurrent', 'a:7:{s:9:\"time_from\";s:5:\"18:00\";s:7:\"time_to\";s:5:\"00:00\";s:9:\"date_from\";s:10:\"05/11/2018\";s:7:\"date_to\";s:10:\"05/31/2018\";s:4:\"type\";s:7:\"monthly\";s:12:\"monthly_type\";s:10:\"day_number\";s:7:\"monthly\";a:1:{s:10:\"day_number\";s:2:\"10\";}}', '2018-05-11 09:02:09', '2018-05-11 09:02:09'),
(63, 29, 'queued', '2018-05-11', '2018-05-11 09:06:03', '2018-05-11 09:06:03'),
(64, 29, 'recurrent', 'a:6:{s:9:\"time_from\";s:5:\"18:00\";s:7:\"time_to\";s:5:\"00:00\";s:9:\"date_from\";s:10:\"05/11/2018\";s:7:\"date_to\";s:10:\"05/31/2018\";s:4:\"type\";s:6:\"weekly\";s:7:\"weekday\";s:1:\"1\";}', '2018-05-11 09:06:03', '2018-05-11 09:06:03'),
(65, 30, 'queued', '2018-05-11', '2018-05-11 09:06:33', '2018-05-11 09:06:33'),
(66, 30, 'recurrent', 'a:6:{s:9:\"time_from\";s:5:\"18:00\";s:7:\"time_to\";s:5:\"00:00\";s:9:\"date_from\";s:10:\"05/11/2018\";s:7:\"date_to\";s:10:\"05/31/2018\";s:4:\"type\";s:6:\"weekly\";s:7:\"weekday\";s:1:\"1\";}', '2018-05-11 09:06:33', '2018-05-11 09:06:33'),
(67, 31, 'queued', '2018-05-11', '2018-05-11 09:06:48', '2018-05-11 09:06:48'),
(72, 32, 'queued', '2018-05-11', '2018-05-11 13:26:12', '2018-05-11 13:26:12'),
(73, 32, 'recurrent', 'a:7:{s:9:\"time_from\";s:5:\"06:00\";s:7:\"time_to\";s:5:\"22:00\";s:9:\"date_from\";s:10:\"05/12/2018\";s:7:\"date_to\";s:10:\"05/26/2018\";s:4:\"type\";s:7:\"monthly\";s:12:\"monthly_type\";s:10:\"day_number\";s:7:\"monthly\";a:1:{s:10:\"day_number\";s:1:\"7\";}}', '2018-05-11 13:26:12', '2018-05-11 13:26:12'),
(74, 33, 'queued', '2018-05-11', '2018-05-11 13:28:14', '2018-05-11 13:28:14'),
(75, 34, 'queued', '2018-05-11', '2018-05-11 13:28:52', '2018-05-11 13:28:52'),
(76, 34, 'recurrent', 'a:7:{s:9:\"time_from\";s:5:\"18:00\";s:7:\"time_to\";s:5:\"22:00\";s:9:\"date_from\";s:10:\"05/12/2018\";s:7:\"date_to\";s:10:\"05/26/2018\";s:4:\"type\";s:7:\"monthly\";s:12:\"monthly_type\";s:10:\"day_number\";s:7:\"monthly\";a:3:{s:10:\"day_number\";s:2:\"10\";s:11:\"week_number\";s:1:\"1\";s:3:\"day\";s:1:\"2\";}}', '2018-05-11 13:28:52', '2018-05-11 13:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE `event_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`id`, `event_id`, `category_id`, `created_at`, `updated_at`) VALUES
(75, 12, 2, '2018-04-05 09:57:38', '2018-04-05 09:57:38'),
(76, 12, 3, '2018-04-05 09:57:38', '2018-04-05 09:57:38'),
(77, 13, 2, '2018-04-05 09:58:37', '2018-04-05 09:58:37'),
(78, 13, 3, '2018-04-05 09:58:37', '2018-04-05 09:58:37'),
(79, 14, 2, '2018-04-05 09:58:43', '2018-04-05 09:58:43'),
(80, 14, 3, '2018-04-05 09:58:43', '2018-04-05 09:58:43'),
(81, 15, 2, '2018-04-05 09:59:30', '2018-04-05 09:59:30'),
(82, 15, 3, '2018-04-05 09:59:30', '2018-04-05 09:59:30'),
(83, 16, 2, '2018-04-05 10:49:02', '2018-04-05 10:49:02'),
(84, 16, 3, '2018-04-05 10:49:02', '2018-04-05 10:49:02'),
(85, 16, 5, '2018-04-05 10:49:02', '2018-04-05 10:49:02'),
(86, 17, 2, '2018-04-05 10:50:28', '2018-04-05 10:50:28'),
(87, 17, 3, '2018-04-05 10:50:28', '2018-04-05 10:50:28'),
(88, 17, 5, '2018-04-05 10:50:28', '2018-04-05 10:50:28'),
(89, 18, 2, '2018-04-05 10:50:44', '2018-04-05 10:50:44'),
(90, 18, 3, '2018-04-05 10:50:44', '2018-04-05 10:50:44'),
(91, 18, 5, '2018-04-05 10:50:44', '2018-04-05 10:50:44'),
(92, 19, 2, '2018-04-05 10:51:37', '2018-04-05 10:51:37'),
(93, 19, 3, '2018-04-05 10:51:37', '2018-04-05 10:51:37'),
(94, 19, 5, '2018-04-05 10:51:37', '2018-04-05 10:51:37'),
(95, 20, 2, '2018-04-05 10:52:16', '2018-04-05 10:52:16'),
(96, 20, 3, '2018-04-05 10:52:16', '2018-04-05 10:52:16'),
(97, 20, 5, '2018-04-05 10:52:16', '2018-04-05 10:52:16'),
(98, 21, 2, '2018-04-05 10:52:55', '2018-04-05 10:52:55'),
(99, 21, 3, '2018-04-05 10:52:55', '2018-04-05 10:52:55'),
(100, 21, 5, '2018-04-05 10:52:55', '2018-04-05 10:52:55'),
(101, 22, 2, '2018-04-05 10:53:15', '2018-04-05 10:53:15'),
(102, 22, 3, '2018-04-05 10:53:15', '2018-04-05 10:53:15'),
(103, 22, 5, '2018-04-05 10:53:15', '2018-04-05 10:53:15'),
(104, 23, 2, '2018-04-05 10:53:29', '2018-04-05 10:53:29'),
(105, 23, 3, '2018-04-05 10:53:29', '2018-04-05 10:53:29'),
(106, 23, 5, '2018-04-05 10:53:29', '2018-04-05 10:53:29'),
(107, 24, 2, '2018-04-05 10:54:05', '2018-04-05 10:54:05'),
(108, 24, 3, '2018-04-05 10:54:05', '2018-04-05 10:54:05'),
(109, 24, 5, '2018-04-05 10:54:05', '2018-04-05 10:54:05'),
(110, 25, 2, '2018-04-05 11:01:35', '2018-04-05 11:01:35'),
(111, 25, 3, '2018-04-05 11:01:35', '2018-04-05 11:01:35'),
(112, 25, 4, '2018-04-05 11:01:35', '2018-04-05 11:01:35'),
(113, 26, 2, '2018-04-05 11:04:34', '2018-04-05 11:04:34'),
(114, 27, 2, '2018-04-05 11:07:23', '2018-04-05 11:07:23'),
(115, 28, 2, '2018-04-05 11:10:56', '2018-04-05 11:10:56'),
(116, 29, 2, '2018-04-05 11:11:12', '2018-04-05 11:11:12'),
(117, 30, 2, '2018-04-05 11:12:02', '2018-04-05 11:12:02'),
(119, 32, 2, '2018-04-05 11:13:05', '2018-04-05 11:13:05'),
(120, 2, 3, '2018-04-07 17:51:27', '2018-04-07 17:51:27'),
(121, 2, 5, '2018-04-07 17:51:27', '2018-04-07 17:51:27'),
(122, 2, 8, '2018-04-07 17:51:27', '2018-04-07 17:51:27'),
(123, 3, 5, '2018-04-10 10:37:00', '2018-04-10 10:37:00'),
(124, 3, 8, '2018-04-10 10:37:00', '2018-04-10 10:37:00'),
(125, 4, 2, '2018-04-10 13:25:40', '2018-04-10 13:25:40'),
(126, 4, 5, '2018-04-10 13:25:40', '2018-04-10 13:25:40'),
(127, 4, 9, '2018-04-10 13:25:40', '2018-04-10 13:25:40'),
(128, 5, 2, '2018-04-11 07:36:53', '2018-04-11 07:36:53'),
(129, 5, 5, '2018-04-11 07:36:53', '2018-04-11 07:36:53'),
(130, 5, 8, '2018-04-11 07:36:53', '2018-04-11 07:36:53'),
(131, 6, 2, '2018-04-11 09:25:08', '2018-04-11 09:25:08'),
(132, 6, 6, '2018-04-11 09:25:08', '2018-04-11 09:25:08'),
(133, 6, 9, '2018-04-11 09:25:08', '2018-04-11 09:25:08'),
(134, 7, 6, '2018-04-11 09:26:33', '2018-04-11 09:26:33'),
(135, 7, 8, '2018-04-11 09:26:33', '2018-04-11 09:26:33'),
(136, 7, 11, '2018-04-11 09:26:33', '2018-04-11 09:26:33'),
(137, 8, 2, '2018-04-11 11:40:17', '2018-04-11 11:40:17'),
(138, 8, 6, '2018-04-11 11:40:17', '2018-04-11 11:40:17'),
(139, 8, 8, '2018-04-11 11:40:17', '2018-04-11 11:40:17'),
(140, 9, 3, '2018-04-11 11:47:44', '2018-04-11 11:47:44'),
(141, 9, 6, '2018-04-11 11:47:44', '2018-04-11 11:47:44'),
(142, 9, 8, '2018-04-11 11:47:44', '2018-04-11 11:47:44'),
(143, 10, 2, '2018-04-11 12:33:17', '2018-04-11 12:33:17'),
(144, 10, 3, '2018-04-11 12:33:17', '2018-04-11 12:33:17'),
(145, 10, 5, '2018-04-11 12:33:17', '2018-04-11 12:33:17'),
(146, 18, 6, '2018-04-11 13:17:36', '2018-04-11 13:17:36'),
(147, 18, 9, '2018-04-11 13:17:36', '2018-04-11 13:17:36'),
(148, 18, 11, '2018-04-11 13:17:36', '2018-04-11 13:17:36'),
(149, 18, 14, '2018-04-11 13:17:36', '2018-04-11 13:17:36'),
(150, 19, 2, '2018-04-11 13:19:01', '2018-04-11 13:19:01'),
(151, 19, 3, '2018-04-11 13:19:01', '2018-04-11 13:19:01'),
(152, 19, 5, '2018-04-11 13:19:01', '2018-04-11 13:19:01'),
(153, 19, 9, '2018-04-11 13:19:01', '2018-04-11 13:19:01'),
(154, 20, 3, '2018-04-11 13:20:36', '2018-04-11 13:20:36'),
(155, 20, 6, '2018-04-11 13:20:36', '2018-04-11 13:20:36'),
(156, 20, 8, '2018-04-11 13:20:36', '2018-04-11 13:20:36'),
(157, 21, 2, '2018-04-11 13:22:40', '2018-04-11 13:22:40'),
(158, 21, 5, '2018-04-11 13:22:40', '2018-04-11 13:22:40'),
(159, 22, 2, '2018-04-13 10:36:40', '2018-04-13 10:36:40'),
(160, 22, 5, '2018-04-13 10:36:40', '2018-04-13 10:36:40'),
(161, 23, 10, '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(162, 23, 13, '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(163, 24, 3, '2018-05-08 09:29:16', '2018-05-08 09:29:16'),
(164, 24, 6, '2018-05-08 09:29:16', '2018-05-08 09:29:16'),
(165, 25, 16, '2018-05-08 12:06:49', '2018-05-08 12:06:49'),
(166, 26, 2, '2018-05-10 21:04:52', '2018-05-10 21:04:52'),
(167, 26, 5, '2018-05-10 21:04:52', '2018-05-10 21:04:52'),
(168, 27, 2, '2018-05-11 08:58:35', '2018-05-11 08:58:35'),
(169, 27, 13, '2018-05-11 08:58:35', '2018-05-11 08:58:35'),
(170, 28, 2, '2018-05-11 09:02:09', '2018-05-11 09:02:09'),
(171, 28, 16, '2018-05-11 09:02:09', '2018-05-11 09:02:09'),
(172, 29, 2, '2018-05-11 09:06:03', '2018-05-11 09:06:03'),
(173, 29, 13, '2018-05-11 09:06:03', '2018-05-11 09:06:03'),
(174, 30, 2, '2018-05-11 09:06:33', '2018-05-11 09:06:33'),
(175, 30, 13, '2018-05-11 09:06:33', '2018-05-11 09:06:33'),
(214, 31, 7, '2018-05-11 13:20:42', '2018-05-11 13:20:42'),
(215, 31, 10, '2018-05-11 13:20:42', '2018-05-11 13:20:42'),
(216, 31, 11, '2018-05-11 13:20:42', '2018-05-11 13:20:42'),
(241, 34, 8, '2018-05-11 13:52:36', '2018-05-11 13:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `event_tags`
--

CREATE TABLE `event_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_tags`
--

INSERT INTO `event_tags` (`id`, `event_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(78, 25, 27, '2018-04-05 11:01:35', '2018-04-05 11:01:35'),
(79, 26, 30, '2018-04-05 11:04:34', '2018-04-05 11:04:34'),
(80, 27, 30, '2018-04-05 11:07:23', '2018-04-05 11:07:23'),
(81, 28, 30, '2018-04-05 11:10:56', '2018-04-05 11:10:56'),
(82, 29, 30, '2018-04-05 11:11:12', '2018-04-05 11:11:12'),
(86, 32, 28, '2018-04-05 11:13:05', '2018-04-05 11:13:05'),
(87, 32, 29, '2018-04-05 11:13:05', '2018-04-05 11:13:05'),
(88, 32, 30, '2018-04-05 11:13:05', '2018-04-05 11:13:05'),
(89, 2, 17, '2018-04-07 17:51:27', '2018-04-07 17:51:27'),
(90, 3, 31, '2018-04-10 10:37:00', '2018-04-10 10:37:00'),
(91, 3, 32, '2018-04-10 10:37:00', '2018-04-10 10:37:00'),
(92, 4, 14, '2018-04-10 13:25:40', '2018-04-10 13:25:40'),
(93, 4, 9, '2018-04-10 13:25:40', '2018-04-10 13:25:40'),
(94, 4, 15, '2018-04-10 13:25:40', '2018-04-10 13:25:40'),
(95, 5, 14, '2018-04-11 07:36:53', '2018-04-11 07:36:53'),
(96, 5, 9, '2018-04-11 07:36:53', '2018-04-11 07:36:53'),
(97, 5, 15, '2018-04-11 07:36:53', '2018-04-11 07:36:53'),
(98, 5, 7, '2018-04-11 07:36:53', '2018-04-11 07:36:53'),
(99, 7, 33, '2018-04-11 09:26:33', '2018-04-11 09:26:33'),
(100, 7, 14, '2018-04-11 09:26:33', '2018-04-11 09:26:33'),
(101, 7, 9, '2018-04-11 09:26:33', '2018-04-11 09:26:33'),
(102, 7, 15, '2018-04-11 09:26:33', '2018-04-11 09:26:33'),
(103, 8, 14, '2018-04-11 11:40:17', '2018-04-11 11:40:17'),
(104, 8, 9, '2018-04-11 11:40:17', '2018-04-11 11:40:17'),
(105, 8, 15, '2018-04-11 11:40:17', '2018-04-11 11:40:17'),
(106, 9, 14, '2018-04-11 11:47:44', '2018-04-11 11:47:44'),
(107, 9, 9, '2018-04-11 11:47:44', '2018-04-11 11:47:44'),
(108, 9, 15, '2018-04-11 11:47:44', '2018-04-11 11:47:44'),
(109, 10, 14, '2018-04-11 12:33:17', '2018-04-11 12:33:17'),
(110, 10, 9, '2018-04-11 12:33:17', '2018-04-11 12:33:17'),
(111, 10, 15, '2018-04-11 12:33:17', '2018-04-11 12:33:17'),
(112, 18, 14, '2018-04-11 13:17:36', '2018-04-11 13:17:36'),
(113, 18, 9, '2018-04-11 13:17:36', '2018-04-11 13:17:36'),
(114, 18, 15, '2018-04-11 13:17:36', '2018-04-11 13:17:36'),
(115, 19, 14, '2018-04-11 13:19:01', '2018-04-11 13:19:01'),
(116, 20, 14, '2018-04-11 13:20:36', '2018-04-11 13:20:36'),
(117, 20, 9, '2018-04-11 13:20:36', '2018-04-11 13:20:36'),
(118, 20, 15, '2018-04-11 13:20:36', '2018-04-11 13:20:36'),
(119, 21, 14, '2018-04-11 13:22:40', '2018-04-11 13:22:40'),
(120, 21, 9, '2018-04-11 13:22:41', '2018-04-11 13:22:41'),
(121, 22, 34, '2018-04-13 10:36:40', '2018-04-13 10:36:40'),
(122, 22, 35, '2018-04-13 10:36:40', '2018-04-13 10:36:40'),
(123, 22, 36, '2018-04-13 10:36:40', '2018-04-13 10:36:40'),
(124, 23, 37, '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(125, 23, 38, '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(126, 23, 20, '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(127, 23, 39, '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(128, 23, 40, '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(129, 23, 41, '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(130, 24, 38, '2018-05-08 09:29:16', '2018-05-08 09:29:16'),
(131, 24, 42, '2018-05-08 09:29:16', '2018-05-08 09:29:16'),
(132, 24, 43, '2018-05-08 09:29:16', '2018-05-08 09:29:16'),
(133, 24, 22, '2018-05-08 09:29:16', '2018-05-08 09:29:16'),
(134, 25, 44, '2018-05-08 12:06:49', '2018-05-08 12:06:49'),
(135, 25, 34, '2018-05-08 12:06:49', '2018-05-08 12:06:49'),
(136, 25, 35, '2018-05-08 12:06:49', '2018-05-08 12:06:49'),
(137, 25, 45, '2018-05-08 12:06:49', '2018-05-08 12:06:49'),
(138, 25, 36, '2018-05-08 12:06:49', '2018-05-08 12:06:49'),
(139, 26, 34, '2018-05-10 21:04:52', '2018-05-10 21:04:52'),
(140, 26, 35, '2018-05-10 21:04:52', '2018-05-10 21:04:52'),
(141, 26, 46, '2018-05-10 21:04:52', '2018-05-10 21:04:52'),
(142, 26, 47, '2018-05-10 21:04:52', '2018-05-10 21:04:52'),
(143, 27, 38, '2018-05-11 08:58:35', '2018-05-11 08:58:35'),
(144, 27, 48, '2018-05-11 08:58:35', '2018-05-11 08:58:35'),
(145, 27, 49, '2018-05-11 08:58:35', '2018-05-11 08:58:35'),
(146, 28, 38, '2018-05-11 09:02:09', '2018-05-11 09:02:09'),
(148, 31, 38, '2018-05-11 09:06:48', '2018-05-11 09:06:48'),
(149, 31, 48, '2018-05-11 09:06:48', '2018-05-11 09:06:48'),
(150, 34, 38, '2018-05-11 13:28:52', '2018-05-11 13:28:52'),
(151, 34, 50, '2018-05-11 13:28:52', '2018-05-11 13:28:52'),
(152, 34, 51, '2018-05-11 13:28:52', '2018-05-11 13:28:52'),
(153, 34, 38, '2018-05-11 13:30:25', '2018-05-11 13:30:25'),
(154, 34, 50, '2018-05-11 13:30:25', '2018-05-11 13:30:25'),
(155, 34, 51, '2018-05-11 13:30:25', '2018-05-11 13:30:25'),
(156, 34, 18, '2018-05-11 13:30:25', '2018-05-11 13:30:25'),
(157, 34, 38, '2018-05-11 13:30:33', '2018-05-11 13:30:33'),
(158, 34, 50, '2018-05-11 13:30:33', '2018-05-11 13:30:33'),
(159, 34, 51, '2018-05-11 13:30:33', '2018-05-11 13:30:33'),
(160, 34, 18, '2018-05-11 13:30:33', '2018-05-11 13:30:33'),
(161, 34, 38, '2018-05-11 13:31:12', '2018-05-11 13:31:12'),
(162, 34, 50, '2018-05-11 13:31:12', '2018-05-11 13:31:12'),
(163, 34, 51, '2018-05-11 13:31:12', '2018-05-11 13:31:12'),
(164, 34, 18, '2018-05-11 13:31:12', '2018-05-11 13:31:12'),
(165, 34, 38, '2018-05-11 13:35:44', '2018-05-11 13:35:44'),
(166, 34, 50, '2018-05-11 13:35:44', '2018-05-11 13:35:44'),
(167, 34, 51, '2018-05-11 13:35:44', '2018-05-11 13:35:44'),
(168, 34, 18, '2018-05-11 13:35:44', '2018-05-11 13:35:44'),
(169, 34, 38, '2018-05-11 13:36:54', '2018-05-11 13:36:54'),
(170, 34, 50, '2018-05-11 13:36:54', '2018-05-11 13:36:54'),
(171, 34, 51, '2018-05-11 13:36:54', '2018-05-11 13:36:54'),
(172, 34, 18, '2018-05-11 13:36:54', '2018-05-11 13:36:54'),
(173, 34, 38, '2018-05-11 13:43:48', '2018-05-11 13:43:48'),
(174, 34, 50, '2018-05-11 13:43:48', '2018-05-11 13:43:48'),
(175, 34, 51, '2018-05-11 13:43:48', '2018-05-11 13:43:48'),
(176, 34, 18, '2018-05-11 13:43:48', '2018-05-11 13:43:48'),
(177, 34, 38, '2018-05-11 13:43:59', '2018-05-11 13:43:59'),
(178, 34, 50, '2018-05-11 13:43:59', '2018-05-11 13:43:59'),
(179, 34, 51, '2018-05-11 13:43:59', '2018-05-11 13:43:59'),
(180, 34, 18, '2018-05-11 13:43:59', '2018-05-11 13:43:59'),
(181, 34, 38, '2018-05-11 13:44:37', '2018-05-11 13:44:37'),
(182, 34, 50, '2018-05-11 13:44:37', '2018-05-11 13:44:37'),
(183, 34, 51, '2018-05-11 13:44:37', '2018-05-11 13:44:37'),
(184, 34, 18, '2018-05-11 13:44:37', '2018-05-11 13:44:37'),
(185, 34, 38, '2018-05-11 13:44:47', '2018-05-11 13:44:47'),
(186, 34, 50, '2018-05-11 13:44:47', '2018-05-11 13:44:47'),
(187, 34, 51, '2018-05-11 13:44:47', '2018-05-11 13:44:47'),
(188, 34, 18, '2018-05-11 13:44:47', '2018-05-11 13:44:47'),
(189, 34, 38, '2018-05-11 13:45:40', '2018-05-11 13:45:40'),
(190, 34, 50, '2018-05-11 13:45:40', '2018-05-11 13:45:40'),
(191, 34, 51, '2018-05-11 13:45:41', '2018-05-11 13:45:41'),
(192, 34, 18, '2018-05-11 13:45:41', '2018-05-11 13:45:41'),
(193, 34, 38, '2018-05-11 13:46:02', '2018-05-11 13:46:02'),
(194, 34, 50, '2018-05-11 13:46:02', '2018-05-11 13:46:02'),
(195, 34, 51, '2018-05-11 13:46:02', '2018-05-11 13:46:02'),
(196, 34, 18, '2018-05-11 13:46:02', '2018-05-11 13:46:02'),
(197, 34, 38, '2018-05-11 13:46:39', '2018-05-11 13:46:39'),
(198, 34, 50, '2018-05-11 13:46:39', '2018-05-11 13:46:39'),
(199, 34, 51, '2018-05-11 13:46:39', '2018-05-11 13:46:39'),
(200, 34, 18, '2018-05-11 13:46:39', '2018-05-11 13:46:39'),
(201, 34, 38, '2018-05-11 13:47:30', '2018-05-11 13:47:30'),
(202, 34, 50, '2018-05-11 13:47:30', '2018-05-11 13:47:30'),
(203, 34, 51, '2018-05-11 13:47:30', '2018-05-11 13:47:30'),
(204, 34, 18, '2018-05-11 13:47:30', '2018-05-11 13:47:30'),
(205, 34, 38, '2018-05-11 13:47:35', '2018-05-11 13:47:35'),
(206, 34, 50, '2018-05-11 13:47:35', '2018-05-11 13:47:35'),
(207, 34, 51, '2018-05-11 13:47:35', '2018-05-11 13:47:35'),
(208, 34, 18, '2018-05-11 13:47:35', '2018-05-11 13:47:35'),
(209, 34, 38, '2018-05-11 13:47:38', '2018-05-11 13:47:38'),
(210, 34, 50, '2018-05-11 13:47:38', '2018-05-11 13:47:38'),
(211, 34, 51, '2018-05-11 13:47:38', '2018-05-11 13:47:38'),
(212, 34, 18, '2018-05-11 13:47:38', '2018-05-11 13:47:38'),
(213, 34, 38, '2018-05-11 13:47:43', '2018-05-11 13:47:43'),
(214, 34, 50, '2018-05-11 13:47:43', '2018-05-11 13:47:43'),
(215, 34, 51, '2018-05-11 13:47:43', '2018-05-11 13:47:43'),
(216, 34, 18, '2018-05-11 13:47:43', '2018-05-11 13:47:43'),
(217, 34, 38, '2018-05-11 13:47:48', '2018-05-11 13:47:48'),
(218, 34, 50, '2018-05-11 13:47:48', '2018-05-11 13:47:48'),
(219, 34, 51, '2018-05-11 13:47:48', '2018-05-11 13:47:48'),
(220, 34, 18, '2018-05-11 13:47:48', '2018-05-11 13:47:48'),
(221, 34, 38, '2018-05-11 13:48:34', '2018-05-11 13:48:34'),
(222, 34, 50, '2018-05-11 13:48:34', '2018-05-11 13:48:34'),
(223, 34, 51, '2018-05-11 13:48:34', '2018-05-11 13:48:34'),
(224, 34, 18, '2018-05-11 13:48:34', '2018-05-11 13:48:34'),
(225, 34, 38, '2018-05-11 13:49:34', '2018-05-11 13:49:34'),
(226, 34, 50, '2018-05-11 13:49:34', '2018-05-11 13:49:34'),
(227, 34, 51, '2018-05-11 13:49:34', '2018-05-11 13:49:34'),
(228, 34, 18, '2018-05-11 13:49:34', '2018-05-11 13:49:34'),
(229, 34, 38, '2018-05-11 13:49:45', '2018-05-11 13:49:45'),
(230, 34, 50, '2018-05-11 13:49:45', '2018-05-11 13:49:45'),
(231, 34, 51, '2018-05-11 13:49:45', '2018-05-11 13:49:45'),
(232, 34, 18, '2018-05-11 13:49:45', '2018-05-11 13:49:45'),
(233, 34, 38, '2018-05-11 13:50:43', '2018-05-11 13:50:43'),
(234, 34, 50, '2018-05-11 13:50:43', '2018-05-11 13:50:43'),
(235, 34, 51, '2018-05-11 13:50:43', '2018-05-11 13:50:43'),
(236, 34, 18, '2018-05-11 13:50:43', '2018-05-11 13:50:43'),
(237, 34, 38, '2018-05-11 13:52:36', '2018-05-11 13:52:36'),
(238, 34, 50, '2018-05-11 13:52:36', '2018-05-11 13:52:36'),
(239, 34, 51, '2018-05-11 13:52:36', '2018-05-11 13:52:36'),
(240, 34, 18, '2018-05-11 13:52:36', '2018-05-11 13:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `file` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `file`, `event_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(36, 'FRnql7nVtBkc8VcV8pCjyyKgmWZS9wCQeyjZc16v.jpeg', 2, 1, '2018-04-07 17:51:27', '2018-04-10 13:43:34', NULL),
(38, 'XPsUSjhzbDepDvYuWee16Q0Onz7jwQsZLGSbHZy2.jpeg', 3, 4, '2018-04-10 10:37:00', '2018-04-10 10:37:00', NULL),
(39, 'nAqiEkqWD9TzREFgZR3AWs8DBCxoQTCy18m65QJM.jpeg', 4, 1, '2018-04-10 13:25:40', '2018-04-10 13:54:19', NULL),
(40, 'WQX5bsmFtlCeNuQZfmpHCfS93zobscyEyKsVDtH6.jpeg', 5, 1, '2018-04-11 07:36:53', '2018-04-11 07:36:53', NULL),
(42, '05V52RWUeXxLoqpIIqkoxZ51gE1dh0lZH4InqdHV.jpeg', 7, 1, '2018-04-11 09:26:33', '2018-04-11 09:26:33', NULL),
(43, 'SiLg9CDVPpVg1aqvGG6FqeSM15noWG3i0RONn6k2.jpeg', 8, 1, '2018-04-11 11:40:17', '2018-04-11 11:40:17', NULL),
(44, '3ScYpWwj2lkJJ1XaE1I5StzCjrZUCUadi13O86Yf.jpeg', 9, 1, '2018-04-11 11:47:44', '2018-04-11 11:47:44', NULL),
(45, 'pVb2ujHfQ7SqFF50t6ohtg5Pa5e1k9MBOoHOGxlV.jpeg', 10, 1, '2018-04-11 12:33:17', '2018-04-11 12:33:17', NULL),
(53, '9947zB3ezdPIorPb5vCM2AfGaCQFfNUP35NZvLCU.jpeg', 18, 1, '2018-04-11 13:17:36', '2018-04-11 13:17:36', NULL),
(54, 'ffsgOeDB0Cclx40MBm1S90dTJDT30FKH0KzKyUIT.jpeg', 19, 1, '2018-04-11 13:19:01', '2018-04-11 13:19:01', NULL),
(55, 'LPplf6QavVub9YxeuV1isVtFMcHyRLNDDbFDf6g6.jpeg', 20, 1, '2018-04-11 13:20:36', '2018-04-11 13:20:36', NULL),
(56, 'VbZL3qrTzwncpUmZlUsf8eaYBp06DYAsq9O2JKiW.jpeg', 21, 1, '2018-04-11 13:22:40', '2018-04-11 13:22:40', NULL),
(57, '4y8nbUgKLRrFuY3f0tZSdGjHu3kCQ2ZTRUSWm3uK.jpeg', 22, 1, '2018-04-13 10:36:40', '2018-05-11 08:45:11', '2018-05-09 18:32:28'),
(61, 'P9aGGVSXI6QGrLQXhKLD5uoJbzRZZ2UbM17mcTD6.png', 22, 1, '2018-04-13 13:00:17', '2018-05-08 12:16:54', '2018-05-08 12:16:54'),
(62, 'flcYRInRt0NUGKuH0g0N7dkEy4exgq1Bh8qqVE8x.png', 22, 1, '2018-04-13 13:00:37', '2018-05-08 12:17:44', '2018-05-08 12:17:44'),
(63, 'S11emJ9ny1UDXyDWHQHrw2nH5CVi7o2XbZYHsvNm.png', 22, 1, '2018-05-04 12:40:26', '2018-05-09 18:32:28', '2018-05-09 18:32:28'),
(64, 'j1FtmPJ4wIx3iTkTyIoqmcuCCERc8TZYrfwEsci6.jpeg', 22, 1, '2018-05-04 12:40:26', '2018-05-08 12:17:44', '2018-05-08 12:17:44'),
(65, 'WR97bA3taxOyoD10kGUlBTXSeXABsFY9rNdQpS3p.png', 22, 1, '2018-05-04 12:42:11', '2018-05-04 12:42:16', '2018-05-04 12:42:16'),
(66, 'Nc7jI4xPjfyAfFCXmPxzGGPEEXV2wCQlXUbiQJs5.jpeg', 22, 1, '2018-05-04 12:42:11', '2018-05-04 12:42:16', '2018-05-04 12:42:16'),
(67, '3LF77YqBtI1Jb2KX5TC9GBbYiGfeNHGMnku1IQRu.png', 22, 1, '2018-05-04 12:52:22', '2018-05-04 12:52:28', '2018-05-04 12:52:28'),
(68, '0fAyJ0F0yUwEIRKzRAYei1Gh4rY9lZRIgh5J9MIx.jpeg', 22, 1, '2018-05-04 12:52:22', '2018-05-04 12:52:28', '2018-05-04 12:52:28'),
(69, 'TRxetXVbSEvv4jyYVE6SDXYbFA9kPvqGAREYJJSf.png', 22, 1, '2018-05-07 07:41:29', '2018-05-07 07:41:32', '2018-05-07 07:41:32'),
(70, 'dFNFcT1xs51LUUAzfl8369fe21V4Jluehz8aIjev.png', 21, 1, '2018-05-07 14:07:00', '2018-05-07 14:07:05', '2018-05-07 14:07:05'),
(71, 'G7g0WeLyKFbt2lfMBIipzJIz0wbHZyTc0PMHpCwy.png', 22, 1, '2018-05-08 08:54:44', '2018-05-08 08:54:47', '2018-05-08 08:54:47'),
(72, 'M6eRhYjyE0vQUaI4HP2LyVpBwzxkEQl31UI3b71t.png', 22, 1, '2018-05-08 08:55:00', '2018-05-08 08:55:04', '2018-05-08 08:55:04'),
(73, 'fei61jh5IFtfpI6eQO15EDSg0E07d8PkkscSem7F.png', 22, 1, '2018-05-08 08:55:00', '2018-05-08 08:55:04', '2018-05-08 08:55:04'),
(74, 'Nerg6rK4SsnPWmHINgZwzwNBE6mO2epMQqnyY4se.png', 4, 1, '2018-05-08 09:13:34', '2018-05-08 09:13:34', NULL),
(81, '00spa6NPLewgX24ivU7fbR89YbE2VpzsIlF33azg.png', 23, 1, '2018-05-08 09:21:56', '2018-05-08 09:21:56', NULL),
(83, 'bJpbylPAc8LDV3Dm7ZZtv059ggsuHuJsT31HeRkq.png', 24, 1, '2018-05-08 09:29:16', '2018-05-08 09:29:16', NULL),
(84, 'WMgmOrtUlEMG9yGdsJmGiIRzOXzxTMso3HTgBvjG.jpeg', 25, 18, '2018-05-08 12:06:49', '2018-05-08 12:06:49', NULL),
(85, 'pd5uB7CjFluUW2ehMsgMh7i2KLhKLDI9YrFZyN03.png', 23, 1, '2018-05-08 12:34:07', '2018-05-08 12:34:14', '2018-05-08 12:34:14'),
(86, '122WnIGJfl2by24pJGGdy4ntJQbH6MR1ckRRvCjg.png', 26, 1, '2018-05-10 21:04:52', '2018-05-10 21:04:52', NULL),
(87, 'cec3qTKu2L1aksGPaVCVV71IUuIVmqQNIsuVqq8I.jpeg', 22, 1, '2018-05-11 07:49:33', '2018-05-11 07:49:36', '2018-05-11 07:49:36'),
(88, 'C7opZQO98o7JaSrL1Zxzyl1boJYyFWHE5jKuQVpU.jpeg', 22, 1, '2018-05-11 07:49:52', '2018-05-11 07:49:52', NULL),
(89, 'M3aylRP51TOqdUNnLDEiRMiIS5zKkhLtl4huaiOY.jpeg', 27, 1, '2018-05-11 08:58:35', '2018-05-11 08:58:35', NULL),
(90, 'PFIKOXpYjYUdJzEeaT0p3940alSJ5gUzPFtD7c1S.jpeg', 28, 1, '2018-05-11 09:02:09', '2018-05-11 09:02:09', NULL),
(91, 'bdUwa02RViWOR3JSdR5wBXp4tWewLkPsTKqJosGv.jpeg', 29, 1, '2018-05-11 09:06:03', '2018-05-11 09:06:03', NULL),
(92, 'SWGVsHXIKdTRWwKYExjSMRJgZ9b6fBjkXjbGTcpv.jpeg', 30, 1, '2018-05-11 09:06:33', '2018-05-11 09:06:33', NULL),
(93, '8EL8hSHDAFI1ycENs7fVV3OjZTncAhoPwEq4OYkr.jpeg', 31, 1, '2018-05-11 09:06:48', '2018-05-11 09:06:48', NULL),
(94, 'wxLCbsA0i2GhzViav0WNuJuSWhyQVUl9CIs7l8RD.jpeg', 0, 1, '2018-05-11 13:26:12', '2018-05-11 13:26:12', NULL),
(95, 'eqJybNGOQ7byKUkpbB8Wf1QBU0wayb7zUM56mv1D.jpeg', 0, 1, '2018-05-11 13:28:14', '2018-05-11 13:28:14', NULL),
(96, 'owzUXORtizIeWhzcVxjxhQSXpUXksn1LKmAWQ4Xf.jpeg', 34, 1, '2018-05-11 13:28:52', '2018-05-11 13:28:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `intervenants`
--

CREATE TABLE `intervenants` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intervenants`
--

INSERT INTO `intervenants` (`id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(13, 6, '2018-05-07 12:21:04', '2018-05-07 09:42:10', '2018-05-07 12:21:04'),
(14, 10, '2018-05-07 09:43:21', '2018-05-07 09:42:43', '2018-05-07 09:43:21'),
(15, 7, NULL, '2018-05-07 10:47:23', '2018-05-08 07:32:23'),
(16, 30, '2018-05-07 12:21:18', '2018-05-07 11:11:16', '2018-05-07 12:21:18'),
(17, 21, '2018-05-07 12:21:18', '2018-05-07 11:11:16', '2018-05-07 12:21:18'),
(18, 19, '2018-05-10 23:47:33', '2018-05-07 11:21:45', '2018-05-10 23:47:33'),
(19, 31, '2018-05-07 12:21:12', '2018-05-07 11:48:34', '2018-05-07 12:21:12'),
(20, 18, NULL, '2018-05-07 13:42:29', '2018-05-07 13:42:29'),
(21, 11, '2018-05-10 22:51:04', '2018-05-08 09:52:05', '2018-05-10 22:51:04'),
(22, 4, '2018-05-11 07:15:38', '2018-05-08 09:52:12', '2018-05-11 07:15:38'),
(23, 1, '2018-05-08 12:07:32', '2018-05-08 12:07:23', '2018-05-08 12:07:32'),
(24, 32, NULL, '2018-05-08 12:55:26', '2018-05-08 12:55:35'),
(31, 39, '2018-05-11 00:28:30', '2018-05-10 23:28:30', '2018-05-10 23:28:30'),
(32, 40, '2018-05-11 00:28:37', '2018-05-10 23:28:37', '2018-05-10 23:28:37'),
(33, 42, '2018-05-11 00:28:46', '2018-05-10 23:28:46', '2018-05-10 23:28:46'),
(38, 53, '2018-05-10 23:47:23', '2018-05-10 23:37:17', '2018-05-10 23:47:23'),
(39, 54, '2018-05-11 07:45:47', '2018-05-10 23:37:37', '2018-05-11 07:45:47'),
(40, 55, '2018-05-11 00:47:58', '2018-05-10 23:47:58', '2018-05-10 23:47:58'),
(41, 56, '2018-05-11 07:16:17', '2018-05-10 23:49:06', '2018-05-11 07:16:17'),
(42, 57, '2018-05-11 07:45:50', '2018-05-11 07:15:47', '2018-05-11 07:45:50'),
(60, 75, '2018-05-11 07:45:51', '2018-05-11 07:41:08', '2018-05-11 07:45:51'),
(61, 76, '2018-05-11 07:42:43', '2018-05-11 07:41:34', '2018-05-11 07:42:43'),
(62, 77, '2018-05-11 07:45:49', '2018-05-11 07:42:57', '2018-05-11 07:45:49'),
(63, 78, '2018-05-11 08:43:47', '2018-05-11 07:43:47', '2018-05-11 07:43:47'),
(65, 80, '2018-05-11 07:45:36', '2018-05-11 07:45:18', '2018-05-11 07:45:36'),
(66, 81, '2018-05-11 08:46:07', '2018-05-11 07:46:07', '2018-05-11 07:46:07'),
(67, 82, '2018-05-11 14:09:14', '2018-05-11 14:07:45', '2018-05-11 14:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `interventions`
--

CREATE TABLE `interventions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interventions`
--

INSERT INTO `interventions` (`id`, `user_id`, `event_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(95, 6, 22, '2018-05-07 09:42:10', '2018-05-07 12:21:04', '2018-05-07 12:21:04'),
(96, 10, 22, '2018-05-07 09:42:43', '2018-05-07 09:43:00', '2018-05-07 09:43:00'),
(97, 10, 2, '2018-05-07 09:43:13', '2018-05-07 09:43:21', '2018-05-07 09:43:21'),
(98, 7, 22, '2018-05-07 10:47:23', '2018-05-07 12:21:05', '2018-05-07 12:21:05'),
(99, 21, 22, '2018-05-07 10:52:22', '2018-05-07 11:20:06', '2018-05-07 11:20:06'),
(100, 22, 22, '2018-05-07 10:56:45', '2018-05-07 11:14:35', '2018-05-07 11:14:35'),
(101, 23, 22, '2018-05-07 10:58:05', '2018-05-07 11:14:41', '2018-05-07 11:14:41'),
(102, 24, 22, '2018-05-07 10:58:17', '2018-05-07 11:17:39', '2018-05-07 11:17:39'),
(103, 25, 22, '2018-05-07 10:58:31', '2018-05-07 11:15:30', '2018-05-07 11:15:30'),
(108, 30, 22, '2018-05-07 11:11:16', '2018-05-07 12:21:06', '2018-05-07 12:21:06'),
(109, 21, 2, '2018-05-07 11:21:38', '2018-05-07 12:21:18', '2018-05-07 12:21:18'),
(110, 19, 22, '2018-05-07 11:21:45', '2018-05-07 12:21:08', '2018-05-07 12:21:08'),
(111, 30, 2, '2018-05-07 11:22:13', '2018-05-07 12:21:18', '2018-05-07 12:21:18'),
(112, 21, 21, '2018-05-07 11:48:02', '2018-05-07 12:21:13', '2018-05-07 12:21:13'),
(113, 31, 21, '2018-05-07 11:48:34', '2018-05-07 12:21:12', '2018-05-07 12:21:12'),
(114, 18, 22, '2018-05-07 13:42:29', '2018-05-07 13:42:29', NULL),
(115, 7, 3, '2018-05-08 07:32:23', '2018-05-08 07:32:23', NULL),
(116, 18, 4, '2018-05-08 09:11:57', '2018-05-08 09:11:59', '2018-05-08 09:11:59'),
(117, 7, 24, '2018-05-08 09:32:41', '2018-05-08 09:32:41', NULL),
(118, 7, 2, '2018-05-08 09:52:00', '2018-05-11 07:12:23', '2018-05-11 07:12:23'),
(119, 11, 2, '2018-05-08 09:52:05', '2018-05-10 22:50:29', '2018-05-10 22:50:29'),
(120, 4, 2, '2018-05-08 09:52:12', '2018-05-10 22:45:26', '2018-05-10 22:45:26'),
(121, 7, 25, '2018-05-08 12:06:57', '2018-05-08 12:06:57', NULL),
(122, 1, 25, '2018-05-08 12:07:23', '2018-05-08 12:07:32', '2018-05-08 12:07:32'),
(123, 7, 23, '2018-05-08 12:21:46', '2018-05-08 12:21:46', NULL),
(124, 18, 23, '2018-05-08 12:55:02', '2018-05-08 12:55:02', NULL),
(125, 32, 23, '2018-05-08 12:55:26', '2018-05-08 12:55:35', NULL),
(126, 18, 2, '2018-05-10 22:37:17', '2018-05-10 22:44:30', '2018-05-10 22:44:30'),
(127, 2, 2, '2018-05-10 22:37:30', '2018-05-10 22:41:48', '2018-05-10 22:41:48'),
(128, 11, 2, '2018-05-10 22:50:23', '2018-05-10 22:50:58', '2018-05-10 22:50:58'),
(129, 18, 2, '2018-05-10 22:50:27', '2018-05-10 22:50:59', '2018-05-10 22:50:59'),
(130, 11, 2, '2018-05-10 22:51:03', '2018-05-10 22:51:04', '2018-05-10 22:51:04'),
(131, 18, 2, '2018-05-10 22:51:09', '2018-05-10 22:51:10', '2018-05-10 22:51:10'),
(132, 53, 2, '2018-05-10 23:37:17', '2018-05-10 23:39:33', '2018-05-10 23:39:33'),
(133, 54, 2, '2018-05-10 23:37:37', '2018-05-11 07:45:47', '2018-05-11 07:45:47'),
(134, 18, 2, '2018-05-10 23:39:25', '2018-05-10 23:39:27', '2018-05-10 23:39:27'),
(135, 18, 2, '2018-05-10 23:39:31', '2018-05-10 23:39:31', NULL),
(136, 19, 2, '2018-05-10 23:39:38', '2018-05-10 23:41:35', '2018-05-10 23:41:35'),
(137, 53, 2, '2018-05-10 23:39:43', '2018-05-10 23:40:56', '2018-05-10 23:40:56'),
(138, 53, 2, '2018-05-10 23:39:47', '2018-05-10 23:40:58', '2018-05-10 23:40:58'),
(139, 19, 2, '2018-05-10 23:42:57', '2018-05-10 23:44:48', '2018-05-10 23:44:48'),
(140, 19, 2, '2018-05-10 23:44:23', '2018-05-10 23:47:16', '2018-05-10 23:47:16'),
(141, 53, 2, '2018-05-10 23:47:14', '2018-05-10 23:47:23', '2018-05-10 23:47:23'),
(142, 19, 2, '2018-05-10 23:47:21', '2018-05-10 23:47:32', '2018-05-10 23:47:32'),
(143, 4, 2, '2018-05-10 23:47:31', '2018-05-10 23:49:16', '2018-05-10 23:49:16'),
(144, 55, 2, '2018-05-10 23:47:58', '2018-05-10 23:47:58', NULL),
(145, 56, 2, '2018-05-10 23:49:06', '2018-05-10 23:49:10', '2018-05-10 23:49:10'),
(146, 56, 2, '2018-05-10 23:49:14', '2018-05-11 07:16:17', '2018-05-11 07:16:17'),
(147, 4, 2, '2018-05-10 23:49:20', '2018-05-11 07:15:38', '2018-05-11 07:15:38'),
(148, 7, 2, '2018-05-11 07:12:30', '2018-05-11 07:15:37', '2018-05-11 07:15:37'),
(149, 57, 2, '2018-05-11 07:15:47', '2018-05-11 07:45:50', '2018-05-11 07:45:50'),
(161, 75, 2, '2018-05-11 07:41:08', '2018-05-11 07:45:51', '2018-05-11 07:45:51'),
(162, 76, 2, '2018-05-11 07:41:34', '2018-05-11 07:41:49', '2018-05-11 07:41:49'),
(163, 76, 2, '2018-05-11 07:42:32', '2018-05-11 07:42:35', '2018-05-11 07:42:35'),
(164, 76, 2, '2018-05-11 07:42:41', '2018-05-11 07:42:43', '2018-05-11 07:42:43'),
(165, 77, 2, '2018-05-11 07:42:57', '2018-05-11 07:45:49', '2018-05-11 07:45:49'),
(166, 78, 2, '2018-05-11 07:43:47', '2018-05-11 07:43:47', NULL),
(168, 80, 2, '2018-05-11 07:45:18', '2018-05-11 07:45:36', '2018-05-11 07:45:36'),
(169, 80, 2, '2018-05-11 07:45:41', '2018-05-11 07:45:41', NULL),
(170, 81, 2, '2018-05-11 07:46:07', '2018-05-11 07:46:07', NULL),
(171, 76, 2, '2018-05-11 07:46:27', '2018-05-11 07:46:27', NULL),
(172, 19, 22, '2018-05-11 07:48:57', '2018-05-11 07:48:57', NULL),
(173, 18, 34, '2018-05-11 14:07:32', '2018-05-11 14:07:49', '2018-05-11 14:07:49'),
(174, 82, 34, '2018-05-11 14:07:45', '2018-05-11 14:09:14', '2018-05-11 14:09:14'),
(175, 18, 34, '2018-05-11 14:07:53', '2018-05-11 14:07:53', NULL),
(176, 82, 34, '2018-05-11 14:09:19', '2018-05-11 14:09:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_02_124513_create_events_table', 2),
(4, '2018_04_02_130749_create_categories_table', 3),
(5, '2018_04_02_133604_create_types_table', 4),
(12, '2018_04_03_085807_event_category', 5),
(13, '2018_04_03_090415_create_event_tags_table', 5),
(14, '2018_04_03_092409_tag', 5),
(15, '2018_04_03_133009_create_images_table', 6),
(16, '2018_04_03_140732_create_events_options_table', 7),
(19, '2018_04_03_151035_create_events_table', 8),
(20, '2018_04_04_090147_create_cities_table', 9),
(21, '2018_04_04_091705_create_venues_table', 10),
(22, '2018_04_05_093513_drop_events_table', 11),
(23, '2018_04_05_093741_create_events_table', 12),
(24, '2018_04_05_101142_create_organizers_table', 13),
(25, '2018_04_07_184640_create_events_table', 14),
(26, '2018_04_09_153216_create_interventions_table', 15),
(27, '2018_04_11_124150_update-events-options', 16),
(28, '2018_04_13_144904_create_schedules_table', 17),
(29, '2018_04_27_142329_add-intervenant-col-schedules', 18),
(30, '2018_04_27_171108_create_access_types_table', 19),
(31, '2018_04_27_171159_AccessType', 19),
(32, '2018_04_27_172029_droptable-accesstypes', 20),
(33, '2018_04_28_151043_create_comments_table', 21),
(34, '2018_04_28_151239_create_ratings_table', 21),
(35, '2018_04_29_164636_rating-nullable-comments', 22),
(36, '2018_04_30_101617_edit-comments-table', 23),
(37, '2018_04_30_102731_create_attendings_table', 24),
(38, '2018_04_30_103032_edit-attendings', 25),
(39, '2018_04_30_111742_create_checkins_table', 26),
(40, '2018_04_30_120547_edit-attendings-table', 27),
(41, '2018_04_30_121241_edit-attendings-table-2', 28),
(42, '2018_04_30_132208_edit-comments-table', 29),
(43, '2018_05_02_093242_create_campaigns_table', 30),
(44, '2018_05_04_120743_edit-images-table', 31),
(45, '2018_05_07_092523_create_intervenants_table', 32),
(46, '2018_05_07_093314_edit-intervention-table', 33),
(47, '2018_05_07_101148_edit-intervention-table-2', 34);

-- --------------------------------------------------------

--
-- Table structure for table `organizers`
--

CREATE TABLE `organizers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizers`
--

INSERT INTO `organizers` (`id`, `user_id`, `name`, `slug`, `avatar`, `bio`, `email`, `phone`, `website`, `facebook`, `twitter`, `linkedin`, `event_count`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Amine Akhouad', 'amine-akhouad', '', '', 'akhouadme@gmail.com', '', '', '', '', '', 0, 0, '2018-04-04 23:00:00', '2018-04-02 08:24:29', '2018-04-02 08:24:29'),
(2, 4, 'John Doe', 'john-doe', '', '', 'john@doe.com', '', '', '', '', '', 0, 0, '2018-04-10 11:36:54', NULL, NULL),
(4, 13, 'amine akad', 'amine-akad', 'm.png', '', 'akhouad@yahoo.fr', '', '', '', '', '', 0, 0, '2018-04-24 12:38:52', '2018-04-24 11:38:52', '2018-04-24 11:38:52'),
(5, 16, 'amine akad', 'amine-akad', 'm.png', '', 'akhouad@akad.me', '', '', '', '', '', 0, 0, '2018-04-24 17:35:28', '2018-04-24 16:35:28', '2018-04-24 16:35:28'),
(6, 17, 'amine akad', 'amine-akad', 'm.png', '', 'akhouad@akad.me', '', '', '', '', '', 0, 0, '2018-04-24 17:36:32', '2018-04-24 16:36:32', '2018-04-24 16:36:32'),
(7, 18, 'amine akad', 'amine-akad', 'm.png', '', 'akhouad@akad.me', '', '', '', '', '', 0, 0, '2018-04-24 17:43:32', '2018-04-24 16:43:32', '2018-04-24 16:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `rating` double NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `event_id`, `rating`, `ip_address`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 3.5, '127.0.0.1', '2018-04-29 14:28:42', '2018-04-29 14:28:42'),
(3, 1, 22, 4.5, '127.0.0.1', '2018-04-29 15:47:54', '2018-04-29 15:47:54'),
(4, 4, 22, 2.5, '127.0.0.1', '2018-04-29 15:50:35', '2018-04-29 15:50:35'),
(5, 18, 22, 0.5, '127.0.0.1', '2018-04-29 15:53:16', '2018-04-29 15:53:16'),
(6, 1, 22, 4.5, '127.0.0.1', '2018-04-29 18:39:40', '2018-04-29 18:39:40'),
(9, 1, 22, 2.5, '127.0.0.1', '2018-04-30 07:22:08', '2018-04-30 07:22:08'),
(10, 1, 22, 2, '127.0.0.1', '2018-04-30 12:52:56', '2018-04-30 12:52:56'),
(11, 1, 2, 3.5, '127.0.0.1', '2018-05-09 14:26:06', '2018-05-09 14:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `intervenant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `event_id`, `title`, `time`, `description`, `deleted_at`, `created_at`, `updated_at`, `intervenant`) VALUES
(2, 2, 'Presentation', '2018-04-28 00:24:02', 'Presentation de l\'evenement', NULL, '2018-04-25 14:01:10', '2018-04-25 14:01:10', 9),
(3, 2, 'bienvenue', '2018-04-28 00:33:30', NULL, NULL, '2018-04-25 15:52:52', '2018-04-25 15:52:52', 2),
(4, 2, 'bienvenue', '2018-05-01 15:38:07', NULL, '2018-05-01 14:38:07', '2018-04-25 15:52:52', '2018-05-01 14:38:07', 9),
(5, 2, 'petit dejeuner', '2018-04-30 09:34:29', NULL, '2018-04-30 08:34:29', '2018-04-30 07:32:30', '2018-04-30 08:34:29', NULL),
(6, 22, 'petit dejeuner', '2018-04-30 09:44:35', NULL, '2018-04-30 08:44:35', '2018-04-30 08:42:38', '2018-04-30 08:44:35', NULL),
(7, 22, 'presentation', '2018-04-30 09:47:18', NULL, '2018-04-30 08:47:18', '2018-04-30 08:46:31', '2018-04-30 08:47:18', NULL),
(8, 22, 'Presentation', '2018-04-29 08:00:00', NULL, NULL, '2018-04-30 08:47:29', '2018-04-30 08:47:29', 2),
(9, 2, 'petit dejeuner', '2018-04-30 09:55:54', NULL, '2018-04-30 08:55:54', '2018-04-30 08:55:50', '2018-04-30 08:55:54', NULL),
(10, 2, 'petit dejeuner', '2018-04-30 15:26:04', NULL, '2018-04-30 14:26:04', '2018-04-30 08:56:07', '2018-04-30 14:26:04', 2),
(11, 2, 'speaker 1', '2018-04-30 15:25:59', 'talking about AI', '2018-04-30 14:25:59', '2018-04-30 08:56:48', '2018-04-30 14:25:59', 4),
(12, 22, 'Speaker 1', '2018-04-29 09:00:00', 'talking about anything', NULL, '2018-04-30 08:57:33', '2018-04-30 08:57:33', 7),
(13, 22, 'dejeuner', '2018-04-30 13:29:18', NULL, '2018-04-30 12:29:18', '2018-04-30 08:57:54', '2018-04-30 12:29:18', NULL),
(14, 2, 'test', '2018-04-30 14:40:05', NULL, '2018-04-30 13:40:05', '2018-04-30 13:39:56', '2018-04-30 13:40:05', NULL),
(15, 2, 'petit dejeuner', '2018-04-26 07:00:00', NULL, NULL, '2018-05-01 14:38:39', '2018-05-01 14:38:39', 7),
(16, 22, 'petit dejeuner', '2018-04-27 07:00:00', NULL, '2018-05-02 12:23:53', '2018-05-02 12:23:46', '2018-05-02 12:23:53', 4),
(17, 3, 'presentation', '2018-04-12 07:00:00', NULL, NULL, '2018-05-02 12:38:37', '2018-05-02 12:38:37', 1),
(18, 3, 'remise des prix', '2018-04-24 17:00:00', 'remise des prix des gagnants des competitions', NULL, '2018-05-02 12:39:03', '2018-05-02 12:39:03', NULL),
(19, 22, 'presentation', '2018-04-27 07:00:00', 'tsst', NULL, '2018-05-02 14:22:57', '2018-05-02 14:22:57', 4),
(20, 24, 'presentation', '2018-05-09 07:00:00', NULL, NULL, '2018-05-08 09:32:55', '2018-05-08 09:32:55', NULL),
(21, 25, 'Presentation des equipes', '2018-05-08 07:00:00', NULL, NULL, '2018-05-08 12:07:12', '2018-05-08 12:07:12', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'jazz', '2018-04-03 08:49:18', '2018-04-03 08:49:18'),
(2, 'blues', '2018-04-03 08:49:18', '2018-04-03 08:49:18'),
(3, 'rock', '2018-04-03 08:49:18', '2018-04-03 08:49:18'),
(4, 'book', '2018-04-03 09:58:21', '2018-04-03 09:58:21'),
(5, 'red', '2018-04-03 09:58:21', '2018-04-03 09:58:21'),
(6, 'rap', '2018-04-03 09:58:21', '2018-04-03 09:58:21'),
(7, 'mwa', '2018-04-03 10:06:48', '2018-04-03 10:06:48'),
(8, 'agadir', '2018-04-03 10:06:48', '2018-04-03 10:06:48'),
(9, 'web', '2018-04-03 10:06:48', '2018-04-03 10:06:48'),
(10, 'root', '2018-04-03 10:13:37', '2018-04-03 10:13:37'),
(11, 'talents', '2018-04-03 10:43:16', '2018-04-03 10:43:16'),
(12, 'talent', '2018-04-03 10:43:16', '2018-04-03 10:43:16'),
(13, 'fun', '2018-04-03 10:43:16', '2018-04-03 10:43:16'),
(14, 'maroc', '2018-04-03 12:36:32', '2018-04-03 12:36:32'),
(15, 'awards', '2018-04-03 12:36:32', '2018-04-03 12:36:32'),
(16, '2018', '2018-04-03 13:28:10', '2018-04-03 13:28:10'),
(17, 'timitar', '2018-04-04 12:47:06', '2018-04-04 12:47:06'),
(18, 'musiques', '2018-04-04 12:47:06', '2018-04-04 12:47:06'),
(19, 'art', '2018-04-04 12:47:06', '2018-04-04 12:47:06'),
(20, 'musique', '2018-04-04 13:57:55', '2018-04-04 13:57:55'),
(21, 'dcheira', '2018-04-04 14:16:47', '2018-04-04 14:16:47'),
(22, '2020', '2018-04-04 14:16:47', '2018-04-04 14:16:47'),
(23, 'test', '2018-04-04 14:21:58', '2018-04-04 14:21:58'),
(24, '', '2018-04-05 09:48:57', '2018-04-05 09:48:57'),
(25, 'du', '2018-04-05 10:54:05', '2018-04-05 10:54:05'),
(26, 'monde', '2018-04-05 10:54:05', '2018-04-05 10:54:05'),
(27, 'musics', '2018-04-05 11:01:35', '2018-04-05 11:01:35'),
(28, 'amine', '2018-04-05 11:04:34', '2018-04-05 11:04:34'),
(29, 'akhouad', '2018-04-05 11:04:34', '2018-04-05 11:04:34'),
(30, 'tags', '2018-04-05 11:04:34', '2018-04-05 11:04:34'),
(31, 'john', '2018-04-10 10:37:00', '2018-04-10 10:37:00'),
(32, 'doe', '2018-04-10 10:37:00', '2018-04-10 10:37:00'),
(33, 'maroc web awards', '2018-04-11 09:26:33', '2018-04-11 09:26:33'),
(34, 'world', '2018-04-13 10:36:40', '2018-04-13 10:36:40'),
(35, 'cup', '2018-04-13 10:36:40', '2018-04-13 10:36:40'),
(36, 'football', '2018-04-13 10:36:40', '2018-04-13 10:36:40'),
(37, 'mawazine', '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(38, 'festival', '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(39, 'stars', '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(40, 'rabat', '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(41, '2019', '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(42, 'casablanca', '2018-05-08 09:29:16', '2018-05-08 09:29:16'),
(43, 'nations unies', '2018-05-08 09:29:16', '2018-05-08 09:29:16'),
(44, 'sport', '2018-05-08 12:06:49', '2018-05-08 12:06:49'),
(45, 'coupe du monde', '2018-05-08 12:06:49', '2018-05-08 12:06:49'),
(46, 'morocco', '2018-05-10 21:04:52', '2018-05-10 21:04:52'),
(47, '2026', '2018-05-10 21:04:52', '2018-05-10 21:04:52'),
(48, 'gnaoua', '2018-05-11 08:58:35', '2018-05-11 08:58:35'),
(49, 'essaouira', '2018-05-11 08:58:35', '2018-05-11 08:58:35'),
(50, 'sahara', '2018-05-11 13:28:52', '2018-05-11 13:28:52'),
(51, 'merzouga', '2018-05-11 13:28:52', '2018-05-11 13:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(246, 'Atelier & Stage', 'atelier-stage', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(247, 'Colloque', 'colloque', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(248, 'Concert', 'concert', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(249, 'Conférence internationale', 'conference-internationale', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(250, 'Conférence & Débat', 'conference-debat', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(251, 'Congrès', 'congres', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(252, 'Contes', 'contes', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(253, 'Débat', 'debat', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(254, 'Défilé de mode', 'defile-de-mode', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(255, 'Exposition', 'exposition', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(256, 'Festival', 'festival', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(257, 'Fête traditionnelle', 'fete-traditionnelle', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(258, 'Lecture', 'lecture', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(259, 'Manifestation', 'manifestation', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(260, 'Marché', 'marche', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(261, 'Projection & Film', 'projection-film', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(262, 'Rencontre & Réunion', 'rencontre-reunion', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(263, 'Représentation', 'representation', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(264, 'Salon & Foire', 'salon-foire', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(265, 'Séminaire', 'seminaire', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(266, 'Signature', 'signature', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(267, 'Tournée', 'tournee', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(268, 'Tournoi', 'tournoi', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(269, 'Fête du personnel', 'fete-du-personnel', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(270, 'Portes ouvertes', 'portes-ouvertes', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(271, 'Conférence de presse', 'conference-de-presse', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(272, 'Inauguration', 'inauguration', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(273, 'Commémoration', 'commemoration', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(274, 'Brocantes & Vide-greniers', 'brocantes-vide-greniers', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(275, 'Café-théâtre', 'cafe-theatre', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(276, 'Littérature', 'litterature', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(277, 'Forum', 'forum', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(278, 'One Man Show', 'one-man-show', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(279, 'Performance', 'performance', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(280, 'Poésie - Slam', 'poesie--slam', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(281, 'Improvisation', 'improvisation', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(282, 'Spectacle', 'spectacle', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(283, 'Clubbing', 'clubbing', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(284, 'Formation', 'formation', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(285, 'Vente de matériel d\'occasion', 'vente-de-materiel-d\'occasion', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(286, 'Excursion et Sortie de groupe', 'excursion-et-sortie-de-groupe', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(287, 'Bénévolat', 'benevolat', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(288, 'Casting', 'casting', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(289, 'Pièce de théâtre', 'piece-de-theatre', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(290, 'Portes ouvertes', 'portes-ouvertes', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(291, 'Compétition', 'competition', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(292, 'Soirée', 'soiree', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(293, 'Cérémonie', 'ceremonie', '2018-04-02 12:55:43', '2018-04-02 12:55:43'),
(294, 'Autre', 'autre', '2018-04-02 12:55:43', '2018-04-02 12:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `facebook_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_access_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirm_email_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_organizer` int(11) NOT NULL,
  `is_certified_organizer` int(11) NOT NULL,
  `is_speaker` int(11) NOT NULL,
  `is_admin` int(11) NOT NULL,
  `verified` int(11) NOT NULL,
  `disabled` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `fullname`, `password`, `avatar`, `phone`, `city_id`, `facebook_id`, `facebook_access_token`, `confirm_email_token`, `access_token`, `is_organizer`, `is_certified_organizer`, `is_speaker`, `is_admin`, `verified`, `disabled`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'akhouadme@gmail.com', 'Amine Akhouad', '$2y$10$xXTfE8T0OmliBBaLariCN.vgWA5Ngw4BiZLKo0xzXLjGZhlWNLh8a', 'a.png', '', 1, '', '', '', '', 1, 0, 0, 1, 0, 0, 'sxp1q6cRunrBw9j9lj1ojloC49BFdKHqQEZq9TkW3vviHwGQfDb7uFQTOvTt', '2018-04-02 08:24:29', '2018-05-08 12:07:32'),
(2, 'amine', 'agadirgroup123@gmail.com', 'amine akhouad 2', '$2y$10$xXTfE8T0OmliBBaLariCN.vgWA5Ngw4BiZLKo0xzXLjGZhlWNLh8a', 'a.png', '', 1, '', '', '', '', 0, 0, 1, 0, 0, 0, '6I8Y0KOMiDZEjHpwdW04IbelmyDC2cdya5Bndpi2KYIXD6fN4pZar0VrT0Bu', '2018-04-02 08:24:29', '2018-05-10 22:37:30'),
(4, 'john', 'john@doe.com', 'john doe', '$2y$10$xXTfE8T0OmliBBaLariCN.vgWA5Ngw4BiZLKo0xzXLjGZhlWNLh8a', 'j.png', '', 1, '', '', '', '', 1, 0, 0, 0, 0, 0, 'P0DIUEoLYSLqiJkS7HNy8iTu4YzbLLLpwJJSwweH0xyUZPAKTCajjtGuQcNj', '2018-04-10 09:06:38', '2018-05-11 07:15:38'),
(5, 'samy', 'samy@akhouad.com', 'samy akhouad', '$2y$10$xXTfE8T0OmliBBaLariCN.vgWA5Ngw4BiZLKo0xzXLjGZhlWNLh8a', 's.png', '', 1, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-04-10 09:16:35', '2018-04-10 09:16:35'),
(6, 'alan', 'alan@turin.com', 'alan turin', '$2y$10$xXTfE8T0OmliBBaLariCN.vgWA5Ngw4BiZLKo0xzXLjGZhlWNLh8a', 'a.png', '', 1, '', '', '', '', 0, 0, 1, 0, 0, 0, NULL, '2018-04-10 09:47:19', '2018-05-07 12:21:04'),
(7, 'med', 'med@baladi.com', 'med amine baladi', '$2y$10$xXTfE8T0OmliBBaLariCN.vgWA5Ngw4BiZLKo0xzXLjGZhlWNLh8a', 'm.png', '', 1, '', '', '', '', 0, 0, 1, 0, 0, 0, NULL, '2018-04-10 09:55:26', '2018-05-07 12:21:05'),
(8, 'elon', 'elon@musk.com', 'elon musk', '', 'e.png', '', 1, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-04-10 13:27:01', '2018-04-10 13:27:01'),
(10, 'mehdi', 'mehdi@doe.com', 'mehdi', '', 'm.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-04-11 08:40:09', '2018-04-11 08:40:09'),
(11, 'souah', 'souah@gmail.com', 'marouane souah', '', 'm.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-04-11 10:23:06', '2018-05-10 22:51:04'),
(18, 'akadme', 'akhouad@akad.me', 'amine akad', '$2y$10$YdtyIr.Iqh4.ZxeTLl2TOu/p/U5zGtApZLUVOK3k1XJRcHf3rijEC', 'a.png', '', 1, '', '', '', '', 1, 0, 1, 0, 0, 0, 'C3lw0w3MaDyYSWgkrBZnOQa0WkvR76oRt5AThAcrlCFzWRlwBbWM6MnuZPDT', '2018-04-24 16:43:32', '2018-05-07 13:42:29'),
(19, 'karim', 'karim@ahmadi.com', 'karim ahmadi', '$2y$10$YdtyIr.Iqh4.ZxeTLl2TOu/p/U5zGtApZLUVOK3k1XJRcHf3rijEC', 'k.png', '', 1, '', '', '', '', 0, 0, 1, 0, 0, 0, 'ogvNm5XQy7dprV7B4aWdJ9DLV3YB8bCcdaRaYGWCkGGOcaFRtfjdZYAzBxZz', '2018-05-03 16:31:34', '2018-05-11 07:48:57'),
(21, 'mehdi_19', 'mehdi@benatia.com', 'mehdi benatia', '', 'm.png', '', 0, '', '', '', '', 0, 0, 1, 0, 0, 0, NULL, '2018-05-07 10:52:22', '2018-05-07 12:21:18'),
(22, 'badr_21', 'badr@banoun.com', 'badr banoun', '', 'b.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-07 10:56:45', '2018-05-07 10:56:45'),
(23, 'mbark_22', 'mbark@boussofa.com', 'mbark boussofa', '', 'm.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-07 10:58:05', '2018-05-07 10:58:05'),
(24, 'hucine_23', 'hucine@hotmail.com', 'hucine akhouad', '', 'h.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-07 10:58:17', '2018-05-07 10:58:17'),
(25, 'aicha_24', 'aicha@radi.com', 'aicha radi', '', 'a.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-07 10:58:31', '2018-05-07 10:58:31'),
(30, 'younes_25', 'younes@adounis.com', 'younes adounis', '', 'U2dfcI7X8NO8tbnLFVcf9sWY9o2iREUIcu95sYEG.png', '', 0, '', '', '', '', 0, 0, 1, 0, 0, 0, NULL, '2018-05-07 11:11:16', '2018-05-07 12:21:18'),
(31, 'yahya_30', 'yahya@kharrazi.com', 'yahya kharrazi', '', 'aXnCmtpz9MKN9VhV1sRNu8CfKhWw893v5giraxKL.jpeg', '', 0, '', '', '', '', 0, 0, 1, 0, 0, 0, NULL, '2018-05-07 11:48:34', '2018-05-07 12:21:12'),
(32, 'youness_31', 'youness@qassimi.com', 'younes qassimi', '', 'rqBcq4LS65I4w5B9rIQRgw2DN0LuBx9dOITIDkT0.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-08 12:55:26', '2018-05-08 12:55:26'),
(53, 'karim_32', 'karim@elhani.com', 'karim elhani', '', 'k.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-10 23:37:17', '2018-05-10 23:47:23'),
(54, 'reda_53', 'reda@elkhayat.com', 'reda elkhayat', '', 'r.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-10 23:37:37', '2018-05-10 23:37:37'),
(55, 'david_54', 'david@bekham.com', 'david bekham', '', 'd.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-10 23:47:58', '2018-05-10 23:47:58'),
(56, 'leo_55', 'leo@messi.com', 'leo messi', '', 'yZcUkR3TGVFXNyH0se3ERLbe6kdrvPCtY2vXLabN.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-10 23:49:06', '2018-05-11 07:16:17'),
(57, 'mouna_56', 'mouna@naim.com', 'mouna naim', '', 'm.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-11 07:15:47', '2018-05-11 07:15:47'),
(75, 'rachid_57', 'rachid@elouali.com', 'rachid elouali', '', 'r.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-11 07:41:08', '2018-05-11 07:45:51'),
(76, 'jack_75', 'jack@twitter.com', 'jack dorsey', '', 'j.png', '', 0, '', '', '', '', 0, 0, 1, 0, 0, 0, NULL, '2018-05-11 07:41:34', '2018-05-11 07:46:27'),
(77, 'zuck_76', 'zuck@facebook.com', 'mark zuckerberg', '', 'z.png', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, NULL, '2018-05-11 07:42:57', '2018-05-11 07:45:49'),
(78, 'houston', 'houston@dropbox.com', 'andrew houston', '', 'h.png', '', 0, '', '', '', '', 0, 0, 1, 0, 0, 0, NULL, '2018-05-11 07:43:47', '2018-05-11 07:43:47'),
(80, 'houston_79', 'houston@email.com', 'drew houston', '', 'h.png', '', 0, '', '', '', '', 0, 0, 1, 0, 0, 0, NULL, '2018-05-11 07:45:18', '2018-05-11 07:45:41'),
(81, 'jack', 'jack@dorsey.com', 'jack dorsey 2', '', 'j.png', '', 0, '', '', '', '', 0, 0, 1, 0, 0, 0, NULL, '2018-05-11 07:46:07', '2018-05-11 07:46:07'),
(82, 'amine_82', 'amine@kamal.com', 'amine kamal', '', 'a.png', '', 0, '', '', '', '', 0, 0, 1, 0, 0, 0, NULL, '2018-05-11 14:07:45', '2018-05-11 14:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `foursquare_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `name`, `slug`, `description`, `adress_1`, `adress_2`, `city_id`, `phone`, `lat`, `lng`, `foursquare_id`, `created_at`, `updated_at`) VALUES
(1, 'place amal', 'place-amal', 'description amaal', '80000', '', 1, '', 30.4192102, -9.6055992, 0, '2018-04-03 23:00:00', '2018-04-03 23:00:00'),
(3, 'ait melloul', 'ait-melloul', '', '81000', '', 1, '', 30.32358719900238, -9.421701562499948, 0, '2018-04-04 13:57:55', '2018-04-04 13:57:55'),
(4, 'dcheira', 'dcheira', '', '86360', '', 1, '', 29.873588057878884, -9.465646874999948, 0, '2018-04-04 14:16:47', '2018-04-04 14:16:47'),
(5, 'inezgane', 'inezgane', '', '80000', '', 1, '', 30.122105729943264, -9.297982012500029, 0, '2018-04-04 14:21:58', '2018-04-04 14:21:58'),
(6, 'soussi', 'soussi', '', '10000', '', 68, '', 33.97201980595889, -6.828928124999948, 0, '2018-05-08 09:21:56', '2018-05-08 09:21:56'),
(7, 'place les nations unies', 'place-les-nations-unies', '', '30000', '', 26, '', 33.56704249148308, -7.575998437499948, 0, '2018-05-08 09:29:16', '2018-05-08 09:29:16'),
(8, 'agdal', 'agdal', '', '10000', '', 68, '', 34.00845630635372, -6.433420312499948, 0, '2018-05-08 12:00:20', '2018-05-08 12:00:20'),
(9, 'prince', 'prince', '', '30000', '', 26, '', 33.49377751207116, -7.619943749999948, 0, '2018-05-08 12:20:17', '2018-05-08 12:20:17'),
(10, 'sqala', 'sqala', '', '22000', '', 74, '', 31.079590142611472, -9.817209374999948, 0, '2018-05-11 08:58:35', '2018-05-11 08:58:35'),
(11, 'somewhere', 'somewhere', '', '99000', '', 104, '', 30.853205493669684, -8.367014062499948, 0, '2018-05-11 13:26:12', '2018-05-11 13:26:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_types`
--
ALTER TABLE `access_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendings`
--
ALTER TABLE `attendings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkins`
--
ALTER TABLE `checkins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_options`
--
ALTER TABLE `events_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_tags`
--
ALTER TABLE `event_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intervenants`
--
ALTER TABLE `intervenants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interventions`
--
ALTER TABLE `interventions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizers`
--
ALTER TABLE `organizers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_types`
--
ALTER TABLE `access_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendings`
--
ALTER TABLE `attendings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `checkins`
--
ALTER TABLE `checkins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `events_options`
--
ALTER TABLE `events_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `event_tags`
--
ALTER TABLE `event_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `intervenants`
--
ALTER TABLE `intervenants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `interventions`
--
ALTER TABLE `interventions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `organizers`
--
ALTER TABLE `organizers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;