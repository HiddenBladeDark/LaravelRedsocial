
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            @include('include.message')
         
          <div class="card pub_image pub_image_detail">
              <div class="card-header">
                @if($image->user->image)
                
                  <div class="container-avatar">
                  <img src="{{ route('user.avatar',['filename'=>$image->user->image])}}" class="avatar" />   
                  </div>
               @endif
               
               <div class="data-user">
                   {{$image->user->name.' '.$image->user->surnmae}}
                   <span class="nickname">
                   {{'| @'.$image->user->nick}}
                   </span>
               </div>
               
              </div>

                <div class="card-body">
                    <div class="image-container image-detail">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}" />
                    </div> 
                    
                    <div class="description">
                         <span class="nickname">{{'@'.$image->user->nick}}</span> 
                         <span class="nickname date" >{{'  |   '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
                        <p>{{$image->description}}</p>
                    
                    </div>
                    
                    <div class="likes">
                        <img src="{{asset('img/corazon.png')}}"/>
                    </div>
                    
                    
                    <!--separar los elementos flotados de comments-->
                    <div class="clearfix"></div>
                    <div class="comments">
                        <h2>Comentarios {{count($image->comments)}}</h2>
                        <hr>
                        
                        <!--comentarios-->
                        <form method="POST" action="{{route('Comment.save')}}">
                            @csrf
                            
                            <input type="hidden" name="image_id" value="{{$image->id}}"/>
                            <p>
                                <textarea class="form-control{{$errors->has('content')? 'is-invalid': ''}}" name="content"  required></textarea>
                               
                                
                                @if($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                             <strong>{{$errors->frist('content')}}</strong>
                            </span>
                         @endif 
                         
                         
                            </p>
                            
                            <button  type="submit" class="btn-success" >Enviar</button>
                        </form>
                        <hr>
                        @foreach($image->comments as $comment)
                        <div class="comment">
                            <span class="nickname">{{'@'.$comment->user->nick}}</span> 
                         <span class="nickname date" >{{'  |   '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                        <p>{{$comment->content}}</p>
                     
                        </div>
                        @endforeach
                        
                    </div>
          </div>

             
            </div> 

             
   
            </div>
    

        </div>
  


@endsection
