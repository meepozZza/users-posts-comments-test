<?php

namespace App\Models\Traits;

use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasPosts
{
    /**
     * Posts relation.
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id', 'id');
    }
}
