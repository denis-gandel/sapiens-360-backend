<?php

namespace App\Modules\Courses\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Courses\Services\Concretes\LevelService;

class LevelController extends BaseController
{
    protected array $createRules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'code' => 'required|string|max:255',
        'order' => 'required|integer',
        'tenant_id' => 'required|uuid|exists:institutes,id',
        'program_id' => 'required|uuid|exists:programs,id',
    ];

    protected array $updateRules = [
        'name' => 'sometimes|required|string|max:255',
        'description' => 'nullable|string',
        'code' => 'sometimes|required|string|max:255',
        'order' => 'sometimes|required|integer',
        'tenant_id' => 'sometimes|required|uuid|exists:institutes,id',
        'program_id' => 'sometimes|required|uuid|exists:programs,id',
    ];

    public function __construct(LevelService $service)
    {
        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
