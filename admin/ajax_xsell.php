<?php

require_once('includes/application_top.php');
$_GET['exclude'] = isset($_GET['exclude']) ? explode(',', $_GET['exclude']) : [];
$getExclude = [];

//fix sql injection
$_GET['xsell_model'] = tep_db_input($_GET['xsell_model']);

foreach ($_GET['exclude'] as $item) {
    $getExclude[] = (int)$item;
}

if ($_GET['action'] == 'show') {
    $sql = "SELECT distinct
          `p`.`products_id` as `id`, 
          `p`.`products_model` as `model`,
          `pd`.`products_name` as `label`
        FROM " . TABLE_PRODUCTS . " `p`
        left join " . TABLE_PRODUCTS_DESCRIPTION . " `pd` on pd.products_id=p.products_id
        WHERE (`pd`.`products_name` LIKE '%{$_GET['xsell_model']}%' OR `p`.`products_model` LIKE '%{$_GET['xsell_model']}%') and  `pd`.`language_id` = " . (int)$_SESSION['languages_id'] . " and `p` . `products_id` not in (" . implode(',',
            $getExclude) . ") and `p` . `products_id` != " . (int)$_GET['pid'];
    $sql = tep_db_query($sql);
    while ($row = tep_db_fetch_array($sql)) {
        $result[] = $row;
    }
    echo json_encode($result);
    exit;

} elseif ($_GET['action'] == 'add' and $_GET['pid'] != '' and $_GET['xsell_model'] != '') {
    $result = tep_db_query("insert into " . TABLE_PRODUCTS_XSELL . " (products_id, xsell_id, sort_order) values (" . (int)$_GET['pid'] . ", " . $_GET['xsell_model'] . ",1)");
    if ($result) {
        $msg = array('msg' => true);
    } else {
        $msg = array('msg' => false);
    }
    echo json_encode($msg);
    exit;

} else {
    if ($_GET['action'] == 'del') {
        if ($_GET['pid'] != '' and $_GET['xsell_id'] != '') {
            tep_db_query("delete from " . TABLE_PRODUCTS_XSELL . " where products_id = " . (int)$_GET['pid'] . " and xsell_id = " . (int)$_GET['xsell_id'] . " ");
        }
        exit;
    } else {
        if ($_GET['action'] == 'add_discount') {
            if ($_GET['pid'] != '' and $_GET['xsell_id'] != '') {
                tep_db_query("UPDATE " . TABLE_PRODUCTS_XSELL . " set discount='" . tep_db_input($_GET['val']) . "' where products_id = " . (int)$_GET['pid'] . " and xsell_id = " . (int)$_GET['xsell_id']);
                if ($_GET["discount"] == "true") {
                    tep_db_query("UPDATE " . TABLE_PRODUCTS_XSELL . " set discount='" . tep_db_input($_GET['val']) . "' where products_id = " . (int)$_GET['xsell_id'] . " and xsell_id = " . (int)$_GET['pid']);
                }
            }
            exit;
        } else {
            if ($_GET['action'] == 'change_sort_order') {
                if ($_GET['xsell_id'] != '') {
                    tep_db_query("UPDATE " . TABLE_PRODUCTS_XSELL . " set sort_order=" . tep_db_input($_GET['val']) . " where products_id = " . (int)$_GET['pid'] . " and xsell_id = " . (int)$_GET['xsell_id']);
                }
                exit;
            } else {
                if ($_GET['action'] == 'add_rec_link') {
                    if ($_GET['pid'] != '' and $_GET['xsell_id'] != '') {
                        if ($_GET['val'] == 'true') {
                            tep_db_query("insert into " . TABLE_PRODUCTS_XSELL . " (products_id, xsell_id, sort_order, discount) values (" . (int)$_GET['xsell_id'] . ", " . (int)$_GET['pid'] . ",1, '" . tep_db_input($_GET['discount']) . "')");
                        } else {
                            tep_db_query("delete from " . TABLE_PRODUCTS_XSELL . " where products_id = " . (int)$_GET['xsell_id'] . " and xsell_id = " . (int)$_GET['pid']);
                        }
                    }
                    exit;
                }
            }
        }
    }
}
/*if ($_GET['action']=='add') {
    if ($_GET['pid']!='' and $_GET['xsell_model']!='') {

        $product_query=tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and p.products_model = '" . $_GET['xsell_model'] . "' ");
        $product=tep_db_fetch_array($product_query);

        $xsell_id=$product['products_id'];
        tep_db_query("insert into " . TABLE_PRODUCTS_XSELL . " (products_id, xsell_id, sort_order) values (" . (int)$_GET['pid'] . ", " . (int)$xsell_id . ",1)");

        echo $product['products_name'];
    }
}elseif ($_GET['action']=='del') {
    if ($_GET['pid']!='' and $_GET['xsell_id']!='') {
        tep_db_query("delete from " . TABLE_PRODUCTS_XSELL . " where products_id = " . (int)$_GET['pid'] . " and xsell_id = " . (int)$_GET['xsell_id'] . " ");
    }
}*/
?>