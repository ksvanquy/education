<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class QuestionTagSeeder extends Seeder
{
    public function run(): void
    {
        $questionTags = [
            ['question_id' => 1, 'tag_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 1, 'tag_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 2, 'tag_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 3, 'tag_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 4, 'tag_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('question_tags')->insert($questionTags);
    }
}
