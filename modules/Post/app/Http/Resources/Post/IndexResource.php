<?php

namespace Modules\Post\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Post\Models\Post;

/** @mixin Post */

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'meta' => $this->meta,
//            'contentItems' => $this
//            'category' => new CategoryResource($this->category),
//            'image' => $this->getProfileUrlAttribute(),
//            'author' => $this->when(auth()->user()->hasRole('manager'), new UserResource($this->author)),
        ];
    }

}
