<?php


namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Database\Factories\UserFactory;

class PermissionsSeeder extends Seeder
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
        Permission::create(['name' => 'folder access']);
        Permission::create(['name' => 'sent internal message']);
        Permission::create(['name' => 'upload external file']);
        Permission::create(['name' => 'manage account with staff role']);
        Permission::create(['name' => 'manage account with admin role']);
        Permission::create(['name' => 'manage sub organizations']);

        //super admin has all permissions 
        $superAdminRole = Role::create(['name' => 'Super-Admin']);
                
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('folder access');
        $adminRole->givePermissionTo('sent internal message');
        $adminRole->givePermissionTo('upload external file');
        $adminRole->givePermissionTo('manage account with staff role');
        $adminRole->givePermissionTo('manage sub organizations');

        $frontDeskRole = Role::create(['name' => 'front desk']);
        $frontDeskRole->givePermissionTo('folder access');
        $frontDeskRole->givePermissionTo('sent internal message');
        $frontDeskRole->givePermissionTo('upload external file');
        $frontDeskRole->givePermissionTo('manage account with staff role');
        $frontDeskRole->givePermissionTo('manage sub organizations');
        
        $staffRole = Role::create(['name' => 'staff']);
        $staffRole->givePermissionTo('folder access');
        $staffRole->givePermissionTo('sent internal message');        
    }
}
