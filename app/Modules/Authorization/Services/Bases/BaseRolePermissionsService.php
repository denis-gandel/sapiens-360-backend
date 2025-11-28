<?php

namespace App\Modules\Authorization\Services\Bases;

use App\Modules\Authorization\Models\Category;
use App\Modules\Authorization\Models\Permission;
use App\Modules\Authorization\Models\Role;
use App\Modules\Authorization\Models\RolePermissions;
use App\Modules\Authorization\Services\Contracts\IRolePermissionsService;
use App\Shared\Services\Bases\BaseService;
use Illuminate\Support\ItemNotFoundException;
use InvalidArgumentException;

abstract class BaseRolePermissionsService extends BaseService implements IRolePermissionsService
{
    protected Role $role;
    protected Permission $permission;
    protected Category $category;
    public function __construct(RolePermissions $model, Role $role, Permission $permission, Category $category)
    {
        parent::__construct($model);
        $this->role = $role;
        $this->permission = $permission;
        $this->category = $category;
    }

    public function getPermissionsByRole(int $roleId, string $tenantId)
    {
        if ($roleId <= 0) {
            throw new InvalidArgumentException("The role id is invalid for this operation");
        }

        if (empty($tenantId)) {
            throw new InvalidArgumentException("This tenant ID is invalid for this operation");
        }

        // 1. Obtener permisos asignados al rol
        $rolePermissions = $this->model
            ->where('role_id', $roleId)
            ->where('tenant_id', $tenantId)
            ->first();

        if (!$rolePermissions || empty($rolePermissions->permissions)) {
            throw new ItemNotFoundException("This role does not have permissions");
        }

        // 2. Obtener todos los permisos activos del tenant
        $allPermissions = $this->permission
            ->where('is_active', true)
            ->get();

        // 3. Filtrar solo los que el rol puede usar
        $permittedIds = collect($rolePermissions->permissions); // asumiendo que es array o json
        $permittedPermissions = $allPermissions->whereIn('id', $permittedIds);

        // 4. Obtener categorías
        $allCategories = $this->category
            ->where('is_active', true)
            ->get();

        // 5. Indexar permisos por categoría
        $permissionsByCategory = $permittedPermissions->groupBy('category_id');

        // 6. Función recursiva para armar árbol de categorías
        $buildCategoryTree = function ($parentId) use (&$buildCategoryTree, $allCategories, $permissionsByCategory) {
            return $allCategories
                ->where('parent_id', $parentId)
                ->map(function ($category) use ($permissionsByCategory, $buildCategoryTree) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'path' => $category->path,
                        'code' => $category->code,
                        'permissions' => $permissionsByCategory->get($category->id, collect())->map(function ($p) {
                            return [
                                'id' => $p->id,
                                'name' => $p->name,
                                'description' => $p->description,
                                'path' => $p->path,
                                'code' => $p->code,
                            ];
                        })->values(),
                        'subCategories' => $buildCategoryTree($category->id),
                    ];
                })
                ->filter(function ($cat) {
                    return $cat['permissions']->isNotEmpty() || $cat['subCategories']->isNotEmpty();
                })
                ->values();
        };

        // 7. Retornar árbol de categorías con permisos
        return $buildCategoryTree(null);
    }


    public function initialize(string $tenantId)
    {
        $permissionsToRole = [
            1 => [3, 5, 11], // student
            2 => [2, 3, 4, 5, 12], // teacher
            3 => [1, 3, 4, 6, 7, 8, 10, 13, 14, 15], // admin
            4 => [1, 3, 4, 6, 7, 8, 9, 10, 13, 14, 15], // principal
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
