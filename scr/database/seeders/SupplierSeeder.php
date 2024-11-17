<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
/*************  ✨ Codeium Command 🌟  *************/
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Define the list of suppliers
       $List = [];
        $Suppliers1 =  [
             'supplier_id' => '1',
             'supplier_name' => 'Nhã Nam',
             'created_at' => now(),
             'updated_at' => now(),

        ];
        array_push($List, $Suppliers1);
        $Suppliers2 =  [
            'supplier_id' => '2',
            'supplier_name' => 'NXB Trẻ',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $Suppliers2);

       $Suppliers3 =  [    
        'supplier_id' => '3',
        'supplier_name' => 'Đinh Tị Books',
        'created_at' => now(),
        'updated_at' => now(),

        ];
        array_push($List, $Suppliers3);

       $Suppliers4 =  [
             'supplier_id' => '4',
             'supplier_name' => 'NXB Kim Đồng',
             'created_at' => now(),
             'updated_at' => now(),

        ];
        array_push($List, $Suppliers4);

        $Suppliers5 =  [
            'supplier_id' => '5',
            'supplier_name' => 'NXB Tổng Hợp TPHCM',
            'created_at' => now(),
            'updated_at' => now(),

       ];
       array_push($List, $Suppliers5);

       $Suppliers6 =  [
        'supplier_id' => '6',
        'supplier_name' => 'Thái Hà Books',
        'created_at' => now(),
        'updated_at' => now(),

        ];
        array_push($List, $Suppliers6);
        
        $Suppliers7 =  [
            'supplier_id' => '7',  
            'supplier_name' => 'Huy Hoàng Bookstore',
            'created_at' => now(),
            'updated_at' => now(),
    
            ];
        array_push($List, $Suppliers7);
        $Suppliers8 =  [
        'supplier_id' => '8',
        'supplier_name' => 'Saigon Books',
        'created_at' => now(),
        'updated_at' => now(),
        ];   
        array_push($List, $Suppliers8);
         DB::table('suppliers')->insert($List);

        }
        
    }

