<?php

namespace Database\Seeders;

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
        $this->call(
            [
                CatalogSeeder::class,
                LegalSeeder::class,
                UserSeeder::class,
                ClientSeeder::class,
                GoalSeeder::class,
                QuestionSeeder::class,
                AudiosSeeder::class,
                UpdateCategoryProgramSeeder::class
            ]
        );
    }
}
