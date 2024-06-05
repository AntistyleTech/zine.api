<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Category\app\Models\Category;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('categorisable', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class);
            $table->string('categorisable_id');
            $table->string('categorisable_type');
            $table->boolean('is_main')->comment('Category is main for categorisable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('categorisable');
    }
};
