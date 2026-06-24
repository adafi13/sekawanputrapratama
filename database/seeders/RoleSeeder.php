<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Pages
            'view pages',
            'create pages',
            'edit pages',
            'delete pages',
            // Blog
            'view blog',
            'create blog',
            'edit blog',
            'delete blog',
            'publish blog',
            // Portfolio
            'view portfolio',
            'create portfolio',
            'edit portfolio',
            'delete portfolio',
            // Services
            'view services',
            'create services',
            'edit services',
            'delete services',
            // Team
            'view team',
            'create team',
            'edit team',
            'delete team',
            // Testimonials
            'view testimonials',
            'create testimonials',
            'edit testimonials',
            'delete testimonials',
            // Contacts
            'view contacts',
            'reply contacts',
            'delete contacts',
            // Settings
            'view settings',
            'edit settings',
            // CRM: Leads
            'view leads',
            'create leads',
            'edit leads',
            'delete leads',
            // CRM: Customers
            'view customers',
            'create customers',
            'edit customers',
            'delete customers',
            // CRM: Quotations
            'view quotations',
            'create quotations',
            'edit quotations',
            'delete quotations',
            // CRM: Contracts
            'view contracts',
            'create contracts',
            'edit contracts',
            'delete contracts',
            // CRM: Projects
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',
            // CRM: Invoices
            'view invoices',
            'create invoices',
            'edit invoices',
            'delete invoices',
            // Users
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $crmFullAccess = [
            'view leads', 'create leads', 'edit leads', 'delete leads',
            'view customers', 'create customers', 'edit customers', 'delete customers',
            'view quotations', 'create quotations', 'edit quotations', 'delete quotations',
            'view contracts', 'create contracts', 'edit contracts', 'delete contracts',
            'view projects', 'create projects', 'edit projects', 'delete projects',
            'view invoices', 'create invoices', 'edit invoices', 'delete invoices',
        ];

        // Create roles and assign permissions (firstOrCreate + syncPermissions so this seeder is safe to re-run)
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->syncPermissions(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions(array_merge([
            'view pages', 'create pages', 'edit pages', 'delete pages',
            'view blog', 'create blog', 'edit blog', 'delete blog', 'publish blog',
            'view portfolio', 'create portfolio', 'edit portfolio', 'delete portfolio',
            'view services', 'create services', 'edit services', 'delete services',
            'view team', 'create team', 'edit team', 'delete team',
            'view testimonials', 'create testimonials', 'edit testimonials', 'delete testimonials',
            'view contacts', 'reply contacts', 'delete contacts',
            'view settings', 'edit settings',
        ], $crmFullAccess));

        $editor = Role::firstOrCreate(['name' => 'Editor']);
        $editor->syncPermissions([
            'view pages', 'create pages', 'edit pages',
            'view blog', 'create blog', 'edit blog', 'publish blog',
            'view portfolio', 'create portfolio', 'edit portfolio',
            'view services', 'create services', 'edit services',
            'view team', 'create team', 'edit team',
            'view testimonials', 'create testimonials', 'edit testimonials',
            'view contacts', 'reply contacts',
        ]);

        $author = Role::firstOrCreate(['name' => 'Author']);
        $author->syncPermissions([
            'view blog', 'create blog', 'edit blog',
            'view portfolio', 'create portfolio', 'edit portfolio',
        ]);

        // CRM roles
        $sales = Role::firstOrCreate(['name' => 'Sales']);
        $sales->syncPermissions([
            'view leads', 'create leads', 'edit leads', 'delete leads',
            'view customers', 'create customers', 'edit customers',
            'view quotations', 'create quotations', 'edit quotations', 'delete quotations',
            'view contracts', 'create contracts', 'edit contracts',
            'view projects',
        ]);

        $projectManager = Role::firstOrCreate(['name' => 'Project Manager']);
        $projectManager->syncPermissions([
            'view projects', 'create projects', 'edit projects', 'delete projects',
            'view contracts',
            'view customers',
            'view leads',
        ]);

        $finance = Role::firstOrCreate(['name' => 'Finance']);
        $finance->syncPermissions([
            'view invoices', 'create invoices', 'edit invoices', 'delete invoices',
            'view contracts',
            'view customers',
            'view projects',
        ]);
    }
}
