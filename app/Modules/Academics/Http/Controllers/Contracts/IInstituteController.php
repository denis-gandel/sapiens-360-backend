<?php

namespace App\Modules\Academics\Http\Controllers\Contracts;

use App\Http\Controllers\Contracts\IController;

interface IInstituteController extends IController
{
    public function verifySubdomain(string $subdomain);
}
