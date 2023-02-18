<?php

/**
 * Class manufacturers
 */
class manufacturers
{

    /**
     * @return string
     */
    public static function getManufacturers()
    {
        global $languages_id;
        $menu = '';
        $result = '';

        $sql = "SELECT manufacturers_id as id,manufacturers_name from manufacturers_info WHERE languages_id = $languages_id order by manufacturers_name";
        $sql = tep_db_query($sql);
        while ($row = tep_db_fetch_array($sql)) {
            $result[] = $row;
        }

        foreach ($result as $manufacturer) {
            $menu .= '<option value="' . $manufacturer['id'] . '">' . $manufacturer['manufacturers_name'] . '</option>';
        }
        return $menu;
    }
}
