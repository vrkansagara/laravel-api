<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    use DatabaseTrait;

    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate(config('permission.table_names.role_has_permissions'));
        $this->truncate(config('permission.table_names.model_has_roles'));
        $this->truncate(config('permission.table_names.model_has_permissions'));
        $this->truncate(config('permission.table_names.permissions'));
        $this->truncate(config('permission.table_names.roles'));

        $this->enableForeignKeys();


        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $roles = [
            [
                'name' => 'system-admin',
                'display_name' => 'System Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'supper-most-admin',
                'display_name' => 'Supper Most Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'supper-admin',
                'display_name' => 'Supper Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'guest',
                'display_name' => 'Guest',
                'guard_name' => 'web',
            ],
            [
                'name' => 'band',
                'display_name' => 'Band',
                'guard_name' => 'web',
            ]
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }


        $permisionMetaItems = [
            'index',
            'view',
            'create',
            'edit',
            'update',
            'enable',
            'disable',
            'delete',
            'forceDelete',
            'restore',
            'manage',
        ];
        $permissionModules = [
            'user',
            'role',
            'permission',
            'dashboard',
            'blog',
            'blog-category',
            'blog-tags',
            'company',
            'audit-log',
            'application-log',
            'oauth2',
        ];

        $permissionListWithModuleItems = [];
        foreach ($permissionModules as $permissionModule) {
            foreach ($permisionMetaItems as $permisionMetaItem) {
                $permissionListWithModuleItems[] = $permissionModule . '-' . $permisionMetaItem;
            }
        }


        foreach ($permissionListWithModuleItems as $permissionListWithModuleItem) {
            $displayName = explode('-', $permissionListWithModuleItem);
            $permission = [
                'name' => $permissionListWithModuleItem,
                'display_name' => ucfirst($displayName[0]) . ' ' . $displayName[1],
                'guard_name' => 'web',
            ];

            Permission::create($permission);
        }

        $role = Role::findByName('system-admin', 'web');
        $role->givePermissionTo(Permission::all());
        $role->save();

        $role = Role::findByName('supper-admin', 'web');
        $role->givePermissionTo(Permission::all());
        $role->save();



        // Creating bad permission and it's combination.
        $permisionMetaItems = [
            'manageBan',
        ];

        $permissionListWithModuleItems = [];
        foreach ($permissionModules as $permissionModule) {
            foreach ($permisionMetaItems as $permisionMetaItem) {
                $permissionListWithModuleItems[] = $permissionModule . '-' . $permisionMetaItem;
            }
        }

        foreach ($permissionListWithModuleItems as $permissionListWithModuleItem) {
            $displayName = explode('-', $permissionListWithModuleItem);
            $permission = [
                'name' => $permissionListWithModuleItem,
                'display_name' => ucfirst($displayName[0]) . ' ' . $displayName[1],
                'guard_name' => 'web',
            ];

            Permission::create($permission);
        }


        app()['cache']->forget('spatie.permission.cache');


    }
}
