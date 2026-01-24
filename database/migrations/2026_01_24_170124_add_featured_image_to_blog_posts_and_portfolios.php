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
            $table->string('featured_image')->nullable()->after('content');
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('featured_image')->nullable()->after('content');
            $table->json('images')->nullable()->after('featured_image')->comment('Gallery images array');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('featured_image');
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['featured_image', 'images']);
        });
    }
};
