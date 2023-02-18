<?php

final class Smsfly extends SmsGate {
    private $lastactionstatus = true;

    public function apiquery (array $params) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, 'https://sms-fly.ua/api/v2/api.php');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, JSON_UNESCAPED_UNICODE));
        $result = ($this->lastactionstatus) ? curl_exec($ch) : null;
        curl_close($ch);

        if ( !empty($result) ) {
            $response = json_decode($result, true);
            $falseStatuses = ['FORBIDDEN', 'INSUFFICIENTFUNDS'];
            $this->lastactionstatus = !(isset($response['error']['code']) && in_array($response['error']['code'], $falseStatuses));
            return $response;
        }
        return false;
    }

    public function send() {
        $phone = $this->to;
        $text = $this->message;
        $sourceSMS = empty($this->from) ? $this->from : '';
        if (empty($sourceSMS)) {
            self::craftError('INVSOURCE', 'не указан или не верный отправитель');
        }

        $recipient      = self::checkPhone($phone);
        if ( !$recipient ) {
            self::craftError('INVROUTE', $phone);
        }
        $text           = htmlspecialchars($text);

        $params = [
            "action" => "SENDMESSAGE",
            "data" => [
                "recipient" => $recipient,
                "channels" => ["sms"],
                "sms" => [
                    "source" => $sourceSMS,
                    "text" => $text
                ]
            ]
        ];

        $params['auth'] = [
            'key' => $this->username,
            'appversion' => 'Solomono',
            //'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ];

        return $this->apiquery($params);
    }

    public function translit($text) {
        $text_arr = $arChar = preg_split('/(?<!^)(?!$)/u', $text);
        $abc =  Array(
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'jo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'jj',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'kh',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'shh',
            'ъ' => '"',
            'ы' => 'y',
            'ь' => "'",
            'э' => 'eh',
            'ю' => 'ju',
            'я' => 'ja',
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'Jo',
            'Ж' => 'Zh',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'Jj',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'Kh',
            'Ц' => 'C',
            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Shh',
            'Ъ' => '""',
            'Ы' => 'Y',
            'Ь' => "''",
            'Э' => 'Eh',
            'Ю' => 'Ju',
            'Я' => 'Ja',
            'Є' => 'E',
            'є' => 'e',
            'і' => 'i',
            'І' => 'I',
            'ї' => 'i',
            'Ї' => 'I',
            '№' => '#'
        );
        $i = 0; $lat = '';

        while (isset($text_arr[$i])) {
            $lat .= isset($abc[$text_arr[$i]]) ? $abc[$text_arr[$i]] : $text_arr[$i];
            $i++;
        }

        return $lat;
    }

    public function checkPhone ($number) {
        $valid_operators = [
            "039" => "kstar",
            "050" => "mts",
            "063" => "life",
            "066" => "mts",
            "067" => "kstar",
            "068" => "kstar",
            "073" => "life",
            "091" => "utel",
            "092" => "peoplenet",
            "093" => "life",
            "094" => "intertelecom",
            "095" => "mts",
            "096" => "kstar",
            "097" => "kstar",
            "098" => "kstar",
            "099" => "mts",
        ];

        preg_match_all("/([0-9]+)/", $number, $matches);
        $number = implode("", $matches[1]);
        $number = str_pad($number, 12, "0", STR_PAD_LEFT);
        $phone = substr($number, -7);
        $operator = substr($number, -10, 3);
        if(!isset($valid_operators[$operator]) || 7 != strlen($phone)) return false;
        return '38'.$operator.$phone;
    }

    public function craftError($statusCode = '', $statusCodeDescription = '') {
        $answer = [];
        $answer['success'] = 0;
        $answer['error'] = array();
        $answer['error']['code'] = $statusCode;
        $answer['error']['date'] = date("Y-m-d H:i:s");
        $answer['error']['description'] = $statusCodeDescription;
        \App\Logger\Log::error('(SMSfly)', $answer);
    }

}