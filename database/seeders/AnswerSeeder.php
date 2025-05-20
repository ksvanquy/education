<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AnswerSeeder extends Seeder
{
    public function run(): void
    {
        $answers = [
            [
                'question_id' => 1,
                'user_id' => 2,
                'content' => 'a = 673, b = 1348 là một đáp án.',
                'is_accepted' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'user_id' => 1,
                'content' => 'Bạn nên lập dàn ý theo các ý chính: hoàn cảnh, nhân vật, ý nghĩa.',
                'is_accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 3,
                'user_id' => 3,
                'content' => 'Thì hiện tại đơn: S + V(s/es)...',
                'is_accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 4,
                'user_id' => 2,
                'content' => 'v = g.t, ví dụ: t = 2s, v = 20m/s.',
                'is_accepted' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 5,
                'user_id' => 1,
                'content' => 'H2SO4 + NaOH → Na2SO4 + H2O.',
                'is_accepted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('answers')->insert($answers);
    }
}
