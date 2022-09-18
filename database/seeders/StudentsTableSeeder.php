<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\TypeBlood;
use App\Models\Grade\Grade;
use App\Models\MyParents;
use App\Models\Nationalitie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('students')->delete();

    $students = new Student();
    $students->name = ['ar' => 'احمد ابراهيم', 'en' => 'Ahmed Ibrahim'];
    $students->email = 'Ahmed_Ibrahim@yahoo.com';
    $students->password = Hash::make('12345678');
    $students->gender_id = 1;
    $students->nationalitie_id = Nationalitie::all()->unique()->random()->id;
    $students->blood_id = TypeBlood::all()->unique()->random()->id;
    $students->Date_Birth = date('1995-01-01');
    $students->Grade_id = Grade::all()->unique()->random()->id;
    $students->Classroom_id = Classroom::all()->unique()->random()->id;
    $students->section_id = Section::all()->unique()->random()->id;
    $students->parent_id = MyParents::all()->unique()->random()->id;
    $students->academic_year = '2022';
    $students->save();
  }
}
