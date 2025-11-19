<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UpdateCategoryWWSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Update category id 7 'Work and wellness, Lifefullness Health' to Lifefullness Health
        DB::table('categories')
            ->where('id', 7)
            ->update([
                'name' => 'Lifefullness Health',
            ]);
        // Add category Work and Wellness
        DB::table('categories')->insert([
            'name' => 'Work and Wellness',
            'url_image' => '/assets/image/wwlh.png',
            'description' => 'Escaneo corporal para comenzar a meditar...',
            'active' => true,
            'url_manual' => '/assets/files/anexo26.pdf',
            'duration' => null,
        ]);
        // update category_program id 11 to Work and Wellness
        DB::table('category_program')
            ->where('id', 11)
            ->update([
                'category_id' => 10,
            ]);
        // Update phase id 24 to Work and Wellness category
        DB::table('phases')
            ->where('id', 24)
            ->update([
                'category_id' => 10,
            ]);
    }
}
