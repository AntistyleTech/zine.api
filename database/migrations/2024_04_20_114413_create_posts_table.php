<?php

use App\Account\Models\Account;
use App\Category\Models\Category;
use App\Content\Services\Data\enum\ContentItemType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Account::class);
            $table->foreignIdFor(Category::class);
            $table->string('title')->nullable()->default('No name');
            $table->enum('type', [
                ContentItemType::Text->value,
                ContentItemType::Html->value,
                ContentItemType::Markdown->value
            ])->default(ContentItemType::Text);
            $table->text('content')->nullable()->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
