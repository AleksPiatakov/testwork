<?php

class Sms
{
    private $smsgate;

    public function __construct($gate, $options = array()) {
        if (!defined('DIR_SMSGATE')) {
            define('DIR_SMSGATE', DIR_WS_EXT . 'sms/smsgate/');
        }

        if (file_exists(DIR_SMSGATE . $gate . '.php')) {
            require_once(DIR_SMSGATE . $gate . '.php');
        } else {
            trigger_error('Error: Could not load smsgate file ' . $gate . '!');
            exit();
        }

        $this->smsgate = new $gate($options);
    }

    public function __get($key) {
        return $this->smsgate->{$key};
    }

    public function __set($key, $value) {
        $this->smsgate->{$key} = $value;
    }

    public function has($key) {
        return $this->smsgate->has($key);
    }

    public function send() {
        $this->smsgate->send();
    }
}

class SmsGate {

    private $data = array();

    public function __construct($options = array()) {
        if (is_array($options)) {
            $this->data = $options;
        }
    }

    public function __get($key) {
        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }

    public function __set($key, $value) {
        $this->data[$key] = $value;
    }

    public function has($key) {
        return isset($this->data[$key]);
    }

    public function send() {
    }
}