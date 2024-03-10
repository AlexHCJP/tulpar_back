<?php

namespace App\Services\v1\CodeSenders;

use App\Interfaces\CodeSenderInterface;
use App\Models\VerificationCode;
use App\Services\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsCodeSender extends Service implements CodeSenderInterface
{
    public function send(VerificationCode $verificationCode)
    {
        $response = Http::get(config('sms.url'), [
            'login' => config('sms.login'),
            'password' => config('sms.password'),
            'type' => 'message',
            'id' => $verificationCode->id,
            'recipient' => $verificationCode->phone,
            'sender' => config('sms.sender'),
			'text' => 'Ваш код авторизации: ' . $verificationCode->code,
        ]);

        if ($response->status() != 200) {
            return $this->errService('Не удалось отправить сообщение');
        }

        // обрезаем 'status='
        $responseCode = substr($response->body(), 7, 3);

        Log::info(__METHOD__ . ': Response code = ' . $responseCode . '. Phone: ' . $verificationCode->phone);

        if ($responseCode >= 100 && $responseCode <= 102) {
            return $this->ok();
        }

        return $this->errService('Не удалось отправить сообщение');
    }
}
