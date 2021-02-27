<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
  // index all Users
  public function index() {
    $drinks = Drink::all();
    return view('pages.drinks', compact('drinks'));
  }
  // show {id} selected User
  public function show($id) {
    $drink = Drink::findOrFail($id);
    return view('pages.drink', compact('drink'));
  }
  // Create new User
  public function create() {
    return view('pages.drink-create');
  }

  public function store(Request $request) {
    $drink = Drink::create($request->all());
    // dd($request->all());
    return redirect() -> route('drinks-index');
  }
  // edit & update methods
  public function edit($id) {
    $drink = Drink::findOrFail($id);
    return view('pages.drink-edit', compact('drink'));
  }
  public function update(Request $request, $id) {
    $drink = Drink::findOrFail($id);
    $drink -> update($request -> all());
    return redirect() -> route('drink-show', $drink -> id);
  }
  public function delete($id) {
    $drink = Drink::findOrFail($id);
    $drink -> delete();
    return redirect() -> route('drinks-index');
  }
}
