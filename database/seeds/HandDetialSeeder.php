<?php

use App\HandDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HandDetialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        HandDetail::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $hand_details = array(
            array('id' => '1', 'name' => 'Center Seconds', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '2', 'name' => 'Small Seconds', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '3', 'name' => 'Luminescent Hands', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '4', 'name' => 'Blue Steel Hands', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL)
        );
        HandDetail::insert($hand_details);
    }
}
