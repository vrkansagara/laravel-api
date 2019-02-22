<?php

namespace App\Policies;

use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function index()
    {
        $userAbility =
            auth()->user()->can(['user-index','user-manage']) &&
            auth()->user()->cannot(['user-manageBan']);

        return $userAbility;
    }

    public function edit(User $user, User $model)
    {
        $userAbility =
            auth()->user()->can(['user-edit','user-manage'])&&
            auth()->user()->cannot(['user-manageBan']);

        return $userAbility;
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Entities\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        $userAbility =
            auth()->user()->can(['user-view','user-manage'])&&
            auth()->user()->cannot(['user-manageBan']);

        return $userAbility;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Entities\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $userAbility =
            auth()->user()->can(['user-create','user-manage'])&&
            auth()->user()->cannot(['user-manageBan']);

        return $userAbility;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Entities\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        $userAbility =
            auth()->user()->can(['user-update','user-manage'])&&
            auth()->user()->cannot(['user-manageBan']);

        return $userAbility;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Entities\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        $userAbility =
            auth()->user()->can(['user-delete','user-manage'])&&
            auth()->user()->cannot(['user-manageBan']);

        return $userAbility;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Entities\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        $userAbility =
            auth()->user()->can(['user-restore','user-manage'])&&
            auth()->user()->cannot(['user-manageBan']);

        return $userAbility;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Entities\User $user
     * @param  \App\User $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        $userAbility =
            auth()->user()->can(['user-edit','user-forceDelete'])&&
            auth()->user()->cannot(['user-manageBan']);

        return $userAbility;
    }
}
