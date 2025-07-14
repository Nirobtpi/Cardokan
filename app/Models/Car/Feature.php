<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $guarded=[];

    public function cars(){
        return $this->belongsToMany(Car::class,'car_feature');
    }
}
