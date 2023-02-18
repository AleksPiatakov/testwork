CREATE TABLE `products_video` (
                                  `products_video_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                  `products_id` int NOT NULL,
                                  `video_url` varchar(255) NOT NULL,
                                  `video_preview` varchar(255) NOT NULL,
                                  `sort_order` int NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;