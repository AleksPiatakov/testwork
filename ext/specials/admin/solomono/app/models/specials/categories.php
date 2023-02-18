<?php

use admin\includes\solomono\app\libs\dropDownMenu\menu;

/**
 * Class categories
 */
class categories
{

    /**
     * @return string
     */
    public function select()
    {
        $sql = "select c.categories_id as id,c.parent_id,cd.categories_name from categories c 
                left join categories_description cd on cd.categories_id=c.categories_id";
        return $sql;
    }

    /**
     * @param string $menu
     * @return mixed
     */
    public function getCategory($menu = 'select')
    {
        $category = new menu([
            'container' => $menu,
            'pk' => 'categories_id',
            'table' => 'category',
            'titleName' => 'categories_name',
            'query' => $this->select()
        ]);
        return $category->getMenu();
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getSubCategories($id)
    {
        global $cat_list;
        // $ids = tep_make_cat_list($id);
        $ids = $cat_list[$id];

        if (!is_null($ids)) {
            return $id . ',' . implode(',', $ids);
        }
        return $id;
    }
}
