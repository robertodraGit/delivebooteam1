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

      return response() -> json([
        'restaurants' => $restaurants
      ]);
    }

    public function searchTypsRestsPlats($query){
      // Trasformo la query in array
      $queries = explode(" ", $query);
      $originalQueries = $queries;

      //RIMUOVO L'ULTIMA LETTERA DI OGNI QUERY
      foreach ($queries as $index => $q) {
        $queries[$index] = substr($queries[$index], 0, -1);
      }

      // 1- ricerca per tipologie
      $responseTypologies = $this->searchTypologies($queries);
      // 2 cerca nel nome ristorante
      $responseRestNames = $this->searchRestNames($queries);
      // 3 cerca nel nome dei piatti
      $responsePlatesNames = $this->searchPlateNames($originalQueries);

      return response() -> json([
        'typology-resoult' => $responseTypologies,
        'rest-name-resoult' => $responseRestNames,
        'plates-resoult' => $responsePlatesNames,
      ]);
    }

    private function searchTypologies($queries){
      $responseTypologies = [];

      $whereClause = "";
      foreach ($queries as $query) {
        $typology = "'%" . $query . "%'";
        $whereClause .=  'typologies.typology like ' . $typology . ' OR ';
      }
      $whereClause = substr($whereClause, 0, -4);

      $responseTypologies = DB::table('typology_user')
        ->join('users', 'users.id', '=', 'typology_user.user_id')
        ->join('typologies', 'typologies.id', '=', 'typology_user.typology_id')
        ->select('users.id','users.name', 'users.address', 'users.phone', 'users.description', 'users.photo', 'users.delivery_cost')
        ->whereRaw($whereClause)
        ->groupBy('typology_user.user_id')
        ->havingRaw('COUNT(typology_user.user_id) ='. count($queries))
        ->get();

        $responseTypologies = $this->addRestaurantInfo($responseTypologies);

        return $responseTypologies;
    }

    private function searchRestNames($queries){
      $whereClause = [];
      foreach ($queries as $query) {
        $word = '%' . $query . '%';
        $whereClause[] = ['name', 'like', $word];
      }

      $responseRestNames = DB::table('users')
        ->where(
            $whereClause
          )
        ->select('users.id','users.name', 'users.address', 'users.phone', 'users.description', 'users.photo', 'users.delivery_cost')
        ->get();

      $responseRestNames = $this->addRestaurantInfo($responseRestNames);

      return $responseRestNames;
    }

    private function searchPlateNames($queries){
      $responsePlatesNames = [];

      $whereClause = [];
      foreach ($queries as $query) {
        $plate = '%' . $query . '%';
        $whereClause[] = ['plate_name', 'like', $plate];
      }

      $responsePlatesNames = DB::table('plates')
        ->where(
            $whereClause
          )
        ->select('*')
        ->get();

      return $responsePlatesNames;
    }

    private function addRestaurantInfo($restaurants){

      foreach ($restaurants as $key => $restaurant) {

        $rest = User::findOrFail($restaurant -> id);
        // Fa ritornare il voto medio
        $votes = [];
        foreach ($rest->feedback as $feedback) {
          $votes[] = $feedback-> rate;
        };

        if ($votes) {
          $average = array_sum($votes)/count($votes);
          $restaurants[$key] -> average_rate = $average;
        } else {
          $restaurants[$key] -> average_rate = 'no-info';
        }

        // Fa ritornare le tipologie
        $typologies = [];
        foreach ($rest->typologies as $typology) {
          $typologies[] = $typology -> typology;
        }

        $restaurants[$key]->typologies = $typologies;

      };
      return $restaurants;
    }
}
