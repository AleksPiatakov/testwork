<?php

function getCompare($id)
{
    if (isset($_SESSION['compares'][$id])) {
        $compare_checked = 'checked';
        $compare_text = getConstantValue('GO_COMPARE');
    } else {
        $compare_checked = '';
        $compare_text = getConstantValue('COMPARE');
    }
    return array('text' => $compare_text, 'checked' => $compare_checked);
}
