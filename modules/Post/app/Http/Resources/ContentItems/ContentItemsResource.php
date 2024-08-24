<?php

namespace Modules\Post\Http\Resources\ContentItems;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Post\Models\ContentItem;

/** @mixin ContentItem */

class ContentItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
//            'id' => $this->id,
            'type' => $this->data['type'],
            'data' => $this->data['data'],
        ];
    }

}
