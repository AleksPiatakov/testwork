<?php

//namespace includes\classes\message;
/*
  $Id: message_stack.php,v 1.1.1.1 2003/09/18 19:05:14 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License

  Example usage:

  $messageStack = new messageStack();
  $messageStack->add('general', 'Error: Error 1', 'error');
  $messageStack->add('general', 'Error: Error 2', 'warning');
  if ($messageStack->size('general') > 0) echo $messageStack->output('general');
*/

class tableBoxMessagestack
{
    var $table_border = '0';
    var $table_width = '100%';
    var $table_cellspacing = '0';
    var $table_cellpadding = '2';
    var $table_parameters = '';
    var $table_row_parameters = '';
    var $table_data_parameters = '';

// class constructor
 //   function tableBoxMessagestack($contents, $direct_output = false) {
    function __construct($contents, $direct_output = false)
    {
        $tableBox1_string = '<table border="' . tep_output_string($this->table_border) . '" width="' . tep_output_string($this->table_width) . '" cellspacing="' . tep_output_string($this->table_cellspacing) . '" cellpadding="' . tep_output_string($this->table_cellpadding) . '"';
        if (tep_not_null($this->table_parameters)) {
            $tableBox1_string .= ' ' . $this->table_parameters;
        }
        $tableBox1_string .= '>' . "\n";

        for ($i = 0, $n = sizeof($contents); $i < $n; $i++) {
            if (isset($contents[$i]['form']) && tep_not_null($contents[$i]['form'])) {
                $tableBox1_string .= $contents[$i]['form'] . "\n";
            }
            $tableBox1_string .= '  <tr';
            if (tep_not_null($this->table_row_parameters)) {
                $tableBox1_string .= ' ' . $this->table_row_parameters;
            }
            if (isset($contents[$i]['params']) && tep_not_null($contents[$i]['params'])) {
                $tableBox1_string .= ' ' . $contents[$i]['params'];
            }
            $tableBox1_string .= '>' . "\n";

            if (isset($contents[$i][0]) && is_array($contents[$i][0])) {
                for ($x = 0, $n2 = sizeof($contents[$i]); $x < $n2; $x++) {
                    if (isset($contents[$i][$x]['text']) && tep_not_null($contents[$i][$x]['text'])) {
                        $tableBox1_string .= '    <td';
                        if (isset($contents[$i][$x]['align']) && tep_not_null($contents[$i][$x]['align'])) {
                            $tableBox1_string .= ' align="' . tep_output_string($contents[$i][$x]['align']) . '"';
                        }
                        if (isset($contents[$i][$x]['params']) && tep_not_null($contents[$i][$x]['params'])) {
                            $tableBox1_string .= ' ' . $contents[$i][$x]['params'];
                        } elseif (tep_not_null($this->table_data_parameters)) {
                            $tableBox1_string .= ' ' . $this->table_data_parameters;
                        }
                        $tableBox1_string .= '>';
                        if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) {
                            $tableBox1_string .= $contents[$i][$x]['form'];
                        }
                        $tableBox1_string .= $contents[$i][$x]['text'];
                        if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) {
                            $tableBox1_string .= '</form>';
                        }
                        $tableBox1_string .= '</td>' . "\n";
                    }
                }
            } else {
                $tableBox1_string .= '    <td';
                if (isset($contents[$i]['align']) && tep_not_null($contents[$i]['align'])) {
                    $tableBox1_string .= ' align="' . tep_output_string($contents[$i]['align']) . '"';
                }
                if (isset($contents[$i]['params']) && tep_not_null($contents[$i]['params'])) {
                    $tableBox1_string .= ' ' . $contents[$i]['params'];
                } elseif (tep_not_null($this->table_data_parameters)) {
                    $tableBox1_string .= ' ' . $this->table_data_parameters;
                }
                $tableBox1_string .= '>' . $contents[$i]['text'] . '</td>' . "\n";
            }

            $tableBox1_string .= '  </tr>' . "\n";
            if (isset($contents[$i]['form']) && tep_not_null($contents[$i]['form'])) {
                $tableBox1_string .= '</form>' . "\n";
            }
        }

        $tableBox1_string .= '</table>' . "\n";

        if ($direct_output == true) {
            echo $tableBox1_string;
        }

        return $tableBox1_string;
    }
}

//Lango Added for template mod: BOF
class messageStack extends tableBoxMessagestack
{
//Lango Added for template mod: EOF
    function render($page_key = '', $render_type = '', $get = false)
    {
        global $messageStack;
      // $messageStack->render_type = $render_type;
        if ($messageStack->size($page_key) > 0) {
            if ($render_type == 'tr') {
                $messageStack->output($page_key);
            } else {
                if ($get) {
                    return $messageStack->output_div($page_key, $get);
                } else {
                    echo $messageStack->output_div($page_key, $get);
                }
            }
        }
    }
// class constructor
    function __construct()
    {
        global $messageToStack;

        $this->messages = array();

        if (tep_session_is_registered('messageToStack')) {
            for ($i = 0, $n = sizeof($messageToStack); $i < $n; $i++) {
                $this->add($messageToStack[$i]['class'], $messageToStack[$i]['text'], $messageToStack[$i]['type']);
            }
            tep_session_unregister('messageToStack');
        }
    }

// class methods
    function add($class, $message, $type = 'error')
    {
        if ($type == 'error') {
            $this->messages[] = array('params' => 'role="alert" class="alert alert-danger messageStackError"', 'class' => $class, 'text' => tep_image(DIR_WS_ICONS . 'error.gif', ICON_ERROR) . '&nbsp;' . $message);
        } elseif ($type == 'warning') {
            $this->messages[] = array('params' => 'role="alert" class="alert alert-warning messageStackWarning"', 'class' => $class, 'text' => tep_image(DIR_WS_ICONS . 'warning.gif', ICON_WARNING) . '&nbsp;' . $message);
        } elseif ($type == 'success') {
            $this->messages[] = array('params' => 'role="alert" class="alert alert-success messageStackSuccess"', 'class' => $class, 'text' => tep_image(DIR_WS_ICONS . 'success.gif', ICON_SUCCESS) . '&nbsp;' . $message);
        } else {
            $this->messages[] = array('params' => 'role="alert" class="alert alert-danger messageStackError"', 'class' => $class, 'text' => $message);
        }
    }

    function add_session($class, $message, $type = 'error')
    {
        global $messageToStack;

        if (!tep_session_is_registered('messageToStack')) {
            tep_session_register('messageToStack');
            $messageToStack = array();
        }

        $messageToStack[] = array('class' => $class, 'text' => $message, 'type' => $type);
    }

    function reset()
    {
        $this->messages = array();
    }
    function output_div($class, $return = false)
    {
        $stack = '';
        foreach ($this->messages as $message) {
            $stack .= '<div ' . $message['params'] . '>
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' . $message['text'] . '</div>';
        }
        if ($return == true) {
            return $stack;
        }
        echo $stack;
    }

    function output($class)
    {
        $this->table_data_parameters = 'class="messageBox"';

        $output = array();
        for ($i = 0, $n = sizeof($this->messages); $i < $n; $i++) {
            if ($this->messages[$i]['class'] == $class) {
                $output[] = $this->messages[$i];
            }
        }
//Lango Added for template mod: BOF
        return $this->tableBoxMessagestack($output);
//Lango Added for template mod: EOF
    }

    function size($class)
    {
        $count = 0;

        for ($i = 0, $n = sizeof($this->messages); $i < $n; $i++) {
            if ($this->messages[$i]['class'] == $class) {
                $count++;
            }
        }

        return $count;
    }
}
