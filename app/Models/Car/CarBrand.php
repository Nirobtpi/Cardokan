<?php

namespace App\Models\Car;

use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    protected $guarded = [];

    public function cars(){
        return $this->hasMany(Car::class);
    }
}
