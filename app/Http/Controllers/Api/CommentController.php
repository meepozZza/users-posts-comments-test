<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CommentStoreRequest;
use App\Http\Resources\Api\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CommentStoreRequest $request
     * @return JsonResponse
     */
    public function store(CommentStoreRequest $request): JsonResponse
    {
        return response()->json(
            new CommentResource(
                Comment::create($request->validated())
                    ->load($request->post('with', [])),
            ),
            201,
        );
    }
}
