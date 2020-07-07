<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['cat1','cat2','cat3'];
     foreach($categories as $category){

        Category::create([
    'ar'=>['name'=>$category],
    'en'=>['name'=>$category]
      ]);
     }
    }
}
