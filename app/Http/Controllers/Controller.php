<?php

namespace App\Http\Controllers;
use App\Plate;
use App\User;
use App\Feedback;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;

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
      //verranno passati dei parametri (post) che poi prenderò dalla request.
      //adesso lavoro senza, simulandoli in una variabile che poi diventerà un array di domande.
      // request = string esempio: cinese italiano
      // domande = ['cinese', 'italiano']

      // 1 cerca nelle categorie rist
      // 2 cerca nel nome ristorante
      // 3 cerca nei piatti

      $queries = ['pizza'];
      // ******
      // 1- ricerca per categorie
      // ******

      $responseTypologies = [];
      foreach ($queries as $typology) {

        $responseTypologies[] = DB::table('typology_user')
              ->join('typologies', 'typology_user.typology_id', '=', 'typologies.id')
              ->join('users', 'typology_user.user_id', '=', 'users.id')
              ->select('users.id','users.name', 'users.address', 'users.phone', 'users.description', 'users.photo', 'users.delivery_cost')
              ->where('typologies.typology', $typology)
              ->get();
      }
      // Risultato: Un array di elementi User per categoria.
      // dd($responseTypologies);

      // ******
      // 2 cerca nel nome ristorante
      // ******

      $responseRestNames = [];

      $whereClause = [];
      foreach ($queries as $query) {
        $word = '%' . $query . '%';;
        $whereClause[] = ['name', 'like', $word];
      }

      $responseRestNames = DB::table('users')
        ->where(
            $whereClause
          )
        ->select('users.id','users.name', 'users.address', 'users.phone', 'users.description', 'users.photo', 'users.delivery_cost')
        ->get();
      // Risultato: un array di elementi che nel name hanno l'and di tutte le query
      // dd($responseRestNames);

      // dd('blocco');



      // Se nessuna query inserita (1 avvio home-page):
      $restaurants = DB::table('users')
      ->select('users.id','users.name', 'users.address', 'users.phone', 'users.description', 'users.photo', 'users.delivery_cost')
      ->inRandomOrder()
      ->limit(10)
      ->get();
      dd($restaurants);


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

      dd($restaurants);

      return response() -> json([
        'restaurants' => $restaurants
      ]);
    }

    public function restaurantShow($id){
      $restaurant = User::findOrFail($id);
      return view('restaurant-show',compact('restaurant'));
    }
}
