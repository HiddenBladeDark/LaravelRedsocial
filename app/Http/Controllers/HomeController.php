<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//pack en uso
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Image;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //comprobar si se identifico
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::orderBy('id','desc')->paginate(5);
        
        return view('home',[
            'images'=>$images
        ]);
    }
}
