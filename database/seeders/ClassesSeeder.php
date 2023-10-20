<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ksn_classes')->insert([
            [
                'id' => 1,
                'name' => 'NC',
                'roman_name' => 'NC',
                'number_name' => -1,
            ],
            [
                'id' => 2,
                'name' => 'KG',
                'roman_name' => 'KG',
                'number_name' => 0,
            ],
            [
                'id' => 3,
                'name' => 'Ist',
                'roman_name' => 'I',
                'number_name' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Second',
                'roman_name' => 'II',
                'number_name' => 2,
            ],
            [
                'id' => 5,
                'name' => 'Third',
                'roman_name' => 'III',
                'number_name' => 3,
            ],
            [
                'id' => 6,
                'name' => 'Four',
                'roman_name' => 'IV',
                'number_name' => 4,
            ],
            [
                'id' => 7,
                'name' => 'Five',
                'roman_name' => 'V',
                'number_name' => 5,
            ],
            [
                'id' => 8,
                'name' => 'Six',
                'roman_name' => 'VI',
                'number_name' => 6,
            ],
            [
                'id' => 9,
                'name' => 'Seaven',
                'roman_name' => 'VII',
                'number_name' => 7,
            ],
            [
                'id' => 10,
                'name' => 'Eight',
                'roman_name' => 'VIII',
                'number_name' => 8,
            ]

        ]);
    }
}
