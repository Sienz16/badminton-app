<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GameMatch;
use App\Models\Venue;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin account
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('Test12345'),
            'role_id' => 'admin'
        ]);

        // Create umpire account
        User::factory()->create([
            'name' => 'Test Umpire',
            'email' => 'umpire@example.com',
            'password' => Hash::make('Test12345'),
            'role_id' => 'umpire'
        ]);

        // Create test player with specific password
        $player1 = User::factory()->create([
            'name' => 'Test Player',
            'email' => 'test@example.com',
            'password' => Hash::make('Test12345'),
            'role_id' => 'player'
        ]);

        // Create some opponent players
        $player2 = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role_id' => 'player'
        ]);

        $player3 = User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'role_id' => 'player'
        ]);

        // Create a venue
        $venue = Venue::create([
            'name' => 'Main Court',
            'address' => '123 Sports Street',
        ]);

        // Create matches with different statuses
        
        // Upcoming match
        GameMatch::create([
            'player1_id' => $player1->id,
            'player2_id' => $player2->id,
            'venue_id' => $venue->id,
            'scheduled_at' => Carbon::now()->addDays(2),
            'status' => 'scheduled',
        ]);

        // Live match
        GameMatch::create([
            'player1_id' => $player1->id,
            'player2_id' => $player3->id,
            'venue_id' => $venue->id,
            'scheduled_at' => Carbon::now(),
            'status' => 'in_progress',
            'score' => '21-19, 16-21',
        ]);

        // Past matches
        GameMatch::create([
            'player1_id' => $player1->id,
            'player2_id' => $player2->id,
            'venue_id' => $venue->id,
            'scheduled_at' => Carbon::now()->subDays(1),
            'played_at' => Carbon::now()->subDays(1),
            'status' => 'completed',
            'score' => '21-15, 21-17',
        ]);

        GameMatch::create([
            'player1_id' => $player2->id,
            'player2_id' => $player1->id,
            'venue_id' => $venue->id,
            'scheduled_at' => Carbon::now()->subDays(3),
            'played_at' => Carbon::now()->subDays(3),
            'status' => 'completed',
            'score' => '21-18, 19-21, 21-15',
        ]);

        GameMatch::create([
            'player1_id' => $player1->id,
            'player2_id' => $player3->id,
            'venue_id' => $venue->id,
            'scheduled_at' => Carbon::now()->subDays(5),
            'played_at' => Carbon::now()->subDays(5),
            'status' => 'completed',
            'score' => '21-13, 21-19',
        ]);
    }
}
