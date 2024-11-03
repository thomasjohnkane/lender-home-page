<?php

namespace App\Jobs;

use App\Models\Post;
use App\Notifications\NotifyFollowerAboutPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NotifyFollowersJob implements ShouldQueue
{
    use Queueable;

    public $post;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $followers = $this->post->user->followers;
        foreach ($followers as $user) {
            // Notify the user
            $user->notify(new NotifyFollowerAboutPost($this->post));
        }
    }
}
