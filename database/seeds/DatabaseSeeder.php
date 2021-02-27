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

      // user
      // orders
      // categories
      // typologies
      // plate
      // order_plate
      // typology_user
      // feedback

      $this->call([
        UserSeeder::class,
        OrderSeeder::class,
        CategorySeeder::class,
        TypologySeeder::class,
        PlateSeeder::class,
        FeedbackSeeder::class,
      ]);
    }
}
