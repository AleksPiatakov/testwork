ALTER TABLE `products` ADD `id_sys_product` VARCHAR(255) NOT NULL AFTER `edited_for_seo`;
UPDATE `products` SET `id_sys_product`=`products_model`;