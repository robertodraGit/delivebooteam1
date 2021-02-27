<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{

    public function run()
    {
      factory(User::class, 80) -> create();
      // for ($i=0; $i < 50; $i++) {
      //
      //   $newUser = new User();
      //   $newUser->name = $faker->name;
      //   $newUser->email = $faker->unique()->safeEmail;
      //   $newUser->email_verified_at = now();
      //   $newUser->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
      //   $newUser->address = $faker ->unique()->streetAddress;
      //   $newUser->piva = $faker ->unique() ->bankAccountNumber;
      //   $newUser->phone = $faker->e164PhoneNumber;
      //   $newUser->description = $faker->words;
      //   $newUser->photo = null;
      //   $newUser->delivery_cost = rand(100,2000);
      //
      //   $newUser->save();
      // }
    }
}
