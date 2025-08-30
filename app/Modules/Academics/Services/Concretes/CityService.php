<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\City;
use App\Modules\Academics\Services\Abstracts\BaseService;

class CityService extends BaseService
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }
}
