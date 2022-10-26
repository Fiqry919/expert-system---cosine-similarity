<?php

namespace Database\Seeders;

use App\Models\admin\Aturan;
use App\Models\admin\History;
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
        // \App\Models\User::factory(10)->create();
        History::factory(500)->create();
        Aturan::factory(10)->create();
    }
}
