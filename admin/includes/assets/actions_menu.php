
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

<div class="actions_menu">
    <div class="actions_menu-top">
        <div class="actions_menu-move">
            <span class="img_block img_remove"><img src="images/new_images_admin-panel/icons/trash-icon.svg"></span>
            <span class="img_block img_copy"><img src="images/new_images_admin-panel/icons/copy-icon.svg"></span>
            <span class="img_block img_move"><img src="images/new_images_admin-panel/icons/move-icon.svg"></span>
            <span class="img_block img_visible"><img src="images/new_images_admin-panel/icons/visible-icon.svg"></span>
            <span class="img_block img_hidden"><img src="images/new_images_admin-panel/icons/invisible-icon.svg"></span>
        </div>
        <span class="img_block img_link"><img src="images/new_images_admin-panel/icons/open-link.svg"></span>

    </div>
    <div class="actions_menu-bottom">
        <input type="text" placeholder="наз.кат=>редактируем">
        <select name="language" id="actions_menu-lang">
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
    </div>
</div>