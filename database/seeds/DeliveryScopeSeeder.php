<?php

use App\DeliveryScope;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryScopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DeliveryScope::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $delivery_scopes = array(
            array('id' => '1', 'name' => 'Watch only', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL),
            array('id' => '2', 'name' => 'Watch with original box', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL),
            array('id' => '3', 'name' => 'Watch with original papers', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL),
            array('id' => '4', 'name' => 'Watch with original box and original papers', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-18 04:48:26', 'deleted_at' => NULL)
        );
        DeliveryScope::insert($delivery_scopes);
    }
}
