<?php

namespace admin\includes\solomono\app\models\template_configuration;

use admin\includes\solomono\app\core\Model;


/**
 * Class template
 * @package admin\includes\solomono\app\models\template_configuration
 *  'class'=>'check_all'   - check all checkbox checked only one
 */
class template extends Model
{
    protected $allowed_fields = [
        'template_description' => [
            'label' => TABLE_HEADING_TEMPLATE,
        ],
        'template_name' => [
            'label' => TABLE_HEADING_TEMPLATE_FOLDER,
        ],
        'status' => [
            'label' => TABLE_HEADING_ACTIVE,
            'type' => 'status',
            'class' => 'check_all',
        ],

    ];
    private $template = DEFAULT_TEMPLATE;
    public $file_config;
    protected $prefix_id = 'template_id';
    protected $table = 'template';

    public function select($id = false)
    {
        $where = $id ? " WHERE `{$this->prefix_id}` = '{$id}' " : ' WHERE template_status = 1 ';
        $isRent = env('APP_ENV') == 'rent';
        if ($isRent) {
            $where .= "and rent_status = 1 ";
            if (getConstantValue('DEFAULT_TEMPLATE')) {
                $where .= "or template_name = '" . getConstantValue('DEFAULT_TEMPLATE') . "' ";
            }
        }
        $sql = "SELECT
                {$this->prefix_id} as id,
                `template_name`,
                `template_description`,
                CASE `template_name`
                WHEN '{$this->template}' THEN '1'
                ELSE '0'
                END as `status`
                FROM `template`
                {$where}";
        return $sql;
    }

    public function sliderOption()
    {
        return json_encode([
            'slider_width' => [
                0 => SLIDER_RIGHT,
                1 => SLIDER_CONTENT_WIDTH,
                2 => SLIDER_CONTENT_WIDTH_100
            ]
        ]);
    }

    public function selectOne($id)
    {
        $where = " WHERE `ic`.`template_id`= '" . $id . "' AND `ic`.`display_in_column`!='GENERAL' ";
        $sql = "SELECT
                  `ic`.`infobox_id` as id,
                  `ic`.`infobox_file_name`,
                  `ic`.`infobox_define`,
                  `ic`.`infobox_display`,
                  `ic`.`infobox_data`,
                  `ic`.`callback_data`,
                  `ic`.`display_in_column`,
                  `ic`.`location`
                FROM `infobox_configuration` `ic`
                " . $where . "
                ORDER  BY `ic`.`display_in_column`,  `ic`.`location`";

        $data = $this->getResultGroup($sql, 'display_in_column');
        $this->data['data'] = $this->ukSort($data);
//        $this->file_config=$this->getConfigPath($id);
//        $this->data['config'] = unserialize();
//        $this->data['config'] = $this->getConfigArr();
        $this->data['id'] = $id;
    }

    public function getArticles($arr, $key)
    {
        static $result = [];
        if (empty($result)) {
            $sql = "SELECT `articles_id`,`articles_name`
                FROM `articles_description`
                WHERE `language_id`='{$this->language_id}'";
            $sql = tep_db_query($sql);
            while ($options_values = tep_db_fetch_array($sql)) {
                $result[] = [
                    'id' => $options_values['articles_id'],
                    'text' => $options_values['articles_name']
                ];
            }
        }

        return tep_draw_pull_down_menu('', $result, $arr[$key]['val']);
    }

    public function getTopics($arr, $key)
    {
        static $result = [];
        if (empty($result)) {
            $sql = "SELECT `topics_id`,`topics_name`
                FROM `topics_description`
                WHERE `language_id`='{$this->language_id}'";
            $sql = tep_db_query($sql);
            while ($options_values = tep_db_fetch_array($sql)) {
                $result[] = [
                    'id' => $options_values['topics_id'],
                    'text' => $options_values['topics_name']
                ];
            }
        }

        return tep_draw_pull_down_menu('', $result, $arr[$key]['val']);
    }

    public function getWidth($arr, $key)
    {
        $templatesIdsWithoutLeftColumn = [24];//clo
        static $result = array(
            array('id' => 0, 'text' => SLIDER_RIGHT),
            array('id' => 1, 'text' => SLIDER_CONTENT_WIDTH),
            array('id' => 2, 'text' => SLIDER_CONTENT_WIDTH_100)
        );
        if (in_array($this->data['id'], $templatesIdsWithoutLeftColumn)) {
            unset($result[0]);
        }

        return tep_draw_pull_down_menu('', $result, $arr[$key]['val']);
    }

    // Return html select for settings field width content
    public function getWidthContent($arr, $key)
    {
        static $result = [
            ['id' => 0, 'text' => CONTENT_WIDTH_CONTENT],
            ['id' => 1, 'text' => CONTENT_WIDTH_FIX]
        ];

        return tep_draw_pull_down_menu('', $result, $arr[$key]['val']);
    }

    public function getCheckbox($arr, $key)
    {
        $val = $arr[$key]['val'];
        $checkbox = '<input class="cmn-toggle cmn-toggle-round" ' . ($val ? 'checked' : '') . ' type="checkbox" name="' . $key . '" id="cmn-toggle-' . $key . '">
            <label for="cmn-toggle-' . $key . '"></label>';
        return $checkbox;
    }

    public function getNumber($arr, $key)
    {
        $val = $arr[$key]['val'];
        $input = '<input class="form-control" type="number" value="' . $val . '">';
        return $input;
    }

