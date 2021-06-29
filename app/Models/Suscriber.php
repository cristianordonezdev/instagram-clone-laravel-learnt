<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscriber extends Model
{
    use HasFactory;

    protected $table = "suscribers";

    public function users(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    // public function suscriber(){
    //     return $this->belongsTo('App\Models\User','suscriber_id');
    // }

    
}
