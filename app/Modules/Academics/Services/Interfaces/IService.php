<?php

namespace App\Modules\Academics\Services\Interfaces;

interface IService
{
    function getAll(string $direction, array $filters, string $orderBy, int $page, int $size);
    function getBy(string $column, string|int $value, bool $fail, bool $onlyActive);
    function create(array $data, ?string $uniqueColumn);
    function update(string|int $id, array $data, ?string $uniqueColumn);
    function delete(string|int $id, bool $force = false);
}
