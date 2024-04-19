<?php

declare(strict_types=1);

namespace App\Content\Services;

use App\Content\Services\Data\ContentData;
use App\Content\Services\Data\UpdateContent;

final class ContentService
{
    /**
     * @return ContentData[]
     */
    public function search(): array
    {
        return [new ContentData()];
    }

    public function create(): ContentData
    {
        return new ContentData();
    }

    public function read(int $id): ?ContentData
    {
        return new ContentData();
    }

    public function update(UpdateContent $update): ContentData
    {
        return new ContentData();
    }

    public function delete(): void
    {

    }
}
