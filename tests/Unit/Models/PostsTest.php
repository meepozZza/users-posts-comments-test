<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test create post.
     *
     * @return void
     */
    public function test_create_post(): void
    {
        $post = Post::factory()->create();

        $this->assertDatabaseHas('posts', $post->toArray());
    }
}
