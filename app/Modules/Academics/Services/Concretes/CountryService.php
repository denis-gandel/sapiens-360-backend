<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\Country;
use App\Services\Bases\BaseService;

class CountryService extends BaseService
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }
}
