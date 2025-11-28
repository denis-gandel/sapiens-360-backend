<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Academics\Models\Institute;
use App\Modules\Calendar\Models\Event;

class User extends Model
{
    protected $table = 'users';

    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'firstnames',
        'lastnames',
        'shortname',
        'code',
        'ci',
        'image_url',
        'address',
        'phone',
        'email',
        'password',
        'gender',
        'birthdate',
        'role_id',
        'is_active',
        'lms_id',
        'tenant_id',
    ];

    // Academics
    public function institute()
    {
        return $this->belongsTo(Institute::class, 'tenant_id');
    }

    // Users
    public function user()
    {
        return $this->hasMany(Event::class, 'author_id');
    }
}
