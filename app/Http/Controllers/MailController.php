<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MailController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }


  public function sendMail(Request $request)  {
    dd($request -> all());
  }
}
