<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\User;

class ProfilesController extends Controller
{
    
    public function index(User $user)
    {
        // $user = User::findOrFail($user);
        // return view('profiles.index', [
        //     'user' => $user
        // ]);
        $follows = (auth()->user())? auth()->user()->following->contains($user->id) : false;
        return view('profiles.index', compact('user', 'follows'));

    }

    public function edit(User $user){
        $this->authorize('update', $user->profile);
        $this->middleware('auth');
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user){
        
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->resize(1200,1200);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile()->update(array_merge(
            $data,
            $imageArray ?? []
        ));
     

        return redirect("/profile/{$user->id}");
    }
}
