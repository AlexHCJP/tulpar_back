<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Part;
use App\Models\PartGroup;
use App\Models\Producer;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producer::truncate();
        CarModel::truncate();
        Car::truncate();
        PartGroup::truncate();
        Part::truncate();

        $producers = Http::withHeaders([
            'Authorization' => config('parts-catalog.apikey'),
            'Accept-Language' => 'ru',
        ])->get(config('parts-catalog.url') . '/catalogs');

        foreach ($producers->json() as $item) {
            Log::info('Producer: ' . json_encode($item));
            $item['api_id'] = $item['id'];
            unset($item['id'], $item['modelsCount']);
            Producer::create($item);

            $this->createModels($item['api_id']);
        }
    }

    private function createModels($producerId)
    {
        $models = Http::withHeaders([
            'Authorization' => config('parts-catalog.apikey'),
            'Accept-Language' => 'ru',
        ])->get(config('parts-catalog.url') . '/catalogs/' . $producerId . '/models');

        foreach ($models->json() as $model) {
            Log::info('Model: ' . json_encode($model));
            $model['api_id'] = $model['id'];
            $model['producer_id'] = $producerId;
            unset($model['id']);
            if (isset($model['img'])) {
                $model['img'] = $this->saveImageFromURL(str_replace('//', 'https://', $model['img']), 'cars');
            }
            CarModel::create($model);

            $this->createCars($producerId, $model['api_id']);
        }
    }

    private function createCars($producerId, $modelId)
    {
        $cars = Http::withHeaders([
            'Authorization' => config('parts-catalog.apikey'),
            'Accept-Language' => 'ru',
        ])->get(config('parts-catalog.url') . '/catalogs/' . $producerId . '/cars2', ['modelId' => $modelId]);

        foreach ($cars->json() as $car) {
            Log::info('Car: ' . json_encode($car));
            $car['api_id'] = $car['id'];
            unset($car['id'], $car['description'], $car['vin'], $car['frame'], $car['criteria']);
            $parameters = $car['parameters'];
            $car['parameters'] = json_encode($parameters);

            Car::create($car);

            if (!empty($parameters)) {
                $this->createGroups($producerId, $car['api_id']);
            }
        }
    }

    public function createGroups($producerId, $carId, $groupId = null)
    {
        $groups = Http::withHeaders([
            'Authorization' => config('parts-catalog.apikey'),
            'Accept-Language' => 'ru',
        ])->get(config('parts-catalog.url') . '/catalogs/' . $producerId . '/groups2', ['carId' => $carId, 'groupId' => $groupId]);

        foreach ($groups->json() as $group) {
            Log::info('group: ' . json_encode($group));
            $group['api_id'] = $group['id'];
            $group['car_id'] = $carId;
            unset($group['id']);
            if (isset($group['img'])) {
                $group['img'] = $this->saveImageFromURL(str_replace('//', 'https://', $group['img']), 'groups');
            }
            PartGroup::create($group);

            if ($group['hasSubgroups']) {
                $this->createGroups($producerId, $carId, $group['api_id']);
            }

            if ($group['hasParts']) {
                $this->createParts($producerId, $carId, $group['api_id']);
            }
        }
    }

    public function createParts($producerId, $carId, $groupId)
    {
        $response = Http::withHeaders([
            'Authorization' => config('parts-catalog.apikey'),
            'Accept-Language' => 'ru',
        ])->get(config('parts-catalog.url') . '/catalogs/' . $producerId . '/parts2',
            [
                'carId' => $carId,
                'groupId' => $groupId
            ]);

        $partGroups = $response->json()['partGroups'];

        foreach ($partGroups as $groups) {
            foreach ($groups['parts'] as $item) {
                $item['api_id'] = $item['id'];
                $item['group_id'] = $groupId;

                unset($item['id']);

                Part::create($item);
            }
        }
    }

    private function saveImageFromURL($imageUrl, $folder = 'cars'): string
    {
        // Генерируем уникальное имя для файла
        $filename = uniqid() . '.' . pathinfo($imageUrl, PATHINFO_EXTENSION);

        // Создаем папку, если она не существует
        $folderPath = 'public/' . $folder;
        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }

        try {
            // Скачиваем изображение и сохраняем его в хранилище
            $imageContents = file_get_contents($imageUrl);
        } catch (Exception $th) {
            return '';
        }
        Storage::put('public/' . $folder . '/' . $filename, $imageContents);

        // Возвращаем путь к сохраненному файлу
        return '/storage/' . $folder . '/' . $filename;
    }
}
