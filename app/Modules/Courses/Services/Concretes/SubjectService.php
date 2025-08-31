<?php

namespace App\Modules\Courses\Services\Concretes;

use App\Services\Bases\BaseService;
use App\Modules\Courses\Models\Subject;

class SubjectService extends BaseService
{
    public function __construct(Subject $model)
    {
        parent::__construct($model);
    }
}
