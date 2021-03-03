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
      // $plate_data = Plate::all();
      // mettere where visible : 1
      // dd($plate_data);
      // return view('welcome', compact('plate_data'));
      return view('welcome-home');
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
