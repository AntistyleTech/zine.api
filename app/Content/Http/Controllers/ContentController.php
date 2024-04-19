<?php

namespace App\Content\Http\Controllers;

use App\Auth\Services\AuthService;
use App\Content\Http\Requests\IndexContentRequest;
use App\Content\Http\Requests\UpdateContentRequest;
use App\Content\Services\ContentService;

class ContentController
{
    public function __construct(
        private readonly ContentService $contentService,
        private readonly AuthService $auth
    ) {
    }

    public function index(IndexContentRequest $content)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContenRequest $request)
    {
        return $this->contentService->create();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->contentService->read($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContentRequest $request, int $id)
    {
        return $this->contentService->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
