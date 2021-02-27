<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
}
