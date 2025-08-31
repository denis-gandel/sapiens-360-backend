<?php

namespace App\Modules\Courses\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Courses\Services\Concretes\CourseService;

class CourseController extends BaseController
{
    public function __construct(CourseService $service)
    {
        parent::__construct($service);
    }
}
