<?php
namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class RoleRepository extends Repository {

    public function model() {
//        return 'Spatie\Permission\Models\Role';
        return 'App\Entity\Role';
    }
}
