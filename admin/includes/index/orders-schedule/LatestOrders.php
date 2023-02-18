<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$order_statuses_colors = array(
    //'1' => 'bg-danger text-white',
    '1' => 'text-white" style="background-color: #b8e7ff;"',
    /*'2' => 'text-white" style="background-color: #98a6ad;"',*/
	 '2' => 'text-white" style="background-color: #e2993a;"',
    //'3' => 'bg-success text-white',
	 '3' => 'text-white" style="background-color: #4fa6f1;"',
    //'4' => 'bg-info text-white',
	 '4' => 'text-white" style="background-color: #c03dff;"',
    '5' => 'bg-primary text-white',
    //'6' => 'text-white" style="background-color: #98a6ad;"',
	 '6' => 'text-white" style="background-color: #61737d;"',
    '7' => 'text-white" style="background-color: #98a6ad;"',
	 //'7' => 'text-white" style="background-color: #e2993a;"',
    '8' => 'text-white" style="background-color: #98a6ad;"',
	 //'8' => 'text-white" style="background-color: #e2993a;"',
);

if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' && empty($_POST['modalLoader'])) {

    $rootPath = dirname(dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))));
    chdir('../../../');
    require('includes/application_top.php');

    if(!isset($currencies)) {
        require(DIR_WS_CLASSES . 'currencies.php');
        $currencies = new currencies();
    }

    // require(DIR_WS_CLASSES . 'currencies.php');
    // $currencies = new currencies();


    if(isset($_POST['next_page']) && $_POST['next_page'] > 0) {
        $nextPage = $_POST['next_page'];
        $offsetItems = 20 * $nextPage;
    } else {
        $offsetItems = 0;
    }

    // Fetch order statuses
    $orders_statuses = array();
    $query = tep_db_query("SELECT orders_status_id, orders_status_name, orders_status_color FROM " . TABLE_ORDERS_STATUS . " WHERE language_id = '" . (int)$languages_id . "'");
    while ($orders_status = tep_db_fetch_array($query)) {
        $orders_statuses[$orders_status['orders_status_id']] = [
                'name' => $orders_status['orders_status_name'],
                'color' => $orders_status['orders_status_color'],
        ];
    }

    $fetchResults = array();
    // $query = tep_db_query("SELECT pd.products_id AS id, pd.products_name AS name, p.products_ordered as orders, p.products_image AS images FROM " . TABLE_PRODUCTS_DESCRIPTION . " pd LEFT JOIN " . TABLE_PRODUCTS . " p ON (pd.products_id = p.products_id) WHERE pd.language_id = " . $languages_id . " AND p.products_ordered > 0 
    // ORDER BY p.products_ordered DESC  LIMIT $offsetItems, 20");

    $query = tep_db_query("SELECT o.orders_id AS id,
                                  o.customers_id,
                                  o.customers_name,
                           UNIX_TIMESTAMP(o.date_purchased) AS date_created, ot.value AS amount, o.orders_status AS status_id 
                           FROM " . TABLE_ORDERS . " o 
                           LEFT JOIN " . TABLE_ORDERS_TOTAL . " ot ON (o.orders_id = ot.orders_id) 
                           AND ot.class = 'ot_total' 
                           ORDER BY o.date_purchased DESC 
                           LIMIT $offsetItems, 20");

    if ($query->num_rows) {
        while ($order = tep_db_fetch_array($query)) {
            $image_file_name = explode(';', $order['images']);
            if($image_file_name[0]!='') $image_file_name = '../getimage/50x50/products/' . $image_file_name[0] . '';
            else $image_file_name = '../getimage/50x50/products/default.png'; 

            // $customers_id_link = tep_href_link(FILENAME_CUSTOMERS, 'cID=' . $order['customers_id']);
            $order['amount'] = $currencies->format($order['amount']);
            $order['date_created'] = date('d.m.Y', $order['date_created']);
            $order['customers_link'] = tep_href_link(FILENAME_CUSTOMERS, 'id=' . $order['customers_id'] . '&action=edit_customers');
            $order['order_link'] = tep_href_link(FILENAME_EDIT_ORDERS, 'oID=' . $order['id']);
//            $order['order_status_color'] = $order_statuses_colors[$order['status_id']]?:'bg-danger text-white';/* !!!! */
            $order['order_status_color'] = $orders_statuses[$order['status_id']]['color']?sprintf('text-white" style="background-color: %s"',$orders_statuses[$order['status_id']]['color']):'bg-danger text-white';/* !!!! */
            $order['status_id'] = $orders_statuses[$order['status_id']]['name']?:'-';

            $fetchResults[] = $order;
            $definesArray = array(
                // 'DIR_WS_CATALOG' => DIR_WS_CATALOG, 
                'TEXT_BLOCK_OVERVIEW_ACTION_EDIT' => TEXT_BLOCK_OVERVIEW_ACTION_EDIT);

            $headersArray = array(
                // 'DIR_WS_CATALOG' => DIR_WS_CATALOG, 
                'TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME' => TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME,
                'TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE' => TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE,
                'TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT' => TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT,
                'TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS' => TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS,
                'empty' => '');

            $response = array(
                'status' => true,
                'msg' => 'Data exists.',
                'id' => 'latest-orders',
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


<div id="latest-orders" class="tab-pane fade active in hidden-scroll">
    <?php
    
        // Fetch order statuses
        $orders_statuses = array();
        $query = tep_db_query("SELECT orders_status_id, orders_status_name, orders_status_color FROM " . TABLE_ORDERS_STATUS . " WHERE language_id = '" . (int)$languages_id . "'");
        while ($orders_status = tep_db_fetch_array($query)) {
            $orders_statuses[$orders_status['orders_status_id']] = [
                'name' => $orders_status['orders_status_name'],
                'color' => $orders_status['orders_status_color'],
            ];
        }
    
        $fetchResults = array();
        // $query = tep_db_query("SELECT pd.products_id AS id, pd.products_name AS name, p.products_ordered as orders, p.products_image AS images FROM " . TABLE_PRODUCTS_DESCRIPTION . " pd LEFT JOIN " . TABLE_PRODUCTS . " p ON (pd.products_id = p.products_id) WHERE pd.language_id = " . $languages_id . " AND p.products_ordered > 0 
        // ORDER BY p.products_ordered DESC  LIMIT $offsetItems, 20");

        $query = tep_db_query("SELECT o.orders_id AS id,
                                      o.customers_id, 
                                      o.customers_name, 
                               UNIX_TIMESTAMP(o.date_purchased) AS date_created, ot.value AS amount, o.orders_status AS status_id 
                               FROM " . TABLE_ORDERS . " o 
                               LEFT JOIN " . TABLE_ORDERS_TOTAL . " ot ON (o.orders_id = ot.orders_id) 
                               AND ot.class = 'ot_total' 
                               ORDER BY o.date_purchased DESC 
                               LIMIT 20");


        if (1 == 1) {
        if ($query->num_rows) {
            while ($order = tep_db_fetch_array($query)) {
                $image_file_name = explode(';', $order['images']);
                if($image_file_name[0]!='') $image_file_name = '../getimage/50x50/products/' . $image_file_name[0] . '';
                else $image_file_name = '../getimage/50x50/products/default.png'; 

                // $customers_id_link = tep_href_link(FILENAME_CUSTOMERS, 'cID=' . $order['customers_id']);
                $order['amount'] = $currencies->format($order['amount']);
                $order['date_created'] = date('d.m.Y', $order['date_created']);
                $order['customers_link'] = tep_href_link(FILENAME_CUSTOMERS, 'cID=' . $order['customers_id']);
                $order['order_link'] = tep_href_link(FILENAME_ORDERS, 'id=' . $order['id'] . '&action=edit_orders');
//                $order['order_status_color'] = $order_statuses_colors[$order['status_id']]?:'bg-danger text-white';
                $order['order_status_color'] = $orders_statuses[$order['status_id']]['color']?sprintf('text-white" style="background-color: %s"',$orders_statuses[$order['status_id']]['color']):'bg-danger text-white';/* !!!! */
                $order['status_id'] = $orders_statuses[$order['status_id']]['name']?:'-';

                $fetchResults[] = $order;
                $definesArray = array(
                    // 'DIR_WS_CATALOG' => DIR_WS_CATALOG, 
                    'TEXT_BLOCK_OVERVIEW_ACTION_VIEW' => TEXT_BLOCK_OVERVIEW_ACTION_EDIT);

                $response = array(
                    'status' => true,
                    'msg' => 'Data exists.',
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

        //   echo '<script>console.log('.json_encode($response).')</script>';

        echo json_encode($response);
        
}
        

    ?>
    <table class="table m-b-none">
        <tr>
            <th><?php print TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_CUSTOMER_NAME; ?></th>
            <th><?php print TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_DATE; ?></th>
            <th><?php print TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_AMOUNT; ?></th>
            <th><?php print TEXT_BLOCK_OVERVIEW_LATEST_ORDERS_STATUS; ?></th>
            <th></th>
        </tr>
        <?php
            

            while ($order = tep_db_fetch_array($query)) {
            ?>
            <tr>
                <td class="text-info text-xs">
                    <a class="text-ellipsis inline" href="<?php print tep_href_link(FILENAME_CUSTOMERS, 'cID=' . $order['customers_id']); ?>" target="_blank" data-toggle="tooltip" data-placement="right" title="<?php print $order['customers_name']; ?>"><?php print $order['customers_name']; ?></a>
                </td>
                <td class="text-xs">
                    <?php print date('d.m.Y', $order['date_created']); ?>
                </td>
                <td class="text-xs">
                    <?php print $currencies->format($order['amount']); ?>
                </td>
                <td>
                    <span class="label <?php print $orders_statuses[$order['status_id']]['color']?sprintf('text-white" style="background-color: %s"',$orders_statuses[$order['status_id']]['color']):'bg-danger text-white'; ?>"><?php print $orders_statuses[$order['status_id']]['name']?:'-'; ?></span>
                </td>
                <td class="text-info">
                    <a href="<?php print tep_href_link(FILENAME_ORDERS, 'id=' . $order['id'] . '&action=edit_orders'); ?>" title="<?php print TEXT_BLOCK_OVERVIEW_ACTION_EDIT; ?>">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>