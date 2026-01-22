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
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('customer_id')->nullable()->after('lead_id')->constrained()->nullOnDelete();
            $table->foreignId('contract_id')->nullable()->after('customer_id')->constrained()->nullOnDelete();
            $table->timestamp('contract_signed_at')->nullable()->after('contract_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['contract_id']);
            $table->dropColumn(['customer_id', 'contract_id', 'contract_signed_at']);
        });
    }
};
