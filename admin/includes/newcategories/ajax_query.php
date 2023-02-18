<?php

if ($products->isAjax()) {
    $action = $_POST['action'] ?: $_GET['action'];
    $tPath = $_GET['tPath'] ? $_GET['tPath'] : ($products->data['tPath'] ?: 0);
    $arr = [
        'success' => false,
        'msg' => TEXT_ERROR
    ];
    switch ($action) {
        case 'category':
            $categories->getDescription($tPath);
            $html = $categories->getView('newcategories/formLang');
            $title = TEXT_EDIT_CATEGORY . ' ' . $categories->data['data'][$_SESSION['languages_id']]['categories_name'];
            echo json_encode([
                'html' => $html,
                'title' => $title
            ]);
            break;
        case 'update_categories_description':
        case 'insert_categories_description':
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $categories->checkFile('categories_image', $id, TABLE_CATEGORIES, $allowed_image_types);
            $categories->checkFile('categories_icon', $id, TABLE_CATEGORIES, $allowed_image_types);
            $method = explode('_', $action)[0];
            if ($categories->$method($_POST)) {
                $get_categories = $categories->setTree();
                $categories = getTree($get_categories, $catProductCounter_ready);
                $arr = [
                    'success' => true,
                    'html' => $categories,
                    'msg' => TEXT_SAVE_DATA_OK
                ];
            }

            echo json_encode($arr);
            break;
        case 'delete_category':
            $cntSubCatProducts = $categories->cntSubCat($_POST['tPath']);
            $text = sprintf(
                TEXT_COUNT_SURE_DELL,
                count($cntSubCatProducts['categories']),
                count($cntSubCatProducts['products'])
            );
            $html = '<div class="row">
                            <div class="col-sm-12">
                                <p>' . $text . '</p>
                            </div>
                            <div class="col-sm-12">
                                  <input type="submit" value="OK" class="btn">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">' .
                                    TEXT_MODAL_CANCEL_ACTION .
                                  '</button>
                            </div>
                     </div>';

            $arr = [
                'title' => TEXT_CONFIRM,
                'html' => $html
            ];
            echo json_encode($arr);
            break;
        case 'confirm_delete_category':
            $categories->confirmDelete($_POST['tPath']);
            $arr = [
                'success' => true,
            ];
            echo json_encode($arr);
            break;
        case 'move_category':
            if (isset($_POST['categoryId']) && isset($_POST['moveTo'])) {
                if ($categories->moveTo($_POST['categoryId'], $_POST['moveTo'])) {
                    $get_categories = $categories->setTree();
                    $categories = getTree($get_categories, $catProductCounter_ready);
                    $arr = [
                        'success' => true,
                        'html' => $categories,
                        'msg' => TEXT_SAVE_DATA_OK
                    ];
                }

                echo json_encode($arr);
                exit;
            } else {
                $get_categories = $categories->setTree();
                $textParent = defined('TEXT_PARENT') ? TEXT_PARENT : '';
                ob_start();
                echo '<div class="chose-cat"><i class="fa fa-fw fa-arrow-circle-left" aria-hidden="true"></i><select class="form-control"><option disabled value="" selected>' . TEXT_CHOOSE_CATEGORY . '</option><option value="0">' . $textParent . '</option>';
                getTreeOption($get_categories, $catProductCounter_ready);
                echo '</select><div class="list-action">
                  <i class="fa fa-check-circle fa-lg" aria-hidden="true"></i></div>';
                $content = ob_get_clean();
                $arr = [
                    'html' => $content,
                ];
                echo json_encode($arr);
            }
            break;
        case 'edit_products_description':
        case 'new_products_description':
            require_once DIR_FS_ADMIN . DIR_WS_LANGUAGES . $language . '/newcategories.php';
            $id = $_GET['id'] ? $_GET['id'] : false;
            $products->selectOne($id);
            $title = $tep_get_category_tree[$products->data['tPath']]['text'] . '/' . $products->data['data'][$languages_id]['products_name'];
            $products->data['category'] = makeCategory($tPath, $categories->setTree());
            $products->data['tPath'] = $tPath;
            $html = $products->getView('newcategories/formLang');
            echo json_encode([
                'html' => $html,
                'title' => $title
            ]);
            break;
        case 'update_products_description':
            if (!empty($_POST['id'])) {
                $products->setTable();
                $products->checkFile('products_image', $_POST['id'], null, $allowed_image_types);
                if ($products->update($_POST)) {
                    $arr = [
                        'success' => true,
                        'msg' => TEXT_SAVE_DATA_OK,
                    ];
                }

                echo json_encode($arr);
            }
            break;
        case 'insert_products_description':
            $products->checkFile('products_image', null, null, $allowed_image_types);
            $insert_result = $products->insert($_POST);
            if ($insert_result['success']) {
                $arr = [
                    'success' => true,
                    'id' => $insert_result['id'],
                    'reload' => true,
                    'msg' => TEXT_SAVE_DATA_OK
                ];
            }

            echo json_encode($arr);
            break;
        case 'copy_products_description':
            $products->data['category'] = makeCategory($tPath, $categories->setTree());
            $products->data['current_category'] = $tPath;
            $html = $products->getView('newcategories/move_products');
            echo json_encode(['html' => $html]);
            break;
        case 'move_products':
            if ($_POST['copy_as'] === 'link') {
                if ($_POST['categories_id'] != $_POST['current_category'] || $_POST['current_category'] == 0) {
                    $products->link($_POST);
                } else {
                    $msg = ERROR_CANNOT_LINK_TO_SAME_CATEGORY;
                    $result = false;
                }
            } elseif ($_POST['copy_as'] === 'duplicate') {
                $products->duplicate($_POST);
            } elseif ($_POST['copy_as'] === 'move') {
                $products->move($_POST);
            }

            $arr = [
                'success' => $result ?: true,
                'msg' => $msg ?: TEXT_SAVE_DATA_OK,
            ];
            echo json_encode($arr);
            break;
        case 'delete_products_description':
            if ($products->deleteProduct($_POST['id'], $_POST['tPath'] ?: false)) {
                $arr = [
                    'success' => true,
                    'msg' => TEXT_SAVE_DATA_OK
                ];
            }

            echo json_encode($arr);
            break;
        case 'getProduct':
            echo json_encode($products->getProduct($_GET['search']));
            break;
        case 'addProduct':
            $arr['success'] = false;
            $arr['msg'] = TEXT_ERROR . ".Create first product";
            if (!empty($_POST['productId']) and !empty($_POST['xsellId'])) {
                $arr['success'] = $products->addProduct($_POST['productId'], $_POST['xsellId']);
                $arr['msg'] = TEXT_SAVE_DATA_OK;
            }
            echo json_encode($arr);
            break;
        case 'delete_xselId':
            echo json_encode(['success' => $products->delXsell($_POST['productsId'], $_POST['xsellId'])]);
            break;
        case 'delete_image':
            if (in_array($_POST['field_name'], ['categories_image', 'categories_icon'])) {
                $categories->delFiles((int)$_POST['ID'], $_POST['field_name'], TABLE_CATEGORIES);
                tep_db_query("UPDATE " . TABLE_CATEGORIES .
                    " SET " . $_POST['field_name'] . " = NULL WHERE categories_id=" . $_POST['ID']);
            } else {
                $products->delFile($_POST['ID'], $_POST['field_name'], 'products');
                tep_db_query("UPDATE " . TABLE_PRODUCTS .
                    " SET " . $_POST['field_name'] . " = '' WHERE products_id=" . $_POST['ID']);
            }

            echo json_encode(true);
            break;
    }

    if (isset($_POST['status'])) {
        if ($products->statusUpdate($_POST['status'], $_POST['id'], 'products_status', TABLE_PRODUCTS)) {
            $arr = [
                'success' => true,
                'msg' => TEXT_SAVE_DATA_OK,
            ];
        }

        echo json_encode($arr);
    }

    exit;
}
