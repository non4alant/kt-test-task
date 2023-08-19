<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipment')->insert([
            'type_id' => rand(1,4),
            'serial_number' => Str::random(10) . rand(1,10) . Str::random(10),
            'comment' => 'Comment test ' . Str::random(20)
        ]);
    }
}
