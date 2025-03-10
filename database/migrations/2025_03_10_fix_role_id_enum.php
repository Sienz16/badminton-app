<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First, update any existing 'umvire' roles to 'umpire'
        DB::table('users')
            ->where('role_id', 'umvire')
            ->update(['role_id' => 'umpire']);

        // Then modify the enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role_id ENUM('admin', 'umpire', 'player') DEFAULT 'admin'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role_id ENUM('admin', 'umvire', 'player') DEFAULT 'admin'");
    }
};