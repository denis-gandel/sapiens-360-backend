<?php

namespace App\Modules\Authorization\Services\Concretes;

use App\Modules\Authorization\Models\Role;
use App\Shared\Services\Bases\BaseService;

class RoleService extends BaseService
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
