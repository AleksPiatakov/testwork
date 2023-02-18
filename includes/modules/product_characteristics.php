<?php
$pags = array();
//нулевая группа для тех, кто не в группе
$pags[] = ['pag_id' => 0, 'pag_name' => '', 'sort_order' => 0, 'attributes' => []];
$product_attr_groups_query = tep_db_query("select pag_id, pag_name, sort_order from products_attributes_groups where language_id = '" . (int)$languages_id . "' ORDER BY sort_order ASC");
while ($product_attr_groups = tep_db_fetch_array($product_attr_groups_query)) {
    $pags[$product_attr_groups['pag_id']] = [
        'pag_id' => $product_attr_groups['pag_id'],
        'pag_name' => $product_attr_groups['pag_name'],
        'sort_order' => $product_attr_groups['sort_order'],
        'attributes' => []
    ];
}
if (!empty($product_attributes)) {
    $attr_string = '<div>';
    $tmp_pag = 0;

    foreach ($product_attributes as $at_id => $at_vals) {
        // replace values IDs to NAMES
        foreach ($at_vals as $k => $at_val_id) {
            $at_vals[$k] = $products_options_array[$at_id][$at_val_id]['text'];
        }

        $pag_id = $pa_id2names[$at_id]['pag'] ?: 0;
        $pags[$pag_id]['attributes'][] = ['name' => $pa_id2names[$at_id]['name'], 'value' => implode(', ', $at_vals)];

    }
    foreach ($pags as $pag) {
        if (!empty($pag['attributes'])) {
            echo '<div class="pag">';
            if (!empty($pag['pag_name'])) {
                echo '<div class="pag_header">' . $pag['pag_name'] . '</div>';
            }
            foreach ($pag['attributes'] as $attribute) {
                echo '<div class="char">';
                echo '  <div class="char-left"><span>' . $attribute['name'] . '</span></div>';
                echo '  <div class="char-right">' . $attribute['value'] . '</div>';
                echo '  <div class="clearfix"></div>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
}