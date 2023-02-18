<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 02.08.2017
 * Time: 17:11
 */
namespace admin\includes\solomono\app\libs\dropDownMenu;


class menu {

    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tpl = '_ul';
    protected $container = 'ul';
    protected $pk = 'id';
    protected $titleName = 'title';
    protected $table;
    protected $cache = 3600;
    protected $query;

    public function __construct($options = []) {
        $this->getOptions($options);
        $this->run();
    }

    public function getMenu() {
        return $this->menuHtml;
    }

    protected function getOptions($options) {
        foreach ($options as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
        $this->tpl = $this->container == 'ul' ? $this->tpl = '_ul' : $this->tpl = '_select';
    }

    protected function run() {
        $this->data = $this->query();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        //$this->output();
    }

    protected function output() {
        $html = "<{$this->container} id='{$this->table}'>";
        $html .= $this->menuHtml;
        $html .= "</{$this->container}>";
        return $html;
    }

    protected function query() {
        $sql = $this->query;
        $sql = tep_db_query($sql);
        while ($row = mysqli_fetch_assoc($sql)) {
            $result[$row['id']] = $row;
        }
        return $result;
    }

    protected function getTree() {

        $tree = [];
        $key = [];
        $data = $this->data;
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }

        return $tree;
    }


    public function getParent($arr, $search_for) {

        static $result;
        foreach ($arr as $id => $v) {
            if ($id == $search_for) {
                $result[] = $v;
            } elseif (isset($v['childs'])) {
                $this->getParent($v['childs'], $search_for);
            }
        }
        return $result;
    }

    protected function getMenuHtml($tree, $tab = '') {
        $str = '';
        foreach ($tree as $id => $category) {
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab, $id) {
        ob_start();
        require $this->tpl . '.php';
        return ob_get_clean();
    }
}
