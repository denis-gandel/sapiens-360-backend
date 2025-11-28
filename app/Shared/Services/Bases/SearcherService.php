<?php

namespace App\Shared\Services\Bases;

use App\Shared\Services\Contracts\ISearcherService;

class SearcherService extends BaseService implements ISearcherService
{
    public function search(String $value, array $filters, int $page, int $size)
    {
        $query = $this->model->where('name', $value)->where($filters)->orderBy('name', 'asc');

        if ($page > 0 && $size > 0) {
            return $query->paginate(
                $size,
                ['*'],
                'page',
                $page
            );
        }

        return $query->get();
    }
}
