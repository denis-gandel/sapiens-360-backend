<?php

namespace App\Modules\Courses\Http\Controllers\Contracts;

use App\Shared\Http\Controllers\Contracts\IController;
use Illuminate\Http\Request;

interface ICourseController extends IController
{
    public function getSubjects(string $id, Request $request);
}
