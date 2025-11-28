<?php

namespace App\Modules\Academics\Http\Controllers\Concretes;

use App\Shared\Http\Controllers\Bases\BaseController;
use App\Modules\Academics\Services\Concretes\StateService;

class StateController extends BaseController
{
    public function __construct(StateService $service)
    {
        $this->createRules = [
            'name' => 'required|string|max:255',
            'country_id' => 'required|integer|exists:countries,id'
        ];
        $this->updateRules = [
            'name' => 'string|max:255',
            'country_id' => 'integer|exists:countries,id'
        ];

        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
