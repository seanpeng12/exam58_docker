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
            $table->String('from_id', 45);

            $table->Integer('to_id');
            $table->foreign('from_id')->references('id')->on('site_data');

            $table->foreign('to_id')->references('id')->on('site_attr');

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
