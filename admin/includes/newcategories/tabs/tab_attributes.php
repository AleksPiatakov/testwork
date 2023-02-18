<?php
$_GET['pID'] = $_GET['id'];
require_once('attributeManager/includes/attributeManagerHeader.inc.php');
?>
<div data-lang="tab_attributes">
    <h3 class="text-center"><?= TEXT_PROD_ATTRIBUTES_TITLE ?></h3>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <!-- AJAX Attribute Manager  -->
        <?php require_once('attributeManager/includes/attributeManagerPlaceHolder.inc.php'); ?>
        <!-- AJAX Attribute Manager end -->
    </table>
    <script>
        attributeManagerInit();
    </script>
</div>
