<?php

namespace App\Modules\Courses\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Academics\Models\Institute;

class Course extends Model
{
    protected $table = 'courses';

    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'code',
        'period',
        'level_id',
        'is_active',
        'subjects',
        'tenant_id',
    ];

    protected $casts = [
        'subjects' => 'array',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'tenant_id');
    }
}
