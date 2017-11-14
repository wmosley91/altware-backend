<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Softwares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softwares', function(Blueprint $table){
          $table->increments('id');
          $table->integer('categoryID');
          $table->string('topicTitle');
          $table->string('brandName');
          $table->string('brandImg');
          $table->string('brandLink');
          $table->string('altName');
          $table->string('altImg');
          $table->string('altLink');
          $table->longText('brandReason');
          $table->longText('altReason');
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
        //
    }
}
