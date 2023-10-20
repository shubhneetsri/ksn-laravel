<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class KsnFeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ksn_fee_details')->insert([
            [
                'id' => 1,
                'academic_year_id' => 1,
                'admission_fee' => 1000,
                'development_fee' => 2000,
                'other' => 1000,
                'monthly_fee' => 500,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'id' => 2,
                'academic_year_id' => 2,
                'admission_fee' => 1000,
                'development_fee' => 2000,
                'other' => 1000,
                'monthly_fee' => 500,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
        ]);
    }
}
