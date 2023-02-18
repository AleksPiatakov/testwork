<?php
/**
 * Created by PhpStorm.
 * User: ILIYA
 * Date: 15.06.2017
 * Time: 12:52
 */

namespace admin\includes\solomono\app\core;


class View {

    /**
     * @layout - default header & footer
     */
    public $layout;
    public $view;
    private $object;

    public function __construct($view) {
        $this->view = $view;
    }

    public function setObject($object) {
        $this->object = $object;
    }

    public function getObject() {
        return $this->object;
    }

    public function render(array $data, $action) {
        $file_view = DIR_FS_DOCUMENT_ROOT . VIEW_PATH . $this->view . '.php';
        ob_start();
        if (file_exists($file_view)) {
            require $file_view;
        } else {
            require DIR_FS_DOCUMENT_ROOT . VIEW_PATH . 'default.php';
            //            echo "<h6>View <b>$file_view</b> not found</h6>";
        }
        return $content = ob_get_clean();
    }

}