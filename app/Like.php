<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    


    //relacion de muchos a uno
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
                    //Nos saca el objeto que se necesite, en este caso user_id y lo 
                    //relacionamos con usuario y buscara los objetos que sea igual que la identidad de user_id en este caso
    }
    
    
    public function image()
    {
        return $this->belongsTo('App\Image','image_id');
                    //Nos saca el objeto que se necesite en este caso Image_id y lo relacionamos
                    //con image y buscara los objetos que sea igual que la identidad de image_id
    }
}
