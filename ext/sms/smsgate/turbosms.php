<?php
final class Turbosms extends SmsGate {

    public function send() {

        try {
            $client = new SoapClient('http://turbosms.in.ua/api/wsdl.html');

            $credentials = Array(
                'login'    => $this->username,
                'password' => $this->password,
            );

            $auth = $client->Auth($credentials);

            if ($auth) {
                $balance = $client->GetCreditBalance();
                $balance_result = round($balance->GetCreditBalanceResult);

                if ($balance_result > '0') {
                    if ($this->from) {
                        $sender = $this->from;
                    } else {
                        $sender = 'Market';
                        \App\Logger\Log::channel('all')->info('(TurboSMS) Notice: Default Sender set! Please input real Sender');
                    }

                    if ($this->to) {
                        $phone = $this->prepPhone($this->to);
                    } else {
                        $phone = false;
                        \App\Logger\Log::error('(TurboSMS) Error: Phone destination not found!');
                    }

                    if ($phone) {
                        $sms = Array(
                            'sender'      => $sender,
                            'destination' => $phone,
                            'text'        => $this->message,
                        );

                        $client->SendSMS($sms);

                    }

                    if ($this->copy) {
                        $numbers = explode(',', $this->copy);
                        $phones = array();

                        foreach ($numbers as $number) {
                            $phones[] = $this->prepPhone($number);
                        }

                        $phones = implode(',', $phones);

                        $sms_bulk = Array(
                            'sender'      => $sender,
                            'destination' => $phones,
                            'text'        => $this->message,
                        );

                        $client->SendSMS($sms_bulk);

                    }
                } else {
                    \App\Logger\Log::error('(TurboSMS) Error: TurboSMS Balance is: ' . $balance->GetCreditBalanceResult);
                }
            } else {
                \App\Logger\Log::error('(TurboSMS) Error: TurboSMS Authentication failed!');
            }
        } catch (SoapFault $fault) {
            \App\Logger\Log::error("Ошибка SOAP: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
        }
    }

    private function prepPhone($phone) {
        $result = preg_replace('/\+?\d+,/', '', $phone);

        return $result;
    }
}