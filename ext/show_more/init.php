<?php

$path = "ext/show_more/" . $template->template_name . "/showmore.php";
if (file_exists($path)) {
    return (require $path);
}
