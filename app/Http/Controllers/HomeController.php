<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function sendMail(Request $request){
    $data = $request -> validate([
      'text' => 'required|min:5'
    ]);
    Mail::to(Auth::user()->email)
      -> send(new TestMail($data['text']));
    return redirect() -> back();
  }

  public function sendEmptyMail(Request $request){

    Mail::to(Auth::user()->email)
      -> send(new TestMail());
    return redirect() -> back();
  }

  public function updateIcon(Request $request){
    $request -> validate([
      'icon' => 'required|file'
    ]);
    $this -> deleteUserImg(); //cancello img
    $image = $request -> file('icon');

    $ext = $image -> getClientOriginalExtension();
    $name = rand(1000000, 9999999) . '_' . time();
    $destfile = $name . '.' . $ext;

    $file = $image -> storeAs('icon', $destfile, 'public');

    // dd($image,$ext,$name, $destfile);
    $user = Auth::user();
    $user -> icon = $destfile;
    $user -> save();

    return redirect() -> back();
  }

  public function clearUserImg(){
    $this -> deleteUserImg();

    $user = Auth::user();
    $user -> icon = null;
    $user -> save();
    return redirect() -> back();
  }

  private function deleteUserImg(){
    $user = Auth::user();
    // se l'utente ha caricato un'icona altrimenti non fare nulla, altrimenmti si spacca;
    try {
      $fileName = $user -> icon;
      $file = storage_path('app/public/icon/' . $fileName);
      File::delete($file);
    } catch (\Exception $e){

    }

  }

  public function index()
  {
      return view('home');
    }

      //dashboard route
    public function dashboard() {
      $email_user = Auth::user()-> email;
      $word = '@';
      // restituisco email utente senza @provider etc
      $mail_cut = substr($email_user, 0, strpos($email_user, $word));

      return view('dashboard', compact('mail_cut'));
    }

    //Restaurant Edit
    public function restaurantEdit(){
      $user = Auth::user();
      return view('restaurant-edit.form-view', compact('user'));
    }

    public function uploadInfo(Request $request){

      $request -> validate([
        'photo' => ['image','max:20240'],
        'description' => ['nullable','string', 'max:255'],
        'phone' => ['required', 'string', 'min:6', 'max:30'],
        'delivery_cost_euro' => ['required', 'integer', 'min:0', 'max:9999'],
        'delivery_cost_cent' => ['required', 'integer', 'min:0', 'max:99'],
      ]);

      $deliveryCost = $request['delivery_cost_euro'] . $request['delivery_cost_cent'];

      if ($request -> photo) {
        $this->updateUserIcon($request -> file('photo'));
      }

      $user = Auth::user();
      $user -> description = $request->description;
      $user -> phone = $request->phone;
      $user -> delivery_cost = $deliveryCost;
      $user -> save();

      return redirect() -> route('restaurant-edit');
    }

    public function deleteIcon(){

      $this-> fileDeleteUserIcon();

      $user = Auth::user();
      $user -> photo = null;
      $user -> save();

      return redirect() -> route('restaurant-edit');
    }

    private function updateUserIcon($img){

      $this-> fileDeleteUserIcon();

      $ext = $img -> getClientOriginalExtension();
      $name = rand(100000, 999999) . '_' . time();

      $fileName = $name . '.' . $ext;

      // Copia file in restaurant_icon
      $img -> storeAs('restaurant_icon', $fileName, 'public');

      // Salvo il nome del file nel db;

      $user = Auth::user();
      $user -> photo = $fileName;
      $user -> save();
    }

    private function fileDeleteUserIcon(){
      $user = Auth::user();

      try {
        $fileName = $user -> photo;
        if ($fileName) {
          $file = storage_path('app/public/restaurant_icon/' . $fileName);
          File::delete($file);
        }
      } catch (\Exception $e) {}
    }

    //End Restaurant Edit
}
