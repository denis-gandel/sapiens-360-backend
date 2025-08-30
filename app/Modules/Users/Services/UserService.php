<?php

namespace App\Modules\Users\Services;

use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAllUsers(?string $tenantId, int $pageNumber, int $pageSize)
    {
        if (!$tenantId) {
            return User::where('is_active', true)->orderBy('lastnames')->orderBy('firstnames')->paginate($pageSize, ['*'], 'page', $pageNumber);
        }

        return User::where('tenant_id', $tenantId)
            ->where('is_active', true)
            ->orderBy('lastnames')->orderBy('firstnames')->paginate($pageSize, ['*'], 'page', $pageNumber);
    }

    public function getUserById(?string $tenantId, string $userId)
    {
        if (!$tenantId) {
            return User::where('is_active', true)->find($userId);
        }

        return User::where('tenant_id', $tenantId)->where('is_active', true)->find($userId);
    }

    public function createUser(array $data): User
    {
        $exists = User::where('email', $data['email'])->get();

        if ($exists && $exists->isNotEmpty()) {
            if ($exists->first()->is_active) {
                throw new \DomainException('User with this email already exists');
            } else {
                $user = $exists->first();
                $user->is_active = true;
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
        return User::create($data);
    }

    public function updateUser(string $userId, string $tenantId, array $data): User
    {
        $user = $this->getUserById($tenantId, $userId);

        if (!$user) {
            throw new \DomainException('User not found');
        }

        $user->fill($data);
        $user->save();

        return $user;
    }

    public function deleteUser(string $userId, string $tenantId): bool
    {
        $user = $this->getUserById($tenantId, $userId);

        if (!$user) {
            throw new \DomainException('User not found');
        }

        return $user->update(['is_active' => false]);
    }
}
