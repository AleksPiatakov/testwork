<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' && empty($_POST['modalLoader'])) {
    $rootPath = dirname(dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))));
    chdir('../../../');
    require('includes/application_top.php');

    // require(DIR_WS_CLASSES . 'currencies.php');
    // $currencies = new currencies();

    if(!isset($currencies)) {
        require(DIR_WS_CLASSES . 'currencies.php');
        $currencies = new currencies();
    }

    if(isset($_POST['next_page']) && $_POST['next_page'] > 0) {
        $nextPage = $_POST['next_page'];
        $offsetItems = 20 * $nextPage;
    } else {
        $offsetItems = 0;
    }

    $fetchResults = array();
    $query = tep_db_query("SELECT pd.products_id AS id, pd.products_name AS name, p.products_ordered as orders, p.products_image AS images FROM " . TABLE_PRODUCTS_DESCRIPTION . " pd LEFT JOIN " . TABLE_PRODUCTS . " p ON (pd.products_id = p.products_id) WHERE pd.language_id = " . $languages_id . " AND p.products_ordered > 0 
    ORDER BY p.products_ordered DESC 
    LIMIT $offsetItems, 20");

    if ($query->num_rows) {
        while ($product = tep_db_fetch_array($query)) {
            $image_file_name = explode(';', $product['images']);
            if($image_file_name[0]!='') $image_file_name = '../getimage/50x50/products/' . $image_file_name[0] . '';
            else $image_file_name = '../getimage/50x50/products/default.png'; 

            $fetchResults[] = $product;
            $definesArray = array('DIR_WS_CATALOG' => DIR_WS_CATALOG, 'TEXT_BLOCK_OVERVIEW_ACTION_VIEW' => TEXT_BLOCK_OVERVIEW_ACTION_VIEW);

            $headersArray = array(
                'ID' => "ID",
                'TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE' => TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE,
                'TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME' => TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME,
                'TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS' => TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS,
                'empty' => '');

            $response = array(
                'status' => true,
                'msg' => 'Data exists.',
                'id' => 'most-sold',
                'headers' => $headersArray,
                'data' => $fetchResults,
                'defines' => $definesArray
            );
            
        }
    } else {
        $response = array(
            'status' => false,
            'msg' => 'No data fetched.',
            'data' =>  []
        );           
    }

    // console($response);
    echo json_encode($response);

    exit;
    

}
                        
                        
?>

<div id="most-sold" class="tab-pane fade hidden-scroll">
    <?php
        $query = tep_db_query("SELECT pd.products_id AS id, pd.products_name AS name, p.products_ordered as orders, p.products_image AS images FROM " . TABLE_PRODUCTS_DESCRIPTION . " pd LEFT JOIN " . TABLE_PRODUCTS . " p ON (pd.products_id = p.products_id) WHERE pd.language_id = " . $languages_id . " AND p.products_ordered > 0 
        ORDER BY p.products_ordered DESC LIMIT 20");
    ?>
    <table class="table table-striped m-b-none">
        <tr>
            <th>ID</th>
            <th><?php print TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODUCT_IMAGE; ?></th>
            <th><?php print TEXT_BLOCK_OVERVIEW_MOST_SOLD_PRODCUT_NAME; ?></th>
            <th><?php print TEXT_BLOCK_OVERVIEW_MOST_SOLD_ORDERS; ?></th>
            <th></th>
        </tr>
        <?php
            while ($product = tep_db_fetch_array($query)) {
                $image_file_name = explode(';', $product['images']);
                if($image_file_name[0]!='') $image_file_name = '../getimage/50x50/products/' . $image_file_name[0];
                else $image_file_name = '../getimage/50x50/products/default.png';
            ?>
            <tr>
                <td class="text-xs">
                    <?php print $product['id']; ?>
                </td>
                <td>
                    <img src="<?php print $image_file_name; ?>" alt="<?php print $product['name']; ?>" title="<?php print $product['name']; ?>">
                </td>
                <td class="text-xs">
                    <?php print $product['name']; ?>
                </td>
                <td class="text-xs">
                    <?php print $product['orders']; ?>
                </td>
                <td class="text-info text-xs">
                    <a href="<?php echo DIR_WS_CATALOG; ?>product_info.php?products_id=<?php print $product['id']; ?>" target="_blank"><?php print TEXT_BLOCK_OVERVIEW_ACTION_VIEW; ?></a>
                </td>
            </tr>
            <?php
        }

        ?>

    </table>
</div>