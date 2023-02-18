<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    require('includes/application_top.php');
    includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONTACT_US);
    if (tep_session_is_registered('customer_id')) {
        $customer_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id='" . $_SESSION['customer_id'] . "'");
        $customer_array = tep_db_fetch_array($customer_query);

        $customer_name = $customer_array['customers_firstname'] . " " . $customer_array['customers_lastname'];
        $customer_email = $customer_array['customers_email_address'];
    } else {
        $customer_name = '';
        $customer_email = '';
    }
    $output = array();
    $output['title'] = POP_CONTACT_US;
    $output['html'] = tep_draw_form('contact_us', tep_href_link(FILENAME_CONTACT_US, 'action=send'));
    $output['html'] .= '<input type="hidden" name="send_to" value="' . STORE_OWNER_EMAIL_ADDRESS . '" />
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="' . ENTRY_NAME . '" value="' . $customer_name . '" />
          </div>
          <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="' . ENTRY_EMAIL . '" value="' . $customer_email . '" />  
          </div>
          <div class="form-group">
            <input type="text" name="phone" class="form-control" placeholder="' . ENTRY_PHONE . '" />   
          </div>
          <div class="form-group">
            <textarea name="enquiry" class="form-control" rows="3" placeholder="' . ENTRY_ENQUIRY . '"></textarea>      
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">' . BUTTON_CANCEL . '</button>
            <button class="btn btn-primary">' . BUTTON_SEND . '</button>
          </div>
        ';

    $output['html'] .= '</form>';
    echo json_encode($output);
    die;
}
