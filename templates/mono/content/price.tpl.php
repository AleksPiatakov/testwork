<?php
//  require('price_settings.php');
// the following cPath references come from application_top.php
$category_depth = 'top';
if (isset($cPath) && tep_not_null($cPath)) {
    $categories_products_query = tep_db_query(
        "select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'"
    );
    $cateqories_products = tep_db_fetch_array($categories_products_query);
    if ($cateqories_products['total'] > 0) {
        $category_depth = 'products'; // display products
    } else {
        $category_parent_query = tep_db_query(
            "select count(*) as total from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$current_category_id . "'"
        );
        $category_parent = tep_db_fetch_array($category_parent_query);
        if ($category_parent['total'] > 0) {
            $category_depth = 'nested'; // navigate through the categories
        } else {
            $category_depth = 'products'; // category has no products, but display the 'no products' message
        }
    }
}
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);
$breadcrumb->add(TITLE_PRICE, tep_href_link("price.php", '', 'SSL'));
?>

<?php
// Set number of columns in listing
define('NR_COLUMNS', 2); ?>

<!-- body //-->
<?php
// group have products?
function check_products($id_group)
{
    $products_price_query = tep_db_query(
        "select products_to_categories.products_id FROM products_to_categories where products_to_categories.categories_id = " . $id_group . " LIMIT 0,1"
    );
    if (tep_db_fetch_array($products_price_query)) {
        return true;
    }
    return false;
}

// list products determined group $id_group
function get_products($id_group, $position)
{
    global $currencies;
    global $languages_id;

    $query = "";
//  if(!SHOW_MARKED_OUT_STOCK){
    $query = " and products.products_status = '1'";
//  }
    if (USED_QUANTITY) {
        $query = $query . " and products.products_quantity <> 0";
    }
    $products_price_query = tep_db_query(
        "select products_description.products_name, products.products_quantity, products.products_price, products.products_model, products_to_categories.products_id, products_to_categories.categories_id FROM products, products_description, products_to_categories where products.products_id = products_description.products_id" . $query . " and products.products_id = products_to_categories.products_id and products_to_categories.categories_id = " . $id_group . " and products_description.language_id = " . $languages_id
    );
    $x = 0;
    while ($products_price = tep_db_fetch_array($products_price_query)) {
        if ($x == 1) {
            $col = "";
            $x = 0;
        } else {
            $col = "";
            $x++;
        }
        $cell = tep_get_products_special_price($products_price['products_id']);
        if ($cell == 0) {
            $cell = $products_price['products_price'];

            // BOF FlyOpenair: Extra Product Price
            $cell = extra_product_price($cell);
            // EOF FlyOpenair: Extra Product Price
        } else {
            $col = "#FFEAEA";
        }
        $quantity = "";
        $str = "";
        for ($i = 0; $i < $position; $i++) {
            $str = $str . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        print "<tr class=\"boxText2\" bgcolor=\"" . $col . "\"><td width=\"80%\" class=\"boxText2\">" . $str . "<a href=\"" . tep_href_link(
            FILENAME_PRODUCT_INFO,
            "products_id=" . $products_price['products_id']
        ) . "\">" . $products_price['products_name'] . "</a></td><td width=\"20%\" align=\"right\" class=\"boxText2\">" . $currencies->display_price(
            $cell,
            TAX_INCREASE
        ) . "&nbsp;</td></tr>";
    }
}

// get all groups recursively
function tep_get_category_tree3($cat_tree, $category_str = '', $spacing = '')
{
    global $cat_names;

    if ($cat_tree) {
        foreach ($cat_tree as $cid => $cname) {
            $category_str .= '<tr><td colspan="2" class="boxText3">' . $spacing . '<a class=productlisting-headingPrice href="' . tep_href_link(
                FILENAME_DEFAULT,
                'cPath=' . $cid,
                'NONSSL'
            ) . '">' . $cat_names[$cid] . '</a></td></tr>';
            if (is_array($cname)) {
                $spacing .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $category_str = tep_get_category_tree3($cname, $category_str, $spacing);
                //$category_str .=get_products($groups_price['categories_id'],$position+1);
                $spacing = '';
            }
        }
        return $category_str;
    }
    return false;
}

function get_articles($a_id)
{
    $art_array = getArticles($a_id, 999);
    if (is_array($art_array)) {
        foreach ($art_array as $articles) {
            echo '<tr><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . $articles['link'] . '">' . $articles['name'] . '</a></td></tr>';
        }
    }
}

?>

<h1><?php echo FOOTER_SITEMAP; ?></h1>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="price_table">
    <tr>
        <td colspan="2" class="boxText3"><b><?php echo TEXT_HEADING_PRICE ?></b></td>
    </tr>
    <?php echo tep_get_category_tree3($cat_tree); ?>

    <tr>
        <td colspan="2" class="boxText3"><b><?php echo FOOTER_INFO; ?></b></td>
    </tr>
    <?php get_articles(16); ?>

    <tr>
        <td colspan="2" class="boxText3"><b><?php echo MAIN_NEWS; ?></b></td>
    </tr>
    <?php get_articles(14); ?>

    <tr>
        <td colspan="2" class="boxText3"><b><?php echo FOOTER_ARTICLES; ?></b></td>
    </tr>
    <?php get_articles(13); ?>
</table>
