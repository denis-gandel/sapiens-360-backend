<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\Institute;
use App\Shared\Services\Bases\BaseService;

class InstituteService extends BaseService
{
    public function __construct(Institute $model)
    {
        parent::__construct($model);
    }
}
