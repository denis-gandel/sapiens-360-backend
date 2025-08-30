<?php

namespace App\Modules\Academics\Services\Concretes;

use App\Modules\Academics\Models\Type;
use App\Modules\Academics\Services\Abstracts\BaseService;

class TypeService extends BaseService
{
    public function __construct(Type $model)
    {
        parent::__construct($model);
    }
}
