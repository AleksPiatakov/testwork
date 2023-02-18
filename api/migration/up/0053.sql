CREATE TABLE `temp_customer_data` (
  `id` int NOT NULL,
  `token` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `json_data` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `data_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;