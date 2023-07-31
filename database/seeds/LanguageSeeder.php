<?php

use App\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Language::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $languages = array(
            array('id' => '1', 'name' => "Deutsch", 'abbreviation' => 'DE', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:04', 'updated_at' => '2019-09-20 06:25:04', 'deleted_at' => NULL),
            array('id' => '2', 'name' => "Español", 'abbreviation' => 'ES', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:04', 'updated_at' => '2019-09-20 06:25:04', 'deleted_at' => NULL),
            array('id' => '3', 'name' => "Français", 'abbreviation' => 'FR', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:04', 'updated_at' => '2019-09-20 06:25:04', 'deleted_at' => NULL),
            array('id' => '4', 'name' => "Italiano", 'abbreviation' => 'IT', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:04', 'updated_at' => '2019-09-20 06:25:04', 'deleted_at' => NULL),
            array('id' => '5', 'name' => "Nederlands", 'abbreviation' => 'NL', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:04', 'updated_at' => '2019-09-20 06:25:04', 'deleted_at' => NULL),
            array('id' => '6', 'name' => "English", 'abbreviation' => 'EN', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:04', 'updated_at' => '2019-09-20 06:25:04', 'deleted_at' => NULL),
            array('id' => '7', 'name' => "Português", 'abbreviation' => 'PT', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:04', 'updated_at' => '2019-09-20 06:25:04', 'deleted_at' => NULL),
            array('id' => '8', 'name' => "Česky", 'abbreviation' => 'CZ', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:04', 'updated_at' => '2019-09-20 06:25:04', 'deleted_at' => NULL),
            array('id' => '9', 'name' => "Dansk", 'abbreviation' => 'DA', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '10', 'name' => "ελληνική", 'abbreviation' => 'EL', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '11', 'name' => "Hrvatski", 'abbreviation' => 'HR', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '12', 'name' => "Magyar", 'abbreviation' => 'HU', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '13', 'name' => " Norsk" , 'abbreviation' => 'NO', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '14', 'name' => "Polski", 'abbreviation' => 'PL', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '15', 'name' => "Русский", 'abbreviation' => 'RU', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '16', 'name' => "Română", 'abbreviation' => 'RO', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '17', 'name' => "Svenska", 'abbreviation' => 'SE', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '18', 'name' => "Türkçe", 'abbreviation' => 'TR', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '19', 'name' => "中文(简体)", 'abbreviation' => 'CN', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '20', 'name' => "中文(繁體)", 'abbreviation' => 'HK', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '21', 'name' => "中文(繁體)", 'abbreviation' => 'TW', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '22', 'name' => "日本語", 'abbreviation' => 'JP', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
            array('id' => '23', 'name' => "한국어", 'abbreviation' => 'KO', 'status_id' => '1', 'created_at' => '2019-09-20 06:25:05', 'updated_at' => '2019-09-20 06:25:05', 'deleted_at' => NULL),
        );
        Language::insert($languages);
    }
}
