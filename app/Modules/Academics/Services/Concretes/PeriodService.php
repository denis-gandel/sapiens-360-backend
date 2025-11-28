<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\Period;
use App\Shared\Services\Bases\BaseService;

class PeriodService extends BaseService
{
    public function __construct(Period $model)
    {
        parent::__construct($model);
    }
}
