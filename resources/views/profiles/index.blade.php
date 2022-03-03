@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage()}}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center" style="padding-bottom: 2em;">
                    <div class="h4">{{ $user->username}}</div>
                    <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                </div>

                @can('update', $user->profile)
                    <a href="/p/create">Add new Post</a>
                @endcan

            </div>
            @can('update', $user->profile)
                <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div style="padding-right: 3em;" class="pr-3"><strong>{{$postCount}}</strong> posts</div>
                <div style="padding-right: 3em;" class="pr-3"><strong>{{$followerCount}}</strong> followers</div>
                <div style="padding-right: 3em;" class="pr-3"><strong>{{$followingCount}}</strong> following</div>
            </div>
            <div  class="pt-4 font-weight-bold" style="font-weight:bold">{{$user->profile->title}}</div>
            <div>
               {{$user->profile->description}}
            </div>
            <div><a href="#" style="font-weight:bold">{{$user->profile->url}}</a></div>
        </div>
    </div>
    <div class="row" style="padding: 2em;">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{$post->id}}">
                <img src="/storage/{{$post->image}} " class='w-100'>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection
