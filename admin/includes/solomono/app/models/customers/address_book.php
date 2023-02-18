<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 07.09.2017
 * Time: 14:06
 */

namespace admin\includes\solomono\app\models\customers;


use admin\includes\solomono\app\core\Model;

class address_book extends Model {

    protected $prefix_id='address_book_id';
    protected $table='address_book';
    private $id_customer;
    protected $allowed_fields=[
        'customer_cabinet'=>[
            'customers_firstname'=>[
                'label'=>TABLE_HEADING_FIRSTNAME,
                'type'=>'select',
            ],
            'customers_lastname'=>[
                'label'=>TABLE_HEADING_LASTNAME,
                'type'=>'text',
            ],
            'customers_email_address'=>[
                'label'=>TEXT_CUST_XLS_EMAIL,
                'type'=>'text',
            ],
            'customers_telephone'=>[
                'label'=>TEXT_CUST_XLS_PHONE,
                'type'=>'text',
            ],
        ],
        'customer_subscribe'=>[
            'customers_newsletter'=>[
                'label'=>ENTRY_NEWSLETTER,
                'type'=>'status',
            ],
        ],
        'address_book'=>[
            'address_book_id'=>[
                'label'=>'address_book_id',
                'type'=>'text',
                'hideInForm'=>true
            ],
            'entry_firstname'=>[
                'label'=>TABLE_HEADING_FIRSTNAME,
                'type'=>'text',
            ],
            'entry_lastname'=>[
                'label'=>TABLE_HEADING_LASTNAME,
                'type'=>'text',
            ],
            'entry_street_address'=>[
                'label'=>CUSTOMERS_STREET_ADDRESS,
                'type'=>'text',
            ],
            'entry_company'=>[
                'label'=>SUBTITLE_COMPANY,
                'type'=>'text',
            ],
            'entry_postcode'=>[
                'label'=>SUBTITLE_POSTCODE,
                'type'=>'text',
            ],
            'entry_phone'=>[
                'label'=>TEXT_CUST_XLS_PHONE,
                'type'=>'text',
                'hideInForm'=>true
            ],
            'entry_fax'=>[
                'label'=>CUSTOMERS_FAX,
                'type'=>'text',
                'hideInForm'=>true
            ],
            'entry_city'=>[
                'label'=>TEXT_CUST_XLS_CITY,
                'type'=>'text',
            ],
            'entry_country_id'=>[
                'label'=>TEXT_INFO_COUNTRY,
                'type'=>'select',
                'option'=>[
                    'id'=>'countries_id',
                    'title'=>'countries_name',
                    'table'=>'countries'
                ]
            ],
            'entry_zone_id'=>[
                'label'=>ENTRY_STATE,
                'type'=>'select',
                'option'=>[
                    'id'=>'zone_id',
                    'title'=>'zone_name',
                    'table'=>'zones',
                ]
            ],
        ],
        'customer_discount'=>[
            'customers_groups_id'=>[
                'label'=>ENTRY_CUSTOMERS_GROUPS_NAME,
                'type'=>'select',
                'option'=>[
                    'id'=>'customers_groups_id',
                    'title'=>'customers_groups_name',
                    'table'=>'customers_groups'
                ]
            ],
            'customers_discount'=>[
                'label'=>ENTRY_CUSTOMERS_DISCOUNT,
                'type'=>'text',
            ],

        ],
    ];

    public function __construct() {
        $this->data['allowed_fields']=$this->allowed_fields;
    }

    /**
     * @param mixed $id_customer
     */
    public function setIdCustomer($id_customer) {
        $this->id_customer=$id_customer;
    }

    public function select() {
    }

    public function selectOne() {
        $this->data['id']=$this->id_customer;

        $this->selectAllCountry();
        $this->selectAllZones();

        $customer_info=$this->getCustomerInfo();
        $this->splitCustomersOnBlocks($customer_info);
        $this->data['address_book']=$this->getAddressBooks();
        $this->data['account_fields']=$this->getAccountFields();

    }
    private function getAccountFields(){
        return [
                'entry_company'=>ACCOUNT_COMPANY,
                'entry_lastname'=>ACCOUNT_LAST_NAME,
                'entry_street_address'=>ACCOUNT_STREET_ADDRESS,
                'entry_postcode'=>ACCOUNT_POSTCODE,
                'entry_city'=>ACCOUNT_CITY,
        ];
    }
    public function update($data) {
        $this->data['address_book']['id']=$data['address_book_id'];
        $data['customers_discount'] = - abs($data['customers_discount']);
        unset($data['address_book_id']);
        if ($data['customer_discount_notify'] === 'on'){
            $this->notifyCustomerOnCustomerGroupChange($data);
        }
        $this->checkPassword($data['password'],$data['password_confirm']);
        $this->checkCheckbox($data,['customers_newsletter','customers_sms']);
        $this->splitCustomersOnBlocks($data);
        $this->checkDefaultAddressBook($data);
        if (!is_numeric($this->data['address_book']['entry_zone_id'])){
            $this->data['address_book']['entry_state'] = $this->data['address_book']['entry_zone_id'];
            $this->data['address_book']['entry_zone_id'] = 0;
        }
        $address_book_query=$this->prepareFields($this->data['address_book']);
        $customers_query=$this->prepareFields(array_merge($this->data['customer_cabinet'],$this->data['customer_subscribe'],$this->data['customer_discount'])+['id'=>$this->id_customer],'customers','customers_id');
        //$customers_info_query=$this->prepareFields($this->data['customer_info']+['id'=>$this->id_customer],'customers_info','customers_info_id');

        if(!tep_db_query($address_book_query))$this->error[]=sprintf(ADDRESS_BOOK_ERROR_UPDATE,TABLE_CUSTOMERS_INFO,'address_book_query');
        if(!tep_db_query($customers_query))$this->error[]=sprintf(ADDRESS_BOOK_ERROR_UPDATE,TABLE_CUSTOMERS_INFO,'customers');;
        //if(!tep_db_query($customers_info_query))$this->error[]=sprintf(ADDRESS_BOOK_ERROR_UPDATE,TABLE_CUSTOMERS_INFO,'customers_info');;

        return $this->error?false:true;
    }
    
