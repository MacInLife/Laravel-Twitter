<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    //
    public function index(Post $post, Request $request)
    {
        //
        $posts = $post->orderBy('id', 'DESC')->paginate(4);
        //$post->user_id = $request->user_id;
        //SELECT * FROM posts WHERE(user_id = 14)
        //$post->user_id = 14;
        $myPosts = $post->all();

        //Retourne la view des posts
        return view('profil', ['posts' => $posts], ['myPosts' => $myPosts]);
    }
}
