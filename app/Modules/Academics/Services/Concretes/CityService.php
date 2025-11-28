<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\City;
use App\Shared\Services\Bases\BaseService;

class CityService extends BaseService
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }
}
