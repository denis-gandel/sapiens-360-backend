<?php

namespace App\Shared\Models\Responses\Bases;

use App\Shared\Models\Responses\Contracts\IResponse;
use Illuminate\Http\JsonResponse;

abstract class BaseResponse implements IResponse
{
    public int $status;
    public string $message;

    public function __construct(int $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    public function toJson(): string
    {
        return json_encode([
            'status' => $this->status,
            'message' => $this->message,
        ]);
    }

    public function toResponse(): JsonResponse
    {
        return response()->json($this->toJson(), $this->status);
    }
}
