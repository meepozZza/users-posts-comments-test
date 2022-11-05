<?php

namespace Tests\Unit\Http\Requests;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentStoreRequestTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var string
     */
    protected string $routePrefix = 'api.comments';

    /**
     * Test comment body is string.
     *
     * @return void
     */
    public function test_body_is_string(): void
    {
        $validatedField = 'body';

        $modelData = Post::factory()->make([
            $validatedField => true,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test comment body is required.
     *
     * @return void
     */
    public function test_body_is_required(): void
    {
        $validatedField = 'body';

        $modelData = Comment::factory()->make([
            $validatedField => null,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test comment author_id is integer.
     *
     * @return void
     */
    public function test_author_id_is_integer(): void
    {
        $validatedField = 'author_id';

        $modelData = Post::factory()->make([
            $validatedField => true,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test comment author_id is required.
     *
     * @return void
     */
    public function test_author_id_is_required(): void
    {
        $validatedField = 'author_id';

        $modelData = Comment::factory()->make([
            $validatedField => null,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test comment author_id is exists.
     *
     * @return void
     */
    public function test_author_id_is_exists(): void
    {
        $validatedField = 'author_id';

        $modelData = Comment::factory()->make([
            $validatedField => User::orderByDesc('id')->first()?->id + 1,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test comment post_id is integer.
     *
     * @return void
     */
    public function test_post_id_is_integer(): void
    {
        $validatedField = 'post_id';

        $modelData = Post::factory()->make([
            $validatedField => true,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test comment post_id is required.
     *
     * @return void
     */
    public function test_post_id_is_required(): void
    {
        $validatedField = 'post_id';

        $modelData = Comment::factory()->make([
            $validatedField => null,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test comment post_id is exists.
     *
     * @return void
     */
    public function test_post_id_is_exists(): void
    {
        $validatedField = 'post_id';

        $modelData = Comment::factory()->make([
            $validatedField => Post::orderByDesc('id')->first()?->id + 1,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }
}
