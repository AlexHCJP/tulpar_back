<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\Auth\ConfirmCodeRequest;
use App\Http\Requests\Api\v1\Auth\FirebaseLoginRequest;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\RegisterRequest;
use App\Services\v1\AuthService;
use App\Services\v1\CodeSenders\EmailCodeSender;
use App\Services\v1\CodeSenders\SmsCodeSender;

class AuthController extends ApiController
{
    public function __construct(
        public AuthService $authService
    ) {
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        if ($data['type'] == 'email') {
            $sender = new EmailCodeSender();
        }
        elseif ($data['type'] == 'phone') {
            $sender = new SmsCodeSender();
        }
        unset($data['type']);
        return $this->result($this->authService->register($data, $sender));
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        return $this->result($this->authService->login($data));
    }

    public function loginStore(LoginRequest $request)
    {
        $data = $request->validated();
        return $this->result($this->authService->loginStore($data));
    }

    public function confirmCode(ConfirmCodeRequest $request)
    {
        $data = $request->validated();
        return $this->result($this->authService->confirmCode($data));
    }

    public function logout()
    {
        return $this->result($this->authService->logout());
    }


    public function loginFirebase(FirebaseLoginRequest $request)
    {
        return $this->result($this->authService->loginFirebase($request->validated()));
    }
}
