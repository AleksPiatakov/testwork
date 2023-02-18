ALTER TABLE `categories`
        ADD `vendor_template` varchar(255) COLLATE 'utf8mb4_general_ci' NULL,
        ADD `id_sys_category` int(11) NULL AFTER `vendor_template`;

ALTER TABLE categories
    ADD UNIQUE (id_sys_category);

ALTER TABLE `categories_description`
        ADD `vendor_template` varchar(255) COLLATE 'utf8mb4_general_ci' NULL,
        ADD `id_sys_category` int(11) NULL AFTER `vendor_template`;

ALTER TABLE `products`
        ADD `vendor_template` varchar(255) NULL;

ALTER TABLE `products_options`
        ADD `categories_id` int(11) NOT NULL;
