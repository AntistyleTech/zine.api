<?php

namespace App\Post\Http\Controllers;

use App\Controller;
use App\Post\Http\Requests\IndexPostRequest;
use App\Post\Http\Requests\StorePostRequest;
use App\Post\Http\Requests\UpdatePostRequest;
use App\Post\Services\Data\SearchPosts;
use App\Post\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexPostRequest $request)
    {
        $search = SearchPosts::from($request->validated());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
