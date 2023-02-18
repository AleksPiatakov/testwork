<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 07.09.2017
 * Time: 14:06
 */

namespace admin\includes\solomono\app\models\customers;


use admin\includes\solomono\app\core\Model;

class mail extends Model {

    protected $table='send_mail';
    private $id_customer;
    protected $allowed_fields=[
        'customers_email_address'=>[
            'label'=>MAIL_TO,
            'type'=>'select',
        ],
        'from'=>[
            'label'=>MAIL_FROM,
            'type'=>'text',
        ],
        'subject'=>[
            'label'=>MAIL_SUBJECT,
            'type'=>'text',
        ],
        'message'=>[
            'label'=>MAIL_MESSAGE,
            'type'=>'textarea',
            'ckeditor'=>true,
            'rows'=>10,
        ],
    ];

    public function __construct() {
        $this->data['allowed_fields']=$this->allowed_fields;
    }

    public function sendMail($data)
    {
        $customers_email_address = tep_db_prepare_input($data['customers_email_address']);
        $from = tep_db_prepare_input($data['from']);
        $subject = tep_db_prepare_input($data['subject']);
        $message = tep_db_prepare_input($data['message']);
        switch ($customers_email_address) {
            case 'all_customers':
                $sql = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS);
                break;
            case 'all_newsletter':
                $sql = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_newsletter = '1'");
                break;
            default:
                $sql = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($customers_email_address) . "'");
                break;
        }
        while ($mail = tep_db_fetch_array($sql)) {
            $sended = tep_mail($mail['customers_firstname'] . ' ' . $mail['customers_lastname'], $mail['customers_email_address'], $subject, $message, $from, STORE_OWNER_EMAIL_ADDRESS);
            if (!$sended) {
                $this->error[] = sprintf(MAIL_ERROR_SEND, $mail['customers_email_address']);
            }
        }

    }

    /**
     * @param mixed $id_customer
     */
    public function setIdCustomer($id_customer) {
        $this->id_customer=$id_customer;
    }

    public function select() {
        $this->data['data']['customers_email_address']=array_column($this->getCustomer(), 'customer', 'email') + $this->getListSendTo();
        $this->data['data']['from']=$this->getFrom();
        $this->data['data']['subject']='';
        $this->data['data']['message']='';

    }

    private function getCustomer() {
        $sql="SELECT
                  concat(`c`.`customers_lastname`, ' ', `c`.`customers_firstname`,'(', `c`.`customers_email_address` ,')') `customer`,
                  `c`.`customers_email_address` as `email`
                FROM `customers` `c`
                WHERE `c`.`customers_id` = '{$this->id_customer}'";
        return $this->getResult($sql);
    }

    private function getListSendTo() {
        $arr_list=[
            'all_customers'=>MAIL_ALL_CUSTOMERS,
            'all_newsletter'=>MAIL_ALL_SUBSCRIBER
        ];

        return $arr_list;
    }

    private function getFrom() {
        return STORE_OWNER_EMAIL_ADDRESS;
    }
}