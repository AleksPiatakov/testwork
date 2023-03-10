<?php
/*
  $Id: newsletter.php,v 1.1.1.1 2003/09/18 19:03:34 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  class newsletter {
    var $show_choose_audience, $title, $content;

    function __construct($title, $content) {
      //+Select Recipients Mod
      $this->show_choose_audience = true;
      //-Select Recipients Mod
      $this->title = $title;
      //raid dlia kartinok:
//      $content = preg_replace('/11/', '77', $content);
        $content = preg_replace('/\/userfiles/', HTTP_SERVER.'/userfiles', $content);
      //raid dlia kartinok:
      $this->content = $content;
    }

    function choose_audience() {
      //+Select Recipients Mod
      global $_GET, $languages_id;

      $recipients_array = array();
      $recipients_query = tep_db_query("select customers_id, customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " ");
      while ($recipients = tep_db_fetch_array($recipients_query)) {
        $recipients_array[] = array('id' => $recipients['customers_id'],
                                  'text' => '#'.$recipients['customers_id'].' '.$recipients['customers_firstname'] . ' ' . $recipients['customers_lastname']);
      }

$choose_audience_string = '<script language="javascript"><!--
function mover(move) {
  if (move == \'remove\') {
    for (x=0; x<(document.notifications.elements[\'recipients[]\'].length); x++) {
      if (document.notifications.elements[\'recipients[]\'].options[x].selected) {
        with(document.notifications.removed) {
          options[options.length] = new Option(document.notifications.elements[\'recipients[]\'].options[x].text,document.notifications.elements[\'recipients[]\'].options[x].value);
        }
        document.notifications.elements[\'recipients[]\'].options[x] = null;
        x = -1;
      }
    }
  }
  if (move == \'add\') {
    for (x=0; x<(document.notifications.removed.length); x++) {
      if (document.notifications.removed.options[x].selected) {
        with(document.notifications.elements[\'recipients[]\']) {
          options[options.length] = new Option(document.notifications.removed.options[x].text,document.notifications.removed.options[x].value);
        }
        document.notifications.removed.options[x] = null;
        x = -1;
      }
    }
  }
  return true;
}

function selectAll(FormName, SelectBox) {
  temp = "document." + FormName + ".elements[\'" + SelectBox + "\']";
  Source = eval(temp);
  for (x=0; x<(Source.length); x++) {
    Source.options[x].selected = "true";
  }

  if (x<1) {
    alert(\'' . JS_PLEASE_SELECT_RECIPIENTS . '\');
    return false;
  } else {
    return true;
  }
}
//--></script>';

      $cancel_button = '<script language="javascript"><!--' . "\n" .
                       'document.write(\'<input type="button" value="' . BUTTON_CANCEL . '" style="width: 8em;" onclick="document.location=\\\'' . tep_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '\\\'">\');' . "\n" .
                       '//--></script><noscript><a href="' . tep_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '">[ ' . BUTTON_CANCEL . ' ]</a></noscript>';

      $choose_audience_string .= '<p align="center" class="main">' . TEXT_CHOOSE_AUDIENCE_INSTRUCTIONS . '</p>' . "\n" .
                                 '<form name="notifications" action="' . tep_href_link(FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] . '&nID=' . $_GET['nID'] . '&action=confirm', 'SSL') . '" method="post" onSubmit="return selectAll(\'notifications\', \'recipients[]\')"><table border="0" width="100%" cellspacing="0" cellpadding="2">' . "\n" .
                                 '  <tr>' . "\n" .
                                 '    <td align="center" class="main"><b>' . TEXT_UNSELECTED . '</b><br>' . tep_draw_pull_down_menu('removed', array(), '', 'size="40" style="width: 20em;" multiple') . '</td>' . "\n" .
                                 '    <td align="center" class="main">&nbsp;<input type="button" value="' . BUTTON_SELECT . '" style="width: 8em;" onClick="mover(\'add\');"><br><br><input type="button" value="' . BUTTON_UNSELECT . '" style="width: 8em;" onClick="mover(\'remove\');"><br><br><br><input type="submit" value="' . BUTTON_SUBMIT . '" style="width: 8em;"><br><br>' . $cancel_button . '</td>' . "\n" .
                                 '    <td align="center" class="main"><b>' . TEXT_RECIPIENTS . '</b><br>' . tep_draw_pull_down_menu('recipients[]', $recipients_array, '', 'size="40" style="width: 20em;" multiple') . '</td>' . "\n" .
                                 '  </tr>' . "\n" .
                                 '</table></form>';

      return $choose_audience_string;
      //-Select Recipients Mod
    }

    function confirm() {
      //+Select Recipients Mod
      global $_GET, $_POST;
      //-Select Recipients Mod
      if(!empty($_POST['recipients'])){
          //+Select Recipients Mod
          $recipients = $_POST['recipients'];

          $ids = implode(',', $recipients);

          //GCD make sure we only send newsletters to approved members
          $customers_query = tep_db_query("select customers_id from " . TABLE_CUSTOMERS . " where customers_id in (" . $ids . ")");
          while ($customers = tep_db_fetch_array($customers_query)) {
            $audience[$customers['customers_id']] = '1';
          }
          //-Select Recipients Mod

          $confirm_string = '<table border="0" cellspacing="0" cellpadding="2">' . "\n" .
                            '  <tr>' . "\n" .
           //+Select Recipients Mod
                            '    <td class="main"><font color="#ff0000"><b>' . sprintf(TEXT_COUNT_CUSTOMERS, sizeof($audience)) . '</b></font></td>' . "\n" .
          //-Select Recipients Mod                        '  </tr>' . "\n" .
                            '  <tr>' . "\n" .
                            '    <td>' . tep_draw_separator('pixel_trans.png', '1', '10') . '</td>' . "\n" .
                            '  </tr>' . "\n" .
                            '  <tr>' . "\n" .
                            '    <td class="main"><b>' . $this->title . '</b></td>' . "\n" .
                            '  </tr>' . "\n" .
                            '  <tr>' . "\n" .
                            '    <td>' . tep_draw_separator('pixel_trans.png', '1', '10') . '</td>' . "\n" .
                            '  </tr>' . "\n" .
                            '  <tr>' . "\n" .
                            '    <td class="main"><tt>' . $this->content . '</tt></td>' . "\n" .
                            '  </tr>' . "\n" .
                            '  <tr>' . "\n" .
                            '    <td>' . tep_draw_separator('pixel_trans.png', '1', '10') . '</td>' . "\n" .
                            '  </tr>' . "\n" .
          //+Select Recipients Mod
                            '  <tr>' . tep_draw_form('confirm', FILENAME_NEWSLETTERS, 'page=' . $_GET['page'] ? : 1 . '&id=' . $_POST['id'] . '&action=confirm_send') . "\n" .
                            '    <td align="right">';
          if (sizeof($audience) > 0) {
            for ($i = 0, $n = sizeof($recipients); $i < $n; $i++) {
              $confirm_string .= tep_draw_hidden_field('recipients[]', $recipients[$i]);
            }
            $confirm_string .= tep_image_submit('button_send.gif', IMAGE_SEND) . ' ';
          }
          $confirm_string .= '<a href="' . tep_href_link(FILENAME_NEWSLETTERS, 'page=' . ($_GET['page'] ? $_GET['page'] : 1) . '&id=' . $_POST['id'] . '&action=send') . '">' . tep_text_button(BUTTON_BACK_NEW) . '</a> <a href="' . tep_href_link(FILENAME_NEWSLETTERS, 'page=' . ($_GET['page'] ? $_GET['page'] : 1) . '&id=' . $_POST['id']) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a></td>' . "\n" .
                             '  </tr>' . "\n" .
                             '</table>';
          //-Select Recipients Mod
        } else {
            $confirm_string = '<table border="0" cellspacing="0" cellpadding="2"><tr><td>choose recipient <br/>';
            $confirm_string .= '<a href="' . tep_href_link(FILENAME_NEWSLETTERS, 'page=' . ($_GET['page'] ? $_GET['page'] : 1) . '&id=' . $_POST['id'] . '&action=send') . '">' . tep_text_button(BUTTON_BACK_NEW) . '</a> <a href="' . tep_href_link(FILENAME_NEWSLETTERS, 'page=' . ($_GET['page'] ? $_GET['page'] : 1) . '&id=' . $_POST['id']) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a></td>';
            $confirm_string .='</td></tr></table>';

        }
      return $confirm_string;
    }

    function send($newsletter_id) {
      //+Select Recipients Mod
      global $_POST;

      $audience = array();

      $recipients = $_POST['recipients'];
      $ids = implode(',', $recipients);

      $customers_query = tep_db_query("select customers_id, customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id in (" . $ids . ")");
      while ($customers = tep_db_fetch_array($customers_query)) {
        $audience[$customers['customers_id']] = array('firstname' => $customers['customers_firstname'],
                                                     'lastname' => $customers['customers_lastname'],
                                                     'email_address' => $customers['customers_email_address']);
      }
      //-Select Recipients Mod

      $mimemessage = new email(array('X-Mailer: osCommerce bulk mailer'));
      $mimemessage->add_html($this->content);
      $mimemessage->build_message();
      //+Select Recipients Mod
      reset($audience);
        foreach ($audience as $key=>$value) {
        //$mimemessage->send($value['firstname'] . ' ' . $value['lastname'], $value['email_address'], STORE_OWNER, (EMAIL_FROM ?: STORE_OWNER_EMAIL_ADDRESS), $this->title);
          tep_mail($value['firstname'] . ' ' . $value['lastname'], $value['email_address'], $this->title, $this->content, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      }
      //-Select Recipients Mod

      $newsletter_id = tep_db_prepare_input($newsletter_id);
      tep_db_query("update " . TABLE_NEWSLETTERS . " set date_sent = now(), status = '1' where newsletters_id = '" . tep_db_input($newsletter_id) . "'");
    }
  }
?>
