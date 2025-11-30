<?php

namespace App\Shared\Models\Responses\Contracts;

use Illuminate\Http\JsonResponse;

interface IResponse
{
    function toJson(): string;
    function toResponse(): JsonResponse;
}
