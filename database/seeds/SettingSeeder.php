<?php

use App\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Setting::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $settings = array(
            array('id' => '1', 'type' => 'header', 'field_type' => 'text', 'name' => 'title', 'value' => 'Time piece', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:44:54', 'deleted_at' => NULL),
            array('id' => '2', 'type' => 'footer', 'field_type' => 'text', 'name' => 'address', 'value' => '123 Main Street, Anytown,CA 12345 - USA.', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:55:35', 'deleted_at' => NULL),
            array('id' => '3', 'type' => 'footer', 'field_type' => 'text', 'name' => 'phone_no', 'value' => '(012) 800 000 789', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:55:35', 'deleted_at' => NULL),
            array('id' => '4', 'type' => 'footer', 'field_type' => 'text', 'name' => 'fax_no', 'value' => '(012) 800 888 789', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:55:35', 'deleted_at' => NULL),
            array('id' => '5', 'type' => 'footer', 'field_type' => 'text', 'name' => 'company_email', 'value' => 'demo@hashthemes.com', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:55:35', 'deleted_at' => NULL),
            array('id' => '6', 'type' => 'header', 'field_type' => 'text', 'name' => 'address', 'value' => '123 Main Street, Anytown,CA 12345 - USA.', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:54:38', 'deleted_at' => NULL),
            array('id' => '7', 'type' => 'header', 'field_type' => 'text', 'name' => 'phone_no', 'value' => '(012) 800 000 789', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:54:38', 'deleted_at' => NULL),
            array('id' => '8', 'type' => 'header', 'field_type' => 'text', 'name' => 'fax_no', 'value' => '(012) 800 888 789', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:54:38', 'deleted_at' => NULL),
            array('id' => '9', 'type' => 'header', 'field_type' => 'text', 'name' => 'company_email', 'value' => 'demo@hashthemes.com', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:54:38', 'deleted_at' => NULL),
            array('id' => '11', 'type' => 'header', 'field_type' => 'textarea', 'name' => 'description', 'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and s', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:44:54', 'deleted_at' => NULL),
            array('id' => '12', 'type' => 'header', 'field_type' => 'text', 'name' => 'new_title', 'value' => 'Time piece', 'updated_by' => NULL, 'created_at' => '2019-09-18 04:48:26', 'updated_at' => '2019-09-19 05:44:54', 'deleted_at' => NULL)
        );
        Setting::insert($settings);
    }
}
