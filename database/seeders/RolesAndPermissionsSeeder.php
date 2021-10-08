<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
        
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'manage_user']);
        Permission::create(['name' => 'manage_role']);
        Permission::create(['name' => 'manage_permission']);
        Permission::create(['name' => 'manage_role|manage_user']);
        Permission::create(['name' => 'manage_permission|manage_user']);
                        
        $role = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role->givePermissionTo('manage_user');
        $role->givePermissionTo('manage_role');
        $role->givePermissionTo('manage_permission');
        $role->givePermissionTo('manage_role|manage_user');
        $role->givePermissionTo('manage_permission|manage_user');

        $user = User::factory()->create([
                    'name' => 'Super-Admin User',
                    'email' => 'superadmin@gmail.com',
                ]);
        $user->assignRole($role);
    }
}
