<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    //
    public function index(Post $post)
    {
        //
        $posts = $post->orderBy('id', 'DESC')->paginate(4);

        //Retourne la view des posts
        return view('profil', ['posts' => $posts]);
    }
}
