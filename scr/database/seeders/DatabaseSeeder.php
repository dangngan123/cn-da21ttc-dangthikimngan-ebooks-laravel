<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this ->call(CategorySeeder::class);
        $this ->call(SupplierSeeder::class);
        $this ->call(AuthorSeeder::class);
        $this ->call(PublishSeeder::class);
        $this ->call(BookSeeder::class);
    }
}
