<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'ôn tập', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'thi THPT', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'bài tập', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'lý thuyết', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'giải nhanh', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('tags')->insert($tags);
    }
}
