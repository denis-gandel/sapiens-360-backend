<?php

namespace App\Modules\Academics\Http\Controllers\Concretes;

use App\Modules\Academics\Http\Controllers\Abstracts\BaseController;
use App\Modules\Academics\Services\Concretes\TypeService;

class TypeController extends BaseController
{
    public function __construct(TypeService $service)
    {
        parent::__construct($service);
    }
}
