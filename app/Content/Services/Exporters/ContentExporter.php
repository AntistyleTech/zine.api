<?php

declare(strict_types=1);

namespace App\Content\Services\Exporters;

use App\Account\Services\Data\AccountData as Account;
use App\Content\Services\Data\Content;
use App\Content\Services\Data\ContentExport;

interface ContentExporter
{
    public function export(Account $account, Content $content, mixed $target): ContentExport;
}
