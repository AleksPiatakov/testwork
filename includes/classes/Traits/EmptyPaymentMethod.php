<?php

/**
 * Trait EmptyPayment
 */
trait EmptyPaymentMethod
{
    public $isBuy = true;
    public $link;
    public $code;
    public $title;
    public $description;
    public $enabled;
    public $_check = false;

    /**
     * @return false|string
     */
    public function getConfigurationLink()
    {
        return $this->link = tep_href_link('configuration.php', 'gID=277');
    }

    /**
     * @return bool
     */
    public function check()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function selection()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function before_process()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function pre_confirmation_check()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function confirmation()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function process_button()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function after_process()
    {
        return false;
    }

    /**
     * @return bool
     */
    public static function isEmptyPaymentMethod () {
        return true;
    }
}
