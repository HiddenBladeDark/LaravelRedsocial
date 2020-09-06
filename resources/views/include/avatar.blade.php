
@if(auth::user()->image)

<div class="container-avatar">
<img src="{{ route('user.avatar',['filename'=>auth::user()->image]) }}" class="avatar" />
</div>  
@endif   
