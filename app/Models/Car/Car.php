<?php

namespace App\Models\Car;

use App\Models\User;
use App\Models\Country\City;
use App\Models\Country\Country;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function brand(){
        return $this->belongsTo(CarBrand::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function features(){
        return $this->belongsToMany(Feature::class);
    }
}
