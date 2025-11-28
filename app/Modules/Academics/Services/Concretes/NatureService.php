<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\Nature;
use App\Shared\Services\Bases\BaseService;

class NatureService extends BaseService
{
    public function __construct(Nature $model)
    {
        parent::__construct($model);
    }
}
