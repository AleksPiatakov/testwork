<?php

// --------------- ATTRIBUTES COUNTER IN FILTER ----------------------------- //
// UNCOMMENT WHEN WE WILL CREATE AUTOMATICALLY REFRESHING OF FILTER BOX !!---------//

foreach ($counts_may_be as $op => $opval_pid) {
    $counts_may_be[$op] = call_user_func_array("array_merge", $counts_may_be[$op]);
    $counts_may_be[$op] = array_unique($counts_may_be[$op]); // delete extra products IDs for each attribute
}
$count_counts_may_be = find_counts($counts_may_be);

$counts_array_true = array();

foreach ($counts_array as $op => $opval_pid) {
    foreach ($opval_pid as $opval => $op_pid) {
        if (in_array($opval, explode('-', $_GET[$op]))) { // if its current selected point
            if (count($counts_may_be) == 1) { // if its only one selected point, then do nothing
                $c_count = count(array_unique($counts_may_be[$op]));
            } else {
                $c_count = find_counts($counts_may_be);
            }
        } elseif (!empty($counts_may_be[$op])) { // if there are already selected other values for current attribute
            $may_be_plus_one = $counts_may_be;
            $may_be_plus_one[$op] = array_unique(array_merge($counts_array[$op][$opval],
                $counts_may_be[$op])); // if we would add this value to current attributes (8)
//            if(count($counts_may_be)==1) { // if its only one selected attribute, do nothing
//              $c_count = count($may_be_plus_one[$op]);
//            } else {
            $c_count = find_counts($may_be_plus_one);
//            }
            if ($current_count = $c_count - $count_counts_may_be) {
                $c_count = '+' . ($current_count); // for current selected attributes show (+5) but not all quantity
            } else {
                $c_count = 0;
            }
        } elseif (empty($_GET[$op]) and empty($counts_may_be)) { // when no any attributes selected
            $c_count = count($counts_array[$op][$opval]);
        } elseif (empty($_GET[$op])) {
            $may_be_plus_one = $counts_may_be;
            $may_be_plus_one[$op] = array_unique($counts_array[$op][$opval]);
            $c_count = find_counts($may_be_plus_one);
        } else {
            $c_count = 0;
        }

        // add quantity only to that value, where coincidences !=0, also hide all quantityes where are no any values
        //          if($c_count!=0 and ($c_count!=$count_counts_may_be or in_array($opval,explode('-',$_GET[$op])))) $counts_array_true[$op][$opval] = $c_count;
        $counts_array_true[$op][$opval] = $c_count;
    }
}
// --------------- ATTRIBUTES COUNTER IN FILTER --END------------------------ //
