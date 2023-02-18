<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\stats_products_viewed\stats_products_viewed;

$filename = basename(__FILE__, ".php");

$stats_products_viewed = new stats_products_viewed();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $stats_products_viewed->query($_GET);
    echo json_encode($stats_products_viewed->data);
    exit;
}

?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang=<?php echo $stats_products_viewed->getTranslation();?>;
    </script>
    <div class="container">
        <?php echo $stats_products_viewed->getView('stats_products_viewed/stats_products_viewed');?>
    </div>
    <script>
        $(document).ready(function () {
            $('#own_table').on('click', 'td[data-name="products_name"]', function () {
                document.location.href='<?php echo FILENAME_PRODUCTS; ?>'+'?action=new_product&pID='+$(this).closest('tr').attr('data-id');
            })
        })
    </script>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>