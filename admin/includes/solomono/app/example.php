<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\admin_members;

use admin\includes\solomono\app\core\Model;


/**
 * Class test
 *
 * @package admin\includes\solomono\app\models\
 *
 * label => label && placeholder,
 * sort => if isset(sort and sort===true) - show arrow for sorting in table thead
 * filter => if isset(filter and filter===true) - create input in table thead for searching by field
 * show => if isset(show and show===false) - not show in table
 * hideInForm =>if isset(hideInForm and show===true) - not show in form
 * placeholder =>if isset(placeholder) -  show in form input
 * change =>if (change==true) -  create in table tbody <span><input> example order_status
 * type =>
 *      for input type(text,email,number,data,etc),
 *      if (type==disabled) show in form like input disabled
 *      if (exist 'type') show in form else not show
 *      if ('type' == textarea && ckeditor) show text in plugin
 *         'rows' => option for textarea(if type textarea and has rows else 6)
 *      if ('type' == select) must have option,example^
 *          'option' => [
 *                   'table' => 'admin_groups',
 *                   'id' => 'admin_groups_id',
 *                   'title' => 'admin_groups_name']
 *
 *  'dynamic'=>[
 *           'label'=>'<input type="checkbox">',
 *           'type'=>'checkbox'
 *  ]  => show in table thead label and create in tbody <input type="type">
 * 'form_option'=>'some value' example:
 *          'some value' -disabled required
 *          <input class='c1' 'some value' ....>
 *  'type_class'=> add class to input
 * if (general) show in form into left column && value is type
 * if (exist 'type') show in form else not show
 *  *
 * to set style,example:
 * #own_table.articles>thead>tr>th[data-table="sort_order"]
 */
class test extends Model {

    protected $allowed_fields = [
        'admin_firstname' => [
            'label' => TABLE_HEADING_NAME,
            'show' =>false,
            'type' =>'disabled',
            'general' => 'number',
        ],
        'admin_lastname' => [
            'label' => TABLE_HEADING_LASTNAME,
            'type' => 'text',
            'form_option'=>'disabled'
        ],
        'admin_email_address' => [
            'label' => TABLE_HEADING_EMAIL,
            'type' => 'email'
        ],
        'admin_groups_name' => [
            'label' => TABLE_HEADING_GROUPS,
            'type' => 'select',
            'option' => [
                'table' => 'admin_groups',
                'id' => 'admin_groups_id',
                'title' => 'admin_groups_name'
            ],
        ],
        'articles_description' => [
            'label' => TEXT_ARTICLES_DESCRIPTION,
            'type' => 'textarea',
            'ckeditor'=>true,
            'rows' => 10,
            'show' => false,
        ],
        'admin_lognum' => ['label' => TABLE_HEADING_LOGNUM],
        'admin_created' => ['label' => TEXT_INFO_CREATED],
        'admin_modified' => ['label' => TEXT_INFO_MODIFIED],
        'admin_logdate' => ['label' => TEXT_INFO_LOGDATE]
    ];
    protected $prefix_id = 'admin_id';
    private $make_password;

    public function getMakePassword(){
        return $this->make_password;
    }

    public function select() {
        $sql = "SELECT a.{$this->prefix_id} as id,a.admin_firstname,a.admin_lastname,a.admin_email_address,ag.admin_groups_name,a.admin_lognum,a.admin_created,a.admin_modified,a.admin_logdate,a.admin_groups_id
                from {$this->table} a
                left join admin_groups ag on ag.admin_groups_id=a.admin_groups_id ";
        return $sql;
    }


    public function update($data) {
        if ($this->checkEmail($data['admin_email_address'], $data['id'])) {
            $data['admin_modified'] = date("Y-m-d H:i:s");
            return parent::update($data);
        }
        $this->error='Такой имейл существует';
        return false;
    }

    public function insert($data) {
        if ($this->checkEmail($data['admin_email_address'])) {
            $this->make_password = $this->randomize();
            $password = tep_encrypt_password($this->make_password);
            if ($data['admin_groups_id'] == 1) {
                $data['admin_cat_access'] = "ALL";
            } else {
                $data['admin_cat_access'] = "";
            }
            $data['admin_created'] = date("Y-m-d H:i:s");
            $data['admin_password'] = $password;
            return parent::insert($data);
        }
        $this->error='Такой имейл существует';
        return false;
    }

    private function checkEmail($email, $id = false) {
        $sql = "SELECT admin_email_address from {$this->table} where `admin_email_address`='{$email}' ";
        if ($id) {
            $sql .= " and {$this->prefix_id} !=$id";
        }
        $check_email_query = tep_db_query($sql);
        if ($check_email_query->num_rows == 0) {
            return true;
        }
        return false;
    }

    private function randomize() {
        $salt = "abchefghjkmnpqrstuvwxyz0123456789";
        srand((double)microtime() * 1000000);
        $i = 0;
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($salt, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }
}