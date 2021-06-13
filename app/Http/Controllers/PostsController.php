<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(){
        if(Auth::check()){

            $users = auth()->user()->following()->pluck('profiles.user_id');
            
            $posts = Post::whereIn('user_id', $users)->latest()->paginate(3);

            return view('posts.index', compact('posts'));
        }else{
            return redirect('/login');
        }
    }


    public function create(){
        return view('posts.create');
    }

    public function store(){
        
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image']
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->resize(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
        
        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(Post $post, User $user){
        // $user = User::findOrFail(auth()->user()->id);
        return view('posts.show', compact('post'));
    }

    public function destroy($id){
        $this->authorize('delete', $user->post);
        
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/profile/'.auth()->user()->id);
    }
}
