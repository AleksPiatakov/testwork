<?php
//  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {


//    $select_box = '<div class="dropdown currency-dropdown" onchange="this.form.submit();">';
//    $select_box .= '<button type="button" class="currency-dropdown-button" name="currency" data-toggle="dropdown">
//                      ' . $currency . ' <span class="caret"></span>
//                    </button>';
//    reset($currencies->currencies);
//
//    $select_box .= '<ul class="dropdown-menu dropdown-menu-currency" role="menu">';
//    while (list($key, $value) = each($currencies->currencies)) {
//        $select_box .= '<li><label for="currency_id_' . $key . '"><input type="radio" value="' . $key . '" id="currency_id_' . $key . '">';
//        $select_box .= $value['title'] . ' </label></li>';
//    }
//    $select_box .= "</ul>";
//    $select_box .= tep_hide_session_id();
//    $select_box .= '</div>';


// starts
//    $select_box = '<span>' . BOX_HEADING_CURRENCY . ':</span>';
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
// ends


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

if (count($currencies->currencies) > 1) {
    echo '<nav class="currency_select">
              <form name="currencies" id="form1" method="get" action="' . tep_href_link(
        basename($PHP_SELF),
        tep_get_all_get_params(array('currency')),
        $connection,
        false
    ) . '">
                ' .  $select_box . '
              </form>
            </nav>';
}
