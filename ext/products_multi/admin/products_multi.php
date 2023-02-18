<?php
//copy
//copy all products to target category
function copyMultipleProducts($productsIds, $targetCategoriesId)
{
    $newProductsId = false;
    if (is_array($productsIds)) {
        foreach ($productsIds as $productsId) {
            //collect product`s data by product`s id
            $productQuery = tep_db_query('select * from ' . TABLE_PRODUCTS . ' where products_id = ' . (int)$productsId);
            $productData = tep_db_fetch_array($productQuery);
            //unset old product id from dataset
            $productData['products_id'] = '';
            //create copy of product with new product`s id
            tep_db_perform(TABLE_PRODUCTS, $productData);

            //get new product`s id
            $newProductsId = tep_db_insert_id();

            //copy product`s attributes from old to new product`s id
            tep_copy_products_attributes($productsId, $newProductsId);

            //get description data by product`s id on each language
            $descriptionQuery = tep_db_query("select * from  " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = " . (int)$productsId);
            //create copy of product`s description on each language
            while ($descriptionData = tep_db_fetch_array($descriptionQuery)) {
                //unset old product id from dataset
                $descriptionData['products_id'] = $newProductsId;
                //copy product`s description from old to new product`s id
                tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $descriptionData);
            }

            //create link "new product to target category"
            tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$newProductsId . "', '" . (int)$targetCategoriesId . "')");

            //set new images for new product
            if (!empty($productData['products_image'])) {
                $newImagesList = tep_rename_images($productData['products_image'], ';');
            } else {
                $newImagesList = '';
            }
            tep_db_query("update " . TABLE_PRODUCTS . " set products_image ='" . $newImagesList . "' where products_id=" . (int)$newProductsId);
        }
    }
    //return last new product id
    return $newProductsId;
}
//copy data of sourceCategoriesId as child into newParentCategoriesId
function duplicateCategory($sourceCategoriesId, $newParentCategoriesId)
{
    //collect category`s data by category`s id
    $categoryQuery = tep_db_query('select * from ' . TABLE_CATEGORIES . ' where categories_id = ' . (int)$sourceCategoriesId);
    $categoryData = tep_db_fetch_array($categoryQuery);
    //unset old category`s id from dataset
    $categoryData['categories_id'] = '';
    //set id of new parent category in dataset
    $categoryData['parent_id'] = $newParentCategoriesId;
    //create copy of category with new category`s id
    tep_db_perform(TABLE_CATEGORIES, $categoryData);

    //get new category`s id
    $newCategoriesId = tep_db_insert_id();

    //get description data by category`s id on each language
    $descriptionQuery = tep_db_query("select * from  " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = " . (int)$sourceCategoriesId);
    //create copy of category`s description on each language
    while ($descriptionData = tep_db_fetch_array($descriptionQuery)) {
        //unset old category id from dataset
        $descriptionData['categories_id'] = $newCategoriesId;
        //copy category`s description from old to new category`s id
        tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $descriptionData);
    }

    //set new images and icons for new category
    if (!empty($categoryData['categories_image'])) {
        $newImagesList = tep_rename_images($categoryData['categories_image'], ';');
    } else {
        $newImagesList = '';
    }
    if (!empty($categoryData['categories_icon'])) {
        $newIconsList = tep_rename_images($categoryData['categories_icon'], ';');
    } else {
        $newIconsList = '';
    }
    tep_db_query("update " . TABLE_CATEGORIES . " set categories_image ='" . $newImagesList . "', categories_icon ='" . $newIconsList . "' where categories_id=" . (int)$newCategoriesId);

    return $newCategoriesId;
}
//copy all chosen categories and their child categories (with inner products for each of them) to target category
function copyMultipleCategories($treeOfChosenCategoriesAndSubcategories, $targetCategoriesId)
{
    global $productsInCategory;
    if (is_array($treeOfChosenCategoriesAndSubcategories)) {
        $categoriesIds = array_keys($treeOfChosenCategoriesAndSubcategories);
        foreach ($categoriesIds as $categoriesId) {
            //copy category
            $newCategoriesId = duplicateCategory($categoriesId, $targetCategoriesId);

            //chose products array from chosen category id
            $productsIds = $productsInCategory[$categoriesId];
            //copy all products of chosen categories and their child-categories.
            copyMultipleProducts($productsIds, $newCategoriesId);

            //chose subcategories tree from chosen category id
            $treeOfSubCategories = $treeOfChosenCategoriesAndSubcategories[$categoriesId];
            //copy all sub..categories of chosen categories and their child-categories.
            copyMultipleCategories($treeOfSubCategories, $newCategoriesId);
        }
    }
}

