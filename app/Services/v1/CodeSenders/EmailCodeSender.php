<?php

namespace App\Services\v1\CodeSenders;

use App\Interfaces\CodeSenderInterface;
use App\Mail\VerificationCodeMail;
use App\Models\VerificationCode;
use App\Services\Service;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailCodeSender extends Service implements CodeSenderInterface
{
    public function send(VerificationCode $verificationCode)
    {
        try {
            Mail::to($verificationCode->email)->send(new VerificationCodeMail($verificationCode->code));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->errService('Не удалось отправить код, попробуйте позднее');
        }
        return $this->ok();
    }
}
