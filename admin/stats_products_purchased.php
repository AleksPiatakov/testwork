<?php

require('includes/application_top.php');

use admin\includes\solomono\app\models\stats_products_purchased\stats_products_purchased;

$filename = basename(__FILE__, ".php");

$startsProductsPurchased = new stats_products_purchased();

$start_date = isset($_GET['start_date']) ? tep_db_input($_GET['start_date']) : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? tep_db_input($_GET['end_date']) : date('Y-m-d');

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $startsProductsPurchased->query($_GET);
    echo json_encode($startsProductsPurchased->data);
    exit;
}

include_once('html-open.php');
include_once('header.php'); ?>
<script>
    var lang = <?= $startsProductsPurchased->getTranslation(); ?>;
</script>
<div class="container">
    <?= $startsProductsPurchased->getView('stats_products_purchased/stats_products_purchased'); ?>
</div>
<script>
    $(document).ready(function () {
        $('#own_table').on('click', 'td[data-name="products_name"]', function () {
            document.location.href = '<?= FILENAME_PRODUCTS; ?>' + '?action=new_product&pID=' + $(this).closest('tr').attr('data-id');
        })
    })
</script>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
