<?php

class geoPlugin
{

    /**
     * GeoPlugin api host
     * @var string
     */
    private $host = 'https://geo.solomono.net/?ip=';

    /**
     * IP address
     * @var string
     */
    public $ip = null;

    /**
     * City name
     * @var string|null
     */
    public $city = null;

    /**
     * Region name
     * @var string|null
     */
    public $region = null;

    /**
     * Region code
     * @var string|null
     */
    public $areaCode = null;

    /**
     * DMA code
     * @var string|null
     */
    public $dmaCode = null;

    /**
     * Country code
     * @var string|null
     */
    public $countryCode = null;

    /**
     * Country name
     * @var string|null
     */
    public $countryName = null;

    /**
     * Continent code
     * @var string|null
     */
    public $continentCode = null;

    /**
     * Latitude
     * @var string|null
     */
    public $latitude = null;

    /**
     * Longitude
     * @var string|null
     */
    public $longitude = null;

    /**
     * Currency code
     * @var string|null
     */
    public $currencyCode = null;
    /**
     * Language code
     * @var array|null
     */
    public $languages = null;

    /**
     * Currency symbol
     * @var string|null
     * @deprecated 1.0.0
     */
    public $currencySymbol = null;

    /**
     * Currency value
     * @var string|null
     * @deprecated 1.0.0
     */
    public $currencyConverter = null;

    /**
     * Get information about IP address
     * @param string|null $ip
     * @return void
     */
    public function locate($ip = null)
    {

        global $_SERVER;

        if (is_null($ip)) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $host = $this->host . $ip;

        $response = $this->fetch($host);

        $data = json_decode($response);

        //set the geoPlugin vars
        $this->ip = $ip;
        $this->city = $data->city->names->en;
        $this->region = $data->subdivisions[0]->names->en;
        $this->areaCode = $data->subdivisions[0]->iso_code;
        $this->countryCode = $data->country->iso_code;
        $this->countryName = $data->country->names->en;
        $this->continentCode = $data->continent->code;
        $this->latitude = $data->location->latitude;
        $this->longitude = $data->location->longitude;
        $this->currencyCode = $data->currencyCode;
        $this->languages = $data->languages;
    }

    /**
     * Fethc data from API
     * @param string $host
     * @return string|void
     */
    public function fetch($host)
    {

        if (function_exists('curl_init')) {
            //use cURL to fetch data
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $host);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
            curl_setopt($ch, CURLOPT_TIMEOUT, 10); // timeout in seconds
            $response = curl_exec($ch);
            curl_close($ch);
        } else {
            if (ini_get('allow_url_fopen')) {
                //fall back to fopen()
                $response = file_get_contents($host, 'r');
            } else {
                trigger_error('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ',
                    E_USER_ERROR);
                return;
            }
        }

        return $response;
    }
}
