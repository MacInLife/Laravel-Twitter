<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

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
        $myFollowing = $user->following()->get();
        $myFollowers = $user->followers()->get();

        //Retourne la view des posts
        return view('/profil', ['posts' => $posts, 'myPosts' => $myPosts, 'user' => $user, 'myFollowers' => $myFollowers, 'myFollowing' => $myFollowing ]);
    }

    public function unFollow($pseudo, User $user, Request $request)
    {
    //     $p = $post->find($id);
    //    // $p->user_id = $request->user_id;
    //    if (Auth::check()) {
    //     $p->delete($id);
    //     return redirect::back()->withOk("Le post " . $p->text . " a été supprimé.");
    //     //->withOk("Le post " . $p->text . " a été supprimé.");
    //     }
    }
    public function followers($pseudo, User $user, Request $request)
    {
        // $user = $user->where('pseudo', $pseudo)->first();
        // //Création de la relation suivre un user
         //$follow = new Follow;
        // //$follow->user_id = 3;
        // $follow->user_id = $request->user_id;
        // //dd($follow);
        // //Sauvegarde de la relation
        // $follow->save();
        // //Redirection
        // return redirect::back()->withOk("Vous suivez désormais" . $follow->user->name . "!");
    }
}
