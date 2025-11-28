<?php

namespace App\Modules\Calendar\Models;

use App\Modules\Academics\Models\Institute;
use App\Modules\Courses\Models\Course;
use App\Modules\Courses\Models\Subject;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'name',
        'description',
        'day',
        'month',
        'year',
        'is_repeatable',
        'type_id',
        'course_id',
        'subject_id',
        'author_id',
        'tenant_id'
    ];

    // Academics
    public function type()
    {
        return $this->belongsTo(TypeEvent::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    // Courses
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
