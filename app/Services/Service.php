<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Presenters\Presenter;

abstract class Service
{
    protected function errValidate(string $message): array
    {
        return $this->error(422, $message);
    }

    protected function errFobidden(string $message): array
    {
        return $this->error(403, $message);
    }
    protected function errNotFound(string $message): array
    {
        return $this->error(404, $message);
    }

    protected function errService(string $message): array
    {
        return $this->error(500, $message);
    }
    protected function errNotAcceptable(string $message): array
    {
        return $this->error(406, $message);
    }

    protected function ok(string $message = 'OK'): array
    {
        return $this->result(['message' => $message]);
    }

    protected function result(array $data): array
    {
        Log::info(__METHOD__ . ' ' . $this->getInfoContext($data));
        $rData = ['success' => true] + $data;
        return [
            'data' => $rData,
            'httpCode' => 200
        ];
    }

    protected function error(int $code, string $message): array
    {
        Log::info(__METHOD__ . ' ' . $message);
        return [
            'data' => [
                'message' => $message,
                'success' => false,
            ],
            'httpCode' => $code
        ];
    }

    protected function response(int $code, array $data): array
    {
        Log::info(__METHOD__ . ' code:' . $code, $data);
        return [
            'data' => $data,
            'httpCode' => $code
        ];
    }

    protected function isSuccess(array $result): bool
    {
        return (!empty($result['httpCode']) && $result['httpCode'] === 200);
    }

    private function getInfoContext($data)
    {
        $info = '';
        if (!empty($data['message'])) {
            $info = $data['message'];
        }
        return $info;
    }
    protected function resultCollections($collections, $classPresenter = null, $method = null, $totals = null): array
    {
        $data['list'] = Presenter::presentCollections($collections, $classPresenter, $method);
        if ($totals) {
            $data['totals'] = $totals;
        }
        return $this->result($data);
    }
}
