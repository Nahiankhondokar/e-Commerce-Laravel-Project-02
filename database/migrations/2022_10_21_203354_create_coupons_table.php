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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_option');
            $table->string('coupon_code');
            $table->text('categories');
            $table->text('users');
            $table->string('coupon_type') -> nullable();
            $table->string('amount_type') -> nullable();
            $table->float('amount') -> nullable();
            $table->date('expire_date');
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
        Schema::dropIfExists('coupons');
    }
};
