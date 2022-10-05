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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->integer('parent_id') -> nullable();
            $table->integer('section_id') -> nullable();
            $table->string('category_image') -> nullable();
            $table->float('category_discount') -> nullable();
            $table->string('description') -> nullable();
            $table->string('url') -> nullable();
            $table->string('meta_title') -> nullable();
            $table->string('meta_description') -> nullable();
            $table->string('meta_keyword') -> nullable();
            $table->tinyInteger('status') -> default(1);
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
        Schema::dropIfExists('categories');
    }
};
