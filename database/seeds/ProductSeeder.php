<?php

use App\Product;
use App\ProductPicture;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        ProductPicture::truncate();
        DB::table('product_product_function')->truncate();
        DB::table('product_hand_detail')->truncate();
        DB::table('product_dial_feature')->truncate();
        DB::table('product_more_setting')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $product =
            ['user_id' => 2, 'name' => 'Rolex GMT-MASTER II Stainless Steel', 'product_category_id' => 1, 'product_type_id' => 2, 'brand_id' => 4,
                'modal' => 'GMT-Master II', 'reference_number' => '126710BLRO', 'condition_id' => 3,
                'delivery_scope_id' => 3, 'gender' => 'male', 'year_of_production' => '2018',
                'approximation_unknown' => 1, 'case_diameter_length' => '40', 'case_diameter_width' => '40', 'movement_id' => 3,
                'description' => 'The Rolex GMT-Master II was designed for the man whose work and play spans different time zones. If you are that man, you will experience the pleasure of a sturdy 40mm stainless-steel case that has a screw-down case back and winding crown. Enclosed in the case is the Rolex Calibre 3285, a self-winding mechanical movement with dual time-zone, stop second and date functionality. This caliber has a -2/+2 sec/day precision and has a power reserve of up to 70 hours. The dial is black with hour markers made from 18 carat gold to prevent tarnishing. The red and blue ceramic bezel is rotatable in both directions and has engraved numerals and graduations in a 24-hour inset. It has a jubilee bracelet in oystersteel with a folding oysterlock safetyclasp. It has a water resistance of up to 100 meters (330 feet). ',
                'price' => 17999, 'country_id' => 4, 'display_name' => 0, 'company_charges' => '170',
                'no_of_views' => 7, 'status_id' => 3, 'is_draft' => 0
            ];
        $productInsert = $product;

        for ($i = 1; $i < 3; $i++) {
            $name = $product['name'] . ' ' . $i;

            $productInsert['name'] = $name;
            $productInsert['no_of_views'] = $i;
            $product = Product::create($productInsert);
            for ($j = 0; $j < 4; $j++) {
                $productPicture = ['product_id' => $product->id, 'type' => 'product', 'picture' => 'picture_' . $j . $product->id . '.jpg'];
                ProductPicture::create($productPicture);
            }
            for ($k = 0; $k < 2; $k++) {
                $productOwnership = ['product_id' => $product->id, 'type' => 'ownership', 'picture' => 'picture_ownership_' . $k . $product->id . '.jpg'];
                ProductPicture::create($productOwnership);
            }

            $product->handDetails()->attach([1, 3]);
            $product->dialFeatures()->attach([2, 4]);
            $product->productFunctions()->attach([2, 4, 6, 8, 9, 10,15,21]);
            $product->caseMoreSettings()->attach([5]);
            $product->caliberMoreSettings()->attach([2,3]);
        }
    }
}
