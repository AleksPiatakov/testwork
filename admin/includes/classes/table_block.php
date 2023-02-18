<?php
/*
  $Id: table_block.php,v 1.1.1.1 2003/09/18 19:03:49 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class tableBlock {
    var $table_border = '0';
    var $table_width = '100%';
    var $table_cellspacing = '0';
    var $table_cellpadding = '2';
    var $table_parameters = '';
    var $table_row_parameters = '';
    var $table_data_parameters = '';

    function __construct($contents = array()) {
      $tableBox_string = '';

      $form_set = false;
      if (isset($contents['form'])) {
        $tableBox_string .= $contents['form'] . "\n";
        $form_set = true;
        array_shift($contents);
      }

      $tableBox_string .= '<table border="' . $this->table_border . '" width="' . $this->table_width . '" cellspacing="' . $this->table_cellspacing . '" cellpadding="' . $this->table_cellpadding . '"';
      if (tep_not_null($this->table_parameters)) $tableBox_string .= ' ' . $this->table_parameters;
      $tableBox_string .= '>' . "\n";

      for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
        $tableBox_string .= '  <tr';
        if (tep_not_null($this->table_row_parameters)) $tableBox_string .= ' ' . $this->table_row_parameters;
        if (isset($contents[$i]['params']) && tep_not_null($contents[$i]['params'])) $tableBox_string .= ' ' . $contents[$i]['params'];
        $tableBox_string .= '>' . "\n";

        if (isset($contents[$i][0]) && is_array($contents[$i][0])) {
          for ($x=0, $y=sizeof($contents[$i]); $x<$y; $x++) {
            if (isset($contents[$i][$x]['text']) && tep_not_null(isset($contents[$i][$x]['text']))) {
              $tableBox_string .= '    <td';
              if (isset($contents[$i][$x]['align']) && tep_not_null($contents[$i][$x]['align'])) $tableBox_string .= ' align="' . $contents[$i][$x]['align'] . '"';
              if (isset($contents[$i][$x]['params']) && tep_not_null(isset($contents[$i][$x]['params']))) {
                $tableBox_string .= ' ' . $contents[$i][$x]['params'];
              } elseif (tep_not_null($this->table_data_parameters)) {
                $tableBox_string .= ' ' . $this->table_data_parameters;
              }
              $tableBox_string .= '>';
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= $contents[$i][$x]['form'];
              $tableBox_string .= $contents[$i][$x]['text'];
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= '</form>';
              $tableBox_string .= '</td>' . "\n";
            }
          }
        } else {
          $tableBox_string .= '    <td';
          if (isset($contents[$i]['align']) && tep_not_null($contents[$i]['align'])) $tableBox_string .= ' align="' . $contents[$i]['align'] . '"';
          if (isset($contents[$i]['params']) && tep_not_null($contents[$i]['params'])) {
            $tableBox_string .= ' ' . $contents[$i]['params'];
          } elseif (tep_not_null($this->table_data_parameters)) {
            $tableBox_string .= ' ' . $this->table_data_parameters;
          }
          $tableBox_string .= '>' . $contents[$i]['text'] . '</td>' . "\n";
        }

        $tableBox_string .= '  </tr>' . "\n";
      }

      $tableBox_string .= '</table>' . "\n";

      if ($form_set == true) $tableBox_string .= '</form>' . "\n";

      return $tableBox_string;
    }

    function tableBlockModal($contents, $params) {

      

      $form_set = false;
      if (isset($contents['form'])) {
        $tableBox_string .= $contents['form'] . "\n";
        $form_set = true;
        array_shift($contents);
      }

      //  <-- modal-body
      $tableBox_string .= '<div class="modal-body">';

      for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
        $tableBox_string .= '  <div>';

        if (isset($contents[$i][0]) && is_array($contents[$i][0])) {
          for ($x=0, $y=sizeof($contents[$i]); $x<$y; $x++) {
            if (isset($contents[$i][$x]['text']) && tep_not_null(isset($contents[$i][$x]['text']))) {

              $tableBox_string .= '<p>';
              
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= $contents[$i][$x]['form'];
              
              $tableBox_string .= $contents[$i][$x]['text'];
              
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= '</form>';
              
              $tableBox_string .= '</p>' . "\n";

            }
          }
        } else {
          $tableBox_string .= '<p>';
          $tableBox_string .= $contents[$i]['text'] . '</p>';
        }

        $tableBox_string .= '  </div>';
      }

      $tableBox_string .= '</div>';
      //  <-- / modal-body
      
      //  <--  modal-footer
      $tableBox_string .= '

      <div class="modal-footer">
        <button type="submit" class="'.$params['submitButton']['class'].'">'. $params['submitButton']['name'] .'</button>
        <button type="button" class="'.$params['cancelButton']['class'].'" data-dismiss="modal">'. $params['cancelButton']['name'] .'</button>
      </div>
      
      ';
      //  <--  /modal-footer

      if ($form_set == true) $tableBox_string .= '</form>' . "\n";

      

      return $tableBox_string;

    }

    function newTableBlockModal($contents, $params) {
      $form_set = false;
      $tableBox_string = '<div class="modal-body">';

      if (isset($contents['form'])) {
        $tableBox_string .= $contents['form'] . "\n";
        $form_set = true;
        array_shift($contents);
      }

      for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
        if (isset($contents[$i]['wrapper_open'])) {
          $tableBox_string .= $contents[$i]['wrapper_open'];
        }

        if (isset($contents[$i][0]) && is_array($contents[$i][0])) {
          for ($x=0, $y=sizeof($contents[$i]); $x<$y; $x++) {
            if (isset($contents[$i][$x]['text']) && tep_not_null(isset($contents[$i][$x]['text']))) {
              $tableBox_string .= '<p>';

              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= $contents[$i][$x]['form'];

              $tableBox_string .= $contents[$i][$x]['text'];

              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= '</form>';

              $tableBox_string .= '</p>' . "\n";
            }
          }
        } else {
          $tableBox_string .= $contents[$i]['text'];
        }

        if (isset($contents[$i]['wrapper_close'])) {
          $tableBox_string .= $contents[$i]['wrapper_close'];
        }
      }

      if ($form_set) {
        $tableBox_string .= '</form>' . "\n";
      }

      $tableBox_string .= '</div>';

      $tableBox_string .= '
      <div class="modal-footer">
        <button type="submit" class="'.$params['submitButton']['class'].'">'. $params['submitButton']['name'] .'</button>
        <button type="button" class="'.$params['cancelButton']['class'].'" data-dismiss="modal">'. $params['cancelButton']['name'] .'</button>
      </div>';

      return $tableBox_string;
    }
  }
