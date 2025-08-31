<?php

namespace App\Modules\Courses\Models;

use App\Modules\Academics\Models\Institute;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';

    protected $fillable = [
        'name',
        'description',
        'code',
        'degree_type',
        'duration_type',
        'periods',
        'is_active',
        'tenant_id',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'program_id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'tenant_id');
    }
}
