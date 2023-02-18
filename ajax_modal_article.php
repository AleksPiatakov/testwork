<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    require('includes/application_top.php');

    $response = renderArticle($_POST['article_id'], [
        'image',
    ]);
    echo json_encode($response);
}
