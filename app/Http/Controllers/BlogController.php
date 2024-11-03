<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Jobs\NotifyFollowersJob;
use App\Models\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{

    /**
     * Display the user's profile form.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Blog/Create', [
            'posts' => Post::all()
        ]);
    }

    /**
     * Make a post.
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'body' => $request->body
        ]);

        // Send notification to followers
        NotifyFollowersJob::dispatch($post);

        return to_route('dashboard')->with([
            'posts' => auth()->user()->posts,
            'followers' => auth()->user()->followers,
            'following' => auth()->user()->following
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function show(Post $post): Response
    {
        // Show the post, of course
        dd($post);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        dd('In theory, you could edit here.');
    }
}
