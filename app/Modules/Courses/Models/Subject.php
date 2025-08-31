<?php

namespace App\Modules\Courses\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Academics\Models\Institute;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'description',
        'code',
        'credits',
        'level_id',
        'prerequisites',
        'is_active',
        'tenant_id',
    ];

    protected $casts = [
        'prerequisites' => 'array',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'tenant_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}
