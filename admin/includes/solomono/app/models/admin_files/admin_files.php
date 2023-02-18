<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 25.07.2017
 * Time: 13:03
 */

namespace admin\includes\solomono\app\models\admin_files;

use admin\includes\solomono\app\core\Model;

include_once(DIR_ROOT . '/' . DIR_WS_CLASSES . 'seo.class.php');

/**
 * Class articles
 * @package admin\includes\solomono\app\models\articles
 * (show===false) - not show in table
 * if (type==disabled) show in form like input disabled
 * if (general) show in form into left column && value is type
 * if (exist 'type') show in form else not show
 * if ('type' == textarea && ckeditor) show text in plugin
 * to set style,example:
 * #own_table.articles>thead>tr>th[data-table="sort_order"]
 */
class admin_files extends Model {

    protected $allowed_fields = [
        'admin_files_name' => [
            'label' => TEXT_INFO_HEADING_DEFAULT_BOXES,
            'filter' => true,
        ],
        'admin_files_select' => [
            'label' => TEXT_INFO_HEADING_DEFAULT_BOXES,
            'type' => 'select',
            'option' => [],
            'show' => false,
        ],
        'status' => [
            'label' => '',
            'thWidth' => '105'
        ],

    ];
    protected $prefix_id = 'admin_files_id';

    public function __construct() {
        $this->allowed_fields['status']['label'] = STATUS_BOX_INSTALL.'/'.STATUS_BOX_REMOVE;
        parent::__construct();
    }

    public function select() {
        $sql = "select admin_files_name,
                        admin_files_id AS id,
                        status
                from " . TABLE_ADMIN_FILES . " 
                where admin_files_is_boxes = '0' ";
        if (!empty($_GET['tPath'])) {
            $sql .= " AND admin_files_to_boxes = {$_GET['tPath']}";
        }
        return $sql;
    }

    public function getOptions()
    {
        return;
    }
    
    public function insertFiles($name, $box){
        $sql_data_array = array('admin_files_name' => tep_db_prepare_input($name),
            'admin_files_to_boxes' => tep_db_prepare_input($box));
        tep_db_perform(TABLE_ADMIN_FILES, $sql_data_array);
        $admin_files_id = tep_db_insert_id();
        return true;
    }
    
    public function getFiles(){
        
        $file_query = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where admin_files_is_boxes = '0' ");
        while ($fetch_files = tep_db_fetch_array($file_query)) {
            $files_array[$fetch_files['admin_files_name']] = $fetch_files['admin_files_name'];
        }
        
        $file_dir = array();
        $dir = dir(DIR_FS_ADMIN);

        while ($file = $dir->read()) {
            if ((substr("$file", -4) == '.php') && $file != FILENAME_DEFAULT && $file != FILENAME_LOGIN && $file != FILENAME_LOGOFF && $file != FILENAME_FORBIDEN && $file != FILENAME_PASSWORD_FORGOTTEN && $file != FILENAME_ADMIN_ACCOUNT && $file != 'invoice.php' && $file != 'packingslip.php') {
                $file_dir[] = $file;
            }
        }

        $result = $file_dir;
        if (sizeof($files_array) > 0) {
            $result = array_values (array_diff($file_dir, $files_array));
        }

        sort ($result);
        reset ($result);
        
        foreach($result as $key => $value) {
            $this->data['option']['admin_files_select'][$value] = $value;
            $this->allowed_fields['admin_files_select']['option'][$value] = $value;
        }
    }   
    
    public function deleteFiles($id) {

        if (!tep_db_query("DELETE FROM `admin_files` where `admin_files_id`={$id}")) {
            return false;
        };
        return true;
    }


    protected function order($request) {
        $request['order'] = $request['order'] ?: 'admin_files_name-asc';
        return parent::order($request);
    }

}