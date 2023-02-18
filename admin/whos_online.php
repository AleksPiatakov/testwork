<?php

require('includes/application_top.php');
use admin\includes\solomono\app\models\whos_online\whos_online;
$filename = basename(__FILE__, ".php");
$online_list = new whos_online();

if (isset($_GET['ajax_load']) && $_GET['ajax_load'] == 'show') {
    $online_list->query($_GET);
    echo json_encode($online_list->data);
    exit;
}

include_once('html-open.php');
include_once('header.php');

?>

<style>
    #own_table.whos_online tr>th:last-of-type {
        display: none;
    }

    #own_table.whos_online tr>td:last-of-type {
        display: none;
    }
</style>
<?php

$sessionsId = implode(',',array_map(function($sId){return "'$sId'";},$online_list->getSessionsId()));
?>
<script>
    var lang=<?php echo $online_list->getTranslation();?>;

    var sessionIds = [<?=$sessionsId?>]
    function getContent() {
        var queryString = {timestamp : new Date().getTime(), sessionIds : sessionIds};

        $.ajax(
            {
                type: 'POST',
                url: '<?=HTTP_SERVER.DIR_WS_ADMIN.DIR_WS_MODULES.'whos_online.php'?>',
                data: queryString,
                dataType: 'JSON',
                success: function(data){
                    sessionIds = data.sessionIds;
                    $('select#per_page').change();
                    getContent();

                }
            }
        );
    }
    $(function() {
        getContent();
    });

</script>

<div class="container">
    <?php echo $online_list->getView();?>
</div>

<?php
    include_once('footer.php');
    include_once('html-close.php');
    require(DIR_WS_INCLUDES . 'application_bottom.php');
?>