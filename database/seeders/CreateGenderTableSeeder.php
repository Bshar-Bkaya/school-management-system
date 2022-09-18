<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateGenderTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('Genders')->delete();

    $genders = [
      ['en' => 'Male', 'ar' => 'ذكر'],
      ['en' => 'Female', 'ar' => 'انثى'],
    ];

    foreach ($genders as $gender) {
      Gender::create([
        'Name' => $gender,
      ]);
    }
  }
}
