<?php

namespace App\Modules\Academics\Http\Controllers\Bases;

use App\Shared\Http\Controllers\Bases\BaseController;
use App\Modules\Academics\Http\Controllers\Contracts\IInstituteController;
use App\Modules\Academics\Services\Concretes\InstituteService;
use App\Shared\Models\Responses\Concretes\SuccessResponse;

abstract class BaseInstituteController extends BaseController implements IInstituteController
{
    protected InstituteService $instituteService;

    public function __construct(InstituteService $service)
    {
        $this->createRules = [
            'name' => 'required|string|max:255',
            'subdomain' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'foundation_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'type_id' => 'required|integer|exists:types,id',
            'nature_id' => 'required|integer|exists:natures,id',
            'period_id' => 'required|integer|exists:periods,id',
            'country_id' => 'required|integer|exists:countries,id',
            'state_id' => 'required|integer|exists:states,id',
            'city_id' => 'required|integer|exists:cities,id',
            'district_id' => 'nullable|integer|exists:districts,id',
        ];
        $this->updateRules = [
            'name' => 'string|max:255',
            'subdomain' => 'string|max:255',
            'location' => 'string|max:255',
            'logo' => 'string|max:255',
            'email' => 'string|email|max:255',
            'phone' => 'string|max:255',
            'foundation_date' => 'required|date',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
            'type_id' => 'integer|exists:types,id',
            'nature_id' => 'integer|exists:natures,id',
            'period_id' => 'integer|exists:periods,id',
            'country_id' => 'integer|exists:countries,id',
            'state_id' => 'integer|exists:states,id',
            'city_id' => 'integer|exists:cities,id',
            'district_id' => 'nullable|integer|exists:districts,id',
        ];

        parent::__construct($service, $this->createRules, $this->updateRules);
        $this->instituteService = $service;
    }

    public function verifySubdomain(string $subdomain)
    {
        $result = $this->instituteService->getBy('subdomain', $subdomain, false);

        $response = new SuccessResponse(200, 'Verified subdomain', $result ? true : false);
        return $response->toResponse();
    }
}
