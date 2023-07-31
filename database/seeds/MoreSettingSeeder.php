<?php

use App\MoreSetting;
use App\ProductFunction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoreSettingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MoreSetting::truncate();
        ProductFunction::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $more_settings = array(
            array('id' => '1', 'type' => 'Caliber', 'name' => 'Genevian Seal', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '2', 'type' => 'Caliber', 'name' => 'Chronometer', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '3', 'type' => 'Caliber', 'name' => 'Master Chronometer', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '4', 'type' => 'Case', 'name' => 'Display Back', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '5', 'type' => 'Case', 'name' => 'Gemstone', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '6', 'type' => 'Case', 'name' => 'PVD/DLC coating', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL)
        );

        MoreSetting::insert($more_settings);

        $product_functions = array(
            array('id' => '1','name' => 'Moon phase','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '2','name' => 'Minute Repeater','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '3','name' => 'Chronograph','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '4','name' => 'Double chronograph','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '5','name' => 'Flyback','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '6','name' => 'Panorama date','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '7','name' => 'Chiming clock','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '8','name' => 'Repeater','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '9','name' => 'Tourbillon','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '10','name' => 'Date','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '11','name' => 'Weekday','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '12','name' => 'Month','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '13','name' => 'Year','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '14','name' => 'Annual calendar','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '15','name' => '4-year calendar','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '16','name' => 'Perpetual calendar','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '17','name' => 'Alarm','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '18','name' => 'GMT','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '19','name' => 'Equation of time','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '20','name' => 'Jumping hour','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL),
            array('id' => '21','name' => 'Tachymeter','status_id' => '1','created_at' => '2019-09-12 04:44:50','updated_at' => '2019-09-12 04:44:50','deleted_at' => NULL)
        );

            ProductFunction::insert($product_functions);
    }
}
