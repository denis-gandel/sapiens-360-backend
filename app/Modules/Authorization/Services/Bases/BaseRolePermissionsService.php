<?php

namespace App\Modules\Authorization\Services\Bases;

use App\Modules\Authorization\Models\Permission;
use App\Modules\Authorization\Models\Role;
use App\Modules\Authorization\Models\RolePermissions;
use App\Modules\Authorization\Services\Contracts\IRolePermissionsService;
use App\Services\Bases\BaseService;
use Illuminate\Support\ItemNotFoundException;

abstract class BaseRolePermissionsService extends BaseService implements IRolePermissionsService
{
    protected Role $role;
    protected Permission $permission;
    public function __construct(RolePermissions $model)
    {
        parent::__construct($model);
    }

    public function getPermissionByRole(int $id, string $tenantId)
    {
        $rolePermissions = $this->model->where('role_id', $id)
            ->where('tenant_id', $tenantId)
            ->first();

        if (!$rolePermissions) {
            return [];
        }

        $role = $this->role->where([
            'id' => $id,
            'tenant_id' => $tenantId,
            'is_active' => true
        ])->first();

        if (!$role) {
            throw new ItemNotFoundException("Role not found");
        }

        $permissions =  $this->permission->whereIn('id', $rolePermissions->permissions)
            ->where([
                'tenant_id' => $tenantId,
                'is_active' => true
            ])
            ->get();

        return ['role' => $role, 'permissions' => $permissions];
    }

    public function initialize(string $tenantId)
    {
        $permissionsToRole = [
            1 => [3, 5, 11], // student
            2 => [2, 3, 4, 5, 12], // teacher
            3 => [1, 3, 4, 6, 7, 8, 10], // admin
            4 => [1, 3, 4, 6, 7, 8, 9, 10], // principal
            5 => [], // parent
        ];

        foreach ($permissionsToRole as $roleId => $permissionIds) {
            if (!empty($permissionIds)) {
                $this->model->create([
                    'role_id' => $roleId,
                    'permissions' => $permissionIds,
                    'tenant_id' => $tenantId,
                ]);
            }
        }
    }
}
