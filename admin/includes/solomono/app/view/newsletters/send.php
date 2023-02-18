<?php
//debug($data);
//debug($action);


$send_data = $data['data'][0];
$send_languages = $data['languages'];
include(DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/newsletters/' . $send_data['module'] . '.php');
include(DIR_WS_MODULES . 'newsletters/' . $send_data['module'] . '.php');
$module_name = $send_data['module'];
$module = new $module_name($send_data['title'], $send_data['content']);
?>

<input type="hidden" name="action" value="confirm_send">
<input type="hidden" name="nID" value="<?=$send_data['id']?>">
<tr>
    <td><?php echo $module->confirm(); ?></td>
</tr>
