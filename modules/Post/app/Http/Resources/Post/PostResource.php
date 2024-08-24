<?php

namespace Modules\Post\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Post\Http\Resources\ContentItems\ContentItemsResource;
use Modules\Post\Models\Post;

/** @mixin Post */

class PostResource extends JsonResource
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
            'blocks' => ContentItemsResource::collection($this->contentItems)
        ];
    }

}
