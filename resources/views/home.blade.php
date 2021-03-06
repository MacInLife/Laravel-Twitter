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
                <div class="navbar px-0 bg-light" style="
    border-bottom: 1px solid lightgrey;">
                    <h6 class=" mt-2 pl-4">Personne que vous pouvez suivre ({{$users->count()}})
                    </h6>
                    <button class="navbar-toggler mr-4" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <svg width="20" height="20" aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="angle-down" class="svg-inline--fa fa-angle-down fa-w-10" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path fill="currentColor"
                                d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                            </path>
                        </svg>
                    </button>
                    <div class="collapse navbar-collapse bg-white p-2" id="navbarSupportedContent">
                        <div class="content p-2">
                            @foreach ($users as $user)
                            @if ($user != Auth::user())
                            <div class="card-body d-flex p-2">

                                <div class="mr-2 float-left" style="width:80px;">
                                    <a href="{{ route('profil', $user->pseudo) }}">
                                        <img class="m-auto rounded img-thumbnail" src="{{$user->getAvatar()}}"
                                            width="100%" height="100%">
                                    </a>
                                </div>
                                <a href="{{ route('profil', $user->pseudo) }}" class="my-auto mr-auto"
                                    style="text-decoration: none; color: inherit;">
                                    <div class="d-flex">
                                        <p class="p-2 my-auto">{{$user->name}}</p>
                                        <p class="my-auto">{{$user->pseudo}}</p>
                                    </div>
                                </a>
                                <div class="p-2 my-auto ">
                                    @if($users == true)
                                    <a href="{{ route('profil.follow', $user->pseudo)}}" class="btn btn-primary btn-lg"
                                        role="button" aria-pressed="true">Follow</a>
                                    @else
                                    <a href="{{ route('profil.unfollow', $user->pseudo)}}"
                                        class="btn btn-dark btn-lg text-white" role="button"
                                        aria-pressed="true">Unfollow</a>
                                    @endif
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex">

                <div class="card mr-2 w-75">
                    <div class="card-header">Tweets</div>
                    <div class="card-body outer">
                        @if($posts)
                        @foreach ($posts as $post)
                        @csrf
                        <div class="child border-bottom mb-2 pb-2">
                            <div class="mb-2 mr-2 float-left" style="width:80px;"><a
                                    href="{{ route('profil', $post->user->pseudo) }}">
                                    <img class="m-auto rounded img-thumbnail" src="{{$post->user->getAvatar()}}"
                                        width="100%" height="100%">
                                </a>
                                <!-- 
                                        Avant en dure : src="./img/tweet1.png"
                                        Après en BDD : src = ./img/$post->user->avatar 
                                    -->
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('profil', $post->user->pseudo) }}" class="mr-auto"
                                    style="text-decoration: none; color: inherit;">
                                    <div class="d-flex">
                                        <H5 class="font-weight-bold pr-2">{{$post->user->name}}</H5>
                                        <p>{{$post->user->pseudo}}</p>
                                    </div>
                                </a>
                                <form action="{{route('destroy.post', $post->id)}}" method="DELETE" id="myform">
                                    @if ($post->user->name === Auth::user()->name)
                                    <button type="submit" class="btn btn-outline-danger p-2" onclick="if(confirm('Voulez-vous vraiment supprimer ce post ?')){
                                            return true;}else{ return false;}">Supprimer</button>
                                    @endif
                                </form>
                            </div>
                            <div class="d-flex">
                                <p class="mr-auto w-70 text-info">
                                    {{$post->text }}
                                </p>
                                <p class="p-2 text-secondary font-italic">
                                    {{$post->created_at->locale('fr_FR')->diffForHumans()}}</p>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        {{$posts->links()}}
                    </div>
                    <!--<a href="#" id="showMore">Show More</a>-->
                </div>

                <div class="card w-50 h-50">
                    <div class="card-header">Ecrire un tweet</div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group m-2 ">
                            <form method="post" action="{{route('create.post')}}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <textarea name="text" class="form-control @error('text') is-invalid @enderror mb-2"
                                    id="text" rows="3">{{ old('text') }}</textarea>
                                {{csrf_field()}}
                                <button href="#" class="btn btn-primary btn-lg btn-block" role="button"
                                    aria-pressed="true" type="submit">Tweet</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
</div>
@endsection
