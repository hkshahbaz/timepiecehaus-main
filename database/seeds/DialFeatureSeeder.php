<?php

use App\DialFeature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DialFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DialFeature::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $dial_features = array(
            array('id' => '1', 'name' => 'Guilloche Dial', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '2', 'name' => 'Guilloche Dial (handwork)', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '3', 'name' => 'Luminescent Numerals', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '4', 'name' => 'Luminous indexes', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL)
        );
        DialFeature::insert($dial_features);
    }
}
