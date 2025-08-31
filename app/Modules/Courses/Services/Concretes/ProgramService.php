<?php

namespace App\Modules\Courses\Services\Concretes;

use App\Modules\Courses\Models\Program;
use App\Services\Bases\BaseService;

class ProgramService extends BaseService
{
    public function __construct(Program $model)
    {
        parent::__construct($model);
    }
}
