<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $List = [];
        $row1 =
        [
            'publish_id' => 1,
            'publish_name' => 'NXB Hội Nhà Văn',
        ];
        array_push($List, $row1);
        $row2 =
        [
            'publish_id'=> 2,
            'publish_name'=> 'NXB Trẻ',
            ];
            array_push($List, $row2);
        $row3 =
        [
            'publish_id'=> 3,
            'publish_name'=> 'NXB Văn Học',
        ];
        array_push($List, $row3);
        DB::table('Publishers')->insert($List);

    }
}