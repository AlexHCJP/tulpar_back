<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\CreateSupportMessageRequest;
use App\Models\SupportMessage;
use Illuminate\Http\Request;

class SupportMessageController extends ApiController
{
    public function send(CreateSupportMessageRequest $request)
    {
        SupportMessage::create(array_merge(['user_id' => auth('api')->id()], $request->validated()));
        return $this->result(['httpCode' => 200, 'data' => ['message' => 'Сообщение отправлено']]);
    }
}
