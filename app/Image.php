<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //tabla para modificar
    //para protejer añadir varias propiedades
    protected $table = 'images';
    
    //Relacion One To Many/uno a muchos, un solo modelo puede tener muchos comentarios
    
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('id','desc');
    }               //este metodo lo que hace es conseguir los array de objetos de comentarios cuyo image sea = 5

    //Relacion One To Many
    
    public function likes()
    {
        return $this->hasMany('App\Like');
                        //sacarme todos los registros de la db en forma de array de objeto cuyo image id corresponda con el que se trata sacar cuyo image sea = 5
        
    }
    
    //Relacion de mucho a uno
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
                    //Nos saca el objeto que se necesite, en este caso user_id y lo 
                    //relacionamos con usuario y buscara los objetos que sea igual que la identidad de user_id en este caso
    }
    
    }
