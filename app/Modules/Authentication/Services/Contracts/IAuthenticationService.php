<?php

namespace App\Modules\Authentication\Services\Contracts;

interface IAuthenticationService
{
    public function login(string $email, string $password);
}
