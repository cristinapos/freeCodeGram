<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;

use App\Http\Requests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->username) : false;

        //$postCount = $user->posts->count();
        $postCount = Cache::remember('count.posts' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->posts->count();
        });
        $followerCount = $user->profile->followers->count();
        $followingCount = $user->following->count();
        return view('profiles.index', compact('user', 'follows', 'postCount', 'followerCount', 'followingCount'));

        // $user = User::findOrFail($user);

        // return view('profiles.index', [
        //     'user' => $user
        // ]);
    }

    public function edit(\App\Models\User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(\App\Models\User $user)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }


        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}
