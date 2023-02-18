<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_STRICT);
require('includes/application_top.php');
require(DIR_WS_LANGUAGES . $language . '/categories.php');
require('includes/functions/newsdesk_general.php');

use admin\includes\solomono\app\models\categories\categories;
use admin\includes\solomono\app\models\categories\products;

$allowed_image_types = ['image/jpeg', 'image/gif', 'image/png', 'image/webp'];
require('includes/newcategories/functions.php');
$categories = new categories();
$products = new products();
if (isset($_GET['ajax_load']) && $_GET['ajax_load'] === 'show') {
    $products->query($_GET);
    $products->data['allowed_fields']['products_sort_order']['class'] = "align_center";
    echo json_encode($products->data);
    exit;
}

require('includes/newcategories/ajax_query.php');
$get_categories = $categories->setTree();
include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang =<?= $products->getTranslation();?>;
    </script>
    <div class="new-categories-page hbox hbox-auto-xs hbox-auto-sm">
        <div class="col w-lg bg-light dk b-r bg-auto" id="aside">
            <div class="wrapper bg">
                <h3 class="m-n font-thin">
                    <?= HEADING_CATEGORY; ?>
                </h3>
<!--                <svg class="plus fa-plus-circle new_product_button" width="44px" role="img"-->
                <svg class="plus fa-plus-circle new_categories_button" width="44px" role="img"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="#58666e"
                          d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"
                          class="">
                    </path>
                </svg>
            </div>
            <div class="wrapper no_padding">
                <ul id="categories">
                    <li>
                        <a data-category="all" href="<?= $_SERVER['PHP_SELF'] ?>"><?= TEXT_ALL ?></a>
                    </li>
                    <?= getTree($get_categories, $catProductCounter_ready) ?>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="wrapper wrapper_767">
                <?= $products->getView('newcategories/products') ?>
            </div>
        </div>
    </div>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
