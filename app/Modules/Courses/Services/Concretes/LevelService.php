<?php

namespace App\Modules\Courses\Services\Concretes;

use App\Services\Bases\BaseService;
use App\Modules\Courses\Models\Level;

class LevelService extends BaseService
{
    public function __construct(Level $model)
    {
        parent::__construct($model);
    }
}
