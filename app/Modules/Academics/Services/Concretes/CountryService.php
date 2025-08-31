<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\Country;
use App\Modules\Academics\Services\Abstracts\BaseService;

class CountryService extends BaseService
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }
}
