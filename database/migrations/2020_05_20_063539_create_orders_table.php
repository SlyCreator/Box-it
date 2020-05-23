<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('sent_from');
            $table->string('weight_in_kg')->default('0');
            $table->string('height_in_m')->default('0');
            $table->string('length_in_m')->default('0');

            $table->unsignedBigInteger('service_type_id');
            $table->foreign('service_type_id')->references('id')
                ->on('service_types')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->default(1);
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
