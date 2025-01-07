<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteAttrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public $incrementing = false;
    public function up()
    {
        Schema::create('site_attr', function (Blueprint $table) {
            $table->Integer('id')->primary();
            $table->String('type', 45);
            $table->String('tag', 45);
            $table->String('color', 10);
            $table->String('shape', 10);
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
        Schema::dropIfExists('site_attr');
    }
}
