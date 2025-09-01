<?php

namespace App\Modules\Authorization\Models;

use App\Modules\Academics\Models\Institute;
use Illuminate\Database\Eloquent\Model;

class RolePermissions extends Model
{
    protected $table = 'role_permissions';

    protected $fillable = [
        'role_id',
        'permissions',
        'tenant_id',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'tenant_id');
    }
}
