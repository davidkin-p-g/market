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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('ItemsId');
            $table->integer('ProductsId');
            $table->integer('SellerId');
            $table->integer('BuyerId');
            $table->boolean('SellerPublished')->nullable();
            $table->boolean('BuyerPublished')->nullable();
            $table->integer('OfferBuyerCount')->nullable();;
            $table->float('OfferBuyerCost')->nullable();;
            $table->integer('OfferSellerCount')->nullable();;
            $table->float('OfferSellerCost')->nullable();;
            $table->date('PublishedDate')->nullable();
            $table->boolean('isDelete')->default(0);
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
        Schema::dropIfExists('offers');
    }
};
