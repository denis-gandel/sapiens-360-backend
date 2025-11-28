<?php

namespace App\Shared\Http\Controllers\Bases;

use App\Shared\Http\Controllers\Contracts\ISearcherController;
use App\Shared\Services\Contracts\ISearcherService;
use Illuminate\Http\Request;

class SearcherController extends BaseController implements ISearcherController
{
    protected $searcherService;

    public function __construct(ISearcherService $searcherService)
    {
        $this->searcherService = $searcherService;
    }

    public function search(Request $request)
    {
        $value = $request->input('value');
        $filters = $request->input('filters');
        $page = $request->input('page');
        $size = $request->input('size');

        return $this->searcherService->search($value, $filters, $page, $size);
    }
}
