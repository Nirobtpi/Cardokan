<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded=[];

    public function blogs(){
        return $this->hasMany(Blog::class);
    }
}
