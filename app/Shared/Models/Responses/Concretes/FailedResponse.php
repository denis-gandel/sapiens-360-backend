<?php

namespace App\Shared\Models\Responses\Concretes;

use App\Shared\Models\Responses\Bases\BaseResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

class FailedResponse extends BaseResponse
{
    public MessageBag | null $errors;

    public function __construct(int $status, string $message, MessageBag | null $errors)
    {
        $this->errors = $errors;
        return parent::__construct($status, $message);
    }

    public function toJson(): string
    {
        return json_encode([
            'status' => $this->status,
            'message' => $this->message,
            'errors' => $this->errors
        ]);
    }


    public function toResponse(): JsonResponse
    {
        return response()->json($this->toJson(), $this->status);
    }
}
