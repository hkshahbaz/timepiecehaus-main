<?php

use App\BraceletColor;
use App\ClaspMaterial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClaspMeterialrSeedere extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ClaspMaterial::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $clasp_materials = array(
            array('id' => '1','name' => ' Aluminum','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '2','name' => ' Bronze','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '3','name' => ' Gold/Steel','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '4','name' => ' Plastic','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '5','name' => ' Platinum','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '6','name' => ' Red gold','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '7','name' => ' Rose Gold','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '8','name' => ' Silver','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '9','name' => ' Steel','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '10','name' => ' Titanium','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '11','name' => ' White Gold','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL),
            array('id' => '12','name' => ' Yellow gold','status_id' => '1','created_at' => '2019-09-18 04:48:22','updated_at' => '2019-09-18 04:48:22','deleted_at' => NULL)
        );
        ClaspMaterial::insert($clasp_materials);
    }
}
