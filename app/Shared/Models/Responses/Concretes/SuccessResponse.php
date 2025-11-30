<?php

namespace App\Shared\Models\Responses\Concretes;

use App\Shared\Models\Responses\Bases\BaseResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class SuccessResponse extends BaseResponse
{
    public mixed $data;

    public function __construct(int $status, string $message, mixed $data)
    {
        $this->data = $data;
        return parent::__construct($status, $message);
    }

    public function toJson(): string
    {
        return json_encode([
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
        ]);
    }

    public function toResponse(): JsonResponse
    {
        return response()->json($this->toJson(), $this->status);
    }
}
