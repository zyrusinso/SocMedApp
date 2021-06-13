@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $post)
        <div class="row mb-3" >
            <div class="col-10 offset-1">
                <div class="card border-primary" style="max-width: 100%">
                    <div class="card-header"> 
                        <div class="d-flex align-items-center" ><img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle" style="max-width: 40px;">
                            <h5 class="font-weight-bold">
                                <a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a>
                            </h5> 
                        </div>
                        
                        <p class="ml-5"> {{ $post->caption }}</p>
                    </div>
                    <div class="card-body text-primary">
                        <a href="/profile/{{ $post->user->id }}">
                            <img src="/storage/{{ $post->image }}" class="w-100 m-2">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>

@endsection
