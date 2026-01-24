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
        Schema::table('contracts', function (Blueprint $table) {
            // Project type: buy_out or managed_service
            $table->enum('project_type', ['buy_out', 'managed_service'])->default('buy_out')->after('status');
            
            // Warranty period in days
            $table->integer('warranty_period')->default(14)->after('project_type')->comment('Warranty period in days');
            
            // Estimated duration in days
            $table->integer('estimated_duration')->nullable()->after('warranty_period')->comment('Project duration in days');
            
            // Payment terms (JSON) - pulled from quotation but can be overridden
            $table->json('payment_terms')->nullable()->after('estimated_duration')->comment('Payment term percentages and descriptions');
            
            // Managed Service specific fields
            $table->decimal('maintenance_fee', 15, 2)->nullable()->after('payment_terms')->comment('Monthly or yearly maintenance fee for managed service');
            $table->enum('maintenance_cycle', ['monthly', 'yearly'])->nullable()->after('maintenance_fee')->comment('Maintenance billing cycle');
            
            // Additional notes
            $table->text('deliverables')->nullable()->after('maintenance_cycle')->comment('Project deliverables checklist');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn([
                'project_type',
                'warranty_period',
                'estimated_duration',
                'payment_terms',
                'maintenance_fee',
                'maintenance_cycle',
                'deliverables',
            ]);
        });
    }
};
