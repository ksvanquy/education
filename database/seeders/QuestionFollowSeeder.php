<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class QuestionFollowSeeder extends Seeder
{
    public function run(): void
    {
        $follows = [
            ['user_id' => 1, 'question_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'question_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'question_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('question_follows')->insert($follows);
    }
}
