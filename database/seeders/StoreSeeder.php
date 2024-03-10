<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'name' => 'Test',
            'phone' => '+77777777777',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo suscipit necessitatibus rem quod doloremque odio, hic temporibus reprehenderit distinctio consequuntur vitae nisi itaque exercitationem obcaecati deleniti ex, ut, dignissimos eum.',
            'password' => '123',
            'active' => 1,
            'city_id' => 1,
        ]);
    }
}
