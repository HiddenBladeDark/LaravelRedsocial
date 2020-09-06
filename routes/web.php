<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use App\Image;


Route::get('/', function () {
   /* 
    //sacaremos todas las iamgenes que hay en la base de datos
    $images = Image::all();
    
    foreach ($images as $image)
    {
        echo $image->image_path."<br/>";
        echo $image->description."<br/>";
        
        //aqui lo que hacemos es concatenar de la tabla imagen
        //usuario nombre y un espacio y luego usuario apellido
        echo $image->user->name.' '.$image->user->surname;
        
        
        echo "<br/>";
        echo '<h4>Comentarios</h4>'."<br/>";
        
        
        //contamos los comentarios que hayan sean mayor igual 1
        if(count($image->comments)>=1){
            
         //aqui sacamos los comentarios con un foreach ya que son muchos comentarios   
        //la propiedad comment es la que creamos en
        foreach($image->comments as $comment)
            //que creamos dentro del modelo imagen function public comment
        {
            echo "<b>".$comment->user->name.' '.$comment->user->surname.':</b> '.$comment->content."<br/>";
            
        }
        }
        echo "LIKES: ".count($image->likes);
        echo "<hr/>";
        
    }
    
    die();
    
    */
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
                                                          //nombre de la rusa          
Route::get('/configuracion','UserController@config')->name('config');
Route::POST('/user/update','UserController@update')->name('user.update');

//mostrar imagen perfil
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');


Route::get('/subir-imagen','imageController@create')->name('image.create');
Route::POST('/image/save','imageController@save')->name('image.save');

Route::get('/image/file/{filename}','imageController@getImage')->name('image.file');



Route::get('/imagen/file/{id}','imageController@detail')->name('image.detail');


Route::Post('/comment/save','CommentController@save')->name('Comment.save');