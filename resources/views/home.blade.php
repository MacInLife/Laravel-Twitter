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
                <div class="card-header">Personne que vous pouvez suivre</div>
                @foreach ($users as $user)
                <div class="card-body d-flex py-2">
                    <div class="mr-2 float-left" style="width:80px;"><img class="m-auto rounded img-thumbnail"
                            src="{{$user->getAvatar()}}" width="100%" height="100%">
                    </div>
                    <p class="mr-auto p-2 my-auto">{{$user->name}}</p>
                    <div class="p-2">
                        <a href="#" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Follow</a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex">

                <div class="card mr-2 w-75">
                    <div class="card-header">Vos tweets</div>
                    <div class="card-body">
                        @if($posts)
                        @foreach ($posts as $post)
                        <form action="{{ route('destroy.post', $post->id) }}" method="DELETE">
                            @csrf
                            <!-- method('DELETE') -->
                            <div class="border-bottom mb-2 pb-2">
                                <div class="mb-2 mr-2 float-left" style="width:80px;"><img
                                        class="m-auto rounded img-thumbnail" src="{{$post->user->getAvatar()}}"
                                        width="100%" height="100%">
                                    <!-- 
                                        Avant en dure : src="./img/tweet1.png"
                                        Après en BDD : src = ./img/$post->user->avatar 
                                    -->
                                </div>
                                <div class="d-flex">
                                    <H5 class="font-weight-bold mr-auto">{{$post->user->name}}</H5>
                                    <button type="submit" class="btn btn-outline-danger p-2"
                                        onclick="if(confirm('Voulez-vous vraiment supprimer ce post ?')){
                                            return alert('Le post a bien été supprimer');}else{ return('home');}">Supprimer</button>
                                </div>
                                <div class="d-flex">
                                    <p class="mr-auto w-70 text-info">
                                        {{$post->text }}
                                    </p>
                                    <p class="p-2 text-secondary font-italic">
                                        {{$post->created_at->locale('fr_FR')->diffForHumans()}}</p>
                                </div>
                            </div>
                        </form>
                        @endforeach
                        @endif
                        {{$posts->links()}}
                    </div>
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
