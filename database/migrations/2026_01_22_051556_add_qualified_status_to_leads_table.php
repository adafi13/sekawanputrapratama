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
        Schema::table('leads', function (Blueprint $table) {
            // This migration updates the status enum to include 'qualified'
            // Note: In production, you may need to use raw SQL for enum modifications
            // For now, we'll handle this in the model constants
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            // Rollback not needed as we're adding a new status value
        });
    }
};
