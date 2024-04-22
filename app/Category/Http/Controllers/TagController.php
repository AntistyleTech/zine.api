<?php

namespace App\Category\Http\Controllers;

use App\Category\Http\Requests\TagIndexRequest;
use App\Category\Services\Data\TagData;
use App\Category\Services\TagService;
use Illuminate\Http\Request;

class TagController
{
    public function __construct(
        private readonly TagService $tagService
    ) {
    }

    public function index(TagIndexRequest $request): array
    {
        return $this->tagService->all();
    }

    // TODO: implement other routes
    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
