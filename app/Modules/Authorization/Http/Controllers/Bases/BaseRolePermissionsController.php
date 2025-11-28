<?php

namespace App\Modules\Authorization\Http\Controllers\Bases;

use App\Shared\Http\Controllers\Bases\BaseController;
use App\Modules\Authorization\Http\Controllers\Contracts\IRolePermissionsController;
use App\Modules\Authorization\Services\Concretes\RolePermissionsService;
use Illuminate\Http\Request;

abstract class BaseRolePermissionsController extends BaseController implements IRolePermissionsController
{
    protected RolePermissionsService $rolePermissionsService;

    protected array $createRules = [
        'role_id' => 'required|integer|exists:roles,id',
        'permissions' => 'required|array',
        'permissions.*' => 'required|integer|exists:permissions,id',
        'tenant_id' => 'required|integer|exists:institutes,id'
    ];

    protected array $updateRules = [
        'role_id' => 'sometimes|integer|exists:roles,id',
        'permissions' => 'sometimes|array',
        'permissions.*' => 'sometimes|integer|exists:permissions,id',
        'tenant_id' => 'sometimes|integer|exists:institutes,id'
    ];

    public function __construct(RolePermissionsService $service)
    {
        parent::__construct($service, $this->createRules, $this->updateRules);
        $this->rolePermissionsService = $service;
    }

    public function getPermissionsByRole(int $id, Request $request)
    {
        $tenant = $request->query('tenant');

        if (!$tenant) {
            return response()->json(['error' => 'Tenant ID is required'], 400);
        }

        try {
            $permissions = $this->rolePermissionsService->getPermissionsByRole($id, $tenant);
            return response()->json($permissions, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function initialize(string $tenantId)
    {
        try {
            $this->rolePermissionsService->initialize($tenantId);
            return response()->json(['message' => 'Role permissions initialized successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
