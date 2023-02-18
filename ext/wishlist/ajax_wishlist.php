<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    chdir('../../');
    $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    require($rootPath . '/includes/application_top.php');

    switch ($_POST['request']) {
        case 'wishlist':
            $output['id'] = $_POST['id'];
            switch ($_POST['action']) {
                case 'add':
                    $wishList->add_wishlist($_POST['id'], $attributes_id);
                    $data = $wishList->getProductData($_POST['id']);
                    $output['price'] = isset($data['products_price']) ? number_format($data['products_price'], 2) : '';
                    $output['name'] = isset($data['products_name']) ? $data['products_name'] : '';
                    $output['categoryName'] = isset($data['categories_name']) ? $data['categories_name'] : '';
                    $output['text'] = IN_WHISHLIST;
                    break;
                case 'delete':
                    $wishList->remove($_POST['id']);
                    $output['text'] = WHISH;
                    break;
                case 'count':
                    if (is_array($wishList->wishID) && !empty($wishList->wishID)) {
                        //  $output['image'] = 'heart.jpg';
                    } else {
                        //  $output['image'] = 'heart_off.jpg';
                    }
                    break;
            }
            echo json_encode($output);
            break;
    }
}
