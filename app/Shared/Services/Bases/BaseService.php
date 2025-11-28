<?php

namespace App\Shared\Services\Bases;

use App\Shared\Services\Contracts\IService;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService implements IService
{

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(
        string $direction = 'asc',
        array $filters = [],
        string $orderBy = 'name',
        int $page = 0,
        int $size = 0
    ) {
        $query = $this->model->where($filters)->orderBy($orderBy, $direction);

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

    public function getBy(string $column, string|int $value, bool $fail = true, bool $onlyActive = true, array $filters = [])
    {
        $query = $this->model->where($column, $value);

        if ($onlyActive) {
            $query->where('is_active', true);
        }

        $query->where($filters);

        return $fail ? $query->firstOrFail() : $query->first();
    }

    public function create(array $data, ?string $uniqueColumn = null)
    {
        if ($uniqueColumn && isset($data[$uniqueColumn])) {
            $exists = $this->model->where($uniqueColumn, $data[$uniqueColumn])->first();

            if ($exists && $exists->is_active) {
                throw new \DomainException("Record with {$uniqueColumn} '{$data[$uniqueColumn]}' already exists.");
            }

            if ($exists && !$exists->is_active) {
                $exists->update([
                    'is_active' => true,
                    'deleted_at' => null
                ]);
                return $exists;
            }
        }

        $data['is_active'] = $data['is_active'] ?? true;

        return $this->model->create($data);
    }

    public function update(string|int $id, array $data, ?string $uniqueColumn = null)
    {
        $record = $this->getBy('id', $id);

        if ($uniqueColumn && isset($data[$uniqueColumn])) {
            $exists = $this->model
                ->where($uniqueColumn, $data[$uniqueColumn])
                ->where('id', '!=', $id)
                ->first();

            if ($exists && $exists->is_active) {
                throw new \DomainException("Record with {$uniqueColumn} '{$data[$uniqueColumn]}' already exists.");
            }
        }

        $record->update($data);
        return $record;
    }

    public function delete(string|int $id, bool $force = false)
    {
        $record = $this->getBy('id', $id);

        if ($force) {
            $record->forceDelete();
        } else {
            $record->is_active = false;
            $record->deleted_at = now();
            $record->save();
        }

        return true;
    }
}
