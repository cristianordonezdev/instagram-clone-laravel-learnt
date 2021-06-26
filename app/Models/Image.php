<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
      //INDICAR CUAL VA SER LA TABLA DEL EL MODELO
      protected $table = 'images';

      //RELACION ONE TO MANY / UN MODELO PUEDE TENER MUCHOS COMENTARIOS
      public function comments(){
          return $this->hasMany('App\Models\Comment')->orderBy('id','desc');
      }
  
      //RELACION ONE TO MANY
      public function likes(){
          return $this->hasMany('App\Models\Like');
      }
  
      //RELACION MANY TO ONE
      public function user(){
          return $this->belongsTo('App\Models\User', 'user_id');
      }
}
