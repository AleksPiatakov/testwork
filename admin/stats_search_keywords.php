<?php
require('includes/application_top.php');

use admin\includes\solomono\app\models\stats_search_keywords\stats_search_keywords;

$filename = basename(__FILE__, ".php");

$stats_search_keywords = new stats_search_keywords();


if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $stats_search_keywords->query($_GET);
    echo json_encode($stats_search_keywords->data);
    exit;
}

?>

<?php
include_once('html-open.php');
include_once('header.php');
?>
    <script>
        var lang=<?php echo $stats_search_keywords->getTranslation();?>;
    </script>
    <div class="container">
        <?php echo $stats_search_keywords->getView('stats_search_keywords/stats_search_keywords');?>
    </div>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>