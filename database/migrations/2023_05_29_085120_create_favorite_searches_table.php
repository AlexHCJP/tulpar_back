<?php

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
        Schema::create('favorite_searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->foreignId('producer_id');
            $table->foreignId('model_id')->nullable();
            $table->foreignId('part_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_searches');
    }
};
