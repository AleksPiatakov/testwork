<?php
//debug($data);
//debug($action);

$send_data = $data['data'][0];

$html = str_get_html($send_data['content']);
$foundImages = $html->find('img');
foreach ($foundImages as &$img) {
    $img->src = addHostnameToLink($img->src);
}
$send_data['content'] = (string)$html;

$send_languages = $data['languages'];
include(DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/newsletters/' . $send_data['module'] . '.php');
include(DIR_WS_MODULES . 'newsletters/' . $send_data['module'] . '.php');
$module_name = $send_data['module'];
$module = new $module_name($send_data['title'], $send_data['content']);
?>

<tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
            <tr>
                <td class="main" valign="middle"><?php echo tep_image(DIR_WS_IMAGES . 'ani_send_email.gif', IMAGE_ANI_SEND_EMAIL); ?></td>
                <td class="main" valign="middle"><b><?php echo TEXT_PLEASE_WAIT; ?></b></td>
            </tr>
        </table></td>
</tr>
<?php
tep_set_time_limit(0);
flush();
if (tep_not_null($mode)) {
    $module->send($send_data['id'], $mode);
} else {
    $module->send($send_data['id']);
}
?>
<tr>
    <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
</tr>
<tr>
    <td class="main"><font color="#ff0000"><b><?php echo TEXT_FINISHED_SENDING_EMAILS; ?></b></font></td>
</tr>
<tr>
    <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
</tr>
<tr>
    <td><?php echo '<a href="' . tep_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
</tr>

