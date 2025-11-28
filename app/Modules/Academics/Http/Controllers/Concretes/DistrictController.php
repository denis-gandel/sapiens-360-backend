<?php

namespace App\Modules\Academics\Http\Controllers\Concretes;

use App\Shared\Http\Controllers\Bases\BaseController;
use App\Modules\Academics\Services\Concretes\DistrictService;

class DistrictController extends BaseController
{
    public function __construct(DistrictService $service)
    {
        $this->createRules = [
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id|integer'
        ];
        $this->updateRules = [
            'name' => 'string|max:255',
            'city_id' => 'exists:cities,id|integer'
        ];
        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
