<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use DB;

class UpdateCategoryProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->updateCategoryProgram();
    }

    function updateCategoryProgram()
    {
        DB::table('category_program')->where('id', 11)->update(['category_id'=> Category::LIFE_FULLNESS_HEALTH]);
    }
}
