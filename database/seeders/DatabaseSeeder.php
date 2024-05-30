<?php

namespace Database\Seeders;

use App\Auth\Models\User;
use App\Content\Models\ContentItem;
use App\Post\Models\Post;
use App\User\Models\Account;
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
                ->has(Post::factory()->count(3)
                    ->has(ContentItem::factory()->count(3))
                )
            )->create();
    }
}
