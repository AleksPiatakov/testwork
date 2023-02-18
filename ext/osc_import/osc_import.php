<?php

//$solomonoTables = [
//  'address_book' => [
//    'address_book_id',
//    'customers_id',
//    'entry_gender',
//    'entry_company',
//    'entry_firstname',
//    'entry_lastname',
//    'entry_street_address',
//    'entry_suburb',
//    'entry_postcode',
//    'entry_city',
//    'entry_state',
//    'entry_country_id',
//    'entry_zone_id',
//  ],
//  'categories' => [
//    'categories_id',
//    'categories_image',
//    'parent_id',
//    'sort_order',
//    'date_added',
//    'last_modified',
//  ],
//  'categories_description' => [
//    'categories_id',
//    'language_id',
//    'categories_name',
//  ],
//  'currencies' => [
//    'currencies_id',
//    'title',
//    'code',
//    'symbol_left',
//    'symbol_right',
//    'decimal_point',
//    'thousands_point',
//    'decimal_places',
//    'value',
//    'last_updated',
//  ],
//  'customers' => [
//    'customers_id',
//    'customers_gender',
//    'customers_firstname',
//    'customers_lastname',
//    'customers_dob',
//    'customers_email_address',
//    'customers_default_address_id',
//    'customers_telephone',
//    'customers_fax',
//    'customers_password',
//    'customers_newsletter',
//  ],
//  'customers_basket' => [
//    'customers_basket_id',
//    'customers_id',
//    'products_id',
//    'customers_basket_quantity',
//    'final_price',
//    'customers_basket_date_added',
//  ],
//  'customers_basket_attributes' => [
//    'customers_basket_attributes_id',
//    'customers_id',
//    'products_id',
//    'products_options_id',
//    'products_options_value_id',
//  ],
//  'customers_info' => [
//    'customers_info_id',
//    'customers_info_date_of_last_logon',
//    'customers_info_number_of_logons',
//    'customers_info_date_account_created',
//    'customers_info_date_account_last_modified',
//    'global_product_notifications',
//  ],
//  'featured' => [
//    'featured_id',
//    'products_id',
//    'featured_date_added',
//    'featured_last_modified',
//    'expires_date',
//    'date_status_change',
//    'status',
//  ],
//  'manufacturers' => [
//    'manufacturers_id',
//    'manufacturers_name',
//    'manufacturers_image',
//    'date_added',
//    'last_modified',
//  ],
//  'manufacturers_info' => [
//    'manufacturers_id',
//    'languages_id',
//    'manufacturers_url',
//    'url_clicked',
//    'date_last_click',
//  ],
//  'orders' => [
//    'orders_id',
//    'customers_id',
//    'customers_name',
//    'customers_company',
//    'customers_street_address',
//    'customers_suburb',
//    'customers_city',
//    'customers_postcode',
//    'customers_state',
//    'customers_country',
//    'customers_telephone',
//    'customers_email_address',
//    'customers_address_format_id',
//    'delivery_name',
//    'delivery_company',
//    'delivery_street_address',
//    'delivery_suburb',
//    'delivery_city',
//    'delivery_postcode',
//    'delivery_state',
//    'delivery_country',
//    'delivery_address_format_id',
//    'billing_name',
//    'billing_company',
//    'billing_street_address',
//    'billing_suburb',
//    'billing_city',
//    'billing_postcode',
//    'billing_state',
//    'billing_country',
//    'billing_address_format_id',
//    'payment_method',
//    'cc_type',
//    'cc_owner',
//    'cc_number',
//    'cc_expires',
//    'last_modified',
//    'date_purchased',
//    'orders_status',
//    'orders_date_finished',
//    'currency',
//    'currency_value',
//  ],
//  'orders_products' => [
//    'orders_products_id',
//    'orders_id',
//    'products_id',
//    'products_model',
//    'products_name',
//    'products_price',
//    'final_price',
//    'products_tax',
//    'products_quantity',
//  ],
//  'orders_products_attributes' => [
//    'orders_products_attributes_id',
//    'orders_id',
//    'orders_products_id',
//    'products_options',
//    'products_options_values',
//    'options_values_price',
//    'price_prefix',
//  ],
//  'orders_products_download' => [
//    'orders_products_download_id',
//    'orders_id',
//    'orders_products_id',
//    'orders_products_filename',
//    'download_maxdays',
//    'download_count',
//  ],
//  'orders_status' => [
//    'orders_status_id',
//    'language_id',
//    'orders_status_name',
//  ],
//  'orders_status_history' => [
//    'orders_status_history_id',
//    'orders_id',
//    'orders_status_id',
//    'date_added',
//    'customer_notified',
//    'comments',
//  ],
//  'orders_total' => [
//    'orders_total_id',
//    'orders_id',
//    'title',
//    'text',
//    'value',
//    'class',
//    'sort_order',
//  ],
//  'products' => [
//    'products_id',
//    'products_quantity',
//    'products_price',
//    'products_model',
//    'products_image',
//    'products_date_added',
//    'products_last_modified',
//    'products_date_available',
//    'products_weight',
//    'products_status',
//    'products_tax_class_id',
//    'manufacturers_id',
//    'products_ordered',
//  ],
//  'products_attributes' => [
//    'products_attributes_id',
//    'products_id',
//    'options_id',
//    'options_values_id',
//    'options_values_price',
//    'price_prefix',
//  ],
//  'products_attributes_download' => [
//    'products_attributes_id',
//    'products_attributes_filename',
//    'products_attributes_maxdays',
//    'products_attributes_maxcount',
//  ],
//  'products_description' => [
//    'products_id',
//    'language_id',
//    'products_name',
//    'products_description',
//    'products_url',
//    'products_viewed',
//  ],
//  'products_notifications' => [
//    'products_id',
//    'customers_id',
//    'date_added',
//  ],
//  'products_options' => [
//    'products_options_id',
//    'language_id',
//    'products_options_name',
//  ],
//  'products_options_values' => [
//    'products_options_values_id',
//    'language_id',
//    'products_options_values_name',
//  ],
//  'products_options_values_to_products_options' => [
//    'products_options_values_to_products_options_id',
//    'products_options_id',
//    'products_options_values_id',
//  ],
//  'products_to_categories' => [
//    'products_id',
//    'categories_id',
//  ],
//  'products_xsell' => [
//    'ID',
//    'products_id',
//    'xsell_id',
//    'sort_order',
//  ],
//  'specials' => [
//    'specials_id',
//    'products_id',
//    'specials_new_products_price',
//    'specials_date_added',
//    'specials_last_modified',
//    'expires_date',
//    'date_status_change',
//    'status',
//
//  ]
//];
use App\Classes\Filesystem\Filesystem;

