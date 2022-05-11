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
        Schema::create('quotas_items', function (Blueprint $table) {
            $table->id();
            $table->integer('QuotasId');
            $table->string('IdCategories');
            $table->string('ItemName');
            $table->integer('ItemCount');
            $table->float('ItemCost');
            $table->string('ItemText')->nullable();
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
        Schema::dropIfExists('quotas_items');
    }
};
