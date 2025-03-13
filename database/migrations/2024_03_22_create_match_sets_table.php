<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('match_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')
                  ->constrained('matches')
                  ->onDelete('cascade');
            $table->unsignedTinyInteger('set_number');
            $table->unsignedInteger('player1_score')->default(0);
            $table->unsignedInteger('player2_score')->default(0);
            $table->foreignId('winner_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->timestamps();

            // Ensure each match can only have one record per set number
            $table->unique(['match_id', 'set_number']);
        });

        // Add check constraint for set_number after table creation
        DB::statement('ALTER TABLE match_sets ADD CONSTRAINT check_set_number CHECK (set_number between 1 and 3)');
    }

    public function down(): void
    {
        Schema::dropIfExists('match_sets');
    }
};