<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPostIndexRequest;
use App\Http\Resources\Api\PostResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UserPostIndexRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function index(UserPostIndexRequest $request, User $user): JsonResponse
    {
        return response()->json(
            PostResource::collection(
                $user->posts()
                    ->with($request->get('with', []))
                    ->get()
            )
        );
    }
}
