<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_relationship', function (Blueprint $table) {
            $table->increments('id');
            
            $table->String('from_id', 45);
            $table->foreign('from_id')->references('id')->on('site_data');
            $table->Integer('to_id');
            $table->foreign('to_id')->references('id')->on('site_attr');
            // $table->primary(['from_id', 'to_id']);

            // $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_relationship');
    }
}
