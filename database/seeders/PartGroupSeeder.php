<?php

namespace Database\Seeders;

use App\Models\PartGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'api_id' => 'group1',
                'car_id' => 'car1',
                'hasSubgroups' => true,
                'hasParts' => false,
                'name' => 'Кузов',
                'description' => 'Кузов от Toyota Camry 2.5',
            ],
            [
                'api_id' => 'group2',
                'car_id' => 'car1',
                'hasSubgroups' => false,
                'hasParts' => true,
                'name' => 'Кузовная часть',
                'description' => 'описание',
                'parentId' => 'group1',
            ],
            [
                'api_id' => 'group3',
                'car_id' => 'car1',
                'hasSubgroups' => false,
                'hasParts' => true,
                'name' => 'Рессора',
                'description' => 'описание',
                'parentId' => 'group1',
            ],
            [
                'api_id' => 'group4',
                'car_id' => 'car1',
                'hasSubgroups' => true,
                'hasParts' => false,
                'name' => 'Электроника',
                'description' => 'описание',
            ],
            [
                'api_id' => 'group5',
                'car_id' => 'car1',
                'hasSubgroups' => false,
                'hasParts' => true,
                'name' => 'провода',
                'description' => 'описание',
                'parentId' => 'group4',
            ],
        ];

        foreach ($data as $group) {
            PartGroup::create($group);
        }
    }
}
