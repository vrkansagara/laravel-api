<?php declare(strict_types=1);
namespace App\Repositories\interfaces\Acl\Role;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface RoleRepositoryInterface extends RepositoryInterface
{
    public function getRoleListForDataTable(array $payLoad);
}
