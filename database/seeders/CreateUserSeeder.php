<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->delete();

    User::create([
      "name" => "Bshar",
      "email" => "bashar@gmail.com",
      "password" => bcrypt("basharnew"),  // 'password' => Hash::make('p@ssw0rd'),
    ]);
  }
}
