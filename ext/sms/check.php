<?php

if (!defined('TELEGRAM_NOTIFICATIONS_ENABLED')) {
    tep_db_query("INSERT INTO configuration ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ( 'Telegram notifications status', 'TELEGRAM_NOTIFICATIONS_ENABLED', 'false', '', 902, 0, NULL, NOW(), NULL, NULL);");
}
if (!defined('TELEGRAM_TOKEN')) {
    tep_db_query("INSERT INTO configuration ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ( 'TELEGRAM_TOKEN', 'TELEGRAM_TOKEN', '----', '', 902, 0, NULL, NOW(), NULL, NULL);");
}
