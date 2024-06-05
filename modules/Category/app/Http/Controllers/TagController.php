<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Category\Http\Requests\TagIndexRequest;
use Modules\Category\Services\TagService;

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
