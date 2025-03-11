<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->foreignId('winner_id')->nullable()->after('score')->constrained('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropForeign(['winner_id']);
            $table->dropColumn('winner_id');
        });
    }
};