<?php

namespace App\Modules\Academics\Http\Controllers\Concretes;

use App\Http\Controllers\Bases\BaseController;
use App\Modules\Academics\Services\Concretes\CountryService;

class CountryController extends BaseController
{
    public function __construct(CountryService $service)
    {
        $this->createRules = [
            'name' => 'required|string|max:255'
        ];
        $this->updateRules = [
            'name' => 'string|max:255'
        ];
        parent::__construct($service, $this->createRules, $this->updateRules);
    }
}