// Don't allow to work module in our server
if ($_SESSION["login_email_address"] !== 'admin@solomono.net' && strpos($_SERVER["SERVER_NAME"], 'solomono.net') !== false) {
    echo '<p style="margin: 20px 0; text-align: center; font-size: medium;">' .
            getConstantValue('OSC_IMPORT_BLOCKED_TEXT', 'Migration is only available on your hosting') .
        '</p>';
    exit();
}
ini_set('max_execution_time', 0);
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'functions.php');
$importDone = false;
if ($_GET['action'] === 'ip') {
    $connection->select_db($dbname);
    checkProductsImages($connection);
    die;
}
if (isset($_POST['action']) && $_POST['action'] === 'submit') {
    $tablesForSkip =
        [
            'articles',
            'articles_descriptions',
            'topics',
            'topics_descriptions',
            'articles_to_topics',
            'configuration',
            'configuration_group',
            'infobox_configuration',
            'template',
            'languages',
        ];
    $prefix = 'solomono';
    $filename = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'db.sql';
    $tablesData = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'db.json'), true);
    // array keys to lower (fix problem if in sql table name contains upper letters)
    $tablesData = array_change_key_case($tablesData, CASE_LOWER);

    $sqlsize = filesize($filename);
    $connection->select_db($dbname);
    $tables = $_POST['table'];
    $max_alloved_packet = $connection->query("SHOW VARIABLES like 'max_allowed_packet'")->fetch_assoc()['Value'];
    // variable for check to need reopen connection or no
    $reopenConnection = false;

    // get sql_mode from db
    $slqMode = $connection->query("SHOW VARIABLES like 'sql_mode'")->fetch_assoc()['Value'];
    $sqlModeArray = explode(',', $slqMode);
    if (!in_array('NO_AUTO_VALUE_ON_ZERO', $sqlModeArray)) {
        $sqlModeArray[] = 'NO_AUTO_VALUE_ON_ZERO';
        $connection->query('SET @@global.sql_mode = "' . implode(',', $sqlModeArray) . '"');
        $reopenConnection = true;
    }

    // check and change max_alloved_packet if need
    if ($sqlsize > (int)$max_alloved_packet) {
        // Increase max_allowed_packet
        if (!$connection->query('SET @@global.max_allowed_packet = ' . ($sqlsize + 100000))) {
            echo 'DB file size bigger than mysql max_allowed_packet variable' . PHP_EOL;
            die;
        }
        // should create new connection after increase max_allowed_packet
        $reopenConnection = true;
    }

    // create new connection if need
    if ($reopenConnection) {
        $connection = new db($dotenv['DB_HOST'], $dotenv['DB_USERNAME'], $dotenv['DB_PASSWORD']);
        $connection->select_db($dbname);
    }

    $sql = "SELECT Concat('ALTER TABLE ', TABLE_NAME, ' RENAME TO {$prefix}_', TABLE_NAME, ';') as queries  FROM information_schema.tables WHERE table_schema = '{$dbname}';";
    alterTables($sql, $connection);
    $sql_dump = file_get_contents($filename);

    $connection->multi_query($sql_dump);
    while ($connection->more_results() && $connection->next_result()) {
        ;
    } // flush multi_queries

    foreach ($tables as $name => $fields) {
        if (!in_array($name, $tablesForSkip)) {
            createTableIfNotExist($tablesData, $name, $connection, $prefix);
            $sql = "SELECT
                isc.TABLE_SCHEMA,
                isc.TABLE_NAME,
                isc.COLUMN_NAME,
                isc.COLUMN_TYPE,
                isc.IS_NULLABLE,
                isc.COLUMN_NAME NOT IN
                    (SELECT COLUMN_NAME
                     FROM information_schema.columns
                     WHERE TABLE_NAME = '{$prefix}_{$name}' AND TABLE_SCHEMA = '{$dbname}') as columnin
                FROM information_schema.columns isc
                WHERE isc.TABLE_SCHEMA = '{$dbname}'
                  AND isc.TABLE_NAME = '{$name}' ";
            $result = $connection->query($sql);
            $alterQueries = [];
            if ($result->num_rows) {
                while ($column = $result->fetch_assoc()) {
                    if ($column['columnin'] == 1) {
                        $isNull = $column['IS_NULLABLE'] === 'NO' ? 'not null' : 'null';
                        $alterQueries[] = "ALTER TABLE `{$prefix}_{$name}` ADD {$column['COLUMN_NAME']} {$column['COLUMN_TYPE']} {$isNull}";
                        $fields[] = $column['COLUMN_NAME'];
                    } else if (!in_array($column['COLUMN_NAME'], $fields)) {
                        $fields[] = $column['COLUMN_NAME'];
                    }
                }
            }
            $result->free_result();

            if ($alterQueries) {
                $alterQuery = implode('; ', $alterQueries);
                $connection->multi_query($alterQuery);
                while ($connection->more_results() && $connection->next_result()) {
                    ;
                } // flush multi_queries
            }
                //        while ($connection->next_result()) {;} // flush multi_queries
            $checkTableExist = $connection->query("SELECT * FROM information_schema.tables where table_schema = '{$dbname}' and table_name = '{$name}'");
            if ($checkTableExist->num_rows) {
                $checkTableExist->free_result();
                $fields = array_unique($fields);
                if ($name == 'manufacturers_info') {
                    // add table prefix for select
                    foreach ($fields as $field) {
                        $SelectFields[] = 'mi.' . $field;
                    }
                    unset($field);

                    $sql = "
                INSERT INTO `{$prefix}_{$name}` (" . implode(',', $fields) . ", manufacturers_name)
                SELECT " . implode(',', $SelectFields) . ", m.manufacturers_name
                FROM `{$name}` mi
                LEFT JOIN manufacturers m ON m.manufacturers_id = mi.manufacturers_id";
                    unset($SelectFields);
                } else {
                    $sql = "
                INSERT INTO `{$prefix}_{$name}` (" . implode(',', $fields) . ")
                SELECT " . implode(',', $fields) . " 
                FROM `{$name}`";
                }
                truncateTable($name, $connection, $prefix);

                $connection->query($sql);
            }
        }
    }

    // Get languages from osc db
    $oscLanguages = tep_db_query('
        SELECT languages_id,
               name,
               code,
               image,
               directory,
               sort_order
        FROM languages');
//    $oscLanguages = $oscLanguages->fetch_all(MYSQLI_ASSOC);

    // Get language array code = id for solomono languages
    $languages = tep_db_query('SELECT languages_id, code FROM ' . $prefix . '_languages');
    $solomonoLanguages = [];
    while ($language = tep_db_fetch_array($languages)) {
        $solomonoLanguages[$language['code']] = $language['languages_id'];
    }

    // Form language map
    $languageMap = [];
    foreach ($oscLanguages as $oscLanguage) {
        if (isset($solomonoLanguages[$oscLanguage['code']])) {
            // Do not add if the same
            if ($oscLanguage['languages_id'] !== $solomonoLanguages[$oscLanguage['code']]) {
                // form array osc_id = solomono_id
                $languageMap[$oscLanguage['languages_id']] = $solomonoLanguages[$oscLanguage['code']];
            }
        } else {
            // Add a new language if not exist
            $sql = "INSERT INTO `solomono_languages` (`name`, `code`, `directory`, `image`, `sort_order`, `lang_status`)
                    VALUES ('{$oscLanguage['name']}', 
                            '{$oscLanguage['code']}', 
                            '{$oscLanguage['directory']}',
                            'icon.png',
                            '1',
                            '1')";
            tep_db_query($sql);
            $langId = tep_db_insert_id();
            $languageMap[$oscLanguage['languages_id']] = $langId;

            // copy english directory to new language directory
            $filesystem = new Filesystem();
            $from = DIR_WS_LANGUAGES . 'english';
            $to = DIR_WS_LANGUAGES . $oscLanguage['directory'];
            $filesystem->copyDirectory($from, $to);
            $filesystem->copy($from . '.php', $to . '.php');

            $filesystem->copyDirectory(DIR_ROOT . DS . $from, DIR_ROOT . DS . $to);
            $filesystem->copy(DIR_ROOT . DS . $from . '.json', DIR_ROOT . DS . $to . '.json');
        }
    }

    $sql = "SELECT
                isc.TABLE_SCHEMA,
                isc.TABLE_NAME,
                isc.COLUMN_NAME,
                isc.COLUMN_TYPE,
                isc.IS_NULLABLE,
                FROM information_schema.columns isc
                WHERE isc.TABLE_SCHEMA = '{$dbname}'
                  AND isc.TABLE_NAME = '{$name}' ";
    $sql = "SELECT Concat('DROP TABLE `', TABLE_NAME,'`;') as queries  FROM information_schema.tables WHERE table_schema = '{$dbname}' and TABLE_NAME not like '{$prefix}_%';";
    alterTables($sql, $connection);
    $sql = "SELECT Concat('ALTER TABLE `', TABLE_NAME, '` RENAME TO `', REPLACE(TABLE_NAME,'{$prefix}_',''), '`;') as queries FROM information_schema.tables WHERE table_schema = '{$dbname}';";
    alterTables($sql, $connection);

    // Replace old language id to new
    $tables_sql = "SELECT
                isc.TABLE_SCHEMA,
                isc.TABLE_NAME
                FROM information_schema.columns isc
                WHERE isc.TABLE_SCHEMA = '{$dbname}'
                      and isc.COLUMN_NAME = 'language_id'";
    $tables_sql = tep_db_query($tables_sql);
    while ($table = tep_db_fetch_array($tables_sql)) {
        // Replace only in imported tables
        if (in_array($table['TABLE_NAME'], $_POST['tables'])) {
            foreach ($languageMap as $oldId => $newId) {
                $sql = "UPDATE IGNORE {$table['TABLE_NAME']} 
                    SET language_id = {$newId} 
                    WHERE language_id = {$oldId}";
                tep_db_query($sql);
            }
        }
    }

    mapImagesInDB($connection);
    checkProductsImages($connection);

    unlink(__DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'db.json');
    unlink(__DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'db.sql');
    $importDone = true;

    if ($reopenConnection) {
        // Set default max_allowed_packet after import
        $connection->query('SET @@global.max_allowed_packet = ' . $max_alloved_packet);
        // Set default sql_mode after import
        $connection->query('SET @@global.sql_mode = "' . $slqMode . '"');
    }
}


