<?php

use App\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Status::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $statuses = array(
            array('id' => '1', 'type' => 'active-inactive', 'name' => 'Active', 'background_color' => 'label-success', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:20', 'updated_at' => '2019-09-19 07:37:20', 'deleted_at' => NULL),
            array('id' => '2', 'type' => 'active-inactive', 'name' => 'Inactive', 'background_color' => 'label-danger', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:20', 'updated_at' => '2019-09-19 07:37:20', 'deleted_at' => NULL),
            array('id' => '3', 'type' => 'product-availability-status', 'name' => 'Available now', 'background_color' => 'label-success bg-slate', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:20', 'updated_at' => '2019-09-19 07:37:20', 'deleted_at' => NULL),
            array('id' => '4', 'type' => 'product-availability-status', 'name' => 'Not Available', 'background_color' => 'label-default', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:20', 'updated_at' => '2019-09-19 07:37:20', 'deleted_at' => NULL),
            array('id' => '5', 'type' => 'product-availability-status', 'name' => 'Disabled', 'background_color' => 'label-danger', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '6', 'type' => 'product-availability-status', 'name' => 'Banned', 'background_color' => 'label-warning', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '7', 'type' => 'suspicious-product-report', 'name' => 'Pending', 'background_color' => 'label-default', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '8', 'type' => 'suspicious-product-report', 'name' => 'Viewed', 'background_color' => 'label-success bg-slate', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '9', 'type' => 'suspicious-product-report', 'name' => 'Canceled', 'background_color' => 'label-danger', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '10', 'type' => 'suspicious-product-report', 'name' => 'Complete', 'background_color' => 'label-success', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '11', 'type' => 'order-status', 'name' => 'Pending', 'background_color' => 'label-success bg-slate', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '12', 'type' => 'order-status', 'name' => 'Approved', 'background_color' => 'label-success', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '13', 'type' => 'order-status', 'name' => 'Rejected', 'background_color' => 'label-success', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '14', 'type' => 'order-status', 'name' => 'Payed', 'background_color' => 'label-danger', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '15', 'type' => 'order-status', 'name' => 'Delivered', 'background_color' => 'label-info', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '16', 'type' => 'order-status', 'name' => 'Received', 'background_color' => 'label-success', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL),
            array('id' => '17', 'type' => 'order-status', 'name' => 'Completed', 'background_color' => 'label-success', 'status' => 'Active', 'created_at' => '2019-09-19 07:37:21', 'updated_at' => '2019-09-19 07:37:21', 'deleted_at' => NULL)
        );
        Status::insert($statuses);
    }
}
