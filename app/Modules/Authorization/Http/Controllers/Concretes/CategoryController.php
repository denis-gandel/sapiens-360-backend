<?php

namespace App\Modules\Authorization\Http\Controllers\Concretes;

use App\Shared\Http\Controllers\Bases\BaseController;
use App\Modules\Authorization\Services\Concretes\CategoryService;

class CategoryController extends BaseController
{
    protected array $createRules = [
        'name' => 'required|string|max:255',
        'parent_id' => 'nullable|integer|exists:categories,id',
        'path' => 'required|string|max:255',
        'code' => 'required|string|max:255'
    ];

    protected array $updateRules = [
        'name' => 'sometimes|string|max:255',
        'parent_id' => 'nullable|integer|exists:categories,id',
        'path' => 'sometimes|string|max:255',
        'code' => 'sometimes|string|max:255'
    ];

    public function __construct(CategoryService $service)
    {
        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
