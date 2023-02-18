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
    $query = tep_db_query("SELECT sum(p.products_ordered) AS orders, ptc.categories_id AS id, cd.categories_name as name 
    FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc 
    LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON (ptc.categories_id = cd.categories_id) 
    WHERE cd.language_id = " . $languages_id . " AND p.products_ordered > 0 AND ptc.products_id = p.products_id 
   group by ptc.categories_id
   order by orders desc
    
    -- ORDER BY p.products_ordered DESC 
    LIMIT $offsetItems, 20");

    if ($query->num_rows) {
        while ($product = tep_db_fetch_array($query)) {
            $image_file_name = explode(';', $product['images']);
            if($image_file_name[0]!='') $image_file_name = '../getimage/50x50/products/' . $image_file_name[0] . '';
            else $image_file_name = '../getimage/50x50/products/default.png'; 

            $fetchResults[] = $product;
            $definesArray = array('DIR_WS_CATALOG' => DIR_WS_CATALOG, 'TEXT_BLOCK_OVERVIEW_ACTION_VIEW' => TEXT_BLOCK_OVERVIEW_ACTION_VIEW);

            $headersArray = array(
                'ID' => 'ID',
                'TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME' => TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME,
                'TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS' => TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS,
                'empty' => '');

            $response = array(
                'status' => true,
                'msg' => 'Data exists.',
                'id' => 'top-categories',
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


<div id="top-categories" class="tab-pane fade hidden-scroll">
    <?php
        $categories = array();
        $query = tep_db_query("SELECT p.products_id AS id, p.products_ordered AS orders, ptc.categories_id AS id, cd.categories_name as name FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON (ptc.categories_id = cd.categories_id) WHERE cd.language_id = " . $languages_id . " AND p.products_ordered > 0 AND ptc.products_id = p.products_id 
        ORDER BY p.products_ordered DESC 
        LIMIT 20");

        while ($category = tep_db_fetch_array($query)) {
            $category['orders'] += $category['orders'];
            if (isset($categories[$category['id']])) {
                $categories[$category['id']]['orders'] += $category['orders'];
            } else {
                $categories[$category['id']] = $category;
            }
        }
        $sort_order = array();
        foreach ($categories as $category_id => $category) {
            $sort_order[$category_id] = $category['orders'];
        }
        array_multisort($sort_order, SORT_DESC, $categories);
    ?>
    <table class="table table-striped m-b-none">
        <tr>
            <th>ID</th>
            <th><?php print TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME; ?></th>
            <th><?php print TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS; ?></th>
            <th></th>
        </tr>
        <?php
            $counter = 0;
            foreach ($categories as $category) {
                if ($counter == 20) {
                    break;
                } ?>
            <tr>
                <td class="text-xs">
                    <?php print $category['id']; ?>
                </td>
                <td class="text-xs">
                    <?php print $category['name']; ?>
                </td>
                <td class="text-xs">
                    <?php print $category['orders']; ?>
                </td>
                <td class="text-info text-xs">
                    <a href="<?php echo DIR_WS_CATALOG; ?>index.php?cPath=<?php print $category['id']; ?>" target="_blank"><?php print TEXT_BLOCK_OVERVIEW_ACTION_VIEW; ?></a>
                </td>
            </tr>
            <?php
                $counter++;
        } ?>
    </table>



    <!-- <table class="table table-striped m-b-none">
        <tr>
            <th><?php// print TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_CATEGORY_NAME; ?></th>
            <th><?php //print TEXT_BLOCK_OVERVIEW_TOP_CATEGORIES_ORDERS; ?></th>
            <th></th>
        </tr>
        <?php //while ($category = tep_db_fetch_array($query)) { ?>
            <tr>
                <td class="text-xs">
                    <?php// print $category['id']; ?>
                </td>
                <td class="text-xs">
                    <?php //print $category['name']; ?>
                </td>
                <td class="text-xs">
                    <?php //print $category['orders']; ?>
                </td>
                <td class="text-info text-xs">
                    <a href="<?php// echo DIR_WS_CATALOG; ?>index.php?cPath=<?php// print $category['id']; ?>" target="_blank"><?php //print TEXT_BLOCK_OVERVIEW_ACTION_VIEW; ?></a>
                </td>
            </tr>
        <?php// } ?>
    </table> -->
   
</div>