//link
//create links for all chosen products to target category
function copyLinksOfMultipleProducts($productsIds, $targetCategoriesId)
{
    global $current_category_id, $messageStack;

    if (is_array($productsIds)) {
        foreach ($productsIds as $productsId) {
            if ($_REQUEST['categories_id'] != $current_category_id) {
                //check that product isn`t in target category
                if (!isProductInCategory($productsId, $targetCategoriesId)) {
                    //create link "product to target category"
                    tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$productsId . "', '" . (int)$targetCategoriesId . "')");
                }
            } else {
                $messageStack->add_session(ERROR_CANNOT_LINK_TO_SAME_CATEGORY, 'error');
            }
        }
    }
}
//create links for all chosen categories and their child categories (with inner products for each of them) to target category
function copyLinksOfMultipleCategories($treeOfChosenCategoriesAndSubcategories, $targetCategoriesId)
{
    global $productsInCategory;
    if (is_array($treeOfChosenCategoriesAndSubcategories)) {
        $categoriesIds = array_keys($treeOfChosenCategoriesAndSubcategories);
        foreach ($categoriesIds as $categoriesId) {
            //copy category
            //collect category`s data by category`s id
            $categoryQuery = tep_db_query('select * from ' . TABLE_CATEGORIES . ' where categories_id = ' . (int)$categoriesId);
            $categoryData = tep_db_fetch_array($categoryQuery);
            //unset old category`s id from dataset
            $categoryData['categories_id'] = '';
            //set id of new parent category in dataset
            $categoryData['parent_id'] = $targetCategoriesId;
            //create copy of category with new category`s id
            tep_db_perform(TABLE_CATEGORIES, $categoryData);

            //get new category`s id
            $newCategoriesId = tep_db_insert_id();

            //get description data by category`s id on each language
            $descriptionQuery = tep_db_query("select * from  " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = " . (int)$categoriesId);
            //create copy of category`s description on each language
            while ($descriptionData = tep_db_fetch_array($descriptionQuery)) {
                //unset old category id from dataset
                $descriptionData['categories_id'] = $newCategoriesId;
                //copy category`s description from old to new category`s id
                tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $descriptionData);
            }

            //chose products array from chosen category id
            $productsIds = $productsInCategory[$categoriesId];
            //copy all products of chosen categories and their child-categories.
            copyLinksOfMultipleProducts($productsIds, $newCategoriesId);

            //chose subcategories tree from chosen category id
            $treeOfSubCategories = $treeOfChosenCategoriesAndSubcategories[$categoriesId];
            //copy all sub..categories of chosen categories and their child-categories.
            copyLinksOfMultipleCategories($treeOfSubCategories, $newCategoriesId);
        }
    }
}

