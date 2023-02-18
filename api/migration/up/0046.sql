ALTER TABLE `products`
    ADD COLUMN `is_download_product` tinyint(1) NULL DEFAULT '0';
CREATE TABLE `products_to_download` (
`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
`products_id` int NOT NULL,
`products_file` varchar(120) NOT NULL,
`sort_order` int NOT NULL default 0
) ENGINE='MyISAM' COLLATE 'utf8mb4_general_ci';