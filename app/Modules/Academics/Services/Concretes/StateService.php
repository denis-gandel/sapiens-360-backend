<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\State;
use App\Modules\Academics\Services\Abstracts\BaseService;

class StateService extends BaseService
{
    public function __construct(State $model)
    {
        parent::__construct($model);
    }
}
