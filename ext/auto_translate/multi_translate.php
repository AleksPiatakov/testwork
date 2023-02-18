<?php

require_once('translate.php');
require_once('functions.php');
define('PROCESS_JSON_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'process.json');

class MultiTranslate
{

    /**
     * @param string $id
     * @return bool|mysqli_result
     */
    public function getProductsSql($id = '')
    {
        $sqlProducts = "
            SELECT products_id,
                   language_id,
                   products_name,
                   products_info,
                   products_description,
                   products_head_title_tag,
                   products_head_desc_tag,
                   products_head_keywords_tag
            FROM " . TABLE_PRODUCTS_DESCRIPTION;
        if ($id) {
            $sqlProducts .= " WHERE products_id = '$id'";
        }
        return tep_db_query($sqlProducts);
    }

    /**
     * @return bool|mysqli_result
     */
    public function getCategoriesSql()
    {
        $sqlCategories = "
            SELECT categories_id,
                   language_id,
                   categories_name,
                   categories_description,
                   categories_heading_title,
                   categories_meta_title,
                   categories_meta_description,
                   categories_meta_keywords
            FROM " . TABLE_CATEGORIES_DESCRIPTION;
        return tep_db_query($sqlCategories);
    }

    /**
     * @return bool|mysqli_result
     */
    public function getProductsOptionsSql()
    {
        $sqlProductsOptions = "
            SELECT products_options_id,
                   language_id,
                   products_options_name,
                   products_options_sort_order,
                   products_options_type,
                   products_options_length
            FROM " . TABLE_PRODUCTS_OPTIONS;
        return tep_db_query($sqlProductsOptions);
    }

    /**
     * @return bool|mixed|mysqli_result
     */
    public function getManufacturersInfoSql()
    {
        $sqlManufacturersSql = "
            SELECT manufacturers_id,
                   languages_id as language_id,
                   manufacturers_url,
                   manufacturers_name,
                   h1_manufacturer,
                   seo_text_top
            FROM " . TABLE_MANUFACTURERS_INFO;
        return tep_db_query($sqlManufacturersSql);
    }

    /**
     * @return bool|mixed|mysqli_result
     */
    public function getManufacturersMetaTags()
    {
        $sqlManufacturersSql = "
            SELECT manufacturers_id,
                   language_id,
                   keywords,
                   description,
                   title
            FROM " . TABLE_METATAGS;
        return tep_db_query($sqlManufacturersSql);
    }

    /**
     * @return bool|mysqli_result
     */
    public function getProductsOptionsValuesSql()
    {
        $sqlProductsOptionsValues = "
            SELECT products_options_values_id,
                   language_id,
                   products_options_values_name
            FROM " . TABLE_PRODUCTS_OPTIONS_VALUES;
        return tep_db_query($sqlProductsOptionsValues);
    }

    public function getArticlesSql()
    {
        $sql = "
            SELECT articles_id,
                   language_id,
                   articles_name,
                   articles_description,
                   articles_head_title_tag,
                   articles_head_desc_tag,
                   articles_head_keywords_tag
            FROM " . TABLE_ARTICLES_DESCRIPTION;
        return tep_db_query($sql);
    }

    /**
     * @param $sql
     * @param string $what
     * @param string $table
     * @throws Exception
     */
    public function translate($sql, $what = 'products', $table = TABLE_PRODUCTS_DESCRIPTION)
    {
        $defaultLanguageId = tep_get_languages_id($_POST['default_language']);
        $translateLanguageId = isset($_POST['translate_language']) ? tep_get_languages_id($_POST['translate_language']) : '';

        $products = [];
        while ($product = tep_db_fetch_array($sql)) {
            $products[$product[$what . '_id']][$product['language_id']] = array_slice($product, 2);
        }

        $languages = tep_get_languages();
        if ($translateLanguageId) {
            foreach ($languages as $language) {
                if ($language['id'] == $translateLanguageId) {
                    $languages = [];
                    $languages[] = $language;
                    break;
                }
            }
        }

        $fields = [];
        $i = 0;
        $productsCount = count($products);
        foreach ($products as $productId => $product) {
            foreach ($languages as $language) {
                if ($language['id'] == $defaultLanguageId) {
                    continue;
                }
                if (!isset($product[$language['id']])) {
                    $fields[$what . '_id'] = $productId;
                    if ($table === TABLE_MANUFACTURERS_INFO) {
                        $fields['languages_id'] = $language['id'];
                    } else {
                        $fields['language_id'] = $language['id'];
                    }
                    foreach ($product[$defaultLanguageId] as $fieldName => $fieldValue) {
                        if ($fieldValue !== '' && $this->checkTranslateField($fieldName, $what)) {
                            if (isset($_POST["remove_tags"]) && $_POST["remove_tags"] == 'on') {
                                $fieldValue = strip_tags($fieldValue);
                            }
                            if (isset($_POST["manufacturers_fields"]) && in_array('translate_brand_name', $_POST["manufacturers_fields"]) && $fieldName === 'manufacturers_name') {
                                $fields[$fieldName] = $fieldValue;
                            } else {
                                $fields[$fieldName] = Translate::translate($_POST['default_language'], $language['code'], $fieldValue);
                            }
                        }
                    }
                    tep_db_perform($table, $fields);
                    $fields = [];
                } else {
                    foreach ($product[$language['id']] as $fieldName => $fieldValue) {
                        if (isset($_POST["ignore_existing"]) && $_POST["ignore_existing"] == 'on') {
                            $ignore_existing = true;
                        } else {
                            $ignore_existing = false;
                        }
                        if ($ignore_existing ? true : $fieldValue == '' && $product[$defaultLanguageId][$fieldName] !== '' && $this->checkTranslateField($fieldName, $what)) {
                            if (isset($_POST["remove_tags"]) && $_POST["remove_tags"] == 'on') {
                                $product[$defaultLanguageId][$fieldName] = strip_tags($product[$defaultLanguageId][$fieldName]);
                            }
                            if (isset($_POST["manufacturers_fields"]) && in_array('translate_brand_name', $_POST["manufacturers_fields"]) && $fieldName === 'manufacturers_name') {
                                $fields[$fieldName] = $product[$defaultLanguageId][$fieldName];
                            } else {
                                $fields[$fieldName] = Translate::translate($_POST['default_language'], $language['code'], $product[$defaultLanguageId][$fieldName]);
                            }
                        }
                    }
                    if (!empty($fields)) {
                        if ($table === TABLE_MANUFACTURERS_INFO) {
                            $parameters = $what . "_id = '$productId' and languages_id = '{$language['id']}'";
                        } else {
                            $parameters = $what . "_id = '$productId' and language_id = '{$language['id']}'";
                        }
                        tep_db_perform($table, $fields, 'update', $parameters);
                    }
                    $fields = [];
                }
            }
            $i++;
            $process['translate_progress'] = round($i / $productsCount * 100, 1);
            file_put_contents(PROCESS_JSON_PATH, json_encode($process));
        }
    }

    /**
     * @param $fieldName
     * @param $what
     * @return bool
     */
    private function checkTranslateField($fieldName, $what)
    {
        if (isset($_POST[$what . '_fields'])) {
            if (in_array($fieldName, $_POST[$what . '_fields'])) {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }
}
