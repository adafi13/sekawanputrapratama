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
        Schema::table('portfolios', function (Blueprint $table) {
            $table->text('challenge')->nullable()->after('content');
            $table->text('solution')->nullable()->after('challenge');
            $table->text('results')->nullable()->after('solution');
            $table->json('metrics')->nullable()->after('results');
            $table->string('client_industry')->nullable()->after('client_name');
            $table->string('project_duration')->nullable()->after('project_date');
            $table->foreignId('service_id')->nullable()->after('category_id')->constrained('services')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['challenge', 'solution', 'results', 'metrics', 'client_industry', 'project_duration', 'service_id']);
        });
    }
};
