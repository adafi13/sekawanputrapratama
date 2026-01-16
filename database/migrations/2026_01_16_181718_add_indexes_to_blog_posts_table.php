<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            // Add index for status (used in WHERE clause)
            $table->index('status', 'blog_posts_status_index');

            // Add index for published_at (used in WHERE and ORDER BY)
            $table->index('published_at', 'blog_posts_published_at_index');

            // Add composite index for common query pattern (status + published_at)
            $table->index(['status', 'published_at'], 'blog_posts_status_published_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIndex('blog_posts_status_index');
            $table->dropIndex('blog_posts_published_at_index');
            $table->dropIndex('blog_posts_status_published_at_index');
        });
    }
};
