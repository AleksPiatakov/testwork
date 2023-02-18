<?php

$hide = tep_hide_session_id();

if (!defined('DISPLAY_POLL_HOW')) {
    $result = tep_db_query("select configuration_key,configuration_value from " . TABLE_PHESIS_POLL_CONFIG);
    while ($key = tep_db_fetch_array($result)) {
        define($key['configuration_key'], $key['configuration_value']);
    }
}

function pollnewest()
{
    global $customer_id, $_GET;

    if (DISPLAY_POLL_HOW == 3) {
        $extra_query = " and pollID='" . DISPLAY_POLL_ID . "'";
    }
    if (!tep_session_is_registered('customer_id')) {
        $extra_query .= " and poll_type='0' ";
    }
    if (DISPLAY_POLL_HOW == 2) {
        $order = 'voters DESC';
    } else {
        $order = 'timestamp DESC';
    }
    if (DISPLAY_POLL_HOW == 0) {
        $order = 'RAND()';
    }

    $query = tep_db_query(
        "select pollid, catID FROM " . TABLE_PHESIS_POLL_DESC . " where poll_open='0'" . $extra_query . "and catID != 0 order by " . $order
    );
    $count = tep_db_num_rows($query);
    $result = tep_db_fetch_array($query);

    $pollid = false;

    if ($count > 0) {
        if ($_GET['cPath']) {
            $mypath = $_GET['cPath'];
        }
        if ($_GET['products_id']) {
            $mypath = tep_get_product_path($_GET['products_id']);
        }
        if ($mypath) {
            $sub_cat_ids = explode("[_]", $mypath);
            foreach ($sub_cat_ids as $sub_cat_id) {
                if ($sub_cat_id == $result['catID']) {
                    $pollid = $result['pollid'];
                }
            }
        }
    }
    $query = tep_db_query(
        "select pollid, catID FROM " . TABLE_PHESIS_POLL_DESC . " where poll_open='0'" . $extra_query . " and catID = 0 order by " . $order
    );
    $count = tep_db_num_rows($query);
    if ((!DISPLAY_POLL_HOW == 0 || $count == 1) && !$pollid) {
        if ($result = tep_db_fetch_array($query)) {
            $pollid = $result['pollid'];
        }
    } elseif (!$pollid && $count) {
        mt_srand((double)microtime() * 1000000);
        $rand = mt_rand(1, $count);
        for ($i = 0; $i < $rand; $i++) {
            $result = tep_db_fetch_array($query);
            $pollid = $result['pollid'];
        }
    }
    return $pollid;
}

if (basename($PHP_SELF) != 'pollbooth.php') {
    $pollid = pollnewest();

    if ($pollid) {
        $poll_query = tep_db_query(
            "select voters from " . TABLE_PHESIS_POLL_DESC . " where pollid=$pollid and poll_open='0'"
        );
        $poll_details = tep_db_fetch_array($poll_query);

        $title_query = tep_db_query(
            "select optionText from " . TABLE_PHESIS_POLL_DATA . " where pollid=$pollid and voteid='0' and language_id = '" . $languages_id . "'"
        );
        $title = tep_db_fetch_array($title_query);

        $url = tep_href_link('pollbooth.php', 'op=results&pollid=' . $pollid);

        //remove language from url
        $url_parts = explode('/', $url);
        if (in_array($url_parts[0], array_keys($lng->languages))) {
            unset($url_parts[0]);
        }
        $url = implode('/', $url_parts);

        $cont = '';

        $cont .= '<input type="hidden" name="pollid" value="' . $pollid . '">';
        $cont .= '<input type="hidden" name="forwarder" value="' . $url . '">';

        $query = tep_db_query(
            "select pollid, optiontext, optioncount, voteid from " . TABLE_PHESIS_POLL_DATA . " where pollid=" . $pollid . " and voteid!=0 and language_id=" . $languages_id
        );
        while ($result = tep_db_fetch_array($query)) {
            if ($result['optiontext']) {
                $cont .= '<input type = "radio" name = "voteid" id="variant_' . $result['voteid'] . '" value = "' . $result['voteid'] . '" />
                <label for="variant_' . $result['voteid'] . '">' . $result['optiontext'] . '</label><br>';
            }
        }

        $cont .= '<button type="submit" name="submit_choice" class="btn btn-default gradient">' . _VOTE . '</button>';

        $query = tep_db_query(
            "select sum(optioncount) as sum from " . TABLE_PHESIS_POLL_DATA . " where pollid=$pollid and language_id=" . $languages_id
        );
        if ($result = tep_db_fetch_array($query)) {
            $sum = $result['sum'];
        }
        $cont .= "<br /><br />" . _VOTES . "<b>" . $sum . "</b>
              
              <a rel='nofollow' href=\"" . tep_href_link(
            'pollbooth.php',
            'op=results&pollid=' . $pollid,
            'NONSSL'
        ) . "\">" . _RESULTS . "</a> / 
              <a rel='nofollow' href=\"" . tep_href_link('pollbooth.php', 'op=list') . "\">" . _POLLS . "</a>";

        echo '<div class="how_know_for_us"><div class="like_h3"><span>' . $title['optionText'] . '</span></div>
           <div class="our_variants">
             <form name="poll" method="post" action="' . tep_href_link('pollcollect.php') . '">
               ' . csrf() . $cont . '
             </form></div></div>';
    } elseif (SHOW_NOPOLL == 1) {
        // echo '<p>'..'</p>';
    }
}
