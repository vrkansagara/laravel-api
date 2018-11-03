<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $roles = [
            [
                'name'=>'system-admin',
                'display_name'=>'System Admin',
                'guard_name'=>'api',
            ],
            [
                'name'=>'supper-admin',
                'display_name'=>'Supper Admin',
                'guard_name'=>'api',
            ],
            [
                'name'=>'admin',
                'display_name'=>'Admin',
                'guard_name'=>'api',
            ],
            [
                'name'=>'guest',
                'display_name'=>'Guest',
                'guard_name'=>'api',
            ],
            [
                'name'=>'band',
                'display_name'=>'Band',
                'guard_name'=>'api',
            ]
        ];
        foreach ($roles as $role){
            Role::create($role);
        }


        $permisionMetaItems = ['create','update','delte','view','enable','disable'];
        $permissionModules = [
            'user',
            'company',
            'role',
            'permission',
            'audit-log',
            'application-log',
            'oauth2',
            'dashboard'
        ];

        $permissionListWithModuleItems = [];
        foreach($permissionModules as $permissionModule){
            foreach($permisionMetaItems as $permisionMetaItem){
                $permissionListWithModuleItems[] = $permissionModule.'-'.$permisionMetaItem;
            }
        }


        foreach ($permissionListWithModuleItems as $permissionListWithModuleItem){
            $displayName = explode('-',$permissionListWithModuleItem);
            $permission = [
                'name' => $permissionListWithModuleItem,
                'display_name' => ucfirst($displayName[0]).' '.$displayName[1],
                'guard_name' => 'api',
            ];

            Permission::create($permission);
        }

        $role = Role::findByName('system-admin','api');
        $role->givePermissionTo(Permission::all());

        $role = Role::findByName('supper-admin','api');
        $role->givePermissionTo(Permission::all());
    }
}
