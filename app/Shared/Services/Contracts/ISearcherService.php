<?php

namespace App\Shared\Services\Contracts;

interface ISearcherService extends IService
{
    function search(String $value, array $filters, int $page, int $size);
}
