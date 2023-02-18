<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 07.09.2017
 * Time: 14:06
 */

namespace admin\includes\solomono\app\models\customers;


use admin\includes\solomono\app\core\Model;

class customers extends Model {

    protected $prefix_id='customers_id';
    private $currencies;
    protected $allowed_fields=[
        'customers_id'=>[
            'label'=>'cid',
            'type'=>'text',
            'filter'=>true,
            'sort'=>true
        ],
        'customers_firstname'=>[
            'label'=>'',
            'type'=>'text',
            'filter'=>true,
            'sort'=>true
        ],
//        'customers_lastname'=>[
//            'label'=>TEXT_CUST_XLS_LASTNAME,
//            'type'=>'text',
//            'filter'=>true,
//            'sort'=>true
//        ],
        'customers_email_address'=>[
            'label'=>TEXT_CUST_XLS_EMAIL,
            'type'=>'text',
            'filter'=>true,
            'sort'=>true,
            'show'=>true
        ],
        'entry_street_address'=>[
            'label'=>TEXT_CUST_CITY,
            'type'=>'text',
            'filter'=>true,
            'sort'=>true,
            'show'=>false
        ],
        'entry_city'=>[
            'label'=>TEXT_CUST_CITY,
            'type'=>'text',
            'filter'=>true,
            'sort'=>true
        ],
        'phones'=>[
            'label'=>TEXT_CUST_XLS_PHONE,
            'type'=>'text',
            'filter'=>true,
            'sort'=>true
        ],
        'customers_info_ordersum_value'=>[
            'label'=>TEXT_CUST_SUM,
            'type'=>'text',
        ],
        'customers_info_date_account_created'=>[
            'label'=>TABLE_HEADING_ACCOUNT_CREATED,
            'type'=>'text',
            'sort'=>true
        ],
//        'customers_groups_id'=>[
//            'label'=>TABLE_HEADING_CUSTOMERS_GROUP,
//           'type'=>'select',
//            'option'=>[
//                'table'=>'customers_groups',
//                'id'=>'customers_groups_id',
//                'title'=>'customers_groups_name'
//            ],
//            'show => false'
//
//        ],
        'customers_groups_name'=>[
            'label'=>TABLE_HEADING_CUSTOMERS_GROUP,
            'type'=>'text',
            'filter_select'=>true,
            'table_select'=>'customers_groups_id',
            'option' => [
                'table'=>'customers_groups',
                'id'=>'customers_groups_id',
                'title'=>'customers_groups_name',
            ],
            'sort'=>true,
            'params' => ''
        ],
        'status'=>[
            'label'=>TABLE_HEADING_CUSTOMERS_STATUS,
            'type'=>'status',
            'hideInForm'=>true
        ],

    ];

    public function __construct() {
        $this->currencies=new \currencies();
        $this->allowed_fields['customers_firstname']['label'] = TEXT_CUST_XLS_NAME . ' ' . TEXT_CUST_XLS_LASTNAME;
        parent::__construct();

    }

    public function query($request) {
        $main_query = $this->select();

        $filter = $this->filter($request);
        $order = $this->order($request);
        $limit = $this->limit($request);

        if (empty($filter))  {
            $request['count'] = $this->getResult('select count(*) as total from customers')[0]['total'];
        }

        $connector = ' WHERE ';
        $filter = $filter ? $connector . $filter : '';
        if (strpos($main_query, 'group by')) {
            $main_query = substr_replace($main_query, $filter . ' ', strpos($main_query, 'group by'), 0);
        } else {
            $main_query = $filter ? $main_query . $filter : $main_query;
        }

        $recordsTotal = $request['count'] ?: $this->getResult($main_query, true);
        $this->paginate($recordsTotal, $request['page'], $request['perPage']);

        $this->modal($request);
        $main_query = $main_query . ' ' . $order . ' ' . $limit;

        $this->data['data'] = $this->getResult($main_query);
        $this->debug($main_query, __METHOD__, 'pre');
        $this->debug($this->data['data'], 'DATA');
        $this->debug($this->data['allowed_fields'], 'allowed_fields');
        $this->debug($recordsTotal, 'recordsTotal', 'pre');

        global $login_email_address;
        if ($login_email_address == 'admin@solomono.net' && is_array($this->data['sql'])) {
            $this->data['sql'][] = preg_replace(['/\r\n|\r|\n/u', '!\s+!'], ['', ' '], $main_query);
        }
        $this->data['data'] = array_map(function($arr){$arr['customers_firstname'] = $arr['customers_firstname'].' '.$arr['customers_lastname'];return $arr;},$this->data['data']);
        $this->basketSum();
        $this->changeFieldsFormat();
    }

