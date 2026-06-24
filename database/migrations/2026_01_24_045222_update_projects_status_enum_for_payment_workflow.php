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
        // The `status` column is a plain string (see create_projects_table), so this
        // enum constraint is MySQL-only cosmetic hardening; other drivers (e.g. sqlite
        // in tests) already accept any of these values without it.
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE projects MODIFY COLUMN status ENUM(
                'awaiting_contract',
                'awaiting_dp',
                'planning',
                'dev_phase_1',
                'dev_phase_2',
                'uat',
                'deployment',
                'in_progress',
                'completed',
                'on_hold',
                'cancelled'
            ) NOT NULL DEFAULT 'awaiting_contract'");
        }

        // Migrate existing data to new workflow
        // awaiting_contract stays (legacy support)
        // in_progress → dev_phase_1 (map old in-progress to development phase 1)
        DB::table('projects')
            ->where('status', 'in_progress')
            ->update(['status' => 'dev_phase_1']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert migrated data
        DB::table('projects')
            ->where('status', 'dev_phase_1')
            ->update(['status' => 'in_progress']);

        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE projects MODIFY COLUMN status ENUM(
                'awaiting_contract',
                'planning',
                'in_progress',
                'completed',
                'on_hold',
                'cancelled'
            ) NOT NULL DEFAULT 'awaiting_contract'");
        }
    }
};
