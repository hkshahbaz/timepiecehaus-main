<?php

use App\MoreSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusSeeder::class);
        exit;
        $this->call(BraceletMaterialSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(DialFeatureSeeder::class);
        $this->call(HandDetialSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(MoreSettingSeeder::class);
        $this->call(ClaspMeterialrSeedere::class);
        $this->call(BraceleColorSeedere::class);
        $this->call(DialSeeder::class);
        $this->call(DialNumeralSeeder::class);
        $this->call(ClaspSeeder::class);
        $this->call(WaterResistanceSeeder::class);
        $this->call(GlassTypeSeeder::class);
        $this->call(CaseMaterialSeeder::class);
//        $this->call(StatusSeeder::class);
    }
}
