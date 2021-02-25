<?php

use Illuminate\Database\Seeder;
use App\Plate;

class PlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $newPlate = new Plate();
      $newPlate -> nome = "Piadina dell'amore";
      $newPlate -> ingredienti = "['zucchine', 'carciofi', 'uova']";
      $newPlate -> descrizione = 'Pancia mia fatti capanna';
      $newPlate -> prezzo = 10;
      $newPlate -> visibile = 1;
      $newPlate -> sconto = 5;
      $newPlate -> disponibile = 1;
      $newPlate -> immagine = 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fprimochef.it%2Fcome-fare-piadina-romagnola-fatta-in-casa%2Fcome-fare%2F&psig=AOvVaw0PNzeNLpgSaw7q8-l-DpOO&ust=1614276722717000&source=images&cd=vfe&ved=0CAYQjRxqFwoTCPi35ciPg-8CFQAAAAAdAAAAABAJ';
      $newPlate -> save();
    }
}
