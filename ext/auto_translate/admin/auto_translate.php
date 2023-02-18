<?php

ini_set('max_execution_time', 0);

require_once(DIR_FS_EXT . 'auto_translate/multi_translate.php');

if (isAjax() && isset($_POST['default_language'])) {
    if (isset($_POST['translate_language']) && $_POST['translate_language'] == $_POST['default_language']) {
        $process = [
            'translate_progress' => 0,
            'msg' => ERROR_LANGUAGES,
            'done' => true
        ];
        file_put_contents(PROCESS_JSON_PATH, json_encode($process));
        die();
    }
    $multiTranslate = new MultiTranslate();
    try {
        $productId = isset($_POST['product_id']) ? $_POST['product_id'] : '';

        $what = isset($_POST['what_translate']) ? $_POST['what_translate'] : 'products';

        switch ($what) {
            case 'categories':
                $sql = $multiTranslate->getCategoriesSql();
                $multiTranslate->translate($sql, $what, TABLE_CATEGORIES_DESCRIPTION);
                break;
            case 'attributes':
                $sql = $multiTranslate->getProductsOptionsSql();
                $multiTranslate->translate($sql, 'products_options', TABLE_PRODUCTS_OPTIONS);
                $sql = $multiTranslate->getProductsOptionsValuesSql();
                $multiTranslate->translate($sql, 'products_options_values', TABLE_PRODUCTS_OPTIONS_VALUES);
                break;
            case 'articles':
                $sql = $multiTranslate->getArticlesSql();
                $multiTranslate->translate($sql, $what, TABLE_ARTICLES_DESCRIPTION);
                break;
            case 'manufacturers':
                $sql = $multiTranslate->getManufacturersInfoSql();
                $multiTranslate->translate($sql, 'manufacturers', TABLE_MANUFACTURERS_INFO);
                $sql = $multiTranslate->getManufacturersMetaTags();
                $multiTranslate->translate($sql, 'manufacturers', TABLE_METATAGS);
                break;
            default:
                $sql = $multiTranslate->getProductsSql($productId);
                $multiTranslate->translate($sql, $what, TABLE_PRODUCTS_DESCRIPTION);
                break;
        }

        if (isset($_POST['product_id'])) {
            $process = [];
            echo json_encode($process);
            die();
        }
        die();
    } catch (Exception $e) {
        if (isset($_POST['product_id'])) {
            $process = [
                'msg' => $e->getMessage(),
                'done' => true
            ];
            echo json_encode($process);
            die();
        } else {
            $process = [
                'translate_progress' => 0,
                'msg' => $e->getMessage(),
                'done' => true
            ];
            file_put_contents(PROCESS_JSON_PATH, json_encode($process));
            die();
        }
    }
}

include_once('html-open.php');
include_once('header.php');

$translateProductsFields = [
    'products_name' => PRODUCT_NAME,
    'products_info' => SHORT_PRODUCT_DESCRIPTION,
    'products_description' => PRODUCT_DESCRIPTION,
    'products_head_title_tag' => 'Meta Title',
    'products_head_desc_tag' => 'Meta Description',
    'products_head_keywords_tag' => 'Meta Keywords',

];

$translateCategoriesFields = [
    'categories_name' => CATEGORIES_NAME,
    'categories_heading_title' => CATEGORIES_NAME_DETAIL,
    'categories_description' => CATEGORIES_DESCRIPTION,
    'categories_meta_title' => 'Meta Title',
    'categories_meta_description' => 'Meta Description',
    'categories_meta_keywords' => 'Meta Keywords',
];

$translateArticlesFields = [
    'articles_name' => ARTICLES_NAME,
    'articles_description' => ARTICLES_DESCRIPTION,
    'articles_head_title_tag' => 'Meta Title',
    'articles_head_desc_tag' => 'Meta Description',
    'articles_head_keywords_tag' => 'Meta Keywords',
];

$translateManufacturersFields = [
    'manufacturers_name' => getConstantValue('MANUFACTURERS_NAME', 'Manufacturers name'),
    'manufacturers_url' => getConstantValue('MANUFACTURERS_DESC', 'Manufacturers description'),
    'keywords' => getConstantValue('MANUFACTURERS_META_KEYWORDS', 'Manufacturers meta keywords'),
    'description' => getConstantValue('MANUFACTURERS_META_DESC', 'Manufacturers meta description'),
    'title' => getConstantValue('MANUFACTURERS_META_TITLE', 'Manufacturers meta title'),
    'h1_manufacturer' => getConstantValue('MANUFACTURERS_H1', 'H1 manufacturers'),
    'seo_text_top' => getConstantValue('MANUFACTURERS_SEO_TEXT_TOP_BLOCK', 'Seo text top block'),
];

