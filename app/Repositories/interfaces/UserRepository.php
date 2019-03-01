<?php declare(strict_types=1);

namespace App\Repositories\interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface UserRepository extends RepositoryInterface
{
    public function getUserListForDataTable(array $payLoad);
}
