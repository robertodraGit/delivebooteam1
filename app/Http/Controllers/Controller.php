<?php

namespace App\Http\Controllers;
use App\Plate;
use App\User;
use App\Feedback;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
      $users = User::inRandomOrder() -> limit(5) -> get();
      // dd($users);
      $idUser = [];
      foreach ($users as $user) {
        $idUser[] = $user['id'];
      }
      // dd($idUser);
      $plates = [];

      $platesAll = Plate::all();
      // $plate['user_id'] == $idUser
      foreach ($platesAll as $plate) {
        if (in_array($plate['user_id'], $idUser)) {
          $plates[] = $plate;
        }
      }

      // dd($plates);
      return view('welcome-home', compact('plates'));
    }

    public function allRestaurant(){
      return view('vista-ristoranti-home');
    }

    public function getAllRestaurant(){
      $restaurants = User::all('id','name', 'address', 'phone', 'description', 'photo', 'delivery_cost');


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

      };

      return response() -> json([
        'restaurants' => $restaurants
      ]);
    }

    public function restaurantShow($id){
      $restaurant = User::findOrFail($id);
      return view('restaurant-show',compact('restaurant'));
    }
}
