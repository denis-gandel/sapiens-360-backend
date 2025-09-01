<?php

namespace App\Modules\Authorization\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Authorization\Services\Concretes\RoleService;

class RoleController extends BaseController
{
    protected array $createRules = [
        'name' => 'required|string|max:255'
    ];

    protected array $updateRules = [
        'name' => 'required|string|max:255'
    ];

    public function __construct(RoleService $service)
    {
        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
