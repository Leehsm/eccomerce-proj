<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('subsubcategory_id')->nullable();
            $table->string('product_name_en');
            $table->string('product_name_my')->nullable();
            $table->string('product_slug_en');
            $table->string('product_slug_my')->nullable();
            $table->string('product_code');
            $table->integer('product_qty')->nullable();
            $table->string('product_tags_en')->nullable();
            $table->string('product_tags_my')->nullable();
            $table->string('product_size_en')->nullable();
            $table->string('product_size_my')->nullable();
            $table->string('product_color_en')->nullable();
            $table->string('product_color_my')->nullable();
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('short_desc_en');
            $table->string('short_desc_my')->nullable();
            $table->string('long_desc_en');
            $table->string('long_desc_my')->nullable();
            $table->string('product_thambnail');
            $table->string('size_chart')->nullable();
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
            // $table->integer('new_arrival')->nullable();
            // $table->integer('best_seller')->nullable();
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
        Schema::dropIfExists('products');
    }
}
