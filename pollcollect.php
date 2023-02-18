<?php

require('includes/application_top.php');
$result = tep_db_query("select configuration_key,configuration_value from " . TABLE_PHESIS_POLL_CONFIG);
while ($key = tep_db_fetch_array($result)) {
    define($key['configuration_key'], $key['configuration_value']);
}
$pollid = $_POST['pollid'];
$voteid = $_POST['voteid'];
$forwarder = $_POST['forwarder'];
$ip = getenv("REMOTE_ADDR");
$past = time() - 90800;
$votevalid = 1;
$query = "DELETE FROM " . TABLE_PHESIS_POLL_CHECK . " WHERE time < " . tep_db_input($past);
tep_db_query($query);
if ($voteid) {
    $result = tep_db_query("select poll_type, poll_open from " . TABLE_PHESIS_POLL_DESC . " where pollid='" . tep_db_input($pollid) . "'");
    $poll = tep_db_fetch_array($result);
    if ($poll['poll_open'] == '1') {
        $votevalid = 0;
        $warn = "_POLLCLOSED";
    }
    if ($poll['poll_type'] == '1' && !isset($customer_id)) {
        $votevalid = 0;
        $warn = "_POLLPRIVATE";
    }
    if ($votevalid == 1 && POLL_SPAM == 0) {
        $query = "SELECT ip FROM " . TABLE_PHESIS_POLL_CHECK . " WHERE ip='" . tep_db_input($ip) . "' and pollid='" . tep_db_input($pollid) . "'";
        $result = tep_db_query($query);
        $result1 = tep_db_fetch_array($result);
        $ips = $result1['ip'];
        $ctime = time();
        if ($ip == $ips) {
            $votevalid = 0;
            $warn = "_ALREADY_VOTED";
        } else {
            $query = "INSERT INTO " . TABLE_PHESIS_POLL_CHECK . " (ip, time, pollid) VALUES ('" . tep_db_input($ip) . "', '" . tep_db_input($ctime) . "' , '" . tep_db_input($pollid) . "')";
            tep_db_query($query);
            $votevalid = 1;
        }
    }
}
if (!$voteid) {
    $votevalid = 0;
    $warn = "_NO_VOTE_SELECTED";
}

if ($votevalid > 0) {
    $query1 = "UPDATE " . TABLE_PHESIS_POLL_DATA . " SET optionCount=optionCount+1 WHERE (pollid='" . tep_db_input($pollid) . "') AND (voteid='" . tep_db_input($voteid) . "')";
    $query2 = "UPDATE " . TABLE_PHESIS_POLL_DESC . " SET voters=voters+1 WHERE pollid='" . tep_db_input($pollid) . "'";
    $result1 = tep_db_query($query1);
    $result2 = tep_db_query($query2);
} else {
    $forwarder .= "/warn/" . $warn;
}
Header("Location: $forwarder");
