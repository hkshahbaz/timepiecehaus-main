<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            /* Personal information */
            $table->string('picture')->nullable()->default('default-profile.png');
            $table->string('gender')->nullable()->default(NULL);
            $table->date('date_of_birth')->nullable()->default(NULL);
            $table->string('phone_no')->nullable()->default(NULL);
            $table->string('fax_no')->nullable()->default(NULL);
            $table->string('mobile_no')->nullable()->default(NULL);

            /* Address */
            $table->string('street')->nullable()->default(NULL);
            $table->string('street_line_2')->nullable()->default(NULL);
            $table->string('zip_code')->nullable()->default(NULL);
            $table->string('city')->nullable()->default(NULL);
            $table->string('state')->nullable()->default(NULL);
            $table->unsignedBigInteger('country_id')->nullable()->default(NULL);
            $table->boolean('display_name')->default(0)->nullable();
            $table->string('company')->nullable()->default(NULL);

            /* About Me */
            $table->string('occupation')->nullable()->default(NULL);
            $table->unsignedBigInteger('timezone_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('language_id')->nullable()->default(NULL);
            $table->longText('about')->nullable()->default(NULL);
            $table->boolean('is_verified')->default(0);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
