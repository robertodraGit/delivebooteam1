<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  public function payment(){
    return $this -> hasOne(Payment::class);
  }
  public function plates(){
    return $this -> belongsToMany(Plate::class);
  }
}
