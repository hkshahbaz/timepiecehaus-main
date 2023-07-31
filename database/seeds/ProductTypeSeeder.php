<?php

use App\ProductType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $product_types = array(
            array('id' => '1', 'name' => 'Wristwatch', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '2', 'name' => 'Pocket watch', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL),
            array('id' => '3', 'name' => 'Other watch', 'status_id' => '1', 'created_at' => '2019-09-18 04:48:21', 'updated_at' => '2019-09-18 04:48:21', 'deleted_at' => NULL)
        );
        ProductType::insert($product_types);
    }
}
