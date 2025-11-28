<?php

namespace App\Modules\Courses\Http\Controllers\Bases;

use App\Shared\Http\Controllers\Bases\BaseController;
use App\Modules\Courses\Http\Controllers\Contracts\ICourseController;
use App\Modules\Courses\Services\Concretes\CourseService;
use Illuminate\Http\Request;

abstract class BaseCourseController extends BaseController implements ICourseController
{
    protected CourseService $courseService;
    protected array $createRules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'code' => 'required|string|max:255',
        'period' => 'required|integer',
        'program_id' => 'required|uuid|exists:programs,id',
        'subjects' => 'nullable|array',
        'subjects.*' => 'uuid|exists:subjects,id',
        'tenant_id' => 'required|uuid|exists:institutes,id',
    ];
    protected array $updateRules = [
        'name' => 'sometimes|required|string|max:255',
        'description' => 'nullable|string',
        'code' => 'sometimes|required|string|max:255',
        'period' => 'sometimes|required|integer',
        'program_id' => 'sometimes|required|uuid|exists:programs,id',
        'subjects' => 'nullable|array',
        'subjects.*' => 'uuid|exists:subjects,id',
        'tenant_id' => 'sometimes|required|uuid|exists:institutes,id',
    ];

    public function __construct(CourseService $service)
    {

        parent::__construct($service, $this->createRules, $this->updateRules);
        $this->courseService = $service;
    }

    public function getSubjects(string $id, Request $request)
    {
        $tenant = $request->query('tenant');

        if (!$tenant) {
            return response()->json(['error' => 'Tenant parameter is required'], 400);
        }

        return $this->courseService->getSubjects($id, $tenant);
    }
}
