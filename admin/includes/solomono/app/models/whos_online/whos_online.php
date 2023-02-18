<?php

/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */


namespace admin\includes\solomono\app\models\whos_online;
use admin\includes\solomono\app\core\Model;
use admin\includes\solomono\app\core\View;


class whos_online extends Model {
    protected $allowed_fields = [
        'online' => [
            'label' => TABLE_HEADING_ONLINE,
            'type'=>'text'
        ],

        'customer_id' => [
            'label' => TABLE_HEADING_CUSTOMER_ID,
            'type'=>'text'
        ],

        'full_name' => [
            'label' => TABLE_HEADING_FULL_NAME,
            'type'=>'text'
        ],

        'ip_address' => [
            'label' => TABLE_HEADING_IP_ADDRESS,
            'type'=>'text'
        ],

        'time_entry' => [
            'label' => TABLE_HEADING_ENTRY_TIME,
            'type'=>'text'
        ],

        'time_last_click' => [
            'label' => TABLE_HEADING_LAST_CLICK,
            'type'=>'text'
        ],

        'last_page_url' => [
            'label' => TABLE_HEADING_LAST_PAGE_URL,
            'type'=>'text'
        ],

    ];

    // public function console($data){
    //     echo '<script>console.log('.json_encode($data).')</script>';
    // }

    public $sessionIds = [];
    protected $prefix_id = 'customer_id';
    public function __construct() {
        parent::__construct();
        $xx_mins_ago = (time() - 900);
        tep_db_query("delete from " . TABLE_WHOS_ONLINE . " where time_last_click < '" . $xx_mins_ago . "'");
        // $this->table='manufacturers';
        // $this->folder='test';

    }
    public function select($id = false) {
        $sql = "SELECT
                {$this->prefix_id},
                full_name,
                session_id,
                ip_address,
                time_entry,
                time_last_click,
                last_page_url
                FROM
                {$this->table}";
        if ($id) {
            $sql .= " where {$this->prefix_id}={$id}";
        }

        return $sql;
    }

    public function getResult($sql, $count = false) {
        $result = array();

        if ($count) {
            $sql = "SELECT COUNT(1) as total FROM ($sql) t";
            $sql = tep_db_query($sql);
            $sql = tep_db_fetch_array($sql);
            return (int)$sql['total'];
        } else {
            $sql = tep_db_query($sql);
            while ($row = tep_db_fetch_array($sql)) {
                $this->sessionIds[] = $row['session_id'];
                $row['online'] = gmdate('H:i:s', (time() - $row['time_entry']));
                $row['time_entry'] = date('H:i:s',$row['time_entry']);
                $row['time_last_click'] = date('H:i:s',$row['time_last_click']);
                $result[] = $row;
            }

            return $result;
        }
    }


    public function query($request) {
        $main_query = $this->select();
        preg_match('/(\bwhere\b)/i', $main_query, $matches);//[0]=>where
        //        $id = $this->getById($request);
        //        if ($id !== '' ) {
        //            $add = $matches ? ' AND ' : " WHERE ";
        //            $main_query = $main_query . $add . "{$this->prefix_id} = {$id}";
        //            return $this->data['data'] = $this->getResult($main_query);
        //        }


        $request['page'] = 1;
        $request['perPage'] = 10000;
//        $request['perPage'] = 25;
        $filter = $this->filter($request);
        $order = $this->order($request);
        $limit = $this->limit($request);
        $connector = $matches ? ' AND ' : ' WHERE ';
        $filter = $filter?$connector.$filter:'';
        if (strpos($main_query, 'group by')) {
            $main_query = substr_replace($main_query,  $filter . ' ', strpos($main_query, 'group by'), 0);
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
    }
    
    protected function limit($request) {
        $limit = '';
        if (isset($request['page']) && $request['perPage']) {
            $start = ($request['page'] - 1) * $request['perPage'];
            $limit = "LIMIT " . intval($start) . ", " . intval($request['perPage']);
        }
        return $limit;
    }

    public function getSessionsId() {
        $query = tep_db_query("SELECT session_id FROM " . TABLE_WHOS_ONLINE);
        $output = [];
        while ($row = tep_db_fetch_array($query)) {
            $output[] = $row['session_id'];
        }
        return $output;
    }

}

// $online_list = new whos_online();
// echo '<script>console.log('.json_encode($online_list->query($_GET)).')</script>';