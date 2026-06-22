<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->timestamp('newsletter_sent_at')->nullable()->after('status');
        });

        // Backfill existing published posts so editing them later doesn't trigger
        // a newsletter blast for content subscribers have already had a chance to see.
        DB::table('blog_posts')
            ->where('status', 'published')
            ->update(['newsletter_sent_at' => DB::raw('COALESCE(published_at, created_at)')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('newsletter_sent_at');
        });
    }
};