    public function insert($data)
    {
        $prepare_data = [];
        foreach ($data as $k => $v){
            $prepare_data[$k] = tep_db_prepare_input($v);
        }
        if ($prepare_data['customer_discount_notify'] === 'on'){
            $this->notifyCustomerOnCustomerGroupChange($prepare_data);
        }

        $this->checkPassword($prepare_data['password'],$prepare_data['password_confirm']);

        $sql_data_array = array(
            'customers_firstname' => $prepare_data['customers_firstname'],
            'customers_lastname' => $prepare_data['customers_lastname'],
            'customers_email_address' => $prepare_data['customers_email_address'],
            'customers_dob' => date('Y-m-d'),
            'customers_telephone' => $prepare_data['customers_telephone'],
            'customers_fax' => $prepare_data['customers_fax'],
            'customers_discount' => $prepare_data['customers_discount'],
            'customers_newsletter' => $prepare_data['customers_newsletter'] == 'on'?1:0,
            'customers_groups_id' => $prepare_data['customers_groups_id'],
            'customers_password' => $this->data['customer_cabinet']['customers_password'],
            'customers_default_address_id' => 1);

        //if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
        if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($prepare_data['customers_dob']);

        tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

        $customer_id = tep_db_insert_id();

        $this->insertAddressBook($customer_id, $prepare_data);

        $address_id = tep_db_insert_id();

        tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

        tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");

        return $customer_id;
    }

    public function insertAddressBook($customer_id, $prepare_data){

        $sql_data_array = array('customers_id' => $customer_id,
            'entry_firstname' => $prepare_data['entry_firstname'],
            'entry_lastname' => $prepare_data['entry_lastname'],
            'entry_street_address' => $prepare_data['entry_street_address'],
            'entry_postcode' => $prepare_data['entry_postcode'],
            'entry_city' => $prepare_data['entry_city'],
            'entry_country_id' => (int)$prepare_data['entry_country_id']);

        //if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
        if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $prepare_data['entry_company'];
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $prepare_data['entry_suburb'];
        if (ACCOUNT_STATE == 'true') {
            if ($prepare_data['entry_zone_id'] > 0) {
                $sql_data_array['entry_zone_id'] = $prepare_data['entry_zone_id'];
                $sql_data_array['entry_state'] = '';
            } else {
                $sql_data_array['entry_zone_id'] = '0';
                $sql_data_array['entry_state'] = $prepare_data['entry_state'];
            }
            if (!is_numeric($prepare_data['entry_zone_id'])){
                $sql_data_array['entry_state'] = $prepare_data['entry_zone_id'];
                $sql_data_array['entry_zone_id'] = 0;
            }
        }

        tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
    }

    private function checkDefaultAddressBook($data){
        if(isset($data['customers_default_address_id'])){
            $this->data['customer_cabinet']['customers_default_address_id']= $this->data['address_book']['id'];
        }
    }

