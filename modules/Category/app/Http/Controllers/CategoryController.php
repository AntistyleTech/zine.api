<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Category\Http\Requests\CategoryIndexRequest;
use Modules\Category\Services\CategoryService;

class CategoryController
{
    public function __construct(
        private readonly CategoryService $categoryService
    ) {
    }

    public function index(CategoryIndexRequest $request): array
    {
        return $this->categoryService->all();
    }

    // TODO: implement other routes
    public function store(Request $request)
    {

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
