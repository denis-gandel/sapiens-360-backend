<?php

namespace App\Modules\Courses\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Courses\Services\Concretes\ProgramService;

class ProgramController extends BaseController
{
    protected array $createRules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'code' => 'required|string|max:255',
        'degree_type' => 'required|string|max:255',
        'duration_type' => 'required|string|max:255',
        'periods' => 'required|integer',
        'tenant_id' => 'required|uuid|exists:institutes,id',
    ];

    protected array $updateRules = [
        'name' => 'sometimes|required|string|max:255',
        'description' => 'nullable|string',
        'code' => 'sometimes|required|string|max:255',
        'degree_type' => 'sometimes|required|string|max:255',
        'duration_type' => 'sometimes|required|string|max:255',
        'periods' => 'sometimes|required|integer',
        'tenant_id' => 'sometimes|required|uuid|exists:institutes,id',
    ];

    public function __construct(ProgramService $service)
    {
        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
