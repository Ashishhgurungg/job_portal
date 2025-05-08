<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // do this for not using model
        $categories = ['IT', 'Sales', 'Education', 'Finance','Health', 'Other'];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name'=> $category
            ]);
        }
        //Category:://do that

        //php artisan db:seed --class=CategorySeeder this is for cmd line code to run a specific seeder class like this category
        //php artisan db:seed runs all the seeder files/class
    }
}
