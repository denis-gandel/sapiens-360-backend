<?php

namespace App\Modules\Academics\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Users\Models\User;

class Institute extends Model
{
    protected $table = 'institutes';

    protected $fillable = [
        'name',
        'subdomain',
        'location',
        'logo',
        'email',
        'phone',
        'type_id',
        'nature_id',
        'period_id',
        'is_active',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'tenant_id');
    }
}
