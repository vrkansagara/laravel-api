<?php

namespace App\Entity;

use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken
{

    protected $visible = ['user_id','client_id','name','revoked'];
}
