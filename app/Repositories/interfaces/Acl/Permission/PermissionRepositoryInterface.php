<?php

namespace App\Repositories\interfaces\Acl\Permission;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PermissionRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface PermissionRepositoryInterface extends RepositoryInterface
{
    public function getPermissionListForDataTable(array $payLoad);
}
