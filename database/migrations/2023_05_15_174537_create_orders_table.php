<?php

use App\Models\Car;
use App\Models\City;
use App\Models\Part;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('user_id');
            $table->string('car_id');
            $table->foreignId('part_id');
            $table->foreignIdFor(City::class, 'city_id');
            $table->string('comment')->nullable();
            $table->enum('status', ['moderation', 'active', 'canceled', 'done'])->default('moderation');
            $table->double('lat', 10, 8)->nullable();
            $table->double('lon', 10, 8)->nullable();
            $table->foreignId('store_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
