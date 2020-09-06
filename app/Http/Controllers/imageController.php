<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
//pack en uso
use App\Image;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use File;






class imageController extends Controller
{
    
   
    
    
        //debe estar autenticado para poder usar este controlador
     public function __construct()
    {
        //comprobar si se identifico
        $this->middleware('auth');
    }
    
    //subir imagenes
   public function create()
   {
       return view('image.create');
   }
   
   public function save(Request $request)
   {
      //validacion
       $validate = $this->validate($request, [
          'description'=>'required',
           //mimes permiten las extensiones de la imagen
           'image_path'=>'required|mimes:jpg,png,gif,mp4,jpeg'
           
       ]);
       
       //capturar datos
       $image_path=$request->file('image_path');
       $description = $request->input('description');
       
       
       //asignar valores al nuevo objeto
       $user = \Auth::user();
       //poner el auth como esta escrito para que lo coja
       $image = new Image();
       
       //le asignamos valor
       $image->user_id=$user->id;
       $image->description=$description;
       
       //subir fichero
       //si da true image_path
       if($image_path)
       {
           //time que sea unico y el getclientoriginal del nombre original del fichero
           $image_path_name = time().$image_path->getClientOriginalName();
           //put para guardar en este disco virtual STORAGE, 
           //lo que hace el FILE es moverme la imagen que tenemos en el storage
           Storage::disk('images')->put($image_path_name, File::get($image_path));
           $image->image_path=$image_path_name;
          
           
      
           
       }
            //me lo guarde en la db
       $image->save();     
         
   
       //retorne
       
       return redirect()->route('home')
           ->with([
           'message'=>'Tu publicación ha subido correctamente!!!'
               
       ]);
       }
       
       public function getImage($filename)
       {
           $file = Storage::disk('images')->get($filename);
           return new Response($file,200);
       }
   
       
       
    public function detail($id)
    {
       $image = Image::find($id);
       
       return view('image.detail',[
           'image'=>$image
       ]);
    }
}
