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
        Schema::create('part_groups', function (Blueprint $table) {
            $table->id();
            $table->string('api_id')->index();
            $table->string('car_id')->index();
            $table->boolean('hasSubgroups')->default(false);
            $table->boolean('hasParts')->default(false);
            $table->string('name');
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->string('parentId')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_groups');
    }
};
