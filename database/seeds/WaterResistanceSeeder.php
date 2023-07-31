<?php

use App\WaterResistance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaterResistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        WaterResistance::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $water_resistances = array(
            array('id' => '1', 'name' => 'Not water resistant', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '2', 'name' => '1 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '3', 'name' => '2 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '4', 'name' => '2.5 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '5', 'name' => '3 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '6', 'name' => '4 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '7', 'name' => '5 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '8', 'name' => '6 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '9', 'name' => '7 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '10', 'name' => '8 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '11', 'name' => '9 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '12', 'name' => '10 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '13', 'name' => '15 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '14', 'name' => '20 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '15', 'name' => '30 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '16', 'name' => '40 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '17', 'name' => '50 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '18', 'name' => '60 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '19', 'name' => '70 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '20', 'name' => '80 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '21', 'name' => '90 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '22', 'name' => '100 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '23', 'name' => '110 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '24', 'name' => '120 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '25', 'name' => 'Over 120 ATM', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL)
        );

        WaterResistance::create($water_resistances);
    }
}
