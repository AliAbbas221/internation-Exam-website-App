<?php

namespace Database\Seeders;

use App\Models\Code;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i =0 ;$i<20;$i++)
        {
            Code::create([
                'value' => Str::random(10),
                'collage_id'=>'1'
            ]);
            Code::create([
                'value' => Str::random(10),
                'collage_id'=>'2'
            ]);
            Code::create([
                'value' => Str::random(10),
                'collage_id'=>'3'
            ]);
            Code::create([
                'value' => Str::random(10),
                'collage_id'=>'4'
            ]);
            Code::create([
                'value' => Str::random(10),
                'collage_id'=>'5'
            ]);
            Code::create([
                'value' => Str::random(10),
                'collage_id'=>'6'
            ]);
        }
    }
}
