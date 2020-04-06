<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_data', function (Blueprint $table) {
            $table->String('id', 10)->primary();
            $table->String('name', 45);
            $table->String('city_name', 20);
            $table->String('address', 50);
            $table->String('type', 10);
            $table->integer('comment');
            $table->float('rate');
            $table->String('href', 100);
            $table->String('color', 10);
            $table->String('shape', 10);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_data');
    }
}
