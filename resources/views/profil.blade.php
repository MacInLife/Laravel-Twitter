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
                    <div class="mr-2 float-left" style="width:80px;"><img id="user-avatar"
                            class="m-auto rounded img-thumbnail" src="{{Auth::user()->getAvatar()}}" width="100%"
                            height="100%">
                    </div>
                    <div class="p-2 my-auto mr-auto">
                        <H5 class="pt-2">{{ Auth::user()->name }} </H5>
                        <p class="text-secondary font-italic">Rejoins
                            {{Auth::user()->created_at->locale('fr_FR')->diffForHumans()}}</p>
                    </div>
                    <div class="p-2 my-auto">
                        <a href="#" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Follow</a>
                    </div>
                </div>
            </div>

            <nav class="nav-pills nav-justified">
                <div class="nav nav-tabs bg-light card-header" id="nav-tab" role="tablist"
                    style="justify-content: space-between;">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                        aria-controls="nav-home" aria-selected="true">Mes tweets ()</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Follower ()</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                        aria-controls="nav-contact" aria-selected="false">Following ()</a>
                </div>
            </nav>
            <div class="tab-content card-body bg-white" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    Tweets
                </div>
                <div class="tab-pane fade bg-white" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    Followers
                </div>
                <div class="tab-pane fade bg-white" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    Followings
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
