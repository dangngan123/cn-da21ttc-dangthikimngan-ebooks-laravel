<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $List = [];
        $row1 = [
            'author_id' => 1,
            'author_name' => 'José Mauro de Vasconcelos',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row1);
        $row2 = [
            'author_id' => 2,
            'author_name' => 'Nguyễn Nhật Ánh',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row2);
        $row3 = [
            'author_id' => 3,
            'author_name' => 'Triêu Tiểu Thành',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row3);
        DB::table('authors')->insert($List);
    }
}