include_once('html-open.php');
include_once('header.php');
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.js"></script>
    <script src="/ext/osc_import/osc_import.js"></script>
    <link href="/ext/osc_import/osc_import.css" rel="stylesheet" />
    <div class="container" id="oscImportContainer">
        <?php if ($images = getArrayFromJsonFile(PRODUCTS_IMAGES_JSON_PATH)) { ?>
            <?php if ($images['inProgress'] === false) { ?>
            <form enctype="multipart/form-data" method="post" id="downloadImagesFromOldWebsite">
                <div class="success">
                    <p> We almost done, database already imported, and finally we can download images for products.</p>
                    <label>Enter URL to the folder with products images on your old website (i.e. https://solomono.net/images/products/) and we try to download images </label>
                    <br>
                    <input type="text" name="oldhostname" required style="width: 100%;">
                </div>

                <div class='progress hidden' id="downloadProgress">
                    <div class='progress-bar' id='progressBar' style="width: <?= ($images['exist'] / $images['total'] * 100) ?>%;">
                        <div class='percent' id='percent'><?= $images['exist'] ?> / <?= $images['total'] ?></div>
                    </div>
                </div>
                <button type="submit">go</button>
            </form>
            <?php } else { ?>
            <p id="imageLoadingTitle">Download in progress</p>
            <div class='progress' id="downloadProgress">
                <div class='progress-bar' id='progressBar' style="width: <?= ($images['exist'] / $images['total'] * 100) ?>%;">
                    <div class='percent' id='percent'><?= $images['exist'] ?> / <?= $images['total'] ?></div>
                </div>
            </div>
            <script type="text/javascript">
                getImageDownloadProgress(
                    {timestamp : new Date().getTime(), current : <?=$images['exist']?>}
                );
            </script>
            <?php } ?>
        <?php } elseif ($importDone) { ?>
            <div class="success">
                Import done!
            </div>
        <?php } elseif (!file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'db.sql')) { ?>
            <form enctype="multipart/form-data" method="post" id="fileUpload">
                <!--                <input type="file" name="db" required accept=".sql">-->
                <!--                <button type="submit">go</button>-->
                <div class="actions">
                    <label>
                        <input type="file" required class="load_file" name="db" accept=".sql">
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
                            <?php echo OSC_IMPORT_UPLOAD_FILE; ?>
                        </span>
                    </label>
                    <button type="submit" class="btn btn-info green_btn"><?php echo OSC_IMPORT_UPLOAD_BUTTON; ?></button>
                </div>
            </form>
            <div class='progress' id="progressDivId" style="display: none;">
                <div class='progress-bar' id='progressBar'>
                    <div class='percent' id='percent'>0%</div>
                </div>
            </div>
            <div id="oscImportResponse">
            </div>
        <?php } else { ?>
            <div id="oscImportResponse">
                <?php if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'db.sql')) {
                    require_once __DIR__ . DIRECTORY_SEPARATOR . 'uploadFile.php';
                } ?>
            </div>
        <?php } ?>
    </div>
<?php
//require('footer.php');
//require('html-close.php');
//require(DIR_WS_INCLUDES . 'application_bottom.php');