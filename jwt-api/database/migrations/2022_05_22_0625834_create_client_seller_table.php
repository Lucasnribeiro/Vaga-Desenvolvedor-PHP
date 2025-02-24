<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_seller', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients')->cascadeOnDelete();
            $table->foreignId('seller_id')->references('id')->on('sellers')->cascadeOnDelete();
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
        Schema::dropIfExists('client_seller');
    }
}
