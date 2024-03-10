<?php

namespace App\Interfaces;

use App\Models\VerificationCode;

interface CodeSenderInterface
{
    public function send(VerificationCode $verificationCode);
}
