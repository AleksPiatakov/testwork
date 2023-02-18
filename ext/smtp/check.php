<?php

if (!defined('SMTP_MODULE_ENABLED')) {
    tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`, `depends_on`, `configuration_subgroup_id`,`callback_func`) VALUES ('SMTP status', 'SMTP_MODULE_ENABLED', 'false', 'SMTP status', 277, 0, NULL, now(), NULL, NULL, '', 0,'check_SMTP');");
}
if (!defined('SMTP_USERNAME')) {
    tep_db_query("INSERT INTO configuration ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ( 'SMTP username', 'SMTP_USERNAME', '', 'SMTP username', 17, 0, NULL, NOW(), NULL, NULL);");
}
if (!defined('SMTP_PASSWORD')) {
    tep_db_query("INSERT INTO configuration ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ( 'SMTP Password', 'SMTP_PASSWORD', '', 'SMTP password', 17, 0, NULL, NOW(), NULL, NULL);");
}
if (!defined('SMTP_HOST')) {
    tep_db_query("INSERT INTO configuration ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ( 'SMTP HOST', 'SMTP_HOST', '', 'SMTP HOST', 17, 0, NULL, NOW(), NULL, NULL);");
}
if (!defined('SMTP_PORT')) {
    tep_db_query("INSERT INTO configuration ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ( 'SMTP PORT', 'SMTP_PORT', '587', 'SMTP PORT', 17, 0, NULL, NOW(), NULL, NULL);");
}
if (!defined('SMTP_SECURITY')) {
    tep_db_query("INSERT INTO configuration ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ( 'SMTP SECURITY', 'SMTP_SECURITY', 'tls', 'SMTP SECURITY', 17, 0, NULL, NOW(), NULL, NULL);");
}
