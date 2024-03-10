<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('CREATE TRIGGER update_store_rating AFTER INSERT ON ratings
            FOR EACH ROW
            BEGIN
                UPDATE stores SET rating = (
                    SELECT AVG(rate)
                    FROM (
                        SELECT rate
                        FROM ratings
                        WHERE store_id = NEW.store_id
                        ORDER BY created_at DESC
                        LIMIT 100
                    ) AS last_ratings
                ) WHERE id = NEW.store_id;
            END'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
