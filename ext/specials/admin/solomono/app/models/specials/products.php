<?php

use admin\includes\solomono\app\core\Model;

/**
 * Class products
 */
class products extends Model
{

    /**
     * @var array
     */
    protected $allowed_fields = [
        'products_model' => [
            'label' => TABLE_HEADING_MODEL,
            'sort' => true
        ],
        'products_name' => [
            'label' => TABLE_HEADING_NAME,
            'sort' => true
        ],
        'products_price' => [
            'label' => TABLE_HEADING_PRICE,
            'sort' => true
        ],
    ];
    protected $prefix_id = 'products_id';

    /**
     * @param bool $id
     * @param bool $in
     * @return string
     */
    public function select($id = false, $in = false)
    {
        $sql = "SELECT
                      p.products_id as id,
                      p.products_model,
                      p.products_price,
                      pd.products_name,
                      p.manufacturers_id,
                      p.products_parent_category,
                      ptc.categories_id,
                      cd.categories_name
                    FROM
                      products p
                      LEFT JOIN
                      products_description pd
                        ON pd.products_id = p.products_id
                      LEFT JOIN
                      products_to_categories ptc
                        ON ptc.products_id = p.products_id
                      LEFT JOIN
                      categories_description cd
                        ON cd.categories_id = ptc.categories_id";

        $sql .= $id ? " WHERE p.products_parent_category = {$id} " : '';
        $sql .= $in ? " OR ptc.categories_id IN ({$in}) " : '';
        return $sql;
    }
}
