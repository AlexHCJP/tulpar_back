<?php

use App\Models\City;
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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->foreignIdFor(City::class);
            $table->string('password');
            $table->string('image')->nullable();
            $table->decimal('rating', 3, 2, true)->default(0);
            $table->boolean('active')->default(false);
            $table->string('firebase_token')->nullable();
            $table->dateTime('last_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
