<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class AcademicYearsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ksn_academic_years')->insert([
            [
                'id' => 1,
                'academic_year' => '2019-20'
            ],
            [
                'id' => 2,
                'academic_year' => '2020-21'
            ],
        ]);
    }
}
