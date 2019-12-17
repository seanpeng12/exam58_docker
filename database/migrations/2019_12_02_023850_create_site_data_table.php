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
            $table->String('id', 45)->primary();
            $table->String('name', 120);
            $table->String('city_name', 15);
            $table->String('address', 150);
            $table->String('type', 45);
            $table->integer('comment');
            $table->float('rate');
            $table->String('href', 180);
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
