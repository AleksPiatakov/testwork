<?php

$select_box = '<select name="currency" onChange="this.form.submit();">';
reset($currencies->currencies);
foreach ($currencies->currencies as $key => $value) {
    $select_box .= '<option value="' . $key . '"';
// $currency is a session variable
    if ($currency == $key) {
        $select_box .= ' SELECTED';
    }
    $select_box .= '>' . $value['title'] . '</option>';
}
$select_box .= "</select>";
$select_box .= tep_hide_session_id();

$hidden_get_variables = '';
reset($_GET);
foreach ($_GET as $key => $value) {
    if (($key != 'currency') && ($key != tep_session_name())) {
        //   $hidden_get_variables .= tep_draw_hidden_field($key, $value);
    }
}

if (getenv('HTTPS') == 'on') {
    $connection = 'SSL';
} else {
    $connection = 'NONSSL';
}

$select_box .= $hidden_get_variables;

echo '<nav class="currency_select">
          <form name="currencies" method="get" action="' . tep_href_link(
    basename($PHP_SELF),
    tep_get_all_get_params(array('currency')),
    $connection,
    false
) . '">
            ' . $select_box . '
          </form>
        </nav>';

//}
