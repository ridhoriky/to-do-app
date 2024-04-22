<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use faker\factory as Faker;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("id_ID");

        for ($i = 0; $i < 10; $i++) {
            DB::table("tasks")->insert([
                "item" => $faker->sentence(),
            ]);
        }
    }
}
