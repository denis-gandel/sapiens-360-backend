<?php

namespace App\Modules\Courses\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Courses\Services\Concretes\SubjectService;

class SubjectController extends BaseController
{
    protected array $createRules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'code' => 'required|string|max:255',
        'credits' => 'required|integer',
        'prerequisites' => 'nullable|array',
        'tenant_id' => 'required|uuid|exists:institutes,id',
    ];

    protected array $updateRules = [
        'name' => 'sometimes|required|string|max:255',
        'description' => 'nullable|string',
        'code' => 'sometimes|required|string|max:255',
        'credits' => 'sometimes|required|integer',
        'prerequisites' => 'nullable|array',
        'tenant_id' => 'sometimes|required|uuid|exists:institutes,id',
    ];

    public function __construct(SubjectService $service)
    {
        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
