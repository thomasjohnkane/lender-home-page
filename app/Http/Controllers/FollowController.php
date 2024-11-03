<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUnfollowRequest;
use App\Models\User;
use Illuminate\Http\Response;

class FollowController extends Controller {
    public function follow( $request): \Illuminate\Http\RedirectResponse
    {
        $userToFollow = User::findOrFail($request);
        auth()->user()->follow($userToFollow);

        return to_route('dashboard')->with([
            'posts' => auth()->user()->posts,
            'followers' => auth()->user()->followers,
            'following' => auth()->user()->following
        ]);
    }

    public function unfollow($request): \Illuminate\Http\RedirectResponse
    {
        $userToUnfollow = User::findOrFail($request);
        auth()->user()->unfollow($userToUnfollow);

        return to_route('dashboard')->with([
            'posts' => auth()->user()->posts,
            'followers' => auth()->user()->followers,
            'following' => auth()->user()->following
        ]);
    }
}
