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
            // Pricing details (enhance existing)
            $table->decimal('discount_percentage', 5, 2)->default(0)->after('discount_amount');
            $table->boolean('include_tax')->default(true)->after('discount_percentage');
            $table->decimal('tax_percentage', 5, 2)->default(11)->after('include_tax');
            $table->decimal('grand_total', 15, 2)->default(0)->after('total_amount');
            
            // Payment terms (3 termin)
            $table->decimal('payment_term_1_percentage', 5, 2)->default(30)->after('grand_total');
            $table->decimal('payment_term_2_percentage', 5, 2)->default(40)->after('payment_term_1_percentage');
            $table->decimal('payment_term_3_percentage', 5, 2)->default(30)->after('payment_term_2_percentage');
            $table->text('payment_term_1_description')->nullable()->after('payment_term_3_percentage');
            $table->text('payment_term_2_description')->nullable()->after('payment_term_1_description');
            $table->text('payment_term_3_description')->nullable()->after('payment_term_2_description');
            
            // Revision terms
            $table->integer('revision_rounds')->default(3)->after('payment_term_3_description');
            $table->text('revision_notes')->nullable()->after('revision_rounds');
            
            // Metadata
            $table->integer('validity_days')->default(30)->after('notes');
            $table->string('prepared_by')->nullable()->after('validity_days');
            $table->string('prepared_by_position')->nullable()->after('prepared_by');
            $table->string('sales_pic')->nullable()->after('prepared_by_position');
            
            // Terms & Conditions (JSON for flexibility)
            $table->json('terms_and_conditions')->nullable()->after('sales_pic');
            
            // PDF
            $table->string('pdf_path')->nullable()->after('file_path');
            $table->timestamp('pdf_generated_at')->nullable()->after('pdf_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn([
                'discount_percentage',
                'include_tax',
                'tax_percentage',
                'grand_total',
                'payment_term_1_percentage',
                'payment_term_2_percentage',
                'payment_term_3_percentage',
                'payment_term_1_description',
                'payment_term_2_description',
                'payment_term_3_description',
                'revision_rounds',
                'revision_notes',
                'validity_days',
                'prepared_by',
                'prepared_by_position',
                'sales_pic',
                'terms_and_conditions',
                'pdf_path',
                'pdf_generated_at',
            ]);
        });
    }
};
