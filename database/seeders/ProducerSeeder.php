<?php

namespace Database\Seeders;

use App\Models\Producer;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'api_id' => 'aaaa',
                'name' => 'Toyota',
            ],
            [
                'api_id' => 'aaab',
                'name' => 'BMW',
            ],
        ];
        foreach ($data as $item) {
            Producer::create($item);
        }
    }
}
