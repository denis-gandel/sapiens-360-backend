<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\District;
use App\Shared\Services\Bases\BaseService;

class DistrictService extends BaseService
{
    public function __construct(District $model)
    {
        parent::__construct($model);
    }
}
