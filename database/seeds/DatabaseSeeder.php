<?php

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

      // UserSeeder::class,
      // OrderSeeder::class,
      // CategorySeeder::class,
      // TypologySeeder::class,
      // PlateSeeder::class,
      // FeedbackSeeder::class,

      $this->call([
        UserSeeder::class,
        CategorySeeder::class,
        TypologySeeder::class,
        PlateSeeder::class,
        OrderSeeder::class,
        FeedbackSeeder::class,
      ]);
    }
}
