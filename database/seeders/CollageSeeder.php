<?php

namespace Database\Seeders;

use App\Models\Collage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CollageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collage::create([
            'collage_name'=>'الهندسة المعلوماتية',
            'category_id' =>'1',
            'image' =>'images/It.svg'
        ]);
        Collage::create([
            'collage_name'=>' الهندسة المعمارية',
            'category_id' =>'1',
            'image' =>'images/ARCH.svg'
        ]);
        
        Collage::create([
            'collage_name'=>'الطب البشري',
            'category_id' =>'2',
            'image' =>'images/DR.svg'
        ]);
        Collage::create([
            'collage_name'=>'طب الاسنان',
            'category_id' =>'2',
            'image' =>'images/dentist.svg'
        ]);
        Collage::create([
            'collage_name'=>'الصيدلة',
            'category_id' =>'2',
            'image' =>'images/pharmacy.svg'
        ]);
        Collage::create([
            'collage_name'=>'التمريض',
            'category_id' =>'2',
            'image' =>'images/nurs.svg'
        ]);
    }
    
}
