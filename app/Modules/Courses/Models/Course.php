<?php

namespace App\Modules\Courses\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Academics\Models\Institute;
use App\Modules\Calendar\Models\Event;

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
        'program_id',
        'subjects',
        'tenant_id',
    ];

    protected $casts = [
        'subjects' => 'array',
    ];

    // Academics
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'tenant_id');
    }

    // Calendar
    public function events()
    {
        return $this->hasMany(Event::class, 'course_id');
    }
}
