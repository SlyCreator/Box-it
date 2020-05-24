<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            $table->string('tracking_code');
            $table->foreign('tracking_code')->references('tracking_code')
                ->on('orders')->onDelete('cascade');

            $table->string('arrival')->nullable();
            $table->string('arrival_at')->nullable();

            $table->string('departure')->nullable();
            $table->string('departure_at')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
