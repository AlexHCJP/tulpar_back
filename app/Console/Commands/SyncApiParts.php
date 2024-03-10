<?php

namespace App\Console\Commands;

use Database\Seeders\ApiSeeder;
use Illuminate\Console\Command;

class SyncApiParts extends Command
{
    protected $signature = 'app:sync-api-parts';
    protected $description = 'Наполняет базу автомобилей';


    public function handle(): void
    {
        (new ApiSeeder())->run();
    }
}
