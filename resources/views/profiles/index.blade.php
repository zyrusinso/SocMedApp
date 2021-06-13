@extends('layouts.app')
<head>
    <title>Profile</title>
    
</head>
@section('content')

<div class="container" >
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle" style="width: 160px;">
        </div>
        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div clas="d-flex align-items-center pb-4 row">
                    <div class="row">
                        <div class="col-6">
                            <h1>{{ $user->username }}</h1>
                        </div>
                        
                        <div class="col-6 " <?php if($user->id == auth()->user()->id){echo 'hidden';} ?>>
                            <follow-button :user="{{ $user->id }} " follows="{{ $follows }}"/>
                        </div>
                    </div>
                </div>
                @can('update', $user->profile)
                    <a href="/p/create" class="btn btn-primary">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pr-2"><strong> {{ count($user->posts) }}<?php //Or you can use $user->posts->count() ?> </strong> posts </div> 
                <div class="pr-2"><strong> {{ $user->profile->followers->count() }} </strong> followers </div>
                <div class="pr-2"><strong> {{ $user->following->count() }} </strong> following </div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row">
    @foreach($user->posts as $post)
        <div class="col-4 pb-3">
            <a href="/p/{{ $post->id }}">
                <img src="/storage/{{ $post->image }}" class="w-100 ">
            </a>
        </div>
    @endforeach
    </div>
</div>
@endsection
