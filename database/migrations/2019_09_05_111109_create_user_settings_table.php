<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');

            $table->boolean('stay_logged_in')->default(false);
            $table->boolean('dont_send_follow_up_emails')->default(false);
            $table->string('sorted_by')->default('relevance');

            $table->boolean('newsletter')->default(false);
            $table->boolean('live_auctions')->default(false);
            $table->boolean('listings_from_partners')->default(false);
            $table->boolean('guide')->default(false);
            $table->boolean('price_alarm')->default(false);
            $table->boolean('stay_up_to_date')->default(false);
            $table->string('preferred_language')->default('English');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_settings');
    }
}
