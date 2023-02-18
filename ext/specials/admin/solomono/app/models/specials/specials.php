<?php

/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 14.06.2017
 * Time: 15:22
 */

use admin\includes\solomono\app\core\Model;
use admin\includes\solomono\app\models\specials\categories;

/**
 * Class specials
 */
class specials extends Model
{

    /**
     * @var array
     */
    protected $allowed_fields = [
        'products_model' => [
            'label' => TABLE_HEADING_MODEL,
            'sort' => true,
            'filter' => true
        ],
        'products_name' => [
            'label' => TABLE_HEADING_NAME,
            'sort' => true,
            'filter' => true,
        ],
        'products_price' => [
            'label' => TABLE_HEADING_PRICE,
            'sort' => true
        ],
        'specials_new_products_price' => [
            'label' => TABLE_HEADING_PRICE_DISCOUNT,
            'sort' => true,
            'change' => true,
            'params' => 'disabled',
            'type' => 'text',
            'class' => 'price',
        ],
        'specials_new_products_percent' => [
            'label' => TABLE_HEADING_DISCOUNT_PERCENT,
            'sort' => true,
            'change' => true,
            'params' => 'disabled',
            'type' => 'text',
            'class' => 'price',
        ],
        'specials_date_added' => [
            'label' => TABLE_HEADING_DATE_ADD_DISCOUNT,
            'sort' => true
        ],
        'expires_date' => [
            'label' => TABLE_HEADING_EXPIRES_DATE,
            'sort' => true,
            'change' => true,
            'params' => 'disabled',
            'type' => 'text',
            'class' => 'date-picker',
        ],
        'status' => [
            'label' => TABLE_HEADING_STATUS,
        ],
        'apply_specials_to_attributes' => [
            'label' => TABLE_HEADING_ATTR,
            'type' => 'status',
        ],
    ];

    /**
     * @var string
     */
    protected $prefix_id = 'products_id';

    /**
     * @return string
     */
    public function select()
    {
        $specials = ($_GET['onlySpecials'] == 'yes') ? ' RIGHT ' : ' LEFT ';
        $sql = "SELECT distinct
                  `p`.`products_id` AS `id`,
                  `p`.`products_model`,
                  `pd`.`products_name`,
                  `p`.`products_price`,
                  `p`.`manufacturers_id`,
                  `p`.`products_parent_category`,
                  `s`.`specials_id` ,
                  `s`.`products_id`,
                  `s`.`apply_specials_to_attributes`,
                  `s`.`specials_new_products_price`,
                  `s`.`specials_new_products_percent`,
                  `s`.`specials_date_added`,
                  `s`.`specials_last_modified`,
                  `s`.`expires_date`,
                  `s`.`date_status_change`,
                  `s`.`status`
                FROM `products` `p`
                  LEFT JOIN `products_description` `pd` ON `pd`.`products_id` = `p`.`products_id`
                  LEFT JOIN `products_to_categories` `ptc` ON `ptc`.`products_id` = `p`.`products_id`
                  LEFT JOIN `categories_description` `cd` ON `cd`.`categories_id` = `ptc`.`categories_id`
                  {$specials} JOIN `specials` `s` ON `s`.`products_id` = `p`.`products_id`";

        return $this->checkGet($sql);
    }

    /**
     * @param string $sql
     * @return mixed
     */
    private function getArrKeyTest($sql)
    {
        $sql = tep_db_query($sql);
        while ($row = tep_db_fetch_array($sql)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }

    /**
     * @param string $sql
     * @return string
     */
    private function checkGet($sql)
    {
        $categoryIn = '';
        if (!empty($_GET['categoryId']) && $_GET['categoryId'] != 'all') {
            $subCat = categories::getSubCategories($_GET['categoryId']);
            $categoryIn = " `ptc`.`categories_id` IN ({$subCat})";
        }

        $manufacturersId = (!empty($_GET['manufacturersId']) && $_GET['manufacturersId'] != 'all') ? " `p`.`manufacturers_id` = {$_GET['manufacturersId']}" : '';

        $sql = $categoryIn ? $sql . " WHERE " . $categoryIn : $sql;

        if ($categoryIn) {
            $sql = $manufacturersId ? $sql . ' AND ' . $manufacturersId : $sql;
        } else {
            $sql = $manufacturersId ? $sql . ' WHERE ' . $manufacturersId : $sql;
        }

        return $sql;
    }

    /**
     * @return bool
     */
    public function insertUpdate()
    {
        $value = [];
        $updates = [];
        foreach ($_POST as $field_name => $v) {
            $value[] = $v;
            $updates[] = "`$field_name` = '$v'";
        }
        $fieldsInsert = "`" . implode("`, `", array_keys($_POST)) . "` ";
        $prepare_value = "'" . implode("', '", $value) . "'";
        $implodeArray = implode(', ', $updates);

        $sql = "INSERT INTO specials ({$fieldsInsert},`specials_date_added`) VALUES ({$prepare_value},now())
            ON DUPLICATE KEY UPDATE {$implodeArray},specials_last_modified=now()";

        if (!tep_db_query($sql)) {
            return false;
        }
        return true;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update($data)
    {
        $id = $data['id'];
        if (!tep_db_query($data = $this->prepareFields($data))) {
            $this->error = TEXT_ERROR_UPDATE . $data;
            return false;
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function specialsTest()
    {
        $sql = "SELECT
                  `s`.`specials_id` as id,
                  `s`.`products_id`,
                  `s`.`apply_specials_to_attributes`,
                  `s`.`specials_new_products_price`,
                  `s`.`specials_new_products_percent`,
                  `s`.`specials_date_added`,
                  `s`.`specials_last_modified`,
                  `s`.`expires_date`,
                  `s`.`date_status_change`,
                  `s`.`status`
                FROM `specials` `s`";

        return $this->getArrKeyTest($sql);
    }

    //    public function query($request) {
    //        parent::query($request);
    //        $all_products=$this->data['data'];
    //        $specials=$this->specials();
    //        $this->compare($all_products,$specials);
    //    }

    /**
     * @param array $products
     * @param array $specials
     */
    private function compareTest($products = [], $specials = [])
    {
        foreach ($products as $k => $v) {
            if (isset($specials[$v['id']])) {
                $products[$k] = array_merge($products[$k], $specials[$v['id']]);
            }
        }
        echo "<pre>";
        print_r($products);
        print_r($specials);
        echo "</pre>";
    }
}
