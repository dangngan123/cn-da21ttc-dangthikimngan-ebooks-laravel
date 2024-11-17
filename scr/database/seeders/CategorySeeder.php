<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $List = [];
        $row1 =
        [
            
            'category_id' => 1,
            'category_name' => 'VĂN HỌC',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),

          
        ];
        array_push($List, $row1);

        $row2 =
        [
            'category_id' => 2,
            'category_name' => 'KINH TẾ',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row2);

        $row3 =
        [
            'category_id' => 3,
            'category_name' => 'TÂM LÝ - KỸ NĂNG SỐNG',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row3);

        $row4 =
        [
            'category_id' => 4,
            'category_name' => 'NUÔI DẠY CON',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row4);

        $row5 =
        [
            'category_id' => 5,
            'category_name' => 'SÁCH THIẾU NHI',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row5);

        $row6 =
        [
            'category_id' => 6,
            'category_name' => 'TIỂU SỬ - HỒI KÝ',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row6);
        
      $row7
        = [
            'category_id' => 7,
            'category_name' => 'GIÁO KHOA THAM KHẢO',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row7);

        $row8 =
        [
            'category_id' => 8,
            'category_name' => 'SÁCH HỌC NGOẠI NGỮ',
            'description' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row8);


        //insert into categories
        DB::table('categories')->insert($List);
        

        
    }
}
