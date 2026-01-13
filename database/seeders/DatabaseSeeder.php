<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create();
        Category::factory()->count(10)->create();
        Banner::factory()->count(5)->create();
    }
}
