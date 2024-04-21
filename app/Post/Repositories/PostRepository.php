<?php

declare(strict_types=1);

namespace App\Post\Repositories;

use App\Content\Services\Content;
use App\Post\Models\Post;
use App\Post\Services\Data\PostData;
use App\Post\Services\Data\SearchPosts;
use Illuminate\Database\Query\Builder;

final class PostRepository
{
    /**
     * @return Content[]
     */
    public function search(SearchPosts $search): array
    {
        $posts = Post::when($search->username,
            fn(Builder $query) => $query->where('account.username', $search->username)
        )->when($search->categories,
            fn(Builder $query) => $query->where('post.category', 'in', $search->categories)
        );

        return PostData::collect($posts);
    }
}
