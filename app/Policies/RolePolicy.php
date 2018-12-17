<?php

namespace App\Policies;

use App\Entities\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function index()
    {
        /**
         * @todo Add custom logic using spatie/laravel-permission
         */
        return true;
    }


    public function show($id)
    {
        /**
         * @todo Add custom logic using spatie/laravel-permission
         */
        return true;
    }


    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\Entities\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function view($id)
    {
        /**
         * @todo Add custom logic using spatie/laravel-permission
         */
        return true;
    }

    public function store($id)
    {
        /**
         * @todo Add custom logic using spatie/laravel-permission
         */
        return true;
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\Entities\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        /**
         * @todo Add custom logic using spatie/laravel-permission
         */
        return true;
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\Entities\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function update()
    {
        /**
         * @todo Add custom logic using spatie/laravel-permission
         */
        return true;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\Entities\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function destroy()
    {
        /**
         * @todo Add custom logic using spatie/laravel-permission
         */
        return true;
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param  \App\Entities\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        /**
         * @todo Add custom logic using spatie/laravel-permission
         */
        return true;
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param  \App\Entities\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        /**
         * @todo Add custom logic using spatie/laravel-permission
         */
        return true;
    }
}