?>
    <link rel="stylesheet" href="../ext/auto_translate/auto_translate.css">
    <script src="../ext/auto_translate/auto_translate.js"></script>
    <div id="tabs-attr" class="tabs-lang">
        <ul class="nav nav-tabs" id="attributes">
            <li class="">
                <a href="<?= tep_href_link(FILENAME_LANGUAGES) ?>"><?= BOX_LOCALIZATION_LANGUAGES ?></a>
            </li>
            <li class="">
                <a href="<?= tep_href_link(FILENAME_LANGUAGES_TRANSLATER,
                    'file=' . $language . '.json') ?>"><?= TEXT_TRANSLATER_TITLE ?></a>
            </li>
            <li class="active">
                <a href="<?= tep_href_link(FILENAME_AUTO_TRANSLATE) ?>"
                    <?= (getConstantValue('AUTO_TRANSLATE_MODULE_ENABLED') == 'true') ? '' : 'style="pointer-events: none;"' ?>>
                    <?= AUTO_TRANSLATE_MODULE_ENABLED_TITLE ?>
                </a>
            </li>
        </ul>
    </div>
    <div class="multi-translate">
        <form method="post" id="translate-products">
            <div class='progress' id="progressDivId">
                <div class='progress-bar' id='progressBar'>
                    <div class='percent' id='percent'>0%</div>
                </div>
            </div>
            <label for="default_language"><?= TRANSLATE_FROM ?></label>
            <select name="default_language">
                <?php foreach ($languages as $_language) { ?>
                    <option value="<?= $_language['code'] ?>">
                        <?= $_language['name'] ?> <b class="caret"></b>
                    </option>
                <?php } ?>
            </select>
            <label for="translate_language"><?= TRANSLATE_TO ?></label>
            <select name="translate_language">
                <?php foreach ($languages as $_language) { ?>
                    <option value="<?= $_language['code'] ?>">
                        <?= $_language['name'] ?> <b class="caret"></b>
                    </option>
                <?php } ?>
            </select>
            <br>
            <br>
            <label>
                <input type="checkbox" name="remove_tags">
                <?= REMOVE_TAGS; ?>
            </label>
            <br>
            <label class="hidden">
                <input type="checkbox" name="ignore_existing">
                <?= IGNORE_EXISTING; ?>
            </label>
            <br>
            <br>
            <label>
                <input type="radio" name="what_translate" value="products" required checked>
                <?= TRANSLATE_PRODUCTS ?>
            </label>
            <br>
            <label>
                <input type="radio" name="what_translate" value="categories">
                <?= TRANSLATE_CATEGORIES ?>
            </label>
            <br>
            <label>
                <input type="radio" name="what_translate" value="attributes">
                <?= TRANSLATE_ATTRIBUTES ?>
            </label>
            <br>
            <label>
                <input type="radio" name="what_translate" value="articles">
                <?= TRANSLATE_ARTICLES ?>
            </label>
            <br>
            <label>
                <input type="radio" name="what_translate" value="manufacturers">
                <?= TRANSLATE_MANUFACTURERS; ?>
            </label>
            <br>
            <br>
            <div class="products fields">
                <?php foreach ($translateProductsFields as $value => $label) { ?>
                    <input type="checkbox" name="product_fields[]" value="<?= $value ?>" id="<?= $value ?>">
                    <label for="<?= $value ?>"><?= $label ?></label>
                    <br>
                <?php } ?>
            </div>
            <div class="categories fields" style="display: none;">
                <?php foreach ($translateCategoriesFields as $value => $label) { ?>
                    <input type="checkbox" name="categories_fields[]" value="<?= $value ?>" id="<?= $value ?>">
                    <label for="<?= $value ?>"><?= $label ?></label>
                    <br>
                <?php } ?>
            </div>
            <div class="articles fields" style="display: none;">
                <?php foreach ($translateArticlesFields as $value => $label) { ?>
                    <input type="checkbox" name="articles_fields[]" value="<?= $value ?>" id="<?= $value ?>">
                    <label for="<?= $value ?>"><?= $label ?></label>
                    <br>
                <?php } ?>
            </div>
            <div class="manufacturers fields" style="display: none;">
                <input type="checkbox" name="manufacturers_fields[]" value="translate_brand_name" id="translate_brand_name" checked>
                <label for="translate_brand_name"><?= TRANSLATE_BRAND_NAME; ?></label>
                <br>
                <?php foreach ($translateManufacturersFields as $value => $label) : ?>
                    <input type="checkbox" name="manufacturers_fields[]" value="<?= $value ?>" id="<?= $value ?>">
                    <label for="<?= $value ?>"><?= $label ?></label>
                    <br>
                <?php endforeach; ?>
            </div>
            <br>
            <br>
            <button id="translate" class="btn btn-info" type="submit"><?= BUTTON_TRANSLATE ?></button>
        </form>
    </div>

<?php require('footer.php');
require('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