    public function select() {
        if(file_exists(DIR_FS_EXT . 'customers_groups/customers_groups.php')) {
            $sql = "select c.customers_id as id, 
                    c.customers_id,
                    c.customers_lastname, 
                    c.customers_firstname, 
                    c.customers_status as status, 
                    c.customers_groups_id,
                    cg.customers_groups_name,
                    cg.color_bar as `background-color`,
                    `c`.`customers_email_address`,
                    `a`.`entry_street_address`,
                    ci.customers_info_date_account_created, 
                    CONCAT( `c`.`customers_telephone`) as phones,
                    a.entry_city, 
            (SELECT SUM(ot.value) FROM " . TABLE_ORDERS_TOTAL . " ot
            left join " . TABLE_ORDERS . " o on o.orders_id = ot.orders_id and ot.class='ot_total'
            WHERE o.customers_id = c.customers_id) as customers_info_ordersum_value,
            a.entry_country_id 
            from " . TABLE_CUSTOMERS . " c 
            left join " . TABLE_ADDRESS_BOOK . " a on c.customers_id = a.customers_id and c.customers_default_address_id = a.address_book_id 
            left join " . TABLE_CUSTOMERS_INFO . " ci on c.customers_id = ci.customers_info_id 
            left join " . TABLE_CUSTOMERS_GROUPS . " cg on c.customers_groups_id = cg.customers_groups_id 
            ";
        }
        else{
            $sql = "select c.customers_id as id, 
                    c.customers_id,
                    c.customers_lastname, 
                    c.customers_firstname, 
                    c.customers_status as status, 
                    `c`.`customers_email_address`,
                    `a`.`entry_street_address`,
                    ci.customers_info_date_account_created, 
                    CONCAT( `c`.`customers_telephone`) as phones,
                    a.entry_city, 
                    sum(ot.value) as customers_info_ordersum_value, 
                    a.entry_country_id 
                    from " . TABLE_CUSTOMERS . " c 
                    left join " . TABLE_ADDRESS_BOOK . " a on c.customers_id = a.customers_id and c.customers_default_address_id = a.address_book_id 
                    left join " . TABLE_CUSTOMERS_INFO . " ci on c.customers_id = ci.customers_info_id 
                    left join " . TABLE_ORDERS . " o on c.customers_id = o.customers_id 
                    left join " . TABLE_ORDERS_TOTAL . " ot on o.orders_id = ot.orders_id and ot.class='ot_total' 
                    group by c.customers_id, c.customers_firstname
                    ";
        }
        return $sql;
    }

    private function changeFieldsFormat($date=true, $money=true) {
        foreach ($this->data['data'] as $k=>&$v) {
            if ($date)
                $this->changeFormatDate($v);
            if ($money)
                $this->changeFormatMoney($v);
        }
    }


    private function changeFormatDate(&$v) {
        $v['customers_info_date_account_created']=is_null($v['customers_info_date_account_created']) ? '--' : date('Y-m-d', strtotime($v['customers_info_date_account_created']));
    }

    private function changeFormatMoney(&$v) {
        $v['customers_info_ordersum_value']=$this->currencies->format($v['customers_info_ordersum_value']);
        $v['customers_basket_sum']=$v['customers_basket_sum'] ? $this->currencies->format($v['customers_basket_sum']) : '-';
    }

    private function basketSum(array $ids_customers=[]) {
        if (!empty($ar)) {
        $index_cid=array_column($this->data['data'], $this->prefix_id);
        $ids=implode(',', $index_cid);
        $sql="SELECT
                  `cb`.`customers_id`,
                 GROUP_CONCAT(SUBSTRING_INDEX(`cb`.`products_id`,'{',1)) as p_id
            FROM `customers_basket` `cb`
            WHERE `cb`.`customers_id` IN ($ids)
            GROUP BY `cb`.`customers_id`";

        $ar=$this->getResultKey($sql, $this->prefix_id);
        }
        if (!empty($ar)) {
            foreach ($ar as $cid=>$item) {
                $sql="SELECT sum(`p`.`products_price`) as sum FROM `products` `p`
                        WHERE `p`.`products_id` IN ({$item['p_id']})";
                $key=array_search($cid, $index_cid);
                $this->data['data'][$key]['customers_basket_sum']=$this->getResultArr($sql)[0];
            }
        }
    }

