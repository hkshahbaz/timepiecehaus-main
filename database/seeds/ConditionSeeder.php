<?php

use App\Condition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Condition::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //
        $conditions = array(
            array('id' => '1', 'name' => 'Unworn(Mint condition, without signs of wear)', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL),
            array('id' => '2', 'name' => 'Very good (Worn with little to no signs of wear)', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL),
            array('id' => '3', 'name' => 'Good(Light signs of wear or scratches)', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL),
            array('id' => '4', 'name' => 'Fair(Obvious signs of wear or scratches)', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL),
            array('id' => '5', 'name' => 'Poor(Heavy signs of wear or scratches) ', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL),
            array('id' => '6', 'name' => 'Incomplete(Components missing, non-functional)', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL)
        );
        Condition::insert($conditions);
    }
}
