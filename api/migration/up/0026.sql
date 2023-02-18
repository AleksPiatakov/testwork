ALTER TABLE `products_stock` ADD `products_combination_price` FLOAT(15,4) NOT NULL DEFAULT '0.0000' AFTER `products_stock_quantity`;
UPDATE `products_options` SET `products_options_type`='3' WHERE `products_options_type`='4';
ALTER TABLE `products_attributes` ADD `pa_article` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' AFTER `pa_qty`;