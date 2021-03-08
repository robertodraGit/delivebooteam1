<?php

namespace App\Http\Controllers;
use App\Plate;
use App\User;
use App\Feedback;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
    //   $users = User::inRandomOrder() -> limit(5) -> get();
    //   // dd($users);
    //   $idUser = [];
    //   foreach ($users as $user) {
    //     $idUser[] = $user['id'];
    //   }
    //   // dd($idUser);
    //   $plates = [];
    //
    //   $platesAll = Plate::all();
    //   // $plate['user_id'] == $idUser
    //   foreach ($platesAll as $plate) {
    //     if (in_array($plate['user_id'], $idUser)) {
    //       $plates[] = $plate;
    //     }
    //   }
    //
    //   $restaurants = User::inRandomOrder() -> first();


      // dd($plates);
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
      // 3 cerca nel nome dei piatti


      // posso dividere tutto in sottofunzioni.
      // aggiungere il voto medio e le altre cose al ristorante


      $queries = ['es', 'se'];

      //RIMUOVO L'ULTIMA LETTERA DI OGNI QUERY
      foreach ($queries as $index => $query) {
        $queries[$index] = substr($queries[$index], 0, -1);
      }

      // ******
      // 1- ricerca per categorie
      // ******

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
      // Risultato: Un array di elementi User che corrispondono in AND alle categorie inserite.
      // dd($responseTypologies);

      // ******
      // 2 cerca nel nome ristorante
      // ******

      $responseRestNames = [];

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
      // Risultato: un array di elementi che nel name hanno l'and di tutte le query
      // dd($responseRestNames);


      // ******
      // 3 cerca nel nome dei piatti
      // ******

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
      dd($responsePlatesNames);

      // dd('typ', $responseTypologies,
      //    'rest',  $responseRestNames,
      //    'plate', $responsePlatesNames);


      // Se nessuna query inserita (1 avvio home-page):

      $restaurants = User::inRandomOrder()->limit(10)
      ->select('users.id','users.name', 'users.address', 'users.phone', 'users.description', 'users.photo', 'users.delivery_cost')
      ->get();

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
