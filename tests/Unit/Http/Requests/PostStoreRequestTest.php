<?php

namespace Tests\Unit\Http\Requests;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PostStoreRequestTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var string
     */
    protected string $routePrefix = 'api.posts';

    /**
     * Test post title is string.
     *
     * @return void
     */
    public function test_title_is_string(): void
    {
        $validatedField = 'title';

        $modelData = Post::factory()->make([
            $validatedField => true,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test post title is required.
     *
     * @return void
     */
    public function test_title_is_required(): void
    {
        $validatedField = 'title';

        $modelData = Post::factory()->make([
            $validatedField => null,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test post description is string.
     *
     * @return void
     */
    public function test_description_is_string(): void
    {
        $validatedField = 'description';

        $modelData = Post::factory()->make([
            $validatedField => true,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test post description is required.
     *
     * @return void
     */
    public function test_description_is_required(): void
    {
        $validatedField = 'description';

        $modelData = Post::factory()->make([
            $validatedField => null,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test post author_id is integer.
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
     * Test post author_id is required.
     *
     * @return void
     */
    public function test_author_id_is_required(): void
    {
        $validatedField = 'author_id';

        $modelData = Post::factory()->make([
            $validatedField => null,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * Test post author_id is exists.
     *
     * @return void
     */
    public function test_author_id_is_exists(): void
    {
        $validatedField = 'author_id';

        $modelData = Post::factory()->make([
            $validatedField => User::orderByDesc('id')->first()?->id + 1,
        ]);

        $this->postJson(
            route("{$this->routePrefix}.store"),
            $modelData->toArray(),
        )->assertJsonValidationErrors($validatedField);
    }
}
