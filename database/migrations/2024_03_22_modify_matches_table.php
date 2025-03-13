<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            // Remove the score column as it's moving to match_sets table
            $table->dropColumn('score');
            
            // Add completed_at if you don't have it already
            if (!Schema::hasColumn('matches', 'completed_at')) {
                $table->timestamp('completed_at')->nullable()->after('played_at');
            }

            // Rename winner_id to final_winner_id
            $table->dropForeign(['winner_id']);
            $table->renameColumn('winner_id', 'final_winner_id');
            $table->foreign('final_winner_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            // Restore the score column
            $table->string('score')->nullable();
            
            // Drop completed_at if it was added in this migration
            if (Schema::hasColumn('matches', 'completed_at')) {
                $table->dropColumn('completed_at');
            }

            // Revert the column name change
            $table->dropForeign(['final_winner_id']);
            $table->renameColumn('final_winner_id', 'winner_id');
            $table->foreign('winner_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }
};