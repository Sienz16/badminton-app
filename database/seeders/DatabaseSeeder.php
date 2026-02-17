<?php

namespace Database\Seeders;

use App\Models\Court;
use App\Models\GameMatch;
use App\Models\MatchSet;
use App\Models\Player;
use App\Models\Umpire;
use App\Models\User;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $password = Hash::make('Test12345');
            $now = Carbon::now();

            $admin = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => $password,
                'role_id' => 'admin',
                'admin_verified_at' => $now->copy()->subDays(30),
                'email_verified_at' => $now->copy()->subDays(30),
            ]);

            $umpireUsers = collect([
                ['name' => 'Test Umpire', 'email' => 'umpire@example.com', 'status' => 'available', 'phone' => '+60 12-500 1100', 'bio' => 'National-level umpire focusing on clean service judgments.'],
                ['name' => 'Farid Rahman', 'email' => 'farid.rahman@example.com', 'status' => 'available', 'phone' => '+60 12-500 1101', 'bio' => 'Experienced in youth and club-level tournaments.'],
                ['name' => 'Liyana Ismail', 'email' => 'liyana.ismail@example.com', 'status' => 'unavailable', 'phone' => '+60 12-500 1102', 'bio' => 'Technical umpire currently assigned to district events.'],
            ])->map(function (array $data) use ($password, $now) {
                $user = User::factory()->create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $password,
                    'role_id' => 'umpire',
                    'email_verified_at' => $now->copy()->subDays(rand(3, 20)),
                ]);

                Umpire::create([
                    'user_id' => $user->id,
                    'phone_number' => $data['phone'],
                    'status' => $data['status'],
                    'bio' => $data['bio'],
                ]);

                return $user;
            });

            $playerProfiles = collect([
                ['name' => 'Test Player', 'email' => 'test@example.com', 'dob' => '1998-07-14', 'gender' => 'male', 'nationality' => 'Malaysian', 'hand' => 'right', 'phone' => '+60 12-700 2100', 'bio' => 'Aggressive front-court specialist with fast net kills.'],
                ['name' => 'Aina Zulkifli', 'email' => 'aina.zulkifli@example.com', 'dob' => '1999-11-04', 'gender' => 'female', 'nationality' => 'Malaysian', 'hand' => 'left', 'phone' => '+60 12-700 2101', 'bio' => 'Control-based rally player known for tight drops.'],
                ['name' => 'Jason Lim', 'email' => 'jason.lim@example.com', 'dob' => '1996-02-22', 'gender' => 'male', 'nationality' => 'Singaporean', 'hand' => 'right', 'phone' => '+65 8123 4567', 'bio' => 'Counter-attacking singles player with strong defense.'],
                ['name' => 'Nur Adila', 'email' => 'nur.adila@example.com', 'dob' => '2000-03-09', 'gender' => 'female', 'nationality' => 'Malaysian', 'hand' => 'right', 'phone' => '+60 12-700 2102', 'bio' => 'Quick-footed player who thrives in long rallies.'],
                ['name' => 'Marcus Tan', 'email' => 'marcus.tan@example.com', 'dob' => '1995-12-01', 'gender' => 'male', 'nationality' => 'Malaysian', 'hand' => 'ambidextrous', 'phone' => '+60 12-700 2103', 'bio' => 'Power smasher with flexible attacking angles.'],
                ['name' => 'Priya Nair', 'email' => 'priya.nair@example.com', 'dob' => '2001-08-18', 'gender' => 'female', 'nationality' => 'Indian', 'hand' => 'left', 'phone' => '+60 12-700 2104', 'bio' => 'Excellent court coverage and deceptive half-smashes.'],
                ['name' => 'Danial Hakim', 'email' => 'danial.hakim@example.com', 'dob' => '1997-06-27', 'gender' => 'male', 'nationality' => 'Malaysian', 'hand' => 'right', 'phone' => '+60 12-700 2105', 'bio' => 'Defensive grinder with precise baseline clears.'],
                ['name' => 'Siti Mariam', 'email' => 'siti.mariam@example.com', 'dob' => '1994-09-13', 'gender' => 'female', 'nationality' => 'Malaysian', 'hand' => 'right', 'phone' => '+60 12-700 2106', 'bio' => 'Veteran club player and tactical shot-maker.'],
            ])->map(function (array $data) use ($password, $now) {
                $user = User::factory()->create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $password,
                    'role_id' => 'player',
                    'email_verified_at' => $now->copy()->subDays(rand(1, 45)),
                ]);

                return Player::create([
                    'user_id' => $user->id,
                    'phone_number' => $data['phone'],
                    'date_of_birth' => $data['dob'],
                    'gender' => $data['gender'],
                    'nationality' => $data['nationality'],
                    'playing_hand' => $data['hand'],
                    'bio' => $data['bio'],
                ]);
            });

            $venues = collect([
                [
                    'name' => 'Batu Caves Badminton Hub',
                    'address' => '12 Jalan Aman Perdana, Selangor',
                    'courts_count' => 4,
                    'contact_phone' => '+60 3-6101 9001',
                    'contact_email' => 'booking@batucaveshub.my',
                    'venue_img' => 'venues/batu-caves-hub.jpg',
                ],
                [
                    'name' => 'Shah Alam Shuttle Arena',
                    'address' => '88 Persiaran Sukan, Shah Alam',
                    'courts_count' => 6,
                    'contact_phone' => '+60 3-5512 4410',
                    'contact_email' => 'hello@shuttlearena.my',
                    'venue_img' => 'venues/shuttle-arena.jpg',
                ],
            ])->map(fn (array $data) => Venue::create($data));

            Court::query()
                ->where('venue_id', $venues[1]->id)
                ->where('number', 6)
                ->update(['status' => 'maintenance']);

            $players = $playerProfiles->values();

            $completedMatches = [
                [0, 1, 0, 1, 0, $now->copy()->subDays(5)->setTime(19, 0), [[21, 18], [18, 21], [21, 16]]],
                [2, 3, 1, 2, 1, $now->copy()->subDays(4)->setTime(20, 30), [[21, 14], [21, 17]]],
                [4, 5, 1, 3, 0, $now->copy()->subDays(3)->setTime(18, 45), [[17, 21], [21, 19], [18, 21]]],
                [6, 7, 0, 2, 1, $now->copy()->subDays(2)->setTime(21, 0), [[21, 13], [21, 15]]],
                [0, 2, 1, 5, 2, $now->copy()->subDay()->setTime(19, 15), [[22, 20], [19, 21], [18, 21]]],
            ];

            foreach ($completedMatches as [$p1Index, $p2Index, $venueIndex, $courtNumber, $umpireIndex, $scheduledAt, $sets]) {
                $player1 = $players[$p1Index]->user_id;
                $player2 = $players[$p2Index]->user_id;
                $umpire = $umpireUsers[$umpireIndex]->id;

                $player1SetWins = collect($sets)->where(fn (array $set) => $set[0] > $set[1])->count();
                $player2SetWins = count($sets) - $player1SetWins;
                $winnerId = $player1SetWins > $player2SetWins ? $player1 : $player2;

                $match = GameMatch::create([
                    'player1_id' => $player1,
                    'player2_id' => $player2,
                    'venue_id' => $venues[$venueIndex]->id,
                    'court_number' => $courtNumber,
                    'umpire_id' => $umpire,
                    'scheduled_at' => $scheduledAt,
                    'played_at' => $scheduledAt->copy()->addMinutes(10),
                    'completed_at' => $scheduledAt->copy()->addMinutes(65),
                    'status' => 'completed',
                    'final_winner_id' => $winnerId,
                ]);

                foreach ($sets as $index => [$player1Score, $player2Score]) {
                    MatchSet::create([
                        'match_id' => $match->id,
                        'set_number' => $index + 1,
                        'player1_score' => $player1Score,
                        'player2_score' => $player2Score,
                        'winner_id' => $player1Score > $player2Score ? $player1 : $player2,
                    ]);
                }
            }

            $inProgressMatch = GameMatch::create([
                'player1_id' => $players[3]->user_id,
                'player2_id' => $players[5]->user_id,
                'venue_id' => $venues[0]->id,
                'court_number' => 3,
                'umpire_id' => $umpireUsers[0]->id,
                'scheduled_at' => $now->copy()->subMinutes(35),
                'played_at' => $now->copy()->subMinutes(30),
                'status' => 'in_progress',
            ]);

            MatchSet::create([
                'match_id' => $inProgressMatch->id,
                'set_number' => 1,
                'player1_score' => 19,
                'player2_score' => 21,
                'winner_id' => $players[5]->user_id,
            ]);

            MatchSet::create([
                'match_id' => $inProgressMatch->id,
                'set_number' => 2,
                'player1_score' => 14,
                'player2_score' => 12,
                'winner_id' => null,
            ]);

            $scheduledMatches = [
                [1, 4, 0, 4, 0, $now->copy()->addDay()->setTime(19, 0)],
                [7, 0, 1, 2, 1, $now->copy()->addDays(2)->setTime(20, 0)],
                [5, 6, 1, 4, 2, $now->copy()->addDays(3)->setTime(18, 30)],
            ];

            foreach ($scheduledMatches as [$p1Index, $p2Index, $venueIndex, $courtNumber, $umpireIndex, $scheduledAt]) {
                GameMatch::create([
                    'player1_id' => $players[$p1Index]->user_id,
                    'player2_id' => $players[$p2Index]->user_id,
                    'venue_id' => $venues[$venueIndex]->id,
                    'court_number' => $courtNumber,
                    'umpire_id' => $umpireUsers[$umpireIndex]->id,
                    'scheduled_at' => $scheduledAt,
                    'status' => 'scheduled',
                ]);
            }

            GameMatch::create([
                'player1_id' => $players[2]->user_id,
                'player2_id' => $players[4]->user_id,
                'venue_id' => $venues[0]->id,
                'court_number' => 2,
                'umpire_id' => $umpireUsers[1]->id,
                'scheduled_at' => $now->copy()->subHours(4),
                'status' => 'cancelled',
            ]);

            $playerProfiles->each(function (Player $profile): void {
                $userId = $profile->user_id;

                $matchesPlayed = GameMatch::query()
                    ->where('status', 'completed')
                    ->where(function ($query) use ($userId) {
                        $query->where('player1_id', $userId)
                            ->orWhere('player2_id', $userId);
                    })
                    ->count();

                $matchesWon = GameMatch::query()
                    ->where('status', 'completed')
                    ->where('final_winner_id', $userId)
                    ->count();

                $profile->update([
                    'matches_played' => $matchesPlayed,
                    'matches_won' => $matchesWon,
                ]);
            });

            $admin->update(['is_active' => true]);
        });
    }
}
