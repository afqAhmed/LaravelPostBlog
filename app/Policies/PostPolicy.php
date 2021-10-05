<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

// php artisan make:policy PostPolicy
// App/Policies/PostPolicy

class PostPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Post $post) {
        return $user->id === $post->user_id;
    }

}
