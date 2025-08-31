<?php

namespace App\Modules\Courses\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Courses\Services\Concretes\LevelService;

class LevelController extends BaseController
{
    public function __construct(LevelService $service)
    {
        parent::__construct($service);
    }
}
