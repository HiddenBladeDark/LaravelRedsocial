<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//importado
use App\Comment;

class CommentController extends Controller
{
     //debe estar autenticado para poder usar este controlador
     public function __construct()
    {
        //comprobar si se identifico
        $this->middleware('auth');
    }
    
    
    public function save(Request $request)
            {
        
        //validacion
        $validate = $this->validate($request,[
           'image_id'=>'integer|required',
            'content'=>'string|required'
            
        ]);
        
        //recogemos los datos del formulario
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');
       
        //asignacion valores a los nuevos objetos
       $comment = new comment();
       $comment->user_id = $user->id;
       $comment->image_id=$image_id;
       $comment->content=$content;
       //guardar en la db
       
       $comment->save();
            
       
       //redireccion
       
       return redirect()->route('image.detail',[
          'id'=>$image_id 
       ])->with([
           'message'=>'Has publicado tu comentario correctamente'
       ]);
    }
            
            
            
}
