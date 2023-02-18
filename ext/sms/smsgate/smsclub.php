<?php

final class SmsClub extends SmsGate {

    public function send() {

        if ($this->username && $this->password) {
            $credentials = Array(
                'username' => $this->username,
                'token'    => $this->password,
            );

            $balance = $this->sendSms("https://gate.smsclub.mobi/token/getbalance.php?" . http_build_query($credentials));

            $balance_result = preg_replace("/[^,.0-9]/", '', $balance);

            if ($balance_result) {

                if ($this->to) {
                    $numbers = $this->prepPhone($this->to);
                } else {
                    \App\Logger\Log::error('(Smsclub) Error: Phone destination not found!');
                    $numbers = false;
                }

                if ($this->copy) {
                    $copyes = explode(',', $this->copy);

                    $phones = array();

                    foreach ($copyes as $phone) {
                        $phones[] = $this->prepPhone($phone);
                    }

                    $phones = implode(',', $phones);

                    $numbers = $this->prepPhone($this->to) . ',' . $phones;
                }

                if ($this->from) {
                    $sender = $this->from;
                } else {
                    $sender = '';
                    \App\Logger\Log::channel('all')->info('(Smsclub) Notice: Default Sender set! Please input real Sender');
                }

                $message = iconv('UTF-8', 'Windows-1251', $this->message);

                if ($numbers) {
                    $sms = Array(
                        'username' => $this->username,
                        'token'    => $this->password,
                        'from'     => $sender,
                        'to'       => $numbers,
                        'text'     => $message
                    );

                    $this->sendSms("https://gate.smsclub.mobi/token/?" . http_build_query($sms));

                    $this->sendSms("https://gate.smsclub.mobi/token/getbalance.php?" . http_build_query($credentials));

                    return true;
                }
            } else {
                \App\Logger\Log::error('(Smsclub) Error: Smsclub Authentication failed!');
            }
        } else {
            \App\Logger\Log::error('(Smsclub) Error: Please enter valid api_id in login(username) field!');
        }
    }

    public function resultStr($str) {
        $result = str_replace('<br/>', ' / ', $str);

        return $result;
    }

    public function prepPhone($phone) {
        $result = preg_replace('/[^0-9,]/', '', $phone);

        return $result;
    }

    public function sendSms($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}