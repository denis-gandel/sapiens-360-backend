<?php

namespace App\Modules\Authorization\Services\Concretes;

use App\Modules\Authorization\Models\Category;
use App\Services\Bases\BaseService;

class CategoryService extends BaseService
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
