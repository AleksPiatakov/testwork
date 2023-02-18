<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\stats_customers\stats_customers;

$filename = basename(__FILE__, ".php");

$stats_customers = new stats_customers();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $stats_customers->query($_GET);
    echo json_encode($stats_customers->data);
    exit;
}

if ($stats_customers->isAjax()) {

    $action = $_GET['action'];

    $action = $_POST['action'];
}

?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang=<?php echo $stats_customers->getTranslation();?>;
    </script>
    <div class="container">
        <?php echo $stats_customers->getView('stats_customers/stats_customers');?>
    </div>
    <script>
        $(document).ready(function () {
            $('#own_table').on('click', 'td[data-name="fio"]', function () {
                document.location.href='<?php echo FILENAME_CUSTOMERS?>'+'?action=edit_customers&id='+$(this).closest('tr').attr('data-id');
            })
        })
    </script>

<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>