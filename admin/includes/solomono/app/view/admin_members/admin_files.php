<?php
//debug($data);
?>
<div class="container-fluid">
	<div class="wrapper-title" style="padding: 28px 0 7px; margin-left: -14px;">
		<div class="bg-light lter ng-scope">
			<h1 class="m-n font-thin h3"><?php echo HEADING_TITLE;?></h1>
		</div>
	</div>
    <div class="row">
        <div class="col-md-3">
            <ul id="tab" class="nav" style="margin-top:15px;">
                <?php foreach ($data['admin_groups'] as $value): ?>
                    <li>
                        <a href="<?php echo  ($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']) . '?info=' . $action . '&admin_groups_id=' . $value['id']; ?>">
                            <?php echo  $value['admin_groups_name']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if ($_SESSION['login_id'] == "1"): ?>

            <div class="text-center">
                <a id="add_file" class="w-full btn btn-default " href="<?=($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']).'?action=add_admin_files'?>" role="button">Добавить файл</a>
                <a id="remove_file" class="w-full btn btn-default " href="<?=($_SERVER['SCRIPT_URL']?:$_SERVER['SCRIPT_NAME']).'?action=remove_admin_files'?>" role="button">Удалить файл</a>
            </div>
            <?php endif; ?>
        </div>


        <div class="col-md-9">
            <?php foreach ($data['result'] as $groupName => $arr): ?>
                <div class="row">
                    <h3><?php echo  (defined($groupName) ? constant($groupName) : $groupName) ?></h3>
                    <?php foreach ($arr as $value): ?>
                        <div class="col-md-4 admin_switch">
                            <div class="switch">
                                <input id="cmn-toggle-<?php echo  $value['admin_files_id']; ?>" class="cmn-toggle cmn-toggle-round" <?php echo  ($value['checked']) ? 'checked' : '' ?> type="checkbox">
                                <label class="admin_label" for="cmn-toggle-<?php echo  $value['admin_files_id']; ?>"></label><span><?php echo (defined($value['admin_files_name']) ? constant($value['admin_files_name']) : $value['admin_files_name']); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script>
    $('.switch input').on('change', function (e) {
        var id = $(this).attr('id').match(/[0-9]+/)[0];
        var urlSelf = window.location.href;
        $.post(urlSelf, {id: id}, function (response) {
            show_tooltip(response.msg, 500);
        }, "json");
    });
    var pathnameLoacation = window.location.pathname + window.location.search;
    if ($("#tab>li>a[href='" + pathnameLoacation + "']").length) {
        $("#tab>li>a[href='" + pathnameLoacation + "']").addClass('active');
    } else {
        $("#tab>li>a").eq(0).addClass('active');
    }
    // var divs = $(".admin_switch > .switch");
    // for(var i = 0; i < divs.length; i+=3) {
    //     divs.slice(i, i+3).wrapAll("<div class='row'></div>");
    // }
</script>