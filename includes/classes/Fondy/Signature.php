<?php

class Signature
{
    /**
     * @var
     */
    private static $password;
    /**
     * @var
     */
    private static $merchant;
    /**
     * Set merchant password
     * @param String $password
     */
    public static function password($password)
    {
        self::$password = $password;
    }
    /**
     * Set merchant id
     * @param String $merchant
     */
    public static function merchant($merchant)
    {
        self::$merchant = $merchant;
    }
    /**
     * Generate request params signature
     * @param array $params
     * @return string
     */
    public static function generate(array $params)
    {
        $params['merchant_id'] = self::$merchant;
        $params = array_filter($params, 'strlen');
        ksort($params);
        $params = array_values($params);
        array_unshift($params, self::$password);
        $params = join('|', $params);
        return(sha1($params));
    }
    /**
     * Sign params with signature
     * @param array $params
     * @return array
     */
    public static function sign(array $params)
    {
        if (array_key_exists('signature', $params)) {
            return $params;
        }
        $params['signature'] = self::generate($params);
        return $params;
    }
    /**
     * Clean array params
     * @param array $data
     * @return array
     */
    public static function clean(array $data)
    {
        if (array_key_exists('response_signature_string', $data)) {
            unset($data['response_signature_string']);
        }
        unset($data['signature']);
        return $data;
    }
    /**
     * Check response params signature
     * @param array $response
     * @return bool
     */
    public static function check(array $response)
    {
        if (!array_key_exists('signature', $response)) {
            return false;
        }
        $signature = $response['signature'];
        $response  = self::clean($response);
        return $signature == self::generate($response);
    }
}
