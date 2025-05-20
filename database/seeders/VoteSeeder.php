<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class VoteSeeder extends Seeder
{
    public function run(): void
    {
        $votes = [
            [
                'user_id' => 1,
                'question_id' => 1,
                'answer_id' => null,
                'vote_type' => 'up',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'question_id' => 1,
                'answer_id' => null,
                'vote_type' => 'down',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'question_id' => null,
                'answer_id' => 1,
                'vote_type' => 'up',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'question_id' => null,
                'answer_id' => 2,
                'vote_type' => 'down',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('votes')->insert($votes);
    }
}
