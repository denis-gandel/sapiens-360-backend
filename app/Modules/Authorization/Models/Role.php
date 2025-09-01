<?php

namespace App\Modules\Authorization\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
    ];

    public function rolePermissions()
    {
        return $this->hasMany(RolePermissions::class, 'role_id');
    }
}
