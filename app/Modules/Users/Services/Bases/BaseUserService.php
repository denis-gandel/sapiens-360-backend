<?php

namespace App\Modules\Users\Services\Bases;

use App\Modules\Users\Models\User;
use App\Modules\Users\Services\Contracts\IUserService;
use App\Services\Bases\BaseService;
use Illuminate\Support\Facades\Hash;

abstract class BaseUserService extends BaseService implements IUserService
{
    protected User $user;
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->user = $model;
    }

    public function create(array $data, ?string $uniqueColumn = null)
    {
        $exists = User::where('email', $data['email'])->get();

        if ($exists && $exists->isNotEmpty()) {
            if ($exists->first()->is_active) {
                throw new \DomainException('User with this email already exists');
            } else {
                $user = $exists->first();
                $user->is_active = true;
                $user->name = $data['lastnames'] . ' ' . $data['firstnames'];
                $user->firstnames = $data['firstnames'];
                $user->lastnames = $data['lastnames'];
                $user->shortname = $data['shortname'];
                $user->code = $data['code'] ?? $user->code;
                $user->ci = $data['ci'];
                $user->image_url = $data['image_url'] ?? $user->image_url;
                $user->address = $data['address'] ?? $user->address;
                $user->phone = $data['phone'] ?? $user->phone;
                $user->password = Hash::make($data['password']);
                $user->save();
                return $user;
            }
        }

        $data['password'] = Hash::make($data['password']);
        $data['name'] = $data['lastnames'] . ' ' . $data['firstnames'];
        return User::create($data);
    }

    public function update(string|int $id, array $data, ?string $uniqueColumn = null)
    {
        $user = $this->getBy('id', $id);

        if (!$user) {
            throw new \DomainException('User not found');
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->fill($data);
        $user->save();

        return $user;
    }

    public function verifyCredentials(string $email, string $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new \Illuminate\Validation\UnauthorizedException('Invalid email or password');
        }

        return $user;
    }
}
