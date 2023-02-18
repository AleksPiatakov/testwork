<?php

$location = ' : <a href="' . tep_href_link(
        'pollbooth.php',
        'op=results',
        'NONSSL') . '" class="headerNavigation"> ' . (defined(
        'NAVBAR_TITLE_1') ? NAVBAR_TITLE_1 : 'NAVBAR_TITLE_1') . '</a>';
DEFINE('MAX_DISPLAY_NEW_COMMENTS', '5');

?>
<table border="0" width="100%" cellspacing="0" cellpadding="<?php echo getConstantValue('CELLPADDING_SUB', '0'); ?>">
    <?php
    // Set number of columns in listing
    define('NR_COLUMNS', 2); ?>

    <!-- body_text //-->
    <td width="100%" valign="top">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>


            <tr>
                <td>
                    <table width="100%">
                        <?php
                        if (!isset($_GET['op'])) {
                            $_GET['op'] = "list";
                        }
                        switch ($_GET['op']) {
                            case "results":
                                if (isset($_GET['pollid'])) {
                                    $pollid = $_GET['pollid'];
                                } else {
                                    $pollid = 1;
                                }
                                $poll_query = tep_db_query(
                                    "SELECT pollid, timeStamp FROM " . TABLE_PHESIS_POLL_DESC . " WHERE pollid='" . tep_db_input(
                                        $pollid) . "'");
                                $polls = tep_db_fetch_array($poll_query);
                                $title_query = tep_db_query(
                                    "SELECT optionText from " . TABLE_PHESIS_POLL_DATA . " where pollid='" . tep_db_input(
                                        $pollid) . "' and voteid='0' and language_id = '" . (int)$languages_id . "'");
                                $title = tep_db_fetch_array($title_query);
                                ?>
                                <tr>
                                    <td colspan="2"><h3><?php echo $title['optionText'] ?></h3></td>
                                </tr>

                                <?php
                                $query = "SELECT SUM(optionCount) AS sum FROM " . TABLE_PHESIS_POLL_DATA . " WHERE pollid='" . tep_db_input(
                                        $pollid) . "' and language_id = '" . (int)$languages_id . "'";

                                $result = tep_db_query($query);
                                $polls = tep_db_fetch_array($result);
                                $sum = $polls['sum'];
                                for ($i = 1; $i <= 15; $i++) {
                                    $query = "SELECT pollid, optiontext, optioncount, voteid FROM " . TABLE_PHESIS_POLL_DATA . " WHERE (language_id = '" . (int)$languages_id . "') and (pollid='" . tep_db_input(
                                            $pollid) . "') AND (voteid='" . (int)$i . "')";
                                    $result = tep_db_query($query);
                                    $polls = tep_db_fetch_array($result);
                                    $optiontext = $polls['optiontext'];
                                    $optioncount = $polls['optioncount'];
                                    if ($optiontext) {
                                        ?>
                                        <tr>
                                            <td valign="top">
                                                <?php echo $optiontext ?>
                                                <?php
                                                if ($sum) {
                                                    $percent = 100 * $optioncount / $sum;
                                                } else {
                                                    $percent = 0;
                                                }
                                                $percentInt = (int)$percent * 4 * 1;
                                                $percent2 = (int)$percent;

                                                ?>

                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         aria-valuenow="<?php echo $percent2 ?>" aria-valuemin="0"
                                                         aria-valuemax="100" style="width: <?php echo $percent2 ?>%;">
                                                        <?php echo $percent2 ?>%
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }

                                if (($comments_numrows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
                                    ?>
                                    <tr>
                                        <td colspan="2"><br>
                                            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                                <tr>
                                                    <td class="smallText"><?php echo $comments_split->display_count(
                                                            $comments_numrows,
                                                            MAX_DISPLAY_NEW_COMMENTS,
                                                            $_GET['page'],
                                                            TEXT_DISPLAY_NUMBER_OF_COMMENTS); ?></td>
                                                    <td align="right"
                                                        class="smallText"><?php echo TEXT_RESULT_PAGE; ?><?php echo $comments_split->display_links(
                                                            $comments_numrows,
                                                            MAX_DISPLAY_NEW_COMMENTS,
                                                            MAX_DISPLAY_PAGE_LINKS,
                                                            $_GET['page'],
                                                            tep_get_all_get_params(
                                                                array('page', 'info', 'x', 'y'))); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php

                                    while ($comments = tep_db_fetch_array($comments_query)) {
                                        if ($comments['customer_id'] != '0') {
                                            $name_query = tep_db_query(
                                                "select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . tep_db_input(
                                                    $comments['customer_id']) . "'");
                                            $name = tep_db_fetch_array($name_query);
                                            $comment_name = $name['customers_firstname'] . " " . $name['customers_lastname'];
                                        } else {
                                            $comment_name = $comments['name'];
                                        }

                                        $post_details = _COMMENTS_BY . $comment_name . ' [' . $comments['host_name'] . ']' . _COMMENTS_ON . $comments['date'];
                                        ?>
                                        <?php if (SHOW_POLL_COMMENTS == '1') { ?>

                                            <tr>
                                                <td class="main" colspan="2"><b><?php echo $post_details; ?></b></td>
                                            </tr>
                                            <td colspan="2"></td>
                                            <tr>
                                                <td class="main"
                                                    colspan="2"><?php echo htmlspecialchars(
                                                        $comments['comment']); ?></td>
                                            </tr>
                                            <td colspan="2"></td>
                                        <?php } ?>


                                        <?php
                                    }
                                }
                                if (($comments_numrows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
                                    ?>
                                    <tr>
                                        <td colspan="2"><br>
                                            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                                <tr>
                                                    <td class="smallText"><?php echo $comments_split->display_count(
                                                            $comments_numrows,
                                                            MAX_DISPLAY_NEW_COMMENTS,
                                                            $_GET['page'],
                                                            TEXT_DISPLAY_NUMBER_OF_COMMENTS); ?></td>
                                                    <td align="right"
                                                        class="smallText"><?php echo TEXT_RESULT_PAGE; ?><?php echo $comments_split->display_links(
                                                            $comments_numrows,
                                                            MAX_DISPLAY_NEW_COMMENTS,
                                                            MAX_DISPLAY_PAGE_LINKS,
                                                            $_GET['page'],
                                                            tep_get_all_get_params(
                                                                array('page', 'info', 'x', 'y'))); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="2" align="center">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" class="main">
                                        <div class="form-group">
                                            <?php echo _TOTALVOTES ?> <span
                                                    class="label label-default"><?php echo $sum ?> </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" class="main">
                                        <div class="btn-group">
                                            <?php if (defined('SHOW_POLL_COMMENTS') && SHOW_POLL_COMMENTS == '1') { ?>
                                                <a class="btn btn-xs btn-default"
                                                   href="<?php echo tep_href_link(
                                                       'pollbooth.php',
                                                       'pollid=' . $pollid . '&op=comment',
                                                       'NONSSL') ?>"><?php echo _ADD_COMMENTS ?>
                                                </a>

                                            <?php } ?>
                                            <!--<a class="btn btn-xs btn-default"
                                           href="<?php /*echo tep_href_link('pollbooth.php', 'pollid=' . $pollid . '&op=vote', 'NONSSL') */
                                            ?>"><?php /*echo _VOTING */
                                            ?></a>-->

                                            <a class="btn btn-xs btn-default"
                                               href="<?php echo tep_href_link(
                                                   'pollbooth.php',
                                                   'op=list',
                                                   'NONSSL') ?>"><?php echo _OTHERPOLLS ?></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                break;
                            case 'comment':
                                if (isset($_GET['pollid'])) {
                                    $pollid = $_GET['pollid'];
                                } else {
                                    $pollid = 1;
                                }
                                $poll_query = tep_db_query(
                                    "SELECT pollid, timeStamp FROM " . TABLE_PHESIS_POLL_DESC . " WHERE pollid='" . tep_db_input(
                                        $pollid) . "'");
                                $polls = tep_db_fetch_array($poll_query);
                                $title_query = tep_db_query(
                                    "select optionText from " . TABLE_PHESIS_POLL_DATA . " where pollid='" . tep_db_input(
                                        $pollid) . "' and voteid='0' and language_id = '" . (int)$languages_id . "'");
                                $title = tep_db_fetch_array($title_query);
                                ?>
                                <?php echo tep_draw_form(
                                'poll_comment',
                                tep_href_link('pollbooth.php', 'action=do_comment&pollid=' . $pollid),
                                'post'); ?>
                                <tr>
                                    <td colspan="2" align="center"><b><br><br><?php echo $title['optionText'] ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <?php
                                if (!$customer_id) {
                                    ?>
                                    <tr>
                                        <td><?php echo _YOURNAME; ?>
                                            &nbsp;<?php echo tep_draw_input_field('comment_name', ''); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td><?php echo _OTZYV; ?>
                                        <br><?php echo tep_draw_textarea_field('comment', 'soft', '30', '4', ''); ?>
                                    </td>
                                </tr>
                                <?php
                                $nolink = true;
                                break;
                            case 'list':
                                ?>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <?php
                                $result = tep_db_query(
                                    "SELECT pollid, timestamp, voters, poll_type, poll_open FROM " . TABLE_PHESIS_POLL_DESC . " ORDER BY timestamp desc");
                                $row = 0;
                                while ($polls = tep_db_fetch_array($result)) {
                                    $row++;
                                    $id_poll = $polls['pollid'];
                                    if (($row / 2) == floor($row / 2)) {
                                        ?>
                                        <tr class="Payment-even">
                                        <?php
                                    } else {
                                        ?>
                                        <tr class="Payment-odd">
                                        <?php
                                    }
                                    $title_query = tep_db_query(
                                        "select optionText from " . TABLE_PHESIS_POLL_DATA . " where pollid='" . tep_db_input(
                                            $id_poll) . "' and voteid='0' and language_id = '" . (int)$languages_id . "'");
                                    $title = tep_db_fetch_array($title_query);
                                    $fullresults = "<a href=\"" . tep_href_link(
                                            'pollbooth.php',
                                            'op=results&pollid=' . $id_poll,
                                            'NONSSL') . "\">" . _POLLRESULTS . "</a>";
                                    $result1 = tep_db_query(
                                        "SELECT SUM(optioncount) AS sum FROM " . TABLE_PHESIS_POLL_DATA . " WHERE pollid='" . tep_db_input(
                                            $id_poll) . "' and language_id = '" . (int)$languages_id . "'");
                                    $poll_sum = tep_db_fetch_array($result1);
                                    $sum = $poll_sum['sum'];

                                    echo("<td class=\"main\">" . $title['optionText'] . "</td><td class=\"main\">" . _VOTES . " " . $sum . "</td><td class=\"main\">&nbsp;</td><td class=\"main\">" . $fullresults . "</td>");


                                    if ($polls['poll_type'] == '0') {
                                        echo("<td class=\"main\">" . _PUBLIC . "</td>");
                                    } else {
                                        echo("<td class=\"main\">" . _PRIVATE . "</td>");
                                    }
                                    if ($polls['poll_open'] == '0') {
                                        echo("<td class=\"main\">" . _POLLOPEN . "</td>");
                                    } else {
                                        echo("<td class=\"main\">" . _POLLCLOSED . "</td>");
                                    }

                                    echo("</tr>\n");
                                }
                                break;
                            case "vote":
                                if (isset($_GET['pollid'])) {
                                    $pollid = $_GET['pollid'];
                                } else {
                                    $pollid = 1;
                                }

                                $poll_query = tep_db_query(
                                    "select voters from " . TABLE_PHESIS_POLL_DESC . " where pollid='" . tep_db_input(
                                        $pollid) . "'");
                                $poll_details = tep_db_fetch_array($poll_query);
                                $title_query = tep_db_query(
                                    "select optionText from " . TABLE_PHESIS_POLL_DATA . " where pollid='" . tep_db_input(
                                        $pollid) . "' and voteid='0' and language_id = '" . (int)$languages_id . "'");
                                $title = tep_db_fetch_array($title_query);
                                ?>
                                <tr>
                                    <td align="center"><b><?php echo $title['optionText'] ?></b>
                                    <td>
                                </tr>
                                <?php
                                $url = tep_href_link('pollbooth.php', 'op=results&pollid=' . $pollid, 'NONSSL');
                                $content = "<input type=\"hidden\" name=\"pollid\" value=\"" . $pollid . "\">\n";
                                $content .= "<input type=\"hidden\" name=\"forwarder\" value=\"" . $url . "\">\n";
                                for ($i = 1; $i <= 12; $i++) {
                                    $query = tep_db_query(
                                        "select pollid, optiontext, optioncount, voteid from " . TABLE_PHESIS_POLL_DATA . " where (pollid='" . tep_db_input(
                                            $pollid) . "') and (voteid=" . (int)$i . ") and (language_id='" . (int)$languages_id . "')");
                                    if ($result = tep_db_fetch_array($query)) {
                                        if ($result['optiontext']) {
                                            $content .= "<input type=\"radio\" name=\"voteid\" value=\"" . $i . "\">" . $result['optiontext'] . "<br>\n";
                                        }
                                    }
                                }
                                $content .= "<br><center><input type=\"submit\" value=\"" . _VOTE . "\"></center><br>\n";
                                $query = tep_db_query(
                                    "select sum(optioncount) as sum from " . TABLE_PHESIS_POLL_DATA . " where pollid='" . tep_db_input(
                                        $pollid) . "' and language_id = '" . (int)$languages_id . "'");
                                if ($result = tep_db_fetch_array($query)) {
                                    $sum = $result['sum'];
                                }
                                $content .= "[ <a href=\"" . tep_href_link(
                                        'pollbooth.php',
                                        'op=results&pollid=' . $pollid,
                                        'NONSSL') . "\">" . _RESULTS . "</a> | <a href=\"" . tep_href_link(
                                        'pollbooth.php',
                                        'op=list',
                                        'NONSSL') . "\">" . _OTHERPOLLS . "</a> ]";
                                $content .= "</br>" . _VOTES . " " . $sum . "</center>\n";
                                echo '<tr><td align="center"><form name="poll" method="post" action="pollcollect.php">';
                                echo csrf();
                                echo $content;
                                echo '<form>';
                                ?>
                                </td>
                                </tr>
                                <?php
                                break;
                        }
                        ?>
                    </table>
            </tr>
            <?php
            if (!$nolink) {
                ?>
                <?php
            }
            ?>
        </table>
    </td>
    <!-- body_text_smend //-->
</table>
