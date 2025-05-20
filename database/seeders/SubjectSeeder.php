<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'Toán', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Văn', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tiếng Anh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vật Lý', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hóa Học', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sinh Học', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lịch Sử', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Địa Lý', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tin Học', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'GDCD', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('subjects')->insert($subjects);
    }
}
