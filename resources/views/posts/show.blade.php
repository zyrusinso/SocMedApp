@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-8">
            <img src="{{ $post->profileImage() }}" class="w-100">
            
        </div>
        
        <div class="col-4 pt-5">
        
            
             <div class="d-flex align-items-center">
                <div><img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle" style="max-width: 40px;"></div>
                <div>
                    <h5 class="font-weight-bold">
                        <a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a>
                    </h5> 
                </div>
             </div>
            
            <p><label for="caption">Caption:</label> {{ $post->caption }}</p>
        </div>
    </div>

    
    <form action="/p/delete/{{ $post->id }}" method="POST">
        @csrf
        @method('DELETE')      
            @can('delete', $post)   
                <button type="submit" class="btn btn-danger float-right mt-2 " onclick="return confirm('Are you sure?')">Delete Posts</button>
                <?php //if(isset($user->id)) 'hidden' ?? '' ?>
            @endcan            
    </form>
</div>
@endsection
