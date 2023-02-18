<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    require_once('includes/application_top.php');
    switch ($_POST['request']) {
        case 'getBuyOnClickForm':
            ob_start();
            if (file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/quick_buy_form.tpl.php')) {
                require_once DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/quick_buy_form.tpl.php';
            } else {
                require_once DIR_WS_CONTENT . '/quick_buy_form.tpl.php';
            }
            $form = ob_get_contents();
            ob_end_clean();
            echo json_encode(array('html' => $form));
            break;
        case 'getLoginForm':
            ob_start();
            if (file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/modal_login.tpl.php')) {
                require_once DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/modal_login.tpl.php';
            } else {
                require_once DIR_WS_CONTENT . '/modal_login.tpl.php';
            }

            $form = ob_get_contents();
            ob_end_clean();
            echo json_encode(array('html' => $form));
            break;
        case 'QuickBuyProccess':
            try {
                //validate
                $phone = trim($_POST['phone']);
                if ( !\Solomono\CSRF ::isValid()) {
                    throw new Exception(getConstantValue('INVALID_CSRF_TOKEN', 'Invalid csrf token'));
                }
                if ( !$phone || strlen($phone) < 6 || preg_match('|[^0-9\-\+()]+|', $phone, $matches)) {
                    throw new Exception(getConstantValue('EMPTY_PHONE_NUMBER', 'Invalid phone number'));
                }

                $message = addDoubleDot(IMAGE_BUTTON_CONFIRM_ORDER) . '<br>';
                $message .= addDoubleDot(ENTRY_TELEPHONE_NUMBER) . ' ' . $_POST['phone'] . '<br>';
                $message .= addDoubleDot(PREV_NEXT_PRODUCT) . ' ' . tep_get_products_name(tep_db_prepare_input((int)$_POST['products_id'])) . '<br>';
                $message .= addDoubleDot(LOW_STOCK_TEXT2) . ' ' . $_POST['model'];

                if (tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, QUICK_ORDER, $message, STORE_NAME, STORE_OWNER_EMAIL_ADDRESS)) {
                    tep_db_query("INSERT INTO " . TABLE_QUICK_ORDERS . " (phone_number, referer, status) VALUES ('" . $phone . "', '" . $_SERVER['HTTP_REFERER'] . "', 0)");

                    //Send sms to admin when buying in one click
                    if (SMS_OWNER_ENABLE_BUY_ONE_CLICK && SMSINFORM_MODULE_ENABLED == 'true') {
                        include('ext/sms/sms_success_buy_on_click.php');
                    }
                    $response = array('success' => true, 'message' => '<span>' . QUICK_ORDER_SUCCESS . '</span>');
                } else {
                    throw new Exception("Message wasn't sent");
                }
            } catch (Exception $e) {
                $response = array('success' => false, 'message' => $e->getMessage());
            }

            echo json_encode($response);
            die();
            break;
        case 'getBugReportForm':    //return content of bug report form
            ob_start();
            if (file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/bug_report_form.tpl.php')) {
                require_once DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/bug_report_form.tpl.php';
            } else {
                require_once DIR_WS_CONTENT . '/bug_report_form.tpl.php';
            }
            $form = ob_get_contents();
            ob_end_clean();
            echo json_encode(array('html' => $form));
            break;
        case 'BugReportProccess':   //write collected data to DB and send it to mail
            $report_text = tep_db_prepare_input($_POST['report_text']);
            $report_image = strtr($_POST['img_base64'], '._-', '+/=');  //decode from the url-transported state
            $report_image_data = str_replace('data:image/png;base64,', '', $report_image);
            $user_agent = tep_db_prepare_input($_SERVER['HTTP_USER_AGENT']);
            $headers = tep_db_prepare_input($_SERVER['CONTENT_TYPE']);
            $page_uri = tep_db_prepare_input($_SERVER['HTTP_REFERER']);
            $session_id = tep_db_prepare_input($_SERVER['SSL_SESSION_ID']);
            //generate random file name
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $rand_string = '';
            for ($i = 0; $i < 4; $i++) {
                $rand_string .= substr($chars, rand(1, strlen($chars)) - 1, 1);
            }
            $particle_timestamp = substr(time(), 4);
            $report_image_name = "report_" . $rand_string . $particle_timestamp . ".png";
            //check directory exist
            $images_dir = "images/";
            $report_dir = "screenshots/";
            if (!is_dir($images_dir . $report_dir)) {
                $permission = 0755;
                mkdir($images_dir . $report_dir, $permission);
            }
            $file_path = $report_dir . $report_image_name;
            //save image as file
            file_put_contents($images_dir . $file_path, base64_decode($report_image_data));
            //write collected data to DB
            if (tep_db_query("SHOW TABLES FROM " . DB_DATABASE . " LIKE '" . TABLE_BUG_REPORT . "'")->num_rows < 1) {
                tep_db_query("CREATE TABLE " . TABLE_BUG_REPORT . " (
                    report_id int(11) NOT NULL AUTO_INCREMENT,
                    report_text varchar(255) NOT NULL,
                    report_image blob NOT NULL,
                    user_agent varchar(255) NOT NULL,
                    headers varchar(255) NOT NULL,
                    page_url varchar(255) NOT NULL,
                    session_id varchar(255) NOT NULL,
                    session_data text NOT NULL,
                    cookies_data text NOT NULL,
                    date_create datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (report_id)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
            }
            $result = tep_db_query("INSERT INTO " . TABLE_BUG_REPORT . " ( report_text, report_image, user_agent, headers, page_url, session_id, session_data, cookies_data ) 
                VALUES ('" . tep_db_prepare_input($report_text) . "', '" . tep_db_prepare_input($file_path) . "', '" . tep_db_prepare_input($user_agent) . "', '" . tep_db_prepare_input($headers) . "', '" . tep_db_prepare_input($page_uri) . "', '" . tep_db_prepare_input($session_id) . "', '" . json_encode($_SESSION) . "', '" . json_encode($_COOKIE) . "')");
            //Prepare message before send
            $message = '<style>#bug_report {border-collapse: collapse;}#bug_report, #bug_report th, #bug_report td {border: 1px solid black;}#bug_report tr{margin: 5px 0} #bug_report td:first-child{width:30%} #bug_report td{text-align: left;padding: 5px;}</style>';
            $message .= '<table id="bug_report">';
            $message .= '<tr> <td>' . ENTRY_REPORT_TEXT . '</td>  <td> ' . $report_text . '</td></tr>';
//                $message .= '<tr> <td colspan="2"> <img alt="screenshot" title="screenshot" style="display:block; width:100%; height:auto;" src="'.$report_image.'" /></td></tr>';
            $message .= '<tr><td>User agent:</td>    <td> ' . $user_agent . '</td></tr>';
            $message .= '<tr><td>Headers:</td>       <td> ' . $headers . '</td></tr>';
            $message .= '<tr><td>Page uri:</td>   <td> ' . $page_uri . '</td></tr>';
            $message .= '<tr><td>Session id:</td>    <td> ' . $session_id . '</td></tr>';
            $message .= '<tr><td>Session data:</td>  <td> <pre>' . print_r($_SESSION, true) . '</pre></td></tr>';
            $message .= '<tr><td>Cookies data:</td>       <td> <pre>' . print_r($_COOKIE, true) . '</pre></td></tr>';
            $message .= '</table>';
            //send message to mail and create response answer
            $attachment = array(
                'name' => 'Screenshot.png', // Set File Name
                'data' => $report_image_data, // File Data
                'type' => 'image/png', // Type
                'encoding' => 'base64', // Content-Transfer-Encoding
                'cid' => $report_image_name
            );
            if (tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, BUG_REPORT, $message, STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, $attachment) && $result == true) {
                $response = array('success' => true,'message' => '<span>' . BUG_REPORT_SUCCESS . '</span>');
            } else {
                $response = array('success' => false);
            }
            echo json_encode($response);    //return response answer
            die();
            break;
    }
}
