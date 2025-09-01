<?php

namespace App\Modules\Users\Services\Contracts;

use App\Services\Contracts\IService;

interface IUserService extends IService
{
    public function verifyCredentials(string $email, string $password);
}
