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
        Schema::table('invoices', function (Blueprint $table) {
            $table->enum('payment_method', ['bank_transfer_bca', 'bank_transfer_mandiri', 'cash', 'check', 'credit_card'])->nullable()->after('status');
            $table->string('payment_proof_path')->nullable()->after('payment_method');
            $table->string('bank_account')->nullable()->after('payment_proof_path');
            $table->string('paid_by')->nullable()->after('bank_account');
            $table->text('payment_notes')->nullable()->after('paid_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_proof_path', 'bank_account', 'paid_by', 'payment_notes']);
        });
    }
};
