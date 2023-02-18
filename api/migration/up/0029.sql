ALTER TABLE orders_products_attributes ADD products_options_id INT(11) NOT NULL DEFAULT '0' AFTER price_prefix;
ALTER TABLE orders_products_attributes ADD products_options_values_id INT(11) NOT NULL DEFAULT '0' AFTER products_options;
