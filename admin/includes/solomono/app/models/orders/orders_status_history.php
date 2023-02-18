<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\orders;

use admin\includes\solomono\app\core\Model;

class orders_status_history extends Model {

    protected $allowed_fields = [
        'date_added' => [
            'label' => TABLE_HEADING_DATE_ADDED,
        ],
        'customer_notified' => [
            'label' => TABLE_HEADING_CUSTOMER_NOTIFIED,
        ],
        'orders_status_id' => [
            'label' => TABLE_HEADING_STATUS,
        ],
        'comments' => [
            'label' => TABLE_HEADING_COMMENTS,
            'general'=>'textarea',
            'ckeditor'=>true
        ],

    ];
    protected $prefix_id = 'orders_status_id';

    public function select($id = false) {
        $id = (int) $id;
        $sql = "SELECT {$this->getField()},`orders_id` FROM " . TABLE_ORDERS_STATUS_HISTORY . " WHERE orders_id = '" . $id . "' order by date_added";
        $this->data['data'] = $this->getResult($sql);
        updateOrderViewsCount($id);
    }

    public function getOrdersStatus($currentName=false) {
        $sql = "SELECT `orders_status_id`,`orders_status_name`,`orders_status_color`, `orders_status_text` FROM `orders_status` WHERE `language_id` ='{$this->language_id}'";
        $this->data['orders_status'] = $this->getResultKey($sql, 'orders_status_id');
        if($currentName){
            $this->setOrderStatusName($currentName);
        }
    }

    private function setOrderStatusName($currentName){
        $currentStatus = array_filter($this->data['orders_status'],function($arr) use ($currentName){return $arr['orders_status_name'] == $currentName; });
        $currentStatus = array_pop($currentStatus);
        $this->data['current_status_id'] = $currentStatus['orders_status_id'];
        $this->data['current_status'] = $currentName;
    }

    public function insert($data) {
        unset($data['orders_status_name']);
        $data['date_added']=date("Y-m-d H:i:s");
        return parent::insert($data);
    }

    public function getOrderStatusText(){
        $sql = "SELECT orders_status_id, orders_status_text FROM orders_status WHERE `language_id` ='{$this->language_id}'";
        return json_encode($this->getResultKey($sql, 'orders_status_id'));
    }
    public function getOrderStatusById($id){
        $status = tep_db_fetch_array(tep_db_query("SELECT orders_status_text,orders_status_name FROM orders_status WHERE `language_id` ='{$this->language_id}' and `orders_status_id` = '$id'"));
        return $status?:[];
    }
    public function customersInfo($id){
        $sql="SELECT `o`.`customers_email_address`,`o`.`date_purchased`,`c`.`customers_firstname`, `c`.`customers_lastname`, `o`.`customers_name`
                FROM `orders` `o`
                  LEFT JOIN `customers` `c` ON `c`.`customers_id` = `o`.`customers_id`
                WHERE `o`.`orders_id` = '{$id}'";
        $sql = tep_db_query($sql);
        $result = tep_db_fetch_array($sql);
        return $result;
    }
    public function changeStatusGroup($status, $arr, $email = false, $comment){
        $ids=explode(',',$arr);
        $comment = tep_db_prepare_input($comment);
        $statusName = $this->getOrderStatusById($status)['orders_status_name'];
        foreach ($ids as $k=>$id) {
            $order_info=tep_get_order_info($id);
            $customer_email_text=EMAIL_TEXT_STATUS_UPDATE;
            if(!tep_db_query("UPDATE `orders` SET `orders_status`='{$status}',`last_modified`=now() WHERE `orders_id`='{$id}'")){
                return false;
            }
            if(!tep_db_query("INSERT INTO `orders_status_history` SET `comments`='$comment',`date_added`=now(), `orders_status_id`='{$status}',`orders_id`='{$id}'")){
                return false;
            }

            if ($email) {
                $email_text=STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $order_info['orders_id'] . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $order_info['orders_id'], 'SSL') . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long($order_info['date_purchased']) . "\n\n" . sprintf($customer_email_text, $this->data['orders_status'][$status]);
                $subject = EMAIL_TEXT_SUBJECT;
                if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                    require_once(DIR_FS_EXT . 'email_content/functions.php');
                    $content_email_array = getChangeOrderStatusText($this->language_id,$order_info, $statusName, $comment);
                    $email_text = $content_email_array['content_html'] ? : $email_text;
                    $subject = $content_email_array['subject'] ? : $subject;
                }

                tep_mail($order_info['delivery_name'], $order_info['customers_email_address'], $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            }
        }
        return true;
    }

}