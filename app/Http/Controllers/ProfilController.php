<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Follow;

class ProfilController extends Controller
{
    //
    public function index($pseudo, Post $post, Follow $follow, User $user)
    {
        //
        $posts = $post->orderBy('id', 'DESC')->get();
        //$post->user_id = $request->user_id;
        //SELECT * FROM posts WHERE(user_id = 14)
        //$post->user_id = 14;
        $user = $user->where('pseudo', $pseudo)->first();
        
        $myPosts = $post->where('user_id', $user->id)->get();
        $myFollowing = $user->following()->get();
        $myFollowers = $user->followers()->get();

        
        //Retourne la view des posts
        return view('/profil', ['posts' => $posts, 'myPosts' => $myPosts, 'user' => $user, 'myFollowers' => $myFollowers, 'myFollowing' => $myFollowing ]);
    }

    public function unFollow($pseudo, Follow $follow, User $user)
    {
        $user_id = Auth::user()->id;
        $follower = $user->where('pseudo', $pseudo)->first();

        //where == request
        $unfollow = $follow
            ->where('user_id', $user_id)
            ->where('follower_id', $follower->id)
            ->first();

        $unfollow->delete();

        return redirect()->back()->withOk("Vous ne suivez plus " . $follower->pseudo . " !");
    }


    public function follow($pseudo, User $user)
    {
        $user_id = Auth::user()->id;
        $follower = $user->where('pseudo', $pseudo)->first();

        $follow = new Follow;
        $follow->user_id = $user_id;   
        $follow->follower_id = $follower->id;   
        $follow->save();

        return redirect()->back()->withOk("Vous suivez désormais " . $follower->pseudo . " !");
    }
}
