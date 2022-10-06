<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('product_name');
            $table->integer('category_id');
            $table->integer('section_id');
            $table->string('product_code');
            $table->string('product_color');
            $table->double('product_price');
            $table->double('product_discount') -> nullable();
            $table->double('product_weight') -> nullable();
            $table->string('product_video') -> nullable();
            $table->string('main_image') -> nullable();
            $table->longText('description') -> nullable();;
            $table->string('wash_care') -> nullable();
            $table->string('fabric') -> nullable();
            $table->string('pattern') -> nullable();
            $table->string('sleeve') -> nullable();
            $table->string('fit') -> nullable();
            $table->string('occassion') -> nullable();
            $table->string('meta_title') -> nullable();
            $table->string('meta_desc') -> nullable();
            $table->string('meta_keyword') -> nullable();
            $table->enum('is_featured', ['No', 'Yes']);
            $table->boolean('status') -> default(1);
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
};
