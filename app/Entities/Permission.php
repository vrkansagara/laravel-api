<?php

namespace App\Entity;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{

    protected $visible = ['id','name','display_name','guard_name'];
}
