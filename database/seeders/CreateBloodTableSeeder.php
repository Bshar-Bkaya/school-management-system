<?php

namespace Database\Seeders;

use App\Models\TypeBlood;
use Mockery\Matcher\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateBloodTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('type_bloods')->delete();
    // TypeBlood::truncate();

    $bloods = ['O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'];

    foreach ($bloods as $blood) {
      TypeBlood::create(['Name' => $blood]);
    }
  }
}
