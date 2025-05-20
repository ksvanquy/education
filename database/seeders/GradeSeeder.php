<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [];
        for ($i = 1; $i <= 12; $i++) {
            $grades[] = ['name' => 'Lớp ' . $i, 'created_at' => now(), 'updated_at' => now()];
        }
        DB::table('grades')->insert($grades);
    }
}