<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

namespace admin\includes\solomono\app\models\admin_members;

use admin\includes\solomono\app\core\Model;

class admin extends Model {

    protected $allowed_fields=[
        'admin_firstname'=>[
            'label'=>TABLE_HEADING_NAME,
            'type'=>'text'
        ],
        'admin_lastname'=>[
            'label'=>TABLE_HEADING_LASTNAME,
            'type'=>'text'
        ],
        'admin_email_address'=>[
            'label'=>TABLE_HEADING_EMAIL,
            'type'=>'email'
        ],
        'admin_groups_name'=>[
            'label'=>TABLE_HEADING_GROUPS,
            'type'=>'select',
            'option'=>[
                'table'=>'admin_groups',
                'id'=>'admin_groups_id',
                'title'=>'admin_groups_name'
            ],
        ],
        'admin_lognum'=>['label'=>TABLE_HEADING_LOGNUM],
        'admin_created'=>['label'=>TEXT_INFO_CREATED],
        'admin_modified'=>['label'=>TEXT_INFO_MODIFIED],
        'admin_logdate'=>['label'=>TEXT_INFO_LOGDATE]
    ];
    protected $prefix_id='admin_id';
    private $make_password;

    public function getMakePassword() {
        return $this->make_password;
    }

    public function select() {
        $sql="SELECT a.{$this->prefix_id} as id,a.admin_firstname,a.admin_lastname,a.admin_email_address,ag.admin_groups_name,a.admin_lognum,a.admin_created,a.admin_modified,a.admin_logdate,a.admin_groups_id
                from {$this->table} a
                left join admin_groups ag on ag.admin_groups_id=a.admin_groups_id 
                where a.admin_email_address<>'admin@solomono.net'";
        return $sql;
    }

    public function selectOne($id) {
        $sql="SELECT a.{$this->prefix_id} as id,a.admin_firstname,a.admin_lastname,a.admin_email_address,ag.admin_groups_name,a.admin_groups_id
                from {$this->table} a
                left join admin_groups ag on ag.admin_groups_id=a.admin_groups_id 
                WHERE {$this->prefix_id}='{$id}'";
        $this->data['data']=$this->getResult($sql)[0];
        $this->getOptions();
    }

    public function updatePassword($data){
        if(!empty($data['password']) && isset($data['id'])){
            if($data['password']==$data['password_confirm']){
                $pass=$data['password'];
                $this->data['password']=tep_encrypt_password($data['password']);
                $data['admin_password']=$this->data['password'];
                unset( $data['password'], $data['password_confirm']);
                if(parent::update($data)){
                    return $this->sendMail($data['id'],$pass);
                }
                return false;
            }else{
                $this->error=TEXT_ERROR_NOT_MATCH_PASS;
                return false;
            }
        }else{
            $this->error=TEXT_ERROR_EMPTY_PASS;
            return false;
        }
    }

    private function sendMail($id,$pass){
        $sql="SELECT admin_email_address,admin_firstname,admin_lastname from  {$this->table} WHERE {$this->prefix_id}='{$id}'";
        $result=$this->getResult($sql)[0];
        return tep_mail($result['admin_firstname'] . ' ' . $result['admin_lastname'], $result['admin_email_address'], ADMIN_EMAIL_SUBJECT_PASS_NEW, nl2br(sprintf(ADMIN_EMAIL_TEXT_CHANGE_PASS,$result['admin_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $result['admin_email_address'], $pass, STORE_OWNER)), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
    }

    public function update($data) {
        //$this->checkPassword($data);
        if ($this->checkEmail($data['admin_email_address'], $data['id'])) {
            $data['admin_modified']=date("Y-m-d H:i:s");
            $data['admin_groups_id']=$data['admin_groups_name'];
            unset($data['admin_groups_name']);
            return parent::update($data);
        }
        $this->error=TEXT_INFO_ERROR;
        return false;
    }

    public function insert($data) {
        if ($this->checkEmail($data['admin_email_address'])) {
            $this->make_password=$this->randomize();
            $password=tep_encrypt_password($this->make_password);
            if ($data['admin_groups_id']==1) {
                $data['admin_cat_access']="ALL";
            }else {
                $data['admin_cat_access']="";
            }
            $data['admin_created']=date("Y-m-d H:i:s");
            $data['admin_password']=$password;
            $data['admin_groups_id']=$data['admin_groups_name'];
            unset($data['admin_groups_name']);
            return parent::insert($data);
        }
        $this->error=TEXT_INFO_ERROR;
        return false;
    }

    private function checkEmail($email, $id=false) {
        $sql="SELECT admin_email_address from {$this->table} where `admin_email_address`='{$email}' ";
        if ($id) {
            $sql.=" and {$this->prefix_id} !=$id";
        }
        $check_email_query=tep_db_query($sql);
        if ($check_email_query->num_rows==0) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        if($this->checkCntAdmins()==1){
            $this->error=TEXT_ERROR_CNT_ADMIN;
            return false;
        }
        $this->deleteSession($id);
        return parent::delete($id);
    }

    private function deleteSession($id){
        $sql="SELECT admin_email_address
              FROM `{$this->table}`
              WHERE admin_id = ".(int)$id;
        $adminEmail = $this->getResult($sql)[0]['admin_email_address'];
        if(!empty($adminEmail)){
            $sql = "DELETE FROM sessions WHERE value LIKE '%$adminEmail%'";
            tep_db_query($sql);
        }
    }

    private function checkCntAdmins(){
        $sql="SELECT count(`admin_id`) AS `cnt`
              FROM `{$this->table}`
              WHERE `admin_email_address` <> 'admin@solomono.net'";
        return $this->getResult($sql)[0]['cnt'];
    }

    private function randomize() {
        $salt="abchefghjkmnpqrstuvwxyz0123456789";
        srand((double)microtime() * 1000000);
        $i=0;
        while ($i <= 7) {
            $num=rand() % 33;
            $tmp=substr($salt, $num, 1);
            $pass=$pass . $tmp;
            $i++;
        }
        return $pass;
    }
}