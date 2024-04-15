<?php

namespace Database\Seeders;

use App\Account\Models\Account;
use App\Auth\Models\User;
use App\Content\Models\Content;
use App\Content\Models\ContentItem;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->count(3)
            ->has(Account::factory()->count(1)
                ->has(Content::factory()->count(3)
                    ->has(ContentItem::factory()->count(3))
                )
            )->create();
    }
}
