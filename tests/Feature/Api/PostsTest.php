<?php

namespace Tests\Feature\Api;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test post index route.
     *
     * @return void
     */
    public function test_get_posts(): void
    {
        $post = Post::factory()->create();

        $response = $this->getJson(route('api.posts.index'));

        $response->assertOk();

        $response->assertJson([
            [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description,
            ]
        ]);
    }

    /**
     * Test post store route.
     *
     * @return void
     */
    public function test_store_post(): void
    {
        $postData = Post::factory()->make()->toArray();

        $response = $this->postJson(
            route('api.posts.store'),
            $postData,
        );

        $response->assertCreated();

        $this->assertDatabaseHas('posts', $postData);
    }

    /**
     * Test get user posts.
     *
     * @return void
     */
    public function test_get_user_posts(): void
    {
        $user = User::factory()->create();

        $postData = Post::factory()->make()->toArray();

        $post = $user->posts()->create($postData);

        $response = $this->actingAs($user)
            ->getJson(route('api.users.posts.index', ['user' => $user->id]));

        $response->assertOk();

        $response->assertJson([
            [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description,
            ]
        ]);
    }
}
