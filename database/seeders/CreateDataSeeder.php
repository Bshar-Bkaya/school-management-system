<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Section;
use App\Models\Classroom;
use App\Models\grade\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class CreateDataSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Remove Old Data
    DB::table('Grades')->delete();
    DB::table('Classrooms')->delete();
    DB::table('sections')->delete();


    $faker = Factory::create('ar_SA');

    for ($i = 1; $i <= 10; $i++) {

      // Grade
      $Grade = new Grade;
      $Grade->setTranslation('Name', 'ar', ' مرحلة' . $i);
      $Grade->setTranslation('Name', 'en', 'grade ' . $i);
      $Grade->Notes = $faker->text(mt_rand(10,  55));
      $Grade->save();

      // Classroom
      $Classroom = new Classroom;
      $Classroom->setTranslation('Name_Class', 'ar', ' صف' . $i);
      $Classroom->setTranslation('Name_Class', 'en', 'class ' . $i);
      $Classroom->Grade_id = $Grade->id;
      $Classroom->Notes = $faker->text(mt_rand(10,  55));
      $Classroom->save();


      //Section
      $Section = new Section;
      $Section->setTranslation('Name', 'ar', ' قسم' . $i);
      $Section->setTranslation('Name', 'en', 'section ' . $i);
      $Section->grade_id = $Grade->id;
      $Section->classroom_id = $Classroom->id;
      $Section->Status = mt_rand(0,  1);
      $Section->save();
    }
  }
}
