<?php

    require_once('price_settings.php');
    chdir('../../../');
    $rootPath = dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))));
    require('includes/application_top.php');

    require($admin . '/' . DIR_WS_LANGUAGES . $_POST['language'] . '/customers.php');

    require_once('Worksheet.php');
    require_once('Workbook.php');

  $filemane = 'customers.xls';
    $workbook = new Workbook($filemane);
    $worksheet1 =&$workbook->add_worksheet(iconv('utf-8', 'cp1251', TEXT_CUST_XLS));

    $formatp =& $workbook->add_format();
    $formatp->set_size(10);
    $formatp->set_align('left');
    $formatp->set_color('black');
    $formatp->set_fg_color('white');
    $formatp->set_pattern(0);

    $worksheet1->set_row(0, 30);
    $worksheet1->write_string(0, 0, iconv('utf-8', 'cp1251', TEXT_CUST_XLS_MODEL), $formatot);
    $worksheet1->write_string(0, 1, iconv('utf-8', 'cp1251', TEXT_CUST_XLS_NAME), $formatot);
    $worksheet1->write_string(0, 2, iconv('utf-8', 'cp1251', TEXT_CUST_XLS_LASTNAME), $form);
    $worksheet1->write_string(0, 3, iconv('utf-8', 'cp1251', TEXT_CUST_XLS_CITY), $formatot);
    $worksheet1->write_string(0, 4, iconv('utf-8', 'cp1251', TEXT_CUST_XLS_PHONE), $formatot);
    $worksheet1->write_string(0, 5, iconv('utf-8', 'cp1251', TEXT_CUST_XLS_EMAIL), $formatot);
    $worksheet1->write_string(0, 6, iconv('utf-8', 'cp1251', TEXT_CUST_XLS_ORDERS), $formatot);
    $worksheet1->write_string(0, 7, iconv('utf-8', 'cp1251', TEXT_CUST_XLS_GROUP), $formatot);
  $worksheet1->write_string(0, 8, iconv('utf-8', 'cp1251', TEXT_CUST_XLS_DATE), $formatot);

    $worksheet1->set_column(0, 0, 7);
    $worksheet1->set_column(1, 1, 40);
    $worksheet1->set_column(2, 2, 25);
    $worksheet1->set_column(3, 3, 25);
    $worksheet1->set_column(4, 4, 30);
    $worksheet1->set_column(5, 5, 30);
    $worksheet1->set_column(6, 6, 10);
    $worksheet1->set_column(7, 7, 25);
  $worksheet1->set_column(8, 8, 25);
    $count = 1;

  $gid = $_POST['customers_groups_id_xls'] ? 'WHERE c.customers_groups_id = ' . $_POST['customers_groups_id_xls'] : '';

    $customers_query = tep_db_query('
	SELECT 
	c.customers_id, 
	c.customers_firstname,  
	c.customers_lastname, 
  cg.customers_groups_name,
	ab.entry_city, 
	c.customers_telephone, 
	ci.customers_info_date_account_created,
	c.customers_email_address,
	COUNT(o.customers_id) as number_orders
	FROM 
	customers c
	INNER JOIN customers_groups cg ON cg.customers_groups_id = c.customers_groups_id
  INNER JOIN address_book ab ON ab.customers_id = c.customers_id
	INNER JOIN customers_info ci ON ci.customers_info_id = c.customers_id
	AND ab.address_book_id = c.customers_default_address_id LEFT OUTER JOIN orders o ON o.customers_id = c.customers_id 
	' . $gid . '   
	GROUP BY c.customers_email_address, c.customers_telephone order by c.customers_id desc');

    while ($listing[] = tep_db_fetch_array($customers_query)) {
    }

    array_pop($listing);//Убираем последний елемент, так как он всегда пуст

    $tmp_array = $listing;
    for ($i = 0, $cnt = count($listing); $i < $cnt; $i++) {
        $kay_check_iterator = 0;
        for ($j = 0, $cnt1 = count($tmp_array); $j < $cnt1; $j++) {
            if ($listing[$i]['customers_email_address'] == $tmp_array[$j]['customers_email_address']) {
                if (substr(preg_replace('| +|', '', $listing[$i]['customers_telephone']), -7) == substr(preg_replace('| +|', '', $tmp_array[$j]['customers_telephone']), -7) && $listing[$i]['customers_id'] != $tmp_array[$j]['customers_id']) {
                    unset($tmp_array[$j]);
                }
            }
        }
        unset($listing[$i]);
    }
    unset($listing);
    foreach ($tmp_array as $k => $v) {
        $worksheet1->write_string($count, 0, iconv('utf-8', 'cp1251', $v['customers_id']), $formatp);
        $worksheet1->write_string($count, 1, iconv('utf-8', 'cp1251', $v['customers_firstname']), $formatp);
        $worksheet1->write_string($count, 2, iconv('utf-8', 'cp1251', $v['customers_lastname']), $formatp);
        $worksheet1->write_string($count, 3, iconv('utf-8', 'cp1251', $v['entry_city']), $formatp);
        $worksheet1->write_string($count, 4, iconv('utf-8', 'cp1251', $v['customers_telephone']), $formatp);
        $worksheet1->write_string($count, 5, iconv('utf-8', 'cp1251', $v['customers_email_address']), $formatp);
        $worksheet1->write_string($count, 6, iconv('utf-8', 'cp1251', $v['number_orders']), $formatp);
        $worksheet1->write_string($count, 7, iconv('utf-8', 'cp1251', $v['customers_groups_name']), $formatp);
        $worksheet1->write_string($count, 8, iconv('utf-8', 'cp1251', $v['customers_info_date_account_created']), $formatp);

        $count++;
    }

    $workbook->close();

    header("Content-type: application/vnd.ms-excel; text/html; ");
    header("Content-Disposition: attachment; filename=" . $filemane);
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Pragma: public");

    $blah = readfile($filemane);
    echo $blah[0];
