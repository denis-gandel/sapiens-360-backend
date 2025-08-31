<?php

namespace App\Modules\Academics\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Academics\Services\Concretes\PeriodService;

class PeriodController extends BaseController
{
    public function __construct(PeriodService $service)
    {
        $this->createRules = [
            'name' => 'required|string|max:255',
            'duration' => 'required|integer|min:1|max:12'
        ];
        $this->updateRules = [
            'name' => 'string|max:255',
            'duration' => 'integer|min:1|max:12'
        ];

        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
