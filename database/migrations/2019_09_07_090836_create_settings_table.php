<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('type')->comment('header,footer,about,contact-us');
            $table->string('field_type')->default('text');

            $table->string('name');
            $table->string('value');

            $table->unsignedBigInteger('updated_by')->nullable()->default(NULL);

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['type', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
