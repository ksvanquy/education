<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'user_id' => 1,
                'subject_id' => 1,
                'grade_id' => 6,
                'title' => 'Tìm các số tự nhiên a, b sao cho a+b=2021 và b chia hết cho a',
                'content' => 'Giải chi tiết giúp mình bài này với!',
                'status' => 'answered',
                'moderation_status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'subject_id' => 2,
                'grade_id' => 7,
                'title' => 'Phân tích tác phẩm Chí Phèo',
                'content' => 'Cần dàn ý chi tiết.',
                'status' => 'unanswered',
                'moderation_status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'subject_id' => 3,
                'grade_id' => 8,
                'title' => 'Cách chia động từ trong tiếng Anh',
                'content' => 'Giải thích các thì cơ bản.',
                'status' => 'pending',
                'moderation_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'subject_id' => 4,
                'grade_id' => 9,
                'title' => 'Tính vận tốc của vật rơi tự do',
                'content' => 'Cho biết công thức và ví dụ.',
                'status' => 'closed',
                'moderation_status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'subject_id' => 5,
                'grade_id' => 10,
                'title' => 'Phản ứng hóa học của H2SO4',
                'content' => 'Viết các phương trình phản ứng.',
                'status' => 'first_time',
                'moderation_status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('questions')->insert($questions);
    }
}
