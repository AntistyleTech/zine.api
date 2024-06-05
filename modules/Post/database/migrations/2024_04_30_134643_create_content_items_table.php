<?php

use App\Content\Models\Content;
use App\Contracts\Content\Enum\ContentItemType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('content_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Content::class);
            $table->enum('type', array_map(fn(UnitEnum $type): string => $type->value, ContentItemType::cases()));
            $table->text('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_items');
    }
};
