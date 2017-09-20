--
-- Database: `hackerearth`
--

-- --------------------------------------------------------

--
-- Table structure for table `hackerearth_outputs`
--

CREATE TABLE `hackerearth_outputs` (
  `id` int(10) UNSIGNED NOT NULL,
  `code_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `async` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `compile_status` text COLLATE utf8mb4_unicode_ci,
  `time_used` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `memory_used` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `output` text COLLATE utf8mb4_unicode_ci,
  `output_html` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_details` text COLLATE utf8mb4_unicode_ci,
  `stderr` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
