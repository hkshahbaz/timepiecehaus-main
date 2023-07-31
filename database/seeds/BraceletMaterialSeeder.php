<?php

use App\BraceletMaterial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BraceletMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        BraceletMaterial::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $bracelet_materials = array(
            array('id' => '1','name' => ' Aluminium','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '2','name' => ' Calf skin','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '3','name' => ' Ceramic','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '4','name' => ' Crocodile skin','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '5','name' => ' Gold/Steel','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '6','name' => ' Leather','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '7','name' => ' Lizard skin','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '8','name' => ' Ostrich skin','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '9','name' => ' Pink gold','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '10','name' => ' Plastic','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '11','name' => ' Platinum','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '12','name' => ' Rose gold','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '13','name' => ' Rubber','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '14','name' => ' Satin','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '15','name' => ' Shark skin','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '16','name' => ' Silicon','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '17','name' => ' Silver','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '18','name' => ' Snake skin','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '19','name' => ' Steel','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '20','name' => ' Textile','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '21','name' => ' Titanium','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '22','name' => ' White gold','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL),
            array('id' => '23','name' => ' Yellow gold','status_id' => '1','created_at' => '2019-09-20 06:39:46','updated_at' => '2019-09-20 06:39:46','deleted_at' => NULL)
        );
        BraceletMaterial::insert($bracelet_materials);
    }
}
