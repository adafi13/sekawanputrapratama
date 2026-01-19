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
        Schema::table('services', function (Blueprint $table) {
            $table->json('features')->nullable()->after('content');
            $table->json('technologies')->nullable()->after('features');
            $table->decimal('pricing_starting_from', 10, 2)->nullable()->after('technologies');
            $table->string('delivery_time')->nullable()->after('pricing_starting_from');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['features', 'technologies', 'pricing_starting_from', 'delivery_time']);
        });
    }
};
