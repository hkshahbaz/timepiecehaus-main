<?php

use App\GlassType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GlassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        GlassType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //
        $glass_types = array(
            array('id' => '1', 'name' => 'Glass', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '2', 'name' => 'Mineral Glass', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '3', 'name' => 'Plastic', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '4', 'name' => 'Plexiglass', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL),
            array('id' => '5', 'name' => 'Sapphire Glass', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:24', 'updated_at' => '2019-09-18 04:48:24', 'deleted_at' => NULL)
        );

        GlassType::insert($glass_types);
    }
}
