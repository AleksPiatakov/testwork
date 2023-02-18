<?php

require_once 'vendor/twilio/sdk/src/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

final class twilio extends SmsGate {

    public function send() {

        if ($this->username && $this->password) {
            $account_sid = $this->username;
            $auth_token = $this->password;
            $phone = $this->to;
            $message = $this->message;

            if(!empty($phone) && strpos($phone, '+') === 0) {

                if ($this->from) {
                    $twilioServiceSid = $this->from;
                    $this->sendSms($account_sid, $auth_token, $phone, $twilioServiceSid, $message);
                } else {
                    \App\Logger\Log::error('(Twilio) Error: Please input Service SID');
                }
            } else {
                \App\Logger\Log::error('(Twilio) Error: Phone destination not found!');
            }
        } else {
            \App\Logger\Log::error('(Twilio) Error: Please enter valid Account SID or Auth token!');
        }
    }

    private function sendSms($account_sid, $auth_token, $phone, $twilioServiceSid, $message) {
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $phone,
            [
                "messagingServiceSid" => $twilioServiceSid,
                'body' => $message
            ]
        );

    }

}