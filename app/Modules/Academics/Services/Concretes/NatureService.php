<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\Nature;
use App\Modules\Academics\Services\Abstracts\BaseService;

class NatureService extends BaseService
{
    public function __construct(Nature $model)
    {
        parent::__construct($model);
    }
}
