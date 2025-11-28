<?php

namespace App\Modules\Academics\Http\Controllers\Concretes;

use App\Shared\Http\Controllers\Bases\BaseController;
use App\Modules\Academics\Services\Concretes\NatureService;

class NatureController extends BaseController
{
    public function __construct(NatureService $service)
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
