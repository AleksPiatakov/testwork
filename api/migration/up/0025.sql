CREATE TABLE `products_stock` (
  `products_stock_id` int NOT NULL,
  `products_id` int NOT NULL DEFAULT '0',
  `products_stock_attributes` varchar(255) CHARACTER SET utf8mb4 COLLATE 'utf8mb4_general_ci' NOT NULL DEFAULT '',
  `products_stock_quantity` int NOT NULL DEFAULT '0',
  `products_vendor_code` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE 'utf8mb4_general_ci' NOT NULL DEFAULT ''
);
ALTER TABLE `products_stock`
  ADD PRIMARY KEY (`products_stock_id`),
  ADD UNIQUE KEY `idx_products_stock_attributes` (`products_id`,`products_stock_attributes`);
ALTER TABLE `products_stock` MODIFY `products_stock_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;