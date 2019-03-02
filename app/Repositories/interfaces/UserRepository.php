<?php declare(strict_types=1);

namespace App\Repositories\interfaces;

use App\Entities\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface UserRepository extends RepositoryInterface
{
    public function getUserListForDataTable(array $payLoad);

    public function isEditableUser(User $user);
}
