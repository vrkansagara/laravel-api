<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class PermissionRepository extends Repository {

    public function model() {
//        return 'Spatie\Permission\Models\Permission';
        return 'App\Entity\Permission';
    }
}
