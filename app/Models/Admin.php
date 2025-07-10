<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Pest\Arch\Concerns\Architectable as AdminArchitectable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    
    // use Authenticatable;
    protected $rediractTo = '/';
    const ACTIVE_STATUS='active';
    const INACTIVE_STATUS='inactive';
    protected $guarded=[];
}
