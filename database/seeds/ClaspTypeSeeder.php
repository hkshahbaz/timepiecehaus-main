<?php

use App\ClaspType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClaspTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ClaspType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $clasp_types = array(
            array('id' => '1','name' => 'Buckle','status_id' => '1','created_at' => '2019-09-18 04:48:24','updated_at' => '2019-09-18 04:48:24','deleted_at' => NULL),
            array('id' => '2','name' => 'Double-fold clasp','status_id' => '1','created_at' => '2019-09-18 04:48:24','updated_at' => '2019-09-18 04:48:24','deleted_at' => NULL),
            array('id' => '3','name' => 'Fold clasp','status_id' => '1','created_at' => '2019-09-18 04:48:24','updated_at' => '2019-09-18 04:48:24','deleted_at' => NULL),
            array('id' => '4','name' => 'Fold clasp, hidden','status_id' => '1','created_at' => '2019-09-18 04:48:24','updated_at' => '2019-09-18 04:48:24','deleted_at' => NULL),
            array('id' => '5','name' => 'Jewelry clasp','status_id' => '1','created_at' => '2019-09-18 04:48:24','updated_at' => '2019-09-18 04:48:24','deleted_at' => NULL)
        );

        ClaspType::insert($clasp_types);
    }
}
