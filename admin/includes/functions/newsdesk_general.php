<?php

// -----------------------------------------------------------------------
// upload file function
// -----------------------------------------------------------------------
function tep_get_uploaded_file($filename)
{
    if (isset($_FILES[$filename])) {
        $uploaded_file = array(
            'name' => $_FILES[$filename]['name'],
            'type' => $_FILES[$filename]['type'],
            'size' => $_FILES[$filename]['size'],
            'tmp_name' => $_FILES[$filename]['tmp_name']
        );
    } elseif (isset($GLOBALS['HTTP_POST_FILES'][$filename])) {
        global $_FILES;

        $uploaded_file = array(
            'name' => $_FILES[$filename]['name'],
            'type' => $_FILES[$filename]['type'],
            'size' => $_FILES[$filename]['size'],
            'tmp_name' => $_FILES[$filename]['tmp_name']
        );
    } else {
        $uploaded_file = array(
            'name' => $GLOBALS[$filename . '_name'],
            'type' => $GLOBALS[$filename . '_type'],
            'size' => $GLOBALS[$filename . '_size'],
            'tmp_name' => $GLOBALS[$filename]
        );
    }

// a_berezin fix start

    if (substr($uploaded_file['type'], 0, 5) != 'image')
        $uploaded_file = array();

// a_berezin fix end

    return $uploaded_file;
}
// -----------------------------------------------------------------------



// -----------------------------------------------------------------------
// return a local directory path (without trailing slash)
// -----------------------------------------------------------------------
function tep_get_local_path($path)
{
    if (substr($path, -1) == '/') $path = substr($path, 0, -1);
    return $path;
}
// -----------------------------------------------------------------------


// -----------------------------------------------------------------------
// the $filename parameter is an array with the following elements:
// name, type, size, tmp_name
// -----------------------------------------------------------------------
function tep_copy_uploaded_file($filename, $target)
{
    if (substr($target, -1) != '/') $target .= '/';
    $target .= $filename['name'];
    move_uploaded_file($filename['tmp_name'], $target);
    chmod($target, 0777);
}
// -----------------------------------------------------------------------