    public function getConfigPath($id)
    {
        $template_name = $this->getResult($this->select($id))[0]['template_name'];
        return DIR_FS_TEMPLATES . $template_name . '/boxes/configuration.php';
    }

    public function getConfigArr($path = null)
    {
        $path = !is_null($path) ? $path : $this->file_config;
        if (file_exists($path)) {
            return require($path);
        }
        $this->error[] = "There is no {$path}.Please create.";
        return false;
    }

    private function ukSort(array &$data)
    {
        $result = [];
        $sorting = [
            'MAINCONF',
            'LEFT',
            'MAINPAGE',
            'HEADER',
            'FOOTER',
            'LISTING',
            'PRODUCT_INFO',
            'OTHER'
        ];

        foreach ($sorting as $v) {
            if (isset($data[$v])) {
                $result[$v] = $data[$v];
            }
        }
        return $result;
    }

    private function getResultGroup($sql, $id)
    {
        $result = [];
        $sql = tep_db_query($sql);
        while ($row = tep_db_fetch_array($sql)) {
            $result[$row[$id]][] = $row;
        }
        return $result;
    }

    public function updateDefault($id)
    {
        $sql = tep_db_query("SELECT `t`.`template_name` FROM `template` `t` WHERE  `t`.{$this->prefix_id} ='{$id}'");
        $template_name = tep_db_fetch_array($sql)['template_name'];
        $sql = ("UPDATE " . TABLE_CONFIGURATION . " SET `configuration_value`='{$template_name}' WHERE `configuration_key` = 'DEFAULT_TEMPLATE'");
        resetMinifiedFiles();
        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }

    public function update($data)
    {
        foreach ($data as $id => $loc) {
            if (!tep_db_query("UPDATE infobox_configuration SET `location` = '{$loc}' WHERE infobox_id={$id}")) {
                return false;
            }
        }
        return true;
    }

    public function changeBySelect($data)
    {
        $sql = "UPDATE {$this->table} set `{$data['name']}`='{$data['val']}' where `{$this->prefix_id}`='{$data['id']}'";
        return tep_db_query($sql);
    }

    public function getDisplayInColumn()
    {
        return [
            'MAINCONF',
            'LEFT',
            'MAINPAGE',
            'HEADER',
            'FOOTER',
            'LISTING',
            'PRODUCT_INFO',
            'OTHER',
        ];
    }

    public function copyTemplate($id, $name)
    {

        if (empty($name)) {
            $this->error = "Name field is <b>required</b><br/>";
            return false;
        }

        $checkTemplateExist = tep_db_query("SELECT template_name FROM template WHERE template_name = '{$name}'");
        if ($checkTemplateExist->num_rows) {
            $this->error = "Template '{$name}' already exist, check names in design controls page and use unique name<br/>";
            return false;
        }
        $from = tep_db_fetch_array(tep_db_query($this->select($id))); //get old template data

        if (disk_free_space('/') < $this->GetDirectorySize(DIR_FS_TEMPLATES . $from['template_name'])) {
            $this->error = "Not enough disk space<br/>";
            return false;
        }
        //insert new
        tep_db_query("INSERT INTO template (template_name,template_description,template_status) VALUES ('{$name}','{$name}',1)");
        $newId = tep_db_insert_id(); //get new id
        //copy infobox
        tep_db_query("INSERT INTO infobox_configuration (template_id,infobox_file_name,infobox_define,infobox_display,display_in_column,location,infobox_data) 
                      SELECT 
                      '{$newId}',infobox_file_name,infobox_define,infobox_display,display_in_column,location,infobox_data
                        FROM infobox_configuration                       
                        WHERE template_id = '{$id}'");
        //copy
        $this->copy_r(DIR_FS_TEMPLATES . $from['template_name'], DIR_FS_TEMPLATES . $name);
        return true;
    }

    public function copy_r($from, $to)
    {
        $dir = opendir($from);
        if (!file_exists($to)) {
            mkdir($to, 0775, true);
        }
        while (false !== ($file = readdir($dir))) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            if (is_dir($from . DIRECTORY_SEPARATOR . $file)) {
                $this->copy_r($from . DIRECTORY_SEPARATOR . $file, $to . DIRECTORY_SEPARATOR . $file);
            } else {
                copy($from . DIRECTORY_SEPARATOR . $file, $to . DIRECTORY_SEPARATOR . $file);
            }
        }
        closedir($dir);
    }

    public function GetDirectorySize($path)
    {
        $bytestotal = 0;
        $path = realpath($path);
        if ($path !== false && !empty($path) && file_exists($path)) {
            foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)) as $object) {
                $bytestotal += $object->getSize();
            }
        }
        return $bytestotal;
    }

    public function getCoupons($arr, $key)
    {
        static $result = [];
        if (empty($result)) {
            $sql = "SELECT `coupon_id`,`coupon_code`,`coupon_amount`
                FROM `coupons`
                WHERE `coupon_active`='Y' AND `coupon_expire_date` >= DATE(now())";
            $sql = tep_db_query($sql);
            while ($options_values = tep_db_fetch_array($sql)) {
                $result[] = [
                    'id' => $options_values['coupon_id'],
                    'text' => $options_values['coupon_code'] . ' - ' . cutToFirstSignificantDigit($options_values['coupon_amount']) . '%',
                ];
            }
        }

        return tep_draw_pull_down_menu('', $result, $arr[$key]['val']);
    }
}