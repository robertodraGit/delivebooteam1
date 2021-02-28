<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Plate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PlateController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function platesIndex(){
    $user = Auth::user();
    return view('plates.plates-index', compact('user'));
  }
}
