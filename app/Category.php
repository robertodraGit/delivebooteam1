<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  public function plates(){
    return $this ->hasMany(Plate::class);
  }
}
