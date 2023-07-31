<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('status_id')
                ->default(11)
                ->comment('11-pending, 12-approved, 13-rejected, 14-payed, 15-deliver, 16-received, 17-completed');

            $table->double('price', 8,2)->default(0);
            $table->double('shipping_cost', 8,2)->default(0);
            $table->string('message')->nullable()->default(NULL);

            $table->string('paypal_payer_id')->nullable()->default(NULL);
            $table->string('paypal_order_id')->nullable()->default(NULL);

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable()->default(NULL);
            $table->timestamps();

            $table->timestamp('approved_or_rejected_at')->nullable()->default(NULL);
            $table->timestamp('payment_done_at')->nullable()->default(NULL);
            $table->timestamp('deliver_at')->nullable()->default(NULL);
            $table->timestamp('received_at')->nullable()->default(NULL);
            $table->timestamp('completed_at')->nullable()->default(NULL);
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
        Schema::dropIfExists('orders');
    }
}
