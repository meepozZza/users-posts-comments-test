<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test create comment.
     *
     * @return void
     */
    public function test_create_comment(): void
    {
        $comment = Comment::factory()->create();

        $this->assertDatabaseHas('comments', $comment->toArray());
    }
}
