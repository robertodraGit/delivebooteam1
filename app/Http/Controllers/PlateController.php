<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plate;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Validator;

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

  public function platesEdit($id) {
    $plate = Plate::findOrFail($id);
    $categories = Category::all();

    return view('plates.plate-edit', compact('plate', 'categories'));
  }

  public function platesUpdate(Request $request, $id) {

    $data = $request -> all();

    Validator::make($data, [

      'plate_name' => 'required|max:50',
      'ingredients' =>  'required|string|min:6|max:255',
      'description' =>  'nullable|string|min:6|max:255',
      'price' =>        'required|integer|min:0|max:9999',
      'visible' =>      'nullable|integer|min:0|max:1',
      'discount' =>     'nullable|integer|min:0|max:100',
      'availability' => 'nullable',
      'img' =>          'nullable|image|max:20240',
      'category_id' =>  'required',

    ]) -> validate();

    $plate = Plate::findOrFail($id);
    
    if ($data['img']) {
      $this -> updateImgPlate($request -> file('img'), $id);
    }

    $category = Category::findOrFail($data['category_id']);

    $plate -> update($data);
    $plate -> category() -> associate($category);
    $plate -> save();

    return redirect() -> route('plates-index');
  }

  private function updateImgPlate($img, $id) {

    $this -> fileDeletePlateImg($id);

    $ext = $img -> getClientOriginalExtension();
    $name = rand(100000, 999999) . '_' . time();

    $fileName = $name . '.' . $ext;

    $img -> storeAs('plates', $fileName, 'public');

    $plate = Plate::findOrFail($id);
    $plate -> img = $fileName;
    $plate -> save();
  }

  private function fileDeletePlateImg($id) {

    $plate = Plate::findOrFail($id);

    try {
      $fileName = $plate -> img;
      if ($fileName) {
        $file = storage_path('app/public/plates/' . $fileName);
        File::delete($file);
      }
    } catch (\Exception $e) {}
  }

}
