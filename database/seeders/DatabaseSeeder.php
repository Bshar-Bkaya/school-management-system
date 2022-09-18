<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\User::factory(10)->create();
    $this->call(CreateUserSeeder::class);
    $this->call(CreateDataSeeder::class);
    $this->call(CreateBloodTableSeeder::class);
    $this->call(CreateNationalitiesTableSeeder::class);
    $this->call(CreateReligionTableSeeder::class);
    $this->call(CreateGenderTableSeeder::class);
    $this->call(CreateSpecializationTableSeeder::class);
    $this->call(ParentsTableSeeder::class);
    $this->call(StudentsTableSeeder::class);
    $this->call(CreateSettingsSeeder::class);
  }
}
