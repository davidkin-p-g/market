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
        Schema::create('quotas', function (Blueprint $table) {
            $table->id();
            $table->integer('BuyerId');
            $table->string('Buyer');
            $table->string('Name');
            $table->string('Text')->nullable();
            $table->string('QPublished')->nullable();
            $table->date('QPublishedDate')->nullable();
            $table->date('QRealizationDate')->nullable();
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
        Schema::dropIfExists('quotas');
    }
};
