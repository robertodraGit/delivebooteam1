<?php

namespace App\Http\Controllers;
use App\Plate;
use App\User;
use App\Feedback;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function getAllRestaurants() {
      $restaurants = User::all('users.id','users.name', 'users.address', 'users.phone', 'users.description', 'users.photo', 'users.delivery_cost');

      $restaurants = $this->addRestaurantInfo($restaurants);

      return response() -> json([
        'restaurants' => $restaurants
      ]);
    }

    public function getRestaurantsInit(){
      $restaurants = User::inRandomOrder()->limit(10)
      ->select('users.id','users.name', 'users.address', 'users.phone', 'users.description', 'users.photo', 'users.delivery_cost')
      ->get();

      $restaurants = $this->addRestaurantInfo($restaurants);
      dd($restaurants);
      return response() -> json([
        'restaurants' => $restaurants
      ]);
    }

    private function addRestaurantInfo($restaurants){

      foreach ($restaurants as $key => $restaurant) {

        // Fa ritornare il voto medio
        $votes = [];
        foreach ($restaurant->feedback as $feedback) {
          $votes[] = $feedback-> rate;
        };

        if ($votes) {
          $average = array_sum($votes)/count($votes);
          $restaurants[$key]['average_rate'] = $average;
        } else {
          $restaurants[$key]['average_rate'] = 'no-info';
        }

        // Fa ritornare le tipologie
        $typologies = [];
        foreach ($restaurant->typologies as $typology) {
          $typologies[] = $typology -> typology;
        }

        $restaurants[$key]['typologies'] = $typologies;

        return $restaurants;
      };
    }
}
