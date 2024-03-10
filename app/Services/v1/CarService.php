<?php

namespace App\Services\v1;

use App\Models\Car;
use App\Models\UserCar;
use App\Presenters\v1\CarPresenter;
use App\Repositories\CarRepository;
use App\Repositories\UserCarRepository;
use App\Services\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CarService extends Service
{
    public function __construct(
        public CarRepository $carRepository,
        public UserCarRepository $userCarRepository,
    )
    {}

    public function getPaginated(array $params = [])
    {
        return $this->resultCollections(
            $this->carRepository->getPaginated($params),
            CarPresenter::class,
            'list',
            $this->carRepository->count()
            );
    }

    public function index(array $params = [])
    {
        $cars = $this->userCarRepository->index($params);
        $count = $this->userCarRepository->count($params);

        return $this->resultCollections($cars, CarPresenter::class, 'my', $count);
    }

    public function create(array $data)
    {
        $car = UserCar::create($data);

        return $this->result([
            'car' => (new CarPresenter($car->load('car')))->my()
        ]);
    }

    public function getCarByVin(array $params)
    {
        $response = Http::withHeaders([
            'Authorization' => config('parts-catalog.apikey'),
        ])->get(config('parts-catalog.url') . '/car/info', $params);

        if ($response->status() != Response::HTTP_OK) {
            Log::error(__METHOD__ . ': ' . json_encode($response->json()));
            return $this->errService('Сервис временно не работает, попробуйте позднее.');
        }

        return $this->result([
            'data' => $response->json(),
        ]);
    }
}
