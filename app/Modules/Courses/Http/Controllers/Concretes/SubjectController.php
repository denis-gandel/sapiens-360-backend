<?php

namespace App\Modules\Courses\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Courses\Services\Concretes\SubjectService;

class SubjectController extends BaseController
{
    public function __construct(SubjectService $service)
    {
        parent::__construct($service);
    }
}
