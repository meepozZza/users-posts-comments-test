<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'body' => $this->resource->body,
            'author' => UserResource::collection($this->whenLoaded('author')),
            'post' => PostResource::collection($this->whenLoaded('post')),
        ];
    }
}
