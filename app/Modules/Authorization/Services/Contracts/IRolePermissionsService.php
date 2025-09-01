<?php

namespace App\Modules\Authorization\Services\Contracts;

use App\Services\Contracts\IService;

interface IRolePermissionsService extends IService
{
    public function getPermissionsByRole(int $id, string $tenantId);
    public function initialize(string $tenantId);
}
