<?php

namespace App\Shared\Models\Responses\Concretes;

use App\Shared\Models\Responses\Bases\BaseResponse;
use Illuminate\Http\JsonResponse;

class PaginateResponse extends BaseResponse
{
    public mixed $items;
    public int $currentPage;
    public int $lastPage;
    public int $perPage;
    public int $total;

    public function __construct(int $status, string $message, mixed $items, int $currentPage, int $lastPage, int $perPage, int $total)
    {
        $this->items = $items;
        $this->currentPage = $currentPage;
        $this->lastPage = $lastPage;
        $this->perPage = $perPage;
        $this->total = $total;
        return parent::__construct($status, $message);
    }

    public function toJson(): string
    {
        return json_encode([
            'status' => $this->status,
            'message' => $this->message,
            'items' => $this->items,
            'last_page' => $this->lastPage
        ]);
    }

    public function toResponse(): JsonResponse
    {
        return response()->json($this->toJson(), $this->status);
    }
}
