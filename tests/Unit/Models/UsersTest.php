<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test user create.
     *
     * @return void
     */
    public function test_create_user(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', $user->toArray());
    }

    /**
     * Test create user post relation
     *
     * @return void
     */
    public function test_create_user_posts_relation(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', $user->toArray());

        $post = $user->posts()->create([
            'title' => 'Hello world!',
            'description' => 'Lorem ipsum.',
        ]);

        $this->assertDatabaseHas('posts', $post->toArray());
    }

    /**
     * Test create user comments relation.
     *
     * @return void
     */
    public function test_create_user_comments_relation(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', $user->toArray());

        $post = Post::factory()->create([
            'author_id' => $user->id,
        ]);

        $this->assertDatabaseHas('posts', $post->toArray());

        $comment = $user->comments()->create([
            'post_id' => $post->id,
            'body' => 'Hello world!',
        ]);

        $this->assertDatabaseHas('comments', $comment->toArray());
    }
}
