<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserIndexRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UserIndexRequest $request
     * @return JsonResponse
     */
    public function index(UserIndexRequest $request): JsonResponse
    {
        return response()->json(
            UserResource::collection(
                User::with($request->get('with', []))->get(),
            ),
        );
    }
}
