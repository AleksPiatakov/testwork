<?php

class CustomizationPanelModel
{

    private $templateId = 0;

    public function __construct()
    {
        $templateName   = CustomizationPanelRegistry::get('template_name');
        $templateQuery  = tep_db_query("SELECT template_id 
                                        FROM " . TABLE_TEMPLATE . " 
                                        WHERE template_name = '{$templateName}'");
        $templateRecord = tep_db_fetch_array($templateQuery);

        if (!empty($templateRecord['template_id'])) {
            $this->templateId = $templateRecord['template_id'];
        } else {
            throw new \Exception("Template doesn't exist!");
        }
    }

    public function changeColor($configurationCode, $colorCode)
    {
        $configurationCode = tep_db_input($configurationCode);
        $colorCode         = tep_db_input($colorCode);

        $infoboxData = \serialize([
            "type" => "color",
            "val" => $colorCode
        ]);

        switch (MINIFY_CSSJS) {
            case '2':
                tep_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = 1 WHERE configuration_key = 'MINIFY_CSSJS'");
                tep_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . time() . "' WHERE configuration_key = 'MINIFY_CSSJS_TIMESTAMP'");
                break;
        }
        $sql = "UPDATE " . TABLE_INFOBOX_CONFIGURATION . " 
                SET infobox_data = '{$infoboxData}'
                WHERE template_id = '{$this->templateId}'
                  AND infobox_define = '{$configurationCode}'";

        return tep_db_query($sql);
    }
}
