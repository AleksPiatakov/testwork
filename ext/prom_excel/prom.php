<?php

require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();
$exportLog = '';
$allowed_image_types = ['image/jpeg','image/gif','image/png','image/webp'];
$allowed_table_types = ['text/csv','application/excel','application/vnd.ms-excel','application/x-excel','application/x-msexcel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

if (tep_not_null($_FILES) && in_array($_FILES['excelfile']['type'], $allowed_table_types)) {
    $file_path = $_FILES['excelfile']['tmp_name'];
    $current_currency = $_POST['currency'] ?: 'USD';
    $current_lang = $_POST['language'] ?: 1;
    $upload_images = isset($_POST['uploadImages']);
    $truncate_table = isset($_POST['truncateTable']);
    include_once('../ext/prom_excel/promua.php');
}
if ($current_page == FILENAME_IMPORT_EXPORT) {
    include_once('html-open.php');
    include_once('header.php');
    ?>
    <!--    <div class="container">-->
    <!--        <div class="col-md-12">-->
    <!--            --><?php //include __DIR__ . "/../../admin/includes/material/blocks/tabs/import_export.php" ?>
    <!--        </div>-->
    <!--    </div>-->
    <div class="container">
        <h1 class="h1">Импорт из Excel Prom.ua</h1>

        <?php if (tep_not_null($exportLog)) { ?>
            <?= $exportLog ?>
        <?php } else { ?>
            <form enctype="multipart/form-data" method="post">

                <div class="form-group"><label for="excelfile">Выберите .xlsx файл:</label>
                    <input type="file" required class="form-control" name="excelfile" id="excelfile" accept=".xlsx">
                </div>
                <label for="currency">Основная валюта:</label>
                <select name="currency" class="form-group" required>
                    <?php foreach ($currencies->currencies as $cur => $data) { ?>
                        <option value="<?= $cur ?>"><?= $cur ?></option>
                    <?php } ?>
                </select>
                <label for="language">Основной язык:</label>
                <select name="language" class="form-group" required>
                    <?php foreach ($languages as $data) { ?>
                        <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                    <?php } ?>
                </select>
                <div class="form-group">
                    <input type="checkbox" name="uploadImages" id="uploadImages">
                    <label for="uploadImages">Импортировать изображения? (займёт много времени)</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="truncateTable" id="truncateTable">
                    <label for="truncateTable">Очистить текущую базу данных от
                        товаров/категорий/производителей/аттрибутов</label>
                </div>
                <button type="submit" class="btn btn-info btn-rounded">Загрузить</button>
            </form>
        <?php } ?>
    </div>
    <?php
    require('footer.php');
    require('html-close.php');
    require(DIR_WS_INCLUDES . 'application_bottom.php');
} elseif ($current_page == FILENAME_NEW_IMPORT_EXPORT) { ?>
    <?php if (tep_not_null($exportLog)) { ?>
        <?= $exportLog ?>
    <?php } else { ?>
        <form enctype="multipart/form-data" method="post">
            <div class="settings_block">
                <span class="w-50">
                    <?php echo PROM_EXCEL_CURRENCY; ?>
                    <select name="currency" class="form-group" required>
                        <?php foreach ($currencies->currencies as $cur => $data) { ?>
                            <option value="<?= $cur ?>"><?= $cur ?></option>
                        <?php } ?>
                    </select>
                </span>
                <span class="w-50">
                    <?php echo PROM_EXCEL_LANGUAGE; ?>
                    <select name="language" class="form-group" required>
                        <?php foreach ($languages as $data) { ?>
                            <option value="<?= $data['id'] ?>" <?=$data['id'] == $languages_id ? 'selected' : '' ?>>
                                <?= $data['name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </span>
                <label>
                    <input type="checkbox" name="uploadImages" id="uploadImages">
                    <span><?php echo PROM_EXCEL_UPLOAD_IMAGES; ?></span>
                </label>
                <label>
                    <input type="checkbox" name="truncateTable" id="truncateTable">
                    <span><?php echo PROM_EXCEL_TRUNCATE_TABLE; ?></span>
                </label>
            </div>
            <div class="actions">
                <label>
                    <input type="file" required class="load_file" name="excelfile" id="excelfile" accept=".xlsx">
                    <span id="replacement_block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <g fill="none" fill-rule="evenodd">
                                    <g fill="#1283E4" fill-rule="nonzero">
                                        <g>
                                            <g>
                                                <g>
                                                    <path fill-opacity=".4" d="M0 15.5v-1c0-.276.224-.5.5-.5h15c.276 0 .5.224.5.5v1c0 .276-.224.5-.5.5H.5c-.276 0-.5-.224-.5-.5z" transform="translate(-1136 -110) translate(430 100) translate(650) translate(56 10)"/>
                                                    <path d="M9.147.75v7.251h3.137c.637 0 .956.672.505 1.066l-4.297 3.757c-.27.235-.707.235-.977 0L3.211 9.067c-.45-.394-.132-1.066.505-1.066h3.14V.751c0-.2.09-.391.252-.532.16-.14.38-.22.608-.219h.572c.228 0 .447.078.608.22.16.14.251.331.25.53z" transform="translate(-1136 -110) translate(430 100) translate(650) translate(56 10)"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <?php echo PROM_EXCEL_UPLOAD_FILE; ?>
                        </span>
                </label>
                <button type="submit" class="btn btn-info green_btn"><?php echo PROM_EXCEL_UPLOAD_BUTTON; ?></button>
            </div>
        </form>
    <?php }
} ?>
