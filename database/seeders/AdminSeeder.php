<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'user_name'=>'admin',
            'phone' =>'0987654321',
            'role' =>'admin',
            'image' => 'ic_user.svg'
        ]);
        Code::create([
            'value' => Str::random(10),
            'user_id'=>$admin->id
        ]);
    }
}
