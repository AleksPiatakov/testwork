<?php
$getOrdersQuery = tep_db_query("SELECT * FROM " . TABLE_QUICK_ORDERS . " ORDER BY status, time DESC ");
require_once DIR_WS_LANGUAGES . $language_short . "/" . $language . "/customers.php";
$action = $_GET['action'];
switch ($action) {
    case "change_status":
        $id = $_POST['id'];
        $val = $_POST['val'];
        tep_db_query("UPDATE " . TABLE_QUICK_ORDERS . " SET status=" . (int)$val . " WHERE quick_orders_id = " . (int)$id);
        echo json_encode(["success" => true]);
        break;
    case "delete":
        $id = $_POST['id'];
        tep_db_query("DELETE FROM " . TABLE_QUICK_ORDERS . " WHERE quick_orders_id = " . (int)$id);
        echo json_encode(["success" => true]);
        break;
}
if ($action) {
    die;
}

include_once('html-open.php');
include_once('header.php');
?>
    <div class="wrapper-title">
        <div class="bg-light lter ng-scope">
            <h1 class="m-n font-thin h3"><?php echo TEXT_QUICK_ORDER; ?></h1>
        </div>
    </div>
    <div class="row">
        <table class="table orders-table table-hover table-bordered bg-white-only b-t b-light orders inner_loader"
               id="own_table">
            <thead>
            <th><?= TEXT_CUST_XLS_PHONE ?></th>
            <th><?= TABLE_HEADING_DATE ?></th>
            <th><?= TEXT_SUMMARY_PRODUCTS ?></th>
            <th><?= TEXT_VIEWED ?></th>
            </thead>
            <tbody>
            <?php
            while ($order = tep_db_fetch_array($getOrdersQuery)) {
                ?>
                <tr>
                    <td><?= $order['phone_number'] ?></td>
                    <td><?= $order['time'] ?></td>
                    <td><a target="_blank" href="<?= $order['referer'] ?>"><?= TEXT_SUMMARY_PRODUCTS ?></a></td>
                    <td class="space_between">
                        <input type="checkbox" <?= ($order['status'] == 1) ? "checked" : "" ?>
                               class="change_status_quick_order" data-id="<?= $order['quick_orders_id'] ?>">
                        <a data-id="<?= $order['quick_orders_id'] ?>"
                           class="delete_order space_between"><?= TEXT_MODAL_DELETE_ACTION ?></a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script>
            $(".change_status_quick_order").click(function () {
                var menuQuickOrderText = $('.item-menu.active>a .quick_orders_menu_count').text();
                if($(this).is(':checked')){
                    menuQuickOrderText = Number(menuQuickOrderText) - Number(1);
                }else{
                    menuQuickOrderText = Number(menuQuickOrderText) + Number(1);
                }
                $('.quick_orders_menu_count').text(menuQuickOrderText);

                $.ajax({
                    url: "?action=change_status",
                    type: "post",
                    data: {
                        id: $(this).attr('data-id'),
                        val: ($(this).is(":checked") ? 1 : 0)
                    }
                })
            });
            $(".delete_order").click(function (e) {
                e.preventDefault();
                let $this = $(this);
                $.ajax({
                    url: "?action=delete",
                    type: "post",
                    data: {
                        id: $(this).attr('data-id')
                    },
                    success: function (data) {
                        try {
                            data = JSON.parse(data);
                            if (data.success = true)
                                $this.parent().parent().remove();
                        } catch (e) {
                            return;
                        }
                    }
                })
            })
        </script>
        <style>
            .space_between {
                display: flex;
                justify-content: space-between;
            }
        </style>
    </div>
<?php
require_once "footer.php";
?>
