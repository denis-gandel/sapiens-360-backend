<?php

namespace App\Shared\Http\Controllers\Contracts;

use Illuminate\Http\Request;

interface ISearcherController extends IController
{
    function search(Request $request);
}
