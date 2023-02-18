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
    $query = tep_db_query("SELECT search_text AS text, search_count AS count FROM search_queries_sorted ORDER BY search_count DESC LIMIT $offsetItems, 20");

    if ($query->num_rows) {
        while ($search_query = tep_db_fetch_array($query)) {

            $fetchResults[] = $search_query;
            // $definesArray = array('DIR_WS_CATALOG' => DIR_WS_CATALOG, 'TEXT_BLOCK_OVERVIEW_ACTION_VIEW' => TEXT_BLOCK_OVERVIEW_ACTION_VIEW);

            $headersArray = array(
                'TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY' => TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY,
                'TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT' => TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT);

            $response = array(
                'status' => true,
                'msg' => 'Data exists.',
                'id' => 'most-searches',
                'headers' => $headersArray,
                'data' => $fetchResults,
                'defines' => []
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


<div id="most-searches" class="tab-pane fade hidden-scroll">
    <?php

    $query = tep_db_query("SELECT search_text AS text, search_count AS count FROM search_queries_sorted ORDER BY search_count DESC LIMIT 20");

    ?>
    <table class="table table-striped m-b-none">
        <tr>
            <th><?php print TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_QUERY; ?></th>
            <th><?php print TEXT_BLOCK_OVERVIEW_MOST_SEARCHED_COUNT; ?></th>
            <?php

            while ($search_query = tep_db_fetch_array($query)) {
            ?>
        <tr>
            <td class="text-xs"><?php print $search_query['text']; ?></td>
            <td class="text-xs"><?php print $search_query['count']; ?></td>
        </tr>
        <?php
        }

        ?>
        </tr>
    </table>
</div>