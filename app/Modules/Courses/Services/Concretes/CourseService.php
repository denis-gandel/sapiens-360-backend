<?php

namespace App\Modules\Courses\Services\Concretes;

use App\Services\Bases\BaseService;
use App\Modules\Courses\Models\Course;

class CourseService extends BaseService
{
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }
}
