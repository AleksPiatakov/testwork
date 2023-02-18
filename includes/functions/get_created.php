<?php

/**
 * @return bool|string
 */
function get_created()
{
    $res = true;
    if (getenv('APP_ENV') == 'demo') {
        $res = false;
    }

    if (empty($dateTo = getenv('TRIAL_END_DATE'))) {
        $res = false;
    } else {
        if ($dateTo < strtotime("now")) {
            $res = false;
        } else {
            $res = date("Y-m-d", $dateTo);
        }
    }

    return $res;
}
