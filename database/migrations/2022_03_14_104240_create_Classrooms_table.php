<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{

  public function up()
  {
    Schema::create('Classrooms', function (Blueprint $table) {
      $table->id();
      $table->string('Name_Class');
      $table->bigInteger('Grade_id')->unsigned();
      $table->foreign('Grade_id')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');
      $table->text('Notes')->nullable();
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::drop('Classrooms');
  }
}
