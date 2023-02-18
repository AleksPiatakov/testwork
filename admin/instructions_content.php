<!DOCTYPE html>
<html>
<head>
    <title><?php echo getConstantValue('SOLOMONO_DOCUMENTATION_TITLE'); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="https://solomono.net/favicon.ico">
    <link rel="stylesheet" type="text/css" href="https://solomono.net/envato/solomono.docs.min.css" media="screen"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://solomono.net/envato/solomono.docs.min.js"></script>
</head>
<body>
<div class="container instructies_wrapper">
    <div class="sidebar">
        <div class="new_col_left_elem">
            <div id="form_instr_search">
                <input id="instr_search" name="ikeywords" type="text" value="" placeholder="<?php echo getConstantValue('SEARCH_TITLE'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M443.5 420.2L336.7 312.4c20.9-26.2 33.5-59.4 33.5-95.5 0-84.5-68.5-153-153.1-153S64 132.5 64 217s68.5 153 153.1 153c36.6 0 70.1-12.8 96.5-34.2l106.1 107.1c3.2 3.4 7.6 5.1 11.9 5.1 4.1 0 8.2-1.5 11.3-4.5 6.6-6.3 6.8-16.7.6-23.3zm-226.4-83.1c-32.1 0-62.3-12.5-85-35.2-22.7-22.7-35.2-52.9-35.2-84.9 0-32.1 12.5-62.3 35.2-84.9 22.7-22.7 52.9-35.2 85-35.2s62.3 12.5 85 35.2c22.7 22.7 35.2 52.9 35.2 84.9 0 32.1-12.5 62.3-35.2 84.9-22.7 22.7-52.9 35.2-85 35.2z"></path>
                </svg>
            </div>
        </div>
        <div class="menu">
            <span class="subtitle"><?php echo getConstantValue('ALL_TITLE'); ?></span>
            <ul class="list" id="categories-list">
                <li><a href="#" data-id="main" class="active"><?php echo getConstantValue('CATEGORIES_TITLE'); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="main">
        <span class="general"></span>
        <div class="subbar d-none">
            <span class="subtitle"><?php echo getConstantValue('ARTICLES_TITLE'); ?></span>
            <ul class="list" id="articles-list"></ul>
        </div>
        <div class="content d-none"></div>
    </div>
</div>
</body>
</html>
