<?php

namespace App\Models;

use App\Models\Traits\HasAuthor;
use App\Models\Traits\HasPosts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasAuthor, HasPosts, HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'author_id',
        'post_id',
        'body',
    ];
}
