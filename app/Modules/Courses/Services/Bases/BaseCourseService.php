<?php

namespace App\Modules\Courses\Services\Bases;

use App\Modules\Courses\Models\Course;
use App\Modules\Courses\Models\Subject;
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

        if (!$course) {
            return [];
        }

        if (!$course['subjects']) {
            return [];
        }

        $subjects = [];

        foreach ($course['subjects'] as $subjectId) {
            $subject = Subject::where('id', $subjectId)
                ->where('tenant_id', $tenantId)
                ->where('is_active', true)
                ->first();

            if ($subject) {
                $subjects[] = $subject;
            }
        }
        return $subjects;
    }
}
