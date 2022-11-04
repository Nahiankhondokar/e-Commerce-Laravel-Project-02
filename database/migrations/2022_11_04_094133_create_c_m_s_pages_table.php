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
        Schema::create('c_m_s_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desc') -> nullable();
            $table->string('url') -> nullable();
            $table->string('meta_title') -> nullable();
            $table->string('meta_desc') -> nullable();
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
        Schema::dropIfExists('c_m_s_pages');
    }
};
