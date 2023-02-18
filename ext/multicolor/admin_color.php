<?php

//$color_id = MULTICOLOR_NAME;

$attributes_query = tep_db_query("SELECT `pov`.`products_options_values_id`, `pov`.`products_options_values_name` FROM " . TABLE_PRODUCTS_ATTRIBUTES . " `pa`, " . TABLE_PRODUCTS_OPTIONS_VALUES . " `pov`, " . TABLE_PRODUCTS_OPTIONS . " popt WHERE `pa`.`products_id` = '" . (int)$_GET['pID'] . "' AND pa.options_id = popt.products_options_id AND popt.products_options_type = 3 AND pa.options_values_id = pov.products_options_values_id AND pov.language_id = '" . (int)$languages_id . "' AND popt.language_id = '" . (int)$languages_id . "' ORDER BY pov.products_options_values_sort_order");
while ($attributes = tep_db_fetch_array($attributes_query)) {
    echo TEXT_PROD_COLOR . ': <b>' . $attributes['products_options_values_name'] . '</b>:
	          <div id="dropbox_' . $attributes['products_options_values_id'] . '" class="dropbox">
						  <span class="message"><i>' . TEXT_PROD_IMGS_DRAG . '</i></span>
						</div>';
}
