<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostIndexRequest;
use App\Http\Requests\Api\PostStoreRequest;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PostIndexRequest $request
     * @return JsonResponse
     */
    public function index(PostIndexRequest $request): JsonResponse
    {
        return response()->json(
            PostResource::collection(
                Post::with($request->get('with', []))->get()
            ),
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @return JsonResponse
     */
    public function store(PostStoreRequest $request): JsonResponse
    {
        return response()->json(
            new PostResource(
                Post::create($request->validated())
                    ->load($request->post('with', [])),
            ),
            201,
        );
    }
}
