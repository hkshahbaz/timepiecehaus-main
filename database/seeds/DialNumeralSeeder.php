<?php

use App\DialNumeral;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DialNumeralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DialNumeral::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $dial_numerals = array(
            array('id' => '1', 'name' => 'Arabic numerals', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '2', 'name' => 'No numerals', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '3', 'name' => 'Roman numerals', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL)
        );

        DialNumeral::insert($dial_numerals);
    }
}
