<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=>'الكليات الهندسية',
            'image'=>'images/ARCH.svg'
         ]);
        Category::create([
            'name'=>'الكليات الطبية',
            'image'=>'images/nurs.svg'
        ]);
         
    }
}
