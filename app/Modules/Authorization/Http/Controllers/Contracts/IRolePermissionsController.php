<?php

namespace App\Modules\Authorization\Http\Controllers\Contracts;

use App\Http\Controllers\Contracts\IController;
use Illuminate\Http\Request;

interface IRolePermissionsController extends IController
{
    public function getPermissionsByRole(int $id, Request $request);
    public function initialize(string $tenantId);
}
