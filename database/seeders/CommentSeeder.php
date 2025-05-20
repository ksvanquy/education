<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $comments = [
            [
                'user_id' => 2,
                'question_id' => 1,
                'answer_id' => null,
                'content' => 'Câu hỏi này hay quá!',
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'question_id' => null,
                'answer_id' => 1,
                'content' => 'Cảm ơn bạn đã trả lời.',
                'created_at' => now(),
            ],
            [
                'user_id' => 3,
                'question_id' => 2,
                'answer_id' => null,
                'content' => 'Mình cũng đang cần dàn ý này.',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'question_id' => null,
                'answer_id' => 2,
                'content' => 'Gợi ý rất hữu ích.',
                'created_at' => now(),
            ],
        ];
        DB::table('comments')->insert($comments);
    }
}
