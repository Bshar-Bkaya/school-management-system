<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateReligionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('religions')->delete();


    $religions = [
      [
        'en' => 'Muslim',
        'ar' => 'مسلم'
      ],
      [
        'en' => 'Christian',
        'ar' => 'مسيحي'
      ],
      [
        'en' => 'Other',
        'ar' => 'غيرذلك'
      ],
    ];

    foreach ($religions as $r) {
      Religion::create(['Name' => $r]);
    }
  }
}
