<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempCheckoutDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_checkout_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address1');
            $table->string('address2');
            $table->integer('post_code');
            $table->string('district');
            $table->string('state');
            $table->string('country');
            $table->text('notes')->nullable();
            $table->integer('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_checkout_data');
    }
}
