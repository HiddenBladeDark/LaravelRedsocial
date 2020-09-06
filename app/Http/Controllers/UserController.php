<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Facades\Image;




class UserController extends Controller
{
    
    //debe estar autenticado para poder usar este controlador
     public function __construct()
    {
        //comprobar si se identifico
        $this->middleware('auth');
    }
    
    
    
    
    //retornar a user.config
    public function config()
    {
    return view('user.config');    
    }
    
    //que nos lleguen los datos
    
    public function update(Request $request)
    {
        
        
        
            //usuario y id actuales logueados
            $user = \Auth::user();
          $id = $user->id;
          
          
        
           //validar datos 
        $validate = $this->validate($request,[
           'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,//esto significa que no haya ningun usuario con el mismo 
            //dato y el id concuerde con el nick
              //unique:users que sea unico en la tabla de usuarios al igual que el correo                            
            'email' => 'required|string|email|max:255|unique:users,email,'.$id//que solo sea unico el email con el id actual logueado
        ]);
    
        
        //recoger datos del usuario
       $name=$request->input('name');
       $surname= $request->input('surname');
        $nick= $request->input('nick');
        $email= $request->input('email');
        
     
       
        
        //asginar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname= $surname;
        $user->nick=$nick;
        $user->email=$email;
        
        
        
        
        //subir la imagen
        
        
        $image_path = $request->file('image_path');
        
        
        
      //si es true  
      if($image_path)
      {  
          
        
       //$filename    =  time().$image_path->getClientOriginalName();
          //poner nombre unico
        //nombre fiechero original cuando sube el usuario exclusivo de la carpeta storage/users 
        $image_path_name = time().$image_path->getClientOriginalName();  

        // $image_path = Image::make($image_path->getRealPath());              
        //$image_path->resize(300, 300);
        
        //guardar en la carpeta storage(storage/app/users)
         //nos sirve para selecionar el disco virtual de users, y put nos permite guardar la imagen
         //, file para conseguir el archivo final, y luego copia y consigue y me lo guarda en users
         Storage::disk('users')->put($image_path_name, file::get($image_path));
        //   $image_path->save(storage_path('app\user' .$filename));
          
        // le damos valor/seteo el nombre de la imagen en el objeto
         $user->image = $image_path_name;

         
        
         
      }
        
        //ejecutar consulta y cambios en la base de datos
        $user->update();
        
        
        return redirect()->route('config')
                ->with(['message'=>'Usuario actualizado correctamente']);
        
    
        
        
        
    }  
    
    //seguridad para que no nos saquen iamgen si no estan logueados
    public function getImage($filename)
    {
        $file= Storage::disk('users')->get($filename);
        
        
        return new response($file,200);
    }
    
}
