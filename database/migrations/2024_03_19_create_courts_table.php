<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venue_id')->constrained()->onDelete('cascade');
            $table->foreignId('match_id')->nullable()->constrained('matches')->onDelete('cascade');
            $table->integer('number');
            $table->enum('status', ['available', 'occupied', 'maintenance'])->default('available');
            $table->date('schedule_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamps();

            // Ensure court numbers are unique within a venue
            $table->unique(['venue_id', 'number']);
            
            // Prevent overlapping schedules for the same court on the same date
            $table->unique(['venue_id', 'number', 'schedule_date', 'start_time'], 'unique_court_schedule');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};