<?php

namespace App\Modules\Authorization\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Authorization\Services\Concretes\PermissionService;

class PermissionController extends BaseController
{
    protected $createRules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'path' => 'required|string|max:255',
        'code' => 'required|string|max:255',
        'category_id' => 'required|integer|exists:categories,id'
    ];

    protected $updateRules = [
        'name' => 'sometimes|string|max:255',
        'description' => 'nullable|string|max:255',
        'path' => 'sometimes|string|max:255',
        'code' => 'sometimes|string|max:255',
        'category_id' => 'sometimes|integer|exists:categories,id'
    ];

    public function __construct(PermissionService $service)
    {
        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
