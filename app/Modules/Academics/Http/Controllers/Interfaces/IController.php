<?php

namespace App\Modules\Academics\Http\Controllers\Interfaces;

use Illuminate\Http\Request;

interface IController
{
    function index(Request $request);
    function show(Request $request);
    function store(Request $request);
    function update(Request $request, string|int $id);
    function destroy(string|int $id);
}
