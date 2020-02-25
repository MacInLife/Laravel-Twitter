<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    //
    public function index($pseudo, Post $post, Request $request, User $user)
    {
        //
        $posts = $post->orderBy('id', 'DESC')->get();
        //$post->user_id = $request->user_id;
        //SELECT * FROM posts WHERE(user_id = 14)
        //$post->user_id = 14;
        $user = $user->where('pseudo', $pseudo)->first();
        $myPosts = $post->where('user_id', $user->id)->get();
     

        //Retourne la view des posts
        return view('/profil', ['posts' => $posts, 'myPosts' => $myPosts, 'user' => $user]);
    }
}
