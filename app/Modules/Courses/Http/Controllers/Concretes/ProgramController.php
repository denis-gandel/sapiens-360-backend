<?php

namespace App\Modules\Courses\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Courses\Services\Concretes\ProgramService;

class ProgramController extends BaseController
{
    public function __construct(ProgramService $service)
    {
        parent::__construct($service);
    }
}
