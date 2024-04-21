<?php

declare(strict_types=1);

namespace App\Post\Services;

use App\Post\Repositories\PostRepository;
use App\Post\Services\Data\SearchPosts;

final class PostService
{
    public function __construct(
        private readonly PostRepository $postRepository
    ) {

    }

    public function searchPost(SearchPosts $searchPosts)
    {
        return $this->postRepository->search($searchPosts);
    }
}
