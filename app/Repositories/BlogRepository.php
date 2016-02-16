<?php

namespace App\Repositories;

use App\User;
use App\Blog;

class BlogRepository
{
    /**
     * Get all of the blogs for a given user.
     *
     * @param User $user
     *
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Blog::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function all()
    {
        return Blog::all();
    }

    public function find($id)
    {
        return Blog::where('id', $id);
    }
}
