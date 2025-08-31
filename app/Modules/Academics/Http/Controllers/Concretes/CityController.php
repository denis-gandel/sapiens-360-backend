<?php

namespace App\Modules\Academics\Http\Controllers\Concretes;

use App\Modules\Academics\Http\Controllers\Abstracts\BaseController;
use App\Modules\Academics\Services\Concretes\CityService;

class CityController extends BaseController
{
    public function __construct(CityService $service)
    {
        $this->createRules = [
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id|integer'
        ];
        $this->updateRules = [
            'name' => 'string|max:255',
            'state_id' => 'exists:states,id|integer'
        ];
        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
