<?php

namespace App\Modules\Authorization\Services\Concretes;

use App\Modules\Authorization\Models\Permission;
use App\Services\Bases\BaseService;

class PermissionService extends BaseService
{
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }
}
