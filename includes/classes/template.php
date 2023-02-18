<?php

/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 20.09.2017
 * Time: 11:40
 */
class template
{

    public $settings = array();
    public $define2column = array();
    public $config;
    /**
     * default Template
     */
    private $template_id = TEMPLATE_NAME;

    public function __construct()
    {
        $this->getOptions();
       // $this->config=$this->getConfigArr();
    }

    /**
     * @return string
     */
    public function getConfigPath()
    {
        return DIR_FS_CATALOG . DIR_WS_TEMPLATES . DEFAULT_TEMPLATE . '/boxes/configuration.php';
    }

    public function getConfigArr($path = null)
    {
       /* $path=!is_null($path)?$path:$this->getConfigPath();
        if (file_exists($path)) {
           return require($path);
        }
        return false;   */
    }


    /**
     * create dynamic property from table "TABLE_TEMPLATE" and
     * setting -array group by TABLE_INFOBOX_CONFIGURATION.display in column.infobox_define
     * example:
     * setting[FOOTER=>[
     *            F_FOOTER_CATEGORIES=>[TABLE_COLUMN=>KEY],
     *            F_FOOTER_CATEGORIES_MENU=>[TABLE_COLUMN=>KEY],
     *              ]
     *         MAINPAGE=>[
     *            M_NEW_PRODUCTS=>[TABLE_COLUMN=>KEY],
     *            M_FEATURED=>[TABLE_COLUMN=>KEY],
     *              ]
     *        ]
     */
    private function getOptions()
    {
        $sql_result = tep_db_query("SELECT * FROM " . TABLE_TEMPLATE . " WHERE template_name = '" . tep_db_prepare_input($this->template_id) . "'");
        $result = tep_db_fetch_array($sql_result);

        if (is_array($result)) {
            foreach ($result as $k => $v) {
                $this->$k = $v;
            }
        }

        $sql = tep_db_query("SELECT * FROM  " . TABLE_INFOBOX_CONFIGURATION . " WHERE template_id = '" . tep_db_prepare_input($this->template_id) . "' order by location");
        while ($row = tep_db_fetch_array($sql)) {
                $this->settings[$row['display_in_column']][$row['infobox_define']] = $row;
                $this->define2column[$row['infobox_define']] = $row['display_in_column'];
                $this->config[$row['display_in_column'] . '_modules'][$row['infobox_define']] = unserialize($row['infobox_data']);
        }
    }

    /**
     * @param $group -value "display_in_column"
     * @param $const -key "infobox_define"
     * @return bool
     */
    public function checkModules($group, $const)
    {
        $group = strtoupper($group);
        $const = strtoupper($const);
        return $this->settings[$group][$const]['infobox_display'];
    }

    private function checkBlocks($const)
    {

        if ($this->settings['GENERAL'][$const]['infobox_display']) {
            return true;
        }
        return false;
    }

    /**
     * @param $group $group -value "display_in_column"
     * @param $const $const -key "infobox_define"
     * @return bool|string file
     */

    /**
     * @param $group $group -value "display_in_column"
     * @param $const $const -key "infobox_define"
     * @return bool|string file
     * @param $config
     * @return bool|string
     */
    public function getFiles($group, $const, &$config = false)
    {
        $config = $this->checkConfig($group, $const);
        if ($this->checkModules($group, $const) && !empty($this->settings[$group][$const]['infobox_file_name'])) {
            return $this->moduleFolder($group, $this->settings[$group][$const]['infobox_file_name']);
        }
        return false;
    }

    public function requireBox($const, &$config = false)
    {
        $file = $this->getFiles($this->define2column[$const], $const, $config);
        if (file_exists($file)) {
            return $file;
        } else {
            return 'ajax.php'; // ajax.php - some ANY file which executing nothing.
        }
    }

    public function checkConfig($group, $const)
    {
        if (isset($this->config[$group . '_modules'][$const])) {
            return $this->config[$group . '_modules'][$const];
        }
        return false;
    }

    /**
     * Return setting for module
     *
     * @param $group
     * @param $const
     * @param $setting
     * @return bool
     */
    public function getModuleSetting($group, $const, $setting)
    {
        if (isset($this->config[$group . '_modules'][$const][$setting]['val'])) {
            return $this->config[$group . '_modules'][$const][$setting]['val'];
        }
        return false;
    }

    public function getMainconf($const)
    {
        if (isset($this->config['MAINCONF_modules'][$const])) {
            return $this->config['MAINCONF_modules'][$const]['val'];
        }
        return false;
    }
    public function getCheckboxVal($module, $const)
    {
        if (isset($this->config[$module][$const])) {
            return $this->config[$module][$const]['val'];
        }
        return false;
    }

    public function show($const, $val = false)
    {
        if (!empty($this->config[$this->define2column[$const] . '_modules'][$const]['val'])) {
            if ($val != false) {
                return $val;
            } else {
                return $this->config[$this->define2column[$const] . '_modules'][$const]['val'];
            }
        } elseif ($this->settings[$this->define2column[$const]][$const]['infobox_display'] != 0) {
            return true;
        } else {
            return '';
        }
    }


    /**
     * @param $group  - value "display_in_column"
     * @param $file - file name
     * @return string -  full path to file "infobox_file_name"
     */

    private function moduleFolder($group, $file)
    {
        $arr = [
            'HEADER' => '/boxes/header/',
            'LEFT' => '/boxes/left/',
            'MAINPAGE' => '/boxes/mainpage_modules/',
            'OTHER' => '/boxes/other/',
            'LISTING' => '/boxes/listing/',
            'FOOTER' => '/boxes/footer/',
        ];
        return DIR_WS_TEMPLATES . TEMPLATE_NAME . $arr[$group] . $file;
    }
}
