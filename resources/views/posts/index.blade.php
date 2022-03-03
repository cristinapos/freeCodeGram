@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row">
        <div class="col-6 offset-3">
            <a href="/profile/{{$post->user->id}}"><img src="/storage/{{$post->image}}" class="w-100"></a>
        </div>
    </div>
    <div class="row" style="padding-top: 1em; padding-bottom: 1em;">
        <div class="col-6 offset-3">
            <div>
                <p>
                    <span class="font-weight-bold" style="font-weight: bold;">
                        <a href="/profile/{{$post->user->id}}" style="text-decoration: none;">
                            <span class="text-dark">{{$post->user->username}}</span>
                        </a>
                    </span> {{ $post->caption}}
                </p>
            </div>
        </div>
    </div>
    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div>
                {{$posts->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
