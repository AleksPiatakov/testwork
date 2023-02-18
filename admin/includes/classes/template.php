<?php

class template
{
    private $template_id;

    public function __construct()
    {
        $this->template_id = $this->getID();
        $this->getAllOptions();
    }

    private function getID()
    {
        $template_id_select_query = tep_db_query("SELECT template_id FROM " . TABLE_TEMPLATE . "  WHERE template_name = '" . DEFAULT_TEMPLATE . "'");
        $template_id_select = tep_db_fetch_array($template_id_select_query);

        return $template_id_select['template_id'];
    }

    public function getOptions($option)
    {

        $sql = tep_db_query("SELECT * FROM  " . TABLE_INFOBOX_CONFIGURATION . " WHERE template_id = '" . tep_db_prepare_input($this->template_id) . "' AND infobox_define = '" . tep_db_prepare_input($option) . "' order by location");
        $result = [];
        while ($row = tep_db_fetch_array($sql)) {
            $result = unserialize($row['infobox_data']);
        }

        return $result['val'];
    }

    private function getAllOptions()
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

    public function checkConfig($group, $const)
    {
        if (isset($this->config[$group . '_modules'][$const])) {
            return $this->config[$group . '_modules'][$const];
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
}


