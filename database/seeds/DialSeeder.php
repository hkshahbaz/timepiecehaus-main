<?php

use App\Dial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Dial::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $dials = array(
            array('id' => '1', 'name' => 'Black', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '2', 'name' => 'Blue', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '3', 'name' => 'Bordeaux', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '4', 'name' => 'Bronze', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '5', 'name' => 'Brown', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '6', 'name' => 'Champagne', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '7', 'name' => 'Gold', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '8', 'name' => 'Gold (solid)', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '9', 'name' => 'Green', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '10', 'name' => 'Grey', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '11', 'name' => 'Mother of pearl', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '12', 'name' => 'Orange', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '13', 'name' => 'Pink', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '14', 'name' => 'Purple', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '15', 'name' => 'Red', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '16', 'name' => 'Silver', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '17', 'name' => 'Silver (solid)', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '18', 'name' => 'Transparent', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '19', 'name' => 'White', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL),
            array('id' => '20', 'name' => 'Yellow', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:23', 'updated_at' => '2019-09-18 04:48:23', 'deleted_at' => NULL)
        );
        Dial::insert($dials);
    }
}