    private function checkPassword($password,$confirm){
        if (tep_not_null($password)) {
            if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
                $this->error[]=ENTRY_PASSWORD_MIN_LENGTH;
            }elseif ($password!=$confirm) {
                $this->error[]='Passwords do not match';
            }else{
               $this->data['customer_cabinet']['customers_password']=tep_encrypt_password($password);
            }
        }
    }

    private function checkCheckbox(&$data,array $allow_field){
        foreach ($allow_field as $item) {
            if(isset($data[$item])){
                $data[$item]='1';
            }else{
                $data[$item]='0';
            }
        }
    }

    private function splitCustomersOnBlocks(array $data){
        foreach ($data as $k => $v){
            $this->getCustomerBlock($v,$k);
        }
        //array_filter($data,[$this,'getCustomerBlock'], ARRAY_FILTER_USE_BOTH);  works only on >=  php 5.6
    }

    private function getCustomerBlock($v,$field_name) {
        if (array_key_exists($field_name, $this->allowed_fields['customer_cabinet'])) {
            $this->data['customer_cabinet'][$field_name]=$v;
        }elseif (array_key_exists($field_name, $this->allowed_fields['customer_subscribe'])) {
            $this->data['customer_subscribe'][$field_name]=$v;
        }elseif (array_key_exists($field_name, $this->allowed_fields['customer_discount'])) {
            $this->data['customer_discount'][$field_name]=$v;
        }elseif (array_key_exists($field_name, $this->allowed_fields['address_book'])) {
            $this->data['address_book'][$field_name]=$v[$this->data['address_book']['id']];
        }elseif ($field_name=='customers_default_address_id') {
            $this->data['customers_default_address_id']=$v;
        }
    }

    private function getAddressBooks(){
        $sql="SELECT
                  `ad`.`address_book_id`,
                  `ad`.`entry_firstname`,
                  `ad`.`entry_lastname`,
                  `ad`.`entry_street_address`,
                  `ad`.`entry_company`,
                  `ad`.`entry_postcode`,
                  `ad`.`entry_city`,
                  `ad`.`entry_country_id`,
                  `ad`.`entry_state`,
                  `ad`.`entry_zone_id`
                FROM `address_book` `ad`
                WHERE `ad`.`customers_id` = '{$this->id_customer}'";
       return $this->getResultKey($sql, 'address_book_id');
    }

/*    private function getCountry(){
        $sql="SELECT
                      `c`.`countries_id`,
                      `c`.`countries_name`
                    FROM `countries` `c`";
        $this->data['option']['entry_country_id']=$this->getResultKey($sql,'countries_id');
    }
*/
    private function getZones(){
        $sql="SELECT
                      `z`.`zone_id`,
                      `z`.`zone_country_id`,
                      `z`.`zone_name`
                    FROM `zones` `z`";
        $this->data['option']['entry_zone_id']=$this->getResultKey($sql,'zone_id');
    }

    public function selectAllCountry(){
        $this->optionFields('entry_country_id', $this->allowed_fields['address_book']['entry_country_id']['option']);
    }

    public function selectAllZones(){
//        $this->optionFields('entry_zone_id', $this->allowed_fields['address_book']['entry_zone_id']['option']);
        $this->getZones();
    }
    public function selectAllCustomersGroups(){
        $this->optionFields('customers_groups_id', $this->allowed_fields['customer_discount']['customers_groups_id']['option']);
    }


    private function getCustomerInfo() {
        $sql="SELECT
                  `c`.`customers_default_address_id`,
                  `c`.`customers_firstname`,
                  `c`.`customers_lastname`,
                  `c`.`customers_email_address`,
                  `c`.`customers_telephone`,
                  `c`.`customers_newsletter`,
                  `c`.`customers_discount`,
                  `c`.`customers_groups_id`                  
                FROM `customers` `c`
                  LEFT JOIN `customers_info` `ci` ON `ci`.`customers_info_id` = `c`.`customers_id`
                WHERE `c`.`customers_id` = '{$this->id_customer}'";
      return $this->getResult($sql)[0];
    }

    
    public function checkEmail($email_address){
        $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and guest_flag != '1'");
        $check_email = tep_db_fetch_array($check_email_query);
        $error = false;
        if ($check_email['total'] > 0) {
            $error = true;
        }
        return $error;
    }

    public function notifyCustomerOnCustomerGroupChange($data){
        global $languages_id,$language;
        include (DIR_WS_LANGUAGES.$language.'/edit_orders.php');
        $this->selectAllCustomersGroups();
        $customers_groups_name = $this->data['option']['customers_groups_id'][$data['customers_groups_id']];
        $current_discount = $data['customers_discount'];
        $text=EMAIL_TEXT_CURRENT_GROUP . $customers_groups_name . "\n" . EMAIL_TEXT_DISCOUNT . $current_discount . "%";

        // to store owner
        $email_text=EMAIL_ACC_DISCOUNT_INTRO_OWNER . "<br/>" . EMAIL_TEXT_CUSTOMER_NAME . ' ' . $data['customers_firstname'] . ' ' . $data['customers_lastname'] . "<br/>" . EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS . ' ' . $data['customers_email_address'] . "<br/>" . EMAIL_TEXT_CUSTOMER_TELEPHONE . ' ' . $data['customers_telephone'] . "<br/><br/>" . $text;
        tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_ACC_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

        // to customer
        $email_text=EMAIL_ACC_INTRO_CUSTOMER . "\n\n" . $text . "\n\n" . EMAIL_ACC_FOOTER;
        $subject = EMAIL_ACC_SUBJECT;

        if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
            require_once(DIR_FS_EXT . 'email_content/functions.php');
            $emailData = [
                'customers_name' => $data['customers_firstname'],
                'customers_group' => $customers_groups_name,
                'customers_discount' => $current_discount,
            ];
            $content_email_array = getChangeGroupManualText($languages_id, $emailData);
            $email_text = $content_email_array['content_html'] ? : $email_text;
            $subject = $content_email_array['subject'] ? : $subject;
        }
        tep_mail($data['customers_firstname'] . ' ' . $data['customers_lastname'], $data['customers_email_address'], $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
    }

}