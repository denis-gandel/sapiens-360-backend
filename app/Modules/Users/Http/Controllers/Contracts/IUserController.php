<?php

namespace App\Modules\Users\Http\Controllers\Contracts;

use App\Http\Controllers\Contracts\IController;
use Illuminate\Http\Request;

interface IUserController extends IController
{
    public function verifyCredentials(Request $request);
}
