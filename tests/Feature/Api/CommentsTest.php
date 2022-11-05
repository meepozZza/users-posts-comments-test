<?php

namespace Tests\Feature\Api;

use App\Models\Comment;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test comment store route.
     *
     * @return void
     */
    public function test_store_comment()
    {
        $commentData = Comment::factory()->make()->toArray();

        $response = $this->postJson(
            route('api.comments.store'),
            $commentData,
        );

        $response->assertCreated();

        $this->assertDatabaseHas('comments', $commentData);
    }
}
