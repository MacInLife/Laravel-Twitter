<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, User $user)
    {
        //
        $posts = $post->orderBy('id', 'DESC')->get();
        $users = $user->orderBy('id', 'DESC')->get();

        //Retourne la view des posts
        return view('home', ['posts' => $posts], ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post, Request $request)
    {
        //Validation
        $validate = $request->validate([
            'text' => 'required',

        ]);
        //Création
        $post = new Post;
        $post->text = $request->text;
        //$post->user_id = 3;
        $post->user_id = $request->user_id;

        //Sauvegarde du post tweet
        $post->save();
        //Redirection
        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // //
        // $p = $post->find($id);
        // $p->title = $request->get('title');
        // $p->content = $request->get('content');
        // $p->save();

        // return redirect()->route('posts.edit', $p->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Post $post, Request $request)
    {
        //
        $p = $post->find($id);
       // $p->user_id = $request->user_id;
       if (Auth::check()) {
        $p->delete($id);
        return redirect('home')->withOk("Le post " . $p->text . " a été supprimé.");
        //->withOk("Le post " . $p->text . " a été supprimé.");
        }
    }
}
