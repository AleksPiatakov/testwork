<?php

class CustomizationPanelController
{
    private $model;

    public function __construct()
    {
        $this->model = new CustomizationPanelModel();
    }

    public function changeColor()
    {
        $configurationCode = $_POST['configurationCode'];
        $colorCode         = $_POST['colorCode'];
        if ($this->model->changeColor($configurationCode, $colorCode)) {
            echo json_encode([
                "status"  => true,
                "message" => "Success!"
            ]);
        } else {
            echo json_encode([
                "status"  => false,
                "message" => "Color wasn't changed!"
            ]);
        }
    }
}
