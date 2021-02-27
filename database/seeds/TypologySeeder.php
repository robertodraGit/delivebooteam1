<?php

use Illuminate\Database\Seeder;
use App\Typology;
use App\User;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $defaultTypologies = [
        'fritti',
        'antipasti',
        'primi piatti',
        'secondi piatti',
        'contorni',
        'dolci',
        'dessert',
        'bevande',
        'bibite',
        'alcolici'
      ];

      foreach ($defaultTypologies as $typology) {
        $newTypology = new Typology();
        $newTypology ->typology = $typology;
        $newTypology -> save();



        $restaurants = User::inRandomOrder()
        ->limit(rand(1,5)) ->get();

        $newTypology -> users() -> attach($restaurants);
      }

    }
}
