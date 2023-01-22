<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{

    public function run()
    {
        Permission::create(['name' => 'viewAny-users']);
        Permission::create(['name' => 'view-users']);
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'viewAny-categories']);
        Permission::create(['name' => 'view-categories']);
        Permission::create(['name' => 'create-categories']);
        Permission::create(['name' => 'edit-categories']);
        Permission::create(['name' => 'delete-categories']);

        Permission::create(['name' => 'viewAny-lessons']);
        Permission::create(['name' => 'view-lessons']);
        Permission::create(['name' => 'create-lessons']);
        Permission::create(['name' => 'edit-lessons']);
        Permission::create(['name' => 'delete-lessons']);

        Permission::create(['name' => 'viewAny-assignments']);
        Permission::create(['name' => 'view-assignments']);
        Permission::create(['name' => 'create-assignments']);
        Permission::create(['name' => 'edit-assignments']);
        Permission::create(['name' => 'delete-assignments']);

        Permission::create(['name' => 'viewAny-additionals']);
        Permission::create(['name' => 'view-additionals']);
        Permission::create(['name' => 'create-additionals']);
        Permission::create(['name' => 'edit-additionals']);
        Permission::create(['name' => 'delete-additionals']);

        Permission::create(['name' => 'viewAny-responses']);
        Permission::create(['name' => 'view-responses']);
        Permission::create(['name' => 'create-responses']);
        Permission::create(['name' => 'edit-responses']);
        Permission::create(['name' => 'delete-responses']);

        Permission::create(['name' => 'viewAny-comments']);
        Permission::create(['name' => 'view-comments']);
        Permission::create(['name' => 'create-comments']);
        Permission::create(['name' => 'delete-comments']);

        $adminRole = Role::create(['name' => 'super-admin']);
        $userRole = Role::create(['name' => 'user']);

        $adminRole->givePermissionTo([
            'viewAny-users',
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',

            'viewAny-categories',
            'view-categories',
            'create-categories',
            'edit-categories',
            'delete-categories',

            'viewAny-lessons',
            'view-lessons',
            'create-lessons',
            'edit-lessons',
            'delete-lessons',

            'viewAny-assignments',
            'view-assignments',
            'create-assignments',
            'edit-assignments',
            'delete-assignments',

            'viewAny-additionals',
            'view-additionals',
            'create-additionals',
            'edit-additionals',
            'delete-additionals',

            'viewAny-responses',
            'view-responses',
            'create-responses',
            'edit-responses',
            'delete-responses',

            'viewAny-comments',
            'view-comments',
            'create-comments',
            'delete-comments',
        ]);

        $userRole->givePermissionTo([
            'view-additionals',

            'view-categories',

            'view-lessons',

            'view-assignments',

            'create-responses',

            'view-comments',
            'create-comments',
        ]);

    }
}
