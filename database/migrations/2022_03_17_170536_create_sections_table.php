<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sections', function (Blueprint $table) {
      $table->id();
      $table->string("Name");
      $table->integer("Status");
      $table->unsignedBigInteger("classroom_id");
      $table->foreign("classroom_id")->references("id")->on("classrooms");
      $table->unsignedBigInteger("grade_id");
      $table->foreign("grade_id")->references("id")->on("grades");
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
    Schema::dropIfExists('sections');
  }
}
