<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')
            ->where('role_id', 'umvire')
            ->update(['role_id' => 'umpire']);

        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_id_check');
        DB::statement('ALTER TABLE users ALTER COLUMN role_id TYPE varchar(255)');
        DB::statement("ALTER TABLE users ALTER COLUMN role_id SET DEFAULT 'admin'");
        DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_id_check CHECK (role_id IN ('admin', 'umpire', 'player'))");
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_id_check');
        DB::statement('ALTER TABLE users ALTER COLUMN role_id TYPE varchar(255)');
    }
};
