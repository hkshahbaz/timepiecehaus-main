<?php

use App\Movement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Movement::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $movements = array(
            array('id' => '1', 'name' => 'Automatic', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL),
            array('id' => '2', 'name' => 'Manual winding', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL),
            array('id' => '3', 'name' => 'Quartz', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL)
        );
        Movement::insert($movements);
    }
}
