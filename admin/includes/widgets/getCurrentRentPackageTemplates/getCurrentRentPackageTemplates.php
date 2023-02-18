<?php

use App\Logger\Log;

//use functions
if (!function_exists('env')) {
    chdir('../../../../');
    require_once 'includes/application_top.php';
}

//if is rent site functionality type
$isRent = env('APP_ENV') == 'rent';
if ($isRent) {
    $query = tep_db_query("SELECT * FROM " . TABLE_TEMPLATE . " WHERE rent_status = 1");
    //if it is time to refresh
    if (defined('NEXT_TEMPLATES_REFRESH_TIME') && (((int)constant('NEXT_TEMPLATES_REFRESH_TIME')) < time())) {
        //set default active template before request to api
        if (getConstantValue('DEFAULT_TEMPLATE')) {
            tep_db_query("UPDATE " . TABLE_TEMPLATE . " SET rent_status = 1 WHERE template_name = '" . getConstantValue('DEFAULT_TEMPLATE') . "'");
        }

        //collect data for request to api
        $sitename = env('APP_NAME');
        $secret = 89635123215498;
        $domen = 'https://solomono.net';
        $url = $domen . '/api/get_templates_by_rent_package.php?secret=' . $secret;
        $data = array('site_name' => $sitename);

        //do request to api
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        //get api answer
        $context = stream_context_create($options);
        $results = file_get_contents($url, false, $context);

        //check api answer
        if ($results === false) {
            Log::error('Ошибка запроса к api при попытке обновления списка доступных шаблонов. Сайт: ' . $sitename);
        } else {
            tep_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = " . strtotime("+10 days") . " WHERE configuration_key = 'NEXT_TEMPLATES_REFRESH_TIME'");

            //check that api answer is compatible
            $activeTemplates = json_decode($results);
            if (is_array($activeTemplates) && !empty($activeTemplates)) {
                //match landing and demo template codes
                foreach ($activeTemplates as $key => $activeTemplateCode) {
                    if ($activeTemplateCode == 'demo') {
                        $activeTemplates[$key] = 'default';
                        break;
                    }
                }
                //use api answer
                $query = tep_db_query("SELECT * FROM " . TABLE_TEMPLATE . " WHERE template_status = 1");
                while ($row = tep_db_fetch_array($query)) {
                    $rentStatus = in_array($row['template_name'], $activeTemplates) ? 1 : 0;
                    tep_db_query("UPDATE " . TABLE_TEMPLATE . " SET rent_status = " . $rentStatus . " WHERE template_name = '" . $row['template_name'] . "'");
                }
            }
        }
    }elseif(!defined('NEXT_TEMPLATES_REFRESH_TIME')){
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_required_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function, depends_on, configuration_subgroup_id, callback_func)
                    VALUES ('Время следующего обновления активных шаблонов арендованного сайта', 'NEXT_TEMPLATES_REFRESH_TIME', '0', 'true', 'Время следующего обновления активных шаблонов арендованного сайта', '225566', '2', '2022-09-06 00:00:00', '2022-09-06 00:00:00', '', '', '', '0', '');");
    }
}