//move
//update category id to new(target) category in links for all chosen products
function moveMultipleProducts($productsIds, $targetCategoriesId)
{
    global $current_category_id;

    if (is_array($productsIds)) {
        foreach ($productsIds as $productsId) {
            //check that product isn`t in target category
            if (!isProductInCategory($productsId, $targetCategoriesId)) {
                //replace category id to new(target) in link "product to target category"
                tep_db_query("update " . TABLE_PRODUCTS_TO_CATEGORIES . " 
                set categories_id = " . (int)$targetCategoriesId . "
                where products_id = " . (int)$productsId . "
                and categories_id = " . (int)$current_category_id);
            }
        }
    }
}
//move all chosen categories and their child categories (with inner products for each of them) to target category
function moveMultipleCategories($chooseCategoriesIds, $targetCategoriesId)
{
    global $cat_tree, $current_category_id;
    if (is_array($chooseCategoriesIds)) {
        $targetCategoriesTree = check_subcategories($cat_tree, $targetCategoriesId);
        $targetCategories = is_array($targetCategoriesTree) ? array_keys($targetCategoriesTree) : [];
        foreach ($chooseCategoriesIds as $categoriesId) {
            //check is category in category
            if (!in_array($categoriesId, $targetCategories)) {
                //replace category id to new(target) in link "product to target category"
                tep_db_query("update " . TABLE_CATEGORIES . " 
                set parent_id = " . (int)$targetCategoriesId . "
                where categories_id = " . (int)$categoriesId . "
                and parent_id = " . (int)$current_category_id);
            }
        }
    }
}

//delete
//remove links (or remove product at all) for all chosen products
//according on delete action type and check "is product in other categories"
function deleteMultipleProducts($productsIds, $targetCategoriesId, $deleteType)
{
    global $prodToCatLinks, $productsInCategory;
    $affectedCategoriesToCheck = [];
    if (is_array($productsIds)) {
        foreach ($productsIds as $productsId) {
            if ($deleteType == 'this_cat' && isProductInAnotherCategory($productsId, $targetCategoriesId)) {
                //remove link to this category
                tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . "
                                    where products_id = '" . $productsId . "'
                                    and categories_id = '" . $targetCategoriesId . "'");

                //collect all affected categories
                $affectedCategoriesToCheck[] = $targetCategoriesId;
            } else {
                //remove product totally
                tep_remove_product($productsId);

                //collect all affected categories from links of each product
                $affectedCategoriesToCheck = (array)$prodToCatLinks[$productsId];
            }

            //remove deleted product for all affected categories in dynamic variables
            foreach ($affectedCategoriesToCheck as $affectedCategoryId) {
                unset($productsInCategory[$affectedCategoryId][$productsId]);
                unset($prodToCatLinks[$productsId][$affectedCategoryId]);
            }

        }
    }
    return $affectedCategoriesToCheck;
}
//remove category from this category (or remove category from all) for all chosen categories
function deleteMultipleCategories($treeOfChosenCategoriesAndSubcategories, $deleteType)
{
    global $productsInCategory;
    $affectedCategoriesToCheck = [];
    if (is_array($treeOfChosenCategoriesAndSubcategories)) {
        $categoriesIds = array_keys($treeOfChosenCategoriesAndSubcategories);
        foreach ($categoriesIds as $categoriesId) {
            //delete category
            tep_remove_category($categoriesId);

            //chose products array from chosen category id
            $productsIds = $productsInCategory[$categoriesId];
            //delete links for all products of chosen categories (and their child-categories)
            //if product has not links anymore(or $deleteType = complete) - delete product at all.
            $affectedCategoriesToCheck = array_merge($affectedCategoriesToCheck, (array)deleteMultipleProducts($productsIds, $categoriesId, $deleteType));

            //chose subcategories tree from chosen category id
            $treeOfSubCategories = $treeOfChosenCategoriesAndSubcategories[$categoriesId];
            //delete all sub..categories of chosen categories (and their child-categories)
            deleteMultipleCategories($treeOfSubCategories, $deleteType);
        }

        //remove empty affected categories
        foreach ($affectedCategoriesToCheck as $affectedCategoryId) {
            //check that affected category is empty and did not delete early
            if (empty($productsInCategory[$affectedCategoryId]) && !in_array($affectedCategoryId, $categoriesIds)) {
                tep_remove_category($affectedCategoryId);
            }
        }
    }
}

require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();
$cat_stat = 0; // internal use -- 0 = no / 1 = yes
$action = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
if (tep_not_null($action)) {
    //collect data
    global $current_category_id;
    $targetCategoriesId = tep_db_prepare_input($_REQUEST['categories_id']);
    $chooseCategoriesIds = $_REQUEST['choose_categories'] ?: [];
    $chooseProductsIds = $_REQUEST['choose'] ?: [];
    $lastProductsId = array_key_last($chooseProductsIds);
    $deleteType = $_REQUEST['del_art'] ?: [];
    //actions
    switch ($action) {
        case 'setflag':
            //set flag
            if (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) {
                if (isset($_GET['pID'])) {
                    tep_set_product_status($_GET['pID'], $_GET['flag']);
                }
            }

            //redirect
            tep_redirect(tep_href_link(FILENAME_PRODUCTS_MULTI, 'cPath=' . $cPath . '&pID=' . $_GET['pID']));
            break;
        case 'delete_product_confirm':
            //collect tree of subcategories from categories in $chooseCategoriesIds
            $treeOfChosenCategoriesAndSubcategories = getTreeOfSubcategoriesFromMultipleCategories($chooseCategoriesIds);

            //copy all chosen categories and their child categories (with inner products for each of them) to target category(recursively)
            deleteMultipleCategories($treeOfChosenCategoriesAndSubcategories, $deleteType);

            //delete multiple products
            deleteMultipleProducts($chooseProductsIds, $current_category_id, $deleteType);

            //reset cache
            resetCacheForCategories();

            //redirect
            tep_redirect(tep_href_link(FILENAME_PRODUCTS_MULTI, 'cPath=' . $cPath));
            break;
        case 'move_product_confirm':
            //move all chosen categories and their child categories (with inner products for each of them) to target category
            moveMultipleCategories($chooseCategoriesIds, $targetCategoriesId);

            //move all chosen products to target category
            moveMultipleProducts($chooseProductsIds, $targetCategoriesId);

            //reset cache
            resetCacheForCategories();

            //redirect
            tep_redirect(tep_href_link(FILENAME_PRODUCTS_MULTI, 'cPath=' . $targetCategoriesId . '&pID=' . $lastProductsId));
            break;
        case 'link_to_confirm':
            //collect tree of subcategories from categories in $chooseCategoriesIds
            $treeOfChosenCategoriesAndSubcategories = getTreeOfSubcategoriesFromMultipleCategories($chooseCategoriesIds);

            //can not create links for categories
            //so create new(target) category and put in it links to products from source category.(recursively)
            copyLinksOfMultipleCategories($treeOfChosenCategoriesAndSubcategories, $targetCategoriesId);

            //create links for all chosen products to target category
            copyLinksOfMultipleProducts($chooseProductsIds, $targetCategoriesId);

            //reset cache
            resetCacheForCategories();

            //redirect
            tep_redirect(tep_href_link(FILENAME_PRODUCTS_MULTI, 'cPath=' . $targetCategoriesId . '&pID=' . $lastProductsId));
            break;
        case 'copy_to_confirm':
            //collect tree of subcategories from categories in $chooseCategoriesIds
            $treeOfChosenCategoriesAndSubcategories = getTreeOfSubcategoriesFromMultipleCategories($chooseCategoriesIds);

            //copy all chosen categories and their child categories (with inner products for each of them) to target category(recursively)
            copyMultipleCategories($treeOfChosenCategoriesAndSubcategories, $targetCategoriesId);

            //copy all chosen products to target category
            $lastProductsId = copyMultipleProducts($chooseProductsIds, $targetCategoriesId) ?: $lastProductsId;

            //reset cache
            resetCacheForCategories();

            //redirect
            tep_redirect(tep_href_link(FILENAME_PRODUCTS_MULTI, 'cPath=' . $targetCategoriesId . '&pID=' . $lastProductsId));
            break;
    }
}

// check if the catalog image directory exists
if (is_dir(DIR_FS_CATALOG_IMAGES)) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES)) {
        $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
    }
} else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
}

