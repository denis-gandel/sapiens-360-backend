<?php

namespace App\Modules\Authentication\Http\Controllers\Contracts;

use Illuminate\Http\Request;

interface IAuthenticationController {
    public function login(Request $request);
}
