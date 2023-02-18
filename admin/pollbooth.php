<?php

/*
$Id: pollbooth.php,v 1.15 2003/04/06 22:29:47 wilt Exp $
Altered by TomB to add results on admin side in OSC

The Exchange Project - Community Made Shopping!
http://www.theexchangeproject.org

Copyright (c) 2000,2001 The Exchange Project

Released under the GNU General Public License
*/
require('includes/application_top.php');

if (isset($_GET['pollid'])) {
  $poll_query = tep_db_query("SELECT poll_desc.pollID, poll_desc.timeStamp, poll_data.optionText
                              FROM ".TABLE_PHESIS_POLL_DESC." poll_desc
                              LEFT JOIN ".TABLE_PHESIS_POLL_DATA." poll_data
                              ON (poll_desc.pollID = poll_data.pollID)
                              WHERE poll_desc.pollID = '" . $_GET['pollid'] . "'
                              AND poll_data.voteID = '0'
                              AND poll_data.language_id = '" . $languages_id . "'");
  $poll = tep_db_fetch_array($poll_query);

  ?>
  <div class="modal-content">
    <div class="modal-header">
      <button class="close" type="button" data-dismiss="modal"
              aria-label="<?php echo TEXT_CLOSE_BUTTON; ?>">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title" id="ajaxModalLabel">
        <?php print !empty($poll['optionText']) && isset($_GET['op']) && $_GET['op'] != 'list'?$poll['optionText']:TEXT_POLLB_RESULTS; ?>
      </h4>
    </div>

    <div class="modal-body">
      <?php

      if ($_GET['warn']) {
        ?>
        <div class="alert alert-warning alert-dismissable fade in">
          <button class="close" type="button" data-dismiss="alert">
            <span>×</span>
            <span class="sr-only">Close</span>
          </button>
          <div><span><?php print _WARNING . $_GET['warn'] . '.'; ?></span></div>
        </div>
        <?php
      }

      ?>

      <?php

      if (!isset($_GET['op'])) {
        $_GET['op'] = 'list';
      }

      switch ($_GET['op']) {
        case 'results':
          if (!empty($poll['optionText'])) {
            ?>
            <p class="font-bold text-center"><?php print TEXT_POLLB_RESULTS . ':'; ?></p>
            <?php
          }

          ?>
          <table class="table m-b-xs">
            <thead>
              <tr>
                <th class="no-padder no-border-i" style="width: 30%;"></th>
                <th class="no-padder no-border-i" style="width: 70%;"></th>
              </tr>
            </thead>
            <tbody>
              <?php

              $poll_options_query = tep_db_query("SELECT pollID, optionText, optionCount, voteID FROM ".TABLE_PHESIS_POLL_DATA." WHERE pollID = '" . $poll['pollID'] . "' AND language_id = '" . $languages_id . "' AND voteID != '0' AND optionText IS NOT NULL AND TRIM(optionText) <> '' ORDER BY voteID ASC");
              $poll_answers_query = tep_db_query("SELECT SUM(optionCount) AS sum FROM ".TABLE_PHESIS_POLL_DATA." WHERE pollid = '" . $poll['pollID'] . "' AND language_id = '" . $languages_id . "'");
              $poll_answers = tep_db_fetch_array($poll_answers_query);
              while ($poll_options = tep_db_fetch_array($poll_options_query)) {
                if ($poll_answers['sum']) {
                  $percents = 100 * $poll_options['optionCount'] / $poll_answers['sum'];
                } else {
                  $percents = 0;
                }

                ?>
                <tr>
                  <td class="text-right no-padder-t no-padder-l no-borders-i">
                    <p class="m-b-none"><?php print $poll_options['optionText']; ?></p>
                  </td>
                  <td class="v-middle no-padder-t no-padder-l-r no-borders-i">
                    <div class="progress m-b-none">
                      <div class="progress-bar progress-bar-striped progress-bar-primary" style="transition: none; width: <?php print $percents . '%'; ?>;">
                          <span class="font-bold progress-bar-option-text"><?php printf("%.2f%% (%d)", $percents, $poll_options['optionCount']); ?></span>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php
              }

              ?>
            </tbody>
          </table>

          <p class="text-center m-b-none"><?php print TEXT_POLLB_TOTAL . ': ' . $poll_answers['sum']; ?></p>
          <?php
          break;

        case 'list':
          ?>
          <table class="table table-striped">
            <tbody>
              <?php

              $polls_query = tep_db_query("SELECT poll_desc.pollID, poll_desc.voters, poll_desc.timeStamp, poll_desc.poll_type, poll_desc.poll_open, poll_data.optionText
                                           FROM ".TABLE_PHESIS_POLL_DESC." poll_desc
                                           LEFT JOIN ".TABLE_PHESIS_POLL_DATA." poll_data
                                           ON (poll_desc.pollID = poll_data.pollID)
                                           WHERE poll_data.voteID = '0'
                                           AND poll_data.language_id = '" . $languages_id . "'
                                           ORDER BY poll_desc.timeStamp DESC");
              while ($polls = tep_db_fetch_array($polls_query)) {
                ?>
                <tr>
                  <?php

                  $poll_answers_query = tep_db_query("SELECT SUM(optionCount) AS sum FROM ".TABLE_PHESIS_POLL_DATA." WHERE pollID = '" . $polls['pollID'] . "'");
                  $poll_answers = tep_db_fetch_array($poll_answers_query);

                  ?>
                  <td style="width: 30%;"><?php print $polls['optionText']; ?></td>
                  <td style="width: 20%;"><?php print $poll_answers['sum'] . ' ' . _VOTES; ?></td>
                  <td style="width: 20%;">
                    <a class="ajax-modal" href="<?php print tep_href_link('pollbooth.php', 'op=results&pollid=' . $polls['pollID'], 'NONSSL'); ?>">
                      <?php print _POLLRESULTS; ?>
                    </a>
                  </td>
                  <td style="width: 15%;"><?php print $polls['poll_type'] == 0?_PUBLIC:_PRIVATE; ?></td>
                  <td style="width: 15%;"><?php print $polls['poll_open'] == 0?_POLLOPEN:_POLLCLOSED; ?></td>
                </tr>
                <?php
              }

              ?>
            </tbody>
          </table>
          <?php
          break;
      }

      ?>
    </div>

    <div class="modal-footer">
      <button class="btn btn-info" data-dismiss="modal"><?php print TEXT_MODAL_CONTINUE_ACTION; ?></button>
    </div>
  </div>

  <?php
}

exit;

require(DIR_WS_INCLUDES . 'application_bottom.php');

?>