include_once('html-open.php');
include_once('header.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css"/>
    <script language="JavaScript">
        /**
         * Checks/unchecks all tables
         *
         * @param   string   the form name
         * @param   boolean  whether to check or to uncheck the element
         *
         * @return  boolean  always true

         */

        $(document).ready(function () {
            $('.dataTableContent input').change(function () {
                if ($('.dataTableContent input').is(':checked') === true) {
                    $('.a-smol_2').show();
                } else {
                    $('.a-smol_2').hide();
                }
            });
            $('.a-smol_2').click(function () {
                $(this).hide();
            });
            $('.check_all').click(function () {
                $('.a-smol_2').show();
            });
        });

        function setCheckboxes(the_form, do_check) {
            //categories
            elts = (typeof (document.forms[the_form].elements['choose_categories[]']) != 'undefined') ? document.forms[the_form].elements['choose_categories[]'] : document.forms[the_form].elements['choose_categories[]'];
            if (elts) {
                elts_cnt = (typeof (elts.length) != 'undefined') ? elts.length : 0;
                if (elts_cnt) {
                    for (var i = 0; i < elts_cnt; i++) {
                        elts[i].checked = do_check;
                    }
                } else {
                    elts.checked = do_check;
                }
            }

            //products
            var elts = (typeof (document.forms[the_form].elements['choose[]']) != 'undefined') ? document.forms[the_form].elements['choose[]'] : document.forms[the_form].elements['choose[]'];
            if (elts) {
                var elts_cnt = (typeof (elts.length) != 'undefined') ? elts.length : 0;
                if (elts_cnt) {
                    for (var i = 0; i < elts_cnt; i++) {
                        elts[i].checked = do_check;
                    }
                } else {
                    elts.checked = do_check;
                }
            }

            return true;
        }
    </script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF"
      onLoad="SetFocus();">
<div id="spiffycalendar" class="text"></div>
<table class="table_products_multi" border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>
        <td class="pageHeading">
            <?php
            echo HEADING_TITLE;
            //echo $action.count($choose).$categories_id.$current_category_id; // nur zu testzwecken - only for tests
            ?>
        </td>
    </tr>
    <tr>
        <!-- body_text //-->
        <td width="100%" valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr class="heading_form_mobil">
                    <td>
                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tr class="not-show-mobile">
                                <td class="pageHeading"
                                    align="right"><?php echo tep_draw_separator('spacer/pixel_trans.png', 1, HEADING_IMAGE_HEIGHT); ?></td>
                                <td align="right" class="left_heading_form">
                                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                        <tr class="prod_multi_tr">
                                            <td width="600" class="smallText prod_multi_td_header">
                                                <div class="transition_unit">
                                                    <?php echo tep_draw_pull_down_categories('cat_tree_links', $tep_get_category_tree, $current_category_id, FILENAME_PRODUCTS_MULTI) ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="show-mobile mobile-title">
                                <td class="pageHeading">
                                    <?php
                                    echo HEADING_TITLE;
                                    //echo $action.count($choose).$categories_id.$current_category_id; // nur zu testzwecken - only for tests
                                    ?>
                                </td>
                            </tr>
                            <tr class="show-mobile mobile-search">
                                <td align="right" class="left_heading_form">
                                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                        <tr class="prod_multi_tr">
                                            <td class="smallText prod_multi_td_header" align="right">
                                                <?php echo tep_draw_form('search', FILENAME_PRODUCTS_MULTI, tep_get_all_get_params(), 'post'); ?>
                                                <?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search', $_REQUEST['search']); ?>
                                                </form>
                                            </td>
                                            <td class="smallText prod_multi_td_header" align="right">
                                                <?php echo tep_draw_form('goto', FILENAME_PRODUCTS_MULTI, '', 'get'); ?>
                                                <?php echo HEADING_TITLE_GOTO . ' ' . tep_draw_pull_down_menu('cPath', $tep_get_category_tree, $current_category_id, 'onChange="this.form.submit();"'); ?>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php echo tep_draw_form('mainForm', FILENAME_PRODUCTS_MULTI, 'cPath=' . $cPath . '&cID=' . $cID, 'post'); ?>
                <!--
                <form method="post" action="products_multi.php?cPath=<?php echo $cPath; ?>&cID=<?php echo $cID; ?>" name="mainForm">
                -->
                <tr class="specials_small_table_mobil" width="100%">
                    <td class="specials_small_table" width="100%" valign="top">
                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                            <tbody>
                            <tr class="infoBoxHeading">
                                <td class="infoBoxHeading"><b>Apple iPhone 6s</b></td>
                            </tr>
                            </tbody>
                        </table>
                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                            <tbody>
                            <tr>
                                <td class="infoBoxContent">Добавлен: 15/03/2018</td>
                                <td class="infoBoxContent">Изменение: 09/05/2020</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" class="infoBoxContent">Нет картинки<br>iphone_6splus_1.jpg
                                </td>
                            </tr>
                            <tr>
                                <td class="infoBoxContent">Цена: $590.00 <br>Кол-во: 99</td>
                                <td class="infoBoxContent">Ср.Оценка: 0.00%</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" width="100%" cellspacing="0" cellpadding="0" class="small_table_mobil">
                            <tr>
                                <td valign="top">
                                    <div class="table-responsive">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                            <tr class="dataTableHeadingRow">
                                                <td class="dataTableHeadingContent"><?php echo TEXT_PMU_CANCEL; ?></td>
                                                <td class="dataTableHeadingContent" width="50px"></td>
                                                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CATEGORIES_PRODUCTS; ?></td>
                                                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
                                                <td class="dataTableHeadingContent"
                                                    align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                                                <td class="dataTableHeadingContent"
                                                    align="center"><?php echo TABLE_HEADING_MANUFACTURERS_NAME; ?></td>
                                                <td class="dataTableHeadingContent"
                                                    align="center"><?php echo TABLE_HEADING_PRODUCTS_QUANTITY; ?></td>
                                                <td class="dataTableHeadingContent"
                                                    align="right"><?php echo TABLE_HEADING_ACTION; ?> </td>
                                            </tr>
                                            <?php
                                            $categories_count = 0;
                                            $rows = 0;
                                            if ($_REQUEST['search']) {
                                                if ($cat_stat == 1) {
                                                    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.categories_status from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' and cd.categories_name like '%" . $_REQUEST['search'] . "%' order by c.sort_order, cd.categories_name");
                                                } else {
                                                    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' and cd.categories_name like '%" . $_REQUEST['search'] . "%' order by c.sort_order, cd.categories_name");
                                                }
                                            } else {
                                                if ($cat_stat == 1) {
                                                    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.categories_status from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . $current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' order by c.sort_order, cd.categories_name");
                                                } else {
                                                    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . $current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' order by c.sort_order, cd.categories_name");
                                                }
                                            }
                                            while ($categories = tep_db_fetch_array($categories_query)) {
                                                $categories_count++;
                                                $rows++;

                                                // Get parent_id for subcategories if search
                                                if ($_REQUEST['search']) {
                                                    $cPath = $categories['parent_id'];
                                                }

                                                if (((!$_REQUEST['cID']) && (!$_REQUEST['pID']) || (@$_REQUEST['cID'] == $categories['categories_id'])) && (!$cInfo) && (substr($_REQUEST['action'], 0, 4) != 'new_')) {
                                                    $category_childs = array('childs_count' => tep_childs_in_category_count($categories['categories_id']));
                                                    $category_products = array('products_count' => tep_products_in_category_count($categories['categories_id']));

                                                    $cInfo_array = tep_array_merge($categories, $category_childs, $category_products);
                                                    $cInfo = new objectInfo($cInfo_array);
                                                }

                                                if ((is_object($cInfo)) && ($categories['categories_id'] == $cInfo->categories_id)) {
                                                    echo '<tr class="dataTableRowSelected category_click" 
                                                    onmouseover="this.style.cursor=\'hand\'" 
                                                    data-href="' . tep_href_link(FILENAME_PRODUCTS_MULTI, tep_get_path($categories['categories_id'])) . '"
                                                    >' . "\n";
                                                } else {
                                                    //data-href="' . tep_href_link(FILENAME_PRODUCTS_MULTI, 'cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '"
                                                    echo '<tr class="dataTableRow category_click" 
                                                    onmouseover="this.className=\'dataTableRowOver category_click\';this.style.cursor=\'hand\'" 
                                                    onmouseout="this.className=\'dataTableRow category_click\'" 
                                                    data-href="' . tep_href_link(FILENAME_PRODUCTS_MULTI, tep_get_path($categories['categories_id'])) . '"
                                                    >' . "\n";
                                                }
                                                ?>
                                                <td class="dataTableContent no_click" width="20" align="center">
                                                    <input type="checkbox" name="choose_categories[]"
                                                           value="<?php echo $categories['categories_id']; ?>"
                                                           id="checkbox_choose_<?php echo $categories_count; ?>" <?php if ($checkall == 1) {
                                                        echo 'checked';
                                                    } ?>>
                                                </td>
                                                <td class="dataTableContent" colspan="3">
                                                    <?php
                                                    echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_MULTI, tep_get_path($categories['categories_id'])) . '">' . tep_image(DIR_WS_ICONS . 'folder.gif', ICON_FOLDER) . '</a>' .
                                                        '<div class="category_name">' . $categories['categories_name'] . '</div>';
                                                    ?>
                                                </td>
                                                <td class="dataTableContent" align="center">
                                                    <?php
                                                    if ($cat_stat == 1) {
                                                        if ($categories['categories_status'] == '1') {
                                                            echo tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '  ' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10);
                                                        } else {
                                                            echo tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '  ' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td class="dataTableContent" align="left"></td>
                                                <td class="dataTableContent" align="center"></td>
                                                <td class="dataTableContent"
                                                    align="right"><?php if ((is_object($cInfo)) && ($categories['categories_id'] == $cInfo->categories_id)) {
                                                        echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
                                                                  } else {
                                                                      echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_MULTI, 'cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
                                                                  } ?>&nbsp;
                                                </td>
                                                </tr>
                                                <?php
                                            }

                                            $products_count = 0;
                                            if ($_REQUEST['search']) {
                                                $products_query = tep_db_query("select p.products_tax_class_id, p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_model, p2c.categories_id, mi.manufacturers_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS_INFO . " mi where p.products_id = pd.products_id and p.manufacturers_id=mi.manufacturers_id and pd.language_id = '" . $languages_id . "' and mi.languages_id = '" . $languages_id . "' and p.products_id = p2c.products_id and pd.products_name like '%" . $_REQUEST['search'] . "%' order by pd.products_name");
                                            } else {
                                                $products_query = tep_db_query("select p.products_tax_class_id, p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_model, mi.manufacturers_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c , " . TABLE_MANUFACTURERS_INFO . " mi where p.products_id = pd.products_id and p.manufacturers_id=mi.manufacturers_id and pd.language_id = '" . $languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = '" . $current_category_id . "' group by products_id order by pd.products_name");
                                            }
                                            while ($products = tep_db_fetch_array($products_query)) {
                                                $products_count++;
                                                $rows++;

                                                $image_file_name = explode(';', $products['products_image']);
                                                $products['products_image'] = $image_file_name[0];

                                                // Get categories_id for product if search
                                                if ($_REQUEST['search']) {
                                                    $cPath = $products['categories_id'];
                                                }

                                                if (((!$_REQUEST['pID']) && (!$_REQUEST['cID']) || (@$_REQUEST['pID'] == $products['products_id'])) && (!$pInfo) && (!$cInfo) && (substr($_REQUEST['action'], 0, 4) != 'new_')) {
                                                    $pInfo = new objectInfo($products);
                                                    //      $pInfo = new objectInfo($pInfo_array);
                                                }

                                                if ((is_object($pInfo)) && ($products['products_id'] == $pInfo->products_id)) {
                                                    echo ' <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'">' . "\n";
                                                } else {
                                                    echo '  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'">' . "\n";
                                                }
                                                ?>
                                                <td class="dataTableContent" width="40px" align="center">
                                                    <input type="checkbox" name="choose[]"
                                                           value="<?php echo $products['products_id']; ?>"
                                                           id="checkbox_choose_<?php echo $products_count; ?>" <?php if ($checkall == 1) {
                                                                echo 'checked';
                                                                               } ?>></td>
                                                <td class="dataTableContent" width="50px"
                                                    align="center"><?php echo tep_info_image($products['products_image'], $products['products_name'], 30, 30); ?></td>
                                                <td class="dataTableContent"><?php echo $products['products_name']; ?></td>
                                                <td class="dataTableContent"
                                                    align="left"><?php echo $products['products_model']; ?>
                                                <td class="dataTableContent" align="center">
                                                    <?php
                                                    if ($products['products_status'] == '1') {
                                                        echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_MULTI, 'action=setflag&flag=0&pID=' . $products['products_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_RED_LIGHT, 16, 16) . '</a>';
                                                    } else {
                                                        echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_MULTI, 'action=setflag&flag=1&pID=' . $products['products_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 16, 16) . '</a>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="dataTableContent"
                                                    align="center"><?php echo $products['manufacturers_name']; ?></td>
                                                <td class="dataTableContent"
                                                    align="center"><?php echo $products['products_quantity']; ?></td>
                                                <td class="dataTableContent"
                                                    align="right"><?php if ((is_object($pInfo)) && ($products['products_id'] == $pInfo->products_id)) {
                                                        echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
                                                                  } else {
                                                                      echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_MULTI, 'cPath=' . $cPath . '&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
                                                                  } ?>&nbsp;
                                                </td>
                                                </tr>
                                                <?php
                                            } // zu: while ($products = tep_db_fetch_array($products_query)) {

                                            if ($cPath_array) {
                                                $cPath_back = '';
                                                for ($i = 0; $i < sizeof($cPath_array) - 1; $i++) {
                                                    if ($cPath_back == '') {
                                                        $cPath_back .= $cPath_array[$i];
                                                    } else {
                                                        $cPath_back .= '_' . $cPath_array[$i];
                                                    }
                                                }
                                            }

                                            $cPath_back = ($cPath_back) ? 'cPath=' . $cPath_back : '';
                                            ?>
                                        </table>
                                    </div>
                                    <table border="0" width="100%" cellspacing="0" cellpadding="2"
                                           class="table-smol-bottom">
                                        <tr>
                                            <td colspan="8" style="padding: 10px;">
                                                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                                    <tr>
                                                        <td width="70" valign="top" style="line-height:41px;">
                                                            <a href="<?= tep_href_link(FILENAME_PRODUCTS_MULTI, $cPath_back . '&cID=' . $current_category_id) ?>"
                                                               class="a-smol_3"><?= getConstantValue('TBL_HEADING_TITLE_BACK_TO_PARENT') ?: getConstantValue('IMAGE_BACK') ?></a>
                                                        </td>
                                                        <td style="line-height:41px;" valign="top" class="td-smol">
                                                            <a <!--href="--><?php /*echo tep_href_link(FILENAME_PRODUCTS_MULTI, '&cPath=' . $cPath . '&cID=' . $cID . '&checkall=1'); */?>"
                                                               onClick="setCheckboxes('mainForm', true); return false;"
                                                               class="a-smol_1 check_all"><?php echo TEXT_CHOOSE_ALL; ?></a>

                                                            <a <!--href="--><?php /*echo tep_href_link(FILENAME_PRODUCTS_MULTI, '&cPath=' . $cPath . '&cID=' . $cID); */?>"
                                                               onClick="setCheckboxes('mainForm', false); return false;"
                                                               class="a-smol_2"><?php echo TEXT_CHOOSE_ALL_REMOVE; ?></a>

                                                            <a href="<?php echo tep_href_link(FILENAME_PRODUCTS_MULTI, '&cPath=' . $cPath . '&cID=' . $cID); ?>"
                                                               onClick="event.preventDefault();$('#duplicate_catalog').show();$('#delete_catalog').hide();$('#perform_block').show();$('#move_product_confirm').trigger('click');"
                                                               class="a-smol_1"><?= IMAGE_COPY ?></a>
                                                            <a href="<?php echo tep_href_link(FILENAME_PRODUCTS_MULTI, '&cPath=' . $cPath . '&cID=' . $cID); ?>"
                                                               onClick="event.preventDefault();$('#delete_catalog').show();$('#duplicate_catalog').hide();$('#perform_block').show();"
                                                               class="a-smol_1 control-btn-delete"><?= IMAGE_DELETE ?></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="cPath"
                                                                   value="<?php echo $cPath; ?>">
                                                            <input type="hidden" name="cID" value="<?php echo $cID; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr class="table-bottom-fon" id="duplicate_catalog"
                                                        style="display: none">
                                                        <td align="left" class="smallText products_multi_actions"
                                                            colspan="4">
                                                            <p><?= TEXT_PMU_DUBL_CATEGORY?></p>
                                                            <label><input type="radio" name="action"
                                                                          value="move_product_confirm"
                                                                          id="move_product_confirm">&nbsp;&nbsp;<?php echo TEXT_MOVE_TO; ?>
                                                            </label>
                                                            <label><input type="radio" name="action"
                                                                          value="copy_to_confirm" id="copy_to_confirm"
                                                                          align="bottom">&nbsp;&nbsp;<?php echo TEXT_DUBLICATE_TO; ?>
                                                            </label>
                                                            <label><input type="radio" name="action"
                                                                          value="link_to_confirm" id="link_to_confirm"
                                                                          checked>&nbsp;&nbsp;<?php echo TEXT_PMU_LINK; ?>
                                                            </label>
                                                            <?php echo tep_draw_pull_down_categories('categories_id', $tep_get_category_tree, $current_category_id); ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-bottom-fon">
                                                        <td align="right" colspan="4" class="smallText">
                                                            <?php echo TEXT_CATEGORIES . ' ' . $categories_count . ' &nbsp;&nbsp;&nbsp; ' . TEXT_PRODUCTS . ' ' . $products_count; ?></td>
                                                    </tr>
                                                    <tr class="table-bottom-fon table-catalog" id="delete_catalog"
                                                        style="display: none">
                                                        <td align="left" class="smallText products_multi_actions"
                                                            colspan="4">
                                                            <label>
                                                                <input type="radio" name="action"
                                                                       checked
                                                                       value="delete_product_confirm"
                                                                       id="delete_product_confirm">&nbsp;&nbsp;<?php echo TEXT_PMU_DEL; ?>
                                                            </label>
                                                            <select name="del_art"
                                                                    title="<?php echo DEL_CHOOSE_DELETE_ART; ?>"
                                                                    id="del_art">
                                                                <option value="this_cat"
                                                                        selected><?php echo DEL_THIS_CAT; ?></option>
                                                                <option value="complete"><?php echo DEL_COMPLETE; ?></option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr id="perform_block" style="display: none" class="table-bottom-fon">
                                                        <td align="right" class="smallText" colspan="3"><input
                                                                    type="submit" name="go" value="<?= BUTTON_PMU_SUBMIT?>"
                                                                    title="<?= BUTTON_PMU_SUBMIT?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="dataTableContent" colspan="3">
                                                            <?php echo TEXT_ATTENTION_DANGER; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <?php
                                $heading = array();
                                $contents = array();
                                switch ($_REQUEST['action']) {
                                    default:
                                        if ($rows > 0) {
                                            if (is_object($cInfo)) { // category info box contents
                                                $heading[] = array('text' => '<b>' . $cInfo->categories_name . '</b>');
                                                $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_short($cInfo->date_added));
                                                if (tep_not_null($cInfo->last_modified)) {
                                                    $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($cInfo->last_modified));
                                                }
                                                $contents[] = array('text' => tep_info_image($cInfo->categories_image, $cInfo->categories_name, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '<br>' . $cInfo->categories_image);
                                                $contents[] = array('text' => TEXT_SUBCATEGORIES . ' ' . $cInfo->childs_count . '<br>' . TEXT_PRODUCTS . ' ' . $cInfo->products_count);
                                            } elseif (is_object($pInfo)) { // product info box contents
                                                $heading[] = array('text' => '<b>' . tep_get_products_name($pInfo->products_id, $languages_id) . '</b>');
                                                $contents[] = array('text' => TEXT_DATE_ADDED . ' ' . tep_date_short($pInfo->products_date_added));
                                                if (tep_not_null($pInfo->products_last_modified)) {
                                                    $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($pInfo->products_last_modified));
                                                }

                                                if (date('Y-m-d') < $pInfo->products_date_available) {
                                                    $contents[] = array('text' => TEXT_DATE_AVAILABLE . ' ' . tep_date_short($pInfo->products_date_available));
                                                }
                                                $contents[] = array('text' => tep_info_image($pInfo->products_image, $pInfo->products_name, 150, 150) . '<br>' . $pInfo->products_image);
                                                $contents[] = array('text' => TEXT_PRODUCTS_PRICE_INFO . ' ' . $currencies->format($pInfo->products_price) . '<br>' . TEXT_PRODUCTS_QUANTITY_INFO . ' ' . $pInfo->products_quantity);
                                                $contents[] = array('text' => TEXT_PRODUCTS_AVERAGE_RATING . ' ' . number_format($pInfo->average_rating, 2) . '%');
                                            }
                                        } else { // create category/product info
                                            $heading[] = array('text' => '<b>' . EMPTY_CATEGORY . '</b>');
                                            $contents[] = array('text' => sprintf(TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS, $parent_categories_name));
                                        }
                                        break;
                                }


                                ?>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <!-- body_text_eof //-->
    </tr>
    </form>
</table>
<!-- body_eof //-->
<br>

<script>
    $(document).on('click', '.table_products_multi tr.category_click', function(e){
        if(e.target.tagName.toLowerCase() != 'input' && !$(e.target).hasClass('no_click')){
            var $this = $(this);
            document.location.href=$this.data('href');
        }
    })
</script>
</body>
</html>