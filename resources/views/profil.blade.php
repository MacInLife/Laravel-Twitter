@extends('layouts.app')
<title>Twitter Laravel</title>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session()->has('ok'))
            <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
            @endif
            <div class="card mb-2">
                <div class="card-header">Profil</div>
                <div class="card-body d-flex">
                    <div class="mr-2 float-left" style="width:80px;">
                        <a href="{{ route('profil', $user->pseudo) }}">
                            <img id="user-avatar" class="m-auto rounded img-thumbnail" src="{{$user->getAvatar()}}"
                                width="100%" height="100%">
                        </a>
                    </div>
                    <div class="p-2 my-auto mr-auto">
                        <a href="{{ route('profil', $user->pseudo) }}" class="my-auto mr-auto"
                            style="text-decoration: none; color: inherit;">
                            <div class="d-flex">
                                <H5 class="font-weight-bold pr-2">{{ $user->name }} </H5>
                                <p>{{$user->pseudo}}</p>
                            </div>
                        </a>
                        <p class="text-secondary font-italic">Rejoint
                            {{$user->created_at->locale('fr_FR')->diffForHumans()}}</p>
                    </div>
                    <div class="p-2 my-auto">
                        <a href="#" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Follow</a>
                    </div>
                </div>
            </div>

            <nav class="nav-pills nav-justified">
                <div class="nav nav-tabs bg-light card-header p-0" id="nav-tab" role="tablist"
                    style="justify-content: space-between;">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                        aria-controls="nav-home" aria-selected="true">Tweets
                        ({{count($myPosts)}})</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Follower ({{count($myFollowers)}})</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                        aria-controls="nav-contact" aria-selected="false">Following ({{count($myFollowing)}})</a>
                </div>
            </nav>
            <div class="tab-content card-body bg-white" id="nav-tabContent">

                <!-- Partie Tweets = Tweets du profil de la personne -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    @if($posts)
                    @foreach ($posts as $post)
                    @if($post->user->name === $user->name)
                    @csrf
                    <div class="border-bottom mb-2 pb-2 pt-2">
                        <div class="mb-2 mr-2 float-left" style="width:80px;">
                            <a href="{{ route('profil', $post->user->pseudo) }}">
                                <img class="m-auto rounded img-thumbnail" src="{{$post->user->getAvatar()}}"
                                    width="100%" height="100%">
                            </a>
                        </div>
                        <div class="d-flex">
                            <a href="{{ route('profil', $post->user->pseudo) }}" class="mr-auto"
                                style="text-decoration: none; color: inherit;">
                                <div class="d-flex">
                                    <H5 class="font-weight-bold p-2">{{$post->user->name}}</H5>
                                    <p class="p-2">{{$post->user->pseudo}}</p>
                                </div>
                            </a>
                            @if ($post->user->name === Auth::user()->name)
                            <form action="{{route('destroy.post', $post->id)}}" method="DELETE" id="myform">
                                <button type="submit" class="btn btn-outline-danger p-2" onclick="if(confirm('Voulez-vous vraiment supprimer ce post ?')){
                                            return true;}else{ return false;}">Supprimer</button>
                            </form>
                            @endif
                        </div>
                        <div class="d-flex">
                            <p class="mr-auto w-70 text-info pl-2">
                                {{$post->text }}
                            </p>
                            <p class="text-secondary font-italic">
                                {{$post->created_at->locale('fr_FR')->diffForHumans()}}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>

                <!-- Partie Followers = personne que je suis -->
                <div class="tab-pane fade bg-white" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    @foreach($user->followers as $follower)
                    @csrf
                    <div class="card-body d-flex p-0 py-2">
                        <div class="mr-2 float-left" style="width:80px;">
                            <a href="{{ route('profil', $follower->pseudo) }}">
                                <img id="user-avatar" class="m-auto rounded img-thumbnail"
                                    src="{{$follower->getAvatar()}}" width="100%" height="100%">
                            </a>
                        </div>
                        <div class="p-2 my-auto mr-auto">
                            <a href="{{ route('profil', $follower->pseudo) }}" class="my-auto mr-auto"
                                style="text-decoration: none; color: inherit;">
                                <div class="d-flex">
                                    <H5 class="font-weight-bold pr-2"> {{ $follower->name }} </H5>
                                    <p>{{$follower->pseudo}}</p>
                                </div>
                            </a>
                            <p class="text-secondary font-italic">Relation crée
                                {{$follower->pivot->created_at->locale('fr_FR')->diffForHumans()}}</p>
                        </div>
                        <div class="p-2 my-auto">
                            <a href="#" class="btn btn-info btn-lg text-white" role="button"
                                aria-pressed="true">UnFollow</a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Partie Following = personne qui me suivent -->
                <div class="tab-pane fade bg-white" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    @foreach($user->following as $following)
                    @csrf
                    <div class="card-body d-flex p-0 py-2">
                        <div class="mr-2 float-left" style="width:80px;">
                            <a href="{{ route('profil', $following->pseudo) }}">
                                <img id="user-avatar" class="m-auto rounded img-thumbnail"
                                    src="{{$following->getAvatar()}}" width="100%" height="100%">
                            </a>
                        </div>
                        <div class="p-2 my-auto mr-auto">
                            <a href="{{ route('profil', $following->pseudo) }}" class="my-auto mr-auto"
                                style="text-decoration: none; color: inherit;">
                                <div class="d-flex">
                                    <H5 class="font-weight-bold pr-2"> {{ $following->name }} </H5>
                                    <p>{{$following->pseudo}}</p>
                                </div>
                            </a>
                            <p class="text-secondary font-italic">Relation crée
                                {{$following->pivot->created_at->locale('fr_FR')->diffForHumans()}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
