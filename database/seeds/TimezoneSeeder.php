<?php

use App\Timezone;
use Illuminate\Database\Seeder;

class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Timezone::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $timezones = array(
            array('id' => '1', 'name' => '(UTC -12:00) Coordinated Universal Time -12', 'identifier' => 'UTC-12:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '2', 'name' => '(UTC -11:00) Pago Pago', 'identifier' => 'UTC-11:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '3', 'name' => '(UTC -10:00) Papeete, Honolulu', 'identifier' => 'UTC-10:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '4', 'name' => '(UTC -09:00) Anchorage', 'identifier' => 'UTC-09:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '5', 'name' => '(UTC -08:00) Los Angeles, Vancouver, Tijuana', 'identifier' => 'UTC-08:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '6', 'name' => '(UTC -07:00) Phoenix, Calgary, Ciudad Juárez', 'identifier' => 'UTC-07:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '7', 'name' => '(UTC -06:00) Chicago, Mexico City, Guatemala City, San José, San Salvador, Winnipeg', 'identifier' => 'UTC-06:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '8', 'name' => '(UTC -05:00) New York, Toronto, Lima, Bogotá, Havana, Kingston', 'identifier' => 'UTC-05:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '9', 'name' => '(UTC -04:00) Caracas, Santiago, Halifax, La Paz, Manaus, Santo Domingo', 'identifier' => 'UTC-04:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '10', 'name' => '(UTC -03:00) Buenos Aires, Montevideo, Sao Paulo', 'identifier' => 'UTC-03:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '11', 'name' => '(UTC -02:00) Coordinated Universal Time -2', 'identifier' => 'UTC-02:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '12', 'name' => '(UTC -01:00) Praia', 'identifier' => 'UTC-01:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '13', 'name' => '(UTC +00:00) London, Dublin, Lisbon, Casablanca, Dakar, Accra', 'identifier' => 'UTC+00:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '14', 'name' => '(UTC +01:00) Berlin, Paris, Madrid, Rome, Vienna, Warsaw, Lagos, Tunis', 'identifier' => 'UTC+01:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '15', 'name' => '(UTC +02:00) Athens, Bucharest, Cairo, Helsinki, Kiev, Jerusalem, Johannesburg', 'identifier' => 'UTC+02:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '16', 'name' => '(UTC +03:00) Istanbul, Moscow, Nairobi, Doha, Minsk, Riyadh, Bagdad', 'identifier' => 'UTC+03:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '17', 'name' => '(UTC +04:00) Dubai, Mucscat, Baku, Samara', 'identifier' => 'UTC+04:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '18', 'name' => '(UTC +05:00) Karachi, Tashkent, Yekaterinburg', 'identifier' => 'UTC+05:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '19', 'name' => '(UTC +06:00) Almaty, Dhaka, Omsk', 'identifier' => 'UTC+06:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '20', 'name' => '(UTC +07:00) Bangkok, Jakarta, Ho Chi Minh City, Krasnoyarsk', 'identifier' => 'UTC+07:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '21', 'name' => '(UTC +08:00) Hong Kong, Singapore, Beijing, Taipei, Kuala Lumpur, Perth, Denpasar, Manila, Irkutsk', 'identifier' => 'UTC+08:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '22', 'name' => '(UTC +09:00) Tokyo, Seoul, Ambon, Yakutsk', 'identifier' => 'UTC+09:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '23', 'name' => '(UTC +10:00) Brisbane, Port Moresby, Vladivostok', 'identifier' => 'UTC+10:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '24', 'name' => '(UTC +11:00) Sydney, Nouméa', 'identifier' => 'UTC+11:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:25', 'updated_at' => '2019-09-20 06:31:25', 'deleted_at' => NULL),
            array('id' => '25', 'name' => '(UTC +12:00) Auckland, Suva', 'identifier' => 'UTC+12:00', 'status_id' => '1', 'created_at' => '2019-09-20 06:31:26', 'updated_at' => '2019-09-20 06:31:26', 'deleted_at' => NULL)
        );
        Timezone::insert($timezones);
    }
}
