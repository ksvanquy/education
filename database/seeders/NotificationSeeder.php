<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $notifications = [
            [
                'user_id' => 1,
                'question_id' => 1,
                'answer_id' => 1,
                'type' => 'answer',
                'content' => 'Câu hỏi của bạn đã có câu trả lời.',
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'question_id' => 2,
                'answer_id' => null,
                'type' => 'comment',
                'content' => 'Có bình luận mới cho câu hỏi của bạn.',
                'is_read' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'question_id' => 3,
                'answer_id' => 3,
                'type' => 'other',
                'content' => 'Bạn được gắn thẻ trong một câu trả lời.',
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('notifications')->insert($notifications);
    }
}
