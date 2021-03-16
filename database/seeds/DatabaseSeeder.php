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
      $this->call([
        CategorySeeder::class,
        TypologySeeder::class,
        UserSeeder::class,
        PlateSeeder::class,
        OrderSeeder::class,
        FeedbackSeeder::class,
        ImageSeeder::class,
      ]);
    }
}
