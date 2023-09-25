<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $it_specialization = [
            'اوتومات',
            'المترجمات',
            'قواعد المعطيات',
            'الذكاء الاصطناعي',
            'هندسة البرمجيات',
            'خوارزميات',
            'امن المعلومات',
            'الشبكات',
            'داتابيز'

        ];
        $arch_specialization = [
            'تصميم معماري',
            'تخطيط مدن',
            'تاريخ العمارة',
            'تصميمات تنفيذية'
        ];
        $med_specialization = [
            'جراحة',
            'باطنية',
            'أطفال'
        ];
        foreach ($it_specialization as $it) {
            Specialization::create([
                'specialization_name' => $it,
                'collage_id' => '1'
            ]);
        }
        foreach ($arch_specialization as $arch) {
            Specialization::create([
                'specialization_name' => $arch,
                'collage_id' => '2'
            ]);
        }
        foreach ($med_specialization as $med) {
            Specialization::create([
                'specialization_name' => $med,
                'collage_id' => '3'
            ]);
        }
    }
}