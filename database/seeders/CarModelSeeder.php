<?php

namespace Database\Seeders;

use App\Models\CarModel;
use App\Models\Producer;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'api_id' => 'bbbb1',
                'name' => 'Camry',
                'producer_id' => 'aaaa'
            ],
            [
                'api_id' => 'bbbb2',
                'name' => 'Corolla',
                'producer_id' => 'aaaa'
            ],
            [
                'api_id' => 'bbbb3',
                'name' => 'M3',
                'producer_id' => 'aaab'
            ],
            [
                'api_id' => 'bbbb4',
                'name' => 'e34',
                'producer_id' => 'aaab'
            ],
        ];

        foreach ($data as $carModel) {
            CarModel::create($carModel);
        }
    }
}
