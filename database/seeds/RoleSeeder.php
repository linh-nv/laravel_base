<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
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
        //Root
        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);

        Permission::create(['name' => 'add shareholders']);
        Permission::create(['name' => 'edit shareholders']);
        Permission::create(['name' => 'delete shareholders']);
        Permission::create(['name' => 'view shareholders']);

        Permission::create(['name' => 'add capitals']);
        Permission::create(['name' => 'edit capitals']);
        Permission::create(['name' => 'delete capitals']);
        Permission::create(['name' => 'view capitals']);

        //Root,Staff,Shareholder
        Permission::create(['name' => 'add categories']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'delete categories']);
        Permission::create(['name' => 'view categories']);

        Permission::create(['name' => 'add customers']);
        Permission::create(['name' => 'edit customers']);
        Permission::create(['name' => 'delete customers']);
        Permission::create(['name' => 'view customers']);

        Permission::create(['name' => 'add invoice types']);
        Permission::create(['name' => 'edit invoice types']);
        Permission::create(['name' => 'delete invoice types']);
        Permission::create(['name' => 'view invoice types']);
        Permission::create(['name' => 'add invoices']);
        Permission::create(['name' => 'edit invoices']);
        Permission::create(['name' => 'delete invoices']);
        Permission::create(['name' => 'view invoices']);

        Permission::create(['name' => 'add products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'view products']);

        Permission::create(['name' => 'add pawn receipts']);
        Permission::create(['name' => 'edit pawn receipts']);
        Permission::create(['name' => 'delete pawn receipts']);
        Permission::create(['name' => 'view pawn receipts']);

        //create Role & give Permission
        //Root
        $rootRole = Role::create(['name' => 'root']);
        $rootRole->syncPermissions(Permission::all());

        //Shareholder
        $roleShareholder = Role::create(['name' => 'shareholder']);
        $roleShareholder->givePermissionTo('add categories');
        $roleShareholder->givePermissionTo('edit categories');
        $roleShareholder->givePermissionTo('delete categories');
        $roleShareholder->givePermissionTo('view categories');

        $roleShareholder->givePermissionTo('add customers');
        $roleShareholder->givePermissionTo('edit customers');
        $roleShareholder->givePermissionTo('delete customers');
        $roleShareholder->givePermissionTo('view customers');

        $roleShareholder->givePermissionTo('add invoice types');
        $roleShareholder->givePermissionTo('edit invoice types');
        $roleShareholder->givePermissionTo('delete invoice types');
        $roleShareholder->givePermissionTo('view invoice types');
        $roleShareholder->givePermissionTo('add invoices');
        $roleShareholder->givePermissionTo('edit invoices');
        $roleShareholder->givePermissionTo('delete invoices');
        $roleShareholder->givePermissionTo('view invoices');

        $roleShareholder->givePermissionTo('add products');
        $roleShareholder->givePermissionTo('edit products');
        $roleShareholder->givePermissionTo('delete products');
        $roleShareholder->givePermissionTo('view products');

        $roleShareholder->givePermissionTo('add pawn receipts');
        $roleShareholder->givePermissionTo('edit pawn receipts');
        $roleShareholder->givePermissionTo('delete pawn receipts');
        $roleShareholder->givePermissionTo('view pawn receipts');

        //Staff
        $roleStaff = Role::create(['name' => 'staff']);
        $roleStaff->givePermissionTo('add categories');
        $roleStaff->givePermissionTo('edit categories');
        $roleStaff->givePermissionTo('delete categories');
        $roleStaff->givePermissionTo('view categories');

        $roleStaff->givePermissionTo('add customers');
        $roleStaff->givePermissionTo('edit customers');
        $roleStaff->givePermissionTo('delete customers');
        $roleStaff->givePermissionTo('view customers');

        $roleStaff->givePermissionTo('add invoice types');
        $roleStaff->givePermissionTo('edit invoice types');
        $roleStaff->givePermissionTo('delete invoice types');
        $roleStaff->givePermissionTo('view invoice types');
        $roleStaff->givePermissionTo('add invoices');
        $roleStaff->givePermissionTo('edit invoices');
        $roleStaff->givePermissionTo('delete invoices');
        $roleStaff->givePermissionTo('view invoices');

        $roleStaff->givePermissionTo('add products');
        $roleStaff->givePermissionTo('edit products');
        $roleStaff->givePermissionTo('delete products');
        $roleStaff->givePermissionTo('view products');

        $roleStaff->givePermissionTo('add pawn receipts');
        $roleStaff->givePermissionTo('edit pawn receipts');
        $roleStaff->givePermissionTo('delete pawn receipts');
        $roleStaff->givePermissionTo('view pawn receipts');


    }
}
