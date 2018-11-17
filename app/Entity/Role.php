<?php

namespace App\Entity;

use Spatie\Permission\Models\Role as SpatieRole;

use Laravel\Passport\HasApiTokens;

class Role extends SpatieRole
{

    protected $visible = ['id','name','display_name','guard_name'];
}
