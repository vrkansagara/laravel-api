<?php
namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use Laravel\Passport\Passport;

class PassportTokenRepository extends Repository {

    public function model() {
//        return Passport::tokenModel();
        return 'App\Entity\Token';
    }
}
