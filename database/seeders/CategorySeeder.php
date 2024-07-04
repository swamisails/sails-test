<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryArr = ['Sports', 'Education', 'Finance', 'IT', 'Jobs', 'Travelling', 'Medical'];
        foreach ($categoryArr as $key => $value) {
            $category = new Category();
            $checkCategory = $category->where('category', $value)->first();
            if (!$checkCategory) {
                $categorySave = new Category();
                $categorySave->category = $value;
                $categorySave->save();
            }
        } 
    }
}
