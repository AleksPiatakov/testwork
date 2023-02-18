ALTER TABLE `categories`    ADD `categories_robots_status`      TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' AFTER `categories_status`;
ALTER TABLE `products`      ADD `products_robots_status`        TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' AFTER `products_status`;
ALTER TABLE `articles`      ADD `articles_robots_status`        TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' AFTER `articles_status`;
ALTER TABLE `topics`        ADD `robots_status`                 TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' AFTER `show_in_sitemap`;
ALTER TABLE `manufacturers` ADD `manufacturers_robots_status`   TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' AFTER `manufacturers_seo_url`;