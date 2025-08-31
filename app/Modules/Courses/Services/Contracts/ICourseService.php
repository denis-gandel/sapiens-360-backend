<?php

namespace App\Modules\Courses\Services\Contracts;

use App\Services\Contracts\IService;

interface ICourseService extends IService
{
    function getSubjects(string $id, string $tenantId);
}