    private function showCredit($request) {
        $sql='';
        if ($request['showcredit']=='yes') {
            $sql="ci.customers_info_credit_value != '0'";
        }
        return $sql;
    }

    protected function filter($request) {
        if (!empty($request['search']['customers_id'])) {
            $request['search']['c.customers_id']=$request['search']['customers_id'];
            unset($request['search']['customers_id']);
        }
        if (!empty($request['search']['customers_email_address'])) {
            $request['search']['c.customers_email_address']=$request['search']['customers_email_address'];
            unset($request['search']['customers_email_address']);
        }
        $columnSearch=[];
        if (isset($request['search']) && count($request['search'])) {
            if ($request['search']['customers_firstname']){
                $columnSearch[]="(customers_firstname LIKE '%" . $request['search']['customers_firstname'] . "%' or customers_lastname" . " LIKE '%" . $request['search']['customers_firstname'] . "%')";
                unset($request['search']['customers_firstname']);
            }
            foreach ($request['search'] as $field=>$search) {
                if (!empty($search)) {
                    if ($field=='phones') {
                        $phone=str_replace(array(' ','-','(',')'), "", $request['search']['phones']);
                        $replacer="replace(replace(replace(replace(`c`.`%s`,' ',''),'-',''),'(',''),')','')";
                        $entry_phone=sprintf($replacer,'customers_telephone');
                        $entry_fax=sprintf($replacer,'customers_fax');
                        $columnSearch[]="({$entry_phone} LIKE '%{$phone}%')";
//                        $columnSearch[]="({$entry_phone} LIKE '%{$phone}%' OR {$entry_fax} LIKE '%{$phone}%')";
                        //$columnSearch[]="(`ad`.`entry_phone` LIKE '%{$phone}%' OR `ad`.`entry_fax` LIKE '%{$phone}%')";
                    }else {
                        if ($field === 'customers_groups_id') {
                            $columnSearch[] = 'c.' . $field . " LIKE '%" . $search . "%'";
                        } else {
                            $columnSearch[]=$field . " LIKE '%" . $search . "%'";
                        }

                    }
                }
            }
            $columnSearch=$columnSearch ? implode(' AND ', $columnSearch) : '';
        }

        $show_credit=$this->showCredit($request);

        if ($show_credit) {
            $result=$columnSearch ? $columnSearch . ' AND ' . $show_credit : $show_credit;
        }else {
            $result=$columnSearch ? $columnSearch : '';
        }

        return $result;
    }

    protected function order($request) {
        if (empty($request['order'])) {
            $request['order']='id-desc';
        }
        return parent::order($request);
    }

    public function getAddressBookCustomers($id_customer, $id_book) {
        return new address_book($id_customer, $id_book);
    }

    public function delete($id) {
        /*        $this->error[]=sprintf(CUSTOMERS_ERROR_DEL_FROM_TABLE,TABLE_ADDRESS_BOOK,$id);
                $this->error[]=sprintf(CUSTOMERS_ERROR_DEL_FROM_TABLE,TABLE_CUSTOMERS,TABLE_ADDRESS_BOOK,$id);
                $this->error[]=sprintf(CUSTOMERS_ERROR_DEL_FROM_TABLE,TABLE_CUSTOMERS_INFO,TABLE_ADDRESS_BOOK,$id);*/

        if (!tep_db_query("delete from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$id . "'"))
            $this->error[]=sprintf(CUSTOMERS_ERROR_DEL_FROM_TABLE, TABLE_ADDRESS_BOOK, $id);
        if (!tep_db_query("delete from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$id . "'"))
            $this->error[]=sprintf(CUSTOMERS_ERROR_DEL_FROM_TABLE, TABLE_CUSTOMERS, $id);
        if (!tep_db_query("delete from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$id . "'"))
            $this->error[]=sprintf(CUSTOMERS_ERROR_DEL_FROM_TABLE, TABLE_CUSTOMERS_INFO, $id);
        if (!tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$id . "'"))
            $this->error[]=sprintf(CUSTOMERS_ERROR_DEL_FROM_TABLE, TABLE_CUSTOMERS_BASKET, $id);
        if (!tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$id . "'"))
            $this->error[]=sprintf(CUSTOMERS_ERROR_DEL_FROM_TABLE, TABLE_CUSTOMERS_BASKET_ATTRIBUTES, $id);
        if (!tep_db_query("delete from " . TABLE_WHOS_ONLINE . " where customer_id = '" . (int)$id . "'"))
            $this->error[]=sprintf(CUSTOMERS_ERROR_DEL_FROM_TABLE, TABLE_WHOS_ONLINE, $id);
    }

}