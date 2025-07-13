<?php

namespace App\Models\Country;

use App\Models\Car\Car;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
     protected $guarded=[];

    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function cars(){
        return $this->hasMany(Car::class);
    }
}
