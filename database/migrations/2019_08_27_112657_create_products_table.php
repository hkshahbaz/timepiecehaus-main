<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->comment('vendor');

            $table->string('name');
            $table->longText('description');
            $table->float('price');
            $table->float('shipping_cost')->default(0);

            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('modal');
            $table->float('listing_fee')->default(NULL)->nullable();
            $table->string('reference_number')->nullable()->default(NULL);
            $table->unsignedBigInteger('condition_id');
            $table->unsignedBigInteger('delivery_scope_id');
            $table->string('gender');
            $table->year('year_of_production')->nullable()->default(NULL);
            $table->boolean('approximation_unknown')->default(0);
            $table->float('case_diameter_length')->default(0)->nullable();
            $table->float('case_diameter_width')->default(0)->nullable();
            $table->unsignedBigInteger('movement_id')->nullable()->default(NULL);

            $table->unsignedBigInteger('country_id');

            $table->unsignedBigInteger('no_of_views')->default(0);
            $table->unsignedBigInteger('status_id')->comment('available or not');

            $table->boolean('is_draft')->default(1)->comment('draft or not');

            /* Caliber Options */
            $table->string('movement_caliber')->nullable()->default(NULL);
            $table->string('base_caliber')->nullable()->default(NULL);
            $table->text('power_reserve')->nullable()->default(NULL);
            $table->unsignedBigInteger('number_of_jewels')->nullable()->default(NULL);
            $table->string('frequency')->nullable()->default(NULL);
            $table->string('frequency_measurement')->nullable()->default(NULL);

            /* Case Options */
            $table->unsignedBigInteger('case_material_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('bezel_material_id')->nullable()->default(NULL);
            $table->float('thickness')->nullable()->default(NULL);
            $table->unsignedBigInteger('glass_type_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('water_resistance_id')->nullable()->default(NULL);

            /* Dial and Hands Options */
            $table->unsignedBigInteger('dial_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('dial_numeral_id')->nullable()->default(NULL);

            /* Bracelet/Strap Options */
            $table->unsignedBigInteger('bracelet_material_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('bracelet_color_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('clasp_type_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('clasp_material_id')->nullable()->default(NULL);

            $table->unsignedBigInteger('no_of_sales')->default(0);
            $table->double('rating', 8, 2)->default(0);

            $table->string('paypal_payer_id')->nullable()->default(NULL);
            $table->string('paypal_order_id')->nullable()->default(NULL);
            $table->timestamp('completed_at')->default(NULL)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
