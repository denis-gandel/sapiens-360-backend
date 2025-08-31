<?php

namespace App\Modules\Courses\Services\Bases;

use App\Modules\Courses\Models\Course;
use App\Modules\Courses\Services\Contracts\ICourseService;
use App\Services\Bases\BaseService;

abstract class BaseCourseService extends BaseService implements ICourseService
{
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }

    public function getSubjects(string $id, string $tenantId)
    {
        $course = $this->model->where('id', $id)
            ->where('tenant_id', $tenantId)
            ->where('is_active', true)
            ->firstOrFail();

        return $course->subjects()->where('is_active', true)->get();
    }
}
