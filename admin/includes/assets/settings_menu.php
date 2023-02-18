
<?php
$languages = tep_get_languages();
$languages_array = array();
$languages_selected = DEFAULT_LANGUAGE;

for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
        'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
        $languages_selected = $languages[$i]['code'];
    }
}
?>

<div class="settings_menu">
    <div class="settings_menu-top">
        <div class="settings_menu-left">
            <span class="img_block img_remove"><img src="images/new_images_admin-panel/icons/trash-icon.svg"></span>
            <span class="img_block img_copy"><img src="images/new_images_admin-panel/icons/copy-icon.svg"></span>
            <span class="img_block img_move"><img src="images/new_images_admin-panel/icons/move-icon.svg"></span>

            <span class="img_block img_visible"><img src="images/new_images_admin-panel/icons/visible-icon.svg"></span>
            <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
        </div>
        <div class="settings_menu-right">
            <span class="img_block img_edit"><img src="images/new_images_admin-panel/icons/edit-icon.svg"></span>
            <span class="img_block img_link"><img src="images/new_images_admin-panel/icons/open-link.svg"></span>
        </div>
    </div>
    <div class="settings_menu-middle">
        <input class="cat_adjustment border_rad_left" type="text" placeholder="Наз.Продукта">
        <select class="border_rad_right" name="language" id="settings_menu-lang">
            <?php

            $url_parts = parse_url($_SERVER['REQUEST_URI']);
            $url_path = $url_parts['path'];
            $url_query = preg_replace('#&?language=[^&]*&?#is', '', $url_parts['query']);

            if (strlen($url_query) > 0) {
                $url_query .= '&language=';
            } else {
                $url_query = 'language=';
            }

            $language_url = $url_path . '?' . $url_query;
            foreach ($languages_array as $_language) {?>
                <option>
                    <a href="<?php print $language_url . $_language['id']; ?>"><?php print $_language['text']; ?></a>
                </option>
            <?php }?>
        </select>

        <div class="price_discount">
            <span class="price_adjustment col_adj">
                <input type="text" value="$535.00">
                Price
            </span>
            <span class="discount_adjustment col_adj">
                <span>
                    <input class="border_rad_left" type="text" value="$481.50">
                    <input class="percents border_rad_right" type="text" value="10%">
                </span>
                Discount
            </span>
        </div>
        <div class="model_sort">
            <span class="model_adjustment">
                <input type="text" value="FH43-85HF-38SK-059F">
                Product model <a href="#">Randomize</a>
            </span>
            <span class="sort_adjustment col_adj">
                <input type="text" value="14#">
                Sort
            </span>
        </div>
        <div class="common_parameters">
            <span class="weight_adjustment col_adj">
                <input type="text" value="1.2lb">
                Weight
            </span>
            <span class="quantity_adjustment col_adj">
                <input type="text" value="124">
                Quantity
            </span>
            <span class="min_step">
                <span class="min_adjustment col_adj">
                    <input class="border_rad_left" type="text" value="1">
                    Min
                </span>
                <span class="step_adjustment col_adj">
                    <input class="border_rad_right" type="text" value="3">
                    Step
                </span>
            </span>
        </div>
    </div>
    <div class="settings_menu-bottom">
        <label><span class="span_label_1">Free Shipping</span><input class="label_1" type="checkbox"></label>
        <label><span class="span_label_2">Discount</span><input class="label_2" type="checkbox"></label>
        <label><span class="span_label_3">Top</span><input class="label_3" type="checkbox"></label>
        <label><span class="span_label_4">New</span><input class="label_4" type="checkbox"></label>
    </div>
</div>