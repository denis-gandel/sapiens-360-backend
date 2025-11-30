<?php

namespace App\Modules\Authorization\Http\Controllers\Bases;

use App\Shared\Http\Controllers\Bases\BaseController;
use App\Modules\Authorization\Http\Controllers\Contracts\IRolePermissionsController;
use App\Modules\Authorization\Services\Concretes\RolePermissionsService;
use App\Shared\Models\Responses\Concretes\FailedResponse;
use App\Shared\Models\Responses\Concretes\SuccessResponse;
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
            $response = new FailedResponse(400, 'Tenant parameter is required', null);
            return $response->toResponse();
        }

        try {
            $data = $this->rolePermissionsService->getPermissionsByRole($id, $tenant);
            $response = new SuccessResponse(200, 'Data correctly obtained', $data);
            return $response->toResponse();
        } catch (\Exception $e) {
            $response = new FailedResponse(400, $e->getMessage(), null);
            return $response->toResponse();
        }
    }

    public function initialize(string $tenantId)
    {
        try {
            $this->rolePermissionsService->initialize($tenantId);
            $response = new SuccessResponse(201, 'Role permissions initialized successfully', null);
            return $response->toResponse();
        } catch (\Exception $e) {
            $response = new FailedResponse(400, $e->getMessage(), null);
            return $response->toResponse();
        }
    }
}
