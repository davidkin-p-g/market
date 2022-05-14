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
            $table->integer('SellerId');
            $table->string('SellerName');
            $table->integer('IdCategories');
            $table->string('ProdName');
            $table->integer('ProdCount');
            $table->float('ProdCost');
            $table->string('ProdText')->nullable();
            $table->string('ProdPublished')->nullable();
            $table->date('ProdPublishedDate')->nullable();
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
        Schema::dropIfExists('products');
    }
};
