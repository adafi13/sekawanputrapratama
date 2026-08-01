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
        Schema::table('quotations', function (Blueprint $table) {
            // Add new dynamic fields
            $table->json('payment_terms')->nullable()->after('grand_total');
            $table->string('prepared_signature_path')->nullable()->after('prepared_by_position');
            $table->string('approved_signature_path')->nullable()->after('prepared_signature_path');
            
            // Drop old static payment terms fields
            $table->dropColumn([
                'payment_term_1_percentage',
                'payment_term_1_description',
                'payment_term_2_percentage',
                'payment_term_2_description',
                'payment_term_3_percentage',
                'payment_term_3_description',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            // Re-add old static payment terms fields
            $table->decimal('payment_term_1_percentage', 5, 2)->nullable();
            $table->text('payment_term_1_description')->nullable();
            $table->decimal('payment_term_2_percentage', 5, 2)->nullable();
            $table->text('payment_term_2_description')->nullable();
            $table->decimal('payment_term_3_percentage', 5, 2)->nullable();
            $table->text('payment_term_3_description')->nullable();

            // Drop new dynamic fields
            $table->dropColumn([
                'payment_terms',
                'prepared_signature_path',
                'approved_signature_path',
            ]);
        });
    }
};
