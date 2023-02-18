<?php

require_once('includes/application_top.php');

if (isset($_SESSION['login_id']) && !empty($_SESSION['login_id']) && isset($_POST["hide_block_id"]) && !empty($_POST["hide_block_id"])) {
    // Get state value
    $states = json_decode(ADMIN_BLOCK_STATE);

    // Fixed warnings if non exist $_SESSION['login_id'] in $states
    if (!isset($states->{$_SESSION['login_id']})) {
        $states->{$_SESSION['login_id']} = new stdClass();
    }
    // Change state
    $states->{$_SESSION['login_id']}->{$_POST["hide_block_id"]} = $_POST["hide_block_value"];
    $states = json_encode($states);

    // Update database
    $sql = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value='" . $states .
          "' WHERE configuration_key='ADMIN_BLOCK_STATE'";
    $sql = tep_db_query($sql);
}
