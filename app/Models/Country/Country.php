<?php

namespace App\Models\Country;


use App\Models\Car\Car;
use App\Models\Country\City;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public function cities(){
        return $this->hasMany(City::class);
    }

    public function cars(){
        return $this->hasMany(Car::class);
    }
}
