<?php

namespace Database\Seeders;

use App\Models\Part;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parts= [
            [
                'api_id' => '1',
                'group_id' => 'group2',
                'name' => 'Название части',
                'number' => 'Какой-то номер',
                'notice' => 'lorem ipsum',
                'description' => 'description',
                'positionNumber' => '0',
            ],
            [
                'api_id' => '2',
                'group_id' => 'group2',
                'name' => 'Название части',
                'number' => 'Какой-то номер',
                'notice' => 'lorem ipsum',
                'description' => 'description',
                'positionNumber' => '0',
            ],
            [
                'api_id' => '3',
                'group_id' => 'group3',
                'name' => 'Название части',
                'number' => 'Какой-то номер',
                'notice' => 'lorem ipsum',
                'description' => 'description',
                'positionNumber' => '0',
            ],
            [
                'api_id' => '4',
                'group_id' => 'group3',
                'name' => 'Название части',
                'number' => 'Какой-то номер',
                'notice' => 'lorem ipsum',
                'description' => 'description',
                'positionNumber' => '0',
            ],
            [
                'api_id' => '5',
                'group_id' => 'group5',
                'name' => 'Название части',
                'number' => 'Какой-то номер',
                'notice' => 'lorem ipsum',
                'description' => 'description',
                'positionNumber' => '0',
            ],
            [
                'api_id' => '6',
                'group_id' => 'group5',
                'name' => 'Название части',
                'number' => 'Какой-то номер',
                'notice' => 'lorem ipsum',
                'description' => 'description',
                'positionNumber' => '0',
            ],
        ];

        foreach ($parts as $part) {
            Part::create($part);
        }
    }
}
