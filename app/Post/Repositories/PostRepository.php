<?php

declare(strict_types=1);

namespace App\Post\Repositories;

use App\Content\Services\Content;
use App\Post\Models\Post;
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
            fn (Builder $builder) => $builder->where('account.username', $search->username)
        )->all();

        return $posts;
    }
}
