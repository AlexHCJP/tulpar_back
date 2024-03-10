<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'api_id' => 'car1',
                'name' => 'Toyota Camry 2.5',
                'modelId' => 'bbbb1',
                'modelName' => 'Camry',
                'catalogId' => 'aaaa',
                'brand' => 'Toyota'
            ],
            [
                'api_id' => 'car2',
                'name' => 'Toyota Camry 3',
                'modelId' => 'bbbb1',
                'modelName' => 'Camry',
                'catalogId' => 'aaaa',
                'brand' => 'Toyota'
            ],
            [
                'api_id' => 'car3',
                'name' => 'Toyota Corolla GTR',
                'modelId' => 'bbbb2',
                'modelName' => 'Corolla',
                'catalogId' => 'aaaa',
                'brand' => 'Toyota'
            ],
            [
                'api_id' => 'car4',
                'name' => 'Toyota Corolla GTR+',
                'modelId' => 'bbbb2',
                'modelName' => 'Corolla',
                'catalogId' => 'aaaa',
                'brand' => 'Toyota'
            ],
        ];

        foreach ($data as $car) {
            Car::create($car);
        }
    }
}
