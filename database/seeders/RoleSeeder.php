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
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo([
            'view pages', 'create pages', 'edit pages', 'delete pages',
            'view blog', 'create blog', 'edit blog', 'delete blog', 'publish blog',
            'view portfolio', 'create portfolio', 'edit portfolio', 'delete portfolio',
            'view services', 'create services', 'edit services', 'delete services',
            'view team', 'create team', 'edit team', 'delete team',
            'view testimonials', 'create testimonials', 'edit testimonials', 'delete testimonials',
            'view contacts', 'reply contacts', 'delete contacts',
            'view settings', 'edit settings',
        ]);

        $editor = Role::create(['name' => 'Editor']);
        $editor->givePermissionTo([
            'view pages', 'create pages', 'edit pages',
            'view blog', 'create blog', 'edit blog', 'publish blog',
            'view portfolio', 'create portfolio', 'edit portfolio',
            'view services', 'create services', 'edit services',
            'view team', 'create team', 'edit team',
            'view testimonials', 'create testimonials', 'edit testimonials',
            'view contacts', 'reply contacts',
        ]);

        $author = Role::create(['name' => 'Author']);
        $author->givePermissionTo([
            'view blog', 'create blog', 'edit blog',
            'view portfolio', 'create portfolio', 'edit portfolio',
        ]);
    }
}
