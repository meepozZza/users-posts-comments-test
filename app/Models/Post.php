<?php

namespace App\Models;

use App\Models\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasAuthor, HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'title',
        'description',
        'author_id',
    ];

    /**
     * Comments relation.
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
